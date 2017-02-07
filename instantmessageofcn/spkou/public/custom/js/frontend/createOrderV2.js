jQuery(
    function ($) {

        $(document.body)
            .on("click", "i[id ^='trash_']", deleteRawMaterial)
            .on("mouseover", ".x li", liMouseOverEffect)
            .on("mouseleave", ".x li", liMouseLeaveEffect)
            .on("click", "ul#list-gender > li", SelectListGender )
            .on("click", "ul#list-craft > li", SelectListCraft )
            .on("click", "ul#list-body-position > li", SelectListBodyPosition)
            .on("click", "ul#list-style > li", SelectListStyle)
            .on("click", ".x li", liItemSelected)
            .on("change", "input[id ^='fileUpload-']", displayImage )
            .on("click", "span[id ^='removeImage-']", removeImage );

        //initialize the project date complete
        var dayToCompleted = 0;
        var monthToCompleted = 0;
        var defaultAddDays = 3;
        getNewDate(defaultAddDays);

        var errPlannedDate = '';
        var errGender = '';
        var errCraft = '';
        var errBodyPosition = '';
        var errStyle = '';
        var errBodySize = '';
        var err = '';
        var languages = $('html').attr('lang');
        if(languages == 'en') {
            errPlannedDate = 'Please select planned date first';
            errGender = 'Please select gender';
            errCraft = 'Please select make craft';
            errBodyPosition = 'Please select body position';
            errStyle = 'Please select style';
            errBodySize = 'Please select body size';
            err = 'ERROR';
        }else{
            errPlannedDate = '请选择何时完成';
            errGender = '请选择性别';
            errCraft = '请选择制作工艺';
            errBodyPosition = '请选择部位';
            errStyle = ' 请选择款式';
            errBodySize = '请选择体型';
            err = '错误';
        }

        //click day completed list
        $(".ul-how-many-day > li").click(function() {
            var id =  $(this).attr("id");
            $('.ul-how-many-day > li').removeClass('active');
            $('.ul-how-many-day > li#' + id ).addClass('active');
            $('.how-many-days').html(id);
            $('.disp-how-many-days').html(id);
            $('#plan_day').val(id);

            var howManyDays = parseInt(id);
            getNewDate(howManyDays);
        });

        $('#common_seal_check').click(function(){
            if($('#common_seal_check').is(':checked')) {
                $('#common_seal').css('display','inline-block');
                $('#common_seal_check').val(1);
            }
            else{
                $('#common_seal').css('display','none');
                $('#common_seal_check').val(0);
            }
        })

        $('#seal3_check').click(function(){
            if($('#seal3_check').is(':checked')) {
                $('#seal3').css('display','inline-block');
                $('#seal3_check').val(1);
            }
            else{
                $('#seal3').css('display','none');
                $('#seal3_check').val(0);
            }
        })

        $('#seal2_check').click(function(){
            if($('#seal2_check').is(':checked')) {
                $('#seal2').css('display','inline-block');
                $('#seal2_check').val(1);
            }
            else{
                $('#seal2').css('display','none');
                $('#seal2_check').val(0);
            }
        })

        $('#seal1_check').click(function(){
            if($('#seal1_check').is(':checked')) {
                $('#seal1').css('display','inline-block');
                $('#seal1_check').val(1);
            }
            else{
                $('#seal1').css('display','none');
                $('#seal1_check').val(0);
            }
        })

        $('#niddle_size_check').click(function(){
            if($('#niddle_size_check').is(':checked')) {
                $('#niddle_size').css('display','inline-block');
                $('#niddle_size_check').val(1);
            }
            else{
                $('#niddle_size').css('display','none');
                $('#niddle_size_check').val(0);
            }
        })

        $('#include_seal').click(function(){
            if($('#include_seal').is(':checked')) {
                $('#span_include_seal').css('display','inline-block');
                $('#include_seal').val(1);
            }
            else{
                $('#span_include_seal').css('display','none');
                $('#include_seal').val(0);
            }
        })

        //Shrinkage
        $('#ts-shrinkage').click(function(){
            if ($(this).is(':checked')){
                $('#content11').css('display','block');
                $('#content12').css('display','block');
                $('#shrinkage').css('width','100%');
                $('#decrease_rate').val(1);
            }
            else{
                $('#content11').css('display','none');
                $('#content12').css('display','none');
                $('#shrinkage').css('width','300px');
                $('#decrease_rate').val(0);
            }
        });

        //Shrinkage horizon number picker
        $('#horizon .next').click(function() {
            refreshNumberList('next', 'horizon', '#horiz');
        })

        $('#horizon .prev').click(function() {
            refreshNumberList('prev', 'horizon', '#horiz');
        })

        //Shrinkage pararal number picker
        $('#pararal .next').click(function() {
            refreshNumberList('next', 'pararal', '#parar');
        })

        $('#pararal .prev').click(function() {
            refreshNumberList('prev', 'pararal', '#parar');
        })

        //Seal width
        $('#ts-seal-width').click(function(){
            if ($(this).is(':checked')){
                $('#ght').css('display','inline-block');
                $('#content21').css('display','block');
                $('#content22').css('display','block');
                $('#content23').css('display','block');
                $('#seal-width').css('width','100%');
                $('#custom_seal').val(1);
            }
            else{
                $('#ght').css('display','none');
                $('#content21').css('display','none');
                $('#content22').css('display','none');
                $('#content23').css('display','none');
                $('#seal-width').css('width','300px');
                $('#custom_seal').val(0);
            }
        });

        //Composition
        $('#ts-composition').click(function(){
            if ($(this).is(':checked')){
                $('#content31').css('display','block');
                $('#content32').css('display','block');
                $('#new-add-raw-material').css('display','block');
                $('#composition').css('width','100%');
                $('#custom_raw_material_switch').val(1);
            }
            else{
                $('#content31').css('display','none');
                $('#content32').css('display','none');
                $('#new-add-raw-material').css('display','none');
                $('#composition').css('width','300px');
                $('#custom_raw_material_switch').val(0);
            }
        });

        $('.raw-material').click(function () {
            var title = $(this).data('text');
            $(this).attr('checked', false);
            $('#material-name-container').val(title);

            var id = parseInt(this.id);
            $('#material-id').val(id);
        });

        $('#raw-material-percentage-minus').click(function(){
            var value = $('#tbx-raw-material-percentage').val();
            if(value == "")
            {
                value = 0;
            }
            else{
                value =  value.replace('%','');
            }

            if ( value != 1 ) {
                $('#tbx-raw-material-percentage').val(parseFloat(value - 1) + "%");
            }else{
                $('#tbx-raw-material-percentage').val("1%");
            }
        })

        $('#raw-material-percentage-plus').click(function(){
            var value=$('#tbx-raw-material-percentage').val();
            if(value=="")
            {
                value=0;
            }
            else{
                value=parseFloat(value.replace('%',''));
            }

            if ( value != 100 ) {
                $('#tbx-raw-material-percentage').val(parseFloat(value + 1) + "%");
            }else{
                $('#tbx-raw-material-percentage').val("100%");
            }
        })

        $('.btn-add-raw-material').click(function() {
            var id = $('#material-id').val();
            var rawMaterialName = $('#material-name-container').val();
            var percentage = parseInt($('#tbx-raw-material-percentage').val().replace('%',''));

            var totalPercentage = getTotalPercentage();
            var newTotalPercentage = totalPercentage + percentage;
            var isRawMaterialAlreadyExist = checkIsRawMaterialAlreadyExist(id);

            if ( newTotalPercentage > 100 ){
                alert('Raw material cannot more than 100%');
                return;
            }

            if( isRawMaterialAlreadyExist == true || id == 0 ){
                alert('Raw material already being choose');
                return
            }

            if ( rawMaterialName == '' || percentage == '' ) {
                alert('Please choose one of the raw material');
                return;
            } else {
                var html =  '<div id="raw-material-' + id + '" class="inner-addon right-addon" style="display:inline-block;">' +
                            '    <i class="fa fa-trash" id="trash_' +  id + '"></i>' +
                            '    <input type="text"  value="' + rawMaterialName + '&emsp;' + percentage + '%" class="form-control cus-te cus-te2"/>' +
                            '</div>&nbsp;';
                $('.raw-material-list').append(html);

                var oldListString = $('#hidRawMaterialList').val();
                var newListString = "";
                if ( oldListString == ""){
                    newListString = id + ',' + rawMaterialName + ',' + percentage;
                }else{
                    newListString = oldListString + '|' + id + ',' +  rawMaterialName + ',' + percentage;
                }
                $('#hidRawMaterialList').val(newListString);
                displayRawMaterial(newListString);
            }
        });

        $('#set_edt').click(function(){
            $('#all_read').children('input').removeAttr('readonly');
        })

        $('.accro').click(function(){
            $('#sdr').slideToggle( "slow", function() {
                if($('.accro i').hasClass('fa-angle-up'))
                {
                    $('.accro i').addClass('fa-angle-down');
                    $('.accro i').removeClass('fa-angle-up');
                }
                else if($('.accro i').hasClass('fa-angle-down'))
                {
                    $('.accro i').removeClass('fa-angle-down');
                    $('.accro i').addClass('fa-angle-up');
                }
                // Animation complete.
            });

        })

        customCheckbox("common_seal_check", false);
        customCheckbox("seal3_check", false);
        customCheckbox("seal2_check", false);
        customCheckbox("seal1_check", false);
        customCheckbox("niddle_size_check", false);
        customCheckbox("include_seal", false);
        customCheckbox("chbWeipay", true);
        customCheckbox("chbZhifuBao", false);

        $('#common_seal').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-common-seal').html(value);
        });

        $('#seal3').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-seal3').html(value);
        });

        $('#seal2').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-seal2').html(value);
        });

        $('#seal1').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-seal1').html(value);
        });

        $('#niddle_size').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-niddle_size').html(value);
        });

        $('#include_seal_num_1').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-include_seal_num_1').html(value);
        });

        $('#include_seal_num_2').change(function(){
            var inputValue = $(this).val();
            var value = parseInt( inputValue.toUpperCase().replace('CM', '') );
            $('.disp-include_seal_num_2').html(value);
        });

        $('.button-next').click(function(){
            var errors = [];
            var page = $('#page-container').val();

            if( page == 1 ) {
                var howManyDays = $('.how-many-days').html();
                var hidGender = parseInt($('#hid-gender').val());
                var hidCraft = parseInt($('#hid-craft').val());
                var hidBodyPosition = parseInt($('#hid-body-position').val());
                var hidStyle = parseInt($('#hid-style').val());
                var hidBodySize = parseInt($('#hid-body-shape').val());

                if (howManyDays == '' || howManyDays == 0) {
                    errors.push(errPlannedDate);
                }
                if (hidGender == 0) {
                    errors.push(errGender);
                }
                if (hidCraft == 0) {
                    errors.push(errCraft);
                }
                if (hidBodyPosition == 0) {
                    errors.push(errBodyPosition);
                }
                if (hidStyle == 0) {
                    errors.push(errStyle)
                }
                if (hidBodySize == 0) {
                    errors.push(errBodySize)
                }
            }

            if (errors.length) {
                toastr.clear();
                showError(errors);
                App.scrollTo($('.page-title'));
                return false;
            } else {
                $('#submit_form').submit();
            }
        });

        //Urgent Post?
        $('#ts-urgent-post').click(function(){
            if ($(this).is(':checked')){
                $('#hid-urgent-post').val(1);
            }
            else{
                $('#hid-urgent-post').val(0);
            }
        });

        //Add extra size?
        $('#ts-extra-size').click(function(){
            if ($(this).is(':checked')){
                $('#hid-extra-size').val(1);
            }
            else{
                $('#hid-extra-size').val(0);
            }
        });

        $('#chbWeipay').click(function(){
            var value = $('#chbWeipay').val();
            if ( value == '1' ){
                $('#chbWeipay').parent().removeClass("selected");
                $('#chbWeipay').val(0);
                $('#chbZhifuBao').parent().addClass("selected");
                $('#chbZhifuBao').val(1);
                $('#payment_method').val(1);
            }else{
                $('#chbWeipay').parent().addClass("selected");
                $('#chbWeipay').val(1);
                $('#chbZhifuBao').parent().removeClass("selected");
                $('#chbZhifuBao').val(0);
                $('#payment_method').val(2);
            }
        });

        $('#chbZhifuBao').click(function(){
            var value = $('#chbZhifuBao').val();
            if ( value == '1' ){
                $('#chbWeipay').parent().addClass("selected");
                $('#chbWeipay').val(1);
                $('#chbZhifuBao').parent().removeClass("selected");
                $('#chbZhifuBao').val(0);
                $('#payment_method').val(2);
            }else{
                $('#chbWeipay').parent().removeClass("selected");
                $('#chbWeipay').val(0);
                $('#chbZhifuBao').parent().addClass("selected");
                $('#chbZhifuBao').val(1);
                $('#payment_method').val(1);
            }
        });

        $('#div-add-picture').click(function() {
            var hidUploadImageInfo = $('#hidUploadImageInfo').val();
            var totalImage = 0;

            var itemList = [];
            if (hidUploadImageInfo != '') {
                itemList = hidUploadImageInfo.split('|');
            }

            var sortList = itemList.sort();
            var availableUploadLocation = 0;
            for (var i = 0; i < 9; i++) {
                if( sortList[i] != ( i + 1 ) ){
                    availableUploadLocation = i + 1;
                    break;
                }
            }
            var index =availableUploadLocation;

            if (index == 10) {
                return;
            }

            $('#fileUpload-' + index).trigger('click');

            //sortList.push(availableUploadLocation);
            //sortList = sortList.sort();
            //var newString = '';
            //if (sortList.length == 0) {
            //    newString = index;
            //} else {
            //    //rebuild sorting string
            //    for (var i = 0; i < sortList.length; i++) {
            //        if( newString == '' ){
            //            newString = sortList[i];
            //        }else{
            //            newString = newString + '|' + sortList[i];
            //        }
            //    }
            //}
            //
            //$('#hidUploadImageInfo').val(newString)
        });

        $('#btnBasicInfoModify').click(function(){
            $('#section-basic-info').show();
            $('#section-basic-info-display').hide();
            $('#section-add-picture-input').hide();
            $('#section-payment-info').hide();
            $('#page-container').val(1);
            App.scrollTo($('#section-basic-info'));
        });

        $('#btnPicInputFormModify').click(function(){
            $('#section-payment-info').hide();
            $('#btnPicInputFormNext').show();
            $('#btnPicInputFormCancel').show();
            $('#btnPicInputFormModify').hide();
            $('#page-container').val(2);
            App.scrollTo($('#div-add-picture'));
        });

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

        var orderId = parseInt($('#order-id-container').val());
        if( isNaN(orderId)) {
            $('#btn-gender').trigger('click');
        }else{
            //Edit existing order
            $("#btn-gender").css('color','#ffffff');
            $("#btn-gender").addClass('custom-square-display');
            $("#btn-gender i").addClass('custom-square-show');

            $("#btn-craft").css('color','#ffffff');
            $("#btn-craft").addClass('custom-square-display');
            $("#btn-craft i").addClass('custom-square-show');

            $("#btn-body-position").css('color','#ffffff');
            $("#btn-body-position").addClass('custom-square-display');
            $("#btn-body-position i").addClass('custom-square-show');

            $("#btn-style").css('color','#ffffff');
            $("#btn-style").addClass('custom-square-display');
            $("#btn-style i").addClass('custom-square-show');

            $("#btn-body-shape").css('color','#ffffff');
            $("#btn-body-shape").addClass('custom-square-display');
            $("#btn-body-shape i").addClass('custom-square-show');

            var decrease_rate = $("#decrease_rate").val();
            var custom_seal = $("#custom_seal").val();
            var custom_raw_material_switch = $("#custom_raw_material_switch").val();

            if( decrease_rate == "1" ){
                $('#ts-shrinkage').trigger('click');
            }

            if( custom_seal == "1" ){
                $('#ts-seal-width').trigger('click');
            }

            if( custom_raw_material_switch == "1" ){
                $('#ts-composition').trigger('click');
            }

            // Shrinkage
            var horiz = parseInt($('#horiz').val());
            var parar = parseInt($('#parar').val());

            if( horiz != 0 ){
                if ( horiz < 0 ){
                    var count = Math.abs(horiz);

                    for (var i = 0; i <count; i++ ){
                        $('#horizon .prev').trigger('click');
                    }
                }else{
                    var count = horiz;

                    for (var i = 0; i <count; i++ ){
                        $('#horizon .next').trigger('click');
                    }
                }
            }else{
                $('.btn-horizon').html('0 %');
            }

            if( parar != 0 ){
                if ( parar < 0 ){
                    var count = Math.abs(parar);

                    for (var i = 0; i <count; i++ ){
                        $('#pararal .prev').trigger('click');
                    }
                }else{
                    var count = parar;

                    for (var i = 0; i <count; i++ ){
                        $('#pararal .next').trigger('click');
                    }
                }
            }else{
                $('.btn-pararal').html('0 %');
            }

            //Seal width
            var common_seal_check = parseInt($('#common_seal_check').val());
            var seal3_check = parseInt($('#seal3_check').val());
            var seal2_check = parseInt($('#seal2_check').val());
            var seal1_check = parseInt($('#seal1_check').val());
            var niddle_size_check = parseInt($('#niddle_size_check').val());
            var include_seal = parseInt($('#include_seal').val());

            if( common_seal_check == 1 ){
                $('#common_seal_check').trigger('click');
            }

            if( seal3_check == 1 ){
                $('#seal3_check').trigger('click');
            }

            if( seal2_check == 1 ){
                $('#seal2_check').trigger('click');
            }

            if( seal1_check == 1 ){
                $('#seal1_check').trigger('click');
            }

            if( niddle_size_check == 1 ){
                $('#niddle_size_check').trigger('click');
            }

            if( include_seal == 1 ){
                $('#include_seal').trigger('click');
            }

            //composition
            var rawMaterialList = $('#hidRawMaterialList').val();
            var result = rawMaterialList.split("|");
            if( result[0] != "") {
                for (i = 0; i < result.length; i++) {
                    var item = result[i].split(",");
                    var id = item[0];
                    var rawMaterialName = item[1];
                    var percentage = item[2];
                    var html = '<div id="raw-material-' + id + '" class="inner-addon right-addon" style="display:inline-block;">' +
                        '    <i class="fa fa-trash" id="trash_' + id + '"></i>' +
                        '    <input type="text"  value="' + rawMaterialName + '&emsp;' + percentage + '%" class="form-control cus-te cus-te2"/>' +
                        '</div>&nbsp;';
                    $('.raw-material-list').append(html);

                    var displayValue = rawMaterialName + '&emsp;' + percentage + "%";
                    $('.disp-raw-material-' + (i + 1)).html(displayValue);
                }
            }

            //Image upload
            var imageList = $("img[id^='imgUserUpload-']");
            $.each(imageList, function( index, value ) {
                if( value.currentSrc.indexOf('uploads') > -1 ){
                    id = parseInt(value.id.replace("imgUserUpload-", ""));
                    $('#div-img-footer-' + id ).show();

                    if( id >= 4 ){
                        $('#div-PictureUpload-Sec2').show();
                    }

                    if( id >= 7 ){
                        $('#div-PictureUpload-Sec3').show();
                    }
                }
            });


            //payment info
            var urgentPost = $("#hid-urgent-post").val();
            var extraSize = $("#hid-extra-size").val();

            if( urgentPost == "1" ){
                $('#ts-urgent-post').trigger('click');
            }

            if( extraSize == "1" ){
                $('#ts-extra-size').trigger('click');
            }

            //weipay init auto select by default
            var paymentMethod = $("#payment_method").val();
            if( paymentMethod == 1 ){
                $('#chbZhifuBao').trigger('click');
            }
        }
    }
);

