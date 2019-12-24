<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin_login;//用户表
use App\Model\Admin_jue;//角色表
use App\Model\Admin_userJue;//用户角色表
use App\Model\Admin_quan;//权限
use App\Model\Admin_quanJue;//权限角色表

class RbacController extends Controller
{
    /** 角色添加 */
    public function jue_add()
    {
        return view('/admin/rbac/jue_add');
    }

    /** 角色添加执行 */
    public function jue_addDo(Request $request)
    {
        $req = $request->all();
        $data = Admin_jue::insert([
            'j_name' => $req['j_name'],
            'j_time' => time()
        ]);
        if ($data){
            $arr=["code"=>200,"msg"=>"添加成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"添加失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }

    /** 角色展示 */
    public function jue_list()
    {
        $data = Admin_jue::get();
//        dd($data);

        return view('/admin/rbac/jue_list',['data'=>$data]);
    }

    /** 角色删除 */
    public function jue_del($j_id)
    {
        $data = Admin_jue::where(['j_id'=>$j_id])->delete();
        if($data){
            return redirect('/admin/rbac/jue_list');
        }
    }

    /** 用户角色添加 */
    public function userJue_add()
    {
        $userData = Admin_login::get();
        $jueData = Admin_jue::get();
        return view('/admin/rbac/userJue_add',['userData'=>$userData],['jueData'=>$jueData]);
    }

    /** 用户角色添加执行 */
    public function userJue_addDo(Request $request)
    {
        $req = $request->all();
//        dd($req);
        $data = Admin_userJue::insert([
            'user_id' => $req['user_id'],
            'j_id' => $req['j_id'],
            'userj_time' => time()
        ]);
        if ($data){
            $arr=["code"=>200,"msg"=>"添加成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"添加失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }

    /** 用户角色展示 */
    public function userJue_list()
    {
        $data = Admin_userJue::join('admin_jue','admin_userJue.j_id','=','admin_jue.j_id')
                ->join('admin_user','admin_userJue.user_id','=','admin_user.user_id')
                ->get();
//        dd($data);

        return view('/admin/rbac/userJue_list',['data'=>$data]);
    }

    /** 用户角色删除 */
    public function userJue_del($userj_id)
    {
        $data = Admin_userJue::where(['userj_id'=>$userj_id])->delete();
        if($data){
            return redirect('/admin/rbac/userJue_list');
        }
    }

    /** 权限添加 */
    public function quan_add()
    {
        return view('/admin/rbac/quan_add');
    }

    /** 权限添加执行 */
    public function quan_addDo(Request $request)
    {
        $req = $request->all();
        $data = Admin_quan::insert([
            'q_name' => $req['q_name'],
            'q_time' => time()
        ]);
        if ($data){
            $arr=["code"=>200,"msg"=>"添加成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"添加失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }

    /** 权限展示 */
    public function quan_list()
    {
        $data = Admin_quan::paginate(5);
//        dd($data);

        return view('/admin/rbac/quan_list',['data'=>$data]);
    }

    /** 权限删除 */
    public function quan_del($q_id)
    {
        $data = Admin_quan::where(['q_id'=>$q_id])->delete();
        if($data){
            return redirect('/admin/rbac/quan_list');
        }
    }

    /** 权限角色添加 */
    public function quanJue_add()
    {
        $quanData = Admin_quan::get();
        $jueData = Admin_jue::get();
        return view('/admin/rbac/quanJue_add',['quanData'=>$quanData],['jueData'=>$jueData]);
    }

    /** 用户角色添加执行 */
    public function quanJue_addDo(Request $request)
    {
        $req = $request->all();
//        dd($req);
        $data = Admin_quanJue::insert([
            'q_id' => $req['q_id'],
            'j_id' => $req['j_id'],
            'qj_time' => time()
        ]);
        if ($data){
            $arr=["code"=>200,"msg"=>"添加成功，请点击确定跳转"];
        }else{
            $arr=["code"=>202,"msg"=>"添加失败，请点击确定跳转"];
        }
        echo json_encode($arr);
    }

    /** 用户角色展示 */
    public function quanJue_list()
    {
        $data = Admin_quanJue::join('admin_jue','admin_quanJue.j_id','=','admin_jue.j_id')
            ->join('admin_quan','admin_quanJue.q_id','=','admin_quan.q_id')
            ->get();
//        dd($data);

        return view('/admin/rbac/quanJue_list',['data'=>$data]);
    }

    /** 权限角色 删除 */
    public function quanJue_del($qj_id)
    {
        $data = Admin_quanJue::where(['qj_id'=>$qj_id])->delete();
        if($data){
            return redirect('/admin/rbac/quanJue_list');
        }
    }

}
