<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-info text-white">
                                    <h4>About Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $about_main_head                  = strip_tags($_POST['about_main_head']);
                              $about_sub_head                   = strip_tags($_POST['about_sub_head']);
                              $about_btn_link                   = strip_tags($_POST['about_btn_link']);
                              $about_btn_text                   = strip_tags($_POST['about_btn_text']);


                              $about_content                   = $_POST['about_content'];
                             
                           
                              
                              
                              $about_main_head                  = $fm->validation($about_main_head);
                              $about_sub_head                   = $fm->validation($about_sub_head);
                              $about_btn_link                   = $fm->validation($about_btn_link);
                              $about_btn_text                   = $fm->validation($about_btn_text);
                             
                              
                              
                              $about_main_head                  = mysqli_real_escape_string($db->link, $about_main_head);
                              $about_sub_head                   = mysqli_real_escape_string($db->link, $about_sub_head);
                              $about_btn_link                   = mysqli_real_escape_string($db->link, $about_btn_link);
                              $about_btn_text                   = mysqli_real_escape_string($db->link, $about_btn_text);
                             
                            
                              
                              
                                $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                                $file_name = $_FILES['about_img']['name'];
                                $file_size = $_FILES['about_img']['size'];
                                $file_temp = $_FILES['about_img']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/".$unique_image;
                              
                          if($about_main_head == "" || $about_sub_head == "" || $about_content == "" || $about_btn_link == "" || $about_btn_text == ""){
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
                                      $query = "UPDATE about
                                          SET
                                          about_main_head = '$about_main_head',
                                          about_sub_head  = '$about_sub_head ',
                                          about_content = '$about_content',
                                          about_btn_link = '$about_btn_link',
                                          about_btn_text = '$about_btn_text',
                                          about_img = '$uploaded_image'
                                          WHERE about_id = '1'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('About Updated Successfully');</script>";
                                       echo "<script>window.location='about.php';</script>";
                                      }else {
                                       echo "<span class='error'>About Not Updated Inserted !</span>";
                                      }
                                  }
                              }else{ 
                                        $query = "UPDATE about
                                        SET
                                        about_main_head = '$about_main_head',
                                        about_sub_head  = '$about_sub_head ',
                                        about_content = '$about_content',
                                        about_btn_link = '$about_btn_link',
                                        about_btn_text = '$about_btn_text'
                                        WHERE about_id = '1'";
                                    $updated_rows = $db->update($query);
                                    if ($updated_rows) {
                                    echo "<script>alert('About Updated Successfully');</script>";
                                    echo "<script>window.location='about.php';</script>";
                                    }else {
                                    echo "<span class='error'>About Not Updated Inserted !</span>";
                                    }
                                  }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <?php
                                                $about_page = "SELECT * FROM about WHERE about_id='1'";
                                                $about = $db->select($about_page);
                                                if($about){   
                                                while($result = $about->fetch_assoc()){
                                            ?>
                                        
                                            <div class="form-group row">
                                                <label for="about_main_head" class="col-sm-3 col-form-label">About Main Heading Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="about_main_head" id="about_main_head" value="<?php echo $result['about_main_head'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="about_sub_head" class="col-sm-3 col-form-label">About Sub Heading Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="about_sub_head" id="about_sub_head" value="<?php echo $result['about_sub_head'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="about_content" class="col-sm-3 col-form-label">About Content</label>
                                                <div class="col-sm-9">
                                                <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="about_content" rows="50"><?php echo $result['about_content']; ?></textarea>
                                                </div>
                                            </div>

                                            

                                            <div class="form-group row">
                                                <label for="about_img" class="col-sm-3 col-form-label">About Image</label>
                                                <div class="col-sm-9">
                                                <img src="<?php echo $result['about_img'];?>" alt="" width="250" height="150">
                                                    <input type="file" name="about_img" class="form-control" id="about_img">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="about_btn_link" class="col-sm-3 col-form-label">About Button Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="about_btn_link" id="about_btn_link" value="<?php echo $result['about_btn_link'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="about_btn_text" class="col-sm-3 col-form-label">About Button Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="about_btn_text" id="about_btn_text" value="<?php echo $result['about_btn_text'];?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update About" class="btn btn-primary">
                                                </div>
                                            </div>

                                                    <?php }}?>
                                            
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