@extends('admin.master')
@section('styles')
<style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
    }

    h1 {
        color: white;
    }

    label {
        display: inline-block;
        width: 200px;
        font-size: 18px !important;
        color: white !important;
    }

    input[type='text'] {
        width: 300px;
        height: 50px;
    }

    textarea {
        width: 300px;
        height: 50px;
    }

    .input_deg {
        padding: 15px;
    }

</style>

@endsection
@section('content')
<h2>Update Product</h2>
<div class="div_deg">
    <form method="post" action="{{ url('edit_author', $author->id) }}">
        @csrf
        @method('put')

        <div class="input_deg">
            <label>Author Name</label>
            <input type="text" name="name" value="{{ $author->name }}">
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="input_deg">
            <label>Author Biography</label>
            <textarea name="biography">{{ $author->biography }}</textarea>
            @if ($errors->has('biography'))
            <div class="text-danger">{{ $errors->first('biography') }}</div>
            @endif
        </div>

        <div class="input_deg">
            <label>Author Email</label>
            <input type="text" name="email" value="{{ $author->email }}" />
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="input_deg">
            <input class="btn btn-success" type="submit" value="Update Author">
        </div>
    </form>
</div>

@endsection
