<?php
    $query = "SELECT * FROM website_info WHERE id = '1'";
     $getwebsite = $db->select($query);
     if($result = $getwebsite->fetch_assoc()){ 

         $logo_main = $result['logo_big'];
         $site_title = $result['title'];
         $domain = $result['domain'];
         $support_email = $result['support_email'];

         $main_title = strtoupper($site_title);

     }
?>
               <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                           
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#websitesetup" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-fw fa-cog"></i></div>
                                 Website Option
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="websitesetup" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="website_info.php">Website Setup</a>
                                    <a class="nav-link" href="subscriber.php">Subscriber</a>
                                    <a class="nav-link" href="social.php">Social Media</a>
                                    <a class="nav-link" href="footer.php">Footer</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="edit_banner.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                                Banner Update
                            </a>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categorySetup" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                 Category
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="categorySetup" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add_category.php">Add Category</a>
                                    <a class="nav-link" href="categorylist.php">View Category</a>
                                    
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gigSetup" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                                 Gig
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="gigSetup" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add_gig.php">Add Gig</a>
                                    <a class="nav-link" href="view_gig.php">View Gig</a>
                                    
                                </nav>
                            </div>
                            
                            
                            <a class="nav-link" href="service_3.php">
                                <div class="sb-nav-link-icon"><i class="fab fa-servicestack"></i></div>
                                Service 3 Section
                            </a>
                           
                           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-blog"></i></div>
                                 Blog
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="blog" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add_post.php">Add Post</a>
                                    <a class="nav-link" href="view_post.php">View Posts</a>
                                    
                                     
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#portfolioPage" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>
                                 Portfolio
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="portfolioPage" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="portfolio_text.php">Portfolio Headers</a>
                                    <a class="nav-link" href="add_portfolio.php">Add Portfolio</a>
                                    <a class="nav-link" href="view_portfolio.php">View Portfolio</a>
                                     
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#testimonialOpen" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                                 Testimonial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="testimonialOpen" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add_test.php">Add Testimonial</a>
                                    <a class="nav-link" href="view_test.php">View Testimonial</a>
                                     
                                </nav>
                            </div>
                            

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesSetup" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                 Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesSetup" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="about.php">About</a>
                                    <a class="nav-link" href="yousec.php">Youtube Section</a>
                                    <a class="nav-link" href="privacy.php">Privacy</a>  
                                    <a class="nav-link" href="terms.php">Terms</a>  
                                </nav>
                            </div>

                           
                            <div class="sb-sidenav-menu-heading">Admin Setup</div>
                            
                            <a class="nav-link" href="change_pass.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                                Change Password
                            </a>
                            
                            <a class="nav-link" href="?action=logout">
                                <div class="sb-nav-link-icon"><i class="fa fa-fw fa-power-off"></i></div>
                                Log out
                            </a>
                            
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $main_title;?>
                    </div>
                </nav>
            </div>