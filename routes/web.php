<?php

use App\Http\Controllers\User\ctrl_user;
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

Route::post('/login', [ctrl_user::class, 'login']);
Route::post('/register',[ctrl_user::class, 'register']);
// Route::group(['middleware'=>['auth:sanctum']],function(){
   
//     Route::post('/logout',[ctrl_user::class, 'logout']);
// });

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/welcome', function () {
    return view('welcome');
}); 



Route::post('/reregister', function () {
    return view('signup');
}); 

Route::get('/', function () {
    return view('login');
    // return view('quiz');
});

Route::get('/quiz', function () {
    return view('quiz');
});
