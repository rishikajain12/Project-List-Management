<?php error_reporting('E_NOTICE') ?>
<?php 
	include('connection.php');
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Project List Management System</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="default.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="date/htmlDatepicker.css" rel="stylesheet" />
	<script language="JavaScript" src="date/htmlDatepicker.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
	<div id="header">
		<h1><U><img src="images/logo2.png" />Innovation Incubation Industry</U></h1>

	</div>
	<div id="menu">
		<h1 class="head2">PROJECTS MONITORING SYSTEM</h1>
	</div>
	<div id="content">
		<div id="columnA">
			<?php
				$action=$_REQUEST['action'];
	 			if($action=='login'){
	 		?>		
    		<h1>LOGIN</h1>
	 		<div class="login" >
	  
	   			<form method="post" class="lform">
					<label for="username">Username</label>
					<input type="text" name="username"  />
					<label for="password">Password</label>
					<input type="password" name="password" class="input"  />
					<input type="submit" name="login" value="Login" class="sub" />
				</form>


				<?php
					   
					if (isset($_POST['login'])){ 
	
						include_once("connection.php");
						$username=$_POST['username'];
						$password=$_POST['password'];
						$pass=md5($password);
	

						$uselect = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
						$result = mysqli_query($conn,$uselect); 
					    $rows = mysqli_num_rows($result);
						$fetchdata=mysqli_fetch_array($result); 
						if($rows){
							session_start();  
							$_SESSION['user_id']=$_POST['username'];
							$_SESSION['password'] = $_POST['password'];
							header("location:getprojinfo.php?action=oneproj");

						
						}else if($username =="" || $password ==""){
							echo '<p style="text-align:center"><font color="red" size="-1" >You forgot to fill all the fields </font></p>';
						}
							
						else{
							echo '<p style="text-align:center"><font color="red" size="-1" >Wrong username or password! Try again</font></p>';
						}
					}
				}
				?>
				
		</div>

	</div>
	<div id="columnB">
	<!---side bar slide --->
	
	</div>
	<div id="footer">
		<p>Copyright &copy; I3. Designed by <a href="mailto:rishikajainranu@gmail.com" style="color:white; font-size: 13px;"><strong>Rishika and Team</strong></a></p>
	</div>


<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>
</body>
</html>