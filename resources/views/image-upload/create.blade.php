<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Laravel Image Upload</title>
    <style>
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-5">Image Upload in Laravel</h3>
        <form action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="user-image mb-3 text-center">
                <div class="imgPreview"> </div>
            </div>            
            <div class="mb-3">
                <input type="text" name="nama" placeholder="nama" class="form-control">
            </div>
            <div class="custom-file">
                <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                <label class="custom-file-label" for="images">Choose image</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Images
            </button>
            <a href="/image-upload-dua" class="text-center">
                upload image v2
            </a>
        </form>
    </div>

    <!-- tampilin data yang diupload -->
    <div class="container mt-5">
        <div class="table">
            <table class="table table-bordered">
                <tbody>
                    @foreach ($images as $image)
                    <tr>
                        <th>Judul</th>
                        <td>@foreach (json_decode($image->name) as $picture )
                            <a href="{{ asset('/uploads/' . $picture) }}">
                                <img src="{{ asset('/uploads/' . $picture) }}" alt="" class="ms-3" width="100" height="100">
                            </a>
                        @endforeach
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- sourc -->
    <div class="text-center">
        <a href="https://www.positronx.io/laravel-multiple-images-upload-with-validation-example/">sumber coding</a> <br> <br>
        <a href="https://medium.com/dot-intern/create-multiple-upload-images-laravel-plus-displaying-on-view-6074aca289d">tampilin data gambar pakai json encode</a>
    </div>
  
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });    
    </script>
</body>
</html>