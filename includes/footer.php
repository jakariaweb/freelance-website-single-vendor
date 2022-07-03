
  <footer>
   
    <div class="whatsapp">
<a href="https://api.whatsapp.com/send?phone=+8801701404742" target="_blank">
<h5><i class="fab fa-whatsapp fa-3x" aria-hidden="true" ></i></h5>
</a>
</div>
    
      
		<div class="container">
			<div class="row text-left text-dark">
				<div class="col-md-3">
					<h5>About</h5>
				
					<p><a href="privacy.php">Privacy Policy</a></p>
					<p><a href="terms.php">Terms of Service</a></p>
					
					
				</div>

				<div class="col-md-3">
				
					

					<h5>Categories</h5>
					<?php
				
						$get_cat = "SELECT * FROM categories LIMIT 0,4";
						$categories = $db->select($get_cat);
						if($categories){   
						while($resultCat = $categories->fetch_assoc()){
					?> 
					<p><a href="category.php?category_id=<?php echo $resultCat['cat_id']; ?>"><?php echo $resultCat['cat_name']; ?></a></p>
					

						<?php }}?>
					
				</div>

				<div class="col-md-3">
					
					<h5>Subscribe</h5>
					<?php

						
						
						$query = "SELECT * FROM website_info WHERE id = '1'";
						$getwebsite = $db->select($query);
						if($result = $getwebsite->fetch_assoc()){ 
							$support_email = $result['support_email'];
							$site_title = $result['title'];
							$g_cap_site_key = $result['g_cap_site_key'];
							$g_cap_secret_key = $result['g_cap_secret_key'];
							$main_title = $site_title;
						
						}
						
                               
                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\Exception;
                            
                            require 'PHPMailer/src/Exception.php';
                            require 'PHPMailer/src/PHPMailer.php';
                            require 'PHPMailer/src/SMTP.php';
                               
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userSubscribe'])){
                
                
         
                
                $secret = $g_cap_secret_key;
                $response = $_POST['g-recaptcha-response'];
                $remoteip = $_SERVER['REMOTE_ADDR'];

                $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");

                $result = json_decode($url, TRUE);

                if($result['success'] == 1){
                
          
                    
            $subscribe_name         = strip_tags($_POST['subscribe_name']);
            $subscribe_email        = strip_tags($_POST['subscribe_email']);
          
                    
                    
            $subscribe_name         = $fm->validation($subscribe_name);
            $subscribe_email        = $fm->validation($subscribe_email);
          

            $subscribe_name      	= mysqli_real_escape_string($db->link, $subscribe_name);
			$subscribe_email     	= mysqli_real_escape_string($db->link, $subscribe_email);
		
                    
            
			 
			if ($subscribe_name == "" || $subscribe_email == "") {
				echo "<div class='alert alert-danger'>
                       <i class='fa fa-info-circle' style='font-size:18px;color:#cc0606;'></i> &nbsp; Filed must not be empty.</a>
                      </div>";
			}else if(filter_var($subscribe_email, FILTER_VALIDATE_EMAIL) === false){
					echo "<div class='alert alert-danger'>
                      <i class='fa fa-info-circle' style='font-size:18px;color:#cc0606;'></i> &nbsp; Invalid Email Address.</a>
                      </div>";
			}else{
                
				$chkquery = "SELECT * FROM subscribe WHERE subscribe_email='$subscribe_email' LIMIT 0,1";
				$chkresult = $db->select($chkquery);
				if ($chkresult != false) {
						echo "<script>alert('Email already in Subscription List');</script>";
                        echo "<script>window.location='$domain';</script>";
                      
				}else{
                    
                    $now = gmdate('y-m-d H:i:s', time() - 3600 * 5);
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $ipAdd = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
                   
                    
                    
                    $adduser = "INSERT INTO subscribe(subscribe_name,subscribe_email) 
					VALUES('$subscribe_name','$subscribe_email')";
	                $inserted_rows = $db->insert($adduser);
	                if ($inserted_rows) {

                        $mail = new PHPMailer(true); 

                        //Recipients
                        $mail->setFrom($support_email, $main_title);
                        $mail->addAddress($subscribe_email);     // Add a recipient

                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $main_title.' SUBSCRIPTION SUCCESSFUL';
                        $mail->Body    = '
                        <div style="width:65%;margin:10px auto;">
                        <p style="color:#fff;background-image: linear-gradient(to bottom, #250646, #1e0839, #19072c, #14031f, #090012);padding:15px;text-align:center;border-radius:5px;border:3px solid #ddd;font-size:20px;">'.$main_title.'</p>
                        <p></p>
                         <p style="text-align:justify;">Full Name: '.$subscribe_name.'</p>
                         <p style="text-align:justify;">Your Email: '.$subscribe_email.'</p>

                        <b>'.$support_email.'</b> <br><br>
                        <b>'.$domain.' </b><br><br><br><br>
                        <p style="color:#fff;background-image: linear-gradient(to left, #031229, #001522, #001616, #001309, #0b0f03);padding:15px;text-align:center;border-radius:5px;border:3px solid #ddd;">&copy; '.$main_title.' 2020 | All Rights Reserved.</p>
                        </div>
                        ';

                        $mail->send();
                            
                       
                        $mail1 = new PHPMailer(true);   
                        
                        //Admin Recipients
                        $mail1->setFrom($support_email, $main_title);
                        $mail1->addAddress($support_email, $main_title);     // Add a recipient

                        //Content
                        $mail1->isHTML(true);                                  // Set email format to HTML
                        $mail1->Subject = $main_title.' SUBSCRIPTION SUCCESSFUL';
                        $mail1->Body    = '
                       <div style="width:65%;margin:10px auto;font-family:arial;">
                          <p style="color:#fff;background-image: linear-gradient(to bottom, #250646, #1e0839, #19072c, #14031f, #090012);padding:15px;text-align:center;border-radius:5px;border:3px solid #ddd;font-size:20px;">'.$main_title.'</p>
                        <p></p>
                        <p>Hello <b>Admin</b>,</p>
                        <p>New user has been Registered:</p>
                        <p>-------------------------------------------------------</p>
                        <p style="text-align:justify;">Full Name: '.$subscribe_name.'</p>
                        <p style="text-align:justify;">Customer Email: '.$subscribe_email.'</p>
                        <p>Country: <b>' .getCountryFromIP($ip, ' NamE '). '</b></p>
                        <p>IP Address: <b>' .$ipAdd. '</b></p>
                        
                         

                       <b>'.$support_email.'</b> <br><br>
                        <b>'.$domain.' </b><br><br><br><br>
                        <p style="color:#fff;background-image: linear-gradient(to left, #031229, #001522, #001616, #001309, #0b0f03);padding:15px;text-align:center;border-radius:5px;border:3px solid #ddd;">&copy; '.$main_title.' 2020 | All Rights Reserved.</p>
                        </div>
                        ';

                        $mail1->send();
                            
                        
						
						echo "<script>alert('You Have Been Subscribed');</script>";
                        echo "<script>window.location='$domain';</script>";
                        
	                    
                                }else {
                                       echo "<span class='error'>User Not Subscribed !</span>";
                                   }

                            }

                            }
                                }else{
                                    echo "<div class='alert alert-danger'>
                                             <i class='fa fa-info-circle' style='font-size:18px;'></i> Please confirm that you are Human. 
                                            </div>"; 
                            }
                                }
                              
                              
                        ?>
                               
					<form action="" method="post" role="form" class="mod_form reg_form">
						<input type="text" class="form-control" placeholder="Full Name" style="margin-bottom: 8px;" name="subscribe_name" data-validation="length" data-validation-length="min4" data-validation="required"> 
						<input type="text" class="form-control" placeholder="Your Email" style="margin-bottom: 8px;" name="subscribe_email" data-validation="email"> 
						<div class="form-group text-center">
						
							<label for="image" style="float:none !important;">Human Verification</label>
							<div class="g-recaptcha" data-sitekey="<?php echo $g_cap_site_key;?>" style="transform: scale(0.8); margin-left: -24px;"></div>
						
						</div>
						<input type="submit" class="btn btn-md btn-success btn-block search_btn" value="Submit" name="userSubscribe" style="padding: 10px !important;border: 1px solid #fff;">
					</form>
				</div>

				<div class="col-md-3">
					
					<h5>Follow Me</h5>
					<p>
					<?php 
							$query 	= "SELECT * FROM social WHERE id='1'";
							$getSocial = $db->select($query);
							if($getSocial){
							while($result = $getSocial->fetch_assoc()){
							
							
							?>
							<a href="<?php echo $result['fb'];?>" target="_blank"><i class="fab fa-facebook footer_social" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['tw'];?>" target="_blank"><i class="fab fa-twitter footer_social" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ins'];?>" target="_blank"><i class="fab fa-instagram-square footer_social" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ytb'];?>" target="_blank"><i class="fab fa-youtube footer_social" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['pn'];?>" target="_blank"><i class="fab fa-pinterest footer_social" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ld'];?>" target="_blank"><i class="fab fa-linkedin footer_social" style="color: #c2c2c2;"></i></a>
					   
							<?php }}?>
					</p>
				</div>

				
			</div>
		</div>
		
		
	</footer>

	<!-- End Footer -->


	
	<div class="copyright text-dark py-1">
		<div class="container">
		<?php 
			$query = "SELECT * FROM footer WHERE footer_id = '1'";
			$getwebsiteFooter = $db->select($query);
				if($getwebsiteFooter){
				$result_footer = $getwebsiteFooter->fetch_assoc(); 

				$footer_note  = $result_footer['footer_note'];
				
			}

		?>

				<div class="float-left p-1">
					<img src="img/logo.png" alt="" style="width: 175px;margin-top: -8px;" class=""> &nbsp;
					<span style="color: #c2c2c2;padding-top: 10px;"><?php echo $footer_note;?></span>
				</div>
		
				<div class="float-right p-1">
					
						<p>
						<?php 
							$query 	= "SELECT * FROM social WHERE id='1'";
							$getSocial = $db->select($query);
							if($getSocial){
							while($result = $getSocial->fetch_assoc()){
							
							
							?>
							<a href="<?php echo $result['fb'];?>" target="_blank"><i class="fab fa-facebook footer_social_bottom" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['tw'];?>" target="_blank"><i class="fab fa-twitter footer_social_bottom" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ins'];?>" target="_blank"><i class="fab fa-instagram-square footer_social_bottom" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ytb'];?>" target="_blank"><i class="fab fa-youtube footer_social_bottom" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['pn'];?>" target="_blank"><i class="fab fa-pinterest footer_social_bottom" style="color: #c2c2c2;"></i></a>
							<a href="<?php echo $result['ld'];?>" target="_blank"><i class="fab fa-linkedin footer_social_bottom" style="color: #c2c2c2;"></i></a>
					   
							<?php }}?>
					   </p>
					
				</div>
				<div class="clearfix"></div>

			
		</div>
		
		
		
	</div>

	


	<!-- Script Source Files -->

	<!-- jQuery -->
	<script src="js/jquery-3.4.1.min.js"></script>
	 <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
 <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="js/jquery.fancybox.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Font Awesome -->
	<script src="js/all.min.js"></script>
    <!-- magnific-popup JS -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.form-validator.min.js"></script>
    <!-- owl carousel JS -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
	<!-- End Script Source Files -->
	

	<script>
        
       $(document).ready(function() {
           
           
           var table = $('#dataTable').DataTable({
    autoWidth: true,
    columns : [
        { width : '50px' },
        { width : '50px' }
               
    ] 
});
           
        } ); 
        
	$.validate({
		lang: 'en'
	});
        
        
        
        // Show/Hide transparent black navigation
        $(function () {

            $(window).scroll(function () {

                if ($(this).scrollTop() < 100) {
                    
                    $("#back-to-top").fadeOut();

                } else {
                    
                    $("#back-to-top").fadeIn();
                }
            });
        });
        
        // Smooth scrolling
        $(function () {

            $("a.smooth-scroll").click(function (event) {

                event.preventDefault();

                // get/return id
                var section = $(this).attr("href");

                $('html, body').animate({
                    scrollTop: $(section).offset().top - 64
                }, 1250, "easeInOutExpo");
            });
        });

		
		$(document).ready(function() {
			$(window).scroll(function() {    
				var scroll = $(window).scrollTop();

				if (scroll >= 1) {
					$(".searchbar").addClass("visible");   // removed the . from class
				} else {
					$(".searchbar").removeClass("visible");  // removed the . from class
				}
			});

			$(".filter-button").click(function(){
				var value = $(this).attr('data-filter');

				if(value == "all"){
					$('.filter').show('1000');

				}else{
					$(".filter").not('.'+value).hide('3000');
					$(".filter").filter('.'+value).show('3000');
				}
			});

			if($(".filter-button").removeClass("active")){
				$(this).removeClass("active");
			}
			$(this).addClass("active");
		});
        
        $(function () {

            $("#customers-testimonials").owlCarousel({
                items: 1,
                autoplay: true,
                smartSpeed: 700,
                loop: true,
                autoplayHoverPause: true
            });
        });
        
        
        
 
		
	</script>
	
</body>
</html>