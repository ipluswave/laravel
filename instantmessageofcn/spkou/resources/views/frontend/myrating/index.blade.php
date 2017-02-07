@extends('frontend.layouts.default')

@section('title')
{{ trans('common.my_rating') }}
@endsection

@section('description')
{{ trans('common.my_rating') }}
@endsection

@section('author')
@endsection

@section('header')
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height: 503px;">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            {{ trans('common.my_rating') }}
                        </div>
                        <div class="portlet-body">
                            TODO
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
	<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script>
        +function ($) {
            $(document).ready(function () {

            });
        }(jQuery);
    </script>
@endsection




