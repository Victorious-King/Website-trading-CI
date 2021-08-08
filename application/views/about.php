<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('about');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="content-main">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p>
            DubaieEdition.com is UAE’s best classifieds website. DubaieEdition.com is designed to give you more control of the buying process and make finding a Cars, Bikes, Boats, Number plates and mobile numbers easier than ever before. We want to give our buyers and sellers more confidence to achieve the best and fairest deal possible. We have largest selection of Cars, Bikes, Boats, Number plates and mobile numbers inventory from dealers and private sellers.
            </p>

            <p>
              To advertise your Cars, Bikes, Boats, Number plates or mobile numbers with DubaieEdition.com <a href="<?php echo base_url()?>contact">click here</a> to contact us
            </p>

            <p>We are in social media</p>
                <ul class="social-links list-inline">
                  <li class="list-inline-item">
                    <a target="_blank" href="https://www.facebook.com/dubaiedition/"><i class="fab fa-facebook-square"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-instagram"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-twitter-square"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a href=""><i class="fab fa-youtube-square"></i></a>
                  </li>
                </ul>
          </div>
          <div class="col-md-6">
            <div class="abt-image">
              <img class="img-fluid" src="<?php echo theme_url()?>img/banner/about_banner.jpg" />
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php include('includes/footer.php');?>

