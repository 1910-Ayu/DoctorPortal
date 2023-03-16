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
    <link rel="stylesheet" href="Style/Allotcss.css">
    
	<title>Document</title>
    
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