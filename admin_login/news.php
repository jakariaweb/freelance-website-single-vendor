<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?>
<?php

            if (isset($_GET['no_news'])) {
                $no_news_id = $_GET['no_news'];
                    $query = "UPDATE news SET news_title ='', status='0' WHERE new_id ='1'";
                        $update_row = $db->update($query);
                        if ($update_row) {
                            echo "<script>alert('News Bulletin Updated Successfully');</script>";
                            echo "<script>window.location='news.php';</script>";

                        }else{
                                echo "<div class='alert alert-danger'>
                                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; News Bulletin Not Updated!</a>
                                    </div>";

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
                                    <h4>Update News</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                          if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $news_title  = $_POST['news_title'];
                             
                              
                                  
                                  if($news_title==""){
                                      echo "<div class='alert alert-danger'>
                                            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; News Bulletin Field Must Not Be Empty ! </a>
                                            </div>";
                                  }else{
                                         
                                            $query = "UPDATE news SET news_title ='$news_title', status='1' WHERE new_id ='1'"; 
                                            $update_row = $db->update($query);
                                            if ($update_row) {
                                                echo "<script>alert('News Bulletin Updated Successfully');</script>";
                                                echo "<script>window.location='news.php';</script>";

                                            }else{
                                                    echo "<div class='alert alert-danger'>
                                                        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; News Bulletin Not Updated!</a>
                                                        </div>";

                                            }

                                   }

                                
                            }
                              
                          
                            ?>
                                   <div class="row">
                                        <form action="" method="post">
                                     
                                      <div class="form-group">
                                         
                                         <label for="news_title" class="control-label col-xs-4" style="font-size:20px;">News Bulletin</label> 
                                         <div class="col-xs-8">
                                         
                                         <?php
                                            $query 	= "SELECT * FROM news WHERE new_id ='1'";
                                            $getnews = $db->select($query);
                                            if($getnews){  
                                               
                                            while($result = $getnews->fetch_assoc()){

                                            
                                          
                                          ?>
                                         
                                         <?php
                                            
                                            if($result['status'] == 0){
                                                
                                           
                                             
                                         ?>
                                         
                                         <textarea name="news_title" id="news_title" cols="30" rows="10" class="form-control"></textarea>
                                         
                                        
                                         <br>
                                         <p class="text-danger"><b>*** No News Found.</b> Please Enter value above and Hit 
                                         <a class="btn btn-primary btn-sm" style="cursor:grabbing;">Update News</a>  Button   </p>
                                         
                                         <?php }else{?>
                                         
                                          <textarea name="news_title" id="" cols="30" rows="10" class="form-control"><?php echo $result['news_title'];?></textarea>
                                          <br>
                                          <p class="text-success">If you want to set no News, Please Hit 
                                         <a class="btn btn-danger btn-sm" style="cursor:grabbing;">Set No News</a>  Button   </p>
                                          
                                          <?php }?>
                                        </div>
                                        
                                      </div>
                                      
                                      <div class="clearfix"></div>
                                      <br> <br> <br>
                                      
                                      <div class="form-group">
                                          <input type="submit" name="submit" value="Update News" class="btn btn-primary"> &nbsp;&nbsp;&nbsp;&nbsp;
                                           <a href="?no_news=<?php echo $result['new_id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure to set no News Bulletin!')">Set No News</a>
                                          
                                          <br> <br>
                                          <p class="text-danger"><b>*** Note:</b> When you click <b>Set No News</b> User will not see any News Update </p>
                                          
                                      </div>
                                  </form>
                                  
                                  
                                  
                                  
                                  <?php }}?>

                                        
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