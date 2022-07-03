<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

        if(isset($_GET['del_test'])){ 
            $deltest_id = $_GET['del_test'];
            $query ="SELECT *  FROM testimonial WHERE test_id ='$deltest_id'";
            $getData = $db->select($query);
            if($getData){
                while($delimg = $getData->fetch_assoc()){
                    $dellink = $delimg['test_img'];
                    unlink($dellink);
                }
            }
            $delquery = "DELETE FROM testimonial WHERE test_id ='$deltest_id'";
            $delData = $db->delete($delquery);
            if($delData){
                echo"<script>alert('Testimonial Deleted Successfully.');</script>";
                echo"<script>window.location ='view_test.php';</script>";
            }else{
                echo "<script>alert('Testimonial Not Deleted.');</script>";
                echo"<script>window.location ='view_test.php';</script>";
            } 
        }
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-info text-white">
                                    <h4>All Testimonial</h4>
                                </div>
                                <div class="card-body">
                                

                                    <div class="row">
                                    <?php
                                        $get_test = "SELECT * FROM testimonial";
                                        $test = $db->select($get_test);
                                        if($test){   
                                        while($result = $test->fetch_assoc()){
                                    ?>

                                    <div class="col-md-3">
                                        <div class="card my-2" style="width: 18rem;height: 26rem;">
                                            <div class="card-header bg-primary text-white">
                                                <?php echo $result['test_client']; ?>
                                            </div>
                                           
                                            <img src="<?php echo $result['test_img']; ?>" class="img-responsive card-img-top" style="width:100%;height:160px;overflow-hidden;" >
                                            <div class="card-body">
                                               
                                                <p><?php echo mb_strimwidth($result['test_comment'], 0, 100, "..."); ?></p>

                                            </div>
                                            
                                            <div class="card-footer">
                                            <a href="view_test.php?del_test=<?php echo $result['test_id']; ?>" onclick="return confirm('Are you sure to delete this Testimonial!')" class="float-left">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                                <a href="edit_test.php?edit_test=<?php echo $result['test_id']; ?>" class="float-right">
                                                    <i class="fa fa-pen"></i> Edit
                                                </a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <?php }}else{echo "<h1 style='color:#444;text-align:center;padding:15px 0px 0px 0px;font-size:20px;'>No Testimonial Added Yet!</h1>"."<br>"."";}?>
                                    <div class="clearfix"></div>
                                    
                                    
                                        
                                    </div>
                                    <br>
                                    <hr>
                                    <p class="text-center"><a href="add_test.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Testimonial Here</a></p>
                                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 