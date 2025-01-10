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
                <div class="col-sm-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ route('admin.courses.show', $course) }}"> --}}
                            <h5 class="card-title">TOTAL: {{ $cart->total() }}</h5>


                            <a href="#" class="btn btn-success">CheckOut</a>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>
@endsection
