<?php use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WallController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/vote', [PostController::class, 'index'])->name('vote');


Route::get('/wall', [WallController::class, 'index'])->name('wall');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/register', 'App\Http\Controllers\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register.submit');
Auth::routes();

Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

//jaunie:
Route::post('/posts/{postId}/vote', [App\Http\Controllers\VoteController::class, 'submitVote'])->name('posts.vote');

