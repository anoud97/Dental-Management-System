
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>
<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_GET['deleteDoctor'])){
        delete_Doctor($_GET['doctor_id']);
    }  


    if(isset($_POST['doctor_addbtn'])){
        $image = $_FILES['doctor_image_file']['name'];
        $image_tmp = $_FILES['doctor_image_file']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/doctors/".$image."");
        $q = "insert into doctor (first_name , last_name , phone , e_mail , username ,password , image , is_connected) values ('".$_POST['doctor_firstName']."','".$_POST['doctor_lastName']."','".$_POST['doctor_phone']."','".$_POST['doctor_email']."' , '".$_POST['doctor_username']."' , '".$_POST['doctor_password']."' , '".$image."' , 0)";
        $result = mysqli_query($conn , $q) or die("error in inserting process "); 
    } 

    if(isset($_POST['doctor_updatebtn'])){
        $image = $_FILES['doctor_image_file']['name'];
        $image_tmp = $_FILES['doctor_image_file']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/doctors/".$image."");
        $q = "update doctor set first_name = '".$_POST['doctor_firstName']."', last_name = '".$_POST['doctor_lastName']."', phone = '".$_POST['doctor_phone']."', e_mail = '".$_POST['doctor_email']."', username = '".$_POST['doctor_username']."', password = '".$_POST['doctor_password']."' ,image = '".$image."' where DID = ".$_POST['doctor_id']."";
        $result = mysqli_query($conn , $q) or die("error in updating process ");   
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


    function get_doctors_table(){
    
        xmlhttp.open("GET",'service.php?get_doctors_table=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('doctors_table').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }


    function delete_confirm(doctor_id){
        if(confirm("Sure To Remove This Record ?")){
            window.location.href='doctors_managment.php?deleteDoctor=true&doctor_id=' + doctor_id;
        }
    }

    function doctor_form_fill(doctor_id, firstName, lastName, username, password, phone , email , image){
        document.getElementById('d').style.display='block';
        document.forms["doctor_data_form"]["doctor_id"].value = doctor_id;
        document.forms["doctor_data_form"]["doctor_firstName"].value = firstName;
        document.forms["doctor_data_form"]["doctor_lastName"].value = lastName;
        document.forms["doctor_data_form"]["doctor_username"].value = username;
        document.forms["doctor_data_form"]["doctor_password"].value = password;  
        document.forms["doctor_data_form"]["doctor_re_password"].value = password; 
        document.forms["doctor_data_form"]["doctor_phone"].value = phone;
        document.forms["doctor_data_form"]["doctor_email"].value = email; 
        document.forms["doctor_data_form"]["doctor_image_file"].value = image;  
        document.getElementById('doc_image').src = "../images/doctors/"+image+"";

    }


    function doctor_form_clear(){
        document.forms["doctor_data_form"]["doctor_id"].value = '';
        document.forms["doctor_data_form"]["doctor_firstName"].value = '';
        document.forms["doctor_data_form"]["doctor_lastName"].value = '';
        document.forms["doctor_data_form"]["doctor_username"].value = '';
        document.forms["doctor_data_form"]["doctor_password"].value = '';  
        document.forms["doctor_data_form"]["doctor_re_password"].value = ''; 
        document.forms["doctor_data_form"]["doctor_phone"].value = '';
        document.forms["doctor_data_form"]["doctor_email"].value = ''; 
        document.forms["doctor_data_form"]["doctor_image_file"].value = '';  

    }

</script>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>doctor managment</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/alert_message_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onLoad="get_doctors_table(); setInterval(showTime , 500); showDateInfo();">
    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;"><img id="doctor_image" style="width: 50px;height: 50px;" src="../images/user_white.gif">
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="doctors_managment.php" >doctors managment</a></li>
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
            <section>
                <section class="visible account_data_form">
                    <form class="doctor_data_form" id="d" name="doctor_data_form"  method="post" action ="doctors_managment.php" enctype="multipart/form-data">
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-center" style="margin-bottom: 0px;"><img id="doc_image" src="../images/doctors/user2.png" style="border: 1px solid #eee; width:150px; height:150px;"><br><input id="doctor_image_file" name="doctor_image_file" type="file" onChange="document.getElementById('doc_image').src = '../images/'+(this).value +''"/></div>
                                <input id="doctor_id"  name="doctor_id" class="form-control form_input" type="text">
                            </div>
                        </div>    
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label  class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">first name</label><input id="doctor_firstName"  name="doctor_firstName" class="form-control form_input" type="text" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">last name</label><input id="doctor_lastName" name="doctor_lastName" class="form-control form_input" type="text" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">username</label><input id="doctor_username" name="doctor_username" class="form-control form_input" type="text" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="padding-left: 0px;margin-bottom: 0px;padding-right: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">password</label><input id="doctor_password" name="doctor_password" class="form-control form_input" type="password" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password</label><input id="doctor_re_password" name="doctor_re_password" class="form-control form_input" type="password" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">phone number</label><input id="doctor_phone" name="doctor_phone" class="form-control form_input" type="number" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">E-mail</label><input id="doctor_email" name="doctor_email" class="form-control form_input" type="email" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><br>
                                    <button id = "update_btn" name="doctor_updatebtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="submit"  onClick="document.getElementById('d').style.display='none';">save</button>
                                    <button id = "add_btn" name="doctor_addbtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="submit"       onClick="document.getElementById('d').style.display='none';">add</button>
                                    <div name="doctor_cancelbtn" class="btn btn-primary" onClick="document.getElementById('d').style.display='none';" style="padding: 4px; width:100px; cursor:pointer;">cancel</div>
                                </div>
                            </div>
                        </div> 
                    </form>
                </section>
                <section class="text-left add_new_section"><button id="newbtn" name="doctor_addbtn"class="btn btn-primary add_button" type="button" onClick="doctor_form_clear();  document.getElementById('d').style.display = 'block'; document.getElementById('add_btn').style.display='inline'; document.getElementById('update_btn').style.display='none';"><strong>+ </strong>&nbsp; Add New</button></section>
                <div class="table-responsive account_table">
                    <table class="table table-hover text-nowrap">
                        <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>doctor no</th>
                                <th>doctor name</th>
                                <th>phone number</th>
                                <th>e-mail</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody id="doctors_table">
                            <!--
                                the doctors table returned by ajax function 
                                called get_doctors_table
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