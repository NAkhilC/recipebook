<!DOCTYPE html>
<html>
<head>
	<title>Recipe page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
		#sized
		{
		 font-size: 15px;
		}
	</style>
<link rel="stylesheet" href="recp.css">
</head>

<?php


include("connect.php");
$error="";
if (isset($_POST['submit'])){
   $otp = $_POST['otp'];
   $password = $_POST['pass'];
   $cpassword = $_POST['cpass'];
   $email = $_GET['email'];
  $result= mysqli_query($con,"SELECT otp FROM `otp` where userid='$email' ORDER BY timestamp desc limit 1");
  if(strlen($password)< 5)
   {
     $error = "password is short";
   }
   else if(strcmp($password, $cpassword) !== 0)
   {
     $error="Password Dosent match";
   }
   else{
    $pass=md5($password);
        if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
       if(strcmp($row['otp'], $otp) !== 0)
       {
         $error="OTP is incorrect";
       }
       else{

            $result1 = mysqli_query ($con, "UPDATE `user` SET `password`='$pass' WHERE email='$email'");
         if($result1)
         {
           $error="password Changed successfully";
         }
         else
         {
           $error="problem in Update";
         }

       }
    }
   }
     
  }



}
?>
<body style="background-image:  linear-gradient( rgba(0,0,0,.5), rgba(0,0,0,.5) ),url('images/bg.jpg');  background-size: cover; " class="bgclass">
	<div class="logindiv1">
        <form action="" method="POST"><br>
            <h5 style="text-align: center;">Enter email</h5>         
              <input type="text" placeholder="Otp" name="otp" required class="inla"><br><br>
              <input type="password" placeholder="Password" name="pass" required class="inla"><br><br>
              <input type="password" placeholder="Confirm Password" name="cpass" required class="inla"><br><br>
             <div style="display: flex;"> <input type="submit" class="subbtn" name="submit" /><button type="reset" class="subbtn">Reset</button></div>
             <div style="text-align: center;"><a  href="login.php" class="subbtn">Login</a> </div>    
             <?php echo $error; ?>
        </form>
	</div>
</body>
</html>