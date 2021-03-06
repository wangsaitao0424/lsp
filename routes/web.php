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

//收货地址添加页
Route::get('/addre', function () {
    return view('admin.address.address');
});
/** 后台—登录—注册 */
Route::prefix('admin')->namespace('admin')->group(function(){
    Route::any('login/login','LoginController@login'); // 登录
    Route::any('login/login_do','LoginController@login_do'); // 登录执行
    Route::any('/login/session', 'LoginController@session'); // 登录 — 存session
    Route::any('/login/register', 'LoginController@register'); // 注册
    Route::any('/login/register_do', 'LoginController@register_do'); // 注册 — 执行
    Route::any('/login/login_lout', 'LoginController@login_lout'); // 退出
});
//后台
Route::prefix('admin')->middleware(['Admin_Rbac'])->group(function(){
    //首页
    Route::any('index','admin\AdminController@index');
    //广告模块
    Route::any('/adver/adver_add','admin\AdverController@adver_add');//广告添加
    Route::any('/adver/adver_addDo','admin\AdverController@adver_addDo');//广告添加执行
    Route::any('edit','admin\AdverController@edit');//广告添加
    Route::any('/adver/adver_list','admin\AdverController@adver_list');//广告展示
    Route::any('/adver/adver_del','admin\AdverController@adver_del');//广告删除
    Route::any('/adver/adver_delInfo','admin\AdverController@adver_delInfo');//回复删除数据
    /** Rbac */
    Route::any('/rbac/jue_add','admin\RbacController@jue_add'); // rbac—角色添加
    Route::any('/rbac/jue_addDo','admin\RbacController@jue_addDo'); // rbac—角色添加执行
    Route::any('/rbac/jue_list','admin\RbacController@jue_list'); // rbac—角色展示
    Route::any('/rbac/jue_del/{j_id}','admin\RbacController@jue_del'); // rbac—角色删除

    Route::any('/rbac/userJue_add','admin\RbacController@userJue_add'); // rbac—用户角色添加
    Route::any('/rbac/userJue_addDo','admin\RbacController@userJue_addDo'); // rbac—用户角色添加执行
    Route::any('/rbac/userJue_list','admin\RbacController@userJue_list'); // rbac—用户角色展示a
    Route::any('/rbac/userJue_del/{userj_id}','admin\RbacController@userJue_del'); // rbac—用户角色展示a

    Route::any('/rbac/quan_add','admin\RbacController@quan_add'); // rbac—权限添加
    Route::any('/rbac/quan_addDo','admin\RbacController@quan_addDo'); // rbac—权限添加执行
    Route::any('/rbac/quan_list','admin\RbacController@quan_list'); // rbac—权限展示
    Route::any('/rbac/quan_del/{q_id}','admin\RbacController@quan_del'); // rbac—权限删除

    Route::any('/rbac/quanJue_add','admin\RbacController@quanJue_add'); // rbac—权限角色添加
    Route::any('/rbac/quanJue_addDo','admin\RbacController@quanJue_addDo'); // rbac—权限角色添加执行
    Route::any('/rbac/quanJue_list','admin\RbacController@quanJue_list'); // rbac—权限角色展示
    Route::any('/rbac/quanJue_del/{qj_id}','admin\RbacController@quanJue_del'); // rbac—权限角色展示
    Route::any('index','admin\AdminController@index');
    //一级菜单
    Route::get('shop_brand_add','admin\BrandController@shop_brand_add');//添加
    Route::post('shop_brand_do','admin\BrandController@shop_brand_do');//执行
    Route::get('shop_brand_list','admin\BrandController@shop_brand_list');//展示
    Route::get('shop_brand_update','admin\BrandController@shop_brand_update');//修改
    Route::post('shop_brand_update_do','admin\BrandController@shop_brand_update_do');//修改执行
    Route::get('shop_brand_del','admin\BrandController@shop_brand_del');//删除
    Route::get('shop_brand_shof','admin\BrandController@shop_brand_shof');//恢复
    //商品
    Route::get('shop_goods_add','admin\BrandController@shop_goods_add');//添加
    Route::post('shop_goods_do','admin\BrandController@shop_goods_do');//添加执行
    Route::get('shop_goods_list','admin\BrandController@shop_goods_list');//展示
    Route::get('shop_goods_del','admin\BrandController@shop_goods_del');//删除
    Route::get('shop_goods_shof','admin\BrandController@shop_goods_shof');//删除
    //商品详情
    Route::get('goods_par_add','admin\BrandController@goods_par_add');//添加
    Route::post('goods_par_do','admin\BrandController@goods_par_do');//添加执行
    Route::get('goods_par_list','admin\BrandController@goods_par_list');//展示
    Route::get('goods_par_del','admin\BrandController@goods_par_del');//删除
    Route::get('goods_par_shof','admin\BrandController@goods_par_shof');//恢复
    //优惠劵
    Route::get('discounts_add','admin\BrandController@discounts_add');//添加
    Route::post('discounts_do','admin\BrandController@discounts_do');//添加
    Route::get('discounts_list','admin\BrandController@discounts_list');//展示
    Route::get('discounts_update','admin\BrandController@discounts_update');//修改
    Route::post('discounts_update_do','admin\BrandController@discounts_update_do');//修改执行
    Route::get('discounts_del','admin\BrandController@discounts_del');//删除
    Route::get('discounts_shof','admin\BrandController@discounts_shof');//恢复

    Route::any('uploads','admin\BrandController@upload');//图片
    Route::any('char','admin\BrandController@char');//恢复
     //轮播图
    Route::any('char','admin\ViewController@char');
    //轮播图添加
    Route::any('char_do','admin\ViewController@char_do');
    //轮播图展示
    Route::any('list_char','admin\ViewController@list_char');
    //轮播图删除
    Route::any('delete','admin\ViewController@delete');
    Route::any('char_list_shof','admin\ViewController@char_list_shof');

     //收货地址
     Route::any('addressed','admin\AddressController@add_do');
     Route::any('address_list','admin\AddressController@address_list');
     Route::any('add_del/{add_id}','admin\AddressController@add_del');
     Route::any('modify/{add_id}','admin\AddressController@modify');
     Route::any('modify_do','admin\AddressController@modify_do');
    //sku
    Route::get('attr_add','admin\AttrController@attr_add');//属性添加
    Route::post('attr_do','admin\AttrController@attr_do');//属性添加执行
    Route::get('attr_list','admin\AttrController@attr_list');//属性展示
    Route::get('attr_goods_add','admin\AttrController@attr_goods_add');//属性商品添加
    Route::post('attr_goods_do','admin\AttrController@attr_goods_do');//属性商品添加执行
    Route::get('attr_goods_list','admin\AttrController@attr_goods_list');//属性商品展示
});

