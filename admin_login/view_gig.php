<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

        if(isset($_GET['del_gig'])){ 
            $delgig_id = $_GET['del_gig'];
            $query ="SELECT *  FROM gig WHERE gig_id ='$delgig_id'";
            $getData = $db->select($query);
            if($getData){
                while($delimg = $getData->fetch_assoc()){
                    $dellink = $delimg['gig_image'];
                    unlink($dellink);
                }
            }
            $delquery = "DELETE FROM gig WHERE gig_id ='$delgig_id'";
            $delData = $db->delete($delquery);
            if($delData){
                echo"<script>alert('Gig Deleted Successfully.');</script>";
                echo"<script>window.location ='view_gig.php';</script>";
            }else{
                echo "<script>alert('Gig Not Deleted.');</script>";
                echo"<script>window.location ='view_gig.php';</script>";
            }
            
        }


    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-success text-white">
                                    <h4>View Gig</h4>
                                </div>
                                <div class="card-body">
                                

                                    <div class="row">
                                    <?php
                                        $get_gig = "SELECT * FROM gig";
                                        $gig = $db->select($get_gig);
                                        if($gig){   
                                        while($result = $gig->fetch_assoc()){
                                    ?>

                                    <div class="col-md-3">
                                        <div class="card my-2" style="width: 18rem;height: 26rem;">
                                            <div class="card-header bg-primary text-white">
                                                <?php
                                                    $gig_category = $result['gig_category'];
                                                    $get_cat = "SELECT * FROM categories WHERE cat_id='$gig_category'";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($resultCat = $categories->fetch_assoc()){

                                                        
                                                        echo $resultCat['cat_name'];

                                                    }

                                                }
                                                ?>
                                            </div>
                                           
                                            <img src="<?php echo $result['gig_image']; ?>" class="img-responsive card-img-top" style="width:100%;height:160px;" >
                                            <div class="card-body">
                                               
                                                <p><?php echo $result['gig_title']; ?></p>

                                            </div>
                                            <div class="card-footer">
                                                
                                                <p class="text-muted" style="padding-bottom: 0; margin-bottom: 0; font-weight: bold; font-size: 16px;">Price $<?php echo $result['gig_price']; ?></p>
                                                
                                            </div>
                                            <div class="card-footer">
                                            <a href="view_gig.php?del_gig=<?php echo $result['gig_id']; ?>" onclick="return confirm('Are you sure to delete this Gig!')" class="float-left">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                                <a href="edit_gig.php?edit_gig=<?php echo $result['gig_id']; ?>" class="float-right">
                                                    <i class="fa fa-pen"></i> Edit
                                                </a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <?php }}else{echo "<h1 style='color:#444;text-align:center;padding:15px 0px 0px 0px;font-size:20px;'>No Gig Added Yet!</h1>"."<br>"."";}?>
                                    <div class="clearfix"></div>
                                    
                                    
                                        
                                    </div>
                                    <br>
                                    <hr>
                                    <p class="text-center"><a href="add_gig.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Gig Here</a></p>
                                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 