<?php
session_start();
$conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
mysqli_select_db($conn,"urexam");
$username=$_SESSION["username"];
$_SESSION["TOTAL_MARKS"]=0;
$fetch_subject="select distinct(subject) from question_bank";
$result_subject=mysqli_query($conn,$fetch_subject);


?>

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
<html>
<body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
<center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
<form method="POST" action="add_test.php" name="test_Details">
<div style="padding-left: 35%;">
Test Name : <input type="text" name="test_name" required ><br><br>
Subject : <select id="sub_select" name="sub_name">
            <option value='blank'>Select Subject</option>
            <?php
                while($row=mysqli_fetch_array($result_subject)){
                echo "<option value='$row[0]'>$row[0]</option>";
            }
            ?>
            </select><br><br>
Duration (Minutes) : <input type="number" name="duration" required ><br><br>
        </div>
        <div  style="padding-left: 40%;"><input type="submit" name="submit"></div>
</form>
        </body>
</html>