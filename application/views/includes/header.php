<!DOCTYPE html>
<html <?php if ($this->uri->segment(1) == 'ar') {?> class="arabic" <?php } ?> <?php echo ($this->uri->segment(1)=='ar')?'lang="ar"':'lang="en"'?> xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $this->meta_info->getTitle()?></title>
    <meta name="Description" content="<?php echo $this->meta_info->getDescription()?>">
    <meta name="keywords" content="<?php echo $this->meta_info->getMetakeywords()?>"> 

    <link rel="shortcut icon" href="<?php echo theme_url()?>img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo theme_url()?>img/favicon.ico" type="image/x-icon">

    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,500,700"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="<?php echo theme_url()?>css/all.css" />    
    <!-- <link rel="stylesheet" href="<?php echo theme_url()?>css/style.css?ver=152" /> -->
    <?php if ($this->uri->segment(1) == 'ar') {?>
    <link href="<?php echo theme_url()?>css/bootstrap-ar.min.css" rel="stylesheet" />
    <link href="<?php echo theme_url()?>css/arabic.css?ver=406" rel="stylesheet" />
    <?php }else{ ?>
    <link href="<?php echo theme_url()?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo theme_url()?>css/style.css?ver=288" rel="stylesheet" />
    <?php } ?>
    
    <link rel="stylesheet" href="<?php echo theme_url()?>css/animate.min.css" />
    <link rel="stylesheet" href="<?php echo theme_url()?>css/materialize.css?ver=23" />
    <link rel="stylesheet" href="<?php echo theme_url()?>css/owl.carousel.css" />
    <link rel="stylesheet" href="<?php echo theme_url()?>css/owl.theme.default.css" />
    <link rel="stylesheet" href="<?php echo theme_url()?>css/ion.rangeSlider.min.css?ver=1" />

    <!-- <link rel="stylesheet" href="<?php echo theme_url()?>css/bootstrap.min.css" /> -->

    <link rel="stylesheet" href="<?php echo theme_url()?>css/toggle-switch.css" />

  

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<script src="<?php echo theme_url()?>js/jquery.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-190760785-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-190760785-1');
</script>

