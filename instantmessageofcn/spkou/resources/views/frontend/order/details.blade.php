@extends('ajaxmodal')

@section('title')
    #{{ $order->order_id }} {{ trans('order.order_detail') }}
@endsection

@section('content')
    @if ($available === true)
    <div class="form-horizontal">
        <div class="form-body">
            <div class="form-group">
                <div class="col-md-12" >
                    <div class="subtitle">{{ trans('member.overview') }}</div>
                    <div class="list-item">
                        <div class="row">
                            <div class="col-md-3 column">{{ trans('member.style') }}: {{ $order->style->getTitle() }}</div>
                            <div class="col-md-3 column">{{ trans('member.thickness') }}: {{ $order->explainMaterial() }}</div>
                            <div class="col-md-3 column">{{ trans('member.body_type') }}: {{ $order->explainBodyShape() }}</div>
                            <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}: {{ $order->topBottom->getTitle() }}</div>
                        </div>
                        @if ($order->seal_width == 1 || $order->decrease_rate == 1 || $order->materials->count())
                            <div class="row">
                                @if ($order->seal_width == 1)
                                    <div class="col-md-3 column">
                                        {{ $order->explainSealWidth() }}
                                    </div>
                                @endif
                                @if ($order->decrease_rate == 1)
                                    <div class="col-md-3 column">
                                        {{ $order->explainDecreaseRate() }}
                                    </div>
                                @endif
                                @if ($order->materials->count())
                                    <div class="col-md-3 column">
                                        {{ $order->explainRawMaterials() }}
                                    </div>
                                @endif
                            </div>
                        @endif
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
            @if ($order->front_pattern_image || $order->front_image_desc || $order->back_pattern_image || $order->back_image_desc || $order->remark)
            <div class="form-group">
                <div class="col-md-12" >
                    <div class="subtitle">{{ trans('order.picture_comment') }}</div>
                    <hr>
                    @if ($order->front_pattern_image || $order->front_image_desc)
                    <div class="row section-image">
                        @if ($order->front_pattern_image)
                        <div class="col-md-4">
                            <img src="{{ asset($order->front_pattern_image) }}">
                        </div>
                        @endif
                        @if ($order->front_image_desc)
                        <div class="col-md-{{ $order->front_pattern_image ? '8' : '12' }}">
                            <span class="bold">{{ trans('order.front_pattern_picture') }}</span>
                            <div class="remark">
                                {{ nl2br($order->front_image_desc) }}
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                    @if ($order->back_pattern_image || $order->back_image_desc)
                        <div class="row section-image">
                            @if ($order->back_pattern_image)
                                <div class="col-md-4">
                                    <img src="{{ asset($order->back_pattern_image) }}">
                                </div>
                            @endif
                            @if ($order->back_image_desc)
                                <div class="col-md-{{ $order->front_pattern_image ? '8' : '12' }}">
                                    <span class="bold">{{ trans('order.back_pattern_picture') }}</span>
                                    <div class="remark">
                                        {{ nl2br($order->back_image_desc) }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($order->remark)
                    <div class="row comments">
                        <div class="intro-project-note">
                            {{ nl2br($order->remark) }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @else
        <div class="col-xs-12">
            <h3>Not allow to see details</h3>
        </div>
    @endif
@endsection

@section('footer')

@endsection

@section('script')

@endsection