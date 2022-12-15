<?php
require_once('db.php');
if(isset($_GET['member_id']))
{
	$get_id=$_GET['member_id'];
	$stmt=$db->prepare('select * from members where member_id=?');
	$stmt->execute([$get_id]);
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$count=$stmt->rowCount();
}
?>
<!doctype html>
 <html lang="en-US">
  <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=0.1,shrink-to-fit=no">
	 <link type="text/css" href="/css" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
       <title>Create Read Update Delete</title>
	    <style>
		 </style>
		  </head>
		   <body>
		    <div class="container">
			 <div class="row">
			  <div class="col-sm-12 col-md-12 col-lg-12">
			   <div class="card">
			    <h1 class="card-title">PERSONAL INFORMATIONS</h1>
				<div class="card-body">
				<h2 class="card-header">HELOO BELOW IS YOU INFORMATIONS</h2>
			  <p class="text-danger"><h3>NAME:: <?php echo $row['name']; ?></h3></p>
			  <p class="text-danger"><h3>E-MAIL:: <?php echo $row['email']; ?></h3></p>
			  <p class="text-danger"><h3>ADDED ON:: <?php echo date('h:i:sA',strtotime($row['time'])).'&nbsp;&nbsp'.$row['date']; ?></h3></p>
			  <p class="text-danger"><h3>ADDED BY:: <?php echo $row['name'];?></h3></p>
			 <p class="text-primary" style="border-top:3px solid orange;"></p>
			 <p class="text-primary">EDDITED ON<?php echo date('h:i:sA',strtotime($row['time_edited'])).'&nbsp;&nbsp;'.$row['date_edited'];?></p>
			 </div>
			</div>
		   </div>
		  </div>
		 </div>
		</div>
	   </body>
	  </html>