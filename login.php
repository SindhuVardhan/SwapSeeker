<?php


// Output response time


include "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Empty Header Start -->
    <div class="empty-header" style="height: 170px; display: flex; justify-content: center; align-items: center;">
        <img id="image" src="img/logoss.png" style="height: 100px; width: 350px;">
    </div>

    
    <!-- Empty Header End -->
   

    
    <!-- Contact Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-4 mb-5">
            </div>
            <div class="col-lg-4 mb-5" style="height:425px;">
                <h2 class="position-relative text-uppercase mx-xl-5 mb-4" style="text-align: center;"><span class="pr-3">Login</span></h2>
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="login" id="login" method="post">
                        <input type="hidden" name="action" value="login" />
                        <div class="control-group">
                            <input type="email" class="form-control" name="username" id="username" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password"
                                required="required" data-validation-required-message="Please enter password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div style="text-align: center;">
                            <button class="btn btn-primary py-2 px-4" type="button" id="bt_login">Login</button>                            
                        </div>
                        <a style="color:#3D464D;text-align: center;width: 100%;display: block;margin-top: 30px;" href="register.php">Don't have an account? Create New Account.</a>

                    </form>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <?php
    
include "includes/footer.php";
?>



