<?php
    include_once("config/conn.php");
?>

<?php
        
        $q = "SELECT * from patient";
        $result = mysqli_query($conn,$q);

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/View3css.css">
  
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
      <a href="ViewDoctors.php" class="links" >View Doctors</a>
      <a href="ViewPatients.php" class="active links">View Patients</a>
</div>  

      
      
    </div>
  </div>
  <div class="container2">
    <div class="wrapper">
       
   <?php 
   $docalloted=1;
   while($res =mysqli_fetch_array($result))
   { 
    $curId = $res['id'];

    $pquery = "SELECT * from allot where patid='$curId'";

    $presult = mysqli_query($conn,$pquery);

    if($presult){

    $statusdb = 2;
    $treatcomplete = 0;
    $doctorname="Not Alloted yet";
    $docid= 0;
    while($rrr = mysqli_fetch_array($presult)){
      $statusdb = $rrr['status']; 
      $docid = $rrr['docid'];

    }
    $quee = "SELECT * from doctor WHERE id='$docid'";
    $ress = mysqli_query($conn,$quee);
    if(mysqli_num_rows($ress)>0){
    while($rrrr= mysqli_fetch_array($ress)){
      $doctorname = $rrrr['fullname'];
    }}
    
    
    if($statusdb == 0){
      $status = "Pending";
  }else if($statusdb == 1){
      $status = "Completed";
      $treatcomplete = 1;
  }else if($statusdb == 2){
      $status = "Processing";
  }else{
      $status = "Hold";
  }}else{
    $docalloted=0;
  }
    ?>
    
  
 <div class="box">
        <p class="name"> <?php echo $res['fullname']; ?></p>
        <p class="doctorname"> Doctor Name: <?php echo $doctorname;?></p>
        <p class="status"> Status of Appointment: <?php echo $status?></p>
                  
         
        <div class="viewButton">  <a class="buttonlink" href="Allotdoctor.php?id=<?php echo $curId?>">Enter Details</a></div>

        

   </div>
   <?php
    }
    ?>
    
     
   
   
   
   


</div>
</div>
</div> 
</body>
</html>