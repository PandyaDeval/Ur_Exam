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
    <head>
    <style> 
                input[type=text] {
                  width: 35%;
                  background: none;
                  padding: 12px 20px;
                  margin: 8px 0;
                  box-sizing: border-box;
                  border: none;
                  border-bottom: 2px solid  #a10000;
                }
                input[type=submit] {
                    background-color: #a10000; /* Green */
                    border: none;
                    border-radius: 5mm;
                    color: white;
                    padding: 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    cursor: pointer;
                    }
                </style>
    </head>
    <body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
    <center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
    <?php echo "LOGGED IN : $username";?>
    <center>
    <b> EDIT PROFILE </b><br><br>
    <form name = "edit_profile" action="edit_profile_backend.php" method = "POST">
        NAME = <input type='text' name="name" value = "<?php echo $user_row[3]?>"><br><br>
        PASSWORD = <input type='text' name = "password" value = "<?php echo $user_row[2]?>"><br><br>
        email = <input type='text' name = "email" value = "<?php echo $user_row[4]?>"> <br><br>
        <input type = "submit" value = "submit">
    </form>
    </center>
</body>
</html>