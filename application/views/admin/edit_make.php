<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>      
    <script type="text/javascript">
function getSubcat(id){
    if(id!=''){
        $.ajax
        ({
        type: "GET",
        url: "<?php echo base_url(); ?>admin/products/getSubcat/"+id,
        cache: false,
        success: function(html)
        {
        $("#subcatid").html(html);
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/brands/<?php echo ($actionType=='add'?'insertMake':'updateMake')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="make_id" id="make_id" value="<?php echo $make['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group ">
                                        <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Make Detail 
                                        </header>
                                          <label for="starting_date" class="control-label col-lg-2">Make<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="make" name="make" value="<?php echo $make['make']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Make arabic<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="make_ar" name="make_ar" value="<?php echo $make['make_ar']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">User logo<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="logoimg[]" class="input-file uniform_on"  type="file">                                               
                                          </div>
                                      </div>
                                      

                                      <div class="control-group">
                                  
                                            <?php if(!empty($assets_brand)){ 
                                                foreach($assets_brand as $img){
                                                $image= $this->asset_model->getImage($img['image'],'100x100');
                                            ?>
                                            
                                                
                                            <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                            <a class="btn btn-danger" href="<?php echo base_url()?>admin/brands/removeAsset/<?php echo $img['id'];?>/<?php echo $make['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                            </a>
                                            
                                            <?php }} ?>
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