<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Success
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

<section id="success-cont" class="showcase">
    <div class="container">     
      <div class="row">
        <div class="col">
          <div class="alert alert-success" role="alert">
            <p>Your AD has beeen posted successfully !</p>
            <p><a href="<?php echo base_url()?>postad">Click here</a> to post another AD</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include('includes/footer.php');?>