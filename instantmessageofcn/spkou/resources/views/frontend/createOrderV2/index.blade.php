@extends('frontend.layouts.default')

@section('title')
	@if (isset($order))
		{{ trans('page.edit_order') }}
	@else
		{{ trans('page.create_order') }}
	@endif
@endsection

@section('description')
	@if (isset($order))
		{{ trans('page.edit_order') }}
	@else
		{{ trans('page.create_order') }}
	@endif
@endsection

@section('author')

@endsection

@section('header')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/createOrderV2.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" >
            {!! Form::open(['id' => 'submit_form', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}

                <!-- Start Basic Info Input Form -->
                <div id="section-basic-info" class="row" style="display:block">
                    <div class="col-md-12">
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase cfr" style="color:#000 !important">{{ trans('order.create_order') }}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                    <div class="col-md-10">
                                        <!-- Complete Date-->
                                        <div class="row" style="margin-top:30px">
                                            <div class="text-left custom-left-margin">
                                                <span class="lbl-how-many-day">{{ trans('order.how_many_days_needed') }}：</span>&nbsp;&nbsp;
                                                <span class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-circle red btn-how-many-day" style="height:36px">
                                                        <span class="how-many-days">3</span>{{ trans('order.days')  }}
                                                        {!! Form::hidden('plan_day', 3, ['id' => 'plan_day']) !!}
                                                    </button>
                                                    <ul class="dropdown-menu ul-how-many-day pagination-lg ad" role="menu" >
                                                        <li id="1">
                                                            <a href="javascript:;"> 1 </a>
                                                        </li>
                                                        <li id="2">
                                                            <a href="javascript:;"> 2 </a>
                                                        </li>
                                                        <li id="3" class="active">
                                                            <a href="javascript:;"> 3 </a>
                                                        </li>
                                                        <li id="4">
                                                            <a href="javascript:;"> 4 </a>
                                                        </li>
                                                        <li id="5">
                                                            <a href="javascript:;"> 5 </a>
                                                        </li>
                                                    </ul>
                                                </span> &nbsp;&nbsp;
                                                <span class="next-3">{{ trans('order.expected_at') }}<span id="month-completed">0</span>{{ trans('order.month') }}<span id="day-completed">00</span>{{ trans('order.day')}}{{ trans('order.complete') }} </span>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:90px">
                                            <!-- Gender -->
                                            <div class="btn-group col-md-2 custom-btn-group dropdown div-gender" >
                                                <button class="btn btn-default dropdown-toggle custom-block" id="btn-gender" type="button" data-toggle="dropdown">
                                                    <i class="fa fa-check-square custom-square"></i>
                                                    <span class="data">{{ trans('order.gender') }}</span>
                                                    <br>
                                                    <span id="data-gender" style="font-weight:normal;font-size: 17px;">
                                                        @if(isset($data['genderName'])) {{ $data['genderName'] }}  @endif
                                                    </span>
                                                    {!! Form::hidden('hid-gender', isset($order) && isset($order->style_id) ? $order->style_id : 0, ['id' => 'hid-gender']) !!}
                                                </button>
                                                <ul id="list-gender" class="dropdown-menu x" role="menu">
                                                    @foreach ($categories as $key => $var)
                                                        <li data-ite="gender" value="{{ $var->id }}" data="{{$var->getTitle()}}">
                                                           <a href="javascript:;"> {{ $var->getTitle() }} </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Craft -->
                                            <div class="btn-group col-md-2 custom-btn-group dropdown div-craft" >
                                                <button class="btn btn-default dropdown-toggle custom-block" id="btn-craft" type="button" data-toggle="dropdown">
                                                    <i class="fa fa-check-square custom-square"></i>
                                                    <span class="data">{{ trans('order.make_craft') }}</span>
                                                    <br>
                                                    <span id="data-craft" style="font-weight:normal;font-size: 17px;">
                                                        @if(isset($data['materialName'])) {{ $data['materialName'] }}  @endif
                                                    </span>
                                                    {!! Form::hidden('hid-craft', isset($order) && isset($order->material) ? $order->material : 0, ['id' => 'hid-craft']) !!}
                                                </button>
                                                <ul id="list-craft" class="dropdown-menu x" role="menu">
                                                    @foreach (\App\Constants::getMaterialLists() as $key => $var)
                                                    <li data-ite="craft" value="{{$key}}" data="{{$var}}">
                                                        <a href="javascript:;"> {{  $var }} </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Body Position -->
                                            <div class="btn-group col-md-2 custom-btn-group dropdown div-body-position" >
                                                <button class="btn btn-default dropdown-toggle custom-block" id="btn-body-position" type="button" data-toggle="dropdown">
                                                    <i class="fa fa-check-square custom-square"></i>
                                                    <span class="data">{{ trans('order.body_part') }}</span>
                                                    <br>
                                                    <span id="data-body-position" style="font-weight:normal;font-size: 17px;">
                                                         @if(isset($data['bodyPositionName'])) {{ $data['bodyPositionName'] }}  @endif
                                                    </span>
                                                    {!! Form::hidden('hid-body-position', isset($order) && isset($order->top_bottom_id) ? $order->top_bottom_id : 0, ['id' => 'hid-body-position']) !!}
                                                </button>
                                                <ul id="list-body-position" class="dropdown-menu x" role="menu">
                                                </ul>
                                            </div>
                                            <!-- Style -->
                                            <div class="btn-group col-md-2 custom-btn-group dropdown div-style" >
                                                <button class="btn btn-default dropdown-toggle custom-block" id="btn-style" type="button" data-toggle="dropdown">
                                                    <i class="fa fa-check-square custom-square"></i>
                                                    <span class="data">{{ trans('order.style') }}</span>
                                                    <br>
                                                    <span id="data-style" style="font-weight:normal;font-size: 17px;">
                                                        @if(isset($data['styleName'])) {{ $data['styleName'] }}  @endif
                                                    </span>
                                                    {!! Form::hidden('hid-style', isset($order) && isset($order->category_id) ? $order->category_id : 0, ['id' => 'hid-style']) !!}
                                                </button>
                                                <ul id="list-style" class="dropdown-menu x" role="menu">
                                                    <!--
                                                    <li data-ite="4">
                                                        <a href="javascript:;"> 男装 </a>
                                                    </li>
                                                    -->
                                                </ul>
                                            </div>
                                            <!-- Body Shape -->
                                            <div class="btn-group col-md-2 custom-btn-group dropdown div-body-shape" >
                                                <button class="btn btn-default dropdown-toggle custom-block" id="btn-body-shape" type="button" data-toggle="dropdown">
                                                    <i class="fa fa-check-square custom-square"></i>
                                                    <span class="data">{{ trans('order.body_shape') }}</span>
                                                    <br>
                                                    <span id="data-body-shape" style="font-weight:normal;font-size: 17px;">
                                                        @if(isset($data['bodyShapeName'])) {{ $data['bodyShapeName'] }}  @endif
                                                    </span>
                                                    {!! Form::hidden('hid-body-shape', isset($order) && isset($order->body_shape) ? $order->body_shape : 0, ['id' => 'hid-body-shape']) !!}
                                                </button>
                                                <ul class="dropdown-menu x" role="menu">
                                                    @foreach (\App\Constants::getBodyShapeLists() as $key => $var)
                                                    <li data-ite="body-shape" value="{{$key}}" data="{{$var}}">
                                                        <a href="javascript:;"> {{  $var }} &emsp;&nbsp;&nbsp;
                                                            <img src="/images/country1.png" />
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                </div>
                                <div class="row" style="margin-top:100px">
                                    <div class="col-md-12">
                                        <hr />
                                    </div>
                                </div>
                                <!-- professional option-->
                                <div class="row">
                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                    <div class="col-md-10">
                                        <div class="row" style="margin-left:30px">
                                            <span class="title"> {{ trans('order.professional_options') }}</span>
                                            <br>
                                            <span>{{ trans('order.professional_option_skip_message') }}</span>
                                        </div>
                                        <!-- Shrinkage -->
                                        <div class="row" style="margin-top:30px;margin-left:30px;margin-right:30px">
                                            <div class="col-md-12 custom-blk" id="shrinkage">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch" style="float:left">
                                                            <input id="ts-shrinkage"  class="cmn-toggle cmn-toggle-round" type="checkbox" style="display:none">
                                                            <label for="ts-shrinkage"></label>
                                                        </div>&emsp;&emsp;&nbsp;&nbsp;
                                                        <span class="custom-over" style="font-size:18px; font-weight:bold">{{ trans('order.decrease_rate') }} </span>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content11">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10">
                                                        <div class="col-md-3 text-center" style="padding-left:0px" >
                                                            <span class="left-0" style="padding-right: 20px;">{{ trans('order.horizontal') }}</span>&nbsp;&nbsp;
                                                            {!! Form::label('horiz', isset($order) && isset($order->horiz) ? $order->horiz : 0 . ' %', [
                                                                'class' => 'btn btn-sm btn-horizon',
                                                                'data-toggle'=>'dropdown',
                                                                'aria-expanded'=>'true'
                                                            ]) !!}

                                                            {!! Form::hidden('horiz', isset($order) && isset($order->horiz) ? $order->horiz : 0, ['id'=>'horiz']) !!}
                                                        </div>
                                                        <!--Horizon Number Picker Start-->
                                                        <div class="col-md-9">
                                                            <span id="horizon">
                                                                <ul class="pagination bootpag">
                                                                    <li class="prev">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-caret-left"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="hide" value="-14">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-13">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-12">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-11">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-10">
                                                                        <a href="javascript:;">-10</a>
                                                                    </li>
                                                                    <li class="hide" value="-9">
                                                                        <a href="javascript:;">-9</a>
                                                                    </li>
                                                                    <li class="hide" value="-8">
                                                                        <a href="javascript:;">-8</a>
                                                                    </li>
                                                                    <li class="hide" value="-7">
                                                                        <a href="javascript:;">-7</a>
                                                                    </li>
                                                                    <li class="hide" value="-6">
                                                                        <a href="javascript:;">-6</a>
                                                                    </li>
                                                                    <li class="hide" value="-5">
                                                                        <a href="javascript:;">-5</a>
                                                                    </li>
                                                                    <li class="gray" value="-4">
                                                                        <a href="javascript:;">-4</a>
                                                                    </li>
                                                                    <li class="" value="-3">
                                                                        <a href="javascript:;">-3</a>
                                                                    </li>
                                                                    <li class="" value="-2">
                                                                        <a href="javascript:;">-2</a>
                                                                    </li>
                                                                    <li class="" value="-1">
                                                                        <a href="javascript:;">-1</a>
                                                                    </li>
                                                                    <li class="disabled" value="0">
                                                                        <a href="javascript:;">0</a>
                                                                    </li>
                                                                    <li class="" value="1">
                                                                        <a href="javascript:;">1</a>
                                                                    </li>
                                                                    <li class="" value="2">
                                                                        <a href="javascript:;">2</a>
                                                                    </li>
                                                                    <li class="" value="3">
                                                                        <a href="javascript:;">3</a>
                                                                    </li>
                                                                    <li class="gray" value="4">
                                                                        <a href="javascript:;">4</a>
                                                                    </li>
                                                                    <li class="hide" value="5">
                                                                        <a href="javascript:;">5</a>
                                                                    </li>
                                                                    <li class="hide" value="6">
                                                                        <a href="javascript:;">6</a>
                                                                    </li>
                                                                    <li class="hide" value="7">
                                                                        <a href="javascript:;">7</a>
                                                                    </li>
                                                                    <li class="hide" value="8">
                                                                        <a href="javascript:;">8</a>
                                                                    </li>
                                                                    <li class="hide" value="9">
                                                                        <a href="javascript:;">9</a>
                                                                    </li>
                                                                    <li class="hide" value="10">
                                                                        <a href="javascript:;">10</a>
                                                                    </li>
                                                                    <li class="hide" value="11">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="12">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="13">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="14">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="next">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-caret-right"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                        <!--Horizon Number Picker End-->
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content12">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10">
                                                        <div class="col-md-3 text-center" style="padding-left:0px">
                                                            <span class="left-0" style="padding-right: 20px;">{{ trans('order.pararal') }}</span>&nbsp;&nbsp;
                                                            {!! Form::label('parar', isset($order) && isset($order->parar) ? $order->parar : 0 . ' %', [
                                                                'class' => 'btn btn-sm btn-pararal',
                                                                'data-toggle'=>'dropdown',
                                                                'aria-expanded'=>'true'
                                                            ]) !!}

                                                            {!! Form::hidden('parar', isset($order) && isset($order->parar) ? $order->parar : 0, ['id'=>'parar']) !!}
                                                        </div>
                                                        <!--Pararal Number Picker Start-->
                                                        <div class="col-md-9">
                                                            <span id="pararal">
                                                                <ul class="pagination bootpag">
                                                                    <li class="prev">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-caret-left"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="hide" value="-14">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-13">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-12">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-11">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="-10">
                                                                        <a href="javascript:;">-10</a>
                                                                    </li>
                                                                    <li class="hide" value="-9">
                                                                        <a href="javascript:;">-9</a>
                                                                    </li>
                                                                    <li class="hide" value="-8">
                                                                        <a href="javascript:;">-8</a>
                                                                    </li>
                                                                    <li class="hide" value="-7">
                                                                        <a href="javascript:;">-7</a>
                                                                    </li>
                                                                    <li class="hide" value="-6">
                                                                        <a href="javascript:;">-6</a>
                                                                    </li>
                                                                    <li class="hide" value="-5">
                                                                        <a href="javascript:;">-5</a>
                                                                    </li>
                                                                    <li class="gray" value="-4">
                                                                        <a href="javascript:;">-4</a>
                                                                    </li>
                                                                    <li class="" value="-3">
                                                                        <a href="javascript:;">-3</a>
                                                                    </li>
                                                                    <li class="" value="-2">
                                                                        <a href="javascript:;">-2</a>
                                                                    </li>
                                                                    <li class="" value="-1">
                                                                        <a href="javascript:;">-1</a>
                                                                    </li>
                                                                    <li class="disabled" value="0">
                                                                        <a href="javascript:;">0</a>
                                                                    </li>
                                                                    <li class="" value="1">
                                                                        <a href="javascript:;">1</a>
                                                                    </li>
                                                                    <li class="" value="2">
                                                                        <a href="javascript:;">2</a>
                                                                    </li>
                                                                    <li class="" value="3">
                                                                        <a href="javascript:;">3</a>
                                                                    </li>
                                                                    <li class="gray" value="4">
                                                                        <a href="javascript:;">4</a>
                                                                    </li>
                                                                    <li class="hide" value="5">
                                                                        <a href="javascript:;">5</a>
                                                                    </li>
                                                                    <li class="hide" value="6">
                                                                        <a href="javascript:;">6</a>
                                                                    </li>
                                                                    <li class="hide" value="7">
                                                                        <a href="javascript:;">7</a>
                                                                    </li>
                                                                    <li class="hide" value="8">
                                                                        <a href="javascript:;">8</a>
                                                                    </li>
                                                                    <li class="hide" value="9">
                                                                        <a href="javascript:;">9</a>
                                                                    </li>
                                                                    <li class="hide" value="10">
                                                                        <a href="javascript:;">10</a>
                                                                    </li>
                                                                    <li class="hide" value="11">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="12">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="13">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="hide" value="14">
                                                                        <a href="javascript:;">&nbsp;</a>
                                                                    </li>
                                                                    <li class="next">
                                                                        <a href="javascript:;">
                                                                            <i class="fa fa-caret-right"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                        </div>
                                                        <!--Pararal Number Picker End-->
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                            </div>
                                            {!! Form::hidden('decrease_rate', isset($order) && isset($order->decrease_rate) ? $order->decrease_rate : 0, ['id' => 'decrease_rate']) !!}
                                        </div>
                                        <!-- Seal width -->
                                        <div class="row" style="margin-top:30px;margin-left:30px;margin-right:30px">
                                            <div class="col-md-12 custom-blk" id="seal-width">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch" style="float:left">
                                                            <input id="ts-seal-width"  class="cmn-toggle cmn-toggle-round" type="checkbox" style="display:none">
                                                            <label for="ts-seal-width"></label>
                                                        </div>
                                                        &emsp;&emsp;&nbsp;&nbsp;
                                                        <span class="custom-over" style="font-size:18px; font-weight:bold">{{ trans('order.seal_width') }} &emsp;
                                                            <span id="ght" style="display:none;font-size:14px">{{ trans('order.measure_unit_remind') }}（CM）</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content21">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10">
                                                        <div class="col-md-4" style="overflow:auto;">
                                                            <span>
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="common_seal_check" id="common_seal_check" value="{{ isset($order) && isset($order->common_seal) ? $order->common_seal : 0 }}" />
                                                                    <span class="option-head">{{ trans('order.common_seal') }}</span>
                                                                </label>
                                                            </span>&emsp;
                                                            <input type="text" name="common_seal" id="common_seal" style="display:none;"  value="{{ isset($order) && isset($order->common_seal_num) ? $order->common_seal_num : 0 }} CM" class="form-control cus-te"/>
                                                        </div>
                                                        <div class="col-md-4" style="overflow:auto;">
                                                            <span>
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="seal3_check" id="seal3_check" value="{{ isset($order) && isset($order->seal3) ? $order->seal3 : 0 }}" />
                                                                    <span class="option-head">{{ trans('order.seal_3') }}</span>
                                                                </label>
                                                            </span>&emsp;
                                                            <input type="text" name="seal3" style="display:none;"  value="{{ isset($order) && isset($order->seal_3_num) ? $order->seal_3_num : 0 }} CM" id="seal3" class="form-control cus-te"/>
                                                        </div>
                                                        <div class="col-md-4" style="overflow:auto;">
                                                            <span>
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="seal2_check" id="seal2_check" value="{{ isset($order) && isset($order->seal2) ? $order->seal2 : 0 }}" />
                                                                    <span class="option-head"> {{ trans('order.seal_2') }} </span>
                                                                </label>
                                                            </span>&emsp;
                                                            <input type="text"  name="seal2" style="display:none;" value="{{ isset($order) && isset($order->seal_2_num) ? $order->seal_2_num : 0 }} CM" id="seal2" class="form-control cus-te"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content23">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10">
                                                        <div class="col-md-4" style="overflow:auto;">
                                                            <span>
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="seal1_check" id="seal1_check" value="{{ isset($order) && isset($order->seal1) ? $order->seal1 : 0 }}" />
                                                                    <span class="option-head"> {{ trans('order.seal_1') }}</span>
                                                                </label>
                                                            </span>&emsp;
                                                            <input type="text" name="seal1" id="seal1" style="display:none;"  value="{{ isset($order) && isset($order->seal_1_num) ? $order->seal_1_num : 0 }} CM" class="form-control cus-te"/>
                                                        </div>
                                                        <div class="col-md-5" style="overflow:auto;">
                                                            <span>
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="niddle_size_check" id="niddle_size_check" value="{{ isset($order) && isset($order->niddle_size) ? $order->niddle_size : 0 }}" />
                                                                    <span class="option-head"> {{ trans('order.niddle_size') }} </span>
                                                                </label>
                                                            </span>&emsp;
                                                            <input type="text" name="niddle_size" style="display:none;" value="{{ isset($order) && isset($order->niddle_size_num) ? $order->niddle_size_num : 0 }} CM" id="niddle_size" class="form-control cus-te"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content22">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10">
                                                        <div class="col-md-8" style="overflow:auto;">
                                                            <span style="">
                                                                <label class="lbl-seal-width">
                                                                    <input type="checkbox" name="include_seal" id="include_seal" value="{{ isset($order) && isset($order->include_seal) ? $order->include_seal : 0 }}" />
                                                                    <span class="option-head"> {{ trans('order.include_seal') }} </span>
                                                                </label>
                                                            </span>&emsp;
                                                            <span id="span_include_seal" name="" style="display:none">
                                                                &emsp;{{ trans('order.size_front') }}
                                                                <input id="include_seal_num_1" type="text" name="include_seal_num_1" value="{{ isset($order) && isset($order->include_seal_num_1) ? $order->include_seal_num_1 : 0 }} CM"  style="display:inline-block" class="form-control cus-te"/>
                                                                &emsp;{{ trans('order.size_back') }}&emsp;
                                                                <input id="include_seal_num_2" type="text" name="include_seal_num_2" value="{{ isset($order) && isset($order->include_seal_num_2) ? $order->include_seal_num_2 : 0 }} CM"  style="display:inline-block" class="form-control cus-te"/>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                            </div>
                                            {!! Form::hidden('custom_seal', isset($order) && isset($order->common_seal) ? $order->common_seal : 0, ['id' => 'custom_seal']) !!}
                                        </div>
                                        <!-- Composition -->
                                        <div class="row" style="margin: 30px 30px 100px 30px;">
                                            <div class="col-md-12 custom-blk" id="composition">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch" style="float:left">
                                                            <input id="ts-composition"  class="cmn-toggle cmn-toggle-round" type="checkbox" style="display:none">
                                                            <label for="ts-composition"></label>
                                                        </div> &emsp;&emsp;&nbsp;&nbsp;
                                                        <span class="custom-over" style="font-size:18px; font-weight:bold"> {{ trans('order.composition') }} </span>
                                                    </div>
                                                </div>
                                                <div class="row" id="content31" style="margin-top:20px;display:none">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10" id="composition">&nbsp;&nbsp;
                                                        <span id="set_edt" class="option-head"> {{ trans('order.common_composition') }} </span> &nbsp;
                                                        <div class="composition-option-list">
                                                            @foreach ($rawMaterial as $key => $var)
                                                            <span type="text" data-text="{{ $var->getName() }}" id="{{ $var->id }}" class="raw-material" >{{ $var->getName() }}</span>&emsp;
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                                <div class="row" style="margin-top:20px;display:none" id="content32">
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <div class="col-md-10" >&nbsp;&nbsp;
                                                        <span class="option-head">
                                                            {{ trans('order.input_composition') }}
                                                        </span> &nbsp;
                                                        <input id="material-name-container" type="text" placeholder=" {{ trans('order.material_name') }} " class="form-control cus-te"/>&nbsp;
                                                        <input id="material-id" type="hidden" value="0">
                                                        <i id="raw-material-percentage-minus" class="fa fa-minus-circle" style="font-size:25px;color:#ccc"></i>&nbsp;
                                                        <input type="text"  value="100 %" id="tbx-raw-material-percentage" class="form-control cus-te cus-99"/>&nbsp;
                                                        <i id="raw-material-percentage-plus" class="fa fa-plus-circle custom-plus" ></i>&emsp;
                                                        <button type="button" class="btn btn-sm btn-add-raw-material" style="font-size:16px">
                                                            {{ trans('order.add') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                </div>
                                                <div class="row" style="margin-top:20px; display:none;margin-bottom:5px;" id="new-add-raw-material" >
                                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                                    <span class="col-md-11" style="overflow:auto;">&nbsp;&nbsp;
                                                        <div class="col-width-title option-head pull-left"> {{ trans('order.material_include') }} </div> &nbsp;
                                                        <div class="col-width-info raw-material-list pull-right">
                                                        </div>
                                                        {!! Form::hidden('hidRawMaterialList', isset($data) && isset($data['hidRawMaterialList']) ? $data['hidRawMaterialList'] : '', ['id' => 'hidRawMaterialList']) !!}
                                                    </span>
                                                </div>
                                            </div>
                                            {!! Form::hidden('custom_raw_material_switch', isset($order) && isset($order->custom_raw_material) ? $order->custom_raw_material : 0, ['id' => 'custom_raw_material_switch']) !!}
                                        </div>
                                        <input type="hidden" value="{{ trans('order.percentage_maximum_exceed') }}" id="raw-material-maximum-percent-msg" />
                                    </div>
                                    <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <div class="row">
                                <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                                <div class="col-md-10" >
                                    <ul class="list-inline">
                                        <li>
                                            <button type="button" class="btn btn-primary border-radius-5 button-next foot-btn"> {{ trans('order.next') }} </button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn default border-radius-5 foot-btn-1" onclick="location.href='{{ route('home') }}';"> {{ trans('order.cancel') }} </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-1 col-hidden-sm col-hidden-xs"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Basic Info Input Form -->

                <!-- Start Basic Info Display -->
                <div id="section-basic-info-display" class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="portlet light" style="background-color:#fff; padding-bottom:0px">
                            <div class="portlet-title custom-portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase" style="color:#000 !important;font-size:18px"> {{ trans('order.order_info') }} </span>
                                </div>
                            </div>
                            <div class="portlet-body" id="sdr" style="display:none">
                                <div class="row">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs" style="padding-left:0px; padding-right:0px">
                                    </div>
                                    <div class="col-md-8" style="padding-left:0px; padding-right:0px">
                                        <div class="row" style="margin-top:30px">
                                            <div class="text-left ">
                                                <span class="custom-over">
                                                    {{ trans('order.production_period') }} ：
                                                </span>&nbsp;&nbsp;
                                                <span class="btn-group">
                                                <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-circle red btn-sm custom-btn-3">
                                                    <span class="disp-how-many-days">3</span> {{ trans('order.days') }}
                                                </button>
                                            </span> &nbsp;&nbsp;
                                            <span class="next-3">{{ trans('order.expected_at') }}<span class="disp-month-completed">5</span>{{ trans('order.month') }}<span class="disp-day-completed">10</span>{{ trans('order.day') }} {{ trans('order.complete') }} </span>

                                        </div>
                                        </div>
                                        <div class="row" style="margin-top:20px;">
                                        <div class="portlet light  custom-design-port" style="background-color:#fff; padding-bottom:0px;padding-top:5px">
                                        <div class="portlet-title custom-portlet-title" style="min-height:40px">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase" style="color:#000 !important;font-size:18px"> {{ trans('order.basic_options') }} </span>
                                            </div>
                                        </div>
                                        <div class="portlet-body" >
                                        <table class="table borderless tbl-basic-option" style="height:94px">
                                            <tbody>
                                                <tr>
                                                    <th> {{ trans('order.gender') }} </th>
                                                    <th> {{ trans('order.make_craft') }} </th>
                                                    <th> {{ trans('order.body_part') }} </th>
                                                    <th> {{ trans('order.style') }} </th>
                                                    <th> {{ trans('order.body_shape') }}  </th>
                                                </tr>
                                                <tr>
                                                    <td><span class="disp-gender">@if(isset($data['genderName'])) {{ $data['genderName'] }}  @endif</span></td>
                                                    <td><span class="disp-craft">@if(isset($data['materialName'])) {{ $data['materialName'] }}  @endif</span></td>
                                                    <td><span class="disp-body-position">@if(isset($data['bodyPositionName'])) {{ $data['bodyPositionName'] }}  @endif</span></td>
                                                    <td><span class="disp-style">@if(isset($data['styleName'])) {{ $data['styleName'] }}  @endif</span></td>
                                                    <td><span class="disp-body-shape">@if(isset($data['bodyShapeName'])) {{ $data['bodyShapeName'] }}  @endif</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px; margin-bottom:20px">
                                        <div class="portlet light  custom-design-port" style="background-color:#fff; padding-bottom:0px;padding-top:5px">
                                        <div class="portlet-title custom-portlet-title" style="min-height:40px">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase" style="color:#000 !important;font-size:18px"> {{ trans('order.professional_options') }} </span>
                                            </div>
                                        </div>
                                        <div class="portlet-body" >
                                        <table class="table borderless tbl-professional-option" style="height:200px">
                                            <tbody>
                                                <tr>
                                                    <td class="tbl-side-title"> {{ trans('order.decrease_rate') }} </td>
                                                    <td class="data"> {{ trans('order.horizontal') }}  <span class="disp-horizon">{{isset($order) && isset($order->horiz) ? $order->horiz : 0 }}</span> % </td>
                                                    <td class="data"> {{ trans('order.pararal') }}  <span class="disp-pararal">{{isset($order) && isset($order->parar) ? $order->parar : 0 }}</span> % </td>
                                                    <td>&nbsp;  </td>
                                                </tr>
                                                <tr>
                                                    <td class="tbl-side-title"> {{ trans('order.seal_width') }} </td>
                                                    <td class="data"> {{ trans('order.common_seal') }}  <span class="disp-common-seal">{{ isset($order) && isset($order->common_seal_num) ? $order->common_seal_num : 0 }}</span>cm </td>
                                                    <td class="data"> {{ trans('order.seal_3') }}  <span class="disp-seal3">{{ isset($order) && isset($order->seal_3_num) ? $order->seal_3_num : 0 }}</span>cm </td>
                                                    <td class="data"> {{ trans('order.seal_2') }}  <span class="disp-seal2">{{ isset($order) && isset($order->seal_2_num) ? $order->seal_2_num : 0 }}</span>cm </td>
                                                </tr>
                                                <tr>
                                                    <td class="tbl-side-title"></td>
                                                    <td class="data"> {{ trans('order.seal_1') }}  <span class="disp-seal1">{{ isset($order) && isset($order->seal_1_num) ? $order->seal_1_num : 0 }}</span>cm </td>
                                                    <td class="data"> {{ trans('order.niddle_size') }}  <span class="disp-niddle_size">{{ isset($order) && isset($order->niddle_size_num) ? $order->niddle_size_num : 0 }}</span>cm </td>
                                                    <td class="data"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tbl-side-title"></td>
                                                    <td class="data" colspan="2"> {{ trans('order.include_seal') }}
                                                        &emsp; {{ trans('order.size_front') }} <span class="disp-include_seal_num_1">{{ isset($order) && isset($order->include_seal_num_1) ? $order->include_seal_num_1 : 0 }}</span>cm
                                                        &emsp; {{ trans('order.size_back') }} <span class="disp-include_seal_num_2">{{ isset($order) && isset($order->include_seal_num_2) ? $order->include_seal_num_2 : 0 }}</span>cm
                                                    </td>
                                                    <td class="data"></td>
                                                </tr>
                                                <tr>
                                                    <td class="tbl-side-title"> {{ trans('order.composition') }} </td>
                                                    <td class="data"><span class="disp-raw-material-1"></span></td>
                                                    <td class="data"><span class="disp-raw-material-2"></span></td>
                                                    <td class="data"><span class="disp-raw-material-3"></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="tbl-side-title"></td>
                                                    <td class="data"><span class="disp-raw-material-4"></span></td>
                                                    <td class="data"></td>
                                                    <td class="data"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                              </div>
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs" style="padding-left:0px; padding-right:0px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <div class="row">
                                <div class="col-md-1 col-hidden-sm col-hidden-xs">
                                </div>
                                <div class="col-md-10">
                                    <ul class="list-inline">
                                        <li>
                                            <button id="btnBasicInfoModify" type="button" class="btn border-radius-5 button-modify" > {{ trans('order.back_modify') }} </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-1 col-hidden-sm col-hidden-xs">
                                <a title="" data-original-title="" class="btn btn-circle btn-icon-only btn-default fullscreen accro" href="javascript:;"><i class="fa fa-angle-down" style="font-size: 25px;" ></i> </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- End Basic Info Display -->

                <!-- Start Add Picture Input Form -->
                <div id="section-add-picture-input" class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="portlet light" style="background-color:#fff; padding-bottom:0px">
                            <div class="portlet-title custom-portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase" style="color:#000 !important;font-size:18px">
                                        {{ trans('order.picture_add') }}
                                    </span>
                                </div>
                            </div>
                            <div class="portlet-body" id="sdr">
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs cus-width" style="padding-left:0px; padding-right:0px">
                                    </div>
                                    <div class="col-md-10" style="padding-left:0px; padding-right:0px">
                                        <span class="cs-title"> {{ trans('order.pic_clothing_style') }} </span><br>
                                        <span style="font-size:14px"> {{ trans('order.type_of_pic') }} </span>
                                    </div>
                                </div>
                                <!-- Image no 1 - 3-->
                                <div class="row" style="margin-top:20px;margin-bottom:20px">
                                    <div id="div-add-picture" class="col-md-2 col-sm-12 col-xs-12 cus-width" style="">
                                        <div class="sdf text-center custom-small-box">
                                            <i class="fa fa-plus-circle big-plus" ></i><br><br>
                                            <span style="color:#000;font-size:14px"> {{ trans('order.picture_add') }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-10" style="padding-right:0px">
                                        <div class="row">
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-1" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-1" src="{{ isset($data) && isset($data['image']['imgUserUpload-1']) ? $data['image']['imgUserUpload-1'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-1" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details" >
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        1
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-1" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-1']) ? $data['image']['imgExistingID-1'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-2" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-2" src="{{ isset($data) && isset($data['image']['imgUserUpload-2']) ? $data['image']['imgUserUpload-2'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-2" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        2
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-2" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-2']) ? $data['image']['imgExistingID-2'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-3" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-3" src="{{ isset($data) && isset($data['image']['imgUserUpload-3']) ? $data['image']['imgUserUpload-3'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-3" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        3
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-3" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-3']) ? $data['image']['imgExistingID-3'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image no 4 - 6-->
                                <div id="div-PictureUpload-Sec2" class="row" style="margin-top:20px;margin-bottom:20px;display:none">
                                    <div class="col-md-2 col-sm-12 col-xs-12 cus-width" style="">
                                    </div>
                                    <div class="col-md-10" style="padding-right:0px">
                                        <div class="row">
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-4" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-4" src="{{ isset($data) && isset($data['image']['imgUserUpload-4']) ? $data['image']['imgUserUpload-4'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-4" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        4
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-4" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-4']) ? $data['image']['imgExistingID-4'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-5" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-5" src="{{ isset($data) && isset($data['image']['imgUserUpload-5']) ? $data['image']['imgUserUpload-5'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-5" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        5
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-5" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-5']) ? $data['image']['imgExistingID-5'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-6" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-6" src="{{ isset($data) && isset($data['image']['imgUserUpload-6']) ? $data['image']['imgUserUpload-6'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-6" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        6
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-6" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-6']) ? $data['image']['imgExistingID-6'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image no 7 - 9-->
                                <div id="div-PictureUpload-Sec3" class="row" style="margin-top:20px;margin-bottom:20px;display:none">
                                    <div class="col-md-2 col-sm-12 col-xs-12 cus-width" style="">
                                    </div>
                                    <div class="col-md-10" style="padding-right:0px">
                                        <div class="row">
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-7" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-7" src="{{ isset($data) && isset($data['image']['imgUserUpload-7']) ? $data['image']['imgUserUpload-7'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-7" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        7
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-7" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-7']) ? $data['image']['imgExistingID-7'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-8" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-8" src="{{ isset($data) && isset($data['image']['imgUserUpload-8']) ? $data['image']['imgUserUpload-8'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-8" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        8
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-8" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-8']) ? $data['image']['imgExistingID-8'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 portfolio-item" style="padding-left:5px;">
                                                <div class="portfolio-item-inner">
                                                    {{--*/ usleep(1) /*--}}
                                                    {{--*/ $fid = uniqid() /*--}}
                                                    <input id="fileUpload-9" name="guide[{{ $fid }}][image]" type="file" style="display:none" />
                                                    <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                                                        <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                                            <img id="imgUserUpload-9" src="{{ isset($data) && isset($data['image']['imgUserUpload-9']) ? $data['image']['imgUserUpload-9'] : 'http://placehold.it/700x400' }}" alt="">
                                                        </div>
                                                    </div>
                                                    <div id="div-img-footer-9" class="row no-margin-side" style="display:none">
                                                        <div class="col-md-12 col-sm-12 portfolio-details">
                                                            <p class="row custom-marg">
                                                                <span class="pull-left">
                                                                    <a class="btn btn-circle btn-icon-only btn-default btn-po" href="javascript:;">
                                                                        9
                                                                    </a>
                                                                </span>
                                                                <span id="removeImage-9" class="pull-right custom-trah" imageUploadID="{{ isset($data) && isset($data['image']['imgExistingID-9']) ? $data['image']['imgExistingID-9'] : '' }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::hidden('hidUploadImageInfo', isset($data) && isset($data['hidUploadImageInfo']) ? $data['hidUploadImageInfo'] : '', ['id'=>'hidUploadImageInfo']) !!}
                                {!! Form::hidden('hidDeleteExistingImageIDList', '', ['id'=>'hidDeleteExistingImageIDList']) !!}
                                <div class="row">
                                    <div class="col-md-12"><hr/></div>
                                </div>

                                <div class="row" >
                                    <div class="col-md-2 col-sm-12 col-xs-12" >
                                    </div>
                                    <div class="col-md-10" style="padding-left:0px">
                                        <div class="row">
                                        <div class="col-md-2 col-sm-12 col-xs-12" style="padding-left:0px">
                                            <span class="cs-title"> {{ trans('order.process_instructions') }} </span><br>
                                            <span style="font-size:14px"> {{ trans('order.text_remarks_indicate') }} </span>
                                        </div>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                        {!! Form::textarea('remark', isset($order) && isset($order->remark) ? $order->remark : '', ['id'=>'remark', 'class'=>'form-control custom-textarea', 'cols'=>'25', 'rows'=>'2']) !!}
                                    </div>
                                     <div class="col-md-1 col-sm-12 col-xs-12">
                                    </div>


                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12"><hr/></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs cus-width" style="padding-left:0px; padding-right:0px">

                                    </div>
                                    <div class="col-md-10" style="padding-left:0px; padding-right:0px">
                                        <span class="cs-title"> {{ trans('order.sample_2d') }} </span><br>
                                        <span style="font-size:14px"> {{ trans('order.2d_prototype_upload_info') }} </span>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-2 col-sm-12 col-xs-12 cus-width">
                                        <div class="sdf text-center custom-small-box">
                                            <a class="btn btn-circle btn-icon-only btn-default btn-po-blue" href="javascript:;">
                                                <img src="/images/t-shirt.png"/>
                                            </a><br><br>
                                            <span style="color:#000;font-size:14px"> {{ trans('order.make_2d_sample') }} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-10" style="padding-left:0px">
                                    <div class="row" style="margin-bottom:20px">
                                        <div class="col-md-4 portfolio-item">
                                            <div class="portfolio-item-inner">
                                                <a href="javascript:;">
                                                    <img class="img-responsive" src="http://placehold.it/277x230" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 portfolio-item">
                                            <div class="portfolio-item-inner">
                                                <a href="javascript:;">
                                                    <img class="img-responsive" src="http://placehold.it/277x230" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 portfolio-item">
                                            <div class="portfolio-item-inner">
                                                <a href="javascript:;">
                                                    <img  src="http://placehold.it/277x230" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <div class="row">
                                <div class="col-md-1 col-hidden-sm col-hidden-xs">
                                </div>
                                <div class="col-md-11" style="padding-left: 0px;">
                                    <ul class="list-inline">
                                        <li>
                                            <button id="btnPicInputFormNext" type="button" class="btn btn-primary border-radius-5 button-next foot-btn"> {{ trans('order.next') }} </button>
                                        </li>
                                        <li>
                                            <button id="btnPicInputFormCancel" type="button" class="btn default border-radius-5 foot-btn-1" onclick="location.href='{{ route('home') }}';"> {{ trans('order.cancel') }} </button>
                                        </li>
                                        <li>
                                            <button id="btnPicInputFormModify" type="button" class="btn border-radius-5 button-modify" style="display:none" > {{ trans('order.back_modify') }} </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Add Picture Input Form -->

                <!-- Start Payment Info Form -->
                <div id="section-payment-info" class="row" style="display:none">
                    <div class="col-md-12">
                        <div class="portlet light" style="background-color:#fff; padding-bottom:0px">
                            <div class="portlet-title custom-portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase" style="color:#000 !important;font-size:18px"> {{ trans('order.payment_information') }} </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                    </div>
                                    <div class="col-md-8" style="padding-left:0px">
                                        <div class="row">
                                            <div class="col-md-12 custom-blk" id="custom-blk1">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch" style="float:left">
                                                            <input id="ts-urgent-post" name="ts-urgent-post" class="cmn-toggle cmn-toggle-round" type="checkbox" style="display:none">
                                                            <label for="ts-urgent-post"></label>
                                                            {!! Form::hidden('hid-urgent-post', isset($order) && isset($order->urgent_post) ? $order->urgent_post : '0', ['id'=>'hid-urgent-post']) !!}
                                                        </div> &emsp;&emsp; &emsp;&emsp;
                                                        <span class="custom-over" style="font-size:18px"> {{ trans('order.whether_expedited') }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                </div>
                                <div class="col-md-8" style="padding-left:0px">
                                    <div class="row">
                                        <div class="col-md-12 custom-blk" id="custom-blk1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="switch" style="float:left">
                                                        <input id="ts-extra-size" name="ts-extra-size" class="cmn-toggle cmn-toggle-round" type="checkbox" style="display:none">
                                                        <label for="ts-extra-size"></label>
                                                        {!! Form::hidden('hid-extra-size', isset($order) && isset($order->grading_needed) ? $order->grading_needed : '0', ['id'=>'hid-extra-size']) !!}
                                                    </div> &emsp;&emsp; &emsp;&emsp;
                                                    <span class="custom-over" style="font-size:18px"> {{ trans('order.whether_extra_size') }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs" style="padding-right:0px">
                                    </div>
                                    <div class="col-md-8" style="padding-left:0px">
                                        <div style="overflow:auto;">
                                            <span style="display:inline-block;font-weight:bold;font-size:16px"> {{ trans('order.pay_price') }} </span>&emsp;
                                            {!! Form::Text('pay_price', isset($order) && isset($order->pay_price) ? $order->pay_price : 99000, ['id'=> 'pay_price', 'class'=>'form-control custom-text-box'])  !!}&nbsp;
                                            <span style="display:inline-block;font-size:14px"> {{ trans('order.lowest_reference_price') }} ： 300 </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs" style="padding-right:0px">
                                    </div>
                                    <div class="col-md-8" style='margin-bottom:20px;padding-left:0px'>
                                        <div style="overflow:auto;">
                                            <span style="display:inline-block;font-weight:700;font-size:16px">
                                                {{ trans('order.pay_method') }}
                                            </span> &emsp;

                                            <label>
                                                <input id="chbWeipay" type="checkbox" name="chbWeipay"  value="1">
                                            </label>
                                            <div class="pyt-logo frd">
                                                <img src="/images/chat_icon.png"/>
                                                {{ trans('order.wechat_pay') }}
                                            </div> &emsp;

                                            <label>
                                                <input id="chbZhifuBao" type="checkbox" name="chbZhifuBao" value="0">
                                            </label>&nbsp;
                                            <div class="pyt-logo frd">
                                                <img src="/images/ch_icon.png"/>
                                                {{ trans('order.alipay')  }}
                                            </div>
                                        </div>
                                        {!! Form::hidden('payment_method', isset($order) && isset($order->payment_method) ? $order->payment_method : '2', ['id'=>'payment_method']) !!}
                                    </div>
                                    <div class="col-md-2 col-hidden-sm col-hidden-xs">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="foot">
                            <div class="row">
                                <div class="col-md-1 col-hidden-sm col-hidden-xs">
                            </div>
                            <div class="col-md-11" style="padding-left: 0px;">
                                <ul class="list-inline">
                                    <li>
                                        <button id="btn-submit" type="button" class="btn btn-primary border-radius-5 foot-btn"> {{ trans('order.confirm_pay') }} </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn default border-radius-5 foot-btn-1" onclick="location.href='{{ route('home') }}';"> {{ trans('order.cancel') }} </button>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Payment Info Form -->
                {!! Form::hidden('page', 1, ['id' => 'page-container']) !!}

                {!! Form::hidden('order_id', isset($order) && isset($order->id) ? $order->id : null, ['id' => 'order-id-container']) !!}

                <!--
                {!! Form::hidden('order_id', 82, ['id' => 'order-id-container']) !!}
                -->
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END CONTENT -->
@endsection

@section('footer')
    {{--<!-- BEGIN PAGE LEVEL PLUGINS -->--}}
    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    {{--<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>--}}
    <script src="/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
    {{--<!-- END PAGE LEVEL PLUGINS -->--}}
    {{--<!-- BEGIN PAGE LEVEL SCRIPTS -->--}}

    {{--<!-- END PAGE LEVEL SCRIPTS -->--}}
    {{--<!-- BEGIN PAGE LEVEL PLUGINS -->--}}
    <script src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
    {{--<!-- END PAGE LEVEL PLUGINS -->--}}
    {{----}}
    {{--<!-- BEGIN PAGE LEVEL SCRIPTS -->--}}
    {{--<script src="/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>--}}
    {{--<!-- BEGIN PAGE LEVEL PLUGINS -->--}}
    <script src="/assets/global/plugins/fuelux/js/spinner.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>
    {{--<script src="/assets/global/scripts/app.min.js" type="text/javascript"></script>--}}
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-bootpag/jquery.bootpag.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/pingpp.js"></script>
    <script src="/custom/js/frontend/createOrderV2.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function () {
                $('#submit_form').ajaxForm({
                    beforeSubmit: function () {
                    },
                    success: function (resp) {
                        if (resp.status == 'success') {
                            var page = parseInt($('#page-container').val());
                            var goto = parseInt(page);

                            if( goto == 1 ){
                                $('#section-basic-info').hide();
                                $('#section-basic-info-display').show();
                                $('#section-add-picture-input').show();
                                $('#section-payment-info').hide();
                                $('#page-container').val(2);
                                App.scrollTo($('#section-add-picture-input'));
                            }

                            if (goto == 2) {
                                //reset image upload list
                                for(var i = 1; i <= 9; i++ ){
                                    $('#imgUserUpload-' + i ).attr('src', 'http://placehold.it/700x400');
                                    $('#removeImage-' + i ).attr('imageuploadid', '');
                                    $('#div-img-footer-' + i ).hide();
                                }
                                $('#hidDeleteExistingImageIDList').val('');
                                $('#hidUploadImageInfo').val('');

                                //refill existing upload image
                                var imageIDList = resp.data.data['imageID'];
                                var imageUrlList = resp.data.data['imageUrl'];
                                var uploadImageInfo = '';
                                if( imageIDList != undefined ){
                                    for(var i = 1; i <= Object.keys(imageIDList).length; i++ ){
                                        var id = imageIDList['imgExistingID-' + i ];
                                        var url = imageUrlList['imgUserUpload-' + i];

                                        $('#imgUserUpload-' + i ).attr('src', url);
                                        $('#removeImage-' + i ).attr('imageuploadid', id);
                                        $('#div-img-footer-' + i ).show();

                                        if( uploadImageInfo == '' ){
                                            uploadImageInfo = i;
                                        }else{
                                            uploadImageInfo = uploadImageInfo + '|' + i;
                                        }
                                    }
                                }
                                $('#hidUploadImageInfo').val(uploadImageInfo);

                                $('#section-payment-info').show();
                                $('#btnPicInputFormNext').hide();
                                $('#btnPicInputFormCancel').hide();
                                $('#btnPicInputFormModify').show();
                                $('#page-container').val(3);
                                App.scrollTo($('#custom-blk1'));
                            }

                            if (typeof resp.data.redirect !== 'undefined' && resp.data.redirect == 1) {
                                if (typeof resp.data.charge_object !== 'undefined') {
                                    if (resp.data.charge_object.channel == 'alipay_wap') {
                                        pingpp.createPayment(resp.data.charge_object, function (result, err) {

                                        });
                                    } else if (resp.data.charge_object.channel == 'wx_pub_qr') {
                                        if (typeof resp.data.charge_object.credential.wx_pub_qr !== 'undefined') {
                                            var q = resp.data.charge_object.credential.wx_pub_qr;
                                            url = '{{ route('payment.showqr') }}';
                                            data = {
                                                q: q,
                                                oid: resp.data.charge_object.order_no,
                                                channel: resp.data.charge_object.channel
                                            };
                                            window.location.href = '{{ route('payment.showqr') }}' + '?' + encodeQueryData(data);
                                        } else {
                                            alertError('{{ trans('common.unknown_error') }}');
                                        }
                                    }
                                } else {
                                    window.location.href = '{{ route('frontend.mypublishorder') }}';
                                }
                            }
                        } else {
                            alertError(resp.msg);
                            App.scrollTo($('.page-title'));
                        }

                        if (typeof resp.data.order_id !== 'undefined') {
                            $('#order-id-container').val(resp.data.order_id);
                        }

                        App.unblockUI('#submit_form');
                    },
                    error: function (response, statusText, xhr, formElm) {
                        var first = true;
                        if (response.status == 422) {
                            $.each(response.responseJSON, function(i) {
                                $.each(response.responseJSON[i], function(key, value) {
                                    App.alert({
                                        type: 'danger',
                                        icon: 'warning',
                                        message: value,
                                        container: '#body-alert-container',
                                        reset: first,
                                        focus: scroll,
                                    });
                                    if (first === true) {
                                        first = false;
                                    }
                                });
                            });
                        }
                        App.unblockUI('#submit_form');
                    }
                });

                $('#btn-submit').on('click', function () {
                    $('#page-container').val(3);
                    $('#submit_form').submit();
                });

            });
        }(jQuery);
    </script>
@endsection