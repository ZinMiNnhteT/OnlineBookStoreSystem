<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Latest Books
            </h2>
        </div>
        <div class="row">
            @foreach($books as $book)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">

                    <div class="img-box">
                        <img src="/books/{{ $book->image }}" alt="">
                    </div>
                    <div class="detail-box">
                        <h6>Title : <span>{{ $book->title }}</span></h6>
                    </div>
                    <div class="detail-box">
                        <h6>Author : <span>{{ $book->author->name }}</span></h6>
                    </div>
                    <div class="detail-box">
                        <h6>Price:
                            <span>
                                ${{ $book->price }}
                            </span>
                        </h6>
                        <h6>Since: <span>{{ $book->publish_year }}</span></h6>
                    </div>

                    <div style="padding:10px">
                        <a class="btn btn-danger" href="{{ url('book_details', $book->id) }}">Details</a>

                        <a class="btn btn-primary" href="{{ url('add_cart',$book->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16" style="margin-bottom: 5px; right: 10px;">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                            Add to Cart</a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="div_deg">
            {{ $books->onEachSide(1)->links() }}
        </div>

    </div>
</section>
