<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('dealers');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="dealer-main">
      <div class="container">
        <div class="row">
          <?php foreach($list_dealers as $dealer) { ?>
            <div class="col-md-4">
              <div class="dealers-card">
                  <div class="dealer-header d-flex">
                      <div class="logo">                      
                        <?php foreach($dealer['images'] as $key => $img){?>
                            <img src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'170x173'); ?>" alt="" />    
                        <?php } ?> 
                      </div>
                      <div class="name-cont">
                        <div class="name">
                          <?php echo $dealer['pname']; ?>
                        </div>   
                        <div class="dealing-list">
                        
                          <?php echo $this->lang->line('we_dealing_in');?> : <?php echo str_replace(",", ", ", $dealer['user_type_lists']); ?>
                        </div>                     
                      </div>
                  </div>
                  <div class="dealer-det">
                    <p><?php echo substr($dealer['des'], 0, 120) ; ?>...</p>
                  </div>

                  <div class="listing">
                    <div class="listing-heading">
                      <?php echo $this->lang->line('total_listings');?>
                    </div>
                    <div class="listing-count">
                      <?php foreach($dealer['count'] as $key => $ct){
                            echo $ct;
                       } ?> 
                    </div>
                  </div>
                  <div class="view-profile-btn">
                  <?php if($dealer['user_type_lists']=="cars") { ?>
                  <!-- <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $dealer['pname']);?>" class="btn">View profile</a> -->
                  <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $dealer['pname']);?>" class="btn"><?php echo $this->lang->line('view_profile');?></a>
                  <?php }else{ ?>
                    <?php } ?>

                   
                  </div>
              </div>
            </div>
          <?php } ?>                
        </div>
      </div>
    </section>






    <?php include('includes/footer.php');?>

