
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

                    show_patient_levels(pid);
                    document.getElementById('available_times').innerHTML = "";
             }
        }
        xmlhttp.send(null);
      
    }


    function show_patient_levels(pid) {
        
        var obj = document.getElementById('level_id');
        xmlhttp.open("GET", 'service.php?get_patient_levels=true&PID=' + pid);
        xmlhttp.onreadystatechange = function() {
           
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               
                obj.innerHTML = xmlhttp.responseText;
                
            }
        }
        xmlhttp.send(null);

        }


    function show_available_times(level) {

        var obj = document.getElementById('available_times');
        xmlhttp.open("GET", 'service.php?get_available_times=true&level=' + level);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;
                
            }
        }
        xmlhttp.send(null);

    }

    function add_appoinment(patient_id, available_time_id) {
        var obj = document.getElementById('available_times');
        xmlhttp.open("GET", 'service.php?add_appoinment=true&patient_id=' + patient_id + '&available_time_id=' + available_time_id + '');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                alert("ok adedd successfully");
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
    <title>appoinment scheduling</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="../css/messages_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="setInterval(showTime , 500);  showDateInfo();">
        <section class="header_section">
            <div style="margin: 13px;width: 150px;text-align:center;"><img style="width: 50px;height: 50px;" src="../images/user_white.gif">
                <p style="margin-bottom: 0px;color: rgb(244,247,251);"><strong><?php  echo $_COOKIE['user_name']; ?></p>
                <a href="..\index.php">
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
                                <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="receptionist_page.php" ><img class="menue_list_icon" src="../images/home.png">Receptionist Page</a></li>     
                                <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patients_page.php"><img class="menue_list_icon" src="../images/patients.png">patients</a></li> 
                                <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patients_page.php"><img class="menue_list_icon" src="../images/patients.png">registeration requests</a></li>   
                                <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="appoinment_schedule.php"><img class="menue_list_icon" src="../images/appoinment.png">appoinment</a></li>    
                                <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="contact_page.php"><img class="menue_list_icon" src="../images/chat.png">chat</a></li>
                                <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php"><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>                        
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9 content_column">
                <div class="content" style="background-color: rgb(252,251,251);">
                    <div class="text-left searchArea"><label style="margin-left: 5px;">Patient ID&nbsp;</label><input id="patient_id_text" placeholder="" style="width: 15%;margin-top: 0px;" type="text" value="">
                    <button class="btn btn-primary text-left" type="button" style="margin-left: 22px;height: 31px;font-size: 14px;padding-top: 0px;padding-right: auto;padding-bottom: 0px;padding-left: auto;background-color: rgb(91,91,92);margin-right: 5px;margin-top: 1px;"onClick="if(document.getElementById('patient_id_text').value=='') alert('enter patient no'); else show_patient_info(document.getElementById('patient_id_text').value);">show info</button>
                        <label style="margin-left: 11px;">Level</label>
                            <select id="level_id" style="margin-left: 5px;width: 15%;font-size: 16px;padding: 1px;">
                            <option value="0" selected="selected">level</option>
                                <!--


                                -->
                            </select>

                            <button class="btn btn-primary text-left" type="button" style="margin-left: 22px;height: 31px;font-size: 14px;padding-top: 0px;padding-right: auto;padding-bottom: 0px;padding-left: auto;background-color: rgb(91,91,92); float: right; margin-right: 5px;margin-top: 1px;"onClick="show_available_times(document.getElementById('level_id').value);">show times</button>

                        <div style="clear:both;"></div>
                        </div>
                        <div id="patient_info" class="patient_Information_Div">
                            <div class="row" style="width: 97%;margin-left: auto;margin-right: auto;">
                                <div class="col-sm-12 col-lg-4">
                                    <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;padding-left: 0px;">patient ID : </p>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">gender : </p>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">phone : </p>
                                </div>
                            </div>
                            <div class="row" style="width: 97%;margin-left: auto;margin-right: auto;">
                                <div class="col-sm-12 col-lg-4">
                                    <p style="width: 100%;padding: 2px;margin: 14px;margin-left: 0px;font-size: 16px;">patient Name: </p>
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                    <p style="width: 100%;padding: 11px;margin: 14px;margin-left: 0px;font-size: 16px;">age: </p>
                                </div>
                            </div>
                        </div>
                        <p style="width: 95%;margin-right: auto;margin-left: auto;margin-bottom: 0px;margin-top: 0px;padding: 5px;padding-left: 1px;font-weight: bold;font-size: 16px;">available students times</p>
                        <div class="table-responsive appoinmentTable">
                            <table class="table table-hover">
                                <thead style="background-color: #d6d6d2;">
                                    <tr>
                                        <th style="width: 164px;">Patient ID</th>
                                        <th>Student ID</th>
                                        <th>Student name</th>
                                        <th>Date</th>
                                        <th>Level</th>
                                        <th>Time</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                                <tbody id="available_times">
                                    <!--
                                        the table of available times will be returned from 
                                        ajax function called get_available_times
                                    -->
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="add_appoinment_Div">
                            <input type="hidden" id="availavle_time_id_text" value="" style="width:30px; float:right;">
                            <button id="add_appoinment_btn" class="btn btn-primary add_appoinment_button" type="button" onClick="if(document.getElementById('availavle_time_id_text').value != '') add_appoinment(document.getElementById('patient_id_text').value , document.getElementById('availavle_time_id_text').value); else alert('you dont select any available time !!');">Add</button>
                            <div style="clear:both;"></div>
                        </div>
                        <div style="height: 52px;"></div>
                        </div>
                    </div>
                </div>


        <script src="../js/javascript.js"></script>
        
        <script src="../js/bootstrap.js"></script>
</body></html>