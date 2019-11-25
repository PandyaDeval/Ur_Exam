<?php
	session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

	$username = $_SESSION['username'];
	//comment

	$admin_profile_query = "select * from admin where username = '$username'";
	$admin_profile_run=mysqli_query($con,$admin_profile_query);
	$admin_profile_row = mysqli_fetch_array($admin_profile_run);

	$name = $admin_profile_row['name'];
	$email = $admin_profile_row['email'];

	echo "<center>";

	echo "WELCOME ADMIN - $username     <br><br>";
	echo "$name<br><br>$email<br><br>     ";
	echo "<a href = ' add_que.php '>ADD QUESTION</a>     ";
	echo "<a href = ' test_adding.php '>ADD TEST</a>     ";
	echo "<a href = ' see_user.php '>MANIPULATE USER</a>     ";
	

	echo "</center>"

?>