<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<Form Name ="form1" Method ="POST" ACTION = "action.php">

<label>Username: </label>
<input type="text" name="username" id="username" required="required" placeholder="username"/><br/><br />

<label>Password: </label>
<input type="password" name="password" id="password" required="required" placeholder="password"/><br/><br />

<input type="submit" value=" Submit " name="submit"/><br />

</form>
</form>
</body>
</html> -->
<?php
session_start();
if (isset($_REQUEST['error']))
{
	$msg="<span style='color:red'>Invalid Login Details</span>";
}
if (isset($_REQUEST['lout'])) 
{
	unset($_SESSION['UserData']['username']);
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="usrlogin.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>OPTYMONEY</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/l.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form name="form1" Method ="POST" ACTION = "action.php">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input  type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div><br /><br /> <center>
						  <input   type="submit" value="submit" name="submit"/><center>
					</form>

					<?= $msg; ?>
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
				
				</div>
				 
			</div>
		</div>
	</div>
</body>
</html>
