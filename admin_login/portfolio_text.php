<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-dark text-white">
                                    <h4>Portfolio Header Update</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                      
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                                    

                                    $portfolio_main_head            = strip_tags($_POST['portfolio_main_head']);
                                    $portfolio_sub_head           = strip_tags($_POST['portfolio_sub_head']);
                                   
                                    $portfolio_main_head            = $fm->validation($portfolio_main_head);
                                    $portfolio_sub_head           = $fm->validation($portfolio_sub_head);
                                   
                                    $portfolio_main_head            = mysqli_real_escape_string($db->link, $portfolio_main_head);
                                    $portfolio_sub_head           = mysqli_real_escape_string($db->link, $portfolio_sub_head);
                                   

                                    if($portfolio_main_head == "" || $portfolio_sub_head == ""){

                                        echo "<span style='color:red;font-size:18px;'>Filed must not be empty</span>";

                                    }else{
                                       
                                        $query = "UPDATE portfolio_head
                                        SET
                                        portfolio_main_head = '$portfolio_main_head',
                                        portfolio_sub_head = '$portfolio_sub_head'
                                        WHERE portfolio_head_id = '1'";
                                        $updated_rows = $db->update($query);
                                        if ($updated_rows) {
                                            echo "<script>alert('Portfolio Information Updated Successfully');</script>";
                                            echo "<script>window.location='portfolio_text.php';</script>";
                                        }else {
                                        echo "<span class='error'>Data Not Updated Inserted !</span>";
                                        }


                                    }

                                }
                                ?>


                                <?php 

                                
                                    
                                        $query = "SELECT * FROM portfolio_head WHERE portfolio_head_id='1'";
                                        $getwebsite = $db->select($query);
                                        while($result = $getwebsite->fetch_assoc()){
                                ?>

                                    <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post">
                                        
                                            <div class="form-group row">
                                                <label for="portfolio_main_head" class="col-sm-3 col-form-label">Portfolio Main Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="portfolio_main_head" id="portfolio_main_head" value="<?php echo $result['portfolio_main_head']?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="portfolio_sub_head" class="col-sm-3 col-form-label">Portfolio Sub Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="portfolio_sub_head" id="portfolio_sub_head" value="<?php echo $result['portfolio_sub_head']?>">
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