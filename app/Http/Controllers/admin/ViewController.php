<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ViewController extends Controller
{
    //轮播图
    public function char()
    {
    	return view('admin/indexa/char');
    }

    public function up(Request $request)
    {
        $requestobj = $request->file("Filedata");
        $ext = $requestobj->getClientOriginalExtension();
        $path = $requestobj->getRealPath();
        $filename = date("YmdHis",time()).".".$ext;
        \Storage::disk('public')->put($filename,file_get_contents($path));
        $newPath = "/uploads/$filename";
        echo $newPath;
    }
    

    //轮播图添加
    public function char_do(Request $request)
    {
       $arr=request()->all();
       $data=[
       		'ch_img'=>$arr['ch_img'],
       		'ch_time'=>time()
       ];
       $res=DB::table('char')->insert($data);
       dd($res);

    }
   //轮播图展示
   public function list_char(Request $request)
   {
      $list=DB::table("char")->paginate(4);
      return view("admin/indexa/list_char",['list'=>$list]);
   }

   //轮播图删除
   public function delete(Request $request)
   {

        $data=request()->all();  
        // dd($data);
    	$res=DB::table('char')->where(['ch_id'=>$data['id']])->update(['delete_at'=>2]);
    	return redirect('admin/list_char');
   }
   //软删除
   public function char_list_shof()
   {
   		$data=request()->all();  
        // dd($data);
    	$res=DB::table('char')->where(['ch_id'=>$data['id']])->update(['delete_at'=>1]);
    	return redirect('admin/list_char');
   }





  

















    /**
     * uploadify 上传图片
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $requestobj=$request->file("Filedata");//资源对象
        //dd($requestobj);
        $ext=$requestobj->getClientOriginalExtension();//扩展名
        $path=$requestobj->getRealPath();//源路径
        $filename=date("YmdHis",time()).'.'.$ext;//新名字
        Storage::disk('public')->put($filename,file_get_contents($path));
        $newPath="/uploads/$filename";
        echo $newPath;
    }



    //用户留言表
    public function tb_leaveword()
    {
    	return view('admin/indexa/tb_leaveword');
    }
}
