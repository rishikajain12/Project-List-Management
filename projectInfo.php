
<?php error_reporting('E_NOTICE') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Projects List Management System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div id="header">
	<h1><U><img src="images/logo2.png" />Innovation Incubation Industry</U></h1>
	
</div>
<div id="menu">
	<h1 class="head2">PROJECTS MONITORING SYSTEM<h1>
</div>
<div id="content">
<div>


</div>
	<div id="columnAAA">
	            <!--print -->
				
				<script language="javascript">
function caaictpms()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><body><head><title>CAA ICT projects monitoring system </title>'); 
      docprint.document.write('<p align="center"><FONT size="+1"><img src="images/logo.png" >CIVIL AVIATION AUTHORITY</FONT></p><P  align="center">ICT PROJECTS MONITORING SYSTEM</P><BR><P  align="center"> Projects Details</P>');
   docprint.document.write('</head><body onLoad="self.print()" style="width:500px; font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
             
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
				
				
				  <!--end print -->
				  
            <a href="home.php?action=pdetails"><img src="images/28.png"  width="" height="40"/></a><a href="home.php?action=pdetails">go back</a>   	<!---	
				<p>Please select fields to display</p>
			<form  method="post">
			<table><tr><td>
			<input type="checkbox" name="c1" value="Proj_code" />Project Code</input></td><td>
			<input type="checkbox" name="c2" value="Project_name" />Project name</input></td><td>
			<input type="checkbox" name="c3" value="Procurement_code" />Procurement Code</input></td></tr><tr><td>
			<input type="checkbox" name="c4" value="Procurement_type" />Procurement type</input></td><td>
			<input type="checkbox" name="c5" value="Funding" />Funding</input></td><td>
			<input type="checkbox" name="c6" value="AppearsIn_BussPlan" />Appears in business plan</input></td></tr><tr><td>
			<input type="checkbox" name="c7" value="DateOf_initiation" />Date of initiation</input></td><td>
			<input type="checkbox" name="c8" value="CostAt_initiation" />Cost at initiation</input></td><td>
			<input type="checkbox" name="c9" value="Proj_implementer" />Project implementer</input></td></tr><tr><td>
			<input type="checkbox" name="c10" value="Proj_manager" />Project manager</input></td><td>
			<input type="checkbox" name="c11" value="Proj_coordinator" />Project Coordinator</input></td><td>
			<input type="checkbox" name="c12" value="Purpose" />Purpose</input></td></tr><tr><td>
			<input type="checkbox" name="c13" value="Scope" />scope</input></td><td>
			<input type="checkbox" name="c14" value="DateOf_Contract" />Date of contract</input></td><td>
			<input type="checkbox" name="c15" value="Planned_costing" />Planned costing</input></td></tr><tr><td>
			<input type="checkbox" name="c16" value="Current_Costing" />Current costing</input></td><td>
			<input type="checkbox" name="c17" value="Planned_completion" />Planned completion</input></td><td>
			<input type="checkbox" name="c18" value="Impl_StartDate" />impelementation start date</input></td></tr><tr><td colspan="3">
			<input type="checkbox" name="c19" value="Impl_EndDate" />implementation end date</input></td></tr><tr><td>
			<input type="submit" name="retrieve" value="Generate report" /></td></tr>
			</table>
						</form> --->
						<?php 
							 include('connection.php');
						if(isset($_POST['retrieve'])){
						include('connection.php');
						$pcode=$_POST['c1'];
						$pname=$_POST['c2'];
						//$prcode=$_REQUEST['c3'];
						//$ptype=$_REQUEST['c4'];
						$fund=$_REQUEST['c5'];
						$appear=$_REQUEST['c6'];
						$doinit=$_REQUEST['c7'];
						$coinit=$_POST['c8'];
						$pimpl=$_REQUEST['c9'];
						$pman=$_REQUEST['c10'];
						$pcod=$_REQUEST['c11'];
						$ppse=$_REQUEST['c12'];
						$scope=$_REQUEST['c13'];
						$docont=$_REQUEST['c14'];
						//$pcost=$_REQUEST['c15'];
						$ccost=$_REQUEST['c16'];
						$pcomp=$_REQUEST['c17'];
						$implst=$_REQUEST['c18'];
						$implend=$_REQUEST['c19'];
					
						
$get=mysqli_query($conn,"SELECT
" .$pcode. " AS pcode,
" .$pname. " as  pname,
" .$fund. " as fund,
" .$appear. " as appear,
" .$doinit. " as doinit,
" .$coinit. " as initcont,
" .$pimpl. " as pimpl,
" .$pman. " as pman,
" .$pcod. " as pcod,
" .$docont. " as docont,

" .$scope. " as scope,
" .$ppse. " as ppse,
" .$ccost. " as ccost,
" .$pcomp. " as pcomp,
" .$implst. " as implst,
" .$implend. " as implend 
from General_information");

					echo '<table id="results">';
						$flag=0;
					while($fetch=mysqli_fetch_array($get)){
			
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 	
					echo '<tr bgcolor=white>';
echo '<td>'.$fetch['pcode'].'</td><td>'.$fetch['pname'].'</td><td>'.$fetch['fund'].'</td><td>'.$fetch['appear'].'</td><td>'.$fetch['doinit'].'</td><td>'.$fetch['initcont'].'</td><td>'.$fetch['pimpl'].'</td><td>'.$fetch['pman'].'</td><td>'.$fetch['pcod'].'</td><td>'.$fetch['docont'].'</td><td>'.$fetch['scope'].'</td><td>'.$fetch['ppse'].'</td><td>'.$fetch['ccost'].'</td><td>'.$fetch['pcomp'].'</td><td>'.$fetch['implst'].'</td><td>'.$fetch['implend'].'</td></tr>';
$flag++;
						}
						echo '</table>';
						}
						?>
                 <h2>Viewing project(s) information</h2>
			
				<p>View <a href="?action=detailed">detailed</a> | <a href="?action=lessdetailed">less detailed</a></p>
				 <div>
				 
				 <?php
				 $action=$_REQUEST['action'];
				 if($action=='detailed'){
				 
				 
				 include('connection.php');
				    $sel=mysqli_query($conn,"SELECT * FROM General_information");
					$rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'There is no any project(s) to view';
		 
		 }else{
		// echo '<a href=printrecord.php?id='.$fetch['STUDENT_ID'].'><img src="images/Print.png" style="width:50px; height:50px; "  title=print_out_record/></a>';
		
				echo '	<div id="print_content">';
		 echo '<p ><a href="javascript:caaictpms()"><img src="images/Print.png" width="30" height="30" /></a></p>';
		 ?>
		
		 
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project code</th><th>Project name</th><th>Project Mentor</th><th>planned</th><th>Team Leader</th><th>Team Mem1</th><th>Team Mem2</th><th>Team Mem3</th><th>Team Mem4</th><th>Team Mem5</th><th>scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Purpose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Github URL</th><th>planned completion (days)</th><th>implementation start date</th><th>implementation end date</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 		
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['0'].'</td><td>'.$fetch['1'].'</td><td>'.$fetch['2'].'</td><td>'.$fetch['3'].'</td><td>'.$fetch['4'].'</td><td>'.$fetch['5'].'</td><td>'.$fetch['6'].'</td><td>'.$fetch['7'].'</td><td>'.$fetch['8'].'</td><td>'.$fetch['9'].'</td><td>'.$fetch['10'].'</td><td>'.$fetch['11'].'</td><td>'.$fetch['12'].'</td><td>'.$fetch['13'].'</td><td>'.$fetch['14'].'</td><td>'.$fetch['15'].'</td><!---<td><a href=modifyProject.php?id='.$fetch['Proj_code'].'><img src="images/edit-icon.png" width=30 height=30 title=MODIFY_RECORD /></a></td><td><a href=deleteProject.php?id='.$fetch['Proj_code'].'><img src="images/deletee.ico" width="30" height="30" title=DELETE_RECORD /></a></td>---></tr>';

			 
			$flag=$flag+1;
			}
			echo '</table>';
			
			}
			 $sel=mysqli_query($conn,"SELECT * FROM General_information");
					$rowscheck=mysqli_num_rows($sel);
		         if($rowscheck < 1){
				 }else{
				?>
                    <!--<br/>
					<form method="post">
					<input type="submit" value="Print_record" name="pint" />
					</form>-->
					<?php
					}
					if (isset($_POST['pint'])){
					
					 ?>
					<div align="center" id="print_content">
				 <?php
				 include('connection.php');
				    $sel=mysqli_query($conn,"SELECT * FROM General_information");
					$rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'There is no any project(s) to view';
		 
		 }else{
		 echo '<br/><p ><a href="javascript:caaictpms()">Click</a></p>';
		 echo '<p><font size=+2>CIVIL AVIATION AUTHORITY <br/>ICT Projects Monitoring System</font></p>';
			echo '<table   id="results">';
			echo '<tr style="background:#0066FF; color:white"><th>Project code</th><th>Project name</th><th>Procurement code</th><th>Procurement type</th><th>Funding</th><th>planned</th><th>Date of initiation</th><th>cost at inititiation</th><th>Project implementer</th><th>Project manager</th><th>Project coordinator</th><th>Purpose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>contract  date</th><th>planed cost</th><th>current cost</th><th>planned completion (days)</th><th>implementation start date</th><th>implementation end date</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
		if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 		
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['0'].'</td><td>'.$fetch['1'].'</td><td>'.$fetch['2'].'</td><td>'.$fetch['3'].'</td><td>'.$fetch['4'].'</td><td>'.$fetch['5'].'</td><td>'.$fetch['6'].'</td><td>'.$fetch['7'].'</td><td>'.$fetch['8'].'</td><td>'.$fetch['9'].'</td><td>'.$fetch['10'].'</td><td>'.$fetch['11'].'</td><td>'.$fetch['12'].'</td><td>'.$fetch['13'].'</td><td>'.$fetch['14'].'</td><td>'.$fetch['15'].'</td></tr>';
			$flag++; 
			}
			echo '</table>';
			
			}
			
			}
			}else if($action=='lessdetailed'){
			
				 include('connection.php');
				    $sel=mysqli_query($conn,"SELECT * FROM General_information");
					$rowscheck=mysqli_num_rows($sel);
		 if($rowscheck < 1){
		 echo 'There is no any project(s) to view';
		 
		 }else{
		// echo '<a href=printrecord.php?id='.$fetch['STUDENT_ID'].'><img src="images/Print.png" style="width:50px; height:50px; "  title=print_out_record/></a>';
		echo '	<div id="print_content">';
		 echo '<p ><a href="javascript:caaictpms()"><img src="images/Print.png" width="30" height="30" /></a></p>';
		 ?>
		
		 
		 <?php
			echo '<table style="" id="results" >';
			echo '<tr style="background:#0066FF; color:white"><th>Project name</th><th>Project implementer</th><th>Project manager</th><th>Purpose&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>GitHub URL</th><th>implementation start date</th><th>implementation end date</th></tr>';
			$flag=0;
			while($fetch=mysqli_fetch_array($sel)){
			if($flag%2==0)
			echo '<tr bgcolor=#E5E5E5>';
			
	else 		
echo '<tr bgcolor=white>';
echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['project_mentor'].'</td><td>'.$fetch['team_leader'].'</td><td>'.$fetch['Purpose'].'</td><td>'.$fetch['Scope'].'</td><td>'.$fetch['DateOf_Contract'].'</td><td>'.$fetch['github_url'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td</tr>';

			 
			$flag=$flag+1;
			}
			echo '</table>';
			
			}
			 $sel=mysqli_query($conn,"SELECT * FROM General_information");
					$rowscheck=mysqli_num_rows($sel);
		         if($rowscheck < 1){
				 
			
			}
			}
				?>
                    </div> </div>
					  
		</div>					
    	</div>
	<div id="columnB">
	<!---side bar slide --->
	
	</div>
</div>



<!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>
</body>
</html>
