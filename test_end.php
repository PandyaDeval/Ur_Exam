<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

$username = $_SESSION['username'];
$exam_id = $_SESSION['exam_id'];
$marks = $_SESSION['marks'];

$count = "select count(*) from question where exam_id='$exam_id'";
$count = mysqli_fetch_array(mysqli_query($con,$count));

$que_mark = (float)$marks/(float)$count[0];

$exam_qry = mysqli_query($con,"select * from question where exam_id='$exam_id'");

$user_marks=0;

$x=1;
while($que=mysqli_fetch_array($exam_qry)){
    
    $quebank_qry = "select * from question_bank where question_id='$que[1]'";
    $quebank_qry_result = mysqli_fetch_array(mysqli_query($con,$quebank_qry));

    $qid = "que$x";
    $user_ans = $_POST[$qid];
    $correct_ans = $quebank_qry_result[7];
    
    echo "user ans: $user_ans<br> correct ans: $correct_ans<br><br>";

    if($user_ans==$correct_ans){
        $user_marks += $que_mark;
    }
    $x++;
}

echo "Marks obtained: $user_marks<br>Total Marks: $marks<br><br> <button onclick='location=\"student_home.php\"'>Back to Home</button>";

$qry = "select * from user where username='$username'";
$user_id = mysqli_fetch_array(mysqli_query($con,$qry))[0];

$insert_result=mysqli_query($con,"insert into `result`(`user_id`,`exam_id`,`user_marks`,`total_marks`) values('$user_id','$exam_id','$user_marks','$marks')");

?>