<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('my_ads');?>
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
                  <a href="<?php echo base_url()?>myads/cars">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/cars-01.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('cars');?></h3>
                      </div>
                      <div class="number">
                        <h4>(<?php echo $myads_cars;  ?>)</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>myads/numberplates">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/number_plate.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('number_plates');?></h3>
                      </div>
                      <div class="number">
                        <h4>(<?php echo $myads_numberplates;  ?>)</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>myads/boats">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/boat.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('boats');?></h3>
                      </div>
                      <div class="number">
                        <h4>(<?php echo $myads_boats;  ?>)</h4>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>myads/bikes">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/bikes-01.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('bikes');?></h3>
                      </div>
                      <div class="number">
                        <h4>(<?php echo $myads_bikes;  ?>)</h4>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-6">
                  <a href="<?php echo base_url()?>myads/mobilenumbers">
                    <div class="sec-cont">
                      <div class="image">
                        <img class="img-fluid" src="<?php echo theme_url()?>img/icons/mobile_number.svg" alt="">
                      </div>
                      <div class="title">
                        <h3><?php echo $this->lang->line('mobile_numbers');?></h3>
                      </div>
                      <div class="number">
                        <h4>(<?php echo $myads_mobilenumber;  ?>)</h4>
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

    <section id="myads-main-mb">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="myads-list-cont">
                <ul>
                  <a href="<?php echo base_url()?>myads/cars">
                    <li>
                    <i class="fas fa-car"></i> <?php echo $this->lang->line('cars');?> <span>(<?php echo $myads_cars;  ?>)</span>
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>myads/numberplates">
                    <li>
                    <i class="far fa-closed-captioning"></i> <?php echo $this->lang->line('number_plates');?> <span>(<?php echo $myads_numberplates;  ?>)</span>
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>myads/boats">
                    <li>
                    <i class="fas fa-ship"></i> <?php echo $this->lang->line('boats');?> <span>(<?php echo $myads_boats;  ?>)</span>
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>myads/bikes">
                    <li>
                    <i class="fas fa-motorcycle"></i> <?php echo $this->lang->line('bikes');?> <span>(<?php echo $myads_bikes;  ?>)</span>
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>myads/mobilenumbers">
                    <li>
                    <i class="fas fa-mobile-alt"></i> <?php echo $this->lang->line('mobile_numbers');?> <span>(<?php echo $myads_mobilenumber;  ?>)</span>
                    </li>
                  </a>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </section>


<?php include('includes/footer.php');?>