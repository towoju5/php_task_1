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
            <a href="/admin/order/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
						Purchase User ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_purchase_user_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Sale User ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_sale_user_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Inventory ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_inventory_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Order Date
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_order_date();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Order Time
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_order_time();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Subtotal
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_subtotal();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Tax
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_tax();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Discount
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_discount();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Total
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_total();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						Stripe Charge ID
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_stripe_charge_id();?>
					</div>
				</div>

				<div class='row mb-4'>
					<div class='col-lg-3 col-12'>
						xyzstripe_intent
					</div>
					<div class='col-lg-9 col-12'>
						<?php echo $view_model->get_stripe_intent();?>
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
