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
<link rel="stylesheet" href="home.css">
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

     <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="home.php" id="sized">Home</a>
       <a class="navbar-brand" href="recipe.php"  id="sized">Recipe</a>
       <a class="navbar-brand" href="adddish.php"  id="sized">Post Recipe</a>
       <a class="navbar-brand" href="profile.php"  id="sized">Profile</a>
     </nav>
  </div>
 
 <div class="imgdiv">
  <img src="images/bg1.jpg" style="overflow: hidden;width: 100%;height: 100%"  />
 </div>
 	<h5 style="text-align: center;margin-top: 20px;">Our Popular Recipes</h5>
  <div class="imgdiv1"> 

  	<?php
  	include("connect.php");
  	$result= mysqli_query($con,"SELECT * FROM `recipes` ORDER By visits desc limit 3");
  	if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {

  	 ?>
  	  <div class="indiv"><a href="making.php?id=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['id']; ?>.jpg" style="width: 100%;height: 100%" ></a><h6><?php echo $row['name']; ?></h6></div>

  	 <?php }
  	} ?>
  </div>


<?php 

include("connect.php");

}
else
{
  echo "Login to your account.";
}

?>
 


</body>
</html>