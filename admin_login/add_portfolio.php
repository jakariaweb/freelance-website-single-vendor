<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-dark text-white">
                                    <h4>Add New Portfolio</h4>
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
                              }elseif ($file_size >1024*5120) {
                                     echo "<span class='error'>Image Size should be less then 5MB!
                                     </span>";
                                    } elseif (in_array($file_ext, $permited) === false) {
                                     echo "<span class='error'>You can upload only:-"
                                     .implode(', ', $permited)."</span>";
                                    } else{
                                    move_uploaded_file($file_temp, $uploaded_image);
                                    $query = "INSERT INTO portfolio(portfolio_category, portfolio_image) VALUES('$cat_id', '$uploaded_image')";
                                    $inserted_rows = $db->insert($query);
                                    if ($inserted_rows) {
                                     echo "<script>alert('Portfolio Added Successfully');</script>";
                                     echo "<script>window.location='view_portfolio.php';</script>";
                                    }else {
                                     echo "<span class='error'>Portfolio Not Added !</span>";
                                    }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">
                                        
                                            <div class="form-group row">
                                                <label for="gig_category" class="col-sm-3 col-form-label">Portfolio Category</label>
                                                <div class="col-sm-9">
                                                <select name="portfolio_category" class="form-control" required id="gig_category">
                                                <option value=""> Select A Category </option>
                                                 <?php
                                                    $get_cat = "SELECT * FROM categories";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($result = $categories->fetch_assoc()){

                                                ?>
                                                  <option value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
                                                  
                                                  <?php }}?>
                                              </select>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="portfolio_image" class="col-sm-3 col-form-label">Portfolio Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="portfolio_image" class="form-control" id="portfolio_image">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Add Portfolio" class="btn btn-primary">
                                                </div>
                                            </div>
                                            
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