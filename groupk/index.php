<?php
session_start();
include('includes/config.php');
include('includes/inputval.php');
if(isset($_POST['login']))
{
	if ($_POST["verficationcode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')
    {
    echo "<script>alert('Incorrect captcha');</script>" ;
    }
    else
		{
$username=Input::email($_POST['username']);
$password=Input::str($_POST['password']);
$password= hash("sha512",$password);
$stmt=$mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
				$stmt->bind_param('sss',$username,$username,$password);
				$stmt->execute();
				$stmt -> bind_result($username,$username,$password,$id);
				$rs=$stmt->fetch();
				$_SESSION['id']=$id;
				$uip=$_SERVER['REMOTE_ADDR'];
				$ldate=date('d/m/Y h:i:s', time());
				if($rs)
				{
					$uid=$_SESSION['id'];
             $uemail=$_SESSION['login'];
						 $_SESSION['last_login_timestmp']= time();
             $str=rand();
             $result = md5($str);
             $cookie_name=$result;
             $cookie_value= $id;
             setcookie($cookie_name, $cookie_value);
             setcookie($cookie_name, $cookie_value, time() + 3600,"/");
					header("location:dashboard.php");
				}

				else
				{
					echo "<script>alert('Invalid Username/Email or password');</script>";
				}
			}
		}
				?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Admin login</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head
<body>

	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3" style="margin-top:4%">
						<h1 class="text-center text-bold text-light mt-4x">Hostel Management System</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">

								<form action="" class="mt" method="post">
									<label for="" class="text-uppercase text-sm">Your Username or Email</label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">
									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">

									<!--Cpatcha Image -->     <div class="form-group">
														 <input type="text"   name="verficationcode" maxlength="5" autocomplete="off" required  style="width: 200px;"  placeholder="Enter Captcha" autofocus />&nbsp;

														 <img src="captcha.php">
													 </div>   <!--Cpatcha Image -->


									<input type="submit" name="login" class="btn btn-primary btn-block" value="login" >
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
