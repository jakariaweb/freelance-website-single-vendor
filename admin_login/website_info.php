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
                                    <h4>Website Information Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 

                                        $get_old = "SELECT * FROM website_info WHERE id='1'";

                                        $run_old =  $db->select($get_old);
                                        if($run_old){

                                        while($resultOld = $run_old->fetch_assoc()){
                                            
                                            $old_logo = $resultOld['logo_big'];
                                            $old_favicon = $resultOld['favicon'];

                                            
                                        }

                                        }
                                      
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                                    

                                    $title            = strip_tags($_POST['title']);
                                    $domain           = strip_tags($_POST['domain']);
                                    $support_email    = strip_tags($_POST['support_email']);
                                    $hire_btn         = strip_tags($_POST['hire_btn']);
                                    $hire_btn_txt     = strip_tags($_POST['hire_btn_txt']);
                                    $g_cap_secret_key = $_POST['g_cap_secret_key'];
                                    $g_cap_site_key   = $_POST['g_cap_site_key'];

                                    $meta_tags        = $_POST['meta_tags'];
                                    $meta_desc        = $_POST['meta_desc'];
                                    
                                    $title            = $fm->validation($title);
                                    $domain           = $fm->validation($domain);
                                    $support_email    = $fm->validation($support_email);
                                    $hire_btn           = $fm->validation($hire_btn);
                                    $hire_btn_txt     = $fm->validation($hire_btn_txt);
                                    
                                    
                                    $title            = mysqli_real_escape_string($db->link, $title);
                                    $domain           = mysqli_real_escape_string($db->link, $domain);
                                    $support_email    = mysqli_real_escape_string($db->link, $support_email);
                                    $hire_btn         = mysqli_real_escape_string($db->link, $hire_btn);
                                    $hire_btn_txt     = mysqli_real_escape_string($db->link, $hire_btn_txt);
                                    $meta_tags        = mysqli_real_escape_string($db->link, $meta_tags);
                                    $meta_desc        = mysqli_real_escape_string($db->link, $meta_desc);

                                    $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');

                                    $file_name = $_FILES['logo_big']['name'];
                                    $file_name2 = $_FILES['favicon']['name'];

                                    $file_temp = $_FILES['logo_big']['tmp_name'];
                                    $file_temp2 = $_FILES['favicon']['tmp_name'];

                                    $div = explode('.', $file_name);
                                    $file_ext = strtolower(end($div));
                                    $same_image = 'logo'.'.'.$file_ext;
                                    $uploaded_image = "../img/".$same_image;
                                  
                                    $div2 = explode('.', $file_name2);
                                    $file_ext2 = strtolower(end($div2));
                                    $same_image2 = 'favicon'.'.'.$file_ext2;
                                    $uploaded_image2 = "../img/".$same_image2;

                                    if($title == "" || $domain == "" || $support_email == "" || 
                                    $g_cap_secret_key == "" || $g_cap_site_key == "" || $hire_btn == "" ||  $hire_btn_txt == ""){

                                        echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";

                                    }else{
                                        move_uploaded_file($file_temp, $uploaded_image);
                                        move_uploaded_file($file_temp2, $uploaded_image2);

                                        if(empty($file_name)){
                                            $uploaded_image = $old_logo;
                                        }else{
                                            $uploaded_image = $uploaded_image;
                                        }
                                        
                                        if(empty($file_name2)){
                                            $uploaded_image2 = $old_favicon;
                                        }else{
                                            $uploaded_image2 = $uploaded_image2;
                                        }

                                        $query = "UPDATE website_info
                                        SET
                                        title = '$title',
                                        logo_big = '$uploaded_image',
                                        favicon = '$uploaded_image2',
                                        domain ='$domain',
                                        support_email ='$support_email',
                                        meta_tags ='$meta_tags',
                                        meta_desc ='$meta_desc',
                                        hire_btn ='$hire_btn',
                                        hire_btn_txt ='$hire_btn_txt',
                                        g_cap_site_key ='$g_cap_site_key',
                                        g_cap_secret_key ='$g_cap_secret_key'
                                        WHERE id = '1'";
                                        $updated_rows = $db->update($query);
                                        if ($updated_rows) {
                                            echo "<script>alert('Website Information Updated Successfully');</script>";
                                            echo "<script>window.location='website_info.php';</script>";
                                        }else {
                                        echo "<span class='error'>Data Not Updated Inserted !</span>";
                                        }


                                    }

                                }
                                ?>


                                <?php 
                                    
                                        $query = "SELECT * FROM website_info WHERE id = '1'";
                                        $getwebsite = $db->select($query);
                                        while($result = $getwebsite->fetch_assoc()){
                                ?>

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" enctype="multipart/form-data">
                                        
                                            <div class="form-group row">
                                                <label for="title" class="col-sm-3 col-form-label">Website Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $result['title']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="logo" class="col-sm-3 col-form-label">Website Logo</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="logo_big" class="form-control" id="logo">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="favicon" class="col-sm-3 col-form-label">Website Favicon</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="favicon" class="form-control" id="favicon">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="domain" class="col-sm-3 col-form-label">Website Domain</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="domain" id="domain" value="<?php echo $result['domain']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="support_email" class="col-sm-3 col-form-label">Support E-mail</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="support_email" id="support_email" value="<?php echo $result['support_email']?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="meta_tags" class="col-sm-3 col-form-label">Meta Tags</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="meta_tags" id="meta_tags" value="<?php echo $result['meta_tags']?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="meta_desc" class="col-sm-3 col-form-label">Meta Descripton</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="meta_desc" id="meta_desc" value="<?php echo $result['meta_desc']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hire_btn" class="col-sm-3 col-form-label">Hire Button Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="hire_btn" id="hire_btn" value="<?php echo $result['hire_btn']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="hire_btn_txt" class="col-sm-3 col-form-label">Hire Button Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="hire_btn_txt" id="hire_btn_txt" value="<?php echo $result['hire_btn_txt']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="g_cap_site_key" class="col-sm-3 col-form-label">Google re-captcha Site Key</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="g_cap_site_key" id="g_cap_site_key" value="<?php echo $result['g_cap_site_key']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="g_cap_secret_key" class="col-sm-3 col-form-label">Google re-captcha Secret Key</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="g_cap_secret_key" id="g_cap_secret_key" value="<?php echo $result['g_cap_secret_key']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                                </div>
                                            </div>
                                            
                                            </form>
                                        </div>

                                        <div class="col-md-3">
                                           
                                                <div style="background:#eee;">
                                                    <img src="<?php echo $result['logo_big']?>" alt="logo" width="200">
                                                    <br> 
                                                    <hr>
                                                </div>

                                                <div style="background:#eee;">
                                                    <img src="<?php echo $result['favicon']?>" alt="logo" width="50">
                                                    <br> <br>
                                                </div>
                                             
                                        </div>
                                    </div>
                                        <?php }?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 