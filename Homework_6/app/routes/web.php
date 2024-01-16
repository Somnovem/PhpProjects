<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::get('/about', function () {
    return view('pages.about');
})->name('page.about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('page.contact');

Route::post('/contact',function(\App\Http\Requests\ContactRequest $request){
    if ($request->validated()) {
        $user = $request->all();
        dd($user);
    }
    return view('pages.contact');
})->name('form.contact');
