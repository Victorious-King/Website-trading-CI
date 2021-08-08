<?php include('includes/header.php');?>

<?php if (isset($_GET['st'])) {?>
  <section id="mobile-filters">
  
    <div class="row">
      <div class="col">
        <ul class="list-inline">
          <li class="list-inline-item dropdown">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-sort-amount-down-alt"></i> <?php echo $this->lang->line('sort');?>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              
              <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=on&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=lh&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=hl&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
            </div>
            
          </li>
          <a href="#" data-target="slide-out" class="sidenav-trigger">
            <li class="list-inline-item"><i class="fas fa-filter"></i> <?php echo $this->lang->line('filter');?></li>
          </a>
        </ul>
      </div>
      
    </div>

    <ul id="slide-out" class="sidenav collapsible collapsible-accordion">
      <div class="side-form-mobile">
        <?php include('includes/bike_search_mb.php');?>
      </div>        
    </ul>

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
                    <a href="<?php echo base_url()?>bikes"><?php echo $this->lang->line('bikes');?></a>
                  </li>
                  <?php if($this->uri->segment(2)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>bikes/<?php echo $this->uri->segment(2); ?>"><?php echo $this->uri->segment(2); ?></a>
                  </li>
                  <?php } ?>
                  <?php if($this->uri->segment(3)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <?php echo $this->uri->segment(3); ?>
                  </li>
                  <?php } ?>
                </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="list-cont" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-12">
          <?php include('includes/bike_search.php');?>
          </div>
          <div class="col-md-9 col-sm-12">
          <div class="row">
            <div class="col-md-8">
            <h1> <?php echo $this->uri->segment(1)=='ar'?$tag_contents['h1_tag_ar']:($this->uri->segment(1)=='cn'?$tag_contents['h1_tag_cn']:$tag_contents['h1_tag']); ?></h1>
            </div>
              <div class="col-md-4">
                    <div class="sort">
                      <ul class="list-inline">
                        <li class="list-inline-item dropdown">
                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort-amount-down-alt"></i> <?php echo $this->lang->line('sort_by');?>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            
                            <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=on&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=lh&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>bikes/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=hl&bike_make=<?php echo $this->input->get('bike_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
                          </div>
                          
                        </li>
                       
                      </ul>
                    </div>
              </div>
            </div>
            <?php foreach($list_bikes as $bike) { ?>
             
              <div class="row cars-cont">
                <div class="col-md-3">
                <a href="<?php echo $this->common_model->getBikeUrl($bike['id'],$bike['make']) ?>">
                
                  <div class="image">
                      <img
                        class="img-fluid"
                        src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($bike['image'],'300x225'); ?>"
                        alt=""
                      />
                  </div>
                  <?php if($bike['featured'] == 1){ ?>
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
                      <a href="<?php echo $this->common_model->getBikeUrl($bike['id'],$bike['make']) ?>">
                        <div class="title">
                          <h2><?php echo $bike['title']; ?></h2>
                        </div>
                        </a>
                        <!-- <div class="price">
                          <h3>AED <?php echo number_format($bike['price']); ?></h3>
                        </div> -->
                        <div class="features">
                          <ul class="list-inline">
                            <li class="list-inline-item">
                              <i class="fas fa-calendar-alt"></i> <?php echo $bike['year']; ?>
                            </li>                            
                            <li class="list-inline-item">
                            <i class="fas fa-flag"></i> <?php echo $bike['make']; ?>
                            </li>
                            
                          </ul>
                        </div>
                        <!-- <div class="desc">
                        <?php echo substr($bike['des'], 0, 120) ; ?> ...
                        </div>                         -->
                        
                      </div>                      
                    </div>
                    <div class="col-md-4">
                      
                      <div class="user-det">
                        <div class="price">
                          <h3>AED <?php echo number_format($bike['price']); ?></h3>
                        </div>
                        <div class="image-user">
                        <?php
                          if ($bike['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?> 
                         
                          <a href="<?php echo $this->common_model->getBikeDealerUrl($bike['pname_slug']) ?>">
                          
                          <?php if(!empty($bike['images'])){ 
                                                foreach($bike['images'] as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?> 

                          <img src="<?php echo base_url().$image; ?>" alt="" />

                          <?php }} ?>
                        
                        </a>                         
                          
                          <?php } ?>
                        </div>
                        <div class="user-name">
                          <h4><?php
                          if ($bike['code'] == 'P'){?>
                          Private car
                          <?} else { ?>
                            <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $bike['profile_name']);?>"><?php echo $bike['profile_name']; }?></a> 
                           </h4>
                        </div>
                        <div class="city-logo">
                            <?php 
                              $city = str_replace(" ", "-", $bike['city']);                    
                            ?>
                            <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt=""/>
                      </div>
                        <!-- <div class="user-contact">
                          <h5><i class="fas fa-phone-alt"></i> <?php echo $bike['mobile']; ?></h5>
                        </div> -->
                        <!-- <div class="viewmore-btn">
                          <a href="<?php echo $this->common_model->getBikeUrl($bike['id'],$bike['make']) ?>" class="btn">View more</a>
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

                    <?php echo $tag_contents['desc']; ?>
                  
                    
                  </div>
                </div>
            </div>
          </div>
        </div>
       
      </div>
    </section>

    <?php if(isset($_GET['st'])) {?>

      <section id="car-lists-mb">
        <div class="container">
          <?php foreach($list_bikes as $bike) { ?>
            <div class="row">
              <div class="col">
              <a href="<?php echo $this->common_model->getBikeUrl($bike['id'],$bike['make']) ?>">
                <div class="car-list-card d-flex">
                  <div class="image">
                        <div class="image">
                            <img
                              class="img-fluid"
                              src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($bike['image'],'300x225'); ?>"
                              alt="<?php echo $bike['year'].' '.($this->uri->segment(1) == 'ar' ? $bike['make_ar']:$bike['make']).' '.($this->uri->segment(1) == 'ar' ? $bike['model_ar']:$bike['model']) ?>"
                            />
                        </div>
                        <?php /* if($bike['featured'] == 1){ ?>
                          <div class="featured">  
                            <span><?php echo $this->lang->line('featured');?></span>
                          </div>
                        <?php } */ ?>                      
                  </div>
                  <div class="car-det">
                    <h2><?php echo substr($bike['title'], 0, 35) ; ?>...</h2>
                    
                    <div class="price-logo">
                        <div class="d-flex det-main-cont">
                            <div class="price-cont">
                              <div class="price">AED <?php echo number_format($bike['price']); ?></div>
                              <ul class="list-inline">
                                <li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo $bike['year']; ?></li>
                                <li class="list-inline-item"><i class="fas fa-motorcycle"></i></i> <?php echo $bike['make']; ?></li>
                              </ul>
                            </div>
                            <div class="city-logo">
                              <?php
                                if ($bike['code'] == 'P'){?>
                                <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                                <?} else { ?>  
                                <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $bike['profile_name']);?>">
                                <?php if(!empty($bike['images'])){ 
                                                      foreach($bike['images'] as $img){
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

      <section id="list-cont-mb">
          <div class="container">
            <div class="row">
              <div class="col">
                  <div class="make-lists-cont"> 
                                  <ul> 
                                  <a href="<?php echo base_url()?>bikes/?st=no&bike_make=&year_min=&year_max=&price_min=&price_max=&condition=">
                                  <li class="all-cars d-flex">
                                    <div class="title">
                                      <?php echo $this->lang->line('view_all_bikes');?> (<?php echo $total_bikes; ?>)
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
                                  
                                    <?php foreach($list_makes as $mk) { ?>
                                        <?php  if($mk['count']['ct']>0){ ?>    
                                          <a href="<?php echo base_url()?>boats/<?php echo str_replace(" ", "-", $mk['type']); ?>/?st=no&boat_type=<?php echo $mk['id']; ?>&boat_make=&year_min=&year_max=&price_min=&price_max=&length=&condition= ">
                                              <li class="d-flex">
                                              <?php /**/ ?>
                                                <div class="make-logo">
                                                    <?php $image = str_replace(" ", "-", $mk['make']); ?> 
                                                    <img src="<?php echo base_url_images()?>posted_images/bike_brand/<?php echo $image; ?>.png" alt="" />
                                                </div>
                                              
                                                <div class="make-name">
                                                  <?php echo $this->uri->segment(1)=='ar'?$mk['make']:$mk['make']; ?>
                                                  <span>(<?php foreach($mk['count'] as $key => $ct){
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
                                                  
                                    <?php } }?>
                                  </ul>
                              </div>
                      
              </div>
            </div>
          </div>
      </section>

    <?php } ?>


<?php include('includes/footer.php');?>

