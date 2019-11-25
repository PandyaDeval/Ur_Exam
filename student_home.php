<?php
session_start();

$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];

    $qry = "SELECT * FROM user where username = '$username'";
    $row = mysqli_fetch_array(mysqli_query($con,$qry));

    $sub_qry = "select distinct(subject) from exam";
    $sub_qry_result = mysqli_query($con, $sub_qry);

    
?>

<html>
    <body>
        <center><h1>Welcome <?php echo $row[3];?></h1>

        <br><br>

        <?php
        while($row=mysqli_fetch_array($sub_qry_result)){
            echo "$row[0]\n";
        }
        ?>

        </center>
    </body>
</html>