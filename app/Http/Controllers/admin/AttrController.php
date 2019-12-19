<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Attr;
use App\Model\ShopGoods;
use App\Model\AttrGoods;
class AttrController extends Controller
{
    /**
     * 属性添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function attr_add()
    {
        return view('admin.attr.attr_add');
    }

    /**
     * 属性添加执行
     */
    public function attr_do()
    {
        $arr=$_REQUEST;
        $data=[
            'attr_name'=>$arr['attr_name'],
            'attr_weight'=>$arr['attr_weight'],
            'attr_time'=>time(),
        ];
        $res=Attr::create($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * 属性展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function attr_list()
    {
        $list=Attr::paginate(3);
        return view('admin.attr.attr_list',['list'=>$list]);
    }
    /**
     * 属性商品添加视图
     */
    public function attr_goods_add()
    {
        $attr=Attr::get();
        $goods=ShopGoods::get();
        return view('admin.attr.attr_goods',['attr'=>$attr,'goods'=>$goods]);
    }
    /**
     * 属性添加执行
     */
    public function attr_goods_do()
    {
        $arr=$_REQUEST;
        $data=[
            'attr_id'=>$arr['attr_id'],
            'goods_id'=>$arr['goods_id'],
            'attr_goods_weight'=>$arr['attr_goods_weight'],
            'attr_goods_time'=>time(),
        ];
        $res=AttrGoods::create($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /**
     * 属性展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function attr_goods_list()
    {
        $list=AttrGoods::join('attr','attr.attr_id','=','attr_goods.attr_id')
            ->join('shop_goods','shop_goods.goods_id','=','attr_goods.goods_id')
            ->paginate();
        return view('admin.attr.attr_goods_list',['list'=>$list]);
    }
}
