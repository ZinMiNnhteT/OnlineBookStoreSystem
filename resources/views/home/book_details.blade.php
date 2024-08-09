@extends('home.HomeMaster')
@section('styles')
<style type="text/css">
    .div_center {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .detail-box {
        padding: 15px;
    }

    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
@endsection
@section('content')
<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Latest Products
            </h2>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="div_center">
                        <img width="400" src="/books/{{ $book->image }}" alt="">
                    </div>

                    <div class="detail-box">
                        <h6>{{ $book->title }}</h6>
                        <h6>Price
                            <span>
                                {{ $book->price }}
                            </span>
                        </h6>
                    </div>

                    <div class="detail-box">
                        <h6>Category{{ $book->category->category_name }}</h6>
                        <h6>Avaiable Quantity
                            <span>
                                {{ $book->quantity }}
                            </span>
                        </h6>
                    </div>

                    <div class="detail-box">
                        <p>
                            {{ $book->description }}
                        </p>
                        </h6>
                    </div>

                    <div class="detail-box">
                        <a class="btn btn-primary" href="{{ url('add_cart',$book->id) }}">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
