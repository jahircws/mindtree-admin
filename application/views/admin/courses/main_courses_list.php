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
                    <h4>Main Course List</h4>
                    <div class="card-header-action">
                        <a class="btn btn-primary" href="<?= base_url('courseadmin/main_courses_add'); ?>"><i class="fa fa-plus"></i> Add</a>
                    </div>
                </div>
	    		<div class="card-body">
	    			<div class="table-responsive">
                    	<table class="table table-striped" id="state_coordinator_table" width="100%">
                    		<thead>
                    			<tr>
                    				<th width="5%">Sl#</th>
                    				<th width="15%">Image</th>
                                    <th width="30%">Title</th>
                                    <th width="25%">Price</th>
                                    <th width="15%">Status</th>
                    				<th width="10%">Action</th>
                    			</tr>
                    		</thead>
                    	</table>
                    </div>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
    var dataTable = $('#state_coordinator_table').DataTable({
		"processing" :true,
		"serverSide" :true,
		"order" :[],
		"ajax" :{
			url:baseURL+'courseadmin/getMainCourseList',
			method:"POST",
		},
		"columnDefs":[
			{
				"targets" :[5],
				"orderable":false,
			}
		],
	});

	function toggleStatus(prim_id, status) {

		$.ajax({
			beforeSend: ()=>{
				$('#btn_status_'+prim_id).addClass('btn-progress');
				$('#btn_status_'+prim_id).attr('disabled', 'disabled');
			},
			url: baseURL+'courseadmin/changeMainCourseStatus',
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

</script>