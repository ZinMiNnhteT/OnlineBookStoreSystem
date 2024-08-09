<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('categories', [BookController::class, 'fetchCategories']);
Route::post('book/add', [BookController::class, 'store']);
Route::get('books', [BookController::class, 'index']);
Route::get('book/{id}/show', [BookController::class, 'show']);
Route::put('book/{id}/update', [BookController::class, 'update']);
Route::delete('book/{id}/delete', [BookController::class, 'destroy']);
Route::get('book/get_books_by_price/{price}', [BookController::class, 'get_books_by_price']);
Route::get('book/search', [BookController::class, 'search']);



Route::post('author/add', [AuthorController::class, 'store']);
Route::get('authors', [AuthorController::class, 'index']);
Route::get('author/{id}/show', [AuthorController::class, 'show']);
Route::put('author/{id}/update', [AuthorController::class, 'update']);
Route::delete('author/{id}/delete', [AuthorController::class, 'destroy']);
Route::get('author/get_authors_by_price/{price}', [AuthorController::class, 'get_authors_by_price']);

Route::post('category/add', [CategoryController::class, 'store']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('category/{id}/show', [CategoryController::class, 'show']);
Route::put('category/{id}/update', [CategoryController::class, 'update']);
Route::delete('category/{id}/delete', [CategoryController::class, 'destroy']);