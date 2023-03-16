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
    <title>Document</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');

  
  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');

  @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Lora:ital,wght@1,400;1,500;1,600&family=Varela&family=Varela+Round&display=swap');

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
  padding:30px;
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

.container2 {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
}

.wrapper {
  display: grid;
  grid-template-columns: 450px 450px;
  grid-gap: 30px;
 
  color: #444;
}

.box {
  background-color:#9079ab;
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

.data{
  font-weight:bold;
  color:#4d188c;
  font-family: 'Josefin Sans', sans-serif;
}

.statusclass{
  font-family: 'Josefin Sans', sans-serif;
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
.viewButton0{
  width:125px;
  height:25px;
  border:2px solid black;
  border-radius:10px;
  text-decoration:none;
  text-align:center;
  background-color:#e7dfe8;
  margin-left:85vw;
}

.buttonlink{
  text-decoration:none;
  color:black;
  font-size:20px;
  font-weight:bolder;
}

.heading{
  text-align:center;
  margin-bottom:-50px;
  font-size: 35px;
  font-family: 'Josefin Sans', sans-serif;
  font-weight:bolder;
}
</style>
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