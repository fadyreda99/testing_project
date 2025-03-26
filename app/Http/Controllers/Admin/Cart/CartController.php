<?php

namespace App\Http\Controllers\Admin\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        // $cart = Cart::with('courses')->where('session_id', session()->getId())->first();
        return view('admin.carts.index', get_defined_vars());
    }

    public function addToCart(Course $course)
    {
        $cart = Cart::firstOrCreate([
            'session_id' => session()->getId(),
            'admin_id' => auth()->guard('admin')->user()->id ?? null,
        ]);

        $cart->courses()->syncWithoutDetaching($course);

        return redirect()->back();
    }

    public function removeFromCart(Course $course)
    {
        $cart = Cart::where('session_id', session()->getId())->first();
        abort_unless($cart, 404);
        $cart->courses()->detach($course);
        return back();
    }
}
