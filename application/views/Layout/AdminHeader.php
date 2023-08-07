<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>OutlineGurus</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!-- Our Vendor CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/vendor_full.css" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
        <link rel="stylesheet" href="/assets/css/select2.css"/>
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="/assets/css/styles.css"/>

    </head>
    <style>
        #logo{
            width: 180px;
        } 
    </style>
<body>

<div class="wrapper">
        <!-- Sidebar  -->
        <?php if (!$layout_clean_mode) { ?>
        <nav id="sidebar">
            <div class="sidebar-header" style="background-color: whitesmoke;padding:0px;padding-top:8px;height:68px;">
              <!-- Brand/logo -->
        <a href="<?php echo base_url();?>" style="margin-left: 23px;;"><img class="navbar-brand" id="logo" src="<?php echo base_url();?>assets/frontend/img/Logo Files/Logo Files/SVG/Artboard 1 copy.svg" /></a>

            </div>

            <ul class="list-unstyled components">
            <li><a href='/admin/dashboard' class='<?php echo ($page_name == 'Dashboard') ? 'active': '';?>'>Dashboard</a></li>
            <li><a href='/admin/order/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Order') ? 'active': '';?>'>Order</a></li>
            <!-- <li><a href='/admin/dispute/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Dispute') ? 'active': '';?>'>Dispute</a></li> -->
            <li><a href='/admin/inventory/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Inventory') ? 'active': '';?>'>Outline</a></li>
            <li><a href='/admin/payout/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Payout') ? 'active': '';?>'>Payout</a></li>
            <li><a href='/admin/review/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Review') ? 'active': '';?>'>Review</a></li>
            <li><a href='/admin/ticket/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Ticket') ? 'active': '';?>'>Dispute</a></li>
            <li><a href='/admin/setting/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Setting') ? 'active': '';?>'>Setting</a></li>
            <li><a href='/admin/school/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'School') ? 'active': '';?>'>School</a></li>
            <!-- <li><a href='/admin/textbook/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Textbook') ? 'active': '';?>'>Textbook</a></li> -->
            <li><a href='/admin/professor/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Professor') ? 'active': '';?>'>Professor</a></li>
            <li><a href='/admin/class/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Class') ? 'active': '';?>'>Class</a></li>
            <!-- <li><a href='/admin/payout/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Payout') ? 'active': '';?>'>Payout</a></li> -->
            <li><a href='/admin/content/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Content') ? 'active': '';?>'>Content</a></li>
            <li><a href='/admin/emails/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Emails') ? 'active': '';?>'>Emails</a></li>
            <!-- <li><a href='/admin/spreadsheet?order_by=id&Direction=ASC' class='<?php echo ($page_name == 'Spreadsheet') ? 'active': '';?>'>Spreadsheet</a></li> -->
            <!-- <li><a href='/admin/marketing?order_by=title&direction=DESC' class='<?php echo ($page_name == 'Marketing') ? 'active': '';?>'>Marketing</a></li> -->
            <!-- <li><a href='/admin/transaction/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Transaction') ? 'active': '';?>'>Transaction</a></li> -->
            <!-- <li><a href='/admin/tax' class='<?php echo ($page_name == 'Tax') ? 'active': '';?>'>Tax</a></li> -->
            <!-- <li><a href='/admin/refund/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Refund') ? 'active': '';?>'>Refund</a></li> -->
            <li><a href='/admin/contact_us/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Contact') ? 'active': '';?>'>Contact</a></li>
            <li><a href='/admin/suggestion/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'Suggestion') ? 'active': '';?>'>Suggestion</a></li>
            <!-- <li><a href='/admin/user_card/0?order_by=id&direction=DESC' class='<?php echo ($page_name == 'User Card') ? 'active': '';?>'>User Card</a></li> -->
            <li><a href='/admin/users/0?order_by=a_id&direction=DESC' class='<?php echo ($page_name == 'Users') ? 'active': '';?>'>Users</a></li>
            <li><a href='/admin/profile' class='<?php echo ($page_name == 'Profile') ? 'active': '';?>'>Profile</a></li>
            <li><a href='/admin/logout' class='<?php echo ($page_name == 'Logout') ? 'active': '';?>'>Logout</a></li>

            </ul>
            <span class="copyright d-none"><?php echo $setting['copyright'];?></span>
            <span class="copyright d-none">Powered By <a href="https://manaknightdigital.com" target="__blank">Manaknightdigital Inc.</a></span>
        </nav>
        <?php } ?>
        <div id="content">
            <?php if (!$layout_clean_mode) { ?>
            <nav>
                <div class="navigation-row">
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                            <span>☰</span>
                        </button>
                </div>
            </nav>
            <?php } ?>
