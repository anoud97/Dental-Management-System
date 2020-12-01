
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }
    
    if(isset($_GET['deleteStudent'])){
        delete_Student($_GET['student_id']);
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


    function get_students_table(){
    
        xmlhttp.open("GET",'service.php?get_students_table=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('students_table').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }

    function delete_confirm(student_id){
        if(confirm("Sure To Remove This Record ?")){
            window.location.href='students_managment.php?deleteStudent=true&student_id=' + student_id;
        }
    }

    function student_form_fill(student_id , firstName, lastName ,username,email,password,phone,level , is_excellent){
        document.getElementById('d').style.display='block';
        document.forms["student_data_form"]["student_id"].value = student_id;
        document.forms["student_data_form"]["student_firstName"].value = firstName;
        document.forms["student_data_form"]["student_firstName"].value = firstName;
        document.forms["student_data_form"]["student_lastName"].value = lastName;
        document.forms["student_data_form"]["student_username"].value = username;
        document.forms["student_data_form"]["student_email"].value = email;
        document.forms["student_data_form"]["student_password"].value = password;  
        document.forms["student_data_form"]["student_re_password"].value = password; 
        document.forms["student_data_form"]["student_phone"].value = phone;  
        document.forms["student_data_form"]["student_level"].value = level; 
        document.forms["student_data_form"]["is_excellent"].value = is_excellent; 
    }

    function student_form_clear(){
        document.forms["student_data_form"]["student_firstName"].value = '';
        document.forms["student_data_form"]["student_lastName"].value = '';
        document.forms["student_data_form"]["student_username"].value = '';
        document.forms["student_data_form"]["student_email"].value = '';
        document.forms["student_data_form"]["student_password"].value = '';  
        document.forms["student_data_form"]["student_re_password"].value = ''; 
        document.forms["student_data_form"]["student_phone"].value = '';  
        document.forms["student_data_form"]["student_level"].value = ''; 
    }


    function add_student(firstName, lastName ,username, email, password, phone, level , is_excellent){
         xmlhttp.open('GET',"service.php?add_student=true&firstName="+firstName+"&lastName="+lastName+"&username="+username+"&email="+email+"&password="+password+"&phone="+phone+"&level="+level+"&is_excellent="+is_excellent+"");
         xmlhttp.onreadystatechange = function(){
             if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                 get_students_table();
                 alert("added sccessfly");
             }
         }
         xmlhttp.send(null);
 
     }
 
 
     function update_student(student_id , firstName, lastName ,username, email, password, phone, level , is_excellent){
         xmlhttp.open("GET", "service.php?update_student=true&student_id="+student_id+"&firstName=" + firstName+"&lastName="+lastName+"&username="+username+"&email="+email+"&password="+password+"&phone="+phone+"&level="+level+"&is_excellent="+is_excellent+"");
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                get_students_table();
                 alert('ok updated successfly');
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
    <title>students managment</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/alert_message_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="get_students_table(); setInterval(showTime , 500); showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="students_managment.php" >students managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manager_data_managment.php" >manager managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="receptionist_data_managment.php" >receptionist managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manage_website_data.php" >website data managment</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <section>
                <section class="visible account_data_form">
                    <form class="student_data_form" id="d" name="student_data_form" method="get" action="students_managment.php">
                        <div class="form-row account_form_row">
                            <input id ="student_id" name="student_id" class="form-control form_input" type="hidden" >
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">first name</label><input id ="student_firstName" name="student_firstName" class="form-control form_input" type="text" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">last name</label><input id ="student_lastName" name="student_lastName" class="form-control form_input" type="text" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">user name</label><input id ="student_username" name="student_username" class="form-control form_input" type="text" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">E-mail</label><input id ="student_email" name="student_email" class="form-control form_input" type="email" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="padding-left: 0px;margin-bottom: 0px;padding-right: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">password</label><input id ="student_password" name="student_password" class="form-control form_input" type="password" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password</label><input id ="student_re_password" name="student_re_password" class="form-control form_input" type="password" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">phone number</label><input id ="student_phone" name="student_phone" class="form-control form_input" type="number" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">student level</label><input id ="student_level" name="student_level" class="form-control form_input" type="number" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">is excellent student ?</label>
                                    <select id="is_excellent" class="form-control">
                                        <option value="0" selected="selected">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><br>  
                                    <button id = "update_btn" name="student_updatebtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button" onClick="update_student(document.getElementById('student_id').value , document.getElementById('student_firstName').value , document.getElementById('student_lastName').value, document.getElementById('student_username').value , document.getElementById('student_email').value , document.getElementById('student_password').value , document.getElementById('student_phone').value , document.getElementById('student_level').value , document.getElementById('is_excellent').value); document.getElementById('d').style.display='none';">save</button>
                                    <button id = "add_btn" name="student_addbtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button"       onClick="add_student(document.getElementById('student_firstName').value , document.getElementById('student_lastName').value, document.getElementById('student_username').value , document.getElementById('student_email').value , document.getElementById('student_password').value , document.getElementById('student_phone').value , document.getElementById('student_level').value , document.getElementById('is_excellent').value); document.getElementById('d').style.display='none';">add</button>
                                    <div name="student_cancelbtn" class="btn btn-primary" onClick="document.getElementById('d').style.display='none';" style="padding: 4px; width:100px; cursor:pointer;">cancel</div>
                                </div>
                            </div>
                        </div> 
                    </form>
                </section>
                <section class="text-left add_new_section"><button name="student_addbtn" class="btn btn-primary add_button" type="button" onClick="student_form_clear(); document.getElementById('d').style.display='block'; document.getElementById('update_btn').style.display='none'; document.getElementById('add_btn').style.display='inline';"><strong>+ </strong>&nbsp; Add New</button></section>
                <div class="table-responsive account_table">
                    <table class="table table-hover">
                        <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>student no</th>
                                <th>student name</th>
                                <th>student level</th>
                                <th>phone number</th>
                                <th>e-mail</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody id="students_table">
                            <!--

                                student table will be returned by 
                                ajax function called get_students_table
                            -->

                        </tbody>
                    </table>
                </div>
                <section style="height: 46px;"></section>
            </section>
        </div>
    </div>
    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>