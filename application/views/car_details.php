<?php include('includes/header.php');?>
<link rel="canonical" href="<?php echo base_url()?>used-cars/<?php echo str_replace(" ", "-", $car['make']); ?>/<?php echo str_replace(" ", "-", $car['model']); ?>" />

<link rel="stylesheet" href="<?php echo theme_url()?>css/lightgallery.min.css" />
<style>
.image_0 {
  display:block;
} 
.image_1,.image_2,.image_3,.image_4,.image_5,.image_6,.image_7,.image_8,.image_9,.image_10 {
  display:none;
} 

</style>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Product",
  "name" : "<?php echo $car['title']; ?>",
  "image" : "<?php echo base_url()?><?php echo $car['image']; ?>",
  "description" : "<?php echo $car['des']; ?>",
  "brand" : {
    "@type" : "Brand",
    "name" : "<?php echo $car['make']; ?>"
  },
  "offers" : {
    "@type" : "Offer",
    "price" : "<?php echo $car['price']; ?>",
    "availability" : "InStock",
    "priceCurrency" : "AED",
    "priceValidUntil" : "<?php echo $car['expiry']; ?>",
    "url" : "<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
  },  
  "sku" : "<?php echo $car['id']; ?>"
}
</script>



<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url()?>"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item" aria-current="page">
                  <a href="<?php echo base_url()?>used-cars"><?php echo $this->lang->line('cars');?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar')?$this->uri->segment(3):$this->uri->segment(2); ?>"><?php echo ($this->uri->segment(1) == 'ar' ? $car['make_ar']:($this->uri->segment(1) == 'cn' ? $car['make_cn']:$car['make']));?></a>
                </li>
                
                <li class="breadcrumb-item" aria-current="page">
                <a href="<?php echo base_url()?>used-cars/<?php echo ($this->uri->segment(1)=='ar')?$this->uri->segment(3):$this->uri->segment(2); ?>/<?php echo ($this->uri->segment(1)=='ar')?$this->uri->segment(4):$this->uri->segment(3); ?>"><?php echo ($this->uri->segment(1) == 'ar' ? $car['model_ar']:($this->uri->segment(1) == 'cn' ? $car['model_cn']:$car['model']));?></a>
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
                  <?php echo $car['title']; ?>
                  </h1>
                </div>
                <div class="ad-date">
                  <p><?php echo $this->lang->line('posted_on');?> <?php 
                  $new_date = date('F j, Y', strtotime($car['created_dt']));
                  echo $new_date ; ?></p>
                </div>
                <div class="price">AED <?php echo number_format($car['price']); ?></div>
              
                <div id="gallery" class="image-gallery gallery">
                  <div class="content">
                  <?php foreach($car['images'] as $key => $img){?>
                    <a
                      class="lightgallery item"
                      href="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'800x600'); ?>"
                    >
                      <img
                        src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'800x600'); ?>"
                        class="image_<?php echo $key; ?> img-fluid"
                        alt="<?php echo $car['year'].' '.($this->uri->segment(1) == 'ar' ? $car['make_ar']:$car['make']).' '.($this->uri->segment(1) == 'ar' ? $car['model_ar']:$car['model']) ?>"                      
                      />
                    </a>
                  <?php } ?>
                    
                  </div>

                  <div class="clear"></div>

                  <div class="thumbnail">
                    <ul class="list-inline">
                    <?php foreach($car['images'] as $key => $img){?>
                      <li class="list-inline-item">
                        <div class="thumb">
                          <a href="#" rel="<?php echo $key; ?>">
                            <img
                              class="img-fluid"
                              src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'300x225'); ?>"
                              id="thumb_<?php echo $key; ?>"
                              alt="<?php echo $car['year'].' '.($this->uri->segment(1) == 'ar' ? $car['make_ar']:$car['make']).' '.($this->uri->segment(1) == 'ar' ? $car['model_ar']:$car['model']) ?>"
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
                  <?php foreach($car['images'] as $key => $img){?>
                    <div class="item">
                      <div class="image">
                        <img
                          src="<?php echo $this->config->item('base_url_assets'); ?><?php echo $this->asset_model->getImage($img['image'],'800x600'); ?>"
                          alt="<?php echo $car['year'].' '.($this->uri->segment(1) == 'ar' ? $car['make_ar']:$car['make']).' '.($this->uri->segment(1) == 'ar' ? $car['model_ar']:$car['model']) ?>"
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
                        <span><div class="icon"><i class="fas fa-car"></i></div><?php echo $this->lang->line('make');?></span><span class="txt">
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['make_ar']:($this->uri->segment(1) == 'cn' ? $car['make_cn']:$car['make']));?>
                        </span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-car-side"></i></div><?php echo $this->lang->line('model');?></span><span class="txt">
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['model_ar']:($this->uri->segment(1) == 'cn' ? $car['model_cn']:$car['model']));?>
                        </span>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="detail-col">
                        <span><div class="icon"><i class="far fa-calendar-alt"></i></div><?php echo $this->lang->line('year');?></span><span class="txt"><?php echo $car['year']; ?></span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-tachometer-alt"></i></div><?php echo $this->lang->line('mileage');?></span><span class="txt"><?php echo number_format($car['mileage']); ?> Kms</span>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-truck-pickup"></i></div><?php echo $this->lang->line('body_type');?> </span><span>
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['body_type_ar']:($this->uri->segment(1) == 'cn' ? $car['body_type_cn']:$car['body_type']));?>
                        </span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-gas-pump"></i></div><?php echo $this->lang->line('fuel_type');?> </span><span>
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['fuel_type_ar']:($this->uri->segment(1) == 'cn' ? $car['fuel_type_cn']:$car['fuel_type']));?>
                        </span>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-car"></i></div><?php echo $this->lang->line('exterior_color');?> </span><span>
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['ex_color_ar']:($this->uri->segment(1) == 'cn' ? $car['ex_color_cn']:$car['ex_color']));?>
                        </span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-palette"></i></div><?php echo $this->lang->line('interior_color');?> </span><span>
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['in_color_ar']:($this->uri->segment(1) == 'cn' ? $car['in_color_cn']:$car['in_color']));?>
                        </span>
                      </div>
                    </li>
                    <li class="d-flex">
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-globe-africa"></i></div><?php echo $this->lang->line('specification');?> </span><span>
                        <?php echo ($this->uri->segment(1) == 'ar' ? $car['specs_ar']:($this->uri->segment(1) == 'cn' ? $car['specs_cn']:$car['specs']));?>
                        </span>
                      </div>
                      <div class="detail-col">
                        <span><div class="icon"><i class="fas fa-bars"></i></div>AD ID </span><span>AT<?php echo $car['id']; ?></span>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="car-desc">
                  <p>
                  <?php echo $car['des']; ?>
                  </p>
                </div>

                <div class="social-share">
                  <div class="d-flex">
                    <div class="text">
                    <?php echo $this->lang->line('share');?>: 
                    </div>
                    <div class="icons">
                      <ul class="list-inline">
                        <li class="list-inline-item">
                          <a target="_blank" rel="noopener" href="https://www.facebook.com/sharer.php?u=<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>"><i class="fab fa-facebook-square"></i></a>
                          
                        </li>
                        <li class="list-inline-item">
                          <a target="_blank" rel="noopener" href="https://api.whatsapp.com/send?text=AutoTraders%20-%20<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>"><i class="fab fa-whatsapp-square"></i></a>
                        </li>

                        <li class="list-inline-item">
                          <a target="_blank" rel="noopener" href="https://twitter.com/share?text=AutoTraders&amp;url=<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>"><i class="fab fa-twitter-square"></i></a>
                        </li> 

                        <li class="list-inline-item">
                          <a target="_blank" rel="noopener" href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode($this->common_model->getCarUrl($car['id'],$car['make'],$car['model'])).'&media='.urlencode($this->config->item('base_url_assets').str_replace('./','',$this->asset_model->getImage($car['images'][0]['image'],'800x600'))); ?>&amp;description=AutoTraders"><i class="fab fa-pinterest-square"></i></a>
                        </li>

                        

                    
                        
                        <!-- <li class="list-inline-item">
                          <a href=""><i class="icofont-instagram"></i></a>
                        </li> -->
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="fraud-warning alert-warning">
                  <p><i class="fas fa-exclamation-triangle"></i> <?php echo $this->lang->line('warning');?></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="side-right sticky">
                  <div class="user-details-cont">
                    <div class="user-details">
                      <div class="logo">
                          <?php
                          if ($car['code'] == 'P'){?>
                          <img src="<?php echo theme_url()?>/img/icons/user.png" alt="Private cars"/>
                          <?} else { ?>                           
                            <a href="<?php echo base_url()?><?php echo str_replace(" ", "-", $car['profile_name']);?>">
                          <?php if(!empty($car['img_logo'])){ 
                                                foreach($car['img_logo'] as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?> 

                            <img src="<?php echo base_url().$image; ?>" alt="" />

                          <?php }} ?>
                           </a>            
                          <?php } ?>
                      </div>
                      <div class="name">
                        <h3><?php
                          if ($car['code'] == 'P'){?>
                          Private car
                          <?} else { 
                           echo $car['profile_name']; }?></h3>
                      </div>
                      <div class="location">
                        <h4>
                          <i class="fas fa-map-marker-alt"></i> <?php echo $car['address']; ?> <?php echo $car['city']; ?>
                        </h4>
                      </div>
                    </div>
                  </div>
                  <div class="user-contact">
                    <a class="btn" href="tel:<?php echo $car['mobile']; ?>">
                      <i class="fas fa-phone-alt"></i> <?php echo $car['mobile']; ?>
                    </a>
                  </div>
                  <?php include('includes/contact_form.php');?>
                  <!-- <div class="contact-form">
                    <div class="form-cont">
                      <form action="">
                        <h3><?php echo $this->lang->line('contact_the_seller');?></h3>
                        <div class="form-group">
                          <label for="name"><?php echo $this->lang->line('name');?></label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="<?php echo $this->lang->line('enter_name');?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email"><?php echo $this->lang->line('email_address');?></label>
                          <input
                            name="email"
                            type="text"
                            class="form-control"
                            id="email"
                            placeholder="<?php echo $this->lang->line('enter_email_address');?>"
                          />
                          
                        </div>
                        <div class="form-group">
                          <label for="contact"><?php echo $this->lang->line('contact_number');?></label>
                          <input
                            type="text"
                            name="contact"
                            class="form-control"
                            id="contact"
                            placeholder="<?php echo $this->lang->line('enter_contact_number');?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="message"><?php echo $this->lang->line('message');?></label>
                          <textarea
                            name="message"
                            class="form-control"
                            id="message"
                            rows="3"
                          ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                        <?php echo $this->lang->line('send');?>
                        </button>
                      </form>
                    </div>
                  </div> -->
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
              
<a href="sms:<?php echo $car['mobile']; ?>;?&body=I%20am%20interested%20on your%20car%20you%20have%20posted%20on%20DubaiEdition <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" class="btn">
                <i class="far fa-envelope"></i> Message Seller</a>
              </div>
              <div class="call-cont">
                <a href="tel:<?php echo $car['mobile']; ?>" class="btn"><i class="fas fa-phone-alt"></i> Call Seller</a>
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
        <?php if ($this->uri->segment(1) == 'ar') {?>
        rtl:true,
        <?php } ?>
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







