<div class="container" id="gig">
		<div class="text-center mt-2 wow animated fadeInDown">
			<p class="lead" style="font-size: 30px;font-weight: bold;">Choose what service you want</p>
		</div>

	<div class="row justify-content-center">
			<?php
				$get_gig = "SELECT * FROM gig LIMIT 0,9";
				$gig = $db->select($get_gig);
				if($gig){   
				while($result = $gig->fetch_assoc()){
			?>
		<div class="col-md-6 col-lg-4 py-3">
			<div class="card" style="min-width: 18rem;height: 23rem;">
				<a href="<?php echo $result['gig_link']; ?>" target="_blank">
					<img class="card-img-top" src="admin_login/<?php echo $result['gig_image']; ?>" alt="" style="height:245px;">
				</a>
				<div class="card-body gig_card" style="padding: 1.2rem 10px">
					<p><a href="<?php echo $result['gig_link']; ?>" target="_blank"><?php echo $result['gig_title']; ?></a></p>
				</div>
				<div class="card-footer">
					<p class="text-muted" style="float: left; padding-bottom: 0; margin-bottom: 0; font-weight: bold; font-size: 16px;"><a href="<?php echo $result['gig_link']; ?>" target="_blank" class="text-capitalize"><?php echo $result['gig_link_text']; ?> </a></p>
					<p class="text-muted" style="float: right; padding-bottom: 0; margin-bottom: 0;">STARTING AT $<?php echo $result['gig_price']; ?></p>
					
				</div>
			</div>
		</div>

				<?php }}?>
		

		
	</div>
	
	    <div class="col-12 text-center mt-2 wow animated fadeInDown">
			<a href="gig_service.php" class="btn btn-success btn-sm text-uppercase">More Gigs</a>
		</div>


</div>