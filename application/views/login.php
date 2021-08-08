<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('login');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="loginreg-main">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="loginreg-cont">
              <div class="row">
                <div class="col-md-4 col-sm-6">
                <div class="login-tabs-cont">
                    <div class="tabs-login">
                      <ul
                        class="nav nav-pills mb-3"
                        id="pills-tab"
                        role="tablist"
                      >
                        <li class="nav-item">
                          <a
                            class="nav-link active"
                            id="login-tab"
                            data-toggle="pill"
                            href="#login"
                            role="tab"
                            aria-controls="login"
                            aria-selected="true"
                            ><?php echo $this->lang->line('login');?></a
                          >
                        </li>
                        <li class="nav-item">
                          <a
                            class="nav-link"
                            id="register-tab"
                            data-toggle="pill"
                            href="#register"
                            role="tab"
                            aria-controls="register"
                            aria-selected="false"
                            ><?php echo $this->lang->line('register');?></a
                          >
                        </li>
                      </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="login"
                        role="tabpanel"
                        aria-labelledby="login-tab"
                      >
                        <!-- Menu items -->
                        <div class="login-cont">
                          <form method="post" class="" action="<?php echo base_url()?>main/validateUser">
                          <div class="error-msg">
                          <?php /* if ($error) { echo $error;  } */?>
                          <?php if ($_SESSION["sess_alert_ve"] && $_GET['st'] == 3) { echo $_SESSION["sess_alert_ve"]; }?>
                         
                                                 

                          <?php if ($_SESSION["sess_alert_iv"] && $_GET['st'] == 4) {echo $_SESSION["sess_alert_iv"];  } ?>
                          
                          <?php   ?>
                         
                          </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="<?php echo $this->lang->line('email');?>"
                                name="email"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="<?php echo $this->lang->line('password');?>"
                                name="password"
                              />
                            </div>
                            <div class="">
                              <button class="btn btn-primary btn-md">
                              <?php echo $this->lang->line('login');?>
                              </button>
                            </div>

                            <div class="dividerln">
                            <p class="divider-text"><?php echo $this->lang->line('or');?></p>
                        </div>

                        <div class="google-login-cont">                       

                          <a href="<?php echo $loginURL; ?>">

                            <div class="social-login">
                              <div class="google-lg">
                                <span><img src="<?php echo theme_url()?>img/google_icon.png" alt=""></span>
                                <?php echo $this->lang->line('login_with_google');?>
                              </div>                              
                            </div>
                          
                          </a>                          
                        
                        </div>


                            <div class="forgot_pass_cont">
                              <a href="<?php echo base_url()?>login/forgotPassword"><?php echo $this->lang->line('forgot_password');?></a>
                            </div>
                          </form>
                        </div>
                        <!-- Menu items -->
                      </div>
                      <div
                        class="tab-pane fade"
                        id="register"
                        role="tabpanel"
                        aria-labelledby="register-tab"
                      >
                        <!-- Menu items -->
                        <div class="login-cont">
                        <form method="post" class="" action="<?php echo base_url()?>main/register">
                          <div class="error-msg">
                          <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 2) { echo $_SESSION["sess_alert"];  }?>
                          </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="<?php echo $this->lang->line('email_address');?>"
                                name="email"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="<?php echo $this->lang->line('password');?>"
                                name="password"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="<?php echo $this->lang->line('confirm_password');?>"
                                name="passconf"
                              />
                            </div>
                            <div class="">
                              <button class="btn btn-primary btn-md">
                              <?php echo $this->lang->line('register');?>
                              </button>
                            </div>
                          </form>
                        </div>
                        <!-- Menu items -->
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



<?php include('includes/footer.php');?>

<script>
  var url = document.URL;
var hash = url.substring(url.indexOf('#'));

$(".nav-pills").find("li a").each(function(key, val) {
    if (hash == $(val).attr('href')) {
        $(val).click();
    }
    
    $(val).click(function(ky, vl) {
        location.hash = $(this).attr('href');
    });
});
</script>