//前台 接口
Route::any('/category_ad','index\CategoryController@category_ad');// 一级分类
Route::any('/register_do','index\CategoryController@register_do'); // 注册接口

Route::any('/goods_do','index\CategoryController@goods_do'); // 商品接口
Route::any('/goods/goods_detail','index\GoodsController@goods_detail'); // 商品属性详情接口
Route::any('/goods/goods_attr','index\GoodsController@goods_attr'); // 商品属性规格接口
Route::any('/char_do','index\CategoryController@char_do'); // 轮播图接口
Route::any('/adver_do','index\CategoryController@adver_do'); // 广告图接口
Route::any('/login_do','index\CategoryController@login_do'); // 接口  登录  token
Route::any('/login/token','index\GoodsController@token'); // 接受token  查询用户
Route::middleware(['Token'])->group(function(){
    Route::any('/info/','index\CategoryController@info');//  接口  登录  token
    Route::any('/goods/attrCart','index\GoodsController@attrCart'); // 点击加入购物车
    Route::any('/goods/cart_list','index\GoodsController@cart_list'); // 购物车列表
    Route::any('/goods/cart_del','index\GoodsController@cart_del'); // 购物车删除  单删  批删
    Route::any('/goods/cart_select','index\GoodsController@cart_select'); // 购物车
});

Route::any('/goods/cart_do','index\GoodsController@cart_do'); // 接受值  点击加入购入车
Route::any('/goods/collect_do','index\GoodsController@collect_do'); // 接受值  点击收藏
Route::any('/goods/collect_list','index\GoodsController@collect_list'); // 接受值  查看收藏列表
Route::any('/goods/collect_del','index\GoodsController@collect_del'); // 收藏 删除 单删  批删
Route::any('/goods/login_lout','index\GoodsController@login_lout'); // 前台用户点击退出

Route::any('/cate/cate_goods','index\CategoryController@cate_goods'); // 分类 下的商品
Route::any('/cate/cate_order','index\CategoryController@cate_order'); // 分类 下的排序





//上传图片 轮播图
 Route::any('up','admin\ViewController@up');
 Route::any('admin/upload','admin\ViewController@upload');