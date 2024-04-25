<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<style>
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color:  #618a3d;
   color:  white;
}
.error {
	color: red !important;
}
</style>
<div class="main-content">
	<div class="row">
	    <div class="col-12">
	    	<div class="card">
	    		<div class="card-header">
					<h4>Coupon List</h4>
					<div class="card-header-action">
						<a class="btn btn-primary" href="javascript:;" onclick="addEditCoupon('add', 0);"><i class="fa fa-plus"></i> Add</a>
					</div>
				</div>
	    		<div class="card-body">
	    			<div class="table-responsive">
                    	<table class="table table-striped" id="table-1" width="100%">
                    		<thead>
                    			<tr>
                    				<th width="5%">Sl#</th>
                    				<th width="40%">Coupon</th>
                                    <th width="10%">Disount(%)</th>
                                    <th width="20%">Expired on</th>
                    				<th width="10%">Status</th>
                    				<th width="15%">Action</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    		</tbody>
                    	</table>
                    </div>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add/Edit Coupon</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="frmCoupon">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Coupon *</label>
								<input type="text" name="code" id="code" value="" class="form-control">
								<input type="hidden" name="prim_id" id="prim_id" value="0">
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="text" name="discount" id="discount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expiration_date">Expire Date</label>
                                <input type="date" name="expiration_date" id="expiration_date" class="form-control">
                            </div>
                        </div>
                    </div>
					
					<div class="form-group">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" id="btn_apply" class="btn btn-primary btn-md">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script>
	var dataTable = $('#table-1').DataTable({
		"processing" :true,
		"serverSide" :true,
		"order" :[],
		"ajax" :{
			url:baseURL+'masteradmin/getCouponList',
			method:"POST",
		}
	});

	$('#frmCoupon').validate({
        errorPlacement: function(error, element) {
			$(element).closest('.form-group').append(error);
		},
        rules: {
            'code': {
                required: true
            },
            'discount': {
                required: true,
                digits: true,
                minlength: 0,
                maxlength: 100
            },
            'expiration_date': {
                required: true
            }
        },
        submitHandler: (form, e) => {
            e.preventDefault();
            var frmData = new FormData($('#frmCoupon')[0]);
            $.ajax({
                beforeSend: () => {
                    $('#btn_apply').html("<span class='spinner-border spinner-border-sm'></span> Saving..");
                    $('#btn_apply').attr('disabled', 'disabled');
                },
                url: baseURL+'masteradmin/cuCoupons',
                type: 'POST',
                data: frmData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: (resp) => {
                    // console.log(resp)
                    if(resp.status){
                        Swal.fire({
                            title: 'Success!',
                            html: resp.errors,
                            icon: 'success'
                        }).then(()=>{
                            dataTable.ajax.reload();
                        });
						$('#couponModal').modal('hide');
                    }else{
                        Swal.fire({
                            title: 'Error!',
                            html: resp.errors,
                            icon: 'error'
                        });
                    }
					$('#frmCoupon')[0].reset();
					$('#btn_apply').html('Save');
					$('#btn_apply').removeAttr('disabled');
                },
                error: (err) => {
                    $('#btn_apply').html('Save');
                    $('#btn_apply').removeAttr('disabled');
                }
            });
        }
    });

	function toggleStatus(prim_id, status) {

		$.ajax({
			beforeSend: ()=>{
				$('#btn_status_'+prim_id).addClass('btn-progress');
				$('#btn_status_'+prim_id).attr('disabled', 'disabled');
			},
			url: baseURL+'masteradmin/changeCouponStatus',
			type: 'post',
			data: { prim_id: prim_id, status: status },
			success: (resp)=>{
				
				if(resp){
					dataTable.ajax.reload();
				}else{
					$('#btn_status_'+prim_id).removeClass('btn-progress');
					$('#btn_status_'+prim_id).removeAttr('disabled');
					Swal.fire(
						'Error!',
						'Status upddate failed.',
						'error'
					);
				}
			},
			error: (err)=>{
				$('#btn_status_'+prim_id).removeClass('btn-progress');
				$('#btn_status_'+prim_id).removeAttr('disabled');
				Swal.fire(
					'Error!',
					'Something went wrong',
					'error'
				);
			}
		});
	}

	function addEditCoupon(action, id)
	{
		if(action === 'add'){
			// $('#frmCoupon')[0].reset();
			$('#frmCoupon #code').val("");
			$('#frmCoupon #prim_id').val(0);
            $('#frmCoupon #discount').val("");
            $('#frmCoupon #expiration_date').val("");
			$('#couponModal').modal('show');
		}else{
			$.ajax({
				beforeSend: ()=>{
					$('#btn_edit_'+id).addClass('btn-progress');
					$('#btn_edit_'+id).attr('disabled', 'disabled');
				},
				url: `${baseURL}masteradmin/getCouponData`,
				type: 'GET',
				data: {prim_id: id},
				dataType: 'json',
				success: (resp) => {
					console.log(typeof resp, resp)
					if(resp.status){
						$('#frmCoupon #code').val(resp.data.code);
                        $('#frmCoupon #prim_id').val(resp.data.id);
                        $('#frmCoupon #discount').val(resp.data.discount);
                        $('#frmCoupon #expiration_date').val(resp.data.expiration_date);
						$('#couponModal').modal('show');
					}else{
						Swal.fire(
							'Error!',
							'Unable to find data',
							'error'
						);
					}
					$('#btn_edit_'+id).removeClass('btn-progress');
					$('#btn_edit_'+id).removeAttr('disabled');
				},
				error: err => {
					$('#btn_edit_'+id).removeClass('btn-progress');
					$('#btn_edit_'+id).removeAttr('disabled');
					Swal.fire(
						'Error!',
						'Something went wrong',
						'error'
					);
				}
			});
		}
	}
</script>