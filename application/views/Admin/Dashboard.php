<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="tab-content mx-4" id="nav-tabContent">
<h2>Dashboard</h2>
<br>
<style>
.card-header{
    font-weight: bold;
    font-size: 22px;
}
    
</style>
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
</div>


<div class="container">

    <div class="row">

        <div class="col-md-4 col-sm-12">

            <div class="card ">
            <div class="card-header">
                Transaction
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">This Week <span class="pull-right">0</span></li>
                <li class="list-group-item">This Month <span class="pull-right">0</span></li>
                <li class="list-group-item">This Year<span class="pull-right">0</span></li>
                <li class="list-group-item">Total <span class="pull-right">0</span></li>
            </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card ">
            <div class="card-header">
            Member Accounts
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">This Week <span class="pull-right"><?php echo  $this->_data['member_accounts']['week'];?></span></li>
                <li class="list-group-item">This Month <span class="pull-right"><?php echo  $this->_data['member_accounts']['month'];?></span></li>
                <li class="list-group-item">This Year<span class="pull-right"><?php echo  $this->_data['member_accounts']['year'];?></span></li>
                <li class="list-group-item">Total <span class="pull-right"><?php echo  $this->_data['member_accounts']['total'];?></span></li>
            </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card ">
            <div class="card-header">
            Uploaded Notes
            </div>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">This Week <span class="pull-right"><?php echo  $this->_data['member_uploads']['week'];?></span></li>
                <li class="list-group-item">This Month <span class="pull-right"><?php echo  $this->_data['member_uploads']['month'];?></span></li>
                <li class="list-group-item">This Year<span class="pull-right"><?php echo  $this->_data['member_uploads']['year'];?></span></li>
                <li class="list-group-item">Total <span class="pull-right"><?php echo  $this->_data['member_uploads']['total'];?></span></li>
            </ul>
            </div>
        </div>




    </div>
    <div class="row mt-3">

        <div class="col-md-4 col-sm-12">

            <div class="card ">
            <div class="card-header">
              Most Accounts By School
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ( $this->_data['top_school_account'] as $key => $value) { ?>                
                <li class="list-group-item"><?php echo $value['school']??'User Not Select School';?><span class="pull-right"><?php echo $value['count']??'0';?></span></li>
                <?php }?>
            </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card ">
            <div class="card-header">
            Most Uploads By School
            </div>
            <ul class="list-group list-group-flush">
            <?php foreach ( $this->_data['top_school_upload'] as $key => $value) { ?>                
                <li class="list-group-item"><?php echo $value['school']??'User Not Select School';?><span class="pull-right"><?php echo $value['count']??'0';?></span></li>
                <?php }?>
            </ul>
            </div>
        </div>
       



    </div>
</div>