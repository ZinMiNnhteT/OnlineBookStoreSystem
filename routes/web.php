<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
//home page
Route::get('/', [HomeController::class, 'home']);
Route::get('search', [HomeController::class, 'search']);
//login home
Route::get('/dashboard', [HomeController::class, 'login_home'])
    ->middleware(['auth', 'verified'])->name('dashboard');
Route::get('auth_search', [HomeController::class, 'auth_search'])
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//admin dashboard
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);

//admin Book
Route::get('view_book', [AdminController::class, 'view_book'])->middleware(['auth','admin']);
Route::get('add_book', [AdminController::class, 'add_book'])->middleware(['auth','admin']);
Route::post('store_book', [AdminController::class, 'store_book'])->middleware(['auth','admin']);
Route::delete('delete_book/{id}', [AdminController::class, 'delete_book'])->middleware(['auth','admin']);
Route::get('update_book/{id}', [AdminController::class, 'update_book'])->middleware(['auth','admin']);
Route::put('edit_book/{id}', [AdminController::class, 'edit_book'])->middleware(['auth','admin']);
Route::get('book_search', [AdminController::class, 'book_search'])->middleware(['auth','admin']);

//admin Author
Route::get('view_author', [AdminController::class, 'view_author'])->middleware(['auth','admin']);
Route::get('add_author', [AdminController::class, 'add_author'])->middleware(['auth','admin']);
Route::post('store_author', [AdminController::class, 'store_author'])->middleware(['auth','admin']);
Route::delete('delete_author/{id}', [AdminController::class, 'delete_author'])->middleware(['auth','admin']);
Route::put('edit_author/{id}', [AdminController::class, 'edit_author'])->middleware(['auth','admin']);
Route::get('update_author/{id}', [AdminController::class, 'update_author'])->middleware(['auth','admin']);
Route::get('author_search', [AdminController::class, 'author_search'])->middleware(['auth','admin']);

//admin Category
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth','admin']);
Route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth','admin']);
Route::delete('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth','admin']);
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth','admin']);
Route::put('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth','admin']);

//user dashboard
Route::get('book_details/{id}', [HomeController::class, 'book_details']);

//user logged dashboard & cart
Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])
->middleware(['auth', 'verified']);
Route::get('mycart', [HomeController::class, 'mycart'])
->middleware(['auth', 'verified']);
Route::delete('delete_cart/{id}', [HomeController::class, 'delete_cart'])
->middleware(['auth', 'verified']);
Route::post('comfirm_order', [HomeController::class, 'comfirm_order'])
->middleware(['auth', 'verified']);
//payment
Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

//my order
Route::get('myorders', [HomeController::class, 'myorders'])
->middleware(['auth', 'verified']);

//admin order
Route::get('view_orders', [AdminController::class, 'view_order'])
->middleware(['auth','admin']);
//on the way
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])
->middleware(['auth','admin']);

//delivered
Route::get('delivered/{id}', [AdminController::class, 'delivered'])
->middleware(['auth','admin']);

//Print PDF
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])
->middleware(['auth','admin']);

//Send Email
Route::get('send_email/{id}', [AdminController::class, 'send_email'])
->middleware(['auth','admin']);

Route::post('send_to_email/{id}', [AdminController::class, 'send_to_email'])
->middleware(['auth','admin']);

//shop
Route::get('shop', [HomeController::class, 'shop']);
Route::get('why', [HomeController::class, 'why']);
Route::get('testimonial', [HomeController::class, 'testimonial']);
Route::get('contact', [HomeController::class, 'contact']);