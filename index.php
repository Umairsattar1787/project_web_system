<?php
require('db.php');
session_start();
if(isset($_POST['login']))
{
	$name=strip_tags($_POST['name']);
	$password=strip_tags($_POST['password']);
	$name=filter_var($name,FILTER_SANITIZE_STRING);
	if(empty($name))
{
	$_SESSION['msg']= "Name required";
}
elseif(!filter_var($name,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/"))))
{
	$_SESSION['msg']="Name contain invalid characters";
}
else if(empty($password))
{
	$_SESSION['msg']= "Password required";
}
if(!isset($_SESSION['msg']))
{
	$query = $db->prepare("SELECT user_id, name, password FROM users WHERE name=?");
	$query->execute([$name]);
	$row=$query->fetch(PDO::FETCH_ASSOC);
	$count = $query->rowcount(); 
	if (password_verify($password, $row['password']) && $count==1) {
		$_SESSION['user'] = $row['user_id'];
		header("Location: home.php");
	}
$admin = $db->prepare("SELECT admin_id, name, password,role FROM admin WHERE name=?");
	$admin->execute([$name]);
	$admin_row=$admin->fetch(PDO::FETCH_ASSOC);
	$admin_count = $admin->rowCount();
	if (password_verify($password, $admin_row['password']) && $admin_count==1)
	{
		$_SESSION['userSession'] = $admin_row['admin_id'];
		header("location: admin.php");
	}
	else
	{
		$_SESSION['msg']="Invalid name or password";
	}
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
				 <form method="post" accept-charset="utf-8">
                  <div class="form-group">
                   <label for="exampleInputName1">Full name</label>
                    <input type="text" class="form-control" name="name" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name">
                     </div> 
                           <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                             <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                              </div>
                                   <button type="submit" name="login" class="btn btn-primary">Submit</button>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
 </html>