<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>      
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Makes</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Makes</li>						  	
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
                              Make lists 
                          </header>

                          <div class="panel-body">
                                <a href="<?php echo base_url();?>admin/brands/addMake" type="button" class="btn btn-primary btn-lg btn-block">Add make</a>
                          </div>

                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> ID</th>
                                 <th><i class="icon_calendar"></i> Make</th>        <th><i class="icon_calendar"></i> Make arabic</th> 
                                 <th><i class="icon_cogs"></i> Action</th>
                                 
                              </tr>
                              <?php foreach($makes as $mk) { ?>
                              <tr>
                                 <td><?php echo $mk['id'];  ?></td>
                                 <td><?php echo $mk['make'];  ?></td>                <td><?php echo $mk['make_ar'];  ?></td>                
                                 

                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo base_url();?>admin/brands/editMake/<?php echo $mk['id'];  ?>"><i class="fa fa-pencil-square-o"></i></i></a>                               
      
                                      <a onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger" href="<?php echo base_url();?>admin/brands/deleteMake/<?php echo $mk['id'];  ?>"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr> 
                              <?php } ?>                                                          
                           </tbody>                          
                        </table>                         
                      </section>
                      <?php echo $pagination?> 
                  </div>

                  

                  </div>
<?php include('includes/footeradmin.php');?>    