function customCheckbox(checkboxName, isCheck){

    var checkBox = $('input[name="'+ checkboxName +'"]');

    $(checkBox).each(function(){
        if(isCheck){
            $(this).wrap("<span class='custom-checkbox selected'></span>");
        }else {
            $(this).wrap("<span class='custom-checkbox'></span>");
        }
        if($(this).is(':checked')){
            $(this).parent().addClass("selected");
        }
    });

    $(checkBox).click(function(){
        $(this).parent().toggleClass("selected");
    });

}

function getNewDate( $day ){
    var completedDate = new Date();
    completedDate.setDate(completedDate.getDate() + $day);

    var completedDay = completedDate.getDate();
    var completedMonth = completedDate.getMonth()+1; //January is 0!

    var languages = $('html').attr('lang');
    if(languages == 'en') {
        if( completedMonth == 1 ){
            completedMonth = 'Jan';
        }else if( completedMonth == 2 ){
            completedMonth = 'Feb';
        }else if( completedMonth == 3 ){
            completedMonth = 'Mar';
        }else if( completedMonth == 4 ){
            completedMonth = 'Apr';
        }else if( completedMonth == 5 ){
            completedMonth = 'May';
        }else if( completedMonth == 6 ){
            completedMonth = 'Jun';
        }else if( completedMonth == 7 ){
            completedMonth = 'Jul';
        }else if( completedMonth == 8 ){
            completedMonth = 'Aug';
        }else if( completedMonth == 9 ){
            completedMonth = 'Sep';
        }else if( completedMonth == 10 ){
            completedMonth = 'Oct';
        }else if( completedMonth == 11 ){
            completedMonth = 'Nov';
        }else if( completedMonth == 12 ){
            completedMonth = 'Dec';
        }
    }

    $('#day-completed').html(completedDay);
    $('.disp-day-completed').html(completedDay)
    ;
    $('#month-completed').html(completedMonth);
    $('.disp-month-completed').html(completedMonth);
}

