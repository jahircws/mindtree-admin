<style>
	.error{
		color: red !important;
	}
</style>
<div class="main-content">
	<section class="section">
		<div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Short Course form</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="<?= base_url('courseadmin/short_courses_list'); ?>"><i class="fa fa-list"></i> List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="frmShortCourse" action="<?= base_url('courseadmin/cuStateCoord'); ?>" method="POST">
                                <input type="hidden" name="sc_id" id="sc_id" value="<?= $fp[0]->id; ?>"/>
                                <div class="row justify-content-center">
									<div class="col-md-6 text-center">
                                    <img src="<?= base_url($fp[0]->cover_img); ?>" id="previewImage" alt="cover_img" class="img-responsive" width="200" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>'"/>
										<div class="form-group">
                                            <label for="cover_img">Cover Image (500 x 281) <span class="text-danger">*</span></label>
                                            <input type="file" name="fl_cover_img" id="fl_cover_img" class="form-control">
                                            <input type="hidden" name="cover_img" id="cover_img" value="<?= $fp[0]->cover_img; ?>">
										</div>
									</div>
								</div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Course Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control" value="<?= $fp[0]->title; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?= $fp[0]->price; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount">Discount(%)</label>
                                            <input type="text" name="discount" id="discount" class="form-control" value="<?= $fp[0]->discount; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="details">Details</label>
                                    <textarea name="details" id="details" class="form-control"><?= $fp[0]->details; ?></textarea>
                                </div>
								<div class="form-group">
									<button type="submit" id="btn_apply" class="btn btn-primary">Save</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('#fl_cover_img').change(function(){
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
    $('#frmShortCourse').validate({
        errorPlacement: function(error, element) {
			$(element).closest('.form-group').append(error);
		},
        rules: {
            'title': {
                required: true
            },
            'price': {
                required: true,
                number: true
            },
            'discount': {
                required: true,
                digits: true,
                minlength: 0,
                maxlength: 100,
            },
            'details': {
                required: false
            },
        },
        submitHandler: (form, e) => {
            e.preventDefault();
            var frmData = new FormData($('#frmShortCourse')[0]);
            $.ajax({
                beforeSend: () => {
                    $('#btn_apply').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
                    $('#btn_apply').attr('disabled', 'disabled');
                },
                url: baseURL+'courseadmin/cuShortCourse',
                type: 'POST',
                data: frmData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (resp) => {
                    console.log(resp)
                    if(resp.status){
                        Swal.fire({
                            title: 'Success!',
                            html: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            let upid = parseInt($('#sc_id').val());
                            // console.log(typeof(upid), upid)
                            if(upid != 0){
                                window.location.href= baseURL+'courseadmin/short_courses_list';
                            }else{
                                window.location.reload();
                            }
                            
                        });
                    }else{
                        $('#frmShortCourse')[0].reset();
                        $('#btn_apply').html('Save');
                        $('#btn_apply').removeAttr('disabled');
                        Swal.fire({
                            title: 'Error!',
                            html: resp.errors,
                            icon: 'error'
                        });
                    }
                },
                error: (err) => {
                    $('#btn_apply').html('Save');
                    $('#btn_apply').removeAttr('disabled');
                }
            });
        }
    });

</script>