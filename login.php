<?php
$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"urexam");
session_start();
$_SESSION["username"]=$_POST["username"];
$username=$_POST["username"];
$password=$_POST["password"];
$gender=$_POST["gender"];
if($gender=='student'){
	$query="select * from user where username='$username' and password='$password'";
	$run=mysqli_query($conn,$query);
	if(mysqli_num_rows($run)==1)
	{
		echo "<script>window.open('student_home.php','_self')</script>";
	}
	else
	{
		echo"<script>alert('Incorrect Username or Password');window.open('home.html','_self');</script>";
	}

}
else{
	$query="select * from admin where username='$username' and password='$password'";
	$run=mysqli_query($conn,$query);
	if(mysqli_num_rows($run)==1)
	{
		echo "<script>window.open('admin_home.php','_self')</script>";
	}
	else
	{
		echo"<script>alert('Incorrect Username or Password');window.open('home.html','_self');</script>";
	}
}
?>