<?php

namespace App\Http\Controllers\index;

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

    /** 执行 */
    public  function register_do()
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        if(empty($username) || empty($pwd)){
            echo "<script>alert('用户名和密码不能为空');location.href='/admin/login/login';</script>";
        }
        // dd($username);
//        $user_pwd = md5($pwd);
        $data = Admin_login::insert([
            'user_name' => $username,
            'user_pwd' => $pwd,
            'user_time' => time()
        ]);
        if($data){
            echo "<script>alert('注册成功，请登录');location.href='/admin/login/login';</script>";
        }else{
            return redirect('admin/login/register');
        }
    }

    /** 登录执行 */
    public function login_do(Request $request)
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        if(empty($username) || empty($pwd)){
            echo "<script>alert('用户名和密码不能为空');location.href='/admin/login/login';</script>";
        }
        $loginData = Admin_login::where(['user_name'=>$username,'user_pwd'=>$pwd])->first();
        session(['loginData'=>$loginData]);
        if($loginData){
            // echo 1;die;
            echo "<script>alert('登录成功');location.href='/admin/index';</script>";
            // return redirect();
        }else{
            // echo 2;die;
            echo "<script>alert('登录失败');location.href='/admin/login/login';</script>";
        }
    }
}
