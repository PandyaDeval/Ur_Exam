<?php
    session_start();
    $conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
    mysqli_select_db($conn,"urexam");
    $username=$_SESSION["username"];

?>

<html>
<form>
    
</form>
</html>