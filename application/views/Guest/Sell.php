<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" type="stylesheet">
<link href="/assets/css/vendor_full.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

<script src="/assets/js/core.js"></script>
<script src="/assets/js/image_gallery.js"></script>
<script src="/assets/js/vendor_full.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
    .modal_suggestion{
        color:blue !important;
    }
    #file_upload2{
      display: none;
    }

.select2-container .select2-selection--single {
    height: 36px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 32px  !important;
}
.error{
  color:red !important;
}
</style>
    <!-- sell_outline_text_start -->
    <div class="container-fluid sell_image_bg ">
        <div class="row" style="margin-top: -30px;">          
            <div class="col-12 col-md-12 col-sm-10">
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12">
                        <h1 class="text-center mt-0"><b> <?php echo  $this->_data['content']['sell_page_main_heading']->content ?? ''; ?></b></h1>
                        <h3 class="text-center mt-1"><b> <?php echo  $this->_data['content']['sell_page_sub_heading']->content ?? ''; ?></b></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- sell_outline_text_end -->

    <!-- upload_form_start -->
    <?php if($this->session->userdata('user_id')) {?>
    <div class="container-fluid ">
        <div class="col-12 col-md-12 col-sm-1"></div>
        <div class="col-12 col-md-12 col-sm-10"> 
                <!-- form_container_start -->
                <div class="row">
                    <div class="col-12 col-sm-2"></div>
                    <div class="col-12 col-sm-8  p-5">
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
                        <form autocomplete="off" class=" " method="post" action="v1/api/add_inventory" enctype="multipart/form-data" >
                           
                            
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <label for="schools">School <b class="required_field"> * </b></label>
                                    <select name="school_id" class="custom-select get_schools_select2 mb-3">
                                        <option value="0">Select School</option> 
                                    </select>
                                    <p class="pp">If your School is not listed above, click <a href="javascript:void();" class="modal_suggestion"><u>here</u></a> to submit
                                    </p>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- schools_ended -->

                            <!-- classes_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <label for="classes">Course <b class="required_field"> * </b></label>
                                    <select name="class_id" class="custom-select get_courses_select2 mb-3">
                                        <option value="0">Select Course</option>
                                         
                                    </select>
                       
                                    <p class="pp">If your Course is not listed above, click <a href="javascript:void();" class="modal_suggestion"><u>here</u></a> to submit
                                    </p>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- classes_ended -->


                            <!-- professor_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <label for="prof">Professor <b class="required_field"> * </b></label>
                                    <select name="professor_id" class="custom-select get_professors_select2 mb-3">
                                        <option value="0">Select Professor</option>
                                         
                                    </select>
                                    <p class="pp">If your Professor is not listed above, click <a href="javascript:void();" class="modal_suggestion"><u>here</u></a> to
                                        submit</p>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- professor_ended -->

                            <!-- textbook_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <label for="book">Textbook <b class="required_field">  </b></label>
                                    <input type="text" class="form-control  mb-3" name="textbook" valeu="" placeholder="Textbook" />
                                    
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- textbook_ended -->

                            <!-- word_count_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="wordcount">Word Count <b class="required_field"> * </b></label>
                                        <input type="number" name="word_count" class="form-control" placeholder="Enter word count"
                                            id="wordcount">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- word_count_ended -->


                            <!-- outline_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <label for="book">Type <b class="required_field"> * </b></label>

                                    <select name="note_type" class="custom-select mb-3">
                                        <option value="1" selected>Outline</option>
                                        <option value="2">Lecture Notes</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- outline_ended -->


                            <!-- word_count_started -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="auth">Year Authored / Course Taken <b class="required_field"> * </b></label>
                                        <input type="text" name="year" class="form-control" id="auth">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <!-- word_count_ended -->


                            <!-- text_book_ISBN_started -->
                            <!-- <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="isbn">ISBN # (optional)</label>
                                        <input type="text" class="form-control" name="isbn" placeholder="Enter book ISBN number"
                                            id="isbn">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div> -->
                            <!-- text_book_ISBN_ended -->


                            <!-- paypal_email_started -->
                            <?php if(empty($this->_data['paypal_email'])) { ?>
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">PayPal Email Address</label>
                                        <small>(PayPal processes payments to you from your sales at the end of each semester)</small>
                                        <input type="email" name="paypal_email" class="form-control" placeholder="Enter paypal email"
                                            id="email">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>

                            </div>
                            <?php } ?>
                            <!-- paypal_email_ended -->

                            <!-- upload_form_button_start -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12 ">
                                    <div class="">
                                        <label for="File">Outline <b class="required_field"> * </b></label>                                        
                                        <input  type="file" name="file_upload" id="file_upload"  accept=".doc,.docx"/>     
                                    </div>       
                                </div> 
                                <div class="col-12 col-sm-2"></div> 
                            </div>
                             
                            <!-- instructions_start -->
                            <div class="row" style="margin-top:10px;">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12">
                                    <h5>Final Instructions to Author:</h5>
                                    <div class="">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Make sure your name does not appear in the document
                                            </li>
                                            <li class="list-group-item">Make sure file is saved in following format:
                                                ProfessorLastName.Course.Year.doc</li>
                                        </ul>
                                    </div>
                                    <div class="checkbox mt-4">
                                        <label><input type="checkbox" name="remember1"> I agree to Terms and Conditions
                                            <a href="/terms_and_conditions"><u>here</u></a></label>
                                    </div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember2"> I agree to Privacy Policy <a
                                                href="/privacy_policy"><u>here</u></a></label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>
                            </div>

                            <!-- instructions_end -->

                            <!-- submit_button_start -->
                            <div class="row">
                                <div class="col-12 col-sm-2"></div>
                                <div class="col-12 col-sm-12 ">
                                    <div class="mt-4 text-center">
                                        <button type="submit" id="submit_form" class="btn btn-primary" >Submit</button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2"></div>
                            </div>

                            <!-- submit_button_end -->

                    </div>
                    <div class="col-12 col-sm-2"></div>
                </div>
                <!-- form_container_end -->
                </form>


          
        </div>
        <div class="col-12 col-md-12 col-sm-1"></div>
    </div>
    <?php }else{ ?>
        <center>You Need to <a style="color: #0D72BA !important; font-weight: 700; font-size: larger;"  href="member/login">Login</a> or <a style="color: #0D72BA !important; font-weight: 700; font-size: larger;"  href="member/register">Register</a> to Sell </center>
        <br>
        <br>
    <?php }?>

    <div class="modal fade" id="loadingModal" style="text-align: center;" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true">
    <div style="position: absolute; top:42%;left:33%;color:white;">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <h4>The upload will take up to 60 seconds...</h4>
      
    </div>
  </div>
    <!-- upload_form_end -->

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
              <option value="4">Course</option>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function()
{

//hammad
$('.mkd-upload-btn2').unbind();
$('.mkd-upload-btn2').on('click',function(e){
  e.preventDefault()
  $('#file_upload2').click();
})

function validateEmail(email) 
{
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
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
//   $('.select2').select2();
  $('.modal_suggestion').on('click',function(e){
    e.preventDefault();
      $('#add-suggestion-modal').modal('toggle');
      return false;
  })

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
        // toastr.error('Insert name');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
      }

      if (email == '' || email == 0) {
        toastr.error('Insert email');
        $('.submit_suggestion_btn').prop('disabled', false);
        return false;
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

    $('#submit_form').click(function(e){
        var valid = true;
        $('.error').remove();

        if($('select[name="school_id"] option:selected').val()==0)
        {
            $('select[name="school_id"]').parent().children('.pp').before('<span class="error">Select School</span>');
            valid = false
        }
        if($('select[name="class_id"] option:selected').val()==0){
            $('select[name="class_id"]').parent().children('.pp').before('<span class="error">Select Course</span>');
            valid = false
        }
        if($('select[name="professor_id"] option:selected').val()==0){
            $('select[name="professor_id"]').parent().children('.pp').before('<span class="error">Select Professor</span>');
            valid = false
        }
        if(!$('input[name="word_count"]').val()){
            $('input[name="word_count"]').after('<span class="error">Enter Word COunt</span>');
            valid = false
        }
        if(!$('input[name="year"]').val()){
            $('input[name="year"]').after('<span class="error">Enter Year Authored</span>');
            valid = false
        }
        if($('input[name="remember1"]').prop('checked')==false ||  $('input[name="remember2"]').prop('checked')==false){
            $('input[name="remember2"]').closest('.checkbox').append('<br><span class="error">Please Select Terms and condition and Privacy Policy</span>');
            valid = false
        }


        <?php if(empty($this->_data['paypal_email'])) { ?>
        if($('input[name="paypal_email"]').val()  != "" &&  !validateEmail($('input[name="paypal_email"]').val()) )
        {
            $('input[name="paypal_email"]').after('<span class="error">Enter valid paypal email</span>');
            valid = false
        }
        <?php } ?>

        
        if( document.getElementById("file_upload").files.length == 0 ){
            $('#file_upload').after('<br><span class="error">Please Upload a File</span>');
            valid = false
        }
        if(valid==true){
            $('#loadingModal').modal('toggle');
        }else{
            e.preventDefault();
        }
    });

    $('#file_upload').on('change',function(){
        var fileExtension = ['doc', 'docx'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $(this).val('');
            return false;
        } 
    })
}, false)
</script>
