<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2021*/
if ($layout_clean_mode) {
	echo '<style>#content{padding:0px !important;}</style>';
}
?>
<div class="tab-content mx-4 mt-3" id="nav-tabContent">
<!-- Bread Crumb -->
<div aria-label="breadcrumb">
    <ol class="breadcrumb pl-0 mb-1 bg-background d-flex justify-content-center justify-content-md-start" style="background-color: inherit;">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/member/inventory/0" class="breadcrumb-link">Notes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            View
        </li>
    </ol>
</div>
<div class="row mb-5">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card pb-5" style='border-bottom:1px solid #ccc;'>
            <div class="card-body">
                <h5 class="primaryHeading2 text-md-left">
                    Notes Details
                </h5>
                
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_id();?>
					</div>
				</div>

				<!-- <div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Title
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_title();?>
					</div>
				</div> -->

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						School 
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_school_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Professor 
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_professor_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Course 
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_class_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
					Textbook 
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_isbn();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Word Count
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_word_count();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Year
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_year();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						ISBN
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_isbn();?>
					</div>
				</div>

				<!-- <div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Paypal Email
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_paypal_email();?>
					</div>
				</div> -->

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						File
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_file();?>
					</div>
				</div>
				<!-- <div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Preview
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_feature_image();?>
					</div>
				</div> -->

				
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Note Type
					</div>
				<div class='col-lg-9 col-12'>
						<?php echo $view_model->note_type_mapping()[$view_model->get_note_type()];?>
					</div>
					</div>
				
				<!-- <div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Description
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_description();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Additional Note
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_inventory_note();?>
					</div>
				</div> -->
<!-- 
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Pin to top
					</div>
				<div class='col-lg-9 col-12'>
						<?php echo $view_model->pin_to_top_mapping()[$view_model->get_pin_to_top()];?>
					</div>
					</div> -->
				
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Approve
					</div>
				<div class='col-lg-9 col-12'>
						<?php echo $view_model->approve_mapping()[$view_model->get_approve()];?>
					</div>
					</div>
				
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Status
					</div>
				<div class='col-lg-9 col-12'>
						<?php echo $view_model->status_mapping()[$view_model->get_status()];?>
					</div>
					</div>
				
            </div>
        </div>
    </div>
</div>
