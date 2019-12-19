<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin_login;

class LoginController extends Controller
{
    /** 登录 */
    public function login()
    {
        return view('/admin/login/login');
    }

    /** 登录执行 */
    public function login_do(Request $request)
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        $email = request()->input('user_email');
        if(empty($username) || empty($pwd) || empty($email)){
            echo "<script>alert('用户名和密码或邮箱不能为空');location.href='/admin/login/login';</script>";
        }
        $loginData = Admin_login::where(['user_name'=>$username,'user_pwd'=>$pwd,'user_email'=>$email])->first();
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

    /** 注册 */
    public  function register()
    {
        return view('/admin/login/register');
    }

    /** 执行 */
    public  function register_do()
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        $email = request()->input('user_email');
        if(empty($username) || empty($pwd) || empty($email)){
            echo "<script>alert('用户名和密码或邮箱不能为空');location.href='/admin/login/login';</script>";
        }
        // dd($username);
//        $user_pwd = md5($pwd);
        $data = Admin_login::insert([
            'user_name' => $username,
            'user_pwd' => $pwd,
            'user_email' => $email,
            'user_time' => time()
        ]);
        if($data){
            echo "<script>alert('注册成功，请登录');location.href='/admin/login/login';</script>";
        }else{
            return redirect('admin/login/register');
        }
    }

    public function session()
    {
        $value = session('loginData');
//        dd($value);
        $name = $value["user_name"];
//         dd($name);
    }

    /** 点击退出 */
    public function login_lout(Request $request)
    {
        session(['loginData'=>null]);
        //跳转到登录页面
        echo '<script>alert("退出登录成功，点击跳转"); location.href="/admin/login/login"</script>';
    }
}
