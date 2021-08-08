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
             
             <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=no&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=on&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=lh&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

             <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=hl&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
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
       <?php include('includes/mobilenumber_search_mb.php');?>
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
                    <a href="<?php echo base_url()?>mobilenumbers"><?php echo $this->lang->line('mobile_numbers');?></a>
                  </li>
                  <!-- <?php if($this->uri->segment(2)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>cars/<?php echo $this->uri->segment(2); ?>"><?php echo $this->uri->segment(2); ?></a>
                  </li>
                  <?php } ?>
                  <?php if($this->uri->segment(3)){ ?>
                  <li class="breadcrumb-item" aria-current="page">
                  <?php echo $this->uri->segment(3); ?>
                  </li>
                  <?php } ?> -->
                </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="list-cont-mobilenumber" class="d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-12">
          <?php include('includes/mobilenumber_search.php');?>
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
                            
                            <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=no&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('newest_to_oldest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=on&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('oldest_to_newest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=lh&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('price_lowest_to_highest');?></a>

                            <a class="dropdown-item" href="<?php echo base_url()?>mobilenumbers/?st=hl&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>"><?php echo $this->lang->line('price_highest_to_lowest');?></a>
                          </div>
                          
                        </li>
                       
                      </ul>
                    </div>
              </div>
            </div>
            <div class="row mobilenumber-row">
              <?php foreach($list_mobilenumbers as $mobile) { ?>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <a href="<?php echo $this->common_model->getMobilenumberUrl($mobile['id'],$mobile['operator'],$mobile['operator_code']) ?>">
                <div class="mobilenumber-cont">
                      <div class="preview-cont-wrapper-mn">
                            <div class="preview-cont">
                              <ul class="list-inline">
                              <li class="list-inline-item city">
                                  <img class="img-fluid mob-operator" src="<?php echo theme_url()?>img/<?php if($mobile['operator']=='Du'){echo 'du_logo.png';} elseif($mobile['operator']=='Etisalat'){echo 'etisalat_logo.png';} elseif($mobile['operator']=='Virgin-Mobile'){echo 'virgin_logo.png';}else{echo 'du_logo.png';}?>" /> 
                                </li>
                                <?php
                                if($mobile['operator']=='Du'){
                                  $color = 'du-color';
                                }else if($mobile['operator']=='Etisalat'){
                                  $color = 'eti-color';
                                }else if($mobile['operator']=='Virgin-Mobile'){
                                  $color = 'vir-color';
                                }
                                //$color = (($mobile['operator']=='Du') ? 'du-color' : ($mobile['operator']=='Etisalat') ? 'eti-color' : 'vir-color');
                                ?>
                                <li class="list-inline-item code <?php echo $color; ?>" id="code"><?php echo $mobile['operator_code']; ?></li>
                                <li class="list-inline-item number <?php echo $color; ?>" id="number"><?php echo $mobile['number']; ?></li>
                              </ul>                    
                            </div>
                      </div>
                      <div class="user-det">
                        <ul>
                          <li><h3>AED <?php echo number_format($mobile['price']); ?></h3></li>
                          <li>
                            <div class="city-logo">
                              <?php 
                              $city = str_replace(" ", "-", $mobile['user_city']);  ?>
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
      <section id="mobilenumber-lists-mb">
        <div class="container">
          <div class="row">

          <?php foreach($list_mobilenumbers as $mobile) { ?>
              <div class="col-md-6">
              <a href="<?php echo $this->common_model->getMobilenumberUrl($mobile['id'],$mobile['operator'],$mobile['operator_code']) ?>">
                    <div class="mobilenumber-cont">
                      <div class="preview-cont-wrapper-mn">
                            <div class="preview-cont">
                              <ul class="list-inline">
                              <li class="list-inline-item city">
                                  <img class="img-fluid mob-operator" src="<?php echo theme_url()?>img/<?php if($mobile['operator']=='Du'){echo 'du_logo.png';} elseif($mobile['operator']=='Etisalat'){echo 'etisalat_logo.png';} elseif($mobile['operator']=='Virgin-Mobile'){echo 'virgin_logo.png';}else{echo 'du_logo.png';}?>" /> 
                                </li>
                                <?php
                                if($mobile['operator']=='Du'){
                                  $color = 'du-color';
                                }else if($mobile['operator']=='Etisalat'){
                                  $color = 'eti-color';
                                }else if($mobile['operator']=='Virgin-Mobile'){
                                  $color = 'vir-color';
                                }
                                //$color = (($mobile['operator']=='Du') ? 'du-color' : ($mobile['operator']=='Etisalat') ? 'eti-color' : 'vir-color');
                                ?>
                                <li class="list-inline-item code <?php echo $color; ?>" id="code"><?php echo $mobile['operator_code']; ?></li>
                                <li class="list-inline-item number <?php echo $color; ?>" id="number"><?php echo $mobile['number']; ?></li>
                              </ul>                    
                            </div>
                      </div>
                      <div class="user-det">
                        <ul>
                          <li><h3>AED <?php echo number_format($mobile['price']); ?></h3></li>
                          <li>
                            <div class="city-logo">
                              <?php 
                              $city = str_replace(" ", "-", $mobile['user_city']);  ?>
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
                              <a href="<?php echo base_url()?>mobilenumbers/<?php echo ($this->uri->segment(1)=='ar'?$this->uri->segment(3):$this->uri->segment(2)); ?>?st=no&operator=<?php echo $this->input->get('operator'); ?>&operator_code=<?php echo $this->input->get('operator_code'); ?>&number=<?php echo $this->input->get('number'); ?>">
                              <li class="all-cars d-flex">
                                <div class="title">                                 
                                  <?php echo $this->lang->line('view_all_mobilenumbers');?> (<?php echo $total_mobilenumbers; ?>)
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
                                      <a href="<?php echo base_url()?>mobilenumbers/Du?st=no&operator=Du&operator_code=&number=">
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/du_logo.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('du_mobilenumber_mb');?> <span>(<?php echo $du_ct; ?>)</span>
                                            </div>
                                            <div class="arrow">
                                              <?php if ($this->uri->segment(1) == 'ar') {?>
                                                <i class="fas fa-chevron-left"></i>
                                                <?php } else { ?>
                                                  <i class="fas fa-chevron-right"></i>
                                                <?php } ?>
                                            </div>
                                          </li> 
                                          <a href="<?php echo base_url()?>mobilenumbers/Etisalat?st=no&operator=Etisalat&operator_code=&number=">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/etisalat_logo.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('etisalat_mobilenumber_mb');?> <span>(<?php echo $etisalat_ct; ?>)</span>
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
                                          <a href="<?php echo base_url()?>mobilenumbers/Virgin-Mobile?st=no&operator=Virgin-Mobile&operator_code=&number=">  
                                          <li class="d-flex">
                                            <div class="make-logo">
                                                <img src="<?php echo theme_url()?>img/virgin_logo.png" alt="" />    
                                            </div>
                                            <div class="make-name">
                                            <?php echo $this->lang->line('virgin_mobilenumber_mb');?> <span>(<?php echo $virgin_ct; ?>)</span>
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

    


<?php include('includes/footer.php');?>

