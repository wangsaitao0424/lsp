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
        <label class="layui-form-label">属性</label>
        <div class="layui-input-block">
            <select name="attr_id">
                <option >请选择</option>
                @foreach($attr as $v)
                    <option value="{{$v['attr_id']}}">{{$v['attr_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商品</label>
        <div class="layui-input-block">
            <select name="goods_id">
                <option >请选择</option>
                @foreach($goods as $v)
                    <option value="{{$v['goods_id']}}">{{$v['goods_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">权重</label>
            <div class="layui-input-block">
                <input type="number" name="attr_goods_weight" lay-verify="title" autocomplete="off" placeholder="请输入权重" class="layui-input">
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
                let attr_id=$("select[name='attr_id']").val();
                if(!attr_id){
                    alert('不能为空');return;
                }
                let goods_id=$("select[name='goods_id']").val();
                if(!goods_id){
                    alert('不能为空');return;
                }

                let attr_goods_weight=$("input[name='attr_goods_weight']").val();
                if(!attr_goods_weight){
                    alert('不能为空');return;
                }
                data={
                    'goods_id':goods_id,
                    'attr_id':attr_id,
                    'attr_goods_weight':attr_goods_weight,
                };
                let url="{{url('admin/attr_goods_do')}}";
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