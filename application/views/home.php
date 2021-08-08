<?php include('includes/header.php');?>
<script type="text/javascript">
function getModelList(id){
    if(id!=''){
        $.ajax
        ({
        type: "GET",        
        url: "<?php echo base_url(); ?>main/getModelList/"+id,
        cache: false,
        success: function(html)
        {
        $("#car_model").html(html);
        } 
        });
      }
  }

  function search_car () {
  
  var car_make = $("#car_make option:selected").attr('id');
  //alert(car_make);
  var car_model = $("#car_model option:selected").attr('id');
  

  val = '';

  if (car_make != '' && typeof (car_make) != 'undefined') {
    val = val + car_make + '/';
  }

  if (car_model != '' && typeof (car_model) != 'undefined') {
    val = val + car_model + '/';
  }


  if (typeof ($("#sort option:selected").val()) != 'undefined') {
    document.search_car_form.st.value = $("#sort option:selected").val();
  }


  var res = val.replace(/ /g, "-");

  document.search_car_form.action = '<?php echo base_url(); ?>used-cars/'+res;
  document.search_car_form.submit();   
}
  </script>

  <section id="home-search-banner" class="d-none d-lg-block">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="all-cont d-flex">
            <div class="search-cont">
              <div class="title">
                <h2><?php echo $this->lang->line('saerch_heading_hm');?></h2>
              </div>

              <form id="search_car_form" name="search_car_form" method="get">

              <div class="row make-cont">
                <div class="col-md-6">
                  <div class="make">
                    <div class="form-group">
                      <!-- <label><?php echo $this->lang->line('select_make');?></label> -->
                      <select name="car_make" id="car_make" class="form-control" onchange="getModelList(this.value);">
                        <option value=""><?php echo $this->lang->line('make_any');?></option>
                          <?php foreach($make as $mk) { ?>
                              <option value="<?php echo $mk['id']; ?>" <?php echo ($car['make_id']==$mk['id']?'selected':'');?> id="<?php echo strtolower($mk['make']);?>">
                              <?php echo ($this->uri->segment(1) == 'ar' ? $mk['make_ar']:($this->uri->segment(1) == 'cn' ? $mk['make_cn']:$mk['make']));?></option>
                          <?php } ?>                                    
                      </select>              
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="model">
                    <div class="form-group">
                      <!-- <label><?php echo $this->lang->line('select_model');?></label> -->
                      <select name="car_model" id="car_model" class="form-control m-bot15">
                        <option value=""><?php echo $this->lang->line('model_any');?></option>                  
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row year-cont">
                <div class="col-md-6">
                    <div class="min-year">
                      <div class="form-group">
                        <!-- <label><?php echo $this->lang->line('select_min_year');?></label> -->
                        <select name="year_min" id="year_min" class="form-control m-bot15">
                          <option value=""><?php echo $this->lang->line('min_year_hm');?></option>
                              <?php 
                                $yearval=date('Y')+1;
                                $yearcount=1;
                                while($yearcount<=100)
                                  {
                                    $selected_year = ($car['year']==$yearval?'selected':'');
                                    echo '<option '.$yearval.' value="'.$yearval.'" '.$selected_year.'>'.$yearval.'</option>';
                                    $yearcount++;
                                    $yearval--;
                                  }
                              ?>
                        </select>
                      </div>
                    </div>                
                  </div>
                  <div class="col-md-6">
                    <div class="max-year">
                      <div class="form-group">
                        <!-- <label><?php echo $this->lang->line('max_year_hm');?></label> -->
                        <select name="year_max" id="year_max" class="form-control m-bot15">
                          <option value=""><?php echo $this->lang->line('max_year_hm');?></option>
                              <?php 
                                $yearval=date('Y')+1;
                                $yearcount=1;
                                while($yearcount<=100)
                                  {
                                    $selected_year = ($car['year']==$yearval?'selected':'');
                                    echo '<option '.$yearval.' value="'.$yearval.'" '.$selected_year.'>'.$yearval.'</option>';
                                    $yearcount++;
                                    $yearval--;
                                  }
                              ?>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="row price-cont">
                <div class="col-md-6">
                  <div class="min-price">

                    <div class="form-group">
                    <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('min_price');?>" name="price_min" value="">
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="max-price">

                    <div class="form-group">
                     <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('max_price');?>" name="price_max" value="">
                    </div>                   
                  
                  </div>
                </div>
              </div>

              <div class="condition">
                  <div class="switch-toggle switch-candy">
                    <input class="checkbox-radio" id="New" name="condition" value="New" type="radio">
                    <label class="option" for="New" onclick=""><?php echo $this->lang->line('new');?></label>

                    <input class="checkbox-radio active" id="Used" name="condition" value="Used" type="radio" checked>
                    <label class="option" for="Used" onclick=""><?php echo $this->lang->line('used');?></label>

                    <input class="checkbox-radio" id="Classic" name="condition" value="Classic" type="radio">
                    <label class="option" for="Classic" onclick=""><?php echo $this->lang->line('classic');?></label>


                    <a class="btn btn-primary"></a>
                  </div>
              </div>

              <div class="search-btn">
                <button onClick="search_car()" class="btn"><?php echo $this->lang->line('search_cars');?></button>
              </div> 

              </form>

              
            </div>
            <div class="banner-cont">
              <div class="banner-image">
                <a href="<?php echo base_url()?>used-cars">
                <img src="<?php echo base_url_images()?>posted_images/banner/img6.jpg" alt=""/>
                </a>
              </div>
              <div class="banner-caption">
               <a href="<?php echo base_url()?>used-cars">
               <h2><?php echo $this->lang->line('find_all_new');?></h2>
               </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </section>
    
   

    <section class="d-none d-lg-block" id="home-featured-side">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col">
                <div class="title-main">
                  <h1><?php echo $this->lang->line('head_txt1');?></h1>
                </div>
              </div>
            </div>
            <div class="row">
              <?php foreach($list_cars as $car) { ?>
              <div class="col-md-3 col-sm-6 col-xs-6">
                
                <div class="car-listing">
                  <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>">
                  <div class="image">
                    <img
                      class="img-fluid"
                      src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($car['image'],'300x225'); ?>"
                      alt="<?php echo $car['year'].' '.($this->uri->segment(1) == 'ar' ? $car['make_ar']:$car['make']).' '.($this->uri->segment(1) == 'ar' ? $car['model_ar']:$car['model']) ?>"
                    />
                  </div>
                  <?php if($car['featured'] == 1){ ?>
                    <div class="featured">  
                      <span><?php echo $this->lang->line('featured');?></span>
                    </div>
                  <?php } ?>
                  </a>
                  <div class="price">
                  AED <?php echo number_format($car['price']); ?>
                  </div>
                  <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>">
                  <div class="car-desc">
                    <h3><?php echo substr($car['title'], 0, 50) ; ?>...</h3>
                    
                  </div>
                  </a>
                  <div class="features">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <i class="fas fa-tachometer-alt"></i> <?php echo $car['mileage']; ?> Kms
                      </li>
                      <li class="list-inline-item">
                        <i class="fas fa-calendar-alt"></i> <?php echo $car['year']; ?>
                      </li>
                      <li class="list-inline-item"></li>
                    </ul>
                  </div>
                  <!-- <div class="badges">
                          <?php if($car['badges']){ ?>
                              <ul class="list-inline">
                              <?php 
                              $type = explode(',', $car['badges']);
                              foreach ($type as $ty){?>                          
                                <li class="list-inline-item">
                                  <?php echo $ty; ?>
                                </li>                                                 
                              <?php } ?>
                            </ul>
                          <?php } ?>                         
                        </div> -->
                </div>
                <div class="city-logo">
                  <?php 
                    $city = str_replace(" ", "-", $car['city']);                    
                  ?>

                  <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt="" class="<?php echo $city; ?>"/>
                </div>

                        
                
                
              </div>
              <?php } ?>
              
            </div>
          </div>
         
          <?php /*
          <div class="col-md-2">
            <div class="side-right">
              <div class="google-adss">
                <!-- <img
                  class="img-fluid"
                  src="<?php echo theme_url()?>/img/banner/300x600_banner1.jpg"
                  alt=""
                /> -->                
                <!-- Vertical Big -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-8056224876401935"
                    data-ad-slot="4842786465"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
              </div>
            </div>
          </div>
          */ ?>

          
        </div>
        
        <?php /*
        <div class="row">
          <div class="col-md-9">
            <div class="google-ads-lb">
                <!-- Leaderboard1 -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-8056224876401935"
                    data-ad-slot="7884323717"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
          </div>
        </div>
         */ ?>
      </div>
    </section>

    <?php /*
    <section id="home-numberplate" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2><?php echo $this->lang->line('head_txt2');?></h2>
          </div>
        </div>

        <div class="row">
        <?php foreach($list_numberplates as $plate) { ?>
            <div class="col-md-3">
            <a href="<?php echo $this->common_model->getPlateUrl($plate['id'],$plate['numberplate_city'],$plate['city_code']) ?>">
                <div class="numberplate-cont">
                      <div class="preview-cont-wrapper">
                            <div class="preview-cont">
                              <ul class="list-inline">
                                <li class="list-inline-item code <?php echo ($plate['city_id']==1?'ad':''); ?>" id="codemb">
                                <?php echo $plate['citycode_id']==0?'<i class="fas fa-question"></i>':$plate['city_code'] ?>
                                </li>
                                <li class="list-inline-item city">
                                  <img class="img-fluid plate-city" src="<?php echo theme_url()?>img/<?php if($plate['city_id']==1){echo 'plate_abudhabi_default.png';} elseif($plate['city_id']==2){echo 'plate_ajman_default.png';} elseif($plate['city_id']==3){echo($plate['plate_type']=='dubai_new'?'Dubai.png':'plate_dubai_default.png');}elseif($plate['city_id']==4){echo 'plate_fujairah_default.png';}elseif($plate['city_id']==5){echo 'plate_uaq_default.png';}elseif($plate['city_id']==6){echo 'plate_rak_default.png';}elseif($plate['city_id']==7){echo 'plate_sharjah_default.png';}else{echo 'plate_dubai_default.png';}?>" data-abudhabi="<?php echo theme_url()?>img/plate_abudhabi_default.png"/> 
                                </li>
                                <li class="list-inline-item number" id="numbermb"><?php echo $plate['number']; ?></li>
                              </ul>                    
                            </div>
                      </div>
                      <div class="user-det">
                        <ul>
                          <li><h3>AED <?php echo number_format($plate['price']); ?></h3></li>
                          <li>
                            <div class="city-logo">
                              <?php 
                              $city = str_replace(" ", "-", $plate['user_city']);  ?>
                              <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt=""/>
                            </div>
                          </li>
                          <li></li>
                        </ul>
                      </div>
                </div>
                </a>
            </div>
        <?php } ?>
        </div>
      </div>
    </section>

    */ ?>

    <section id="top-brands" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2>
            <?php echo $this->lang->line('head_txt3');?>
            </h2>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="top-brands-lists">
              <ul class="list-inline brands_slide owl-carousel owl-theme">
              <?php foreach($list_make as $key => $make) { ?>
                <a href="<?php echo base_url()?>used-cars/<?php echo str_replace(" ", "-", $make['make']); ?>">
                <li class="item list-inline-item">
                  <div class="logo">
                    <?php if(!empty($make['images'])){ 
                        foreach($make['images'] as $img){
                          $image= $this->asset_model->getImage($img['image'],'100x100');
                    ?> 
                    <img src="<?php echo base_url_images().$image; ?>" alt="" />
                    <?php }} ?>
                  </div>
                  <div class="make-name">
                    <?php echo $this->uri->segment(1)=='ar'?$make['make_ar']:($this->uri->segment(1)=='cn'?$make['make_cn']:$make['make']); ?> <span>(<?php foreach($make['count'] as $key => $ct){
                        echo $ct;
                    } ?>)
                  </div>
                </li>
                </a>
              <?php } ?>
              </ul>
            </div>
          </div>
        </div>
       
      </div>
    </section>

    

    <section id="mobile-category">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="category-cont">
              <ul>
                  <a href="<?php echo base_url()?>used-cars">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/cars-01_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('cars');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_cars');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                   
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>numberplates">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/number_plate_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('number_plates');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_plate');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                   
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>boats">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/boat_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('boats');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_boats');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                    
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>bikes">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/bikes-01_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('bikes');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_bikes');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                  
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>mobilenumbers">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/mobile_number_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('mobile_numbers');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_mobilenums');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                   
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>dealers">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/dealers_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('car_dealers');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_dealres');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                    
                    </li>
                  </a>
                  <!-- <a href="<?php echo base_url()?>numberplates">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/number_plate_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('number_plates');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_plate');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                   
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>boats">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/boat_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('boats');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_boats');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                    
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>bikes">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/bikes-01_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('bikes');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_bikes');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                  
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>mobilenumbers">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/mobile_number_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('mobile_numbers');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_mobilenums');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                   
                    </li>
                  </a>
                  <a href="<?php echo base_url()?>dealers">
                    <li class="d-flex category">
                        <div class="icon">
                          <img src="<?php echo theme_url()?>img/icons/dealers_r.svg" alt=""/>
                        </div>
                        <div class="title-cont">
                          <div class="title"><?php echo $this->lang->line('car_dealers');?></div>
                          <div class="small-des"><?php echo $this->lang->line('mb_home_dealres');?></div>
                        </div>
                        <div class="arrow">
                          <?php if ($this->uri->segment(1) == 'ar') {?>
                            <i class="fas fa-chevron-left"></i>
                          <?php } else { ?>
                            <i class="fas fa-chevron-right"></i>
                          <?php } ?>
                        </div>                    
                    </li>
                  </a> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    

    <?php include('includes/footer.php');?>




    <?php echo $this->common_model->mobileDigitalLinkHome(); ?>

