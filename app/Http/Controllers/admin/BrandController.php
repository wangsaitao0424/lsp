<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ShopBrand;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Model\ShopGoods;
use App\Model\GoodsPar;
use App\Model\Discounts;
class BrandController extends Controller
{
    /**
     * 一级菜单视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop_brand_add()
    {
        return view('/admin/brand/shop_brand_add');
    }

    /**
     * 一级菜单添加执行
     */
    public function shop_brand_do()
    {
        $arr=$_REQUEST;
        $data=[
            'shop_name'=>$arr['shop_name'],
            'is_show'=>$arr['is_show'],
            'shop_weight'=>$arr['shop_weight'],
            'shop_time'=>time(),
        ];
        $res=ShopBrand::create($data);
       // $res=DB::insert('INSERT INTO shop_brand ("shop_name","is_show","shop_weight","shop_time")VALUE ($arr["shop_name"],$arr["is_show"],$arr["shop_weight"],time())');
       // DB::insert('insert into test (id, name, email, password) values (?, ?, ? , ? )',[1, 'Laravel','laravel@test.com','Laravel']);
//        $shop_name =$arr['shop_name'];
//        $is_show   = $arr['is_show'];
//        $weight    = $arr['shop_weight'];
//        $time = time();
//        $sql = "INSERT INTO shop_brand SET shop_name='{$shop_name}',is_show=$is_show,shop_weight=$weight,shop_time=$time";
//        DB::insert($sql);
//        exit;
        //dd($res);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * 一级菜单展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop_brand_list()
    {
        $list=ShopBrand::paginate(3);
//        var_dump($list);
        return view('admin.brand.shop_brand_list',['list'=>$list]);
    }

    /**
     * 一级菜单修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop_brand_update()
    {
        $shop_id=$_REQUEST['shop_id'];
        $info=ShopBrand::where(['shop_id'=>$shop_id])->first();
//        dd($info);
        return view('admin.brand.shop_brand_update',['info'=>$info]);
    }

    /**
     * 修改执行
     */
    public function shop_brand_update_do()
    {
        $arr=$_REQUEST;
//        dd($arr);
        $data=[
            'shop_name'=>$arr['shop_name'],
            'is_show'=>$arr['is_show'],
            'shop_weight'=>$arr['shop_weight'],
            'shop_time'=>time(),
        ];
        $res=ShopBrand::where(['shop_id'=>$arr['shop_id']])->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /**
     * 一级菜单删除
     * @return int
     */
    public function shop_brand_del()
    {
        $shop_id=$_REQUEST['shop_id'];
        $shop_goods=ShopGoods::where(['shop_id'=>$shop_id])->first();
        if($shop_goods){
          echo "3";
          die;
        }
        $res=ShopBrand::where(['shop_id'=>$shop_id])->update(['shop_del'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 恢复删除
     * @return int
     */
    public function shop_brand_shof()
    {
        $shop_id=$_REQUEST['shop_id'];
        $res=ShopBrand::where(['shop_id'=>$shop_id])->update(['shop_del'=>1]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 商品视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shop_goods_add()
    {
        $shop=ShopBrand::get();
        return view('admin.goods.shop_goods_add',['shop'=>$shop]);
    }

    /**
     *商品添加
     */
    public function shop_goods_do()
    {
        $arr=$_REQUEST;
        $data=[
            'goods_name'=>$arr['goods_name'],
            'goods_price'=>$arr['goods_price'],
            'goods_img'=>$arr['goods_img'],
            'goods_num'=>$arr['goods_num'],
            'goods_weight'=>$arr['goods_weight'],
            'shop_id'=>$arr['shop_id'],
            'is_show'=>$arr['is_show'],
            'goods_time'=>time(),
        ];
        $res=ShopGoods::create($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * 商品展示
     */
    public function shop_goods_list()
    {
        $list=ShopGoods::join('shop_brand', 'shop_goods.shop_id', '=', 'shop_brand.shop_id')->paginate(3);
        return view('admin.goods.shop_goods_list',['list'=>$list]);
    }

    /**
     * 商品删除
     * @return int
     */
    public function shop_goods_del()
    {
        $goods_id=$_REQUEST['goods_id'];
        $goods_par=GoodsPar::where(['goods_id'=>$goods_id])->first();
        if($goods_par){
            echo "3";
            die;
        }
        $res=ShopGoods::where(['goods_id'=>$goods_id])->update(['goods_del'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 恢复删除
     * @return int
     */
    public function shop_goods_shof()
    {
        $goods_id=$_REQUEST['goods_id'];
        $res=ShopGoods::where(['goods_id'=>$goods_id])->update(['goods_del'=>1]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 商品详情视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goods_par_add()
    {
        $goods=ShopGoods::get();
//        dd($goods);
        return view('admin.par.goods_par_add',['goods'=>$goods]);
    }

    /**
     * 详情添加执行
     */
    public function goods_par_do()
    {
        $arr=$_REQUEST;
//        dd($arr);
        $data=[
            'goods_id'=>$arr['goods_id'],
            'par_content'=>$arr['par_content'],
            'par_time'=>time(),
        ];
//        dd($data);
        $res=GoodsPar::create($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * 详情展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function goods_par_list()
    {
        $list=GoodsPar::join('shop_goods','goods_par.goods_id','=','shop_goods.goods_id')->paginate(1);
        return  view('admin.par.goods_par_list',['list'=>$list]);
    }

    /**
     * 详情删除
     * @return int
     */
    public function goods_par_del()
    {
        $par_id=$_REQUEST['par_id'];
        $res=GoodsPar::where(['par_id'=>$par_id])->update(['par_del'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 恢复
     * @return int
     */
    public function goods_par_shof()
    {
        $par_id=$_REQUEST['par_id'];
        $res=GoodsPar::where(['par_id'=>$par_id])->update(['par_del'=>1]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 优惠劵添加视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function discounts_add()
    {
        $goods=ShopGoods::get();
        return view('admin.discounts.discounts_add',['goods'=>$goods]);
    }

    /**
     * 优惠劵展示
     */
    public function discounts_do()
    {
        $arr=$_REQUEST;
//        dd($arr);
        $data=[
            'goods_id'=>$arr['goods_id'],
            'dis_money'=>$arr['dis_money'],
            'dis_num'=>$arr['dis_num'],
            'is_show'=>$arr['is_show'],
            'dis_weight'=>$arr['dis_weight'],
            'dis_time'=>time(),
        ];
//        dd($data);
        $res=Discounts::create($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    /**
     * 优惠劵展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function discounts_list()
    {
        $list=Discounts::join('shop_goods','discounts.goods_id','=','shop_goods.goods_id')->paginate(3);
        return  view('admin.discounts.discounts_list',['list'=>$list]);
    }

    /**
     * 优惠劵修改
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function discounts_update()
    {
        $dis_id=$_REQUEST['dis_id'];
        $goods=ShopGoods::get();
        $info=Discounts::where(['dis_id'=>$dis_id])->first();
        return view('admin.discounts.discounts_update',['info'=>$info,'goods'=>$goods]);
    }

    /**
     * 修改执行
     */
    public function discounts_update_do()
    {
        $arr=$_REQUEST;
//        dd($arr);
        $data=[
            'goods_id'=>$arr['goods_id'],
            'dis_money'=>$arr['dis_money'],
            'dis_num'=>$arr['dis_num'],
            'is_show'=>$arr['is_show'],
            'dis_weight'=>$arr['dis_weight'],
            'dis_time'=>time(),
        ];
        $res=Discounts::where(['dis_id'=>$arr['dis_id']])->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    /**
     * 优惠劵删除
     * @return int
     */
    public function discounts_del()
    {
        $dis_id=$_REQUEST['dis_id'];
        $res=Discounts::where(['dis_id'=>$dis_id])->update(['dis_del'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * 优惠劵恢复
     * @return int
     */
    public function discounts_shof()
    {
        $dis_id=$_REQUEST['dis_id'];
        $res=Discounts::where(['dis_id'=>$dis_id])->update(['dis_del'=>1]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }
    /**
     * uploadify 上传图片
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $requestobj=$request->file("Filedata");//资源对象
        $ext=$requestobj->getClientOriginalExtension();//扩展名
        $path=$requestobj->getRealPath();//源路径
        $filename=date("YmdHis",time()).'.'.$ext;//新名字
        $st=Storage::disk('public')->put('/brand/'.$filename,file_get_contents($path));
        $newPath="uploads/brand/$filename";
        echo $newPath;
    }
}
