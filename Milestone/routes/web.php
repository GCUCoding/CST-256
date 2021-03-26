<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () 
{
    return view('home');
});

Route::get('/home', function ()
{
    return view('home');
});

Route::get('/register', function () 
{
    return view('registration');
});

Route::post('/registered', 'RegisterController@index');

Route::get('/login', function()
{
   return view('login'); 
});

Route::post('/logged', 'LoginController@index');

Route::get('/viewUsers', 'LoginController@viewUsers');

Route::get('/profile', 'LoginController@userAccess');

Route::post('/editProfilePage', 'LoginController@profile');

Route::post('/editUser', 'AdminController@editUser');

Route::get('/editUser', function()
{
    return view();
});

Route::post('/editedUser', 'AdminController@confirmEditUser');

Route::get('/editedUser', function()
{
    return view('security');
});

Route::post('/deleteUser', 'AdminController@deleteUser');

Route::post('/editedUserInfo', 'CustomerController@editUserInfo');

Route::post('/editUserProfile', 'AdminController@editUserProfile');

Route::post('/editedUserProfile', 'AdminController@editedUserProfile');

Route::get('/logout', 'LoginController@Logout');

Route::post('/education', 'EducationController@index');

Route::post('/editEducation', 'EducationController@edit');

Route::post('/addEducation', 'EducationController@addEducation');

Route::post('/newEducation', 'EducationController@newEducation');

Route::post('/deleteEducation', 'EducationController@deleteEducation');

Route::get('/jobs', 'JobListingController@index');

Route::post('/addJob', 'JobListingController@addJobPage');

Route::post('/newJob', 'JobListingController@createNewJob');

Route::post('/viewJob', 'JobListingController@viewJobDetails');

Route::post('/editJob', 'JobListingController@editJobListing');

Route::post('/editJobPage', 'JobListingController@viewEditPage');

Route::post('/searchJob', 'JobListingController@jobListingSearch');

Route::post('/applyToJob', 'JobListingController@applyToJob');

Route::post('/applyToJobSubmit', 'JobListingController@index');

Route::post('/jobHistory', 'JobHistoryController@index');

Route::post('/addJobHistory', 'JobHistoryController@addJobHistory');

Route::post('newJobHistory', 'JobHistoryController@createJobHistory');

Route::post('/editJobHistoryPage', 'JobHistoryController@jobHistoryEditPage');

Route::post('/viewJobHistory', 'JobHistoryController@viewJobHistoryDetails');

Route::post('/editJobHistory', 'JobHistoryController@editJobHistory');

Route::post('/deleteJobHistory', 'JobHistoryController@deleteJobHistory');

Route::get('/groups', 'GroupController@index');

Route::post('/addGroup', 'GroupController@addGroup');

Route::post('/newGroup', 'GroupController@newGroup');

Route::post('/editGroup', 'GroupController@editGroup');

Route::post('/viewGroup', 'GroupController@viewGroup');

Route::post('/joinGroup', 'GroupController@joinGroup');

Route::post('/leaveGroup', 'GroupController@leaveGroup');

Route::post('/deleteGroup', 'GroupController@deleteGroup');

Route::post('/toEditGroup', 'GroupController@toEditGroup');

Route::resource('/usersrest', 'UsersRestController');

Route::resource('/jobsrest', 'JobsRestController');

Route::get('/apis', function ()
{
    return view('Admin/api');
});

?>