function refreshNumberList( $task, $target, $hiddenID ){
    var currentValue = parseInt($('#' + $target + ' li.disabled').attr('value'));

    if( $task == 'next' ){
        if( currentValue <= 9 ) {
            var nextValue = currentValue + 1;
        }else{
            return;
        }
    }else if($task == 'prev' ){
        var currentValue = parseInt($('#' + $target + ' li.disabled').attr('value'));

        if( currentValue >= -9 ) {
            var nextValue = currentValue - 1;
        }else{
            return;
        }
    }

    $('#' + $target + ' li.disabled').removeClass("disabled");
    $('#' + $target + ' li[value=' + nextValue + ']').addClass("disabled");
    $('.btn-' + $target).html(nextValue + ' %');
    $($hiddenID).val(nextValue);
    $('.disp-' + $target ).html(nextValue);

    var startNumber = nextValue - 4;
    var endNumber = nextValue + 4;

    $( '#' + $target + ' li' ).each(function( index ) {

        var listItemValue = $( this ).attr('value')
        if( listItemValue >= -14 && listItemValue<= 14 ){
            if( (listItemValue == startNumber || listItemValue == endNumber ) && !(listItemValue == 10 || listItemValue == -10) ) {
                $('#' + $target + ' li[value=' + listItemValue + ']').addClass("gray");
            }else{
                $('#' + $target + ' li[value=' + listItemValue + ']').removeClass("gray");
            }

            if(listItemValue >= startNumber && listItemValue<= endNumber ){
                $('#' + $target + ' li[value=' + listItemValue + ']').removeClass("hide");
            }else{
                $('#' + $target + ' li[value=' + listItemValue + ']').addClass("hide");
            }
        }
    });
}

