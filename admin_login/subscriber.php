<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

                if(isset($_GET['del_sub'])){
                    
                    $del_id = $_GET['del_sub'];
                  
                    $delquery = "DELETE FROM subscribe WHERE subscribe_id ='$del_id'";
                    $delData = $db->delete($delquery);
                    if($delData){
                        echo"<script>alert('Subscriber Deleted Successfully.');</script>";
                        echo"<script>window.location ='subscriber.php';</script>";
                    }else{
                        echo "<script>alert('Subscriber Not Deleted.');</script>";
                        echo"<script>window.location ='categorylist.php';</script>";
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
                                        <h4>Subscriber List</h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Full Name</th>
                                                <th>E-mail Address</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                        $get_subs = "SELECT * FROM subscribe";
                                        $subs = $db->select($get_subs);
                                        if($subs){  
                                            $i = 0;

                                        while($result = $subs->fetch_assoc()){
                                            $i++; 
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['subscribe_name']; ?></td>
                                                <td><?php echo $result['subscribe_email']; ?></td>
                                                <td style="text-align:center;">

                                                <a href="?del_sub=<?php echo $result['subscribe_id'];?>" class="btn btn-danger" style="font-size:16px;height:33px;" onclick="return confirm('Are you sure to delete!')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                               
                                            </tr>
                                            <?php }}else{echo "<h1 style='color:#000;text-align:center;padding:15px 0px 0px 0px;'>No Subscriber Added Yet!</h1>"."<br>"."<h3 style='text-align:center;'></h3>";}?>
                                        </tbody>
                                        
                                    </table>
                                
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