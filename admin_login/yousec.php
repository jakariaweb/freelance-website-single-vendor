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
                                    <h4>Youtube Section Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $youtube_link                   = $_POST['youtube_link'];
                              $youtube_text                   = $_POST['youtube_text'];
                              $youtube_channel                = $_POST['youtube_channel'];

                              $youtube_link        = mysqli_real_escape_string($db->link, $youtube_link);
                              $youtube_text        = mysqli_real_escape_string($db->link, $youtube_text);
                              $youtube_channel     = mysqli_real_escape_string($db->link, $youtube_channel);
                             
                              
                          if($youtube_link == "" || $youtube_text == "" || $youtube_channel == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{
                                      $query = "UPDATE youtube_sec
                                          SET
                                          youtube_link = '$youtube_link',
                                          youtube_text = '$youtube_text',
                                          youtube_channel = '$youtube_channel'
                                          WHERE youtube_id = '1'";
                                      $updated_rows = $db->update($query);
                                      if ($updated_rows) {
                                       echo "<script>alert('Youtube Seciont Updated Successfully');</script>";
                                       echo "<script>window.location='yousec.php';</script>";
                                      }else {
                                       echo "<span class='error'>Youtube Seciont Not Updated Inserted !</span>";
                                      }
                               
                                }
                              
                          }
                            ?>


                                

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">

                                            <?php
                                                $youtube_sec = "SELECT * FROM youtube_sec WHERE youtube_id='1'";
                                                $youtube = $db->select($youtube_sec);
                                                if($youtube){   
                                                while($result = $youtube->fetch_assoc()){
                                            ?>

                                            <div class="form-group row">
                                                <label for="youtube_link" class="col-sm-3 col-form-label">Youtube Video Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="youtube_link" id="youtube_link" value="<?php echo $result['youtube_link']?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="youtube_text" class="col-sm-3 col-form-label">Youtube Content</label>
                                                <div class="col-sm-9">
                                                <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="youtube_text" rows="50"><?php echo $result['youtube_text']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="youtube_channel" class="col-sm-3 col-form-label">Youtube Channel Link</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="youtube_channel" id="youtube_channel" value="<?php echo $result['youtube_channel']?>">
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update Youtube Section" class="btn btn-primary">
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