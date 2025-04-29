
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
                    @if (session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif
        
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                        Add New Category
                    </a>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th width="20%">Actions</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $key => $category)
                                                <tr>
                                                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->description }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.categories.show', ['category' => $category]) }}"
                                                            class="btn btn-primary btn-sm">
                                                            Show
                                                        </a>
        
                                                        <a href="{{ route('admin.categories.edit', ['category' => $category]) }}"
                                                            class="btn btn-primary btn-sm">
                                                            Edit
                                                        </a>    
        
                                                        <form
                                                            action="{{ route('admin.categories.destroy', ['category' => $category]) }}"
                                                            class="d-inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
        
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="100%">
                                                    <div class="text-danger text-center" role="alert">
                                                        No Categories Found
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
        
                            {{ $categories->appends(request()->query())->render('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
