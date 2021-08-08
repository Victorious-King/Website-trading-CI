<?php include('includes/header.php');?>

<?php if($car_make_url && $car_model_url) { ?>  
  <link rel="canonical" href="<?php echo base_url()?>used-cars/<?php echo str_replace(" ", "-", $c_make); ?>/<?php echo str_replace(" ", "-", $c_model); ?>" />
<?php } else if($car_make_url){ ?>
  <link rel="canonical" href="<?php echo base_url()?>used-cars/<?php echo str_replace(" ", "-", $c_make); ?>" />
<?php } else { ?>
  <link rel="canonical" href="<?php echo base_url()?>used-cars" />
<?php } ?>


<?php if (($car_model_url) || (isset($_GET['st']))) {?>

 <section id="mobile-filters">
  
    <div class="row">
      <div class="col">
        <ul class="list-inline">
          <li class="list-inline-item dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-sort-amount-down-alt"></i> <?php echo $this->lang->line('sort');?>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              
              <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=on&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=lh&&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=hl&&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
            </div>
            
          </li>
          <!-- <a href="#" data-target="slide-out" class="sidenav-trigger">
            <li class="list-inline-item"><i class="fas fa-filter"></i> <?php echo $this->lang->line('filter');?></li>
          </a> -->
          <!-- <a href="#" data-target="slide-out" class="sidenav-trigger">
            <li class="list-inline-item"><i class="fas fa-filter"></i> <?php echo $this->lang->line('filter');?></li>
          </a> -->
          <li id="filter-btn" class="list-inline-item"><button><i class="fas fa-filter"></i> <?php echo $this->lang->line('filter');?></button></li>
        </ul>
      </div>
      
    </div>




    <div id="slide-out">
      <div class="overlay">
        <div class="form-cont">
          <div class="side-form-mobile">
            <?php include('includes/car_search_mb.php');?>
          </div>    

        </div>
        
      </div>
    </div>
    

    <style>

    </style>

    <script>
      $("#filter-btn button").click(function() {
          $(".overlay").addClass("active");
      });

      $(".overlay button").click(function() {
          $(".overlay").removeClass("active");
      });
    </script>

</section> 
<?php } ?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home');?></a></li>
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="<?php echo base_url()?>used-cars"><?php echo $this->lang->line('cars');?></a>
                  </li>
                  <?php if($this->uri->segment(2)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>used-cars/<?php echo $this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2); ?>"><?php echo $this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2); ?></a>
                  </li>
                  <?php } ?>
                  <?php if($this->uri->segment(3)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <?php echo $this->uri->segment(1)=='ar'?$this->uri->segment(4):$this->uri->segment(3); ?>
                  </li>
                  <?php } ?>
                </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    

    <section class="d-none d-lg-block" id="list-cont">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-12">
          <?php include('includes/car_search.php');?>
          </div>
          <div class="col-md-9 col-sm-12">
            <div class="row">
              <div class="col-md-8">
                <h1>
                
                  <?php if($car_model_url && $car_make_url)  {?>                    
                    <?php echo $this->uri->segment(1)=='ar'?$tag_contents_model['h1_tag']:$tag_contents_model['h1_tag']; ?>
                  <?php }else if($car_make_url) {?>
                    <?php echo $this->uri->segment(1)=='ar'?$tag_contents_make['h1_tag']:$tag_contents_make['h1_tag']; ?>
                    <?php }else{?>
                    <?php echo $this->uri->segment(1)=='cn'?$contents['h1_tag_cn']:($this->uri->segment(1)=='ar'?$contents['h1_tag_ar']:$contents['h1_tag']); ?>
                  <?php }?>
                  <?php /* if ($this->input->get('city') == 'Dubai') {
                    echo $this->lang->line('used_cars_sale_dubai');
                  } else if ($this->input->get('city') == 'Abu-Dhabi') {
                    echo $this->lang->line('used_cars_sale_abudhabi');
                  } else if ($this->input->get('city') == 'Sharjah') {
                    echo $this->lang->line('used_cars_sale_sharjah');
                  } else if ($this->input->get('city') == 'Ajman') {
                    echo $this->lang->line('used_cars_sale_ajman');
                  } else if ($this->input->get('city') == 'Fujairah') {
                    echo $this->lang->line('used_cars_sale_fujairah');
                  } else if ($this->input->get('city') == 'Umm-Al-Quwain') {
                    echo $this->lang->line('used_cars_sale_uaq');
                  } else if ($this->input->get('city') == 'Ras-Al-Khaimah') {
                    echo $this->lang->line('used_cars_sale_rak');
                  } else if ($this->input->get('city') == 'Al-Ain') {
                    echo $this->lang->line('used_cars_sale_alain');
                  } else{
                    echo $this->lang->line('used_cars_sale_dubai');
                  } */
                  ?>
                </h1>
              </div>
              <div class="col-md-4">
                    <div class="sort">
                      <ul class="list-inline">
                        <!-- <li class="list-inline-item">
                          <span><?php echo $this->lang->line('sort_by');?></span>
                        </li> -->
                        <li class="list-inline-item dropdown">
                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort-amount-down-alt"></i> <?php echo $this->lang->line('sort_by');?>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            
                            <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=on&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=lh&&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=hl&&city=<?php echo $this->input->get('city'); ?>&condition=<?php echo $this->input->get('condition'); ?>&car_make=<?php echo $this->input->get('car_make'); ?>&car_model=<?php echo $this->input->get('car_model'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
                          </div>
                          
                        </li>
                      </ul>
                    </div>
              </div>
            </div>
            <?php if($car_make_url) { ?>
              <div class="row">
                <div class="col make_all_col">
                    <div class="make-lists-cont"> 
                        <ul class = "limheight">                        
                          <?php foreach($list_model as $model) { ?>
                              <?php if($model['count']['ct']>0){ ?>
                                    <li><a href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar'|| $this->uri->segment(1)=='cn')?str_replace(" ", "-", $this->uri->segment(3)):str_replace(" ", "-", $this->uri->segment(2)); ?>/<?php echo strtolower(str_replace(" ", "-", $model['model'])); ?>"><?php echo $this->uri->segment(1)=='ar'?$model['model_ar']:($this->uri->segment(1)=='cn'?$model['model_cn']:$model['model']); ?></a> <span>(<?php foreach($model['count'] as $key => $ct){
                                      echo $ct;
                                } ?>)</span></li>   
                              <?php } ?>              
                          <?php } ?>
                        </ul>
                    </div>
                    
                    
                    
                    <div class="show-all-btn">
                      <a href="#" class="js_toggle"><?php echo $this->lang->line('show_all');?></a>
                    </div>
                </div>
              </div>
            <?php } else { ?>
              <div class="row">
                <div class="col make_all_col">
                    <div class="make-lists-cont"> 
                        <ul class = "limheight">                        
                          <?php foreach($list_make as $key => $make) { ?>
                              <?php if($make['count']['ct']>0){ ?>
                                    <li  class="<?php echo $key ?>"><a href="<?php echo base_url()?>used-cars/<?php echo strtolower(str_replace(" ", "-", $make['make'])); ?>"><?php echo $this->uri->segment(1)=='ar'?$make['make_ar']:($this->uri->segment(1)=='cn'?$make['make_cn']:$make['make']); ?></a> <span>(<?php foreach($make['count'] as $key => $ct){
                                      echo $ct;
                                } ?>)</span></li>   
                              <?php } ?>              
                          <?php } ?>
                        </ul>
                    </div>
                    
                    <div class="show-all-btn">
                      <a href="#" class="js_toggle"><?php echo $this->lang->line('show_all');?></a>
                    </div>
                </div>
              </div>
            <?php } ?>
            
            <?php foreach($list_cars as $car) { ?>
             
              <div class="row cars-cont">
                <div class="col-md-3">
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
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="car-desc">
                      <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>">
                        <div class="title">
                          <h2><?php echo $car['title']; ?></h2>
                        </div>
                        </a>
                        <!-- <div class="price">
                          <h3>AED <?php echo number_format($car['price']); ?></h3>
                        </div> -->
                        <div class="features">
                          <ul class="list-inline">
                            <li class="list-inline-item">
                              <i class="fas fa-calendar-alt"></i> <?php echo $car['year']; ?>
                            </li>
                            <li class="list-inline-item">
                              <i class="fas fa-tachometer-alt"></i><?php echo number_format($car['mileage']); ?> Kms
                            </li>
                            
                            
                          </ul>
                        </div>
                        <!-- <div class="desc">
                        <?php echo substr($car['des'], 0, 120) ; ?> ...
                        </div>                         -->
                        <div class="badges">
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
                         
                        </div>
                      </div>                      
                    </div>
                    <div class="col-md-4">
                      
                      <div class="user-det">
                        <div class="price">
                          <h3>AED <?php echo number_format($car['price']); ?></h3>
                        </div>
                        <div class="image-user">
                        <?php
                          if ($car['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?>  
                          <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $car['profile_name']);?>">
                          <?php if(!empty($car['images'])){ 
                                                foreach($car['images'] as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?> 

                          <img src="<?php echo base_url().$image; ?>" alt="" />

                          <?php }} ?>
                           </a>                         
                          
                          <?php } ?>
                        </div>
                        <div class="user-name">
                          <h4><?php
                          if ($car['code'] == 'P'){?>
                          Private car
                          <?} else { ?>
                            <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $car['profile_name']);?>"><?php echo $car['profile_name']; }?></a> 
                           </h4>
                        </div>
                        <div class="city-logo">
                            <?php 
                              $city = str_replace(" ", "-", $car['city']);                    
                            ?>
                            <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt="" class="<?php echo $city; ?>"/>
                      </div>
                        <!-- <div class="user-contact">
                          <h5><i class="fas fa-phone-alt"></i> <?php echo $car['mobile']; ?></h5>
                        </div> -->
                        <!-- <div class="viewmore-btn">
                          <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>" class="btn">View more</a>
                        </div> -->
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>

              <span class="line"></span>

              
              
              
            <?php } ?>

            <div class="row">
                <div class="pagination-cont">
                  <div aria-label="Page navigation">
                          <?php echo $pagination ?>
                  </div>    
                </div>
            </div>
            <div class="row">
                <div class="col">
                  <div class="sg-contents">

                  <?php if($car_model_url && $car_make_url)  {?>
                    <?php echo $tag_contents_model['desc']; ?>
                  <?php } else if($car_make_url)  {?>
                    <?php echo $tag_contents_make['desc']; ?>
                  <?php }else {?>
                    <?php echo $contents['desc']; ?>
                  <?php }?>
                    
                  </div>
                </div>
            </div>

          </div>
        </div>
       
      </div>
    </section>

   
    
    <?php if(($car_model_url) || (isset($_GET['st']))) {?>
      
    <?php } else { ?>
      <section id="list-cont-mb">
            <div class="container">
              <div class="row">
                <div class="col">
                  <?php if($car_make_url) { ?>
                    <div class="make-lists-cont"> 
                              <ul> 
                              <a href="<?php echo base_url()?>used-cars/?st=no&city=&condition=&car_make=<?php echo $car['make_id'] ?>&car_model=&year_min=&year_max=&price_min=&price_max=">
                              <li class="all-cars d-flex">
                                <div class="title">
                                  <?php echo $this->lang->line('view_all');?> <?php echo ($this->uri->segment(1)=='ar'?$car['make_ar']:$car['make']);?> (<?php echo $total_cars; ?>)
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
                                <?php foreach($list_model as $model) { ?>
                                    <?php if($model['count']['ct']>0){ ?>
                                      <a href="<?php echo base_url()?>used-cars/<?php echo $this->uri->segment(1)=='ar'?str_replace(" ", "-", $this->uri->segment(3)):str_replace(" ", "-", $this->uri->segment(2)); ?>/<?php echo strtolower(str_replace(" ", "-", $model['model'])); ?>">
                                          <li class="d-flex">
                                            <div class="make-name">
                                              <?php echo $this->uri->segment(1)=='ar'?$model['model_ar']:($this->uri->segment(1)=='cn'?$model['model_cn']:$model['model']); ?>
                                              <span>(<?php foreach($model['count'] as $key => $ct){
                                              echo $ct;} ?>)</span>
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
                                    <?php } ?>              
                                <?php } ?>
                              </ul>
                          </div>
                  <?php } else { ?>
                    <div class="make-lists-cont"> 
                              <ul>    
                              <a href="<?php echo base_url()?>used-cars/?st=no&city=&condition=&car_make=&car_model=&year_min=&year_max=&price_min=&price_max=">
                              <li class="all-cars d-flex">
                                <div class="title">
                                  <?php echo $this->lang->line('view_all_cars');?> (<?php echo $total_cars; ?>)
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
                                <?php foreach($list_make as $key => $make) { ?>
                                    <?php if($make['count']['ct']>0){ ?>
                                      <a href="<?php echo base_url()?>used-cars/<?php echo strtolower(str_replace(" ", "-", $make['make'])); ?>">
                                          <li class="d-flex">
                                            <div class="make-logo">
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
                                      } ?>)</span>
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
                                    <?php } ?>              
                                <?php } ?>
                              </ul>
                          </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </section>
    <?php } ?>


   
    
    <?php if(($car_model_url) || (isset($_GET['st']))) {?>
      <section id="car-lists-mb">
        <div class="container">
          <?php foreach($list_cars as $car) { ?>
            <div class="row">
              <div class="col">
              <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>">
                <div class="car-list-card d-flex">
                  <div class="image">
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
                  </div>
                  <div class="car-det">
                    <h2><?php echo substr($car['title'], 0, 35) ; ?>...</h2>
                    
                    <div class="price-logo">
                        <div class="d-flex det-main-cont">
                            <div class="price-cont">
                              <div class="price">AED <?php echo number_format($car['price']); ?></div>
                              <ul class="list-inline">
                                <li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo $car['year']; ?></li>
                                <li class="list-inline-item"><i class="fas fa-tachometer-alt"></i> <?php echo number_format($car['mileage']); ?> KMS</li>
                              </ul>
                            </div>
                            <div class="city-logo">
                              <?php
                                if ($car['code'] == 'P'){?>
                                <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                                <?} else { ?>  
                                <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $car['profile_name']);?>">
                                <?php if(!empty($car['images'])){ 
                                                      foreach($car['images'] as $img){
                                                      $image= $this->asset_model->getImage($img['image'],'170x173');
                                                  ?> 

                                <img src="<?php echo base_url().$image; ?>" alt="" />

                                <?php }} ?>
                                </a>                         
                                
                                <?php } ?>
                            </div>
                          </div>
                        </div>
                    </div>
                    

                    
                  
                </div>
              </a>
              </div>
            </div>
          <?php } ?>
          <div class="row">
                <div class="pagination-cont">
                  <div aria-label="Page navigation">
                          <?php echo $pagination ?>
                  </div>    
                </div>
            </div>
        </div>
      </section>
    <?php } else { ?>
      
    <?php } ?>



<?php include('includes/footer.php');?>

<script>
  $( document ).ready(function() {

    $('.js_toggle').on('click', function(event) {
     
        $('.limheight').toggleClass('full-table');
        
        event.preventDefault();
    });

  });
  </script>


