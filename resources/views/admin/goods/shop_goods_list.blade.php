@extends('admin/layouts.index')
@section('content')
    <style type="text/css">
        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
        <legend>展示</legend>
    </fieldset>
    <button type="button" class="layui-btn"><a href="{{url('admin/shop_goods_add')}}">增加</a></button>
    <table class="layui-table" lay-skin="line">
        <colgroup>
            <col width="150">
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>价格</th>
            <th>图片</th>
            <th>库存</th>
            <th>权重</th>
            <th>一级菜单</th>
            <th>是否已删除</th>
            <th>是否展示</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
            <tr>
                <td>{{$v['goods_id']}}</td>
                <td>{{$v['goods_name']}}</td>
                <td>{{$v['goods_price']}}</td>
                <td><img src="http://www.wangsaitao.com/{{$v['goods_img']}}" alt="此商品无图片"></td>
                <td>{{$v['goods_num']}}</td>
                <td>{{$v['goods_weight']}}</td>
                <td>{{$v['shop_name']}}</td>
                <td>@if($v['goods_del'] == 1) 未删除 @else <a class="layui-btn sh" href="{{url('admin/shop_goods_shof?goods_id='.$v['goods_id'])}}">已删除恢复该条数据</a> @endif</td>
                <td>@if($v['is_show'] == 1) √@else × @endif</td>
                <td>{{date("Y-m-d H:i:s",$v['goods_time'])}}</td>
                <td>
                    <div class="layui-btn-group">
                        {{--<a class="layui-btn" href="{{url('admin/shop_brand_update?shop_id='.$v['shop_id'])}}">编辑</a>||--}}
                        <a class="layui-btn del" href="{{url('admin/shop_goods_del?goods_id='.$v['goods_id'])}}" >删除</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        {{ $list -> links() }}
    </div>
    <script src="{{asset('/admin/jquery.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".del").click(function () {
                event.preventDefault();
                let _this = $(this);
                let url=_this.attr('href');
                // console.log(url);return;
                $.ajax({
                    url:url,
                    success:function (msg) {
                        if(msg == 1) {
                            alert("删除成功");
                            window.location.reload();
                        }else if(msg == 3){
                            alert("有物");
                        }else{
                            alert("删除失败");
                        }
                    }
                })
                // return false;
            })
            $(".sh").click(function () {
                event.preventDefault();
                let _this = $(this);
                let url=_this.attr('href');
                // console.log(url);return;
                $.ajax({
                    url:url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("恢复成功");
                            window.location.reload();
                        }else{
                            alert("恢复失败");
                        }
                    }
                })
                // return false;
            });
        })
    </script>
@endsection