<?php
session_start();
$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"urexam");
$examid=$_SESSION["examid"];
$marks=$_SESSION["TOTAL_MARKS"];
$query="UPDATE exam SET marks='$marks' WHERE exam_id='$examid'";
if(mysqli_query($conn,$query)){
    echo "<script>alert('Question Added Successfully');location='admin_home.php';</script>";
}
?>