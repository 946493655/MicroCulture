@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <h3 class="center pos">{{ $lists['func']['name'] }}详情页</h3>
        <table class="table_create" cellspacing="0" cellpadding="0">
            <tr>
                <td class="field_name">名称：</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td class="field_name">类型：</td>
                <td>{{ $data->genre() }}</td>
            </tr>
            <tr>
                <td class="field_name">内容：</td>
                <td><div class="admin_show_con">{!! $data->intro !!}</div></td>
            </tr>
            <tr>
                <td class="field_name">排序：</td>
                <td>{{ $data->sort }}</td>
            </tr>
            <tr>
                <td class="field_name">企业前台显示否：</td>
                <td>{{ $data->isshow() }}</td>
            </tr>
            <tr>
                <td class="field_name">创建时间：</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            <tr>
                <td class="field_name">更新时间：</td>
                <td>{{ $data->updated_at=='0000-00-00 00:00:00' ? '未更新' : $data->updated_at }}</td>
            </tr>

            <tr><td class="center" colspan="3" style="border:0;cursor:pointer;">
                    <a href="/company/admin/intro/{{$data->id}}/edit">
                        <button class="companybtn">修&nbsp;&nbsp;改</button></a>
                    <a><button class="companybtn" onclick="history.go(-1)">返&nbsp;&nbsp;回</button></a>
                </td></tr>
        </table>
    </div>
@stop
