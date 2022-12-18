<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <title>Add Blog</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">

                <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-1">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="inputTitle" placeholder="title article" name="title">
                    </div>

                    <div class="mb-1">
                        <label for="inputContent" class="form-label">Content</label>
                        <input type="text" class="form-control" id="inputContent" placeholder="content article" name="content">
                    </div>

                    <div class="mb-3">
                        <label for="inputDesc" class="form-label">Description</label>
                        <input type="text" class="form-control" id="inputDesc" placeholder="title article" name="description">
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" name="image">
                    </div>


                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input" id="isChecked" name="ischecked">
                        <label class="form-check-label" for="isChecked">is checked</label>

                    </div>


                    <div class="mb-1 form-check">
                        <input type="checkbox" class="form-check-input" id="isDraft" name="isdraft">
                        <label class="form-check-label" for="isDraft">is draft</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
    </div>
</body>

</html>
