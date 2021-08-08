<?php include('includes/header.php');?>

<section id="options-main">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="options-card">
          <div class="header">
            Make your AD stand out <?php echo $sdsdsd; ?>
          </div>
          <div class="features">
            <ul>
              <li>Your ad appears in a section at the top of the page</li>
              <li>More people see and reply to top ads because of their prominent position</li>
              <li>Your ad on top for 15 days</li>              
            </ul>
            <div class="form-cont">
              <form action="">
                <label>
                  <input name="ad_featured" type="checkbox" value="Yes" class="filled-in" onchange="valueChanged()"/>
                  <span>Make AD Featured </span>
                </label>
                <div class="btn-cont" id="checkout">
                  <a href="<?php echo base_url()?>checkout/<?php echo $product_featured['id'] ?>" class="btn add-to-cart">Proceed to checkout</a>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="freead-cont">
          <div class="or-text">
            or
          </div>
          <div class="text">
            Skip to continue as <span>FREE</span> AD
          </div>
          <div class="freead-btn">
            <a href="<?php echo base_url()?>success/adsuccess" class="btn">Post my ad</a>
          </div>
        </div>
        
      </div>

      <div class="cart-cont">
          <div class="title">
          Order summary
          </div>
          <div class="sub-title">
          Your order total is
          </div>
          <div class="price">
          99 AED
          </div>
        </div>
        
    </div>
  </div>
</section>

<?php include('includes/footer.php');?>

<script type="text/javascript">
$("#checkout").hide();
$(".cart-cont").hide();

function valueChanged()
{
    if($('.filled-in').is(":checked")){ 
        $(".cart-cont").show();
        $("#checkout").show();
        $(".freead-cont").hide();
    }else{
        $(".cart-cont").hide();
        $("#checkout").hide();
        $(".freead-cont").show();
    }
}

$(document).ready(function(){
      $("input[name='ad_featured']").click(function(){
        var valu=[];
        $.each($("input[name='ad_featured']:checked"), function(){            
                valu.push($(this).val());
            });
        if (valu) {
          $('.add-to-cart').attr('href',"<?php echo base_url()?>checkout/<?php echo $product_featured['id'] ?>/"+valu);
        }else{
          $('.add-to-cart').attr('href',"<?php echo base_url()?>checkout/<?php echo $product_featured['id'] ?>/");
        }
      });
    });
</script>