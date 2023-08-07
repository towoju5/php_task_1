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
            <a href="/admin/transaction/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
					<label for="Payment Method">Payment Method <b class="required_field"> * </b></label>
					<select id="form_payment_method" name="payment_method" class="form-control data-input">
						<?php foreach ($view_model->payment_method_mapping() as $key => $value) {
							echo "<option value='{$key}' " . (($view_model->get_payment_method() == $key && $view_model->get_payment_method() != '') ? 'selected' : '') . "> {$value} </option>";
						}?>
					</select>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Order ID">Order ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_order_id" name="order_id" value="<?php echo set_value('order_id', $this->_data['view_model']->get_order_id());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Transaction Date">Transaction Date </label>
					<input type="date" class="form-control data-input" id="form_transaction_date" name="transaction_date" value="<?php echo set_value('transaction_date', $this->_data['view_model']->get_transaction_date());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Transaction Time">Transaction Time <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_transaction_time" name="transaction_time" value="<?php echo set_value('transaction_time', $this->_data['view_model']->get_transaction_time());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="User ID">User ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_user_id" name="user_id" value="<?php echo set_value('user_id', $this->_data['view_model']->get_user_id());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Tax">Tax <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_tax" name="tax" value="<?php echo set_value('tax', $this->_data['view_model']->get_tax());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Discount">Discount <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_discount" name="discount" value="<?php echo set_value('discount', $this->_data['view_model']->get_discount());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Subtotal">Subtotal <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_subtotal" name="subtotal" value="<?php echo set_value('subtotal', $this->_data['view_model']->get_subtotal());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Total">Total <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_total" name="total" value="<?php echo set_value('total', $this->_data['view_model']->get_total());?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Status">Status <b class="required_field"> * </b></label>
					<select id="form_status" name="status" class="form-control data-input">
						<?php foreach ($view_model->status_mapping() as $key => $value) {
							echo "<option value='{$key}' " . (($view_model->get_status() == $key && $view_model->get_status() != '') ? 'selected' : '') . "> {$value} </option>";
						}?>
					</select>
				</div>

                    
                <div class="form-group col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary ext-white mr-4 my-4" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>