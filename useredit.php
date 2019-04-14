<?php error_reporting('E_NOTICE') ?>
<?php 
	include('connection.php');
	session_start();  
	if(empty($_SESSION['user_id']) OR empty($_SESSION['password']) ) {
		header('Location: index.php' );   
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> PROJECTS LIST MANAGEMENT SYSTEM | Edit User Info </title>
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
			<h1><img src="images/logo2.png" />Innovation Incubation Industry</h1>
		</div>
		<div id="menu">
			<h1 class="head2"> PROJECTS LIST MANAGEMENT SYSTEM </h1>
		</div>
		<div id="content">
			<div id="columnA">
	<?php 
				$id=$_REQUEST['userid'];
				$out=mysqli_query($conn,"SELECT * FROM user WHERE user_id='$id' ");
				$fetch=mysqli_fetch_array($out);
	?>		
				<p>Modify User Entries </p>
				<form method="post">
					<table id="utable">
						<tr><td>User_id</td><td><input type="text" name="uid" readonly="readonly" value="<?php echo $fetch[0] ?>" maxlength="8"/></td></tr>
						<tr><td>Name</td><td><input type="text" name="name" value="<?php echo $fetch[1] ?>"/></td></tr>
						<tr><td>Department</td><td><input type="text" name="dep" value="<?php echo $fetch[2] ?>"/></td></tr>
						<tr><td>Role</td><td><input type="text" name="role" value="<?php echo $fetch[3] ?>" /></td></tr>
						<tr><td>Email Address</td><td><input type="email" name="email" required value="<?php echo $fetch[4] ?>" /></td></tr>
						<tr><td>User Name</td><td><input type="text" name="uname"  required value="<?php echo $fetch[5] ?>" /></td></tr>
						<tr><td>Password</td><td><input type="text" name="pwd"   value="" required/></td></tr>
						<tr><td></td><td><input type="submit" name="up" value="Update User"  /></td></tr>
					</table>
				</form>
	<?php
				if(isset($_POST['up']))
				{
					$uids = $_REQUEST['uid'];
					$name = $_REQUEST['name'];
					$dep= $_REQUEST['dep'];
					$role=$_REQUEST['role'];
					$email=$_REQUEST['email'];
					$uname = $_REQUEST['uname'];
					$password=$_REQUEST['pwd'];
					$pass=md5($password);
					$pwd=mysqli_query($conn,"SELECT password FROM user WHERE user_id='$uids' ");
					$fetch=mysqli_fetch_array($pwd);
					if($password="")
					{
						$pass=$fetch['password'];
					}else {
						$pass=$pass;
					}
					$update=mysqli_query($conn,"UPDATE user SET name='$name',department='$dep',role='$role', email_address='$email',username='$uname', password='$pass' WHERE user_id='$uids' ");
					if($update){
						echo '<font color="green">User information updated</font> ';
						echo '<a href="index.php?action=login">login</a>';
					}else{
						echo mysqli_error($conn);
					}
				}
	?>
			</div>
			<div class="panel panel-default" id="userw">
				<div class="panel-heading">
					<h4 class="panel-title"> MANAGE USERS </h4>
				</div></br>
				<div class="panel-heading">
					<h4 class="panel-title"> <a href="index.php?action=adduser"> Add User </a> </h4>
				</div></br>
				<div class="panel-heading">
					<h4 class="panel-title"> <a href="index.php?action=uedit">Edit User information</a> </h4>
				</div></br>
				<div class="panel-heading">
					<h4 class="panel-title"> <a href="dirLogin.php?action=login">login</a> </h4>
				</div>
			</div>
		</div>
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
