<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
    die("Could not select database.");

    $username = $_SESSION['username'];
    $user_id = $_GET['id'];

    $delete_from_result_qry = "delete from result where user_id = '$user_id'";
    $delete_from_user_qry = "delete from user where user_id = '$user_id'";

    if( mysqli_query($con,$delete_from_result_qry) && mysqli_query($con,$delete_from_user_qry) ){
        echo "<script>alert('USER DELETED!');location='admin_home.php'; </script>";
    }
    else{
        echo "<script>alert('USER NOT DELETED!');location='admin_home.php'; </script>";
    }

?>