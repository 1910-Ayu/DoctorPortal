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
    <title>Document</title>
    <style>
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

.wrapper {
  display: grid;
  grid-template-columns: 300px 300px 300px;
  grid-gap: 30px;
  color: #444;
}

.box {
  background-color:#9079ab  ;
  color: #fff;
  border-radius: 5px;
  padding: 20px;
  font-size: 135%;
}
.links{
  width:150px;
}

.name{
  font-family: 'Josefin Sans', sans-serif;
  color:black;
  font-weight:bolder;
}

.speciality{
  font-weight:bold;
  color:#4d188c;
}

.treat{
  color:#1b0436;
  font-size: 18px;
}

.viewButton{
  width:100px;
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
    /*if($res1){
    
    $pend_count = 0;
  while($rr = mysqli_fetch_array($res1)){
    $pend_count++;
  }}*/
  $pend_count = mysqli_num_rows($res1);
    $que2 = "SELECT * from allot where docid='$curId' and status ='2' ";
    $res2 = mysqli_query($conn,$que2);
   /* if($res2){
    $arr2 = mysqli_fetch_array($res2);
    $process_count=0;
    while($rrr = mysqli_fetch_array($res2)){
     $process_count++;
    }*/
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