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
                                     
                <div class="form-group col-md-5 col-sm-12">
                    <label for="School ID">School  <b class="required_field"> * </b></label>                    
                    <select id="form_school_id" name="school_id" class="get_schools_select2 form-control data-input" required>
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
                    
                    <select id="form_professor_id" name="professor_id" class="get_professors_select2 form-control data-input" required>
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
                    
                    <select id="form_class_id" name="class_id" class="get_courses_select2 form-control data-input" required>
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
                  
                </div>
                <div class="form-group col-md-5 col-sm-12">
                    <label for="Word Count">Word Count <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_word_count" name="word_count" value="<?php echo set_value('word_count', $this->_data['view_model']->get_word_count());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
                </div>
                <div class="form-group col-md-5 col-sm-12">
                    <label for="Year">Year <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_year" name="year" value="<?php echo set_value('year', $this->_data['view_model']->get_year());?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
                </div>
             
                <div class="form-group col-md-5 col-sm-12">
                    <label for="Note Type">Note Type <b class="required_field"> * </b></label>
                    <select id="form_note_type" name="note_type" class="form-control data-input">
                        <?php foreach ($view_model->note_type_mapping() as $key => $value) {
                            echo "<option value='{$key}' " . (($view_model->get_note_type() == $key && $view_model->get_note_type() != '') ? 'selected' : '') . "> {$value} </option>";
                        }?>
                    </select>
                </div>

                <div class="form-group col-md-5 col-sm-12 mb-4">
                    <label for="feature_image" style="display: block;">Preview Image 1 </label>
                    <span class="img-delete-close " <?php if (empty($this->_data['view_model']->get_feature_image())):  echo ' style="display: none;" '; endif; ?>  ><i class="fa fa-trash img-wrapper-delete-close"></i></span>

                    <img class='edit-preview-image d-block' style="max-width:150px;" id="output_feature_image" src="<?php echo set_value('feature_image', $this->_data['view_model']->get_feature_image());?>" onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/>
                    <br/><div class="btn btn-info btn-sm image_id_uppload_library uppload-button" data-image-url="feature_image" data-image-id="feature_image_id" data-image-preview="output_feature_image" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Choose Image</div>
                     
                    <input type="hidden"  class="check_change_event"   id="feature_image" name="feature_image" value="<?php echo set_value('feature_image', $this->_data['view_model']->get_feature_image());?>"/>
                    <input type="hidden" id="feature_image_id" name="feature_image_id" value="<?php echo set_value('feature_image_id', $this->_data['view_model']->get_feature_image_id());?>"/>

                    <span  class="feature_image_complete"  id="feature_image_complete" style="display: block;"></span>

                </div>


                <div class="form-group col-md-5 col-sm-12 mb-4">
                    <label for="feature_image2" style="display: block;">Preview Image 2 </label>

                    <span class="img-delete-close " <?php if (empty($this->_data['view_model']->get_feature_image2())):  echo ' style="display: none;" '; endif; ?>  ><i class="fa fa-trash img-wrapper-delete-close"></i></span>

                    <img class='edit-preview-image d-block' style="max-width:150px;" id="output_feature_image2" src="<?php echo set_value('feature_image2', $this->_data['view_model']->get_feature_image2());?>" onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/>
                    <br/><div class="btn btn-info btn-sm image_id_uppload_library uppload-button" data-image-url="feature_image2" data-image-id="feature_image2_id" data-image-preview="output_feature_image2" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Choose Image</div>
                    
                    <input type="hidden" class="check_change_event"  id="feature_image2" name="feature_image2" value="<?php echo set_value('feature_image2', $this->_data['view_model']->get_feature_image2());?>"/>
                    <input type="hidden" id="feature_image2_id" name="feature_image2_id" value="<?php echo set_value('feature_image2_id', $this->_data['view_model']->get_feature_image2_id());?>"/>

                    <span class="feature_image_complete" id="feature_image2_complete" style="display: block;"></span>

                </div>


                <div class="form-group col-md-5 col-sm-12 mb-4">
                    <label for="feature_image3" style="display: block;">Preview Image 3 </label>

                    <span class="img-delete-close " <?php if (empty($this->_data['view_model']->get_feature_image3())):  echo ' style="display: none;" '; endif; ?>  ><i class="fa fa-trash img-wrapper-delete-close"></i></span>

                    <img class='edit-preview-image d-block' style="max-width:150px;" id="output_feature_image3" src="<?php echo set_value('feature_image3', $this->_data['view_model']->get_feature_image3());?>" onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/>
                    <br/><div class="btn btn-info btn-sm image_id_uppload_library uppload-button" data-image-url="feature_image3" data-image-id="feature_image3_id" data-image-preview="output_feature_image3" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Choose Image</div>
                    
                    <input type="hidden"  class="check_change_event"   id="feature_image3" name="feature_image3" value="<?php echo set_value('feature_image3', $this->_data['view_model']->get_feature_image3());?>"/>
                    <input type="hidden" id="feature_image3_id" name="feature_image3_id" value="<?php echo set_value('feature_image3_id', $this->_data['view_model']->get_feature_image3_id());?>"/>

                    <span  class="feature_image_complete"  id="feature_image3_complete" style="display: block;"></span>

                </div>
                 
                    
                <div class="form-group col-md-5 col-sm-12">
                    <input type="submit" class="btn btn-primary ext-white mr-4 my-4" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
 

<script> 
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
        success: function (data) 
        {
            $("#feature_image").val(data.file);
            $("#feature_image_id").val(data.id);
            $("#file_text2").html(data.file);
        }
    });
}

</script>