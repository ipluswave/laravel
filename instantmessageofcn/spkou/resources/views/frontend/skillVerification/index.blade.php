@extends('frontend.layouts.default')

@section('title')
Skill Verification
@endsection

@section('description')
Skill Verification
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/skillVerification.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.skill_verification') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            {!! Form::open(['route' => 'frontend.skillverification.update', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'skill-update-form']) !!}
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('member.work_experience') }}</label>
                                        <div class="col-md-2">
                                            <input id="working_experience" class="form-control" type="text" value="{{ \Auth::guard('users')->user()->experience }}" name="working_experience">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">{{ trans('member.specializes_in_type') }}</label>
                                        <div class="col-md-9">
                                            <input class="col-md-12" type="text" value="" id="advance-filter-tag" name="skills" />
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {!! Form::select('level_one', $category, null, ['class' => 'form-control', 'id' => 'level-one-selector', 'size' => 4]) !!}
                                                </div>
                                                <div class="col-md-4" id="level-two-selector-container">
                                                    <select name="level_two" class="form-control" size="4" id="level-two-selector" style="display: none;">
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="level_three" class="form-control" size="4" id="level-three-selector" style="display: none;">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group button-action" id="selector-add-container" style="display: none;">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-2 add-tag">
                                            <a href="javascript:;" class="btn default" id="selector-add">
                                                <i class="fa fa-plus"></i>{{ trans('member.add') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-offset-3 col-md-9">
                                    <hr>
                                </div>
                                <div class="form-actions">
                                    <div class="form-group button-action">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-2 save">
                                             <button type="button" class="btn blue" id="submit-skill-btn">{{ trans('member.update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>

    <script src="/custom/js/frontend/skillVerification.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function () {
                function clearSelector(level) {
                    $('#selector-add-container').hide();
                    if (level == 1) {
                        $('#level-two-selector').find('option').remove();
                        $('#level-three-selector').find('option').remove();
                        $('#level-three-selector-container').hide();
                    } else if (level == 2) {
                        $('#level-three-selector').find('option').remove();
                        $('#level-three-selector-container').hide();
                    }
                }

                $('#level-one-selector').on('change', function () {
                    var $value = $(this).val();
                    if ($value != '') {
                        $.ajax({
                            url: '{{ route('frontend.checkcategory.leveltwo') }}',
                            data: {'parent_id': $value},
                            dataType: 'json',
                            beforeSend: function () {
                                clearSelector(1);
                            },
                            error: function (resp) {
                                alert(resp);
                                clearSelector(1);
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    $.each(resp.data.category, function (index, value) {
                                        $('#level-two-selector').append($('<option></option>').prop('value', index).text(value));
                                    });
                                    $('#level-two-selector').show();
                                } else {
                                    alert(resp.msg);
                                }
                            }
                        });
                    }
                });

                $('#level-two-selector').on('change', function () {
                    var $value = $(this).val();
                    if ($value != '') {
                        $.ajax({
                            url: '{{ route('frontend.checkcategory.levelthree') }}',
                            data: {'parent_id': $value},
                            dataType: 'json',
                            beforeSend: function () {
                                clearSelector(2);
                            },
                            error: function (resp) {
                                alert(resp);
                                clearSelector(2);
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    if (typeof resp.data.selectable !== 'undefined') {
                                        $('#level-three-selector').hide();
                                        $('#selector-add-container').show();
                                    } else {
                                        $.each(resp.data.category, function (index, value) {
                                            $('#level-three-selector').append($('<option></option>').prop('value', index).text(value));
                                        });
                                        $('#level-three-selector').show();
                                    }
                                } else {
                                    alert(resp.msg);
                                }
                            }
                        });
                    }
                });

                $('#level-three-selector').on('change', function () {
                    $('#selector-add-container').show();
                });

                var elt = $('#advance-filter-tag');
                elt.tagsinput({
                    itemValue: 'value',
                    itemText: 'text',
                    maxTags: 6
                });

                $('#selector-add').on('click', function () {
                    if ($('#level-three-selector').is(':visible')) {
                        var $selected = $('#level-three-selector option:selected');

                        if ($selected.length) {
                            var $text = $selected.text();
                            var $value = $selected.val();
                            elt.tagsinput('add', {'value': $value, 'text': $text});
                        }
                    } else {
                        var $selected = $('#level-two-selector option:selected');

                        if ($selected.length) {
                            var $text = $selected.text();
                            var $value = $selected.val();
                            elt.tagsinput('add', {'value': $value, 'text': $text});
                        }
                    }
                });

                @if ($mySkills)
                    @foreach ($mySkills as $key => $var)
                        elt.tagsinput('add', {'value': '{{ $var->category_id }}', 'text': '{{ $var->category->getTitle() }}'});
                    @endforeach
                @endif

                $('#skill-update-form').makeAjaxForm({
                    submitBtn: '#submit-skill-btn',
                });
            });
        }(jQuery);
    </script>
@endsection




