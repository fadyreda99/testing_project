<?php

namespace App\Http\Controllers\AdminAuth;

use App\Events\LogoutEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
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
    public function store(LoginRequest $request): RedirectResponse
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        $request->authenticate('admin');

        $request->session()->regenerate();

        if ($cart) {
            $cart->update([
                'session_id' => session()->getId(),
                'admin_id' => auth()->guard('admin')->user()->id
            ]);
        }

        return to_route('admin.home');
        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        $user = auth()->guard('admin')->user();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('admin.login');
    }
}
