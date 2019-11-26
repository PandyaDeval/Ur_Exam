<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];
    $subject = $_GET['s'];

    $qry = mysqli_fetch_array(mysqli_query($con,"select count(*) from user where username='$username'"))[0];
    if($qry==0){
    echo "<script>alert('Please login as a student');location='home.html';</script>";
    }
$qry = "select * from exam where subject = '$subject'";
$qry_result = mysqli_query($con,$qry);

echo "<select id='select_exam'>";
while($row = mysqli_fetch_array($qry_result)){
    echo "<option value='$row[1]'>$row[1]</option>";
}
echo "</select>
<br><br><br>
<button onclick='start_exam()'>Start Exam</button>";
?>