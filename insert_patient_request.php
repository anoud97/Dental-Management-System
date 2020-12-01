
<?php

error_reporting(0);

$conn_db2 = mysqli_connect("localhost","root","","patients_request_db");

if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error();
}


include("inc/functions.php");
?>

<?php


if(isset($_POST['first_name'])){

    $image = $_FILES['patient_image']['name'];
    $image_tmp = $_FILES['patient_image']['tmp_name'];

    date_default_timezone_set('Asia/Riyadh');

    move_uploaded_file($image_tmp,"images/patients/".$image."");
    $q = "insert into patient_request (PID , first_name, last_name , address, phone, username, e_mail, password, image ,  date_of_birth, gender  , problem_description , accepted , timestamp) values ( '".$_POST['PID']."' , '".$_POST['first_name']."','".$_POST['last_name']."'  , '".$_POST['address']."','".$_POST['phone']."' , '".$_POST['username']."' , '".$_POST['e_mail']."' , '".$_POST['patient_password']."' , '". $image ."' , '".$_POST['date_of_birth']."' , '".$_POST['gender']."'  , '".$_POST['problem_description']."' , 0 , '".time()."')";
    
    $result = mysqli_query($conn_db2 , $q) or die(mysqli_error($conn_db2));   
    

    echo "تم إرسال طلبك بنجاح";

} 

?>