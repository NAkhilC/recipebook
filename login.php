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

<body style="background-image:  linear-gradient( rgba(0,0,0,.5), rgba(0,0,0,.5) ),url('images/bg.jpg');  background-size: cover; " class="bgclass">
	<?php 
	session_start(); 
	  if(isset($_SESSION['userid'])) // If session is not set then redirect to Login Page
       {
       	 header('Location: recipe.php');
       }
 include("connect.php");
 $error="";
 if (isset($_POST['submit'])){
  $email = $_POST['uname'];
  $pass= $_POST['psw'];
  $md5al=md5($pass);
  $res = mysqli_query ($con, "SELECT * FROM user WHERE email = '$email' AND password='$md5al'");
  if(mysqli_num_rows($res)>0)
      {
      	  
      	   session_start();

// Use session variables
$_SESSION["userid"] = $email;
          header('Location: recipe.php');
      }
  else{
  	$error="Incorrect Credentianls";
  }    
 }
	 ?>
	<div class="logindiv">
		<div class="logicon"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                   <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
             </svg>
        </div>
        <form action="login.php" method="post">
        	 <label for="uname" class="inlab"><b>Username</b></label><br>
        	 <input type="text" placeholder="Enter Username" name="uname" required class="inla"><br><br>
        	 <label for="psw" class="inlab"><b>Password</b></label><br>
             <input type="password" placeholder="Enter Password" name="psw" required class="inla"><br><br>
             <div style="display: flex;"><input type="submit" class="subbtn" name="submit"/> <button type="reset" class="subbtn">Reset</button></div>
             <div style="text-align: center;"><a  href="forgot.php" class="subbtn">Forgot Password ? </a> </div>
             <div style="text-align: center;"><a href="signup.php"  class="subbtn"> Sign Up</a></div> 
             <?php echo $error; ?>          
        </form>
	</div>
</body>
</html>