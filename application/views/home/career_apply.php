<style>
	.error {
		color: red;
	}
	.heading {
		background-color: #3f1651;
		padding: 10px;
		color: white;
		border-radius: 10px 10px 0px 0px;
	}
	.wizard-content-left {
		background-blend-mode: darken;
		background-color: rgba(0, 0, 0, 0.45);
		background-image: url('<?= base_url('assets/images/admission.jpg'); ?>');
		background-position: center center;
		background-size: cover;
		height: 100vh;
		padding: 30px;
	}
	.wizard-content-left h1 {
		color: #ffffff;
		font-size: 38px;
		font-weight: 600;
		padding: 12px 20px;
		text-align: center;
	}

	.form-wizard {
		color: #888888;
		padding: 30px;
	}
	#frmCareer {
		background-color: #ffffff;
		padding: 40px;
	}

	/* Hide all steps by default: */
	.tab{
		display: none;
		width: 100%;
		height: 50%;
		margin: 0px auto;
	}
	.current{
		display: block;
	}
	input.invalid {
		background-color: #ffdddd;
	}

	/* Make circles that indicate the steps of the form: */
	.step {
		height: 15px;
		width: 15px;
		margin: 0 2px;
		background-color: #bbbbbb;
		border: none;
		border-radius: 50%;
		display: inline-block;
		opacity: 0.5;
	}

	/* Mark the active step: */
	.step.active {
		opacity: 1;
	}

	/* Mark the steps that are finished and valid: */
	.step.finish {
		background-color: #04AA6D;
	}
</style>

