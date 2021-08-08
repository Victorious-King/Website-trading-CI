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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Bikes</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Bikes</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
				<div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add car make
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/Bikes/<?php echo ($actionType=='add'?'insertBike':'updateBike')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="bike_id" id="bike_id" value="<?php echo $bike['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Bike Detail 
                                        </header>
                                          <label for="make" class="control-label col-lg-2">Dealer <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="user_id" name="user" class="form-control m-bot15" >
                                                  <option>Select dealer</option>
                                                  <option value="0" <?php echo ($bike['code']=='P'?'selected':'');?> >Private</option>
                                                  <?php 
                                                  foreach($dealers as $dl) { 
                                                  ?>
                                                  <option value="<?php echo $dl->id; ?>" <?php echo ($bike['user_id']==$dl->id?'selected':'');?>><?php echo $dl->pname;?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Title<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control"   type="text" name="title" value="<?php echo $bike['title']; ?>" placeholder=""/>
                                          </div>
                                      </div>                                     

                                       <div class="form-group ">                                        
                                          <label for="year" class="control-label col-lg-2">Year <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <select name="year" class="form-control m-bot15">
                                              <option>Select year</option>
                                              <?php 
                                                  $yearval=date('Y')+1;
                                                  $yearcount=1;
                                                  while($yearcount<=100)
                                                  {
                                                      $selected_year = ($bike['year']==$yearval?'selected':'');
                                                      echo '<option '.$yearval.' value="'.$yearval.'" '.$selected_year.'>'.$yearval.'</option>';
                                                      $yearcount++;
                                                      $yearval--;
                                                  }
                                              ?>
                                            </select>
                                          </div>
                                       </div>                                  

                                      <div class="form-group ">                                        
                                          <label for="make" class="control-label col-lg-2">Make <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="make_id" name="make_id" class="form-control m-bot15" onchange="getModelList(this.value);">
                                                  <option value="">Select make</option>
                                                  <?php 
                                                  foreach($bike_make as $bm) { 
                                                  ?>
                                                  <option value="<?php echo $bm['id']; ?>" <?php echo ($bike['make_id']==$bm['id']?'selected':'');?>><?php echo $bm['make'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control"   type="text" name="price" value="<?php echo $bike['price']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="condition" class="control-label col-lg-2">Condition <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <select name="condition" class="form-control m-bot15">
                                              <option>Select condition</option>   
                                                  <option value="New" <?php echo ($bike['condition']=='New'?'selected':'');?>>New</option>
                                                  <option value="Used" <?php echo ($bike['condition']=='Used'?'selected':'');?>>Used</option>

                                                                                          </select>
                                          </div>
                                       </div>  

                                                                            

                                      <div class="form-group ">                                        
                                          <label for="person_name" class="control-label col-lg-2">Featured AD <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <label class="checkbox-inline">
                                              <input name="featured" type="checkbox" value="1" <?php echo ($bike['featured']==1?'checked':'');?>></label>
                                          </select>
                                          </div>
                                      </div>
                                     

                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Bikes's description
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Details<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <div class="col-sm-10">
                                                  <textarea class="form-control" name="des" rows="6"><?php echo $bike['des']; ?></textarea>
                                              </div>
                                          </div>
                                      </div>

                                      

                                      <div class="form-group ">  
                                       <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Bikes's images
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Image1<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image2<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image3<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image4<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image5<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image6<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image7<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image8<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image9<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image10<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                                          </div>
                                      </div>



                                      

                                      <div class="control-group">
                                  
                                          <?php if(!empty($assets)){ 
                                            foreach($assets as $img){
                                            $image= $this->asset_model->getImage($img['image'],'300x225');
                                          ?>
                                          
                                               
                                          <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                          <a class="btn btn-danger" href="<?php echo base_url()?>admin/Bikes/removeAsset/<?php echo $img['id'];?>/<?php echo $bike['id'];?>">
                                          <i class="fa fa-trash" aria-hidden="true"></i> 
                                        </a>
                                          
                                          <?php }} ?>
                                      </div>

                                      <div class="form-group ">  
                                      <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Contact details
                                        </header>                                      
                                          <label for="person_name" class="control-label col-lg-2">City <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                             <select name="city" class="form-control m-bot15">
                                              <option value="">Select city</option>
                                              <?php foreach($city as $ct) { ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($bike['city']==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                                         

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Location<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="location" name="location" value="<?php echo $bike['location']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                     
                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Mobile#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="mobile" name="mobile" value="<?php echo $bike['mobile']; ?>" placeholder=""/>
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