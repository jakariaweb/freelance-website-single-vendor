            <?php 
                 $query = "SELECT * FROM slider WHERE 	slider_id = '1'";
                         $getwebsite = $db->select($query);
                        if($getwebsite){
                             $result_home_banner = $getwebsite->fetch_assoc(); 
                            
                             $home_banner = $result_home_banner['slide_image'];
                        }
                        
            ?>
        

        <div class="searchOnCarousel" style="background-image: url(admin_login/<?php echo $home_banner; ?>);">
			<div class="container">
				<div class="row">
					<div class="mx-auto form-section">
				
						<form role="form" method="get" action="search.php">
						    <h3 class="slider_form_text">Find the perfect freelance services <br> for your business</h3>
							<div class="top_search">
								<div class="input-group">
									<!-- <input type="text" class="form-control" placeholder="Find Services" style="border-radius: 3px 0 0 3px;"> -->
									<span class="input-group-append">
										<div class="input-group-text bg-transparent" style="background: #fff !important; border-right: 1px solid #fff !important;"><i class="fa fa-search"></i></div>
									</span>
									<input class="form-control py-2 border-right-0 border" type="text" placeholder="Try 'Logo Design' " style="border-radius: 0px 0 0 0px;border-left: none !important" name="user_query" required>
									
	
									<div class="input-group-append">
										<button type="submit" class="btn btn-success" name="search" type="button" style="padding: 0px 10px !important;
background: #fa3798; border: 1px solid #fa3798;">
											Search
										</button>

									</div>
								</div>
								
							</div>
							
							<p class="slider_form_p">
                              <?php

                                $get_cat = "SELECT * FROM categories LIMIT 0,4";
                                $categories = $db->select($get_cat);
                                if($categories){   
                                while($resultCat = $categories->fetch_assoc()){
                            ?> 
                              <a href="category.php?category_id=<?php echo $resultCat['cat_id']; ?>" class="tags-search"><?php echo $resultCat['cat_name']; ?></a>

                                <?php }}?>
					        </p>
							
					  </form>
					  
					  
					  
					</div>

				</div>
              
                
				  
			</div>
			
			
			    
			
			
		</div>
		
		
		
		