<?php
include("inc/connection.php");
?>

<!--  get website data  -->
<?php
    $q = "select * from website_data where id = 1";
    $res = mysqli_query($conn , $q);
    $website_data = mysqli_fetch_array($res);
?>

<script>

    //Create a boolean variable to check for a valid Internet Explorer instance.
    var xmlhttp;
    if(window.ActiveXObject){
        xmlhttp = new ActiveXObject("Micosoft.XMLHTTP");
    }else{
        xmlhttp = new XMLHttpRequest();
    }


    function delete_past_requests(){
    
        xmlhttp.open("GET",'service.php?delete_past_requests=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
 
            }
        }
        xmlhttp.send(null);
    }

</script>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dental Managment System</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.css">
    <link rel="stylesheet" href="css/index_style.css">
</head>

<body onLoad="setInterval(showTime , 1000);  showDateInfo();">

    <section class="header_section">
    <img class="d-flex d-sm-flex d-md-flex justify-content-center justify-content-sm-center website_logo" src="images/logo_white.gif">
        <p class="text-center" style="width: 250px;color: rgb(240,250,249);margin-right: auto;margin-left: auto;"><strong>Dental Managment System</strong><br></p>
    </section>

    <section class="current_time_date_bar">
        <span style="font-size: 13px;font-family: Abel, sans-serif;color: rgb(47,126,121); float:right;"><span id="currentTime">11:30 AM </span>&nbsp; Today &nbsp;is &nbsp;<span id="day_name">Wednesday</span>&nbsp;, <span id="date_info">November 13th, 2019</span> &nbsp;</span>
        <div style="clear:both;"></div>
    </section>

    <section class="main_content_section">
        <p class="text-center website_word_header">Dental Managment System</p>
        <div style="width: 35%;height: 2px;margin-right: auto;margin-left: auto;background-color: #6cebe3;"></div>
        <p class="text-center website_word">DMS<br>Welcome to DMS.Where services to patients of all ages. <br>Our entire team is here to provide free dentistry <br> To each and every patient in a safe, warm, and friendlly<br>environment.Every patient is welcomed into our family.</p>
        <div class="text-center"><a href="login.php" ><button id="save_button" class="btn btn-primary btn-lg login_button" type="button">Login to start</button></a></div>
        <div class="text-center" >or</a></div>
        <div class="register_patient_btn text-center" ><a id="register_patient" class="btn btn-primary btn-lg login_button" href="patient_register.php" style="font-size:14px; width:140px;">Voluntary patient<br>(متطوع)</a></div>
    </section>

    <div class="contacts_section">
        <div style="width: 250px;"><i class="fa fa-phone" style="padding: 7px;font-size: 22px;color: rgb(11,143,133);"></i><span style="font-size: 14px;color: rgb(38,154,144);font-family: Abel, sans-serif;">&nbsp;<?php echo $website_data['phone']; ?></span></div>
        <div style="width: 250px;"><i class="fa fa-map-marker" style="padding: 7px;font-size: 22px;color: rgb(11,143,133);"></i><span style="font-size: 14px;color: rgb(58,154,144);font-family: Abel, sans-serif;">&nbsp;<?php echo $website_data['location']; ?></span></div>
    </div>


    <section class="website_footer">
        <div style="height: 10px;background-color: #d8f9f7;"></div>
        <div style="height: 10px;background-color: #96eee8;"></div>
        <div class="website_footer_main">
            <p class="text-center footer_time_date">All rights reserved © &nbsp;<br><span id="year_name">2020 - 2021 </span> DMS v1<br></p>
            <div style="clear:both;"></div>
        </div>
    </section>




    <script src="js/javascript.js"></script> 
    <script src="js/jquery-1.9.1.min.js"></script>   
    <script src="js/jquery-3.js"></script>
    <script src="js/bootstrap.js"></script>


</body></html>