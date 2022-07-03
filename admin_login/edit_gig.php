<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
<?php 

        if(!isset($_GET['edit_gig']) || $_GET['edit_gig'] == NULL){
            header("Location: view_gig.php");
        }
        else{
            $gig_id = $_GET['edit_gig'];
        }
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-dark text-white">
                                    <h4>Edit Gig</h4>
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
                                      $query = "UPDATE gig
                                          SET
                                          gig_title = '$gig_title',
                                          gig_image = '$uploaded_image',
                                          gig_link = '$gig_link',
                                          gig_category = '$cat_id',
                                          gig_price = '$gig_price',
                                          gig_link_text = '$gig_link_text'
                                          WHERE gig_id = '$gig_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Gig Updated Successfully');</script>";
                                       echo "<script>window.location='view_gig.php';</script>";
                                      }else {
                                       echo "<span class='error'>Gig Not Updated Inserted !</span>";
                                      }
                                  }
                              }else{ 
                                      $query = "UPDATE gig
                                          SET
                                          gig_title = '$gig_title',
                                          gig_link = '$gig_link',
                                          gig_category = '$cat_id',
                                          gig_price = '$gig_price',
                                          gig_link_text = '$gig_link_text'
                                          WHERE gig_id = '$gig_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Gig Updated Successfully');</script>";
                                       echo "<script>window.location='view_gig.php';</script>";
                                      }else {
                                       echo "<span class='error'>Gig Not Updated Inserted !</span>";
                                      }
                                  }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">

                                        <?php
                                            $get_gig = "SELECT * FROM gig WHERE gig_id='$gig_id'";
                                            $gig = $db->select($get_gig);
                                            if($gig){   
                                            while($result = $gig->fetch_assoc()){
                                        ?>
                                        
                                            <div class="form-group row">
                                                <label for="gig_title" class="col-sm-3 col-form-label">Gig Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_title" id="gig_title" value="<?php echo $result['gig_title'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_category" class="col-sm-3 col-form-label">Gig Category</label>
                                                <div class="col-sm-9">
                                                <select name="gig_category" class="form-control" required>
                                                <option value=""> Select A Category </option>
                                                 <?php
                                                    $get_cat = "SELECT * FROM categories";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($resultcat = $categories->fetch_assoc()){

                                                ?>
                                                  <option 

                                             		<?php 
                                             			if ($result['gig_category'] == $resultcat['cat_id']) { ?>
                                             				selected = "selected"
                                             		<?php	}
                                             		 ?>

                                             	value="<?php echo $resultcat['cat_id']; ?>"><?php echo $resultcat['cat_name']; ?></option>
                                             	<?php }} ?>
                                              </select>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="gig_image" class="col-sm-3 col-form-label">Gig Image</label>
                                                <div class="col-sm-9">
                                                    <img src="<?php echo $result['gig_image'];?>" alt="" width="250" height="150">
                                                    <input type="file" name="gig_image" class="form-control" id="gig_image">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_link" class="col-sm-3 col-form-label">Gig Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_link" id="gig_link" value="<?php echo $result['gig_link']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_price" class="col-sm-3 col-form-label">Gig Price</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_price" id="gig_price" value="<?php echo $result['gig_price']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gig_link_text" class="col-sm-3 col-form-label">Gig Link Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="gig_link_text" id="gig_link_text" value="<?php echo $result['gig_link_text']; ?>">
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