<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*Powered By: Manaknightdigital Inc. https://manaknightdigital.com/ Year: 2020*/
?>
<div class="tab-content mx-4 mt-3" id="nav-tabContent">
<div class="clear"></div>
<?php if (strlen($error) > 0) : ?>
    <div class="row">
        <div class="col-md-12 mt-4">
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

<h5 class="primaryHeading2 d-flex justify-content-between mt-2 my-2">
  <?php echo $view_model->get_heading();?>
  <span class="add-part d-flex justify-content-md-end  text-white "><a class="btn btn-primary btn-sm" target="__blank" href="/admin/sms/add"><i class="fas fa-plus-circle"></i></a></span>
</h5>
<div class="row mb-5">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card"   id="sms_listing">

            <div class="card-body">

                <div class="table-responsive">
                    
                    <table class="display nowrap table table-hover table-striped table-bordered w-100 table-compact mb-0 mkd-table-container">
                        <thead class=''>
                        
                        <?php
                        foreach ($view_model->get_column() as $data) {
                            echo "<th text-left>{$data}</th>";
                        } ?>
                        </thead>
                        <tbody class="tbody-light">
                        <?php $i=1; foreach ($view_model->get_list() as $data) { ?>
                            <?php
                            echo '<tr>';
                                
                                							echo '<td style=\'max-width: 100px;\'>';
							echo '<a class="btn-link link-underline text-underline" target="__blank" href="/admin/sms/edit/' . $data->id . '">Edit</a>';
							echo ' <a class="btn-link link-underline text-underline" target="__blank" href="/admin/sms/view/' . $data->id . '">View</a>';
							echo '</td>';							echo "<td>{$data->slug}</td>";
							echo "<td>{$data->content}</td>";
							echo "<td>{$data->tag}</td>";

                            echo '</tr>';
                            ?>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                    <small><?php echo $view_model->get_total_rows();?> results found</small>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


