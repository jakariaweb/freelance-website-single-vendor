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
                                    <h4>Privacy Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $privacy_content                   = $_POST['privacy_content'];
                             
                              
                          if($privacy_content == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{
                                      $query = "UPDATE privacy
                                          SET
                                          privacy_content = '$privacy_content'
                                          WHERE privacy_id = '1'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Privacy Updated Successfully');</script>";
                                       echo "<script>window.location='privacy.php';</script>";
                                      }else {
                                       echo "<span class='error'>Privacy Not Updated Inserted !</span>";
                                      }
                               
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">

                                            <?php
                                                $about_page = "SELECT * FROM privacy WHERE privacy_id='1'";
                                                $about = $db->select($about_page);
                                                if($about){   
                                                while($result = $about->fetch_assoc()){
                                            ?>


                                            <div class="form-group row">
                                                <label for="privacy_content" class="col-sm-3 col-form-label">Privacy Content</label>
                                                <div class="col-sm-9">
                                                <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="privacy_content" rows="50"><?php echo $result['privacy_content']; ?></textarea>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Privacy" class="btn btn-primary">
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