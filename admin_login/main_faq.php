<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

            <?php 

                if(isset($_GET['del_home_faq'])){
                    
                    $delhfaq_id = $_GET['del_home_faq'];
                    
                    
                    $delquery = "DELETE FROM home_faq WHERE home_faq_id ='$delhfaq_id'";
                    $delData = $db->delete($delquery);
                    if($delData){
                        echo"<script>alert('FAQ Deleted Successfully.');</script>";
                        echo"<script>window.location ='main_faq.php';</script>";
                    }else{
                        echo "<script>alert('FAQ Not Deleted.');</script>";
                        echo"<script>window.location ='main_faq.php';</script>";
                    }
                    
                }


            ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card py-1">
                                    <div class="card-header bg-danger text-white">
                                        <h4>All F.A.Q</h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Faq Title</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                        $get_faq = "SELECT * FROM home_faq";
                                        $faq = $db->select($get_faq);
                                        if($faq){  
                                            $i = 0;

                                        while($result = $faq->fetch_assoc()){
                                            $i++; 
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['home_faq_title']; ?></td>
                                                <td style="text-align:center;">

                                                <a href="edit_faq.php?edit_faq=<?php echo $result['home_faq_id']; ?>" class="btn btn-primary" style="font-size:16px;height:33px;">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a> 
                                                <a href="?del_home_faq=<?php echo $result['home_faq_id'];?>" class="btn btn-danger" style="font-size:16px;height:33px;" onclick="return confirm('Are you sure to delete!')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                               
                                            </tr>
                                            <?php }}else{echo "<h5 style='color:#000;text-align:center;padding:15px 0px 0px 0px;'>No Faq Added Yet!</h5>"."<br>"."<h3 style='text-align:center;'></h3>";}?>
                                        </tbody>
                                        
                                    </table>
                                
                                </div>
                                <p class="text-center"><a href="add_faq.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Faq Here</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 