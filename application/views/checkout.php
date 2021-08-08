<?php include('includes/header.php');?>


<section id="checkout-cont">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="form-cont">
            <!-- <form id="myCCForm" action="<?php echo base_url()?>TwoCheckoutPayment/callback" method="post">
              <input name="token" type="hidden" value="" />
              <div>
                <label>
                  <span>Card Number</span>
                  <input id="ccNo" type="text" value="" autocomplete="off" required />
                </label>
              </div>
              <div>
                <label>
                  <span>Expiration Date (MM/YYYY)</span>
                  <input id="expMonth" type="text" size="2" required />
                </label>
                <span> / </span>
                <input id="expYear" type="text" size="4" required />
              </div>
              <div>
                <label>
                  <span>CVC</span>
                  <input id="cvv" type="text" value="" autocomplete="off" required />
                </label>
              </div>
              <input class="btn" type="submit" value="Submit Payment" />
            </form> -->
            <form action="<?php print site_url(); ?>checkout/callback" method="POST" id="myCCForm">
                <input id="token" name="token" type="hidden" value="">
                
                <input type="hidden" name="product_name" value="<?php echo $product_info['name'];?>">
                <input type="hidden" name="product_id" value="<?php echo $product_info['id'];?>">
                <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 pb-5">
                <div class="row"></div>
                    <!--Form with header-->
                        <div class="card border-gray rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-gray text-left py-2">
                                    <h5 class="pl-2"><strong>Item Name: </strong><?php echo $product_info['name'];?></h5> 
                                    <h6 class="pl-2"><strong>Price: </strong> AED <?php echo number_format($product_info['price']);?> </h6>
                                </div>
                            </div>
            
                            <div class="card-body p-3">                                
                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Full Name</div>
                                        </div>
                                        <input type="text" class="form-control" id="2checkout-name" name="2checkout_name" placeholder="Full Name *" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Email</div>
                                        </div>
                                        <input type="email" class="form-control" id="2checkout-email" name="2checkout_email" placeholder="Email *" required>
                                    </div>
                                </div>                                
                                
                                  <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Card Number</div>
                                        </div>
                                        <input id="ccNo" type="text" size="20" class="form-control" autocomplete="off" placeholder="1234 5678 9012 3456" required />                            
                                    </div>
                                  </div>
                                  <div class="form-row">
                                  <div class="form-group col-md-5">
                                        <input type="text" class="form-control" name="tcheckout_month" placeholder="MM" maxlength="2" id="expMonth" required autocomplete="off"/>
                                  </div>
                                  <div class="form-group col-md-5">
                                        <input type="text" class="form-control" name="tcheckout_year" placeholder="YYYY" maxlength="4" id="expYear" autocomplete="off" required />
                                  </div>
                                  <div class="form-group col-md-2">
                                        <input id="cvv" maxlength="4" type="text" class="form-control"  name="cvc" placeholder="CVC" autocomplete="off" required />
                                  </div>
                                  </div>
            
                                <div class="text-right">
                                    <a href="<?php print site_url();?>" id="payBtn" class="btn btn-primary py-2">Back</a> 
                                    <button type="buttom" id="payBtn" class="btn btn-info py-2">Pay</button>
                                </div>
                                
                            </div>
                            
                        </div> 
                          <div>                
                            </div>
                      </div>
                    </div>    
            </form>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include('includes/footer.php');?>
<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
<script>
      var successCallback = function(data) {
          var myForm = document.getElementById('myCCForm');
          myForm.token.value = data.response.token.token;
          myForm.submit();
      };
      var errorCallback = function(data) {
          if (data.errorCode === 200) {
              tokenRequest();
          } else {
              alert(data.errorMsg);
          }
      };
      var tokenRequest = function() {
          var args = {
              sellerId: "<?php print TWOCHECKOUT_SELLER_ID; ?>",
              publishableKey: "<?php print TWOCHECKOUT_PUBLISHABLE_KEY;?>",
              ccNo: $("#ccNo").val(),
              cvv: $("#cvv").val(),
              expMonth: $("#expMonth").val(),
              expYear: $("#expYear").val()
          };
          TCO.requestToken(successCallback, errorCallback, args);
      };
      $(function() {
          TCO.loadPubKey('sandbox');
          $("#myCCForm").submit(function(e) {
              tokenRequest();
              return false;
          });
      });
  </script>