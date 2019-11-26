<?php
    session_start();
    $conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
    mysqli_select_db($conn,"urexam");
    $username=$_SESSION["username"];

    $qry = mysqli_fetch_array(mysqli_query($con,"select count(*) from admin where username='$username'"))[0];
if($qry==0){
  echo "<script>alert('Please login as an admin');location='home.html';</script>";
}

    $test_name=$_POST["test_name"];
    $sub_name=$_POST["sub_name"];
    $duration=$_POST["duration"];

    $_SESSION["test_name"]=$test_name;
    $_SESSION["sub_name"]=$sub_name;
    
    $query="INSERT INTO exam (name,subject,duration) values ('$test_name','$sub_name','$duration')";
    if(mysqli_query($conn,$query)){
        echo "<script>alert('Test Added!');location='select_question_for_test.php';</script>";
    }
    else{
        echo "<script>alert('Error!');location='add_test.html';</script>";
    }

?>
