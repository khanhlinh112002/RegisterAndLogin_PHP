<?php
// include Function  file
include_once('function.php');
// Object creation
$userdata = new Users();
if(isset($_POST['submit']))
{
// Posted Values
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
//Function Calling
$check = $userdata->check_pass($password,$cpassword);
if ($check){
  $finish = $userdata->registration($username,$email,$password,$cpassword);
  
  if($finish)
  {
    $userdata->processSendEmail($email);
    // Message for successfull insertion (Message thành công thêm dữ liệu)
    echo "<script>alert('Registration successfull.');</script>";
    echo "<script>window.location.href='signin.php'</script>";
  
  }
  else
  {
    // Message for unsuccessfull insertion (Message không thành công thêm dữ liệu)
    echo "<script>alert('Something went wrong. Please try again');</script>";
    echo "<script>window.location.href='index.php'</script>";
  }
}else
{
  // Message for unsuccessfull insertion (Message không thành công thêm dữ liệu)
  echo "<script>alert('Something went wrong. Please try again');</script>";
  echo "<script>window.location.href='index.php'</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Registration using PHP OOPs Concept</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assests/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href=".styles.css" rel='stylesheet'>
    <script src="assests/jquery-1.11.1.min.js"></script>
    <script src="assests/bootstrap.min.js"></script>
 <script>
function checkemail(va) {
  $.ajax({
  type: "POST",
  url: "check_availability.php",
  data:'email='+va,
  success: function(data){
  $("#emailavailblty").html(data);
  }
  });
};
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('cpassword').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password matched';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = "Password didn't match";
  }
}
</script>
</head>
<body>
<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend" align="center">
      <legend class="">Đăng ký để đăng xuất khỏi trái đất</legend>
    </div>

    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
<input type="text" id="username" name="username"  class="input-xlarge" required="true">
          
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="email" id="email" name="email" onblur="checkemail(this.value)" placeholder="" class="input-xlarge" required="true">
        <span id="emailavailblty"></span>
      </div>
    </div>
    
   
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" onkeyup='check();'name="password" placeholder="" class="input-xlarge" required="true">
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Confirm Password</label>
      <div class="controls">
      <input type="password" placeholder="Confirm Password" onkeyup='check();' id="cpassword" name="cpassword"  class="input-xlarge" required="true">
      <span id="message"></span>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" type="submit" id="submit" name="submit">Register</button>
      </div>
    </div>
    

 <div class="control-group">
      <div class="controls">
       Already registered <a href="signin.php">Signin</a>
      </div>
    </div>

  </fieldset>
</form>
<script type="text/javascript">
</script>
</body>
</html>
