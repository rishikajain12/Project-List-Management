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
<title>Project List Management System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="date/htmlDatepicker.css" rel="stylesheet" />
	<script language="JavaScript" src="date/htmlDatepicker.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/boxOver.js"></script>
	<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}</script>
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
			
echo 'Currrent date:<a href="calender.php" title="click to view calendar"><font color="blue" face=""> <a href="calender.php"> ' .$d['date'].'&nbsp;&nbsp;&nbsp;</font></a><img src="images/admin.png"> logged in as <<font color="red"> '.$Name.'</font>>';?>  <a href="logout.php" class="logout">Logout</a></P>
	<?php 
 $id=$_REQUEST['id'];

$sel=mysqli_query($conn,"SELECT * FROM General_information WHERE Proj_code='$id'");

$fetch=mysqli_fetch_array($sel);


?>
		<h1>Modify project</h1>
		<form method="post">
	<table class="ptable">
  <tr>
    <td>Project code</td>
    <td><input type="text" name="pcode" readonly="readonly" value="<?php echo $fetch[0] ?>"  maxlength="8" /></td>
    <td>Project name</td>
    <td><input type="text" name="pname" value="<?php echo $fetch[1] ?>" /></td>
  </tr>
  <tr>
    <td>Procurement code</td>
    <td><input type="text" name="prcode"  value="<?php echo $fetch[2] ?>"  maxlength="8" /></td>
    <td>Procrement type</td>
    <td><select name="prtype" >
						<?php
						
		               echo '<option value="'.$fetch['3'].'">'.$fetch['3'].'</option>';
			
						?>
	<option value="Contract">Contract</option>
	<option value="LPO">LPO</option>
	</select></td>
  </tr>
  <tr>
    <td>Funding</td>
    <td><select name="fund">
                <?php
						
		               echo '<option value="'.$fetch['4'].'">'.$fetch['4'].'</option>';
			
						?>
	<option value="Capex">Capex</option>
	<option value="Support Programme">Support Programme</option>
	</select></td>
    <td>Appears in business plan</td>
    <td><input type="radio" name="inbzp" value="YES" required />YES<input type="radio" name="inbzp" value="NO" required />NO</td>
  </tr>
  <tr>
    <td>Date of initiation</td>
    <td><input type="text" id="SelectedDate" name='initdate' readonly onClick="GetDate(this)" placeholder='select date' 
	value="<?php echo $fetch[6] ?>" /></td>
    <td>Cost at initiation</td>
    <td><input type="someid" name="costInit" value="<?php echo $fetch[7] ?>" id="this" onkeypress="return isNumberKey(event)" title="header=[Enter numbers only] body=[&nbsp;] fade=[on]"/></td>
  </tr>
  <tr>
    <td>Project Implementer</td>
    <td><input type="text" name="pimpl" value="<?php echo $fetch[8] ?>" /></td>
    <td>Project Manager</td>
    <td><input type="text" name="pman" value="<?php echo $fetch[9] ?>" /></td>
  </tr>
  <tr>
    <td>Project Coordinator</td>
    <td><input type="text" name="pcoo" value="<?php echo $fetch[10] ?>" /></td>
    <td>Date of contract</td>
    <td><input type="text" id="SelectedDate" name='contd' readonly onClick="GetDate(this)"  src="" value="<?php echo $fetch[13] ?>" /></td>
  </tr>
  <tr>
    <td>project purpose</td>
    <td><textarea name="ppose" rows="3" ><?php echo $fetch[11] ?></textarea></td>
    <td>Scope</td>
    <td><textarea name="pscope" rows="3" ><?php echo $fetch[12] ?></textarea></td>
  </tr>
  <tr>
    <td>Planned costing</td>
    <td><input type="someid" name="pcost" value="<?php echo $fetch[14] ?>" maxlength="11" id="this" onkeypress="return isNumberKey(event)" title="header=[Enter numbers only] body=[&nbsp;] fade=[on]"/></td>
    <td>Current costing</td>
    <td><input type="someid" name="ccost" value="<?php echo $fetch[15] ?>" maxlength="11"id="this" onkeypress="return isNumberKey(event)" title="header=[Enter numbers only] body=[&nbsp;] fade=[on]" /></td>
  </tr>
  <tr>
    <td>planned completion(days)</td>
    <td><?php 
				  $op;
				  for($t=1;$t<=500;$t++){
				 $op.="<option value=".$t.">".$t."</option>";
				  
				  }
				  ?>
                <select name="pcdays" >
				
                  <?php 
				  echo '<option value="'.$fetch['16'].'">'.$fetch['16'].'</option>';
				   echo $op; ?>
                </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Impl start date</td>
    <td><input type="text" id="SelectedDate" name='impstartdate' readonly onClick="GetDate(this)" placeholder='select date' 
	value="<?php echo $fetch[17] ?>" /></td>
    <td>imple end date</td>
    <td><input type="text" id="SelectedDate" name='impenddate' readonly onClick="GetDate(this)" placeholder='select date'
	value="<?php echo $fetch[18] ?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" name="submit"/></td>
  </tr>
  
