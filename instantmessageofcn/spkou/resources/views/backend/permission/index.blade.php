@extends('backend.layout')

@section('title')
    权限组
@endsection

@section('description')
    新增/编辑/删除 权限组
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.permissions') }}">权限组</a>
        </li>
    </ul>
@endsection

@section('header')

@endsection

@section('footer')
    <script>
        +function() {
            $(document).ready(function() {
                var dTable = new Datatable();
                dTable.init({
                    src: $('#permissions-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            "url": "{{ route('backend.permissions.dt') }}",
                            "type": "GET"
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'group_name', name: 'group_name'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'updated_at', name: 'updated_at'},
                            {data: 'actions', name: 'actions', orderable: false, searchable: false}
                        ],
                    }
                });
            });
        }(jQuery);
    </script>
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <span class="caption-subject bold uppercase"> 权限组列表</span>
            </div>
            <div class="actions">
                <a href="{{ route('backend.permissions.create') }}" class="btn btn-circle red-sunglo btn-sm"><i class="fa fa-plus"></i> 新增权限组</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="permissions-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="80">#</th>
                        <th width="400">权限组名称</th>
                        <th>创建时间</th>
                        <th>最后编辑时间</th>
                        <th>操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm number-input" name="filter_row_id" placeholder="Id">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_group_name" placeholder="Group Name">
                        </td>
                        <td>
                            <div class="input-group margin-bottom-5">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_created_after" placeholder="From">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_created_before" placeholder="To">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                        </td>
                        <td>
                            <div class="input-group margin-bottom-5">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_updated_after" placeholder="From">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_updated_before" placeholder="To">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                        </td>
                        <td>
                            <div class="margin-bottom-5">
                                <button class="btn btn-info-alt filter-submit">
                                    <i class="fa fa-search"></i> 过滤
                                </button>
                            </div>
                            <button class="btn btn-danger-alt filter-cancel">
                                <i class="fa fa-times"></i> 重置
                            </button>
                        </td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection