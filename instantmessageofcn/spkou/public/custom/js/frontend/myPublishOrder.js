jQuery(
    function ($) {
        $("input[name='size-number']").TouchSpin({
            initval: 50
        });

        // $('.kv-fa').rating({
            // defaultCaption: '{rating}',
            // starCaptions: function (rating) {
                // return rating;
            // },
            // starCaptionClasses: function(val) {
                // return 'star-caption';
            // },
            // filledStar: '<i class="fa fa-star"></i>',
            // emptyStar: '<i class="fa fa-star-o"></i>'
        // });

        // $('.ttl-evaluation').rating({
            // defaultCaption: '{rating}',
            // starCaptions: function (rating) {
                // return ' ';
            // },
            // starCaptionClasses: function(val) {
                // return 'star-caption';
            // },
            // filledStar: '<i class="fa fa-star"></i>',
            // emptyStar: '<i class="fa fa-star-o"></i>'
        // });

        // $('.tailor-rated-val').rating({
            // defaultCaption: '{rating}',
            // starCaptions: function (rating) {
                // return ' ';
            // },
            // starCaptionClasses: function(val) {
                // return 'star-caption';
            // },
            // filledStar: '<span style="color:#777777"><i class="fa fa-star"></i></span>',
            // emptyStar: '<span style="color:#cccccc"><i class="fa fa-star"></i></span>'
        // });

        // $('.user-rated-val').rating({
            // defaultCaption: '{rating}',
            // starCaptions: function (rating) {
                // return ' ';
            // },
            // starCaptionClasses: function(val) {
                // return 'star-caption';
            // },
            // filledStar: '<span style="color:#777777"><i class="fa fa-star"></i></span>',
            // emptyStar: '<span style="color:#cccccc"><i class="fa fa-star"></i></span>'
        // });

        // ratingHistogram();
    }
);

function ratingHistogram(){
    $('.bar span').hide();
    $('#bar-five').animate({
        width: '100%'}, 1000);
    $('#bar-four').animate({
        width: '35%'}, 1000);
    $('#bar-three').animate({
        width: '20%'}, 1000);
    $('#bar-two').animate({
        width: '15%'}, 1000);
    $('#bar-one').animate({
        width: '30%'}, 1000);

    setTimeout(function() {
        $('.bar span').fadeIn('slow');
    }, 1000);
}
