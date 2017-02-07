$(document).ready(function () {
	setTimeout(function(){
    	var url = $('.order-conversation').data('url');
        console.log(url);
    	$.ajax({
            url: url,
            dataType: 'json',
            method: 'get',
            beforeSend: function() {
            },
            success: function(result) {
                if(result.status == 'OK'){
                    $('#content-chat').html('<ul class="chats"></ul>');
                    $.each(result.chatLog, function(i, e) {
                        var changeDate = '';
                        if(e.changeDate == 1){
                            changeDate = '<li><div class="strike"><span>'+e.date+'</span></div></li>';
                        }
                        var image = '';
                        if(e.isImage == 1){
                            image = '<br><img src="/'+e.file+'" width="30%" />'
                        }
                        var audio = '';
                        if(e.isAudio == 1){
                            audio = '<br><audio controls><source src="/'+e.file+'" type="audio/ogg"><source src="'+e.file+'" type="audio/mp3">Your browser does not support the audio element.</audio>'
                        }
                        $('#content-chat ul').append(changeDate+'<li class="'+e.status+'">'+
                                                        '<img class="avatar" alt="" src="'+e.avatar+'" />'+
                                                        '<div class="message">'+
                                                            '<span class="arrow"> </span>'+
                                                            '<a href="javascript:void(0);" class="name"> '+e.email+' </a>'+
                                                            '<span class="body"> '+ e.content +' '+image+''+audio+'</span>'+
                                                        '</div>'+
                                                        '<div class="div-datetime">' +
                                                            '<span class="datetime">'+e.time+'</span>'+
                                                        '</div>' +
                                                    '</li>');
                    });
                }
            },
            error: function(a, b) {
                if (a.status != 422) {
                    alert('Unknown error occured, please try again later');
                }
            }
        });
    }, 1000);
    
    $('#chat-message-img').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#add-order-file-chat').attr('action',url);
        $('#modalAddFileChat').modal('show');
    });

    $('#chat-message-file').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $('#add-order-file-chat').attr('action',url);
        $('#modalAddFileChat').modal('show');
    });

	$('.chat-form form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            method: 'post',
            statusCode: {
                422: function (resp) {
                    var html = '';
                    var json = $.parseJSON(resp.responseText);

                    $.each(json, function(index, value) {
                        $.each(value, function(i, msg) {
                            alertError(msg, 'test');
                        })
                    });

                    //$('.chat-form .error-msg').html(html);
                }
            },
            beforeSend: function() {
                $('.chat-form .error-msg').html('');
            },
            success: function(result) {
                if(result.status == "OK"){
                    $('#content-chat ul').append('<li class="in">'+
                                                        '<img class="avatar" alt="" src="'+result.avatar+'" />'+
                                                        '<div class="message">'+
                                                            '<span class="arrow"> </span>'+
                                                            '<a href="javascript:void(0);" class="name"> '+result.realName+' </a>'+
                                                            '<span class="datetime"> at '+result.time+'</span>'+
                                                            '<span class="body"> '+ result.message +' </span>'+
                                                        '</div>'+
                                                    '</li>');
                    $('.chat-form .message').val('');
                }
            },
            error: function(a, b) {
                if (a.status != 422) {
                    alert('Unknown error occured, please try again later');
                }
            }
        });
        return false;
    });

	$('#invite-helpdesk').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'get',
            statusCode: {
                422: function (resp) {
                    var html = '';
                    var json = $.parseJSON(resp.responseText);

                    $.each(json, function(index, value) {
                        $.each(value, function(i, msg) {
                            alertError(msg, 'test');
                        })
                    });

                    //$('.chat-form .error-msg').html(html);
                }
            },
            beforeSend: function() {
                $('.chat-form .error-msg').html('');
            },
            success: function(result) {
                if(result.status == "OK"){
                    $('#content-chat ul').append('<li class="in">'+
                                                        '<img class="avatar" alt="" src="'+result.avatar+'" />'+
                                                        '<div class="message">'+
                                                            '<span class="arrow"> </span>'+
                                                            '<a href="javascript:void(0);" class="name"> '+result.realName+' </a>'+
                                                            '<span class="datetime"> at '+result.time+'</span>'+
                                                            '<span class="body"> '+ result.message +' </span>'+
                                                        '</div>'+
                                                    '</li>');
                    alertSuccess('Invitation sent', 'clear');
                }
            },
            error: function(a, b) {
                if (a.status != 422) {
                    alert('Unknown error occured, please try again later');
                }
            }
        });
        return false;
    });

    $('#add-order-file-chat').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData( this );
        console.log(data);
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            method: 'post',
            statusCode: {
                422: function (resp) {
                    $('.modal-alert-container').html('');
                    var json = $.parseJSON(resp.responseText);

                    $.each(json, function(index, value) {
                        $.each(value, function(i, msg) {
                            $('.modal-alert-container').append('<div class="custom-alerts alert alert-danger fade in">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                                    '<i class="fa-lg fa fa-fa fa-times"></i>'+msg+'</div>');
                        })
                    });

                    //$('.chat-form .error-msg').html(html);
                }
            },
            beforeSend: function() {
                $('.chat-form .error-msg').html('');
            },
            success: function(result) {
                if(result.status == "OK"){
                    $('.modal-alert-container').html('<div class="custom-alerts alert alert-success fade in">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                                    '<i class="fa-lg fa fa-fa fa-check"></i>Upload success</div>');
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }
            },
            error: function(a, b) {
                if (a.status != 422) {
                    alert('Unknown error occured, please try again later');
                }
            }
        });
        return false;
    });
});