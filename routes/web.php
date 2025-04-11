<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Route;



Auth::routes();


Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store'])->name('follow.store');

Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/post/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::post('/post', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/post/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('post.show');

Route::get('profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
