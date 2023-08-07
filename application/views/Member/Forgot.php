<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>OutlineGurus | Forgot Password</title>
    <style>
        .form-container {
            width: 40%;
            min-width: 300px;
            max-width: 500px;
            border: 1px solid #ccc;
            height: auto;
            margin: 50px auto;
        }
        @media (max-width: 500px) {
            h1 {
                font-size: 24px;
            }
            .form-container {
                margin: 10px auto;
            }
        }
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
       }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-danger" style="margin-bottom: 1px">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
            <span class="navbar-toggler-icon"><img
                    src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" /></span>
        </button>
        <!-- Brand/logo -->
        <a href="<?php echo base_url();?>"><img class="navbar-brand" id="logo" src="<?php echo base_url();?>/assets/frontend/img/Logo Files/Logo Files/SVG/Artboard 1 copy.svg" /></a>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="Navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a   class="nav-link text-dark" href="<?php echo base_url();?>/member/login">Login</a>
                </li>
                
            </ul>
        </div>
    </nav>
        <div class="">
            <div class='text-center'>
                <h1>Forgot Password</h1>
            </div>
            <div class="form-container p-5">
                <?php echo form_open();?>
                    <?php if (strlen($error) > 0) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (validation_errors()) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors() ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (strlen($success) > 0) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    <?php echo $success; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class='required' for="Email">Email</label>
                        <input type="email" class="form-control site-input" id="email" name="email"  required="true" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name='btn-login' class="btn btn-primary btn-block" value="Reset Password">
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-center">
                        <a href="/member/login" id="mkd-forgot-password-link">Back</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center mt-0" style=" width: 100%;"> 
            <div class="col-auto mt-3">
                <p>© Copyright 2021 Outline Gurus</p>
            </div>
        </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

