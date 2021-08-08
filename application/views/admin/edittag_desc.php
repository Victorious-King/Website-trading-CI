<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?> 
<script type="text/javascript">
  function getModelList(id){
    if(id!=''){      
        $.ajax
        ({
        type: "GET",        
        url: "<?php echo base_url()?>main/getModelList/"+id,
        cache: false,
        success: function(html)
        {
        $("#model_id").html(html);
        } 
        });
      }
  }


</script>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> contents</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>contents</li>						  	
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
                              <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/tagsdesc/<?php echo ($actionType=='add'?'insertTagsdesc':'updateTagsdesc')?>/" enctype="multipart/form-data">
                                  <input type="hidden" name="tagdesc_id" id="tagdesc_id" value="<?php echo $tagdesc['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                        Contents Detail 
                                        </header>
                                        <label for="make" class="control-label col-lg-2">Type <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="type" name="type" class="form-control m-bot15" >
                                                  <option>Select type</option>
                                                  <option value="car" <?php echo ($tagdesc['type']=='car'?'selected':'');?> >Car</option>
                                                  <option value="plate" <?php echo ($tagdesc['type']=='plate'?'selected':'');?> >Number plate</option>
                                                  <option value="bike" <?php echo ($tagdesc['type']=='bike'?'selected':'');?> >Bike</option>
                                                  <option value="boat" <?php echo ($tagdesc['type']=='boat'?'selected':'');?> >Boat</option>
                                                  <option value="mobile_number" <?php echo ($tagdesc['type']=='mobile_number'?'selected':'');?> >Mobile number</option>
                                                                                  
                                              </select>
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                        
                                          <label for="starting_date" class="control-label col-lg-2">Make<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="make_id" name="make_id" class="form-control m-bot15" onchange="getModelList(this.value);">
                                                  <option>Select make</option>
                                                  <?php 
                                                  foreach($make as $mk) { 
                                                  ?>
                                                  <option value="<?php echo $mk['id']; ?>" <?php echo ($tagdesc['make_id']==$mk['id']?'selected':'');?>><?php echo $mk['make'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">
                                          <label for="model" class="control-label col-lg-2">Model <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                             <select name="model_id" id="model_id" class="form-control m-bot15">
                                              <option value="">Select make first</option>
                                              <?php foreach($model as $md) { ?>
                                                <option value="<?php echo $md['id']; ?>" <?php echo ($tagdesc['model_id']==$md['id']?'selected':'');?>><?php echo $md['model'];?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">H1 tag <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control"   type="text" name="h1_tag" value="<?php echo $tagdesc['h1_tag']; ?>" placeholder=""/>
                                          </div>
                                      </div>    
                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">H1 tag arabic<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control"   type="text" name="h1_tag_ar" value="<?php echo $tagdesc['h1_tag_ar']; ?>" placeholder=""/>
                                          </div>
                                      </div>    


                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Contents<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <div class="col-sm-10">
                                                  <textarea class="form-control ckeditor" name="desc" rows="6"><?php echo $tagdesc['desc']; ?></textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Contents arabic<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <div class="col-sm-10">
                                                  <textarea class="form-control ckeditor" name="desc_ar" rows="6"><?php echo $tagdesc['desc_ar']; ?></textarea>
                                              </div>
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



</div>