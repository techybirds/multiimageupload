<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => []], function () {
    Route::post('save-form-details', ['as'=>'save.form.details', 'uses' => 'API\FormController@saveFormDetails']);
    Route::post('save-images', ['as'=>'save.images', 'uses' => 'API\FormController@saveImages']);

    Route::get('get-forms', ['as'=>'get.forms', 'uses' => 'API\FormController@getForms']);
    Route::get('get-images/{form_id}', ['as'=>'get.forms', 'uses' => 'API\FormController@getImages']);
});
