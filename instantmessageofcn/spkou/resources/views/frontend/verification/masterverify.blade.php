@extends('ajaxmodal')

@section('title')
{{ trans('member.master_verify') }}
@endsection

@section('content')
{!! Form::open(['route' => 'frontend.verification.master.verify.post', 'method' => 'post', 'id' => 'master-verification-form']) !!}
    <div class="form-body">
        <div class="for-group row" style="margin-bottom: 10px;">
            <div class="col-xs-4 col-md-3">&nbsp;</div>
            <div class="col-xs-8 col-md-8" style="font-size: 12px; color: #cecece; font-weight: bolder;">
                <i class="fa fa-exclamation" style="color: #fff; padding: 3px 8px; border-radius: 999px; background-color: #2ea5f7; font-size: 11px;"></i> {{ trans('member.master_verify_form_security_hint')}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-4 col-md-3">{{ trans('member.real_name') }}</div>
            <div class="col-xs-8 col-md-8">{!! Form::text('real_name', $_G['user']->real_name, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-4 col-md-3">{{ trans('member.id_card_no') }}</div>
            <div class="col-xs-8 col-md-8">{!! Form::text('id_card_no', $_G['user']->id_card_no, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group row">
            <div class="col-xs-4 col-md-3">
                {{ trans('member.gender') }}
            </div>
            <div class="col-xs-8 col-md-8">
                <div class="md-radio pull-left" style="margin-right: 10px;">
                    {!! Form::radio('gender', 0, $_G['user']->gender == 0 ? true : false, ['class' => 'md-radiobtn', 'id' => 'gender-male']) !!}
                    <label for="gender-male" style="color: #000;">
                        <span class="inc"></span>
                        <span class="check"></span>
                        <span class="box"></span> {{ trans('member.male') }}
                    </label>
                </div>
                <div class="md-radio has-error pull-left">
                    {!! Form::radio('gender', 1, $_G['user']->gender == 1 ? true : false, ['class' => 'md-radiobtn', 'id' => 'gender-female']) !!}
                    <label for="gender-female" style="color: #000;">
                        <span class="inc"></span>
                        <span class="check"></span>
                        <span class="box"></span> {{ trans('member.female') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row" style="margin-bottom: 0;">
            <hr />
        </div>
        <div class="form-group row">
            <h4 class="text-center" style="margin-top: 0;">{{ trans('member.id_card_upload') }}</p>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                <p class="text-center">{{ trans('member.front_id_card') }}</p>
                <div class="portfolio-item" style="padding-left:5px;">
                    <div class="portfolio-item-inner">
                        <input id="front-image-uploader" name="id_image_front" type="file" style="display:none" />
                        <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                            <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                <img id="front-image" src="http://placehold.it/255x170" data-ori-src="http://placehold.it/255x170" alt="" width="250" height="170" class="img-responsive" style="width: 250px; height: 170px;" />
                            </div>
                        </div>
                        <div class="row no-margin-side" style="display:none">
                            <div class="col-md-12 col-sm-12 portfolio-details" >
                                <p class="row custom-marg">
                                    <span class="pull-right custom-trah">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px;">
                    <button type="button" id="front-id-btn" class="btn btn-orange">{{ trans('common.upload') }}</button>
                    <button type="button" id="front-id-btn-delete" class="btn btn-orange" style="display: none;">{{ trans('common.delete') }}</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <p class="text-center">{{ trans('member.back_id_card') }}</p>
                <div class="portfolio-item" style="padding-left:5px;">
                    <div class="portfolio-item-inner">
                        <input id="back-image-uploader" name="id_image_back" type="file" style="display:none" />
                        <div class="fileinput fileinput-exists" style="width:100%; height:180px;">
                            <div class="fileinput-preview thumbnail borderless" style="width: 100%; height: 100%;">
                                <img id="back-image" src="http://placehold.it/255x170" data-ori-src="http://placehold.it/255x170" alt="" width="250" height="170" class="img-responsive" style="width: 250px; height: 170px;" />
                            </div>
                        </div>
                        <div class="row no-margin-side" style="display:none">
                            <div class="col-md-12 col-sm-12 portfolio-details" >
                                <p class="row custom-marg">
                                    <span class="pull-right custom-trah">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px;">
                    <button type="button" id="back-id-btn" class="btn btn-orange">{{ trans('common.upload') }}</button>
                    <button type="button" id="back-id-btn-delete" class="btn btn-orange" style="display: none;">{{ trans('common.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection

@section('footer')
    <button type="button" id="btn-submit-master-verification" class="btn btn-orange">{{ trans('member.submit_verify') }}
@endsection

@section('script')
<script>
+function ($) {
    $(document).ready(function () {
        function previewImage(input, selector) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(selector).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#master-verification-form').makeAjaxForm({
            submitBtn: '#btn-submit-master-verification',
            inModal: true,
            closeModal: true,
            successRefresh: true,
        });

        $('#front-id-btn').on('click', function () {
            $('#front-image-uploader').trigger('click');
        });

        $('#front-image-uploader').on('change', function () {
            var fileName = $(this).val();
            if (typeof fileName !== 'undefined' && fileName != '') {
                $('#front-id-btn').hide();
                $('#front-id-btn-delete').show();
                previewImage(this, '#front-image');
            } else {
                $('#front-id-btn-delete').hide();
                $('#front-id-btn').show();
                $('#front-image').prop('src', $('#front-image').data('ori-src'));
            }
        });
        $('#front-id-btn-delete').on('click', function () {
            $('#front-image-uploader').val(null).trigger('change');
        });

        $('#back-id-btn').on('click', function () {
            $('#back-image-uploader').trigger('click');
        });

        $('#back-image-uploader').on('change', function () {
            var fileName = $(this).val();
            if (typeof fileName !== 'undefined' && fileName != '') {
                $('#back-id-btn').hide();
                $('#back-id-btn-delete').show();
                previewImage(this, '#back-image');
            } else {
                $('#back-id-btn-delete').hide();
                $('#back-id-btn').show();
                $('#back-image').prop('src', $('#back-image').data('ori-src'));
            }
        });
        $('#back-id-btn-delete').on('click', function () {
            $('#back-image-uploader').val(null).trigger('change');
        });
    });
}(jQuery);
</script>
@endsection