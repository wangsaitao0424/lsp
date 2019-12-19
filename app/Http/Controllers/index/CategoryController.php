<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopBrand;

class CategoryController extends Controller
{
    // 分类
    public function category_ad(Request $request)
    {
        $catData = ShopBrand::where(['is_show'=>1])->where(['shop_del'=>1])->orderBy('shop_id','DESC')->get();
        return json_encode($catData);
    }

    // 注册
    public function register_do(Request $request)
    {
        $req = $request->all();
        dd($req);
    }
}
