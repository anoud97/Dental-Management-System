

<?php
include("../inc/connection.php");
include("../inc/functions.php");
?>

<?php 

    if(isset($_GET['get_admins_table'])){
        $q = "select * from admin";
        $res = mysqli_query($conn , $q);
        while($row = mysqli_fetch_array($res))
        {
            echo'
                <tr>
                <td>'.$row['AID'].'</td>
                <td>'.$row['admin_name'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['e_mail'].'</td>
                <td style="padding: 8px;width: 126px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle operation_dropdown" data-toggle="dropdown" aria-expanded="false" type="button">operation</button>
                        <div class="dropdown-menu" role="menu" style="padding: 5px;">
                            <a name="deleteAdmin" class="dropdown-item" role="presentation" href="javascript:delete_confirm(' . $row['AID'] . ')" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">delete</a>
                            <a name="updateAdmin" class="dropdown-item" role="presentation"  style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;" onClick="admin_form_fill('.$row['AID'].',\''.$row['admin_name'].'\',\''.$row['e_mail'].'\',\''.$row['username'].'\',\''.$row['password'].'\'); document.getElementById(\'update_btn\').style.display=\'inline\'; document.getElementById(\'add_btn\').style.display=\'none\';">update</a>
                        </div>
                    </div>
                </td>
            </tr>
            ';
        }
    }


    
    if(isset($_GET['add_admin'])){
        $q = "insert into admin (admin_name , e_mail , username , password) values ('".$_GET['admin_name']."','".$_GET['admin_email']."','".$_GET['admin_username']."','".$_GET['admin_password']."')";
        $result = mysqli_query($conn , $q) or die("error in inserting process ");   
} 

    if(isset($_GET['update_admin'])){
        $q = "update admin set admin_name = '".$_GET['admin_name']."', e_mail = '".$_GET['admin_email']."', username = '".$_GET['admin_username']."' , password = '".$_GET['admin_password']."' where AID = '".$_GET['admin_id']."'";
        $result = mysqli_query($conn , $q) or die("error in updating process ");    
}  







    if(isset($_GET['get_receptionist_table'])){
        $q = "select * from receptionist";
        $res = mysqli_query($conn , $q);
        while($row = mysqli_fetch_array($res))
        {
            echo'
                <tr>
                <td>'.$row['RID'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['username'].'</td>
                <td style="padding: 8px;width: 126px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle operation_dropdown" data-toggle="dropdown" aria-expanded="false" type="button">operation</button>
                        <div class="dropdown-menu" role="menu" style="padding: 5px;">
                            <a name="deleteReceptionist" class="dropdown-item" role="presentation" href="javascript:delete_confirm(' . $row['RID'] . ');" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">delete</a>
                            <a name="updateReceptionist" class="dropdown-item" role="presentation"  style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;" onClick="receptionist_form_fill('.$row['RID'].',\''.$row['name'].'\',\''.$row['username'].'\',\''.$row['password'].'\'); document.getElementById(\'update_btn\').style.display=\'inline\'; document.getElementById(\'add_btn\').style.display=\'none\';">update</a>
                        </div>
                    </div>
                </td>
            </tr>
            ';
        }
    }


    if(isset($_GET['add_receptionist'])){
        $q = "insert into receptionist (name  , username , password) values ('".$_GET['receptionist_name']."','".$_GET['receptionist_username']."','".$_GET['receptionist_password']."')";
        $result = mysqli_query($conn , $q) or die("error in inserting process ");   
        echo "ok";
} 

    if(isset($_GET['update_receptionist'])){
        $q = "update receptionist set name = '".$_GET['receptionist_name']."', username = '".$_GET['receptionist_username']."' , password = '".$_GET['receptionist_password']."' where RID = '".$_GET['receptionist_id']."'";
        $result = mysqli_query($conn , $q) or die("error in updating process ");    
}  







    if(isset($_GET['get_doctors_table'])){
        $q = "select * from doctor";
        $res = mysqli_query($conn , $q);
        while($row = mysqli_fetch_array($res))
        {
            echo'
                <tr>
                <td>'.$row['DID'].'</td>
                <td>'.$row['first_name'].'   '.$row['last_name'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['e_mail'].'</td>
                <td style="padding: 8px;width: 126px;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle operation_dropdown" data-toggle="dropdown" aria-expanded="false" type="button">operation</button>
                    <div class="dropdown-menu" role="menu" style="padding: 5px;">
                        <a name="deleteDoctor" class="dropdown-item" role="presentation" href="javascript:delete_confirm('.$row['DID'].')" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">delete</a>
                        <a name="updateDoctor" class="dropdown-item" onClick="doctor_form_fill('.$row['DID'].',\''.$row['first_name'].'\', \''.$row['last_name'].'\',\''.$row['username'].'\',\''.$row['password'].'\',\''.$row['phone'].'\',\''.$row['e_mail'].'\', \''.$row['image'].'\'); document.getElementById(\'update_btn\').style.display=\'inline\'; document.getElementById(\'add_btn\').style.display=\'none\';" role="presentation" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">update</a>
                    </div>
                </div>
                </td>
            </tr>
            ';
        }    
    }






    if(isset($_GET['get_students_table'])){
        $q = "select * from student";
        $res = mysqli_query($conn , $q);
        while($row = mysqli_fetch_array($res))
        {
            echo'
                <tr>
                <td>'.$row['SID'].'</td>
                <td>'.$row['first_name'].'   '.$row['last_name'].'</td>
                <td>'.$row['level'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['e_mail'].'</td>
                <td style="padding: 8px;width: 126px;">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle operation_dropdown" data-toggle="dropdown" aria-expanded="false" type="button">operation</button>
                    <div class="dropdown-menu" role="menu" style="padding: 5px;">
                        <a name="deleteStudent" class="dropdown-item" role="presentation" href="javascript:delete_confirm('.$row['SID'].');" style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">delete</a>
                        <a name="updateStudent" onClick="student_form_fill('.$row['SID'].',\''.$row['first_name'].'\', \''.$row['last_name'].'\',\''.$row['username'].'\',\''.$row['e_mail'].'\',\''.$row['password'].'\',\''.$row['phone'].'\', \''.$row['level'].'\' , \''.$row['is_excellent'].'\'); document.getElementById(\'update_btn\').style.display=\'inline\'; document.getElementById(\'add_btn\').style.display=\'none\';" class="dropdown-item" role="presentation"  style="padding: 0px;padding-left: 24px;border-bottom: 1px solid #eee;font-size: 14px;width: 100%;">update</a>
                    </div>                                                 
                </div>
                </td>
            </tr>
            ';
        }
    }



    if(isset($_GET['add_student'])){

        $q = "insert into student (first_name , last_name , username , e_mail , password , phone , level , is_excellent) values ('".$_GET['firstName']."','".$_GET['lastName']."','".$_GET['username']."','".$_GET['email']."' , '".$_GET['password']."' , '".$_GET['phone']."' , '".$_GET['level']."' , ".$_GET['is_excellent'].")";
        $result = mysqli_query($conn , $q) or die("error in inserting process ");   
    } 



    if(isset($_GET['update_student'])){ 
        $q = "update student set  first_name = '".$_GET['firstName']."', last_name = '".$_GET['lastName']."' , username = '".$_GET['username']."' , e_mail = '".$_GET['email']."' , password = '".$_GET['password']."' , phone = '".$_GET['phone']."' , level = '".$_GET['level']."', is_excellent = ".$_GET['is_excellent']."  where SID = ".$_GET['student_id']."";
        $result = mysqli_query($conn , $q) or die("error in updating process ");   
    }  




?>



