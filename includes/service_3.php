 <!-- Testimonials -->
 <section id="service_3">
             <div class="container">
                 <div class="text-center mt-1">

                     <p class="pt-4 text-uppercase">MY SERVICES </p>
                     <p class="" style="font-size:25px;">What Services I Offer</p>
                 </div>
                 <div class="row wow animated bounceInDown" data-wow-duration="1s" data-wow-delay=".5s" style="margin-top:30px;">
                    <?php
                                        $ser_3 = "SELECT * FROM service_3";
                                        $ser = $db->select($ser_3);
                                        if($ser){   
                                        while($result = $ser->fetch_assoc()){
                                    ?>
                     <div class="col-md-4 text-center" id="service_3_hov">

                         <img src="admin_login/<?php echo $result['service_3_logo']; ?>" alt="Service Logo">
                         <p class="pt-3 text-uppercase"><?php echo $result['service_3_title']; ?> </p>
                         <p class="py-2 ser_mob_p" style="font-size:15px;"><?php echo $result['service_3_desc']; ?>

                         </p>
                         <a href="<?php echo $result['service_3_btn_link']; ?>" target="_blank" class="btn btn-success btn-sm text-uppercase"><?php echo $result['service_3_btn_text']; ?></a>
                     </div>
                     
                     <?php }} ?>
                     
                     

                 </div>

             </div>
         
         <!-- End Content Box -->
     
 </section>