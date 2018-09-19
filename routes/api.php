<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* TODO: API Routes
*
* You need to add two routes to this file. The first route should be a POST route for the URI 'send', and should call a function called 'send' in your ChatController
* The second route should be a GET route that goes to a function called 'getMessages' in your ChatController. The get route should have the URI of 'msgs/{room}/{id}'
* Room and ID are parameters you are passing to your controller
*
*/