function deleteRawMaterial(e){
    var id = parseInt(this.id.replace("trash_", ""));
    $( "#raw-material-" + id ).remove();

    var oldListString = $('#hidRawMaterialList').val();
    var newListString = "";
    var result = oldListString.split("|");
    for (i = 0; i < result.length; i++) {
        //get raw material id and percentage
        var rawMaterialInfo = result[i].split(",");
        var rawMaterialId = rawMaterialInfo[0];
        var rawMaterialName = rawMaterialInfo[1].trim();
        var percentage = parseInt(rawMaterialInfo[2]);

        if( id != rawMaterialId){
            if( newListString == "" ){
                newListString = rawMaterialId + ',' + rawMaterialName + ',' + percentage;
            }else{
                newListString = newListString + '|' + rawMaterialId + ',' + rawMaterialName  + ',' + percentage;
            }
        }
    }
    $('#hidRawMaterialList').val(newListString);
    displayRawMaterial(newListString);
}

function displayRawMaterial($result){
    var item = $result.split("|");

    $('.disp-raw-material-1').html('');
    $('.disp-raw-material-2').html('');
    $('.disp-raw-material-3').html('');
    $('.disp-raw-material-4').html('');

    for (i = 0; i < item.length; i++) {
        var rawMaterialInfo = item[i].split(",");
        var rawMaterialId = rawMaterialInfo[0];
        var rawMaterialName = rawMaterialInfo[1].trim();
        var percentage = parseInt(rawMaterialInfo[2]);

        var displayValue = rawMaterialName + '&emsp;' + percentage + "%";
        $('.disp-raw-material-' + (i + 1)).html(displayValue);
    }
}

