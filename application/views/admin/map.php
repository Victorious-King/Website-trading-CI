<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>      
<script type="text/javascript">
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



//   $(document).ready(function() {
  
//     $("#pname").keyup(function (e) {        
//         var pname = $(this).val();
        
//         if(pname.length < 4){$("#user-result").html('');return;}
        
//         if(pname.length >= 4){
//             $("#pname_avail").html('<img src="<?php echo base_url()?>themes/images/name_avail_loader.gif" />');
//             $.post('<?php echo base_url()?>admin/deusers/checkPname', {'pname':pname}, function(data) {
//               $("#pname_avail").html(data);
//             });
//         }
//     }); 
//     });
</script>

<style>
#map_container div {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
}
.gm-style-iw {
width: 90px; 
min-height: 20px;
}
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script>
var country;
var geolat;
var geolng;
var geocoder;
var map;
var marker;

function initialize() {
	var geolat = '24.4667'
	var geolng = '54.3667'
	var zm = 11;
	if (geolat=='' || geolng=='' || geolat==0 || geolng==0)  
	{
		geolat= 24.4667;
		geolng= 54.3667; 
		zm = 7;
	}

  geocoder = new google.maps.Geocoder();
  
  var LatLng = new google.maps.LatLng(geolat, geolng);
  var mapOptions = {
    zoom: zm,
    center: LatLng,
    panControl: true,
    zoomControl: true,
    scaleControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  

map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	  var $geolat = document.getElementById('geolat');
	  var $geolng = document.getElementById('geolng');
	  $geolat.value = LatLng.lat();
	  $geolng.value = LatLng.lng();
	  placeMarker(LatLng);



  google.maps.event.addListener(marker, 'dragend', function(marker){
            var latLng = marker.latLng;
            $geolat.value = latLng.lat();
            $geolng.value = latLng.lng();
            copyIt();
        });


}



function codeAddress(address) {

 geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK)  {
          var $geolat = document.getElementById('geolat');
          var $geolng = document.getElementById('geolng');
          var geolat=results[0].geometry.location.lat();
          var geolng=results[0].geometry.location.lng();
          var LatLng = new google.maps.LatLng(geolat, geolng);
          $geolat.value = LatLng.lat();
          $geolng.value = LatLng.lng();
          placeMarker(results[0].geometry.location);



          google.maps.event.addListener(marker, 'dragend', function(marker){
            var latLng = marker.latLng;
            $geolat.value = latLng.lat();
            $geolng.value = latLng.lng();
        });

       if (results[0].geometry.viewport) 
          map.fitBounds(results[0].geometry.viewport);

      copyIt();

   } else {
      alert('Location not found');
    }
  });
 
}


function placeMarker(location) {
    

    if (marker) {
        //if marker already was created change positon

        marker.setPosition(location);
        map.setCenter(marker.getPosition());

    } else {
        //create a marker
            marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true            
        });
           
        	map.setCenter(marker.getPosition());
        	var contentString = '<b>Click and Drag</b>';

        	var infowindow = new google.maps.InfoWindow({
      				content: contentString
  			});
            infowindow.open(map,marker);

    }
   
  }

google.maps.event.addDomListener(window, 'load', initialize);

</script>


<script type = "text/javascript">
function copyIt() { 
	
	if (document.getElementById("copylatcar")) {
		var x = document.getElementById("geolat").value;
		document.getElementById("copylatcar").value = x;
		var x = document.getElementById("geolng").value;
		document.getElementById("copylngcar").value = x;
	}

	if (document.getElementById("copylatrent")) {
		var x = document.getElementById("geolat").value;
		document.getElementById("copylatrent").value = x;
		var x = document.getElementById("geolng").value;
		document.getElementById("copylngrent").value = x;
	}
	
	if (document.getElementById("copylatbike")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatbike").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngbike").value = x;
}

	if (document.getElementById("copylatmobile")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatmobile").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngmobile").value = x;
}


if (document.getElementById("copylatparts")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatparts").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngparts").value = x;
}


if (document.getElementById("copylatplates")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatplates").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngplates").value = x;
}

if (document.getElementById("copylatcaravan")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatcaravan").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngcaravan").value = x;
}

if (document.getElementById("copylatboat")) {
	var x = document.getElementById("geolat").value;
	document.getElementById("copylatboat").value = x;
	var x = document.getElementById("geolng").value;
	document.getElementById("copylngboat").value = x;
}

}

$(document).ready(function() {
	$("#find_btn").hide();
  
  $( "#address" ).keyup(function() {
    	$("#find_btn").show();
  });

 

});

