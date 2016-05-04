<?php
/**
 * 系统后台权限
 */
Route::group(['prefix' => 'admin','namespace'=>'Admin'], function(){
    Route::get('login', 'LoginController@login');
    Route::post('login', 'LoginController@dologin');
    Route::get('logout', 'LoginController@dologout');
});

/**
 * 这里是系统后台路由
 */
Route::group(['prefix'=>'admin','middleware' => 'AdminAuth','namespace'=>'Admin'],function(){
//Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //系统后台首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
    //权限管理
        //管理员路由
    Route::post('admin/{id}','AdminController@update');
    Route::get('admin/{id}/forceDelete','AdminController@forceDelete');
    Route::resource('admin','AdminController');
        //角色路由
    Route::post('role/{id}','RoleController@update');
    Route::get('role/{id}/forceDelete','RoleController@forceDelete');
    Route::resource('role','RoleController');
        //操作路由
    Route::get('action/create/{pid}','ActionController@create');
    Route::post('action/{id}','ActionController@update');
    Route::get('action/{id}/forceDelete','ActionController@forceDelete');
    Route::get('action/increase/{id}','ActionController@increase');
    Route::get('action/reduce/{id}','ActionController@reduce');
    Route::resource('action','ActionController');
        //用户权限分配
    Route::resource('authorization','AuthorizationController');
        //前台功能
    Route::post('function/{id}','FunctionController@update');
    Route::get('function/trash','FunctionController@trash');
    Route::resource('function','FunctionController');
        //前台左侧菜单链接功能
    Route::post('menus/{id}','MenusController@update');
    Route::get('menus/{id}/forceDelete','MenusController@forceDelete');
    Route::get('menus/trash','MenusController@trash');
    Route::get('{type}/menus/trash','MenusController@trash');
    Route::get('{type}/menus','MenusController@index');
    Route::resource('menus','MenusController');
    //资料审核
        //会员管理
    Route::get('user/toauth/{id}','UserController@toauth');
    Route::get('user/noauth/{id}','UserController@noauth');
    Route::get('user/increase/{id}','UserController@increase');
    Route::get('user/reduce/{id}','UserController@reduce');
    Route::get('user/limit/{id}/{limit}','UserController@limit');
    Route::post('user/{id}','UserController@update');
    Route::get('{data}/user','UserController@index');
    Route::resource('user','UserController');
    //作品管理（制作公司和设计师的）
    Route::get('{type}/goods','GoodsController@index');
    Route::resource('goods','GoodsController');
    //内部产品管理
    Route::resource('product','ProductController');
        //内部产品属性路由
    Route::resource('productattr','ProductAttrController');
        //产品类型路由
    Route::resource('category','CategoryController');
    //租赁路由
    Route::resource('rent','RentController');
    //娱乐路由
    Route::post('entertain/{id}','EntertainController@update');
    Route::resource('entertain','EntertainController');
    //设计路由
    Route::post('design/{id}','DesignController@update');
    Route::get('design/trash','DesignController@trash');
    Route::resource('design','DesignController');
    //功能管理
        //消息管理
    Route::get('message/trash','MessageController@trash');
    Route::resource('message','MessageController');
        //链接管理
    Route::post('link/{id}','LinkController@update');
    Route::resource('link','LinkController');
        //心声管理
    Route::resource('uservoice','UserVoiceController');
        //用户意见管理
    Route::post('opinions/{id}','OpinionsController@update');
    Route::get('opinions/{id}/destroy','OpinionsController@destroy');
    Route::get('opinions/{id}/restore','OpinionsController@restore');
    Route::get('opinions/{id}/forceDelete','OpinionsController@forceDelete');
    Route::get('opinions/trash','OpinionsController@trash');
    Route::get('opinions/{isshow}/trash','OpinionsController@trash');
    Route::get('{isshow}/opinions','OpinionsController@index');
    Route::resource('opinions','OpinionsController');
        //图片管理
    Route::post('pic/{id}','PicController@update');
    Route::get('pic/create/{id}','PicController@create');
    Route::resource('pic','PicController');
        //类型管理
    Route::post('type/{id}','TypeController@update');
    Route::get('type/create/{id}','TypeController@create');
    Route::resource('type','TypeController');
    Route::get('type/tableid/{table_id}','TypeController@index');
        //用户日志管理
    Route::resource('userlog','UserlogController');
        //地区管理
    Route::resource('area','AreaController');
    //企业页面功能管理
        //企业主页路由
    Route::post('commain/{id}','ComMainController@update');
    Route::resource('commain','ComMainController');
        //企业模块路由
    Route::post('commodule/{id}','ComModuleController@update');
    Route::resource('commodule','ComModuleController');
        //企业功能路由
    Route::post('comfunc/{id}','ComFuncController@update');
    Route::resource('comfunc','ComFuncController');
//        //企业信息管理路由
//    Route::post('cominfo/{id}','ComInfoController@update');
//    Route::resource('cominfo','ComInfoController');
//        //企业服务项目路由
//    Route::post('comfirm/{id}','ComFirmController@update');
//    Route::get('comfirm/{id}/forceDelete','ComFirmController@forceDelete');
//    Route::resource('comfirm','ComFirmController');
//        //企业宣传路由
//    Route::get('comppt/trash','ComPptController@trash');
//    Route::get('comppt/{id}/destroy','OpinionsController@destroy');
//    Route::get('comppt/{id}/restore','OpinionsController@restore');
//    Route::get('comppt/{id}/forceDelete','OpinionsController@forceDelete');
//    Route::post('comppt/{id}','ComPptController@update');
//    Route::resource('comppt','ComPptController');
//        //企业招聘路由
//    Route::get('comjob/{id}/destroy','ComJobController@destroy');
//    Route::get('comjob/{id}/restore','ComJobController@restore');
//    Route::get('comjob/{id}/forceDelete','ComJobController@forceDelete');
//    Route::post('comjob/{id}','ComJobController@update');
//    Route::resource('comjob','ComJobController');
//        //企业团队路由
//    Route::resource('comteam','ComTeamController');
    //广告路由
        //广告管理
    Route::resource('ad','AdController');
        //广告位管理
    Route::get('place/create','AdPlaceController@create');
    Route::resource('place','AdPlaceController');
        //修改（版本）日志管理
    Route::get('versionlog/{id}/forceDelete','VersionlogController@forceDelete');
    Route::post('versionlog/{id}','VersionlogController@update');
    Route::resource('versionlog','VersionlogController');
        //创意管理
    Route::post('idea/{id}','IdeaController@update');
    Route::resource('idea','IdeaController');
        //话题管理
    Route::post('talk/{id}','TalkController@update');
    Route::resource('talk','TalkController');
        //演员管理
    Route::resource('actor','ActorController');
});