function liMouseOverEffect(e){
    $(this).children('a').addClass("borderClass");
}

function liMouseLeaveEffect(e){
    $(this).children('a').removeClass("borderClass");
}

function liItemSelected(e){
    var target = $(this).attr("data-ite");
    var text = $(this).attr("data");
    var id = $(this).attr("value");
    $("#data-" + target ).text(text.trim());
    $("#hid-" + target ).val(id.trim());
    $("#btn-" + target ).css('color','#ffffff');
    $("#btn-" + target ).addClass('custom-square-display');
    $("#btn-" + target +" i").addClass('custom-square-show');
    $(".disp-" + target ).html(text);
}

function resetItem( $target ){
    $("#data-" + $target ).text('');
    $("#hid-"+ $target ).val(0);
    $("#btn-"+ $target ).css('color','#000000');
    $("#btn-" + $target ).removeClass('custom-square-display');
    $("#btn-" + $target + " i").removeClass('custom-square-show');
}

function SelectListGender(e){
    var id =  $(this).attr("value");

    resetItem('craft');
    resetItem('body-position');
    resetItem('style');
    resetItem('body-shape');

    $.ajax({
        type: "GET",
        url: '/createOrderv2/getLevel2Category',
        dataType: 'json',
        data: {parent_id: id},
        error: function () {
            alert('Unable to get category right now, please try again later');
        },
        success: function (data) {
            if (data['status'] == "OK" ){
                var categoryList = data['result'];
                $("ul#list-body-position").empty();

                for(var i = 0; i < categoryList.length; i++){
                    var categoryName = categoryList[i].name;
                    var categoryId = categoryList[i].id;

                    $html = '<li data-ite="body-position" value="' + categoryId + '" data="' + categoryName + '">' +
                    '   <a class="" href="javascript:;"> ' + categoryName + ' </a>' +
                    '</li>'
                    $("ul#list-body-position").append($html);
                    $('#btn-craft').trigger('click');
                }
            }
        }
    });
}

