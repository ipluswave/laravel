@extends('backend.layout')

@section('title')
    新增权限组
@endsection

@section('description')

@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.permissions') }}">权限组</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.permissions.create') }}">新增权限组</a>
        </li>
    </ul>
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection

@section('footer')
    <script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script>
        +function() {
            $(document).ready(function() {
                $('#permissions-selector').multiSelect({
                    selectableHeader: '<span class="caption font-red-sunglo">未选择</span>',
                    selectionHeader: '<span class="caption font-green-sharp">已选择</span>',
                });
                $('#permission-form').makeAjaxForm({
                    redirectTo: '{{ route('backend.permissions') }}',
                });
            });
        }(jQuery);
    </script>
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <span class="caption-helper">填上表格以新增权限组</span>
            </div>
            <div class="actions">

            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(['method' => 'post', 'role' => 'form', 'id' => 'permission-form']) !!}
                <div class="form-body">
                    <div class="form-group">
                        <label>权限组名称</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-group"></i>
                            </span>
                            {!! Form::text('group_name', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>权限</label>
                        {!! Form::select('permissions[]', \App\Models\PermissionGroupPermission::getPermissionsLists(), '', ['id' => 'permissions-selector', 'multiple']) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue">新增</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('modal')

@endsection