<script type="text/javascript">
function getModelList(id){

    if(id!=''){
        $.ajax
        ({
        type: "GET",        
        url: "<?php echo base_url(); ?>main/getModelList/"+id,
        cache: false,
        success: function(html)
        {
        $("#car_model11").html(html);
        } 
        });
      }
  }

  $(document).ready(function(){ 

    var make_id = $("#car_make option:selected").attr('value');
    var car_model = $("#car_model option:selected").attr("id");

    //alert(car_model);

    
    getModelList(make_id,car_model);
  });

  function search_car() {  
  
  var car_make = $("#car_make option:selected").attr('id');
  //alert(car_make);
  var car_model = $("#car_model option:selected").attr('id');

  //var city = $("#city option:selected").attr('id');
  //alert(city);

  val = '';

  // if (city != '' && typeof (city) != 'undefined') {
  //   val = val + city + '/';
  // }

  if (car_make != '' && typeof (car_make) != 'undefined') {
    val = val + car_make + '/';
  }

  if (car_model != '' && typeof (car_model) != 'undefined') {
    val = val + car_model + '/';
  }

  
  


  if (typeof ($("#sort option:selected").val()) != 'undefined') {
    document.search_car_formnw.st.value = $("#sort option:selected").val();
  }


  var res = val.replace(/ /g, "-");

  document.search_car_formnw.action = '<?php echo base_url(); ?>used-cars/'+res;
  document.search_car_formnw.submit();   
}
  </script>
