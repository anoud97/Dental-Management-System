
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_GET['savebtn'])){
        if($_GET['password'] == $_GET['re_password']){
            save_managerData($_GET['first_name'] , $_GET['last_name'] , $_GET['role'] , $_GET['username'], $_GET['password']);
        }else{
            echo '<h4 style="color:red; text-align:center;">password and confirm password not maches</h4>';
        }
        
    }  
?>



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

<body onload="setInterval(showTime , 500); showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="manager_data_managment.php" >manager managment</a></li>
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
                    <form merhod="get" acrion="manager_data_managment.php"> 
                    
                        <?php
                            $q = "select * from manager";
                            $result = mysqli_query($conn , $q);
                            $row = mysqli_fetch_array($result);
                        ?>  
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">manager first name</label><input name="first_name" class="form-control form_input" type="text" value="<?php echo $row['first_name']; ?>"  required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">manager last name</label><input name="last_name" class="form-control form_input" type="text" value="<?php echo $row['last_name']; ?>" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">role</label><input name="role" class="form-control form_input" type="text" value="<?php echo $row['role']; ?>" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">user name</label><input name="username" class="form-control form_input" type="text" value="<?php echo $row['username']; ?>" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">password</label><input name="password" class="form-control form_input" type="password" value="<?php echo $row['password']; ?>" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password</label><input name="re_password" class="form-control form_input"  type="password" value="<?php echo $row['password']; ?>"></div>
                            </div>
                         </div>
                         <section class="text-left save_section"><br><button name="savebtn" class="btn btn-primary save_button" type="submit"><strong>Save</strong><br></button></section>
                    </form>
                </section>
                <section style="height: 46px;"></section>
            </section>
        </div>
    </div>
    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>