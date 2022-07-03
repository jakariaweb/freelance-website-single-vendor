 <!-- Testimonials -->
    <section id="testimonials" >

                <div class="container">
                    <div class="text-center mt-5">
								
                        <p class="pt-4 text-uppercase">Some Valuable Testimonials </p>
                        <p class="" style="font-size:25px;">My Clients Say About Me</p>
                    </div>

                    <div class="row wow animated bounceInDown" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="col-md-12">

                            <div id="customers-testimonials" class="text-left owl-carousel owl-theme">
                                
                                <?php
                                        $get_test = "SELECT testimonial.test_img, testimonial.test_comment, testimonial.test_client,
                                        testimonial.test_country, countries.country_name
                                        FROM testimonial
                                        INNER JOIN countries
                                        ON testimonial.test_country = countries.country_id
                                        ORDER BY testimonial.test_id";
                                        $test = $db->select($get_test);
                                        if($test){   
                                        while($result = $test->fetch_assoc()){
                                            
                                    ?>
                                    
                                    <div class="row">
                                            <div class="col-md-4">
                                                 <div id="heart" class="col d-flex align-items-center justify-content-center">
                                                     <img src="admin_login/<?php echo $result['test_img'];?>" class="img-responsive rounded-circle mx-auto d-block" alt="testimonial">
                                                 </div>
                                            </div>
                                            <div class="col-md-7">
                                             <div class="testimonial-author">
                                        <p>
                                            <strong> <?php echo $result['test_client'];?> </strong>
                                            <span> Country: <?php echo $result['country_name'];?> </span>
                                            
                                        </p>
                                    </div>
                                            <blockquote class="text-left">
                                        <p><?php echo $result['test_comment'];?></p>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                    </blockquote>
                                   
                                            </div>
                                       
                                    </div>

                                <?php }}?>


                            </div>

                        </div>

                    </div>

                </div>
         
            <!-- End Content Box -->
        
    </section>