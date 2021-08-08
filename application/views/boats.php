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
              
              <a class="dropdown-item" href="<?php echo base_url()?>boats/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>boats/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=on&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>boats/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=lh&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

              <a class="dropdown-item" href="<?php echo base_url()?>boats/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=hl&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
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
        <?php include('includes/boat_search_mb.php');?>
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
                    <a href="<?php echo base_url()?>boats"><?php echo $this->lang->line('boats');?></a>
                  </li>
                  <?php if($this->uri->segment(2)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>boats/<?php echo $this->uri->segment(2); ?>"><?php echo $this->uri->segment(2); ?></a>
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
          <?php include('includes/boat_search.php');?>
          </div>
          <div class="col-md-9 col-sm-12">
          <div class="row">
              <div class="col-md-8">
              <h1> <?php echo $this->uri->segment(1)=='ar'?$tag_contents['h1_tag_ar']:($this->uri->segment(1)=='cn'?$tag_contents['h1_tag_cn']:$tag_contents['h1_tag']); ?></h1>
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
                            
                            <a class="dropdown-item" href="<?php echo base_url()?>boats/?st=no&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>boats/?st=on&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>boats/?st=lh&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>boats/?st=hl&boat_type=<?php echo $this->input->get('boat_type'); ?>&boat_make=<?php echo $this->input->get('boat_make'); ?>&year_min=<?php echo $this->input->get('year_min'); ?>&year_max=<?php echo $this->input->get('year_max'); ?>&price_min=<?php echo $this->input->get('price_min'); ?>&price_max=<?php echo $this->input->get('price_max'); ?>&length=<?php echo $this->input->get('length'); ?>&condition=<?php echo $this->input->get('condition'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
                          </div>
                          
                        </li>
                      </ul>
                    </div>
              </div>
            </div>
            <?php foreach($list_boats as $boat) { ?>
             
              <div class="row cars-cont">
                <div class="col-md-3">
                <a href="<?php echo $this->common_model->getBoatUrl($boat['id'],$boat['type'],$boat['make']) ?>">
                
                  <div class="image">
                      <img
                        class="img-fluid"
                        src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($boat['image'],'300x225'); ?>"
                        alt=""
                      />
                  </div>
                  <?php if($boat['featured'] == 1){ ?>
                    <div class="featured">  
                      <span>Featured</span>
                    </div>
                  <?php } ?>
                </a>
                </div>
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="car-desc">
                      <a href="<?php echo $this->common_model->getBoatUrl($boat['id'],$boat['type'],$boat['make']) ?>">
                        <div class="title">
                          <h2><?php echo $boat['title']; ?></h2>
                        </div>
                        </a>
                        <!-- <div class="price">
                          <h3>AED <?php echo number_format($boat['price']); ?></h3>
                        </div> -->
                        <div class="features">
                          <ul class="list-inline">
                            <li class="list-inline-item">
                              <i class="fas fa-calendar-alt"></i> <?php echo $boat['year']; ?>
                            </li>
                            <li class="list-inline-item">
                            <i class="fas fa-ship"></i> <?php echo $boat['type']; ?>
                            </li>
                            <li class="list-inline-item">
                            <i class="fas fa-flag"></i> <?php echo $boat['make']; ?>
                            </li>
                            
                          </ul>
                        </div>
                        <!-- <div class="desc">
                        <?php echo substr($boat['des'], 0, 120) ; ?> ...
                        </div>                         -->
                        <div class="badges">
                        <?php if($boat['badges']){ ?>
                            <ul class="list-inline">
                            <?php 
                            $type = explode(',', $boat['badges']);
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
                          <h3>AED <?php echo number_format($boat['price']); ?></h3>
                        </div>
                        <div class="image-user">
                        <?php
                          if ($boat['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?> 
                         
                          <a href="<?php echo $this->common_model->getBoatDealerUrl($boat['pname_slug']) ?>">
                          
                          <?php if(!empty($boat['images'])){ 
                                                foreach($boat['images'] as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?> 

                          <img src="<?php echo base_url().$image; ?>" alt="" />

                          <?php }} ?>
                        
                        </a>                         
                          
                          <?php } ?>
                        </div>
                        <div class="user-name">
                          <h4><?php
                          if ($boat['code'] == 'P'){?>
                          Private car
                          <?} else { ?>
                            <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $boat['profile_name']);?>"><?php echo $boat['profile_name']; }?></a> 
                           </h4>
                        </div>
                        <div class="city-logo">
                            <?php 
                              $city = str_replace(" ", "-", $boat['city']);                    
                            ?>
                            <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt=""/>
                      </div>
                        <!-- <div class="user-contact">
                          <h5><i class="fas fa-phone-alt"></i> <?php echo $boat['mobile']; ?></h5>
                        </div> -->
                        <!-- <div class="viewmore-btn">
                          <a href="<?php echo $this->common_model->getBoatUrl($boat['id'],$boat['type'],$boat['make']) ?>" class="btn">View more</a>
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
          <?php foreach($list_boats as $boat) { ?>
            <div class="row">
              <div class="col">
              <a href="<?php echo $this->common_model->getBoatUrl($boat['id'],$boat['type'],$boat['make']) ?>">
                <div class="car-list-card d-flex">
                  <div class="image">
                        <div class="image">
                            <img
                              class="img-fluid"
                              src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($boat['image'],'300x225'); ?>"
                              alt="<?php echo $boat['year'].' '.($this->uri->segment(1) == 'ar' ? $boat['make_ar']:$boat['make']).' '.($this->uri->segment(1) == 'ar' ? $boat['model_ar']:$boat['model']) ?>"
                            />
                        </div>
                        <?php /* if($boat['featured'] == 1){ ?>
                          <div class="featured">  
                            <span><?php echo $this->lang->line('featured');?></span>
                          </div>
                        <?php } */ ?>                      
                  </div>
                  <div class="car-det">
                    <h2><?php echo substr($boat['title'], 0, 35) ; ?>...</h2>
                    
                    <div class="price-logo">
                        <div class="d-flex det-main-cont">
                            <div class="price-cont">
                              <div class="price">AED <?php echo number_format($boat['price']); ?></div>
                              <ul class="list-inline">
                                <li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo $boat['year']; ?></li>
                                <li class="list-inline-item"><i class="fas fa-tachometer-alt"></i> <?php echo $boat['type']; ?></li>
                              </ul>
                            </div>
                            <div class="city-logo">
                              <?php
                                if ($boat['code'] == 'P'){?>
                                <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                                <?} else { ?>  
                                <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $boat['profile_name']);?>">
                                <?php if(!empty($boat['images'])){ 
                                                      foreach($boat['images'] as $img){
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
                                  <a href="<?php echo base_url()?>boats/?st=no&boat_type=&boat_make=&year_min=&year_max=&price_min=&price_max=&length=&condition=">
                                  <li class="all-cars d-flex">
                                    <div class="title">
                                      <?php echo $this->lang->line('view_all_boats');?> (<?php echo $total_boats; ?>)
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
                                  
                                    <?php foreach($list_types as $ty) { ?>
                                        <?php /* if($model['count']['ct']>0){ ?><?php } */ ?>    
                                          <a href="<?php echo base_url()?>boats/<?php echo str_replace(" ", "-", $ty['type']); ?>/?st=no&boat_type=<?php echo $ty['id']; ?>&boat_make=&year_min=&year_max=&price_min=&price_max=&length=&condition= ">
                                              <li class="d-flex">
                                              <div class="make-logo">
                                                    <?php $image = str_replace(" ", "-", $ty['type']); ?> 
                                                    <img src="<?php echo theme_url()?>img/<?php echo $image; ?>.png" alt="" />
                                                  
                                                </div>
                                                <div class="make-name">
                                                  <?php echo $this->uri->segment(1)=='ar'?$ty['type']:$ty['type']; ?>
                                                  <span>(<?php foreach($ty['count'] as $key => $ct){
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
                                  </ul>
                              </div>
                      
              </div>
            </div>
          </div>
      </section>

    <?php } ?>

   




<?php include('includes/footer.php');?>

