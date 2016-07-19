<?php
session_start();
if ($_SESSION['usertype']!=102) 
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");

$flag=0;
if (isset($_POST['submit'])){

$message=NULL;

/*
SKU
Product
Qty -> weight
Expiry Date
Production Date
Received Date
//location
*/

 if (empty($_POST['rawMaterialName'])){
  $rawMaterialName=FALSE;
  $message.='<p>You forgot to enter the raw material name!';
 }else
  $rawMaterialName=$_POST['rawMaterialName'];

 if (empty($_POST['sku'])){
  $sku=NULL;
 }else
  $sku=$_POST['sku'];

 if (empty($_POST['weight'])){
  $weight=0;
 }else{
  if (!is_numeric($_POST['weight'])){
   $message.='<p>The product price you entered is not numeric!';
  }else
   $productprice=$_POST['weight'];
 }

if (empty($_POST['expiryDate'])){
	$expiryDate=FALSE;	
	$message.='<p>You forgot to enter the expiry date!';
if (empty($_POST['productionDate'])){
	$productionDate=FALSE;
	$message.='<p>You forgot to enter the productionDate!';
if (empty($_POST['receivedDate'])){
	$receivedDate=FALSE;
	$message.='<p>You forgot to enter the receivedDate!';
  
if(!isset($message)){
require_once('../mysql_connect.php');
$query="insert into products (rawMaterialName, sku, weight, expiryDate, productionDate, expiryDate) values ('{$rawMaterialName}','{$sku}','{$weight}', '{$expiryDate}', '{$productionDate}','{$receivedDate}')";
$result=mysqli_query($dbc,$query);
$message="<b><p>Name: {$rawMaterialName}<br>SKU: {$sku}<br> Weight: {$weight} <br>added! </b>";
$flag=1;
//flag here
}
 
}/*End of main Submit conditional*/


if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}


/*
rawMaterialName
SKU
Qty -> weight
Expiry Date
Production Date
Received Date
//location
*/


?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add New Product: </legend>

<p>RawMaterial Name: <input type="text" name="rawMaterialName" size="20" maxlength="30" value="<?php if (isset($_POST['rawMaterialName']) && !$flag) echo $_POST['rawMaterialName']; ?>"/>
<p>SKU: <input type="text" name="sku" size="20" maxlength="30" value="<?php if (isset($_POST['sku']) && !$flag) echo $_POST['sku']; ?>"/>
<p> Weight: <input type="text" name="weight" size="20" maxlength="30" value="<?php if (isset($_POST['weight']) && !$flag) echo $_POST['weight']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Add!" /></div>
</fieldset>
</form>
<p>
<a href="admin.php">Return to dashboard</a>
