<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="/admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
            <h1 class="h5">Zin Min Htet</h1>
            <p>Web Developer</p>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li><a href="{{ url('admin/dashboard') }}"> <i class="icon-home"></i>Home</a></li>
        <li><a href="{{ url('view_category') }}"> <i class="icon-grid"></i>Category </a></li>
        <li>
            <a href="{{ url('view_orders') }}">
                <i class="icon-grid"></i>Orders
            </a>
        </li>
        <li>
            <a href="#exampledropdownBooks" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Books
            </a>
            <ul id="exampledropdownBooks" class="collapse list-unstyled">
                <li><a href="{{ url('add_book') }}">Add Books</a></li>
                <li><a href="{{ url('view_book') }}">View Books</a></li>
            </ul>
        </li>
        <li>
            <a href="#exampledropdownAuthor" aria-expanded="false" data-toggle="collapse">
                <i class="icon-windows"></i>Authors
            </a>
            <ul id="exampledropdownAuthor" class="collapse list-unstyled">
                <li><a href="{{ url('add_author') }}">Add Authors</a></li>
                <li><a href="{{ url('view_author') }}">View Authors</a></li>
            </ul>
        </li>
    </ul>
</nav>
