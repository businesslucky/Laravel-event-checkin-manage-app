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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('home/getUserList', 'HomeController@getUserList');

Route::get('/upcomingEvents','EventController@index');
Route::post('/upcomingEvents/addEvent','EventController@onEventAdd');
Route::post('/upcomingEvents/editEvent','EventController@onEventEdit');
Route::post('/upcomingEvents/deleteEvent','EventController@onEventDelete');

Route::get('/upcomingEvents/invite/{id}','GuestsController@index');
Route::post('/upcomingEvents/invite/addInvite','GuestsController@onAddInvite');
Route::post('/upcomingEvents/invite/editInvite','GuestsController@onEditInvite');
Route::post('/upcomingEvents/invite/deleteInvite','GuestsController@onDeleteInvite');
Route::post('/upcomingEvents/invite/addPlusone','PlusoneController@onAddInvite');
Route::post('/upcomingEvents/invite/editPlusone','PlusoneController@onEditInvite');
Route::post('/upcomingEvents/invite/deletePlusone','PlusoneController@onDeleteInvite');
Route::get('/upcomingEvents/invite/exportExcel','GuestsController@onExportExcel');
Route::post('/upcomingEvents/invite/importExcel','GuestsController@onImportExcel');

Route::get('/userlist','UserController@guestIndex');
Route::post('/userlist/editUser','UserController@editUser');
Route::post('/userlist/deleteUser','UserController@deleteUser');
Route::post('/userlist/addUser','UserController@addUser');

Route::get('/upcomingEvents/plusone/{id}','PlusoneController@index');
Route::post('/upcomingEvents/plusone/addInvite','PlusoneController@onAddInvite');
Route::post('/upcomingEvents/plusone/editInvite','PlusoneController@onEditInvite');
Route::post('/upcomingEvents/plusone/deleteInvite','PlusoneController@onDeleteInvite');

Route::get('/doorworker','DoorWorkerController@index');
Route::post('/doorworker/getEvent','DoorWorkerController@getEvent');
Route::post('/doorworker/onCheck','DoorWorkerController@onCheck');

Route::get('/location','LocationController@index');
Route::post('/location/addLocation','LocationController@addLocation');
Route::post('/location/editLocation','LocationController@editLocation');
Route::post('/location/deleteLocation','LocationController@deleteLocation');

Route::get('/organization','OrganizationController@index');
Route::post('/organization/addOrganization','OrganizationController@addOrganization');
Route::post('/organization/editOrganization','OrganizationController@editOrganization');
Route::post('/organization/deleteOrganization','OrganizationController@deleteOrganization');

Route::get('/user','UserController@index');
Route::post('/user/editUser','UserController@editUser');

Route::get('/statistics','StatisticsController@index');