@extends('admin.master')
@section('styles')
<style type="text/css">
    label {
        display: inline-block;
        width: 300px;
        font-size: 15px;
        font-weight: bold;
    }

</style>
@endsection
@section('content')
<h1 style="text-align:center;font-size:25px;">Send Email to: {{ $order->email }}</h1>
<form action="{{ url('send_to_email',$order->id) }}" method="POST">

    @csrf
    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email Greeting:</label>
        <input type="text" name="greeting">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email FirstLine:</label>
        <input type="text" name="firstline">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email Body:</label>
        <input type="text" name="body">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email Button name:</label>
        <input type="text" name="button">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email Url:</label>
        <input type="text" name="url">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <label>Email LastLine:</label>
        <input type="text" name="lastline">
    </div>

    <div style="padding-left:25%; padding-top: 30px;">
        <input type="submit" name="Send Email" class="btn btn-primary   ">
    </div>

</form>

@endsection
