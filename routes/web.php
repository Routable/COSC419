<?php

use Illuminate\Support\Facades\DB;

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

/* TODO: Web Routes
*
* You'll need to create several routes in this file. First, you want to create a couple of GET routes for the 'about' and 'contact' URIs.
* These GET routes should use a closure function to return a view, or use the Route::view functionality. Each should return the relevant view
*
* You will also need to create a POST route for the 'create' URI - this is where requests to create a new chatroom go. It should call a function 'create' in your ChatController.
* Lastly, create a GET route for the 'chat/{room}' URI. This should call a function 'join' at your ChatController. This is called when someone loads the page for a given chatroom.
* The room parameter is an MD5 hash that identifies a specific chat room. This should be passed to your controller. 
*
*/

Route::get('/', function () {
    return view('main');
});