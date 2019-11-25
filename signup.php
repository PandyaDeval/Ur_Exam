<?php	
$conn=mysqli_connect("localhost","root","") or die("could not connect");
mysqli_select_db($conn,"urexam")
or mysqli_query($conn,"urexam");


$name=$_POST["name"];
$username=$_POST["username"];
$email=$_POST["email"];
$pass=$_POST["pass"];
$conf=$_POST["confpass"];
$gender=$_POST["gender"];

if($gender=='student'){
    $checkuser="select * from user where username='$username'";
$checkemail="select * from user where email='$email'";

$runuser=mysqli_query($conn,$checkuser);
$runemail=mysqli_query($conn,$checkemail);

$cntuser=mysqli_num_rows($runuser);
$cntemail=mysqli_num_rows($runemail);

session_start();
$_SESSION['email']=$email;

if($cntuser>0 && $cntemail>0 )
{
    echo "<script>alert('Username And Email Already Exist.Choose Another');location='home.html';</script>";
}
else if($cntuser>0)
{
    echo "<script>alert('Username Already Exist.Choose Another');location='home.html';</script>";
}
else if($cntemail>0 )
{
    echo "<script>alert('Email Already Exist.Choose Another');location='home.html';</script>";
}
else
{
    if($pass==$conf)
    {
        $sql="INSERT INTO user (username,password,name,email) VALUES ('$username','$pass','$name','$email')";
        if (mysqli_query($conn,$sql))
        {
            echo "<script>alert('Registration succesful!');location='home.html';</script>";
        }
        else
        {
            echo "<script>alert('Nope');</script>";
        }
    }
    else{
        echo "<script>alert('Nope');</script>";
    }
}
}
else{
    $checkuser="select * from admin where username='$username'";
    $checkemail="select * from admin where email='$email'";

    $runuser=mysqli_query($conn,$checkuser);
    $runemail=mysqli_query($conn,$checkemail);

    $cntuser=mysqli_num_rows($runuser);
    $cntemail=mysqli_num_rows($runemail);

    session_start();
    $_SESSION['email']=$email;

    if($cntuser>0 && $cntemail>0 )
    {
        echo "<script>alert('Username And Email Already Exist.Choose Another');location='home.html';</script>";
    }
    else if($cntuser>0)
    {
        echo "<script>alert('Username Already Exist.Choose Another');location='home.html';</script>";
    }
    else if($cntemail>0 )
    {
        echo "<script>alert('Email Already Exist.Choose Another');location='home.html';</script>";
    }
    else
    {
        if($pass==$conf)
        {
            $sql="INSERT INTO admin (username,password,name,email) VALUES ('$username','$pass','$name','$email')";
            if (mysqli_query($conn,$sql))
            {
                echo "<script>alert('Registration succesful!');location='home.html';</script>";
            }
            else
            {
                echo "<script>alert('Nope');</script>";
            }
        }
        else{
            echo "<script>alert('Nope');</script>";
        }
    }
}

?>