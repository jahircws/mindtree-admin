<style>
.error {
	color: red;
}
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<div class="wrapper">
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-8">
			<?php
				if($this->session->flashdata('success') != ""){
					echo '<div class="alert alert-success alert-dismissible">
						  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						  <strong>Success!</strong> '.$this->session->flashdata('success').'
						</div>';
				}
				if($this->session->flashdata('errors') != ""){
					echo '<div class="alert alert-danger alert-dismissible">
						  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
						  <strong>Success!</strong> '.$this->session->flashdata('errors').'
						</div>';
				}
			?>	
			</div>
		</div>
		<div class="row justify-content-center mt-5">
			<div class="col-lg-4 col-md-6 col-sm-6">
				 <div class="card shadow">
					<div class="card-title text-center border-bottom">
						<img src="<?= base_url('assets/images/mindtreeinc.png'); ?>" alt="ACEVT" style="width: 10rem"/>
					</div>
					<div class="card-body">
						<h4 class="card-title">For Career Application</h4>
						<form id="frmEnrollment">
						<div class="form-group mb-4">
							<label for="enroll_no" class="form-label">Identification Number</label>
							<input type="text" class="form-control" id="enroll_no" name="enroll_no" />
						</div>
						<div class="d-grid">
							<button type="submit" id="btn_submit" class="btn text-light btn-primary">Check</button>
						</div>
						</form>
					</div>
				 </div>
			</div>
		</div>
		<div class="row justify-content-center mt-5">
			<div class="col-md-8" id="mem_data">

			</div>
		</div>
	</div>
</div>
<script src="<?= base_url('assets/js/home.js'); ?>"></script>