<?php
    include_once("config/conn.php");
?>

<?php


    if(isset($_POST['update'])){
        echo "nwoeifj";
        $statusinput = $_POST['statusinput'];
        $patid = $_POST['patidinput'];
        $statusdb = 2;

        if($statusinput == "Pending"){
            $statusdb = 0;
        }else if($statusinput == "Completed"){
            $statusdb =1;
        }else if($statusinput == "Processing"){
            $statusdb = 2;
        }else{
            $statusdb =3;
        }

        $qq = "UPDATE allot SET status='$statusdb' WHERE patid='$patid'";
        $rr = mysqli_query($conn,$qq);

        if($rr){
            header("location:DoctorPage.php");
            exit;
        }


    }
?>

<?php
$id = $_GET['id'];

$q = "SELECT * from allot WHERE patid='$id'";
$r = mysqli_query($conn,$q);

while($row = mysqli_fetch_array($r)){
    $status = $row['status'];
    $disease = $row['disease'];
    $appdate = $row['appdate'];
}
$statusout = "Processing";

if($status == 0){
    $statusout = "Pending";
}else if($status == 1){
    $statusout = "Completed";
    $treatcomplete = 1;
}else if($status == 2){
    $statusout = "Processing";
}else{
    $statusout = "Hold";
}

$q1 = "SELECT * from patient WHERE id='$id'";
$r1 = mysqli_query($conn,$q1);

while($row2 = mysqli_fetch_array($r1)){
    $fullname = $row2['fullname'];
    $address = $row2['address'];
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


.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
    background-color:#c6a0de;
}

.formclass{
    width:440px;
    height:600px;
    border:2px solid black;
    border-radius:50px;
    display: flex;
	align-items: center;
	justify-content: center;
    background-color:#ccbcd6;
}

.data{
    font-size:30px;
    margin-left:20px;
    color:#2e1e38;
    font-family: 'Josefin Sans', sans-serif;
}

.labelclass{
    font-size:25px;
    margin-left:20px;
    font-weight:bolder;
    
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
}

.updatebutton{
    display:block;
    margin-top:20px;
    margin-left:20px;
    font-size:15px;
    padding: 16px 20px;
    border-radius: 26px;
	border: 1px solid #D4D3E8;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	
	color: #4C489D;
	box-shadow: 0px 2px 2px #5C5696;
	cursor: pointer;
	transition: .2s;
}
    </style>
</head>
<body>
   <div class="container">
    <div class="formclass">
        <div>
   <form action="UpdateStatus.php" method = "POST">
    <p class="data">Name of Patient: <?php echo $fullname?> </p>
    <p class="data"> Disease: <?php echo $disease?> </p>
    <p class="data"> Appointment Date: <?php echo $appdate?></p>
    <p class="data"> Current Status: <?php echo $statusout?> </p>

    <p class="labelclass"> Choose from the list below to change the Status </p>
    
    <select id="statusinput" name="statusinput" class="login__input">
            <option value="Pending" >Pending</option>
           <option value="Completed">Completed</option>
           <option value="Processing" >Processing</option>
           <option value="Hold">Hold</option>
</select>

<input type="hidden" name="patidinput" value="<?php echo $_GET['id'];?>">

    <button type = "submit" id="update" name = "update" class="updatebutton"> Update Status </button>

  

   
  </form>
</div>
</div>
</div>
</body>
</html>