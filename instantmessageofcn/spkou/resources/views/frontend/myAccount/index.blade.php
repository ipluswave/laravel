@extends('frontend.layouts.default')

@section('title')
My Account
@endsection

@section('description')
My Account
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="../assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="../custom/css/frontend/myAccount.css" rel="stylesheet" type="text/css" />
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
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.my_bank_account') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <div class="well well-lg">
                                    <h4 class="block">{{ trans('member.account_balance') }}</h4>
                                    <div class="pull-right action">
                                        <button type="submit" class="btn blue"> {{ trans('member.withdraw') }} </button>
                                        <button type="submit" class="btn default"> {{ trans('member.topup') }} </button>
                                    </div>
                                    <div class="font-red bold balance">&#165; 5, 000  </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    {{ trans('member.bank_accounts_bidding') }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach (Auth::guard('users')->user()->bankAccount as $key => $var)
                                        @include('frontend.includes.bankcard', ['card' => $var])
                                    @endforeach
                                    <div class="col-md-6">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalAddBankAccount">
                                            <div class="col-md-12 font-black account add-new">
                                                <div class="col-md-2">
                                                    <img src="../images/add-new.png" alt="logo" class="logo-default" />
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="pull-right">
                                                        <label class="control-label">&nbsp;</label>
                                                    </div>
                                                    <div>
                                                        <label class="control-label">{{ trans('member.add_new_bank_account') }}<br/>&nbsp;</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <label class="control-label account-no">****  ****  ****  ****</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="div-action">
                                            <a href="javascript:;" data-toggle="modal" data-target="#modalAddBankAccount">{{ trans('common.add') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
        @include('frontend.includes.modalAddBankAccount', ['banks' => $banks])
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/myAccount.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function () {
                $('#add-bank-account-form').makeAjaxForm({
                    'inModal': true,
                    'closeModal': true,
                    'submitBtn': '#submit-report-form',
                    'alertContainer': '#add-bank-errors',
                    'successRefresh': true,
                });
                $('#bank-card-no-input').on('keyup', function () {
                    var val = $(this).val();
                    val = val.replace(/(.{4})/g, '$1 ').trim();
                    $('#bank-card-no').html(val);
                });
            });
        }(jQuery);
    </script>
@endsection




