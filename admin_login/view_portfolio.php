<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

        if(isset($_GET['del_port'])){ 
            $delport_id = $_GET['del_port'];
            $query ="SELECT *  FROM portfolio WHERE portfolio_id ='$delport_id'";
            $getData = $db->select($query);
            if($getData){
                while($delimg = $getData->fetch_assoc()){
                    $dellink = $delimg['portfolio_image'];
                    unlink($dellink);
                }
            }
            $delquery = "DELETE FROM portfolio WHERE portfolio_id ='$delport_id'";
            $delData = $db->delete($delquery);
            if($delData){
                echo"<script>alert('Portfolio Deleted Successfully.');</script>";
                echo"<script>window.location ='view_portfolio.php';</script>";
            }else{
                echo "<script>alert('Portfolio Not Deleted.');</script>";
                echo"<script>window.location ='view_portfolio.php';</script>";
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
                                    <h4>View Portfolio</h4>
                                </div>
                                <div class="card-body">
                                

                                    <div class="row">
                                    <?php
                                        $get_portfolio = "SELECT * FROM portfolio";
                                        $portfolio = $db->select($get_portfolio);
                                        if($portfolio){   
                                        while($result = $portfolio->fetch_assoc()){
                                    ?>

                                    <div class="col-md-3">
                                        <div class="card my-2" >
                                            <div class="card-header bg-primary text-white">
                                                <?php
                                                    $gig_category = $result['portfolio_category'];
                                                    $get_cat = "SELECT * FROM categories WHERE cat_id='$gig_category'";
                                                    $categories = $db->select($get_cat);
                                                    if($categories){   
                                                    while($resultCat = $categories->fetch_assoc()){

                                                        
                                                        echo $resultCat['cat_name'];

                                                    }

                                                }
                                                ?>
                                            </div>
                                           
                                            <img src="<?php echo $result['portfolio_image']; ?>" class="img-responsive card-img-top" style="width:100%;height:160px;" >
                                            
                                            <div class="card-footer">
                                            <a href="view_portfolio.php?del_port=<?php echo $result['portfolio_id']; ?>" onclick="return confirm('Are you sure to delete this Portfolio!')" class="float-left">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                                <a href="edit_portfolio.php?edit_port=<?php echo $result['portfolio_id']; ?>" class="float-right">
                                                    <i class="fa fa-pen"></i> Edit
                                                </a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <?php }}else{echo "<h1 style='color:#444;text-align:center;padding:15px 0px 0px 0px;font-size:20px;'>No Portfolio Added Yet!</h1>"."<br>"."";}?>
                                    <div class="clearfix"></div>
                                    
                                    
                                        
                                    </div>
                                    <br>
                                    <hr>
                                    <p class="text-center"><a href="add_portfolio.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Portfolio Here</a></p>
                                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 