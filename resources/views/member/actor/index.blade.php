@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <div class="mem_create" style="margin:20px 0;"><a href="/member/actor/create">添加演员</a></div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>演员名称</td>
                <td>性别</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="/member/actor/{{$data->id}}">{{ $data->name }}</a></td>
                <td>{{ $data->sex }}</td>
                <td>{{ $data->created_at }}</td>
                <td>
                    <a href="/member/actor/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="/member/actor/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    <a href="/member/actor/{{ $data->id }}/destroy" class="list_btn">删除</a>
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop