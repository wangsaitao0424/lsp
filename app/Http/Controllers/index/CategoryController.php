<?php

namespace App\Http\Controllers\index;

use App\Model\Admin_login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopBrand;

class CategoryController extends Controller
{
    // 分类
    public function category_ad(Request $request)
    {
        $catData = ShopBrand::where(['is_show'=>1])->where(['shop_del'=>1])->orderBy('shop_id','DESC')->get();
        return json_encode($catData);

    }

    //注册执行
    /** 执行 */
    public  function register_do()
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        if(empty($username) || empty($pwd)){
            $arr=["code"=>202,"msg"=>"注册失败，请点击确定跳转"];
        }
        // dd($username);
//        $user_pwd = md5($pwd);
        $data = Admin_login::insert([
            'user_name' => $username,
            'user_pwd' => $pwd,
            'user_time' => time()
        ]);
        if ($data){
            $arr=["code"=>200,"msg"=>"注册成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"注册失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }

    /** 登录执行 */
    public function login_do(Request $request)
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        if(empty($username) || empty($pwd)){
            $arr=["code"=>202,"msg"=>"登录失败，请点击确定跳转"];
        }
        $loginData = Admin_login::where(['user_name'=>$username,'user_pwd'=>$pwd])->first();
        session(['loginData'=>$loginData]);
        if ($loginData){
            $arr=["code"=>200,"msg"=>"登录成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"登录失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }
}
