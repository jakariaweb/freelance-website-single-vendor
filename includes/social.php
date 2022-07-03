		<!-- Start Social Media -->
		<div class="social-media">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-1">
						<ul class="social">
							<?php 
							$query 	= "SELECT * FROM social WHERE id='1'";
							$getSocial = $db->select($query);
							if($getSocial){
							while($result = $getSocial->fetch_assoc()){
							
							
							?>
							<li><a href="<?php echo $result['fb'];?>" target="_blank"><i class="fab fa-facebook" style="color: #c2c2c2;"></i></a></li>
							<li><a href="<?php echo $result['tw'];?>" target="_blank"><i class="fab fa-twitter" style="color: #c2c2c2;"></i></a></li>
							<li><a href="<?php echo $result['ins'];?>" target="_blank"><i class="fab fa-instagram-square" style="color: #c2c2c2;"></i></a></li>
							<li><a href="<?php echo $result['ytb'];?>" target="_blank"><i class="fab fa-youtube" style="color: #c2c2c2;"></i></a></li>
							<li><a href="<?php echo $result['pn'];?>" target="_blank"><i class="fab fa-pinterest" style="color: #c2c2c2;"></i></a></li>
							<li><a href="<?php echo $result['ld'];?>" target="_blank"><i class="fab fa-linkedin" style="color: #c2c2c2;"></i></a></li>

							<?php }}?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Social Media -->