<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?php echo $this->lang->line('success');?>
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
          <div class="text-xs-center">
            <?php if(!empty($msg)) { echo $msg;}?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include('includes/footer.php');?>