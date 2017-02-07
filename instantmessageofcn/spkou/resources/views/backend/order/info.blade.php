@extends('backend.layout')

@section('title')
   信息
@endsection

@section('description')
    新增/编辑/删除 银行
@endsection

@section('breadcrumb')
    <ul class="page-breadcrumb">
        <li>
            <a href="javascript:;">后台</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ route('backend.order') }}">订单管理</a>
        </li>
    </ul>
@endsection

@section('header')
    <link href="/custom/plugins/colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
    <link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" /> -->
	<link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <!-- <link href="/custom/css/frontend/createOrder.css" rel="stylesheet" type="text/css" /> -->
    <style type="text/css">
    	.page-content
    	{
		    min-height: 850px !important;
    	}
    	.col-md-5ths {
			width: 20%;
		    float: left;
		}
    </style>
@endsection

@section('footer')
    <script src="/custom/plugins/colorpicker/js/colorpicker.js"></script>
@endsection

@section('content')
    <div class="tab-pane active" id="tab1">
		<div class="form-group">
			<label class="control-label col-md-3">{{ trans('order.need_complete') }}</label>
			<div class="col-md-4">
				<div class="input-group date form_datetime" data-date="{{ Carbon::now('Asia/Singapore')->addDay()->format('Y-m-d'). 'T' . Carbon::now('Asia/Singapore')->addDay()->format('H:i:s').'Z' }}">
					<input type="text" name="planned_date" class="form-control" value="{{ isset($model) && $model->planned_date ? $model->getPlannedDate() : '' }}">
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
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.style') }}</label>
			<div class="col-md-9">
				<div class="input-group col-md-12">
					<div class="icheck-inline">
					<?php $categories = \App\Models\Category::where('level',1)->get();?>
					@foreach ($categories as $key => $var)
						<label class="col-md-3 pull-left">
							<input type="radio" name="c_one" class="icheck l1" value="{{ $var->id }}" data-title="{{ $var->title_en.' ( '.$var->title_cn.' )' }}"{{ isset($var) && $var->id == $model->style_id ? ' checked' : '' }}>{{ $var->title_en.' ( '.$var->title_cn.' )' }}</label>
						</label>
					@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.material') }}</label>
			<div class="col-md-8">
				<div class="input-group col-md-12">
					<div class="icheck-inline">
						@foreach (\App\Constants::getMaterialLists() as $key => $var)
							<label class="col-md-3">
								<input type="radio" name="material" class="icheck" data-title="{{ $var }}" value="{{ $key }}"{{ isset($model) && $model->material == $key ? ' checked' : '' }} />{{  $var }}
							</label>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.body_shape') }}</label>
			<div class="col-md-8">
				<div class="input-group col-md-12">
					<div class="icheck-inline">
						<?php $body_shape = \App\Constants::getBodyShapeLists();?>
						@foreach ( $body_shape as $key => $var)
							<label class="col-md-3">
								<input type="radio" name="bodyshape" class="icheck" data-title="{{ $var }}" value="{{ $key }}"{{ isset($model) && $model->body_shape == $key ? ' checked' : '' }} />{{  $var }}
							</label>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<?php $currentTopBottom = \App\Models\Category::where('parent_id', '=', $model->style_id)->get();?>
		<div class="form-group" id="level-2-container" style="{{ count($currentTopBottom) != 0 ? '' : 'display: none;' }}">
			<label class="control-label col-md-3"> {{ trans('order.top_bottom') }}</label>
			<div class="col-md-8">
				<div class="input-group col-md-12 level-2-inner-container">
					<div class="icheck-inline">
						@if (isset($currentTopBottom))
							@include('frontend.createOrder.category2', ['categories' => $currentTopBottom, 'model' => $model])
						@endif
					</div>
				</div>
			</div>
			<!-- <div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div> -->
		</div>
		<?php if ($model->category_id != null) {
                $currentCategory = \App\Models\Category::where('parent_id', '=', $model->top_bottom_id)->get();
            }
            else
            {
                $currentCategory = null;
            }
		?>
		<div class="form-group" id="level-3-container" style="{{ count($currentTopBottom) != 0 ? '' : 'display: none;' }}">
			<label class="control-label col-md-3">
			</label>
			<div class="col-md-8">
				<div class="input-group col-md-12 level-3-inner-container">
					<div class="icheck-inline">
						@if (isset($currentCategory) && $currentCategory != null)
							@include('frontend.createOrder.category3', ['categories' => $currentCategory, 'model' => $model])
						@endif
					</div>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-md-3">{{ trans('order.size_deatil') }}</label>
			<div class="col-md-9">
				<div class="input-group col-md-12" style="line-height: 30px;">
	                <!-- <label class="col-md-2">
	                    <button type="button" class="btn default" data-toggle="modal" data-target="#modalCreateOrderSizeTable">{{ trans('order.modify') }}</button>
	                </label> -->
	                <?php $size = \App\Models\OrderSize::where('order_id', $model->id)->get(); ?>
	                
	                <span class="part-name col-md-10">
	                	@foreach ( $size as $key => $var)
	                		{{ $var->size_type."&nbsp;&nbsp;: ".$var->size.' | ' }}
	                	@endforeach
	                </span>
	                
				</div>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.seal_width') }}</label>
			<div class="col-md-9 switch-align">
				<input type="checkbox" class="make-switch" name="custom_seal" value="1"{{ isset($model) && $model->seal_width == 0 ? '' : ' checked' }} data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
			</div>
			
		</div>
		<div class="form-group">
			<label class="control-label col-md-3">
			</label>
			<div class="col-md-9">
				<div class="input-group col-md-12">
					<div class="icheck-inline">
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck common_seal_check" name="common_seal_check" value="1"{{ isset($model) && $model->common_seal == 1 ? ' checked' : '' }}> {{ trans('order.common_seal') }}
	                        <span class="inp_common_seal_check" style="{{ isset($model) && $model->common_seal == 1 ? '' : 'display:none;' }}">
	                            <input type="text" class="input-size btm-line" value="{{ isset($model) ? $model->common_seal_num : '' }}" name="common_seal">&nbsp;cm
	                        </span>
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck seal3_check" name="seal3_check" value="1"{{ isset($model) && $model->seal3 == 1 ? ' checked' : '' }}> {{ trans('order.seal_3') }}
						    <span class="inp_seal3_check" style="{{ isset($model) && $model->seal3 == 1 ? '' : 'display:none;' }}">
						        <input type="text" class="input-size btm-line" value="{{ isset($model) ? $model->seal_3_num : '' }}" name="seal3">&nbsp;cm
	                        </span>
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck seal2_check" name="seal2_check" value="1"{{ isset($model) && $model->seal2 == 1 ? ' checked' : '' }}> {{ trans('order.seal_2') }}
							<span class="inp_seal2_check" style="{{ isset($model) && $model->seal2 == 1 ? '' : 'display:none;' }}">
							    <input style="width: 20%;" type="text" class="input-size btm-line" value="{{ isset($model) ? $model->seal_2_num : '' }}" name="seal2" disabled="disabled">&nbsp;cm
	                        </span>
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck seal1_check" name="seal1_check" value="1"{{ isset($model) && $model->seal1 == 1 ? ' checked' : '' }}> {{ trans('order.seal_1') }}
							<span class="inp_seal1_check" style="{{ isset($model) && $model->seal1 == 1 ? '' : 'display:none;' }}">
							    <input type="text" class="input-size btm-line" value="{{ isset($model) ? $model->seal_1_num : '' }}" name="seal1">&nbsp;cm
	                        </span>
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck niddle_size_check" name="niddle_size_check" value="1"{{ isset($model) && $model->niddle_size == 1 ? ' checked' : '' }}> {{ trans('order.niddle_size') }}
							<span class="inp_niddle_size_check" style="{{ isset($model) && $model->niddle_size == 1 ? '' : 'display:none;' }}">
	                            <input type="text" class="input-size btm-line" value="{{ isset($model) ? $model->niddle_size_num : '' }}" name="niddle_size">&nbsp;cm
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
							<input type="checkbox" class="icheck" name="include_seal" value="1" id="include-seal-switch"{{ isset($model) && $model->include_seal == 1 ? ' checked' : '' }}> {{ trans('order.include_seal') }}
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck include-seal-related" name="front_big_back" value="1" id="include-seal-one" {{ isset($model) && $model->front_big_back_small == 1 ? 'checked' : 'disabled' }}> {{ trans('order.front_big_back') }}
	                    </div>
						<div class="col-md-5ths">
							<input type="checkbox" class="icheck include-seal-related" name="front_small_back" value="1" id="include-seal-two" {{ isset($model) && $model->front_small_back_big == 1 ? 'checked' : 'disabled' }}>  {{ trans('order.front_small_back') }}
	                    </div>
	                    <div class="col-md-4">
	                        <input type="text" style="width: 20%;" class="input-size include-seal-related" name="include_seal_num_1" value="{{ isset($model) && $model->include_seal_num_1 ? $model->include_seal_num_1 : '' }}" disabled>&nbsp;cm&nbsp;({{ trans('order.size_front') }})
	                        &nbsp;&nbsp;&nbsp;&nbsp;
	                        <input type="text" style="width: 20%;" class="input-size include-seal-related" name="include_seal_num_2" value="{{ isset($model) && $model->include_seal_num_2 ? $model->include_seal_num_2 : '' }}" disabled>&nbsp;cm&nbsp;({{ trans('order.size_back') }})
	                    </div>
					</div>
				</div>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.decrease_rate') }}</label>
			<div class="col-md-9 switch-align">
				<input type="checkbox" class="make-switch" name="decrease_rate" value="1" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>">
			</div>
			<!-- <div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div> -->
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"></label>
			<div class="col-md-3" style="padding-top: 15px;">
	            <label class="control-label col-md-3 lbl-touchspin"> {{ trans('order.pararal') }} </label>
				<input class="col-md-3" id="touchspin-pararal" type="text" value="{{ isset($model) ? $model->parar.'%' : '' }}" name="parar" class="form-control" disabled>
			</div>
			<div class="col-md-3" style="padding-top: 15px;">
				<label class="control-label col-md-4 lbl-touchspin"> {{ trans('order.horizontal') }} </label>
				<input class="col-md-3" id="touchspin-horizontal" type="text" value="{{ isset($model) ? $model->horiz.'%' : '' }}" name="horiz" class="form-control" disabled>
			</div>
			<div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> {{ trans('order.composition') }}</label>
			<div class="col-md-9 switch-align">
				<input type="checkbox" class="make-switch" name="custom_raw_material_switch" value="1" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times' ></i>">
			</div>
			<!-- <div class="col-md-12 hr"> <hr style="border-top: 1px solid black;"> </div> -->
		</div>
		<div class="form-group">
			<label class="control-label col-md-3"> </label>
			<div class="col-md-8">
				<div class="input-group col-md-6">
					<div>
						
						@foreach (\App\Models\RawMaterial::GetMaterial()->get() as $key => $var)
							<button type="button" class="btn btn-gray raw-material pull-left mr5" style="margin: 5px 5px 0 0;" data-text="{{ $var->name_en.'( '.$var->name_cn.' )' }}"> {{ $var->name_en.'( '.$var->name_cn.' )' }} </button>
						@endforeach
					</div>
				</div>
				<br/>
	            <div class="clearfix">
					<label class="col-md-3 lbl-raw-material"> {{ trans('order.material_include') }}  </label>
					<?php $name_material = \App\Models\OrderMaterial::where('order_id',$model->id)->get();?>
					
				    	<input class="tag-input col-md-3" type="text" name="raw_materials" id="raw-material-tags" value="@foreach ($name_material as $key => $var) {{ isset($var) ? $var->percent.'% '.$var->material_name : '' }} @endforeach" data-role="tagsinput" disabled>
				    
				</div>
	            <!-- <div class="row" style="padding-top: 15px;">
	                <div class="col-md-3">
	                    <input id="touchspin-raw-material" type="text" value="{{ $var->percent}}" class="form-control">
	                </div>
	                <div class="col-md-2">
	                    <input id="material-name-container" type="text" value="{{ $var->material_name }}" name="materialname" class="form-control">
	                </div>
	                <div class="col-md-2">
	                    <!-- <button type="button" class="btn btn-gray" id="material-add-btn"> + {{ trans('order.add') }} </button> -->
	                </div>
	            </div>
			</div>
		</div>
	</div>
	
@endsection