function SelectListCraft(e){
    resetItem('body-position');
    resetItem('style');
    resetItem('body-shape');

    //need delay to prevent auto close dropdown menu
    setTimeout(function() {
        $('#btn-body-position').trigger('click');
    }, 500);

}

function SelectListBodyPosition(e){
    var id =  $(this).attr("value");

    resetItem('style');
    resetItem('body-shape');

    $.ajax({
        type: "GET",
        url: '/createOrderv2/getLevel3Category',
        dataType: 'json',
        data: {parent_id: id},
        error: function () {
            alert('Unable to get category right now, please try again later');
        },
        success: function (data) {
            if (data['status'] == "OK" ){
                var categoryList = data['result'];
                $("ul#list-style").empty();

                for(var i = 0; i < categoryList.length; i++){
                    var categoryName = categoryList[i].name;
                    var categoryId = categoryList[i].id;

                    $html = '<li data-ite="style" value="' + categoryId + '" data="' + categoryName + '">' +
                            '   <a class="" href="javascript:;"> ' + categoryName + ' </a>' +
                            '</li>'
                    $("ul#list-style").append($html);
                    $('#btn-style').trigger('click');
                }
            }
        }
    });
}

function SelectListStyle(){
    resetItem('body-shape');

    setTimeout(function() {
        $('#btn-body-shape').trigger('click');
    }, 500);
}

