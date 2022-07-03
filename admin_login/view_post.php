<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

<?php 

                if(isset($_GET['del_post'])){
                    
                    $del_id = $_GET['del_post'];

                    $delquery = "DELETE FROM blog WHERE blog_id ='$del_id'";
                    $delData = $db->delete($delquery);
                    if($delData){
                        echo"<script>alert('Post Deleted Successfully.');</script>";
                        echo"<script>window.location ='view_post.php';</script>";
                    }else{
                        echo "<script>alert('Post Not Deleted.');</script>";
                        echo"<script>window.location ='view_post.php';</script>";
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
                                        <h4>Post List <?php 
                                                    $query = "SELECT * FROM blog";
                                                    $counttrans = $db->select($query);
                                                    if($counttrans){
                                                    $count = mysqli_num_rows($counttrans);
                                                        echo "<span style='font-family:sans-serif;'>(".$count.")</span>";
                                                    }else{
                                                        echo "(0)";
                                                    }

                                                    ?></h4>
                                    </div>
                                    <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Post Image</th>
                                                <th>Post Title</th>
                                                <th>Post Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php
                                        $get_blog = "SELECT * FROM blog";
                                        $blog = $db->select($get_blog);
                                        if($blog){  
                                            $i = 0;

                                        while($result = $blog->fetch_assoc()){
                                            $i++; 
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td style="text-align:center;"><img src="<?php echo $result['blog_image']?>" alt="" style="width:60px;height:60px;" class="img rounded"></td>
                                                <td><?php echo substr($result['blog_title'], 0, 120); ?></td>
                                                <td style="text-align:center;"><?php 
                                            if($result['status'] =='1'){?>
                                              <button class="btn btn-success">PUBLISHED</button>
                                               <?php }else{?>
                                               <button class="btn btn-danger">PENDING</button>
                                               <?php }?></td>
                                                <td style="text-align:center;">

                                                <a href="edit_post.php?edit_post=<?php echo $result['blog_id'];?>" class="btn btn-primary" style="font-size:16px;height:33px;">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a> 
                                                <a href="?del_post=<?php echo $result['blog_id'];?>" class="btn btn-danger" style="font-size:16px;height:33px;" onclick="return confirm('Are you sure to delete!')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                </td>
                                               
                                            </tr>
                                            <?php }}else{echo "<h1 style='color:#fff;text-align:center;padding:15px 0px 0px 0px;'>No Post Added Yet!</h1>"."<br>"."<h3 style='text-align:center;'></h3>";}?>
                                        </tbody>
                                        
                                    </table>
                                
                                </div>
                                <p class="text-center"><a href="add_post.php" class="btn btn-danger" style="font-size:20px;margin-left:15px;">Add Post Here</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 