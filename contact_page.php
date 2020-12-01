
<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>
<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }
?>



<!DOCTYPE html>
<html><head>

<script>
        //Create a boolean variable to check for a valid Internet Explorer instance.
    var xmlhttp;
    if(window.ActiveXObject){
        xmlhttp = new ActiveXObject("Micosoft.XMLHTTP");
    }else{
        xmlhttp = new XMLHttpRequest();
    }

    function showContactList() {
        var obj = document.getElementById('contact_list');
        xmlhttp.open("GET", 'service.php?get_Contacts=true');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            obj.innerHTML = xmlhttp.responseText;
        }
        }
        xmlhttp.send(null);
    }


    function showMessagesList() {
        var obj = document.getElementById('chat_messages_list');
        var RID = document.getElementById('selected_recept_id').value;
        xmlhttp.open("GET", 'service.php?get_Messages=true&selected_recept='+ RID +'');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            obj.innerHTML = xmlhttp.responseText;
        }
        }
        xmlhttp.send(null);
    }

    function sendMessages() {
        var RID = document.getElementById('selected_recept_id').value;
        var text = document.getElementById('new_message_text').value;
        var d = new Date();
        var AMBM = (d.getHours("hh")<=12)?"AM":"BM";
        var current_time = d.getHours() + ":" + d.getMinutes() + ":" +  d.getSeconds() + " " + AMBM;
        xmlhttp.open("GET", 'service.php?send_message=true&RID=' + RID + '&text=' + text + '&time=' + current_time + '');
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        }
        }
        xmlhttp.send(null);
    }


    function scrollDown(){
        var element = document.getElementById('chatting_content_div');
        element.scrollTop = document.getElementById('chatting_content_div').scrollHeight;
    }

</script>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>contact page</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/messages_style.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body onLoad="setInterval(showContactList , 500); setInterval(showTime , 500);  showDateInfo();">
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
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="patient_file.php"><img class="menue_list_icon" src="../images/view_file.png">view patient file</a></li>         
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="contact_page.php"><img class="menue_list_icon" src="../images/chat.png">chat</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <div class="row chat_div_header">
                    <div class="col-sm-4 col-md-3 col-lg-3 Receptionist_columen">
                        <div class="Receptionist_columen_header">
                            <p style="padding: 8px;margin-right: 5px;font-size: 16px;background-color: #ece8e8;"><strong>List of receptionist</strong></p>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-9 chatting_colument">
                        <div class="chatting_colument_header">                      
                            <p style="padding: 8px;margin-left: 5px;background-color: #ece8e8;"><strong id="receptionist_name_header">Res\</strong></p>
                        </div>
                    </div>
                </div>
                <div class="row chat_div_content" style="height: auto;">
                    <div class="col-sm-4 col-md-3 col-lg-3 Receptionist_columen" >
                        <div class="Receptionist_columen_content" style="height: 420px;">
                            <ul class="receptionist_list" id="contact_list">

                                <!-- the Receptionist list will be returned by the timer
                                 and ajax get_Contacts function-->

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9 col-lg-9 chatting_column">
                        <div id="chatting_content_div" class="chatting_colument_content" style="height: 420px;">
                            <ul class="messages_list" id="chat_messages_list" style="padding: 0px;">
                              
                                <!-- the message list of between the selected Receptionist and the reciptionist
                                will be returned by the timerand ajax get_Messages function-->
                                
                            </ul>
                        </div>
                        <div class="send_message_area"><input class="new_message_text" id="new_message_text" type="text"><input id="selected_recept_id" type="text" style="width:40px;"><button id="2020" class="btn btn-primary send_btn" type="button" onClick="sendMessages(); document.getElementById('new_message_text').value = '' ; scrollDown();">send</button>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>