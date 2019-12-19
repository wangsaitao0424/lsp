@extends('admin/layouts.index')
@section('content')
    <meta charset="utf-8">
    <title>Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="{{asset('/admin/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('uploadify/uploadify.css')}}">
    <script src="{{asset('uploadify/jquery.uploadify.js')}}"></script>
{{--    <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">--}}
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
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
    <legend>广告模块添加</legend>
</fieldset>
    <div class="layui-form-item">
        <label class="layui-form-label">广告标题</label>
        <div class="layui-input-block">
            <input type="text" name="ad_title" lay-verify="required" lay-reqtext="广告标题是必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">跳转路径</label>
        <div class="layui-input-block">
            <input type="text" name="ad_url" lay-verify="required" lay-reqtext="广告标题是必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>

    <label class="layui-form-label">是否显示</label>
    <div>
        是<input type="radio" name="is_show" value="1" class="gcs-radio" id="是" />
        <label for="是"></label>
        否<input type="radio" name="is_show" value="2" class="gcs-radio" id="否" />
        <label for="否"></label>
    </div>
{{--    <hr />--}}

    <div class="layui-form-item">
        <label class="layui-form-label">广告图片</label>
        <div class="layui-input-block">
            <input type="file" name="ad_img" id="uploadify">
            <input type="hidden" name="ad_img" id="file">
        </div>
    </div>

    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">广告内容</label>
        <div class="layui-input-block">
            <textarea name="ad_content" placeholder="请输入内容"  class="layui-textarea"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" id="btn" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
<script>
    $(document).ready(function () {
        // alert(111);return;
        $("#btn").click(function(){
            var data = {};
            var ad_title = $("[name='ad_title']").val();
            var ad_url = $("[name='ad_url']").val();
            // var is_show = $("[name='is_show']").val();
            var is_show=$("input[type='radio']:checked").val();
            var ad_img = $("[name='ad_img']").val();
            var ad_content = $("[name='ad_content']").val();
            data.ad_title = ad_title;
            data.ad_url = ad_url;
            data.is_show = is_show;
            data.ad_img = ad_img;
            data.ad_content = ad_content;
            // console.log(is_show);
            $.ajax({
                url:"/admin/adver/adver_addDo",
                type:'POST',
                data:data,
                dataType:"json",
                success:function(res){
                    if(res.code==200){
                        alert(res.msg);
                        location.href='/admin/adver/adver_list';
                    }else{
                        alert(res.msg);
                        location.href='/admin/adver/adver_list';
                    }
                }
            });

        });

        {{--$("#uploadify").uploadify({--}}
        {{--    'swf':"{{asset('uploadify/uploadify.swf')}}",--}}
        {{--    'uploader':'{{url('/admin/upload')}}',--}}
        {{--    'onUploadSuccess':function (file,msg,data) {--}}
        {{--        // let img="<img src='http://www.laravel_app.com/"+msg+"' alt='waht' style='width: 200px;height: 200px'> <input type='hidden' name='sls_img' value='"+msg+"'>";--}}
        {{--        // $("#show_img").append(img);--}}
        {{--    }--}}
        {{--});--}}
        $("#uploadify").uploadify({
            'swf':'/uploadify/uploadify.swf',
            'uploader':'/admin/edit',
            'onUploadSuccess':function(file,data,msg){
                $('#file').val("/"+data);
            }
        })
    })

</script>
@endsection