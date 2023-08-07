
<!-- contact_image_start -->
<!-- <div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <img src="/assets/frontend/img/contact-us-4193523_640.jpg" width="100%" height="500">
        </div>
    </div>
</div> -->
<!-- contact_image_ends -->

    <!-- contact_form_start -->
    <div class="container-fluid bg-priamry jumbotron">
        <div class="row ">
            <div class="col-12 col-sm-2"></div>
            <div class="col-12 col-sm-8 border border-secondary p-4">
                <div class="row">
                    <h1 class="col-12 text-center text-dark">Contact Us</h1>
                </div>
               
                <div class="row">
                    <?php if(($this->_data['status_'] ?? '')=='success') { ?>
                        <div class="alert alert-success" role="alert">
                           <?php echo $this->_data['status_msg'];?>
                        </div>
                    <?php } ?>
                    <?php if(($this->_data['status_'] ?? '')=='error') { ?>
                        <div class="alert alert-danger" role="alert">
                             <?php echo $this->_data['status_msg'];?>
                        </div>
                    <?php } ?>
                    <div class="col-12">
                        <form method="post"   action="<?php echo base_url();?>v1/api/contact">
                            <div class="form-group">
                              <label for="email">Email address: *</label>
                              <input type="email" class="form-control" placeholder="Enter email" name="email" id="email">
                            </div>
                            <!-- <div class="form-group">
                              <label for="name">User name: </label>
                              <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                            </div> -->
                            <div class="form-group">
                                <label for="message">Message: *</label>
                                <textarea class="form-control" rows="5" name="message" placeholder="Enter Message" id="message"></textarea>
                              </div>
                            <input  type="submit" name="submit_btn" class="btn btn-primary" value="Submit" />
                          </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-2"></div>
        </div>

    </div>
    <!-- contact_form_ends -->