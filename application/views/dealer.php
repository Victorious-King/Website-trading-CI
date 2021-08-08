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
          <div class="social-user">
            <ul>
              <?php if($dealer['fb_handle']) {?>
              <li><a target="_blank" href="<?php echo $dealer['fb_link'] ?>"><img src="<?php echo theme_url()?>img/icons/fb_icon.svg" alt=""
                    /> <span><?php echo $dealer['fb_handle'] ?></span></a></li>
              <?php } ?>
              <?php if($dealer['insta_handle']) {?>
              <li><a target="_blank" href="<?php echo $dealer['insta_link'] ?>"><img src="<?php echo theme_url()?>img/icons/insta_icon.svg" alt=""
                    /> <span><?php echo $dealer['insta_handle'] ?></span></a></li>
              <?php } ?>
              <?php if($dealer['twt_handle']) {?>
              <a target="_blank" href="<?php echo $dealer['twt_link'] ?>"><li><img src="<?php echo theme_url()?>img/icons/twt_icon.svg" alt=""
                    /> <span><?php echo $dealer['twt_handle'] ?></span></li></a>
              <?php } ?>
            </ul>
          </div>
          

</section>

<section id="home-featured-side">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
            <div class="row">
            <?php foreach($list_cars as $car) { ?>
              <div class="col-md-3 col-sm-6 col-xs-6">
                
                <div class="car-listing">
                <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>">
                  <div class="image">
                    <img
                      class="img-fluid"
                      src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($car['image'],'300x225'); ?>"
                      alt=""
                    />
                  </div>
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
                </div>
                <div class="city-logo">
                  <?php 
                    $city = str_replace(" ", "-", $car['city']);                    
                  ?>

                  <img src="<?php echo theme_url()?>img/<?php echo $city; ?>.png" alt=""/>
                </div>
                
                
              </div>
            <?php } ?>
              
            </div>
          </div>
          <!-- <div class="col-md-3">
            <div class="side-right">
              
            </div>
          </div> -->
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

    <section id="google-location">
    
      <div id="map"></div>
  
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3O13i8ni_htZxfgGqpYUmq45-tyPda8g&callback=initMap"></script>

      <script>
        function initialize() {
          var myLatLng = {lat: <?php echo $dealer['lat']; ?>, lng: <?php echo $dealer['lng']; ?>};

          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: myLatLng
          });

          var contentString = '<b><?php echo $dealer['pname']; ?></b> - <?php echo $dealer['loc']; ?>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
          

          var marker = new google.maps.Marker({
            position: myLatLng,
            icon: '<?php echo $this->config->item('base_url_assets'); ?><?php echo $dealer['marker']; ?>',
            map: map,
            title: '<?php echo $dealer['pname']; ?>'
          });   
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });         
        }
        initialize();
        </script>
    </section>





    <?php include('includes/footer.php');?>

