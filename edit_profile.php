<?php
    session_start();
	$con=mysqli_connect("localhost","root","")or
	die("Could not connect.");
		mysqli_select_db($con,"urexam")or
	die("Could not select database.");

    $username = $_SESSION['username'];
    $user_id = $_GET['id'];
    $user_qry = "select * from user where user_id = '$user_id'";
    $user_row = mysqli_fetch_array(mysqli_query($con,$user_qry));
?>

<html>
    <?php echo "LOGGED IN : $username";?>
    <center>
    <b> EDIT PROFILE </b><br><br>
    <form name = "edit_profile" action="edit_profile_backend.php" method = "POST">
        NAME = <input name="name" value = "<?php echo $user_row[3]?>"><br><br>
        PASSWORD = <input name = "password" value = "<?php echo $user_row[2]?>"><br><br>
        email = <input name = "email" value = "<?php echo $user_row[4]?>"> <br><br>
        <input type = "submit" value = "submit">
    </form>
    </center>
</html>