<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('contact');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="contact-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8">
                <div class="alert-msg error-msg">
                <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 1) { echo $_SESSION["sess_alert"];  }?>
                </div>
                <form method="post" action="<?php echo base_url()?>main/enqEmail">
                <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" placeholder="<?php echo $this->lang->line('name');?>" id="name" name="name" class="form-control" required="">
                      </div>
                      <div class="form-group">
                        <input type="text" placeholder="<?php echo $this->lang->line('email');?>" id="email" name="email" class="form-control" required="">
                      </div>
                      <div class="form-group">
                        <input type="text" placeholder="<?php echo $this->lang->line('contact');?>" id="contact" name="contact" class="form-control" required="">
                      </div>
                    </div>
                    <div class="col-md-6 txtarea">
                      <div class="form-group">
                        <textarea cols="12" rows="7" placeholder="<?php echo $this->lang->line('message');?>" id="message" name="message" class="form-control" required=""></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button class="btn"><?php echo $this->lang->line('send');?></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-4">
                <div class="contact-details">
                  <div class="contact">
                    <div class="d-flex">
                      <div class="icon">
                        <i class="fas fa-building"></i>
                      </div>
                      <div class="address">
                       <span>Emisa Art Production FZE LLC <br></span>
                       <span> P.O.Box 4422.<br></span>
                       <span> United Arab Emirates.</span>
                      
                      </div>
                    </div>
                    
                    
                    
                    </span>
                  </div>
                  <div class="contact">
                    <i class="fas fa-phone-alt"></i>
                    <span>+971 58 275 9235</span>
                  </div>
                  <div class="contact">
                    <i class="far fa-envelope"></i>
                    <span>sales@autotraders.ae</span>
                  </div>
                  <div class="contact">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Dubai, United Arab Emirates</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>






    <?php include('includes/footer.php');?>

