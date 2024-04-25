<div class="row">
    <div class="col-12 col-md-12 col-lg-4 author-box">
        <div class="author-box-center">
            <img class="rounded-circle author-box-picture" src="<?= base_url($tjp[0]->photo_dp); ?>" alt="" onerror="this.src='<?= base_url('assets/images/user_noimage.png'); ?>'" alt="Generic placeholder image" style="width: 200px; height: 200px; max-width: 200px; max-height: 200px; object-fit: fit;">
            <div class="clearfix"></div>
            <div class="author-box-name">
                <a href="#"><?= $tjp[0]->candidate_name; ?></a>
            </div>
        </div>
        <div class="py-4">
            <p class="clearfix">
                <span class="float-left">
                Father
                </span>
                <span class="float-right text-muted">
                <?= $tjp[0]->father_name; ?>
                </span>
            </p>
            <p class="clearfix">
                <span class="float-left">
                Gender
                </span>
                <span class="float-right text-muted">
                <?= $tjp[0]->gender; ?>
                </span>
            </p>
            <p class="clearfix">
                <span class="float-left">
                Birthday
                </span>
                <span class="float-right text-muted">
                <?= date('d-m-Y',strtotime($tjp[0]->dob)); ?>
                </span>
            </p>
            <p class="clearfix">
                <span class="float-left">
                Phone
                </span>
                <span class="float-right text-muted">
                <?= $tjp[0]->mobile; ?>
                </span>
            </p>
            <p class="clearfix">
                <span class="float-left">
                Mail
                </span>
                <span class="float-right text-muted">
                <?= $tjp[0]->email; ?>
                </span>
            </p>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-8">
        <div class="section-title m-t-30">Selected Course</div>
        <p><?= $tjp[0]->course_name; ?></p>
        <div class="section-title m-t-30">Course Amount</div>
        <p><?= $tjp[0]->amount; ?></p>
        <div class="section-title m-t-30">Transaction</div>
        <p><?= $tjp[0]->payment_id; ?></p>
        <hr>
        <div class="section-title">Other Details</div>
        <p><strong>Nationality:</strong> <?= $tjp[0]->nationality; ?><span class="mx-3">|</span><strong>Religion:</strong> <?= $tjp[0]->religion; ?><span class="mx-3"></p>
        <p><strong>Present <?php //if($tjp[0]->same_as_pre){ echo '+ Permanent '; } ?>Address:</strong><br>
        <?= $tjp[0]->present_address.', '.$tjp[0]->pre_state_title.', '.$tjp[0]->pre_district_title.', '.$tjp[0]->pre_pin_code; ?>
        </p>
        <?php 
            // if(!$tjp[0]->same_as_pre){ 
            //     echo '<p><strong>Permanent Address:</strong><br>
            //     '.$tjp[0]->permanent_address.', '.$tjp[0]->per_state_title.', '.$tjp[0]->per_district_title.', '.$tjp[0]->per_pin_code.'</p>'; 
            // } 
        
        ?>
        <hr>
        <div class="section-title">Last Qualification</div>
        <p><?= $tjp[0]->qualification.'<br>'.$tjp[0]->board_uni.'<br>Grade: '.$tjp[0]->grade.' | Passing Year: '.$tjp[0]->pass_year; ?></p>
        <hr>
        <div class="section-title">KYC Details</div>
        <div class="py-4">
            <p class="clearfix">
                <span class="float-left">
                Aadhar Card
                </span>
                <span class="float-right text-muted">
                    <?= $tjp[0]->adhaar_no; ?><br>
                    <a href="<?= base_url($tjp[0]->adhaar_front); ?>" target="_blank">View Front</a>
                    <a href="<?= base_url($tjp[0]->adhaar_back); ?>" target="_blank">View Back</a>
                </span>
            </p>
            <p class="clearfix">
                <span class="float-left">Pan Card</span>
                <span class="float-right text-muted"><?= $tjp[0]->pan_no; ?><br>
                <a href="<?= base_url($tjp[0]->photo_dp); ?>" target="_blank">View PAN</a>
                </span>
            </p>
        </div>
        <hr>
    </div>
</div>