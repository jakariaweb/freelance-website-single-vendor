<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
<?php 

        if(!isset($_GET['edit_ser']) || $_GET['edit_ser'] == NULL){
            header("Location: service_3.php");
        }
        else{
            $ser_id = $_GET['edit_ser'];
        }
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-dark text-white">
                                    <h4>Edit Service 3</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $service_3_title      = strip_tags($_POST['service_3_title']);
                              $service_3_desc       = strip_tags($_POST['service_3_desc']);
                              $service_3_btn_link   = strip_tags($_POST['service_3_btn_link']);
                              $service_3_btn_text   = strip_tags($_POST['service_3_btn_text']);
                           
                              $service_3_title      = $fm->validation($service_3_title);
                              $service_3_desc       = $fm->validation($service_3_desc);
                              $service_3_btn_link   = $fm->validation($service_3_btn_link);
                              $service_3_btn_text   = $fm->validation($service_3_btn_text);
                              
                              $service_3_title      = mysqli_real_escape_string($db->link, $service_3_title);
                              $service_3_desc       = mysqli_real_escape_string($db->link, $service_3_desc);
                              $service_3_btn_link   = mysqli_real_escape_string($db->link, $service_3_btn_link);
                              $service_3_btn_text   = mysqli_real_escape_string($db->link, $service_3_btn_text);

                            
                              
                              
                                $permited  = array('png');
                                $file_name = $_FILES['service_3_logo']['name'];
                                $file_size = $_FILES['service_3_logo']['size'];
                                $file_temp = $_FILES['service_3_logo']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/ser_3/".$unique_image;
                              
                          if($service_3_title == "" || $service_3_desc == "" || $service_3_btn_link == "" || $service_3_btn_text == ""){
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
                                      $query = "UPDATE service_3
                                          SET
                                          service_3_logo = '$uploaded_image',
                                          service_3_title = '$service_3_title',
                                          service_3_desc = '$service_3_desc',
                                          service_3_btn_link = '$service_3_btn_link',
                                          service_3_btn_text = '$service_3_btn_text'
                                          WHERE service_3_id = '$ser_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Service 3 Updated Successfully');</script>";
                                       echo "<script>window.location='service_3.php';</script>";
                                      }else {
                                       echo "<span class='error'>Gig Not Updated Inserted !</span>";
                                      }
                                  }
                              }else{ 
                                      $query = "UPDATE service_3
                                          SET
                                          service_3_title = '$service_3_title',
                                          service_3_desc = '$service_3_desc',
                                          service_3_btn_link = '$service_3_btn_link',
                                          service_3_btn_text = '$service_3_btn_text'
                                          WHERE service_3_id = '$ser_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Service 3 Updated Successfully');</script>";
                                       echo "<script>window.location='service_3.php';</script>";
                                      }else {
                                       echo "<span class='error'>Service 3 Not Updated Inserted !</span>";
                                      }
                                  }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">

                                        <?php
                                            $ser_3 = "SELECT * FROM service_3 WHERE service_3_id='$ser_id'";
                                            $ser = $db->select($ser_3);
                                            if($ser){   
                                            while($result = $ser->fetch_assoc()){
                                        ?>
                                        
                                             <div class="form-group row">
                                                <label for="service_3_logo" class="col-sm-3 col-form-label">Service 3 Image</label>
                                                <div class="col-sm-9">
                                                    <img src="<?php echo $result['service_3_logo'];?>" alt="" width="80" height="80">
                                                    <input type="file" name="service_3_logo" class="form-control" id="service_3_logo">
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label for="service_3_title" class="col-sm-3 col-form-label">Service 3 Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="service_3_title" id="service_3_title" value="<?php echo $result['service_3_title'];?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="service_3_desc" class="col-sm-3 col-form-label">Service 3 Description</label>
                                                <div class="col-sm-9">
                                                    
                                                    <textarea name="service_3_desc" id="service_3_desc" cols="30" rows="10" class="form-control"><?php echo $result['service_3_desc'];?></textarea>
                                                </div>
                                            </div>


                                           

                                            <div class="form-group row">
                                                <label for="service_3_btn_link" class="col-sm-3 col-form-label">Service 3 Button Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="service_3_btn_link" id="service_3_btn_link" value="<?php echo $result['service_3_btn_link']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="service_3_btn_text" class="col-sm-3 col-form-label">Service 3 Button Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="service_3_btn_text" id="service_3_btn_text" value="<?php echo $result['service_3_btn_text']; ?>">
                                                </div>
                                            </div>



                                            

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Service 3" class="btn btn-primary">
                                                </div>
                                            </div>

                                                    <?php }}?>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="service_3.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Service 3 Here</a></p>
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