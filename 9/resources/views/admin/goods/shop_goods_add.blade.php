@extends('admin/layouts.index')
@section('content')
    <style>
        /*单选按钮*/
        .gcs-radio {
            display: none;
        }
        .gcs-radio+label {
            width: 20px;
            height: 20px;
            line-height: 20px;
            display: inline-block;
            text-align: center;
            vertical-align: bottom;
            border: 1px solid gray;
            border-radius: 50%;
        }
        .gcs-radio+label:hover {
            border: 1px solid #2783FB;
            cursor: pointer;
        }
        .gcs-radio:checked+label {
            background: #2783FB;
            border: 1px solid #2783FB;
        }
        .gcs-radio:checked+label:after {
            content: "\2022";
            font-size: 35px;
            color: white;
        }
        select{
            width:100%;
            height:30px;
            appearance:none;
            -moz-appearance:none;
            -webkit-appearance:none;
            background: white no-repeat right center;
            font-size:16px;
            font-family:Microsoft YaHei;
            color:#0C0C0C;
        }
    </style>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加</legend>
    </fieldset>
    <div class="layui-form-item">
        <label class="layui-form-label">一级菜单</label>
        <div class="layui-input-block">
            <select name="shop_id">
                <option >请选择</option>
                @foreach($shop as $v)
                <option value="{{$v['shop_id']}}">{{$v['shop_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-block">
                <input type="text" name="goods_name" lay-verify="title" autocomplete="off" placeholder="请输入名称" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品价格</label>
            <div class="layui-input-block">
                <input type="number" name="goods_price" lay-verify="title" autocomplete="off" placeholder="请输入价格" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">图片 :</label>
            <div class="layui-input-block">
                <input type="file" id="uploadify" />
                <div id="show_img"></div>
                <div class="error-msg"></div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">商品库存</label>
            <div class="layui-input-block">
                <input type="number" name="goods_num" lay-verify="title" autocomplete="off" placeholder="请输入价格" class="layui-input">
            </div>
        </div>

        <label class="layui-form-label">是否显示</label>
        <div>
            是<input type="radio" name="is_show" class="gcs-radio" id="男"  value="1"/>
            <label for="男"></label>
            否<input type="radio" name="is_show" class="gcs-radio" id="女" value="2" />
            <label for="女"></label>
        </div>
        <hr />
        <div class="layui-form-item">
            <label class="layui-form-label">权重</label>
            <div class="layui-input-block">
                <input type="number" name="goods_weight" lay-verify="title" autocomplete="off" placeholder="请输入权重" class="layui-input">
            </div>
        </div>



        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                {{--<button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
            </div>
        </div>
    </div>
    <script src="{{asset('/admin/jquery.js')}}"></script>
    <script src="{{asset('/uploadify/jquery.uploadify.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/uploadify/uploadify.css')}}">
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#uploadify").uploadify({
                'swf':"/uploadify/uploadify.swf",
                'uploader':'/admin/upload',
                'onUploadSuccess':function (file,msg,data) {
                    let img="<img src='http://www.wangsaitao.com/"+msg+"' alt='waht' style='width: 100px;height: 100px'> <input type='hidden' name='goods_img' value='"+msg+"'>";
                    $("#show_img").append(img);
                }
            });
            $(".layui-btn").on('click',function () {
                let shop_id=$("select[name='shop_id']").val();
                if(!shop_id){
                    alert('不能为空');return;
                }
                let goods_name=$("input[name='goods_name']").val();
                if(!goods_name){
                    alert('不能为空');return;
                }
                let goods_price=$("input[name='goods_price']").val();
                if(!goods_price){
                    alert('不能为空');return;
                }
                let goods_img=$("input[name='goods_img']").val();
                // alert(goods_img);
                // if(!goods_img){
                //     alert('不能为空');return;
                // }
                let goods_num=$("input[name='goods_num']").val();
                if(!goods_num){
                    alert('不能为空');return;
                }
                let is_show=$("input[type='radio']:checked").val();
                if(!is_show){
                    alert('不能为空');return;
                }
                let goods_weight=$("input[name='goods_weight']").val();
                if(!goods_weight){
                    alert('不能为空');return;
                }
                data={
                    'goods_name':goods_name,
                    'goods_price':goods_price,
                    'goods_img':goods_img,
                    'goods_num':goods_num,
                    'shop_id':shop_id,
                    'is_show':is_show,
                    'goods_weight':goods_weight,
                };
                let url="{{url('admin/shop_goods_do')}}";
                $.ajax({
                    data:data,
                    dataType: "json",
                    type: "post",
                    // jsonp:"callback",
                    url: url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("添加成功");
                            window.location.href="{{url('admin/shop_goods_list')}}"
                        }else{
                            alert("添加失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection