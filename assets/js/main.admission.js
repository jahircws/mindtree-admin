$(function(){

	$('#frmAdmission').validate({
		errorPlacement: function(error, element) {
		  $(element).closest('.form-group').append(error);
		},
		rules: {
			'ver_code': {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 6,
			},
			'nationality': {
				required: true,
			},
			'religion': {
				required: true,
			},	
			'aadhar_no': {
				required: true,
				digits: true,
				minlength: 12,
				maxlength: 12
			},
			'pan_no': {
				minlength: 10,
				maxlength: 10
			},
			'family_name': {
				required: true,
			},
			'family_work': {
				required: true,
			},
			'family_income': {
				required: true,
				digits: true
			},
			'emergency': {
				digits: true,
				minlength: 10,
				maxlength: 10
			},
			'bank_name': {
				required: true
			},
			'account_no': {
				required: true,
				digits: true,
			},
			'branch_name': {
				required: true
			},
			'ifsc_code': {
				required: true
			},
			'termCheck': {
				required: true
			}
		},
		messages: {
			'ver_code': {
				required: 'The email has to be verified. Click `Get OTP`.'
			}
		},
		submitHandler: (form, e) => {
			e.preventDefault();
			var frmData = new FormData($("#frmAdmission")[0]);

			$.ajax({
				beforeSend: ()=>{
					$('#btn_preview').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
					$('#btn_preview').attr('disabled', 'disabled');
				},
				url: baseURL+'preview_registration',
				type: 'POST',
				data: frmData,
				dataType: 'json',
				processData: false,
				contentType: false,
				success: (resp)=>{
					if(resp.status){
						window.open(baseURL+resp.webURI, '_self');
					}else{
						$('#btn_preview').html("Register Now");
						$('#btn_preview').removeAttr('disabled');
						Swal.fire(
						  'Warning',
						  'Admission data submition failed. Try again.',
						  'warning'
						);
					}
				},
				error: (err)=>{
					$('#btn_preview').html("Register Now");
					$('#btn_preview').removeAttr('disabled');
					Swal.fire(
					  'Warning',
					  'Something went wrong. Please try again.',
					  'warning'
					);
				}
			});
		}
	});

});

$('#btn_save').on('click', () => {
	$.ajax({
		beforeSend: ()=>{
			$('#btn_save').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
			$('#btn_save').attr('disabled', 'disabled');
		},
		url: baseURL+'complete_registration',
		type: 'POST',
		data: { cid: $('#cid').val(), enroll: $('#enroll').val() },
		dataType: 'json',
		success: (resp)=>{
			if(resp.status){
				window.open(baseURL+resp.webURI, '_self');
			}else{
				$('#btn_save').html("Save Now");
				$('#btn_save').removeAttr('disabled');
				Swal.fire(
				  'Warning',
				  'Admission data completion failed. Try again.',
				  'warning'
				);
			}
		},
		error: (err)=>{
			$('#btn_save').html("Save Now");
			$('#btn_save').removeAttr('disabled');
			Swal.fire(
			  'Warning',
			  'Something went wrong. Please try again.',
			  'warning'
			);
		}
	});
});

$('#email').on('keyup', ()=>{
	$('#email_verified').val(0);
	$('#ver_code').val("");
	//$('#ver_code').attr('disabled', 'disabled');
	$('#btn_bool').html('<i class="fa fa-ban text-danger"></i>');
	$('#btn_check').attr('disabled', 'disabled');
});

$('#btn_otp').on('click', ()=>{
	var email = $('#email').val();
	$.ajax({
		beforeSend: ()=>{
			$('#btn_otp').html("<span class='spinner-border spinner-border-sm'></span> Sending..");
			$('#btn_otp').attr('disabled', 'disabled');
		},
		url: baseURL+'getEMailOTP',
		type: 'GET',
		data: { email: email },
		dataType: 'json',
		success: (resp)=>{
			$('#btn_otp').html("Get OTP");
			$('#btn_otp').removeAttr('disabled');
			if(resp.status){
				//$('#ver_code').removeAttr('disabled');
				$('#email_otp').val(resp.vcode);
				$('#btn_check').removeAttr('disabled');
				Swal.fire(
				  'Success',
				  'OTP has been mailed. Enter and check to verify it.',
				  'success'
				)
			}else{
				Swal.fire(
				  'Error',
				  resp.errors,
				  'error'
				)
			}
		},
		error: (err)=>{
			$('#btn_otp').html("Get OTP");
			$('#btn_otp').removeAttr('disabled');
			Swal.fire(
			  'Error',
			  'Something went wrong. Please try again.',
			  'error'
			)
		}
	});
});

$('#btn_check').on('click', ()=>{
	$otp = $('#email_otp').val();
	$votp = btoa($('#ver_code').val());

	if($otp === $votp){
		$('#email_verified').val(1);
		$('#btn_bool').html('<i class="fa fa-check text-success"></i>');
		$('#btn_check').attr('disabled', 'disabled');
		Swal.fire(
		  'Success',
		  'Email Verified.',
		  'success'
		)
	}else{
		$('#email_verified').val(0);
		$('#ver_code').val("");
		//$('#ver_code').attr('disabled', 'disabled');
		$('#btn_bool').html('<i class="fa fa-ban text-danger"></i>');
		$('#btn_check').attr('disabled', 'disabled');
		Swal.fire(
		  'Error',
		  'OTP not matched. Try again',
		  'error'
		)
	}
});