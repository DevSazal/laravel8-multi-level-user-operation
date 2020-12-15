<?php

use Illuminate\Support\Facades\Route;

// Add User Directory
use App\Http\Controllers\User;
use App\Http\Controllers\Staff;

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
Route::get('/disable',[User\AuthController::class, 'disable'])->name('disable');

Route::get('/',[User\PostController::class, 'index']);
Route::post('/',[User\PostController::class, 'storePost'])->name('storePost');
Route::delete('/post/{id}/delete',[User\PostController::class, 'delete'])->name('post.delete'); // For Admin & Staff Only
Route::get('/post/{id}',[User\PostController::class, 'show'])->name('post.show');
Route::post('/post/{id}/comment',[User\PostController::class, 'makeComment'])->name('make.comment');

// For Staff Only
Route::get('/staff',[Staff\PostManageController::class, 'index']);
Route::put('/staff/post/{id}/publish/',[Staff\PostManageController::class, 'publish'])->name('post.publish.staff');
Route::delete('/staff/post/{id}/delete/',[Staff\PostManageController::class, 'delete'])->name('post.delete.staff');
Route::get('/staff/users/{key?}',[Staff\UserManageController::class, 'index'])->name('users');

Route::get('/staff/login',[Staff\AuthController::class, 'loginPage']);
Route::post('/staff/login',[Staff\AuthController::class, 'loginUser'])->name('login.staff');
Route::get('/staff/logout',[Staff\AuthController::class, 'logout'])->name('logout.staff');
