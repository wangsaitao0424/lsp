@extends('admin/layouts.index')
@section('content')
    <meta charset="utf-8">
    <title>Layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="{{asset('/admin/jquery.js')}}"></script>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>Rbac—用户角色添加</legend>
    </fieldset>
    <div>
        <h4><a href="/admin/rbac/userJue_list">用户角色展示</a></h4>
    </div><br>
    <div class="layui-form-item">
        <label class="layui-form-label">选择用户</label>
        <div class="layui-input-block">
            <select class="layui-input" name="user_id" lay-filter="aihao">
                <option value=""></option>
                @foreach($userData as $v)
                    <option value="{{$v->user_id}}">{{$v->user_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">选择角色</label>
        <div class="layui-input-block">
            <select class="layui-input" name="j_id" lay-filter="aihao">
                <option value=""></option>
                @foreach($jueData as $v)
                    <option value="{{$v->j_id}}">{{$v->j_name}}</option>
                @endforeach
            </select>
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
               var user_id = $("[name='user_id']").val();
               var j_id = $("[name='j_id']").val();
               console.log(user_id);
               console.log(j_id);
               $.ajax({
                  url:"/admin/rbac/userJue_addDo",
                   type:"POST",
                   dataType:'json',
                   data:{user_id:user_id,j_id:j_id},
                   success:function(res){
                       if(res.code==200){
                           alert(res.msg);
                           location.href='/admin/rbac/userJue_list';
                       }else{
                           alert(res.msg);
                           location.href='/admin/rbac/userJue_add';
                       }
                   }
               });
           })
        });
    </script>
@endsection
