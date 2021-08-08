<?php include('includes/header.php');?>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  Login
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="loginreg-main">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="loginreg-cont">
              <div class="row">
                <div class="col-md-4 col-sm-6">
                      <div class="login-cont">
                      <form method="post" class="" action="<?php echo base_url()?>main/register">
                          <div class="error-msg">
                          <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 2) { echo $_SESSION["sess_alert"];  }?>
                          </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="text"
                                placeholder="Email"
                                name="email"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="Password"
                                name="password"
                              />
                            </div>
                            <div class="">
                              <input
                                class="form-control"
                                type="password"
                                placeholder="Confirm password"
                                name="passconf"
                              />
                            </div>
                            <div class="">
                              <button class="btn btn-primary btn-md">
                                Register
                              </button>
                            </div>
                          </form>
                        </div>
                 
                </div>
              </div>
            </div>
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

