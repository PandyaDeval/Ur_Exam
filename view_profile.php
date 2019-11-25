<body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
<center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>

<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
    die("Could not select database.");

    $username = $_SESSION['username'];
    echo "LOGGED IN : $username";

    $user_id = $_GET['id'];
    
    $user_info_qry = "select * from user where user_id = '$user_id'";
    $user_info_run = mysqli_query($con,$user_info_qry);
    $user_info_row = mysqli_fetch_array($user_info_run);

    echo "<center><b>USER INFORMATION</b><br><br>";
    
    //general information
    echo "NAME : $user_info_row[3]<br><br>USERNAME : $user_info_row[1]<br><br>PASSWORD : $user_info_row[2]<br><br>EMAIL : $user_info_row[4]<br><br><br>";

    //test results
    echo "<b>TEST STATISTICS</b><br><br>";
    $overall_user_marks = 0;
    $overall_test_marks = 0;
    $user_tests_qry = "select * from result where user_id = '$user_id'";
    $user_tests_run = mysqli_query($con,$user_tests_qry);
    $deb = mysqli_num_rows($user_tests_run);
    echo "<table border = '1px solid black'>";
    echo "<tr> <td>TEST NAME</td>   <td>SUBJECT</td>    <td>MARKS</td>  <td>FROM</td> </tr>";
    while( $user_tests_row = mysqli_fetch_array( $user_tests_run ) ){
        
        $test_name_qry = "select * from exam where exam_id = '$user_tests_row[1]'";
        $test_name_run = mysqli_query($con,$test_name_qry);
        $test_name_row = mysqli_fetch_array($test_name_run);
        $exam_name = $test_name_row[1];
        $exam_subject = $test_name_row[2];
        $marks_got = $user_tests_row[3];
        $marks_tot = $user_tests_row[4];

        $overall_test_marks += $marks_tot;
        $overall_user_marks += $marks_got;
        
        echo "<tr>";
        echo "<td>$exam_name</td>   <td>$exam_subject</td>  <td>$marks_got</td>     <td>$marks_tot</td>";
        echo "</tr>";  

    }
    if( mysqli_num_rows($user_tests_run) > 0 ){
        echo "<tr> <td colspan='2'>TOTAL</td>   <td>$overall_user_marks</td>    <td>$overall_test_marks</td> </tr>";
    }
    else{
        echo "$user_info_row[3] HASN'T GIVEN ANY TEST YET";
    }
    echo "</table>";

    echo "</center>";
?>
</body>