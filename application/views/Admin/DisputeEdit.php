<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2020*/
if ($layout_clean_mode) {
    echo '<style>#content{padding:0px !important;}</style>';
}
?>
<div class="tab-content mx-4 mt-3" id="nav-tabContent">
              <!-- Bread Crumb -->
<div aria-label="breadcrumb">
    <ol class="breadcrumb pl-0 mb-1 bg-background d-flex justify-content-center justify-content-md-start">
        <!-- <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/dashboard" class="breadcrumb-link">Dashboard</a>
        </li> -->
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/dispute/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Edit
        </li>
    </ol>
</div>
<?php if (validation_errors()) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?= validation_errors() ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (strlen($error) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (strlen($success) > 0) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="success">
                <?php echo $success; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
<div class="row mb-5">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="primaryHeading2 mb-4 text-md-left pl-3">
                    Edit <?php echo $view_model->get_heading();?>
                </h5>
                <?= form_open() ?>
                    				<div class="form-group col-md-5 col-sm-12">
					<label for="Order ID">Order ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_order_id" name="order_id" value="<?php echo set_value('order_id', $this->_data['view_model']->get_order_id());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="User ID">User ID </label>
					<input type="text" class="form-control data-input" id="form_user_id" name="user_id" value="<?php echo set_value('user_id', $this->_data['view_model']->get_user_id());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Reason">Reason </label>
					<input type="text" class="form-control data-input" id="form_reason" name="reason" value="<?php echo set_value('reason', $this->_data['view_model']->get_reason());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Explanation">Explanation </label>
					<textarea id='form_explanation' name='explanation' class='data-input form-control' rows='5'><?php echo set_value('explanation', $this->_data['view_model']->get_explanation());?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Stripe Charge ID">Stripe Charge ID </label>
					<input type="text" class="form-control data-input" id="form_stripe_charge_id" name="stripe_charge_id" value="<?php echo set_value('stripe_charge_id', $this->_data['view_model']->get_stripe_charge_id());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Stripe Dispute ID">Stripe Dispute ID </label>
					<input type="text" class="form-control data-input" id="form_stripe_dispute_id" name="stripe_dispute_id" value="<?php echo set_value('stripe_dispute_id', $this->_data['view_model']->get_stripe_dispute_id());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Status">Status </label>
					<input type="text" class="form-control data-input" id="form_status" name="status" value="<?php echo set_value('status', $this->_data['view_model']->get_status());?>"/>
				</div>

                    
                <div class="form-group col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary ext-white mr-4 my-4" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>