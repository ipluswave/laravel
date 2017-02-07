$(document).ready(function(){

    var width = $(window).width();
    $.ajax({
        url: "/home/storeScreenWidth",
        data : {screenwidth:width}
    }).done(function() {
        //alert('Successfully Send : ' + width);
    });

    if( width > 1140){
        var margin = ( width - 1140) / 2;
        $('.page-header.navbar.navbar-fixed-top').css('margin-right', margin).css('margin-left', margin);
        $('body').attr('style', 'margin-right: ' + margin + 'px !important; margin-left: ' + margin + 'px !important;' );
    }else{
        $('.page-header.navbar.navbar-fixed-top').css('margin-right', 0).css('margin-left', 0);
        $('body').attr('style', 'margin-right: ' + 0 + 'px !important; margin-left: ' + 0 + 'px !important;' );
    }

    $( window ).resize(function() {
        var width = $(window).width();
        if( width > 1140){
            var margin = ( width - 1140) / 2;
            $('.page-header.navbar.navbar-fixed-top').css('margin-right', margin).css('margin-left', margin);
            $('body').attr('style', 'margin-right: ' + margin + 'px !important; margin-left: ' + margin + 'px !important;' );
        }else{
            //mean not need margin
            width = 1140;

            $('.page-header.navbar.navbar-fixed-top').css('margin-right', 0).css('margin-left', 0);
            $('body').attr('style', 'margin-right: ' + 0 + 'px !important; margin-left: ' + 0 + 'px !important;' );
        }

        $.ajax({
            url: "/home/storeScreenWidth",
            data : {screenwidth:width}
        }).done(function() {
            //alert('Successfully Send : ' + width);
        });
    });
});