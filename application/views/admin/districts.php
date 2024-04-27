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
	    			<h4 class="card-title">District List</h4>
	    		</div>
	    		<div class="card-body">
	    			<div class="table-responsive">
                    	<table class="table table-striped" id="table-1" width="100%">
                    		<thead>
                    			<tr>
                    				<th width="5%">Sl#</th>
                    				<th width="70%">Districts</th>
                    				<th width="10%">Status</th>
                    				<th width="15%">Action</th>
                    			</tr>
                    		</thead>
                    		<tbody>
                    			<?php 
                    			if(!empty($districts)){
                    				$i=1;
                    				foreach($districts as $row){
                    					echo '<tr id="row_'.$row->districtid.'">';
                    					echo '<td>'.$i.'</td>';
                    					echo '<td>'.$row->district_title.'</td>';
                    					echo '<td>'.(($row->district_status=='Active')? '<div class="badge badge-success badge-shadow">Active</div>' : '<div class="badge badge-warning badge-shadow">Inactive</div>').'</td>';
                    					echo '<td><a href="javascript:toggleStatus('.$row->districtid.', `'.(($row->district_status=='Active')? 'Deactive' : 'Active').'`);" class="btn btn-warning btn-sm ml-2" id="btn_status_'.$row->districtid.'">Status</a></td>';
                    					echo '</tr>';

                    					$i++;
                    				}
                    			}
                    			?>
                    		</tbody>
                    	</table>
                    </div>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script>
	$('#table-1').dataTable();

	function toggleStatus(prim_id, status) {

		$.ajax({
			beforeSend: ()=>{
				$('#btn_status_'+prim_id).addClass('btn-progress');
				$('#btn_status_'+prim_id).attr('disabled', 'disabled');
			},
			url: baseURL+'masteradmin/changeDistrictStatus',
			type: 'post',
			data: { prim_id: prim_id, status: status },
			success: (resp)=>{
				
				if(resp){
					window.location.reload();
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