$(document).ready(function() {

	$(document).on("click", "#register_save_btn", function() {
		save_password();	
	} );	
	
	//save on pressing Enter
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			save_password();	
		}
	});
	
    function save_password() {
		var element_passwort = document.getElementById("edit-passwort");
		var element_confirm = document.getElementById("edit-passwort-bestaetigung");
		var input_error = false;
		var password = element_passwort.value;
		var confirm = element_confirm.value;
		$('#page_message').html('');
		element_passwort.classList.remove("invalid_input");
		element_confirm.classList.remove("invalid_input");
		hide_password_hints();
		if (password.length == 0)
		{
			document.getElementById("invalid_input_message").classList.remove("div_hidden");
			element_passwort.classList.add("invalid_input");		
			input_error = true;
		}

		if (!input_error && password != confirm)
		{
			document.getElementById("password_not_equal").classList.remove("div_hidden");
			element_confirm.classList.add("invalid_input");		
			input_error = true;
		}

		if (input_error)
		{
			return;
		}

		var email =  $('#email').val();
		var request_key =  $('#request_key').val();
		var token =  $('#token').val();
		
		var data = {
		   email : email,
		   password : password,
		   request_key : request_key,
		   token : token,
		   Action: 'ResetPassword'
		};
		ShowOverlay();
		$.ajax({
			type: 'POST',
			url: "set/set_user.php",
			data: data,
			async: true,
			success : function( retdata ) {
				$('#page_message').html('');
				try {
					var obj = JSON.parse(retdata);
					if (obj['error'] !== '')
					{
						$('#page_message').html('<div class="alert alert-danger">' + obj['error'] + '</div>');
					}
					else
					{
						document.getElementById("reset_div").classList.add("div_hidden");
						document.getElementById("success_message").classList.remove("div_hidden");
					}
				}
				catch(err)
				{
					$('#page_message').html('<div class="alert alert-danger">' + retdata + '</div>');
				}
				HideOverlay();
			},
			error : function() {
				$('#page_message').html('<div class="alert alert-danger">Error while saving the password</div>');
				HideOverlay();
			}
		});   
	};	
	
	function hide_password_hints()
	{
		document.getElementById("invalid_input_message").classList.add("div_hidden");
		document.getElementById("password_not_equal").classList.add("div_hidden");
	}
	
} );


