<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?php echo $this->lang->line('reset_password');?>
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
                    <!-- Forgot password -->
                    <div class="tab-content" id="pills-tabContent">
                      <div
                        class="tab-pane fade show active"
                        id="login"
                        role="tabpanel"
                        aria-labelledby="login-tab"
                      >
                        <!-- Menu items -->
                        <div class="login-cont">
                          <form method="post" class="" action="<?php echo base_url()?>main/resetPasswordVal">
                          <div class="error-msg">
                          <?php /* if ($error) { echo $error;  } */?>
                          <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 1) { echo $_SESSION["sess_alert"]; }?>
                         
                          
                         
                          </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="hidden"                                
                                name="reset_key"
                                value="<?php echo $this->uri->segment(3); ?>"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="<?php echo $this->lang->line('new_password');?>"
                                name="password"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="<?php echo $this->lang->line('confirm_new_password');?>"
                                name="passconf"
                              />
                            </div>
                           
                            <div class="">
                              <button class="btn btn-primary btn-md">
                              <?php echo $this->lang->line('reset_password');?>
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

    <section id="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <div class="ads-adv">
              <h3>
                WANT TO SELL YOUR CAR?
              </h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="post-btn">
              <button class="btn btn-white">Post an AD for FREE</button>
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

