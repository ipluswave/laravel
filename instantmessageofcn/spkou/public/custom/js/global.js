function encodeQueryData(data) {
    var ret = [];
    for (var d in data)
        ret.push(encodeURIComponent(d) + "=" + encodeURIComponent(data[d]));
    return ret.join("&");
}

function alertClear() {
    toastr.clear();
}

function alertError(msg, clear) {
    if (typeof clear === 'undefined') {
        var clear = true;
    }
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

    toastr["error"](msg, "ERROR");
}

function alertSuccess(msg, clear) {
    if (typeof clear === 'undefined') {
        var clear = true;
    }
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

    toastr["success"](msg, "SUCCESS");
}

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}

function randomString(length_) {

    var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
    if (typeof length_ !== "number") {
        length_ = Math.floor(Math.random() * chars.length_);
    }
    var str = '';
    for (var i = 0; i < length_; i++) {
        str += chars[Math.floor(Math.random() * chars.length)];
    }
    return str;
}

var commonHandle = function() {
    var bodyAlertContainer = function() {
        return '#body-alert-container';
    };

    var handleModal = function() {
        $('#remote-modal').on("hidden.bs.modal", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
        $('#remote-modal-large').on("hidden.bs.modal", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
        $('#remote-modal-full').on("hidden.bs.modal", function (e) {
            $(e.target).removeData("bs.modal").find(".modal-content").empty();
        });
        $('#remote-modal, #remote-modal-large, #remote-modal-full').on('shown.bs.modal', function(e) {
            //adjustModal();
            commonHandle.init();
        });
        $('#confirm-modal').on('show.bs.modal', function(e) {
            var redirect = $(e.relatedTarget).data('redirect');
            $(this).find('.modal-header').html($(e.relatedTarget).data('header'));
            $(this).find('.modal-body').html($(e.relatedTarget).data('body'));
            if (redirect === 'yes') {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            } else {
                //make ajax post
                $('.btn-ok').unbind('click');
                $('.btn-ok', this).on('click', function() {
                    $.ajax({
                        url: $(e.relatedTarget).data('href'),
                        method: 'post',
                        dataType: 'json',
                        data: $('#p-key-form').serializeArray(),
                        beforeSend: function() {

                        },
                        success: function(response) {
                            $('.modal').modal('hide');
                            var first = true;
                            var scroll = true;
                            $.each(response, function(i) {
                                $.each(response[i], function (key, value) {
                                    App.alert({
                                        type: 'success',
                                        icon: 'check',
                                        message: value,
                                        place: 'append',
                                        container: bodyAlertContainer(),
                                        reset: first,
                                        focus: scroll,
                                    });
                                    if (first === true) {
                                        first = false;
                                        scroll = false;
                                    }
                                });
                            });

                        },
                        error: function(response) {
                            if (response.status == 422) {
                                App.alert({
                                    type: 'info',
                                    icon: 'info',
                                    message: response.msg,
                                    place: 'append',
                                    container: bodyAlertContainer()
                                });
                            } else {
                                alert('Unknown error occured, please try again later');
                            }
                        }
                    });
                });
            }
        });
        $('#confirm-modal').on('hidden.bs.modal', function(e) {
            $(this).find('.modal-header').empty();
            $(this).find('.modal-body').empty();
            $(this).find('.btn-ok').removeAttr('href');
        });
    };

    var handleDatetimePicker = function() {
        if ($.fn.datetimepicker) {
            $('.datetime-picker').datetimepicker({autoclose: true,});
        }
    };

    var handleDatePicker = function() {
        if ($.fn.datepicker) {
            $('.date-picker').datepicker({autoclose: true, 'format': 'yyyy-mm-dd'});
        }
    };

    var handleInput = function() {
        if ($.fn.numberInput) {
            $('.number-input').numberInput();
        }

        if ($.fn.fundInput) {
            $('.fund-input').fundInput();
        }

        if ($.fn.percentageInput) {
            $('.percentage-input').percentageInput();
        }

        if ($.fn.fourDInput) {
            $('.fourd-input, .bet-input').fourDInput();
        }
    };

    return {
        init: function() {
            handleModal();
            handleDatetimePicker();
            handleDatePicker();
            handleInput();
        },
        modalInit: function() {
            handleModal();
        },
        datetimeInit: function() {
            handleDatetimePicker();
            handleDatePicker();
        }
    };
}

(function($) {
    var MakeAjaxForm = function ($el, options) {
        this._defaults =  {
            loadingText: 'Loading...',
            submitBtn: 'default',
            successFunction: 'default',
            afterSuccessFunction: 'default',
            errorFunction: 'default',
            beforeFunction: 'default',
            dataType: 'json',
            url: $el.prop('action'),
            type: $el.prop('method'),
            closeModal: true,
            clearForm: false,
            container: 'default',
            inModal: false,
            alertContainer: 'default',
            successRefresh: false,
            redirectTo: false,
        };

        this._options = $.extend(true, {}, this._defaults, options);
        this.options = function(options) {
            return (options) ?
                $.extend(true, this._options, options) :
                this._options;
        };

        if (this._options.container === 'default') {
            if (this._options.inModal === true) {
                this._options.container = $el.closest('.modal-content');
            } else {
                if ($el.closest('.portlet').length) {
                    this._options.container = $el.closest('.portlet');
                } else {
                    this._options.container = $el;
                }
            }
        }

        if (this._options.alertContainer === 'default') {
            if (this._options.inModal === true) {
                this._options.alertContainer = $el.closest('.modal-content').children('.modal-body').children('.modal-alert-container');
            } else {
                this._options.alertContainer = '#body-alert-container';
            }
        }

        if (this._options.submitBtn === 'default') {

        } else {
            $(this._options.submitBtn).on('click', function() {
                $el.submit();
            });
        }

        var $this = this;

        $el.ajaxForm({
            url: $this._options.url,
            type: $this._options.type,
            dataType: $this._options.dataType,
            resetForm: $this._options.refreshForm,
            beforeSubmit: function () {
                if ($this._options.beforeFunction === 'default') {
                    var $next = true;
                } else {
                    var $next = $this._options.beforeFunction($el);
                }

                if ($next === true) {
                    App.blockUI({
                        target: $this._options.container,
                        overlayColor: 'none',
                        centerY: true,
                        boxed: true
                    });

                    return true;
                } else {
                    return false;
                }
            },
            success: function (response, statusText, xhr, formElm) {
                if ($this._options.successRefresh === true) {
                    window.location.reload();
                }

                if ($this._options.successFunction === 'default') {
                    var first = true;
                    var scroll = $this._options.inModal === true;
                    if ($this._options.afterSuccessFunction === 'default') {
                        //Override the alertContainer if is true
                        if ($this._options.closeModal === true) {
                            $this._options.alertContainer = '#body-alert-container';
                        }
                        if ($this._options.redirectTo != false) {
                            window.location.href = $this._options.redirectTo;
                        }
                        $.each(response, function(i) {
                            $.each(response[i], function (key, value) {
                                App.alert({
                                    type: 'success',
                                    icon: 'check',
                                    message: value,
                                    place: 'append',
                                    container: $this._options.alertContainer,
                                    reset: first,
                                    focus: scroll,
                                });
                                if (first === true) {
                                    first = false;
                                    scroll = false;
                                }
                            });
                        });
                        if ($this._options.closeModal === true) {
                            $('.modal').modal('hide');
                        }

                        if ($this._options.inModal) {
                            $('.modal').scrollTop('-1');
                        }
                    } else {
                        $this._options.afterSuccessFunction(response, $el, $this);
                    }
                    App.unblockUI($this._options.container);
                } else {
                    $this._options.successFunction(response, $el, $this);
                }

                if ($('.captcha-container', $this).legnth) {
                    refreshCaptcha();
                }
            },
            error: function (response, statusText, xhr, formElm) {
                if ($this._options.errorFunction === 'default') {
                    if (typeof response !== 'undefined' && typeof response.status !== 'undefined' && typeof response.responseText !== 'undefined' && typeof response.responseJSON !== 'undefined') {
                        var first = true;
                        var scroll = $this._options.inModal === true;
                        if (response.status == 422) {
                            $.each(response.responseJSON, function(i) {
                                $.each(response.responseJSON[i], function(key, value) {
                                    App.alert({
                                        type: 'danger',
                                        icon: 'warning',
                                        message: value,
                                        container: $this._options.alertContainer,
                                        reset: first,
                                        focus: scroll,
                                    });
                                    if (first === true) {
                                        first = false;
                                        scroll = false;
                                    }
                                });
                            });
                            if ($this._options.inModal) {
                                $('.modal').scrollTop('-1');
                            }
                        } else {
                            alert('Unknown error occured, please try again later');
                        }
                    } else {
                        alert('Unknown error occured, please try again later');
                    }

                    if ($('.captcha-container', $this).legnth) {
                        refreshCaptcha();
                    }

                    App.unblockUI($this._options.container);
                } else {
                    opts.errorFunction(response, $el, $this);
                }
            }
        });
    };

    $.fn.makeAjaxForm = function (methodOrOptions) {
        var method = (typeof methodOrOptions === 'string') ? methodOrOptions : undefined;

        if (method) {

            function getMakeAjaxForm() {
                var $el          = $(this);
                var ajaxForm     = $el.data('makeAjaxForm');

                ajaxForm.push(makeAjaxForm);
            }

            this.each(getMakeAjaxForm);

            var args    = (arguments.length > 1) ? Array.prototype.slice.call(arguments, 1) : undefined;
            var results = [];

            function applyMethod(index) {
                var makeAjaxForm = makeAjaxForm[index];

                if (!makeAjaxForm) {
                    console.warn('$.makeAjaxForm not instantiated yet');
                    console.info(this);
                    results.push(undefined);
                    return;
                }

                if (typeof makeAjaxForm[method] === 'function') {
                    var result = makeAjaxForm[method].apply(makeAjaxForm, args);
                    results.push(result);
                } else {
                    console.warn('Method \'' + method + '\' not defined in $.makeAjaxForm');
                }
            }

            this.each(applyMethod);

            return (results.length > 1) ? results : results[0];
        } else {
            var options = (typeof methodOrOptions === 'object') ? methodOrOptions : undefined;

            function init() {
                var $el          = $(this);
                var makeAjaxForm = new MakeAjaxForm($el, options);

                $el.data('makeAjaxForm', makeAjaxForm);
            }

            return this.each(init);
        }
    };

    $.fn.centerMe = function () {
        $(this).each (function() {
            $(this).css('left', $(window).width()/2 - $(this).width()/2);
        });

    };

    //Input number only
    $.fn.numberInput = function() {
        this.on('cut copy paste', function(evt) {
            evt.preventDefault();
        });
        this.on('keypress', function(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                evt.preventDefault();
            }
        });
    };

    //Input must be valid fund
    $.fn.fundInput = function() {
        this.on('cut copy paste', function(evt) {
            evt.preventDefault();
        });
        this.on('keypress', function(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            var value = this.value;

            if ((evt.which != 46 || value.indexOf('.') != -1) &&
                ((evt.which < 48 || evt.which > 57) &&
                (evt.which != 0 && evt.which != 8))) {
                evt.preventDefault();
            }

            if ((value.indexOf('.') != -1) &&
                (value.substring(value.indexOf('.')).length > 2) &&
                (value.which != 0 && value.which != 8) &&
                (this.selectionStart >= value.length - 2)) {
                evt.preventDefault();
            }
        });
    };

    //Input must be valid percentage(100% maximum)
    $.fn.percentageInput = function() {
        this.on('cut copy paste', function(evt) {
            evt.preventDefault();
        });
        this.on('keypress', function(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            var value = this.value;

            var estimatedValue = value + String.fromCharCode(charCode);

            if (estimatedValue > 100) {
                evt.preventDefault();
            }

            if ((evt.which != 46 || value.indexOf('.') != -1) &&
                ((evt.which < 48 || evt.which > 57) &&
                (evt.which != 0 && evt.which != 8))) {
                evt.preventDefault();
            }

            if ((value.indexOf('.') != -1) &&
                (value.substring(value.indexOf('.')).length > 2) &&
                (value.which != 0 && value.which != 8) &&
                (this.selectionStart >= value.length - 2)) {
                evt.preventDefault();
            }
        });
    };

}(jQuery));

+function() {
    $(document).ready(function() {
        commonHandle.init();
    });
}(jQuery);