<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>

<script type="text/javascript">
  function getModels()
  {
    var make_id = document.getElementById("make_id").value;    
    document.search_form.action="<?php echo base_url()?>admin/brands/listModels/?make_id="+make_id
  }
</script>      
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Models</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Models</li>						  	
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
                              Model lists
                          </header>

                          <div class="panel-body">
                                <a href="<?php echo base_url();?>admin/brands/addModel" type="button" class="btn btn-primary btn-lg btn-block">Add modles</a>
                          </div>


                          <header class="panel-heading">
                              Search models
                          </header>

                          <form action="" method="post"  class="all-form" name="search_form">
                            <div class="panel-body">
                                <select id="make_id" name="make_id" class="form-control m-bot15">
                                    <option>Select make</option>
                                    <?php 
                                    foreach($make as $mk) { 
                                    ?>
                                    <option value="<?php echo $mk['id']; ?>" <?php echo ($this->uri->segment(4)==$mk['id']?'selected':'');?>><?php echo $mk['make'];?></option>
                                    <?php } ?>                                    
                                </select>
                                <button type="submit" class="btn btn-success" onClick="getModels()" title="">Search</button>
                               
                            </div>

                          </form>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i> ID</th>
                                 <th><i class="icon_calendar"></i> Make</th>
                                 <th><i class="icon_calendar"></i> Model</th>  
                                 <th><i class="icon_calendar"></i> Model arabic</th>                                                             
                                 <th><i class="icon_cogs"></i> Action</th>
                                 
                              </tr>
                              <?php foreach($models as $md) { ?>
                              <tr>
                                <td><?php echo $md['id'];  ?></td>
                                <td><?php echo $md['make'];  ?></td>
                                <td><?php echo $md['model'];  ?></td>  
                                <td><?php echo $md['model_ar'];  ?></td>
                                                              
                                 

                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="<?php echo base_url();?>admin/brands/editModel/<?php echo $md['id'];  ?>"><i class="fa fa-pencil-square-o"></i></i></a>                               
      
                                      <a onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger" href="<?php echo base_url();?>admin/brands/deleteModel/<?php echo $md['id'];  ?>"><i class="icon_close_alt2"></i></a>
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