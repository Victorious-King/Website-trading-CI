<div class="contact-form">
                    <div class="form-cont">
                    <?php if ($_SESSION["sess_alert"] && $_GET['succ'] == 2) { ?> 
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION["sess_alert"]; ?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <?php } ?>

                          <?php if ($_SESSION["sess_alert"] && $_GET['succ'] == 1) { ?> 
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION["sess_alert"]; ?>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <?php } ?>

                    <form method="post" id="enquiry_form" action="<?php echo base_url()?>main/emailCar">
                          <input type="hidden" name="last_link" value="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

                          <input type="hidden" name="ad_link" value="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

                          <input type="hidden" name="user_id" value="<?php echo $car['user_id']; ?>" />

                        <h3><?php echo $this->lang->line('contact_the_seller');?></h3>
                        <div class="form-group">
                          <label for="name"><?php echo $this->lang->line('name');?></label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            placeholder="<?php echo $this->lang->line('enter_name');?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email"><?php echo $this->lang->line('email_address');?></label>
                          <input
                            name="email"
                            type="text"
                            class="form-control"
                            id="email"
                            placeholder="<?php echo $this->lang->line('enter_email_address');?>"
                          />
                          
                        </div>
                        <div class="form-group">
                          <label for="contact"><?php echo $this->lang->line('contact_number');?></label>
                          <input
                            type="text"
                            name="contact"
                            class="form-control"
                            id="contact"
                            placeholder="<?php echo $this->lang->line('enter_contact_number');?>"
                          />
                        </div>
                        <div class="form-group">
                          <label for="message"><?php echo $this->lang->line('message');?></label>
                          <textarea
                            name="message"
                            class="form-control"
                            id="message"
                            rows="3"
                          ></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                        <?php echo $this->lang->line('send');?>
                        </button>
                      </form>
                    </div>
                  </div>