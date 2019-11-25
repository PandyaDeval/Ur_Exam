
<style>

table, td, th {  
border: 1px solid black;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
  width:50%;
}
input[type=submit], button {
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

<script>
var cnt=0;
function add_que(a){
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
        }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            cnt=cnt+1;
            document.getElementById(a).innerHTML = "Added";
            document.getElementById(a).disabled = true;
            document.getElementById("sel_ques").innerHTML=this.responseText;
            
        }
      }
      xmlhttp.open("GET","add_particular_que.php?q="+a,true);
      xmlhttp.send();
            }
</script>
<body style="background-image: linear-gradient(#F17153, #F58D63, #f1ab53);">
<center><h1><font face="Bunch Blossoms Personal Use">urExam</font></h1></center>
<?php
 session_start();
 $conn=mysqli_connect("localhost","root","") or die("Could Not Connect");
 mysqli_select_db($conn,"urexam");
 $username=$_SESSION["username"];
 $test_name=$_SESSION["test_name"];
 $sub_name=$_SESSION["sub_name"];
 $marks=$_SESSION["marks"];

 $fetch_examid="SELECT * FROM exam WHERE name='$test_name' AND subject='$sub_name'";
 $result_examid=mysqli_query($conn,$fetch_examid);
$examid;
 while($row=mysqli_fetch_array($result_examid)){
     $examid=$row["exam_id"];
     $_SESSION["examid"]=$examid;
 }

echo "<center><b><div id = 'sel_ques'> </div></b></center>";

 $fetch_question="SELECT  * FROM question_bank WHERE subject='$sub_name'";
 $result_question=mysqli_query($conn,$fetch_question);
 while($q_row=mysqli_fetch_array($result_question)){
     $q_id=$q_row["question_id"];
     $question=$q_row["question"];
     $op_1=$q_row["op_1"];
     $op_2=$q_row["op_2"];
     $op_3=$q_row["op_3"];
     $op_4=$q_row["op_4"];
     $answer=$q_row["answer"];
    ?>
    <table>
        <tr><td colspan='2'><b>Question :  </b><?php echo $question; ?></td></tr>    
        <tr><td><b>A. </b><?php echo $op_1; ?></td><td><b>B. </b><?php echo $op_2; ?></td></tr>
        <tr><td><b>C. </b><?php echo $op_3; ?></td><td><b>C. </b><?php echo $op_4; ?></td></tr>
        <tr><td><b>Ans. </b><?php echo $answer; ?></td><td><button style="padding:7.5px;" id="<?php echo $q_id; ?>" onclick=add_que(<?php echo $q_id; ?>) value="ADD">ADD</button></td></tr>
    </table><br>
    <?php
 }
?>
<center>
<form method="POST" action="add_marks.php">
    <input type="hidden" name="marks" value="<?php echo $_SESSION["TOTAL_MARKS"]; ?>" >
    <input type="submit" value="SUBMIT">
</form></center>
</body>