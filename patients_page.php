
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_GET['deletePatient'])){
        delete_Patient($_GET['patient_id']);
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


    function show_all_Patients() {
        
        var obj = document.getElementById('patients_table');
        xmlhttp.open("GET", 'service.php?get_all_patients=true');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;
                show_rows_count('all' , '');
             }
        }
        xmlhttp.send(null);
    }


    function show_specific_Patients(filter) {
       
        var obj = document.getElementById('patients_table');
        xmlhttp.open("GET", 'service.php?show_specific_Patients=true&filter='+filter);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                obj.innerHTML = xmlhttp.responseText;
                show_rows_count('specific' , filter);
            }
        }
        xmlhttp.send(null);
    }


    function show_rows_count(all_or_specific , filter) {
        var obj = document.getElementById('rows_count');
        xmlhttp.open("GET", 'service.php?show_patients_count=true&type='+all_or_specific+'&filter='+filter);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            obj.innerHTML = xmlhttp.responseText;
        }
        }
        xmlhttp.send(null);     
    }



    function delete_confirm(patient_id){
        if(confirm("Sure To Remove This Record ?")){
            window.location.href='patients_page.php?deletePatient=true&patient_id=' + patient_id;
        }
}
</script>


<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>patients page</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="../css/all_patients_style.css">
    <link rel="stylesheet" href="../css/messages_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">

    <link rel="stylesheet" href="../css/DataTable.css">
</head>

<body onload="setInterval(showTime , 500); showDateInfo();">

    <!-- librarys for table pagging  -->
    <script src="../js/jq.js"></script>
	<script src="../js/DataTable.js"></script>

    <!-- for table pagging using Jquer  -->
    <script language="javascript">
            $(document).ready(function() {
                $("#myTable").DataTable();
            } );
    </script>

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
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="manager_page.php" ><img class="menue_list_icon" src="../images/home.png">Manager Page</a></li>     
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="patients_page.php" ><img class="menue_list_icon" src="../images/patients.png">patients</a></li>  
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php" ><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>                     
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <div class="content" style="background-color: rgb(252,251,251);">
              <?php
                    $q = "select * from patient";
                    $res = mysqli_query($conn , $q);
                    $count = mysqli_num_rows($res);
                ?>
                <div class="text-left searchArea"><i class="fa fa-search" style="font-size: 25px;color: rgb(255,255,255);float:left;"></i><input id = "filter_text_field" placeholder="type to find patient" style="width: 20%;margin-top: 0px;margin-left: 9px;float:left;" type="text" onChange="show_specific_Patients(this.value)"><button class="btn btn-primary text-left" type="button" style="margin-left: 22px;height: 31px;font-size: 14px;padding: 11px;padding-top: 3px;padding-right: auto;padding-bottom: 0px;padding-left: auto;background-color:rgb(91,91,92);margin-right: 5px;margin-top: 1px;width: 74px; float:left;" onClick="show_specific_Patients(document.getElementById('filter_text_field').value)">&nbsp; Find<br>&nbsp;<br></button>
                    <p style="width: 40px;float: left;font-weight: bold;font-size: 15px;">&nbsp; &nbsp;or &nbsp;</p><button class="btn btn-primary text-left" type="button" style="margin-left: 22px;height: 31px;font-size: 14px;padding: 11px;padding-top: 3px;padding-right: auto;padding-bottom: 0px;padding-left: auto;background-color: rgb(91,91,92);margin-right: 5px;margin-top: 1px;width: 147px;" onClick="show_all_Patients()">&nbsp; ahow all patients<br>&nbsp;<br></button>
                    <p style="width: 164px;float: right;font-weight: bold;font-size: 15px;margin-top: 1px;"><span id="rows_count"> <?php echo $count; ?></span> patients found</p>
                    <div style="clear:both;"></div>
                </div>
                <div class="table-responsive patients_Table">
                <table  id="myTable" class="table table-hover">
                        <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>patient no</th>
                                <th>first name</th>
                                <th>last name</th>
                                <th>gender</th>
                                <th>address</th>
                                <th>date of birth</th>
                                <th>Dentist</th>  
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody id="patients_table">
                        <?php
                                $q = "select * from patient";
                                $res = mysqli_query($conn , $q);
                                while($row = mysqli_fetch_array($res))
                                {
                                    echo'
                                        <tr>
                                            <td style="padding: 1px;"><img style="width: 35px;height: 35px;float: left;" src="../images/patients/'.$row['image'].'">
                                            <p style="width: 50%;margin-left: 47px;margin-top: 5px;">'.$row['PID'].'</p>
                                            <div style="clear:both;"></div>
                                         </td>
                                        <td>'.$row['first_name'].'</td>
                                        <td>'.$row['last_name'].'</td>
                                        <td>'.$row['gender'].'</td>
                                        <td>'.$row['address'].'</td>
                                        <td>'.$row['date_of_birth'].'</td>
                                     ';
                                        $q_SID = "select first_name from student where SID = ".$row['SID']."";
                                        $res_SID = mysqli_query($conn , $q_SID);
                                        $row_SID = mysqli_fetch_array($res_SID);
                                    echo'
                                        <td>'.$row_SID['first_name'].'</td>
                                        <td style="padding: 0;"><a name="deletePatient" class="btn btn-primary delete_appoinment_button " role="presentation" href="javascript:delete_confirm('.$row['PID'].')" style="width:30px;"> X </a></td>
                                    </tr>
                                    ';
                                }
                            ?>  
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>