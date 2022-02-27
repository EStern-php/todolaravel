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
    foreach($userlists as &$list){
        $list->tasks = DB::select('select * from tasks where todolist_id = :todo_id AND deleted = 0', ["todo_id" => $list->id]);
    }


    return view('dashboard', ['userslists' => $userlists]);
})->middleware(['auth'])->name('dashboard');

Route::post('addlist', function(){
    $name = $_POST['listname'];
    DB::insert('insert into todolists (userid, name) values(:user, :name)', ["user" => \Auth::id() , "name" => $name]);
});

Route::post('deletelist', function(){
    $id = $_POST['delete-list-id'];
    DB::update('update todolists set deleted = 1 where userid = :user AND id = :id', ["user" => \Auth::id() , "id" => $id]);
});

Route::post('editlist', function(){
    
    $id = $_POST['list-id'];
    $task = $_POST['task'];

    DB::insert('insert into tasks (todolist_id, task_desc) values(:todolist_id, :task)', ["todolist_id" => $id , "task" => $task]);

});

Route::post('removeTask', function(){
    $id = $_POST['id'];
    DB::update('update tasks set deleted = 1 where id = :id', ["id" => $id]);
});

Route::post('completeTask', function(){
    $id = $_POST['id'];
    $completed = $_POST['completed'];
    DB::update('update tasks set completed = :completed where id = :id', ["completed" => $completed, "id" => $id]);
});

require __DIR__.'/auth.php';
