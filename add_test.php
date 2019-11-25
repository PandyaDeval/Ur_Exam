<?php
    session_start();
    $conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
    mysqli_select_db($conn,"urexam");
    $username=$_SESSION["username"];

    $test_name=$_POST["test_name"];
    $sub_name=$_POST["sub_name"];
    $marks=$_POST["marks"];
    $duration=$_POST["duration"];

    $query="INSERT INTO exam (name,subject,marks,duration) values ('$test_name','$sub_name','$marks','$duration')";
    if(mysqli_query($conn,$query)){
        echo "<script>alert('Test Added!');location='select_question.php';</script>";
    }
    else{
        echo "<script>alert('Error!');location='add_test.html';</script>";
    }

?>
