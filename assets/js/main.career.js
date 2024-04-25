$(function(){
	$('#frmCareer').validate({
		errorPlacement: function(error, element) {
		  $(element).closest('.form-group').append(error);
		},
		rules: {
			'ddl_prof_type': {
				required: true
			},
			'ddl_coord_type': {
				required: true
			},
			'fullname': {
				required: true
			},
			'father_name': {
				required: true
			},
			'dob': {
				required: true
			},
			'gender': {
				required: true
			},
			'contact_1': {
				required: true,
				digits: true,
				minlength: 10,
				maxlength: 10,
			},
			'contact_2': {
				digits: true,
				minlength: 10,
				maxlength: 10,
			},
			'email': {
				required: true,
				email: true
			},
			'ver_code': {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 6,
			},
			'address': {
				required: true
			},
			'district': {
				required: true
			},
			'block': {
				required: true
			},
			'pincode': {
				required: true,
				digits: true,
				minlength: 6,
				maxlength: 6,
			},
			'hsboard': {
				required: true
			},
			'hsgrade': {
				required: true
			},
			'hsyear': {
				required: true,
				digits: true,
				minlength: 4,
				maxlength: 4,
			},
			'gryear': {
				digits: true,
				minlength: 4,
				maxlength: 4,
			},
			'mayear': {
				digits: true,
				minlength: 4,
				maxlength: 4,
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
			var frmData = new FormData($('#frmCareer')[0]);
			$.ajax({
				beforeSend: () => {
					$('#btn_apply').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
					$('#btn_apply').attr('disabled', 'disabled');
				},
				url: baseURL+'submitCareerApplication',
				type: 'POST',
				data: frmData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: (resp) => {
					if(resp.status){
						window.open(baseURL+resp.webURL, '_self');
					}else{
						$('#frmCareer')[0].reset();
						$('#btn_apply').html('Apply');
						$('#btn_apply').removeAttr('disabled');
						Swal.fire(
						  'Error',
						  resp.errors,
						  'error'
						)
					}
				},
				error: (err) => {
					$('#btn_apply').html('Apply');
					$('#btn_apply').removeAttr('disabled');
				}
			});
		}
	});
});

$('#ddl_prof_type').on('change', (e) => {
	if(e.target.value != ""){
		$('#show_coord').hide();
	}else{
		$('#show_coord').show();
	}
});

$('#ddl_coord_type').on('change', (e) => {
	if(e.target.value != ""){
		$('#show_prof').hide();
	}else{
		$('#show_prof').show();
	}
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
	//alert(email);
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