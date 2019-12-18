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

    </style>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>添加</legend>
    </fieldset>
    <div class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">一级菜单名称</label>
            <div class="layui-input-block">
                <input type="text" name="shop_name" lay-verify="title" autocomplete="off" placeholder="请输入一级菜单名称" class="layui-input">
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
                    <input type="number" name="shop_weight" lay-verify="title" autocomplete="off" placeholder="请输入权重" class="layui-input">
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
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".layui-btn").on('click',function () {
                let shop_name=$("input[name='shop_name']").val();
                if(!shop_name){
                    alert('不能为空');return;
                }
                let is_show=$("input[type='radio']:checked").val();
                if(!is_show){
                    alert('不能为空');return;
                }
                let shop_weight=$("input[name='shop_weight']").val();
                if(!shop_weight){
                    alert('不能为空');return;
                }
                data={
                    'shop_name':shop_name,
                    'is_show':is_show,
                    'shop_weight':shop_weight,
                };
                let url="{{url('admin/shop_brand_do')}}";
                $.ajax({
                    data:data,
                    dataType: "json",
                    type: "post",
                    // jsonp:"callback",
                    url: url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("添加成功");
                            window.location.href="{{url('admin/shop_brand_list')}}"
                        }else{
                            alert("添加失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection