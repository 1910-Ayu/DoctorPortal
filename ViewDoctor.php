<?php 
    include_once("config/conn.php");?>


<?php
$id = $_GET['id'];



$q = "SELECT * from doctor where id='$id'";
$r = mysqli_query($conn,$q);
while($res= mysqli_fetch_array($r)){
    $fullname = $res['fullname'];
    $spec = $res['spec'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/Viewcss.css">
   
    <title>Document</title>
 
</head>
<body>

<div class="bg-img">
  <div class="container">
    <div class="topnav">
      <a href="DocRegistration.php" >Doctor Registration</a>
      <a href="PatRegistration.php">Patient Registration</a>
     
      <a href="ViewDoctors.php" class="active" >View Doctors</a>
      <a href="ViewPatients.php">View Patients</a>
     
      
      
    </div>
  </div>
  <div class="container2">
  <div class="screen">
		<div class="screen__content">
    <h1 class="login__input"> <?php echo $fullname;?></h1>
    <p class="login__input"> Speciality:  <?php if($spec){
        echo $spec;}
        else{
            echo "Not known";}?></p>


<div>

<h3 class="appment">Appointments :</h3>
<br>

<?php


$q2 = "SELECT * from allot where docid='$id'";
$r2 = mysqli_query($conn,$q2);?>


<?php


while($res2 = mysqli_fetch_array($r2))

{
    $pat = $res2['patid'];
    $disease = $res2['disease'];
    $statusdb = $res2['status'];
    if($statusdb == 0){
        $status = "Pending";
    }else if($statusdb == 1){
        $status = "Completed";
    }else if($statusdb == 2){
        $status = "Processing";
    }else{
        $status = "Hold";
    }
    $q3 = "SELECT * from patient where id='$pat'";
    $r3 = mysqli_query($conn,$q3);
    

    while($res3 = mysqli_fetch_array($r3))
   {?>
   
     <h4 class="data"> <?php echo $res3['fullname']?></h4>
     <p  class="data"> Status of the treatment: <?php echo $status?> </p>

    <?php}?>

<p class="data"> Disease to be treated: <?php echo $disease?> </p>
    
<br>
    <?php
}
?>    
 <?php
}
?>  
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