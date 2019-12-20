<?php

namespace App\Http\Controllers\index;

use App\Model\Attr;
use App\Model\AttrGoods;
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
//        $goods_id = 6;
        $goodsData = ShopGoods::where(['goods_id'=>$goods_id])->first();
        $goodsAttrData=Attr::where('goods_id',$goods_id)->join('attr_goods','attr.attr_id','=','attr_goods.attr_id')->get();
        $goodsPar = GoodsPar::where(['goods_id'=>$goods_id])->first();
        return json_encode([
            'goodsData' => $goodsData,
            'goodsPar' => $goodsPar,
            'goodsAttrData' => $goodsAttrData,
        ]);

    }

    /** 商品属性规格 */
    public function goods_attr()
    {
        $attrGoods = AttrGoods::get()->toArray();
        $attr = Attr::join('attr_goods','attr.attr_id','=','attr_goods.attr_id')->get()->toArray();
        $goods = ShopGoods::join('attr_goods','shop_goods.goods_id','=','attr_goods.goods_id')->get()->toArray();
        dd($goods);
    }
}
