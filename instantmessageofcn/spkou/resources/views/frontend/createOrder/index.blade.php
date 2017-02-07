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
    <link href="/custom/css/frontend/createOrder.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
            	<div class="col-md-12">
            		<div class="portlet light bordered" id="form_wizard_1">
            			<div class="portlet-body form">
							{!! Form::open(['id' => 'submit_form', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
            					<div class="form-wizard" >
            						<div class="form-body">
            							<h4><strong>{{ trans('order.form_actions') }} </strong></h4>
            							<hr>
            							<ul class="nav nav-pills nav-justified steps">
            								<li>
            									<a href="#tab1" data-toggle="tab" class="active step">
            										<span class="number col-md-2 col-sm-2 col-xs-2 pull-left"> 1 </span>
            										<span class="col-md-10 col-sm-6 col-xs-6">
                                                        <span class="desc">
                                                            {{ trans('order.order_data1') }} </span><br>
                                                        <span class="desc_small hidden-xs hidden-sm">
                                                            {{ trans('order.order_data1_small') }} </span>
                                                    </span>
            									</a>
            								</li>
            								<li>
            									<a href="#tab2" data-toggle="tab" class="step">
            										<span class="number col-md-2 col-sm-2 col-xs-2 pull-left"> 2 </span>
            										<span class="col-md-10 col-sm-6 col-xs-6">
                                                        <span class="desc">
                                                            {{ trans('order.order_data2') }} </span><br/>
                                                        <span class="desc_small hidden-xs hidden-sm">
                                                            {{ trans('order.order_data2_small') }} </span>
                                                    </span>
            									</a>
            								</li>
            								<li>
            									<a href="#tab3" data-toggle="tab" class="step">
            										<span class="number col-md-2 col-sm-2 col-xs-2 pull-left"> 3 </span>
            										<span class="col-md-10 col-sm-6 col-xs-6">
                                                        <span class="desc">
                                                            {{ trans('order.order_data3') }} </span><br>
                                                        <span class="desc_small hidden-xs hidden-sm">
                                                            {{ trans('order.order_data3_small') }} </span>
                                                    </span>
            									</a>
            								</li>
            							</ul>
            							<div class="tab-content">
            								<div class="alert alert-danger display-none">
            									<button class="close" data-dismiss="alert"></button> {{ trans('order.some_error') }} </div>
            								<div class="alert alert-success display-none">
            									<button class="close" data-dismiss="alert"></button> {{ trans('order.validate_success') }} </div>
            								<div class="tab-pane active" id="tab1">
            									<div class="form-group">
            										<label class="control-label col-md-3">{{ trans('order.need_complete') }}</label>
            										<div class="col-md-4">
            											<div class="input-group date form_datetime" data-date="{{ $tomorrowFormatDate }}">
            												<input type="text" name="planned_date" class="form-control" value="{{ isset($order) && $order->planned_date ? $order->getPlannedDate() : '' }}">
            												<span class="input-group-btn" >
            													<button class="btn default date-reset" type="button">
            														<i class="fa fa-times"></i>
            													</button>
            													<button class="btn default date-set" type="button">
            														<i class="fa fa-calendar"></i>
            													</button>
            												</span>

            											</div>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.style') }}</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12">
															<div class="icheck-inline">
															@foreach ($categories as $key => $var)
																<label class="col-md-3 pull-left">
																	<input type="radio" name="c_one" class="icheck l1" value="{{ $var->id }}" data-title="{{ $var->getTitle() }}"{{ isset($order) && $var->id == $order->style_id ? ' checked' : '' }}>{{ $var->getTitle() }}</label>
																</label>
															@endforeach
															</div>
            											</div>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.material') }}</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12">
            												<div class="icheck-inline">
																@foreach (\App\Constants::getMaterialLists() as $key => $var)
																	<label class="col-md-3">
																		<input type="radio" name="material" class="icheck" data-title="{{ $var }}" value="{{ $key }}"{{ isset($order) && $order->material == $key ? ' checked' : '' }} />{{  $var }}
																	</label>
																@endforeach
            												</div>
            											</div>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.body_shape') }}</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12">
            												<div class="icheck-inline">
																@foreach (\App\Constants::getBodyShapeLists() as $key => $var)
																	<label class="col-md-3">
																		<input type="radio" name="bodyshape" class="icheck" data-title="{{ $var }}" value="{{ $key }}"{{ isset($order) && $order->body_shape == $key ? ' checked' : '' }} />{{  $var }}
																	</label>
																@endforeach
            												</div>
            											</div>
            										</div>
            									</div>
            									<div class="form-group" id="level-2-container" style="{{ isset($currentTopBottom) ? '' : 'display: none;' }}">
            										<label class="control-label col-md-3"> {{ trans('order.top_bottom') }}</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12 level-2-inner-container">
            												<div class="icheck-inline">
																@if (isset($currentTopBottom))
																	@include('frontend.createOrder.category2', ['categories' => $currentTopBottom, 'order' => $order])
																@endif
            												</div>
            											</div>
            										</div>
            									</div>
            									<div class="form-group" id="level-3-container" style="{{ isset($currentCategory) ? '' : 'display: none;' }}">
            										<label class="control-label col-md-3">
            										</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12 level-3-inner-container">
            												<div class="icheck-inline">
																@if (isset($currentCategory) && $currentCategory != null)
																	@include('frontend.createOrder.category3', ['categories' => $currentCategory, 'order' => $order])
																@endif
            												</div>
            											</div>
            										</div>
            									</div>
            									<hr>
            									<div class="form-group">
            										<label class="control-label col-md-3">{{ trans('order.size_deatil') }}</label>
            										<div class="col-md-9">
            											<div class="input-group col-md-12">
                                                            <label class="col-md-1">
                                                                <button type="button" class="btn default" data-toggle="modal" data-target="#modalCreateOrderSizeTable">{{ trans('order.modify') }}</button>
                                                            </label>
                                                            <span class="part-name col-md-11">
                                                                {{ trans('order.chest') }}&nbsp;&nbsp;5 ,
                                                                {{ trans('order.waist') }}&nbsp;&nbsp;8 ,
                                                                {{ trans('order.lower_hem') }}&nbsp;&nbsp;5 ,
                                                                {{ trans('order.shirt_length') }}&nbsp;&nbsp;8 ,
                                                                {{ trans('order.cuff_sin') }}&nbsp;&nbsp;5 ,
                                                                {{ trans('order.shoulder_width') }}&nbsp;&nbsp;8 ,
                                                                {{ trans('order.cuff') }}&nbsp;&nbsp;1
                                                            </span>
            											</div>
            										</div>
            									</div>
            									<hr>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.seal_width') }}</label>
            										<div class="col-md-9 switch-align">
            											<input type="checkbox" class="make-switch" name="custom_seal" value="1"{{ isset($order) && $order->seal_width == 0 ? '' : ' checked' }} data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3">
            										</label>
            										<div class="col-md-9">
            											<div class="input-group col-md-12">
            												<div class="icheck-inline">
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck common_seal_check" name="common_seal_check" value="1"{{ isset($order) && $order->common_seal == 1 ? ' checked' : '' }}> {{ trans('order.common_seal') }}
                                                                    <span class="inp_common_seal_check" style="{{ isset($order) && $order->common_seal == 1 ? '' : 'display:none;' }}">
                                                                        <input type="text" class="input-size btm-line" value="{{ isset($order) ? $order->common_seal_num : '' }}" name="common_seal">&nbsp;cm
                                                                    </span>
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck seal3_check" name="seal3_check" value="1"{{ isset($order) && $order->seal3 == 1 ? ' checked' : '' }}> {{ trans('order.seal_3') }}
            													    <span class="inp_seal3_check" style="{{ isset($order) && $order->seal3 == 1 ? '' : 'display:none;' }}">
            													        <input type="text" class="input-size btm-line" value="{{ isset($order) ? $order->seal_3_num : '' }}" name="seal3">&nbsp;cm
                                                                    </span>
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck seal2_check" name="seal2_check" value="1"{{ isset($order) && $order->seal2 == 1 ? ' checked' : '' }}> {{ trans('order.seal_2') }}
            														<span class="inp_seal2_check" style="{{ isset($order) && $order->seal2 == 1 ? '' : 'display:none;' }}">
            														    <input type="text" class="input-size btm-line" value="{{ isset($order) ? $order->seal_2_num : '' }}" name="seal2">&nbsp;cm
                                                                    </span>
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck seal1_check" name="seal1_check" value="1"{{ isset($order) && $order->seal1 == 1 ? ' checked' : '' }}> {{ trans('order.seal_1') }}
            														<span class="inp_seal1_check" style="{{ isset($order) && $order->seal1 == 1 ? '' : 'display:none;' }}">
            														    <input type="text" class="input-size btm-line" value="{{ isset($order) ? $order->seal_1_num : '' }}" name="seal1">&nbsp;cm
                                                                    </span>
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck niddle_size_check" name="niddle_size_check" value="1"{{ isset($order) && $order->niddle_size == 1 ? ' checked' : '' }}> {{ trans('order.niddle_size') }}
            														<span class="inp_niddle_size_check" style="{{ isset($order) && $order->niddle_size == 1 ? '' : 'display:none;' }}">
                                                                        <input type="text" class="input-size btm-line" value="{{ isset($order) ? $order->niddle_size_num : '' }}" name="niddle_size">&nbsp;cm
                                                                    </span>
                                                                </div>
            												</div>
            											</div>

            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3">
            										</label>
            										<div class="col-md-9">
            											<div class="input-group col-md-12">
            												<div class="icheck-inline">
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck" name="include_seal" value="1" id="include-seal-switch"{{ isset($order) && $order->include_seal == 1 ? ' checked' : '' }}> {{ trans('order.include_seal') }}
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck include-seal-related" name="front_big_back" value="1" id="include-seal-one" {{ isset($order) && $order->front_big_back_small == 1 ? 'checked' : 'disabled' }}> {{ trans('order.front_big_back') }}
                                                                </div>
            													<div class="col-md-5ths">
            														<input type="checkbox" class="icheck include-seal-related" name="front_small_back" value="1" id="include-seal-two" {{ isset($order) && $order->front_small_back_big == 1 ? 'checked' : 'disabled' }}>  {{ trans('order.front_small_back') }}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="input-size include-seal-related" name="include_seal_num_1" value="{{ isset($order) && $order->include_seal_num_1 ? $order->include_seal_num_1 : '' }}" disabled>&nbsp;cm&nbsp;({{ trans('order.size_front') }})
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <input type="text" class="input-size include-seal-related" name="include_seal_num_2" value="{{ isset($order) && $order->include_seal_num_2 ? $order->include_seal_num_2 : '' }}" disabled>&nbsp;cm&nbsp;({{ trans('order.size_back') }})
                                                                </div>
            												</div>
            											</div>
            										</div>
            									</div>
            									<hr>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.decrease_rate') }}</label>
            										<div class="col-md-9 switch-align">
            											<input type="checkbox" class="make-switch" name="decrease_rate" value="1" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"></label>
            										<div class="col-md-3">
                                                        <label class="control-label col-md-3 lbl-touchspin"> {{ trans('order.pararal') }} </label>
            											<input id="touchspin-pararal" type="text" value="99" name="parar" class="form-control">
            										</div>
            										<div class="col-md-3">
            											<label class="control-label col-md-3 lbl-touchspin"> {{ trans('order.horizontal') }} </label>
            											<input id="touchspin-horizontal" type="text" value="99" name="horiz" class="form-control">
            										</div>
            									</div>
            									<hr>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.composition') }}</label>
            										<div class="col-md-9 switch-align">
            											<input type="checkbox" class="make-switch" name="custom_raw_material_switch" value="1" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> </label>
            										<div class="col-md-8">
            											<div class="input-group col-md-6">
            												<div>
																@foreach ($rawMaterial as $key => $var)
																	<button type="button" class="btn btn-gray raw-material pull-left mr5" style="margin: 5px 5px 0 0;" data-text="{{ $var->getName() }}"> {{ $var->getName() }} </button>
																@endforeach
            												</div>
            											</div>
            											<br/>
                                                        <div class="clearfix">
            												<label class="col-md-2 lbl-raw-material"> {{ trans('order.material_include') }}  </label>
            											    <input class="tag-input col-md-9" type="text" name="raw_materials" id="raw-material-tags" value="{{ isset($order) ? $order->getMaterialsString() : '' }}" data-role="tagsinput">
            											</div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input id="touchspin-raw-material" type="text" value="100" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input id="material-name-container" type="text" value="" name="materialname" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-gray" id="material-add-btn"> + {{ trans('order.add') }} </button>
                                                            </div>
                                                        </div>
            										</div>
            									</div>
            								</div>
            								<div class="tab-pane" id="tab2">
            									<div class="form-group">
            										<label class="control-label col-md-3">{{ trans('order.front_pattern_picture') }}</label>
            										<div class="col-md-2">
            											<div class="fileinput fileinput-new" data-provides="fileinput">
            												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            													<img src="{{ isset($order) && $order->front_pattern_image ? asset($order->front_pattern_image) : '/images/no-image-box.png' }}" alt="" class="img-previewer" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;" id="front-pattern-img-container"> </div>
															<div>
            													<span class="btn default btn-file">
            														<span class="fileinput-new">{{ trans('order.picture_add') }}</span>
            														<span class="fileinput-exists"> {{ trans('member.change') }} </span>
            														<input type="file" name="front_pattern_image" id="front-pattern-image" class="file-with-preview" />
																</span>
            													<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
            													<div class="clearfix margin-top-10">
            														{{ trans('order.attach_introduce') }}
            													</div>
            												</div>
            											</div>
            										</div>
            										<div class="col-md-5 img-explain-align">
														<textarea class="form-control" id="front-pattern-word" rows="7" placeholder="{{ trans('order.picture_s_intro') }}" name="front_image_desc">{{ isset($order) && $order->front_image_desc ? $order->front_image_desc : '' }}</textarea>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.back_pattern_picture') }} </label>
            										<div class="col-md-2">
            											<div class="fileinput fileinput-new" data-provides="fileinput">
            												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            													<img src="{{ isset($order) && $order->back_pattern_image ? asset($order->back_pattern_image) : '/images/no-image-box.png' }}" alt="" class="img-previewer" />
															</div>
            												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;" id="back-pattern-img-container"> </div>
            												<div>
            													<span class="btn default btn-file">
            														<span class="fileinput-new"> {{ trans('order.picture_add') }} </span>
            														<span class="fileinput-exists"> {{ trans('member.change') }} </span>
            														<input type="file" name="back_pattern_image" id="back-pattern-image" class="file-with-preview">
																</span>
            													<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
            													<div class="clearfix margin-top-10">
            														{{ trans('order.attach_introduce') }}
            													</div>
            												</div>
            											</div>
            										</div>
            										<div class="col-md-5 img-explain-align">
														<textarea class="form-control" rows="7" id="back-pattern-word" placeholder="{{ trans('order.picture_s_intro') }}" name="back_image_desc">{{ isset($order) && $order->back_image_desc ? $order->back_image_desc : '' }}</textarea>
            										</div>
            									</div>
            									<hr>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.processing_guide') }}</label>
													<div class="col-md-7" id="guide-all-container">
														@if (isset($order) && $order->processingGuides)
															@foreach ($order->processingGuides as $key => $var)
																<div class="row guide-container">
																	<div class="col-md-4">
																		<div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail{{ $var->image_path ? ' old-guide-image' : '' }}" style="width: 200px; height: 150px;">
																				<img src="{{ $var->image_path ? asset($var->image_path) : '/images/no-image-box.png' }}" alt="" class="img-previewer" />
																			</div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new"> {{ trans('order.picture_add') }} </span>
																					<span class="fileinput-exists"> {{ trans('member.change') }} </span>
																					<input type="file" name="guide[{{ $var->file_id }}][image]" class="file-with-preview">
																				</span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
																						<!--
																				<div class="clearfix margin-top-10">
																					{{ trans('order.attach_introduce') }}
																								</div>
																								-->
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8 img-explain-align">
																		<textarea class="form-control" rows="7" placeholder="{{ trans('order.write_at_here') }}" name="guide[{{ $var->file_id }}][comment]">{{ $var->comment }}</textarea>
																	</div>
																</div>
															@endforeach
														@endif
														<div class="row guide-container" id="guide-original">
															<div class="col-md-4">
																{{--*/ $fid = uniqid() /*--}}
																<div class="fileinput fileinput-new" data-provides="fileinput">
																	<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																		<img src="/images/no-image-box.png" alt="" class="img-previewer" />
																	</div>
																	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																	<div>
																		<span class="btn default btn-file">
																			<span class="fileinput-new"> {{ trans('order.picture_add') }} </span>
																			<span class="fileinput-exists"> {{ trans('member.change') }} </span>
																			<input type="file" name="guide[{{ $fid }}][image]" class="file-with-preview">
																		</span>
																		<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
																		<!--
																		<div class="clearfix margin-top-10">
																			{{ trans('order.attach_introduce') }}
																		</div>
																		-->
																	</div>
																</div>
															</div>
															<div class="col-md-8 img-explain-align">
																<textarea class="form-control" rows="7" placeholder="{{ trans('order.write_at_here') }}" name="guide[{{ $fid }}][comment]"></textarea>
															</div>
														</div>
													</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"></label>
            										<div class="col-md-7">
            											<textarea class="form-control" rows="5" id="remark-txt" placeholder="{{ trans('order.ready_done_content') }}" name="remark">{{ isset($order) && $order->remark ? $order->remark : '' }}</textarea>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> </label>
            										<div class="col-md-4">
            											<div class="clearfix">
            												<button type="button" class="btn btn-gray btn-add-guide"> + {{ trans('order.more_picture') }}</button>
            											</div>
            										</div>
            									</div>
            								</div>
            								<div class="tab-pane" id="tab3">
            									<h4 class="form-section">{{ trans('order.order_detail') }}</h4>
            									<div class="list-item">
                                                    <div class="row">
                                                        <div class="col-md-3 column">{{ trans('member.style') }}：<span id="mirror-c-one">{{ isset($order) && $order->style ? $order->style->getTitle() : '' }}</span></div>
                                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：<span id="mirror-material">{{ isset($order) && $order->material ? $order->explainMaterial() : '' }}</span></div>
                                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：<span id="mirror-bodyshape">{{ isset($order) && $order->body_shape ? $order->explainBodyShape() : '' }}</span></div>
                                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：<span id="mirror-c-two">{{ isset($order) && $order->top_bottom_id ? $order->topBottom->getTitle() : ''}}</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：{{ isset($order) ? $order->explainSealWidth() : '' }}</div>
                                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向<span id="mirror-parar">{{ isset($order) ? $order->parar . '%' : '' }}</span> 横向<span id="mirror-horiz">{{ isset($order) ? $order->horiz . '%' : '' }}</span></div>
                                                        <div class="col-md-5 column" >{{ trans('member.raw_material') }}：<span id="mirror-raw-material">{{ isset($order) ? $order->explainRawMaterials() : '' }}</span></div>
                                                    </div>
                                                </div>
            									<h4 class="form-section">{{ trans('order.size') }}</h4>
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
												<br/>
												<div id="pattern-image-container">
													<h4 class="form-section">{{ trans('order.picture_comment') }}</h4>
													<hr>
													<div class="form-group" id="front-pattern-container">
														<label class="control-label col-md-3"></label>
														<div class="col-md-3">
															<img src="{{ isset($order) && $order->front_pattern_image ? asset($order->front_pattern_image) : '/images/order1.jpg' }}" id="mirror-front-pattern-picture" style="max-width:300px" />
														</div>
														<div class="col-md-4">
															<label class="control-label bold">{{ trans('order.front_pattern_picture') }}</label><p>
															<label class="control-label" id="mirror-front-pattern-word">{{ isset($order) && $order->front_image_desc ? nl2br($order->front_image_desc) : '' }}</label>
														</div>
													</div>
													<div class="form-group" id="back-pattern-container">
														<label class="control-label col-md-3"></label>
														<div class="col-md-3">
															<img src="{{ isset($order) && $order->back_pattern_image ? asset($order->back_pattern_image) : '/images/order2.jpg' }}" id="mirror-back-pattern-picture" style="max-width:300px" />
														</div>
														<div class="col-md-4">
															<label class="control-label bold">{{ trans('order.front_pattern_picture') }}</label><p>
															<label class="control-label" id="mirror-back-pattern-word">{{ isset($order) && $order->back_image_desc ? nl2br($order->back_image_desc) : '' }}</label>
														</div>
													</div>
												</div>
												<br>
												<div id="guide-mirror-outer-container">
													<h4 class="form-section">{{ trans('order.picture_comment') }}</h4>
													<div id="guide-mirror-container">

													</div>
												</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"></label>
            										<div class="col-md-9">
            											<label class="control-label" id="mirror-remark">{{ isset($order) && $order->remark ? nl2br($order->remark) : '' }}</label>
            										</div>
            									</div>
            									<div class="form-group" style="display: none;">
            										<label class="control-label col-md-3"></label>
            										<div class="col-md-9">
            											<button type="button" class="btn default"> + {{ trans('order.data_error') }}</button>
            										</div>
            									</div>
            									<hr>
            									<!--
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.order_option') }}</label>
            										<div class="col-md-6">
            											<div class="input-group col-md-12">
                                                            <label class="col-md-4">
                                                                <input type="checkbox" name="grading_needed" value="1" checked class="icheck" data-title=" {{ trans('order.grading_needed') }}"> {{ trans('order.grading_needed') }} </label>
                                                            <label class="col-md-4">
                                                                <input type="checkbox" name="common_post" value="1" class="icheck" data-title=" {{ trans('order.common_post') }}"> {{ trans('order.common_post') }}</label>
                                                            <label class="col-md-4">
                                                                <input type="checkbox" name="urgent_post" value="1" class="icheck" data-title=" {{ trans('order.urgent_post') }}"> {{ trans('order.urgent_post') }}  </label>
            											</div>
            										</div>
            									</div>
            									-->
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.pay_price') }}</label>
            										<div class="col-md-2">
            											<input id="touchspin-price" type="text" value="{{ isset($order) && $order->pay_price ? $order->pay_price : '' }}" name="pay_price" class="form-control">
            										</div>
            										<div class="col-md-2">
            											<label class="control-label "> {{ trans('order.recommend_price_300') }} </label>
            										</div>
            									</div>
            									<div class="form-group">
            										<label class="control-label col-md-3"> {{ trans('order.pay_method') }}</label>
            										<div class="col-md-8">
            											<div class="input-group col-md-12">
															<label class="col-md-4">
																<input type="radio" name="payment_method"{{ isset($order) && $order->payment_method != 1 ? '' : ' checked' }} class="icheck" value="1" >
																<img src="/images/order_alipay.jpg" />
																</label>
															<label class="col-md-4">
																<input type="radio" name="payment_method"{{ isset($order) && $order->payment_method == 2 ? ' checked' : '' }} class="icheck" value="2" >
																<img src="/images/order_xin.jpg" />
															</label>
															<label class="col-md-4" style="display: none;">
																<input type="radio" name="payment_method"{{ isset($order) && $order->payment_method == 3 ? ' checked' : '' }} class="icheck" value="3" >
																<img src="/images/order_paypal.jpg" />
															</label>
            											</div>
            										</div>
            									</div>
            								</div>
            							</div>
            						</div>
            						<div class="form-actions">
            							<div class="row">
            								<div class="col-md-offset-3 col-md-9">

            									<a href="javascript:;" class="btn blue button-next"> {{ trans('order.next') }}</a>
            									<a href="javascript:;" class="btn red-sunglo button-submit" id="btn-submit"> {{ trans('order.confirm_pay') }}</a>
            									<a href="javascript:;" class="btn default button-previous">{{ trans('order.back') }} </a>
            								</div>
            							</div>
            						</div>
            					</div>
								{!! Form::hidden('page', 1, ['id' => 'page-container']) !!}
								{!! Form::hidden('order_id', isset($order) && isset($order->id) ? $order->id : null, ['id' => 'order-id-container']) !!}
            				{!! Form::close() !!}
            			</div>
            		</div>
            	</div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
		<input type="hidden" value="{{ trans('order.percentage_maximum_exceed') }}" id="raw-material-maximum-percent-msg" />
        <!-- END CONTENT BODY -->
        @include('frontend.includes.modalCreateOrderSizeTable')
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
	<script type="text/javascript" src="/js/pingpp.js"></script>
    <script src="/custom/js/frontend/createOrder.js" type="text/javascript"></script>
	<script>
		+function () {
			$(document).ready(function () {
				$('#submit_form').ajaxForm({
					beforeSubmit: function () {
//						App.blockUI({
//							target: $('#submit_form'),
//							overlayColor: 'none',
//							centerY: true,
//							boxed: true
//						});
					},
					success: function (resp) {
						if (resp.status == 'success') {
							var page = parseInt($('#page-container').val());
							var goto = parseInt(page);

							if (goto == 2 || goto == 3) {
								$('#form_wizard_1').bootstrapWizard('show', goto);
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
				@if (isset($order) && $order->include_seal == 1)
					@if ($order->front_big_back_small == 1)
						$('#include-seal-one').removeAttr('disabled');
					@elseif ($order->front_small_back_big == 1)
						$('#include-seal-two').removeAttr('disabled');
					@endif
					$('input[name="include_seal_num_1"]').removeAttr('disabled');
					$('input[name="include_seal_num_2"]').removeAttr('disabled');
				@endif
			});
		}(jQuery);
	</script>
@endsection




