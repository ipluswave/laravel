@extends('frontend.layouts.default')

@section('title')
Trash
@endsection

@section('description')
Trash
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/trash.css" rel="stylesheet" type="text/css" />
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
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.trash') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
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
    <script src="/custom/js/frontend/trash.js" type="text/javascript"></script>
@endsection