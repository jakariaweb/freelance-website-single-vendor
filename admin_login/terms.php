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
                                    <h4>Terms of Services Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $terms_content                   = $_POST['terms_content'];
                             
                              
                          if($terms_content == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{
                                      $query = "UPDATE terms
                                          SET
                                          terms_content = '$terms_content'
                                          WHERE terms_id = '1'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Terms of Services Updated Successfully');</script>";
                                       echo "<script>window.location='terms.php';</script>";
                                      }else {
                                       echo "<span class='error'>Terms of Services Not Updated Inserted !</span>";
                                      }
                               
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">

                                            <?php
                                                $about_page = "SELECT * FROM terms WHERE terms_id='1'";
                                                $about = $db->select($about_page);
                                                if($about){   
                                                while($result = $about->fetch_assoc()){
                                            ?>


                                            <div class="form-group row">
                                                <label for="terms_content" class="col-sm-3 col-form-label">Privacy Content</label>
                                                <div class="col-sm-9">
                                                <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="terms_content" rows="50"><?php echo $result['terms_content']; ?></textarea>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Terms" class="btn btn-primary">
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