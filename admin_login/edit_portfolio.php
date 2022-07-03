<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
<?php 

        if(!isset($_GET['edit_port']) || $_GET['edit_port'] == NULL){
            header("Location: view_portfolio.php");
        }
        else{
            $port_id = $_GET['edit_port'];
        }
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-primary text-white">
                                    <h4>Edit Portfolio</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                            
                              $cat_id               = strip_tags($_POST['portfolio_category']);
                             
                              
                              
                            
                              $cat_id               = $fm->validation($cat_id);
                              
                            
                              
                              
                             
                              $cat_id               = mysqli_real_escape_string($db->link, $cat_id);
                           
                            
                              
                              
                                $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                                $file_name = $_FILES['portfolio_image']['name'];
                                $file_size = $_FILES['portfolio_image']['size'];
                                $file_temp = $_FILES['portfolio_image']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/".$unique_image;
                              
                          if($cat_id == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{
                                if(!empty($file_name)){
                                if ($file_size > 1024 * 5120) {
                                       echo "<span class='error'>Image Size should be less then 5MB!
                                       </span>";
                                      } elseif (in_array($file_ext, $permited) === false) {
                                       echo "<span class='error'>You can upload only:-"
                                       .implode(', ', $permited)."</span>";
                                      } 
                                  else{
                                      move_uploaded_file($file_temp, $uploaded_image);
                                      $query = "UPDATE portfolio
                                          SET
                                          portfolio_category = '$cat_id',
                                          portfolio_image = '$uploaded_image'
                                          WHERE portfolio_id = '$port_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Portfolio Updated Successfully');</script>";
                                       echo "<script>window.location='view_portfolio.php';</script>";
                                      }else {
                                       echo "<span class='error'>Portfolio Not Updated Inserted !</span>";
                                      }
                                  }
                              }else{ 
                                        $query = "UPDATE portfolio
                                        SET
                                        portfolio_category = '$cat_id'
                                        WHERE portfolio_id = '$port_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('GiPortfoliog Updated Successfully');</script>";
                                       echo "<script>window.location='view_portfolio.php';</script>";
                                      }else {
                                       echo "<span class='error'>Portfolio Not Updated Inserted !</span>";
                                      }
                                  }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">

                                        <?php
                                            $get_port = "SELECT * FROM portfolio WHERE portfolio_id='$port_id'";
                                            $port = $db->select($get_port);
                                            if($port){   
                                            while($result = $port->fetch_assoc()){
                                        ?>
                                        

                                            <div class="form-group row">
                                                <label for="portfolio_category" class="col-sm-3 col-form-label">Gig Category</label>
                                                <div class="col-sm-9">
                                                <select name="portfolio_category" class="form-control" required>
                                                <option value=""> Select A Category </option>
                                                 <?php
                                                    $get_cat = "SELECT * FROM categories";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($resultcat = $categories->fetch_assoc()){

                                                ?>
                                                  <option 

                                             		<?php 
                                             			if ($result['portfolio_category'] == $resultcat['cat_id']) { ?>
                                             				selected = "selected"
                                             		<?php	}
                                             		 ?>

                                             	value="<?php echo $resultcat['cat_id']; ?>"><?php echo $resultcat['cat_name']; ?></option>
                                             	<?php }} ?>
                                              </select>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="portfolio_image" class="col-sm-3 col-form-label">Gig Image</label>
                                                <div class="col-sm-9">
                                                    <img src="<?php echo $result['portfolio_image'];?>" alt="" width="250" height="150">
                                                    <input type="file" name="portfolio_image" class="form-control" id="portfolio_image">
                                                </div>
                                            </div>

                                           
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Gig" class="btn btn-primary">
                                                </div>
                                            </div>

                                                    <?php }}?>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="view_portfolio.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Portfolio Here</a></p>
                                        </div>

                                        
                                    </div>
                                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 