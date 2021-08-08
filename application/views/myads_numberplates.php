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
                      <td class="title"><?php echo $this->lang->line('title');?></td>
                      <td class="code"><?php echo $this->lang->line('code');?></td>
                      <td class="city"><?php echo $this->lang->line('city');?></td>
                      <td class="number"><?php echo $this->lang->line('number');?></td>
                      <td class="price"><?php echo $this->lang->line('price');?></td>                      
                      <td class="date"><?php echo $this->lang->line('date');?></td>
                      <td class="action"><?php echo $this->lang->line('action');?></td>
                    </tr>
                    <?php foreach($list_plates as $plate) { ?>
                    <tr class="myads-det">
                      <td class="title"><?php echo $plate['title'];  ?></td>
                      <td class="code"><?php echo $plate['code'];  ?></td>
                      <td class="city"><?php echo $plate['city'];  ?></td>
                      <td class="number"><?php echo $plate['number'];  ?></td>
                      <td class="price">AED <?php echo number_format($plate['price']); ?></td>                     
                      <td class="date"><?php echo $this->common_model->get_dt($plate['created_dt']);  ?></td>
                      <td class="myads-icons action">
                        <a href="<?php echo base_url();?>myads/editPlate/<?php echo $plate['id'];  ?>"><i class="far fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>myads/deletePlate/<?php echo $plate['id'];  ?>"><i class="far fa-trash-alt"></i></i></a>
                        <a href="<?php echo $this->common_model->getPlateUrl($plate['id'],$plate['city'],$plate['code']) ?>"><i class="far fa-eye"></i></a>
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