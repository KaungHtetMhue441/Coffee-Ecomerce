<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $status  = $request->status;
        $orders = Order::where("user_id", "=", auth()->user()->id);
        if ($status == null) {
            $orders->whereNotNull("status");
        } else {
            $orders->where("status", "like", "%" . $status . "%");
        }
        if ($request["from"]) {
            $orders->whereDate("order_date", ">=", $request["from"]);
        }
        if ($request["to"]) {
            $orders->whereDate("order_date", "<=", $request["to"]);
        }
        if ($request['id']) {
            $orders->where("id", "=", $request['id']);
        }
        $orders = $orders->paginate(8)->appends($request->all());

        return view('client.profile.index', [
            'user' => $request->user(),
            "orders" => $orders,
            "status" => $status
        ]);
    }

    public function inbox(Request $request): View
    {
        return view('client.profile.inbox', [
            'user' => $request->user(),
        ]);
    }

    public function setting(Request $request): View
    {
        return view('client.profile.setting', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
