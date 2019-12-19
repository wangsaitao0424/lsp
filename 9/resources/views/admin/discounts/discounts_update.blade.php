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
        <input type="hidden" name="dis_id" value="{{$info['dis_id']}}">
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-block">
            <select name="goods_id">
                @foreach($goods as $v)
                    @if($info['goods_id'] == $v['goods_id'])
                    <option value="{{$info['goods_id']}}" selected>{{$info['goods_name']}}</option>
                    @endif
                    <option value="{{$v['goods_id']}}" selected>{{$v['goods_name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">优惠价格</label>
            <div class="layui-input-block">
                <input type="number" name="dis_money" lay-verify="title" autocomplete="off" placeholder="请输入价格" class="layui-input" value="{{$info['dis_money']}}">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">优惠数量</label>
            <div class="layui-input-block">
                <input type="number" name="dis_num" lay-verify="title" autocomplete="off" placeholder="请输入价格" class="layui-input" value="{{$info['dis_num']}}">
            </div>
        </div>

        <label class="layui-form-label">是否显示</label>
        @if($info['is_show'] == 1)
        <div>
            是<input type="radio" name="is_show" class="gcs-radio" id="男"  value="1" checked/>
            <label for="男"></label>
            否<input type="radio" name="is_show" class="gcs-radio" id="女" value="2" />
            <label for="女"></label>
        </div>
        @else
            <div>
                是<input type="radio" name="is_show" class="gcs-radio" id="男"  value="1"/>
                <label for="男"></label>
                否<input type="radio" name="is_show" class="gcs-radio" id="女" value="2" checked/>
                <label for="女"></label>
            </div>
        @endif
        <hr />
        <div class="layui-form-item">
            <label class="layui-form-label">权重</label>
            <div class="layui-input-block">
                <input type="number" name="dis_weight" lay-verify="title" autocomplete="off" placeholder="请输入权重" class="layui-input" value="{{$info['dis_weight']}}">
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
                let dis_id=$("input[name='dis_id']").val();
                let goods_id=$("select[name='goods_id']").val();
                if(!goods_id){
                    alert('不能为空');return;
                }
                let dis_money=$("input[name='dis_money']").val();
                if(!dis_money){
                    alert('不能为空');return;
                }
                let dis_num=$("input[name='dis_num']").val();
                if(!dis_num){
                    alert('不能为空');return;
                }
                let is_show=$("input[type='radio']:checked").val();
                if(!is_show){
                    alert('不能为空');return;
                }
                let dis_weight=$("input[name='dis_weight']").val();
                if(!dis_weight){
                    alert('不能为空');return;
                }
                data={
                    'dis_id':dis_id,
                    'goods_id':goods_id,
                    'dis_money':dis_money,
                    'dis_num':dis_num,
                    'is_show':is_show,
                    'dis_weight':dis_weight,
                };
                let url="{{url('admin/discounts_update_do')}}";
                $.ajax({
                    data:data,
                    dataType: "json",
                    type: "post",
                    // jsonp:"callback",
                    url: url,
                    success:function (msg) {
                        if(msg == 1){
                            alert("修改成功");
                            window.location.href="{{url('admin/discounts_list')}}"
                        }else{
                            alert("修改失败");
                        }
                    }
                })
            })
        })
    </script>
@endsection