</table>
		</form>
	<?php	
	
	if (isset($_POST['submit'])) {
	
// get the posted data
$pcode = $_REQUEST['pcode'];
$pname = $_REQUEST['pname'];
$prcode= $_REQUEST['prcode'];
$prtype=$_REQUEST['prtype'];
$fund=$_REQUEST['fund'];
$inbusplan = $_REQUEST['inbzp'];
$initdate = $_REQUEST['initdate'];
$costInit = $_REQUEST['costInit'];
$pimpl=$_REQUEST['pimpl'];
$pman=$_REQUEST['pman'];
$pcoo=$_REQUEST['pcoo'];
$contdate = $_REQUEST['contd'];
$ppose = $_REQUEST['ppose'];
$pscope=$_REQUEST['pscope'];
$pcost = $_REQUEST['pcost'];
$ccost=$_REQUEST['ccost'];
$pcdays=$_REQUEST['pcdays'];
$impstartdate=$_REQUEST['impenddate'];
$impenddate=$_REQUEST['impenddate'];

if(empty($pcode) ||empty($pname) ||empty($prcode) || empty($prtype) || empty($fund) || empty($inbusplan)
 ||empty($initdate)|| empty($costInit) ||empty($pimpl) || empty($pman) || empty($pcoo) || empty($contdate) || empty($ppose)|| empty($pscope)||empty($pcost)|| empty($ccost) || empty($pcdays) || empty($impstartdate) ||empty($impenddate)||$rowpcode>0)
{
 echo '<font color=red size=-1>please fill all the fileds</font><br/>';

}else{
$update=mysqli_query($conn,"UPDATE General_information SET project_name='$pname',Procurement_code='$prcode',Procurement_type='$prtype', Funding='$fund',AppearsIn_BussPlan='$inbusplan', DateOf_initiation='$initdate', CostAt_initiation='$costInit', Proj_implementer='$pimpl', Proj_manager='$pman', Proj_coordinator='$pcoo', Purpose='$ppose', Scope='$pscope', DateOf_Contract='$contdate', Planned_costing='$pcost', Current_Costing='$ccost', Planned_completion='$pcdays', Impl_StartDate='$impstartdate', Impl_EndDate='$impenddate' WHERE Proj_code='$pcode' ");
if($update){
echo '<font color="green">Project details successully updated</font> ';
 echo '<meta content="2;projectInfo.php" http-equiv="refresh" />';

}else {
echo mysqli_error($conn);
}
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
                        IMPLEMENTATION STATUS
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
					
					<li class="even"><a href="home.php?action=sop">status of projects</a></li>
					<li class="odd"><a href="home.php?action=comp">completed projects</a></li>
					<li class="even"><a href="home.php?action=runp">running projects</a></li>
					<li class="odd"><a href="home.php?action=stp">stalled projects</a></li>
					<li class="even"><a href="home.php?action=notes">other notifications</a></li>
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
