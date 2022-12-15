<?php
require("db.php");
error_reporting(~E_NOTICE);
session_start();
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}
	$stmt=$db->prepare("select * from users where user_id=:aid ");
	$stmt->execute(array(':aid'=>$_SESSION['user']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();

?>
<!doctype html>
 <html lang="en">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width user-scalable=no,shrink-to-fit=no">
	 <link type="text/css" href="/css" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <title>Create Read Update Delete</title>
	    <style>
		 </style>
		  </head>
		   <body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
    </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
           <a class="nav-link" href="logout.php?logout">Log out</a>
            </li>
			 <li class="nav-item">
           <a class="nav-link">Hello !<?php  echo $row['name'];?></a>
            </li>
                          </div>
                         </nav>
                    <div class="container">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
<table class="table">
<?php
	if(isset($_SESSION['msg']))
	{
			?>
<?php
echo $_SESSION['msg'];
?>
            <?php
			unset($_SESSION['msg']);
	}
		?>  
<form method="post" action="delete_all.php">
<thead>
<tr>
   <th scope="col">Name</th>
   <th scope="col">Email</th>
   <th scope="col">Gender</th>
   <th scope="col">View</th>
   </tr>
   </thead>
<tbody>
 <?php
$query=$db->query('select * from members where status = "active" ');
while($roww=$query->fetch(PDO::FETCH_ASSOC))
{
	?>
   <tr>
   <td><?php echo $roww["mname"]; ?></td>
   <td><?php echo $roww["email"]; ?></td>
   <td><?php echo $roww["gender"]; ?></td>
   <td><a href="view.php?member_id=<?php echo $roww['member_id'];?>">View</a></td>
 </tr>
   <?php
 }
 ?>
 </tbody>
</table>
 