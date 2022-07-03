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
                                    <h4>Add Category</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $cat_name                 = strip_tags($_POST['cat_name']);
                             
                              $cat_name                 = $fm->validation($cat_name);
                            
                              $cat_name                 = mysqli_real_escape_string($db->link, $cat_name);

                              $cat_short = str_replace(' ', '', $cat_name);

                              $cat_short = strtolower($cat_short);
                            
                             
                            if($cat_name == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{

                                $check_exist = "SELECT * FROM categories WHERE cat_name='$cat_name' LIMIT 0,1";
                                $chkresult = $db->select($check_exist);

                                if ($chkresult != false) {
                                    echo "<div class='alert alert-danger'>
                                       <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Category Already Exist! </a>
                                      </div>";

                                }else{
                                    $query = "INSERT INTO categories(cat_name, cat_short) VALUES('$cat_name', '$cat_short')";
                                    $inserted_rows = $db->insert($query);
                                    if ($inserted_rows) {
                                     echo "<script>alert('Category Added Successfully');</script>";
                                     echo "<script>window.location='categorylist.php';</script>";
                                    }else {
                                     echo "<span class='error'>Category Not Added !</span>";
                                    }

                                }
                                    
                                }
                              
                          }
                            ?>
                                   <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">
                                        
                                            <div class="form-group row">
                                                <label for="cat_name" class="col-sm-3 col-form-label">Category Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="cat_name" id="cat_name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                                                </div>
                                            </div>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="categorylist.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View Categories Here</a></p>
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