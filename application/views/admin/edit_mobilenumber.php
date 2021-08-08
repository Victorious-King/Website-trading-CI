<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>   
<script src="<?php echo theme_url()?>js/jquery.min.js"></script>   
    <script type="text/javascript">
  function getOpcode(code){    
    //alert(code);
     var op = "<?php echo $mobile['operator_code']; ?>"; 
         

       if(code!=''){
        $.ajax
        ({
        type: "GET",        
        url: "<?php echo base_url()?>main/getOperatorCodes/"+code+"/?op_code="+op,        
        cache: false,
        success: function(html)
        {            
        $("#operator_code").html(html);
        
        } 
        });
      }


  }

  $(document).ready(function(){  

    var code = "<?php echo $mobile['operator']; ?>";       
    getOpcode(code);
  });

</script>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Mobile numbers</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-Plate"></i>Mobile number</li>						  	
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/mobilenumber/<?php echo ($actionType=='add'?'insertmobilenumber':'updatemobilenumber')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="mobile_id" id="mobile_id" value="<?php echo $mobile['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Plate Detail 
                                        </header>
                                          <label for="make" class="control-label col-lg-2">Dealer <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="user_id" name="user" class="form-control m-bot15" >
                                                  <option>Select dealer</option>
                                                  <option value="0" <?php echo ($mobile['code']=='P'?'selected':'');?> >Private</option>
                                                  <?php 
                                                  foreach($dealers as $dl) { 
                                                  ?>
                                                  <option value="<?php echo $dl->id; ?>" <?php echo ($mobile['user_id']==$dl->id?'selected':'');?>><?php echo $dl->pname;?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Title<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" type="text" name="title" value="<?php echo $mobile['title']; ?>" placeholder=""/>
                                          </div>
                                      </div>                                     
                                      

                                      <div class="form-group ">                                        
                                          <label for="city" class="control-label col-lg-2">Mobile operator <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <select id="operator" name="operator" class="form-control m-bot15" onchange="getOpcode(this.value);" required>
                                                  <option value="">Select operator</option>
                                                  <?php 
                                                  foreach($operator as $key => $value) { 
                                                  ?>
                                                  <option value="<?php echo $key; ?>" <?php echo (str_replace("-", " ", $mobile['operator'])==$value?'selected':'');?>><?php echo $value;?></option>
                                                  <?php } ?>                                    
                                          </select>
                                          </div>
                                      </div>

                                     
                                      <div class="form-group ">
                                          <label for="model" class="control-label col-lg-2">City code <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <select name="operator_code" id="operator_code" class="form-control m-bot15" onchange="change_operator_code(this.value);" required>
                                          <option value="">Select operator first</option>                 
                                          </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Number<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="number" type="text" name="number" value="<?php echo $mobile['number']; ?>" placeholder=""/>
                                          </div>
                                      </div> 
                                     

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Price<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="price" type="text" name="price" value="<?php echo $mobile['price']; ?>" placeholder=""/>
                                          </div>
                                      </div>    

                                      <div class="form-group ">                                        
                                          <label for="person_name" class="control-label col-lg-2">Featured AD <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                            <label class="checkbox-inline">
                                              <input name="featured" type="checkbox" value="1" <?php echo ($mobile['featured']==1?'checked':'');?>></label>
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
                                                  <textarea class="form-control" name="des" rows="6"><?php echo $mobile['des']; ?></textarea>
                                              </div>
                                          </div>
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
                                              <option value="<?php echo $ct; ?>" <?php echo ($mobile['city']==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                                          </select>
                                          </div>
                                      </div>

                                                          

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Location<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="location" name="location" value="<?php echo $mobile['location']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                     
                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Mobile#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="mobile" name="mobile" value="<?php echo $mobile['mobile']; ?>" placeholder=""/>
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