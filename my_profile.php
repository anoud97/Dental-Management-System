
<?php
    include("../inc/connection.php");
    include("../inc/functions.php");
?>


<?php
    if(!isset($_COOKIE['user_name'])){
        header("location:../login.php");
    }

    if(isset($_POST['patient_updatebtn'])){
        $image = $_FILES['patient_image']['name'];
        $image_tmp = $_FILES['patient_image']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/patients/".$image."");
        $q = "update patient set first_name = '".$_POST['first_name']."', last_name = '".$_POST['last_name']."', address = '".$_POST['address']."', phone = '".$_POST['phone']."', username = '".$_POST['username']."', e_mail = '".$_POST['e_mail']."', password = '".$_POST['patient_password']."', date_of_birth = '".$_POST['date_of_birth']."', gender = '".$_POST['gender']."' ,image = '".$image."' , problem_description = '".$_POST['problem_description']."' where PID=".$_POST['patient_id']."";
        $result = mysqli_query($conn , $q) or die("error in updating process "); 

        echo '<script>alert("updating finshed successfly");</script>';
    }  
?>


<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>open patient file(فتح ملف المريض)</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fonts/font-awesome.css">
    <link rel="stylesheet" href="../css/control_panel_style.css">
    <link rel="stylesheet" href="../css/contact_style.css">
    <link rel="stylesheet" href="../css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="../css/messages_style.css">
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
                            <li class="nav-item left_nav_item menue_list_item " role="presentation"><a class="nav-link nav_item_link" href="patient_page.php" ><img class="menue_list_icon" src="../images/home.png">Patient Page(صفحه المريض)</a></li>   
                            <li class="nav-item left_nav_item menue_list_item activated" role="presentation"><a class="nav-link nav_item_link" href="my_profile.php" ><img class="menue_list_icon" src="../images/appoinment.png">my profile(ملفي)</a></li>                        
                            <li class="nav-item left_nav_item menue_list_item" role="presentation"><a class="nav-link nav_item_link" href="appoinments_page.php" ><img class="menue_list_icon" src="../images/appoinment.png">appoinments(المواعيد)</a></li>                       
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 content_column">
            <section>
                <section class="visible account_data_form">
                    <form id="d" name="patient_data_form" method="post" action ="my_profile.php" enctype="multipart/form-data" >
                       
                        <?php
                            $q = "select * from patient where PID = ".$_COOKIE['user_id']."";
                            $res = mysqli_query($conn , $q);
                            $row = mysqli_fetch_array($res);                      
                        ?>

                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-center" style="margin-bottom: 0px;"><img id="p_image" src="../images/<?php echo $row['image']; ?>" style="border: 1px solid #eee; width:150px; height:150px;"><br><input id="patient_image" name="patient_image" type="file" onChange="document.getElementById('p_image').src = '../images/'+(this).value +''"/></div>
                            </div>
                        </div>                                                                                                                
                        <div class="form-row account_form_row">
                            <input id="patient_id" name="patient_id" class="form-control form_input" type="hidden" value="<?php echo $row['PID']; ?>">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">first name(الأسم الاول)</label><input id="first_name" name="first_name" class="form-control form_input" type="text" value="<?php echo $row['first_name']; ?>" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">last name(اسم العائله)</label><input id="last_name" name="last_name" class="form-control form_input" type="text" value="<?php echo $row['last_name']; ?>" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">address(العنوان)</label><input id="address" name="address" class="form-control form_input" type="text" value="<?php echo $row['address']; ?>" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">phone(رقم الجوال)</label><input id="phone" name="phone" class="form-control form_input" type="text" value="<?php echo $row['phone']; ?>" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">user name(اسم المستخدم)</label><input id="username" name="username" class="form-control form_input" type="text" value="<?php echo $row['username']; ?>" required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">E-mail(الإيميل)</label><input id="e_mail"  name="e_mail" class="form-control form_input" type="email" value="<?php echo $row['e_mail']; ?>" required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="padding-left: 0px;margin-bottom: 0px;padding-right: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">password(كلمة السر)</label><input id="patient_password" name="patient_password" class="form-control form_input" type="password" value="<?php echo $row['password']; ?>"  required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">repeat password(أعد كلمة السر)</label><input id="patient_re_password" name="patient_re_password" class="form-control form_input" type="password" value="<?php echo $row['password']; ?>"  required></div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">date of birth(تاريخ الميلاد)</label><input id="date_of_birth" name="date_of_birth" class="form-control form_input" type="date" value="<?php echo $row['date_of_birth']; ?>"  required></div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label  class="field_label" required>gender</label>
                                    <select id="gender" name="gender" class="form-control genderSelect" style="margin-left: 0px;">  
                                        <option value="" selected="selected">gender(الجنس)</option>
                                        <option value="Male" <?php  echo ($row['gender']=='Male')?"selected":""; ?> >Male(ذكر)</option>
                                        <option value="Female" <?php  echo ($row['gender']=='Female')?"selected":""; ?> >Female(أنثى)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-left" style="margin-bottom: 0px;"><label class="field_label">problem description(وصف المشكله)</label><textarea id="problem_description" name="problem_description" class="form-control form_input" rows="5" required><?php echo $row['problem_description']; ?></textarea> </div>
                            </div>
                        </div>
                        <div class="form-row account_form_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><br>
                                    <button id = "update_btn" name="patient_updatebtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="submit" >update(تحديث)</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </section>
            </section>
        </div>
    </div>

    <script src="../js/javascript.js"></script>
    <script src="../js/jquery-3.js"></script>
    <script src="../js/bootstrap.js"></script>


</body></html>