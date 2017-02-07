$(document).ready(function () {

    $(document).on('click', 'a.cad-file-link', function () {
        var file = $(this).data('file');
        var url = '//sharecad.org/cadframe/load?url=';
        $('#modal-cad').find('.modal-body').html('');
        if (typeof file !== 'undefined') {
            url = url + window.location.hostname + file;
            $('#modal-cad').modal('show');
            $('#modal-cad').find('.modal-body').html('<iframe src="' + url + '" frameborder="0" scrolling="no" style="width: 100%; min-height: 300px;" onload="resizeIframe(this);"></iframe>');
        }
    });

    $('#modal-cad').on('shown.bs.modal', function () {
        var iFrameID = document.getElementById('cad-iframe');
        if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
        }
    });

	setTimeout(function(){
    	var url = $('.order-conversation').data('url');
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

        var urlFile = $('.order-conversation').data('urlfile');
        $.ajax({
            url: urlFile,
            dataType: 'json',
            method: 'get',
            beforeSend: function() {
            },
            success: function(result) {
                if(result.status == 'OK' && result.count > 0){
                    $('#file-content').html('');
                    $('.file-upload .slimScrollDiv').css('height', '300px');
                    $('#content-file').css('height', '300px');
                    $.each(result.chatLog, function(i, e) {
                        $('.file-list').append(
                            '<li>' +
                                '<div class="file-logo pull-left">' +
                                    '<img alt="file-logo" src="/images/file-logo.png">' +
                                '</div>' +
                                '<div class="file-info text-left">' +
                                    'filename : '+e.content+'<br/>' +
                                    '<span class="size-datetime">'+e.size+' - '+e.time+'</span><br>' +
                                    '<a href="/'+e.file+'" class="download-file">下载纸样</a>' +
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
                    alertSuccess('Upload success', 'test');
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