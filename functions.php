    <?php
    include("connection.php");


    // دالة للتحقق من صحة الحساب
    function login($UID,$PWD,$Table){

        global $conn;
        $q = "select * from ".$Table." where username = '".$UID."' and password = '".$PWD."'";
        $result = mysqli_query($conn , $q);

        if(mysqli_num_rows($result)!== 0){

            $row = mysqli_fetch_array($result);
            setcookie("user_id" , $row[0]);
            setcookie("user_name" , $row['username']);
            setcookie('user_type' , $Table);
            
            if($Table == 'student'){
                    setcookie('is_excellent_student' , $row['is_excellent']);
            } 

            if($Table == 'doctor'){
                $q_c = "update doctor set is_connected = 1 where DID = ".$row[0]."";
                $res_c = mysqli_query($conn , $q_c) or die('error in updatin process');
            }
            else if($Table == 'receptionist'){
                $q_c = "update receptionist set is_connected = 1 where RID = ".$row[0]."";
                $res_c = mysqli_query($conn , $q_c) or die('error in updatin process');
            }

            return true;
        }else{
            return false;
        }

    }



    // دالة حذف أدمن
    function delete_Admin($admin_id){
        global $conn;
        $q = "delete from admin where AID = ".$admin_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");

    }


    // دالة حذف موظف إستقبال
    function delete_Receptionist($receptionist_id){

        global $conn;
        $q = "delete from receptionist where RID = ".$receptionist_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");
    }


    // دالة حذف دكتور
    function delete_Doctor($doctor_id){
        global $conn;
        $q = "delete from doctor where DID = ".$doctor_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");
    }




    //دالة إظافة طالب جديد
    function add_Student($student_firstName , $student_lastName ,$student_level , $student_username , $student_phone ,$student_email , $student_password){
        global $conn;
        $q = "insert into student (first_name , last_name , level , phone , e_mail ,username ,password) values ('".$student_firstName."','".$student_lastName."',".$student_level.",'".$student_phone."' , '".$student_email."' , '".$student_username."','".$student_password."')";
        $result = mysqli_query($conn , $q) or die("error in inserting process ");    
    }


    // دالة حذف طالب
    function delete_Student($student_id){
        global $conn;
        $q = "delete from student where SID = ".$student_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");
    }


// حفظ او تعديل بيانات المةقع
    function save_websiteData($website_phone , $website_email , $location , $website_word){
        global $conn;
        $q = "select * from website_data";
        $result = mysqli_query($conn , $q);
        if(mysqli_num_rows($result) == 0){
            $q = "insert into website_data (website_word , phone , e_mail , location ) values ('".$website_word."','".$website_phone."','".$website_email."',".$location."')";
            $result = mysqli_query($conn , $q) or die("error in inserting process "); 
        }else{
            $q = "update website_data set website_word = '".$website_word."', phone = '".$website_phone."', e_mail = '".$website_email."', location = '".$location."'";
            $result = mysqli_query($conn , $q) or die("error in updating process "); 
        }
    }


   // حفظ او تعديل بيانات المدير
    function save_managerData($first_name , $last_name , $role , $username , $password ){
        global $conn;
        $q = "select * from manager";
        $result = mysqli_query($conn , $q);
        if(mysqli_num_rows($result) == 0){
            $q = "insert into manager (first_name , last_name , role , username , password ) values ('".$first_name."','".$last_name."','".$role."','".$username."' , '".$password."')";
            $result = mysqli_query($conn , $q) or die("error in inserting process "); 
        }else{
            $q = "update manager set first_name = '".$first_name."', last_name = '".$last_name."', role = '".$role."', username = '".$username."', password = '".$password."'";
            $result = mysqli_query($conn , $q) or die("error in updating process "); 
        }
    }

       // حفظ او تعديل بيانات موظف الإستقبال
    function save_receptionistData($receptionist_name , $receptionist_username , $receptionist_password , $receptionist_image ,$receptionist_image_tmp){
        global $conn;
        $q = "select * from receptionist";
        $result = mysqli_query($conn , $q);
        if(mysqli_num_rows($result) == 0){
            move_uploaded_file($receptionist_image_tmp,"../images/$receptionist_image");
            $q = "insert into receptionist (name , username , password , image ) values ('".$receptionist_name."','".$receptionist_username."','".$receptionist_password."','".$receptionist_image."')";
            $result = mysqli_query($conn , $q) or die("error in inserting process "); 
        }else{
            $q = "update receptionist set name = '".$receptionist_name."', username = '".$receptionist_username."', password = '".$receptionist_password."', image = '".$receptionist_image."'";
            $result = mysqli_query($conn , $q) or die("error in updating process "); 
        }
    }
    

    // دالة حذف مريض
    function delete_Patient($patient_id){
        global $conn;
        $q = "delete from patient where PID = ".$patient_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");
    }



    // حذف وقت متاح للطالب
    function delete_time($time_id){
        global $conn;
        $q = "delete from available_times where ID = ".$time_id."";
        $result = mysqli_query($conn , $q) or die("error in deleting process ");
    }
    ?>