<div class="search-filter sticky">
  <form id="search_car_formnw" name="search_car_formnw" method="get">
  <input type="hidden" name="st" value="<?php echo $this->input->get('st'); ?>">
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_city');?></label>
                                          <select name="city" id="city" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_city');?></option>
                                              <?php foreach($city as $ct) { ?>
                                              <option id="<?php echo str_replace(" ", "-", $ct) ?>" value="<?php echo str_replace(" ", "-", $ct) ?>" <?php echo ($this->input->get('city')==str_replace(" ", "-", $ct) ?'selected':'');?>><?php echo $ct; ?></option>
                                              <?php } ?>
                                          </select>
                </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('select_condition');?></label>
                  <select id="condition" name="condition" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_condition');?></option>

                                                  <option value="New" <?php echo ($this->input->get('condition')=='New'?'selected':'');?>><?php echo $this->lang->line('new');?></option>
                                                  <option value="Used" <?php echo ($this->input->get('condition')=='Used'?'selected':'');?>><?php echo $this->lang->line('used');?></option>
                                                  <option value="Classic" <?php echo ($this->input->get('condition')=='Classic'?'selected':'');?>><?php echo $this->lang->line('classic');?></option>
                                                                                     
                                              </select>
                </div>

                  <div class="form-group">
                  <label><?php echo $this->lang->line('select_make');?></label>
                  <select name="car_make" id="car_make" class="form-control m-bot15" onchange="getModelList(this.value);">
                <option value=""><?php echo $this->lang->line('select_make');?></option>
                                     <?php 

                                      if ($this->uri->segment(1)=='ar') {
                                        if ($this->uri->segment(2) == 'Mercedes-Benz') {
                                          $get_make = (str_replace('-', '-', $this->uri->segment(3))) ;
                                        } else{
                                          $get_make = (str_replace('-', ' ', $this->uri->segment(3))) ;
                                        }
                                      }else{
                                        if ($this->uri->segment(2) == 'Mercedes-Benz') {
                                          $get_make = (str_replace('-', '-', $this->uri->segment(2))) ;
                                        } else{
                                          $get_make = (str_replace('-', ' ', $this->uri->segment(2))) ;
                                        }
                                      }
                                    

                                    ?>  

                                    <?php foreach ($make as $mk){ ?>
                                      <option value="<?php echo $mk['id']?>" <?php echo ($get_make==strtolower($mk['make']) || ($this->input->get('car_make')==$mk['id'])?'selected':'');?> id="<?php echo strtolower($mk['make']);?>"><?php echo ($this->uri->segment(1)=='ar'?$mk['make_ar']:($this->uri->segment(1)=='cn'?$mk['make_cn']:$mk['make']))?></option>                           
                                    <?php } ?>                                   
              </select>  
              
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_model');?></label>
                  <select name="car_model" id="car_model11" class="form-control m-bot15">
                <option value=""><?php echo $this->lang->line('select_make_irst');?></option>  
                <?php 
                                        if ($this->uri->segment(1)=='ar') {
                                          $get_model = (str_replace('-', ' ', $this->uri->segment(4))) ; 
                                        }else{
                                          $get_model = (str_replace('-', ' ', $this->uri->segment(3))) ; 
                                        }
                                                                             
                                      ?>  

                                      <?php foreach($model as $md) { ?>
                                          <option value="<?php echo $md['id']; ?>" <?php echo ($this->input->get('car_model')==$md['id']?'selected':'');?> id="<?php echo $md['model']?>"><?php echo ($this->uri->segment(1)=='ar'?$md['model_ar']:$this->uri->segment(1)=='cn'?$md['model_cn']:$md['model']);?></option>
                                      <?php } ?>                
              </select>
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_color');?></label>
                  <select name="ex_color_id" id="ex_color_id" class="form-control m-bot15">
                <option value=""><?php echo $this->lang->line('select_color');?></option>   
                                              <?php foreach($color as $cl) { ?>
                                              <option value="<?php echo $cl['id']; ?>" <?php echo ($this->input->get('ex_color_id')==$cl['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $cl['color_ar']:($this->uri->segment(1) == 'cn' ? $cl['color_cn']:$cl['color']));?></option>
                                              <?php } ?>      
               
              </select>
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_specs');?></label>
                  <select name="specs_id" id="specs_id" class="form-control m-bot15">
                <option value=""><?php echo $this->lang->line('select_specs');?></option>   
                                               
                                              <?php foreach($specs as $sp) { ?>
                                              <option value="<?php echo $sp['id']; ?>" <?php echo ($this->input->get('specs_id')==$sp['id']?'selected':'');?>><?php echo ($this->uri->segment(1) == 'ar' ? $sp['specs_ar']:($this->uri->segment(1) == 'cn' ? $sp['specs_cn']:$sp['specs']));?></option>
                                              <?php } ?> 
               
              </select>
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_type');?></label>
                  <select name="code" id="code" class="form-control m-bot15">
                <option value=""><?php echo $this->lang->line('select_type');?></option>   
                                               
                <option value="D" <?php echo ($this->input->get('code')=='D'?'selected':'');?>>Dealer</option>
                                                  <option value="P" <?php echo ($this->input->get('code')=='P'?'selected':'');?>>Private</option>
               
              </select>
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('search_anything');?></label>
                  <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('search_anything');?>" name="keywords" value="<?php echo $this->input->get('keywords'); ?>">
                 
                </div>
                <ul class="list-inline">
                  <li class="list-inline-item year-min">
                  <div class="form-group">
                  <label><?php echo $this->lang->line('min_year');?></label>
                  <select name="year_min" id="year_min" class="form-control m-bot15">
                      <option value=""><?php echo $this->lang->line('min_year');?></option>
                      <?php 
                        $yearval=date('Y')+1;
                        $yearcount=1;
                        while($yearcount<=100)
                          {
                            $selected_year = ($this->input->get('year_min')==$yearval?'selected':'');
                            echo '<option '.$yearval.' value="'.$yearval.'" '.$selected_year.'>'.$yearval.'</option>';
                            $yearcount++;
                            $yearval--;
                          }
                      ?>
                </select>
                </div>
                  </li>
                  <li class="list-inline-item year-max">
                  <div class="form-group">
                  <label><?php echo $this->lang->line('max_year');?></label>
                  <select name="year_max" id="year_max" class="form-control m-bot15">
                      <option value=""><?php echo $this->lang->line('max_year');?></option>
                      <?php 
                        $yearval=date('Y')+1;
                        $yearcount=1;
                        while($yearcount<=100)
                          {
                            $selected_year = ($this->input->get('year_max')==$yearval?'selected':'');
                            echo '<option '.$yearval.' value="'.$yearval.'" '.$selected_year.'>'.$yearval.'</option>';
                            $yearcount++;
                            $yearval--;
                          }
                      ?>
                </select>
                </div>
                  </li>
                </ul>

                <ul class="list-inline">
                  <li class="list-inline-item price-from">
                  <label><?php echo $this->lang->line('price_from');?></label>
                  <input class="form-control" type="text" placeholder="" name="price_min" value="<?php echo $this->input->get('price_min'); ?>">
                  </li>
                  <li class="list-inline-item price-to">
                  <label><?php echo $this->lang->line('price_to');?></label>
                  <input class="form-control" type="text" placeholder="" name="price_max" value="<?php echo $this->input->get('price_max'); ?>">
                  </li>
                </ul>
                

                <button onClick="search_car()" class="btn"><?php echo $this->lang->line('search');?></button>
              </form>

  <div class="gads-side">
      <!-- Vertical Big -->
    
  </div>
</div>