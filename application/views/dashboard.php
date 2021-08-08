<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('dashboard');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="myaccount-main" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          <?php include('includes/user_menu.php');?>
          </div>
          <div class="col-md-9">
            <div class="dashboard-cont">
              <div class="row">
                <div class="col-md-4">
                  <a href="<?php echo base_url()?>myads">
                    <div class="dashbord-list">
                      <div class="title">
                        <h4><?php echo $this->lang->line('my_ads');?></h4>
                      </div>
                      <div class="icon">
                        <i class="fas fa-list-ul"></i>
                      </div>
                      <!-- <div class="txt-sub">
                        <?php echo $myads_cars; ?>
                      </div> -->
                    </div>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="<?php echo base_url()?>postad">
                    <div class="dashbord-list">
                      <div class="title">
                        <h4><?php echo $this->lang->line('post_an_ad');?></h4>
                      </div>
                      <div class="icon">
                        <i class="fas fa-bullhorn"></i>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-4">
                  <a href="">
                    <div class="dashbord-list">
                      <div class="title">
                        <h4><?php echo $this->lang->line('account_settings');?></h4>
                      </div>
                      <div class="icon">
                        <i class="fas fa-user"></i>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="myaccount-main-mb">
      <div class="container">
        <div class="row">

          <div class="col">
            <a href="<?php echo base_url()?>myads">
              <div class="dashboard-lists">
                <div class="icon">
                  <i class="fas fa-list-ul"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('my_ads');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>postad">
              <div class="dashboard-lists">
                <div class="icon">
                <i class="fas fa-bullhorn"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('post_an_ad');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>myaccount/settings">
              <div class="dashboard-lists">
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('my_account');?>
                </div>
              </div>
            </a>
          </div>

         

        </div>
      </div>
    </section>

<?php include('includes/footer.php');?>