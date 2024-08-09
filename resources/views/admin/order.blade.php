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
        width: 100%;
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
    <h3>All ORDERS</h3>
    <br>
    <table class="table_deg">
        <tr>
            <th>#</th>
            <th>Customer name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Book title</th>
            <th>Price</th>
            <th>Payment Status</th>
            <th>Image</th>
            <th>Status</th>
            <th>Change Status</th>
            <th>Print PDF</th>
            <th>Send Email</th>
        </tr>
        @foreach($orders as $key => $order)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->rec_address }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->book->title }}</td>
            <td>{{ $order->book->price }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>
                <img width="150" src="/books/{{ $order->book->image }}">
            </td>
            <td>
                @if($order->status == 'in progress')
                <span style="color:red">{{ $order->status }}</span>

                @elseif($order->status == 'on the way')
                <span style="color:skyblue">{{ $order->status }}</span>

                @else
                <span style="color:yellow">{{ $order->status }}</span>
                @endif
            </td>
            <td>
                <div style="display: flex">
                    <a class="btn btn-primary" href="{{ url('on_the_way',$order->id) }}">On the way</a>

                    <a class="btn btn-success  ml-2" href="{{ url('delivered',$order->id) }}">Delivered</a>

                </div>
            </td>
            <td>
                <a class="btn btn-secondary" href="{{ url('print_pdf',$order->id) }}">Print PDF</a>
            </td>

            <td>
                <a class="btn btn-info" href="{{ url('send_email',$order->id ) }}">Send Email </a>
            </td>

        </tr>
        @endforeach
    </table>

</div>

@endsection
