<?php 
    ob_start();
    include 'functions/functions.php';
    $query = "SELECT * FROM website_info WHERE id = '1'";
    $getwebsite = $db->select($query);
     if($result = $getwebsite->fetch_assoc()){ 
         $logo_main = $result['logo_big'];
         $favicon = $result['favicon'];
         $site_title = $result['title'];
         $domain = $result['domain'];
         $hire_btn = $result['hire_btn'];
         $hire_btn_txt = $result['hire_btn_txt'];
         $support_email = $result['support_email'];
         $meta_tags = $result['meta_tags'];
         $meta_desc = $result['meta_desc'];
		 $main_title = $site_title;
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $main_title; ?></title>
	<meta name="HandheldFriendly" content="true">
    <meta name=og:title content="<?php echo $main_title; ?>">
	<meta name="keywords" content="<?php echo $meta_tags; ?>">
	<meta name="author" content="<?php echo $main_title; ?>">
    <meta name="description" content="<?php echo $meta_desc; ?>">
	
	<link rel="shortcut icon" href="admin_login/<?php echo $favicon; ?>">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Fancybox CSS -->
	<link rel="stylesheet" href="css/jquery.fancybox.min.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<style>
    .dropdown-menu .sub-menu {
    left: 100%;
    position: absolute;
    top: 0;
    visibility: hidden;
    margin-top: -1px;
}

.dropdown-menu li:hover .sub-menu {
    visibility: visible;
   
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
    margin-top: 0;
}

.navbar .sub-menu:before {
    border-bottom: 7px solid transparent;
    border-left: none;
    border-right: 7px solid rgba(0, 0, 0, 0.2);
    border-top: 7px solid transparent;
    left: -7px;
    top: 10px;
}
.navbar .sub-menu:after {
    border-top: 6px solid transparent;
    border-left: none;
    border-right: 6px solid #fff;
    border-bottom: 6px solid transparent;
    left: 10px;
    top: 11px;
    left: -6px;
}

    </style>
    
     <script data-ad-client="ca-pub-8109107152875776" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WMJ9BT5VZL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WMJ9BT5VZL');
</script>
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
		<!-- Navigation -->
		<nav class="navbar bg-light navbar-light navbar-expand-lg fixed-top site-navbar-target">
			<div class="container">
				<a onClick="document.location='index.php#home-section';" style="cursor:pointer;" class="navbar-brand">
                <img src="admin_login/<?php echo $logo_main; ?>" class="logomain" alt="<?php echo $site_title; ?>" title="<?php echo $site_title; ?>" />
				</a>
				
					<form class="searchbar" method="get" action="search.php">
						<div class="top_search">
							<div class="input-group">
								<!-- <input type="text" class="form-control" placeholder="Find Services" style="border-radius: 3px 0 0 3px;"> -->
								<span class="input-group-append">
									<div class="input-group-text bg-transparent" style="background: #fff !important; border-right: 1px solid #fff !important;"><i class="fa fa-search"></i></div>
								</span>
								<input class="form-control py-2 border-right-0 border" type="text" placeholder="Find Services" style="border-radius: 3px 0 0 3px;border-left: none !important" name="user_query" required>
								

								<div class="input-group-append">
									<button type="submit" class="btn btn-success search_btn" name="search" type="button" >
										Search
									</button>
								</div>
							</div>
						</div>
				  </form>

				

				<button class="navbar-toggler" type="button" 
					data-toggle="collapse" data-target="#navbarResponsive">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<!--<li class="nav-item"><a onClick="document.location='index.php#home-section';" style="cursor:pointer;" class="nav-link">Home</a></li>-->
						<li class="nav-item"><a onClick="document.location='index.php#about';" style="cursor:pointer;" class="nav-link">About</a></li>
						<li class="nav-item desktop_none"><a href="gig_service.php" class="nav-link">Fiverr Gigs</a></li>
						<li class="nav-item dropdown mobile_none">
                            <a class="nav-link dropdown-toggle" href="gig_service.php" id="dropdown01">Fiverr Gigs</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                              <?php
				
                            $get_cat = "SELECT * FROM categories LIMIT 0,8";
                            $categories = $db->select($get_cat);
                            if($categories){   
                            while($resultCat = $categories->fetch_assoc()){
                                
                           ?> 
					       <a class="dropdown-item" href="category.php?category_id=<?php echo $resultCat['cat_id']; ?>"><?php echo $resultCat['cat_name']; ?></a>
                            
                            <?php }}?>
                          
                            </div>
                       </li>
						<li class="nav-item"><a href="portfolio.php" class="nav-link">Portfolio</a></li>
						<li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
						<li class="nav-item"><a href="faq.php" class="nav-link">Faq</a></li>
					</ul>
					<a href="<?php echo $hire_btn; ?>" target="_blank" class="btn btn-outline-success btn-md outline-btn-top" style=""><?php echo $hire_btn_txt; ?></a>
				</div>
			</div>
		</nav>
		<?php if(isset($_GET["no_service"])){ 

		echo "<script>window.location='no_service.php';</script>";

		} ?>

<!--Start Slider-->
<?php include("includes/slider.php");?>
<!-- End of Slider-->
<?php
        
        if(isset($_GET['user_query']) && !empty($_GET['user_query'])){
          $user_query  = $_GET['user_query']; 
          
          $user_query  = mysqli_real_escape_string($db->link, $user_query);


        
        
?>


<br><br>
<div class="container">
		<div class="col-12 text-center mt-2">
			<p class="lead" style="font-size: 30px;font-weight: bold;">Search Results: <?php echo $user_query; ?></p>
            <div class="border-top border-gray mx-auto my-3" style="width: 20%;"></div>
		</div>

	<div class="row justify-content-center">
			<?php
				$get_gig = "SELECT * FROM gig WHERE gig_title LIKE '%$user_query%'";
				$gig = $db->select($get_gig);
				if($gig){   
				while($result = $gig->fetch_assoc()){
			?>
		<div class="col-md-6 col-lg-4 py-3">
			<div class="card" style="width: 18rem;height: 26rem;">
				<a href="<?php echo $result['gig_link']; ?>" target="_blank">
					<img class="card-img-top" src="admin_login/<?php echo $result['gig_image']; ?>" alt="" style="height:245px;">
				</a>
				<div class="card-body gig_card" style="padding: 1.2rem 10px">
					<p><a href="<?php echo $result['gig_link']; ?>"><?php echo $result['gig_title']; ?></a></p>
				</div>
				<div class="card-footer">
					<p class="text-muted" style="float: left; padding-bottom: 0; margin-bottom: 0; font-weight: bold; font-size: 16px;"><a href="<?php echo $result['gig_link']; ?>" class="text-uppercase"><?php echo $result['gig_link_text']; ?> </a></p>
					<p class="text-muted" style="float: right; padding-bottom: 0; margin-bottom: 0; font-weight: bold; font-size: 16px;">STARTING AT $<?php echo $result['gig_price']; ?></p>
					
				</div>
			</div>
		</div>

				<?php }}else{
                                    
                                    ?>
                                    
                                    <h3 class="text-left text-danger" style="text-transform:uppercase;">WE DIDN'T FIND ANY SERVICES WITH THIS KEYWORK: <span style="color:#848484;"><?php echo $user_query;?></span></h3>
                                    
                            <br>
                                   
                            <h3 class="tet-center">Please contact with me for any query</h3> <br>

							<br>

							<?php 
								
								$query = "SELECT * FROM website_info WHERE id = '1'";
								$getwebsite = $db->select($query);
								if($result = $getwebsite->fetch_assoc()){ 
									
									$hire_btn = $result['hire_btn'];
									$hire_btn_txt = $result['hire_btn_txt'];
									
								}
							?>
						
                                    
                    <?php } ?>
		

		
	</div>

								<div class="row">
									<div class="col-md-12">
									<br>
									<p class="text-center"><a href="<?php echo $hire_btn; ?>" target="_blank" class="btn btn-success btn-md">Contact me now</a></p>
									</div>
								</div>

</div>
   
    <?php }else{
                echo "<script>window.open('index.php?no_service','_self')</script>";
    }?>

<!-- Start Footer -->
<?php include("includes/footer.php");?>