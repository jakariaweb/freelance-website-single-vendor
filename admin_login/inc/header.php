<?php
ob_start();
include '../lib/Session.php';
Session::checkSession();

include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';

$db = new Database();
$fm = new Format();


//set headers to NOT cache a page
//   header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
//   header("Pragma: no-cache"); //HTTP 1.0
//   header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
//   header("Cache-Control: max-age=2592000"); 

// updated

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


     $query = "SELECT * FROM website_info WHERE id = '1'";
     $getwebsite = $db->select($query);
     if($result = $getwebsite->fetch_assoc()){ 

         $logo_main = $result['logo_big'];
         $site_title = $result['title'];
         $domain = $result['domain'];
         $support_email = $result['support_email'];

         $main_title = strtoupper($site_title);

     }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Panel | <?php echo strtoupper($site_title);?></title>
        <link rel="stylesheet" href="css/jodit.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><?php echo strtoupper($site_title);?></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <a class="navbar-brand" href="news.php">News</a>
            <a class="navbar-brand" href="main_faq.php">F.A.Q</a>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </div>
            
            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
               <li  class="nav-item"><a href="../index.php" class="nav-link" target="_blank"><i class="fa fa-globe"></i> HOME SITE</a></li>
               <li  class="nav-item"><a href="?action=logout" class="nav-link"><i class="fa fa-fw fa-power-off"></i> Log out</a></li>
                
               
            </ul>
        </nav>
        <?php   
            if(isset($_GET['action']) && $_GET['action'] == "logout"){
                Session::destroy();
            }

         ?>