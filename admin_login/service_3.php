<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-success text-white">
                                    <h4>Service 3 Section Update</h4>
                                </div>
                                <div class="card-body">
                                

                                    <div class="row">
                                    <?php
                                        $ser_3 = "SELECT * FROM service_3";
                                        $ser = $db->select($ser_3);
                                        if($ser){   
                                        while($result = $ser->fetch_assoc()){
                                    ?>

                                    <div class="col-md-3">
                                        <div class="card my-2" style="width: 18rem;min-height: 24rem; max-height:24rem;">
                                            <div class="col-md-12 text-center py-3" id="service_3_hov">
                                            <img src="<?php echo $result['service_3_logo']; ?>" class="justify-content-center align-self-center" >
                                            <div class="card-body">
                                               
                                                <p><?php echo $result['service_3_title']; ?></p>
                                                <p><?php echo $result['service_3_desc']; ?></p>

                                            </div>
                                           
                                            <div class="card-footer">
                                           
                                                <a href="edit_ser_3.php?edit_ser=<?php echo $result['service_3_id']; ?>" class="btn btn-success">
                                                    <i class="fa fa-pen"></i> Update
                                                </a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    

                                    <?php }} ?>
                                    
                                    
                                        
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