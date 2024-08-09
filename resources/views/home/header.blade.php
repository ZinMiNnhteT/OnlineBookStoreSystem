<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
            <span>
                Online Book Store
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('shop') }}">
                        Shop
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('why') }}">
                        Why Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('testimonial') }}">
                        Testimonial
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                </li>
            </ul>
            <div class="user_option">

                @if (Route::has('login'))
                @auth

                <a href="{{ url('myorders') }}">
                    My Orders
                </a>

                <a href="{{ url('mycart') }}">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>{{ $count }}

                </a>

                <form class="form-inline" action="{{ url('search') }}" method="GET">
                    @csrf
                    <input class="form-control mr-sm-2 auth_search-box" type="search" name="search" placeholder="Search Books" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </form>


                <form method="POST" style="padding:15px" action="{{ route('logout') }}">
                    @csrf
                    <input class="btn btn-success" type="submit" value="logout">
                </form>

                @else
                <a href="{{ url('/login') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Login
                    </span>
                </a>

                <a href="{{ url('/register') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        Register
                    </span>
                </a>

                <form class="form-inline" action="{{ url('search') }}" method="GET">
                    @csrf
                    <input class="form-control mr-sm-2 search-box" type="search" name="search" placeholder="Search Books" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>Search</button>
                </form>

                @endauth
                @endif

            </div>
        </div>
    </nav>
</header>
