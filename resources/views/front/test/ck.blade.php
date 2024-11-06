<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKEditor Image Upload</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script> <!-- CKEditor 5 CDN -->
</head>

<body>
    <form action="{{ route('front.ck') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="10" cols="80"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>

    @if(isset($data))
        @foreach ($data as $da)
            <p>{!! $da->desc !!}</p>
        @endforeach
    @endif
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: 'https://ckeditor.com/apps/ckfinder/3.5.0/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

                    // uploadUrl: '{{ route('front.ck.image.upload') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'],
                    styles: ['full', 'alignLeft', 'alignCenter', 'alignRight']
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>

</html>
