<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$startTime = time();

Route::filter('requestEnd', function($route, $request, $response, $startTime) {
	$requestTiming = new RequestTiming(Input::all());
	$requestTiming->method = $request->server('REQUEST_METHOD');
	$requestTiming->path = $request->path();
	$requestTiming->parameters = json_encode(Input::all());
	$requestTiming->start_time = date("Y-m-d H:m:s", $startTime);
	$requestTiming->end_time = date("Y-m-d H:m:s");
	$requestTiming->save();
});

Route::group(['prefix' => 'api', 'after' => 'requestEnd:' . $startTime], function() {
	// Get some sample JSON
	Route::get('/', function() {

		return Response::json("Hello World!");
	});

	// Get an array of all Users
	Route::get('/user', function() {
		$users = User::all();

		return Response::json($users);
	});

	// Get a specific User
	Route::get('/user/{id}', function($id) {
		$user = User::findOrFail($id);

		return Response::json($user);
	});

	// Create a new User
	Route::post('/user', function() {
		$user = User::create(Input::all());

		if ( $avatar = Input::hasFile('avatar') ) {
			$avatar->move(storage_path(), "avatar_" . $user->id . "." . $avatar->getClientOriginalExtension());
		}

		return Response::json($user);
	});

	// Update a User
	Route::post('/user/{id}', function($id) {
		$user = User::findOrFail($id);
		$user->update(Input::all());

		return Response::json($user);
	});
});