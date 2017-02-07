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
            <a href="{{ route('backend.user.submitid') }}"><?= Lang::get('member.submit_id'); ?></a>
        </li>
    </ul>
@endsection

@section('header')
	<link rel="stylesheet" href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
@endsection

@section('footer')
	<script src="/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
    <script>
        +function() {
            $(document).ready(function() {
                var dTable = new Datatable();
                dTable.init({
                    src: $('#submitid-dt'),
                    dataTable: {
                        @include('custom.datatable.common')
                        "ajax": {
                            "url": "{{ route('backend.user.submitid.dt') }}",
                            "type": "GET"
                        },
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'email', name: 'email'},
                            {data: 'real_name', name: 'real_name'},
                            {data: 'id_card_no', name: 'id_card_no'},
                            {data: 'gender', name: 'gender'},
                            {data: 'date_of_birth', name: 'date_of_birth'},
                            {data: 'address', name: 'address'},
                            {data: 'handphone_no', name: 'handphone_no'},
                            {data: 'images', name: 'images'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'actions', name: 'actions', orderable: false, searchable: false}
                        ],
                    }
                });
				$(document).on('click', '.btn-image-view', function () {
					$.fancybox($(this).attr('href'));
				});
            });
        }(jQuery);
    </script>
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <span class="caption-subject bold uppercase"><?= Lang::get('member.submit_id'); ?></span>
            </div>
            <div class="actions">
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover table-checkable" id="submitid-dt">
                    <thead>
                    <tr role="row" class="heading">
                        <th>ID</th>
                        <th width="200">电子邮件地址</th>
                        <th><?= Lang::get('member.real_name'); ?></th>
                        <th><?= Lang::get('member.id_card_no'); ?></th>
                        <th><?= Lang::get('member.gender'); ?></th>
                        <th><?= Lang::get('member.birth_date'); ?></th>
                        <th><?= Lang::get('member.address'); ?></th>
                        <th><?= Lang::get('member.handphone'); ?></th>
                        <th><?= Lang::get('member.front_back_image'); ?></th>
                        <th>注册时间</th>
                        <th>操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_id" placeholder="ID" />
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="filter_email" placeholder="电子邮件地址">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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