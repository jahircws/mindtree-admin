<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?= base_url(); ?>admin-assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<script src="<?= base_url(); ?>admin-assets/bundles/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
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
                    <h4>Candidate List</h4>
                    <!-- <div class="card-header-action">
                        <a class="btn btn-primary" href="<?php // base_url('coordinatoradmin/tjp_surveys'); ?>"><i class="fa fa-plus"></i> Add</a>
                    </div> -->
                </div>
	    		<div class="card-body">
                <form class="mb-3" id="frmFilter">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">State</label>
                                <select class="form-control select2" data-select2-id="state_id" name="state_id" id="state_id">
                                    <?php
                                        if(isset($states)){
                                            echo '<option value="0">Select one</option>';
                                            foreach($states as $dc){
                                                echo "<option value='".$dc->state_id."'>".$dc->state_title."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">District</label>
                                <select class="form-control select2" data-select2-id="district_id" name="district_id" id="district_id">
                                    <option value="0">Select one</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control select2" data-select2-id="status" name="status" id="status">
                                        <option value="0">Select one</option>
                                        <option value="1">Preivewed</option>
                                        <option value="2">Expired</option>
                                        <option value="3">Enrolled</option>
                                        <option value="4">Completed</option>
                                        <option value="5">Failed</option>
                                        <option value="6">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="d-block">Date Range Picker</label>
                                <!-- <a href="javascript:;" class="btn btn-primary daterange-btn icon-left btn-icon"><i
                                    class="fas fa-calendar"></i> Choose Date
                                    <span></span>
                                </a> -->
                                <input type="text" name="date_range" id="date_range" class="form-control daterange-btn" placeholder="Choose Date" value=""/>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary btn-block" onclick="filterCandidateReport();"><i class="fas fa-search"></i> Filter</button>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <button type="reset" class="btn btn-warning btn-block" onclick="resetCandidateReport();"><i class="fas fa-search"></i> Reset</button>
                        </div>
                    </div>
                </form>
	    			<div class="table-responsive">
                    	<table class="table table-striped" id="candidate_report_table" width="100%">
                    		<thead>
                    			<tr>
                    				<th width="5%">Sl#</th>
                    				<th width="25%">Candidate</th>
                                    <th width="20%">Course</th>
                                    <th width="20%">Contact</th>
                                    <th width="15%">Applied on</th>
                                    <th width="15%">Status</th>
                    				<th width="15%">Action</th>
                    			</tr>
                    		</thead>
                    	</table>
                    </div>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Candidate Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body border">
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Update Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="frmStatus">
                    <input type="hidden" name="cand_id" id="cand_id" value="0"/>
                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control" name="ddl_status" id="ddl_status">
                                <option value="0">Select one</option>
                                <option value="1">Preivewed</option>
                                <option value="2">Expired</option>
                                <option value="3">Enrolled</option>
                                <option value="4">Completed</option>
                                <option value="5">Failed</option>
                                <option value="6">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>admin-assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script>
    var dataTable = $('#candidate_report_table').DataTable({
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"processing" :true,
		"serverSide" :true,
		"order" :[],
		"ajax" :{
			url:baseURL+'masteradmin/getCandidateReport',
			method:"POST",
            data: {
                district_id: function() {
                    return $("#district_id").val();
                },
                state_id: function() {
                    return $("#state_id").val();
                },
                status: function() {
                    return $("#status").val();
                },
                date_range: function() {
                    return $("#date_range").val();
                }
            }
		},
		"columnDefs":[
			{
				"targets" :[5],
				"orderable":false,
			}
		],
	});
    $('.daterange-btn').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        ranges: {
            'Today': [moment(), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        $('.daterange-btn').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    });
    $('.daterange-btn').on('cancel.daterangepicker', function(ev, picker) {
        //do something, like clearing an input
        $('.daterange-btn').val('');
    });

    function resetCandidateReport()
    {
        $('#district_id').val('0').trigger('change');
        $('#state_id').val('0').trigger('change');
        $('#status').val('0').trigger('change');
        $('#status').val('0').trigger('change');
        // $('#cand_id').val('0').trigger('change');
        $('.daterange-btn').val('');
    }

    function filterCandidateReport()
    {
        dataTable.ajax.reload();
    }

    $('#state_id').on('change', ev=>{
        let stateid = ev.target.value;
        var distHtml = '<option value="0">Select One</option>';
        if(stateid != 0){
            $.ajax({
                beforeSend: ()=>{
                    $('#state_id, #district').prop('disabled', true);
                },
                url: baseURL+'masteradmin/get_districts_by_state',
                type: 'GET',
                data: {stateid: stateid},
                dateType: 'json',
                success: resp => {
                    if(resp.status){
                        resp.data.map(val => {
                            distHtml += `<option value="${val.districtid}">${val.district_title}</option>`;
                        })
                    }
                    $('#state_id, #district').prop('disabled', false);
                    $('#district').html(distHtml);
                },
                error: err=>{
                    $('#state_id, #district').prop('disabled', false);
                    $('#district').html(distHtml);
                }
            });
        }else{
            $('#district').html(distHtml);
        }
    });

    function viewCandidateDetails(prim_id)
    {
        $.ajax({
            beforeSend: ()=>{
                $('#btn_view_'+prim_id).addClass('btn-progress');
                $('#btn_view_'+prim_id).attr('disabled', 'disabled');
            },
            url: `${baseURL}masteradmin/getCandidateData`,
            type: 'GET',
            data: {id: prim_id},
            success: resp => {
                $('#btn_view_'+prim_id).removeClass('btn-progress');
                $('#btn_view_'+prim_id).removeAttr('disabled');
                if ('error' in resp) {
                    // Handle error condition
                    alert(resp.error);
                } else {
                    // Set the HTML content in the modal
                    $('.bd-example-modal-lg .modal-body').html(resp.html_content);
                    $('.bd-example-modal-lg').modal('show');
                }
            },
            error: err => {
                Swal.fire('Error', 'Unable to find data', 'error');
                $('#btn_view_'+prim_id).removeClass('btn-progress');
                $('#btn_view_'+prim_id).removeAttr('disabled');
            }
        });
    }

    function openCandidateStatus(prim_id, status_id){
        $('#frmStatus #cand_id').val(prim_id);
        $('#frmStatus #ddl_status').val(status_id);
        $('#exampleModalCenter').modal('show');
    }

    $('#frmStatus').on('submit', ev => {
        ev.preventDefault();
        $.ajax({
            beforeSend: () => {
                $('#frmStatus button').attr('disabled', 'disabled');
            },
            url: baseURL+'masteradmin/updateCandidateStatus',
            type: 'POST',
            data: new FormData($('#frmStatus')[0]),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: resp => {
                if(resp){
                    Swal.fire('Success', 'Candidate Status updated', 'success');
                    dataTable.ajax.reload();
                } else {
                    Swal.fire('Error', 'Candidate Status update failed', 'error');
                }
                $('#frmStatus button').removeAttr('disabled');
                $('#exampleModalCenter').modal('hide');
            },
            error: err => {
                $('#frmStatus button').removeAttr('disabled');
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    });

	// function toggleStatus(prim_id, status) {

	// 	$.ajax({
	// 		beforeSend: ()=>{
	// 			$('#btn_status_'+prim_id).addClass('btn-progress');
	// 			$('#btn_status_'+prim_id).attr('disabled', 'disabled');
	// 		},
	// 		url: baseURL+'coordinatoradmin/changeSchoolStatus',
	// 		type: 'post',
	// 		data: { prim_id: prim_id, status: status },
	// 		success: (resp)=>{
				
	// 			if(resp){
	// 				dataTable.ajax.reload();
	// 			}else{
	// 				$('#btn_status_'+prim_id).removeClass('btn-progress');
	// 				$('#btn_status_'+prim_id).removeAttr('disabled');
	// 				Swal.fire(
	// 					'Error!',
	// 					'Status upddate failed.',
	// 					'error'
	// 				);
	// 			}
	// 		},
	// 		error: (err)=>{
	// 			$('#btn_status_'+prim_id).removeClass('btn-progress');
	// 			$('#btn_status_'+prim_id).removeAttr('disabled');
	// 			Swal.fire(
	// 				'Error!',
	// 				'Something went wrong',
	// 				'error'
	// 			);
	// 		}
	// 	});
	// }
</script>