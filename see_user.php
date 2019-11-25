<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
    die("Could not select database.");

    $username = $_SESSION['username'];
    $user_qry = "select * from user";
    $user_qry_run = mysqli_query($con,$user_qry);
    echo "LOGGED IN : <a href = 'admin_home.php'>$username </a> ";
    echo "<center>";
    echo "ALL USERS";
    echo "<table>";
    while( $user_row = mysqli_fetch_array($user_qry_run) ){

        echo "<tr>";
        echo "<td> $user_row[1] </td>   <td><a href = 'view_profile.php?id=$user_row[0]'> VIEW PROFILE </a></td>";
        echo "</tr>";
    }

    echo "</table></center>";

?>