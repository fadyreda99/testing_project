@extends('admin.master')

@section('content')
    <div class="container">
        <h1>Courses</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                            <p class="card-text">{{ $course->price }}</p>
                            <a href="#" class="btn btn-primary">Add To Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>


    </div>
@endsection
