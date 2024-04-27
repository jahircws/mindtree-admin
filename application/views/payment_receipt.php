<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pageTitle; ?></title>
	<link rel="shortcut icon" href="<?php echo site_url(); ?>assets/images/mindtreeinc.png" type="image/x-icon">
	<link rel="icon" href="<?php echo site_url(); ?>assets/images/mindtreeinc.png" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700;800&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?php echo site_url(); ?>assets/css/style.css">
	<script src="<?php echo site_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo site_url(); ?>assets/js/bootstrap.min.js"></script>
	<style>
		th, td {
			padding: 2px;
			text-align: left;
			border: 0;
		}

		th {
			background-color: #FFF;
			width: 30%; /* Adjust the width of the left column */
		}

		/* Responsive CSS */
		@media screen and (max-width: 600px) {
			th {
				width: 50%; /* Adjust the width of the left column for smaller screens */
			}
		}
		@media print {
	        .printMe {display: block;}
	        .noprint {display: none;}
	    }
	</style>
</head>
<body class="boxed-version">
	<noscript>Your browser does not support JavaScript</noscript>
	<section class="my-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card printMe" id="printable">
						<div class="card-header" style="background-color: #e53f71; height: 115px;">
							<img src="<?= base_url('assets/images/mindtreeinc.png'); ?>" alt="ACEVT" class="float-start" width="100wh"/>
						</div>
						<div class="card-header" style="background-color: #3f1651;">
						<h5 class="text-white justify-content-between d-flex"><strong>Mindtree Inc.</strong> <div><?= date('dS M Y h:ia', strtotime($udetails[0]->payment_dt)); ?></div></h5>
						</div>
						<div class="card-body">
							<table width="100%">
								<tr>
									<th class="text-center" colspan="2">Payment Receipt</th>
								</tr>
								<tr><td colspan="2" height="25px"></td></tr>
								<tr>
									<th>Reference. No:</th>
									<td><?= $udetails[0]->enroll_no; ?></td>
								</tr>
								<tr><td colspan="2" height="25px"></td></tr>
								<tr>
									<th>Student Name:</th>
									<td><?= $udetails[0]->name; ?></td>
								</tr>
								<tr>
									<th>Mobile:</th>
									<td><?= $udetails[0]->mobile; ?></td>
								</tr>
								<tr>
									<th>Email:</th>
									<td><?= $udetails[0]->email; ?></td>
								</tr>
								<tr><td colspan="2" height="25px"></td></tr>
								<tr>
									<th>Transaction Status:</th>
									<td><?= ($odetails->status == 'paid')? 'Success' : 'Failed'; ?></td>
								</tr>
								<tr>
									<th>Transaction ID:</th>
									<td><?= $udetails[0]->payment_id; ?></td>
								</tr>
								<tr>
									<th>Transaction Amount:</th>
									<td><?= '₹' . number_format(($odetails->amount_paid/100), 2, '.', ',').'/-'; ?></td>
								</tr>
								<tr><td colspan="2" height="25px"></td></tr>
								<tr>
									<th>Fees Type:</th>
									<td>Course Fee</td>
								</tr>
								<tr>
									<th>Course:</th>
									<td><?= $udetails[0]->course_name; ?></td>
								</tr>
								<tr>
									<th>Session:</th>
									<td><?= $udetails[0]->session; ?></td>
								</tr>
								<tr>
									<th>Payment Mode:</th>
									<td>Online</td>
								</tr>
								<tr><td colspan="2" height="25px"></td></tr>
							</table>
						</div>
						<div class="card-footer">
							<p style="color: #3f1651; font-weight: 600;">This is system generated payment receipt hence no signature required. Course/Training Fees is not entitled for refund under Terms of Services</p>
						</div>
					</div>
					<h6 class="mt-3 text-center noprint"><a href="javascript:printPageArea('printable');" class="btn btn-sm" style="background-color: #3f1651; color: #fff;">Print</a> <a href="https://mindtreeinc.com" class="btn btn-sm" style="background-color: #e53f71; color: #fff;">Back</a></h6>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		function printPageArea(areaID){

			var printContents = document.getElementById(areaID).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
		}
	</script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?php echo site_url(); ?>assets/js/countdown.js"></script>
	<script src="<?php echo site_url(); ?>assets/js/script.js"></script>
</body>
</html>