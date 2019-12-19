@extends('admin/layouts.index')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>广告展示</legend>
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
{{--    <script src="/css/page2.css"></script>--}}
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>广告顺序</th>
                <th>广告标题</th>
                <th>广告地址</th>
                <th>广告内容</th>
                <th>是否展示</th>
                <th>广告图片</th>
                <th>是否删除</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($adverData as $v)
            <tbody>
            <tr align="center">
                <td>{{$v->ad_id}}</td>
                <td>{{$v->ad_title}}</td>h
                <td>{{$v->ad_url}}</td>
                <td>{{$v->ad_content}}</td>
                <td style="color: #0b0b0b">
                    @if($v->is_show == 1)
                        √
                    @elseif($v->is_show == 2)
                        ×
                    @endif
                </td>
                <td><img src="{{$v->ad_img}}" style="width: 60px;height: 70px;"></td>
                <td>
                    @if($v['is_del'] == 1)
                        未删除
                    @else
                        <a class="layui-btn sh" href="{{url('/admin/adver/adver_delInfo?ad_id='.$v['ad_id'])}}">
                            点击恢复该条数据
                        </a>
                    @endif
                </td>
                <td>{{date('Y-m-d',$v->ad_time)}}</td>
                <td>
                    <a class="layui-btn sh" href="{{url('/admin/adver/adver_del?ad_id='.$v['ad_id'])}}">删除  </a>
                    <a href=""></a>
                </td>
            </tr>
            </tbody>
            @endforeach
        </table>
        <div class="pull-right">
            {{ $adverData -> links() }}
        </div>
    </div>
@endsection