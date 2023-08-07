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
            <a href="/admin/inventory/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
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
					<label for="Title">Title <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_title" name="title" value="<?php echo set_value('title'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="School ID">School ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_school_id" name="school_id" value="<?php echo set_value('school_id'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Professor ID">Professor ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_professor_id" name="professor_id" value="<?php echo set_value('professor_id'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Class ID">Class ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_class_id" name="class_id" value="<?php echo set_value('class_id'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Textbook ID">Textbook ID <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_textbook_id" name="textbook_id" value="<?php echo set_value('textbook_id'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Word Count">Word Count <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_word_count" name="word_count" value="<?php echo set_value('word_count'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Year">Year <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_year" name="year" value="<?php echo set_value('year'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="ISBN">ISBN </label>
					<input type="text" class="form-control data-input" id="form_isbn" name="isbn" value="<?php echo set_value('isbn'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Paypal Email">Paypal Email <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_paypal_email" name="paypal_email" value="<?php echo set_value('paypal_email'); ?>"/>
				</div>
				<div class="form-group col-md-5 col-sm-12 ">
					<div class="mkd-upload-form-btn-wrapper">
						<label for="File">File <b class="required_field"> * </b></label>
						<button class="mkd-upload-btn btn btn-primary d-block">Upload a file</button>
						<input type="file" name="file_upload" id="file_upload" onchange="onFileUploaded(event, 'file')" accept=".gif,.jpg,.jpeg,.png,.doc,.docx,.pdf,.md,.txt,.rtf,.xls,.xlsx,.xml,.json,.html,.mp3,.mp4,.csv,.bmp,.mpeg,.ppt,.pptx,.svg,.wav,.webm,.weba,.woff,.tiff"/>
					<input type="hidden" id="file" name="file"/>
					<input type="hidden" id="file_id" name="file_id"/>
					<span id="file_text" class="mkd-upload-filename"></span>
					</div>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Feature Image">Feature Image </label>
					<img id="output_feature_image" style="max-height:100px" onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/>
					<div class="btn uppload-button image_id_uppload_library btn-primary btn-sm  " data-image-url="feature_image" data-image-id="feature_image_id" data-image-preview="output_feature_image" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Choose Image</div>
					<div class='btn btn-success' onclick='show_image_gallery("feature_image", "feature_image_id")'>Gallery</div>					<div class="btn btn-primary btn-sm  mkd-media-gallery" data-target="#mkd-media-gallery" data-toggle="modal" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Media Gallery</div>
					<input type="hidden" id="feature_image" name="feature_image" value=""/>
					<input type="hidden" id="feature_image_id" name="feature_image_id" value=""/>
				 <span id="feature_image_complete" class="image_complete_uppload" ></span></div>				<div class="form-group col-md-5 col-sm-12 ">
					<label for="Note Type">Note Type <b class="required_field"> * </b></label>
					<select id="form_note_type" name="note_type" class="form-control data-input">
						<?php foreach ($view_model->note_type_mapping() as $key => $value) {
							echo "<option value='{$key}'> {$value} </option>";
						}?>
					</select>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Description">Description </label>
					<textarea id='form_description' name='description' class='form-control data-input' rows='5'><?php echo set_value('description'); ?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Inventory Note">Inventory Note </label>
					<textarea id='form_inventory_note' name='inventory_note' class='form-control data-input' rows='5'><?php echo set_value('inventory_note'); ?></textarea>
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