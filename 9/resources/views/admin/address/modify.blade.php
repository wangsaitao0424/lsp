@extends('admin/layouts.index')
@section('content')
<title>省市区三级联动</title>

<script type="text/javascript" src="{{url('/js/jquery.js')}}"></script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/Popt.js"></script>
<script type="text/javascript" src="/js/city.json.js"></script>
<script type="text/javascript" src="/js/citySet.js"></script>

<style type="text/css">
* { -ms-word-wrap: break-word; word-wrap: break-word; }
html { -webkit-text-size-adjust: none; text-size-adjust: none; }
html, body {height:99%;width:99%; }
.wrap{width:464px;height:34px;margin:20px auto;border:0;position:relative;}
.input{position:absolute;top:0;left:0;width:457px;margin:0;padding-left:5px;height:30px;line-height:30px;font-size:12px;border:1px solid #c9cacb;}
s{position:absolute;top:1px;right:0;width:32px;height:32px;background:url("images/arrow.png") no-repeat;}
._citys { width: 450px; display: inline-block; border: 2px solid #eee; padding: 5px; position: relative; }
._citys span { color: #05920a; height: 15px; width: 15px; line-height: 15px; text-align: center; border-radius: 3px; position: absolute; right: 10px; top: 10px; border: 1px solid #05920a; cursor: pointer; }
._citys0 { width: 95%; height: 34px; line-height: 34px; display: inline-block; border-bottom: 2px solid #05920a; padding: 0px 5px; font-size:14px; font-weight:bold; margin-left:6px; }
._citys0 li { display: inline-block; line-height: 34px; font-size: 15px; color: #888; width: 80px; text-align: center; cursor: pointer; }
._citys1 { width: 100%; display: inline-block; padding: 10px 0; }
._citys1 a { width: 83px; height: 35px; display: inline-block; background-color: #f5f5f5; color: #666; margin-left: 6px; margin-top: 3px; line-height: 35px; text-align: center; cursor: pointer; font-size: 12px; border-radius: 5px; overflow: hidden; }
._citys1 a:hover { color: #fff; background-color: #05920a; }
.AreaS { background-color: #05920a !important; color: #fff !important; }
</style>

</head>
<body>

<center>
    <br>收货人：

    <input type="text" name="user_name" id="user_name">
    <br><br>
    电话：
    <input type="text" name="user_tel" id="user_tel">
</center>
<div class="wrap">
	<input class="input" name="city" id="city" type="text" placeholder="请选择地理位置。。。" autocomplete="off" readonly="true">
	<s></s>
</div>
<center>
    邮编：
<input type="text" name="add_youbian" id="add_youbian"><br><br>
<button type="button" id="btn" class="layui-btn layui-btn-lg">修改</button>
</center>
<script type="text/javascript">
$("#city").click(function (e) {
	SelCity(this,e);
});
$("s").click(function (e) {
	SelCity(document.getElementById("city"),e);
});
</script>

</body>
</html>

<script>
    $(document).ready(function(){
        $('#btn').click(function(){
            // alert(1111)

            var data = {} ;
            var user_name = $('#user_name').val();
            var user_tel = $('#user_tel').val();
            var city = $('#city').val();
            var add_youbian = $('#add_youbian').val();
            var url = "http://www.wangsaitao.com/admin/modify_do";
            // alert(user_name);alert(user_tel);alert(city);alert(add_youbian);
            
            data.user_name = user_name;
            data.user_tel = user_tel;
            data.city = city;
            data.add_youbian = add_youbian;

            $.ajax({
                url:url,
                data:data,
                type:'post',
                datatype:'json',
                // jsonp : "jsonpCallback",
                // jsonpCallback:"success_jsonpCallback", 
                success:function(res){
                    if(res.code==200){
                        alert(res.msg);
                        location.href="/admin/address_list";
                    }else{
                        alert(res.msg);
                        location.href="/admin/address_list";
                    }
                }
                                            
            })
        })
    })
</script>
@endsection 