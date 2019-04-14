
<?php error_reporting('E_NOTICE') ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> PROJECTS LIST MANAGEMENT SYSTEM | Detailed</title>
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
			<h1 class="head2"> PROJECTS LIST MANAGEMENT SYSTEM <h1>
		</div>
		<div id="content">
			<div id="columnAAA">
				<script language="javascript">
					function caaictpms()
					{ 
						var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
						disp_setting+="scrollbars=yes"; 
						var content_vlue = document.getElementById("print_content").innerHTML; 
						var docprint=window.open("","",disp_setting); 
						docprint.document.open(); 
						docprint.document.write('<html><body><head><title> i3 PROJECTS LIST MANAGEMENT SYSTEM </title>'); 
						docprint.document.write('<p align="center"><FONT size="+1"><img src="images/logo.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Projects Details</P>');
						docprint.document.write('</head><body onLoad="self.print()" style="width:500px; font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
						docprint.document.write(content_vlue);          
						docprint.document.write('</body></html>'); 
						docprint.document.close(); 
						docprint.focus(); 
					}
				</script>
					  
	            <a href="dirDash.php?action=spr"><img src="images/28.png"  width="" height="40"/></a>
		        <h2>Viewing Project(s) Information</h2>
				<h1>View <a href="?action=detailed">Detailed</a> | <a href="?action=lessdetailed">Less Detailed</a></h1>
				<div>
	<?php
					$action=$_REQUEST['action'];
					if($action=='detailed')
					{
						include('connection.php');
						$sel=mysqli_query($conn,"SELECT * FROM General_information");
						$rowscheck=mysqli_num_rows($sel);
						if($rowscheck < 1){
							echo 'There is No any project(s) to view';
						}else{
							echo '	<div id="print_content">';
							echo '<p ><a href="javascript:caaictpms()"><img src="images/Print.png" width="30" height="30" /></a></p>';
							echo '<table style="" id="results" >';
							echo '<tr style="background:#0066FF; color:white"><th>Project Code</th><th>Project Name</th><th>Project Mentor</th><th>Planned</th><th>Team Leader</th><th>Team Mem1</th><th>Team Mem2</th><th>Team Mem3</th><th>Team Mem4</th><th>Team Mem5</th><th>Scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Purpose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Github URL</th><th>Planned Completion(days)</th><th>Implementation Start-Date</th><th>Implementation End-Date</th></tr>';
							$flag=0;
							while($fetch=mysqli_fetch_array($sel))
							{
								if($flag%2==0)
									echo '<tr bgcolor=#E5E5E5>';
								else
									echo '<tr bgcolor=white>';
									echo '<td>'.$fetch['0'].'</td><td>'.$fetch['1'].'</td><td>'.$fetch['2'].'</td><td>'.$fetch['3'].'</td><td>'.$fetch['4'].'</td><td>'.$fetch['5'].'</td><td>'.$fetch['6'].'</td><td>'.$fetch['7'].'</td><td>'.$fetch['8'].'</td><td>'.$fetch['9'].'</td><td>'.$fetch['10'].'</td><td>'.$fetch['11'].'</td><td>'.$fetch['12'].'</td><td>'.$fetch['13'].'</td><td>'.$fetch['14'].'</td><td>'.$fetch['15'].'</td><!---<td><a href=modifyProject.php?id='.$fetch['Proj_code'].'><img src="images/edit-icon.png" width=30 height=30 title=MODIFY_RECORD /></a></td><td><a href=deleteProject.php?id='.$fetch['Proj_code'].'><img src="images/deletee.ico" width="30" height="30" title=DELETE_RECORD /></a></td>---></tr>';
									$flag=$flag+1;
							}
							echo '</table>';
						}
						if (isset($_POST['pint']))
						{
	?>
							<div align="center" id="print_content">
	<?php
								include('connection.php');
								$sel=mysqli_query($conn,"SELECT * FROM General_information");
								$rowscheck=mysqli_num_rows($sel);
								if($rowscheck < 1)
								{
									echo 'There is no any project(s) to view';
								}else{
									echo '<br/><p ><a href="javascript:caaictpms()">Click</a></p>';
									echo '<p><font size=+2>i3 PROJECTS LIST MANAGEMENT SYSTEM </font></p>';
									echo '<table   id="results">';
									echo '<tr style="background:#0066FF; color:white"><th>Project Code</th><th>Project Name</th><th>Procurement Code</th><th>Procurement Type</th><th>Funding</th><th>Planned</th><th>Date of initiation</th><th>Cost at inititiation</th><th>Project Implementer</th><th>Project Manager</th><th>Project Coordinator</th><th>Purpose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Contract Date</th><th>Planed Cost</th><th>Current Cost</th><th>Planned Completion (days)</th><th>Implementation Start-Date</th><th>Implementation End-Date</th></tr>';
									$flag=0;
									while($fetch=mysqli_fetch_array($sel))
									{
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
							echo '	<div id="print_content">';
							echo '<p ><a href="javascript:caaictpms()"><img src="images/Print.png" width="30" height="30" /></a></p>';
							echo '<table style="" id="results" >';
							echo '<tr style="background:#0066FF; color:white"><th>Project Name</th><th>Project Implementer</th><th>Project Manager</th><th>Purpose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Scope&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>GitHub URL</th><th>Implementation Start-Date</th><th>Implementation End-Date</th></tr>';
							$flag=0;
							while($fetch=mysqli_fetch_array($sel)){
								if($flag%2==0)
									echo '<tr bgcolor=#E5E5E5>';
								else
									echo '<tr bgcolor=white>';
									echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['project_mentor'].'</td><td>'.$fetch['team_leader'].'</td><td>'.$fetch['Purpose'].'</td><td>'.$fetch['Scope'].'</td><td>'.$fetch['github_url'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td</tr>';
									$flag=$flag+1;
							}
							echo '</table>';
						}
						$sel=mysqli_query($conn,"SELECT * FROM General_information");
						$rowscheck=mysqli_num_rows($sel);
					}
	?>
					</div>
				</div>
			</div>
		</div>

		<!-- JavaScript -->
	    <script src="js/jquery-1.10.2.js"></script>
	    <script src="js/bootstrap.js"></script>
	    <script src="js/modern-business.js"></script>
	</body>
</html>
