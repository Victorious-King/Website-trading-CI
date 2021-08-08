<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>      
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Boats</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Boats</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
				<div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add car make
                          </header>
                          <div class="panel-body">
                              <a href="<?php echo base_url();?>admin/brands/addMake" type="button" class="btn btn-primary btn-lg btn-block">Add car make</a>                              
                          </div>
                      </section> -->
                      <?php if ($_SESSION["sess_alert"] && $_GET['err'] == 1) { ?>
                            <div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <?php  echo $_SESSION["sess_alert"]; ?> 
                            </div>
                      <?php } ?> 

                      <section class="panel">
                          <header class="panel-heading">
                              Boats details
                          </header>
                          <form name="approval_form" method="post" action="<?php echo base_url() ?>admin/boats/approveBoats/"/>
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> ID</th>
                                 <th><i class="icon_calendar"></i> title</th>
                                 <th><i class="icon_calendar"></i> Year</th>
                                 <th><i class="icon_mail_alt"></i> Boat type</th>
                                 <th><i class="icon_calendar"></i> Make</th>                                   
                                 <th><i class="icon_mail_alt"></i> Price</th>                                 
                                 <th><i class="icon_mail_alt"></i> Created date</th>
                                  <th><i class="icon_mail_alt"></i> Created by</th>
                                  <th><i class="icon_mail_alt"></i> Mobile</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                                 
                              </tr>
                              <?php foreach($list_boats as $boat) { ?>
                              <tr>
                                 <td><?php echo $boat['id'];  ?></td>
                                 <td><?php echo $boat['title'];  ?></td>
                                 <td><?php echo $boat['year'];  ?></td>
                                 <td><?php echo $boat['type'];  ?></td>
                                 <td><?php echo $boat['make'];  ?></td>                                 
                                 <td><?php echo $boat['price'];  ?></td>                                 
                                 <td><?php echo $boat['created_dt'];  ?></td>
                                 <td><?php echo $boat['created_by'];  ?></td>
                                 <td><?php echo $boat['mobile'];  ?></td>

                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo base_url();?>admin/boats/editBoat/<?php echo $boat['id'];  ?>"><i class="fa fa-pencil-square-o"></i></i></a>                               
      
                                      <a class="btn btn-danger" href="<?php echo base_url();?>admin/boats/deleteBoat/<?php echo $boat['id'];  ?>"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr> 
                              <tr>
                                <td>
                                  <input type="checkbox" name="checked[]" value="<?php echo $boat['id']; ?>">
                                  <?php foreach ($boat['images']as $im) { ?>
                                        <div class="approve-image"  >
                                                <div class="approve_image_img example-image-link" href="<?php echo base_url() . $this->asset_model->getImage($im['image'], '700x386'); ?>" data-lightbox="example-set<?php echo $boat['id']; ?>">
                                                    <img class="approv_mobile"  src="<?php echo base_url() . $this->asset_model->getImage($im['image'], '300x225'); ?>" />
                                                </div>
                                                <a class="approve_image_text" alt="Approve image" href="<?php echo base_url() . 'admin/boats/approveImage/' . $im['id'] . ''; ?>/Car/<?php echo $boat['id']; ?>">Approve image</a>
                                                <br><br>
                                                <a class="image_delete" alt="Delete image" href="<?php echo base_url() . 'admin/boats/deleteImage/' . $im['id'] . ''; ?>/Car">Delete image (X)</a>
                                        </div>
                                  <?php } ?>
                                </td>
                              </tr>
                              <?php } ?>   

                              <tr><td colspan="9"><button type="submit" name="app_checked" class="btn btn-primary">Approve checked</button></td></tr>                                                       
                           </tbody>                          
                        </table> 
                        </form>                        
                      </section>
                      <?php echo $pagination?> 
                  </div>

                  

                  </div>
<?php include('includes/footeradmin.php');?>    