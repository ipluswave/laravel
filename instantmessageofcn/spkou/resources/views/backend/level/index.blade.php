@extends('backend.layout')

@section('title')
    银行管理
@endsection

@section('description')
    新增/编辑/删除 银行
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.level') }}">水平管理</a>
        </li>
    </ul>
@endsection

@section('footer')
    <script>
        +function() {
            $(document).ready(function() {
                var dTable = new Datatable();
                dTable.init({
                    src: $('#level-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            "url": "{{ route('backend.level.dt') }}",
                            "type": "GET"
                        },
                        columns: [
                            {data: 'badge', name: 'badge'},
                            {data: 'level', name: 'level'},
                            {data: 'url_icon', name: 'url_icon'},
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
                <span class="caption-subject bold uppercase">水平管理</span>
            </div>
            <div class="actions">
                <a href="{{ route('backend.level.create') }}" class="btn btn-circle red-sunglo btn-sm" data-target="#remote-modal" data-toggle="modal"><i class="fa fa-plus"></i> 新增水平</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="level-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th>Badge</th>
                        <th>Level</th>
                        <th>Icon</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection