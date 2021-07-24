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
  if( $_POST['email'])
  {
   $email = $_POST['email'];
  
  $result= mysqli_query($con,"SELECT * FROM `user` where email='$email'");
  
if ($result->num_rows > 0) {
   $to      = $email;
   $r= rand(100000,999999);
$subject = 'One Time Password';
$message='This is one time password. Do not share with any one.'.$r;
$headers = 'From: carrentalve@gmail.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
date_default_timezone_set("America/New_York");
$date=date ("F, d, Y")." ".date("h:i:sa");
$result = mysqli_query ($con, "INSERT INTO `otp`( `userid`, `otp`, `timestamp`) VALUES ('$email','$r','$date')");
         if($result)
         {
           mail($to, $subject, $message, $headers);
          header("Location: confirm.php?email=$email");
         }
         else
         {
           $error="problem in sending email";
         }

}
else
{
  $error="User does not exist";
}
 

  

}
}
?>
<body style="background-image:  linear-gradient( rgba(0,0,0,.5), rgba(0,0,0,.5) ),url('images/bg.jpg');  background-size: cover; " class="bgclass">
	<div class="logindiv1">
        <form action="forgot.php" method="POST"><br>
            <h5 style="text-align: center;">Enter email</h5>         
              <input type="Email" placeholder="Email" name="email" required class="inla"><br><br>
             <div style="display: flex;"> <input type="submit" class="subbtn" name="submit" /><button type="reset" class="subbtn">Reset</button></div>
             <div style="text-align: center;"><a  href="login.php" class="subbtn">Login</a> </div>    
             <?php echo $error; ?>
        </form>
	</div>
</body>
</html>