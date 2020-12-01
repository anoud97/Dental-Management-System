
<?php

error_reporting(0);

include("inc/functions.php");
?>

<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>open patient file</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.css">
    <link rel="stylesheet" href="css/control_panel_style.css">
    <link rel="stylesheet" href="css/contact_style.css">
    <link rel="stylesheet" href="css/appoinment_schedule_style.css">
    <link rel="stylesheet" href="css/messages_style.css">
    <link rel="stylesheet" href="css/index_style.css">
    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="css/parsley.min.css" />  
</head>

<body dir="rtl" onload="setInterval(showTime , 500);  showDateInfo();">

    <section class="header_section">
        <div style="margin: 13px;width: 150px;text-align:center;">
            <br>
            <br>
            <br>
            <br>
        </div>
    </section>
    <section class="current_time_date_bar">
            <span style="font-size: 13px;font-family: Abel, sans-serif;color: rgb(47,126,121); float:right;"><span id="currentTime">11:30 AM </span>&nbsp; Today &nbsp;is &nbsp;<span id="day_name">Wednesday</span>&nbsp;, <span id="date_info">November 13th, 2019</span> &nbsp;</span>
            <div style="clear:both;"></div>
    </section>
    <div class="row flex-grow-1 text-center">
        <div class="col-sm-0 col-md-2 col-lg-2 content_column text-center">
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 content_column text-center">
            <section>
                <section class="visible account_data_form patient_register_form">
                   <center>
                    <form id="requestForm" name="patient_data_form" method="post" action ="patient_register.php" enctype="multipart/form-data" >
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-center" style="margin-bottom: 0px;"><img id="p_image" src="images/user_black.gif" style="border: 1px solid #eee; width:150px; height:150px;"><br><input id="patient_image" name="patient_image" type="file" onChange="document.getElementById('p_image').src = 'images/'+(this).value +''"/></div>
                            </div>
                        </div>                                                                                                                
                        <div class=" ">
                            
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">الإسم الأول :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : First name </label><input id="first_name" name="first_name" class="form-control form_input" type="text" value="<?php echo $_POST['first_name']; ?>" required data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">الإسم الأخير :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Last name </label><input id="last_name" name="last_name" class="form-control form_input" type="text" value="<?php echo $_POST['last_name']; ?>" required  data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">الرقم الوطني :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : National Card Id </label><input id="PID" name="PID" class="form-control form_input" type="text" value="<?php echo $_POST['PID']; ?>" required data-parsley-pattern="^[0-9]+$" data-parsley-length="[10, 10]" data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">العنوان :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Address </label><input id="address" name="address" class="form-control form_input" type="text" value="<?php echo $_POST['address']; ?>" required  data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-rightlg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">رقم الهاتف :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Phone number </label><input id="phone" name="phone" class="form-control form_input" type="text" value="<?php echo $_POST['phone']; ?>" required data-parsley-pattern="^(05)[0-9+-/]+$" data-parsley-length="[10, 10]" data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;">إسم المستخدم :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Username </label><input id="username" name="username" class="form-control form_input" type="text" value="<?php echo $_POST['username']; ?>" required  data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px;"> البريد الإلكتروني :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Email </label><input id="e_mail"  name="e_mail" class="form-control form_input" type="text" value="<?php echo $_POST['e_mail']; ?>" required data-parsley-type="email" data-parsley-trigger="keyup" ></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="padding-left: 0px;margin-bottom: 0px;padding-right: 0px;"><label style="color: rgb(83,84,85);padding-right: 0px;">كلمة المرور :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Password </label><input id="patient_password" name="patient_password" class="form-control form_input" type="password" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label">تأكيد كلمة المرور :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Confirm password </label><input id="patient_re_password" name="patient_re_password" class="form-control form_input" type="password" required data-parsley-equalto="#patient_password" data-parsley-trigger="keyup"></div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label">تاريخ الميلاد :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Birth date </label><input id="date_of_birth" name="date_of_birth" value="2020-04-22" min="1940-01-01" max="2014-12-31" class="form-control form_input" type="date" value="<?php echo $_POST['date_of_birth']; ?>" required></div>
                           
						   </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label  class="field_label" required>الجنس :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Gender </label>
                                    <select id="gender" name="gender" class="form-control genderSelect" style="margin-right: 0px;" required>  
                                        <option value="" selected="selected">الجنس</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><label class="field_label">وصف المشكلة :</label><label class="field_label" style="color: rgb(83,84,85);padding-right: 0px; float:left;"> : Problem description </label><textarea id="problem_description" name="problem_description" class="form-control form_input" rows="5" required data-parsley-trigger="keyup"><?php echo $_POST['problem_description']; ?></textarea> </div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group text-right" style="margin-bottom: 0px;"><br>
                                   <!-- <button id = "add_btn" name="patient_addbtn" class="btn btn-primary" style="padding: 4px; width:100px;" type="submit" >إرسال</button> -->
                                   <input type="submit" id="submit" name="submit" value="إرسال" class="btn btn-primary" style="padding: 4px; width:100px; cursor:pointer;" /> 
                                   <a href="index.php" name="admin_cancelbtn" class="btn btn-primary" style="padding: 4px; width:100px; cursor:pointer;">رجوع</a>
                                    
                                </div>
                            </div>
                        </div> 
                    </form>
                  <center>
                </section>
                <section style="height: 46px;"></section>
            </section>
        </div>
        <div class="col-sm-0 col-md-2 col-lg-2 content_column text-center">
        </div>
    </div>

    <script src="js/javascript.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="js/parsley.min.js"></script>         <!-- library for form validation  -->

</body>
</html>

<script>  
$(document).ready(function(){  
    $('#requestForm').parsley();
 
 $('#requestForm').on('submit', function(event){
  event.preventDefault();
  if($('#requestForm').parsley().isValid())
  {
   $.ajax({
    url:"insert_patient_request.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){

    },
    success:function(data)
    {
     $('#requestForm')[0].reset();
     $('#requestForm').parsley().reset();
     alert(data);
    }
   });
  }
 });
});  
</script>