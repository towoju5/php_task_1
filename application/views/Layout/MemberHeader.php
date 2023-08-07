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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <!-- Our Custom CSS -->
    	<link rel="stylesheet" href="/assets/css/styles.css"/>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>

</head>

<body>
    <style>
        #logo{
        width: 180px;
        }
        .navbar{
            padding:3px 10px !important;
        }
        #Navbar2{
            text-align: center;
        }
       .nav-link{
           color:blue;
       }
       .nav-link.active{
           text-decoration: underline;
       }.bold-heading{
           font-weight: bolder;
       }
    </style>
<div>
     <!-- navbar starts -->
 <nav class="navbar navbar-expand-sm bg-light navbar-danger" style="margin-bottom: 1px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
            <span class="navbar-toggler-icon"><img
                    src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" /></span>
        </button>
        <!-- Brand/logo -->
        <a href="<?php echo base_url();?>"><img class="navbar-brand" id="logo" src="<?php echo base_url();?>assets/frontend/img/Logo Files/Logo Files/SVG/Artboard 1 copy.svg" /></a>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="Navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo base_url();?>buy">Buy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo base_url();?>sell">Sell</a>
                </li>
                <?php if($this->session->userdata('user_id')) {?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo base_url();?>member/profile">Account</a>
                </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php echo base_url();?>contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>member/<?php echo ($this->session->userdata('user_id')) ? 'profile' : 'login'; ?>" ><img style="height: 20px;margin-top: 10px;" src="https://img.icons8.com/ios-filled/26/000000/user.png" /></a>
                </li>
                <li class="nav-item">
                  <?php //(!$this->session->userdata('user_id')) ?
                    // '<a class="btn-main signup_btn flex-css" style="text-decoration: none;" href="/member/register">Sign Up</a>' :
                    // '<a class="nav-link" href="/member/logout">Logout</a>';
                  ?>
              </li>   
            </ul>
        </div>
    </nav>
    <!-- navbar ends -->
    <nav class="navbar navbar-expand-sm bg-light navbar-danger" style="margin-bottom: 1px">
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar2">
            <span class="navbar-toggler-icon"><img
                    src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" /></span>
        </button>
        <div class="collapse navbar-collapse" id="Navbar2">    
                <ul class="navbar-nav ml-auto"   style="margin-right: auto;    margin-left: auto;">
               
                    <!-- <li  class="nav-item"><a href='/member/dashboard' class='nav-link <?php echo ($page_name == 'Dashboard') ? 'active bold-heading': '';?>'>Dashboard</a></li> -->
                    <li  class="nav-item"><a href='/member/profile' class='nav-link <?php echo ($page_name == 'Profile') ? 'active bold-heading': '';?>'>Profile</a></li>
                    <li  class="nav-item"><a href='/member/setting' class='nav-link <?php echo ( $this->uri->segment(2)=='setting' || $this->uri->segment(2)=='post_setting' ) ? 'active bold-heading': '';?>'>Setting</a></li>
                    <li  class="nav-item"><a href='/member/purchases/0?order_by=id&direction=DESC' class='nav-link <?php echo ($page_name == 'Purchases') ? 'active bold-heading': '';?>'>Purchases</a></li>
                    <li  class="nav-item"><a href='/member/sales/0?order_by=id&direction=DESC' class='nav-link <?php echo ($page_name == 'Sales') ? 'active bold-heading': '';?>'>Earnings</a></li>
                <li  class="nav-item"><a href='/member/inventory/0?order_by=id&direction=DESC' class='nav-link <?php echo ($page_name == 'Inventory' && $this->uri->segment(2)=='inventory') ? 'active bold-heading': '';?>'>Uploads</a></li>
                <li  class="nav-item"><a href='/member/ticket/0?order_by=id&direction=DESC' class='nav-link <?php echo ($page_name == 'Ticket') ? 'active bold-heading': '';?>'>Tickets</a></li>
                <li  class="nav-item"><a href='/member/logout' class='nav-link <?php echo ($page_name == 'Logout') ? 'active bold-heading': '';?>'>Logout</a></li>

                </ul>
       
        </div>
    </nav>
 
           
</div>
<div class="container">
      
       
        <div id="content">
           
