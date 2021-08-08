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




</script>

<script
      type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3O13i8ni_htZxfgGqpYUmq45-tyPda8g&sensor=false&libraries=places"
    ></script>

    <style type="text/css">
      .input-controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
      #searchInput {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 50%;
      }
      #searchInput:focus {
        border-color: #4d90fe;
      }
    </style>

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
                                        
                                        <?php 
                                          $type = explode(',', $user['user_type_lists']);
                                          
                                        ?>

                                          <div class="form-group">
                                                <label class="control-label col-lg-2" for="inputSuccess">User Type</label>
                                                <div class="col-lg-10">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="cars" name="user_type_lists[]" <?php echo $checked = ((in_array('cars', $type))?"checked":""); ?> > Cars
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="boats" name="user_type_lists[]" <?php echo $checked = ((in_array('boats', $type))?"checked":""); ?>> Boats
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="bikes" name="user_type_lists[]" <?php echo $checked = ((in_array('bikes', $type))?"checked":""); ?>> Bikes
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="number plates" name="user_type_lists[]" <?php echo $checked = ((in_array('number plates', $type))?"checked":""); ?>> Number plates
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="mobile numbers" name="user_type_lists[]" <?php echo $checked = ((in_array('mobile numbers', $type))?"checked":""); ?>> Mobile numbers
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" id="" value="rents" name="user_type_lists[]" <?php echo $checked = ((in_array('rents', $type))?"checked":""); ?>> Rent a car
                                                    </label>
                                                </div>
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
                                          <label for="" class="control-label col-lg-2">Facebook<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control"  name="fb_handle" value="<?php echo $user['fb_handle']; ?>" placeholder="@fb_handle"/><br>
                                              <input class="form-control" name="fb_link" value="<?php echo $user['fb_link']; ?>" placeholder="FB link"/>
                                          </div>
                                      </div> 
                                      
                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Instagram<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" name="insta_handle" value="<?php echo $user['insta_handle']; ?>" placeholder="@insta_handle"/><br>
                                              <input class="form-control"  name="insta_link" value="<?php echo $user['insta_link']; ?>" placeholder="@insta_link"/>
                                          </div>
                                      </div> 

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Twitter<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" name="twt_handle" value="<?php echo $user['twt_handle']; ?>" placeholder="@twitter_handle"/><br>
                                              <input class="form-control"  name="twt_link" value="<?php echo $user['twt_link']; ?>" placeholder="@twitter_link"/>
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

                                      <div class="form-group ">                                       
                                          <label for="" class="control-label col-lg-2">Limit Featured AD<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="limit_featured" name="limit_featured" type="text" value="<?php echo $user['limit_featured']; ?>" placeholder=""/>
                                          </div>
                                      </div>
                                      

                                      <div class="control-group">
                                  
                                            <?php if(!empty($assets_logo)){ 
                                                foreach($assets_logo as $img){
                                                $image= $this->asset_model->getImage($img['image'],'170x173');
                                            ?>

                                            <ul>
                                                  <li>
                                                  <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                            
                                                  </li>
                                                  <li>
                                                  <a class="btn btn-danger" href="<?php echo base_url()?>admin/Deusers/removeAsset/<?php echo $img['id'];?>/<?php echo $user['id'];?>">
                                                  <i class="far fa-trash-alt"></i>
                                                  </a>
                                                  </li>
                                            </ul>

                                            
                                                
                                            
                                            
                                            </a>

                                            <br><br>
                                            
                                            <?php }} ?>
                                        </div>

                                    <div class="form-group ">  
                                       <header class="panel-heading" style="margin:-1px;margin-bottom:15px;margin-top:-15px;">
                                            Showroom Location
                                        </header> 
                                        <input type="hidden" name="loc" id="location" value="<?php echo ($user['loc']?$user['loc']:'Dubai');?>" />
                                        <input type="hidden" name="lat" id="lat" value="<?php echo ($user['lat']?$user['lat']:'23.372514');?>" />
                                        <input type="hidden" name="lng" id="lng" value="<?php echo ($user['lng']?$user['lng']:'54.447327');?>" /> 
                                                          <br>     
                                        <div class="form-group ">                                        
                                          <label for="" class="control-label col-lg-2">Location logo marker<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input name="logomarker[]" class="input-file uniform_on"  type="file">                                               
                                          </div>
                                      </div>

                                      <div class="control-group">
                                  
                                            <?php if(!empty($assets_marker)){ 
                                                foreach($assets_marker as $img){
                                                $image= $this->asset_model->getImage($img['image'],'56x70');
                                            ?>
                                            
                                                
                                            <img class="item-view" id='' src="<?php echo base_url().$image; ?>"  /><br>
                                            <a class="btn btn-danger" href="<?php echo base_url()?>admin/Deusers/removeAsset/<?php echo $img['id'];?>/<?php echo $user['id'];?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                            </a>
                                            
                                            <?php }} ?>
                                        </div>


                                          <label for="" class="control-label col-lg-2">Find loction<span class="required">*</span></label>

                                          <div class="col-lg-10">
                                          <input
                                            id="searchInput"
                                            class="input-controls"
                                            type="text"
                                            placeholder="Enter a location"
                                            />
                                            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                          </div>

                                         
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

<script>
      /* script */
      function initialize() {
        
        var latlng = new google.maps.LatLng(<?php echo ($user['lat']?$user['lat']:'23.372514');?>, <?php echo ($user['lng']?$user['lng']:'54.447327');?>);
        var map = new google.maps.Map(document.getElementById('map'), {
          center: latlng,
          zoom: 7
        });
        var marker = new google.maps.Marker({
          map: map,
          position: latlng,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var geocoder = new google.maps.Geocoder();
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
          }

          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          bindDataToForm(
            place.formatted_address,
            place.geometry.location.lat(),
            place.geometry.location.lng()
          );
          infowindow.setContent(place.formatted_address);
          infowindow.open(map, marker);
        });
        // this function will work on marker move event into map
        google.maps.event.addListener(marker, 'dragend', function() {
          geocoder.geocode({ latLng: marker.getPosition() }, function(
            results,
            status
          ) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {
                bindDataToForm(
                  results[0].formatted_address,
                  marker.getPosition().lat(),
                  marker.getPosition().lng()
                );
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
              }
            }
          });
        });
      }
      function bindDataToForm(address, lat, lng) {
        document.getElementById('location').value = address;
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>