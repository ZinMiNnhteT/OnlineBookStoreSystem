<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
        public function view_category() {
            $categories = Category::all();
            return view('admin.category', compact('categories'));
        }

        public function add_category(Request $request) {
            $category = new Category;
            $category->category_name = $request->category;
            $category->save();

            toastr()->closeButton()->timeOut(5000)->addSuccess('Category Added Successfully!');
            return redirect()->back();
        }

        public function delete_category($id) {
            $category = Category::findOrFail($id);
            $category->delete();

            toastr()->closeButton()->timeOut(5000)->addSuccess('Category Deleted Successfully!');
            return redirect()->back();
        }

        public function edit_category($id) {
            $category = Category::find($id);
            return view('admin.edit_category', compact('category'));
        }

        public function update_category(Request $request,$id){
            $category = Category::find($id);
            $category->category_name = $request->category;
            $category->save();

            toastr()->closeButton()->timeOut(5000)->addSuccess('Category Updated Successfully!');
            return redirect('/view_category');
        }

        public function add_product() {

            $categories = Category::all();

            return view('admin.add_product', compact('categories'));
        }

        public function view_order()
        {
            $orders = Order::all();
            return view('admin.order',compact('orders'));
        }

        public function on_the_way($id) {
            $order = Order::find($id);
            $order->status = 'on the way';
            $order->save();

            return redirect('/view_orders');
        }

        public function delivered($id) {
            $order = Order::find($id);
            $order->status = 'delivered';
            $order->save();

            return redirect('/view_orders');
        }

        public function print_pdf($id){
            $order = Order::find($id);
            $pdf = Pdf::loadView('admin.invoice', compact('order'));
            return $pdf->download('invoice.pdf');

        }

        public function send_email($id){
            $order = Order::find($id);
            return view('admin.email_info',compact('order'));
        }

        public function send_to_email(Request $request,$id){
            $order = Order::find($id);
            $details = [
                'greeting' =>$request->greeting,
                'firstline' =>$request->firstline,
                'body' =>$request->body,
                'button' =>$request->button,
                'url' =>$request->url,
                'lastline' =>$request->lastline,
            ];
            Notification::send($order, new SendEmailNotification($details));
            return redirect()->back();
        }




        //Author Controller Method
        public function view_author() {
            $authors = Author::paginate(3);
            return view('author.view_author',compact('authors'));
        }

        public function add_author() {
            return view('author.add_author');
        }

        public function store_author(Request $request)
            {
                $request->validate([
                'name' => 'required|string|max:255',
                'biography' => 'required|string',
                'email' => 'required|email|unique:authors,email|max:255',
            ]);
                $author = new Author;
                $author->name = $request->name;
                $author->biography = $request->biography;
                $author->email = $request->email;
                $author->save();

                toastr()->closeButton()->timeOut(10000)->addSuccess('Author Updated Successfully!');
                return redirect()->back();
            }

        public function update_author($id)
            {
                $author = Author::find($id);
                return view('author.update_author', compact('author'));
            }

        public function edit_author(Request $request, $id) {

                $request->validate([
                'name' => 'required|string|max:255',
                'biography' => 'required|string',
                'email' => 'nullable|email|max:255',
            ]);
                $author = Author::findOrFail($id);
                $author->name = $request->name;
                $author->biography = $request->biography;
                $author->email = $request->email;
                $author->save();
                toastr()->closeButton()->timeOut(10000)->addSuccess('Product Updated Successfully!');
                return redirect('/view_author');
            }

        public function author_search(Request $request)
            {
                $search = $request->input('search');

                if (empty($search)) {
                    return redirect()->back()->with('error', 'Search term cannot be empty');
                }
                $authors = Author::where('name', 'LIKE', '%' . $search . '%')->paginate(3);
                    return view('author.view_author', compact('authors'));
            }

        public function delete_author($id) {
                $author= Author::find($id);
                $author->delete();
                toastr()->closeButton()->timeOut(5000)->addSuccess('Author Deleted Successfully!');
                return redirect()->back();
            }
            // end Author Controller method

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function view_book() {
                $books = Book::paginate(3);
                return view('book.view_book', compact('books'));
            }

        public function add_book() {
            $categories = Category::all();
            $authors = Author::all();
            return view('book.add_book',compact('categories','authors'));
        }

        public function store_book(Request $request)
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

            toastr()->closeButton()->timeOut(10000)->addSuccess('Category Added Successfully!');

            return redirect()->back();
        }

        public function update_book($id){
                $book = Book::find($id);
                $categories = Category::all();
                $authors = Author::all();
                return view('book.update_book', compact('book','categories', 'authors'));
            }

        public  function edit_book(Request $request, $id){
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

            $book = Book::findOrFail($id);
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
            $book->update();

            toastr()->closeButton()->timeOut(10000)->addSuccess('Book Added Successfully!');

            return redirect()->back();
        }

        public function book_search(Request $request)
            {
                $search = $request->input('search');

                if (empty($search)) {
                    return redirect()->back()->with('error', 'Search term cannot be empty');
                }
                $books = Book::where('title', 'LIKE', '%' . $search . '%')
                ->orwhere('publish_year', 'LIKE', '%'. $search. '%')
                ->orWhereHas('Author', function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->paginate(3);
                    return view('book.view_book', compact('books'));
            }

        public function delete_book($id) {
                $book= Book::find($id);
                $book->delete();
                toastr()->closeButton()->timeOut(5000)->addSuccess('Book Deleted Successfully!');
                return redirect()->back();
            }

}
// /////////////////////////////////////////////////////////////////////////////////////////////////////////