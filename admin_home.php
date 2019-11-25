<style>
a:link, a:visited {
  background-color: #a10000;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 5mm;
  width: 400px;
}

a:hover, a:active {
  background-color: #a10000;
}
</style>
<?php
session_start();
$con=mysqli_connect("localhost","root","")or
die("Could not connect.");
	mysqli_select_db($con,"urexam")or
die("Could not select database.");

$username = $_SESSION['username'];

$admin_profile_query = "select * from admin where username = '$username'";
$admin_profile_run=mysqli_query($con,$admin_profile_query);
$admin_profile_row = mysqli_fetch_array($admin_profile_run);

$name = $admin_profile_row['name'];
$email = $admin_profile_row['email'];
?>

<body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
<center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
<div style="display:flex">
<div style="padding-left:300;padding-top:150;text-decoration: none;">
	<?php
echo "<center>";

	echo "<h2>Welcome Admin : $username</h2><br><br>";
	echo "<text style='font-size: 1.25em;'>Name : $name<br><br>E-mail : $email</text><br><br>     ";
	?>
</div>
<div style="padding-left:300;padding-top:150;">
<?php
	
	echo "<a href = ' add_que.html '>ADD QUESTION</a> <br><br>    ";
	echo "<a href = ' test_adding.php '>ADD TEST</a>    <br><br> ";
	echo "<a href = ' see_user.php '>USER PROFILE</a>     ";
	

	echo "</center>"

?>
</div>
</div>
</body>