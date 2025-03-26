<?php

namespace App\Http\Controllers\Admin\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Checkout;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {

        $cart = Cart::where('session_id', session()->getId())->first();
        $prices = $cart->courses()->pluck('stripe_price_id')->toArray(); // Convert to plain array
        $sessionOprions = [
            'success_url' => route('admin.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('admin.checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            // 'success_url' => route('admin.courses.index', ['success_message' => 'payment was successfully']),
            // 'cancel_url' => route('admin.courses.index', ['error_message' => 'payment was cancelled']),
            // 'billing_address_collection' => 'required', 
            // 'phone_number_collection' => [
            //     'enabled' => true
            // ]
            // "payment_method_types" => [
            //     "card"
            // ],
            'metadata' => [
                'user_id' => Auth::guard('admin')->id(),
                'cart_id' => $cart->id
            ]

        ];
        $payment = Auth::guard('admin')->user()->checkout($prices, $sessionOprions);

        // this to generate url for the payment method to front end 
        // return response()->json(['checkout_url' => $payment->url]);
        // dd($payment);
        return $payment;
    }
    public function enableCoupons(Request $request)
    {

        $cart = Cart::where('session_id', session()->getId())->first();
        $prices = $cart->courses()->pluck('stripe_price_id')->toArray(); // Convert to plain array
        $sessionOprions = [
            // 'success_url' => route('admin.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            // 'cancel_url' => route('admin.checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            'success_url' => route('admin.courses.index', ['success_message' => 'payment was successfully']),
            'cancel_url' => route('admin.courses.index', ['error_message' => 'payment was cancelled']),
            // 'billing_address_collection' => 'required', 
            // 'phone_number_collection' => [
            //     'enabled' => true
            // ]
            // "payment_method_types" => [
            //     "card"
            // ],
            // 'metadata' => [
            //     'user_id' => Auth::guard('admin')->id(),
            //     'cart_id' => $cart->id
            // ]
            // "allow_promotion_codes" => true,

        ];
        $payment = Auth::guard('admin')->user()
            // ->allowPromotionCodes()
            ->withCoupon('qVkBjUqq')
            // ->withPromotionCode('promo_1QkAQuR6sneoDwjohaXoBtce')
            ->checkout($prices, $sessionOprions);

        // this to generate url for the payment method to front end 
        // return response()->json(['checkout_url' => $payment->url]);
        // dd($payment);
        return $payment;
    }

    // for only one item
    // public function nonStrtipeProductsCheckout(Request $request)
    // {
    //     $cart = Cart::where('session_id', session()->getId())->first();
    //     $amount = $cart->courses()->sum('price'); // Convert to plain array
    //     $quantity = 1;
    //     $name = 'courses bundle';
    //     $sessionOprions = [
    //         'success_url' => route('admin.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('admin.checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
    //         // 'success_url' => route('admin.courses.index', ['success_message' => 'payment was successfully']),
    //         // 'cancel_url' => route('admin.courses.index', ['error_message' => 'payment was cancelled']),
    //         'metadata' => [
    //             'user_id' => Auth::guard('admin')->id(),
    //             'cart_id' => $cart->id
    //         ]

    //     ];
    //     $payment = Auth::guard('admin')->user()->checkoutCharge($amount,  $name, $quantity, $sessionOprions);

    //     // this to generate url for the payment method to front end 
    //     // return response()->json(['checkout_url' => $payment->url]);
    //     // dd($payment);
    //     return $payment;
    // }
    // for array of items
    public function nonStrtipeProductsCheckout(Request $request)
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        $courses = $cart->courses->map(function ($course) {
            return [
                'price_data' => [
                    'currency' => env('CASHIER_CURRENCY', 'usd'),
                    'product_data' => [
                        'name' => $course->name,
                    ],
                    'unit_amount' => $course->price,
                ],
                'quantity' => 1,
                // handle quantity from stripe
                // 'adjustable_quantity' => [ 
                //     'enabled' => true,
                //     'maximum' => 100,
                //     'minimum' => 0,
                // ],
            ];
        })->toArray();

        $sessionOptions = [
            'success_url' => route('admin.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('admin.checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            // 'success_url' => route('admin.courses.index', ['success_message' => 'payment was successfully']),
            // 'cancel_url' => route('admin.courses.index', ['error_message' => 'payment was cancelled']),
            'metadata' => [
                'user_id' => Auth::guard('admin')->id(),
                'cart_id' => $cart->id
            ],
            'line_items' => $courses

        ];
        $payment = Auth::guard('admin')->user()->checkout(null, $sessionOptions);

        // this to generate url for the payment method to front end 
        // return response()->json(['checkout_url' => $payment->url]);
        // dd($payment);
        return $payment;
    }
    public function nonStrtipeProductsCheckoutGuest(Request $request)
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        $courses = $cart->courses->map(function ($course) {
            return [
                'price_data' => [
                    'currency' => env('CASHIER_CURRENCY', 'usd'),
                    'product_data' => [
                        'name' => $course->name,
                    ],
                    'unit_amount' => $course->price,
                ],
                'quantity' => 1,
                // handle quantity from stripe
                // 'adjustable_quantity' => [ 
                //     'enabled' => true,
                //     'maximum' => 100,
                //     'minimum' => 0,
                // ],
            ];
        })->toArray();

        $sessionOptions = [
            // 'success_url' => route('admin.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            // 'cancel_url' => route('admin.checkout.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            'success_url' => route('admin.courses.index', ['success_message' => 'payment was successfully']),
            'cancel_url' => route('admin.courses.index', ['error_message' => 'payment was cancelled']),
            'metadata' => [
                'user_id' => Auth::guard('admin')->id(),
                'cart_id' => $cart->id
            ],
            'line_items' => $courses

        ];
        $payment = Checkout::guest()->create(null, $sessionOptions);
        return $payment;
    }

    public function success(Request $request)
    {

        // dd($request->all());
        // $session = $request->user()->stripe()->checkout->sessions->retrieve($request->session_id);
        // $session = Auth::guard('admin')->user()->stripe()->checkout->sessions->retrieve($request->session_id);
        $session = $request->user('admin')->stripe()->checkout->sessions->retrieve($request->session_id);
        if ($session->payment_status == 'paid') {

            $cart = Cart::findOrFail($session->metadata->cart_id);
            $order = Order::create([
                'admin_id' => $request->user('admin')->id,
                'status' => $session->payment_status,
            ]);

            $order->courses()->attach($cart->courses->pluck('id')->toArray());
            $cart->delete();
            return redirect()->route('admin.courses.index', ['success_message' => 'payment was successfully']);
        }
        // dd($session);
        // return view('admin.checkout.success');
    }

    public function cancel(Request $request)
    {
        $session = $request->user('admin')->stripe()->checkout->sessions->retrieve($request->session_id);


        dd($session);

        // return view('admin.checkout.cancel');
    }
}
