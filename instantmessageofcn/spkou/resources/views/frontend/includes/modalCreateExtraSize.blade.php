<!-- Modal -->
<div id="modalCreateExtraSize" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {!! Form::open(['route' => 'frontend.mypublishorderdetails.createextrasize', 'id' => 'create-extra-size-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bold">{{ trans('member.apply_extra_size') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ trans('member.how_many_extra_size') }}</label>
                            <div class="col-md-3">
                                <input id="size-number" class="form-control" type="text" value="" name="size-number">
                            </div>
                            <label class="col-md-3 control-label size">{{ trans('member.different_unit') }}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label">
                                <span class="label-price-size">
                                    {{ trans('member.payment_for_extra_size') }}：
                                </span>
                                <span class="price-size text=left bold">
                                    ¥99
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red-sunglo" id="submit-report-form">{{ trans('member.confirm_payment') }}</button>
                    <button type="button" class="btn gray01" data-dismiss="modal">{{ trans('member.cancel') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>