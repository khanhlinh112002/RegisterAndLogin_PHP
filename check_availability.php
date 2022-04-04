<?php
// include Function  file
include_once('function.php');
// Object creation (tạo đối tượng)
//uusername change user
$user = new Users();
// Getting Post value (nhận giá trị từ post)
$email= $_POST["email"];	
// Calling function (gọi function)
$sql=$user->emailavailblty($email);
$num=mysqli_num_rows($sql);
if($num > 0)
{
	echo "<span style='color:red'> Email already associated with another account .</span>";
 	echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
	
	echo "<span style='color:green'> Email available for Registration .</span>";
 	echo "<script>$('#submit').prop('disabled',false);</script>";
}