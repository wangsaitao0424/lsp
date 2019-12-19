<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin_adver;

class AdverController extends Controller
{
    /**
     * 广告视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function adver_add()
    {
        return view('/admin/adver/adver_add');
    }

    public function adver_addDo(Request $request)
    {
        $data=$request->all();
//         dd($data);
        if (empty($data['is_show']) || empty($data['ad_title']) || empty($data['ad_content']) || empty($data['ad_url'])){
            $arr=['code'=>202,"msg"=>"参数不能为空"];
        }else {
            unset($data['top-search']);
            $data['ad_time'] = time();
//            dd($data);
            $res = Admin_adver::create($data);
//            dd($res);
            if ($res){
                $arr=["code"=>200,"msg"=>"添加成功，请点击确定跳转"];
            }else{
                $arr=["code"=>202,"msg"=>"添加失败，请点击确定跳转"];
            }
        }
        echo json_encode($arr);
    }

    /**
     * uploadify 上传图片
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $arrinfo=$_FILES['Filedata'];
        $tmpname=$arrinfo['tmp_name'];
        $realname=$arrinfo['name'];
        $ext=explode(".",$realname)[1];
        $basename=md5(uniqid()).".".$ext;
        $daseDir="adver/".date("Y-m-d",time());
//        dd($daseDir);
        if (!is_dir($daseDir)){
            mkdir($daseDir,0,777);
        }
        $filePath="$daseDir/".$basename;
//        dd($filePath);
        move_uploaded_file($tmpname,$filePath);
        echo $filePath;
    }

    /**
     * 广告展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function adver_list()
    {
        $adverData = Admin_adver::paginate(2);//get();//paginate(1);
//        $data = Admin_adver::where(['is_del'==1])->get();

        return view('/admin/adver/adver_list',['adverData'=>$adverData]);
    }

    /** 广告删除 */
//    public function adver_del($ad_id)
//    {
//        if(empty($data['ad_img'])){
//            $data = Admin_adver::where(['ad_id'=>$ad_id])->delete();
//        }else{
//            $data = Admin_adver::where(['ad_id'=>$ad_id])->delete();
//            unlink($data['ad_img']);
//        }
//        if($data){
//            return redirect('/admin/adver/adver_list');
//        }
//    }

    public function adver_del()
    {
        $ad_id=$_REQUEST['ad_id'];
        $data=Admin_adver::where(['ad_id'=>$ad_id])->first();
        $res=Admin_adver::where(['ad_id'=>$ad_id])->update(['is_del'=>2]);
        if($res){
            return redirect('/admin/adver/adver_list');
        }else{
            return redirect('/admin/adver/adver_list');
        }
    }
    /** 回复已删除数据 */
    public function adver_delInfo()
    {
        $ad_id=$_REQUEST['ad_id'];
//        dd($ad_id);
        $res=Admin_adver::where(['ad_id'=>$ad_id])->update(['is_del'=>1]);
        if($res){
            return redirect('/admin/adver/adver_list');
        }else{
            return redirect('/admin/adver/adver_list');
        }
    }
}
