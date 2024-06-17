<x-app-layout>
    <x-dynamic-page-title text="Posts"></x-dynamic-page-title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">


                <table class="table m-5 w-80">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">post</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($posts) == 0)
                            <tr>
                                <td colspan="2">No posts found</td>
                            </tr>
                        @else
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    {{-- <td>{{ $post->post_en }}</td> --}}
                                    <td>{{ $post->{'post_' . app()->getLocale()} }}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>




            </div>
        </div>
    </div>
</x-app-layout>
