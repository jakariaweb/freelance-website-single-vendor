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
                                    <h4>Update Home Banner</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $slide_name               = strip_tags($_POST['slide_name']);
                          
                              $slide_name               = $fm->validation($slide_name);
                           
                              $slide_name               = mysqli_real_escape_string($db->link, $slide_name);
                          
                              
                                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                                $file_name = $_FILES['slide_image']['name'];
                                $file_size = $_FILES['slide_image']['size'];
                                $file_temp = $_FILES['slide_image']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/carousel/".$unique_image;
                              
                              if($slide_name == ""){
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
                                    $query = "UPDATE slider
                                        SET
                                        slide_name = '$slide_name',
                                        slide_image = '$uploaded_image'
                                        WHERE slider_id = '1'";
                                    $updated_rows = $db->update($query);
                                    if ($updated_rows) {
                                     echo "<script>alert('Banner Updated Successfully');</script>";
                                     echo "<script>window.location='edit_banner.php';</script>";
                                    }else {
                                     echo "<span class='error'>Banner Not Updated Inserted !</span>";
                                    }
                                }
                            }else{ 
                                    $query = "UPDATE slider
                                        SET
                                        slide_name = '$slide_name'
                                        WHERE slider_id = '1'";
                                    $updated_rows = $db->update($query);
                                    if ($updated_rows) {
                                     echo "<script>alert('Banner Updated Successfully');</script>";
                                     echo "<script>window.location='edit_banner.php';</script>";
                                    }else {
                                     echo "<span class='error'>Banner Not Updated Inserted !</span>";
                                    }
                                }
                              }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">
                                        <?php
                                            $query = "SELECT * FROM slider WHERE slider_id='1' ORDER BY slider_id DESC";
                                            $getslider = $db->select($query);
                                            while($slideresult = $getslider->fetch_assoc()){
                                        ?>
                                        
                                            <div class="form-group row">
                                                <label for="slide_name" class="col-sm-3 col-form-label">Banner Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="slide_name" id="slide_name" value="<?php echo $slideresult['slide_name'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="slide_image" class="col-sm-3 col-form-label">Banner Image</label>
                                                <div class="col-sm-9">
                                                <img src="<?php echo $slideresult['slide_image'];?>" alt="" width="250" height="150">
                                                <input type="file" name="slide_image" class="form-control" id="slide_image">
                                                </div>
                                            </div>

                                            

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Banner" class="btn btn-primary">
                                                </div>
                                            </div>

                                            <?php }?>
                                            
                                            </form>
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