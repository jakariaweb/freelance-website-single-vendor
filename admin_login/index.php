<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4 text-center">Welcome to Administrator Dashboard</h1>
                        <ol class="breadcrumb mb-4" style="background-image: linear-gradient(to bottom, #000000, #0c0005, #100010, #0e001a, #000323);">
                            <li class="breadcrumb-item text-white active">Dashboard</li>
                        </ol>
                         <div class="row">
                          <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-image: linear-gradient(to bottom, #00851d, #06661b, #0a4916, #0b2d10, #011401);color:#fff;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <i class="fa fa-briefcase fa-5x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge">
                                                <h3>Gig <br> <br> 

                                                 <?php 
                                                    $query = "SELECT * FROM gig";
                                                    $counttrans = $db->select($query);
                                                    if($counttrans){
                                                    $count = mysqli_num_rows($counttrans);
                                                        echo "<span style='font-family:sans-serif;'>(".$count.")</span>";
                                                    }else{
                                                        echo "(0)";
                                                    }

                                                    ?>
                                                 </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_gig.php">
                                        <div class="card-footer">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-image: linear-gradient(to bottom, #000d21, #001233, #001546, #001557, #001267);color:#fff;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <i class="fa fa-file fa-5x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge">
                                                <h3>Category <br> <br> 
                                                <?php 
                                                    $query = "SELECT * FROM categories";
                                                    $counttrans = $db->select($query);
                                                    if($counttrans){
                                                    $count = mysqli_num_rows($counttrans);
                                                        echo "<span style='font-family:sans-serif;'>(".$count.")</span>";
                                                    }else{
                                                        echo "(0)";
                                                    }

                                                    ?>
                                                 </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <a href="categorylist.php">
                                        <div class="card-footer">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header" style="background-image: linear-gradient(to bottom, #0a0027, #1b2756, #294b8b, #2b73c4, #079eff);color:#fff;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge">
                                                <h3>Portfolio <br> <br> 
                                                <?php 
                                                    $query = "SELECT * FROM portfolio";
                                                    $counttrans = $db->select($query);
                                                    if($counttrans){
                                                    $count = mysqli_num_rows($counttrans);
                                                        echo "<span style='font-family:sans-serif;'>(".$count.")</span>";
                                                    }else{
                                                        echo "(0)";
                                                    }

                                                    ?>
                                                 </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_portfolio.php">
                                        <div class="card-footer">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-4 my-4">
                                <div class="card">
                                    <div class="card-header" style="background-image: linear-gradient(to bottom, #360900, #621018, #94132f, #c80f4c, #ff006f);color:#fff;">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <i class="fa fa-tasks fa-5x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge">
                                                <h3>Blog Posts <br> <br> 
                                                <?php 
                                                    $query = "SELECT * FROM blog WHERE status='1'";
                                                    $counttrans = $db->select($query);
                                                    if($counttrans){
                                                    $count = mysqli_num_rows($counttrans);
                                                        echo "<span style='font-family:sans-serif;'>(".$count.")</span>";
                                                    }else{
                                                        echo "(0)";
                                                    }

                                                    ?>
                                                 </h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <a href="view_post.php">
                                        <div class="card-footer">
                                            <span class="float-left">View Details</span>
                                            <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 