<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>
<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>control panel</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/fontawesome-all.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/fonts/fontawesome5-overrides.css">
    <link rel="stylesheet" href="../css/all_patients_style.css">
    <link rel="stylesheet" href="../css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="../css/appoinments_page_style.css">
    <link rel="stylesheet" href="../css/available_times_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../css/patient_file_style.css">
    <link rel="stylesheet" href="../css/alert_message_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onLoad="setInterval(showTime , 500); , showDateInfo();">
    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;"><img style="width: 50px;height: 50px;" src="../images/user_white.gif">
            <p style="margin-bottom: 0px;color: rgb(244,247,251);"><strong><?php  echo $_COOKIE['user_name']; ?></strong></p>
            <a href="../logout.php">
                <p style="margin-bottom: 0px;font-size: 14px;color: rgb(236,238,241);background-color: #2e675a;text-decoration: none;display: block;width: 90px;margin-right: auto;margin-left: auto;border-radius: 15px;">logout</p>
            </a>
        </div>
    </section>
    <section class="current_time_date_bar">
        <span style="font-size: 13px;font-family: Abel, sans-serif;color: rgb(47,126,121); float:right;"><span id="currentTime">11:30 AM </span>&nbsp; Today &nbsp;is &nbsp;<span id="day_name">Wednesday</span>&nbsp;, <span id="date_info">November 13th, 2019</span> &nbsp;</span>
        <div style="clear:both;"></div>
    </section>
    <div class="row flex-grow-1">
        <div class="col-md-3 col-lg-3 left_columen">
            <nav class="navbar navbar-light navbar-expand-md left_navbar">
                <div class="container-fluid"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav d-block left_nav">
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="admins_managment.php">admins managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="doctors_managment.php" >doctors managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="students_managment.php" >students managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manager_data_managment.php" >manager managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="receptionist_data_managment.php" >receptionist managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manage_website_data.php" >website data managment</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
        <section class="main_content_section">
                <p class="text-center website_word_header">Wellcome to Control Panel</p>
                <div style="width: 35%;height: 2px;margin-right: auto;margin-left: auto;background-color: #6cebe3;"></div>
                <p class="text-center website_word">from this page you can :<br>  manage website admins  -  manage Doctors data  - manage Student data <br> and another jobs</p>
                
                <ul class="shortcut_list">
                    <center>
                        <div style="text-align:center; width:64%;">
                        <center>
                            <li class="shortcut_list_item" ><div><a class="" href="admins_managment.php"><br>admins<br>managment</a></div></li>
                            <li class="shortcut_list_item" ><div><a class="" href="doctors_managment.php" ><br>doctors<br>managment</a></li>
                            <li class="shortcut_list_item" ><div><a class="" href="students_managment.php" ><br>students<br>managment</a></li>
                            <li class="shortcut_list_item" ><div><a class="" href="manager_data_managment.php" ><br>manager<br>managment</a></li>
                            <li class="shortcut_list_item" ><div><a class="" href="receptionist_data_managment.php" ><br>receptionist<br>managment</a></li>
                            <li class="shortcut_list_item" ><div><a class="" href="manage_website_data.php" ><br>website data<br>managment</a></li>
                            <div style="clear:both;"></div>
                        </center>
                        </div>
                    </center>
                </ul>
                
            </section>
        </div>
    </div>
    <script src="../js/javascript.js"></script> 
    
    <script src="../js/bootstrap.js"></script>


</body></html>