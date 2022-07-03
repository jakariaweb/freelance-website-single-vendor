<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
<?php 

        if(!isset($_GET['edit_post']) || $_GET['edit_post'] == NULL){
            header("Location: view_post.php");
        }
        else{
            $edit_id = $_GET['edit_post'];
        }
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-dark text-white">
                                    <h4>Edit Post</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              $blog_category               = strip_tags($_POST['blog_category']);
                              $blog_title               = strip_tags($_POST['blog_title']);
                              $blog_desc               = $_POST['blog_desc'];
                              $status               = strip_tags($_POST['status']);
                           
                              
                              
                              $blog_category               = $fm->validation($blog_category);
                              $blog_title               = $fm->validation($blog_title);
                              $status               = $fm->validation($status);
                            
                              
                              
                              $blog_category              = mysqli_real_escape_string($db->link, $blog_category);
                              $blog_title               = mysqli_real_escape_string($db->link, $blog_title);
                              $status               = mysqli_real_escape_string($db->link, $status);
                              $blog_desc               = mysqli_real_escape_string($db->link, $blog_desc);
                            
                              
                              class SanitizeUrl{

                                    public static function slug($string, $space="-") {
                                        $string = utf8_encode($string);
                                        if (function_exists('iconv')) {
                                            $string = iconv('UTF-8', 'ISO-8859-1//IGNORE', $string);
                                        }

                                        $string = preg_replace("/[^a-zA-Z0-9 \-]/", "", $string);
                                        $string = trim(preg_replace("/\\s+/", " ", $string));
                                        $string = strtolower($string);
                                        $string = str_replace(" ", $space, $string);

                                        return $string;
                                    }
                                }
                              
                                $sanitize_url = SanitizeUrl::slug($blog_title);
                              
                                $blog_url  = mysqli_real_escape_string($db->link, $sanitize_url);
                              
                                $get_exist_url = "SELECT * FROM blog WHERE blog_url='$blog_url' LIMIT 0,1";
                              
                                $run_exist_url = $db->select($get_exist_url);
                                
                                if($run_exist_url != false){
                                    
                                    $today = date("Ymd");
                                    $rand = strtolower(substr(uniqid(sha1(time())),0,5));
                                    $order_num = '-effectshub-' . $rand;
                                    
                                    $blog_url .= $order_num;
                                    
                                }else{
                                    $blog_url = $blog_url;
                                }
                              
                                 
                              
                              
                                $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
                                $file_name = $_FILES['blog_image']['name'];
                                $file_size = $_FILES['blog_image']['size'];
                                $file_temp = $_FILES['blog_image']['tmp_name'];

                                $div = explode('.', $file_name);
                                $file_ext = strtolower(end($div));
                                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                                $uploaded_image = "../img/blog/".$unique_image;

                          if($blog_category == "" || $blog_title == "" || $blog_desc == "" || $status == ""){
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
                                      $query = "UPDATE blog
                                          SET
                                          blog_category = '$blog_category',
                                          blog_image = '$uploaded_image',
                                          blog_title = '$blog_title',
                                          blog_desc = '$blog_desc',
                                          blog_url = '$blog_url',
                                          status = '$status'
                                          WHERE blog_id = '$edit_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Blog Updated Successfully');</script>";
                                       echo "<script>window.location='view_post.php';</script>";
                                      }else {
                                       echo "<span class='error'>Blog Not Updated Inserted !</span>";
                                      }
                                  }
                              }else{ 
                                      $query = "UPDATE blog
                                          SET
                                          blog_category = '$blog_category',
                                          blog_title = '$blog_title',
                                          blog_desc = '$blog_desc',
                                          blog_url = '$blog_url',
                                          status = '$status'
                                          WHERE blog_id = '$edit_id'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                      echo "<script>alert('Blog Updated Successfully');</script>";
                                       echo "<script>window.location='view_post.php';</script>";
                                      }else {
                                     echo "<span class='error'>Blog Not Updated Inserted !</span>";
                                      }
                                  }
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">

                                        <?php
                                            $get_blog = "SELECT * FROM blog WHERE blog_id='$edit_id'";
                                            $blog = $db->select($get_blog);
                                            if($blog){   
                                            while($result = $blog->fetch_assoc()){
                                        ?>
                                        
                                           <div class="form-group row">
                                                <label for="blog_category" class="col-sm-3 col-form-label">Post Category</label>
                                                <div class="col-sm-9">
                                                <select name="blog_category" class="form-control" required>
                                                <option value=""> Select A Category </option>
                                                 <?php
                                                    $get_cat = "SELECT * FROM categories";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($resultcat = $categories->fetch_assoc()){

                                                ?>
                                                  <option 

                                             		<?php 
                                             			if ($result['blog_category'] == $resultcat['cat_id']) { ?>
                                             				selected = "selected"
                                             		<?php	}
                                             		 ?>

                                             	value="<?php echo $resultcat['cat_id']; ?>"><?php echo $resultcat['cat_name']; ?></option>
                                             	<?php }} ?>
                                              </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="blog_image" class="col-sm-3 col-form-label">Blog Image</label>
                                                <div class="col-sm-9">
                                                    <img src="<?php echo $result['blog_image'];?>" alt="" width="250" height="150">
                                                    <input type="file" name="blog_image" class="form-control" id="blog_image">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="blog_title" class="col-sm-3 col-form-label">Blog Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="blog_title" id="blog_title" value="<?php echo $result['blog_title'];?>">
                                                </div>
                                            </div>
                                            
                                             <div class="form-group row">
                                                <label for="blog_desc" class="col-sm-3 col-form-label">Blog Description</label>
                                                <div class="col-sm-9">
                                                    <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="blog_desc"><?php echo $result['blog_desc'];?></textarea>
                                                </div>
                                            </div>
                                            
                                             <div class="form-group row">
                                                <label for="status" class="col-sm-3 col-form-label">Blog Publishing Status</label>
                                                <div class="col-sm-9">
                                                    <select name="status" class="form-control" required id="status">
                                                       
                                                        <?php
                                                            if($result['status'] == '1'){
                                                        ?>
                                                        <option value="1">Published</option>
                                                         <option value="0">Pending</option>
                                                        <?php }else{?>
                                                        
                                                         <option value="0">Pending</option>
                                                         <option value="1">Published</option>
                                                        <?php }?>
                                                        
                                                       
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Post" class="btn btn-primary">
                                                </div>
                                            </div>

                                                    <?php }}?>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="view_post.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Blog Posts Here</a></p>
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
