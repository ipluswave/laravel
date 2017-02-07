var makeOrderForm = function () {

    var languages = $('html').attr('lang');
    var errCompleteDate = '';
    var errStyle = '';
    var errMaterial = '';
    var errBodyShape = '';
    var errTopBottom = '';
    var err = '';

    var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    if(languages == 'en') {
        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: App.isRTL(),
            format: "dd MM yyyy - hh",
            startDate: tomorrow,
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
            minView : 1
        }).on('changeDate', function(ev) {

        });

        errCompleteDate = 'Please select complete date first'
        errStyle = 'Please select style first'
        errMaterial ='Please select material first'
        errBodyShape = 'Please select body shape first'
        errTopBottom = 'Please select Top and bottom first'
        err = 'ERROR';

    }else{
        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: App.isRTL(),
            format: "dd MM yyyy - hh",
            startDate: tomorrow,
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
            minView : 1,
            language: "zh-CN",
        }).on('changeDate', function(ev) {

        });

        errCompleteDate = '请选择何时完成'
        errStyle = ' 请选择款式'
        errMaterial ='请选择面料'
        errBodyShape = '请选择体型'
        errTopBottom = '请选择上下装'
        err = '错误';
    }

    var getMaterialPercentageByString = function (str) {
        var v = str.trim().split(' ');
        if (typeof v[0] !== 'undefined') {
            var s = v[0].replace(' ', '');
            return parseFloat(s);
        } else {
            return 0;
        }
    };

    var showError = function (val) {
        if (val instanceof Array) {
            $(val).each(function (index, value) {
                showError(value);
            });
        } else {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr["error"](val, err);
        }
    };

    return {
        init: function () {
            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            var displayConfirm = function() {
                $('#tab3 .form-control-static', form).each(function() {
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            };

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            };

            $('body').on('change', 'input[name=material]', function () {
                $('#mirror-material').html($(this).data('title'));
            });
            $('body').on('change', 'input[name=bodyshape]', function () {
                $('#mirror-bodyshape').html($(this).data('title'));
            });
            $('#touchspin-horizontal').on('change', function () {
                $('#mirror-horiz').html($(this).val() + '%');
            });
            $('#touchspin-pararal').on('change', function () {
                $('#mirror-parar').html($(this).val() + '%');
            });

            $('body').on('change', '.l1', function () {
                var l1 = $(this).val();
                $('#mirror-c-one').html($(this).data('title'));
                $.ajax({
                    url: '/getcategory/level2',
                    dataType: 'html',
                    data: {'parent_id': l1},
                    beforeSend: function () {
                        $('#level-2-container .level-2-inner-container .icheck-inline').html('');
                        $('#level-2-container').hide();
                    },
                    error: function () {
                        alert('Unable to get category right now, please try again later');
                    },
                    success: function (response) {
                        $('#level-2-container .level-2-inner-container .icheck-inline').html(response);
                        $('#level-2-container').show();
                    }
                });
            });
            $('body').on('change', '.l2', function () {
                var l2 = $(this).val();
                $('#mirror-c-two').html($(this).data('title'));
                $.ajax({
                    url: '/getcategory/level3',
                    dataType: 'html',
                    data: {'parent_id': l2},
                    beforeSend: function () {
                        $('#level-3-container .level-2-inner-container .icheck-inline').html('');
                        $('#level-3-container').hide();
                    },
                    error: function () {
                        alert('Unable to get category right now, please try again later');
                    },
                    success: function (response) {
                        $('#level-3-container .level-3-inner-container .icheck-inline').html(response);
                        $('#level-3-container').show();
                    }
                });
            });

            $('body').on('click', '.raw-material', function () {
                var title = $(this).data('text');
                $(this).attr('checked', false);
                $('#material-name-container').val(title);
            });

            $('#raw-material-tags').on('beforeItemAdd', function(event) {
                var currentPercent = 0;
                var currentStr = $('#raw-material-tags').val();
                var items = currentStr.split(',');
                $(items).each(function (index, value) {
                    var p = getMaterialPercentageByString(value);
                    currentPercent = parseFloat(currentPercent) + parseFloat(p);
                });
                var addPercent = getMaterialPercentageByString(event.item);
                if ((parseFloat(currentPercent) + addPercent) > 100) {
                    event.cancel = true;
                    alert($('#raw-material-maximum-percent-msg').val());
                }
            });

            $('#raw-material-tags').on('itemAdded', function (event) {
                var currentStr = $('#raw-material-tags').val();
                $('#mirror-raw-material').html(currentStr);
            });

            $('body').on('click', '#material-add-btn', function () {
                var name = $('#material-name-container').val();
                var percentage = $('#touchspin-raw-material').val();
                var str = percentage + '% ' + name;
                $('#raw-material-tags').tagsinput('add', str);
            });

            $('body').on('change', '#include-seal-switch', function () {
                if ($(this).is(':checked')) {
                    $('.include-seal-related').removeAttr('disabled');
                } else {
                    $('.include-seal-related').attr('disabled', true);
                    $('#include-seal-one, #include-seal-two').removeAttr('checked');
                }
            });

            $('body').on('change', '#include-seal-one', function () {
                if ($(this).is(':checked')) {
                    $('#include-seal-two').removeAttr('checked');
                }
            });

            $('body').on('change', '#include-seal-two', function () {
                if ($(this).is(':checked')) {
                    $('#include-seal-one').removeAttr('checked');
                }
            });

            $('.fileinput').on('change.bs.fileinput', function () {
                var ct = $(this).find('.fileinput-preview');
                if (ct.is('#front-pattern-img-container')) {
                    var img = ct.find('img');

                    if (img) {
                        $('#mirror-front-pattern-picture').attr('src', img.attr('src'));
                    }
                }

                if (ct.is('#back-pattern-img-container')) {
                    var img = ct.find('img');

                    if (img) {
                        $('#mirror-back-pattern-picture').attr('src', img.attr('src'));
                    }
                }
            });

            $('body').on('change', '#front-pattern-word', function () {
                $('#mirror-front-pattern-word').html($(this).val());
            });
            $('body').on('change', '#back-pattern-word', function () {
                $('#mirror-back-pattern-word').html($(this).val());
            });
            $('body').on('change', '#remark-txt', function () {
                $('#mirror-remark').html($(this).val());
            });

            $('body').on('click', '.btn-add-guide', function () {
                var ct = $('#guide-original');
                var total = $('.guide-container').length;
                var row = $('#guide-original').clone().removeAttr('id');
                row.html(function (i, oldHTML) {
                    var newTotal = uniqid();
                    return oldHTML.replace(/guide\[(.*?)\]/g, 'guide[' + newTotal + ']');
                });
                row.find('.fileinput').removeClass('fileinput-exists').addClass('fileinput-new');
                row.find('.fileinput-preview').html('');
                row.find('textarea').val('');
                row.find('input[type=file]').val('');
                $('#guide-all-container').append(row);
            });

            function mirrorCheck() {
                if ($('#front-pattern-image').val() == '' && $('#front-pattern-word').val() == '' && $('#back-pattern-word').val() == '' && $('#back-pattern-word').val() == '') {
                    $('#pattern-image-container').hide();
                } else {
                    if ($('#front-pattern-image').val() == '' && $('#front-pattern-word').val() == '') {
                        $('#front-pattern-container').hide();
                    } else {
                        $('#front-pattern-container').show();
                    }

                    if ($('#back-pattern-word').val() == '' && $('#back-pattern-word').val() == '') {
                        $('#back-pattern-container').hide();
                    } else {
                        $('#back-pattern-container').show();
                    }
                    $('#pattern-image-container').show();
                }

                $('#guide-mirror-container').html('');
                $('.guide-container').each (function (index, value) {
                    var $this = $(this);
                    if ($('.old-guide-image', $this).length) {
                        var $image = $('.old-guide-image > img', $this);
                    } else {
                        var $image = $('.fileinput-exists > img', $this);
                    }
                    var $text = $('textarea', $this);
                    var html = '<div class="form-group mirror-guide-row"><label class="control-label col-md-3"></label>';
                    if ($image.length && $text.val() != '') {
                        if ($image.prop('src') == $('#guide-original .fileinput-new > .fileinput-new img').prop('src')) {
                            html += '<div class="col-md-3"></div>';
                        } else {
                            html += '<div class="col-md-3"><img src="' + $image.prop('src') + '" style="max-width: 300px;" /></div>';
                        }
                        html += '<div class="col-md-4">' + $text.val() + '</div>';
                        html += '</div>';
                        $('#guide-mirror-container').append(html);
                    } else if ($image.length && $text.val() == '') {
                        html += '<div class="col-md-3"><img src="' + $image.prop('src') + '" style="max-width: 300px;" /></div>';
                        html += '<div class="col-md-4"></div>';
                        html += '</div>';
                        $('#guide-mirror-container').append(html);
                    } else if (!$image.length && $text.val() != '') {
                        html += '<div class="col-md-3"></div>';
                        html += '<div class="col-md-4">' + $text.val() + '</div>';
                        html += '</div>';
                        $('#guide-mirror-container').append(html);
                    }
                });
                if ($('#guide-mirror-container').html() != '') {
                    $('#guide-mirror-outer-container').show();
                } else {
                    $('#guide-mirror-outer-container').hide();
                }
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    //Mean tab 2 or tab 3
                    if (clickedIndex == 1 || clickedIndex == 2) {
                        var errors = [];
                        if ($('input[name="planned_date"]').val() == '') {
                            errors.push(errCompleteDate);
                        }
                        if (!$('input[name="c_one"]').is(':checked')) {
                            errors.push(errStyle);
                        }
                        if (!$('input[name="material"]').is(':checked')) {
                            errors.push(errMaterial);
                        }
                        if (!$('input[name="bodyshape"]').is(':checked')) {
                            errors.push(errBodyShape);
                        }
                        if (!$('input[name="c_two"]').is(':checked')) {
                            errors.push(errTopBottom)
                        }

                        if (errors.length) {
                            toastr.clear();
                            showError(errors);
                            App.scrollTo($('.page-title'));
                            $('#form_wizard_1').bootstrapWizard('show', 0);
                            return false;
                        } else {
                            $('#submit_form').submit();
                            $('#form_wizard_1').bootstrapWizard('show', clickedIndex);
                        }
                    } else if (clickedIndex == 0) {
                        $('#form_wizard_1').bootstrapWizard('show', clickedIndex);
                    }

                    mirrorCheck();

                    return false;
                },
                onNext: function (tab, navigation, index) {

                    switch (index) {
                        case 1:
                            var errors = [];
                            if ($('input[name="planned_date"]').val() == '') {
                                errors.push(errCompleteDate);
                            }
                            if (!$('input[name="c_one"]').is(':checked')) {
                                errors.push(errStyle);
                            }
                            if (!$('input[name="material"]').is(':checked')) {
                                errors.push(errMaterial);
                            }
                            if (!$('input[name="bodyshape"]').is(':checked')) {
                                errors.push(errBodyShape);
                            }
                            if (!$('input[name="c_two"]').is(':checked')) {
                                errors.push(errTopBottom)
                            }

                            if (errors.length) {
                                toastr.clear();
                                showError(errors);
                                App.scrollTo($('.page-title'));
                                return false;
                            } else {
                                $('#submit_form').submit();
                            }
                        break;
                        case 2:
                            var errors = [];

                            if (errors.length) {
                                toastr.clear();
                                showError(errors);
                                App.scrollTo($('.page-title'));
                                return false;
                            } else {
                                $('#page-container').val(2);
                                $('#submit_form').submit();
                            }
                        break;
                        case 3:
                            $('#page-container').val(3);
                        break;
                        return false;
                    }
                    mirrorCheck();
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#btn-submit').hide();
        }
    };
};

+function () {
    $(document).ready(function() {
        $("#touchspin-pararal").TouchSpin({
            min: 0,
            max: 100,
            initval: 50,
            postfix: '%'
        });

        $("#touchspin-horizontal").TouchSpin({
            min: 0,
            max: 100,
            initval: 50,
            postfix: '%'
        });

        $("#touchspin-raw-material").TouchSpin({
            min: 0,
            max: 100,
            initval: 50,
            postfix: '%'
        });

        $("#touchspin-price").TouchSpin({
            min: 1,
            max: 10000000,
            initval: 1000,
            prefix: '¥'
        });

        $(".common_seal_check").change(function() {
            $(".inp_common_seal_check").toggle();
        });

        $(".seal3_check").change(function() {
            $(".inp_seal3_check").toggle();
        });

        $(".seal2_check").change(function() {
            $(".inp_seal2_check").toggle();
        });

        $(".seal1_check").change(function() {
            $(".inp_seal1_check").toggle();
        });

        $(".niddle_size_check").change(function() {
            $(".inp_niddle_size_check").toggle();
        });

        makeOrderForm().init();
    });
}(jQuery);