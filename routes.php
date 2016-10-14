<?php

use Illuminate\Support\Facades\Input;
use App\ProbaModel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'ProbaController@loginUser');
Route::get('/userZone_{id}', 'ProbaController@getListTasks');
Route::post('/userZone_{id}', 'ProbaController@newListTasks');
Route::get('/del_{id}', 'ProbaController@deleteList');
Route::get('/userZone_{id}/listTasks_{id1}', 'ProbaController@tasks');
Route::post('/userZone_{id}/listTasks_{id1}', 'ProbaController@newTasks');
Route::get('arhiv/listTasks_{id1}', 'ProbaController@arhiv');
Route::get('/userZone_{id}/listTasks_{id1}/id_task_{id2}', 'ProbaController@deleteZadacha');
Route::any('/adminZone_{id}',  function () {
    $obekt=new ProbaModel();
    $f=$obekt->vsickiSpisyci();
    $d=$obekt->zaqvkaDeleteList();
    return view('admin',['x'=>$f, 'z'=>$d]);
});
