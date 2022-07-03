<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-danger text-white">
                                    <h4>Social Media Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                                      if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                          
                                         
                                          $fb    = strip_tags($_POST['fb']);
                                          $tw    = strip_tags($_POST['tw']);
                                          $ld    = strip_tags($_POST['ld']);
                                          $sky    = strip_tags($_POST['sky']);
                                          $ytb    = strip_tags($_POST['ytb']);
                                          $pn    = strip_tags($_POST['pn']);
                                          $ins   = strip_tags($_POST['ins']);
                                          
                                          $fb    = $fm->validation($fb);
                                          $tw    = $fm->validation($tw);
                                          $ld    = $fm->validation($ld);
                                          $sky    = $fm->validation($sky);
                                          $ytb    = $fm->validation($ytb);
                                          $pn    = $fm->validation($pn);
                                          $ins   = $fm->validation($ins);
                                          
                                        
                                          $fb     = mysqli_real_escape_string($db->link, $fb);
                                          $tw     = mysqli_real_escape_string($db->link, $tw);
                                          $ld     = mysqli_real_escape_string($db->link, $ld);
                                          $sky     = mysqli_real_escape_string($db->link, $sky);
                                          $ytb     = mysqli_real_escape_string($db->link, $ytb);
                                          $pn     = mysqli_real_escape_string($db->link, $pn );
                                          $ins    = mysqli_real_escape_string($db->link, $ins);
                                          
                                          
                                           if (empty($fb) || empty($tw) || empty($ld) || empty($sky) || empty($pn) || empty($ins || empty($ytb)) ){
                                             echo "<div class='alert alert-danger'>
                                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Filed must not be empty!
                                                </div>";
                                            }else{
                                               $query = "UPDATE social
                                                    SET
                                                    fb = '$fb',
                                                    tw = '$tw',
                                                    ld = '$ld',
                                                    sky = '$sky',
                                                    ytb = '$ytb',
                                                    pn = '$pn',
                                                    ins = '$ins'
                                                    WHERE id = '1'";
                                                $updated_rows = $db->update($query);
                                                if ($updated_rows) {
                                                 echo "<script>alert('Social Media Updated Successfully');</script>";
                                                 echo "<script>window.location='social.php';</script>";
                                                }else {
                                                 echo "<span class='error'>Data Not Updated !</span>";
                                                }  
                                            }
                                          
                                      }
                                        ?>


                                    <?php 

                                    $query = "SELECT * FROM social WHERE id = '1'";
                                    $getsocial = $db->select($query);
                                    while($result = $getsocial->fetch_assoc()){
                                    ?>

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">
                                        
                                            <div class="form-group row">
                                                <label for="fb" class="col-sm-3 col-form-label">Facebook</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="fb" class="form-control" value="<?php echo $result['fb'];?>" id="fb">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tw" class="col-sm-3 col-form-label">Twitter</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="tw" class="form-control" value="<?php echo $result['tw'];?>" id="tw">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="ld" class="col-sm-3 col-form-label">LinkedIn</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="ld" class="form-control" value="<?php echo $result['ld'];?>" id="ld">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="sky" class="col-sm-3 col-form-label">Skype</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="sky" class="form-control" value="<?php echo $result['sky'];?>" id="sky">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="ytb" class="col-sm-3 col-form-label">Youtube</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="ytb" class="form-control" value="<?php echo $result['ytb'];?>" id="ytb">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pn" class="col-sm-3 col-form-label">Pinterest</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="pn" class="form-control" value="<?php echo $result['pn'];?>" id="pn">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="ins" class="col-sm-3 col-form-label">Instagram</label>
                                                <div class="col-sm-9">
                                                <input type="text" name="ins" class="form-control" value="<?php echo $result['ins'];?>" id="ins">
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