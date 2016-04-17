@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <tbody id="tbody-alert">
                    @if(is_object($data))
                    <tr>
                        <td class="am-hide-sm-only">编号 / Id：</td>
                        <td>{{ $data->id }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">链接名称 / Link Name：</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">鼠标移动提示 / Title：</td>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">类型 / Type：</td>
                        <td>{{ $data->type_id }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">图片 / Picture：</td>
                        <td>{{ $data->pic_id }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">介绍 / Introduce：</td>
                        <td>{{ $data->intro }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">访问路径地址 / Url：</td>
                        <td>{{ $data->link }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">显示方式 / Way：</td>
                        <td>{{ $data->way }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">前台显示否 / Is Show：</td>
                        <td>{{ $data->isshow }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">父id / Parent Id：</td>
                        <td>{{ $data->pid }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">添加时间 / Create Time：</td>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="am-hide-sm-only">更新时间 / Update Time：</td>
                        <td>{{ $data->updated_at }}</td>
                    </tr>
                    @else @include('admin.common.norecord')
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop