<meta charset="utf-8">

<?php
	include("inc/connection.php");

	//حذف ملفات تعريف الإرتباط
	setcookie("user_id" , "");
	setcookie("user_name" , "");
	setcookie("user_type" , "");


	if($_COOKIE['user_type'] == 'doctor'){
		$q_c = "update doctor set is_connected = 0 where DID = ".$_COOKIE['user_id']."";
		$res_c = mysqli_query($conn , $q_c) or die('error in updatin process');

	}else 	if($_COOKIE['user_type'] == 'receptionist'){
		$q_c = "update receptionist set is_connected = 0 where RID = ".$_COOKIE['user_id']."";
		$res_c = mysqli_query($conn , $q_c) or die('error in updatin process');
	}

?>
	<!--طباعة هذا النص و يظهر لمدة 2 ثواني و بعدها ينتقل الى الصفحة الرئيسية -->
	<h2 style="text-align:center; margin-top:100px; font-size:18px; font-family:tahoma; color:green; ">  Logout successful, you are being redirected to the home page ...</h2>
	<meta http-equiv="refresh" content="2; url='index.php'" />


