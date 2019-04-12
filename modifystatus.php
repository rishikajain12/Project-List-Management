<?php error_reporting('E_NOTICE') ?>
<?php 
include('connection.php');
session_start();  
if(empty($_SESSION['user_id']) OR empty($_SESSION['password']) ) {  
  
   header('Location: index.php?login=access_denied' );   
}  ?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Projects List Management System</title>
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
	<P style="font: 12px/17px arial, sans-serif;
color: rgb(50, 50, 50); float:right; margin-top:-40px;"><?php
			//mag show sang information sang user nga nag login
			$user_id=$_SESSION['user_id'];
			
			$result=mysqli_query($conn,"select * from user where username='$user_id'")or die(mysqli_error($conn));
			$date=mysqli_query($conn,"SELECT curdate() as date");
			$row=mysqli_fetch_array($result);
			$d=mysqli_fetch_array($date);
			$Name=$row['username'];
			
echo 'Currrent date:<a href="calender.php" title="click to view calendar"><font color="blue" face=""> <a href="calender.php"> ' .$d['date'].'&nbsp;&nbsp;&nbsp;</font></a><img src="images/admin.png"> logged in as <<font color="red"> '.$Name.'</font>>';?>
  <a href="logout.php" class="logout">Logout</a></P>
	<?php 
 $id=$_REQUEST['id'];
$sel=mysqli_query($conn,"SELECT * FROM Implementation_status WHERE Proj_code='$id'");

$fetch=mysqli_fetch_array($sel);


?>
		<h1>Modify project status</h1>
		<form method="post">
	<table class="ptable">
  <tr>
    <td>Project code</td>
    <td><input type="text" name="pcode" readonly="readonly" value="<?php echo $fetch[0] ?>"   /></td>
    <td>Implem code</td>
    <td><input type="text" name="icode" value="<?php echo $fetch[1] ?>"   /></td>
  </tr>
  <tr>
    <td>Project Scenario</td>
    <td><textarea name="istatus" rows="3" ><?php echo $fetch[2] ?></textarea></td>
    <td>Project status</td>
    <td><select name="pstatus" >
						<?php
						
		               echo '<option value="'.$fetch[3].'">'.$fetch[3].'</option>';
			
						?>
	<option value="Completed">Completed</option>
	<option value="Running">Running</option>
	<option value="Stalled">Stalled</option>
	<option value="Terminated">Terminated</option>
	</select></td>
  </tr>
  <tr>
    <td>Remarks</td>
    <td><textarea name="rmarks" rows="3" ><?php echo $fetch[4] ?></textarea></td>
    <td>Action required</td>
    <td><textarea name="areq" rows="3" ><?php echo $fetch[5] ?></textarea></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" name="isub"/></td>
  </tr>
  
</table>
		</form>
	<?php	
	
	if (isset($_POST['isub'])) {
	
// get the posted data
$pcode = $_REQUEST['pcode'];
$icode= $_REQUEST['icode'];
$istatus= $_REQUEST['istatus'];
$pstatus=$_REQUEST['pstatus'];
$rmarks=$_REQUEST['rmarks'];
$areq = $_REQUEST['areq'];
//BACKUP

$Bpcode = $fetch['Proj_code'];
$Bicode= $fetch[1];
$Bistatus= $fetch[2];
$Bpstatus=$fetch[3];
$Brmarks=$fetch[4];
$Bareq = $fetch[5];
$s=mysqli_query($conn,"SELECT * FROM general_information WHERE Proj_code='$Bpcode'");

$f=mysqli_fetch_array($s);
$g=$f['Project_name'];

$backup=mysqli_query($conn,"INSERT INTO backup(Proj_code,Project_name,Impl_code,Impl_status,Proj_status,Remarks,Action_required,update_date) VALUES('$g','$Bpcode','$Bicode','$Bistatus','$Bpstatus','$Brmarks','$Bareq',curdate())");
if(!$backup){
echo mysqli_error($conn);
}

$update=mysqli_query($conn,"UPDATE Implementation_status SET impl_code='$icode',Impl_status='$istatus', Proj_status='$pstatus', Remarks='$rmarks',Action_required='$areq' WHERE Proj_code='$pcode' ");
if($update){
echo '<font color="green">Project details successully updated.. Old info kept</font> ';
echo '<meta content="2;home.php?action=sop" http-equiv="refresh" />';

}else {
echo mysqli_error($conn);

}
}
?>		
	</div>
	<div id="columnB">
	<!---side bar slide --->
	
	
	
        <div class="row">

            <div class="col-lg-12">

                <div class="panel-group" id="accordion">
				<!--- test all--->
				
				<!--- stop--->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="home.php?action=pdetails">
                        PROJECT DETAILS
                  </a>
                            </h4>
                        </div>
                        
                    </div>
					
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="home.php?action=impstatus">
                        PROJECT SCENARIO
                  </a>
                            </h4>
                        </div>
                        
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        VIEW REPORTS
                  </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
							<ol>
					<li class="odd"><a href="home.php?action=pmr">project monitoring report</a></li>
					
					<li class="odd"><a href="?action=pmr">project monitoring report</a></li>
							    <li class="even"><a href="getprojinfo.php">Standard project report</a></li>
								<li class="odd"><a href="home.php?action=sop">status of projects</a></li>
								<li class="even"><a href="home.php?action=comp">completed projects</a></li>
								<li class="odd"><a href="home.php?action=runp">running projects</a></li>
								<li class="even"><a href="home.php?action=stp">stalled projects</a></li>
								<li class="odd"> <a href="home.php?action=term">Terminated projects</a></li>
								<li class="even"><a href="home.php?action=notes">other notifications</a></li>
								<li class="even"><a href="home.php?action=back"><font color="#CC6633"><i>BACK UP OF PROJECTS STATUS</i></font></a></li>
 							</ol>
                            </div>
                        </div>
                    </div>
                   <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                               <a  href="logout.php" onclick="alert('You are about to log out. Refresh the page  to cancel or click OK button to continue')">
                        CLOSE APPLICATION
                  </a>
                            </h4>
                        </div>
                        
                    </div>
                    </div>

                </div>

            </div>

        
	
	
	
	<!--- side bar slide --->
	
	</div>
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
