<?php
include("../inc/connection.php");
include("../inc/functions.php");

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


    function get_patients_name(){
        var obj = document.getElementById('patient_list');
        xmlhttp.open('GET','service.php?get_patients_name=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                obj.innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }


    function get_selected_patient_info(PID){
        var obj = document.getElementById('selected_patient_info');
        xmlhttp.open('GET','service.php?get_selected_patient_info=true&PID='+PID+'');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                obj.innerHTML = xmlhttp.responseText;
                get_patient_chart(PID);
            }
        }
        xmlhttp.send(null);
    }

    function get_patient_chart(PID){
        var obj = document.getElementById('selected_patient_chart');
        xmlhttp.open('GET','service.php?get_selected_patient_chart=true&PID='+PID+'');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                obj.innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }


    function add_patient_chart(PID , SID , tooth_no , level){
        var d = new Date();
        var currentDate = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate()+"";
        xmlhttp.open('GET',"service.php?add_patient_chart=true&PID="+PID+"&SID="+SID+"&tooth_no="+tooth_no+"&level="+level+"&date='"+currentDate+"'");
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                get_patient_chart(PID);
                alert("added sccessfly");
            }
        }
        xmlhttp.send(null);
    }

    function accept_reject_student_work(PID , ID) {
        
        if(document.getElementById('accept_btn_('+ID+')').innerHTML =='accept'){
            xmlhttp.open("GET", 'service.php?accept_student_work=true&chart_id=' + ID);
        }else{
            xmlhttp.open("GET", 'service.php?reject_student_work=true&chart_id=' + ID);
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                get_patient_chart(PID);
             }
        }
        xmlhttp.send(null);
    }


</script>

