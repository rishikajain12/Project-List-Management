<?php include('connection.php')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project List Management System</title>
</head>

<body>
<?php 
	 $id=$_REQUEST['id'];
	 $query=mysqli_query($conn,"DELETE FROM Implementation_status WHERE 1 AND Proj_code='$id'");
	 
	    header('location:home.php?action=sop');	 
	 ?>

  </p>
</div>
</body>
</html>
