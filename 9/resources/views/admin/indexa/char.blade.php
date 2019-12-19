@extends('admin/layouts.index')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Document</title>
   <link rel="stylesheet" href="{{asset('uploadify/uploadify.css')}}">
      <script src="{{asset('/admin/jquery.js')}}"></script>
   <script src="{{asset('uploadify/jquery.uploadify.js')}}"></script>
</head>
<body>
<form class="layui-form">


  <div class="layui-form-item">
    <label class="layui-form-label" >上传文件</label>
    <div class="layui-input-block" id="uploadify" name=ch_img >
     <input name="ch_img" type="file" id="file" class="" />

    <input type="file">
     </div>
     <div id="show_img"></div>
  </div>
   <div class="layui-form-item" pane="">
    <label class="layui-form-label">开关-开</label>
    <div class="layui-input-block">
      <input type="checkbox"  lay-skin="switch" lay-filter="switchTest" title="开关" >
    </div>
  </div>
 
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo" id="btn">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>

 </body>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>
<script>
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
             $("#uploadify").uploadify({
            'swf':'/uploadify/uploadify.swf',
            'uploader':'/up',
            'onUploadSuccess':function(data,msg,info){
            // $("input[name='ch_img']").val(msg);
            let img="<img src='http://www.laravel2.com/"+msg+"' alt='waht' style='width: 200px;height: 200px'> <input type='hidden' name='images' value='"+msg+"'>";
               $("#show_img").append(img);
     
            }
         })
          

$("#btn").on("click",function(){
   var data={};
   var ch_img=$("input[name='images']").val();
   
   data.ch_img=ch_img;
   $.ajax({
       data:data,
       type:'post',
       url:'char_do',
       success:function(res){

      }
    });
 });

});
</script>
@endsection