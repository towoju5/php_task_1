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
    <ol class="breadcrumb pl-0 mb-2 bg-background d-flex justify-content-center justify-content-md-start">
        <!-- <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/dashboard" class="breadcrumb-link">Dashboard</a>
        </li> -->
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/marketing/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
                <h5 class="primaryHeading2 mb-4 text-md-left">
                    Add <?php echo $view_model->get_heading();?>
                </h5>
                <?= form_open() ?>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12">
				    	<label for="Title">Title <b class="required_field"> * </b></label>
				    	<input type="text" id='form_title' name='title' class='form-control data-input generate_slug_marketing' value="<?php echo set_value('title'); ?>">
				    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12">
				    	<label for="SEO Title">SEO Title <b class="required_field"> * </b></label>
				    	<input type="text" id='form_seo_title' name='seo_title' class='form-control data-input generate_slug_marketing' value="<?php echo set_value('seo_title'); ?>">
				    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12">
				    	<label for="SEO Description">SEO Description <b class="required_field"> * </b></label>
				    	<input type="text" id='form_seo_description' name='seo_description' class='form-control data-input generate_slug_marketing' value="<?php echo set_value('seo_description'); ?>">
				    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12">
					    <label for="Path To URL">Url <b class="required_field"> * </b></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon3"><?php echo $view_model->marketing_slug_url(); ?></span>
                            </div>
                            <input type="text" class="form-control" name='slug' id="form_slug_marketing" aria-describedby="basic-addon3">
                            </div>
				    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12">
                        <label for="Content">Content <b class="required_field"> * </b></label>
                        <textarea id='content_sun-editor' name='content' class='form-control data-input sun-editor-component' row='20'></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12 col-sm-12 ">
				    	<label for="Page Password">Page Password <small>(if added, password required to see the page default username : <strong>guest</strong>)</small> </label>
				    	<input type="text" class="form-control data-input" id="form_password_protect" name="password_protect" value="<?php echo set_value('password_protect'); ?>"/>
				    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-5 col-sm-12">
				    	<label for="Header Template">Header Template </label>
                        <select id="form_header_template_path" name="header_template_path" class="form-control data-input">
                            <!-- <option value="">None</option> -->
						<?php foreach ($view_model->get_header_templates() as $key => $value) {
							echo "<option value='{$key}'> {$value} </option>";
						}?>
					    </select>
				    </div>
				    <div class="form-group col-md-5 col-sm-12">
				    	<label for="Template">Template </label>
                        <select id="form_content_template_path" name="content_template_path" class="form-control data-input">
                        <!-- <option value="">None</option> -->

						<?php
                            if(is_array($view_model->get_content_templates()) && !empty($view_model->get_content_templates()))
                            {
                                foreach($view_model->get_content_templates() as $key => $value)
                                { ?>
                                    <optgroup label="<?= $key?>">
						            <?php foreach($value as $k => $val){

						            	?>
						            	<option value="<?php echo $k ?>" ><?php echo $val ?></option>
						            <?php }?>

						            </optgroup>
                               <?php }
                            } ?>
                            </select>
                    </div>

				</div>
                <div class="form-row">


                    <div class="form-group col-md-5 col-sm-12">
                            <label for="Footer Template">Footer Template </label>
                            <select id="form_footer_template_path" name="footer_template_path" class="form-control data-input">
                            <!-- <option value="">None</option> -->
                            <?php foreach ($view_model->get_footer_templates() as $key => $value) {
                                echo "<option value='{$key}'> {$value} </option>";
                            }?>
                            </select>
                    </div>

                    <div class="form-group col-md-5 col-sm-12 ">
                        <label for="Status">Status </label>
                        <select id="form_status" name="status" class="form-control data-input">
                            <?php foreach ($view_model->status_mapping() as $key => $value) {
                                echo "<option value='{$key}'> {$value} </option>";
                            }?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group  col-md-5 col-sm-12">
                        <input type="submit" class="btn btn-primary text-white mr-4 my-4" value="Submit">
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>