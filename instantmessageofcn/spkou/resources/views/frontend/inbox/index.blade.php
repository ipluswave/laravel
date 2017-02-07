@extends('frontend.layouts.default')

@section('title')
Inbox
@endsection

@section('description')
Inbox
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/inbox.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="message-status-menu pull-right">
                                <ul>
                                    <li class="active">{{ trans('member.not_read') }}</li>
                                    <li>{{ trans('member.already_read') }}</li>
                                </ul>
                            </div>
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.inbox') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="inbox table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            <span style="padding-left: 7px;">
                                                <input class="mail-checkbox mail-group-checkbox" type="checkbox">
                                            </span>
                                            <div class="btn-group input-actions" style="padding-left: 5px;">
                                                <a class="btn btn-sm blue btn-outline dropdown-toggle sbold" href="javascript:;" data-toggle="dropdown"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-pencil"></i> Mark as Read </a>
                                                    </li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </th>
                                        <th class="pagination-control" colspan="3">
                                            <span class="pagination-info"> 1-30 of 789 </span>
                                            <a class="btn btn-sm blue btn-outline">
                                                <i class="fa fa-angle-left"></i>
                                            </a>
                                            <a class="btn btn-sm blue btn-outline">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>

                            @foreach ($myInbox as $key => $var)
                            {{--*/ $row_id = generateRandomHtmlId() /*--}}
                            <div class="panel {{ $var->getHtmlClass() }} inbox-container" data-isread="{{ $var->is_read }}" data-inboxid="{{ $var->id }}">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <span>
                                            <input type="checkbox" value="{{ $var->id }}" name="ids[]">
                                        </span>
                                        <a class="message-title accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#{{ $row_id }}">
                                            {{ $var->getTitle() }}
                                        </a>
                                        <span class="pull-right dateTime">
                                            {{ $var->created_at->format('Y-m-d H:i') }}
                                        </span>
                                    </h4>
                                </div>
                                <div id="{{ $row_id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if ($var->order)
                                            @include('frontend.includes.orderDetails', ['orders' => collect([0 => $var->order])])
                                        @endif
                                        @foreach ($var->messages as $message)
                                        <div class="alert {{ $message->getHtmlClass() }}">
                                            <div class="pull-right">
                                                <a href="{{ $message->getGotoLink() }}" class="view">点击查看</a>
                                            </div>
                                            {{ $message->getTitle() }}
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="inbox-content">

                </div>
            </div>

            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/custom/js/frontend/inbox.js" type="text/javascript"></script>
    <script type="text/javascript">
        +function () {
            $(document).ready(function () {
                $('.inbox-container').on('click', function () {
                    var $this = $(this);
                    var is_read = $(this).data('isread');
                    var $id = $(this).data('inboxid');

                    if (is_read == 0) {
                        $.ajax({
                            url: '{{ route('frontend.readinbox') }}',
                            method: 'post',
                            data: {'_token': '{{ csrf_token() }}', 'id': $id},
                            dataType: 'json',
                            beforeSend: function () {
                                $this.data('isread', 1);
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    $('#unread-msg-counter').html(resp.data.unread);
                                } else {
                                    alertError(resp.msg);
                                    $.each(resp.data, function (index, value) {
                                        if (index != 'unread') {
                                            alertError(value);
                                        }
                                    });
                                }
                            },
                            error: function (resp) {
                                $this.data('isread', 0);
                                alert(trans('common.unknown_error'));
                            }
                        });
                    }
                });
            });
        }(jQuery);
    </script>
@endsection