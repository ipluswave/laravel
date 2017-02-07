<!-- Modal -->
<div id="modalTailorOrderCheckDetail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {!! Form::open(['route' => 'frontend.myaccount.create', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('order.order_detail') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12" >
                                <div class="subtitle">{{ trans('member.overview') }}</div>
                                <div class="list-item">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-6 column" >{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" >
                                <div class="subtitle">{{ trans('order.size') }}</div>
                                <div class="list-item">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('order.chest') }}：45</div>
                                        <div class="col-md-3 column">{{ trans('order.waist') }}：452</div>
                                        <div class="col-md-3 column">{{ trans('order.lower_hem') }}：21</div>
                                        <div class="col-md-3 column">{{ trans('order.shirt_length') }}：4151</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('order.sleeve_length') }}：45</div>
                                        <div class="col-md-3 column">{{ trans('order.shoulder_width') }} ：121</div>
                                        <div class="col-md-3 column">{{ trans('order.cuff') }} ：45</div>
                                        <div class="col-md-3 column"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" >
                                <div class="subtitle">{{ trans('order.pictur_comment') }}</div>
                                <hr>
                                <div class="row section-image">
                                    <div class="col-md-4">
                                        <img src="/images/order1.jpg">
                                    </div>
                                    <div class="col-md-8">
                                        <span class="bold">{{ trans('order.front_pattern_picture') }}</span>
                                        <div class="remark">
                                            备注文字备注文字
                                        </div>
                                    </div>
                                </div>
                                <div class="row section-image">
                                    <div class="col-md-4">
                                        <img src="/images/order2.jpg">
                                    </div>
                                    <div class="col-md-8">
                                        <span class="bold">{{ trans('order.front_pattern_picture') }}</span>
                                        <div class="remark">
                                            备注文字备注文字
                                        </div>
                                    </div>
                                </div>
                                <div class="row comments">
                                    <div class="intro-project-note">
                                        工艺指示纯文本备注介绍工艺指示纯文本备注介绍工艺指示纯文本备注介绍工艺指示纯文本备注介绍
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue" id="submit-report-form">{{ trans('member.apply_for_order') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('member.back') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>