<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('Category','Author')->get();
        return response()->json(['books' => $books], 200);
    }

    public function show($id)
    {
        $books = Book::with('Category','Author')->findOrFail($id);
        if($books)
        {
            return response()->json(['books' => $books], 200);
        }
        else
        {
            return response()->json(['message' => 'Not Book Found']);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'qty' => 'required|integer',
                'publish_year' => 'required|integer|min:1999|max:2024',
                'category_id' => 'required|integer',
                'author_id' => 'required|integer',
                'image' => 'nullable|image',
        ]);
            $book = new Book;
            $book->title = $request->title;
            $book->description = $request->description;
            $book->author_id = $request->author_id;
            $book->publish_year = $request->publish_year;
            $book->category_id = $request->category_id;
            $book->price = $request->price;
            $book->quantity = $request->qty;

            $image = $request->image;
            if($image)
            {
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('books', $imagename);

                $book->image = $imagename;
            }

            $book->save();

        return response()->json(['message' => 'Book Added Successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'qty' => 'required|integer',
                'publish_year' => 'required|integer|min:1999|max:2024',
                'category_id' => 'required|integer',
                'author_id' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $book = Book::with('Category','Author')->findOrFail($id);
        if($book)
        {
            $book->title = $request->title;
            $book->description = $request->description;
            $book->author_id = $request->author_id;
            $book->publish_year = $request->publish_year;
            $book->category_id = $request->category_id;
            $book->price = $request->price;
            $book->quantity = $request->qty;

            if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('books'), $imagename);
            $book->image = $imagename;
            }
            $book->save();
        return response()->json(['message'=>'Book Updated Successfully'], 200);
        }
        else{
            return response()->json(['message' => 'Not Book Found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $image_path = public_path('books/'.$book->image);

            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $book->delete();
            return response()->json(['message' => 'Book Deleted Successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Book Not Found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the Book'], 500);
        }
    }

    public function get_books_by_price($price)
    {
        $books = Book::where('price', $price)->get();
        if($books)
        {
            return response()->json(['products' => $books], 200);
        }
        else
        {
            return response()->json(['message' => 'Price Not Found.'], 404);
        }
    }

    public function search(Request $request)
    {
        $query = Book::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        if ($request->has('publish_year')) {
            $query->where('publish_year', $request->input('publish_year'));
        }

        $books = $query->get();

        return response()->json($books);
    }
}