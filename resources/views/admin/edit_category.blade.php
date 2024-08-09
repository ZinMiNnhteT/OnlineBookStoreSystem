@extends('admin.master')
@section('styles')
<style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
    }

    input[type='text'] {
        width: 400px;
        height: 50px;
    }

</style>

@endsection
@section('content')
<h1 style="color:white">Update Category</h1>
<div class="div_deg">
    <form method="POST" action="{{ url('update_category', $category->id) }}">
        @csrf
        @method('PUT')
        <input type="text" name="category" value="{{ $category->category_name }}">
        <input class="btn btn-primary" type="submit" value="Update Category">

    </form>
</div>
@endsection
