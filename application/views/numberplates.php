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
             
             <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=no&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=on&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=lh&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=hl&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
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
       <?php include('includes/numberplate_search_mb.php');?>
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
                    <?php echo $this->lang->line('number_plates');?>
                  </li>
                  
                </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="list-cont-plate" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-12">
          <?php include('includes/numberplate_search.php');?>
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
                            
                            <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=no&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=on&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=lh&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>numberplates/?st=hl&city_id=<?php echo $this->input->get('city_id'); ?>&citycode_id=<?php echo $this->input->get('citycode_id'); ?>&number=<?php echo $this->input->get('number'); ?>&digit=<?php echo $this->input->get('digit'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
                          </div>
                          
                        </li>
                      </ul>
                    </div>
              </div>
            </div>
            <div class="row plate-row">
              <?php foreach($list_numberplates as $plate) { ?>
              <div class="col-md-4 col-sm-6 col-xs-6">
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
    
    <?php if (isset($_GET['st'])) {?>
      <section id="plates-lists-mb">
        <div class="container">
          <div class="row">

            <?php foreach($list_numberplates as $plate) { ?>
              <div class="col-md-6">
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
          <div class="row">
                <div class="pagination-cont">
                  <div aria-label="Page navigation">
                          <?php echo $pagination ?>
                  </div>    
                </div>
            </div>
        </div>
      </section>
    <?php }else{ ?>
      <section id="list-cont-plate-mb">
      <div class="container">
        <div class="row">
          <div class="col">
          <div class="city-lists-cont"> 
                              <ul>    
                              <a href="<?php echo base_url()?>numberplates/?st=no&city_id=&citycode_id=&number=&digit=All">
                              <li class="all-cars d-flex">
                                <div class="title">
                                  <!-- <?php echo $this->lang->line('view_all_cars');?> (<?php echo $total_cars; ?>) -->
                                  <?php echo $this->lang->line('view_all_numberplates');?> (<?php echo $total_numberplates; ?>)
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
                                      <a href="<?php echo base_url()?>numberplates/?st=no&city_id=3&citycode_id=&number=&digit=All">
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/Dubai.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('dubai_numberplates_mb');?> <span>(<?php echo $dubai_ct; ?>)</span>
                                            </div>
                                            <div class="arrow">
                                              <?php if ($this->uri->segment(1) == 'ar') {?>
                                                <i class="fas fa-chevron-left"></i>
                                                <?php } else { ?>
                                                  <i class="fas fa-chevron-right"></i>
                                                <?php } ?>
                                            </div>
                                          </li> 
                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=1&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/Abu-Dhabi.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('abudhabi_numberplates');?> <span>(<?php echo $abudhabi_ct; ?>)</span>
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
                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=2&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/Ajman.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('ajman_numberplates');?> <span>(<?php echo $ajman_ct; ?>)</span>
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

                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=4&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/plate_fujairah_default.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('fujairah_numberplates');?> <span>(<?php echo $fujairah_ct; ?>)</span>
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

                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=5&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/uaq.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('uaq_numberplates');?> <span>(<?php echo $uaq_ct; ?>)</span>
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

                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=6&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/plate_rak_default.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('rak_numberplates');?> <span>(<?php echo $rak_ct; ?>)</span>
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

                                          <a href="<?php echo base_url()?>numberplates/?st=no&city_id=7&citycode_id=&number=&digit=All">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/Sharjah.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('sharjah_numberplates');?> <span>(<?php echo $sharjah_ct; ?>)</span>
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
                                  
                              </ul>
                          </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

    

    <?php if (isset($_GET['st'])) {?>
      
    <?php } ?>




<?php include('includes/footer.php');?>

