<?php 
include '../lib/Session.php';
Session::checkLogin();
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';
?>
<?php 
    $db = new Database();
    $fm = new Format();

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

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ADMINISTRATOR LOGIN </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <script src="js/all.min.js" crossorigin="anonymous"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-image: linear-gradient(to bottom, #000000, #0d0006, #120011, #11001b, #040125);height:750px;">

    
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                  <br>
                   
                   <?php
                    
                        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                            
                            
                            $username       = strip_tags($_POST['username']);
                            $password       = strip_tags($_POST['password']);
                            
                            
                            $username       = $fm->validation($username);
                            $password       = $fm->validation($password);
                            
                            
                            $username       = mysqli_real_escape_string($db->link, $username);
                            $password       = mysqli_real_escape_string($db->link, $password);
                            
                            
                            
                            
                             if(empty($username) || empty($password)){
                                 
                                 echo "<div class='alert alert-danger'>
                               <span class='glyphicon glyphicon-info-sign'></span> &nbsp; User name or password must not be empty</a>
                              </div>";
                                 
                                }


                            else{
                                
                                $password = md5($password);
                                
                                $query = "SELECT * FROM admin_user WHERE username ='$username' AND password = '$password'";
                                $result = $db->select($query);

                               if($result != false){
                                    $value = $result->fetch_assoc();
                                   if ($value['role'] == '1') {
                                       echo "<div class='alert alert-danger'>
                                       <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Admin User Not Activated !</a>
                                      </div>";
                                        
                                    }else{
                                        Session::set("Adminlogin", true);
                                        Session::set("id", $value['id']);
                                        Session::set("username", $value['username']);
                                        Session::set("name", $value['name']);
                                        Session::set("email", $value['email']);
                                        header("Location: index.php");
                                   }
                                }else{
                                   echo "<div class='alert alert-danger'>
                                       <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Access Details !</a>
                                      </div>";
                                   
                                }


                            }
                            
                            
                        }
                    
                    ?>
                   
                    <form action="" method="post" class="" style="margin-top:100px;">       
                      <h2 class="text-center" style="color:#fff;">
                      <i class="fa fa-fw fa-desktop"></i> <?php echo strtoupper($site_title);?><br> <br>
                      <span style="font-size:20px;"><i class="fa fa-fw fa-power-off"></i> ADMINISTRATOR LOGIN</span></h2>
                      <br>
                      <div class="form-group">
                          <label for="username" style="color:#fff;font-size:20px;">Username</label>
                          <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
                      </div>
                      
                      <div class="form-group">
                          <label for="password" style="color:#fff;font-size:20px;">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                      </div>
                      
                      <div class="form-group">
                          
                          
                          <button type="submit" name="Adminlogin" style="border-radius:0;text-transform:uppercase;font-size:18px;background-image: linear-gradient(to bottom, #250646, #1e0839, #19072c, #14031f, #090012);border-color:#222;" class="btn btn-md btn-primary btn-block"><i class="fa fa-key"></i> LOGIN</button>
                          <br>
                          <hr style="height:1px; border:none; color:#4b4b4b; background-color:#4b4b4b;text-align:center;">
                          <p class="text-center text-muted">© <?php echo strtoupper($site_title);?></p>
                      </div>

                    </form>
                </div>
            </div>
        </div>
    
        

<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/sb-admin.min.js"></script>
        

    
       
</body>

</html>
