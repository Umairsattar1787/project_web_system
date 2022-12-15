<?php
require('db.php');
session_start();
if(isset($_SESSION['user']))
{
unset($_SESSION['user']);
session_destroy($_SESSON['user']);
header("location:index.php");
}
elseif(isset($_SESSION['userSession']))
{
unset($_SESSION['userSession']);
session_destroy($_SESSON['userSession']);
header("location:index.php");
}
else
{
	echo "unable to logout";
}
?>






