<style>
.heading {
    background-color: #3f1651;
    padding: 10px;
    color: white;
    border-radius: 10px 10px 0px 0px;
}
label {
    font-weight: 700;
}
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<section class="container wizard-section">
	<div class="row no-gutters justify-content-center">
		<div class="col-lg-8 col-md-8">
            <h2 class="text-center">Admission Form Preview</h2>
            <div class="form-group mb-3" style="padding: 4px;">  
                <div class="row align-items-center">
                    <div class="col-md-6" style="background-color: #e53f71;">
                        <div class="form-group text-white">
                            <label for="" class="">Course:</label><br>
                            <?= $fp[0]->course_name; ?>
                        </div>
                    </div>
                    <div class="col-md-6" style="background-color: #e53f71;">
                        <div class="form-group text-white">
                            <label for="" class="">Session:</label><br>
                            <?= $fp[0]->session ?>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="font-weight-bold heading text-center">Personal Details</h4>
			<div class="form-group">
                <label>Candidate name<span class="text-danger">*</span></label>: <?= $fp[0]->candidate_name; ?>
            </div>
            <div class="form-group">
                <label>Guardian name<span class="text-danger">*</span></label>: <?= $fp[0]->father_name; ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gender<span class="text-danger">*</span></label>: <?= $fp[0]->gender; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>D.O.B<span class="text-danger">*</span></label>: <?= date('d/m/Y',strtotime($fp[0]->dob)); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nationality<span class="text-danger">*</span></label>: <?= $fp[0]->nationality; ?>
                    </div>
                </div>
            </div>
            <h4 class="font-weight-bold heading text-center">Communication Details</h4>
            <div class="form-group">
                <label>Email<span class="text-danger">*</span></label>: <?= $fp[0]->email; ?>
            </div>
            <div class="form-group">
                <label>Mobile <span class="text-danger">*</span></label>: <?= $fp[0]->mobile; ?>
            </div>
            
            <div class="form-group">
                <label>Alternet Contact No</label>: <?= $fp[0]->alt_mobile; ?>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Correspondence Address (P.S & P.O – Must be mentioned)<span class="text-danger">*</span></label>:<br><?= $fp[0]->present_address; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State<span class="text-danger">*</span></label>: <?= $fp[0]->pre_state_title; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>District<span class="text-danger">*</span></label>: <?= $fp[0]->pre_district_title; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>PIN Code<span class="text-danger">*</span></label>: <?= $fp[0]->pre_pin_code; ?>
                    </div>
                </div>
            </div>
            <h4 class="font-weight-bold heading text-center">Qualification Details</h4>
            <div class="form-group">
                <label>Last Qualification<span class="text-danger">*</span></label>: <?= $fp[0]->qualification; ?>
            </div>
            <div class="form-group">
                <label>Degree/Certification/Standard<span class="text-danger">*</span></label>: <?= $fp[0]->board_uni; ?>
            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Passing Year<span class="text-danger">*</span></label>: <?php // $fp[0]->pass_year; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Grade/Class/Percentage<span class="text-danger">*</span></label>: <?php // $fp[0]->grade; ?>
                    </div>
                </div>
            </div> -->

            <h4 class="font-weight-bold heading text-center">KYC Details</h4>
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <img src="<?= base_url($fp[0]->adhaar_front); ?>" alt="" id="preview_fl_adhaar_front" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;"><br>
                        <label for="">Aadhar Front Image</label>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <img src="<?= base_url($fp[0]->adhaar_back); ?>" alt="" id="preview_fl_adhaar_back" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;"><br>
                        <label for="">Aadhar Back Image</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <img src="<?= base_url($fp[0]->pan_pic); ?>" alt="" id="preview_fl_pancard" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;"><br>
                        <label for="">PAN Card Image</label>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <img src="<?= base_url($fp[0]->photo_dp); ?>" alt="" id="preview_fl_profiledp" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>' " style="max-width: 200px; max-height: 200px; width: 200px; height: 200px; object-fit: contain;"><br>
                        <label for="">Profile Image</label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label>Aadhar No.</label>: <?= $fp[0]->adhaar_no; ?><br>
                <label>PAN No.</label>: <?= $fp[0]->pan_no; ?>
            </div>
            
            <hr>
            <div class="card mb-4">
                <div class="card-body">
                    <a href="<?= base_url('?token='.$token.'&uid='.$fp[0]->id); ?>" class="btn btn-primary btn-block mb-3">Edit Form</a>
                    <form id="frmCareer" action="">
                        <input type="hidden" name="token" id="token" value="<?= $token; ?>">
                        <input type="hidden" name="amount" id="amount" value="<?= $amount; ?>">
                        <input type="hidden" name="id" id="id" value="<?= $fp[0]->id; ?>">
                        <input type="hidden" name="candidate_name" id="candidate_name" value="<?= $fp[0]->candidate_name; ?>">
                        <input type="hidden" name="email" id="email" value="<?= $fp[0]->email; ?>">
                        <input type="hidden" name="mobile" id="mobile" value="<?= $fp[0]->mobile; ?>">
                        <input type="hidden" name="discount" id="discount" value="0>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Coupon Code">
                            <div class="input-group-append">
                                <button type="button" id="btn_code" class="btn btn-info">Apply</button>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong>Amount: </strong>
                                    <?php 
                                        if($amount === $price){
                                            echo '₹' . number_format($amount, 2, '.', ',').'/-';
                                        }else{
                                            echo '<s>₹' . number_format($price, 2, '.', ',').'/-</s>  ₹' . number_format($amount, 2, '.', ',').'/-';
                                        }
                                    ?>
                                </div>
                                <div class="form-group" id="payable_amount"></div>
                                <button type="button" id="btn_submit" class="btn btn-success">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#btn_submit').on('click', (ev)=>{
            ev.preventDefault();
            $.ajax({
                beforeSend: ()=>{
                    $('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
                    $('#btn_submit').attr('disabled', 'disabled');
                },
                url: baseURL+'createAdmissionPaymentOrder',
                type: 'POST',
                data: new FormData($('#frmCareer')[0]),
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (resp) => {
                    console.log("resp: ",resp);
                    if(resp.status){
                        let amount = resp.amount;
                        let prim_id = resp.prim_id;
                        let options = resp.options;
                        $('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Payment Processing..");
                        options.modal = {
                            "ondismiss": function(){
                                $('#btn_submit').html('Pay Now');
                                $('#btn_submit').removeAttr('disabled');
                            }
                        };
                        options.handler = function (response){
                            response.amount = amount;
                            response.prim_id = prim_id;
                            $('#btn_submit').html("<span class='spinner-border spinner-border-sm'></span> Completing...");
                            $.post(baseURL+"candidatePayment", {response}, function(result){
                                //console.log(result);
                                var obj = JSON.parse(result);
                                if(obj['status']){
                                    Swal.fire({
                                        title: 'Successfull!',
                                        text: 'Admission and Payment Successfull.',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay',
                                    }).then((respond) => {
                                        window.location.href = baseURL+obj['webURI'];
                                    });
                                }else{
                                    Swal.fire(
                                        'Error',
                                        'Your payment failed.',
                                        'error'
                                    );
                                    $('#btn_submit').html('Pay Now');
                                    $('#btn_submit').removeAttr('disabled');
                                }
                            });
                        }
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (respond){
                            // console.log(respond.error);
                            Swal.fire(
                                'Error',
                                'Your payment failed. Try again.',
                                'error'
                            );
                            $('#btn_submit').html('Pay Now');
                            $('#btn_submit').removeAttr('disabled');
                        });
                        rzp1.open();
                        
                    }else{
                        // $('#frmCareer')[0].reset();
                        $('#btn_submit').html('Pay Now');
                        $('#btn_submit').removeAttr('disabled');
                        $('#prevBtn').removeAttr('disabled');
                        Swal.fire(
                            'Error',
                            resp.msg,
                            'error'
                        )
                    }
                },
                error: (err) => {
                    $('#btn_submit').html('Pay Now');
                    $('#btn_submit').removeAttr('disabled');
                    $('#prevBtn').removeAttr('disabled');
                }
            });
        });
    })
    
    $('#coupon_code').on('keypress', ()=>{
        $('#btn_code').html('Apply').removeAttr('disabled');
    })
    $('#btn_code').on('click', ()=>{
        $('#payable_amount').html("");
        let coupon_code = $('#coupon_code').val().trim();
        if(coupon_code){
            $.ajax({
                beforeSend: ()=>{
                    $('#btn_code, btn_submit').attr('disabled', 'disabled');
                },
                url: baseURL+'checkValidCoupon',
                type: 'GET',
                dataType: 'json',
                data: {ccode: coupon_code},
                success: resp=>{
                    if(resp.status){
                        let final_amt = 0;
                        let discount = resp.data[0].discount;
                        let amount = $('#amount').val();
                        if(discount != 0 && discount <=100){
                            final_amt = amount * (1 - (discount/100));
                            $('#payable_amount').html(`<strong>Final Amount:</strong> ${Number(final_amt).toLocaleString("en-IN", {style:"currency", currency:"IND"})}/-`);
                        }

                        $('#discount').val(discount);

                        $('#btn_code').html('Applied').attr('disabled', 'disabled');
                        
                    }else{
                        Swal.fire(
                            'Error',
                            resp.msg,
                            'error'
                        );
                        $('#payable_amount').html("");
                        $('#coupon_code').val("");
                    }
                    
                    $('#btn_code, btn_submit').removeAttr('disabled');
                },
                error: err=>{
                    $('#btn_code, btn_submit').removeAttr('disabled');
                    Swal.fire(
                        'Warning',
                        'Please enter valid coupon code',
                        'error'
                    );
                    $('#payable_amount').html("");
                    $('#coupon_code').val("");
                }
            });
        }else{
            Swal.fire(
                'Warning',
                'Please enter valid coupon code',
                'error'
            );
        }
    });

    
</script>
            