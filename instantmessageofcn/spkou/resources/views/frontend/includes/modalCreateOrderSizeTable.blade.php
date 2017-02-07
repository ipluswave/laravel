<!-- Modal -->
<div id="modalCreateOrderSizeTable" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {!! Form::open(['route' => 'frontend.myaccount.create', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('member.size_table') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="div-table-size">
                                <table class="tbl-size col-md-12">
                                    <thead>
                                        <th class="col-md-4">{{ trans('member.part_name') }}</th>
                                        <th class="col-md-5">{{ trans('member.custom_size') }}</th>
                                        <th class="col-md-3">XS {{ trans('member.reference_size') }}</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ trans('order.chest') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.waist') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.lower_hem') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>8</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.shirt_length') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.cuff_length') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.shoulder_width') }}</td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>{{ trans('order.cuff') }}&nbsp;&nbsp;<a href="javascript:;">{{ trans('member.delete') }}</a></td>
                                            <td>
                                                <span class="col-md-4 input-refernce-size">
                                                    <input class="form-control" placeholder="{{ trans('member.empty') }}" type="text">
                                                </span>
                                                <span class="col-md-8 reference-size">
                                                    <a href="javascript:;">{{ trans('member.use_reference_size') }}</a>
                                                </span>
                                            </td>
                                            <td>/</td>
                                        </tr>
                                        <tr class="last-row">
                                            <td><input class="form-control" placeholder="{{ trans('member.new_part_name') }}" type="text"></td>
                                            <td><input class="form-control" placeholder="{{ trans('member.new_size') }}" type="text"></td>
                                            <td><button type="button" class="btn blue" id="submit-report-form">{{ trans('member.add') }}</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left sample-size">
                        {{ trans('member.common_reference_size') }}&nbsp;&nbsp;
                        <a href="javascript:;">XS</a>&nbsp;&nbsp;
                        <a href="javascript:;">S</a>&nbsp;&nbsp;
                        <a href="javascript:;">M</a>&nbsp;&nbsp;
                        <a href="javascript:;">L</a>&nbsp;&nbsp;
                        <a href="javascript:;">XL</a>&nbsp;&nbsp;
                        <a href="javascript:;">XXL</a>
                    </div>
                    <button type="button" class="btn blue" id="submit-report-form">{{ trans('member.confirm_modify') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('member.cancel') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>