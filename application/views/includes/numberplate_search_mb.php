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


  function search_numberplate() {  

    val = '';

    if (typeof ($("#sort option:selected").val()) != 'undefined') {
    document.search_plate_form.st.value = $("#sort option:selected").val();
  }
  var res = val.replace(/ /g, "-");

  document.search_plate_form.action = '<?php echo base_url(); ?>numberplates/'+res;;
  document.search_plate_form.submit();   
}
  </script>
<div class="search-filter sticky">
<h3><?php echo $this->lang->line('filter_your_search');?></h3>
<form id="search_plate_form" name="search_plate_form" method="get">
<input type="hidden" name="st" value="<?php echo $this->input->get('st'); ?>">
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_emirate');?></label>
                        <select id="city_id" name="city_id" class="form-control m-bot15" onchange="getCityCode(this.value);">
                                                  <option value=""><?php echo $this->lang->line('select_emirate');?></option>
                                                  <?php 
                                                  foreach($plate_city as $pc) { 
                                                  ?>
                                                  <option value="<?php echo $pc['id']; ?>" <?php echo ($this->input->get('city_id')==$pc['id']?'selected':'');?>><?php echo $pc['city'];?></option>
                                                  <?php } ?>                                    
                        </select>
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_code');?></label>
                                          <select name="citycode_id" id="citycode_id" class="form-control m-bot15">
                                              <option value=""><?php echo $this->lang->line('select_emirate_first');?></option>
                                              <?php foreach($citycode as $cc) { ?>
                                              <option value="<?php echo $cc['id']; ?>" <?php echo ($this->input->get('citycode_id')==$cc['id']?'selected':'');?>><?php echo $cc['code'];?></option>
                                              <?php } ?>
                                          </select>
                </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('enter_number');?></label>
                  <input class="form-control" type="text" value="<?php echo $this->input->get('number');?>" name="number"/>
                </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('select_digit');?></label>
                  <input type="text" id="digitmb" name="digit" 
                  value="" 
                  data-min="All"
                  data-max="5"
                  data-from="<?php echo $this->input->get('digit');?>"
                  data-to="500"
                   />           
                </div>
            

             

                <button onClick="search_numberplate()" class="btn"><?php echo $this->lang->line('search');?></button>
              </form>
            
            </div>




