<?php
    include_once('config/conn.php');
?>

<?php
    session_start();
    if(isset($_SESSION['doctor'])){
        header("location:DoctorPage.php");
        exit;
    }else if(isset($_SESSION['admin'])){
        header("location:AdminPage.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/indexcss.css">
    <title>Document</title>
</head>
<body>

<div>
    <div class="heading"><h1> Welcome to Doctor Web Portal</h1><div>
    <div class="container">
        <div class="element"><a href="DoctorLogin.php" class="links"> Doctor Login</a> </div>
        <div class="element">  <a href="AdminLogin.php" class="links"> Admin Login </a> </div>
    </div>
</div>

</body>
</html>