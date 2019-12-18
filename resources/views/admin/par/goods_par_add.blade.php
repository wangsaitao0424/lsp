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
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-block">
            <select name="goods_id">
                @foreach($goods as $v)
                    <option value="{{$v['goods_id']}}">{{$v['goods_name']}}</option>
                    @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">商品详情</label>
            <div class="layui-input-block">
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"></script>
                <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                <script id="editor" type="text/plain" name="nth_content" style="width:100%;height:350px;"></script>
                <script type="text/javascript">
                //实例化编辑器
                var ue = UE.getEditor('editor', {
                    toolbars: [
                        [
                            'undo', //撤销
                            'bold', //加粗
                            'underline', //下划线
                            'preview', //预览
                            'horizontal', //分隔线
                            'inserttitle', //插入标题
                            'cleardoc', //清空文档
                            'fontfamily', //字体
                            'fontsize', //字号
                            'paragraph', //段落格式
                            'simpleupload', //单图上传
                            'insertimage', //多图上传
                            'attachment', //附件
                            'music', //音乐
                            'inserttable', //插入表格
                            'emotion', //表情
                            'insertvideo', //视频
                            'justifyleft', //居左对齐
                            'justifyright', //居右对齐
                            'justifycenter', //居中对
                            'justifyjustify', //两端对齐
                            'forecolor', //字体颜色
                            'fullscreen', //全屏
                            'edittip ', //编辑提示
                            'customstyle', //自定义标题
                            'template', //模板
                        ]
                    ]
                });
                </script>
                <div class="error-msg"></div>
                <div class="success-msg"></div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
                let goods_id=$("select[name='goods_id']").val();
                // alert(goods_id);
                if(!goods_id){
                    alert('不能为空');return;
                }
                let par_content= UE.getEditor('editor').getContentTxt();
                if(!par_content){
                    alert("不能为空");return;
                }
                data={
                    'goods_id':goods_id,
                    'par_content':par_content
                };
                // console.log(data);return;
                let url="{{url('admin/goods_par_do')}}";
                $.ajax({
                    data:data,
                    dataType: "json",
                    type: "post",
                    // jsonp:"callback",
                    url: url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("添加成功");
                            window.location.href="{{url('admin/goods_par_list')}}"
                        }else{
                            alert("添加失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection