<?php
session_start();
$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"urexam");
$username=$_SESSION["username"];

$fetch_subject="select distinct(subject) from question_bank";
$result_subject=mysqli_query($conn,$fetch_subject);


?>


<html>
<form method="POST" action="add_test.php" name="test_Details">
<input type="text" name="test_name" required placeholder="Add Test Name">
<select id="sub_select">
            <option value='blank'>Select Subject</option>
            <?php
            while($row=mysqli_fetch_array($sub_qry_result)){
                echo "<option value='$row[0]'>$row[0]</option>";
            }
            ?>
            </select>
<input type="number" name="marks" required placeholder="Enter Marks">
<input type="number" name="duration" required placeholder="Enter Time in Minutes">
<input type="submit" name="submit">
</form>
</html>