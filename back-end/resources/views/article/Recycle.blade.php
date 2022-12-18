<!DOCTYPE html>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="utf-8" />
    <title>Recycle Blog</title>
</head>

<body>
    <table class="table caption-top">
        <h3 style="text-align: center;margin:20px 0px; color:red;">List of Recycle</h3>

        <form action="{{ route('article.DeleteAllTrashed') }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-warning">Delete All</button>
        </form>
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
                <th scope="col">Deleted at</th>
                <th scope="col">Crud</th>
            </tr>
        </thead>
        <tbody>


            @foreach($articles as $article)
            @if($article->deleted_at != null)
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
                <td>{{$article->deleted_at}}</td>

                <td>
                    <form action="{{ route('article.forceDelete',$article->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('article.restore', $article->id) }}" class="btn btn-success">Restore</a>
                </td>
                <td>
                </td>
            </tr>

            @endif
            @endforeach

        </tbody>
    </table>
</body>

</html>
