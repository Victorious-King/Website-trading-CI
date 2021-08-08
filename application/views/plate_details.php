<?php include('includes/header.php');?>
<link rel="stylesheet" href="<?php echo theme_url()?>css/lightgallery.min.css" />
<style>
.image_0 {
  display:block;
} 
.image_1,.image_2,.image_3,.image_4,.image_5,.image_6,.image_7,.image_8,.image_9,.image_10 {
  display:none;
} 

</style>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>numberplates"><?php echo $this->lang->line('number_plates');?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>numberplates/<?php echo $this->uri->segment(3); ?>"><?php echo $this->uri->segment(3); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>numberplates/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>"><?php echo $this->uri->segment(4); ?></a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="details-main">
      <div class="container">
        <div class="row">
         
          <div class="col-md-12 col-sm-12">
            <div class="row">
              <div class="col-md-8 col-xs-12">
                <div class="title">
                  <h1>
                  <?php echo $plate['title']; ?>
                  </h1>
                </div>
                <div class="price">AED <?php echo number_format($plate['price']); ?></div>

                <div class="plate-view-cont">
                <div class="preview-cont-wrapper">
                            <div class="preview-cont">
                              <ul class="list-inline">
                                <li class="list-inline-item code <?php echo ($plate['city_id']==1?'ad':''); ?>" id="codemb"><?php echo $plate['citycode_id']==0?'<i class="fas fa-question"></i>':$plate['city_code'] ?></li>
                                <li class="list-inline-item city">
                                  <img class="img-fluid plate-city" src="<?php echo theme_url()?>img/<?php if($plate['city_id']==1){echo 'plate_abudhabi_default.png';} elseif($plate['city_id']==2){echo 'plate_ajman_default.png';} elseif($plate['city_id']==3){echo($plate['plate_type']=='dubai_new'?'Dubai.png':'plate_dubai_default.png');}elseif($plate['city_id']==4){echo 'plate_fujairah_default.png';}elseif($plate['city_id']==5){echo 'plate_uaq_default.png';}elseif($plate['city_id']==6){echo 'plate_rak_default.png';}elseif($plate['city_id']==7){echo 'plate_sharjah_default.png';}else{echo 'plate_dubai_default.png';}?>" data-abudhabi="<?php echo theme_url()?>img/plate_abudhabi_default.png"/> 
                                </li>
                                <li class="list-inline-item number" id="numbermb"><?php echo $plate['number']; ?></li>
                              </ul>                    
                            </div>
                      </div>
                </div>
                
                <div class="car-desc">
                  <p>
                  <?php echo $plate['des']; ?>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="side-right sticky">
                  <div class="user-details-cont">
                    <div class="user-details">
                      <div class="logo">
                                            

                          <?php
                          if ($plate['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?> 
                            <a href="<?php echo $this->common_model->getPlateDealerUrl($plate['pname_slug']) ?>"> 
                                            <?php if(!empty($assets_logo)){ 
                                                foreach($assets_logo as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?>                         
                                            <img src="<?php echo base_url().$image; ?>" alt="" /> 
                                            <?php }} ?>
                            </a>
                          <?php } ?>
                      </div>
                      <div class="name">
                        <h3><?php
                          if ($plate['code'] == 'P'){?>
                          Private car
                          <?} else { 
                           echo $plate['profile_name']; }?></h3>
                      </div>
                      <div class="location">
                        <h4>
                          <i class="fas fa-map-marker-alt"></i> <?php echo $plate['address']; ?> - <?php echo $plate['user_city_post']; ?>
                        </h4>
                      </div>
                    </div>
                  </div>
                  <div class="user-contact">
                    <a class="btn" href="tel:<?php echo $plate['mobile']; ?>">
                      <i class="fas fa-phone-alt"></i> <?php echo $plate['mobile']; ?>
                    </a>
                  </div>
                  <?php include('includes/contact_form.php');?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="sticky-footer">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="actbtn-cont">
              <div class="sms-cont">
                <a href="sms://<?php echo $plate['mobile']; ?>?body=I%20am%20interested%20on your%20car%20you%20have%20posted%20on%20DubaiEdition <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="btn"><i class="far fa-envelope"></i> Message Seller</a>
              </div>
              <div class="call-cont">
                <a href="tel:<?php echo $plate['mobile']; ?>" class="btn"><i class="fas fa-phone-alt"></i> Call Seller</a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section>

<?php include('includes/footer.php');?>

<script src="<?php echo theme_url()?>js/lightgallery.min.js"></script>
    <script src="<?php echo theme_url()?>js/simplegallery.min.js"></script>

    <script>
      $('.owl_gallery_main').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        navText: [
          '<i class="fa fa-angle-left" aria-hidden="true"></i>',
          '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        items: 1
      });

      $('.gallery').lightGallery({
        selector: '.lightgallery'
      });
      $(document).ready(function() {
        $('#gallery').simplegallery({
          galltime: 400, // transition delay
          gallcontent: '.content',
          gallthumbnail: '.thumbnail',
          gallthumb: '.thumb'
        });
      });
    </script>





