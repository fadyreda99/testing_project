@extends('admin.master')

@section('content')
    <div class="container">
        <h1>categories</h1>

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
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            {{-- MODIFICATIONS FROM HERE --}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Name</label>
                                    <p class="border form-control">{{ $category->name ?? '--' }}</p>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">Description</label>
                                    <p class="border form-control">{{ $category->description ?? '--' }}</p>
                                </div>
                            </div>
                            {{-- MODIFICATIONS TO HERE --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
