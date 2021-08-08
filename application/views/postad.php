<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('post_an_ad');?>
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
          <div class="postad-cont">
              <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>postad/car">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/cars-01.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('cars');?></h3>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>postad/numberplate">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/number_plate.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('number_plates');?></h3>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>postad/boat">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/boat.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('boats');?></h3>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>postad/bike">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/bikes-01.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('bikes');?></h3>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>postad/mobilenumber">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/mobile_number.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('mobile_numbers');?></h3>
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
            <a href="<?php echo base_url()?>postad/car">
              <div class="dashboard-lists">
                <div class="icon">
                  <i class="fas fa-car"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('cars');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>postad/numberplate">
              <div class="dashboard-lists">
                <div class="icon">
                <i class="far fa-closed-captioning"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('number_plates');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>postad/boat">
              <div class="dashboard-lists">
                <div class="icon">
                <i class="fas fa-ship"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('boats');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>postad/bike">
              <div class="dashboard-lists">
                <div class="icon">
                  <i class="fas fa-motorcycle"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('bikes');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col">
            <a href="<?php echo base_url()?>postad/mobilenumber">
              <div class="dashboard-lists">
                <div class="icon">
                <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('mobile_numbers');?>
                </div>
              </div>
            </a>
          </div>

          <div class="col"></div>
          

          <!-- <div class="col">
            <a href="">
              <div class="dashboard-lists">
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <div class="title">
                <?php echo $this->lang->line('boats');?>
                </div>
              </div>
            </a>
          </div> -->

         

        </div>
      </div>
    </section>

<?php include('includes/footer.php');?>