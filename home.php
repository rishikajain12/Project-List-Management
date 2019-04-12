<?php error_reporting('E_NOTICE') ?>
<?php 
include('connection.php');
session_start();  
if(empty($_SESSION['user_id']) OR empty($_SESSION['password']) ) {  
  
   header('Location: index.php?login=access_denied' );   
}  
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Project List Management System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="date/htmlDatepicker.css" rel="stylesheet" />
	<script language="JavaScript" src="date/htmlDatepicker.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/boxOver.js"></script>
	<script type="text/javascript">

   function enterNumber(){

  var e = document.getElementById('this');

  if (!/^[0-9]+$/.test(e.value)) 
{ 
alert("Please enter onyl number.");
e.value = e.value.substring(0,e.value.length-1);
}
}   

</script>
	<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    //if (charCode > 31 && (charCode < 48 || charCode > 57))
	if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}</script>
<script>
function showprojectdetails(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";//txtHint is an event handler 
  return;
  }
if (window.XMLHttpRequest)  //XMLHttp request object is created and we are checking whether ajax works in diffrent browsers..i.e we are checking browser compatibity
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()//xmlhttprequest object is configured
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)//asyncronous request to web server
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getprojinfo.php?q="+str,true);
xmlhttp.send();
}
</script>
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
	$action=$_REQUEST['action'];
	if($action=='pdetails'){
	 ?>
		<h1>Enter new project details</h1>



		<form method="post">
	<table class="ptable">
  <tr>
    <td>Project code</td>
    <td><input type="text" name="pcode"   required /></td>
    <td>Project name</td>
    <td><input type="text" name="pname" required /></td>
  </tr>
  
  <tr>
    <td>Project mentor</td>
	<td><input type="text" name="fund"   required /></td>
    <td>Appears in business plan</td>
    <td><input type="radio" name="inbzp" value="YES" required />YES<input type="radio" name="inbzp" value="NO"  />NO</td>
  </tr>
  <tr>
    <td>Team Leader</td>
    <td><input type="text" id="SelectedDate" name='initdate' /></td>
    <td>Team Member1</td>
    <td><input type="text" name="costInit" required id="this"   /></td>
  </tr>
  <tr>
    <td>Team Member2</td>
    <td><input type="text" name="pimpl"   /></td>
    <td>Team Member3</td>
    <td><input type="text" name="pman"  /></td>
  </tr>
  <tr>
    <td>Team Member4</td>
    <td><input type="text" name="pcoo"  /></td>
    <td>Team Member5</td>
    <td><input type="text" id="SelectedDate" name='contd'  /></td>
  </tr>
  <tr>
    <td>project purpose</td>
    <td><textarea name="ppose" rows="3"   ></textarea></td>
    <td>Scope</td>
    <td><textarea name="pscope" rows="3"  ></textarea></td>
  </tr>
  <tr>
    <td>Github URL</td>
    <td><input type="text" name="ccost"  id="this"   /></td>
  
    <td>planned completion(days)</td>
    <td><?php 
				  $op;
				  for($t=1;$t<=500;$t++){
				 $op.="<option value=".$t.">".$t."</option>";
				  
				  }
				  ?>
                <select name="pcdays" >
                  <?php  echo $op; ?>
                </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Impl start date</td>
    <td><input type="text" id="SelectedDate" name='impstartdate' readonly onClick="GetDate(this)" placeholder='select date' /></td>
    <td>imple end date</td>
    <td><input type="text" id="SelectedDate" name='impenddate' readonly onClick="GetDate(this)" placeholder='select date'  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" name="submit"/></td>
  </tr>
  
</table>
		</form>
	<?php	
	
	if (isset($_POST['submit'])) {
	
// get the posted data
 $pcode =trim($_POST['pcode']);
 $pname = trim($_POST['pname']);
 //$prcode= trim($_POST['prcode']);
//$prtype=trim($_POST['prtype']);
 $fund=trim($_POST['fund']);
 $inbusplan = trim($_POST['inbzp']);
 $initdate = trim($_POST['initdate']);
 $costInit = trim($_POST['costInit']);
$pimpl=trim($_POST['pimpl']);
 $pman=trim($_POST ['pman']);
 $pcoo=trim($_POST ['pcoo']);
 $contdate = trim($_POST ['contd']);

$pscope=trim($_POST ['pscope']);
$ppose = trim($_POST ['ppose']);
 //$pcost = trim($_POST ['pcost']);
 $ccost=trim($_POST ['ccost']);
 $pcdays=trim($_POST ['pcdays']);
 $impstartdate=trim($_POST ['impenddate']);
 $impenddate=trim($_POST ['impenddate']);


$checkpcode=mysqli_query($conn,"SELECT * FROM General_Information where 1 and Proj_code='$pcode'");
  $outpcode=mysqli_fetch_array($checkpcode);
   $rowpcode=mysqli_num_rows($checkpcode);
 if($rowpcode > 0 ){
 echo '<font color=red size=-1>Project code exists. please chose different project code.</font><br/>';

 }
else if( $pcode=="")
{
 echo '<font color=red size=-1>Project code, name can\' t be empty, please fill all the fields. </font><br/>';

}else{

$insert_data = mysqli_query($conn,"INSERT INTO General_information VALUES( '$pcode', '$pname', '$fund', '$inbusplan','$initdate','$costInit', '$pimpl', '$pman','$pcoo','$contdate', '$pscope', '$ppose','$ccost','$pcdays', '$impstartdate', '$impenddate')");
if($insert_data){
echo '<font color="green">Project details successully stored</font> ';
echo '<meta content="2;projectInfo.php" http-equiv="refresh" />';
}else {
echo mysqli_error($conn);
}
}
 }
	}else if($action=='impstatus'){
	$result = mysqli_query($conn,"SELECT Proj_code FROM General_information WHERE 1 AND Proj_code  NOT IN (SELECT Proj_code FROM Implementation_Status)   ");
	$rows=mysqli_num_rows($result);
	if($rows <1){
	echo 'no project details found. <a href="home.php?action=sop">view implementation status</a>';
	}else{ 
	
	?>
		<h1>ENTER PROJECT SCENARIO</h1>
	<form method="post">
	<table class="ptable" >
  <tr>
    <td>Project</td>
    <td> <select  name="pcode" onChange="showpname(this.value)"  >
            
            <?php  
$result = mysqli_query($conn,"SELECT Proj_code,Project_name  FROM General_information WHERE 1 AND Proj_code  NOT IN (SELECT Proj_code FROM Implementation_Status)   ");
		while($row = mysqli_fetch_array($result))
			{  
				echo '<option value="'.$row['Proj_code'].'">';
				echo $row['Project_name'];
				echo '</option>';
			}
		?>
          </select>
		  
		  
		  </td>
		<!---  <tr>
    <td>Project</td>
    <td><p id="txtHint"></p></td</tr> --->
    
    <td>Implementaion code</td>
    <td><input type="text" name="implcode" required  /></td>
  </tr>
  <tr>
    <td>Project Scenario</td>
    <td><textarea name="impstatus" rows="3"   ></textarea></td>
    <td>Project status</td>
    <td><select name="pstatus">

	<option value="Completed">Completed</option>
	<option value="Running">Running</option>
	<option value="Stalled">Stalled</option>
	<option value="Terminated">Terminated</option>
	</select></td>
	
  </tr>
   <tr>
    <td>Remarks</td>
    <td><textarea name="remarks" rows="3"   ></textarea></td>
    <td>Action Required</td>
    <td><textarea name="actreq" rows="3"  ></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" name="sub"/></td>
  </tr>
  </table>
  </form>
		
		<?php 
		
		
		}
			
	if (isset($_POST['sub'])) {
	
// get the posted data
$pcod = ( htmlspecialchars( $_POST['pcode']));
$implcode = $_POST['implcode'];
$impstatus= $_POST['impstatus'];
$pstatus=$_POST['pstatus'];
$remarks=$_POST['remarks'];
$actreq = $_POST['actreq'];


$insert_info = mysqli_query($conn,"INSERT INTO Implementation_status VALUES( '$pcod', '$implcode', '$impstatus', '$pstatus', '$remarks', '$actreq')");
	if($insert_info){
echo '<font color="green">implementation status successully stored</font> ';
echo '<meta content="2;home.php?action=sop" http-equiv="refresh" />';
}else {
echo mysqli_error($conn);


}
 }
		
		
		}else if($action==pmr){
		
		
		
		header('location:projectInfo.php');
		
		
		}else if($action==sop){
		
		echo'<h1>Viewing Project Scenario</h1>';
				 include('connection.php');
				    $sel=mysqli_query($conn,"SELECT * FROM  General_information, Implementation_status where General_information.Proj_code=Implementation_status.Proj_code");
					
					$rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'the is No project under implementation. click <a href="home.php?action=impstatus">here</a> to enter implementation status';
		 
		 }else{
		 
		 
			?>					<script language="javascript">
function caaictpms()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>'); 
      docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Status of Projects</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<div  id="print_content">
                         <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
		  
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project Name</th><th>Implementation code</th><th align=left>Project Scenario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			</th><th>project status</th><th>remarks</th><th>action required</th><th>Edit</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_status'].'</td><td>'.$fetch['Proj_status'].'</td><td>'.$fetch['Remarks'].'</td><td>'.$fetch['Action_required'].'</td><td><a href=modifystatus.php?id='.$fetch['Proj_code'].'><img src="images/edit-icon.png" width=15 height=15 title=MODIFY_RECORD /></a></td><!---<td><a href=deletestatus.php?id='.$fetch['Proj_code'].'><img src="images/deletee.ico" width="15" height="15" title=DELETE_RECORD /></a></td>---></tr>';
			  
			$flag=$flag+1;
			}
			echo '</table>';
			
						
				}?>
				</div>
		<?php 
		
		}else if($action==comp){
				
		echo '<h1>completed projects</h1>';
		
		$selects=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information
		 WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='Completed'");
		 $rowscheck=mysqli_num_rows($selects);
		 if($rowscheck < 1){
		 echo 'No completed project(s)';
		 
		 }else{
		 
			?>					<script language="javascript">
function caaictpms()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>'); 
      docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Completed Projects</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<div  id="print_content">
                           <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
		
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project  code</th><th>Project name</th><th>Implementation code</th><th>Implementation startDate</th><th>endDate</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($selects)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
			 $flag++;
			}
			echo '</table>';
			echo '</div>';
	
			
		}
		}else if($action==runp){
		echo '<h1>running projects</h1>';
		$selec=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information
		 WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='running'");
		 
		 $rowscheck=mysqli_num_rows($selec);
		 if($rowscheck < 1){
		 echo 'No running project(s)';
		 
		 }else{
		 ?>
		 		<script language="javascript">
function caaictp()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_conte").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>'); 
      docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Running Projects</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
		 <div  id="print_conte">
                          <a href="javascript:caaictp()"><img src="images/Print.png" width="30" height="30" /></a><br/>
						  
	 
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project  code</th><th>Project name</th><th>Implementation code</th><th>Implementation startDate</th><th>endDate</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($selec)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
			 $flag++;
			}
			echo '</table>';

		
          echo '</div>';
	
			
		}
		}else if($action==stp){
		echo '<h1>stalled project</h1>';
		$sel=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information
		 WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='stalled'");
		 $rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'No stalled project(s)';
		 
		 }else{
		 
		 ?>
		 		<script language="javascript">
function caaictp()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_conte").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>');
   docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Stalled Projects</P>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
		 <div  id="print_conte">
		 <a href="javascript:caaictp()"><img src="images/Print.png" width="30" height="30" /></a><br/>
   
						
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project  code</th><th>Project name</th><th>Implementation code</th><th>Implementation startDate</th><th>endDate</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
			 $flag++;
			}
			echo '</table>';
		
			 echo '</div>';
	
			
		}
		}else if($action==notes){
		
		echo 'other notifications<br/>';
		$compdate=mysqli_query($conn,"SELECT *FROM General_information, Implementation_status  WHERE General_information.Proj_code=Implementation_status.Proj_code AND Impl_EndDate < curdate() ");
		
		$rowscheck=mysqli_num_rows($compdate);
		if($rowscheck <1){
		echo '<br/><font color=red>Not available </font>';
		}
		while($fetch=mysqli_fetch_array($compdate)){
			echo 'Project <font color=red>['.$fetch['Project_name']. ']</font> with implementation code <font color=red> ['.$fetch['Impl_code']. '] </font>has passed its compeletion time <br/>';
			
			
			}
			echo '</table>';
		
		
		}else if($action=='term'){
		
		echo '<h1>Terminated projects</h1>';
		$sel=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information
		 WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='terminated'");
		 $rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'No terminated project(s)';
		 
		 }else{
		 
		 ?>
		 		<script language="javascript">
function caaictp()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_conte").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>'); 
      docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Terminated Projects</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
		 <div  id="print_conte">
                          <a href="javascript:caaictp()"><img src="images/Print.png" width="30" height="30" /></a><br/>
						  
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project  code</th><th>Project name</th><th>Implementation code</th><th>Implementation startDate</th><th>endDate</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
			$flag++; 
			}
			echo '</table>';
		
			 echo '</div>';
	
			
		}
		}else if($action=='back'){
		echo'<h1>Projects status backups</h1>';
				 include('connection.php');
				    $sel=mysqli_query($conn,"SELECT * FROM  backup");
					
					$rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'Back up not available. click <a href="home.php?action=sop">here</a> to view projects status';
		 
		 }else{
		 
		 
			?>					<script language="javascript">
function caaictpms()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>CAA ICT projects monitoring system </title>'); 
   docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Projects Status back up information</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<div  id="print_content">
                           <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
		 
		 <?php
			echo '<table style="" id="results">';
			echo '<tr style="background:#0066FF; color:white"><th>Project Name</th><th>Implementation code</th><th align=left>implementation status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			</th><th>project status</th><th>remarks</th><th>action required</th><th>Date modified</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_status'].'</td><td>'.$fetch['Proj_status'].'</td><td>'.$fetch['Remarks'].'</td><td>'.$fetch['Action_required'].'</td><td>'.$fetch['update_date'].'</td></tr>';
			  
			$flag=$flag+1;
			}
			echo '</table>';
			
						
				}?>
				</div>
		<?php 
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
                                <a  href="?action=pdetails">
                        PROJECT DETAILS
                  </a>
                            </h4>
                        </div>
                        
                    </div>
					
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="?action=impstatus">
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
								
                                <li class="odd"><a href="?action=pmr">project monitoring report</a></li>
							    <li class="even"><a href="getprojinfo.php">Standard project report</a></li>
								<li class="odd"><a href="?action=sop">status of projects</a></li>
								<li class="even"><a href="?action=comp">completed projects</a></li>
								<li class="odd"><a href="?action=runp">running projects</a></li>
								<li class="even"><a href="?action=stp">stalled projects</a></li>
								<li class="odd"> <a href="?action=term">Terminated projects</a></li>
								<li class="even"><a href="?action=notes">other notifications</a></li>
								<li class="even"><a href="?action=back"><font color="#CC6633"><i>BACK UP OF PROJECTS STATUS</i></font></a></li>
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
