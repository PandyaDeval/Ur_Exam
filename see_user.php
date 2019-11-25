<html>
    <style>
    a:link, a:visited {
  background-color: #a10000;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 5mm;

}

a:hover, a:active {
  background-color: #a10000;
}
    </style>
    <head>

        <script>
            function check(){
                if(confirm("ARE U SURE?")){
                    return true;
                }
                else return false;
            }
        </script>
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
    $user_qry = "select * from user";
    $user_qry_run = mysqli_query($con,$user_qry);
    echo "LOGGED IN : <a href = 'admin_home.php'>$username </a> ";
    echo "<center style='font-size:30px;'>";
    echo "ALL USERS<br><br>";
    echo "<table>";
    while( $user_row = mysqli_fetch_array($user_qry_run) ){

        echo "<tr >";
        echo "<td style='font-size:30px;'> $user_row[1] </td>   <td><a href = 'view_profile.php?id=$user_row[0]'> VIEW PROFILE </a></td> <td> | <a href = 'delete_profile.php?id=$user_row[0]' onclick = 'return check()' >DELETE</a></td>";
        echo "</tr>";
    }

    echo "</table></center>";

?>
</body>
</html>