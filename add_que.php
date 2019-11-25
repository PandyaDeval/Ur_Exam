<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
    die("Could not select database.");
    
    $username = $_SESSION['username'];
    
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $answer = $_POST['answer'];
    $subject = $_POST['subject'];

    $add_que_qry = "insert into `question_bank` (subject,question,op_1,op_2,op_3,op_4,answer) values('$subject','$question','$opt1','$opt2','$opt3','$opt4','$answer')";
    if(mysqli_query($con,$add_que_qry)){
        echo "<script>alert('QUESTION ADDED!');location = 'admin_home.php';</script>";
    }
    else {
        echo $add_que_qry;
        echo "<script>alert('INSERTION FAILED!');location = 'admin_home.php';</script>";
    }

?>