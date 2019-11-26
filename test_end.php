<html>
    <head>
        <style>
            table, td, th {  
            border: 1px solid black;
            text-align: center;
            }

            table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            padding: 15px;
            width:33.33%;
            }
            button {
                background-color: #a10000;
                color: white;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                border-radius: 5mm;
                
            }
        </style>
    </head>
    <body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
        <center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

$username = $_SESSION['username'];
$exam_id = $_SESSION['exam_id'];
$marks = $_SESSION['marks'];

$qry = mysqli_fetch_array(mysqli_query($con,"select count(*) from user where username='$username'"))[0];
    if($qry==0){
    echo "<script>alert('Please login as a student');location='home.html';</script>";
    }

$count = "select count(*) from question where exam_id='$exam_id'";
$count = mysqli_fetch_array(mysqli_query($con,$count));

$que_mark = (float)$marks/(float)$count[0];

$exam_qry = mysqli_query($con,"select * from question where exam_id='$exam_id'");

$user_marks=0;
echo "<table>
    <tr><th>Question No.</th><th>Correct Answer</th><th>Your Answer</th></tr>";
$x=1;
while($que=mysqli_fetch_array($exam_qry)){
    
    $quebank_qry = "select * from question_bank where question_id='$que[1]'";
    $quebank_qry_result = mysqli_fetch_array(mysqli_query($con,$quebank_qry));

    $qid = "que$x";
    @$user_ans = $_POST[$qid];
    $correct_ans = $quebank_qry_result[7];
    
    echo "<tr><td>$x</td><td>$user_ans</td><td>$correct_ans</td></tr>";

    if($user_ans==$correct_ans){
        $user_marks += $que_mark;
    }
    $x++;
}
echo "</table><br><br>";

echo "<center><span style='font-size:150%;font-weight:bold;'>Marks obtained: $user_marks out of $marks</span><br><br> <button onclick='location=\"student_home.php\"'>Back to Home</button></center>";

$qry = "select * from user where username='$username'";
$user_id = mysqli_fetch_array(mysqli_query($con,$qry))[0];

$insert_result=mysqli_query($con,"insert into `result`(`user_id`,`exam_id`,`user_marks`,`total_marks`) values('$user_id','$exam_id','$user_marks','$marks')");

?>


    </body>
</html>