@extends('admin/layouts.index')
@section('content')
<body>
<style type="text/css">
        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
    <center>
        <table class="layui-table" border=1>
            <tr>
                <td>编号</td>
                <td>收货人</td>
                <td>电话</td>
                <td>地址</td>
                <td>邮编</td>
                <td>时间</td>
                <td>操作</td>
            </tr>
            @foreach($data as $k => $v)
            <tr>
                <td>{{$v['add_id']}}</td>
                <td>{{$v['user_name']}}</td>
                <td>{{$v['user_tel']}}</td>
                <td>{{$v['city']}}</td>
                <td>{{$v['add_youbian']}}</td>
                <td>{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
                <td>
                    <a class="layui-btn" href="/admin/add_del/{{$v['add_id']}}">删除</a>
                    <a class="layui-btn layui-btn-danger" href="/admin/modify/{{$v['add_id']}}">修改</a>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="pull-right">
            {{ $data -> links() }}
        </div>

    </center>
</body>

@endsection 