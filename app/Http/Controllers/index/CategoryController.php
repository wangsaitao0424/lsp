<?php

namespace App\Http\Controllers\index;
use App\Model\Admin_adver;
use App\Model\Admin_login;
use App\Model\ShopGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopBrand;
use App\Model\Attr;
use App\Model\AttrGoods;

class CategoryController extends Controller
{
    // 分类
    public function category_ad(Request $request)
    {
        $catData = ShopBrand::where(['is_show'=>1])->where(['shop_del'=>1])->orderBy('shop_id','DESC')->get();
        return json_encode($catData);
    }

    /** 分类下的商品详情 */
    public function cate_goods(Request $request)
    {
        $req = $request->all();
        $shop_id = $req['shop_id'];
        $shopData = ShopGoods::where(['shop_goods.shop_id'=>$shop_id])
                    ->join('shop_brand','shop_goods.shop_id','=','shop_brand.shop_id')
                    ->get();
        return json_encode([
            'code' => 200,
            'shopData' => $shopData
        ]);
//        dd($shopData);
    }

    /** 分类 下的排序 */
    public function cate_order(Request $request)
    {
        $req = $request->all();
        $shop_weight = $req['shop_weight'];
        $goodsData = ShopGoods::where(['shop_weight'=>$shop_weight])->orderBy("$shop_weight",'DESC')->get();
        return json_encode(['code'=>200,'goodsData'=>$goodsData]);
    }

    /** 执行 */
    public  function register_do()
    {
        $username = request()->input('user_name');
        $pwd = request()->input('user_pwd');
        if(empty($username) || empty($pwd)){
         $arr=["code"=>202,"msg"=>"注册失败，请点击确定跳转"];
          echo "<script>alert('用户名和密码不能为空');location.href='/admin/login/login';</script>";
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
        $username = $request->input('user_name');
        $pwd = $request->input('user_pwd');
        $data = Admin_login::where(['user_name'=>$username,'user_pwd'=>$pwd])->first();
        $token = md5($data['user_id'].time());
        $data->token = $token;
        $data->user_time = time()+7200;
        $data->save();
        return json_encode(['code'=>200,'msg'=>'登录成功','data'=>$data]);
    }
    public function info(Request $request)
    {
        $token = $request->input("token");
        // dd($token);
        if(empty($token)){
            return json_encode(['code'=>203,'msg'=>'用户名和密码不对']);
        }
        $data = Admin_login::where(['token'=>$token])->first();
        if (!$data) {
            return json_encode(['code'=>201,'msg'=>'用户名和密码不对']);
        }
        if(time()>$data['user_time']){
            return json_encode(['code'=>202,'msg'=>'请重新登']);
        }

        echo '问伟良';die;
    }

    /** 商品 查询 接口 */
    public function goods_do()
    {
        $goodsData = ShopGoods::get();
        return json_encode($goodsData);
    }

    /** 轮播图 */
    public function char_do()
    {
        $charData = \DB::table('char')->where(['delete_at'=>1])->orderBy("ch_id","desc")->limit('4')->get();
        return json_encode($charData);
    }

    /** 广告接口 */
    public function adver_do()
    {
        $adverData = Admin_adver::where(['is_del'=>1])->where(['is_show'=>1])->orderBy('ad_id','desc')->limit('1')->get();
        return json_encode($adverData);
    }


}
