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
            <a href="/admin/emails/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
                    <?php echo $view_model->get_heading();?> Details
                </h5>
                
				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Slug
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_slug();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Subject
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_subject();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Tags
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_tag();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Body Header
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_email_header();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Email Body
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_html();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Body Footer
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_email_footer();?>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>
