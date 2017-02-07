@extends('backend.layout')

@section('title')
    目录管理
@endsection

@section('description')
    新增/编辑/删除 目录
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.category') }}">目录</a>
            @if ($model)
                <i class="fa fa-circle"></i>
            @endif
        </li>
        @if ($model && $model->parent)
            <li>
                <a href="{{ route('backend.category', ['id' => $model->parent->id]) }}">
                    {{ $model->parent->getTitles() }}
                </a>
                <i class="fa fa-circle"></i>
            </li>
        @endif
        @if ($model)
            <li>
                <a href="{{ route('backend.category', ['id' => $model->id]) }}">
                    {{ $model->getTitles() }}
                </a>
            </li>
        @endif
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
                    src: $('#category-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            @if ($id === null)
                            "url": "{{ route('backend.category.dt') }}",
                            @else
                            "url": "{{ route('backend.category.dt', ['id' => $id]) }}",
                            @endif
                            "type": "GET"
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'titles', name: 'titles', orderable: false, searchable: false},
                            {data: 'created_at', name: 'created_at'},
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
                <span class="caption-subject bold uppercase"> 目录列表</span>
            </div>
            <div class="actions">
                @if ($id === null)
                <a href="{{ route('backend.category.create') }}" class="btn btn-circle red-sunglo btn-sm" data-target="#remote-modal" data-toggle="modal"><i class="fa fa-plus"></i> 新增目录</a>
                @else
                <a href="{{ route('backend.category.create', ['id' => $id]) }}" class="btn btn-circle red-sunglo btn-sm" data-target="#remote-modal" data-toggle="modal"><i class="fa fa-plus"></i> 新增目录</a>
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="category-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th>ID</th>
                        <th width="700">目录名称</th>
                        <th>新增时间</th>
                        <th>操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_id" placeholder="ID" />
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_title" placeholder="目录名称">
                        </td>
                        <td>
                            <div class="input-group margin-bottom-5">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_created_after" placeholder="开始">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_created_before" placeholder="结束">
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