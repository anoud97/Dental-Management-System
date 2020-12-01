<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_GET['deleteAdmin'])){
        delete_Admin($_GET['admin_id']);
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


    function get_admins_table(){
    
        xmlhttp.open("GET",'service.php?get_admins_table=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('admins_table').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }



    function delete_confirm(admin_id)
    {
        if(confirm('Sure To Remove This Record ?'))
        {
            window.location.href='admins_managment.php?deleteAdmin=true&admin_id='+admin_id;
        }
    }



    function admin_form_fill(admin_id,admin_name ,admin_email,admin_username,admin_password){
        document.getElementById('d').style.display='block';
        document.forms["admin_data_form"]["admin_id"].value = admin_id;
        document.forms["admin_data_form"]["admin_name"].value = admin_name;
        document.forms["admin_data_form"]["admin_username"].value = admin_username;
        document.forms["admin_data_form"]["admin_email"].value = admin_email;
        document.forms["admin_data_form"]["admin_password"].value = admin_password;  
        document.forms["admin_data_form"]["admin_re_password"].value = admin_password;  
    }



    function admin_form_clear(){
        document.forms["admin_data_form"]["admin_id"].value = '';
        document.forms["admin_data_form"]["admin_name"].value = '';
        document.forms["admin_data_form"]["admin_username"].value = '';
        document.forms["admin_data_form"]["admin_email"].value = '';
        document.forms["admin_data_form"]["admin_password"].value = '';  
        document.forms["admin_data_form"]["admin_re_password"].value = '';  
        document.forms["admin_data_form"]["admin_name"].focus();
    }



    function add_admin(admin_name , admin_username , admin_email , admin_password){
        xmlhttp.open('GET',"service.php?add_admin=true&admin_name="+admin_name+"&admin_username="+admin_username+"&admin_email="+admin_email+"&admin_password="+admin_password+"");
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                get_admins_table();
                alert("added sccessfly");
            }
        }
        xmlhttp.send(null);
    }


    function update_admin(admin_id , admin_name , admin_username , admin_email , admin_password){
        xmlhttp.open("GET", 'service.php?update_admin=true&admin_id='+admin_id+'&admin_name=' + admin_name + '&admin_username=' + admin_username + '&admin_email=' + admin_email + '&admin_password=' + admin_password + '');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                get_admins_table();
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
    <title>admins managment</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/alert_message_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
    
</head>

<body onLoad="get_admins_table(); setInterval(showTime , 500); showDateInfo();">
    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;"><img style="width: 50px;height: 50px;" src="../images/user_white.gif">
        <p style="margin-bottom: 0px;color: rgb(244,247,251);"><strong><?php echo $_COOKIE['user_name']; ?></strong></p>
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="admins_managment.php">admins managment</a></li>
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
            <section id="admin_data_section">
                <section class="visible account_data_form">
                    <form class="admin_data_form" id="d" name="admin_data_form">
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <input id="admin_id" name="admin_id" class="form-control form_input" type="hidden">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">admin name</label><input id="admin_name" name="admin_name" class="form-control form_input" type="text" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">user name</label><input id="admin_username" name="admin_username" class="form-control form_input" type="text" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">E-mail</label><input id="admin_email" name="admin_email" class="form-control form_input" type="email" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="padding-left: 0px;margin-bottom: 0px;padding-right: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">password</label><input id="admin_password" name="admin_password" class="form-control form_input" type="password" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password</label><input id="admin_re_password" name="admin_re_password" class="form-control form_input" type="password" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right" style="margin-bottom: 0px;"><br>
                                <button id = "update_btn" name="admin_updatebtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button" onClick="update_admin(document.getElementById('admin_id').value , document.getElementById('admin_name').value , document.getElementById('admin_username').value , document.getElementById('admin_email').value , document.getElementById('admin_password').value); document.getElementById('d').style.display='none';">save</button>
                                <button id = "add_btn" name="admin_addbtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button" onClick="add_admin(document.getElementById('admin_name').value , document.getElementById('admin_username').value , document.getElementById('admin_email').value , document.getElementById('admin_password').value); document.getElementById('d').style.display='none';">add</button>
                                <div name="admin_cancelbtn" class="btn btn-primary" onClick="document.getElementById('d').style.display='none';" style="padding: 4px; width:100px; cursor:pointer;">cancel</div>
                            </div>
                        </div>
                        </div> 
                    </form>

                </section>
                <section class="text-left add_new_section"><button id="newbtn" name="admin_newbtn" class="btn btn-primary add_button" type="button"  onClick="admin_form_clear(); document.getElementById('d').style.display='block'; document.getElementById('add_btn').style.display='inline'; document.getElementById('update_btn').style.display='none';"><strong>+ </strong>&nbsp; Add New</button></section>
                <div class="table-responsive account_table">
                    <table class="table table-hover">
                        <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>user name</th>
                                <th>e-mail</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody id="admins_table">
                            <!--
                                admins tables will be returned
                                by ajax function called get_admins_table
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