<?php include('includes/header.php');?>

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
                                  <?php   echo $_SESSION["sess_alert"];?>
                          </div>
                  <?php } if ($error) { ?>
                     <div class="alert alert-success" role="alert"><?php echo $error; ?></div>
                  <?php } ?>
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>myads/<?php echo ($actionType=='add'?'addPlate':'updatePlate')?>/" enctype="multipart/form-data">

                  <input type="hidden" name="plate_id" id="plate_id" value="<?php echo $plate['id']; ?>"  />

                    <div class="form-group">
                    <label><?php echo $this->lang->line('title');?></label>
                      <input class="form-control" type="text" placeholder="" name="title" value="<?php echo $plate['title']; ?>"  required/>
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('select_plate_city');?></label>
                        <select id="city_id" name="city_id" class="form-control m-bot15" onchange="getCityCode(this.value);change_city_icon(this.value);" required>
                                                  <option value="">Select city</option>
                                                  <?php 
                                                  foreach($plate_city as $pc) { 
                                                  ?>
                                                  <option value="<?php echo $pc['id']; ?>" <?php echo ($plate['city_id']==$pc['id']?'selected':'');?>><?php echo $pc['city'];?></option>
                                                  <?php } ?>                                    
                        </select>
                      </div>

                      <div class="form-group plate-type city<?php echo $plate['city_id']; ?>">
                        <label><?php echo $this->lang->line('select_plate_type');?></label>
                        <ul class="list-inline">
                          <li class="list-inline-item">
                          <label class="default">
                            <input type="radio" name="plate_type" value="dubai_def" checked onclick=change_plate_type(this.value); <?php echo ($plate['plate_type']=='dubai_def'?'checked':''); ?>>
                            <img src="<?php echo theme_url()?>img/plate_dubai_default.png">
                          </label>
                          </li>
                          <li class="list-inline-item">
                          <label class="new">
                            <input type="radio" name="plate_type" value="dubai_new" onclick=change_plate_type(this.value); <?php echo ($plate['plate_type']=='dubai_new'?'checked':''); ?>>
                            <img src="<?php echo theme_url()?>img/Dubai.png">
                          </label>
                          </li>
                        </ul>
                        
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_city_code');?></label>
                        <select name="citycode_id" id="citycode_id" class="form-control m-bot15" onchange="change_city_code(this);" required>
                                              <option value=""><?php echo $this->lang->line('select_city_first');?></option>
                                              <?php foreach($citycode as $cc) { ?>
                                              <option value="<?php echo $cc['id']; ?>" <?php echo ($plate['citycode_id']==$cc['id']?'selected':'');?>><?php echo $cc['code'];?></option>
                                              <?php } ?>
                                          </select>
                      </div>
                      
                    <div class="form-group">
                    <label><?php echo $this->lang->line('number');?></label>
                    <input maxlength="5" class="form-control" type="text" name="number" value="<?php echo $plate['number']; ?>" placeholder="" onkeyup="change_number(this.value);" required/>
                    </div>

                    <div class="form-group">
                    <label><?php echo $this->lang->line('price');?></label>
                    <input class="form-control" type="text" name="price" value="<?php echo $plate['price']; ?>" placeholder="" required/>
                    </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('description');?></label>
                      <textarea class="form-control" name="des" rows="6"><?php echo $plate['des']; ?></textarea>
                      </div>

                      

                     


                      <div class="form-group">
                      <label><?php echo $this->lang->line('city');?></label>
                      <select name="city" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_city');?></option>
                                              <?php foreach($city as $ct) { 
                                              
                                              if($user_city){
                                                $city=$user_city;
                                              }else{
                                                $city=$plate['city'];
                                              }
                                              //echo $city;
                                              ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($city==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                      </select>
                      </div>

                     

                      <div class="form-group">
                      <label><?php echo $this->lang->line('mobile');?></label>
                      <input class="form-control" id="mobile" name="mobile" value="<?php if ($plate['mobile']){ echo $plate['mobile'];} else{ echo $phone_number; } ?>" placeholder="" required/>
                      </div>

                      <div class="form-group">                      
                      <button class="btn" type="submit"><?php echo $this->lang->line('post');?></button>
                      </div>

                      
                      

                      
                    </form>
                  </div>
                </div>
                <div class="col-md-6">                
                  <div class="preview-main">
                      <div class="title">
                      <?php echo $this->lang->line('number_plate_preview');?>
                    </div>
                      <div class="preview-cont-wrapper">
                            <div class="preview-cont">
                              <ul class="list-inline">
                                <li class="list-inline-item code <?php echo ($plate['city_id']==1?'ad':''); ?>" id="code"><?php echo ($this->uri->segment(2)=='editPlate'?$pcitycode:'X'); ?></li>
                                <li class="list-inline-item city">
                                  <img class="img-fluid plate-city" src="<?php echo theme_url()?>img/<?php if($plate['city_id']==1){echo 'plate_abudhabi_default.png';} elseif($plate['city_id']==2){echo 'plate_ajman_default.png';} elseif($plate['city_id']==3){echo($plate['plate_type']=='dubai_new'?'Dubai.png':'plate_dubai_default.png');}elseif($plate['city_id']==4){echo 'plate_fujairah_default.png';}elseif($plate['city_id']==5){echo 'plate_uaq_default.png';}elseif($plate['city_id']==6){echo 'plate_rak_default.png';}elseif($plate['city_id']==7){echo 'plate_sharjah_default.png';}else{echo 'plate_dubai_default.png';}?>" data-abudhabi="<?php echo theme_url()?>img/plate_abudhabi_default.png" data-ajman="<?php echo theme_url()?>img/plate_ajman_default.png" data-dubai="<?php echo theme_url()?>img/plate_dubai_default.png" data-fujairah="<?php echo theme_url()?>img/plate_fujairah_default.png" data-uaq="<?php echo theme_url()?>img/plate_uaq_default.png" data-rak="<?php echo theme_url()?>img/plate_rak_default.png" data-sharjah="<?php echo theme_url()?>img/plate_sharjah_default.png" data-dubainew="<?php echo theme_url()?>img/Dubai.png" /> 
                                </li>
                                <li class="list-inline-item number" id="number"><?php echo ($this->uri->segment(2)=='editPlate'?$plate['number']:'00000'); ?></li>
                              </ul>                    
                            </div>                           
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>

    <section id="preview-plate-mb">
        <div class="container">
            <div class="row">
              <div class="col">
                  <div class="preview-cont">
                  <div class="title">
                  <?php echo $this->lang->line('number_plate_preview');?>
                  </div>
                  <div class="preview-cont-wrapper">
                            <div class="preview-cont">
                              <ul class="list-inline">
                                <li class="list-inline-item code <?php echo ($plate['city_id']==1?'ad':''); ?>" id="codemb"><?php echo ($this->uri->segment(2)=='editPlate'?$pcitycode:'X'); ?></li>
                                <li class="list-inline-item city">
                                  <img class="img-fluid plate-city" src="<?php echo theme_url()?>img/<?php if($plate['city_id']==1){echo 'plate_abudhabi_default.png';} elseif($plate['city_id']==2){echo 'plate_ajman_default.png';} elseif($plate['city_id']==3){echo($plate['plate_type']=='dubai_new'?'Dubai.png':'plate_dubai_default.png');}elseif($plate['city_id']==4){echo 'plate_fujairah_default.png';}elseif($plate['city_id']==5){echo 'plate_uaq_default.png';}elseif($plate['city_id']==6){echo 'plate_rak_default.png';}elseif($plate['city_id']==7){echo 'plate_sharjah_default.png';}else{echo 'plate_dubai_default.png';}?>" data-abudhabi="<?php echo theme_url()?>img/plate_abudhabi_default.png" data-ajman="<?php echo theme_url()?>img/plate_ajman_default.png" data-dubai="<?php echo theme_url()?>img/plate_dubai_default.png" data-fujairah="<?php echo theme_url()?>img/plate_fujairah_default.png" data-uaq="<?php echo theme_url()?>img/plate_uaq_default.png" data-rak="<?php echo theme_url()?>img/plate_rak_default.png" data-sharjah="<?php echo theme_url()?>img/plate_sharjah_default.png" data-dubainew="<?php echo theme_url()?>img/Dubai.png" /> 
                                </li>
                                <li class="list-inline-item number" id="numbermb"><?php echo ($this->uri->segment(2)=='editPlate'?$plate['number']:'00000'); ?></li>
                              </ul>                    
                            </div>                           
                      </div>    
                  </div>
              </div>
            </div>
        </div>
    </section>


<?php include('includes/footer.php');?>

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

function change_city_icon(city) {
  //alert(city);
  if(city == '1') {
    $('.plate-city').attr('src',$('.plate-city').data('abudhabi'));    
  } else if (city == '2') {
    $('.plate-city').attr('src',$('.plate-city').data('ajman'));
  } else if (city == '3') {
    $('.plate-city').attr('src',$('.plate-city').data('dubai'));
  } else if (city == '4') {
    $('.plate-city').attr('src',$('.plate-city').data('fujairah'));
  } else if (city == '5') {
    $('.plate-city').attr('src',$('.plate-city').data('uaq'));
  } else if (city == '6') {
    $('.plate-city').attr('src',$('.plate-city').data('rak'));
  } else if (city == '7') {
    $('.plate-city').attr('src',$('.plate-city').data('sharjah'));
  }


  if(city == '1') {
    $('.code').addClass('ad');
  }else{
    $('.code').removeClass('ad');
  }
}

function change_city_code(citycode_id) {  
  $citycode = citycode_id.options[citycode_id.selectedIndex].text;  
  document.getElementById("code").innerHTML = $citycode;  
  document.getElementById("codemb").innerHTML = $citycode;  
}

function change_number(plate_number) {  
  document.getElementById("number").innerHTML = plate_number;
  document.getElementById("numbermb").innerHTML = plate_number;
}

function change_plate_type(type) {  
  if(type == 'dubai_def') {
    $('.plate-city').attr('src',$('.plate-city').data('dubai'));    
  } else if (type == 'dubai_new') {
    $('.plate-city').attr('src',$('.plate-city').data('dubainew'));
  }
}



$( document ).ready(function() {
  //$(".plate-type").hide();
    $('#city_id').on('change', function() {
      if ( this.value == 3)
      {
        $(".plate-type").show();
      }
      else
      {
        $(".plate-type").hide();
      }
    });
  });


</script>