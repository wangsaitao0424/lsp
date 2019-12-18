@extends('admin/layouts.index')
@section('content')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">

</head>
<body><br/><br/>
<table>
 <tr><td><div class="layui-form-item">
    <label class="layui-form-label">用户编号</label>
    <div class="layui-input-inline">
      <select name="quiz1" name="userid">
        <option value="">请选择</option>
        <option value=""></option>
      </select>
    </div>
  </div></td></tr>
<tr><td><div class="layui-form-item">
    <label class="layui-form-label">文本标题</label>
    <div class="layui-input-inline">
      <input type="text" name="" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div></td></tr>
  <tr><td><div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea placeholder="请输入内容" class="layui-textarea" name="desc"></textarea>
    </div>
  </div></td></tr>
  <tr><td><div>
    <button type="button" class="layui-btn layui-btn-warm" id="btn">提交</button>
  </div></td></tr>
  </table>
</body>
 <script src="{{asset('/admin/jquery.js')}}"></script>
 <script>
$("#btn").on("click",function(){
	var data={};
	var 
})
 </script>
@endsection