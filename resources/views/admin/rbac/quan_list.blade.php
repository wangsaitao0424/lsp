@extends('admin/layouts.index')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>权限展示</legend>
    </fieldset>
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
    <div>
        <h4><a href="/admin/rbac/quan_add">权限添加</a></h4>
    </div><br>
    {{--    <script src="/css/page2.css"></script>--}}
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="150">
{{--                <col>--}}
            </colgroup>
            <thead>
            <tr>
                <th>权限id</th>
                <th>权限名称</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($data as $v)
                <tbody>
                <tr align="center">
                    <td>{{$v->q_id}}</td>
                    <td>{{$v->q_name}}</td>
                    <td>{{date('Y-m-d',$v->q_time)}}</td>
                    <td>
                        <a href="/admin/rbac/quan_del/{{$v->q_id}}">删除  </a>
                        <a href=""></a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <div class="pull-right">
        {{ $data -> links() }}
    </div>
@endsection