(function($){
	$(document).ready(function(){
		$("#submit").on('click',function(){
			$.post(admin_ajex.admin_url,{
				action: 'form',
				gemail: $("#email").val(),
				message: $("#message").val(),
				_ajax_nonce: admin_ajex.nonce,

			}, function(response){
				console.log(response);

			});
			return false;
		})
		
	});
})(jQuery)