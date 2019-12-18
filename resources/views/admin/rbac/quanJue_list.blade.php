@extends('admin/layouts.index')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>用户角色关系展示</legend>
    </fieldset>
    <div>
        <h4><a href="/admin/rbac/quanJue_add">用户角色关系添加</a></h4>
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
                <th>权限角色id</th>
                <th>角色名称</th>
                <th>角色权限</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($data as $v)
                <tbody>
                <tr align="center">
                    <td>{{$v->qj_id}}</td>
                    <td>{{$v->j_name}}</td>
                    <td>{{$v->q_name}}</td>
                    <td>{{date('Y-m-d',$v->qj_time)}}</td>
                    <td>
                        <a href="/admin/rbac/quanJue_del/{{$v->qj_id}}">删除  </a>
                        <a href=""></a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection