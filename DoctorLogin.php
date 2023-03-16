<?php
    include_once("config/conn.php");
?>

<?php
 $isError=0;
 $error="";

session_start();
if(isset($_SESSION['doctor'])){
    header("location:DoctorPage.php");
    exit;
}
 if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = "SELECT * FROM doctor WHERE username ='$username'";
    $r = mysqli_query($conn,$q);
    if(mysqli_num_rows($r)>0){
        while($row = mysqli_fetch_array($r)){
            $dbpassword = $row['password'];
            $status = $row['status'];
            $id = $row['id'];
        }
        if($status === 0){
            $isError=1;
            $error="Doctor No Longer Active";
            exit;
        }
        if(password_verify($password,$dbpassword)){
            session_start();
            $_SESSION['doctor'] = 1;
            $_SESSION['id'] = $id;

            header("location:DoctorPage.php");
            exit;
        }else{
            $isError=1;
            $error="Incorrect Password";
        }
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Login.css">
    <title>Document</title>
    <style>
        </style>
</head>
<body>
    
<div class="container" >
    
	<div class="screen">
        
		<div class="screen__content">
            
			<form class="login" action="DoctorLogin.php" method="POST">
				<div class="login__field">
					
					<input type="text" class="login__input" placeholder="User name "
                    name="username" id="username">
				</div>
				<div class="login__field">
					
					<input type="password" class="login__input" placeholder="Password"
                    name="password" id="password">
				</div>
				<button class="button login__submit" type="submit" name="login" value="login">
					<span class="button__text">Log In Now</span>
					
				</button>	
                			
			</form>
           
           
            
		</div>
        
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>