<!DOCTYPE html>
<html style="margin-right: auto;margin-left: auto;"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>patient file</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/fontawesome-all.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/fonts/fontawesome5-overrides.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/patient_file_style.css">
    <link rel="stylesheet" href="../css/modal_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="get_patients_name();  setInterval(showTime , 500);  showDateInfo();">
    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;"><img style="width: 50px;height: 50px;" src="../images/user_white.gif">
            <p style="margin-bottom: 0px;color: rgb(244,247,251);"><strong><?php  echo $_COOKIE['user_name']; ?></p>
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
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="doctor_page.php"><img class="menue_list_icon" src="../images/home.png">Doctor Page</a></li> 
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php"><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>         
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="contact_page.php"><img class="menue_list_icon" src="../images/chat.png">chat</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <section class="text-center search_patient_area">
                <div>
                    <i class="fa fa-search" style="font-size: 28px;color: rgb(67,159,153);"></i>
                    <span style="margin-left: 10px;font-size: 16px;color: rgb(104,104,105);">Please select the Patient:&nbsp;</span>
                    <select id="patient_name" class="patient_list">
                        <optgroup id="patient_list" label="Patient name" selected>

                            <!--
                                the list of patients name 
                                will be returned from ajax function called get_patient_names
                            -->
                        </optgroup>
                    </select>
                    <button class="btn btn-primary view_patient_info" type="button" onClick="get_selected_patient_info(document.getElementById('patient_name').value);">view</button>
                </div>
            </section>
            <div id="selected_patient_info" class="row patient_info_row">
                <div class="col-md-3 col-lg-2 patient_img_col">
                    <div class="text-center"><img id="patient_image" class="patient_img" src="../images/user_black.gif"></div>
                </div>
                <div class="col-md-9 col-lg-10">
                    <p class="patient_name"><strong>Patient Name</strong></p>
                    <div><i class="fa fa-id-card" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>Patient Id &nbsp; :</strong></span></div>
                    <div><i class="fas fa-transgender" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>Gender &nbsp; &nbsp; &nbsp; &nbsp;:</strong></span></div>
                    <div><i class="fas fa-map-marker-alt" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>Address &nbsp; &nbsp; &nbsp; :</strong></span></div>
                    <div><i class="fa fa-calendar" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>Age &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</strong></span></div>
                    <div><i class="fa fa-phone" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>Phone No &nbsp; :</strong></span></div>
                    <div><i class="fa fa-phone" style="color: rgb(67,159,153);padding: 5px;"></i><span style="font-size: 15px;color: rgb(97,97,98);"><strong>problem desc&nbsp; :</strong></span></div>
                    <!--
                        the selected patient info will be returned 
                        by ajax function called get_selected_patient_info
                    -->
                </div>
            </div>
            <section class="new_teeth_case_area">
                <div style="text-align: center;padding: 8px;">
                    <i class="fas fa-tooth" style="color: rgb(67,159,153);padding: 5px;"></i>
                    <span><strong>tooth no &nbsp;:</strong></span>
                    <input id="tooth_no" style="border: 1px solid #ccc;width: 45px;margin: 0px;margin-left: 6px;padding-left: 5px; text-align:center; font-weight:bold; background-color:#FFE79B;" type="text">
                    <i class="fas fa-microscope" style="color: rgb(67,159,153);padding: 5px;margin-left: 17px;"></i>
                    <span><strong>Case level &nbsp;:</strong></span>
                    <input id="case_level" style="border: 1px solid #ccc;width: 70px;margin: 0px;margin-left: 6px;padding-left: 10px; text-align:center; font-weight:bold;" type="text">
                    
                    <button class="btn btn-primary" type="button" style="padding: 1px;font-size: 15px;width: 61px;height: 29px;margin-top: -6px;margin-left: 10px;background-color: rgb(67,159,153);"onClick="add_patient_chart( document.getElementById('patient_name').value, <?php echo $_COOKIE['user_id'] ?> , document.getElementById('tooth_no').value , document.getElementById('case_level').value); document.getElementById('tooth_no').value=''; document.getElementById('case_level').value = '';">save</button>
                </div>
            </section>
            <section class="patient_chart_section"><span style="padding-left: 14px;font-weight: bold;font-size: 17px;color: rgb(97,97,98);">Pactient Chart</span>
                <div class="row up_teeth_row">
                    <div class="col up_row_left_col text-right">
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 18;"><img class="tooth_img" src="../images/tooth_images/18.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 17;"><img class="tooth_img" src="../images\tooth_images/17.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 16;"><img class="tooth_img" src="../images/tooth_images/16.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 15;"><img class="tooth_img" src="../images/tooth_images/15.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 14;"><img class="tooth_img" src="../images/tooth_images/14.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 13;"><img class="tooth_img" src="../images/tooth_images/13.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 12;"><img class="tooth_img" src="../images/tooth_images/12.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 11;"><img class="tooth_img" src="../images/tooth_images/11.gif"></button>
                    </div>
                    <div class="col up_row_right_col text-left">
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 21;"><img class="tooth_img" src="../images/tooth_images/21.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 22;"><img class="tooth_img" src="../images/tooth_images/22.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 23;"><img class="tooth_img" src="../images/tooth_images/23.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 24;"><img class="tooth_img" src="../images/tooth_images/24.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 25;"><img class="tooth_img" src="../images/tooth_images/25.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 26;"><img class="tooth_img" src="../images/tooth_images/26.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 27;"><img class="tooth_img" src="../images/tooth_images/27.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 28;"><img class="tooth_img" src="../images/tooth_images/28.gif"></button>
                    </div>
                </div>
                <div class="row bottom_teeth_row">
                    <div class="col bottom_row_left_col text-right">
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 48;"><img class="tooth_img" src="../images/tooth_images/48.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 47;"><img class="tooth_img" src="../images/tooth_images/47.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 46;"><img class="tooth_img" src="../images/tooth_images/46.png"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 45;"><img class="tooth_img" src="../images/tooth_images/45.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 44;"><img class="tooth_img" src="../images/tooth_images/44.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 43;"><img class="tooth_img" src="../images/tooth_images/43.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 42;"><img class="tooth_img" src="../images/tooth_images/42.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 41;"><img class="tooth_img" src="../images/tooth_images/41.gif"></button>
                    </div>
                    <div class="col bottom_row_right_col text-left">
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 31;"><img class="tooth_img" src="../images/tooth_images/31.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 32;"><img class="tooth_img" src="../images/tooth_images/32.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 33;"><img class="tooth_img" src="../images/tooth_images/33.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 34;"><img class="tooth_img" src="../images/tooth_images/34.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 35;"><img class="tooth_img" src="../images/tooth_images/35.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 36;"><img class="tooth_img" src="../images/tooth_images/36.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 37;"><img class="tooth_img" src="../images/tooth_images/37.gif"></button>
                        <button class="btn btn-primary tooth_button" type="button" onClick="document.getElementById('tooth_no').value = 38;"><img class="tooth_img" src="../images/tooth_images/38.png"></button>
                    </div>
                </div>
                <div class="table-responsive chart_table">
                    <table class="table">
                        <thead class="chart_table_header">
                            <tr>
                                <th style="padding: 10px 20px;">Date</th>
                                <th style="padding: 10px;">Teeth No</th>
                                <th style="padding: 10px;">Case Level</th>
                                <th style="padding: 10px;">Changes</th>
                                <th style="padding: 10px;">Notes</th>
                                <th class="text-center" style="padding: 10px;">Accepted?</th>
                                <th style="padding: 10px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="selected_patient_chart">

                            <!--
                                the patient chart will be returned
                                from ajax function called get_selected_patient_chart 
                            -->

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
     <!-- updating modal code -->
		 <!-- The Modal -->
			<div id="id01" class="modal">
			  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

                <!-- Modal Content -->
                <form name="update_chart_form" class="modal-content animate" method="get" action="patient_file.php">
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><input id="PID" name="PID" class="form-control form_input" type="hidden"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><input id="chart_id" name="chart_id" class="form-control form_input" type="hidden"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label  style="color: rgb(83,84,85);padding-right: 0px;">Date</label><input id="date_text" name="date_text" class="form-control form_input" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12"> 
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">Teeth no</label><input id="teeth_no" name="teeth_no" class="form-control form_input" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">Case Level</label><input id="level" name="level" class="form-control form_input" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">Changes</label><input id="changes" name="changes" class="form-control form_input" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">Notes</label><input id="notes" name="notes" class="form-control form_input" type="text"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                <br><br>
                                <button name="edit_savebtn" class="btn btn-primary" style="padding: 4px; width:80px;" type="button" onClick="update_chart(document.getElementById('PID').value , document.getElementById('chart_id').value , document.getElementById('date_text').value , document.getElementById('teeth_no').value , document.getElementById('level').value , document.getElementById('changes').value , document.getElementById('notes').value);">save</button>
                                <button name="edit_cancelbtn" class="btn btn-primary" style="padding: 4px; width:80px;" type="button" onclick="document.getElementById('id01').style.display='none';">cancel</button>
                            </div>
                        </div>
                    <div class="container" style="background-color:#f0f0f0">
        
				</div>
			  </form>
			</div>
		<!-- login form code -->

    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>