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
                                <h4>Add New Post</h4>
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
                              }elseif ($file_size >1024*5120) {
                                     echo "<span class='error'>Image Size should be less then 5MB!
                                     </span>";
                                    } elseif (in_array($file_ext, $permited) === false) {
                                     echo "<span class='error'>You can upload only:-"
                                     .implode(', ', $permited)."</span>";
                                    } else{
                                    move_uploaded_file($file_temp, $uploaded_image);
                                    $query = "INSERT INTO blog(blog_category , blog_image, blog_title, blog_desc, blog_url, blog_pub_date, status) VALUES('$blog_category', '$uploaded_image', '$blog_title', '$blog_desc', '$blog_url', now(), '$status')";
                                    $inserted_rows = $db->insert($query);
                                    if ($inserted_rows) {
                                     echo "<script>alert('Post Added Successfully');</script>";
                                     echo "<script>window.location='view_post.php';</script>";
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
                                                <label for="blog_category" class="col-sm-3 col-form-label">Post Category</label>
                                                <div class="col-sm-9">
                                                    <select name="blog_category" class="form-control" required id="blog_category">
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
                                                <label for="blog_image" class="col-sm-3 col-form-label">Blog Image</label>
                                                <div class="col-sm-9">
                                                   
                                                    <input type="file" name="blog_image" class="form-control" id="blog_image">
                                                </div>
                                            </div>

                                                                                    <div class="form-group row">
                                                <label for="blog_title" class="col-sm-3 col-form-label">Blog Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="blog_title" id="blog_title">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="blog_desc" class="col-sm-3 col-form-label">Blog Description</label>
                                                <div class="col-sm-9">
                                                    <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="blog_desc"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="status" class="col-sm-3 col-form-label">Blog Publishing Status</label>
                                                <div class="col-sm-9">
                                                    <select name="status" class="form-control" required id="status">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Published</option>
                                                        <option value="0">Pending</option>
                                                    </select>
                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Add Post" class="btn btn-primary">
                                                </div>
                                            </div>

                                        </form>

                                        <br>
                                        <p class="text-center"><a href="view_post.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Post Here</a></p>
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
