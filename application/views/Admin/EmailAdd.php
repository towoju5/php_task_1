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
            <a href="/admin/emails/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
					<label for="Slug">Slug <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_slug" name="slug" value="<?php echo set_value('slug'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Subject">Subject <b class="required_field"> * </b></label>
					<textarea id='form_subject' name='subject' class='form-control data-input' rows='5'><?php echo set_value('subject'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Body Header">Body Header <b class="required_field"> * </b></label>
					<textarea id='form_email_header' name='email_header' class='form-control data-input' rows='5'><?php echo set_value('email_header'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Body Footer">Body Footer <b class="required_field"> * </b></label>
					<textarea id='form_email_footer' name='email_footer' class='form-control data-input' rows='5'><?php echo set_value('email_footer'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Subject">Subject <b class="required_field"> * </b></label>
					<textarea id='form_subject' name='subject' class='form-control data-input' rows='5'><?php echo set_value('subject'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Tags">Tags <b class="required_field"> * </b></label>
					<textarea id='form_tag' name='tag' class='form-control data-input' rows='5'><?php echo set_value('tag'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Email Body">Email Body <b class="required_field"> * </b></label>
					<textarea id='form_html' name='html' class='form-control data-input' rows='5'><?php echo set_value('html'); ?></textarea>
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