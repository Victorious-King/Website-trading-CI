<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?> 
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> models</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>models</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
				<div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add car model
                          </header>                          
                      </section> -->

                      <section class="panel">                          
                          <div class="panel-body">
                            <?php if ($_SESSION["sess_alert"] && $_GET['err'] == 1) { ?>
                            <div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <?php  echo $_SESSION["sess_alert"]; ?> 
                            </div>
                            <?php } ?> 

                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/brands/<?php echo ($actionType=='add'?'insertmodel':'updatemodel')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="model_id" id="model_id" value="<?php echo $model['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Model Detail 
                                        </header>
                                          <label for="starting_date" class="control-label col-lg-2">Make<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="make_id" name="make_id" class="form-control m-bot15">
                                                  <option>Select make</option>
                                                  <?php 
                                                  foreach($make as $mk) { 
                                                  ?>
                                                  <option value="<?php echo $mk['id']; ?>" <?php echo ($model['make_id']==$mk['id']?'selected':'');?>><?php echo $mk['make'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Model<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="model" name="model" value="<?php echo $model['model']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Model arabic<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="model_ar" name="model_ar" value="<?php echo $model['model_ar']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Save</button>
                                              <button class="btn btn-default" type="button">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
<br><br>
                              <div class="col-lg-10">
                      <!--Project Activity start-->
                      
                      <!--Project Activity end-->
                  </div>

                          </div>
                          
                                           
                      </section>
                      
                  </div>

                  

                  </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="<?php echo base_url()?>themes/admin/assets/ckeditor/ckeditor.js"></script>

<?php include('includes/footeradmin.php');?>    


<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({                    
                    format: 'YYYY-MM-DD LT'
                });
            });

            
        </script>
</div>