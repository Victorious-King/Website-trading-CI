<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dubai edition">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Dubai edition">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url()?>themes/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url()?>themes/admin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url()?>themes/admin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>themes/admin/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo base_url()?>themes/admin/css/style.css?v=1" rel="stylesheet">
    <link href="<?php echo base_url()?>themes/admin/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <style>
     .btn-primary{
      background-color: #393939;
      border-color: #202020;
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary {
        color: #393939;
        border-color: #202020;
        background: transparent;
    }
    /*.login-img img{      
        width:200px;    
    }
    .login-form{
      background: #00a5ff;
    border: 1px solid #d5d7de;
    }
    .btn-primary{
      background-color: #0d2149;
    }
    .bd-login{
      background-image: url(../themes/admin/img/bg.jpg);
      background-position: left;      
      background-repeat: repeat-y;
      background-size: cover;
    } */
    </style>
</head>
<!-- class="login-img3-body" -->
  <body class="bd-login">

    <div class="container">

      <form class="login-form" method="post" action="<?php echo base_url()?>admin/login/validateUser">        
        <div class="login-wrap">
            <div style="color:#ff0000;">
                <?php echo validation_errors(); 
                    if (!empty($flag)) {
                        echo '<div style="margin-left:30px;"><br />Invalid Email or Password!</div>';
                    }
                ?>
            </div>
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input name="email" type="text" class="form-control" placeholder="Username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>
           <!--  <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label> -->
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        </div>
      </form>

    </div>


  </body>
</html>
