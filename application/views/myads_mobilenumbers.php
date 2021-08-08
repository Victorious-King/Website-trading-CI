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
                      <td class="code"><?php echo $this->lang->line('operator');?></td>
                      <td class="city"><?php echo $this->lang->line('code');?></td>
                      <td class="number"><?php echo $this->lang->line('number');?></td>
                      <td class="price"><?php echo $this->lang->line('price');?></td>                      
                      <td class="date"><?php echo $this->lang->line('date');?></td>
                      <td class="action"><?php echo $this->lang->line('action');?></td>
                    </tr>
                    <?php foreach($list_mobilenumbers as $mobile) { ?>
                    <tr class="myads-det">
                      <td class="title"><?php echo $mobile['title'];  ?></td>
                      <td class="code"><?php echo $mobile['operator'];  ?></td>
                      <td class="city"><?php echo $mobile['operator_code'];  ?></td>
                      <td class="number"><?php echo $mobile['number'];  ?></td>
                      <td class="price">AED <?php echo number_format($mobile['price']); ?></td>                     
                      <td class="date"><?php echo $this->common_model->get_dt($mobile['created_dt']);  ?></td>
                      <td class="myads-icons action">
                        <a href="<?php echo base_url();?>myads/editMobilenumber/<?php echo $mobile['id'];  ?>"><i class="far fa-edit"></i></a>
                        <a onclick="return confirm('Are you sure want to delete?');" href="<?php echo base_url();?>myads/deleteMobilenumber/<?php echo $mobile['id'];  ?>"><i class="far fa-trash-alt"></i></i></a>
                        <a href="<?php echo $this->common_model->getMobilenumberUrl($mobile['id'],$mobile['operator'],$mobile['operator_code']) ?>"><i class="far fa-eye"></i></a>
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