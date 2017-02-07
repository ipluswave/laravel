@extends('backend.layout')

@section('title')
    银行管理
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
            <a href="{{ route('backend.order.conflict') }}">Admin conflict support</a>
        </li>
    </ul>
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/backend/myPublishOrderDetails.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myChat.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="row">
		@if (!empty($error))
			<div class="alert alert-danger display-none">
				<button class="close" data-dismiss="alert"></button> $error 
			</div>
		@endif
		<div class="col-md-8">
			@include('backend.includes.orderChatMessage',['orderId'=>$orderId])	
		</div>
        <div class="col-md-4">
			<div class="portlet box gray-color">
		        <div class="portlet-title">
		            <div class="caption" style="color: black">
		                Admin handle conflicting here
		            </div>
		        </div>
		        <div class="portlet-body form">
		        	<div class="panel panel-default">
	                    <div class="panel-body">
	                    	<a class="btn red btn-block" data-href="{{ route('backend.order.conflict.refund', $orderId) }}" data-redirect="yes" data-toggle="modal" data-target="#confirm-modal" data-header="Confirm?" data-body="Are you sure?">
                                Refund to client
                            </a>
		                    <hr>
		                    <a class="btn green btn-block" data-href="{{ route('backend.order.conflict.refund', $orderId) }}" data-redirect="yes" data-toggle="modal" data-target="#confirm-modal" data-header="Confirm?" data-body="Are you sure?">
                                Release money to tailor
                            </a>
                            <hr>
                            {!! Form::open(['route' => 'backend.order.conflict.forward', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        		<input type="hidden" name="orderId" value="{{ $orderId }}" />
                    			<div class="form-group">
                    				<div class="col-md-12">
				                      	<label for="tailor">Tailor</label>
				                      	<select name="tailor" class="form-control" required>
				                      		<option value="">Choose a tailor</option>
			                      			@foreach ($tailors as $tailor)
											    <option value="{{ $tailor->id }}">{{ $tailor->real_name }}</option>
											@endforeach
			                      		</select>
			                      	</div>
			                    </div>
			                    <div class="form-group">
	                                <div class="col-md-12">
	                                    <button type="submit" class="btn blue btn-block" id="submit-login">
	                                        Move order to this tailor
	                                    </button>
	                                </div>
	                            </div>
                    		{!! Form::close() !!}
	                    </div>
	                </div>
		        </div>        	
	        </div>
        </div>
    </div>
    <!-- END CONTENT -->
@endsection

@section('footer')
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/custom/js/backend/myChatOrderMessage.js" type="text/javascript"></script>
@endsection