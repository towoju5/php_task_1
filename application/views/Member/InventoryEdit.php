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
            <a href="/member/dashboard" class="breadcrumb-link">Dashboard</a>
        </li> -->
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/member/inventory/0" class="breadcrumb-link">Notes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Edit
        </li>
    </ol>
</div>

<style>
.select2-container .select2-selection--single {
    height: 36px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 32px  !important;
}
</style>
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
                    Edit Notes
                </h5>
                <?= form_open() ?>
                    				<!-- <div class="form-group col-md-5 col-sm-12">
					<label for="Title">Title <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_title" name="title" value="<?php echo set_value('title', $this->_data['view_model']->get_title());?>"/>
				</div> -->
				<div class="form-group col-md-5 col-sm-12">
					<label for="School ID">School  <b class="required_field"> * </b></label>					
                    <select id="form_school_id" name="school_id" class="select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($schools)):
                        foreach ($schools as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=  $this->_data['view_model']->get_school_id()==$res1->id ? 'selected' :'';?> ><?=$res1->name;?></option>
                        <?php 
                        endforeach;
                      endif;
                      ?>
                    </select>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Professor ID">Professor <b class="required_field"> * </b></label>
					
                    <select id="form_professor_id" name="professor_id" class="select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($professors)):
                        foreach ($professors as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=  $this->_data['view_model']->get_professor_id()==$res1->id ? 'selected' : '' ; ?> ><?=$res1->name;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Class ID">Course  <b class="required_field"> * </b></label>
					
                    <select id="form_class_id" name="class_id" class="select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($classes)):
                        foreach ($classes as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=  $this->_data['view_model']->get_class_id()==$res1->id ? 'selected' :'';?> ><?=$res1->name;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Textbook ID">Textbook  <b class="required_field">  </b></label>
					<input type="text" name="isbn" class="form-control" value="<?php echo $this->_data['view_model']->get_isbn() ?? ''?>" />
                  <?php /*  <select id="form_textbook_id" name="textbook_id" class="select2  form-control data-input" >
                      <option>--Select--</option>
                      <?php
                      if (!empty($textbooks)):
                        foreach ($textbooks as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=  $this->_data['view_model']->get_textbook_id()==$res1->id ? 'selected' :'';?> ><?=$res1->isbn;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
                    */?>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Word Count">Word Count <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_word_count" name="word_count" value="<?php echo set_value('word_count', $this->_data['view_model']->get_word_count());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Year">Year <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_year" name="year" value="<?php echo set_value('year', $this->_data['view_model']->get_year());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
				</div>
				<!-- <div class="form-group col-md-5 col-sm-12">
					<label for="ISBN">ISBN </label>
					<input type="text" class="form-control data-input" id="form_isbn" name="isbn" value="<?php echo set_value('isbn', $this->_data['view_model']->get_isbn());?>"/>
				</div> -->
				<!-- <div class="form-group col-md-5 col-sm-12">
					<label for="Paypal Email">Paypal Email <b class="required_field"> * </b></label>
					<input type="text" class="form-control data-input" id="form_paypal_email" name="paypal_email" value="<?php echo set_value('paypal_email', $this->_data['view_model']->get_paypal_email());?>"/>
				</div> -->
				<div class="form-group col-md-5 col-sm-12">
				 <!-- <div class="mkd-upload-form-btn-wrapper"> -->
						<label for="File">File <b class="required_field"> * </b></label>
						<!--	<button class="mkd-upload-btn btn btn-primary d-block">Upload a file</button>
						<input type="file" name="file_upload" id="file_upload" onchange="onFileUploaded(event, 'file')" accept=".doc,.docx,.pdf,.txt,.rtf,.xls,.xlsx,.xml"/>
					<input type="hidden" id="file" name="file" value="<?php echo set_value('file', $this->_data['view_model']->get_file());?>"/>
					<input type="hidden" id="file_id" name="file_id" value="<?php echo set_value('file_id', $this->_data['view_model']->get_file_id());?>"/> -->
					<span id="file_text" class="mkd-upload-filename"><?php echo set_value('file', $this->_data['view_model']->get_file());?></span>
					<!-- </div> -->
				</div>

                <!-- <div class="form-group col-md-5 col-sm-12 ">
                    <div class="mkd-upload-form-btn-wrapper">
                      <label for="File">Preview <b class="required_field"> * </b></label>
                      <button class="mkd-upload-btn btn btn-primary d-block">Upload a file</button>
                      <input type="file" name="file_upload2" id="file_upload2" onchange="onFileUploadedCustom(event, 'feature_image')" accept=".doc,.docx,.pdf,.txt,.rtf,.xls,.xlsx,.xml"/>
                    <input type="hidden" id="feature_image" name="feature_image" value="<?php echo set_value('file', $this->_data['view_model']->get_feature_image());?>"/>
                    <input type="hidden" id="feature_image_id" name="feature_image_id" value="<?php echo set_value('feature_image_id', $this->_data['view_model']->get_feature_image_id());?>"/>
                    <span id="file_text2" class="mkd-upload-filename"><?php echo set_value('file', $this->_data['view_model']->get_feature_image());?></span>
                    </div>
                  </div>
				 -->
                 			<div class="form-group col-md-5 col-sm-12">
					<label for="Note Type">Note Type <b class="required_field"> * </b></label>
					<select id="form_note_type" name="note_type" class="form-control data-input">
						<?php foreach ($view_model->note_type_mapping() as $key => $value) {
							echo "<option value='{$key}' " . (($view_model->get_note_type() == $key && $view_model->get_note_type() != '') ? 'selected' : '') . "> {$value} </option>";
						}?>
					</select>
				</div>
				<!-- <div class="form-group col-md-5 col-sm-12">
					<label for="Description">Description </label>
					<textarea id='form_description' name='description' class='data-input form-control' rows='5'><?php echo set_value('description', $this->_data['view_model']->get_description());?></textarea>
				</div>
				<div class="form-group col-md-5 col-sm-12">
					<label for="Inventory Note">Additional Note </label>
					<textarea id='form_inventory_note' name='inventory_note' class='data-input form-control' rows='5'><?php echo set_value('inventory_note', $this->_data['view_model']->get_inventory_note());?></textarea>
				</div> -->

                    
                <div class="form-group col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary ext-white mr-4 my-4" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$('.select2').select2();
//hammad
function onFileUploadedCustom(event, id,name="file_upload") {
  var selectedFile = event.target.files[0];
  
  var formData = new FormData();
  formData.append("file", selectedFile, "file");
  jQuery.ajax({
    url: "/v1/api/file/upload",
    type: "post",
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    async: false,
    success: function (data) {
      $("#feature_image").val(data.file);
      $("#feature_image_id").val(data.id);
      $("#file_text2").html(data.file);
    }
  });
}

</script>