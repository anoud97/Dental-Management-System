
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }else{
        $q_student = "select * from student where SID = ".$_COOKIE['user_id']."";
        $res_student = mysqli_query($conn , $q_student);
        $row_student = mysqli_fetch_array($res_student);
    }

    if(isset($_GET['deleteAvailableTime'])){
        delete_time($_GET['time_id']);
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

    function show_available_times() {

        var obj = document.getElementById('available_times_table');
        xmlhttp.open("GET", 'service.php?get_available_times=true');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);

    }


    function add_availableTime(SID , hour , AM_PM , date){
        xmlhttp.open("GET", 'service.php?add_available_times=true&SID='+ SID +'&hour='+ hour +'&AM_or_PM='+ AM_PM +'&date='+ date +'');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                show_available_times();
                alert("ok adedd succefly");
            }
        }
        xmlhttp.send(null);
    }

    function delete_confirm(available_time_id){
        if(confirm("Sure To Remove This Record ?")){
            window.location.href='available_times.php?deleteAvailableTime=true&time_id=' + available_time_id;
        }
    }


</script>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>available times page</title>
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

    <script>
    function check_fields(){
        if(document.getElementById('day_id').value > 0 && document.getElementById('month_id').value > 0 && document.getElementById('year_id').value > 0 && document.getElementById('hour_id').value > 0 )
            return true;
        else
            return false;
    }
    </script>
</head>

<body onload="show_available_times(); setInterval(showTime , 500);  showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item " role="presentation"><a class="nav-link nav_item_link" href="student_page.php" ><img class="menue_list_icon" src="../images/home.png">Student Page</a></li>    
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php" ><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>                      
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="available_times.php" ><img class="menue_list_icon" src="../images/available_time.png">available times</a></li>                     
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <div class="content" style="background-color: rgb(252,251,251);">
                <div class="patient_Information_Div" style="padding-left: 4px;padding-top: 6px;">
                    <p class="patient_info"><strong>student ID :</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span id="student_id"><?php echo $row_student['SID'];  ?></span></p>
                    <p class="patient_info"><strong>student name :</strong>&nbsp; &nbsp; &nbsp;<?php echo $row_student['first_name'].'  '.$row_student['last_name'];  ?></p>
                    <p class="patient_info"><strong>phone :</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_student['phone'];  ?></p>
                    <p class="patient_info"><strong>level :</strong>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; <?php echo $row_student['level'];  ?></p>
                    <p class="patient_info"><strong>e_mail :</strong>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $row_student['e_mail'];  ?></p>
                </div>
                <p style="width: 95%;margin-right: auto;margin-left: auto;margin-bottom: 0px;margin-top: 14px;padding: 5px;padding-left: 1px;font-weight: bold;font-size: 16px;padding-top: 0px;">add your available time</p>
                <div class="text-left availableTimeArea">
                    <label style="margin-left: 12px;">Date</label>
                    <select id="day_id" style="margin-left: 7px;width: 10%;font-size: 16px;padding: 1px;">
                        <option value="0" selected="selected">Day</option>
                        <?php
                            for($i=1;$i<=30; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        ?>
                    </select>
                    <select id="month_id" style="margin-left: 12px;width: 10%;font-size: 16px;padding: 1px;">
                        <option value="0" selected="selected">Month</option>
                        <?php
                            $months = array('Jan','Feb','Mar','Apr','May','Jan','Jul','Aug','Sep','Oct','Nov','Dec');
                            for($i=0;$i<=12; $i++){
                                echo '<option value="'.($i+1).'">'.$months[$i].'</option>';
                            }
                        ?>
                    </select>
                    <select id="year_id" style="margin-left: 12px;width: 15%;font-size: 16px;padding: 1px;">
                        <option value="0" selected="selected">Year</option>
                        <?php
                                for($i=2020;$i<=2030; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                    </select>
                    <label style="margin-left: 12px;">Clock</label>
                    <select id="hour_id" style="margin-left: 12px;width: 15%;font-size: 16px;padding: 1px;">
                        <option value="0" selected="selected">hour</option>
                        <?php
                                for($i=1;$i<=12; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                    </select>
                    <select id="AM_PM" style="margin-left: 12px;width: 70px;font-size: 16px;padding: 1px;">
                        <option value="AM" selected="selected">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <button id = "add_btn" class="btn btn-primary text-left" type="button" style="margin-left: 22px;height: 31px;font-size: 14px;padding-top: 0px;padding-right: auto;padding-bottom: 0px;padding-left: auto;background-color: rgb(91,91,92);float: right;margin-right: 5px;margin-top: 1px;" onClick="if(check_fields()) add_availableTime(<?php echo $row_student['SID']; ?> , document.getElementById('hour_id').value, document.getElementById('AM_PM').value ,document.getElementById('year_id').value + '-' + document.getElementById('month_id').value  + '-' +  document.getElementById('day_id').value ); else alert('insert all available time values');">add</button>
                <div style="clear:both;"></div>
            </div>
            <div class="table-responsive available_times_Table">
                <table class="table table-hover">
                    <thead style="background-color: #d4d4d3;">
                        <tr>
                            <th>Student ID</th>
                            <th>Date</th>
                            <th>Level</th>
                            <th>Time</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody id="available_times_table">

                    </tbody>
                </table>
            </div>
            <div style="height: 52px;"></div>
        </div>
        </div>
    </div>

    
    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>