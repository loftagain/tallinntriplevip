<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register.submit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/vote', [App\Http\Controllers\PostController::class, 'vote'])->name('vote');
Route::post('/vote/{id}', [App\Http\Controllers\PostController::class, 'storeVote'])->name('vote.store');
