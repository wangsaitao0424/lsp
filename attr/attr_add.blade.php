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

    <div class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">属性名称</label>
            <div class="layui-input-block">
                <input type="text" name="attr_name" lay-verify="title" autocomplete="off" placeholder="请输入名称" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">权重</label>
            <div class="layui-input-block">
                <input type="number" name="attr_weight" lay-verify="title" autocomplete="off" placeholder="请输入权重" class="layui-input">
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
            $(".layui-btn").on('click',function () {
                let attr_name=$("input[name='attr_name']").val();
                if(!attr_name){
                    alert('不能为空');return;
                }
                let attr_weight=$("input[name='attr_weight']").val();
                if(!attr_weight){
                    alert('不能为空');return;
                }
                data={
                    'attr_name':attr_name,
                    'attr_weight':attr_weight,
                };
                let url="{{url('admin/attr_do')}}";
                $.ajax({
                    data:data,
                    dataType: "json",
                    type: "post",
                    // jsonp:"callback",
                    url: url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("添加成功");
                            window.location.href="{{url('admin/attr_list')}}"
                        }else{
                            alert("添加失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection