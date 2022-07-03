<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

                if(isset($_GET['del_cat'])){
                    
                    $del_id = $_GET['del_cat'];
                    
                    
                    $query ="SELECT *  FROM categories WHERE cat_id ='$del_id'";
                    $getData = $db->select($query);
                    $delquery = "DELETE FROM categories WHERE cat_id ='$del_id'";
                    $delData = $db->delete($delquery);
                    if($delData){
                        echo"<script>alert('Category Deleted Successfully.');</script>";
                        echo"<script>window.location ='categorylist.php';</script>";
                    }else{
                        echo "<script>alert('Category Not Deleted.');</script>";
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
                                        <h4>Category List</h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Category Name</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                        $get_cat = "SELECT * FROM categories";
                                        $categories = $db->select($get_cat);
                                        if($categories){  
                                            $i = 0;

                                        while($result = $categories->fetch_assoc()){
                                            $i++; 
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['cat_name']; ?></td>
                                                <td style="text-align:center;">

                                                <a href="edit_cat.php?edit_cat=<?php echo $result['cat_id'];?>" class="btn btn-primary" style="font-size:16px;height:33px;">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a> 
                                                <a href="?del_cat=<?php echo $result['cat_id'];?>" class="btn btn-danger" style="font-size:16px;height:33px;" onclick="return confirm('Are you sure to delete!')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                               
                                            </tr>
                                            <?php }}else{echo "<h1 style='color:#fff;text-align:center;padding:15px 0px 0px 0px;'>No Category Added Yet!</h1>"."<br>"."<h3 style='text-align:center;'></h3>";}?>
                                        </tbody>
                                        
                                    </table>
                                
                                </div>
                                <p class="text-center"><a href="add_category.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Category Here</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 