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
	<link rel="stylesheet" href="styles1.css">
</head>
<body >
  <?php
    session_start();
  if(isset($_SESSION['userid'])) // If session is not set then redirect to Login Page
       { $usere= $_SESSION['userid'];?>
 <div> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"  href="home.php">The Recipe Book</a>
     <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto"></ul>
        <span class="navbar-text">  Logged In as <a href="#"><?php echo $usere; ?></a> </span>
        <span class="navbar-text" style="margin-left: 20px"><a href="logout.php">Logout</a></span>
      </div>
     </nav>

     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php" id="sized">Home</a>
       <a class="navbar-brand" href="recipe.php"  id="sized">Recipe</a>
       <a class="navbar-brand" href="adddish.php"  id="sized">Post Recipe</a>
       <a class="navbar-brand" href="profile.php"  id="sized">Profile</a>
     <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto"></ul>
      </div>
     </nav>

  </div>


  <?php

     
 

#https://www.w3schools.com/php/func_mysqli_connect.asp
include("connect.php");

if(mysqli_connect_errno()){
  echo "error occured while connecting with database".mysqli_connect_errno();
}

if (isset($_GET['delete'])) {
   $id = $_GET['id'];
    $result = mysqli_query ($con, "DELETE FROM `recipes` WHERE id='$id'");
         if($result)
         {
           $error=" You Deleted the item.";
         }
         else
         {
           $error="problem in deletion";
         }

  }

$error="";
if (isset($_POST['submit'])){
  $fname=  $_POST['fname'];
  $lname=  $_POST['lname'];
  $password=  $_POST['pass'];
  $cpassword=  $_POST['cpass'];
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
         $result = mysqli_query ($con, "UPDATE `user` SET `firstname`='$fname',`lastname`='$lname',`password`='$pass' WHERE email='$usere'");
         if($result)
         {
           $error=" Update is successfull";
         }
         else
         {
           $error="problem in Update";
         }
     
   }
}

$result= mysqli_query($con,"SELECT * FROM `user` where email='$usere'");
  
if ($result->num_rows > 0) {
  ?> <div class="cdis"><div style="width: 300px; margin-left: 20px;"><?php
  // output data of each row
  while($row = $result->fetch_assoc()) {
    ?>
    <div class="first11">
       <form action="profile.php" method="POST" enctype="multipart/form-data"><br>
        <input type="text" name="fname" value=<?php echo $row["firstname"]; ?> required class="form-control"><br>
        <input type="text" name="lname" value=<?php echo $row["lastname"]; ?> required class="form-control"><br>
        <input type="text" name="email" value=<?php echo $row["email"]; ?> disabled class="form-control"><br>
        <input type="password" name="pass" placeholder="Password"  required class="form-control"><br>
        <input type="password" name="cpass" placeholder="Confirm Password"  required class="form-control"><br>
        <div style="display: flex; margin-left: 10%"> <input type="submit" class="btn btn-success" id="btn" name="submit"/><button style="margin-left: 20px;" type="reset" class="btn btn-primary">Reset</button></div>  
        <h5 class="diserr"><?php echo $error; ?></h5>
     </form>
   </div>
    <?php
  }

  ?></div>
  <?php
   $result= mysqli_query($con,"SELECT * FROM `recipes` WHERE by_name='$usere'");
   if ($result->num_rows > 0) {
  ?> <div class="maindiv"> <h5 style="text-align: center;margin-top: 20px;">Your Posts</h5><?php
  // output data of each row 

  while($row = $result->fetch_assoc()) {
    ?>
   <div style="margin-left: 100px" class="nextid">
   
    <div class="div11" ><div class="next11"><img src="images/<?php echo $row['id']; ?>.jpg" style="width: 100%; height: 100%" /></div><div class="nextid1"><?php echo $row['name']; ?><br><?php echo $row['timestamp']; ?></div><div><a href="making.php?id=<?php echo $row['id']; ?>">View</a><a style="margin-left: 10px;" href="editpost.php?id=<?php echo $row['id']; ?>">Edit</a><a style="margin-left: 10px;" onClick='alert("Do you want to delete  ??")' href="profile.php?delete=true&id=<?php echo $row['id']; ?>">Delete</a></div></div> 
  </div>
    <?php
  }

  ?></div><?php
} else{
  ?>  <h5 class="diserr1"><?php echo "You dont have any posts to show"; ?><a href="adddish.php"> Click </a> to start posting</h5><?php
   
} ?>

</div>
  <?php
} else {
  echo "No results";
}

}
else
{
	echo "Login to your account";
    ?><a href="login.php">  Click here</a><?php
}

?>
<?php ?>

</body>
</html>