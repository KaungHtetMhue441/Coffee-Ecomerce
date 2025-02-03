<?php

namespace App\Http\Controllers\Stripe;

use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Order;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Enums\OrderStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripePaymentController extends Controller
{
    public function showCheckoutForm(Request $request, Order $order)
    {
        return redirect()->route("order.stripe.checkout.process", $order->id);
    }
    public function processCheckout(Request $request, Order $order)
    {
        $products = $order->products;
        $total_price = 0;
        $quantity = 0;
        $products->each(function ($product) use (&$total_price, &$quantity) {
            $total_price += $product->pivot->price * $product->pivot->quantity;
            $quantity += $product->pivot->quantity;
        });

        // dd($total_price, $quantity);
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));

        $redirectUrl = route('order.stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $cancelUrl = route('order.stripe.checkout.cancel');

        $response =  $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'cancel_url' => $cancelUrl,
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => $order->user->name
                        ],
                        'unit_amount'  => $total_price * 100,
                        'currency'     => 'MMK',
                    ],
                    'quantity'    => 1
                ],
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        // Save the Stripe session ID in the order record
        $order->stripe_session_id = $response['id'];
        $order->save();

        return redirect($response['url']);
    }

    public function showSuccess(Request $request)
    {

        $sessionId = $request->query('session_id');

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET"));
        $session = $stripe->checkout->sessions->retrieve($sessionId);

        // Find the order by the session ID
        $order = Order::where('stripe_session_id', $sessionId)->first();

        // Retrieve the PaymentIntent associated with the session
        $paymentIntentId = $session->payment_intent;
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        // Retrieve the PaymentMethod associated with the PaymentIntent
        $paymentMethodId = $paymentIntent->payment_method;
        $paymentMethod = PaymentMethod::retrieve($paymentMethodId);

        // Get card details
        $cardBrand = $paymentMethod->card->brand;
        $last4 = $paymentMethod->card->last4;

        if ($order) {
            // Update the order status to 'paid' if the payment was successful
            if ($session->payment_status === 'paid') {

                $order->status = OrderStatus::PAID;
                // $order->order_date = Carbon::now();
                $order->payment_type = $cardBrand;
                Transaction::create([
                    "order_id" => $order->id,
                    "payment_type" => $cardBrand,
                    "total_amount" => $order->total_amount,
                    "last4" => $last4,
                    "user_id" => $order->user_id,
                    "application_type" => "order"
                ]);
                $order->save();
            }
        }

        return redirect()->route("profile.index", ['type' => "pending"])->with("success", "Successfully Order");

        // return view('client.checkout.success', compact('order'));
    }

    public function showCancel()
    {
        return view('checkout.cancel')->with('error', 'Your payment was canceled. You can try again or contact support if you need assistance.');
    }
}
