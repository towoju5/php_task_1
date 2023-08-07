<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2020*/

?>
<div class="tab-content mx-4" id="nav-tabContent">
<br>
<div class="clear"></div>
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
<style>
.select2-container .select2-selection--single {
    height: 38px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 34px  !important;
}

</style>
<section>
<div class="row filter-section">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card" id="order_filter_listing">
            <div class="card-body">
              <h5 class="primaryHeading2 text-md-left">
                    <?php echo $view_model->get_heading();?> Search
              </h5>
                <?= form_open('/admin/order/0', ['method' => 'get']) ?>
                    <div class="row">
                    						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="ID">ID </label>
								<input type="text" class="form-control" id="id" name="id" value="<?php echo $this->_data['view_model']->get_id();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div>
						<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Purchase User ID">Purchase User ID </label>
								<input type="text" class="form-control" id="purchase_user_id" name="purchase_user_id" value="<?php echo $this->_data['view_model']->get_purchase_user_id();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Sale User ID">Sale User ID </label>
								<input type="text" class="form-control" id="sale_user_id" name="sale_user_id" value="<?php echo $this->_data['view_model']->get_sale_user_id();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div> -->
						<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Inventory ID">Inventory ID </label>
								<input type="text" class="form-control" id="inventory_id" name="inventory_id" value="<?php echo $this->_data['view_model']->get_inventory_id();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div> -->
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Professor ID">Users </label>
								<select id="form_professor_id" name="purchase_user_id" class="form-control select2 data-input" >
                                    <option value="">--Select--</option>
                                    <?php
                                    if (!empty( $this->_data['users'])):
                                        foreach ( $this->_data['users'] as $res1): ?>
                                        <option value='<?=$res1->id;?>' <?=  $this->_data['view_model']->get_purchase_user_id()==$res1->id ? 'selected' : '' ; ?> ><?=$res1->first_name;?></option>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Order Date">Order Date </label>
								<input type="date" class="form-control" id="order_date" name="order_date" value="<?php echo $this->_data['view_model']->get_order_date();?>"/>
							</div>
						</div>
						<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Order Time">Order Time </label>
								<input type="text" class="form-control" id="order_time" name="order_time" value="<?php echo $this->_data['view_model']->get_order_time();?>"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Subtotal">Subtotal </label>
								<input type="text" class="form-control" id="subtotal" name="subtotal" value="<?php echo $this->_data['view_model']->get_subtotal();?>"/>
							</div>
						</div> -->
						<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Tax">Tax </label>
								<input type="text" class="form-control" id="tax" name="tax" value="<?php echo $this->_data['view_model']->get_tax();?>"/>
							</div>
						</div> -->
						<!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Discount">Discount </label>
								<input type="text" class="form-control" id="discount" name="discount" value="<?php echo $this->_data['view_model']->get_discount();?>"/>
							</div>
						</div> -->
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Total">Amount </label>
								<input type="text" class="form-control" id="total" name="total" value="<?php echo $this->_data['view_model']->get_total();?>"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Status">Status </label>
								<select name="status" class="form-control">
									<option value="">All</option>
									<?php foreach ($view_model->status_mapping() as $key => $value) {
										echo "<option value='{$key}' " . (($view_model->get_status() == $key && $view_model->get_status() != '') ? 'selected' : '') . "> {$value} </option>";
									}?>
								</select>
							</div>
						</div>

                    <input type="hidden" name="order_by" value="<?php echo $view_model->get_order_by();?>"/>
                    <input type="hidden" name="direction" value="<?php echo $view_model->get_sort();?>"/>
                    <div style="width:100%;height:10px;display:block;float:none;"></div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="hidden" id="form_per_page" value="<?php echo $this->_data['view_model']->get_per_page() ?>" name="per_page_sort">
                                <input type="submit" name="submit" class="btn btn-primary" value="Search">
                                <a class="btn btn-danger" name="submit" type="button" href="<?php echo $view_model->get_sort_base_url().'?order_by=id&direction=DESC&per_page_sort='.$this->_data['view_model']->get_per_page(); ?>">Clear Search</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<h5 class="primaryHeading2 d-flex justify-content-between mt-2 my-4">
  <?php echo $view_model->get_heading();?>
  <span class=""></span>
