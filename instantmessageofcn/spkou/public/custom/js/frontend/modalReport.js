$(document).ready(function() {

    $('#report-form').on('submit', function() {
        $.ajax({
            url: $('#report-form').prop('action'),
            dataType: 'json',
            data: $('#report-form').serializeArray(),
            method: $('#report-form').prop('method'),
            statusCode: {
                422: function (resp) {
                    var html = '';
                    var json = $.parseJSON(resp.responseText);

                    $.each(json, function(index, value) {
                        $.each(value, function(i, msg) {
                            html += msg;
                        })
                    });
                    $('#modal-report-msg-container').html(html);
                }
            },
            beforeSend: function() {
                $('#modal-report-msg-container').html('');
            },
            success: function(resp) {
                var html = '';
                $.each(resp, function (index, value) {
                    $.each(value, function (i, v) {
                        html += v;
                    });
                });
                $('#modal-report-msg-container').html(html);
            },
            error: function(a, b) {
                if (a.status != 422) {
                    alert('Unknown error occured, please try again later');
                }
            }
        });
        return false;
    });
    $('#submit-report-form').on('click', function () {
        $('#report-form').submit();
    });
});