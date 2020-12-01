
<?php
include("../inc/connection.php");
include("../inc/functions.php");

$conn_db2 = mysqli_connect("localhost","root","","patients_request_db");

if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error();
}


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


    function delete_confirm(patient_id){
        if(confirm("Sure To Remove This Record ?")){
            window.location.href='patient_register.php?deletePatient=true&patient_id=' + patient_id;
        }
    }


    function get_patients_requests_table(){
    
        xmlhttp.open("GET",'service.php?get_patients_requests_table=true');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('patients_request_table').innerHTML = xmlhttp.responseText;
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
            window.location.href='registeration_requests.php?deletePatient=true&patient_id=' + patient_id;
        }
    }



    function accept_reject_pationt_request(patient_id , value){

        xmlhttp.open("GET",'service.php?accept_reject_pationt_request=true&PID='+patient_id+'&status='+value+'');
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                alert(xmlhttp.responseText);
                get_patients_requests_table();              
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


<body onload="setInterval(showTime , 500);  showDateInfo();">

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
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="receptionist_page.php" ><img class="menue_list_icon" src="../images/home.png">Receptionist Page</a></li>    
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patients_page.php"><img class="menue_list_icon" src="../images/patients.png">patients</a></li> 
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="registeration_requests.php"><img class="menue_list_icon" src="../images/patients.png">registeration requests</a></li>  
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="appoinment_schedule.php"><img class="menue_list_icon" src="../images/appoinment.png">appoinment</a></li>    
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="contact_page.php"><img class="menue_list_icon" src="../images/chat.png">chat</a></li>
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php"><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>                        
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

                <div class="table-responsive patients_Table">
                    <table  id="myTable" class="table table-hover">
                    <thead style="background-color: #e6e6e6;">
                            <tr>
                                <th>patient no</th>
                                <th>patient name</th>
                                <th>gender</th>
                                <th>address</th>
                                <th>date of birth</th>
                                <th>phone number</th>
                                <th>e-mail</th>
                                <th>operation</th>
                            </tr>
                        </thead>
                        <tbody id="patients_request_table">
                            <?php
                                $q = "select * from patient_request";
                                $res = mysqli_query($conn_db2 , $q);
                                while($row = mysqli_fetch_array($res))
                                {
                                    echo'
                                        <tr>
                                            <td>'.$row['PID'].'</td>
                                            <td>'.$row['first_name'].'   '.$row['last_name'].'</td>
                                            <td>'.$row['gender'].'</td>
                                            <td>'.$row['address'].'</td>
                                            <td>'.$row['date_of_birth'].'</td>
                                            <td>'.$row['phone'].'</td>
                                            <td>'.$row['e_mail'].'</td>
                                            <td style="padding: 8px;width: 126px;">
                                                <a name="acceptPatientRequest" class="btn btn-primary" style="width:80px; font-size:13px; color:white; padding:3px 10px; cursor:pointer;" onClick="accept_reject_pationt_request('.$row['PID'].' , 1);" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%; cursor:pointer;">accept</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            
                            ?>
                        </tbody>
                    </table>
                    <span id="result">result</span>
                 </div>
            </div>
        </div>
    </div>


    <script src="../js/javascript.js"></script>
    <script src="../js/bootstrap.js"></script>



</body></html>