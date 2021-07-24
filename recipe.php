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
	<link rel="stylesheet" href="mystyle1.css">
</head>
<body >
  <?php
    session_start();
  if(isset($_SESSION['userid'])) // If session is not set then redirect to Login Page
       { $usere=$_SESSION['userid'];?>
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
         <form action="recipe.php" method="GET">
	       <input type="text" name="query" />
	       <input type="submit" value="Search" />
         </form>
      </div>
     </nav>

  </div>


  <?php

     
 

#https://www.w3schools.com/php/func_mysqli_connect.asp
include("connect.php");

if(mysqli_connect_errno()){
  echo "error occured while connecting with database".mysqli_connect_errno();
}
if(isset($_GET['query']))
{
	$que=$_GET['query'];
 $result= mysqli_query($con,"SELECT * FROM `recipes` WHERE name LIKE '%$que%'");
}
else
{

	$result= mysqli_query($con,"SELECT * FROM `recipes` ");
}


if ($result->num_rows > 0) {

	?> <div class="maindiv"><br><?php
  // output data of each row
  while($row = $result->fetch_assoc()) {
  	$gh=$row['by_name'];
    $result1 = mysqli_query($con, "SELECT * FROM user WHERE email='$gh' LIMIT 1");
    $row1 = mysqli_fetch_assoc($result1);
  	?>
    <div class="first1">
  	   	 <div class="first2"><a href="making.php?id=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['id']; ?>.jpg" style="width: 100%" ></a></div>
  	   	 <div class="first3"><h5><?php echo $row["name"]; ?></h5><h6><?php echo $row1["firstname"]; ?></h6>Visits :  <?php echo $row["visits"]; ?> <span style="font-size:20px;padding: 10px;">l</span> &#128337 : <?php echo $row["prep_time"]; ?> Min <br> 
  	   	 Calories: <?php echo $row["calories"]; ?></div>
    </div>
  	<?php
  }

  ?></div><?php
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