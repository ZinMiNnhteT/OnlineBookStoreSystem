<?php
namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype','user')->get()->count();
        $order = Order::all()->count();
        $book = Book::all()->count();
        $author = Author::all()->count();
        $delivered = Order::where('status','delivered')->get()->count();
        return view('admin.index',compact(['user','order','delivered','book','author']));
    }

    public function home()
    {
        $books = Book::paginate(8);
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.index', compact('books','count'));
    }

    public function login_home(){
        $books = Book::paginate(8);
        $user = Auth::user();
        $userid = $user->id;

        $count = Cart::where('user_id', $userid)->count();
        return view('home.index',compact('books','count'));
    }

    public function book_details($id) {
        $book = Book::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.book_details',compact('book','count'));
    }


    public function search(Request $request)
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
            return view('home.shop', compact('books'));
    }

    public function auth_search(Request $request)
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
            return view('home.shop', compact('books'));
    }


    public function add_cart($id) {
        $book_id = $id;

        $user = Auth::user();

        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;
        $data->book_id = $book_id;

        $data->save();
        toastr()->closeButton()->timeOut(10000)->addSuccess('Cart Added Successfully!');
        return redirect()->back();
    }


    public function mycart(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
            $carts = Cart::where('user_id',$userid)->get();

        }
        return view('home.mycart',compact('count','carts'));
    }

    public function delete_cart($id) {
        $cart = Cart::find($id);
        $cart->delete();

        toastr()->closeButton()->timeOut(10000)->addSuccess('Cart Removed Successfully!');
        return redirect()->back();
    }

    public function comfirm_order(Request $request) {
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $phone = $request->phone;

        $userid = Auth::user()->id;
        $carts = Cart::where('user_id', $userid)->get();

        foreach($carts as $cart) {
            $order = new Order;
            $order->book_id = $cart->book_id;
            $order->name = $name;
            $order->email = $email;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;

            $order->save();

        }
        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->closeButton()->timeOut(10000)->addSuccess('Books Order Successfully!');
        return redirect()->back();
    }

    public function myorders(){
        $user = Auth::user()->id;
        $count = Cart::where('user_id',$user)->get()->count();
        $orders = Order::where('user_id',$user)->get();
        return view('home.order', compact('count','orders'));
    }

    public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }

    public function stripePost(Request $request,$value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $value = intval($value);
        if ($value < 1) {
        return back()->withErrors(['value' => 'The payment amount must be at least 1.']);
        }
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;

        $userid = Auth::user()->id;
        $carts = Cart::where('user_id', $userid)->get();

        foreach($carts as $cart) {
            $order = new Order;
            $order->book_id = $cart->book_id;
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            $order->payment_status = "paid";
            $order->save();

        }
        $cart_remove = Cart::where('user_id', $userid)->get();

        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->closeButton()->timeOut(10000)->addSuccess('Product Order Successfully!');
        return redirect('mycart');
    }

    public function shop()
    {
        $books = Book::paginate(8);
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.shop', compact('books','count'));
    }

    public function why()
    {
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.why', compact('count'));
    }

    public function testimonial()
    {
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.testimonial', compact('count'));
    }

    public function contact()
    {
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else{
            $count = '';
        }
        return view('home.contactus', compact('count'));
    }
}