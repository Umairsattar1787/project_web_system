<?php
require('db.php');
error_reporting(~E_NOTICE);
DATE_DEFAULT_TIMEZONE_SET('AFRICA/NAIROBI');
session_start();
$stmt=$db->prepare("select name,admin_id from admin where admin_id=:aid");
$stmt->execute(array(':aid'=>$_SESSION['userSession']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$count=$stmt->rowCount();
$nn=$row['name'];
echo $name;
if(isset($_POST['add']))
{
	$mname=strip_tags($_POST['mname']);
	$email=strip_tags($_POST['email']);
	$gender=strip_tags($_POST['gender']);
    $mname=filter_var($mname,FILTER_SANITIZE_STRING);
	$email=filter_var($email,FILTER_VALIDATE_EMAIL);
	$gender=filter_var($gender,FILTER_SANITIZE_STRING);
	$time=date('y-m-d h:i:s',time());
	$date=date('y-m-d',time());
	$status="active";
	if(empty($mname))
	{
		$_SESSION['msg']="Name required";
	}
	elseif(!filter_var($mname,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
	{
		$_SESSION['msg']="Name contain invalid characters";
	}
	elseif(empty($email))
	{
		$_SESSION['msg']="Email is required";
	}
	elseif(empty($_POST['gender']))
	{
		$_SESSION['msg']="Gender is Required";
	}
	elseif(!isset($_SESSION['msg']))
	{
		$stmt=$db->prepare('insert into members(mname,email,gender,time,date,name,status,user_id)values(?,?,?,?,?,?,?,?)');
		$stmt->bindparam(1,$mname);
		$stmt->bindparam(2,$email);
		$stmt->bindparam(3,$gender);
		$stmt->bindparam(4,$time);
		$stmt->bindparam(5,$date);
		$stmt->bindparam(6,$nn);
		$stmt->bindparam(7,$status);
		$stmt->bindparam(8,$_SESSION['userSession']);
		$stmt->execute();
		header("location:admin.php");
	}
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
			 <div class="row justify-content-center">
			  <div class="col-sm-6 col-md-6 col-lg-6">
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
			   <div class="card">
			    <div class="card-body">
				 <form method="post">
                  <div class="form-group">
                   <label for="exampleInputName1">Full name</label>
                    <input type="text" class="form-control" name="mname" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name">
                     </div> 
				      <div class="form-group">
                       <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                         <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div>
                           <div class="form-group">
                            <label for="exampleInputGender1">Gender</label>
                             <select class="form-control" name="gender" id="exampleInputGender1" placeholder="gender">
                              <option>MALE</option>
							  <option>FEMALE</option>
							  <option>NONE OF THE ABOVE</option>
							  </div>
                               </select>
							    <div class="form-group">
                                 <button type="submit" name="add" class="btn btn-primary">Submit</button>
                                  </form>
								   </div>
								   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
 </html>

 