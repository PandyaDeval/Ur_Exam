<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $update_qry = "update `user` set email='$email', name='$name', password='$password' where username='$username'";
    if( mysqli_query( $con,$update_qry ) ){
        echo "<script>alert('PROFILE UPDATED!');location = 'student_home.php';</script>";
    }
    else {
        echo "<script>alert('PROFILE NOT UPDATED!');location = 'student_home.php';</script>";
    }

?>