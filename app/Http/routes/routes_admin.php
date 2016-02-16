<?php
/**
 * 这里是系统后台路由
 */

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //系统后台首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
        //图片管理
    Route::post('pic/{id}','PicController@update');
    Route::get('pic/create/{id}','PicController@create');
    Route::resource('pic','PicController');
        //类型管理
    Route::post('type/{id}','TypeController@update');
    Route::get('type/create/{id}','TypeController@create');
    Route::resource('type','TypeController');
    //权限管理之管理员路由
    Route::resource('admin','AdminController');
    //权限管理之角色路由
    Route::resource('role','RoleController');
    //权限管理之操作路由
    Route::get('action/create/{pid}','ActionController@create');
    Route::post('action/{id}','ActionController@update');
    Route::resource('action','ActionController');
    //供求管理之供应路由
    //供求管理之需求路由
    //内部产品路由
    Route::resource('product','ProductController');
        //内部产品属性路由
    Route::resource('productattr','ProductAttrController');
    //上传的视频路由
    Route::resource('video','VideoController');
        //上传的视频路由
    Route::resource('videocate','VideoCategoryController');
    //租赁路由
    //娱乐路由
    //设计路由
    //消息路由之消息管理
    Route::resource('message','MessageController');
    //消息路由之链接管理
    Route::resource('link','LinkController');
    //消息路由之心声管理
    Route::resource('voice','VoiceController');
    //广告管理
    Route::resource('ad','AdController');
    //广告位管理
    Route::get('place/create','AdPlaceController@create');
    Route::resource('place','AdPlaceController');
});