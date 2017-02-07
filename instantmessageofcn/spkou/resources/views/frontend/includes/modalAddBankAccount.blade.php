<!-- Modal -->
<div id="modalAddBankAccount" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {!! Form::open(['route' => 'frontend.myaccount.create', 'id' => 'add-bank-account-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('member.add_new_withdraw_account') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12" id="add-bank-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.bank_name') }}</label>
                            <div class="col-md-9">
                                {!! Form::select('bank_id', $banks, null, ['class' => 'bs-select form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.bank_address') }}</label>
                            <div class="col-md-9">
                                {!! Form::text('account_address', '', ['class' => 'form-control', 'placeholder' => trans('member.phd_bank_address')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.bank_card_no') }}</label>
                            <div class="col-md-9">
                                {!! Form::text('account_number', '', ['class' => 'form-control', 'id' => 'bank-card-no-input', 'placeholder' => trans('member.phd_bank_card_no')]) !!}
                                <span class="help-block" id="bank-card-no"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.account_name') }}</label>
                            <div class="col-md-9">
                                {!! Form::text('account_name', '', ['class' => 'form-control', 'placeholder' => trans('member.phd_account_name')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue" id="submit-report-form">{{ trans('member.confirm_add') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('member.cancel') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>