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

    <section id="success-msg">
      <div class="container">
        <div class="row">
          <div class="col">
          <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 1) { echo $_SESSION["sess_alert"]; }?>        
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

<script>
  var url = document.URL;
var hash = url.substring(url.indexOf('#'));

$(".nav-pills").find("li a").each(function(key, val) {
    if (hash == $(val).attr('href')) {
        $(val).click();
    }
    
    $(val).click(function(ky, vl) {
        location.hash = $(this).attr('href');
    });
});
</script>

