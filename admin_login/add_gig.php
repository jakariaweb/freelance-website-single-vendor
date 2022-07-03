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
                                    <h4>Add New Gig</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $gig_title               = strip_tags($_POST['gig_title']);
                              $cat_id               = strip_tags($_POST['gig_category']);
                              $gig_link               = strip_tags($_POST['gig_link']);
                              $gig_link_text               = strip_tags($_POST['gig_link_text']);
                              $gig_price               = strip_tags($_POST['gig_price']);
                           
                              
                              
                              $gig_title               = $fm->validation($gig_title);
                              $cat_id               = $fm->validation($cat_id);
                              $gig_link               = $fm->validation($gig_link);
                              $gig_link_text               = $fm->validation($gig_link_text);
                              $gig_price               = $fm->validation($gig_price);
                            
                              
                              
                              $gig_title               = mysqli_real_escape_string($db->link, $gig_title);
                              $cat_id               = mysqli_real_escape_string($db->link, $cat_id);
                              $gig_link               = mysqli_real_escape_string($db->link, $gig_link);
                              $gig_link_text               = mysqli_real_escape_string($db->link, $gig_link_text);
                              $gig_price               = mysqli_real_escape_string($db->link, $gig_price);
                            
                              
                              
                               $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                                $file_name = $_FILES['gig_image']['name'];
                                $file_size = $_FILES['gig_image']['size'];
                                $file_temp = $_FILES['gig_image']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/".$unique_image;
                              
                          if($gig_title == "" || $cat_id == "" || $gig_link == "" || $gig_link_text == "" || $gig_price == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }elseif ($file_size >1024*5120) {
                                     echo "<span class='error'>Image Size should be less then 5MB!
                                     </span>";
                                    } elseif (in_array($file_ext, $permited) === false) {
                                     echo "<span class='error'>You can upload only:-"
                                     .implode(', ', $permited)."</span>";
                                    } else{
                                    move_uploaded_file($file_temp, $uploaded_image);
                                    $query = "INSERT INTO gig(gig_title , gig_image, gig_link, gig_category, gig_price, gig_link_text) VALUES('$gig_title', '$uploaded_image', '$gig_link', '$cat_id', '$gig_price', '$gig_link_text')";
                                    $inserted_rows = $db->insert($query);
                                    if ($inserted_rows) {
                                     echo "<script>alert('Gig Added Successfully');</script>";
                                     echo "<script>window.location='view_gig.php';</script>";
                                    }else {
                                     echo "<span class='error'>Gig Not Added !</span>";
                                    }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">
                                        
                                            <div class="form-group row">
                                                <label for="gig_title" class="col-sm-3 col-form-label">Gig Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_title" id="gig_title">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_category" class="col-sm-3 col-form-label">Gig Category</label>
                                                <div class="col-sm-9">
                                                <select name="gig_category" class="form-control" required id="gig_category">
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
                                                <label for="gig_image" class="col-sm-3 col-form-label">Gig Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="gig_image" class="form-control" id="gig_image">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_link" class="col-sm-3 col-form-label">Gig Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_link" id="gig_link">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_price" class="col-sm-3 col-form-label">Gig Price</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_price" id="gig_price">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_link_text" class="col-sm-3 col-form-label">Gig Link Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_link_text" id="gig_link_text">
                                                </div>
                                            </div>



                                            

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Add Gig" class="btn btn-primary">
                                                </div>
                                            </div>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="view_gig.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Gig Here</a></p>
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