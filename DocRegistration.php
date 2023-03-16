<?php
    include_once("config/conn.php");
?>

<?php
	$query = "SELECT * from spec";
	$specresult = mysqli_query($conn,$query);
?>
<?php
    if(isset($_POST['add'])){
        $fullname = $_POST['fullname'];
        $contact1 = $_POST['contact1'];
        $contact2 = $_POST['contact2'];
		$email = $_POST['email'];
		$visittimefrom = $_POST['visittimefrom'];
		$visittimeto = $_POST['visittimeto'];
        if($contact1 == $contact2){
            echo "primary and secondary contact number are same";
            exit;
        }
        $address = $_POST['address'];
        $adhar = $_POST['adhar'];
        $pan = $_POST['pan'];
        $username = $_POST['username'];
		$spec = $_POST['spec'];
		$joindate = $_POST['joindate'];
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

        $q1 = "insert into doctor(fullname,contact1,contact2,address,adhar,pan,spec,username,password,status,email,visittimefrom,visittimeto)
        values('$fullname','$contact1','$contact2','$address','$adhar','$pan','$spec','$username','$password','$status','$email','$visittimefrom','$visittimeto')";
        
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
    <link rel="stylesheet" href="Style/DocRegcss.css">
	<title>Document</title>
  
</head>
<body>
    
<div class="bg-img">
  <div class="container">
    <div class="topnav">
    <a href="DocRegistration.php"class="active" >Doctor Registration</a>
      <a href="PatRegistration.php">Patient Registration</a>
     
     
      <a href="ViewDoctors.php" >View Doctors</a>
      <a href="ViewPatients.php">View Patients</a>
	  <a href="Logout.php" >Logout</a>
      
    </div>
  </div>
  <div class="container2">
 <div class="screen">
		<div class="screen__content">
 <form action="DocRegistration.php" method="POST">
	<div class="formclass">
 <div class="login__field">
					
        <input type="text" class="login__input" name="fullname" id="fullname" placeholder="Enter full name of Doctor">
</div>

<div class="login__field">
					
       <input class="login__input" type="email" name="email" id="email" placeholder="Enter Email of Doctor">
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
					
       <input class="login__input" type="textarea" name="address" id="address" placeholder="Enter address of Doctor">
</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="adhar" id="adhar" placeholder="Enter Adhar Card Number of Doctor">
</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="pan" id="pan" placeholder="Enter Pan Card Number of Doctor">
</div>

<div class="login__field">
			</div>
<div class="login__field">
					
       <input class="login__input" type="text" name="username" id="username" placeholder="Enter user name of Doctor">
</div>
<div class="login__field">
					
       <input class="login__input" type="password" name="password" id="password" placeholder="Enter password of Doctor">
</div>

<div class="login__field">
					<label for="visittimefrom" class="labelclass">Visiting time from:</label>
       <input class="login__input" type="time" name="visittimefrom" id="visittimefrom" >
</div>

<div class="login__field">
					<label for="visittimeto" class="labelclass">Visiting time to:</label>
       <input class="login__input" type="time" name="visittimeto" id="visittimeto" >
</div>


<div class="login__field">
					
        
       
        <p class="labelclass"> Speciality of Doctor<p>


	


        <select id="spec" name="spec" class="login__input">
          <?php while($data = mysqli_fetch_array($specresult)){?>

			<?phpif($rows[$status]){?>
			<option value ="<?php echo $data['title']?>"> <?php echo $data['title']?></option>
			<?php}?>
			<?php
        
    }?>
        </select>
</div>
<div class="login__field">
					
        
       
        <p class="labelclass"> Status of Doctor<p>
        <select id="status" name="status" class="login__input">
           <option value="Active" >Active</option>
           <option value="Inactive">Inactive</option>
        </select>
</div>

<div class="login__field">
			<p class="labelclass"> Enter the joining date:</p>		
       <input class="login__input" type="date" name="joindate" id="joindate">
</div>
  
        <button class="button login__submit" type="submit" value="add" name="add" >Register Doctor</button>

</div>
    </form>
</div>

</div>
 </div>
</div> 
</body>
</html>