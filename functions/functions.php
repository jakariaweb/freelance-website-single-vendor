<?php
session_start();
include 'config/config.php';
include 'lib/Database.php';
include 'helpers/Format.php';
include 'helpers/geoiploc.php';
$db = new Database();
$fm = new Format();

/// IP address code starts /////
function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
/// IP address code Ends /////

function timeAgo($datetime){
            $time = strtotime($datetime);
            $current = time();
            $seconds = $current - $time;
            $minutes = round($seconds / 60);
            $hours = round($seconds / 3600);
            $months = round($seconds / 2600640);
            
            if($seconds <= 60){
                if($seconds == 0){
                    return 'now';
                }else{
                    return 'now';
                }
                
                }elseif($minutes <= 60){
                    return $minutes.'m ago';
                }elseif($hours <= 24){
                    return $hours.'h ago';
                }elseif($months <= 12){
                    return date('j M Y', $time);
                }else{
                    return date('j M Y', $time);
                }
            
}

function substr_word($body,$maxlength){
    if (strlen($body)<$maxlength) return $body;
    $body = substr($body, 0, $maxlength);
    $rpos = strrpos($body,' ');
    if ($rpos>0) $body = substr($body, 0, $rpos);
    return $body;
}

function title_function($string){
     $string = substr($string,0,40);
     $string = substr($string,0,strrpos($string," "));
     return $string;
}
function desc_function($string){
     $string = substr($string,0,100);
     $string = substr($string,0,strrpos($string," "));
     return $string;
}

function getBlog(){
    global $db;
    $get_blog = "SELECT * FROM blog WHERE status='1' ORDER BY blog_id DESC LIMIT 0,6";
    $blog = $db->select($get_blog);
    if($blog){  


    while($result = $blog->fetch_assoc()){
        
        $blog_id = $result['blog_id'];
        $blog_img = $result['blog_image'];
        $blog_title =  title_function($result['blog_title']);
        $blog_url = $result['blog_url'];
        $blog_desc = desc_function($result['blog_desc'])." ...";
        
        echo "<div class='col-md-12 col-sm-12 py-2'>
                <div class='card' style='height:22rem;'>
                    <a href='$blog_url'>
                        <img class='card-img-top' src='admin_login/$blog_img' alt='Blog Image' style='width:348px;height:245px;'>
                    </a>
                    <div class='card-body gig_card' style='padding: 1.2rem 10px'>
                        <p style='font-size:18px;font-weight:bold'><a href='$blog_url' >$blog_title</a></p>
                        <p style='font-size:14px;'>$blog_desc</p>
                    </div>
                </div>
        </div>
        
        ";
        
    }}
    
}


function desc_blog_function($string){
     $string = substr($string,0,300);
     $string = substr($string,0,strrpos($string," "));
     return $string;
}

function getBlogPosts(){
    global $db;
    $get_blog = "SELECT * FROM blog WHERE status='1' ORDER BY blog_id DESC";
    $blog = $db->select($get_blog);
    if($blog){  


    while($result = $blog->fetch_assoc()){
        
        $blog_id = $result['blog_id'];
        $blog_img = $result['blog_image'];
        $blog_title =  title_function($result['blog_title']);
        $blog_url = $result['blog_url'];
        $blog_desc = desc_blog_function($result['blog_desc'])." ...";
        
        echo "
        <div class='col-md-4 mb-5'>
                <div class='card' style='height:22rem;'>
                    <a href='$blog_url'>
                        <img class='card-img-top' src='admin_login/$blog_img' alt='Blog Image' style='height:200px;'>
                    </a>
                    <div class='card-body gig_card' style='padding: 1.2rem 10px'>
                        <p style='font-size:18px;font-weight:bold'><a href='$blog_url' >$blog_title</a></p>
                       
                    </div>
                </div>
        </div>
        
        ";
        
    }}
    
}


