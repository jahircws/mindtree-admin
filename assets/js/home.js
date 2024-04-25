$(function(){
	$('#frmEnrollment').validate({
		errorPlacement: function(error, element) {
		  $(element).closest('.form-group').append(error);
		},
		rules: {
			'enroll_no': {
				required: true
			}
		},
		messages: {
			'enroll_no': {
				required: 'Enrollment number is must'
			}
		},
		submitHandler: (form, e) => {
			
			e.preventDefault();
			var enrollNo = $('#enroll_no').val().trim();
			$.ajax({
				beforeSend: () => {
					$('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
					$('#btn_submit').attr('disabled', 'disabled');
				},
				url: baseURL+'check_enrollment',
				type: 'GET',
				data: { enrollNo: enrollNo },
				dataType: 'json',
				success: (resp) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
					if(resp.status){
						$('#mem_data').html(resp.memData);
					}else{
						Swal.fire(
						  'Error!',
						  resp.errors,
						  'error'
						)
					}
				},
				error: (err) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
				}
			});
		}
	});

	$('#frmChkAdmission').validate({
		errorPlacement: function(error, element) {
		  $(element).closest('.form-group').append(error);
		},
		rules: {
			'enroll_no': {
				required: true
			}
		},
		messages: {
			'enroll_no': {
				required: 'Enrollment number is must'
			}
		},
		submitHandler: (form, e) => {
			
			e.preventDefault();
			var enrollNo = $('#enroll_no').val().trim();
			$.ajax({
				beforeSend: () => {
					$('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
					$('#btn_submit').attr('disabled', 'disabled');
				},
				url: baseURL+'check_qualified_enrollment',
				type: 'GET',
				data: { enrollNo: enrollNo },
				dataType: 'json',
				success: (resp) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
					if(resp.status){
						window.location.href = baseURL+resp.webURI;
						//window.open(baseURL+resp.webURI, '_self');
					}else{
						Swal.fire(
						  resp.title,
						  resp.errors,
						  resp.icon
						)
					}
				},
				error: (err) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
					Swal.fire(
					  'Error',
					  'Something went wrong. Please try again.',
					  'error'
					)
				}
			});
		}
	});

	$('#frmExam').validate({
		errorPlacement: function(error, element) {
		  $(element).closest('.form-group').append(error);
		},
		rules: {
			'enroll_no': {
				required: true
			},
			'dob': {
				required: true
			}
		},
		messages: {
			'enroll_no': {
				required: 'Enrollment number is must'
			},
			'dob': {
				required: 'DOB is must'
			}
		},
		submitHandler: (form, e) => {
			
			e.preventDefault();
			var enrollNo = $('#enroll_no').val().trim();
			$.ajax({
				beforeSend: () => {
					$('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
					$('#btn_submit').attr('disabled', 'disabled');
				},
				url: baseURL+'Exam/check_exam_enrollment',
				type: 'GET',
				data: { enrollNo: enrollNo, dob: $('#dob').val() },
				dataType: 'json',
				success: (resp) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
					if(resp.status){
						$('#mem_data').html(resp.memData);
					}else{
						Swal.fire(
						  'Error',
						  resp.errors,
						  'error'
						)
					}
				},
				error: (err) => {
					$('#btn_submit').html('Check');
					$('#btn_submit').removeAttr('disabled');
				}
			});
		}
	});
});

function setupPayment(tprice, fid, name, email, mobile, ptype)
{

	$.ajax({
		beforeSend: ()=>{
			Swal.fire(
			  'Warning',
			  'Please do not refresh/close your window during payment process.',
			  'warning'
			);
			$('#btn_pay').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
			$('#btn_pay').attr('disabled', 'disabled');
		},
		url: baseURL+'setPaymentOrder',
		dataType: 'json',
		data: { 'tprice': tprice, 'fid': fid, 'name': name, 'email': email, 'mobile': mobile },
		type: 'POST',
		success: (options)=>{
			options.modal = {
			    "ondismiss": function(){
			        $('#btn_pay').html('Pay: ₹'+tprice);
					$('#btn_pay').removeAttr('disabled');
			     }
			};
			options.handler = function (response){
				response.fid = fid;
				response.ptype = ptype;
				$('#btn_pay').html("<span class='spinner-border spinner-border-sm'></span> Completing..");
				$.post(baseURL+"paymentStatus", {response}, function(result){
					//console.log(result);
					var obj = JSON.parse(result);
					if(obj['status']){
						//window.open(baseURL+obj['webURI'], '_blank');
						Swal.fire({
						  title: 'Successfull!',
						  text: 'Payment Successfull.',
						  icon: 'success',
						  showCancelButton: false,
						  confirmButtonText: 'Okay',
						}).then((respond) => {
						  if (ptype === 'exam_fees') {
							  window.location.href = baseURL+obj['webURI'];
						    //window.location.reload();
						  } else{
							  window.location.href = baseURL+obj['webURI'];
						    //window.open(baseURL+'admission', '_self');
						  }
						});
					}else{
						Swal.fire(
						  'Error',
						  'Your payment failed.',
						  'error'
						);
						$('#btn_pay').html('Pay: ₹'+tprice);
						$('#btn_pay').removeAttr('disabled');
					}
				});
			};
			var rzp1 = new Razorpay(options);
			rzp1.on('payment.failed', function (respond){
				console.log(respond.error);
				Swal.fire(
				  'Error',
				  'Your payment failed. Try again.',
				  'error'
				);
				$('#btn_pay').html('Pay: ₹'+tprice);
				$('#btn_pay').removeAttr('disabled');
			});
			rzp1.open();
		},
		error: (err)=>{
			$('#btn_pay').html('Pay: ₹'+tprice);
			$('#btn_pay').removeAttr('disabled');
		}
	});
}
