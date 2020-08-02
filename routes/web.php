<?php

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

Auth::routes();
//Auth::routes([ 'verify' => true]);
Route::get('/dashboard', function (){
    return 'Not adult';
}) -> name('not.adult');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect/{service}','SocialController@redirect');
Route::get('/callback/{service}','SocialController@callback');

Route::get('fillable', 'CrudController@getOffer');

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function() {


        Route::group(['prefix' => 'offers'], function (){
//          Route::get('store', 'CrudController@store');
            Route::get('create', 'CrudController@create');
            Route::post('store', 'CrudController@store') -> name('offer.store');

            Route::get('edit/{offer_id}', 'CrudController@editOffer');
            Route::post('update/{offer_id}', 'CrudController@updateOffer') -> name('offers.update');
            Route::get('delete/{offer_id}', 'CrudController@deleteOffer') -> name('offers.delete');
            Route::get('all', 'CrudController@getAllOffers') -> name('offers.all');

        });

        Route::get('youtube', 'CrudController@getVideo');

});

##################################### Begin Ajax Route #####################################
Route::group(['prefix' => 'ajax_offers'], function (){
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store') -> name('ajax.offers.store');
    Route::get('all', 'OfferController@all') ->name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete') ->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit') -> name('ajax.offers.edit');
    Route::post('update', 'OfferController@update') -> name('ajax.offers.update');

});
##################################### End Ajax Route #####################################


##################################### Begin Authentication && Guards ###################################
Route::group([ 'middleware' => 'CheckAge', 'namespace' => 'Auth'], function (){
    Route::get('adults','CustomAuthController@adult') -> name('adult');
});


Route::get('site','Auth\CustomAuthController@site') ->middleware('auth:web') -> name('site');
Route::get('admin','Auth\CustomAuthController@admin') ->middleware('auth:admin')-> name('admin');


##################################### End Authentication && Guards #####################################

