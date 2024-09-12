<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $admin = auth()->guard("admin")->user();

        $url = route('admin.dashboard', absolute: false);

        if ($admin->role->name == "admin") {
            $url = route('admin.dashboard', absolute: false);
        }
        if ($admin->role->name == "staff") {
            $url = route("admin.order.index", "pending");
        }
        if ($admin->role->name == "cashier") {
            $url = route("admin.sale.index");
        }
        // dd($url);
        return redirect($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
