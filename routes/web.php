<?php

use Illuminate\Support\Facades\Route;

// Add User Directory
use App\Http\Controllers\User;

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

// Route::get('/', function () {
//     return view('user.index');
// })->middleware('user');

Route::get('/register',[User\AuthController::class, 'registerPage']);
Route::post('/register',[User\AuthController::class, 'registerUser'])->name('register');

Route::get('/login',[User\AuthController::class, 'loginPage']);
Route::post('/login',[User\AuthController::class, 'loginUser'])->name('login');

Route::get('/logout',[User\AuthController::class, 'logout'])->name('logout');

Route::get('/',[User\PostController::class, 'index']);
Route::post('/',[User\PostController::class, 'storePost'])->name('storePost');
Route::delete('/post/{id}/delete',[User\PostController::class, 'delete'])->name('post.delete');
