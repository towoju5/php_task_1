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
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/textbook/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Add
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
                    Add <?php echo $view_model->get_heading();?>
                </h5>
                <?= form_open() ?>

                    				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Name">Name <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_name" name="name" value="<?php echo set_value('name'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="ISBN">ISBN </label>
					<input type="text" class="form-control data-input" id="form_isbn" name="isbn" value="<?php echo set_value('isbn'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Status">Status <b class="required_field"> * </b></label>
					<select id="form_status" name="status" class="form-control data-input">
						<?php foreach ($view_model->status_mapping() as $key => $value) {
							echo "<option value='{$key}'> {$value} </option>";
						}?>
					</select>
				</div>

                    
                <div class="form-group  col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary text-white mr-4 my-4" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>