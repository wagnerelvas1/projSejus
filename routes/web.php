<?php

USE App\Http\Controllers\sitecontroler;
use Illuminate\Support\Facades\Route;

Route::get('/', [sitecontroler::class, 'home'])->name('homePage');
Route::get('/about', [sitecontroler::class, 'about'])->name('aboutUs');
Route::get('/games', [sitecontroler::class, 'games'])->name('gamesPage');
Route::get('/login', [sitecontroler::class, 'login'])->name('login');
Route::get('/register', [sitecontroler::class, 'register'])->name('register');
Route::get('/myprofile', [sitecontroler::class, 'myprofile'])->name('myProfile');
Route::get('/navbar', [sitecontroler::class, 'navbar'])->name('navbar');
Route::get('/loginPage', [sitecontroler::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [sitecontroler::class, 'registerPage'])->name('registerPage');
