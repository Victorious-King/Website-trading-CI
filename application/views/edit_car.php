<?php include('includes/header.php');?>

<style>


</style>

<script src="https://unpkg.com/event-target@latest/min.js"></script>
<script src="https://unpkg.com/resize-observer-polyfill@1.5.0/dist/ResizeObserver.global.js"></script>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=IntersectionObserver"></script>
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
                  <?php if ($_SESSION["sess_alert"] && $_GET['err'] == 1) { ?>
                  <div class="alert alert-success" role="alert"><?php echo $_SESSION["sess_alert"]; ?></div>
                  <?php } ?>
                  <form class="form-validate form-horizontal" id="post_form" method="post" action="<?php echo base_url();?>myads/<?php echo ($actionType=='add'?'addCar':'updateCar')?>/" enctype="multipart/form-data">

                  <input type="hidden" name="car_id" id="car_id" value="<?php echo $car['id']; ?>"  />

                  <input type="hidden" name="last_link" value="<?php echo (stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

                    <div class="form-group">
                    <label><?php echo $this->lang->line('title');?></label>
                      <input class="form-control" type="text" placeholder="" id="title" name="title" value="<?php echo $car['title']; ?>"  />
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('select_year');?></label>
                        <select id="year" name="year" class="form-control m-bot15">
                            <option value=""><?php echo $this->lang->line('select_year');?></option>
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

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_make');?></label>
                        <select id="make_id" name="make_id" class="form-control m-bot15" onchange="getModelList(this.value);">
                                                  <option value=""><?php echo $this->lang->line('select_make');?></option>
                                                  <?php 
                                                  foreach($make as $mk) { 
                                                  ?>
                                                  <option value="<?php echo $mk['id']; ?>" <?php echo ($car['make_id']==$mk['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $mk['make_ar']:($this->uri->segment(1) == 'cn' ? $mk['make_cn']:$mk['make']));?></option>
                                                  <?php } ?>                                    
                                              </select>
                      </div>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_model');?></label>
                        <select name="model_id" id="model_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_make_irst');?></option>
                                              <?php foreach($model as $md) { ?>
                                              <option value="<?php echo $md['id']; ?>" <?php echo ($car['model_id']==$md['id']?'selected':'');?>><?php echo $md['model'];?></option>
                                              <?php } ?>
                                          </select>
                      </div>

                    <div class="form-group">
                    <label><?php echo $this->lang->line('price');?></label>
                    <input class="form-control" type="text" name="price" id="price" value="<?php echo $car['price']; ?>" placeholder=""/>
                    </div>

                    <div class="form-group">
                    <label><?php echo $this->lang->line('mileage');?></label>
                    <input class="form-control" type="text" id="mileage" name="mileage" value="<?php echo $car['mileage']; ?>" placeholder=""/>
                    </div>

                    <div class="form-group">
                        <label><?php echo $this->lang->line('body_type');?></label>
                        <select id="body_type" name="body_type_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('body_type');?></option>
                                              <?php foreach($car_body_type as $cbt) { ?>
                                              <option value="<?php echo $cbt['id']; ?>" <?php echo ($car['body_type_id']==$cbt['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $cbt['body_type_ar']:($this->uri->segment(1) == 'cn' ? $cbt['body_type_cn']:$cbt['body_type']));?>
                                              </option>
                                              <?php } ?>
                                          </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('fuel_type');?></label>
                        <select name="fuel_type_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('fuel_type');?></option>
                                              <?php foreach($fuel_type as $ft) { ?>
                                              <option value="<?php echo $ft['id']; ?>" <?php echo ($car['fuel_type_id']==$ft['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $ft['fuel_type_ar']:($this->uri->segment(1) == 'cn' ? $ft['fuel_type_cn']:$ft['fuel_type']));?></option>
                                              <?php } ?>
                                          </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('exterior_color');?></label>
                        <select name="ex_color_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('exterior_color');?></option>
                                              <?php foreach($color as $cl) { ?>
                                              <option value="<?php echo $cl['id']; ?>" <?php echo ($car['ex_color_id']==$cl['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $cl['color_ar']:($this->uri->segment(1) == 'cn' ? $cl['color_cn']:$cl['color']));?></option>
                                              <?php } ?>

                                          </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('interior_color');?> </label>
                        <select name="in_color_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('interior_color');?></option>
                                              <?php foreach($color as $cl) { ?>
                                              <option value="<?php echo $cl['id']; ?>" <?php echo ($car['in_color_id']==$cl['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $cl['color_ar']:($this->uri->segment(1) == 'cn' ? $cl['color_cn']:$cl['color']));?></option>
                                              <?php } ?>

                                          </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_specification');?></label>
                        <select name="specs_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_specification');?></option>
                                              <?php foreach($specs as $sp) { ?>
                                              <option value="<?php echo $sp['id']; ?>" <?php echo ($car['specs_id']==$sp['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $sp['specs_ar']:($this->uri->segment(1) == 'cn' ? $sp['specs_cn']:$sp['specs']));?></option>
                                              <?php } ?>
                                          </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_transmission');?></label>
                        <select id="trans" name="trans_id" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_transmission');?></option>

                                                  <?php foreach($trans as $tr) { ?>
                                                  <option value="<?php echo $tr['id']; ?>" <?php echo ($car['trans_id']==$tr['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $tr['trans_ar']:($this->uri->segment(1) == 'cn' ? $tr['trans_cn']:$tr['trans']));?></option>
                                                  <?php } ?>
                                                                                     
                                              </select>
                      </div>

                      <div class="form-group">
                        <label><?php echo $this->lang->line('select_condition');?></label>
                        <select id="condition" name="condition" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_condition');?></option>

                                                  <option value="New" <?php echo ($car['condition']=='New'?'selected':'');?>>New</option>
                                                  <option value="Used" <?php echo ($car['condition']=='Used'?'selected':'');?>>Used</option>
                                                  <option value="Classic" <?php echo ($car['condition']=='Classic'?'selected':'');?>>Classic</option>
                                                                                     
                                              </select>
                      </div>

                      <div class="form-group">
                      <label><?php echo $this->lang->line('description');?></label>
                      <textarea class="form-control" id="des" name="des" rows="6"><?php echo $car['des']; ?></textarea>
                      </div>

                      

                      <div class="form-group">
                          <span class="main-photo-tag">Main photo</span>

                          <div id="image_preview" class="text-center">
                          </div>

                          <div class="photo_progress mb-4">
                            <img class='img-thumbnail' width='80'>
                            <div class='progress_container'>
                              <div class='progress_bar'><div id="bar"></div></div>
                              <div class="progress_bar_f_len position-absolute"></div>
                            </div>
                            <div class='progress_delete'>×</div>
                          </div>
                          
                          <div class="text-center">
                            <button type="button" id="add_picture" class="btn form-control"><i class="fa fa-camera"></i> <?php echo $this->lang->line('add_pictures');?></button>
                            <span class="image_length"></span>
                          </div>
                          <input class="input-file uniform_on addmultipleImages" name="files[]" id="fileInput" type="file" multiple>
                          <div id="multipleImages" class="text-danger text-center">You Can Add Maximum <?php echo $_SESSION['img_limit']; ?> Images Here. </div> 
                      </div>


                    

                      <div class="row">
                      <?php if(!empty($assets)){ 
                                            foreach($assets as $img){
                                            $image= $this->asset_model->getImage($img['image'],'300x225');
                                          ?>
                        <div class="col img-cont">
                        <img class="item-view" id='' src="<?php echo base_url_images().$image; ?>"  /><br>
                                          <a class="btn btn-danger" href="<?php echo base_url()?>myads/removeAsset/<?php echo $img['id'];?>/<?php echo $car['id'];?>">
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
                                          <a class="btn btn-danger" href="<?php echo base_url()?>myads/removeAsset/<?php echo $img['id'];?>/<?php echo $car['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                          </a>
                                          
                                          <?php }} ?>
                                      </div> -->

                      <div class="form-group">
                      <label><?php echo $this->lang->line('city');?></label>
                      <select name="city" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_city');?></option>
                                              <?php foreach($city as $ct) { ?>
                                              <option value="<?php echo $ct; ?>" <?php echo ($user_city==$ct?'selected':'');?>><?php echo $ct;?></option>
                                              <?php } ?>
                                          </select>
                      </div>

                     
                      

                      <div class="form-group">
                      <label><?php echo $this->lang->line('mobile');?></label>
                      <input class="form-control" id="mobile" name="mobile" value="<?php if ($car['mobile']){ echo $car['mobile'];} else{ echo $phone_number; } ?>" placeholder=""/>
                      </div>
                      


                      <?php if (($user_type == 'Dealer') && ($featured_ct < $limit_featured)) {?>
                      <hr>
                      

                        <div class="form-group">
                        <!-- <label>Make your cars Featured AD</label> &nbsp;
                        <input name="featured" type="checkbox" value="1" <?php echo ($car['featured']==1?'checked':'');?>></label> -->
                        <label>
                          <input name="featured" type="checkbox" value="1" class="filled-in" <?php echo ($car['featured']==1?'checked':'');?> />
                          <span>Make your cars Featured AD</span>
                        </label>
                        </div>

                      <?php } ?>

                      <!-- <a href=""><i class="far fa-trash-alt"></i> Remove featured AD</a> -->

                      
                      <div class="form-group">
                        <div class="del-fad">
                        <?php if (($user_type == 'Dealer') && ($car['featured']==1)) {?>
                          <a href="<?php echo base_url()?>myads/removeFad/<?php echo $car['id'];?>"><i class="far fa-trash-alt"></i> Remove featured AD</a>
                        <?php } ?>
                        </div>
                      </div>

                      <div class="form-group">
                      </div>
                      



                      

                      <div class="form-group">    
                        <div class="d-flex">
                            <div class="btcont">
                              <button class="btn" id="submit-button"><?php echo $this->lang->line('post');?></button>
                            </div>  
                            <div class="loder-cont">
                              <div id="roller" class="loaderr hdd"></div>
                            </div>                
                        </div>                   
                    
                      </div>

                      
                      <?php /* */ if ($user_type == 'Dealer')  { $_SESSION['img_limit'] = 20; }else{ $_SESSION['img_limit'] = 10; }; ?>

                      <?php /*   echo $_SESSION['img_limit']; echo "sdfsdf"; */ ?>

                      
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
    


<?php include('includes/footer.php');?>

<script src="<?php echo theme_url()?>js/jquery.validate.js"></script>

<script type="text/javascript">
  
  jQuery(document).ready(function(){

    var imglimit= '<?php echo $_SESSION['img_limit']; ?>';
    var total_file;
    var scr;
    var u_id;
    var img_len;
    var storedFiles = [];

    $( "#image_preview" ).sortable();
    $( "#image_preview" ).disableSelection();

    // validate signup form on keyup and submit
    $("#post_form").validate({
      rules: {
        title: {
          required: true,
        },
        year: {
          required: true,
        },
        make_id: {
          required: true
        },
        model_id: {
          required: true
        },
        price: {
          required: true,
        },
        mileage: {
          required: true,
        },
        body_type_id: {
          required: true,
        },
        des: {
          required: true,
        },
        city: {
          required: true,
        },
        mobile: {
          required: true,
          maxlength: 18,
          accept: '^[0-9+, ._\\-]+$'
          
        },
      },
      messages: {
        title: "Please enter title",
        year: "Please select year",
        make_id: "Please select make",
        model_id: "Please select model",
        price: "Please enter price",
        mileage: "Please enter mileage",
        body_type_id: "Please select body type",
        des: "Please enter car description",
        city: "Please select city",
                 
          },
          onfocusout: function (element) {
            $(element).valid();
          }
    });

    $.validator.addMethod("accept", function(value, element, param) {
            return value.match(new RegExp(param));
        }, 'Please enter a valid mobile number'); 
    $("#fileInput").hide()
    $(".photo_progress").hide()
    $("#multipleImages").hide()
    
    $("#add_picture").click(function(){
      $("#fileInput").click();
    })
    

    $("#fileInput").change(function(){
      var total_file_tmp = $("#fileInput")[0].files.length;
      if(total_file_tmp==0) {  return;}

      if(img_len === undefined){
        img_len = 0;
      }
        var current_file_num = $("#image_preview").children('.photo_container').length;
        if (current_file_num==undefined) current_file_num = 0;
        if(current_file_num == imglimit){
          $(".photo_progress").hide();
          $("#multipleImages").show();
        }
        
       
        var diff = total_file_tmp + current_file_num - imglimit ; 
        if(diff > 0) {
          total_file = total_file_tmp - diff;
          $(".photo_progress").hide();
          $("#multipleImages").show();
        }
        else if(diff = 0) {
          $("#multipleImages").show();
          total_file = total_file_tmp;
        }
          else {
            $("#multipleImages").hide();
            total_file = total_file_tmp;
        }
        
        var timeout = total_file*100;
        $(".photo_progress").show()
        
        var id = $("#image_preview").children("div:last-child").children("div:eq(0)").attr("id");

        for(var i=0;i<total_file;i++)
        {

          setTimeout(loop(), timeout);
            function loop(){
              if(id == undefined){
                u_id = i;
              }else{
                u_id = i+1 + id*1;
              }
              storedFiles.push(event.target.files[i]);
              scr =  URL.createObjectURL(event.target.files[i]);
              
            }
            
          setTimeout(progress( event.target.files[i].name, scr, total_file, u_id), timeout);
        }
  
    })

    $("#image_preview").on("click", ".delete_photo" , function(){

      var fileId = $(this).attr("id");
      //input file delete
      $(this).parent().remove();
      // img_len = img_len -1;
      var full_num = $("#image_preview").children('div').length;
      $(".image_length").text(''+full_num+'files uploaded');

      for (var k = 0; k < full_num; k++) {
        var new_id = $("#image_preview").children("div:eq("+(k)+")").children("div:eq(0)").attr("id")
        if(new_id > fileId){
          $("#image_preview").children("div:eq("+(k)+")").children("div:eq(0)").attr("id",new_id - 1)
        }
      }

      for(var temp = 0; temp < storedFiles.length; temp++) {
          if(storedFiles[temp].name == $(this).parent().children('img').attr('name')) {
              storedFiles.splice(temp, 1);
              break;
           }
      }
        
      if( $("#image_preview").children().length == 0){
        $(".main-photo-tag").hide()
      }
      
      if(full_num < imglimit) $("#multipleImages").hide()
    })

    function progress(name, scr,total_file, i){
      $(".progress_bar_f_len").text(total_file + "image(s) uploading ....")
      $(".img-thumbnail").attr("src", scr);
      var j = 0;
        if (j == 0) {
          j = 1;
          var bar = $("#bar");
          var width = total_file/imglimit;
          var id = setInterval(frame, total_file*5);
          function frame() {
            if (width >= 100) {
              clearInterval(id);
              $(".photo_progress").hide()
              j = 0;
              bar.css("width","")

              var  preview_html = 
                "<div class='photo_container'>"+
                  "<div class='delete_photo' id="+ i +">×</div>"+
                  "<img class='photo_preview' src='"+scr+"' name='"+ name+"' >"+
                "</div>";
                $('#image_preview').append(preview_html);
                $(".main-photo-tag").show();
                img_len = $("#image_preview").children().length;
                $(".image_length").text(''+img_len +'files uploaded');
            } else {
              width++;
              bar.css("width", width + "%" )
            }
          }
        }
      }
  // 
  function FileListItems (files) {
    var b = new ClipboardEvent("").clipboardData || new DataTransfer()
    for (var i = 0, len = files.length; i<len; i++) b.items.add(files[i])
    return b.files
  }
  
  $("#submit-button").click(function (e) {
    $("#roller").addClass("hdd");
    e.preventDefault();
      var title = $('#title').val();
    var year = $('#year' ).val();
    var make_id = $('#make_id').val();
    var model_id = $('#model_id').val();
    var price = $('#price' ).val();
    var mileage = $('#mileage').val();
    var body_type = $('#body_type').val();
    var des = $('#des' ).val();
    var mobile = $('#mobile').val();
 
    if(year && title  && make_id && model_id  && price && mileage  && body_type && des  && mobile ){
      $("#roller").removeClass("hdd");
    }

    var list=[];

    for(var num=0;num<$("#image_preview").children('.photo_container').length;num++){
      for(var store_num = 0; store_num < storedFiles.length;store_num++){
        if(storedFiles[store_num].name == $("#image_preview").children("div:eq("+num+")").children(".photo_preview").attr('name')) {
                list.push(storedFiles[store_num]);
              break;
           }
      }
    }
    $('.input-file').prop('files',FileListItems(list));
    console.log($('.input-file').prop('files'));
    // var real_list = [];
    // for(var real = 0; real < list.length;real++){
    //   var blob = list[real].slice(0, list[real].size, 'image/png'); 
    //   var newFile = new File([blob], ''+"carimgend"+real+''+'.png', {type: 'image/png'});
    //   real_list.push(newFile);
    //   list[real].name = "carimg"+real+"end";
    // }
    // console.log(real_list);


    $("#post_form").submit();
  });

  })
</script>