function checkIsRawMaterialAlreadyExist($targetRawMaterialId){
    //sample list = "1, Name1, 20 | 2, Name2, 30 | 3, Name3, 10"
    var rawMaterialList = $('#hidRawMaterialList').val();
    var result = rawMaterialList.split("|");
    var isRawMaterialExist = false;
    for (i = 0; i < result.length; i++) {
        //get raw material id and percentage
        var rawMaterialInfo = result[i].split(",");
        var id = rawMaterialInfo[0];
        var name = rawMaterialInfo[1];
        var percentage = rawMaterialInfo[2];

        if( id == $targetRawMaterialId){
            isRawMaterialExist = true;
        }
    }

    return isRawMaterialExist;
}

function getTotalPercentage(){
    //sample list = "1,Name1, 20 | 2, Name2, 30 | 3, Name3, 10"
    var rawMaterialList = $('#hidRawMaterialList').val();
    var result = rawMaterialList.split("|");
    var totalPercentage = 0;

    if( result.length == 1 && result[0] == "" ){
        return totalPercentage;
    }

    for (i = 0; i < result.length; i++) {
        //get raw material id and percentage
        var rawMaterialInfo = result[i].split(",");
        var id = rawMaterialInfo[0];
        var percentage = parseInt(rawMaterialInfo[2]);

        totalPercentage += percentage;
    }

    return totalPercentage;
}

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imgUserUpload-' + id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function displayImage(e){
    var id = parseInt(this.id.replace("fileUpload-", ""));
    readURL(this, id);
    $('#div-img-footer-' + id).show();


    var hidUploadImageInfo = $('#hidUploadImageInfo').val();
    var itemList = [];
    var totalImage = 0;

    if (hidUploadImageInfo != '') {
        itemList = hidUploadImageInfo.split('|');
    }

    var sortList = itemList.sort();
    sortList.push(id);
    sortList = sortList.sort();

    var newString = '';
    if (sortList.length == 0) {
        newString = index;
    } else {
        //rebuild sorting string
        for (var i = 0; i < sortList.length; i++) {
            if( newString == '' ){
                newString = sortList[i];
            }else{
                newString = newString + '|' + sortList[i];
            }
        }
    }

    $('#hidUploadImageInfo').val(newString)

    totalImage = sortList.length;
    if( totalImage >= 4 ){
        $('#div-PictureUpload-Sec2').show();
    }

    if( totalImage >= 7 ){
        $('#div-PictureUpload-Sec3').show();
    }
}

