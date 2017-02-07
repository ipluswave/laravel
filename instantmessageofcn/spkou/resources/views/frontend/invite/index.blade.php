@extends('frontend.layouts.default')

@section('title')
Invite
@endsection

@section('description')
Invite
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/invite.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="rows">
                <div class="col-md-5">
                    <div class="portlet box gray-color">
                        <div class="portlet-title">
                            <div class="caption">
                                {{ trans('member.your_2d_code') }}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <img src="../images/2D-Code.png" alt="logo" width="200px" height="220px" class="logo-default" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="text-center">
                                                <button type="submit" class="btn yellow-gold"> {{ trans('member.click_share') }} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="portlet box gray-color">
                        <div class="portlet-title">
                            <div class="caption">
                                {{ trans('member.invite_status') }}
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-6 control-label">{{ trans('member.total_earning') }} : 12306&#165;</label>

                                        <div class="pull-right tranfer">
                                            <button type="submit" class="btn blue">{{ trans('member.transfer_balance') }} </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-6 control-label">{{ trans('member.spread_number') }} : 4 {{ trans('member.people') }}</label>
                                        <div class="pull-right chk-detail">
                                            <button type="submit" class="btn blue">{{ trans('member.check_details') }}</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="table-scrollable table-scrollable-borderless col-md-6">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th colspan="2"> {{ trans('member.username') }} </th>
                                                        <th> {{ trans('member.total_earning') }} </th>
                                                        <th> {{ trans('member.completed_cases') }} </th>
                                                        <th> {{ trans('member.publish_order') }} </th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar4.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Brain</a>
                                                    </td>
                                                    <td> $345 </td>
                                                    <td> 45 </td>
                                                    <td> 124 </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar5.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Nick</a>
                                                    </td>
                                                    <td> $560 </td>
                                                    <td> 12 </td>
                                                    <td> 24 </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar6.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Tim</a>
                                                    </td>
                                                    <td> $1,345 </td>
                                                    <td> 450 </td>
                                                    <td> 46 </td>
                                                </tr>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="../assets/pages/media/users/avatar7.jpg"> </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link">Tom</a>
                                                    </td>
                                                    <td> $645 </td>
                                                    <td> 50 </td>
                                                    <td> 89 </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
@endsection




