<?php

namespace App\Http\Controllers\index;

use App\Model\Admin_login;
use App\Model\Attr;
use App\Model\AttrGoods;
use App\Model\Cart;
use App\Model\Fav;
use App\Model\GoodsPar;
use App\Model\ShopGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    /** 商品详情 */
    public function goods_detail(Request $request)
    {
        $goods_id = $_REQUEST['goods_id'];
//        $goods_id = $_REQUEST['goods_id'];
//        $goods_id = 6;
        $goodsData = ShopGoods::where(['goods_id'=>$goods_id])->first();
        $goodsAttrData=Attr::where('goods_id',$goods_id)->join('attr_goods','attr.attr_id','=','attr_goods.attr_id')->get();
        $goodsPar = GoodsPar::where(['goods_id'=>$goods_id])->first();
        $value = session('loginData');
        return json_encode([
            'goodsData' => $goodsData,
            'goodsPar' => $goodsPar,
            'goodsAttrData' => $goodsAttrData,
            'value' => $value,
        ]);

    }

//    /** 商品属性规格 */
//    public function goods_attr()
//    {
//        $attrGoods = AttrGoods::get()->toArray();
//        $attr = Attr::join('attr_goods','attr.attr_id','=','attr_goods.attr_id')->get()->toArray();
//        $goods = ShopGoods::join('attr_goods','shop_goods.goods_id','=','attr_goods.goods_id')->get()->toArray();
//        dd($goods);
//    }

    /** 接受token 根据token查询  */
    public function token(Request $request)
    {
        $token = $_REQUEST['token'];
        $userData = Admin_login::where(['token'=>$token])->first();
        return json_encode(['userData'=>$userData]);
    }

    /** 点击加入购物车 */
    public function cart_do(Request $request)
    {
        $req = $request->all();
        if($req['a'] == 'a'){
            // 进行累加
            $carData = Cart::where(['car_id'=>$req['car_id']])->update(['car_num'=>$req['cart_nums']]);
        }else{
            $carData = Cart::insert([
                'user_id' => $req['user_id'],
                'goods_id' => $req['goods_id'],
                'car_num' => $req['car_num'],
                'attr_id' => $req['attr_id'],
                'car_time' => time()
            ]);
        }
        if ($carData){
            return json_encode(['code'=>200,'msg'=>'加入购物车成功']);
        }else{
            return json_encode(['code'=>203,'msg'=>'加入购物车失败']);
        }
    }

    /** 点击收藏 */
    public function collect_do(Request $request)
    {
        $req = $request->all();
        $favData = Fav::insert([
            'user_id' => $req['user_id'],
            'goods_id' => $req['goods_id'],
            'fav_time' => time()
        ]);
        if ($favData){
            return json_encode(['code'=>200,'msg'=>'收藏成功']);
        }else{
            return json_encode(['code'=>203,'msg'=>'收藏失败']);
        }
    }

    /** 收藏列表 */
    public function collect_list(Request $request)
    {
        $req = $request->all();
        $user_id = $req['user_id'];
        $favData = Fav::where(['user_id'=>$user_id])
                    ->join('shop_goods','favorite.goods_id','=','shop_goods.goods_id')
                    ->get();
        return json_encode(['code'=>200,'favData'=>$favData]);
    }

    /** 收藏删除  单删  批删 */
    public function collect_del(Request $request)
    {
        $req = $request->all();
        $user_id = $req['user_id'];
        if(empty($req['fav_id'])){
            // 批删
            $favDate = Fav::where(['user_id'=>$user_id])->delete();
            return json_encode([
                'code' => 200,
                'msg' => '删除全部成功'
            ]);
        }else{
            // 单删
            $fav_id = $req['fav_id'];
            $favDate = Fav::where(['user_id'=>$user_id])->where(['fav_id'=>$fav_id])->delete();
            return json_encode([
                'code' => 200,
                'msg' => '删除成功'
            ]);
        }
    }

    /**
     * 购物车列表
     * @param Request $request
     * @return false|mixed|string
     */
    public function cart_list(Request $request)
    {
        $req = $request->all();
        $user_id = $req['user_id'];
        $cartData = Cart::where(['user_id'=>$user_id])
                ->join('shop_goods','shop_goods.goods_id','=','car.goods_id')
                ->join('attr','car.attr_id','=','attr.attr_id')
                ->get();
        return json_encode(['code'=>200,'cartData'=>$cartData]);
    }

    /** 购物车删除  单删  批删 */
    public function cart_del(Request $request)
    {
        $req = $request->all();
        $user_id = $req['user_id'];
        foreach ($req['bike'] as $k=>$v){
            // 单删
            $cartDate = Cart::where(['user_id'=>$user_id])->where(['goods_id'=>$v])->delete();
//          dd($cartDate);
        }
        return json_encode([
                'code' => 200,
                'msg' => '删除成功'
            ]);
    }

    /** 购物车全选 改变价格 数量 */
    public function cart_select(Request $request)
    {
        $req = $request->all();
        dd($req);
        foreach($req as $key=>$value){
            foreach($value as $kk=>$vv){
                foreach($vv as $k=>$v){
                    $user_id = $v['user_id'];
                    $goods_id = $v['goods_id'];
                    $goodsData = ShopGoods::where(['goods_id'=>$goods_id])->first();
                    $goods_num = $goodsData['goods_num'];
                    $goods_name = $goodsData['goods_name'];
                    $car_num = $v['car_num'];
                    if($car_num >= $goods_num){
                        echo json_encode(['code'=>202,'msg'=>$goods_name.'库存不足哦']);die;
                    }else{
//                        $car_num = $goods_num + $car_num;
                        $carData = Cart::where(['user_id'=>$user_id])
                            ->where(['goods_id'=>$goods_id])
                            ->update(['car_num'=>$car_num]);
                        $goods_num = $goods_num - $car_num;
                        $goodsData = ShopGoods::where(['goods_id'=>$goods_id])->update(['goods_num'=>$goods_num]);
                        echo json_encode(['msg'=>111]);
                    }
                }
            }
        }
    }

    /** 前台点击退出 */
    public function login_lout(Request $request)
    {
        $req = $request->all();
        $user_id = $req['user_id'];
        $loginData = Admin_login::where(['user_id'=>$user_id])->update(['token'=>'null']);
        return json_encode([
           'code' => 200,
            'msg' => '退出成功'
        ]);
    }
}
