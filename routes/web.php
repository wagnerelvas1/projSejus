<?php

use App\Http\Controllers\sitecontroler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogosControler;

Route::get('/games', [JogosControler::class, 'index']);
Route::get('/', [sitecontroler::class, 'home'])->name('homePage');
Route::get('/about', [sitecontroler::class, 'about'])->name('aboutUs');
Route::get('/games', [sitecontroler::class, 'games'])->name('gamesPage');
Route::get('/games/{$id}', [sitecontroler::class, 'show']);

// Login controler
Route::get('/login', [sitecontroler::class, 'login'])->name('login');
Route::post('/login', [sitecontroler::class, 'authenticate'])->name('authenticate');

Route::get('/myprofile', [sitecontroler::class, 'myprofile'])->name('myProfile');
Route::get('/navbar', [sitecontroler::class, 'navbar'])->name('navbar');
// Pagina de Registro + Store de dados
Route::get('/registerPage', [sitecontroler::class, 'registerPage'])->name('registerPage');
Route::post('/registerPage', [sitecontroler::class, 'store']);

