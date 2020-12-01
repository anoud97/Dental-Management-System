<?php
include("inc/connection.php");
include("inc/functions.php");


if(isset($_GET['loginBtn'])){
    $user_name = $_GET['user_name'];
    $password = $_GET['password'];

    if(login($user_name,$password,"admin")){
        header("location:admin_pages/admin_panel.php");
    }
    else if(login($user_name,$password,"doctor")){
        header("location:doctor_pages/doctor_page.php");
    }
    else if(login($user_name,$password,"patient")){
        header("location:patient_pages/patient_page.php");
    }
    else if(login($user_name,$password,"student")){
        header("location:student_pages/student_page.php");
    }
    else if(login($user_name,$password,"manager")){
        header("location:manager_pages/manager_page.php");
    }
    else if(login($user_name,$password,"receptionist")){
        header("location:receptionist_pages/receptionist_page.php");
    }
    else{
       echo "<h2 style='text-align:center; color:red;'>There is no user with this information</h2>";
    }
}

?>

<script>

    function clear_login_form(){
        document.getElementById('user_name').value = '';
        document.getElementById('password').value = '';
    }

</script>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dental Managment System</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts/fontawesome-all.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.css">
    <link rel="stylesheet" href="css/fonts/fontawesome5-overrides.css">
    <link rel="stylesheet" href="css/Login-Form-Clean.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index_style.css">
</head>

<body onload="clear_login_form(); setInterval(showTime , 500);  showDateInfo();">

    <section class="header_section"><br>
        <p class="text-center" style="width: 250px;color: rgb(240,250,249);margin-right: auto;margin-left: auto; font-size:18px;"><strong>Dental Managment System</strong><br></p>
    </section>

    <section class="current_time_date_bar">
        <span style="font-size: 13px;font-family: Abel, sans-serif;color: rgb(47,126,121); float:right;"><span id="currentTime">11:30 AM </span>&nbsp; Today &nbsp;is &nbsp;<span id="day_name">Wednesday</span>&nbsp;, <span id="date_info">November 13th, 2019</span> &nbsp;</span>
        <div style="clear:both;"></div>
    </section>

    <div class="login-clean" style="margin-top: 0px;">
        <form method="get" action="login.php" style="width: 325px;padding: 35px;padding-top: 2px;height: 500px;">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration">
                <img src="images/logo.png" style="width: 135px;height: 120px;">
                <p style="font-size: 15px;color: rgb(77,73,74);font-family: 'Pathway Gothic One', sans-serif;">PATIENT RECORD SYSTEM</p>
            </div>
            <div class="form-group">
                <input id = "user_name" name="user_name" class="form-control" placeholder="username" style="padding-left: 0px;" type="text" require>
            </div>
            <div class="form-group">        
                <input id = "password" name="password" class="form-control" name="password" placeholder="Password" style="padding-right: 20px;padding-left: 0px;font-size: 14px;" type="password" require>
            </div>
            <div class="form-group text-center">
                <button name="loginBtn" class="btn btn-primary" type="submit" style="background-color: rgb(77,198,190);;width: 70px;height: 35px;padding: 0px; margin-right:5px;">Login</button>
                <a href="index.php">
                    <button class="btn btn-primary" type="button" style="background-color: rgb(77,198,190);;width: 70px;height: 35px;padding: 0px;">cancel</button>
                </a>
            </div>
            <a class="forgot" href="#">Forgot your email or password?</a></form>
    </div>

    <section class="website_footer">
        <div style="height: 10px;background-color: #d8f9f7;"></div>
        <div style="height: 10px;background-color: #96eee8;"></div>
        <div class="website_footer_main">
            <p class="text-center footer_time_date">Today is <span id="day_name2">Wednesday</span>,<span id="month_name">November</span>&nbsp;<br><span id="year_name">2019 - 2020 </span> DMS v1<br></p>
            <div style="clear:both;"></div>
        </div>
    </section>

    <script src="js/javascript.js"></script> 
    <script src="js/jquery-1.9.1.min.js"></script>   
    <script src="js/jquery-3.js"></script>
    <script src="js/bootstrap.js"></script>

</body></html>