<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];
    $exam = $_GET['exam'];
    $subject = $_GET['subject'];
    $qry = mysqli_fetch_array(mysqli_query($con,"select count(*) from user where username='$username'"))[0];
    if($qry==0){
    echo "<script>alert('Please login as a student');location='home.html';</script>";
    }
    
    $exam_qry = "select * from exam where subject='$subject' and name='$exam'";
    $exam_qry_result = mysqli_fetch_array(mysqli_query($con, $exam_qry));

    $user_id = mysqli_fetch_array(mysqli_query($con,"select * from user where username='$username'"))[0];
    $already_given_qry = mysqli_fetch_array(mysqli_query($con,"select count(*) from result where exam_id='$exam_qry_result[0]' and user_id='$user_id'"))[0];
    if($already_given_qry!=0){
        echo "<script>alert('You have already given this test.');window.close();</script>";
    }
    
    $ques_qry = "select * from question where exam_id='$exam_qry_result[0]'";
    $ques_qry_result = mysqli_query($con, $ques_qry);

    
    $_SESSION['exam_id'] = $exam_qry_result[0];
    $_SESSION['marks'] = $exam_qry_result[3];

?>

<html>
    <head>
        <style>
            table, td, th {  
            border: 1px solid black;
            text-align: left;
            }

            table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            padding: 15px;
            width:50%;
            }

            input[type='submit']{
            background-color: #a10000;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5mm;
            
            }
        </style>
        <script>
            var counter=<?php echo $exam_qry_result[4];?>*60;
            var sec=0;
            var xyz=setInterval(timer, 1000);
            function timer(){
                if(counter>0)
                {
                    var min=Math.floor(counter/60);
                    if(min<10&&sec<10)
                    var time="0"+min+" : 0"+sec;
                    else if(min<10)
                    var time="0"+min+" : "+sec;
                    else if(sec<10)
                    var time=min+" : 0"+sec;
                    else	
                    var time=min+" : "+sec;
                    document.getElementById("timer").innerHTML=time;
                    if(sec==0)
                    sec=59;
                    else
                    sec--;
                    counter--;
                }
                else
                {
                    window.location.href="test_end.php";
                }
            }
        </script>
    </head>
    <body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
        <center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
        <center><?php echo "<h1>$exam_qry_result[1]</h1><br><h2>Marks: $exam_qry_result[3]<br>Time Left: <span id='timer'></span></h2>"?></center>
        <div id='test_div'>
            <form name='exam' method='POST' action = 'test_end.php'>                
            <?php 
            $count=1;
            while($row = mysqli_fetch_array($ques_qry_result)){
                $quebank_qry = "select * from question_bank where question_id='$row[1]'";
                $quebank_qry_result = mysqli_fetch_array(mysqli_query($con,$quebank_qry));
                echo "<table>
                <tr><th colspan='2'>$count) $quebank_qry_result[2]</th></tr>
                <tr><td><input type='radio' name='que$count' value='1'>(A) $quebank_qry_result[3]</input></td>
                <td><input type='radio' name='que$count' value='2'>(B) $quebank_qry_result[4]</input></td></tr>
                <tr><td><input type='radio' name='que$count' value='3'>(C) $quebank_qry_result[5]</input></td>
                <td><input type='radio' name='que$count' value='4'>(D) $quebank_qry_result[6]</input></td></tr>
                </table><br>";
                $count++;
            }
            ?>

            <center><input type='submit' value='Submit Exam'></input></center>
            </form>
        </div>
    </body>
</html>