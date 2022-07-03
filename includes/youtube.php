
    <?php
        $youtube_sec = "SELECT * FROM youtube_sec WHERE youtube_id='1'";
        $youtube = $db->select($youtube_sec);
        if($youtube){   
        while($result = $youtube->fetch_assoc()){
            
            $youtube_video   = $result['youtube_link'];
            $youtube_text    = $result['youtube_text']; 
            $youtube_channel = $result['youtube_channel']; 
            
        }}
    ?>

   

<div class="container">
    <div class="row my-5">
        <div class="col-lg-6 p-0">
           <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php echo $youtube_video; ?>" allowfullscreen></iframe>
            </div>
            
        </div>
        
        <div class="col-lg-6 px-5 text-left">
            <h4>You may like to see this video</h4>
            <p><?php echo $youtube_text; ?></p>
            
            <a href="<?php echo $youtube_channel; ?>" class="btn btn-md btn-success" target="_blank">Check my channel</a>
        </div>
    </div>
    <div style="height:10vh"></div>
</div>