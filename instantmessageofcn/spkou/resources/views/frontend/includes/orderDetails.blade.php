@foreach ($orders as $key => $var)
    <div class="portlet box gray-box">
        <div class="portlet-title">
            <div class="order-status-menu pull-right">
                {{ trans('member.complete_time') }} : {{ $var->planned_date }}
            </div>
            <div class="order-id">
                {{ trans('member.order_id') }} : {{ $var->order_id }}
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-3 column">{{ trans('member.style') }}: {{ $var->style ? $var->style->getTitle() : '' }}</div>
                <div class="col-md-3 column">{{ trans('member.thickness') }}: {{ $var->explainMaterial() }}</div>
                <div class="col-md-3 column">{{ trans('member.body_type') }}: {{ $var->explainBodyShape() }}</div>
                <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}: {{ $var->topBottom ? $var->topBottom->getTitle() : '' }}</div>
            </div>
            @if ($var->seal_width == 1 || $var->decrease_rate == 1)
                <div class="row">
                    @if ($var->seal_width == 1)
                        <div class="col-md-3 column">
                            {{ $var->explainSealWidth() }}
                        </div>
                    @endif
                    @if ($var->decrease_rate == 1)
                        <div class="col-md-3 column">
                            {{ $var->explainDecreaseRate() }}
                        </div>
                    @endif
                </div>
            @endif
            <hr>
            <div class="row">
                <div class="col-md-3 column">
                    <span class="font-black bold">
                        {{ trans('member.quoted_price') }}：
                    </span>
                    <span class="font-red bold">
                        ¥{{ $var->pay_price }}
                    </span>
                </div>
                <div class="col-md-4 column">
                    <span class="font-black bold">
                        {{ trans('member.order_status') }}：
                    </span>
                    <span class="font-red bold">
                        {{ $var->explainStatus() }}
                    </span>
                </div>
                @if (isset($operation) && $operation === true)
                    <div class="col-md-5 text-right" style="padding-top: 10px;">
                        @if ($var->status == \App\Models\Order::STATUS_DRAFT)
                            <a href="{{ route('frontend.deleteorder', ['id' => $var->id]) }}" class="link"
                               data-toggle="confirmation"
                               data-original-title="{{ trans('common.are_you_sure') }}"
                               data-btn-ok-label="{{ trans('common.yes') }}"
                               data-btn-ok-icon="icon-like"
                               data-btn-ok-class="btn-success"
                               data-btn-cancel-label="{{ trans('common.no') }}"
                               data-btn-cancel-icon="icon-close"
                               data-btn-cancel-class="btn-danger"
                            >{{ trans('member.delete') }}</a>
                            <a href="{{ route('frontend.editorder', ['id' => $var->id]) }}" class="btn blue">{{ trans('member.continue_editing') }}</a>
                        @else
                            @if ($var->haveApprovedApplicant())
                                <a href="{{ route('frontend.mypublishorderdetails', ['id' => $var->id]) }}" class="link" >{{ trans('member.go_into_working_panel') }}</a>
                            @else
                                <a href="{{ route('frontend.deleteorder', ['id' => $var->id]) }}" class="link"
                                   data-toggle="confirmation"
                                   data-original-title="{{ trans('common.are_you_sure') }}"
                                   data-btn-ok-label="{{ trans('common.yes') }}"
                                   data-btn-ok-icon="icon-like"
                                   data-btn-ok-class="btn-success"
                                   data-btn-cancel-label="{{ trans('common.no') }}"
                                   data-btn-cancel-icon="icon-close"
                                   data-btn-cancel-class="btn-danger"
                                >{{ trans('member.delete') }}</a>
                            @endif
                        @endif
                    </div>
                </div>
                @if ($var->applicants && !$var->haveApprovedApplicant())
                    <div class="row">
                        @foreach ($var->applicants as $k => $t)
                            @include('frontend.includes.summaryTailorDetail', ['applicant' => $t])
                        @endforeach
                    </div>
                @endif
            @else
            </div>
            @endif
        </div>
    </div>
@endforeach