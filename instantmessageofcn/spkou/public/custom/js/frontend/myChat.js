$(document).ready(function () {
    $('#recent-chats').on('click','a',function(e){
        var url = $(this).data('url');
        $.ajax({
            url: url,
            dataType: 'json',
            method: 'get',
            beforeSend: function() {
                $('#content-chat').html('<center><h3>loading ...</h3></center>');
                $('#caption-chat').html('loading ...');
                $('.chat-form').addClass('hidden');
                $('.chat-form form #receiverId').val(0);
            },
            success: function(result) {
                if(result.status == 'OK'){
                    $('#caption-chat').html(result.realName);
                    $('#content-chat').html('<ul class="chats"></ul>');
                    $('.chat-form').removeClass('hidden');
                    $('.chat-form form #receiverId').val(result.receiverId);
                    $.each(result.chatLog, function(i, e) {
                        $('#content-chat ul').append('<li class="'+e.status+'">'+
                                                        '<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />'+
                                                        '<div class="message">'+
                                                            '<span class="arrow"> </span>'+
                                                            '<a href="javascript:void(0);" class="name"> '+e.email+' </a>'+
                                                            '<span class="datetime"> at '+e.time.date+'</span>'+
                                                            '<span class="body"> '+ e.content +' </span>'+
                                                        '</div>'+
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
        return false;
    });
    $('#recent-chats li').first().find('a').first().trigger('click');
    
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
                    $('#content-chat ul').append('<li class="out">'+
                                                        '<img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />'+
                                                        '<div class="message">'+
                                                            '<span class="arrow"> </span>'+
                                                            '<a href="javascript:void(0);" class="name"> '+result.realName+' </a>'+
                                                            '<span class="datetime"> at '+result.time.date+'</span>'+
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

    $('#invite-chat-form').submit(function(e){
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
                }
            },
            beforeSend: function() {
            },
            success: function(result) {
                if(result.status == "OK"){
                    $('#invite-chat-sucess').html('<div class="custom-alerts alert alert-success fade in">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                            '<i class="fa-lg fa fa-check"></i> Invitation send, wait for reply.'+
                        '</div>');
                    
                    setTimeout(function(){
                        $('#modalChatInvite').modal('hide');
                    }, 2000);
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