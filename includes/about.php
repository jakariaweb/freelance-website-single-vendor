<?php
	$about_page = "SELECT * FROM about WHERE about_id='1'";
	$about = $db->select($about_page);
	if($about){   
	while($result = $about->fetch_assoc()){

		$about_main_head = $result['about_main_head'];
		$about_sub_head  = $result['about_sub_head'];
		$about_content = $result['about_content'];
		$about_btn_link = $result['about_btn_link'];
		$about_btn_text  = $result['about_btn_text'];
		$about_img = $result['about_img'];

	}}
?>

<div class="container text-left mt-3">
   <div class="text-center mt-5 wow animated fadeInDown">
    <p class="pt-4 text-uppercase"><?php echo $about_main_head; ?></p>
   <p class="" style="font-size:25px;"><?php echo $about_sub_head; ?></p>
    </div>


<div class="mt-5">
    <div class="row py-1">
        <div class="col-lg-7 mb-4 my-lg-auto">
            <?php echo $about_content; ?>
            <br><br>
            <a href="<?php echo $about_btn_link; ?>" class="btn btn-outline-success btn-lg outline-btn-top" style="border-radius: 0px;padding: 3px 10px;"><?php echo $about_btn_text; ?></a>
        </div>

        <div class="col-lg-5 wow animated fadeInRight col-12 text-center">
            <!--					<img src="admin_login/<?php echo $about_img; ?>" alt="" class="w-100">-->

            <!-- Put this code anywhere in the body of your page where you want the badge to show up. -->

            <div itemscope itemtype='http://schema.org/Person' class='fiverr-seller-widget' style='display: inline-block;'>
                <a itemprop='url' href=https://www.fiverr.com/a_kumar07 rel="nofollow" target="_blank" style='display: inline-block;'>
                    <div class='fiverr-seller-content' id='fiverr-seller-widget-content-9e2113df-8bb2-4af5-86c2-15e9ce611a33' itemprop='contentURL' style='display: none;'></div>
                    <div id='fiverr-widget-seller-data' style='display: none;'>
                        <div itemprop='name'>a_kumar07</div>
                        <div itemscope itemtype='http://schema.org/Organization'><span itemprop='name'>Fiverr</span></div>
                        <div itemprop='jobtitle'>Seller</div>
                        <div itemprop='description'>
                            Hello! My name is Amit Bairagi. I am a professional graphic designer with many years of experience. I enjoy making corporate logos, business card design, print design, corporate branding, newsletters, flyers, banners, brochures, compliment slips, “thank you” cards and many more projects. I
                            am passionate about design and take pride in the quality of my work. An order with me, is an order with confidence!</div>
                    </div>
                </a>
            </div>

            <script id='fiverr-seller-widget-script-9e2113df-8bb2-4af5-86c2-15e9ce611a33' src='https://widgets.fiverr.com/api/v1/seller/a_kumar07?widget_id=9e2113df-8bb2-4af5-86c2-15e9ce611a33' data-config='{"category_name":"Graphics \u0026 Design"}' async='true' defer='true'></script>
        </div>


    </div>
    </div>
    
</div>