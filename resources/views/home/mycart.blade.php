@extends('home.HomeMaster')
@section('styles')
<style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px;
    }

    table {
        border: 2px solid black;
        text-align: center;
        width: 650px;
    }

    th {
        border: 2px solid black;
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;
    }

    td {
        border: 1px solid skyblue;
    }

    .cart_value {
        text-align: center;
        padding: 18px;
    }

    .order_deg {
        margin-bottom: 20px;

    }

    label {
        display: inline-block;
        width: 100px;
    }

    .div_gap {
        padding: 20px;
    }

</style>
@endsection
@section('content')

<div class="div_deg">
    <table>
        <tr>
            <th>Book Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Remove</th>
        </tr>

        <?php
            $value = 0;
            ?>

        @foreach ($carts as $cart)
        <tr>

            <td>{{ $cart->book->title }}</td>
            <td>{{ $cart->book->price }}</td>
            <td>
                <img width="50" src="/books/{{ $cart->book->image }}">
            </td>
            <td>
                <form action="{{ url('delete_cart',$cart->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </td>
        </tr>
        <?php
            $value = $value + $cart->book->price;
             ?>
        @endforeach
    </table>
</div>
<div class="cart_value">
    <h3>Total Value of cart is : ${{ $value }}</h3>
</div>

<div class="order_deg" style="display:flex; justify-content:center; align-items:center">
    <form action="{{ url('comfirm_order') }}" method="POST">
        @csrf
        <div class="div_gap">
            <label>Receiver Name</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}">
        </div>

        <div class="div_gap">
            <label>Receiver Address</label>
            <textarea name="address">{{ Auth::user()->address }}</textarea>
        </div>

        <div class="div_gap">
            <label>Receiver Address</label>
            <textarea name="email">{{ Auth::user()->email }}</textarea>
        </div>

        <div class="div_gap">
            <label>Receiver Phone</label>
            <input type="text" name="phone" value="{{ Auth::user()->phone }}">
        </div>

        <div>
            <input class="btn btn-primary" type="submit" value="Cash On Delivery">
            <a class="btn btn-success" href="{{ url('stripe',$value) }}">Pay Using Card</a>
        </div>
    </form>
</div>
@endsection
