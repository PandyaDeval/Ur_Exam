<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];
    $exam = $_GET['exam'];
    $subject = $_GET['subject'];
    
    $exam_qry = "select * from exam where subject='$subject' and name='$exam'";
    $exam_qry_result = mysqli_fetch_array(mysqli_query($con, $exam_qry));
    
    $ques_qry = "select * from question where exam_id='$exam_qry_result[0]'";
    $ques_qry_result = mysqli_query($con, $ques_qry);

    
    $_SESSION['exam_id'] = $exam_qry_result[0];
    $_SESSION['marks'] = $exam_qry_result[3];

?>

<html>
    <head>
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
    <body>
        <center><?php echo "<h1>$exam_qry_result[1]</h1><br><h2>Marks: $exam_qry_result[3]<br>Time Left: <span id='timer'></span></h2>"?></center>
        <div id='test_div'>
            <form name='exam' method='POST' action = 'test_end.php'>                
            <?php 
            $count=1;
            while($row = mysqli_fetch_array($ques_qry_result)){
                $quebank_qry = "select * from question_bank where question_id='$row[1]'";
                $quebank_qry_result = mysqli_fetch_array(mysqli_query($con,$quebank_qry));
                echo "$count) $quebank_qry_result[2]<br><br>
                <input type='radio' name='que$count' value='1'>(A) $quebank_qry_result[3]</input><br>
                <input type='radio' name='que$count' value='2'>(B) $quebank_qry_result[4]</input><br>
                <input type='radio' name='que$count' value='3'>(C) $quebank_qry_result[5]</input><br>
                <input type='radio' name='que$count' value='4'>(D) $quebank_qry_result[6]</input><br><br>";
                $count++;
            }
            ?>

            <input type='submit' value='Submut Exam'></input>
            </form>
        </div>
    </body>
</html>