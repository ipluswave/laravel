<!-- Modal -->
<div id="modalEvaluationOrder" class="modal fade" role="dialog">
    <div class="modal-dialog evaluation-order">
        <!-- Modal content-->
        <div class="modal-content">
            {{--<script type="text/javascript" src="/custom/js/frontend/modalAddBankAccount.js"></script>--}}
            {{--{!! Form::open(['route' => 'frontend.myaccount.create', 'id' => 'add-bank-account-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}--}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('member.evaluation_order') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet box gray-box">
                        <div class="portlet-title">
                            <div class="complete-time pull-right">
                                {{ trans('member.complete_time') }} : 2016-10-10 14:30
                            </div>
                            <div class="order-id">
                                {{ trans('member.order_id') }} : NGC201354251456
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="tailor-profile" >
                                    <div class="profile-image col-md-2">
                                        <div class="profile-userpic">
                                            <img src="/assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="" >
                                        </div>
                                    </div>
                                    <div class="user-info col-md-5">
                                        <div class="basic-info">
                                            <span class="bold">张师傅</span>&nbsp;&nbsp;{{ trans('member.male') }}&nbsp;&nbsp;40{{ trans('member.years_old') }}
                                            <span>
                                                <img src="/images/authentication-logo.png" class="img-auth" alt="" >
                                            </span><br/>
                                            <span class="location">广东省 广州市</span><br/>
                                            {{ trans('member.work_experience') }} : 30 {{ trans('member.year') }}<br/>
                                            {{ trans('common.level') }} : 50
                                            </br>
                                        </div>
                                    </div>
                                    {{--//http://plugins.krajee.com/star-rating-demo-basic-usage--}}
                                    <div class="info col-md-5">
                                        <div>
                                            <div class="col-md-2 rate-label">{{ trans('member.efficiency') }}：</div>
                                            <div class="col-md-10"><input type="text" class="kv-fa rating-loading" value="2" data-size="16" title="" data-show-clear="false"></div>
                                        </div>
                                        <div>
                                            <div class="col-md-2 rate-label">{{ trans('member.quality') }}：</div>
                                            <div class="col-md-10"><input type="text" class="kv-fa rating-loading" value="2" data-size="16" title="" data-show-clear="false"></div>
                                        </div>
                                        <div>
                                            <div class="col-md-2 rate-label">{{ trans('member.service') }}：</div>
                                            <div class="col-md-10"><input type="text" class="kv-fa rating-loading" value="2" data-size="16" title="" data-show-clear="false"></div>
                                        </div>
                                        <div>
                                            <div class="col-md-2 rate-label">{{ trans('member.overall_rating') }}：</div>
                                            <div class="col-md-10"><input type="text" class="kv-fa rating-loading" value="2" data-size="16" title="" data-show-clear="false" data-readonly="true"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="comment-tab">
                            <div class="pull-right">
                                <button type="button" class="btn btn-complain" >{{ trans('member.complaints') }}</button>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab"> {{ trans('member.comment_tailor') }} </a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab"> {{ trans('member.comment_platform') }} </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_1_1">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" rows="5" placeholder="{{ trans('member.write_your_comment') }}"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_1_2">
                                <div class="form-group">
                                    <textarea class="form-control" id="message" rows="5" placeholder="{{ trans('member.write_your_comment') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue btn-evaluation" id="submit-report-form">{{ trans('member.submit_evaluation') }}</button>
                </div>
            {{--{!! Form::close() !!}--}}
        </div>
    </div>
</div>