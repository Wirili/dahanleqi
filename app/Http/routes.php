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

/*
 * 前台路由列表
 */

Route::get('/', ['uses'=>'Home\IndexController@index', 'as'=>'index']);
Route::get('/index', ['uses'=>'Home\IndexController@index', 'as'=>'index']);

// Authentication Routes...
Route::get('login', ['uses'=>'Home\AuthController@showLoginForm', 'as'=>'get_login']);
Route::post('login', ['uses'=>'Home\AuthController@login', 'as'=>'post_login']);
Route::get('logout', ['uses'=>'Home\AuthController@logout', 'as'=>'logout']);

// Registration Routes...
Route::get('register', ['uses'=>'Home\AuthController@showRegistrationForm', 'as'=>'get_register']);
Route::post('register', ['uses'=>'Home\AuthController@register', 'as'=>'post_register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['uses'=>'Home\PasswordController@showResetForm', 'as'=>'password.reset.token']);
Route::post('password/email', ['uses'=>'Home\PasswordController@sendResetLinkEmail', 'as'=>'password.email']);
Route::post('password/reset', ['uses'=>'Home\PasswordController@reset', 'as'=>'password.reset']);

//商品类别页
Route::get('category/{id}', ['uses'=>'Home\CategoryController@index', 'as'=>'category']);
Route::get('qrcode', ['uses'=>'Home\CategoryController@qrcode', 'as'=>'qrcode']);
Route::get('xqrcode', ['uses'=>'Home\CategoryController@xqrcode', 'as'=>'xqrcode']);

//微信路由
Route::group(['prefix' => 'admin','middleware' => 'wechat'], function () {
    Route::get('server',['uses'=>'Wechat/ServerController@index','as'=>'wechat.server.index']);
});

/*
 * 后台管理路由列表
 */
//首页
Route::get('admin', ['uses'=>'Admin\IndexController@index','as'=>'admin']);
Route::get('admin/welcome', ['uses'=>'Admin\IndexController@welcome','as'=>'admin.welcome']);
Route::get('admin/setting', ['uses'=>'Admin\IndexController@getSetting','as'=>'admin.get_setting']);
Route::post('admin/setting', ['uses'=>'Admin\IndexController@postSetting','as'=>'admin.post_setting']);

Route::get('admin/index', ['uses'=>'Admin\IndexController@index','as'=>'admin.index']);
Route::get('admin/login', ['uses'=>'Admin\AuthController@getLogin','as'=>'admin.get_login']);
Route::get('admin/logout', ['uses'=>'Admin\AuthController@logout','as'=>'admin.logout']);
Route::post('admin/login', ['uses'=>'Admin\AuthController@postLogin','as'=>'admin.post_login']);
Route::get('admin/register', ['uses'=>'Admin\AuthController@getRegister','as'=>'admin.get_register']);
Route::post('admin/register', ['uses'=>'Admin\AuthController@postRegister','as'=>'admin.post_register']);

//品牌路由
Route::get('admin/brand/index', ['uses'=>'Admin\BrandController@index','as'=>'admin.brand.index']);
Route::get('admin/brand/edit/{id}', ['uses'=>'Admin\BrandController@edit','as'=>'admin.brand.edit']);
Route::get('admin/brand/create', ['uses'=>'Admin\BrandController@create','as'=>'admin.brand.create']);
Route::get('admin/brand/del/{id}', ['uses'=>'Admin\BrandController@del','as'=>'admin.brand.del']);
Route::post('admin/brand/save', ['uses'=>'Admin\BrandController@save','as'=>'admin.brand.save']);
Route::post('admin/brand/ajax', ['uses'=>'Admin\BrandController@ajax','as'=>'admin.brand.ajax']);

//商品路由
Route::get('admin/goods/index', ['uses'=>'Admin\GoodsController@index','as'=>'admin.goods.index']);
Route::get('admin/goods/edit/{id}', ['uses'=>'Admin\GoodsController@edit','as'=>'admin.goods.edit']);
Route::get('admin/goods/create', ['uses'=>'Admin\GoodsController@create','as'=>'admin.goods.create']);
Route::get('admin/goods/del/{id}', ['uses'=>'Admin\GoodsController@del','as'=>'admin.goods.del']);
Route::post('admin/goods/save', ['uses'=>'Admin\GoodsController@save','as'=>'admin.goods.save']);
Route::post('admin/goods/ajax', ['uses'=>'Admin\GoodsController@ajax','as'=>'admin.goods.ajax']);
Route::post('admin/goods/ajax_img', ['uses'=>'Admin\GoodsController@ajax_img','as'=>'admin.goods.ajax_img']);

//商品类别路由
Route::get('admin/category/index', ['uses'=>'Admin\CategoryController@index','as'=>'admin.category.index']);
Route::get('admin/category/edit/{id}', ['uses'=>'Admin\CategoryController@edit','as'=>'admin.category.edit']);
Route::get('admin/category/create', ['uses'=>'Admin\CategoryController@create','as'=>'admin.category.create']);
Route::post('admin/category/save', ['uses'=>'Admin\CategoryController@save','as'=>'admin.category.save']);
Route::get('admin/category/del/{id}', ['uses'=>'Admin\CategoryController@del','as'=>'admin.category.del']);

//文章路由
Route::get('admin/article/index', ['uses'=>'Admin\ArticleController@index','as'=>'admin.article.index']);
Route::get('admin/article/edit/{id}', ['uses'=>'Admin\ArticleController@edit','as'=>'admin.article.edit']);
Route::get('admin/article/create', ['uses'=>'Admin\ArticleController@create','as'=>'admin.article.create']);
Route::post('admin/article/save', ['uses'=>'Admin\ArticleController@save','as'=>'admin.article.save']);
Route::post('admin/article/ajax', ['uses'=>'Admin\ArticleController@ajax','as'=>'admin.article.ajax']);
Route::get('admin/article/del/{id}', ['uses'=>'Admin\ArticleController@del','as'=>'admin.article.del']);

//文章类别路由
Route::get('admin/article_cat/index', ['uses'=>'Admin\ArticleCatController@index','as'=>'admin.article_cat.index']);
Route::get('admin/article_cat/edit/{id}', ['uses'=>'Admin\ArticleCatController@edit','as'=>'admin.article_cat.edit']);
Route::get('admin/article_cat/create', ['uses'=>'Admin\ArticleCatController@create','as'=>'admin.article_cat.create']);
Route::post('admin/article_cat/save', ['uses'=>'Admin\ArticleCatController@save','as'=>'admin.article_cat.save']);
Route::get('admin/article_cat/del/{id}', ['uses'=>'Admin\ArticleCatController@del','as'=>'admin.article_cat.del']);

//管理员路由
Route::get('admin/admin/index', ['uses'=>'Admin\AdminController@index','as'=>'admin.admin.index']);
Route::get('admin/admin/edit/{id}',['uses'=>'Admin\AdminController@edit','as'=>'admin.admin.edit']);
Route::get('admin/admin/create',['uses'=>'Admin\AdminController@create','as'=>'admin.admin.create']);
Route::post('admin/admin/save',['uses'=>'Admin\AdminController@save','as'=>'admin.admin.save']);
Route::post('admin/admin/ajax', ['uses'=>'Admin\AdminController@ajax','as'=>'admin.admin.ajax']);

//权限控制路由
Route::get('admin/role/index',['uses'=>'Admin\RoleController@index','as'=>'admin.role.index']);
Route::get('admin/role/edit/{id}',['uses'=>'Admin\RoleController@edit','as'=>'admin.role.edit']);
Route::get('admin/role/create',['uses'=>'Admin\RoleController@create','as'=>'admin.role.create']);
Route::post('admin/role/save',['uses'=>'Admin\RoleController@save','as'=>'admin.role.save']);
Route::post('admin/role/ajax', ['uses'=>'Admin\RoleController@ajax','as'=>'admin.role.ajax']);
Route::get('admin/role/del/{id}', ['uses'=>'Admin\RoleController@del','as'=>'admin.role.del']);


//获取图片
Route::get('image/{filename}',['uses'=>'ImageController@getGoodImage', 'as'=>'good.image']);

