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
    height: 36px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 32px  !important;
}
</style>
<section>
    <?php /*
<div class="row filter-section">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card" id="inventory_filter_listing">
            <div class="card-body">
              <h5 class="primaryHeading2 text-md-left">
                    Uploaded Notes
              </h5>
                <?= form_open('/member/inventory/0', ['method' => 'get']) ?>
                    <div class="row">
                    						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="ID">ID </label>
								<input type="text" class="form-control" id="id" name="id" value="<?php echo $this->_data['view_model']->get_id();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Title">Title </label>
								<input type="text" class="form-control" id="title" name="title" value="<?php echo $this->_data['view_model']->get_title();?>"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="School ID">School </label>
								
                                <select id="form_school_id" name="school_id" class="form-control select2 data-input" required>
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
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Professor ID">Professor </label>
								<select id="form_professor_id" name="professor_id" class="form-control select2 data-input" required>
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
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Class ID">Course </label>
								<select id="form_class_id" name="class_id" class="form-control select2 data-input" required>
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
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Textbook ID">Textbook </label>
								
                                <select id="form_textbook_id" name="textbook_id" class="form-control select2 data-input" required>
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
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Word Count">Word Count </label>
								<input type="text" class="form-control" id="word_count" name="word_count" value="<?php echo $this->_data['view_model']->get_word_count();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Year">Year </label>
								<input type="text" class="form-control " id="year" name="year" value="<?php echo $this->_data['view_model']->get_year();?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label for="Status">Status </label>
								<select name="status" class="form-control select2">
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
*/?></section>

<h5 class="primaryHeading2 d-flex justify-content-between mt-2 my-4">
  Uploaded Notes
  <span class="add-part d-flex justify-content-md-end text-white "><a class="btn btn-primary btn-sm" target="__blank" href="/sell"><i class="fas fa-plus-circle"></i></a></span>
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
                        
                        	echo '<td style=\'max-width: 100px;\'>';
							 
							echo ' <a class="btn-link link-underline text-underline" target="__blank" href="/member/inventory/view/' . $data->id . '">View</a>';
							echo ' <a data-id="'.$data->id.'" class="btn-link link-underline text-underline text-danger remove_link" href="#">Remove</a>';
							echo '</td>';							echo "<td>{$data->id}</td>";
							// echo "<td>{$data->title}</td>";
							echo "<td>{$data->school_id}</td>";
							echo "<td>{$data->professor_id}</td>";
							echo "<td>{$data->class_id}</td>";
							echo "<td>{$data->isbn}</td>";
							// echo "<td><div class='mkd-image-container'><img class='img-fluid modal-image' src='$data->feature_image' onerror=\"if (this.src != '/uploads/placeholder.jpg') this.src = '/uploads/placeholder.jpg';\"/></div></td>";
							echo "<td>{$data->word_count}</td>";
							echo "<td>{$data->year}</td>";
							echo "<td>".($data->purchased_count  ?? 0)."</td>";
							echo "<td>".($data->refunded_count  ?? 0)."</td>";
							
							echo "<td>" . ucfirst($view_model->status_mapping()[$data->status]) ."</td>";

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
    $('.select2').select2();
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
          url: '/v1/api/member/inventory/delete',
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



