<table>
    <thead>
        <tr>
            <th>id</th>
            <th>post</th>
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
                    <td>{{ $post->post }}</td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>