<script data-ad-client="ca-pub-8056224876401935" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<script  src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>


  </head>
  <body>
    <header id="header-main">
      <div class="top-header">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="social-top d-none d-lg-block">
                <ul class="social-footer list-inline">
                  <li class="list-inline-item">
                    <a target="_blank" href="https://www.facebook.com/dubaiedition/"><i class="fab fa-facebook-square"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-instagram"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-twitter-square"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-youtube-square"></i></a>
                  </li>
                </ul>
              </div>
              <div class="login-menu">
                <ul class="list-inline">
                  
                    <!-- <li class="list-inline-item">
                      <i class="fas fa-user-circle"></i>
                    </li> -->
                    <!-- <li class="list-inline-item login-txt">
                      <a href="<?php echo base_url()?>login">Login / Register</a>
                    </li> -->
                    <?php if ($this->session->userdata('user_id') > 0) {?>
                  <li class="list-inline-item">
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-user-circle"></i> <?php echo $this->lang->line('my_account');?>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo base_url()?>myaccount/dashboard"><i class="fas fa-tachometer-alt"></i> <?php echo $this->lang->line('dashboard');?></a>
                        <a class="dropdown-item" href="<?php echo base_url()?>myads"><i class="fas fa-list-ul"></i> <?php echo $this->lang->line('my_ads');?></a>
                        <a class="dropdown-item" href="<?php echo base_url()?>main/logout"><i class="fas fa-sign-out-alt"></i> <?php echo $this->lang->line('logout');?></a>                        
                      </div>
                    </div>
                  </li>
                  <?php }else{ ?>
                    <li class="list-inline-item login-txt">
                    <a href="<?php echo base_url()?>login"
                      ><i class="fas fa-user-circle"></i>
                      <?php echo $this->lang->line('login_register');?>
                    </a>
                  </li>
                  <?php } ?>
                  
                </ul>
              </div>
              <div class="lang-dropdown">
              <?php /*
                <?php if ($this->uri->segment(1) == 'ar') {?>
                  <a href="<?php echo base_url()?>langswitch/switchLanguage/en">
                  <img src="<?php echo theme_url()?>img/icons/usa_flag.png" />&nbsp; English
                  </a>                  
                <?php } else { ?>
                  <a href="<?php echo base_url()?>langswitch/switchLanguage/ar"><img src="<?php echo theme_url()?>img/icons/uae_flag.png" />&nbsp; العربية</a>
                <?php } ?>
                */ ?>
                <?php /**/ ?>
                <div class="btn-group">
                  <a
                    class="btn btn-secondary dropdown-toggle"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                      <?php if ($this->uri->segment(1) == 'ar') {?>
                      <img src="<?php echo theme_url()?>img/icons/uae_flag.png" />&nbsp; العربية
                      <?php }else if ($this->uri->segment(1) == 'cn'){ ?>
                      <img src="<?php echo theme_url()?>img/icons/china_flag.png" />&nbsp; 中文
                      <?php }else{ ?>
                      <img src="<?php echo theme_url()?>img/icons/usa_flag.png" />&nbsp; English
                      <?php } ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo base_url()?>langswitch/switchLanguage/en"
                      ><img src="<?php echo theme_url()?>img/icons/usa_flag.png" />&nbsp; English</a
                    >
                    <a class="dropdown-item" href="<?php echo base_url()?>langswitch/switchLanguage/ar"
                      ><img src="<?php echo theme_url()?>img/icons/uae_flag.png" />&nbsp; العربية</a
                    >
                    <a class="dropdown-item" href="<?php echo base_url()?>langswitch/switchLanguageCn/cn"
                      ><img src="<?php echo theme_url()?>img/icons/china_flag.png" />&nbsp; 中文</a
                    >
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="top-banner">
                <ul class="logo">
                  <li class="list-inline-item items logo-main">
                    <a href="<?php echo base_url()?>"
                      ><img src="<?php echo theme_url()?>img/at_logo_new.png" alt=""
                    /></a>
                  </li>
                  <li class="list-inline-item items logo-mb">
                    <div class="d-flex logo-mb-bk">
                      <?php if ($this->uri->rsegment(1) == 'home') {?>
                      <?php }else{ ?>
                        <div class="icon">
                          <a  onclick="handleRedirect()">
                          <?php echo ($this->uri->segment(1)=='ar')?'<i class="fas fa-arrow-right"></i>':'<i class="fas fa-arrow-left"></i>'?> 
                          </a>
                        </div>
                      <?php  } ?>                        
                        <div class="logo">
                          <a href="<?php echo base_url()?>"><img src="<?php echo theme_url()?>img/at_logo_new.png" alt=""
                          /></a>
                        </div>
                    </div>
                  </li>
                </ul>
                <!-- <div class="gads">
                  
                  <ins class="adsbygoogle"
                      style="display:block"
                      data-ad-client="ca-pub-8056224876401935"
                      data-ad-slot="9332418477"
                      data-ad-format="auto"
                      data-full-width-responsive="true"></ins>
                  <script>
                      (adsbygoogle = window.adsbygoogle || []).push({});
                  </script>
                </div> -->
                <ul class="post-btn">
                  <li class="list-inline-item items">
                    <a href="<?php echo base_url()?>postad" class="btn"><?php echo $this->lang->line('post_an_ad');?></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="menus">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="menus-cont">
              <ul class="list-inline owl7 owl-carousel owl-theme">
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>used-cars">
                  <img src="<?php echo theme_url()?>img/icons/cars-01.svg" alt="" />
                  <span><?php echo $this->lang->line('cars');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>numberplates">
                  <img src="<?php echo theme_url()?>img/icons/number_plate.svg" alt="" />
                  <span><?php echo $this->lang->line('number_plates');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>boats">
                  <img src="<?php echo theme_url()?>img/icons/boat.svg" alt="" />
                  <span><?php echo $this->lang->line('boats');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>bikes">
                  <img src="<?php echo theme_url()?>img/icons/bikes-01.svg" alt="" />
                  <span><?php echo $this->lang->line('bikes');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>mobilenumbers">
                  <img src="<?php echo theme_url()?>img/icons/mobile_number.svg" alt="" />
                  <span><?php echo $this->lang->line('mobile_numbers');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>dealers">
                  <img src="<?php echo theme_url()?>img/icons/dealers.svg" alt="" />
                  <span><?php echo $this->lang->line('car_dealers');?></span>
                  </a>
                </li>
                <!-- <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>numberplates">
                  <img src="<?php echo theme_url()?>img/icons/number_plate.svg" alt="" />
                  <span><?php echo $this->lang->line('number_plates');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>boats">
                  <img src="<?php echo theme_url()?>img/icons/boat.svg" alt="" />
                  <span><?php echo $this->lang->line('boats');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>bikes">
                  <img src="<?php echo theme_url()?>img/icons/bikes-01.svg" alt="" />
                  <span><?php echo $this->lang->line('bikes');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>mobilenumbers">
                  <img src="<?php echo theme_url()?>img/icons/mobile_number.svg" alt="" />
                  <span><?php echo $this->lang->line('mobile_numbers');?></span>
                  </a>
                </li>
                <li class="list-inline-item items">
                  <a href="<?php echo base_url()?>dealers">
                  <img src="<?php echo theme_url()?>img/icons/dealers.svg" alt="" />
                  <span><?php echo $this->lang->line('car_dealers');?></span>
                  </a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>