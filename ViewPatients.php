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
    <title>Document</title>
   
</head>

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


@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');

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
  display:flex;
  flex-direction:column;
}


.active{
    background-color: black;
    
}

.container2 {
 
 display: flex;
 align-items: center;
 justify-content: center;
 min-height: 90vh;
}

.wrapper{
  display:grid;
  grid-template-columns: 300px 300px 300px;
  grid-gap: 30px;
}

.box {
  background-color:#9079ab  ;
  color: #fff;
  border-radius: 5px;
  padding: 20px;
  font-size: 135%;
}

.name{
  font-family: 'Josefin Sans', sans-serif;
  color:black;
  font-weight:bolder;
}
.doctorname{
  font-weight:bold;
  color:#4d188c;
}

.links{
  width:150px;
}

.status{
  color:#1b0436;
  font-size: 18px;
}

.viewButton{
  width:125px;
  height:25px;
  border:2px solid black;
  border-radius:10px;
  text-decoration:none;
  text-align:center;
  background-color:#e7dfe8;
}

.buttonlink{
  text-decoration:none;
  color:black;
  font-size:20px;
  font-weight:bolder;
}

</style>
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