
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>
<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_GET['deleteReceptionist'])){

       delete_Receptionist($_GET['receptionist_id']);
    }  
    
    if(isset($_POST['receptionist_savebtn'])){
        if($_POST['receptionist_password'] == $_POST['receptionist_re_password']){
            $receptionist_image = $_FILES['receptionist_image']['name'];
            $receptionist_image_tmp = $_FILES['receptionist_image']['tmp_name'];
            
            save_receptionistData($_POST['receptionist_name'] , $_POST['receptionist_username'] , $_POST['receptionist_password'] , $receptionist_image ,$receptionist_image_tmp);
        }else{
             echo '<h4 style="color:red; text-align:center;">password and confirm password not maches</h4>';
        }
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


    function get_receptionist_table(){
    
        xmlhttp.open("GET",'service.php?get_receptionist_table=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('receptionist_table').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }



    function delete_confirm(R_id)
    {
        if(confirm('Sure To Remove This Record ?'))
        {
            window.location.href='receptionist_data_managment.php?deleteReceptionist=true&receptionist_id='+R_id;
        }
    }



    function receptionist_form_fill(receptionist_id,receptionist_name ,receptionist_username,receptionist_password){
        document.getElementById('d').style.display='block';
        document.forms["receptionist_data_form"]["receptionist_id"].value = receptionist_id;
        document.forms["receptionist_data_form"]["receptionist_name"].value = receptionist_name;
        document.forms["receptionist_data_form"]["receptionist_username"].value = receptionist_username;
        document.forms["receptionist_data_form"]["receptionist_password"].value = receptionist_password;  
        document.forms["receptionist_data_form"]["receptionist_re_password"].value = receptionist_password;  
    }



    function receptionist_form_clear(){
        document.getElementById('d').style.display='block';
        document.forms["receptionist_data_form"]["receptionist_id"].value = '';
        document.forms["receptionist_data_form"]["receptionist_name"].value = '';
        document.forms["receptionist_data_form"]["receptionist_username"].value = '';
        document.forms["receptionist_data_form"]["receptionist_password"].value = '';  
        document.forms["receptionist_data_form"]["receptionist_re_password"].value = '';  
        document.forms["receptionist_data_form"]["receptionist_name"].focus();

    }



    function add_receptionist(receptionist_name , receptionist_username , receptionist_password){

        xmlhttp.open('GET',"service.php?add_receptionist=true&receptionist_name="+receptionist_name+"&receptionist_username="+receptionist_username+"&receptionist_password="+receptionist_password+"");
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                get_receptionist_table();  
                alert('ok added successfly'); 
            }
        }
        xmlhttp.send(null);

    }


    function update_receptionist(receptionist_id , receptionist_name , receptionist_username  , receptionist_password){

        xmlhttp.open("GET", 'service.php?update_receptionist=true&receptionist_id='+receptionist_id+'&receptionist_name=' + receptionist_name + '&receptionist_username=' + receptionist_username + '&receptionist_password=' + receptionist_password + '');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                get_receptionist_table(); 
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
    <title>manage receptionist data</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/css_002">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/alert_message_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="get_receptionist_table(); setInterval(showTime , 500); showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="receptionist_data_managment.php" >receptionist managment</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manage_website_data.php" >website data managment</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <section>
                <section  class="visible account_data_form">
                    <form class="receptionist_data_form" id="d" name="receptionist_data_form" style="display:none;">
                        <?php
                            $q = "select * from receptionist";
                            $result = mysqli_query($conn , $q);
                            $row = mysqli_fetch_array($result);
                        ?>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input id="receptionist_id" name="receptionist_id" class="form-control form_input" type="text">
                                <div class="form-group text-center" style="margin-bottom: 0px;"><img id="rec_image" id="receptionist_img" name="receptionist_img" src="../images/<?php echo $row['image']; ?>" style="border: 1px solid #eee; width:150px; height:150px;"><br><input type="file" name="receptionist_image" onChange="document.getElementById('rec_image').src = '../images/'+(this).value +''"/></div>
                            </div>
                        </div>    
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">receptionist name</label><input id="receptionist_name" name="receptionist_name" class="form-control form_input" type="text" value="<?php echo $row['name']; ?>"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">user name</label><input id="receptionist_username" name="receptionist_username" class="form-control form_input" type="text" value="<?php echo $row['username']; ?>"></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">password</label><input id="receptionist_password" name="receptionist_password" class="form-control form_input" type="password" value="<?php echo $row['password']; ?>"></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password</label><input id="receptionist_re_password" name="receptionist_re_password" class="form-control form_input" type="password" value="<?php echo $row['password']; ?>"></div>
                            </div>
                         </div>
                         <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><br>
                                    <button id = "update_btn" name="receptionist_updatebtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button" onClick="update_receptionist(document.getElementById('receptionist_id').value , document.getElementById('receptionist_name').value , document.getElementById('receptionist_username').value  , document.getElementById('receptionist_password').value); document.getElementById('d').style.display='none';">save</button>
                                    <button id = "add_btn" name="receptionist_addbtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="button" onClick="add_receptionist(document.getElementById('receptionist_name').value , document.getElementById('receptionist_username').value  , document.getElementById('receptionist_password').value); document.getElementById('d').style.display='none';">add</button>
                                    <div name="admin_cancelbtn" class="btn btn-primary" onClick="document.getElementById('d').style.display='none';" style="padding: 4px; width:100px; cursor:pointer;">cancel</div>
                                </div>
                            </div>
                          </div> 
                     </form>
                </section>
                <section class="text-left add_new_section"><button id="newbtn" name="admin_newbtn" class="btn btn-primary add_button" type="button"  onClick="receptionist_form_clear(); document.getElementById('d').style.display='block'; document.getElementById('add_btn').style.display='inline'; document.getElementById('update_btn').style.display='none';"><strong>+ </strong>&nbsp; Add New</button></section>
                <div class="table-responsive account_table">
                    <table class="table table-hover">
                        <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>user name</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody id="receptionist_table">
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