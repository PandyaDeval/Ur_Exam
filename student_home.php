<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];

    $qry = "SELECT * FROM user where username = '$username'";
    $row = mysqli_fetch_array(mysqli_query($con,$qry));

    $sub_qry = "select distinct(subject) from question_bank";
    $sub_qry_result = mysqli_query($con, $sub_qry);

    $exam_qry = "select * from exam";
    $exam_qry_result = mysqli_query($con,$exam_qry);

    
?>

<html>
    <head>
        <script>
            function sub_select(){
                var subject = document.getElementById("sub_select").value;
                if(subject != "blank"){
                    document.getElementById("select_div").html += ""
                }
            }
        </script>
    </head>
    <body>
        <center><h1>Welcome <?php echo $row[3];?></h1>

        <br><br>

        <div id="select_div">
            Select Subject:
            <select onchange = "sub_select()" id="sub_select">
                <option value='blank'>Select Subject</option>
            <?php
            while($row=mysqli_fetch_array($sub_qry_result)){
                echo "<option value='$row[0]'>$row[0]</option>";
            }
            ?>
            </select>
        </div>


        </center>
    </body>
</html>