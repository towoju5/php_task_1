<?php
  defined('BASEPATH') || exit('No direct script access allowed');
  /*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2020*/
  if ($layout_clean_mode)
  {
    echo '<style>#content{padding:0px !important;}</style>';
  }
?>

<div class="tab-content mx-4 mt-3" id="nav-tabContent">
<!-- Bread Crumb -->
<div aria-label="breadcrumb">
    <ol class="breadcrumb pl-0 mb-1 bg-background d-flex justify-content-center justify-content-md-start">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/member/inventory/0" class="breadcrumb-link">Notes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Add
        </li>
    </ol>
</div>

<?php if (validation_errors()): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?=validation_errors()?>
            </div>
        </div>
    </div>
    <?php endif;?>
<?php if (strlen($error) > 0): ?>
        <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        </div>
        </div>
    <?php endif;?>
<?php if (strlen($success) > 0): ?>
        <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="success">
                <?php echo $success; ?>
            </div>
        </div>
        </div>
    <?php endif;?>

    <style>
.select2-container .select2-selection--single {
    height: 36px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 32px  !important;
}
</style>
<div class="row mb-5">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="primaryHeading2 mb-4 text-md-left pl-3">
                    Add Notes
                </h5>
                <?=form_open()?>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Title">Title <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_title" name="title" value="<?php echo set_value('title'); ?>"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <label for="form_school_id">School <b class="required_field"> * </b></label>
                    <select id="form_school_id" name="school_id" class=" select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($schools)):
                        foreach ($schools as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=set_select('school_id', $res1->id);?> ><?=$res1->name;?></option>
                        <?php 
                        endforeach;
                      endif;
                      ?>
                    </select>
                    <span style="font-size: 14px;">(If your school is not listed above, <a class="text-primary add_suggestion_link" href="">click here</a> to submit)</span>
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <label for="form_class_id">Course <b class="required_field"> * </b></label>
                    <select id="form_class_id" name="class_id" class=" select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($classes)):
                        foreach ($classes as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=set_select('class_id', $res1->id);?> ><?=$res1->name;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
                    <span style="font-size: 14px;">(If your Course is not listed above, <a class="text-primary add_suggestion_link" href="">click here</a> to submit)</span>
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <label for="form_professor_id">Professor <b class="required_field"> * </b></label>
                    <select id="form_professor_id" name="professor_id" class=" select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($professors)):
                        foreach ($professors as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=set_select('professor_id', $res1->id);?> ><?=$res1->name;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
                    <span style="font-size: 14px;">(If your professor is not listed above, <a class="text-primary add_suggestion_link" href="">click here</a> to submit)</span>
                  </div>

                  <div class="form-group col-md-5 col-sm-12">
                    <label for="form_textbook_id">Textbook <b class="required_field">  </b></label>
                    <select id="form_textbook_id" name="textbook_id" class="select2 form-control data-input" required>
                      <option>--Select--</option>
                      <?php
                      if (!empty($textbooks)):
                        foreach ($textbooks as $res1): ?>
                          <option value='<?=$res1->id;?>' <?=set_select('textbook_id', $res1->id);?> ><?=$res1->name;?></option>
                        <?php
                        endforeach;
                      endif;
                      ?>
                    </select>
                    <span style="font-size: 14px;">(If your textbook is not listed above, <a class="text-primary add_suggestion_link" href="">click here</a> to submit)</span>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Word Count">Word Count <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_word_count" name="word_count" value="<?php echo set_value('word_count'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Note Type">Type <b class="required_field"> * </b></label>
                    <select id="form_note_type" name="note_type" class="form-control data-input">
                      <?php foreach ($view_model->note_type_mapping() as $key => $value)
                      {
                        echo "<option value='{$key}'> {$value} </option>";
                      }?>
                    </select>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Year">Year <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_year" name="year" value="<?php echo set_value('year'); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 45)"/>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <label for="ISBN">Textbook ISBN (Optional)</label>
                    <input type="text" class="form-control data-input" id="form_isbn" name="isbn" value="<?php echo set_value('isbn'); ?>"/>
                  </div>

                  <!-- <div class="form-group col-md-5 col-sm-12 ">
                    <label for="Paypal Email">PayPal Email to pay out to you <b class="required_field"> * </b></label>
                    <input type="text" class="form-control data-input" id="form_paypal_email" name="paypal_email" value="<?php echo set_value('paypal_email'); ?>"/>
                  </div> -->

                  <div class="form-group col-md-5 col-sm-12 ">
                    <div class="mkd-upload-form-btn-wrapper">
                      <label for="File">Notes <b class="required_field"> * </b></label>
                      <button class="mkd-upload-btn btn btn-primary d-block">Upload a file</button>
                      <input type="file" name="file_upload" id="file_upload" onchange="onFileUploaded(event, 'file')" accept=".doc,.docx,.pdf,.txt,.xls,.xlsx,.xml"/>
                    <input type="hidden" id="file" name="file"/>
                    <input type="hidden" id="file_id" name="file_id"/>
                    <span id="file_text" class="mkd-upload-filename"></span>
                    </div>
                  </div>

                  <div class="form-group col-md-5 col-sm-12 ">
                    <div class="mkd-upload-form-btn-wrapper">
                      <label for="File">Preview <b class="required_field"> * </b></label>
                      <button class="mkd-upload-btn btn btn-primary d-block">Upload a file</button>
                      <input type="file" name="file_upload2" id="file_upload2" onchange="onFileUploadedCustom(event, 'feature_image')" accept=".doc,.docx,.pdf,.txt,.rtf,.xls,.xlsx,.xml"/>
                    <input type="hidden" id="feature_image" name="feature_image"/>
                    <input type="hidden" id="feature_image_id" name="feature_image_id"/>
                    <span id="file_text2" class="mkd-upload-filename"></span>
                    </div>
                  </div>

                  <!-- <div class="form-group col-md-5 col-sm-12">
                    <label for="Feature Image">Feature Image <b class="required_field"> * </b></label>
                    <img id="output_feature_image" style="max-height:100px" onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/>
                    <div class="btn uppload-button image_id_uppload_library btn-primary btn-sm  " data-image-url="feature_image" data-image-id="feature_image_id" data-image-preview="output_feature_image" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Choose Image</div>
                    <div class='btn btn-success' onclick='show_image_gallery("feature_image", "feature_image_id")'>Gallery</div>
                    <div class="btn btn-primary btn-sm  mkd-media-gallery" data-target="#mkd-media-gallery" data-toggle="modal" data-view-width="250" data-view-height="250" data-boundary-width="500" data-boundary-height="500">Media Gallery</div>
                    <input type="hidden" id="feature_image" name="feature_image" value=""/>
                    <input type="hidden" id="feature_image_id" name="feature_image_id" value=""/>
                    <span id="feature_image_complete" class="image_complete_uppload" ></span>
                  </div> -->

                  <div class="form-group  col-md-5 col-sm-12">
                      <input type="submit" class="btn btn-primary text-white mr-4 my-4" value="Submit">
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Add suggestion modal start -->
<div class="modal fade" id="add-suggestion-modal" tabindex="-1" role="dialog" aria-labelledby="cardAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="cardAddLabel">Submit Suggestion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>

      <form class="p-3 add_suggestion_form" autocomplete="off">

        <div class="form-row justify-content-between">
          <div class="col-12 my-3">
            <label for="name" class="required">Name</label>
            <input type="text" name="name" placeholder="Enter Name" class="form-control name" />
          </div>

          <div class="col-12 my-3">
            <label for="email" class="required">Email</label>
            <input type="email" name="email" placeholder="Enter Email" class="form-control email" />
          </div>

          <div class="col-12 my-3">
            <label for="phone" class="required">Suggestion Type</label>
            <select class="form-control suggestion_type" name="suggestion_type" id="suggestion_type">
              <option value="0">--Select--</option>
              <option value="1">School</option>
              <option value="2">Professor</option>
              <option value="3">Textbook</option>
              <option value="4">Class</option>
            </select>
          </div>

          <div class="col-12 my-3">
            <label for="suggestion_name" class="required">Suggestion Name</label>
            <input type="text" name="suggestion_name" placeholder="Enter Suggestion Name" class="form-control suggestion_name" />
          </div>

          <div class="col-12 my-3">
            <label for="additional_notes" class="required">Additional Notes</label>
            <input type="text" name="additional_notes" placeholder="Enter Additional Notes" class="form-control additional_notes" />
          </div>

          <div class="col-12 my-3">
            <button type="submit" class="btn btn-primary submit_suggestion_btn">Submit</button>
            <a class="btn btn-danger reset_suggestion_form" href="">Reset Form</a>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add suggestion modal end -->

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
  $(document).ready(function() {
    // on click add suggestion link
    $('.add_suggestion_link').click(function(e){
      e.preventDefault();
      $('#add-suggestion-modal').modal('toggle');
      return false;
    });

    // submit suggestion form
    $('.add_suggestion_form').submit(function (e) {
      e.preventDefault();
      $('.submit_suggestion_btn').prop('disabled', true);

      var name = $('.name').val();
      var email = $('.email').val();
      var suggestion_type = $('.suggestion_type').val();
      var suggestion_name = $('.suggestion_name').val();
      var additional_notes = $('.additional_notes').val();

      if (name == '' || name == 0) {
        toastr.error('Insert name');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      if (email == '' || email == 0) {
        toastr.error('Insert email');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }

      if (!validateEmail(email)) {
        toastr.error('Enter a valid email.');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      if (suggestion_type == '' || suggestion_type == 0) {
        toastr.error('Select suggestion type');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      if (suggestion_name == '' || suggestion_name == 0) {
        toastr.error('Insert suggestion name');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      $.ajax({
        type: 'POST',
        url: '/v1/api/member/suggestion/add',
        dataType: 'JSON',
        timeout: 5000,
        data: {
          name: name,
          email: email,
          suggestion_type: suggestion_type,
          suggestion_name: suggestion_name,
          additional_notes: additional_notes
        },
        success: function (response) {
          if (response.success) {
            $('#add-suggestion-modal').modal('toggle');
            toastr.options.timeOut = 1500;
            toastr.options.fadeOut = 1500;
            toastr.options.onHidden = function () {
              location.reload();
            };
            toastr.success(response.msg);
          }
          if (response.error) {
            $('#add-suggestion-modal').modal('toggle');
            toastr.options.timeOut = 1500;
            toastr.options.fadeOut = 1500;
            toastr.options.onHidden = function () {
              location.reload();
            };
            toastr.error(response.msg);
          }
        },
      });
      return false;
    });

    

    // reset suggestion form
    $('.reset_suggestion_form').click(function(e){
      e.preventDefault();
      $('.name').val('');
      $('.email').val('');
      $('.suggestion_type').val('0');
      $('.suggestion_name').val('');
      $('.additional_notes').val('');
      return false;
    });
  });
</script>