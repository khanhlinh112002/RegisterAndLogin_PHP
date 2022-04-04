<?php
session_start();
// include Function  file
include_once('function.php');
// Object creation
$usercredentials = new Users();
if(isset($_POST['signin']))
{
// Posted Values
$email=$_POST['email'];
$password=md5($_POST['password']);
//Function Calling
$signin=$usercredentials->signin($email,$password);
$num=mysqli_fetch_array($signin);
if($num>0)
{
  $_SESSION['uid']=$num['id'];
  $_SESSION['em']=$num['email'];
// For success
  echo "<script>window.location.href='welcome.php'</script>";
}
else
{
// Message for unsuccessfull login
echo "<script>alert('Invalid details. Please try again');</script>";
echo "<script>window.location.href='index.php'</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Registraion using PHP OOPs Concept</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assests/style.css" rel="stylesheet">
    <script src="assests/jquery-1.11.1.min.js"></script>
    <script src="assests/bootstrap.min.js"></script>
</head>
<body>
<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">User Signin using PHP OOPs Concept</legend>
    </div>

<div class="control-group">
       
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="email" id="email" name="email" placeholder="" class="input-xlarge" required="true">
      </div>
    </div>


    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge" required="true">
      </div>
    </div>
 

 
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success" type="submit" name="signin">Signin</button>
      </div>
    </div>

 <div class="control-group">
      <!-- Button -->
      <div class="controls">
      Not Registered yet? <a href="index.php">Register Here</a>
      </div>
    </div>

  </fieldset>
</form>
<script type="text/javascript">

</script>
</body>
</html>
