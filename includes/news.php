
               
                   
                       
                        <?php
                            $query 	= "SELECT * FROM news WHERE new_id ='1'";
                            $getnews = $db->select($query);
                            if($getnews){  

                            while($result = $getnews->fetch_assoc()){



                          ?>
                       
                            <div class="" style="height:55px;padding: 10px 5px !important;background-image: linear-gradient(to right, #28a745, #28a745, #28a745, #28a745, #28a745);color:#fff;">
                                 
                                 <h3 style="width:100%;"><marquee behavior="" direction="" ><?php echo $result['news_title'];?></marquee></h3>
                            <div class="clearfix"></div>
                            </div>
                        
                        
                        <?php }}?>

                        
                    
                    <!-- /.row -->

               
          

         