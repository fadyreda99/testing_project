<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPUB Viewer</title>
</head>

<body>
    <h1>EPUB Viewer</h1>
    <div id="epub-viewer" style="width: 100%; height: 90vh; border: 1px solid #ccc;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.6.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/epubjs@0.3.88/dist/epub.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const book = ePub(
                "https://popeshenoudatest.msol.dev/Fundamental-Accessibility-Tests-Basic-Functionality-v2.0.0.epub"
                );
            const rendition = book.renderTo("epub-viewer", {
                width: "100%",
                height: "100%"
            });

            rendition.display();
        });
    </script>
</body>

</html>
