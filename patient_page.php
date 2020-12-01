<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>patients page(صفحه المريض)</title>
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
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onload="setInterval(showTime , 500);  showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="patient_page.php" ><img class="menue_list_icon" src="../images/home.png">Patient Page(صفحه المريض)</a></li>   
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="my_profile.php" ><img class="menue_list_icon" src="../images/view_file.png">my profile(ملفي)</a></li>                        
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="appoinments_page.php" ><img class="menue_list_icon" src="../images/appoinment.png">appoinments(المواعيد)</a></li>                       
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
        <section class="main_content_section">
            <p class="text-center website_word_header">Wellcome to Patient Page(اهلا بك في صفحه المريض)</p>
            <div style="width: 35%;height: 2px;margin-right: auto;margin-left: auto;background-color: #6cebe3;"></div>
            <p class="text-center website_word">from this page you can(من هذه الصفحه بإمكانك) :<br>  manage appoinments(إدارة المواعيد)  <br> and another jobs(وأمور أخرى)</p>
            
            <ul class="shortcut_list">
                <center>
                    <div style="text-align:center; width:22%;">
                    <center>
                        <li class="shortcut_list_item" ><div><a class="" href="my_profile.php"><img src="../images/view_file.png" style="width:60px; height:60px; border-radius:20px;" /><br>my profile(ملفي الشخصي)</a></div></li>
                        <li class="shortcut_list_item" ><div><a class="" href="appoinments_page.php" ><img src="../images/appoinment.png" style="width:60px; height:60px; border-radius:20px;" /><br>appoinments(المواعيد)</a></li>
                        <div style="clear:both;"></div>
                    </center>
                    </div>
                </center>
            </ul>  
        </section>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>