</script>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
        <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-laptop"></i> Dealers</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
            <li><i class="fa fa-car"></i>Dealers</li>               
          </ol>
        </div>
      </div>
              
            <div class="row">
        <div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add car dealer
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
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="<?php echo base_url();?>admin/deusers/<?php echo ($actionType=='add'?'insertdeuser':'updatedeuser')?>/" enctype="multipart/form-data">
                                      <input type="hidden" name="user_id" id="user_id" value="<?php echo $user['id']; ?>"  />

                                      <input type="hidden" name="last_link" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
                                      
                                      <div class="form-group "> 
                                          <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            User Detail 
                                          </header>

                                          <label for="starting_date" class="control-label col-lg-2">User type<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="user_type" name="user_type" class="form-control m-bot15" onchange="getCity(this.value)">
                                                  <option>Select type</option>                                                  
                                                  <option value="Dealer" <?php echo ($user['user_type']=="Dealer"?'selected':'');?>>Dealer</option>
                                                  <option value="Private" <?php echo ($user['user_type']=="Private"?'selected':'');?>>Private</option>
                                                                                     
                                              </select>
                                          </div>
                                      </div>

                                   

                                     <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Name<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="pname" name="pname" value="<?php echo $user['pname']; ?>" placeholder=""/>
                                          </div>

                                          
                                      </div>

                                     

                                      <div class="form-group ">                                                 
                                          <label for="" class="control-label col-lg-2">Address<span class="required">*</span></label>
                                          <div class="col-lg-10">                                              
                                                  <textarea class="form-control" name="address" rows="6"><?php echo $user['address']; ?></textarea>
                                          </div>
                                      </div>                                      

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">Country<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="country" name="country" class="form-control m-bot15" onchange="getCity(this.value)">
                                                  <option>Select country</option>
                                                  <?php 
                                                  foreach($countries as $country) { 
                                                  ?>
                                                  <option value="<?php echo $country['country']; ?>" <?php echo ($user['country']==$country['country']?'selected':'');?>><?php echo $country['country'];?></option>
                                                  <?php } ?>                                    
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="starting_date" class="control-label col-lg-2">City<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <select id="city" name="city" class="form-control m-bot15">
                                                      <?php foreach($city_list as $city){
                                                        $selected = ($user['city']==$city['city']?'selected':'');
                                                      ?>
                                                      <option value="<?php echo $city['city']?>" <?php echo $selected?>><?php echo $city['city']?></option>
                                                      <?php }?>                                
                                              </select>
                                          </div>
                                      </div>                                     

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Postal address<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="postal" name="postal" value="<?php echo $user['postal']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Telephone#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="tel" name="tel" value="<?php echo $user['tel']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                       <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Mobile#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Fax#<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="fax" name="fax" value="<?php echo $user['fax']; ?>" placeholder=""/>
                                          </div>
                                      </div>    

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Website<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="website" name="website" value="<?php echo $user['website']; ?>" placeholder=""/>
                                          </div>
                                      </div>   

                                                                    

                                      <div class="form-group ">                                                 
                                          <label for="" class="control-label col-lg-2">About dealer<span class="required">*</span></label>
                                          <div class="col-lg-10">                                              
                                                  <textarea class="form-control" name="des" rows="6"><?php echo $user['des']; ?></textarea>
                                          </div>
                                      </div>                     

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Email (User name)<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Password<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="password" name="password" type="password" value="<?php echo $user['password']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Limit car<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="limit_car" name="limit_car" type="text" value="<?php echo $user['limit_car']; ?>" placeholder=""/>
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">User logo<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="logoimg[]" class="input-file uniform_on"  type="file">                                               
                                          </div>
                                      </div>
                                      

                                      <div class="control-group">
                                  
                                            <?php if(!empty($assets_logo)){ 
                                                foreach($assets_logo as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?>
                                            
                                                
                                            <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                            <a class="btn btn-danger" href="<?php echo base_url()?>admin/Deusers/removeAsset/<?php echo $img['id'];?>/<?php echo $user['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                            </a>
                                            
                                            <?php }} ?>
                                        </div>


                                      <div class="form-group ">  
                                       <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Showroom cover
                                        </header>                                        
                                          <label for="" class="control-label col-lg-2">Image1<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on"  type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image2<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on"  type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image3<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on"  type="file"> 
                                          </div>
                                      </div>

                                      <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Image4<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="files[]" class="input-file uniform_on"  type="file"> 
                                          </div>
                                      </div>

                                      <div class="control-group">
                                  
                                          <?php if(!empty($assets)){ 
                                            foreach($assets as $img){
                                            $image= $this->asset_model->getImage($img['image'],'400x185');
                                          ?>
                                          
                                               
                                          <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                          <a class="btn btn-danger" href="<?php echo base_url()?>admin/Deusers/removeAsset/<?php echo $img['id'];?>/<?php echo $user['id'];?>">
                                          <i class="fa fa-trash" aria-hidden="true"></i> 
                                        </a>
                                          
                                          <?php }} ?>
                                      </div>

                                      <!-- sdasdasd -->

                                      <div class="form-group ">  
                                       <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Showroom cover
                                        </header>                                        
                                        <div class="map-add-dv" style="">

                                        <div> 
                                            <div>
                                            <h2>dsad</h2>
                                                <p id="post_ads"><input type="text" id="address" placeholder=''/></p>
                                                

                                                <span id="post_ads"><input type="button" value="" onClick="codeAddress(document.getElementById('address').value);" id="find_btn"></span>
                                                <br />
                                                <br />
                                                <div id="map-canvas" style="width:745px; height:450px"></div>
                                            </div>
                                        </div>


                                            <input type="text" name="lat" value="" id = "geolat"  >
                                            <input type="text" name="lng" value="" id = "geolng">

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