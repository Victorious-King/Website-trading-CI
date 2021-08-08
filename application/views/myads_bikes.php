<?php include('includes/header.php');?>
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
                      <td><?php echo $this->lang->line('make');?></td>
                      <td><?php echo $this->lang->line('date');?></td>
                      <td><?php echo $this->lang->line('action');?></td>
                    </tr>
                    <?php foreach($list_bikes as $boat) { ?>
                    <tr class="myads-det">
                      <td><?php echo $boat['title'];  ?></td>
                      <td>AED <?php echo number_format($boat['price']); ?></td>
                      <td><?php echo $boat['make'];  ?></td>
                      <td><?php echo $this->common_model->get_dt($boat['created_dt']);  ?></td>
                      <td  class="myads-icons">
                        <a href="<?php echo base_url();?>myads/editBike/<?php echo $boat['id'];  ?>"><i class="far fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>myads/deleteBike/<?php echo $boat['id'];  ?>"><i class="far fa-trash-alt"></i></i></a>
                        <a href="<?php echo $this->common_model->getBikeUrl($boat['id'],$boat['make']) ?>"><i class="far fa-eye"></i></a>
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