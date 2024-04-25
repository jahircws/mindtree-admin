$(function(){
	$('#frmLogin').on('submit', (e) => {
		e.preventDefault();
		var frmData = new FormData($('#frmLogin')[0]);
		$.ajax({
			beforeSend: ()=>{
				$('#btn_login').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
				$('#btn_login').attr('disabled', 'disabled');
			},
			url: baseURL+'masteradmin/userAuthentication',
			type: 'POST',
			data: frmData,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: (resp)=>{
				if(resp.accessGranted){
					window.open(baseURL+resp.webURI, '_self');
				}else{
					$('#btn_login').html('Login');
					$('#btn_login').removeAttr('disabled');
					Swal.fire({
					  title: 'Error',
					  html: resp.errors,
					  icon: 'error'
					});
				}
			},
			error: (err)=>{
				$('#btn_login').html('Login');
				$('#btn_login').removeAttr('disabled');
				Swal.fire(
				  'Error',
				  'Something went wrong.',
				  'error'
				);
			} 
		});
	});
	$('#frmAuthLogin').on('submit', (e) => {
		e.preventDefault();
		var frmData = new FormData($('#frmAuthLogin')[0]);
		$.ajax({
			beforeSend: ()=>{
				$('#btn_login').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
				$('#btn_login').attr('disabled', 'disabled');
			},
			url: baseURL+'coordinatoradmin/userAuthentication',
			type: 'POST',
			data: frmData,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: (resp)=>{
				if(resp.accessGranted){
					window.open(baseURL+resp.webURI, '_self');
				}else{
					$('#btn_login').html('Login');
					$('#btn_login').removeAttr('disabled');
					Swal.fire({
					  title: 'Error',
					  html: resp.errors,
					  icon: 'error'
					});
				}
			},
			error: (err)=>{
				$('#btn_login').html('Login');
				$('#btn_login').removeAttr('disabled');
				Swal.fire(
				  'Error',
				  'Something went wrong.',
				  'error'
				);
			} 
		});
	});
});