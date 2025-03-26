@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Cart Courses</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="row">
            @if ($cart && count($cart->courses) > 0)
                @foreach ($cart->courses as $course)
                    <div class="col-sm-4 mt-3">
                        <div class="card">
                            <div class="card-body">
                                {{-- <a href="{{ route('admin.courses.show', $course) }}"> --}}
                                <h5 class="card-title">{{ $course->name }}</h5>

                                {{-- </a> --}}
                                <p class="card-text">{{ $course->description }}</p>
                                <p class="card-text">{{ $course->price() }}</p>
                                <a href="{{ route('admin.carts.removeFromCart', $course) }}"
                                    class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-danger">
                    no courses in the cart
                </div>
            @endif


            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ route('admin.courses.show', $course) }}"> --}}
                            <h5 class="card-title">TOTAL: {{ $cart?->total() ?? 0.0 }}</h5>


                            <a href="{{ route('admin.checkout.checkout') }}" class="btn btn-success">CheckOut</a>
                            <a href="{{ route('admin.checkout.enableCoupons') }}" class="btn btn-success">CheckOut
                                Coupon</a>
                            <a href="{{ route('admin.checkout.none-stripe') }}" class="btn btn-success">CheckOut none
                                stripe</a>
                            <a href="{{ route('admin.checkout.none-stripe-guest') }}" class="btn btn-success">CheckOut none
                                stripe guest</a>
                            <a href="{{ route('admin.direct.payment-method') }}" class="btn btn-success">CheckOut Direct
                                Integration PaymentMethod</a>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>
@endsection
