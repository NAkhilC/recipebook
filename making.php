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
<body >
    <?php
    session_start();
  if(isset($_SESSION['userid'])) // If session is not set then redirect to Login Page
       { ?>
 <div> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">The Recipe Book</a>
     <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto"></ul>
        <span class="navbar-text">  Logged In as <a href="#">Akhil Nallamothu</a> </span>
        <span class="navbar-text" style="margin-left: 20px">Logout</span>
      </div>
     </nav>

     <nav class="navbar navbar-expand-lg navbar-light bg-light" >
       <a class="navbar-brand" href="home.php" id="sized">Home</a>
       <a class="navbar-brand" href="recipe.php"  id="sized">Recipe</a>
       <a class="navbar-brand" href="#"  id="sized">Post Recipe</a>
       <a class="navbar-brand" href="#"  id="sized">Profile</a>
       <a class="navbar-brand" href="#"  id="sized">Popular</a>
     </nav>
  </div>
<?php 
$id = $_GET['id'];

include("connect.php");

if(mysqli_connect_errno()){
  echo "error occured while connecting with database".mysqli_connect_errno();
}
$result= mysqli_query($con,"SELECT * FROM `recipes` WHERE id='$id'");


if ($result->num_rows > 0) {
  ?> <div class="maindiv"><?php
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $gh=$row['by_name'];
    $result1 = mysqli_query($con, "SELECT * FROM user WHERE email='$gh' LIMIT 1");
$row1 = mysqli_fetch_assoc($result1);
    ?>
     <div class="main11">
         <div class="main111"><img src="images/<?php echo $row['id']; ?>.jpg" style="width: 100%;height: 100%" ></div>
         <div class="main1111">
           <div ><h5><?php echo $row["name"]; ?> </h5>By: <?php echo $row1['firstname']; ?>  <br>Calories : <?php echo $row["calories"]; ?>  <br> &#128337 : <?php echo $row["prep_time"]; ?> Min <br> &#10084; : 220<br>Style : <?php echo $row["country"]; ?><br />Visits : <?php echo $row["visits"]; ?></div>
            <div ><br><h5> Ingredients </h5><?php echo $row["ingredients"]; ?> </div>
             <div ><br><h5> Process </h5> <?php echo $row["description"]; ?></div>
             <?php
                $vist_c=$row["visits"]; 
                $vist_c=$vist_c+1;
                $upid=$row["id"];
                mysqli_query($con, "UPDATE `recipes` SET `visits`='$vist_c' WHERE id = '$upid'");
              ?>
         </div>     
     </div>

    <?php
  }

  ?></div><?php
} else {
  echo "No results";
}
}else
{
  echo "Login to your account.";
}

?>
 


</body>
</html>