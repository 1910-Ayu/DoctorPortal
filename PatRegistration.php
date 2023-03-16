<?php
    include_once("config/conn.php");
?>

<?php
    if(isset($_POST['add'])){
        $fullname = $_POST['fullname'];
        $contact1 = $_POST['contact1'];
        $contact2 = $_POST['contact2'];
        if($contact1 == $contact2){
            echo "primary and secondary contact number are same";
            exit;
        }
        $address = $_POST['address'];
        $adhar = $_POST['adhar'];
        $pan = $_POST['pan'];
        $username = $_POST['username'];
        $password_input = $_POST['password'];
        $uppercase = preg_match('@[A-Z]@', $password_input);
        $lowercase = preg_match('@[a-z]@', $password_input);
        $number    = preg_match('@[0-9]@', $password_input);
        $specialChars = preg_match('@[^\w]@', $password_input);
        
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_input) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'; 
            exit;}
        $password= password_hash($password_input,PASSWORD_DEFAULT);

        $status_input = $_POST['status'];

        if($status_input == "Active"){
            $status =1;
        }else{
            $status=0;
        }

        $q1 = "insert into patient(fullname,contact1,contact2,address,adhar,pan,username,password,status)
        values('$fullname','$contact1','$contact2','$address','$adhar','$pan','$username','$password','$status')";
        
        $result = mysqli_query($conn,$q1);
        if($result){
            header("location:AdminPage.php");
        }else{
            echo "something went wrong";
        }
        

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


.bg-img {
  /* The image used */
  background-image: url("doc_bg.jpg");

  min-height: 100vh;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

  /* Needed to position the navbar */
  position: relative;
}

/* Position the navbar container inside the image */
.container {
  position: absolute;
  margin: 20px;
  width: auto;
}

/* The navbar */
.topnav {
  overflow: hidden;
  background-color: #6A679E;
}

/* Navbar links */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}


.active{
    background-color: black;
    
}

@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;	
	font-family: Raleway, sans-serif;
}

body {
	background: linear-gradient(90deg, #C7C5F4, #776BCC);		
}

.container2 {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
}

.screen {		
	background:linear-gradient(90deg, #5D54A4, #7C78B8);		
	position: relative;	
	height: 500px;
	width: 800px;	
	box-shadow: 0px 0px 24px #5C5696;
}

.screen__content {
	z-index: 1;
	position: relative;	
	height: 100%;
}

.screen__background {		
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);	
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #FFF;	
	top: -50px;
	right: 120px;	
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 220px;
	width: 220px;
	background: #6C63AC;	
	top: -172px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg, #5D54A4, #6A679E);
	top: -24px;
	right: 0;	
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: #7E7BB9;	
	top: 420px;
	right: 50px;	
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 156px;
}

.login__field {
	padding: 20px 0px;	
	position: relative;	
}

.login__icon {
	position: absolute;
	top: 30px;
	color: #7875B5;
}

.login__input {
	border: none;
	border-bottom: 2px solid #D1D1D4;
	background: none;
	padding: 10px;
	padding-left: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
    color:black;
}

.formclass{
	display:grid;
	
  grid-template-columns: 400px 400px ;
  grid-gap: 10px;
  background-color: #fff;
  color: #444;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #6A679E;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	margin-bottom:30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 80%;
	color: #4C489D;
	box-shadow: 0px 2px 2px #5C5696;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #6A679E;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin: auto;
    
	color: #7875B5;
}



.labelclass{
	margin-left:23px;
	font-weight:bold;
}

</style>
</head>
<body>
    
<div class="bg-img">
  <div class="container">
    <div class="topnav">
      <a href="DocRegistration.php" >Doctor Registration</a>
      <a href="PatRegistration.php" class="active">Patient Registration</a>
      <a href="ViewDoctors.php" >View Doctors</a>
      <a href="ViewPatients.php">View Patients</a>
	  <a href="Logout.php" >Logout</a>
      
    </div>
  </div>

 <div class="container2">
 <div class="screen">
		<div class="screen__content">
			
 <form action="PatRegistration.php" method="POST">
	<div class="formclass">
 <div class="login__field">
					
        <input type="text" class="login__input" name="fullname" id="fullname" placeholder="Enter full name of Patient">
</div>
<div class="login__field">
					
        <input class="login__input" type="tel" id="contact1" name="contact1"
        placeholder="Enter Contact in 123-456-7890 format"
       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
       >
</div>
<div class="login__field">
					
       <input class="login__input" type="tel" id="contact2" name="contact2"
        placeholder="Enter Contact in 123-456-7890 format"
       pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
       >
</div>
<div class="login__field">
					
       <input class="login__input" type="textarea" name="address" id="address" placeholder="Enter address of Patient">
</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="adhar" id="adhar" placeholder="Enter Adhar Card Number of Patient">
</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="pan" id="pan" placeholder="Enter Pan Card Number of Patient">
</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="username" id="username" placeholder="Enter user name of Patient">
</div>
<div class="login__field">
					
       <input class="login__input" type="password" name="password" id="password" placeholder="Enter password of Patient">
</div>
<div class="login__field">
					
        
       
        <p class="labelclass"> Status of Patient<p>
        <select id="status" name="status" class="login__input">
           <option value="Active" >Active</option>
           <option value="Inactive">Inactive</option>
        </select>
</div>
  
       
<button class="button login__submit" type="submit" value="add" name="add" >Register Patient</button>
</div>
    </form>

</div>

</div>
 </div>


</div> 
</body>
</html>