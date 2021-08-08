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
                  <a href="<?php echo base_url()?>bikes"><?php echo $this->lang->line('bikes');?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>bikes/<?php echo $this->uri->segment(3); ?>"><?php echo $this->uri->segment(3); ?></a>
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
                  <?php echo $bike['title']; ?>
                  </h1>
                </div>
                <div class="price">AED <?php echo number_format($bike['price']); ?></div>
                <div id="gallery" class="image-gallery gallery">
                  <div class="content">
                  <?php foreach($bike['images'] as $key => $img){?>
                    <a
                      class="lightgallery item"
                      href="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'800x600'); ?>"
                    >
                      <img
                        src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'800x600'); ?>"
                        class="image_<?php echo $key; ?> img-fluid"
                        alt=""                      
                      />
                    </a>
                  <?php } ?>
                    
                  </div>

                  <div class="clear"></div>

                  <div class="thumbnail">
                    <ul class="list-inline">
                    <?php foreach($bike['images'] as $key => $img){?>
                      <li class="list-inline-item">
                        <div class="thumb">
                          <a href="#" rel="<?php echo $key; ?>">
                            <img
                              class="img-fluid"
                              src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'300x225'); ?>"
                              id="thumb_<?php echo $key; ?>"
                              alt=""
                            />
                          </a>
                        </div>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>

                 <div class="gallery-cont-mobile">
                  <div class="owl_gallery_main owl-carousel owl-theme">
                  <?php foreach($bike['images'] as $key => $img){?>
                    <div class="item">
                      <div class="image">
                        <img
                          src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'400x300'); ?>"
                          alt=""
                        />
                      </div>
                    </div>
                    <?php } ?>
                   
                  </div>
                </div> 

                <div class="car-det">
                  <ul class="car-det-list">
                    <li class="d-flex">
                      <div class="detail-col">
                        <span><div class="icon icn-bikemake"><img src="<?php echo theme_url()?>img/icons/bike_make.svg" alt=""
                    /> </div><?php echo $this->lang->line('make');?></span><span class="txt"><?php echo $bike['make']; ?></span>
                      </div>
                      <div class="detail-col">
                      <span><div class="icon"><i class="far fa-calendar-alt"></i></div><?php echo $this->lang->line('year');?> </span><span><?php echo $bike['year']; ?></span>
                      </div>
                    </li>
                    
                    
                    <li class="d-flex">
                    <div class="detail-col">
                        <span><div class="icon icn-bikecond"><img src="<?php echo theme_url()?>img/icons/bike_cond.svg" alt=""
                    /></div><?php echo $this->lang->line('condition');?></span><span class="txt"><?php echo $bike['condition']; ?></span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-bars"></i></div>AD ID</span><span class="txt">DEBK<?php echo $bike['id']; ?></span>
                      </div>
                       
                    </li>
                    
                  </ul>
                </div>

                <div class="car-desc">
                  <p>
                  <?php echo $bike['des']; ?>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="side-right sticky">
                  <div class="user-details-cont">
                    <div class="user-details">
                      <div class="logo">
                          <?php
                          if ($bike['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt=""/>
                          <?} else { ?>  

                            <?php if(!empty($assets_logo)){ 
                                                foreach($assets_logo as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?> 
                          <img src="<?php echo base_url().$image; ?>" alt="" /> 

                          <?php }} ?>

                          <?php } ?>
                      </div>
                      <div class="name">
                        <h3><?php
                          if ($bike['code'] == 'P'){?>
                          Private car
                          <?} else { 
                           echo $bike['profile_name']; }?></h3>
                      </div>
                      <div class="location">
                        <h4>
                          <i class="fas fa-map-marker-alt"></i> <?php echo $bike['address']; ?> <?php echo $bike['city']; ?>
                        </h4>
                      </div>
                    </div>
                  </div>
                  <div class="user-contact">
                    <a class="btn" href="tel:<?php echo $bike['mobile']; ?>">
                      <i class="fas fa-phone-alt"></i> <?php echo $bike['mobile']; ?>
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
                <a href="sms://<?php echo $bike['mobile']; ?>?body=I%20am%20interested%20on your%20car%20you%20have%20posted%20on%20DubaiEdition <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="btn"><i class="far fa-envelope"></i> Message Seller</a>
              </div>
              <div class="call-cont">
                <a href="tel:<?php echo $bike['mobile']; ?>" class="btn"><i class="fas fa-phone-alt"></i> Call Seller</a>
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





