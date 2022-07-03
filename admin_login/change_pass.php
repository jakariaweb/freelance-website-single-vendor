<?php include 'inc/header.php';?> 
        <div id="layoutSidenav">
<?php include 'inc/sidebar.php';?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                               
                                <div class="card py-1">
                                <div class="card-header bg-info text-white">
                                    <h4>Change Password</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                
                          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePass'])){
                                    
                                  $admin_mail = Session::get('email');
                              
                                  $old_password         = strip_tags($_POST['old_password']);
                                  $password             = strip_tags($_POST['password']);
                               


                                  $old_password         = $fm->validation($old_password);
                                  $password             = $fm->validation($password);
                                  


                                  $old_password         = mysqli_real_escape_string($db->link, $old_password);
                                  $password             = mysqli_real_escape_string($db->link, $password);
                           
                              
                                    if(empty($old_password) || empty($password)){
                                    echo "<div class='alert alert-danger'>
                                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Filed must not be empty.</a>
                                    </div>";
                                    }

                                else{

                                $password = md5($password);
                                $old_password = md5($old_password);

                                $oldpass = "SELECT password FROM admin_user WHERE email='$admin_mail' AND password ='$old_password'";
                                $finalcheck = $db->select($oldpass);
                                if ($finalcheck != true) {
                                echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Incorrect Current Password </a>
                                </div>";
                                }else{


                                $addnewpass = "UPDATE admin_user
                                        SET
                                        password = '$password'
                                        WHERE email = '$admin_mail'";
                                $updated_rows = $db->update($addnewpass);
                                if ($updated_rows) {
                                 echo "<div class='alert alert-success'>
                                    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password Changed Successfully You will be redirect Login page.</a>
                                    </div>";
                                    echo "<script>alert('Password Changed Successfully You are now Redirected to Login Page');</script>";
                                    session_destroy();

                                    echo "<script>window.open('login.php','_self')</script>";
                                }else {
                                 echo "<span class='error'>Password Not Changed!</span>";
                                    }
                                  }
                                }


                            }
                            ?>
                                   <div class="row">
                                        <div class="col-md-9">

                                        <form action="" method="post" class="form-signin">

                                        <div class="form-group">
                                          <label>Current Password</label>
                                         <input type="password" class="form-control" name="old_password" placeholder="Current Password" data-validation="required">
                                        </div>                       
                                        <div class="form-group">
                                            <!-- form-group Starts -->
                                            <label>New Password</label>
                                            <input type="password" name="password" data-validation="length" data-validation-length="min6" placeholder="Password" id="password" class="form-control">

                                        </div>

                                        <div class="form-group">
                                            <!-- form-group Starts -->
                                            <label>Confirm Password</label>
                                            <input type="password" placeholder="Confirm Password" id="confirm_password" class="form-control" data-validation="required">

                                        </div>
                                        <hr />
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger" name="changePass">
                                            <span class="glyphicon glyphicon-lock"></span> &nbsp; Change Password
                                            </button> 
                                        </div>
                                        
                                           
                                            
                                        </form>

                                            
                                        </div>

                                        
                                    </div>
                                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php include 'inc/footer.php';?> 