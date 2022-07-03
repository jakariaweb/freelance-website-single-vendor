<section id="portfolio">
		<div class="container">
			<div class="text-center mt-5">
								<?php 

                                
                                    
                                        $query = "SELECT * FROM portfolio_head WHERE portfolio_head_id='1'";
                                        $getwebsite = $db->select($query);
                                        while($result = $getwebsite->fetch_assoc()){
											$main_header_port = $result['portfolio_main_head'];
											$portfolio_sub_head = $result['portfolio_sub_head'];
										}
                                ?>
				<p class="pt-4 text-uppercase"><?php echo $main_header_port; ?></p>
				<p class="" style="font-size:25px;"><?php echo $portfolio_sub_head; ?></p>
			</div>
			
			<div class="text-center mt-5 p-0">
					 
				<button class="btn btn-default filter-button" data-filter="all">All</button>
					<?php
				
						$get_cat = "SELECT * FROM categories";
						$categories = $db->select($get_cat);
						if($categories){   
						while($resultCat = $categories->fetch_assoc()){
					?>
				<button class="btn btn-default filter-button" data-filter="<?php echo $resultCat['cat_short']; ?>"><?php echo $resultCat['cat_name']; ?></button>
				 <?php }}?>
			</div>
			
			<div class="row">

			<?php
				$get_portfolio = "SELECT * FROM portfolio ORDER BY portfolio_id ASC LIMIT 0,12";
				$portfolio = $db->select($get_portfolio);
				if($portfolio){   
				while($result = $portfolio->fetch_assoc()){

					$gig_category = $result['portfolio_category'];
					$get_cat = "SELECT * FROM categories WHERE cat_id='$gig_category'";
					$categories = $db->select($get_cat);
					if($categories){   
					while($resultCat = $categories->fetch_assoc()){
						$cat_name = $resultCat['cat_name'];
						$cat_short = $resultCat['cat_short'];
					}
				}


			?>
			
				
				
				<div class="col-md-4 col-sm-12 col-xs-12 col-lg-4 filter <?php echo $cat_short;?> pt-3">
                    <div class="hvrbox">
                        <a href="admin_login/<?php echo $result['portfolio_image'];?>" class="item-wrap fancybox" data-fancybox="gallery2">
                        <img src="admin_login/<?php echo $result['portfolio_image'];?>" alt="Mountains" class="hvrbox-layer_bottom">
                        <div class="hvrbox-layer_top hvrbox-layer_slidedown">
                            <div class="hvrbox-text">
                                <?php echo $cat_name;?> Design By <br> Amit Bairagi
                            </div>
                        </div>

                        </a>
                    </div>
				</div>
				
				

				<?php }}?>
				
			</div>
			
			<div class="col-12 text-center mt-2 wow animated fadeInDown">
			<a href="portfolio.php" class="btn btn-success btn-sm text-uppercase">View More Portfolio</a>
		</div>
			
			
		</div>
	</section>