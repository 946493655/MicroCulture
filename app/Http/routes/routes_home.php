<?php
/**
 * 这里是前台页面路由
 */

//Route::get('home',function(){
//    return 'home';
//});

Route::group(['prefix'=>'','namespace'=>'Home'],function(){
    //前台首页路由
    Route::any('/','HomeController@index');
    Route::any('home','HomeController@index');
    Route::any('creation','CreationController@index');
    //产品样片
    Route::any('product','ProductController@index');
    //在线作品
    Route::any('creation','CreationController@index');
    //供应单位
    Route::any('supply','SupplyController@index');
    //需求信息
    Route::any('demand','DemandController@index');
    //娱乐频道
    Route::any('entertain','EntertainController@index');
    //租赁频道
    Route::any('rent/SD/{genre}','RentController@index');
    Route::any('rent','RentController@index');
    //设计频道
    Route::any('design','DesignController@index');
    //关于我们
    Route::any('about','AboutController@index');
    //用户对本站的意见栏
    Route::get('opinion/create/{reply}','OpinionController@create');
    Route::get('opinion/create','OpinionController@create');
    Route::post('opinion/{id}','OpinionController@update');
    Route::get('{status}/opinion','OpinionController@index');
    Route::resource('opinion','OpinionController');
    //创意路由
    Route::get('idea/click/{id}','IdeaController@click');
    Route::get('idea/collect/{id}','IdeaController@collect');
    Route::resource('idea','IdeaController');
    //话题路由
    Route::post('talk/{id}','TalkController@update');
    Route::get('talk/mytalk','TalkController@mytalk');
    Route::get('talk/follow','TalkController@follow');
    Route::get('talk/theme','TalkController@theme');
    Route::get('talk/collect','TalkController@collect');
    Route::get('talk/tofollow','TalkController@tofollow');
    Route::get('talk/tothank','TalkController@tothank');
    Route::get('talk/toclick','TalkController@toclick');
    Route::get('talk/toshare','TalkController@toshare');
    Route::get('talk/toreport','TalkController@toreport');
    Route::get('talk/tocollect','TalkController@tocollect');
    Route::get('talk/mycollect/{id}','TalkController@tomycollect');
    Route::get('talk/{id}/destroy','TalkController@destroy');
    Route::get('talk/{id}/restore','TalkController@restore');
    Route::get('talk/{id}/forceDelete','TalkController@forceDelete');
    Route::resource('talk','TalkController');
});