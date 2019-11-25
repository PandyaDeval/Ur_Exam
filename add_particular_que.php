<?php
session_start();
$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"urexam");
$username=$_SESSION["username"];
$examid=$_SESSION["examid"];
$qid=$_GET["q"];
$_SESSION["TOTAL_MARKS"]=$_SESSION["TOTAL_MARKS"]+1;
echo "SELECTED QUES : ".$_SESSION['TOTAL_MARKS'];
$query="INSERT INTO question (exam_id,question_id) values('$examid','$qid')";
mysqli_query($conn,$query);

?>