@extends('admin/layouts.index')
@section('content')
    <meta charset="utf-8">
    <title>Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="{{asset('/admin/jquery.js')}}"></script>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>Rbac—角色添加</legend>
    </fieldset>
    <div>
        <h4><a href="/admin/rbac/jue_list">角色展示</a></h4>
    </div><br>
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">角色添加</label>
    <div class="layui-input-block">
        <input type="text" name="j_name" lay-verify="required" lay-reqtext="广告标题是必填项，岂能为空？" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="button" id="btn" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</div>
    <script>
        $(document).ready(function(){
           $("#btn").click(function(){
               var j_name = $("[name='j_name']").val();
               $.ajax({
                  url:"/admin/rbac/jue_addDo",
                   type:"POST",
                   dataType:'json',
                   data:{j_name:j_name},
                   success:function(res){
                       if(res.code==200){
                           alert(res.msg);
                           location.href='/admin/rbac/jue_list';
                       }else{
                           alert(res.msg);
                           location.href='/admin/rbac/jue_add';
                       }
                   }
               });
           })
        });
    </script>
@endsection