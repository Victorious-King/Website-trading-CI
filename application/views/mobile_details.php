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
                  <a href="<?php echo base_url()?>cars"><?php echo $this->lang->line('mobile_numbers');?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>mobilenumbers/<?php echo $this->uri->segment(3); ?>"><?php echo $this->uri->segment(3); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>mobilenumbers/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>"><?php echo $this->uri->segment(4); ?></a>
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
                  <?php echo $mobile['title']; ?>
                  </h1>
                </div>
                <div class="price">AED <?php echo number_format($mobile['price']); ?></div>

                <div class="mobilenumber-view-cont">
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
                </div>
                
                <div class="car-desc">
                  <p>
                  <?php echo $mobile['des']; ?>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="side-right sticky">
                  <div class="user-details-cont">
                    <div class="user-details">
                      <div class="logo">
                                            

                          <?php
                          if ($mobile['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?> 
                            <a href="<?php echo $this->common_model->getPlateDealerUrl($mobile['pname_slug']) ?>"> 
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
                          if ($mobile['code'] == 'P'){?>
                          Private car
                          <?} else { 
                           echo $mobile['profile_name']; }?></h3>
                      </div>
                      <div class="location">
                        <h4>
                          <i class="fas fa-map-marker-alt"></i> <?php echo $mobile['address']; ?> - <?php echo $mobile['user_city_post']; ?>
                        </h4>
                      </div>
                    </div>
                  </div>
                  <div class="user-contact">
                    <a class="btn" href="tel:<?php echo $mobile['mobile']; ?>">
                      <i class="fas fa-phone-alt"></i> <?php echo $mobile['mobile']; ?>
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
                <a href="sms://<?php echo $mobile['mobile']; ?>?body=I%20am%20interested%20on your%20car%20you%20have%20posted%20on%20DubaiEdition <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="btn"><i class="far fa-envelope"></i> Message Seller</a>
              </div>
              <div class="call-cont">
                <a href="tel:<?php echo $mobile['mobile']; ?>" class="btn"><i class="fas fa-phone-alt"></i> Call Seller</a>
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





