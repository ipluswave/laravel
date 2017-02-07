@extends('backend.layout')

@section('title')
    会员
@endsection

@section('description')
    新增/编辑/删除 会员
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.user') }}">会员</a>
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
                    src: $('#rating-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            "url": "{{ route('backend.user.rating.dt') }}",
                            "type": "GET"
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'order', name: 'order'},
                            {data: 'rate_quality', name: 'rate_quality'},
                            {data: 'rate_communicate', name: 'rate_communicate'},
                            {data: 'rate_speed', name: 'rate_speed'},
                            {data: 'text_review', name: 'text_review'},
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
                <span class="caption-subject bold uppercase"><?= $model->email ?></span>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="rating-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th>ID</th>
                        <th width="200">order ID</th>
                        <th><?= trans('member.rate_quality') ?></th>
                        <th><?= trans('member.rate_communicate') ?></th>
                        <th><?= trans('member.rate_speed') ?></th>
                        <th><?= trans('member.text_review') ?></th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_id" placeholder="ID" />
                        </td>
                        <td>
                        	<!-- order ID -->
                        </td>
                        <td>
                        	<!-- rate quality -->
                        </td>
                        <td>
                        	<!-- rate communicate -->
                        </td>
                        <td>
                        	<!-- rate speed -->
                        </td>
                        <td>
                        	<!-- text review -->
                        </td>
                        <td>
                            <div class="input-group margin-bottom-5">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_updated_after" placeholder="开始">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control form-filter input-sm datetime-picker" readonly name="filter_updated_before" placeholder="结束">
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