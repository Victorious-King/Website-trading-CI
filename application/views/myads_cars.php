<?php include('includes/header.php');?>
<script type="text/javascript">
    function renewMyads(id){    
      alert(id);
      document.refresh_frm.ref_id.value = id;          
      document.refresh_frm.submit();
    }
</script>

<form id="refresh_frm" name="refresh_frm" action="<?php echo base_url()?>Myads/refreshMyads" method="post">  
  <input type="hidden" name="ref_id" value="">    
</form>

<section id="breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><?php echo $this->lang->line('home');?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?php echo $this->lang->line('my_ads');?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section id="myaccount-main">
      <div class="container">
        <div class="row">
          <div class="col-md-3 d-none d-lg-block">
          <?php include('includes/user_menu.php');?>
          </div>
          <div class="col-md-9">
          <div class="myads-cont">
              <div class="row">
                <div class="col">
                  <table class="table table-striped tresponsive">
                    <tr class="myads-title">
                      <td><?php echo $this->lang->line('title');?></td>
                      <td><?php echo $this->lang->line('price');?></td>
                      <td><?php echo $this->lang->line('year');?></td>
                      <td><?php echo $this->lang->line('date');?></td>
                      <td><?php echo $this->lang->line('action');?></td>
                    </tr>
                    <?php foreach($list_cars as $car) { ?>
                    <tr class="myads-det">
                      <td><?php echo $car['title'];  ?></td>
                      <td>AED <?php echo number_format($car['price']); ?></td>
                      <td><?php echo $car['year'];  ?></td>
                      <td><?php echo $this->common_model->get_dt($car['created_dt']);  ?></td>
                      <td  class="myads-icons">
                        <a href="<?php echo base_url();?>myads/editCar/<?php echo $car['id'];  ?>"><i class="far fa-edit"></i></a>
                        <button class="btndel" type="button" onclick="confirmDeleteModal(<?php echo $car['id'];  ?>);" ><i class="far fa-trash-alt"></i></i></button>
                        <a href="<?php echo $this->common_model->getCarUrl($car['id'],$car['make'],$car['model']) ?>"><i class="far fa-eye"></i></a>
                        <!-- <a type="submit" href="javascript:;" title="Refresh" onClick="renewMyads(<?php echo $car['id']; ?>)"><i class="fas fa-sync-alt"></i></a> -->
                      </td>
                    </tr>
                    <?php } ?>   
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<?php include('includes/footer.php');?>

  <!----modal starts here--->
  <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                &times;
              </button>
              
            </div>
            <div class="modal-body">
              <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                style="background-color: #6c757d !important;"
              >
                Cancel
              </button>
              <span id="deleteButton"></span>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
      function confirmDeleteModal(id) {
        //alert(id);
        var SITEURL = "<?php echo base_url() ?>";
        var ssss = '<a href='+ SITEURL +"myads/deleteCar/"+ id +'>Delete</a>';
        //alert(ssss);
        $("#deleteModal").modal();
        $("#deleteButton").html(
          '<a class="btn" href='+ SITEURL +"myads/deleteCar/"+ id +'>Delete</a>'
        );
      }
 
    </script>