<!DOCTYPE html>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <title>index Blog</title>
</head>

<body>
    <table class="table caption-top">
    <h3 style="text-align: center;margin:20px 0px; color:red;">List of Articles</h3>
        <a href="{{ route('article.create')}}" class="btn btn-primary">Add</a>
        <a href="{{ route('article.recycle')}}" class="btn btn-danger">Recycle List</a>

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">isDraft</th>
                <th scope="col">isChecked</th>
                <th scope="col">Read_Number</th>
                <th scope="col">Last_read</th>
                <th scope="col">Deleted By</th>
                <th scope="col">Created By</th>
                <th scope="col">Updated By</th>
                <th scope="col">Crud</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->content}}</td>
                <td>{{$article->description}}</td>
                <td><img src="/image/{{ $article->image }}" width="100px"></td>
                <td>{{$article->isdraft}}</td>
                <td>{{$article->ischecked}}</td>
                <td>{{$article->read_number}}</td>
                <td>{{$article->last_read_at}}</td>
                <td>{{$article->deleted_by}}</td>
                <td>{{$article->created_by}}</td>
                <td>{{$article->updated_by}}</td>


                <td>
                    <form action="{{ route('article.destroy',$article->id) }}" method="POST" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <!-- <a class="btn btn-info" href="{{ route('article.show',$article->id) }}">Show</a> -->
                        <a class="btn btn-primary" href="{{ route('article.edit',$article->id) }}">Edit</a>
                        <a class="btn btn-warning" href="{{ route('article.show',$article->id) }}">Show</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                <td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
