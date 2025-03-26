@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Courses</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (request('success_message'))
        <div class="alert alert-success">
            {{ request('success_message') }}
        </div>
    @endif
    
    @if (request('error_message'))
        <div class="alert alert-danger">
            {{ request('error_message') }}
        </div>
    @endif

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-sm-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.courses.show', $course) }}">
                                <h5 class="card-title">{{ $course->name }}</h5>

                            </a>
                            <p class="card-text">{{ $course->description }}</p>
                            <p class="card-text">{{ $course->price() }}</p>
                            @if ($cart && $cart->courses->contains($course))
                                <a href="{{ route('admin.carts.removeFromCart', $course) }}" class="btn btn-danger">Remove
                                    From
                                    Cart</a>
                            @else
                                <a href="{{ route('admin.carts.addToCart', $course) }}" class="btn btn-primary">Add To
                                    Cart</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach



        </div>


    </div>
@endsection
