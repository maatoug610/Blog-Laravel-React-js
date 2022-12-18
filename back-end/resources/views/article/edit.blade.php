<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <title>Edit Blog</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <form action="{{ route('article.update',$article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-1">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="inputTitle" value="{{ $article->title }}" name="title">
                    </div>
                    <div class="mb-1">
                        <label for="inputContent" class="form-label">Content</label>
                        <input type="text" class="form-control" id="inputContent" value="{{ $article->content }}" name="content">
                    </div>
                    <div class="mb-2">
                        <label for="inputDesc" class="form-label">Description</label>
                        <input type="text" class="form-control" id="inputDesc" value="{{ $article->description }}" name="description">
                    </div>
                    <div class="mb-2">
                        <label for="inputImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="inputImage" name="image">
                        <img src="/image/{{ $article->image }}" width="300px">
                    </div>
                    <div class="mb-2">
                        <label for="inputRead" class="form-label">Read Number</label>
                        <input type="number" class="form-control" id="inputRead" value="{{ $article->read_number }}" name="read_number" disabled readonly>
                    </div>
                    <div class="mb-1">
                        <label for="inputDeleted" class="form-label">deleted_by</label>
                        <input type="number" class="form-control" id="inputDeleted" value="{{ $article->deleted_by }}" name="deleted_by" disabled readonly>
                    </div>
                    <div class="mb-1">
                        <label for="inputCreated" class="form-label">created_by</label>
                        <input type="number" class="form-control" id="inputCreated" value="{{ $article->created_by }}" name="created_by" disabled readonly>
                    </div>
                    <div class="mb-1">
                        <label for="inputUpdated" class="form-label">updated_by</label>
                        <input type="number" class="form-control" id="inputUpdated" value="{{ $article->updated_by }}" name="updated_by" disabled readonly>
                    </div>
                    <div class="mb-1">
                        <label for="inputlast_read_at" class="form-label">Last_read</label>
                        <input type="datetime-local" class="form-control" id="inputlast_read_at" value="{{ $article->last_read_at }}" name="last_read_at" disabled readonly>
                    </div>

                    <div class="mb-1 form-check">
                        @if($article->ischecked == 1)
                        <input type="checkbox" class="form-check-input" id="isChecked" name="ischecked" checked>
                        <label class="form-check-label" for="isChecked">is checked</label>
                        @elseif($article->ischecked == 0)
                        <input type="checkbox" class="form-check-input" id="isChecked" name="ischecked">
                        <label class="form-check-label" for="isChecked">is checked</label>
                        @endif
                    </div>
                    <div class="mb-1 form-check">
                        @if($article->isdraft == 1)
                        <input type="checkbox" class="form-check-input" id="isDraft" name="isdraft" checked>
                        <label class="form-check-label" for="isDraft">is draft</label>
                        @elseif($article->isdraft == 0)
                        <input type="checkbox" class="form-check-input" id="isDraft" name="isdraft">
                        <label class="form-check-label" for="isDraft">is draft</label>
                        @endif
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
