<?php

namespace App\Http\Controllers\Admin\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodCheckoutController extends Controller
{
    public function index()
    {
        return view('admin.stripe-direct-integ.payment-method');
    }

    public function post(Request $request)
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        $paymentMethod = $request->payment_method;
        $amount = $cart->courses()->sum('price');
        $payment =   Auth::guard('admin')->user()->charge($amount, $paymentMethod, [
            'return_url' => route('admin.courses.index'),
        ]);
        if ($payment->status == 'succeeded') {
            $order = Order::create([
                'admin_id' => Auth::guard('admin')->id(),
                'amount' => $amount,
                'status' => 'paid'
            ]);
            $order->courses()->attach($cart->courses->pluck('id')->toArray());
            $cart->delete();
            return redirect()->route('admin.courses.index', ['success_message' => 'payment was successfully']);
        }
    }
}
