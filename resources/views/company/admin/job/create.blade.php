@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <form data-am-validator method="POST" action="{{DOMAIN_C_BACK}}job" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table_create">
                <tr>
                    <td class="field_name"><label>岗位名称：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="至少2位" minlength="2" name="name"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>需要人数：</label></td>
                    <td class="right">
                        <input type="text" class="field_value" placeholder="数字" pattern="^\d+$" required name="number"/>
                    </td>
                </tr>

                <tr>
                    <td class="field_name"><label>工作要求：</label></td>
                    <td class="right">
                        <textarea name="intro" cols="50" rows="10" style="resize:none;"></textarea>
                    </td>
                </tr>

                <tr><td colspan="2" style="text-align:center;">
                        <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;回</button>
                        <button type="submit" class="companybtn">保存添加</button>
                    </td></tr>
            </table>
        </form>
    </div>
@stop

