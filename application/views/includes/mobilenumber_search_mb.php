<script src="<?php echo theme_url()?>js/jquery.min.js"></script>
<script type="text/javascript">
  function getOpcode(code){    
    //alert(code);
     var op = "<?php echo $this->input->get('operator_code'); ?>"; 
         

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

  var code = "<?php echo $this->input->get('operator'); ?>";       
  getOpcode(code);
  });


  function search_mobilenumber() { 
    
    var operator = $("#operator option:selected").attr('id'); 

    val = '';

    if (operator != '' && typeof (operator) != 'undefined') {
    val = val + operator + '/';
  }

    if (typeof ($("#sort option:selected").val()) != 'undefined') {
    document.search_mobilenumber_form.st.value = $("#sort option:selected").val();
  }
  var res = val.replace(/ /g, "-");

  document.search_mobilenumber_form.action = '<?php echo base_url(); ?>mobilenumbers/'+res;;
  document.search_mobilenumber_form.submit();   
}
  </script>
<div class="search-filter sticky">
<h3><?php echo $this->lang->line('filter_your_search');?></h3>
<form id="search_mobilenumber_form" name="search_mobilenumber_form" method="get">
<input type="hidden" name="st" value="<?php echo $this->input->get('st'); ?>">
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_operator');?></label>
                        <select id="operator" name="operator" class="form-control m-bot15" onchange="getOpcode(this.value);">
                                                  <option value=""><?php echo $this->lang->line('select_operator');?></option>
                                                  <?php 
                                                  foreach($operator as $key => $value) { 
                                                  ?>
                                                  <option id="<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo (str_replace("-", " ", $this->input->get('operator'))==$value?'selected':'');?>><?php echo $value;?></option>
                                                  <?php } ?>                                      
                        </select>
                </div>
                
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_code');?></label>
                        <select name="operator_code" id="operator_code" class="form-control m-bot15" onchange="change_operator_code(this.value);">
                          <option value=""><?php echo $this->lang->line('select_operator_first');?></option>                 
                        </select>
                </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('enter_number');?></label>
                  <input class="form-control" type="text" value="<?php echo $this->input->get('number');?>" name="number"/>
                </div>

                
            

             

                <button onClick="search_mobilenumber()" class="btn"><?php echo $this->lang->line('search');?></button>
              </form>
             
            </div>

