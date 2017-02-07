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
            <a href="{{ route('backend.order') }}">订单管理</a>
        </li>
    </ul>
@endsection

@section('header')
    <link href="/custom/plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
@endsection

@section('footer')
    <script src="/custom/plugins/colorpicker/js/colorpicker.js"></script>
    <script>
        +function() {
            $(document).ready(function() {
                var dTable = new Datatable();
                dTable.init({
                    src: $('#order-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            "url": "{{ route('backend.order.dt') }}",
                            "type": "GET"
                        },
                        columns: [
                            {data: 'order_id', name: 'order_id'},
                            {data: 'creator_name', name: 'creator_name'},
                            {data: 'status_text', name: 'status_text'},
                            {data: 'planned_date', name: 'planned_date'},
                            {data: 'pay_price', name: 'pay_price'},
                            {data: 'payment_method', name: 'payment_method'},
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
                <span class="caption-subject bold uppercase"> 订单列表</span>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="order-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th>order ID</th>
                        <th>创造者</th>
                        <th width="100">状态</th>
                        <th>计划日期</th>
                        <th>付出的代价</th>
                        <th>付款方式</th>
                        <th width="150">新增时间</th>
                        <th>操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_id" placeholder="order ID" />
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_name" placeholder="计划日期">
                        </td>
                        <td>
							<select class="form-control form-filter" name="filter_status">
								<option></option>
								<option value="0">draft</option>
								<option value="1">publish</option>
								<option value="2">hired</option>
								<option value="3">completed</option>
								<option value="4">cancel</option>
							</select>                        	
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
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