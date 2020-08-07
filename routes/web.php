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

define('PAGINATION_COUNT' , 5);

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes([ 'verify' => true]);
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
            Route::get('get_all_inactive_offers', 'CrudController@getAllInactiveOffers') ;

        });

        Route::get('youtube', 'CrudController@getVideo')->middleware('auth:web') ;

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

Route::get('admin/login','Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');



##################################### End Authentication && Guards #####################################

##################################### Begin relations Routes #####################################

Route::get('has_one','Relation\RelationsController@hasOneRelation');

Route::get('has_one_reverse','Relation\RelationsController@hasOneRelationReverse');

Route::get('get_user_has_phone','Relation\RelationsController@getUserHasPhone');

Route::get('get_user_not_has_phone','Relation\RelationsController@getUserNotHasPhone');

Route::get('get_user_has_phone_with_condition','Relation\RelationsController@getUserWhereHasPhoneWithCondition');

################################### Begin One To Many Relationship #####################
// get data Routes
Route::get('hospital_has_many_doctors','Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals','Relation\RelationsController@hospitals') -> name('hospital.all');

Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')-> name('hospitals.doctors');

Route::get('hospitals_has_doctors','Relation\RelationsController@hospitalsHasDoctors');
Route::get('hospitals_has_doctors_male','Relation\RelationsController@hospitalsHaveOnlyMaleDoctors');
Route::get('hospitals_not_has_doctors_male','Relation\RelationsController@hospitalsDontHaveDoctors');

// delete data Route
Route::get('hospitals/{hospital_id}','Relation\RelationsController@deleteHospital') -> name('hospital.delete');


################################### End One To Many Relationship #######################

################################### Begin Many To Many Relationship #####################

Route::get('doctors_services','Relation\RelationsController@getDoctorServices') -> name('doctor.service');

Route::get('service_doctors','Relation\RelationsController@getServiceDoctors') -> name('doctor.service');

Route::get('doctors/services/{doctor_id}','Relation\RelationsController@getDoctorServicesById') -> name('doctors.services');
Route::post('saveServices-to-doctor','Relation\RelationsController@saveServicesToDoctors')-> name('save.doctors.services');

################################### End Many To Many Relationship #######################

Route::get('has_0ne_through','Relation\RelationsController@getPatientDoctors');
Route::get('has_one_through_country_hospital','Relation\RelationsController@getCountryHospitals');

Route::get('has_many_through','Relation\RelationsController@getCountryDoctor');

##################################### End relations Routes #####################################