</h5>

  <section class="table-placeholder bg-white mb-5 p-3 pl-4 pr-4 pt-4" style="height:auto;">
    <div class="table-responsive">
    <div class="row">
        
        <div class="col p-2">
            <div class="float-right mr-1"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    

    <input type="hidden" id="per_page" value="<?php echo $this->_data['view_model']->get_per_page(); ?>" >
        <div class="row">
            <div class="col-sm-12 col-md-6">

                <div class="dataTables_length" id="config-table_length">
                    <small class="d-flex align-items-baseline">Show
                        <select data-sorturl="<?php echo $view_model->get_sort_base_url(); ?>" id="change_per_page" name="config-table_length" aria-controls="config-table" class="form-control form-control-sm mx-2" style="width: auto;margin-bottom: 10px;">
                        <?php if(isset($_GET['per_page_sort'])) { ?>
                            <option value="10" <?php echo ($_GET['per_page_sort'] == '5' && $_GET['per_page_sort']) ? 'selected' : '';?>>5</option>
                            <option value="10" <?php echo ($_GET['per_page_sort'] == '10' && $_GET['per_page_sort']) ? 'selected' : '';?>>10</option>
                            <option value="25" <?php echo ($_GET['per_page_sort'] == '25' && $_GET['per_page_sort']) ? 'selected' : '';?>>25</option>
                            <option value="50" <?php echo ($_GET['per_page_sort'] == '50' && $_GET['per_page_sort']) ? 'selected' : '';?>>50</option>
                            <option value="100" <?php echo ($_GET['per_page_sort'] == '100' && $_GET['per_page_sort']) ? 'selected' : '';?>>100</option>
                        <?php } else { ?>
                            <option value="10" <?php echo ($this->_data['view_model']->get_per_page() == '10' && $this->_data['view_model']->get_per_page()) ? 'selected' : '';?>>10</option>
                            <option value="25" <?php echo ($this->_data['view_model']->get_per_page() == '25' && $this->_data['view_model']->get_per_page()) ? 'selected' : '';?>>25</option>
                            <option value="50" <?php echo ($this->_data['view_model']->get_per_page() == '50' && $this->_data['view_model']->get_per_page()) ? 'selected' : '';?>>50</option>
                            <option value="100" <?php echo ($this->_data['view_model']->get_per_page() == '100' && $this->_data['view_model']->get_per_page()) ? 'selected' : '';?>>100</option>
                        <?php } ?>

                        </select>
                    entries</small>
                </div>
            </div>
        </div>

    <table class="display nowrap table table-hover table-striped table-bordered w-100 table-compact mb-0 mkd-table-container">
        <thead class=''>
        
        <?php
        $order_by = $view_model->get_order_by();
        $direction = $view_model->get_sort();
        $model_base_url = $view_model->get_sort_base_url();
        $field_column = $view_model->get_field_column();
        $clean_mode = $view_model->get_format_layout();
        $query_string = $view_model->get_query_parameter();
        $per_page = $this->_data['view_model']->get_per_page();
        $format_mode = '';
        if ($clean_mode) {
            $format_mode = '&layout_clean_mode=1';
        }
        foreach ($view_model->get_column() as $key => $data) {
            $data_field = $field_column[$key];
            if (strlen($order_by) < 1 || $data_field == '')
            {
                echo "<th scope='col' class='paragraphText text-center'>{$data}</th>";
            }
            else
            {
                if ($order_by === $data_field)
                {
                    if ($direction == 'ASC')
                    {
                        echo "<th scope='col' class='paragraphText text-center theme-sort sort-asc'><a href='{$model_base_url}?order_by={$data_field}{$format_mode}&direction=DESC{$query_string}'>{$data}</a></th>";
                    }
                    else
                    {
                        echo "<th scope='col' class='paragraphText text-center theme-sort sort-desc'><a href='{$model_base_url}?order_by={$data_field}{$format_mode}&direction=ASC{$query_string}'>{$data}</a></th>";
                    }
                }
                else
                {
                    echo "<th  scope='col' class='paragraphText text-center theme-sort'><a href='{$model_base_url}?order_by={$data_field}{$format_mode}&direction=ASC{$query_string}'>{$data}</a></th>";
                }
            }
        } ?>
        </thead>
        <tbody class="tbody-light">
            <?php $i=1; foreach ($view_model->get_list() as $data) { ?>
                <?php
                    echo '<tr>';
                        
                        						
                            echo "<td>{$data->id}</td>";
							echo "<td>{$data->purchase_user_id}</td>";
							echo "<td>{$data->school_id}</td>";
							echo "<td>{$data->isbn}</td>";
							echo "<td>{$data->professor_id}</td>";
							echo "<td>" . date('F d Y', strtotime($data->order_date)) . "</td>";						
							echo "<td>{$data->total} $</td>";
							echo "<td>" . ucfirst($view_model->status_mapping()[$data->status]) ."</td>";
                            echo '<td style=\'max-width: 100px;\'>';
							// echo ' <a class="btn-link link-underline text-underline" target="__blank" href="/admin/order/view/' . $data->id . '">View</a>';
							echo $data->status==1 ? ' <a class="btn-link link-underline text-underline" target="__blank" href="/admin/order/refund/' . $data->id . '">Refund</a>' : '' ;
							echo '</td>';	

                    echo '</tr>';
                ?>
            <?php $i++; } ?>
        </tbody>
    </table>

    <small><?php echo $view_model->get_total_rows();?> results found</small>
    <span class="pagination_custom">
        <?php echo $view_model->get_links(); ?>
    </span>
    </div>
  </section>


</div>

<?php
if ($layout_clean_mode) {
    echo '<style>#content{padding:0px !important;}</style>';
    echo '<style>.filter-section {display: none !important;}</style>';
    echo '<style>#tab-content{padding:0px !important; margin:0px !important;}</style>';
}
?>



<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $view_model->get_heading();?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-white close_btn" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger delete_confirm_btn">Confirm</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script>
$(document).ready(function() {
  $(".remove_link").click(function(e) {
    // console.log('remove btn clicked');

    e.preventDefault();
    $('#deleteModal').modal('show');
    var id = e.currentTarget.getAttribute('data-id');

    if (id != 0 || id != '') {
      $(".delete_confirm_btn").click(function(e) {
        e.preventDefault();
        $('.delete_confirm_btn').prop('disabled',true);
        $('.close_btn').prop('disabled',true);
        // toastr.info(id);
        // return false;
        $.ajax({
          url: '/v1/api/admin/order/delete',
          type: "POST",
          data: { id: id },
          dataType: 'JSON',
          success: function (response) {
            if (response.success) {
              toastr.options.timeOut = 1500;
              toastr.options.fadeOut = 1500;
              toastr.options.onHidden = function() {
                location.reload();
              }
              toastr.success(response.msg);
            }
            if (response.error) {
              toastr.options.timeOut = 1500;
              toastr.options.fadeOut = 1500;
              toastr.options.onHidden = function() {
                location.reload();
              }
              toastr.error(response.msg);
            }
          },
        });
        return false;
      });
    } else {
      toastr.error('Data not found.');
      return false;
    }
  });
});
</script>



