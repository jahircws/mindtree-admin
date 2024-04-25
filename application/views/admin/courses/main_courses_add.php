<link rel="stylesheet" href="<?=base_url(); ?>admin-assets/bundles/summernote/summernote-bs4.css">
<script src="<?=base_url(); ?>admin-assets/bundles/summernote/summernote-bs4.js"></script>
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
                            <h4>Main Course form</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="<?= base_url('courseadmin/main_courses_list'); ?>"><i class="fa fa-list"></i> List</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="frmMainCourse" action="<?= base_url('courseadmin/cuMainCourse'); ?>" method="POST">
                                <input type="hidden" name="sc_id" id="sc_id" value="<?= $fp[0]->id; ?>"/>
                                <div class="row justify-content-center">
									<div class="col-md-6 text-center">
                                    <img src="<?= base_url($fp[0]->cover_img); ?>" id="previewImage" alt="cover_img" class="img-responsive" width="200" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>'"/>
										<div class="form-group">
                                            <label for="cover_img">Cover Image (500 x 500) <span class="text-danger">*</span></label>
                                            <input type="file" name="fl_cover_img" id="fl_cover_img" class="form-control">
                                            <input type="hidden" name="cover_img" id="cover_img" value="<?= $fp[0]->cover_img; ?>">
										</div>
									</div>
								</div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Course Category <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="category_id" id="category_id">
                                                <option value="">Select one</option>
                                                <?php
                                                    foreach($categories as $dts){
                                                        echo ($dts->id === $fp[0]->category_id)? "<option value='".$dts->id."' selected>".$dts->title."</option>": "<option value='".$dts->id."'>".$dts->title."</option>";
                                                    }
                                                ?>
                                            </select>
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
                                    <textarea name="details" id="details" class="form-control summernote-simple"><?= $fp[0]->details; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="details">Eligibility</label>
                                    <div class="row">
                                    <?php
                                    $eligibility = json_decode($fp[0]->eligibility, true);

                                    // Check if eligibility exist
                                    if (!empty($eligibility)) {
                                        foreach ($eligibility as $key => $value) {
                                            echo '<div class="col-md-6 mb-2"><input type="text" name="eligibility[]" value="' . htmlspecialchars($value) . '" class="form-control"></div>';
                                        }
                                    } else {
                                        $input_count = 8;
                                        for ($i = 0; $i < $input_count; $i++) {
                                            echo '<div class="col-md-6 mb-2"><input type="text" name="eligibility[]" class="form-control"></div>';
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="details">Highlights</label>
                                    <div class="row">
                                    <?php
                                    $highlights = json_decode($fp[0]->highlights, true);

                                    // Check if highlights exist
                                    if (!empty($highlights)) {
                                        foreach ($highlights as $key => $value) {
                                            echo '<div class="col-md-4 mb-2"><input type="text" name="highlights[]" value="' . htmlspecialchars($value) . '" class="form-control"></div>';
                                        }
                                    } else {
                                        $input_count = 9;
                                        for ($i = 0; $i < $input_count; $i++) {
                                            echo '<div class="col-md-4 mb-2"><input type="text" name="highlights[]" class="form-control"></div>';
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="details">Course For Whom</label>
                                    <div class="row">
                                <?php
                                $for_whom = json_decode($fp[0]->for_whom, true);

                                // Check if highlights exist
                                if (!empty($for_whom)) {
                                    foreach ($for_whom as $key => $value) {
                                        echo '<div class="col-md-4 mb-2"><input type="text" name="for_whom[]" value="' . htmlspecialchars($value) . '" class="form-control"></div>';
                                    }
                                } else {
                                    $input_count = 6;
                                    for ($i = 0; $i < $input_count; $i++) {
                                        echo '<div class="col-md-4 mb-2"><input type="text" name="for_whom[]" class="form-control"></div>';
                                    }
                                }
                                ?>
                                    </div>
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
    $('#frmMainCourse').validate({
        errorPlacement: function(error, element) {
			$(element).closest('.form-group').append(error);
		},
        rules: {
            'category_id': {
                required: true
            },
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
            var frmData = new FormData($('#frmMainCourse')[0]);
            $.ajax({
                beforeSend: () => {
                    $('#btn_apply').html("<span class='spinner-border spinner-border-sm'></span> Loading..");
                    $('#btn_apply').attr('disabled', 'disabled');
                },
                url: baseURL+'courseadmin/cuMainCourse',
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
                                window.location.href= baseURL+'courseadmin/main_courses_list';
                            }else{
                                window.location.reload();
                            }
                            
                        });
                    }else{
                        $('#frmMainCourse')[0].reset();
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