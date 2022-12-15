<?php
session_start();
require('db.php');
error_reporting(~E_NOTICE);
DATE_DEFAULT_TIMEZONE_SET('AFRICA/NAIROBI');
if(isset($_POST['register']))
{
	$name=strip_tags($_POST['name']);
	$email=strip_tags($_POST['email']);
	$password=strip_tags($_POST['password']);
	$name=filter_var($name,FILTER_SANITIZE_STRING);
	$email=filter_var($email,FILTER_VALIDATE_EMAIL);
	$gender=strip_tags($_POST['gender']);
	$gender=filter_var($gender,FILTER_SANITIZE_STRING);
	$time=date('y-m-d h:i:s',time());
	$date=date('y-m-d',strtotime('now'));
if(empty($name))
{
	$_SESSION['msg'] = "Name is Required";
}
elseif(!filter_var($name,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
{
	$_SESSION['msg']="Name contain invalid characters";
}
elseif(empty($email))
{
	$_SESSION['msg']="email required";
}
elseif(empty($password))
{
	$_SESSION['msg'] = "password required";
}
elseif(empty($gender))
{
	$_SESSION['msg'] = "gender required";
}
	elseif(!isset($_SESSION['msg']))
	{	
$encrypt=password_hash($password,PASSWORD_DEFAULT);
$sth=$db->prepare("INSERT INTO users(name,email,password,gender,time,date)VALUES(?,?,?,?,?,?)");
$sth->bindparam(1,$name,PDO::PARAM_STR);
$sth->bindparam(2,$email,PDO::PARAM_STR);
$sth->bindparam(3,$encrypt,PDO::PARAM_STR);
$sth->bindparam(4,$gender,PDO::PARAM_STR);
$sth->bindparam(5,$time);
$sth->bindparam(6,$date);
$sth->execute();
header("location:index.php");
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
                    <input type="text" class="form-control" name="name" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name" value="<?php echo $name;?>">
                     </div> 
				      <div class="form-group">
                       <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          </div>
                           <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                             <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                              </div>
							   <div class="form-group">
							    <label for="exampleInputGender1">Gender</label>
							     <select class="form-control" name="gender" id="exampleInputGender1">
								  <option>MALE</option>
								   <option>FEMALE</option>
								    <option>NONE OF THE ABOVE</option>
								     </select>
								      </div>
	                                       <button type="submit" name="register" class="btn btn-primary">Submit</button>

											</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
 </html>