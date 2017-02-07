$(document).ready(function () {
	var is_request = 0;
	$('.chat-bell').hover(function(e){
		var url = $(this).data('url');
		if(is_request == 0){
			console.log(is_request);
			$.ajax({
	            url: url,
	            dataType: 'json',
	            method: 'get',
	            beforeSend: function() {
	            	is_request = 1;
					console.log(is_request);
	            },
	            success: function(result) {
	                if(result.status == 'OK'){
	                }
	                setTimeout(function(){is_request = 0; }, 5000);
	                console.log(is_request);
	            },
	            error: function(a, b) {
	                if (a.status != 422) {
	                    alert('Unknown error occured, please try again later');
	                }
	            }
	        });
		}
	})
});