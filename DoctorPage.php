<?php
    include_once("config/conn.php");
?>

<?php
       session_start();
    if(isset($_SESSION['doctor'])){
        $id = $_SESSION['id'];
        $q = "SELECT * from allot WHERE docid='$id'";
        $result = mysqli_query($conn,$q);
    }
        

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/DocPagecss.css">
   
    <title>Document</title>
  
</head>
<body>
    
<div class="bg-img">
<div class="viewButton0"> <a href="Logout.php" class="buttonlink">Logout</a></div>

<p class="heading"> Patients to be treated </p>
  <div class="container2">
 
    <div class="wrapper">
     
   
   <?php 
   while($res =mysqli_fetch_array($result)){
   $patid = $res['patid'];
   $statusdb = $res['status'];
   $status="Processing";
   if($statusdb == 0){
    $status = "Pending";
}else if($statusdb == 1){
    $status = "Completed";
    $treatcomplete = 1;
}else if($statusdb == 2){
    $status = "Processing";
}else{
    $status = "Hold";
}
   $disease = $res['disease'];
   $appdate = $res['appdate'];
   $q2 = "SELECT * from patient WHERE id='$patid'";
   $res2 = mysqli_query($conn,$q2);
   while($row = mysqli_fetch_array($res2)){
    $fullname = $row['fullname'];

   }
    ?>

    <div class="box">
        <h2 class="name"> <?php echo $fullname;?></h2>
        <p class="data"> Disease to be treated: <?php echo $disease ?></p>
        <p class="data">Appointment Date: <?php echo $appdate ?> </p>
        <p class="statusclass"> Status : <?php echo $status?><p>
        <div class="viewButton">  <a class="buttonlink" href="UpdateStatus.php?id=<?php echo $patid;?>">Update Status</a></div>

        

   </div>
   <?php
    }
    ?>
   
  
   


</div>
</div>
</div> 
</body>
</html>