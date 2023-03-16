<?php
include_once('config/conn.php');

$q = "SELECT * from doctor";

$r = mysqli_query($conn,$q);


?>
<?php
    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $input = $_POST['doc'];
        echo $input;
        $disease = $_POST['disease'];
        $sql0 = "SELECT * from doctor WHERE fullname='$input'";
        $res0 = mysqli_query($conn,$sql0);
        while($r = mysqli_fetch_array($res0)){
            $docid = $r['id'];
        }
        
        $appdate = $_POST['appdate'];
		$extraquery = "UPDATE patient SET disease='$disease' where id='$id'";
		$extrares = mysqli_query($conn,$extraquery);
		$sql0 = "SELECT * from allot where patid='$id'";
		$res0 = mysqli_query($conn,$sql0);
		if(mysqli_num_rows($res0)>0){
			$sql1 = "UPDATE allot SET docid = '$docid', disease='$disease',
			appdate='$appdate', status= 2  WHERE patid='$id'";
			$res1 = mysqli_query($conn,$sql1);
			if($res1){
				header("location:ViewPatients.php");
				exit;
			}
		}else{
        $sql = "INSERT INTO allot(docid, patid, disease, appdate, status) 
        VALUES ('$docid','$id','$disease','$appdate',2)";

        $res = mysqli_query($conn,$sql);

        if($res){
            header("location:ViewPatients.php");
        }
	}
       
    }
?>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "select * from patient where id = $id");
while($res=mysqli_fetch_array($result)){
    $fullname = $res['fullname'];
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
	background: linear-gradient(90deg, #5D54A4, #7C78B8);		
	position: relative;	
	height: 550px;
	width: 450px;	
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


.class0{
	margin-left:20px;
}


</style>
</head>
<body>
<div class="bg-img">
  <div class="container">
    <div class="topnav">
      <a href="DocRegistration.php" >Doctor Registration</a>
      <a href="PatRegistration.php">Patient Registration</a>

      <a href="ViewDoctors.php" >View Doctors</a>
      <a href="ViewPatients.php" class="active">View Patients</a>
     
      
      
    </div>
  </div>

  <div class="container2">
 <div class="screen">
		<div class="screen__content">
            <div class="login__input">
    <h3> Name of Patient:<p>
<h2> <?php echo $fullname;?> </h2>
</div>
<form action="Allotdoctor.php" method="POST">

    <br>

<p class="class0">Choose the doctor from the list</p>
<select id="doc" name="doc" class="login__input">
    <?php
while($rows = mysqli_fetch_array($r)){?>
        <?phpif($rows[$status]){?>
           
            
            <option value="<?php echo $rows['fullname']?>" ><?php echo$rows['fullname']?></option>
          
        
        <?php}?>
        <?php
        
    }?>




          
        </select>
        <br>
        <br>
        <p class="class0"> Enter the disease for which treatment is required</p>
<input type="text" name="disease" id="disease" class="login__input">

<br>
<br>
<p class="class0"> Select the date for appointment</p>
        <input class="login__input" type="date" name="appdate" id="appdate">
    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
    
<button class="button login__submit" type="submit" value ="add" name="add">Complete Allotment</button><div>
</form>
</div>
</div>
     <div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>
</div>
</div>
</div>
</body>
</html>