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
                                    <h4>Footer Copyright Text Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                 if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                               $footer_note      = strip_tags($_POST['footer_note']);
                             
                              
                              $footer_note      = $fm->validation($footer_note);
                              
                              
                             
                              $footer_note      = mysqli_real_escape_string($db->link, $footer_note);
                              
                              
                               
                              
                              if($footer_note == ""){
                                  echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";
                              }else{
                                    $query = "UPDATE footer
                                        SET
                                        footer_note = '$footer_note'
                                        WHERE footer_id = '1'";
                                    $updated_rows = $db->update($query);
                                    if ($updated_rows) {
                                     echo "<script>alert('Footer Updated Successfully');</script>";
                                     echo "<script>window.location='footer.php';</script>";
                                    }else {
                                     echo "<span class='error'>Footer Not Updated Inserted !</span>";
                                    }
                                
                              }
                              
                          }     
                          
                            ?>


                                            <?php
                                            
                                            $query = "SELECT * FROM footer WHERE footer_id = '1'";
                                                $getcopy = $db->select($query);
                                                while($result = $getcopy->fetch_assoc()){

                                        ?>

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">
                                        
                                            <div class="form-group row">
                                                <label for="footer_note" class="col-sm-3 col-form-label">Footer Copyright Text</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="footer_note" class="form-control" id="footer_note" value="<?php echo $result['footer_note'];?>">
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