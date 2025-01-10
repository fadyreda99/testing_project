@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Course {{$course->name}}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="row">
            <div class="col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <p class="card-text">{{ $course->price }}</p>
                        <a href="#" class="btn btn-primary">Add To Cart</a>
                    </div>
                </div>
            </div>



        </div>


    </div>
@endsection
