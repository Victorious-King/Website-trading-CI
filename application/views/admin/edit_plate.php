<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>      
    <script type="text/javascript">
  function getCityCode(id){    
    if(id!=''){
        $.ajax
        ({
        type: "GET",        
        url: "<?php echo base_url()?>main/getCityCode/"+id,
        cache: false,
        success: function(html)
        {
        $("#citycode_id").html(html);
        } 
        });
      }
  }

function getCity(cn){      
       var country = cn.replace(/ /g,"-");       
        if(country!=''){
        $.ajax
        ({
        type: "GET",
        url: "<?php echo base_url()?>main/getCityList/"+country,        
        cache: false,
        success: function(html)
        {
        $("#city").html(html);
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Plates</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-Plate"></i>Number plate</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
				<div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add Plate make
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/Plate/<?php echo ($actionType=='add'?'insertPlate':'updatePlate')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="plate_id" id="plate_id" value="<?php echo $plate['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Plate Detail 
                                        </header>
                                          <label for="make" class="control-label col-lg-2">Dealer <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="user_id" name="user" class="form-control m-bot15" >
                                                  <option>Select dealer</option>
                                                  <option value="0" <?php echo ($plate['code']=='P'?'selected':'');?> >Private</option>
                                                  <?php 
                                                  foreach($dealers as $dl) { 
                                                  ?>
                                                  <option value="<?php echo $dl->id; ?>" <?php echo ($plate['user_id']==$dl->id?'selected':'');?>><?php echo $dl->pname;?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Title<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="title" value="<?php echo $plate['title']; ?>" placeholder=""/>
                                          </div>
                                      </div>                                     
                                      

                                      <div class="form-group ">                                        
                                          <label for="city" class="control-label col-lg-2">Plate city <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="city_id" name="city_id" class="form-control m-bot15" onchange="getCityCode(this.value);">
                                                  <option value="">Select city</option>
                                                  <?php 
                                                  foreach($plate_city as $pc) { 
                                                  ?>
                                                  <option value="<?php echo $pc['id']; ?>" <?php echo ($plate['city_id']==$pc['id']?'selected':'');?>><?php echo $pc['city'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div>

                                     
                                      <div class="form-group ">
                                          <label for="model" class="control-label col-lg-2">City code <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                             <select name="citycode_id" id="citycode_id" class="form-control m-bot15">
                                              <option value="">Select city first</option>
                                              <?php foreach($citycode as $cc) { ?>
                                              <option value="<?php echo $cc['id']; ?>" <?php echo ($plate['citycode_id']==$cc['id']?'selected':'');?>><?php echo $cc['code'];?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Number<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="number" type="text" name="number" value="<?php echo $plate['number']; ?>" placeholder=""/>
                                          </div>
                                      </div> 


                                      <div class="form-group ">                                        
                                          <label for="hide_code" class="control-label col-lg-2">Hide plate code <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <label class="checkbox-inline">
                                              <input name="hide_code" type="checkbox" value="1" <?php echo ($plate['hide_code']==1?'checked':'');?>></label>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="price" type="text" name="price" value="<?php echo $plate['price']; ?>" placeholder=""/>
                                          </div>
                                      </div>    

                                      <div class="form-group ">                                        
                                          <label for="person_name" class="control-label col-lg-2">Featured AD <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <label class="checkbox-inline">
                                              <input name="featured" type="checkbox" value="1" <?php echo ($plate['featured']==1?'checked':'');?>></label>
                                          </select>
                                          </div>
                                      </div>

                                      
                                     

                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Plate's description
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Details<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <div class="col-sm-10">
                                                  <textarea class="form-control" name="des" rows="6"><?php echo $plate['des']; ?></textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <!-- <div class="form-group ">
                                        <?php 
                                          $type = explode(',', $plate['badges']);
                                          
                                        ?>
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Badges
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Badges<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <div class="col-sm-10">
                                                  <ul>
                                                    <li><label class="checkbox-inline">
                                              <input name="badges[]" type="checkbox" value="Full Service History"<?php echo $checked = ((in_array('Full Service History', $type))?"checked":""); ?>>Full Service History</label></li>
                                                    <li><label class="checkbox-inline">
                                              <input name="badges[]" type="checkbox" value="Accident Free" <?php echo $checked = ((in_array('Accident Free', $type))?"checked":""); ?>>Accident Free</label></li>
                                                    <li><label class="checkbox-inline">
                                              <input name="badges[]" type="checkbox" value="Under Warranty" <?php echo $checked = ((in_array('Under Warranty', $type))?"checked":""); ?>>Under Warranty</label></li>
                                                    <li><label class="checkbox-inline">
                                              <input name="badges[]" type="checkbox" value="Negotiable" <?php echo $checked = ((in_array('Negotiable', $type))?"checked":""); ?>>Negotiable</label></li>

                                                  </ul>
                                              </div>
                                          </div>
                                      </div> -->



                                      <div class="form-group ">  
                                      <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Contact details
                                        </header>                                      
                                          <label for="person_name" class="control-label col-lg-2">City <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                             <select name="city" class="form-control m-bot15">
                                              <option value="">Select city</option>
                                              <?php foreach($city as $ct) { ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($plate['city']==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                      <?php /*

                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Contact details
                                        </header>
                                          <label for="" class="control-label col-lg-2">Country<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="country" name="country" class="form-control m-bot15" onchange="getCity(this.value)">
                                                  <option value="">Select country</option>
                                                  <?php 
                                                  foreach($countries as $country) { 
                                                  ?>
                                                  <option value="<?php echo $country['country']; ?>" <?php echo ($plate['country']==$country['country']?'selected':'');?>><?php echo $country['country'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">City<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="city" name="city" class="form-control m-bot15">
                                                      <option value="">Select city</option>
                                                      <?php foreach($city_list as $city){
                                                        $selected = ($plate['city']==$city['city']?'selected':'');
                                                      ?>
                                                      <option value="<?php echo $city['city']?>" <?php echo $selected?>><?php echo $city['city']?></option>
                                                      <?php }?>                                
                                              </select>
                                          </div>
                                      </div>      
                                      */ ?>                               

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Location<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="location" name="location" value="<?php echo $plate['location']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                     
                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Mobile#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="mobile" name="mobile" value="<?php echo $plate['mobile']; ?>" placeholder=""/>
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