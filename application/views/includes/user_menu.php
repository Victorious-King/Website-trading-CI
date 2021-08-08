<div class="user-menu sticky">
              <ul class="side-menu">
              <a href="<?php echo base_url()?>myaccount/dashboard">
                <li class="<?php if ($this->uri->rsegment(2) == 'dashboard') {?>active<?php  } ?>">                  
                    <i class="fas fa-tachometer-alt"></i> <?php echo $this->lang->line('dashboard');?>                  
                </li>
                </a>
                <a href="<?php echo base_url()?>myads">
                <li class="<?php if ($this->uri->rsegment(1) == 'myads') {?>active<?php  } ?>">
                   <i class="fas fa-list-ul"></i> <?php echo $this->lang->line('my_ads');?>
                </li>
                </a>
                <a href="<?php echo base_url()?>postad">
                <li class="<?php if ($this->uri->rsegment(1) == 'postad') {?>active<?php  } ?>">
                   <i class="fas fa-bullhorn"></i> <?php echo $this->lang->line('post_an_ad');?>
                </li>
                </a>
                <a href="<?php echo base_url()?>myaccount/settings">
                <li>
                   <i class="fas fa-user"></i> <?php echo $this->lang->line('my_account');?>
                </li>
                </a>
              </ul>
            </div>