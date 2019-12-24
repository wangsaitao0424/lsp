@extends('admin/layouts.index')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>权限展示</legend>
    </fieldset>
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