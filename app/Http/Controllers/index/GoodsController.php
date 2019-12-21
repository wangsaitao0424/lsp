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
        $favData = Fav::where(['user_id'=>$user_id])->get();
        return json_encode(['code'=>200,'favData'=>$favData]);
    }

    /**
     * @param Request $request
     * @return false|mixed|string
     * 购物车列表
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
}
