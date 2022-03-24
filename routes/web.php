<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/profile', function(){
//     return view('profile');
// })->name('profile');

Route::get('/addpost', function(){
    return view('addpost');
})->name('addpost');

//Route::get('add-blog-post-form', [PostController::class, 'index'])->addpost;
//Route::put('/profile/update', [PostController::class, 'update'])->name('update');
Route::delete('/profile/{id}', [PostController::class, 'destroy'])->name('destroy');
Route::get('/profile', [PostController::class, 'profile_show'])->name('profile');
Route::post('/store', [PostController::class, 'store'])->name('storepost');
Route::post('/edit/{id}', [PostController::class, 'editpost'])->name('editpost');
Route::get('/profile/edit/{id}', [PostController::class, 'edit'])->name('edit');
Route::get('/postdetail/{id}', [PostController::class, 'postdetail'])->name('postdetail');
Route::get('/search', [PostController::class, 'search'])->name('search');





