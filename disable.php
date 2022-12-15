<?php
require('db.php');
error_reporting(~E_NOTICE);
DATE_DEFAULT_TIMEZONE_SET('AFRICA/NAIROBI');
session_start();
if(isset($_GET['member_id']))
{
	$id=$_GET['member_id'];
$stmt=$db->prepare("select * from members where member_id=:mid");
$stmt->execute(array(':mid'=>$id));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();
}
	$status="disable";
		$stmt=$db->prepare('update members set status=? where member_id=?');
	$stmt->bindparam(1,$status);
	$stmt->bindparam(2,$id);
		$stmt->execute();
		header("location:admin.php");
?>
