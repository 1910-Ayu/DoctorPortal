<?php
include_once('config/conn.php');

$q = "SELECT * from spec";

$r = mysqli_query($conn,$q);


?>



<?php
    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $input = $_POST['chkl'];
        $i = serialize($input);
         $q = "UPDATE doctor SET spec = '$i' where id='$id'";
         $r = mysqli_query($conn,$q);
         if($r){
            echo "done";
         }else{
            echo "error";
         }
    }
?>

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "select * from doctor where id = $id");
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
</head>
<body>
    <h1> <?php echo $fullname;?> </h1>
<form action="Addspec.php" method="POST">

    <?php
    
    while($rows = mysqli_fetch_array($r)){?>
        <?phpif($rows[$status]){?>
           
            
        <input type="checkbox" name="chkl[ ]" value="<?php  echo $rows['title'];?>">
        <label class="con" style=""><?php  echo $rows['title'];?>
        </label>
        
        <?php}?>
        <?php
        
    }?>
    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
    <div>
<button type="submit" value ="add" name="add">Add</button><div>
</form>

</body>
</html>