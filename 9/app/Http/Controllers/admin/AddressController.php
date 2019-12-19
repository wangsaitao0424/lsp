<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AddressModel;

class AddressController extends Controller
{
    //
    public function add_do(Request $request)
    {
        // echo 123;die;
        // Header("add Access-Control-Allow-Origin *");
        $res = $_REQUEST;
        // dd($res);    
        // $name = $res['user_tel'];
        // dd($name);
        $data = AddressModel::insert([
            'user_name' => $res['user_name'],
            'user_tel' => $res['user_tel'],
            'city' => $res['city'],
            'add_youbian' => $res['add_youbian'],
            'add_time' => time()
        ]);
        // var_dump($data);die;
        // dd($data);
        if($data){
            // return json_encode(["code"=>200,"msg"=>"添加成功"]);
            return 1;
        }else{
            // return json_encode(["code"=>201,"msg"=>"添加失败，请重新添加"]);
            return 2;
        }
    }

    //收货地址展示
    public function address_list()
    {
        $data = AddressModel::where(['add_type'=>1])->paginate(1);
        // dd($data);->paginate(5)
        return view('admin.address.address_list',['data'=>$data]);
    }

    //收货地址删除
    public function add_del(Request $request)
    {
        $id = $request->add_id;
        // dd($id);
        $data = AddressModel::where(['add_id'=>$id])->update(['add_type'=>0]);
        // $sql = "update address set ziduan = 0 where add_id = $id";
        if($data){
            echo ("<script>alert('删除成功');location.href='/admin/address_list';</script>");
        }else{
            echo ("<script>alert('删除失败');location.href='/admin/address_list';</script>");
        }
    }

    //收货地址修改
    public function modify(Request $request)
    {
        $id = $request->add_id;
        // dd($id);
        $data = AddressModel::where(['add_id'=>$id])->first();
        return view('admin.address.modify',['data'=>$data]);
    }

    //收货地址修改执行
    public function modify_do(Request $request)
    {
        $res = $_REQUEST;
        dd($res);
        $id = $res['add_id'];
        dd($id);
        $user_name = $res['user_name'];
        $user_tel = $res['user_tel'];
        $city = $res['city'];
        $add_youbian = $res['add_youbian'];

        $data = AppendModel::where(['add_id'=>$id])->update([
            'user_name' => $user_name,
            'user_tel'  => $user_tel,
            'city'      => $city,
            'add_youbian'=> $add_youbian
        ]);

        if($data){
            // echo 1;
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            // echo 2;
            return json_encode(['code'=>201,'msg'=>'修改失败']);
        }
    }
}
