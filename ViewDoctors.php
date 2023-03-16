<?php
    include_once("config/conn.php");
?>

<?php
        
        $q = "SELECT * from doctor";
        $result = mysqli_query($conn,$q);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/View2css.css">
  
    <title>Document</title>

</head>
<body>
    
<div class="bg-img">
  <div class="container">
    <div class="topnav">
      <div>
      <a href="DocRegistration.php" class="links">Doctor Registration</a>
      <a href="PatRegistration.php" class="links">Patient Registration</a>
</div>
<div>
      <a href="ViewDoctors.php" class="active links" >View Doctors</a>
      <a href="ViewPatients.php" class="links">View Patients</a>
</div>
      
      
    </div>
  </div>

  <div class="container2">
    <div class="wrapper">
       
   <?php 
   while($res =mysqli_fetch_array($result))
   { ?><?php
    $curId = $res['id'];
    $fullname = $res['fullname'];
    $spec = $res['spec'];
    $que1 = "SELECT * from allot where docid='$curId' and status ='0' ";
    $res1 = mysqli_query($conn,$que1);
    $pend_count = mysqli_num_rows($res1);
    $que2 = "SELECT * from allot where docid='$curId' and status ='2' ";
    $res2 = mysqli_query($conn,$que2);
    $process_count = mysqli_num_rows($res2);
 ?>


    <div class="box">
        <p class="name"> <?php echo $res['fullname']; ?></p>
        <p class="speciality"> <?php echo $res['spec'];?> </p>
      <p class="treat"> <?php echo $pend_count;?> Pending Treatments</p>
      <p class="treat"> <?php echo $process_count;?> Processing Treatments</p>
       <div class="viewButton"><a class="buttonlink"href="ViewDoctor.php?id=<?php echo $curId;?>">View More</a></div>

   </div>
  
   <?php}?>
   
   
<?php }?>

</div>
</div>
</div> 
</body>
</html>