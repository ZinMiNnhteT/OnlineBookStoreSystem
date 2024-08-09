<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

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
            max-width: 600px;
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
        }

        .table-container .table {
            width: 100%;
            white-space: nowrap;
        }

        input[type='search'] {
            width: 400px;
            height: 45px;
            margin: 15px;
            border-radius: 30px;
        }

    </style>
</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <form class="form-inline" action="{{ url('book_search') }}" method="GET">
                        @csrf
                        <input class="form-control mr-sm-2 search-box" type="search" name="search" placeholder="Search Books" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>Search</button>
                        <button type="button" style="margin-left:500px" class="btn btn-secondary pull-right" onclick=" window.history.back();"> Back</button>
                    </form>
                    <div class="result"></div>

                    <div class="table-container">
                        <div id="books-container" class="container mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Book Modal -->
        <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editBookForm">
                        <div class="modal-body">
                            <input type="hidden" id="editBookId" name="id">
                            <div class="form-group">
                                <label for="editBookTitle">Title:</label>
                                <input type="text" class="form-control" id="editBookTitle" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookAuthor">Author:</label>
                                <input type="text" class="form-control" id="editBookAuthor" name="author" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookCategory">Category:</label>
                                <input type="text" class="form-control" id="editBookCategory" name="category" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookDescription">Description:</label>
                                <textarea class="form-control" id="editBookDescription" name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editBookPublishYear">Publish Year:</label>
                                <input type="text" class="form-control" id="editBookPublishYear" name="publish_year" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookPrice">Price:</label>
                                <input type="number" class="form-control" id="editBookPrice" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookQuantity">Quantity:</label>
                                <input type="number" class="form-control" id="editBookQuantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="editBookImage">Current Image:</label>
                                <img style="margin:3px;" width="80" id="editBookImage">
                            </div>

                            <div class="form-group">
                                <label for="editBookImage">New Image:</label>
                                <input type="file" class="form-control" id="editBookImage" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
        <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
        <script src="{{ asset('admincss/js/front.js') }}"></script>

        <script>
            $(document).ready(function() {
                fetchBooks();

                function fetchBooks() {
                    $.ajax({
                        url: 'http://localhost:8000/api/books'
                        , type: 'GET'
                        , dataType: 'json'
                        , success: function(response) {
                            var booksContainer = $('#books-container');
                            var books = response.books;
                            var html = '<table class="table_deg table table-striped table-bordered table-hover">' +
                                '<tr>' +
                                '<th>#</th>' +
                                '<th>Title</th>' +
                                '<th>Author</th> ' +
                                '<th>Category</th>' +
                                '<th>Description</th>' +
                                '<th>Publish Year</th>' +
                                '<th>Price</th>' +
                                '<th>Quantity</th>' +
                                '<th>Image</th>' +
                                '<th>Action</th>' +
                                '</tr>';

                            $.each(books, function(index, book) {
                                var imageUrl = 'books/' + book.image;
                                var categoryName = book.category && book.category.category_name ? book.category.category_name : '';
                                html += '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + book.title + '</td>' +
                                    '<td>' + book.author.name + '</td>' +
                                    '<td>' + categoryName + '</td>' +
                                    '<td>' + book.description + '</td>' +
                                    '<td>' + book.publish_year + '</td>' +
                                    '<td>$' + book.price + '</td>' +
                                    '<td>' + book.quantity + '</td>' +
                                    '<td><img src="' + imageUrl + '" alt="' + book.title + ' image" width="50"></td>' +
                                    '<td>' +
                                    '<button class="btn btn-warning btn-edit" data-id="' + book.id + '">Edit</button> ' +
                                    '<button class="btn btn-danger btn-delete" data-id="' + book.id + '">Delete</button>' +
                                    '</td>' +
                                    '</tr>';
                            });

                            html += '</table>';
                            booksContainer.html(html);
                        }
                        , error: function(xhr, status, error) {
                            console.error('Error fetching books:', error);
                        }
                    });
                }

                $(document).on('click', '.btn-delete', function() {
                    if (confirm('Are you sure you want to delete this book?')) {
                        let id = $(this).data('id');
                        $.ajax({
                            url: '/api/book/' + id + '/delete'
                            , type: 'DELETE'
                            , success: function(response) {
                                alert(response.message);
                                fetchBooks();
                            }
                            , error: function(xhr, status, error) {
                                console.error('Error deleting product:', error);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');

                    $.ajax({
                        url: '/api/book/' + id + '/show'
                        , type: 'GET'
                        , success: function(response) {
                            var book = response.books;
                            $('#editBookId').val(book.id);
                            $('#editBookTitle').val(book.title);
                            $('#editBookAuthor').val(book.author.name);
                            $('#editBookCategory').val(book.category.category_name);
                            $('#editBookDescription').val(book.description);
                            $('#editBookPublishYear').val(book.publish_year);
                            $('#editBookPrice').val(book.price);
                            $('#editBookQuantity').val(book.quantity);
                            $('#editBookImage').attr('src', 'books/' + book.image);
                            $('#editBookModal').modal('show');
                        }
                        , error: function(xhr, status, error) {
                            console.error('Error fetching product details:', error);
                        }
                    });
                });

                $('#editBookForm').submit(function(e) {
                    e.preventDefault();
                    let id = $('#editBookId').val();
                    let formData = new FormData(this);

                    $.ajax({
                        url: 'http://localhost:8000/api/book/' + id + '/update'
                        , type: 'PUT'
                        , data: formData
                        , processData: false
                        , contentType: false
                        , success: function(response) {
                            alert(response.message);
                            $('#editBookModal').modal('hide');
                            fetchBooks();
                        }
                        , error: function(xhr, status, error) {
                            console.error('Error updating book:', error);
                        }
                    });
                });


            });

        </script>
</body>
</html>
