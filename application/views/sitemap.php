<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                sitemap
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="sitemap">
      <div class="container">
        <div class="row">
          <div class="col">
            <ul class="main-menu">

              <div class="row">
                <div class="col-md-4">
                  <li>
                    <a href="<?php echo base_url()?>used-cars"><?php echo $this->lang->line('cars');?></a>
                        <ul class="sub-menu">
                                  <?php foreach($list_make as $key => $make) { ?>
                                      <?php if($make['count']['ct']>0){ ?>
                                            <li  class="<?php echo $key ?>"><a href="<?php echo base_url()?>used-cars/<?php echo strtolower(str_replace(" ", "-", $make['make'])); ?>"><?php echo $this->uri->segment(1)=='ar'?$make['make_ar']:$make['make']; ?></a> 
                                            
                                            <ul class="sub-menu">
                                              <?php foreach ($this->common_model->get_carmodels($make['id']) as $model) {?>
                                                  
                                                <a href="<?php echo base_url()?>used-cars/<?php echo strtolower(str_replace(" ", "-", $make['make'])); ?>/<?php echo strtolower(str_replace(" ", "-", $model['model'])); ?>">
                                                <li> <?php echo $this->uri->segment(1)=='ar'?$model['model_ar']:$model['model']; ?></li>
                                                </a>

                                              <?php } ?>
                                            </ul>
                                            </li>   
                                      <?php } ?>              
                                  <?php } ?>             
                                  
                        </ul>
                      </li>
                </div>
                <div class="col-md-4">
                    <li>
                    <a href="<?php echo base_url()?>"><?php echo $this->lang->line('home');?></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>numberplates"><?php echo $this->lang->line('number_plates');?></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>boats"><?php echo $this->lang->line('boats');?></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>bikes"><?php echo $this->lang->line('bikes');?></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>mobilenumbers"><?php echo $this->lang->line('mobile_numbers');?></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url()?>dealers"><?php echo $this->lang->line('car_dealers');?></a>
                    </li>
                 
                </div>
              </div>
              
              
              
            </ul>
          </div>
        </div>
      </div>
    </section>



    <?php include('includes/footer.php');?>

