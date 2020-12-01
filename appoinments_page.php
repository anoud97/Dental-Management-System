

<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }
?>

<script>

    //Create a boolean variable to check for a valid Internet Explorer instance.
    var xmlhttp;
    if(window.ActiveXObject){
        xmlhttp = new ActiveXObject("Micosoft.XMLHTTP");
    }else{
        xmlhttp = new XMLHttpRequest();
    }


    function show_patient_info(pid) {
        var obj = document.getElementById('patient_info');
        xmlhttp.open("GET", 'service.php?get_patient_info=true&PID=' + pid);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;

                show_patient_appoinments(pid);
             }
        }
        xmlhttp.send(null);
      
    }

    function show_patient_appoinments(pid) {
        var obj = document.getElementById('appoinments_table');
        xmlhttp.open("GET", 'service.php?get_patient_appoinments=true&PID=' + pid);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;
             }
        }
        xmlhttp.send(null);
      
    }


    function cancel_appoinment(ID , PID) {
        xmlhttp.open("GET", 'service.php?cancel_appoinment=true&appoinment_id=' + ID);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                show_patient_appoinments(PID);
             }
        }
        xmlhttp.send(null);
      
    }

    function cancel_all_appoinment(PID) {
        xmlhttp.open("GET", 'service.php?cancel_all_appoinment=true&patient_id=' + PID);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                show_patient_appoinments(PID);
             }
        }
        xmlhttp.send(null);
      
    }

</script>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>appoinments page(صفحه المواعيد)</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="../css/appoinments_page_style.css">
    <link rel="stylesheet" href="../css/messages_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="show_patient_info(<?php echo $_COOKIE['user_id'];  ?>); setInterval(showTime , 500);  showDateInfo();" >
    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;"><img style="width: 50px;height: 50px;" src="../images/user_white.gif">
            <p style="margin-bottom: 0px;color: rgb(244,247,251);"><strong><?php  echo $_COOKIE['user_name']; ?></p>
            <a href="../logout.php">
                <p style="margin-bottom: 0px;font-size: 14px;color: rgb(236,238,241);background-color: #2e675a;text-decoration: none;display: block;width: 90px;margin-right: auto;margin-left: auto;border-radius: 15px;">logout(تسجيل الخروج)</p>
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
                        <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_page.php" ><img class="menue_list_icon" src="../images/home.png">Patient Page(صفحه المريض)</a></li>   
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="my_profile.php" ><img class="menue_list_icon" src="../images/appoinment.png">my profile(ملفي الشخصي)</a></li>                        
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="appoinments_page.php" ><img class="menue_list_icon" src="../images/appoinment.png">appoinments(المواعيد)</a></li>                     
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <div class="content" style="background-color: rgb(252,251,251);">
               <span> Information(المعلومات) </span>
                <div id="patient_info" class="patient_Information_Div">
                    <div class="row" style="width: 97%;margin-left: auto;margin-right: auto;">
                        <div class="col-sm-12 col-lg-4">
                            <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;padding-left: 0px;">patient ID(رقم هوية المريض) : </p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">gender(الجنس) : </p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">phone(رقم الجوال) : </p>
                        </div>
                    </div>
                    <div class="row" style="width: 97%;margin-left: auto;margin-right: auto;">
                        <div class="col-sm-12 col-lg-4">
                            <p style="width: 100%;padding: 2px;margin: 14px;margin-left: 0px;font-size: 16px;">patient Name(اسم المريض): </p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">age(العمر): </p>
                        </div>
                    </div>
                </div>
                <p style="width: 95%;margin-right: auto;margin-left: auto;margin-bottom: 0px;margin-top: 15px;padding: 5px;padding-left: 1px;font-weight: bold;font-size: 18px;">Your appoinments(موعدك):</p>
                <div class="table-responsive appoinmentTable">
                    <table class="table table-hover">
                        <thead style="background-color: #e0e0dc;">
                            <tr>
                                <th>Student ID(رقم هوية الطالب)</th>
                                <th>Date(التاريخ)</th>
                                <th>Level(المستوى)</th>
                                <th>Time(الوقت)</th>
                                <th>delete(حذف)</th>
                            </tr>
                        </thead >
                        <tbody id="appoinments_table">
                        <!--
                            the appoinments table will be returned
                            by ajax function called get_pationt_appoinment
                        -->
                        </tbody>
                    </table>
                </div>
                <div class="add_appoinment_Div">
                <button class="btn btn-primary cancel_appoinment_button" type="button" style="background-color: rgb(77,76,69);padding: 8px;" onClick="if(confirm('Sure want to cancel all appoinments?!!')==true) cancel_all_appoinment(<?php  echo $_COOKIE['user_id'];  ?>);">cancel(إلغاء)</button>
                    <div style="clear:both;"></div>
                </div>
                <div style="height: 52px;"></div>
            </div>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>