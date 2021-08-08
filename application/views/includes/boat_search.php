<script type="text/javascript">

  function search_boat() {
  
  var boat_type = $("#boat_type option:selected").attr('id');
  
  var boat_make = $("#boat_make option:selected").attr('id');
  

  val = '';

  if (boat_type != '' && typeof (boat_type) != 'undefined') {
    val = val + boat_type + '/';
  }

  if (boat_make != '' && typeof (boat_make) != 'undefined') {
    val = val + boat_make + '/';
  }


  if (typeof ($("#sort option:selected").val()) != 'undefined') {
    document.search_boat_form.st.value = $("#sort option:selected").val();
  }


  var res = val.replace(/ /g, "-");

  document.search_boat_form.action = '<?php echo base_url(); ?>boats/'+res;
  document.search_boat_form.submit();   
}
  </script>
<div class="search-filter sticky">
<form id="search_boat_form" name="search_boat_form" method="get">
<input type="hidden" name="st" value="<?php echo $this->input->get('st'); ?>">
<div class="form-group">
                  <label><?php echo $this->lang->line('select_type');?></label>
                  <select name="boat_type" id="boat_type" class="form-control m-bot15" >
                <option value=""><?php echo $this->lang->line('select_type');?></option>
                                    <?php foreach ($boat_type as $bt){ ?>
                                      <option value="<?php echo $bt['id']?>" <?php echo ($this->input->get('boat_type')==$bt['id']?'selected':'');?> id="<?php echo $bt['type']?>"><?php echo $bt['type']; ?></option> 
                                    <?php } ?>                                   
              </select>  
                </div>

                <div class="form-group">
                  <label><?php echo $this->lang->line('select_make');?></label>
                  <select name="boat_make" id="boat_make" class="form-control m-bot15">
                <option value=""><?php echo $this->lang->line('select_make');?></option>                                     
                                    <?php foreach ($boat_make as $mk){ ?>
                                      <option value="<?php echo $mk['id']?>" <?php echo ($this->input->get('boat_make')==$mk['id']?'selected':'');?> id="<?php echo $mk['make']?>"><?php echo $mk['make']; ?></option>                           
                                    <?php } ?>                                   
              </select>  
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

                <div class="form-group">
                  <label><?php echo $this->lang->line('select_length');?></label>
                  <input type="text" id="lengthslider" name="length" 
                  value="" 
                  
                   />           
                </div>
                <div class="form-group">
                  <label><?php echo $this->lang->line('select_condition');?></label>
                  <select id="condition" name="condition" class="form-control m-bot15">
                                                  <option value=""><?php echo $this->lang->line('select_condition');?></option>

                                                  <option value="New" <?php echo ($this->input->get('condition')=='New'?'selected':'');?>><?php echo $this->lang->line('new');?></option>
                                                  <option value="Used" <?php echo ($this->input->get('condition')=='Used'?'selected':'');?>><?php echo $this->lang->line('used');?></option>
                                                                                     
                                              </select>
                </div>

                <button onClick="search_boat()" class="btn"><?php echo $this->lang->line('search');?></button>
              </form>
              <div class="gads-side">
                  <!-- Vertical Big -->
                  <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-8056224876401935"
                                data-ad-slot="4842786465"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
              </div>
            </div>