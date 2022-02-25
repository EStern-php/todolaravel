<?php

use Illuminate\Support\Facades\Route;

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

    $userlists = DB::select('select * from todolists where userid = :user AND deleted = 0', ["user" => \Auth::id()]);
  //  die(var_dump($userlists));
    return view('dashboard', ['userslists' => $userlists]);
})->middleware(['auth'])->name('dashboard');

Route::post('addlist', function(){
    $name = $_POST['listname'];
    DB::insert('insert into todolists (userid, name) values(:user, :name)', ["user" => \Auth::id() , "name" => $name]);
});

Route::post('deletelist', function(){
    $id = $_POST['list-id'];
    DB::update('update todolists set deleted = 1 where userid = :user AND id = :id', ["user" => \Auth::id() , "id" => $id]);
});

require __DIR__.'/auth.php';
