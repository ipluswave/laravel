jQuery(
    function ($) {
        var languages = $('html').attr('lang');
        var a = new Date();
        a.setYear(a.getFullYear() - 100);
        if(languages == 'en') {
            $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startView: 2,
                startDate: a,
            });
        }
        else{
            $('.input-group.date').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                language: "zh-CN",
                startView: 2,
                startDate: a,
            });
        }

        $('#resubmit-identity').on('click', function () {
            $('#resubmit-container').remove();
            $('#submit_form').show();
        });
    }
);

function validate(){
    var languages = $('html').attr('lang');
    if(languages == 'en') {
        errRealName = 'Please input real name';
        errIdentityCardNo = 'Please input identity card number';
        errIdentityCardLength = 'Identity card number must 18 numbers';
        errGender ='Please select gender';
        errBirthDate = 'Please select birth date';
        errAddress = 'Please input address';
        errHandphone = 'Please input handphone number';
        errBackIDCard = 'Please upload back of your ID card';
        errFrontIDCard = 'Please upload front of your ID card';
        err = 'ERROR';
    }else{
        errRealName = '请输入真实姓名';
        errIdentityCardNo = '请输入身份证号码';
        errIdentityCardLength = '身份证号码应该18个号码';
        errGender ='请选择性别';
        errBirthDate = '请选择出生日期';
        errAddress = '请输入地址';
        errHandphone = '请输入手机号码';
        errBackIDCard = '请上传身份证背面图';
        errFrontIDCard = '请上传身份证正面图';
        err = '错误';
    }

    var errors = [];
    if ($('input[name="real_name"]').val() == '') {
        errors.push(errRealName);
    }
    if ($('input[name="id_card_no"]').val() == '') {
        errors.push(errIdentityCardNo);
    }

    var id_card_no = $('input[name="id_card_no"]').val();
    if (!($('input[name="id_card_no"]').val().length == '18' && !isNaN(id_card_no))) {
        errors.push(errIdentityCardLength);
    }
    if (!$('input[name="gender"]').is(':checked')) {
        errors.push(errGender);
    }
    if ($('input[name="date_of_birth"]').val() == '') {
        errors.push(errBirthDate);
    }
    if ($('input[name="address"]').val() == '') {
        errors.push(errAddress);
    }
    if ($('input[name="handphone_no"]').val() == '') {
        errors.push(errHandphone);
    }
    if ( typeof $('.img_front_id img').attr('src') === 'undefined') {
        errors.push(errFrontIDCard);
    }
    if ( typeof $('.img_back_id img').attr('src') === 'undefined') {
        errors.push(errBackIDCard);
    }

    if (errors.length) {
        toastr.clear();
        showError(errors);
        App.scrollTo($('.page-title'));
        return false;
    } else {
        return true;
    }
}

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
