<?php include('includes/header.php');?>

<style>
  video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}
</style>



<section id="dealer-cover">

  <?php foreach($dealer['images'] as $key => $img){?>
  <div class="img1" style="background-image: url('<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'1300x500'); ?>');"></div>
  <?php } ?>

          <div class="profile-img">
          <?php foreach($dealer['logo'] as $key => $img){?>
              <img src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'170x173'); ?>" alt="" />    
          <?php } ?>          
          </div>
          <div class="profile-name">
            <h3><?php echo $dealer['pname']; ?></h3>
          </div>
          

</section>

<section id="list-cont-plate">
      <div class="container">
        <div class="row">          
          <div class="col-md-12 col-sm-12">
            <div class="row plate-row">
              <?php foreach($list_numberplates as $plate) { ?>
              <div class="col-md-3 col-sm-6 col-xs-6">
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
        </div>
       
      </div>
    </section>



    <section id="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <div class="ads-adv">
              <h3>
                WANT TO SELL YOUR CAR?
              </h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="post-btn">
              <button class="btn btn-white">Post an AD for FREE</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include('includes/footer.php');?>

