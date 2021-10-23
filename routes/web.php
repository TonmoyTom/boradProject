<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'FrontendController@index')->name('welcome');
Route::get('/backgrounds/{slug}', 'FrontendController@subject')->name('backgrounds.frontend');
Route::get('/subjects/{subjectslug}', 'FrontendController@board')->name('subject.frontend');
Route::get('/boards/{slug}', 'FrontendController@answer')->name('boards.frontend');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
    Route::get('/home', 'AdminController@index')->name('admin.home');
    //Admin Profile...
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::get('/profile/change', 'AdminController@profilechange')->name('admin.profile.change');

    //Ajax Start
    Route::Post('/update-password', 'AdminController@oldPassword');
    //ajax End

    Route::post('/update-profile-change-store', 'AdminController@upadteprofilestore')->name('admin.update.profile.store');

    Route::get('/password/change', 'AdminController@passwordchange')->name('admin.password.change');
    Route::post('/password/change/store', 'AdminController@updatepassword')->name('admin.password.change.store');

    //All Admin ...

    Route::get('/allusers', 'AdminController@allusers')->name('users.all');
    Route::get('/create/users', 'AdminController@usercreate')->name('users.create');
    Route::Post('/create/users', 'AdminController@store')->name('users.store');;

    //Admin Edit System ...
    Route::get('/users/view/{id}', 'AdminController@view')->name(' users.view ');
    Route::get('/users/edit/{id}', 'AdminController@edit')->name(' users.edit ');
    Route::get('/users/message/{id}', 'AdminController@message')->name(' users.message ');
    Route::post('/users/message/', 'AdminController@messageupdate')->name(' users.messageUpdate');
    Route::Post('/users/edit/{id}', 'AdminController@update')->name(' users.update ');
    Route::post('/users/delete/{id}', 'AdminController@delete')->name('users.delete ');
    // Route::delete('/users/multiple/delete/{id}', 'AdminController@multipledelete')->name('users.multiple.delete ');

    //Role System

    Route::get('/allroles', 'RoleController@index')->name('role.all');
    Route::get('/create/roles', 'RoleController@create')->name('role.create');
    Route::post('/create/roles', 'RoleController@store')->name('role.store');

    //Role Edit System

    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('role.edit ');
    Route::post('/roles/edit/{id}', 'RoleController@update')->name('role.update ');
    Route::post('/roles/delete/{id}', 'RoleController@delete')->name('role.delete ');


    //BackGround System

    Route::get('/allbackgrounds', 'Admin\BackgroundController@index')->name('backgrounds.all');
    Route::get('/create/backgrounds', 'Admin\BackgroundController@create')->name('backgrounds.create');
    Route::post('/create/backgrounds', 'Admin\BackgroundController@store')->name('backgrounds.store');

    Route::Post('/backgroundsupdatestatus', 'Admin\BackgroundController@backgroundsstatus');

    //BackGround Edit System
    Route::get('/backgrounds/view/{id}', 'Admin\BackgroundController@view')->name('backgrounds.view ');

    Route::get('/backgrounds/edit/{id}', 'Admin\BackgroundController@edit')->name('backgrounds.edit ');
    Route::post('/backgrounds/edit/{id}', 'Admin\BackgroundController@update')->name('backgrounds.update ');
    Route::post('/backgrounds/delete/{id}', 'Admin\BackgroundController@delete')->name('backgrounds.delete ');

    //SubJect System

    Route::get('/allsubjects', 'Admin\SubjectController@index')->name('subjects.all');
    Route::get('/create/subjects', 'Admin\SubjectController@create')->name('subjects.create');
    Route::post('/create/subjects', 'Admin\SubjectController@store')->name('subjects.store');

    Route::Post('/subjectsupdatestatus', 'Admin\SubjectController@subjectssstatus');

    //SubJect Edit System
    Route::get('/subjects/view/{id}', 'Admin\SubjectController@view')->name('subjects.view ');
    Route::get('/subjects/edit/{id}', 'Admin\SubjectController@edit')->name('subjects.edit ');
    Route::post('/subjects/edit/{id}', 'Admin\SubjectController@update')->name('subjects.update ');
    Route::post('/subjects/delete/{id}', 'Admin\SubjectController@delete')->name('subjects.delete ');

    //Board System

    Route::get('/allboards', 'Admin\BoardController@index')->name('boards.all');
    Route::get('/create/boards', 'Admin\BoardController@create')->name('boards.create');
    Route::post('/create/boards', 'Admin\BoardController@store')->name('boards.store');

    Route::Post('/boardsupdatestatus', 'Admin\BoardController@boardssstatus');

    //Board Edit System
    Route::get('/boards/view/{id}', 'Admin\BoardController@view')->name('boards.view ');
    Route::get('/boards/edit/{id}', 'Admin\BoardController@edit')->name('boards.edit ');
    Route::post('/boards/edit/{id}', 'Admin\BoardController@update')->name('boards.update ');
    Route::post('/boards/delete/{id}', 'Admin\BoardController@delete')->name('boards.delete ');


    //Board System

    Route::get('/allqustions', 'Admin\QustionController@index')->name('qustions.all');
    Route::get('/create/qustions', 'Admin\QustionController@create')->name('qustions.create');
    Route::post('/create/qustions', 'Admin\QustionController@store')->name('qustions.store');

    Route::Post('/qustionsupdatestatus', 'Admin\QustionController@qustionssstatus');

    //SubJect Edit System
    Route::get('/qustions/view/{id}', 'Admin\QustionController@view')->name('qustions.view ');
    Route::get('/qustions/edit/{id}', 'Admin\QustionController@edit')->name('qustions.edit ');
    Route::post('/qustions/edit/{id}', 'Admin\QustionController@update')->name('qustions.update ');
    Route::post('/qustions/delete/{id}', 'Admin\QustionController@delete')->name('qustions.delete ');

    //Answer System

    Route::get('/allanswers', 'Admin\AnswerController@index')->name('answers.all');
    Route::get('/create/answers', 'Admin\AnswerController@create')->name('answers.create');
    Route::post('/create/answers', 'Admin\AnswerController@store')->name('answers.store');

    Route::Post('/answersupdatestatus', 'Admin\AnswerController@answerssstatus');

    //Answer Edit System
    Route::get('/answers/view/{id}', 'Admin\AnswerController@view')->name('answers.view ');
    Route::get('/answers/edit/{id}', 'Admin\AnswerController@edit')->name('answers.edit ');
    Route::post('/answers/edit/{id}', 'Admin\AnswerController@update')->name('answers.update ');
    Route::post('/answers/delete/{id}', 'Admin\AnswerController@delete')->name('answers.delete ');
});
