    
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->_data['meta']['title']?? 'Outline gurus';?></title>
    <meta name="description" 
    content="<?php echo $this->_data['meta']['desc']?? 'Outline gurus';?>">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-208304207-1">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-208304207-1');
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/frontend/css/style.css" />
    <link rel="stylesheet" href="/assets/css/select2.css" /> 
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!--load all styles -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>

<style>
    body{
        font-family: "Oswald", Sans-serif !important;
    }

    @media screen and (max-width: 767px) {
        #reviewModal .modal-dialog {
            max-width: 350px !important;
            margin: 50px auto; }
        }
</style>
<body>

 <!-- navbar starts -->
 <nav class="navbar navbar-expand-sm bg-light navbar-danger">
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
                    <a class="nav-link text-dark" href="/buy">Buy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/sell">Sell</a>
                </li>
                <?php if($this->session->userdata('user_id')) {?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/member/profile">Account</a>
                </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="/member/<?php echo ($this->session->userdata('user_id')) ? 'profile' : 'login'; ?>" ><img style="height: 20px;margin-top: 10px;" src="https://img.icons8.com/ios-filled/26/000000/user.png" /></a>
                </li>
                 
            </ul>
        </div>
    </nav> 