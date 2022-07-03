<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?>
 <?php 

    if(!isset($_GET['edit_faq']) || $_GET['edit_faq'] == NULL){
        header("Location: main_faq.php");
    }
    else{
        $h_faq_id = $_GET['edit_faq'];
    }
    ?>
     
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-info text-white">
                                    <h4>Edit Category</h4>
                                </div>
                                <div class="card-body">
                                 <?php 
                             if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              $home_faq_title    = strip_tags($_POST['home_faq_title']);
                              $home_faq_desc     = $_POST['home_faq_desc'];
                            
                              
                              $home_faq_title    = $fm->validation($home_faq_title);
                            
                              
                            
                              $home_faq_title    = mysqli_real_escape_string($db->link, $home_faq_title);
                            
                              
                              
                               if (empty($home_faq_title) || empty($home_faq_desc)){
                                 echo "<div class='alert alert-danger'>
                                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Filed must not be empty!
                                    </div>";
                                }else{
                                   $query = "UPDATE home_faq
                                        SET
                                        home_faq_title = '$home_faq_title',
                                        home_faq_desc = '$home_faq_desc'
                                       
                                        WHERE home_faq_id = '$h_faq_id'";
                                    $updated_rows = $db->update($query);
                                    if ($updated_rows) {
                                     echo "<script>alert('F.A.Q Updated Successfully');</script>";
                                     echo "<script>window.location='main_faq.php';</script>";
                                    }else {
                                     echo "<span class='error'>Data Not Updated !</span>";
                                    }  
                                }       
                             }
                             ?>
                                   <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">

                                             <?php
                                                  $query = "SELECT * FROM home_faq WHERE home_faq_id='$h_faq_id'";
                                                  $getHomeFAQ = $db->select($query);
                                                  while($homefAQ = $getHomeFAQ->fetch_assoc()){
                                              ?>
                                        
                                            <div class="form-group row">
                                                <label for="home_faq_title" class="col-sm-3 col-form-label">F.A.Q Question</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="home_faq_title" id="home_faq_title" value="<?php echo $homefAQ['home_faq_title'];?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="home_faq_desc" class="col-sm-3 col-form-label">F.A.Q Answer</label>
                                                <div class="col-sm-9">
                                                   <textarea style="margin-bottom:20px;" class="form-control" id="editor" name="home_faq_desc" rows="50"><?php echo $homefAQ['home_faq_desc'];?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <input type="submit" name="submit" value="Update F.A.Q" class="btn btn-primary">
                                                </div>
                                            </div>


                                            <?php }?>
                                            
                                            </form>

                                            <br>
                                            <p class="text-center"><a href="main_faq.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">View F.A.Q Here</a></p>
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