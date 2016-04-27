@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/commain" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        {{--<div class="am-form-group">--}}
                            {{--<label>公司名称 / Name：</label>--}}
                            {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>--}}
                            {{--{{ $data->company()->name }}--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title"/>
                        </div>

                        <div class="am-form-group">
                            <label>网站关键字 / Keyword：</label>
                            <input type="text" name="keyword"/>
                        </div>

                        <div class="am-form-group">
                            <label>网站描述 / Description：</label>
                            <input type="text" name="description"/>
                        </div>

                        <div class="am-form-group">
                            <label>logo / Logo：</label>
                            {{--<input type="text" name="logo"/>--}}
                            <input type="text" placeholder="本地logo地址" readonly name="url_file">
                            <input type="button" value="[找图]" onclick="path.click()" class="am-btn am-btn-primary">
                            <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;" name="url_ori">
                        </div>

                        <div class="am-form-group" id="job">
                            <label>招聘岗位 / Job：(多组信息用|隔开)</label>
                            <textarea placeholder="多组信息用|隔开" name="job" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group" id="num">
                            <label>岗位人数 / Job Number：(多组信息用|隔开，必须与岗位一一对应)</label>
                            <textarea placeholder="多组信息用|隔开" name="job_num" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group" id="require">
                            <label>岗位要求 / Job Require：(多组信息用|隔开，必须与岗位一一对应)</label>
                            <textarea placeholder="多组信息用|隔开" name="job_require" cols="50" rows="5"></textarea>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var job = $("#job");
                                var num = $("#num");
                                var require = $("#require");
                                job.change(function(){
                                    if(job.val()){ num.show(); require.show(); }
                                    else { num.hide(); require.hide(); }
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" name="sort" value="10">
                        </div>

                        <div class="am-form-group">
                            <label>是否置顶 / Is Top：</label>
                            <label><input type="radio" name="istop" value="0"> 不置顶&nbsp;&nbsp;</label>
                            <label><input type="radio" name="istop" value="1" checked> 置顶&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" checked> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1"> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

