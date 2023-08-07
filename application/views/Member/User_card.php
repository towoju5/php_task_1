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

<section>
<div class="row filter-section">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card" id="user_card_filter_listing">
            <div class="card-body">
              <h5 class="primaryHeading2 text-md-left">
                    <?php echo $view_model->get_heading();?> Search
              </h5>
                <?= form_open('/member/user_card/0', ['method' => 'get']) ?>

                  <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="form-group">
                        <label for="Last4">Last4 </label>
                        <input type="text" class="form-control" id="last4" name="last4" value="<?php echo $this->_data['view_model']->get_last4();?>"/>
                      </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                      <div class="form-group">
                        <label for="Is Default">Is Default </label>
                        <select name="is_default" class="form-control">
                          <option value="">All</option>
                          <?php foreach ($view_model->is_default_mapping() as $key => $value) {
                            echo "<option value='{$key}' " . (($view_model->get_is_default() == $key && $view_model->get_is_default() != '') ? 'selected' : '') . "> {$value} </option>";
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
  <span class="add-part d-flex justify-content-md-end text-white "><a class="btn btn-primary btn-sm" target="_blank" href="/member/user_card/add"><i class="fas fa-plus-circle"></i></a></span>
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
            <?php $i=1; foreach ($view_model->get_list() as $data) {
                $set_default = '';
                if ($data->is_default == 0)
                {
                  $set_default = '<a data-id="' . $data->id . '" class="btn-link link-underline text-underline set_default_btn" target="_blank" href="/member/user_card/edit/' . $data->id . '">Set Default</a>';
                }
                ?>
                <?php
                    echo '<tr>';
                    echo '<td>';
                    echo $set_default;
                    echo '<a data-id="' . $data->id . '" class="btn-link link-underline text-underline text-danger remove_btn" target="_blank" href="/member/user_card/delete/' . $data->id . '">Remove</a>';
                    echo '</td>';
                    echo "<td>{$data->id}</td>";
                    echo "<td>" . ucfirst($view_model->is_default_mapping()[$data->is_default]) ."</td>";
                    echo "<td>{$data->user_id}</td>";
                    echo "<td>{$data->stripe_card_id}</td>";
                    echo "<td>{$data->last4}</td>";
                    echo "<td>{$data->brand}</td>";
                    echo "<td>{$data->exp_month}</td>";
                    echo "<td>{$data->exp_year}</td>";
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function () {

  // set default card
  $(".set_default_btn").click(function(e) {
    // console.log('remove btn clicked');
    e.preventDefault();
    var user_card_id = e.currentTarget.getAttribute('data-id');

    if (user_card_id) {
      var x = confirm("Are you sure you want to set this default?");
      if (x) {
        // console.log(user_card_id);
        // return false;
        $('.remove_btn').removeAttr("href");
        $('.set_default_btn').removeAttr("href");
        $('.view_btn').removeAttr("href");
        $.ajax({
          url: '/v1/api/member/user_card/set_default',
          type: "POST",
          data: { user_card_id: user_card_id },
          dataType: 'JSON',
          success: function (response) {
            if (response.success) {
              toastr.options.timeOut = 2000;
              toastr.options.fadeOut = 2000;
              toastr.options.onHidden = function() {
                window.location.href = '/member/user_card/0?order_by=id&direction=DESC';
              }
              toastr.success(response.msg);
            }
            if (response.error) {
              toastr.options.timeOut = 2000;
              toastr.options.fadeOut = 2000;
              toastr.options.onHidden = function() {
                window.location.href = '/member/user_card/0?order_by=id&direction=DESC';
              }
              toastr.error(response.msg);
            }
          },
        });
      } else {
        return false;
      }
    }
  });

  // delete card
  $(".remove_btn").click(function(e) {
    // console.log('remove btn clicked');
    e.preventDefault();
    var user_card_id = e.currentTarget.getAttribute('data-id');

    if (user_card_id) {
      var x = confirm("Are you sure you want to delete?");
      if (x) {
        // console.log(user_card_id);
        // return false;
        $('.remove_btn').removeAttr("href");
        $('.set_default_btn').removeAttr("href");
        $('.view_btn').removeAttr("href");
        $.ajax({
          url: '/v1/api/member/user_card/delete',
          type: "POST",
          data: { user_card_id: user_card_id },
          dataType: 'JSON',
          success: function (response) {
            if (response.success) {
              toastr.options.timeOut = 2000;
              toastr.options.fadeOut = 2000;
              toastr.options.onHidden = function() {
                window.location.href = '/member/user_card/0?order_by=id&direction=DESC';
              }
              toastr.success(response.msg);
            }
            if (response.error) {
              toastr.options.timeOut = 2000;
              toastr.options.fadeOut = 2000;
              toastr.options.onHidden = function() {
                window.location.href = '/member/user_card/0?order_by=id&direction=DESC';
              }
              toastr.error(response.msg);
            }
          },
        });
      } else {
        return false;
      }
    }
  });
});
</script>


