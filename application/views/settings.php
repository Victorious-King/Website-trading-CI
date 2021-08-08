<?php include('includes/header.php');?>
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('account_settings');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="myaccount-main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
          <?php include('includes/user_menu.php');?>
          </div>
          <div class="col-md-9">
            <div class="settings-cont">
   

                    <?php if ($_GET['st'] == 1) { ?>
                            
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <?php  echo $_SESSION["sess_alert"]; ?> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                    <?php } ?> 

                    <?php if ($_GET['st'] == 2) { ?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <?php  echo $_SESSION["sess_alert"]; ?> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                          
                    <?php } ?>


            <div class="acc-btn-cont">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#editaccount" aria-expanded="false" aria-controls="editaccount">
                        <i class="fa fa-user" aria-hidden="true"></i> <?php echo $this->lang->line('personal_details');?>
                      </button>
                    </div>
                    <div class="collapse" id="editaccount">
                      <div class="well">
                        <!-- <form method="post" class="" action="<?php base_url()?>updateAccount" >  -->

                        <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>main/updateAccount" enctype="multipart/form-data">

                            <div class="">
                              <label><?php echo $this->lang->line('name');?></label>
                              <input class="form-control" id="title" type="text" name="pname" value="<?php echo $settings['pname']?>" placeholder="<?php echo $this->lang->line('name');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('address');?></label>
                              <input class="form-control" id="title" type="text" name="address" value="<?php echo $settings['address']?>" placeholder="<?php echo $this->lang->line('address');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('po_box');?></label>
                              <input class="form-control" id="title" type="text" name="postal" value="<?php echo $settings['postal']?>" placeholder="<?php echo $this->lang->line('po_box');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('telephone');?></label>
                              <input class="form-control" id="title" type="text" name="tel" value="<?php echo $settings['tel']?>" placeholder="<?php echo $this->lang->line('telephone');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('mobile');?></label>
                              <input class="form-control" id="title" type="text" name="mobile" value="<?php echo $settings['mobile']?>" placeholder="<?php echo $this->lang->line('mobile');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('fax');?></label>
                              <input class="form-control" id="title" type="text" name="fax" value="<?php echo $settings['fax']?>" placeholder="<?php echo $this->lang->line('fax');?>"/>
                            </div>

                            <div class="pass-btn-cont">
                              <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('update');?></button>                              
                            </div>
                          </form>
                      </div>
                    </div>

                    <hr>

                    <div class="acc-btn-cont">
                      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#changepassword" aria-expanded="false" aria-controls="changepassword">
                        <i class="fa fa-user-secret" aria-hidden="true"></i> <?php echo $this->lang->line('change_password');?>
                      </button>
                    </div>
                    <div class="collapse" id="changepassword">
                      <div class="well">
                         
                          <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>main/updatePassword" enctype="multipart/form-data">

                            <div class="">
                              <label><?php echo $this->lang->line('new_password');?></label>
                              <input class="form-control" id="title" type="password" name="password" value="" placeholder="<?php echo $this->lang->line('new_password');?>"/>
                            </div>

                            <div class="">
                              <label><?php echo $this->lang->line('confirm_new_password');?> </label>
                              <input class="form-control" id="title" type="password" name="passconf" value="" placeholder="<?php echo $this->lang->line('confirm_new_password');?>"/>
                            </div>

                            <div class="pass-btn-cont">
                              <button class="btn btn-primary"><?php echo $this->lang->line('update');?></button>                              
                            </div>
                          </form>
                      </div>
                    </div>


            </div>
          </div>
        </div>
      </div>
    </section>


<?php include('includes/footer.php');?>