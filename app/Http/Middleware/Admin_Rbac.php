<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin_login;//用户表
use App\Model\Admin_jue;//角色表
use App\Model\Admin_userJue;//用户角色表
use App\Model\Admin_quan;//权限
use App\Model\Admin_quanJue;//权限角色表

class Admin_Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(session('loginData')['user_name'])){
            return redirect('/admin/login/login');
        }else{
            /** @var 登陆者信息 $info */
            $info = session('loginData');
//            dd($info);
            /** @var 先查用户表和用户角色关系表 $userJue */
            $userJue = Admin_login::where(['user_name'=>$info['user_name']])
                        ->join('admin_userJue','admin_user.user_id','=','admin_userJue.user_id')
                        ->first()
                        ->toArray();
//            dd($userJue);die;
            /** @var 根据上面查的把角色表id单独提出来 $j_id */
            $j_id = $userJue['j_id'];
//            dd($j_id);
            /** @var 根据j_id查询权限表和角色权限关系表 $quanJue */
            $quanJue = Admin_quanJue::where(['j_id'=>$j_id])
                        ->join('admin_quan','admin_quan.q_id','=','admin_quanJue.q_id')
                        ->get()
                        ->toArray();
//            dd($quanJue);
            $data = "";
            foreach ($quanJue as $k=>$v){
                /** @var 获取当前路径 $url */
                $url = request()->server("REDIRECT_URL");
//                dd($v);
                $path = Admin_quan::where(['q_id'=>$v['q_id']])->where(['q_name'=>$url])->first();
                /** 拼接当前路径 */
                $data.=$path;
//                dd($path);
            }
//            dd($data);
//            if(empty($data)){
//                echo "<script>alert('您的权限不够，请联系更高一级管理员');location.href='/admin/index'</script>";
//            }
        }
        return $next($request);
    }
}
