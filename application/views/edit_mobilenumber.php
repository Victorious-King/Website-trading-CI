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
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>myads/<?php echo ($actionType=='add'?'addMobilenumber':'updateMobilenumber')?>/" enctype="multipart/form-data">

                  <input type="hidden" name="mobilenumber_id" id="mobilenumber_id" value="<?php echo $mobile['id']; ?>"  />

                    <div class="form-group">
                    <label><?php echo $this->lang->line('title');?></label>
                      <input class="form-control" type="text" placeholder="" name="title" value="<?php echo $mobile['title']; ?>"  required/>
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('select_mobile_operator');?></label>
                        <select id="operator" name="operator" class="form-control m-bot15" onchange="getOpcode(this.value);change_operator_icon(this.value);" required>
                                                  <option value=""><?php echo $this->lang->line('select_operator');?></option>
                                                  <?php 
                                                  foreach($operator as $key => $value) { 
                                                  ?>
                                                  <option value="<?php echo $key; ?>" <?php echo (str_replace("-", " ", $mobile['operator'])==$value?'selected':'');?>><?php echo $value;?></option>
                                                  <?php } ?>                                    
                        </select>
                      </div>

                      

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_operator_code');?></label>
                        <select name="operator_code" id="operator_code" class="form-control m-bot15" onchange="change_operator_code(this.value);" required>
                        <option value=""><?php echo $this->lang->line('select_operator_first');?></option>                 
                        </select>
                      </div>
                      
                    <div class="form-group">
                    <label><?php echo $this->lang->line('number');?></label>
                    <input maxlength="7" maxlength="7" class="form-control" type="text" name="number" value="<?php echo $mobile['number']; ?>" placeholder="" onkeyup="change_number(this.value);" required/>
                    </div>

                    <div class="form-group">
                    <label><?php echo $this->lang->line('price');?></label>
                    <input class="form-control" type="text" name="price" value="<?php echo $mobile['price']; ?>" placeholder="" required/>
                    </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('description');?></label>
                      <textarea class="form-control" name="des" rows="6"><?php echo $mobile['des']; ?></textarea>
                      </div>

                      

                     


                      <div class="form-group">
                      <label><?php echo $this->lang->line('city');?></label>
                      <select name="city" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_city');?></option>
                                              <?php foreach($city as $ct) { 
                                              
                                              if($user_city){
                                                $city=$user_city;
                                              }else{
                                                $city=$mobile['city'];
                                              }
                                              //echo $city;
                                              ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($city==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                      </select>
                      </div>

                     

                      <div class="form-group">
                      <label><?php echo $this->lang->line('mobile');?></label>
                      <input class="form-control" id="mobile" name="mobile" value="<?php if ($mobile['mobile']){ echo $mobile['mobile'];} else{ echo $phone_number; } ?>" placeholder="" required/>
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
                      <?php echo $this->lang->line('mobile_number_preview');?>
                    </div>
                      <div class="preview-cont-wrapper-mn">
                            <div class="preview-cont">
                              <ul class="list-inline">                                
                                <li class="list-inline-item city">
                                  <img class="img-fluid mob-operator" src="<?php echo theme_url()?>img/<?php if($mobile['operator']=='Du'){echo 'du_logo.png';} elseif($mobile['operator']=='Etisalat'){echo 'etisalat_logo.png';} elseif($mobile['operator']=='Virgin-Mobile'){echo 'virgin_logo.png';}else{echo 'du_logo.png';}?>" data-du="<?php echo theme_url()?>img/du_logo.png" data-etisalat="<?php echo theme_url()?>img/etisalat_logo.png" data-virgin="<?php echo theme_url()?>img/virgin_logo.png" /> 
                                </li>
                                <li class="list-inline-item code <?php echo ($mobile['city_id']==1?'ad':''); ?>" id="code"><?php echo ($this->uri->segment(2)=='editMobilenumber'?$mobile['operator_code']:'055'); ?></li>
                                <li class="list-inline-item number" id="number"><?php echo ($this->uri->segment(2)=='editMobilenumber'?$mobile['number']:'0000000'); ?></li>
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

    <section id="preview-mobilenumber-mb">
        <div class="container">
            <div class="row">
              <div class="col">
                  <div class="preview-cont">
                  <div class="title">
                  <?php echo $this->lang->line('mobile_number_preview');?>
                  </div>
                  <div class="preview-cont-wrapper">
                            <div class="preview-cont">
                            <ul class="list-inline">                                
                                <li class="list-inline-item city">
                                  <img class="img-fluid mob-operator" src="<?php echo theme_url()?>img/<?php if($mobile['operator']=='Du'){echo 'du_logo.png';} elseif($mobile['operator']=='Etisalat'){echo 'etisalat_logo.png';} elseif($mobile['operator']=='Virgin-Mobile'){echo 'virgin_logo.png';}else{echo 'du_logo.png';}?>" data-du="<?php echo theme_url()?>img/du_logo.png" data-etisalat="<?php echo theme_url()?>img/etisalat_logo.png" data-virgin="<?php echo theme_url()?>img/virgin_logo.png" /> 
                                </li>
                                <li class="list-inline-item code" id="codemb"><?php echo ($this->uri->segment(2)=='editMobilenumber'?$pcitycode:'055'); ?></li>
                                <li class="list-inline-item number" id="numbermb"><?php echo ($this->uri->segment(2)=='editMobilenumber'?$mobile['number']:'0000000'); ?></li>
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

    var code = "<?php echo $mobile['operator_code']; ?>";       
    getOpcode(code);
  });

function change_operator_icon(operator) { 
  if(operator == 'Du') {
    $('.mob-operator').attr('src',$('.mob-operator').data('du'));    
    $('.code, .number').addClass('du-color');
    $('.code, .number').removeClass('eti-color');
    $('.code, .number').removeClass('vir-color');    
  } else if (operator == 'Etisalat') {
    $('.mob-operator').attr('src',$('.mob-operator').data('etisalat'));
    $('.code, .number').addClass('eti-color');
    $('.code, .number').removeClass('du-color');
    $('.code, .number').removeClass('vir-color');
  } else if (operator == 'Virgin-Mobile') {
    $('.mob-operator').attr('src',$('.mob-operator').data('virgin'));
    $('.code, .number').addClass('vir-color');
    $('.code, .number').removeClass('du-color');
    $('.code, .number').removeClass('eti-color');
  } 
 
  
}

function change_operator_code(code) {  
  $operator_code = operator_code.options[operator_code.selectedIndex].text;  
  document.getElementById("code").innerHTML = $operator_code;  
  document.getElementById("codemb").innerHTML = $operator_code;  
}

function change_number(mob_number) {  
  document.getElementById("number").innerHTML = mob_number;
  document.getElementById("numbermb").innerHTML = mob_number;
}







</script>