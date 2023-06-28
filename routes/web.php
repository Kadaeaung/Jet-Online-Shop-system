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


Route::get('/','FrontendController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('brand/{id}','FrontendController@brand')->name('brand');
Route::get('promotion','FrontendController@promotion')->name('promotion');
Route::get('cart','FrontendController@cart')->name('cart');
Route::get('detail/{id}','FrontendController@show')->name('detail');
Route::get('subcategory/{id}','FrontendController@subcategory')->name('subcategory');
Route::post('order','FrontendController@order')->name('order');
Route::get('ordersuccess','FrontendController@ordersuccess')->name('ordersuccess');
Route::post('search','FrontendController@search')->name('search');
Route::get('searchitem',function(){
	return view('frontend.search');
})->name('searchitem');

//Basic Routing
	//GET Method

	Route::get('hello','TestOneController@index');


	//POST Method
	Route::post('hello','TestOneController@index');

	  //For All Method(
	//get,post,put,patch,delete,options)

	Route::resource('test','TestTwoController');
	//Route Parameters
	Route::get('user/{id}','TestThreeController@show');

	//Multiple Route Parametrs
	Route::get('hellouser/{nmae}/{positin}/{city}','TestOneController@user');


	//Backend

	Route::group(['middleware' => 'role:admin', 'prefix' => 'backside' , 'as' => 'backside.'], function(){


	Route::resource('/category','CategoryController');
	Route::resource('/subcategory','SubCategoryController');

	Route::resource('/brand','BrandController');
	Route::resource('/item','ItemController');
	Route::resource('/township','TownshipController');
	Route::resource('/orderl','OrderController');

		});

