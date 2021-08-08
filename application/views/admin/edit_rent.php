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
					<h3 class="page-header"><i class="fa fa-laptop"></i> Rent a cars</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Rent a cars</li>						  	
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/rents/<?php echo ($actionType=='add'?'insertCar':'updateCar')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="car_id" id="car_id" value="<?php echo $car['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                        Rent a car Detail 
                                        </header>
                                          <label for="make" class="control-label col-lg-2">Dealer <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="user_id" name="user" class="form-control m-bot15" >
                                                  <option>Select dealer</option>
                                                  
                                                  <?php 
                                                  foreach($dealers as $dl) { 
                                                  ?>
                                                  <option value="<?php echo $dl->id; ?>" <?php echo ($car['user_id']==$dl->id?'selected':'');?>><?php echo $dl->pname;?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Title<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="title" value="<?php echo $car['title']; ?>" placeholder=""/>
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
                                                      $selected_year = ($car['year']==$yearval?'selected':'');
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
                                                  foreach($make as $mk) { 
                                                  ?>
                                                  <option value="<?php echo $mk['id']; ?>" <?php echo ($car['make_id']==$mk['id']?'selected':'');?>><?php echo $mk['make'];?></option>
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
                                              <option value="<?php echo $md['id']; ?>" <?php echo ($car['model_id']==$md['id']?'selected':'');?>><?php echo $md['model'];?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price per day<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="price_per_day" value="<?php echo $car['price_per_day']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price per week<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="price_per_week" value="<?php echo $car['price_per_week']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price per month<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="price_per_month" value="<?php echo $car['price_per_month']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                 

                                      <div class="form-group ">                                        
                                          <label for="person_name" class="control-label col-lg-2">Body type <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                             <select name="body_type" class="form-control m-bot15">
                                              <option value="">Select body type</option>
                                              <?php foreach($car_body_type as $cbt) { ?>
                                              <option value="<?php echo $cbt; ?>" <?php echo ($car['body_type']==$cbt?'selected':'');?>><?php echo $cbt;?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Booked date<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <input name="booked_date" type="text" class="form-control date" placeholder="Pick the multiple dates" value="<?php echo $car['booked_date']; ?>" autocomplete="off">
                                          </div>
                                          
                                      </div>

                                   

                                      


                                      <!-- <div class="form-group ">                                        
                                          <label for="person_name" class="control-label col-lg-2">Featured AD <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <label class="checkbox-inline">
                                              <input name="featured" type="checkbox" value="1" <?php echo ($car['featured']==1?'checked':'');?>></label>
                                          </select>
                                          </div>
                                      </div> -->
                                     

                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Car's description
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Details<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <div class="col-sm-10">
                                                  <textarea class="form-control" name="des" rows="6"><?php echo $car['des']; ?></textarea>
                                              </div>
                                          </div>
                                      </div>

                                      

                                      

                                      <div class="form-group ">  
                                       <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Car's images
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

                                        <ul class="list-inline">
                                        <?php if(!empty($assets)){ 
                                          foreach($assets as $img){
                                          $image= $this->asset_model->getImage($img['image'],'300x225');
                                        ?>
                                            <li class="list-inline-item">

                                            <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                        <a class="btn btn-danger" href="<?php echo base_url()?>admin/rents/removeAsset/<?php echo $img['id'];?>/<?php echo $car['id'];?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                        </a>
                                            
                                            </li>
                                        <?php }} ?>
                                        </ul>
                                        <br><br>

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
                                              <option value="<?php echo $ct; ?>" <?php echo ($car['city']==$ct?'selected':'');?>><?php echo $ct;?></option>
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
                                                  <option value="<?php echo $country['country']; ?>" <?php echo ($car['country']==$country['country']?'selected':'');?>><?php echo $country['country'];?></option>
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
                                                        $selected = ($car['city']==$city['city']?'selected':'');
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
                                              <input class="form-control" id="location" name="location" value="<?php echo $car['location']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                     
                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Mobile#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="mobile" name="mobile" value="<?php echo $car['mobile']; ?>" placeholder=""/>
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
<!-- <script src="<?php echo base_url()?>themes/admin/assets/ckeditor/ckeditor.js"></script> -->

<?php include('includes/footeradmin.php');?>    

<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet"/> 

<script>
 $('.date').datepicker({
    multidate: true,
    startDate: '-0d',
    inline: true,
    format: 'yyyy-mm-dd'
});
  </script>




</div>