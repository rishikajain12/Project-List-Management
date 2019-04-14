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
					<input type="submit" name="login" value="login" class="sub" />
					</form>
					<p id="for"><a href="#index.php?action=uedit"></a></p>
				      <?php
					  
					  
	if (isset($_POST['login'])){ 
	
	include_once("connection.php");
	$username=$_POST['username'];
	$password=$_POST['password'];
	$pass=md5($password);
	

	//$sql = mysql_query("INSERT INTO user(username,password) VALUES('$username', '$pass')");
	
	$uselect = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
	$result = mysqli_query($conn,$uselect); 
	    $rows = mysqli_num_rows($result);
		$fetchdata=mysqli_fetch_array($result); 
		if($rows){
		session_start();
		//session_register("user_id", "username");  
		$_SESSION['user_id']=$_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		header("location:home.php?action=pdetails");

	
	}else if($username =="" || $password ==""){
	echo '<p style="text-align:center"><font color="red" size="-1" >You forgot to fill all the fields </font></p>';
	}
	
	else{
	echo '<p style="text-align:center"><font color="red" size="-1" >Wrong username or password! Try again</font></p>';
	}
	}
	}else if($action=='adduser'){
	?>
	<h1>Add user</h1>
	<form method="post">
	<table id="utable">
	<tr><td>User_id:</td><td><input type="text" name="uid"  required  /></td></tr>
	<tr><td>Name:</td><td><input type="text" name="name" /></td></tr>
	<tr><td>Department:	</td><td><input type="text" name="dep" /></td></tr>
	<tr><td>Role:</td><td><input type="text" name="role"  /></td></tr>
	<tr><td>Email address *:	</td><td><input type="email" name="email" required /></td></tr>
	<tr><td>User name *:</td><td><input type="text" name="uname"  required /></td></tr>
	<tr><td>Password *:	</td><td><input type="password" name="pwd" required /></td></tr>
	<tr><td></td><td><input type="submit" name="Submit" value="AddUser" /></td></tr>
	</table>
	</form>
	 <a href="index.php?action=login"> login</a> 
	<?php
	if(isset($_POST['Submit'])){
	$uid=$_POST['uid'];
	$name=$_POST['name'];
	$dep=$_POST['dep'];
	$role=$_POST['role'];
	$email=$_POST['email'];
	$username=$_POST['uname'];
	$pwd=$_POST['pwd'];
	$pwds=md5($pwd);
	
	$sel=mysqli_query($conn,"SELECT *FROM user WHERE username='$username'");
	$ro=mysqli_num_rows($sel);
	if ($ro > 0 ){
	echo 'Sory! username is in use by someone else. please chose another username';
	}else if($username==""){
	echo '<br/>You forgot to enter username.username and password can\'t be empty<br/>';
	}else if($pwd==""){
	echo 'You forgot to enter password.password can\'t be empty<br/>';
	}else{
	$adduser=mysqli_query($conn,"INSERT INTO user(user_id,name,department,role,email_address,username,password) VALUES('$uid', '$name', '$dep', '$role', '$email', '$username','$pwds' )");
	if(!$adduser){
	echo mysqli_error($conn);
	}else {
	echo 'User added succefully. ';
	}
	
	}
	}
	
	}else if($action=='uedit'){
	?>
	<h1>Select user to view details</h1>
	<?php
		$sql = "select count(user_id) as total from user";
		$result = mysqli_query($conn,$sql);
		$data = mysqli_fetch_assoc($result);
		echo 'Total Faculties Registered: '.$data['total'];
		
		
	?>
	<form method="post" action="useredit.php">
	 
	 <select name="userid">
                <?php
						$sel=mysqli_query($conn,"SELECT *FROM user ");
						while($fetch=mysqli_fetch_array($sel)){
		               echo '<option value="'.$fetch['user_id'].'">'.$fetch['username'].'</option>';
			}
						?>
	
	</select>
	
	 <input type="submit" name="go" value="click" />
	</form>
	
	
	<?php
	
	

	}else if($action=='deleteuser'){
	?>
	<h1>Select used to delete</h1>
	<form method="post">
	 
	 <select name="userid">
                <?php
						$sel=mysqli_query($conn,"SELECT *FROM user ");
						while($fetch=mysqli_fetch_array($sel)){
		               echo '<option value="'.$fetch['user_id'].'">'.$fetch['username'].'</option>';
			}
						?>
	
	</select>
	
	 <input type="submit" name="delete"  value="Delete User" />
	</form>
	
	<?php
	if(isset($_POST['delete'])){
	
	
	 $id=$_POST['userid'];
	 $query=mysqli_query($conn,"DELETE FROM user WHERE 1 AND user_id='$id'");
	 if($query){
	  echo 'user has been deleted';
	  echo '<meta content="2;login.php?action=deleteuser" http-equiv="refresh" />';
	  
	 }else{
	
	 echo 'please click delete button again';
	 
	 }
	 
	
	}
	}

?>
</div>
<div class="panel panel-default" id="userw">
                        <div class="panel-heading">
                            <h4 class="panel-title">
							<a href="?action=login"></a>
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >
                        MANAGE USERS
                  </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
							<ol id="user">
                                <li class="odd"><a href="?action=adduser" onclick="var admin=prompt('Enter Security Code');if(admin=='admin') return true; else  return false;">Add User</a></li>
								<li class="even"><a href="?action=uedit" onclick="var admins=prompt('Enter Security Code');if(admins=='admin') return true; else  return false;">Edit User information</a></li>
								<li class="even"><a href="?action=deleteuser" onclick="var admins=prompt('Enter Security Code');if(admins=='admin') return true; else  return false;">Delete user</a></li>
								<li class="odd"><a href="?action=login">login</a></li>
								
 							</ol>
                            </div>
                        </div>
                   
					</div>
</div>
	</div>
	<div id="columnB">
	<!---side bar slide --->
	
	
	    
</div>
<div id="footer">
	<p>Copyright &copy; I3. Designed by <a href="rishikajainranu@gmail.com" class="link1">Rishika and team</a></p>
</div>


<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>
</body>
</html>
