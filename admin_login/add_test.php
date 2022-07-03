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
                                    <h4>Add New Testimonial</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $test_comment               = strip_tags($_POST['test_comment']);
                              $test_client                = strip_tags($_POST['test_client']);
                              $test_country               = strip_tags($_POST['test_country']);
                            
                           
                              
                              
                              $test_comment               = $fm->validation($test_comment);
                              $test_client                = $fm->validation($test_client);
                              $test_country               = $fm->validation($test_country);
                             
                            
                              
                              
                              $test_comment               = mysqli_real_escape_string($db->link, $test_comment);
                              $test_client                = mysqli_real_escape_string($db->link, $test_client);
                              $test_country               = mysqli_real_escape_string($db->link, $test_country);
                             
                            
                              
                              
                               $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                                $file_name = $_FILES['test_img']['name'];
                                $file_size = $_FILES['test_img']['size'];
                                $file_temp = $_FILES['test_img']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/client/".$unique_image;
                              
                          if($test_comment == "" || $test_client == "" || $test_country == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }elseif ($file_size >1024*5120) {
                                     echo "<span class='error'>Image Size should be less then 5MB!
                                     </span>";
                                    } elseif (in_array($file_ext, $permited) === false) {
                                     echo "<span class='error'>You can upload only:-"
                                     .implode(', ', $permited)."</span>";
                                    } else{
                                    move_uploaded_file($file_temp, $uploaded_image);
                                    $query = "INSERT INTO testimonial(test_img , test_comment, test_client, test_country) VALUES('$uploaded_image', '$test_comment', '$test_client', '$test_country')";
                                    $inserted_rows = $db->insert($query);
                                    if ($inserted_rows) {
                                     echo "<script>alert('Testimonial Added Successfully');</script>";
                                     echo "<script>window.location='view_test.php';</script>";
                                    }else {
                                     echo "<span class='error'>Testimonial Not Added !</span>";
                                    }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">
                                        
                                            <div class="form-group row">
                                                <label for="test_img" class="col-sm-3 col-form-label">Client Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="test_img" class="form-control" id="test_img">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label for="test_client" class="col-sm-3 col-form-label">Client Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="test_client" id="test_client">
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="form-group row">
                                                <label for="test_country" class="col-sm-3 col-form-label">Client Country</label>
                                                <div class="col-sm-9">
                                                <select name="test_country" class="form-control" required id="test_country">
                                                <option value=""> Select Country </option>
                                                 <?php
                                                    $get_country = "SELECT * FROM countries";
                                                    $country = $db->select($get_country);
                                                    if($country){  
                                                    while($result = $country->fetch_assoc()){

                                                ?>
                                                  <option value="<?php echo $result['country_id']; ?>"><?php echo $result['country_name']; ?></option>
                                                  
                                                  <?php }}?>
                                              </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="test_comment" class="col-sm-3 col-form-label">Client Comment</label>
                                                <div class="col-sm-9">
                                                   <textarea name="test_comment" id="test_comment" cols="30" rows="10" class="form-control"></textarea>
                                                  
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Add Testimonial" class="btn btn-primary">
                                                </div>
                                            </div>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="view_test.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Testimonial Here</a></p>
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