// Gig Functions with paginations
function pagination(){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM gig";
    $read = $db->select($sql);
    $row = mysqli_fetch_row($read);
    $row_count = $row[0];
    
    $pagination_button  = 2;
    $page_number        = (isset($_GET['page']) AND !empty($_GET['page']))? $_GET['page']:1;
    $per_page_records   = 9;
    $rows               = $row_count;
    $last_page          = ceil($rows/$per_page_records); // round up
    
    $offset = ($page_number-1)*$per_page_records;
    
        $sql = "SELECT * FROM gig LIMIT $per_page_records OFFSET $offset";
        $result_gig = $db->select($sql);
            if($result_gig){
            while($rowresult = $result_gig->fetch_assoc()){
                
                
                
                    echo '<div class="col-md-6 col-lg-4 py-3">
			<div class="card" style="min-width: 18rem;height: 23rem;">
				<a href="'.$rowresult['gig_link'].'" target="_blank">
					<img class="card-img-top" src="admin_login/'.$rowresult['gig_image'].'" alt="" style="height:245px;">
				</a>
				<div class="card-body gig_card" style="padding: 1.2rem 10px">
					<p><a href="'.$rowresult['gig_link'].'" target="_blank">'.$rowresult['gig_title'].'</a></p>
				</div>
				<div class="card-footer">
					<p class="text-muted" style="float: left; padding-bottom: 0; margin-bottom: 0; font-weight: bold; font-size: 16px;"><a href="'.$rowresult['gig_link'].'" class="text-capitalize" target="_blank">'.$rowresult['gig_link_text'].'</a></p>
					<p class="text-muted" style="float: right; padding-bottom: 0; margin-bottom: 0;">STARTING AT $'.$rowresult['gig_price'].'</p>
					
				</div>
			</div>
		</div>
        
        ';
                }
            
               
            }
    
    $pagination         = '';
    
    $pagination        .= '<nav aria-label="Page navigation example" style="width:100%;display:inline-block;">';
    $pagination        .= '<ul class="pagination pagination-blog justify-content-center">';
    
    
    if($page_number < 1){
        $page_number = 1;
    }else if($page_number > $last_page){
        $page_number = $last_page;
    }

    
    
    
    $half               = floor($pagination_button/2); // round down
    
    if($page_number < $pagination_button AND ($last_page == $pagination_button OR $last_page > $pagination_button)){
        
        for($i=1; $i<=$pagination_button; $i++){
            
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
        
        if($last_page > $pagination_button){
            $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.($pagination_button+1).'">»</a></li>';
        }
        
    }
    
    else if($page_number >= $pagination_button AND $last_page > $pagination_button){
        
        if(($page_number+$half) >= $last_page){
             $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.($last_page - $pagination_button).'">«</a></li>';
        for($i=($last_page - $pagination_button)+1; $i<=$last_page; $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            
        }else if(($page_number+$half) < $last_page){
            $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.(($page_number-$half)-1).'">«</a></li>';
            
        for($i=($page_number-$half); $i<=($page_number+$half); $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            $pagination .= '<li class="page-item"><a class="page-link" href="gig_service.php?page='.(($page_number+$half)+1).'">»</a></li>';
        }
        
        
    }
    
    $pagination        .= '</ul></nav>';
    
    echo $pagination;
    
    
    
    
    

}

// Blog Functions with Pagination

function paginationBlog(){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM blog WHERE status='1' ORDER BY blog_id DESC";
    $read = $db->select($sql);
    $row = mysqli_fetch_row($read);
    $row_count = $row[0];
    
    $pagination_button  = 3;
    $page_number        = (isset($_GET['page']) AND !empty($_GET['page']))? $_GET['page']:1;
    $per_page_records   = 9;
    $rows               = $row_count;
    $last_page          = ceil($rows/$per_page_records); // round up
    
    $offset = ($page_number-1)*$per_page_records;
    
        $sql = "SELECT * FROM blog ORDER BY blog_id DESC LIMIT $per_page_records OFFSET $offset";
        $result_blog = $db->select($sql);
            if($result_blog){
            while($rowresult = $result_blog->fetch_assoc()){
                $blog_desc = desc_function($rowresult['blog_desc'])." ...";
                    echo '<div class="col-md-6 col-lg-4 py-3">
			<div class="card" style="min-width: 18rem;height: 26rem;">
				<a href="'.$rowresult['blog_url'].'">
					<img class="card-img-top" src="admin_login/'.$rowresult['blog_image'].'" alt="" style="height:245px;">
				</a>
				<div class="card-body gig_card" style="padding: 1.2rem 10px">
					<p style="font-size:18px;font-weight:bold;color:rgb(223,8,115);"><a href="'.$rowresult['blog_url'].'">'.$rowresult['blog_title'].'</a></p>
					<p>'.$blog_desc.'</p>
				</div>
				
			</div>
		</div>
        
        ';
                }
            
               
            }
    
    $pagination         = '';
    
    $pagination        .= '<nav aria-label="Page navigation example" style="width:100%;display:inline-block;">';
    $pagination        .= '<ul class="pagination pagination-blog justify-content-center">';
    
    
    if($page_number < 1){
        $page_number = 1;
    }else if($page_number > $last_page){
        $page_number = $last_page;
    }

    
    
    
    $half               = floor($pagination_button/2); // round down
    
    if($page_number < $pagination_button AND ($last_page == $pagination_button OR $last_page > $pagination_button)){
        
        for($i=1; $i<=$pagination_button; $i++){
            
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
        
        if($last_page > $pagination_button){
            $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.($pagination_button+1).'">»</a></li>';
        }
        
    }
    
    else if($page_number >= $pagination_button AND $last_page > $pagination_button){
        
        if(($page_number+$half) >= $last_page){
             $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.($last_page - $pagination_button).'">«</a></li>';
        for($i=($last_page - $pagination_button)+1; $i<=$last_page; $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            
        }else if(($page_number+$half) < $last_page){
            $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.(($page_number-$half)-1).'">«</a></li>';
            
        for($i=($page_number-$half); $i<=($page_number+$half); $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            $pagination .= '<li class="page-item"><a class="page-link" href="blog.php?page='.(($page_number+$half)+1).'">»</a></li>';
        }
        
        
    }
    
    $pagination        .= '</ul></nav>';
    
    echo $pagination;
    
    
    
    
    

}

// Portfolio Functions With Paginations
function paginationPort(){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM portfolio ORDER BY portfolio_id ASC";
    $read = $db->select($sql);
    $row = mysqli_fetch_row($read);
    $row_count = $row[0];
    
    $pagination_button  = 2;
    $page_number        = (isset($_GET['page']) AND !empty($_GET['page']))? $_GET['page']:1;
    $per_page_records   = 24;
    $rows               = $row_count;
    $last_page          = ceil($rows/$per_page_records); // round up
    
    $offset = ($page_number-1)*$per_page_records;
    
        $sql = "SELECT * FROM portfolio LIMIT $per_page_records OFFSET $offset";
        $result_gig = $db->select($sql);
            if($result_gig){
            while($rowresult = $result_gig->fetch_assoc()){
                
                $gig_category = $rowresult['portfolio_category'];
                $get_cat = "SELECT * FROM categories WHERE cat_id='$gig_category'";
					$categories = $db->select($get_cat);
					if($categories){   
					while($resultCat = $categories->fetch_assoc()){
						$cat_name = $resultCat['cat_name'];
						$cat_short = $resultCat['cat_short'];
					}
				}
                
            echo '<div class="col-md-4 col-sm-12 col-xs-12 col-lg-4 filter '.$cat_short.' pt-3">
                    <div class="hvrbox">
                        <a href="admin_login/'.$rowresult['portfolio_image'].'" class="item-wrap fancybox" data-fancybox="gallery2">
                        <img src="admin_login/'.$rowresult['portfolio_image'].'" alt="'.$cat_name.'" class="hvrbox-layer_bottom">
                        <div class="hvrbox-layer_top hvrbox-layer_slidedown">
                            <div class="hvrbox-text">
                                '.$cat_name.' Design By <br> Amit Bairagi
                            </div>
                        </div>

                        </a>
                    </div>
				</div>';
                }
            
               
            }
    
    $pagination         = '';
    
    $pagination        .= '<nav aria-label="Page navigation example" style="width:100%;display:inline-block;">';
    $pagination        .= '<ul class="pagination pagination-blog justify-content-center">';
    
    
    if($page_number < 1){
        $page_number = 1;
    }else if($page_number > $last_page){
        $page_number = $last_page;
    }

    
    
    
    $half               = floor($pagination_button/2); // round down
    
    if($page_number < $pagination_button AND ($last_page == $pagination_button OR $last_page > $pagination_button)){
        
        for($i=1; $i<=$pagination_button; $i++){
            
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
        
        if($last_page > $pagination_button){
            $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.($pagination_button+1).'">»</a></li>';
        }
        
    }
    
    else if($page_number >= $pagination_button AND $last_page > $pagination_button){
        
        if(($page_number+$half) >= $last_page){
             $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.($last_page - $pagination_button).'">«</a></li>';
        for($i=($last_page - $pagination_button)+1; $i<=$last_page; $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            
        }else if(($page_number+$half) < $last_page){
            $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.(($page_number-$half)-1).'">«</a></li>';
            
        for($i=($page_number-$half); $i<=($page_number+$half); $i++){
            if($i == $page_number){
                $pagination .= '<li class="page-item active"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
            else{
                $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
            $pagination .= '<li class="page-item"><a class="page-link" href="portfolio.php?page='.(($page_number+$half)+1).'">»</a></li>';
        }
        
        
    }
    
    $pagination        .= '</ul></nav>';
    
    echo $pagination;
    
    
    
    
    

}


?>