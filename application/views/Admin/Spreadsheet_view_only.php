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
    <ol class="breadcrumb pl-0 mb-2 bg-background d-flex justify-content-center justify-content-md-start">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="/admin/spreadsheet/0" class="breadcrumb-link"><?php echo $view_model->get_heading();?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Edit
        </li>
    </ol>
</div>
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

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form id="Spreadsheet_update">
            <div class="pull-right">
                <input type="submit" class="btn btn-primary ext-white mb-2" value="Save">
            </div>
            <div class="clear"></div>
            <input type="hidden" id="spreadsheet_id" value="<?php echo $this->_data['view_model']->get_id();?>">
            <div class="card" style="height: 1000px;width: 100%;">
                <div class="card-body" >
                    <input type="hidden" value= '<?php echo $this->_data['view_model']->get_value(); ?>' id='value_data'>
                    <div id="luckysheet" style="margin:0px;padding:0px;position:absolute;width:100%;height:100%;left: 0px;top: 0px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        var data_value = document.getElementById('value_data');
        var options = {
            title :'Spreadsheet',
            data : JSON.parse(data_value.value),
            myFolderUrl : '/admin/spreadsheet/0'

        };
        luckysheet.create(options);
    });
</script>