<section class="container wizard-section">
	<div class="row no-gutters justify-content-center">
		<div class="col-lg-8 col-md-8">
			<form id="frmCareer" action="">
				<input type="hidden" name="token" id="token" value="<?= $token; ?>">
				<input type="hidden" name="id" id="id" value="<?= $fp[0]->id; ?>">
				<input type="hidden" name="status" id="status" value="<?= $fp[0]->status; ?>">
				<h2 class="text-center">Admission Form</h2>
				<hr>
				<!-- One "tab" for each step in the form: -->
				<div class="tab">
					<div class="form-group mb-3" style="padding: 4px;">  
						<div class="row align-items-center">
							<div class="col-md-6" style="background-color: #e53f71;">
								<div class="form-group text-white">
									<label for="" class="">Course:</label><br>
									<?= $course_name; ?>
									<input type="hidden" name="course_name" id="course_name" value="<?= $course_name; ?>" class="form-control" readonly>
									<input type="hidden" name="course_id" id="course_id" value="<?= $course_id; ?>" class="form-control" readonly>
								</div>
							</div>
							<div class="col-md-6" style="background-color: #e53f71;">
								<div class="form-group text-white">
									<label for="" class="">Session:</label><br>
									<?= date('Y') ?>
									<input type="hidden" name="course_session" id="course_session" value="<?= date('Y') ?>" class="form-control" readonly>
								</div>
							</div>
						</div>
					</div>
					<h4 class="font-weight-bold heading text-center">Personal Details</h4>
					
					<div class="form-group">
						<label>Candidate name<span class="text-danger">*</span></label>
						<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter full name" value="<?= $fp[0]->candidate_name; ?>">
					</div>
					<div class="form-group">
						<label>Guardian name<span class="text-danger">*</span></label>
						<input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter your father name" value="<?= $fp[0]->father_name; ?>">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Gender<span class="text-danger">*</span></label>
								<div class="form-group">
									
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="gender_f" name="gender" value="Female" <?php if($fp[0]->gender == 'Female'){ echo 'checked';} ?>>
									<label class="form-check-label" for="gender_f">Female</label>
									</div>
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" id="gender_m" name="gender" value="Male"<?php if($fp[0]->gender == 'Male'){ echo 'checked';} ?>>
									<label class="form-check-label" for="gender_m">Male</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>D.O.B<span class="text-danger">*</span></label>
								<input type="date" name="dob" id="dob" class="form-control" value="<?= $fp[0]->dob; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nationality<span class="text-danger">*</span></label>
								<input type="text" name="nationality" id="nationality" class="form-control" value="<?= $fp[0]->nationality; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="tab">
					<h4 class="font-weight-bold heading text-center">Communication Details</h4>
						<div class="form-group">
							<label>Email<span class="text-danger">*</span></label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter valid email" value="<?= $fp[0]->email; ?>">
						</div>
						<div class="form-group">
							<label>Mobile <span class="text-danger">*</span></label>
							<input type="text" name="contact_1" id="contact_1" class="form-control" placeholder="Enter your mobile number" value="<?= $fp[0]->mobile; ?>">
						</div>
						
						<div class="form-group">
							<label>Alternet Contact No</label>
							<input type="text" name="contact_2" id="contact_2" class="form-control" placeholder="Alternate contact number, if any" value="<?= $fp[0]->alt_mobile; ?>">
						</div>
						
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label>Correspondence Address (P.S & P.O – Must be mentioned)<span class="text-danger">*</span></label>
									<input type="text" name="pre_address" id="pre_address" class="form-control" value="<?= $fp[0]->present_address; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>State<span class="text-danger">*</span></label>
									<select name="pre_ddl_state" id="pre_ddl_state" class="form-select" onchange="getDistrict(this.value, 'pre_', 0);">
										<option value="">Select States</option>
										<?php 
											if(!empty($states)){
												foreach($states as $state){
													echo ($fp[0]->pre_state)? '<option value="'.$state->state_id.'" selected>'.$state->state_title.'</option>' : '<option value="'.$state->state_id.'">'.$state->state_title.'</option>';
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>District<span class="text-danger">*</span></label>
									<select name="pre_district" id="pre_district" class="form-select">
										<option value="">Select District</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>PIN Code<span class="text-danger">*</span></label>
									<input type="text" name="pre_pincode" id="pre_pincode" class="form-control" value="<?= $fp[0]->pre_pin_code; ?>">
								</div>
							</div>
						</div>
						
				</div>

				<div class="tab">
					<h4 class="font-weight-bold heading text-center">Select Qualification</h4>
					<div class="form-group">
						<label>Last Qualification<span class="text-danger">*</span></label>
						<select name="hs" id="hs" class="form-select">
							<option value="">Select One</option>
							<option value="Secondary Education" <?php if($fp[0]->qualification=='Secondary Education'){echo 'selected';} ?>>10<sup>th</sup> or Secondary Education</option>
							<option value="Higher Secondary Education" <?php if($fp[0]->qualification=='Higher Secondary Education'){echo 'selected';} ?>>12<sup>th</sup> or Higher Secondary Education</option>
							<option value="Graduation" <?php if($fp[0]->qualification=='Graduation'){echo 'selected';} ?>>Graduation</option>
							<option value="Masters" <?php if($fp[0]->qualification=='Masters'){echo 'selected';} ?>>Masters</option>
						</select>
					</div>
					<div class="form-group">
						<label>Name of Degree/Certification/Standard<span class="text-danger">*</span></label>
						<input type="text" name="hsboard" id="hsboard" class="form-control" value="<?= $fp[0]->board_uni; ?>" placeholder="BA/BSc/BCOM/BTECH/BE/MCA/MA/MCOM/MSc">
					</div>
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Passing Year<span class="text-danger">*</span></label>
								<input type="text" name="hsyear" id="hsyear" class="form-control" value="<?php //$fp[0]->pass_year; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Grade/Class/Percentage<span class="text-danger">*</span></label>
								<input type="text" name="hsgrade" id="hsgrade" class="form-control" value="<?php // $fp[0]->grade; ?>">
							</div>
						</div>
					</div> -->
				</div>

				<div class="tab">
					<h4 class="font-weight-bold heading text-center">KYC Details</h4>
					<div class="row">
						<div class="col-md-6 text-center">
							<div class="form-group">
								<img src="<?= base_url($fp[0]->adhaar_front); ?>" alt="" id="preview_fl_adhaar_front" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;">
								<input type="file" name="fl_adhaar_front" id="fl_adhaar_front" class="form-control" onchange="previewImage(this, 'fl_adhaar_front');">
								<label for="">Aadhar Front Image<br><span class="small">(less than 2MB | JPG|JPEG|PNG)</span> <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-md-6 text-center">
							<div class="form-group">
								<img src="<?= base_url($fp[0]->adhaar_back); ?>" alt="" id="preview_fl_adhaar_back" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;">
								<input type="file" name="fl_adhaar_back" id="fl_adhaar_back" class="form-control"onchange="previewImage(this, 'fl_adhaar_back');">
								<label for="">Aadhar Back Image<br><span class="small">(less than 2MB | JPG|JPEG|PNG)</span> <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
					<div class="form-group mb-2">
						<label>Aadhar Number <span class="text-danger">*</span></label>
						<input type="text" name="addhar_no" id="addhar_no" class="form-control" value="<?= $fp[0]->adhaar_no; ?>">
					</div>
					<div class="row">
						<div class="col-md-6 text-center">
							<div class="form-group">
								<img src="<?= base_url($fp[0]->pan_pic); ?>" alt="" id="preview_fl_pancard" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;">
								<input type="file" name="fl_pancard" id="fl_pancard" class="form-control" onchange="previewImage(this, 'fl_pancard');">
								<label for="">PAN Card Image<br><span class="small">(less than 2MB | JPG|JPEG|PNG)</span> <span class="text-danger">*</span></label>
								
							</div>
						</div>
						<div class="col-md-6 text-center">
							<div class="form-group">
								<img src="<?= base_url($fp[0]->photo_dp); ?>" alt="" id="preview_fl_profiledp" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;">
								<input type="file" name="fl_profiledp" id="fl_profiledp" class="form-control" onchange="previewImage(this, 'fl_profiledp');">
								<label for="">Profile Image<br><span class="small">(less than 2MB | JPG|JPEG|PNG)</span> <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
					<div class="form-group mb-2">
						<label>PAN Card Number <span class="text-danger">*</span></label>
						<input type="text" name="pan_no" id="pan_no" class="form-control" value="<?= $fp[0]->pan_no; ?>">
					</div>
					<hr>
					<div class="form-group">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" name="termCheck" id="termCheck">
							<label class="form-check-label" for="termCheck">I hereby agree to accept all the <a href="<?= base_url('terms-conditions'); ?>" target="_blank">Terms and Conditions</a> mentioned in this page.</label>
						</div>
					</div>
				</div>

				<div style="overflow:auto;" class="mt-2">
					<div style="display:flex; justify-content: space-between">
						<button type="button" id="prevBtn" class="btn btn-danger btn-sm previous" onclick="nextPrev(-1)">Previous</button>
						<button type="button" id="nextBtn" class="btn btn-primary btn-sm next" onclick="nextPrev(1)">Next</button>
						<button type="submit" class="btn btn-primary btn-sm submit" id="btn_apply">Preview</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script>

	getDistrict(<?= $fp[0]->pre_state; ?>, 'pre_', <?= $fp[0]->pre_district; ?>);
	$(document).ready(function(){
		$.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'File size must be less than {0} bytes');
		$.validator.addMethod("isRequired", function(value, element) {
			var id = $('#id').val(); 
			// console.log(id, value, ((id === '0' && value)? (value? true : false) : true))
			return (id === '0' && value)? (value? true : false) : true; 
		}, "Please select a file.");
        $.validator.addMethod('extension', function(value, element, param) {
            param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g';
            return this.optional(element) || (new RegExp('^(.+?)\.(png|jpe?g)$', 'i').test(value));
        }, 'Please select a file with a valid extension (png/jpg/jpeg)');
		$.validator.addMethod('isAdult', function(value, element, param) {
            var birthYear = parseInt(value.split('-')[0]);
			var currentDate = new Date();
    		var currentYear = currentDate.getFullYear();
            return ((currentYear - birthYear) > 18);
        }, 'Must be above 18+');

		$("#frmCareer").multiStepForm(
        {
            // defaultStep:0,
            beforeSubmit : function(form, submit){
                console.log("called before submiting the form");
                console.log(form);
                console.log(submit);
            },
            validations:{
				errorPlacement: function(error, element) {
					$(element).closest('.form-group').append(error);
				},
				rules: {
					'ddl_position': {
						required: true
					},
					'fullname': {
						required: true
					},
					'father_name': {
						required: true
					},
					'dob': {
						required: true,
						isAdult: true
					},
					'gender': {
						required: true
					},
					'nationality': {
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
					'pre_address': {
						required: true
					},
					'pre_district': {
						required: true
					},
					'pre_ddl_state': {
						required: true
					},
					'pre_pincode': {
						required: true,
						digits: true,
						minlength: 6,
						maxlength: 6,
					},
					'fl_adhaar_back': {
						isRequired: true,
						extension: 'png,jpg,jpeg',
						filesize: 2097152	
					},
					'fl_adhaar_front': {
						isRequired: true,
						extension: 'png,jpg,jpeg',
						filesize: 2097152	
					},
					'fl_pancard': {
						isRequired: true,
						extension: 'png,jpg,jpeg',
						filesize: 2097152	
					},
					'fl_profiledp': {
						isRequired: true,
						extension: 'png,jpg,jpeg',
						filesize: 2097152	
					},
					'addhar_no': {
						required: true,
						digits: true,
						maxlength: 12,
						minlength: 12
					},
					'pan_no': {
						required: true,
						maxlength: 10,
						minlength: 10
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
					'termCheck': {
						required: true
					}
				},
				messages: {
					'fl_adhaar_back': {
						required: 'Please select a file',
						extension: 'Please select a file with a valid extension (png/jpg/jpeg)',
						filesize: 'File size must be less than 2MB'	
					},
					'fl_adhaar_front': {
						required: 'Please select a file',
						extension: 'Please select a file with a valid extension (png/jpg/jpeg)',
						filesize: 'File size must be less than 2MB'	
					},
					'fl_pancard': {
						required: 'Please select a file',
						extension: 'Please select a file with a valid extension (png/jpg/jpeg)',
						filesize: 'File size must be less than 2MB'	
					},
					'fl_profiledp': {
						required: 'Please select a file',
						extension: 'Please select a file with a valid extension (png/jpg/jpeg)',
						filesize: 'File size must be less than 2MB'	
					},
				},
				submitHandler: (form, e) => {
					e.preventDefault();
					var frmData = new FormData($('#frmCareer')[0]);
					$.ajax({
						beforeSend: () => {
							$('#btn_apply').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
							$('#btn_apply').attr('disabled', 'disabled');
							$('#prevBtn').attr('disabled', 'disabled');
						},
						url: baseURL+'submitAdmissionApplication',
						type: 'POST',
						data: frmData,
						processData: false,
						contentType: false,
						dataType: 'json',
						success: (resp) => {
							// console.log("resp: ",resp);
							if(resp.status){
								window.open(baseURL+resp.webURL, '_self');
							}else{
								// $('#frmCareer')[0].reset();
								$('#btn_apply').html('Preview');
								$('#btn_apply').removeAttr('disabled');
								$('#prevBtn').removeAttr('disabled');
								Swal.fire(
									'Error',
									resp.msg,
									'error'
								)
							}
						},
						error: (err) => {
							$('#btn_apply').html('Preview');
							$('#btn_apply').removeAttr('disabled');
							$('#prevBtn').removeAttr('disabled');
						}
					});
				}
			},
        }
        ).navigateTo(0);

		jQuery.validator.addMethod("equalToStoredOTP", function(value, element) {
			let otp = $('#email_otp').val();
			// console.log(otp, atob(otp))
			return /^\d{6}$/.test(value) && (value === atob(otp)); // In this example, we check if the OTP has 6 digits.
		}, "Please enter a valid OTP.");
	});

	function previewImage(inputValue, previewImageId) {
        if (inputValue.files && inputValue.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#preview_' + previewImageId).attr('src', e.target.result).show();
			};

			reader.readAsDataURL(inputValue.files[0]);
		} else {
			$('#' + previewImageId).attr('src', '#').hide();
		}
    }

	function getDistrict(state_id, prefixid, district_id)
	{
		var disthtml = '<option value="">Select District</option>';
		if(!!state_id){
			$.ajax({
				beforeSend: ()=>{
					$(`#${prefixid}ddl_state`).attr('disabled', 'disabled');
					$(`#${prefixid}district`).attr('disabled', 'disabled');
				},
				url: baseURL+'home/get_districts_by_state',
				type: 'GET',
				data: {stateid: state_id},
				dataType: 'json',
				success: resp => {
					$(`#${prefixid}ddl_state`).removeAttr('disabled');
					$(`#${prefixid}district`).removeAttr('disabled');
					if(resp.status){
						resp.data.map(val=>{
							if(val.districtid == district_id){
								disthtml += `<option value="${val.districtid}" selected>${val.district_title}</option>`;
							}else{
								disthtml += `<option value="${val.districtid}">${val.district_title}</option>`;
							}
							
						});
						$(`#${prefixid}district`).html(disthtml);
					}
				},
				error: err =>{
					$(`#${prefixid}ddl_state`).removeAttr('disabled');
					$(`#${prefixid}district`).removeAttr('disabled');
					$(`#${prefixid}district`).html(disthtml);
				}
			});
			
		}else{
			$(`#${prefixid}district`).html(disthtml);
		}
	}

	function checkSameAddress(){
		if ($('input[name=same_as_above]').is(':checked')) {
			$('#per_address, #per_ddl_state, #per_district, #per_pincode').prop('disabled', true);
		} else {
			$('#per_address, #per_ddl_state, #per_district, #per_pincode').prop('disabled', false);
		}
	}

	(function ( $ ) {
		$.fn.multiStepForm = function(args) {
			if(args === null || typeof args !== 'object' || $.isArray(args))
				throw  " : Called with Invalid argument";
				var form = this;
				var tabs = form.find('.tab');
				var steps = form.find('.step');
				steps.each(function(i, e){
					$(e).on('click', function(ev){
					});
				});
				form.navigateTo = function (i) {/*index*/
				/*Mark the current section with the class 'current'*/
				tabs.removeClass('current').eq(i).addClass('current');
				// Show only the navigation buttons that make sense for the current section:
				form.find('.previous').toggle(i > 0);
				atTheEnd = i >= tabs.length - 1;
				form.find('.next').toggle(!atTheEnd);
				// console.log('atTheEnd='+atTheEnd);
				form.find('.submit').toggle(atTheEnd);
				fixStepIndicator(curIndex());
				return form;
			}
			function curIndex() {
				/*Return the current index by looking at which section has the class 'current'*/
				return tabs.index(tabs.filter('.current'));
			}
			function fixStepIndicator(n) {
				steps.each(function(i, e){
					i == n ? $(e).addClass('active') : $(e).removeClass('active');
				});
			}
			/* Previous button is easy, just go back */
			form.find('.previous').click(function() {
				form.navigateTo(curIndex() - 1);
			});

			/* Next button goes forward iff current block validates */
			form.find('.next').click(function() {
				if('validations' in args && typeof args.validations === 'object' && !$.isArray(args.validations)){
					if(!('noValidate' in args) || (typeof args.noValidate === 'boolean' && !args.noValidate)){
						form.validate(args.validations);
						if(form.valid() == true){
							form.navigateTo(curIndex() + 1);
							return true;
						}
						return false;
					}
				}
				form.navigateTo(curIndex() + 1);
			});
			form.find('.submit').on('click', function(e){
				if(typeof args.beforeSubmit !== 'undefined' && typeof args.beforeSubmit !== 'function')
					args.beforeSubmit(form, this);
					/*check if args.submit is set false if not then form.submit is not gonna run, if not set then will run by default*/        
				if(typeof args.submit === 'undefined' || (typeof args.submit === 'boolean' && args.submit)){
					// form.submit();
				}
				return form;
			});
			/*By default navigate to the tab 0, if it is being set using defaultStep property*/
			typeof args.defaultStep === 'number' ? form.navigateTo(args.defaultStep) : null;
			form.noValidate = function() {
		
			}
			return form;
		};
	}( jQuery ));
</script>