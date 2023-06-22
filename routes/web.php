<?php use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WallController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\LangController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});


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

//šeit glabā blog entry
Route::post('/wall', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');


Route::post('users/{id}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
Route::put('/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');

Route::delete('/blogs/{id}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');


Route::get('/switch-language/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLanguage'])
    ->name('switch-language');

  
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');