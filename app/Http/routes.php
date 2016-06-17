<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'web'],function(){
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
//    Route::get('admin/{user}',function(\App\Models\Admin $user) {
//        dd($user);
//    });
});

Route::group(['prefix' => 'admin','middleware' => 'web','namespace'=>'Admin'],function(){
    //权限管理
    Route::get('/','AdminController@index');
    Route::get('permission/{cid}/create',['as' => 'admin.permission.create','uses'=>'PermissionController@create']);
    Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('permission', 'PermissionController');
    Route::put('permission/update', ['as' => 'admin.permission.edit', 'uses' => 'PermissionController@update']); //修改
    Route::post('permission/store', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@store']); //添加

    //角色管理路由
    Route::get('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController');
    Route::put('role/update', ['as' => 'admin.role.edit', 'uses' => 'RoleController@update']); //修改
    Route::post('role/store', ['as' => 'admin.role.create', 'uses' => 'RoleController@store']); //添加


    //用户管理路由
    Route::get('user/manage', ['as' => 'admin.user.manage', 'uses' => 'UserController@index']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('user', 'UserController');
    Route::put('user/update', ['as' => 'admin.user.edit', 'uses' => 'UserController@update']); //修改
    Route::post('user/store', ['as' => 'admin.user.create', 'uses' => 'UserController@store']); //添加

});



Route::controller('test','Admin\AdminController');

//Route::get('test', function () {
//    clock()->startEvent('event_name', 'LaravelAcademy.org'); //事件名称，显示在Timeline中
//
//    clock('Message text.'); //在Clockwork的log中显示'Message text.'
//    logger('Message text.'); //也Clockwork的log中显示'Message text.'
//
//    clock(array('hello' => 'world')); //以json方式在log中显示数组
//    //如果对象实现了__toString()方法则在log中显示对应字符串，
//    //如果对象实现了toArray方法则显示对应json格式数据，
//    //如果都没有则将对象转化为数组并显示对应json格式数据
//    clock('eerr');
//
//    clock()->endEvent('event_name');
//});
