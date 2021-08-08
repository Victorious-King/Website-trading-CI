<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Admin admin</title>

    <link rel="stylesheet" href="<?php echo theme_url()?>css/all.css" />   

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url()?>themes/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url()?>themes/admin/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url()?>themes/admin/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>themes/admin/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="<?php echo base_url()?>themes/admin/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>themes/admin/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo base_url()?>themes/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo base_url()?>themes/admin/css/owl.carousel.css" type="text/css">
	<link href="<?php echo base_url()?>themes/admin/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo base_url()?>themes/admin/css/fullcalendar.css">
	<link href="<?php echo base_url()?>themes/admin/css/widgets.css" rel="stylesheet">
    <link href="<?php echo base_url()?>themes/admin/css/style.css?v=2" rel="stylesheet">
    <link href="<?php echo base_url()?>themes/admin/css/style-responsive.css" rel="stylesheet" />
	<link href="<?php echo base_url()?>themes/admin/css/xcharts.min.css" rel=" stylesheet">	
	<link href="<?php echo base_url()?>themes/admin/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url()?>themes/admin/js/html5shiv.js"></script>
      <script src="<?php echo base_url()?>themes/admin/js/respond.min.js"></script>
      <script src="<?php echo base_url()?>themes/admin/js/lte-ie7.js"></script>
    <![endif]-->

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="<?php echo base_url()?>admin/dashboard" class="logo">DE <span class="lite">Admin</span></a>
            <!--logo end-->

            <?php 
            /* 
            <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" placeholder="Search" type="text">
                        </form>
                    </li>                    
                </ul>
                <!--  search form end -->                
            </div> 
            */ 
            ?>

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span>
                            <span class="username"><?php $name=$this->session->userdata('fname'); echo ($name<>''?'Welcome '.$name:'');?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            
                            <li>
                                <a href="<?php echo base_url()?>admin/login/logOut/"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->