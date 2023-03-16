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
    <title>Document</title>

    <style>


  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');


  body {
	background-image: url("doc_bg.jpg");

    min-height: 100vh;

/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover;

/* Needed to position the navbar */
position: relative;
}
.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
    margin-top:-100px;
    
}
.heading
{
    text-align:center;
    font-family: 'Josefin Sans', sans-serif;
    font-size:23px;

}
.element{
    height:150px;
    width:150px;
    border: 2px solid black;
    border-radius:5px;
   margin-left:20px;
    display: flex;
	align-items: center;
	justify-content: center;
    background: linear-gradient(90deg, #C7C5F4, #776BCC);
    	
   
}

.links{
    font-size: 30px;
    text-decoration:none;
    color:black;
    text-align:center;
    font-weight:bolder;
    font-family: 'Josefin Sans', sans-serif;
}

        </style>
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