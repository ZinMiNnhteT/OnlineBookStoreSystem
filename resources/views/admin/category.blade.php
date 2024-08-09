@extends('admin.master')
@section('styles')
<style type="text/css">
    input[type='text'] {
        width: 400px;
        height: 50px;
    }

    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
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

</style>
@endsection
@section('content')
<h1 style="color:white">Add Category</h1>
<div class="div_deg">
    <form action="{{ url('add_category') }}" method="POST">
        @csrf
        <div>
            <input type="text" name="category">
            <input class="btn btn-primary" type="submit" value="Add Category">
        </div>
    </form>
</div>
<div>
    <table class="table_deg table table-striped table-bordered table-hover">
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>

        @foreach ($categories as $key=>$category )
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
                <a href="{{ url('edit_category', $category->id) }}">
                    <button type="button" class="btn btn-primary">Edit</button>
                </a>

                <form action="{{ url('delete_category', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
