<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<br/>
<br/>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body pb-3 pl-3 pr-3">

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
                
                <form method="get" action="<?php echo base_url();?>member/post_setting">

                <h5 class="primaryHeading2 mb-4 text-md-left pl-3 mt-1">
                   PayPal Email
                </h5>
                <div class="form-group col-md-5 col-sm-12">                
                   
                    <input type="email" class="form-control"  name="email" autocomplete="off" value="<?php echo $this->_data['paypal_email']['paypal_email'] ??'';?>"  />
                  </div>
                 
                  <div class="form-group col-md-5 col-sm-12">
                    <input class="btn btn-primary" type="submit" name="submit" value="Save" />                  
                  </div>
                </form>
            </div>
            </div>
            </div>
</div>