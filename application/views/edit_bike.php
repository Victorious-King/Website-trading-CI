<?php include('includes/header.php');?>
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
<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                <?php echo $this->lang->line('post_an_ad');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="myaccount-main">
      <div class="container">
        <div class="row">
          <div class="col-md-3 d-none d-lg-block">
          <?php include('includes/user_menu.php');?>
          </div>
          <div class="col-md-9">
          <div class="postad-cont">
              <div class="row">
                <div class="col-md-6">
                  <div class="post-form-cont">
                  <?php if ($_SESSION["sess_alert"] && $_GET['st'] == 1) { ?>
                          <div class="alert alert-danger" role="alert">
                          <?php   echo $_SESSION["sess_alert"];  }?>
                  </div>
                  <?php if ($error) { ?>
                  <div class="alert alert-success" role="alert"><?php echo $error; ?></div>
                  <?php } ?>
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>myads/<?php echo ($actionType=='add'?'addBike':'updateBike')?>/" enctype="multipart/form-data">

                  <input type="hidden" name="bike_id" id="bike_id" value="<?php echo $bike['id']; ?>"  />

                    <div class="form-group">
                    <label><?php echo $this->lang->line('title');?></label>
                      <input class="form-control" type="text" placeholder="" name="title" value="<?php echo $bike['title']; ?>"  />
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('select_year');?></label>
                        <select name="year" class="form-control m-bot15">
                            <option><?php echo $this->lang->line('select_year');?></option>
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

                      
                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_make');?></label>
                        <select id="make_id" name="make_id" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_make');?></option>
                                                  <?php 
                                                  foreach($bike_make as $mk) { 
                                                  ?>
                                                  <option value="<?php echo $mk['id']; ?>" <?php echo ($bike['make_id']==$mk['id']?'selected':'');?>><?php echo $mk['make'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                      </div>
                      

                    <div class="form-group">
                    <label><?php echo $this->lang->line('price');?></label>
                    <input class="form-control" type="text" name="price" value="<?php echo $bike['price']; ?>" placeholder=""/>
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('select_condition');?></label>
                        <select id="condition" name="condition" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_condition');?></option>

                                                  <option value="New" <?php echo ($bike['condition']=='New'?'selected':'');?>>New</option>
                                                  <option value="Used" <?php echo ($bike['condition']=='Used'?'selected':'');?>>Used</option>
                                                                                     
                                              </select>
                      </div>

                                      

                      <div class="form-group">
                      <label><?php echo $this->lang->line('description');?></label>
                      <textarea class="form-control" name="des" rows="6"><?php echo $bike['des']; ?></textarea>
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image1');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image2');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image3');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image4');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image5');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image6');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image7');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image8');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image9');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('image10');?></label>
                      <input name="files[]" class="input-file uniform_on" id="fileInput" type="file"> 
                      </div>

                      <div class="row">
                      <?php if(!empty($assets)){ 
                                            foreach($assets as $img){
                                            $image= $this->asset_model->getImage($img['image'],'300x225');
                                          ?>
                        <div class="col img-cont">
                        <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                          <a class="btn btn-danger" href="<?php echo base_url()?>myads/removeAssetBike/<?php echo $img['id'];?>/<?php echo $bike['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                          </a>                      
                        </div>
                        <?php }} ?>
                      </div>

                      <!-- <div class="control-group">
                                  
                                          <?php if(!empty($assets)){ 
                                            foreach($assets as $img){
                                            $image= $this->asset_model->getImage($img['image'],'300x225');
                                          ?>
                                          
                                               
                                          <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                          <a class="btn btn-danger" href="<?php echo base_url()?>myads/removeAsset/<?php echo $img['id'];?>/<?php echo $bike['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                          </a>
                                          
                                          <?php }} ?>
                                      </div> -->

                                      <div class="form-group">
                      <label><?php echo $this->lang->line('city');?></label>
                      <select name="city" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_city');?></option>
                                              <?php foreach($city as $ct) { 
                                              
                                              if($user_city){
                                                $city=$user_city;
                                              }else{
                                                $city=$bike['city'];
                                              }
                                              //echo $city;
                                              ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($city==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                      </select>
                      </div>

                     

                      <div class="form-group">
                      <label><?php echo $this->lang->line('mobile');?></label>
                      <input class="form-control" id="mobile" name="mobile" value="<?php if ($bike['mobile']){ echo $bike['mobile'];} else{ echo $phone_number; } ?>" placeholder=""/>
                      </div>

                      <div class="form-group">                      
                      <button class="btn" type="submit"><?php echo $this->lang->line('post');?></button>
                      </div>

                      
                      

                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>


<?php include('includes/footer.php');?>