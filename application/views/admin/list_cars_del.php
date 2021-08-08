<?php include('includes/headeradmin.php');?>
<?php include('includes/menuadmin.php');?>   

<script>
    function delform() {
        var a = confirm('Delete All Checked?');
        
        if (a == true) {
            document.del_form.submit();
        } else {
            return false;
        }
    }

    function toggle(source) {
    checkboxes = document.getElementsByName('chk[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
    }
    }

</script>
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Cars</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php echo base_url()?>admin/dashboard">Home</a></li>
						<li><i class="fa fa-car"></i>Cars</li>						  	
					</ol>
				</div>
			</div>
              
            <div class="row">
				<div class="col-lg-12">
                      <!-- <section class="panel">
                          <header class="panel-heading">
                              Add car make
                          </header>
                          <div class="panel-body">
                              <a href="<?php echo base_url();?>admin/brands/addMake" type="button" class="btn btn-primary btn-lg btn-block">Add car make</a>                              
                          </div>
                      </section> -->
                      <?php if ($_SESSION["sess_alert"] && $_GET['err'] == 1) { ?>
                            <div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <?php  echo $_SESSION["sess_alert"]; ?> 
                            </div>
                      <?php } ?> 

                      <section class="panel">
                          <header class="panel-heading">
                              Cars details
                          </header>

                          <div style="float:left">
                          <input type="submit" value="Delete Checked"  id="del" onclick="return delform();"></div>

                          <div style="float:right">
						  <form name="srch" action="" method="get">
						  <table><tr><td>Search:</td><td>
						   <input type="text" class="form-control" name="keywords" required value="<?php echo $_GET['keywords'];?>" placeholder="Car id or Mobile"></td><td>
						  <button class="btn btn-primary" type="submit">Go</button>&nbsp;<a href="<?php echo base_url('admin/cars/listCars');?>"><button class="btn btn-primary" type="button">Reset</button></a>&nbsp;&nbsp;</td></tr></table>
						  </form>
						  </div>

                          

                        <form name="del_form" method="post">     
                          
                            <table class="table table-striped table-advance table-hover">
                                <tbody>
                                <tr>
                                        <th> <input type="checkbox" onClick="toggle(this)" /> 

                                </th>
                                    <th><i class="icon_profile"></i> ID</th>
                                    <th><i class="icon_calendar"></i> title</th>
                                    <th><i class="icon_calendar"></i> Year</th>
                                    <th><i class="icon_calendar"></i> Make</th>
                                    <th><i class="icon_mail_alt"></i> Model</th>  
                                    <th><i class="icon_mail_alt"></i> Price</th>                                 
                                    <th><i class="icon_mail_alt"></i> created date</th>
                                    <th><i class="icon_mail_alt"></i> created by</th>
                                    <th><i class="icon_cogs"></i> Action</th>
                                    
                                </tr>
                                <?php foreach($list_cars as $cars) { ?>
                               
                                <tr>
                                    <td><input type="checkbox" name="chk[]" id="chk[]" value="<?php echo $cars['id'];  ?>"></td>
                                    <td><?php echo $cars['id'];  ?></td>
                                    <td><?php echo $cars['title'];  ?></td>
                                    <td><?php echo $cars['year'];  ?></td>
                                    <td><?php echo $cars['make'];  ?></td>
                                    <td><?php echo $cars['model'];  ?></td>
                                    <td><?php echo $cars['price'];  ?></td>                                 
                                    <td><?php echo $cars['created_dt'];  ?></td>
                                    <td><?php echo $cars['created_by'];  ?></td>

                                    <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="<?php echo base_url();?>admin/cars/editCar/<?php echo $cars['id'];  ?>"><i class="fa fa-pencil-square-o"></i></i></a>                               
        
                                        <a onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger" href="<?php echo base_url();?>admin/cars/deleteCar/<?php echo $cars['id'];  ?>"><i class="icon_close_alt2"></i></a>
                                    </div>
                                    </td>
                                </tr> 
                                <?php } ?>
                                                                                  
                                </tbody>                          
                            </table>  

                        </form>


                      </section>
                      <?php echo $pagination?> 
                  </div>

                  

                  </div>
<?php include('includes/footeradmin.php');?>    