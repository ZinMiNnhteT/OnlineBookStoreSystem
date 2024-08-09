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

    .input_deg select {
        width: 300px;
        height: 50px;
        padding: 5px;
        font-size: 16px;
    }

    .input_deg input[type="number"] {
        width: 300px;
        height: 50px;
        padding: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

</style>
@endsection
@section('content')
<h1>Add Book</h1>
<div class="div_deg">
    <form id="bookForm">
        @csrf

        <div class="input_deg">
            <label>Book Title</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="input_deg">
            <label>Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div class="input_deg">
            <label>Price</label>
            <input type="text" id="price" name="price" required />
        </div>

        <div class="input_deg">
            <label>Quantity</label>
            <input type="number" id="qty" name="qty" required />
        </div>

        <div class="input_deg">
            <label>Publish Year</label>
            <input type="number" name="publish_year" id="publish_year" min="1999" max="2024" step="1" required>
        </div>

        <div class="input_deg">
            <label for="category-select">Book category</label>
            <select id="category-select" name="category_id" required></select>
        </div>

        <div class="input_deg">
            <label for="author-select">Author</label>
            <select id="author-select" name="author_id" required></select>
        </div>

        <div class="input_deg">
            <label for="image">Book Image</label>
            <input type="file" id="image" name="image">
        </div>

        <div class="input_deg">
            <input class="btn btn-success" type="submit" value="Add Book">
        </div>
    </form>
    <div id="responseMessage"></div>
</div>
@section('scripts')
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/categories'
            , method: 'GET'
            , success: function(response) {
                var categories = response.categories;
                var $select = $('#category-select');
                $select.empty();

                $.each(categories, function(index, category) {
                    $select.append($('<option>', {
                        value: category.id
                        , text: category.category_name
                    }));
                });

                if (categories.length > 0) {
                    $select.val(categories[0].id);
                }
            }
            , error: function(xhr, status, error) {
                $('#responseMessage').html('<p>Error loading categories - ' + xhr.status + ': ' + xhr.statusText + '</p>');
            }
        });

        $.ajax({
            url: '/api/authors'
            , method: 'GET'
            , success: function(response) {
                console.log(response); // Log the response to debug
                var authors = response.authors;
                var $select = $('#author-select');
                $select.empty();

                $.each(authors, function(index, author) {
                    $select.append($('<option>', {
                        value: author.id
                        , text: author.name
                    }));
                });

                if (authors.length > 0) {
                    $select.val(authors[0].id);
                }
            }
            , error: function(xhr, status, error) {
                $('#responseMessage').html('<p>Error loading authors - ' + xhr.status + ': ' + xhr.statusText + '</p>');
            }
        });

        $('#bookForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST'
                , url: '/api/book/add'
                , data: formData
                , processData: false
                , contentType: false
                , success: function(response) {
                    $('#responseMessage').html('<p>' + response.message + '</p>');
                    $('#bookForm')[0].reset();
                    window.location.href = "/view_book";
                }
                , error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    $('#responseMessage').html('<p>Error - ' + errorMessage + '</p>');
                }
            });
        });
    });

</script>


@endsection
@endsection
