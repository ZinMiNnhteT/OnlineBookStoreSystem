@extends('admin.master')
@section('styles')
<style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
    }

    .table_deg {
        text-align: center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 5px;
        width: 600px;
    }

    th {
        background-color: skyblue;
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
        color: white;
    }

    td {
        color: white;
        padding: 10px;
        border: 1px solid skyblue;
    }

    .table-container {
        overflow-x: auto;
        max-width: 100%;
        /* Adjust the width as needed */
    }

    .table-container .table {
        width: 100%;
        white-space: nowrap;
    }

    input[type='search'] {
        width: 400px;
        height: 45px;
        margin-left: 50px;
    }

</style>

@endsection
@section('content')
<div class="table-container">

    <form action="{{ url('author_search') }}" method="GET">
        @csrf
        <input type="search" name="search">
        <input type="submit" class="btn btn-secondary" value="Search">
        <button type="button" class="btn btn-secondary pull-right" onclick=" window.history.back();"> Back</button>

    </form>

    <table class="table_deg table table-striped table-bordered table-hover">

        <tr>
            <th>#</td>
            <th>Author Name</th>
            <th>Biography</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        @foreach ($authors as $key=>$author)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $author->name }}</td>
            <td>{!!Str::words($author->biography,5)!!}</td>
            <td>{{ $author->email }}</td>
            <td>
                <a href="{{ url('update_author', $author->id) }}">
                    <button type="button" class="btn btn-primary">Edit</button>
                </a>

                <form action="{{ url('delete_author', $author->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>

        </tr>

        @endforeach

    </table>
</div>
<div class="div_deg">
    {{ $authors->onEachSide(1)->links() }}
</div>

@endsection
