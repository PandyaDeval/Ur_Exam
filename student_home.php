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
        <style>
            a:link, a:visited, select, option, button {
            background-color: #a10000;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5mm;
            width: 400px;
            }

            a:hover, a:active {
            background-color: #a10000;
            }
        </style>
        <script>
            function sub_select(){
                var subject = document.getElementById("sub_select").value;
                if(subject == "blank"){
                    document.getElementById("show_exams").html = "";
                }
                else{
                    if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("show_exams").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","get_exams.php?s="+subject,true);
                    xmlhttp.send();
                }
            }

            function start_exam(){
                var exam = document.getElementById("select_exam").value;
                var subject = document.getElementById("sub_select").value;
                location = "exam_page.php?exam="+exam+"&subject="+subject;
            }
        </script>
    </head>
    <body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
<center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
        <center><h1>Welcome <?php echo $row[3];?></h1>

        <br><br>

        <div>
            <select onchange = "sub_select()" id="sub_select">
                <option value='blank'>Select Subject</option>
            <?php
            while($row=mysqli_fetch_array($sub_qry_result)){
                echo "<option value='$row[0]'>$row[0]</option>";
            }
            ?>
            </select>
        </div>
        <br><br>
        <div id='show_exams'>    
        </div>
        <br><br>
        <?php $user_id_row = mysqli_fetch_array(mysqli_query($con,$qry)); ?>
        <a href = "view_profile.php?id=<?php echo $user_id_row[0]?>">VIEW PROFILE</a> |
        <a href = "edit_profile.php?id=<?php echo $user_id_row[0]?>">EDIT PROFILE</a><br><br><br><br><br>
        <a href='logout.php' style='width:20%'>Logout</a>

        </center>
    </body>
</html>