function removeImage(e){
    var id = parseInt(this.id.replace("removeImage-", ""));
    $('#div-img-footer-' + id).hide();
    $('#fileUpload-' + id).val('');
    $('#imgUserUpload-' + id).attr('src', 'http://placehold.it/700x400');

    var oldString = $('#hidUploadImageInfo').val();
    var newString = '';
    var itemList = oldString.split('|');
    for(var i = 0; i < itemList.length; i++ ){
        if(id != itemList[i]){
            if( newString == '' ){
                newString =  itemList[i];
            }else{
                newString = newString + '|' + itemList[i];
            }
        }
    }

    $('#hidUploadImageInfo').val(newString);

    //the existing upload image
    var existingImageId = parseInt(this['attributes']['imageUploadID'].value);
    var deleteExistingImageIDList = $('#hidDeleteExistingImageIDList').val();
    if( existingImageId >= 0 ){
        if( deleteExistingImageIDList == ""){
            deleteExistingImageIDList = existingImageId;
        }else{
            deleteExistingImageIDList = deleteExistingImageIDList + '|' + existingImageId;
        }

        $('#hidDeleteExistingImageIDList').val(deleteExistingImageIDList);

        //reset the existing upload image id value
        this['attributes']['imageUploadID'].value = "";
    }
}