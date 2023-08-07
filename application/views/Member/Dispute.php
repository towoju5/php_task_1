<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">

<h5 class="primaryHeading2 d-flex justify-content-between mt-2 my-4 ml-3">
Dispute
  <span class=""></span>
</h5>


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
                
                <form method="get" action="<?php echo base_url();?>member/post_dispute">
                    <!-- <input type="hidden" name="order_id" value="<?php echo $this->uri->segment(3) ?? ($_GET['order_id']??'') ;?>" /> -->
                  
                   
                    <div class="form-group col-md-5 col-sm-12">
                    <h5 class="primaryHeading2  text-md-left  mt-1">
                    Reason For Dispute
                    </h5>
                        <textarea name="comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-5 col-sm-12">                       
                    <h5 class="primaryHeading2  text-md-left  mt-1">
                    Order #
                    </h5>
                    <select name="order_id" required class="form-control ">
                        <?php foreach ($this->_data['orders']  as $key => $value) {
                           echo '<option value="'.$value['id'].'" '.(($this->uri->segment(3) ?? ($_GET['order_id']??'')) == $value['id'] ? "selected" : "").' > Order #'.$value['id'].'</option>';
                           
                        }?>
                    </select>
                    </div>

                    
                    <div class="form-group col-md-5 col-sm-12">
                    <input class="btn btn-primary" type="submit" name="submit" value="Save" />
                     
                  </div>
                </form>
            </div>
            </div>
            </div>
</div>