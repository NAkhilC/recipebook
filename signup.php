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
$error="no error";
if (isset($_POST['submit'])){
  $firstName = $_POST['fname'];
  $lastName = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['psw'];
   $cpassword = $_POST['cpsw'];

   if(strlen($firstName)< 4)
   {
     $error = "Firstname is short";
   }
   else if(strlen($lastName)< 4)
   {
    $error = "Lastname is short";
   }
   else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error="Enter valid email";
   }
   else if (strlen($password) < 5){
  $error = "Passwrod must be greater than five characters";
    }
   else if ($password !== $cpassword){
    $error = "Password dose not match!";
    }
    else
    {
      $qemails = mysqli_query ($con, "SELECT * FROM user WHERE email = '$email'");
      if(mysqli_num_rows($qemails)>0)
      {
          $error = "User is alreday registered";
      }
      else
      {
        $pass=md5($password);
         $result = mysqli_query ($con, "INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$pass')");
         if($result)
         {
           $error="successfull";
         }
         else
         {
           $error="problem in registration";
         }
      }
    }
  
  }
?>
<body style="background-image:  linear-gradient( rgba(0,0,0,.5), rgba(0,0,0,.5) ),url('images/bg.jpg');  background-size: cover; " class="bgclass">
	<div class="logindiv1">
        <form action="signup.php" method="post"><br>
            <h5 style="text-align: center;">Register with us!</h5>         
        	    <input type="text" placeholder="First Name" name="fname" required class="inla"><br><br>
              <input type="text" placeholder="Last Name" name="lname" required class="inla"><br><br>
              <input type="Email" placeholder="Email" name="email" required class="inla"><br><br>
             <input type="password" placeholder="Enter Password" name="psw" required class="inla"><br><br>
              <input type="password" placeholder="Confirm Password" name="cpsw" required class="inla"><br><br>
             <div style="display: flex;"> <input type="submit" class="subbtn" name="submit"/><button type="reset" class="subbtn">Reset</button></div>
             <div style="text-align: center;"><a  href="login.php" class="subbtn">Login</a> </div>    
             <?php echo $error; ?>
        </form>
	</div>
</body>
</html>