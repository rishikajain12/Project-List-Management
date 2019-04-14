<?php error_reporting('E_NOTICE') ?>
<?php
	include('connection.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> PROJECTS LIST MANAGEMENT SYSTEM | Dashboard</title>
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
			function enterNumber() {
				var e = document.getElementById('this');
				if (!/^[0-9]+$/.test(e.value)) {alert("Please enter onyl number.");
					e.value = e.value.substring(0,e.value.length-1);
				}
			}
		</script>
		<script type="text/javascript">
			function isNumberKey(evt) {
				var charCode = (evt.which) ? evt.which : event.keyCode
				//if (charCode > 31 && (charCode < 48 || charCode > 57))
				if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
					return false;
				return true;
			}
		</script>
		<script>
			function showprojectdetails(str) {
				if (str=="") {
					document.getElementById("txtHint").innerHTML="";//txtHint is an event handler
					return;
				}
				if (window.XMLHttpRequest)  //XMLHttp request object is created and we are checking whether ajax works in diffrent browsers..i.e we are checking browser compatibity
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				} else {
					// code for IE6, IE5
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
			<h1 class="head2"> PROJECTS LIST MANAGEMENT SYSTEM </h1>
		</div>
		<div id="content"><div>
		<div id="columnA">
			<div style="float:left;">
				<form  method="post">
					<h2 style="display: inline-block; font-size: 25px;">Project Code : </h2>
					<input value="" name="pcode" required="true" />
	<?php
					$result = mysqli_query($conn,"SELECT *FROM General_information WHERE 1 AND Proj_code IN (SELECT Proj_code FROM Implementation_Status) ");
	?>
					<br><br>
					<input type="submit" value="Submit" name="Go" style="margin-left: 45%; font-size:25; height:40px;" />
				</form>
			</div>
	<?php
			if (isset($_POST['Go'])) {
				$q=$_POST["pcode"];
				$con = mysqli_connect('localhost', 'root', '12345');
				if (!$con) {
					die('Could not connect: ' . mysqli_error($con));
				} else {
					mysqli_select_db($con,"ictpms");
					$sql= "SELECT * FROM General_information,Implementation_status WHERE 1 AND General_information.Proj_code=Implementation_status.Proj_code AND Implementation_status.Proj_code ='$q'";
					$result1 = mysqli_query($con,$sql);
					while( $row = mysqli_fetch_array( $result1)) {
	?>
						<script language="javascript">
							function caaictpms() {
								var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
								disp_setting+="scrollbars=yes";
								var content_vlue = document.getElementById("print_content").innerHTML;
								var docprint=window.open("","",disp_setting);
								docprint.document.open();
								docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>');
								docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center">  Project Report</P>');
								docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
								docprint.document.write(content_vlue);
								docprint.document.write('</body></html>');
								docprint.document.close();
								docprint.focus();
							}
						</script>
						<div  id="print_content" style="margin-top:30px;float:left">
							<p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
							<table class="tablea" style="text-align: left;">
								<tr>
									<th >Project Name</th>
									<td><?php echo    ': <b>'.( htmlspecialchars( $row['Project_name'] ) ).'</b>'; ?></td>
								</tr>
								<tr>
									<th >Project Implementer</th>
									<td><?php echo ': '.( htmlspecialchars( $row['project_mentor'] ) ); ?></td>
								</tr>
								<tr>
									<th >Project Managers</th>
									<td><?php echo ': '.( htmlspecialchars( $row['team_leader'] ) ); ?></td>
								</tr>
								<tr>
									<th >Project Particulars</th>
									<td> :  See details below</td>
								</tr>
							</table>
							<table  border="1" class="tableb" cellpadding="0" cellspacing="0">
								<tr>
									<td>(a) Purpose </td>
									<td><?php echo( htmlspecialchars( $row['Purpose'] ) ); ?></td>
								</tr>
								<tr>
									<td>(b) Scope of Work </td>
									<td><?php echo( htmlspecialchars( $row['Scope'] ) ); ?></td>
								</tr>
								<tr>
									<td>(e) Project Scenario </td>
									<td><?php echo( htmlspecialchars( $row['Impl_status'] ) ); ?></td>
								</tr>
								<tr>
									<td>(f) Github URL</td>
									<td><?php echo( htmlspecialchars( $row['github_url'] ) ); ?></td>
								</tr>
								<tr>
									<td>(g) Remarks on Success/Failure/Delay </td>
									<td><?php echo( htmlspecialchars( $row['Remarks'] ) ); ?></td>
								</tr>
								<tr>
									<td>(h) Action Required </td>
									<td><?php echo( htmlspecialchars( $row['Action_required'] ) ); ?></td>
								</tr>
							</table>
	<?php
					}
				}
			}if(isset($_POST['view'])) {
				$q=$_POST["noproj"];
				$con = mysqli_connect('localhost', 'root', '12345');
				if (!$con) {
					die('Could not connect: ' . mysqli_error($con));
				} else {
					mysqli_select_db($con,"ictpms");
					$sql= "SELECT * FROM General_information,Implementation_status WHERE 1 AND General_information.Proj_code=Implementation_status.Proj_code LIMIT $q";
					$r=mysqli_num_rows($sql);
					$result1 = mysqli_query($con,$sql);
					//echo 'Displaying '.$q. ' out of '. $r . 'projects';
	?>
					<script language="javascript">
						function caaictpms() {
							var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,";
							disp_setting+="scrollbars=yes";
							var content_vlue = document.getElementById("print_contents").innerHTML;
							var docprint=window.open("","",disp_setting);
							docprint.document.open();
							docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>');
							docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Projects Reports</P>');
							docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
							docprint.document.write(content_vlue);
							docprint.document.write('</body></html>');
							docprint.document.close();
							docprint.focus();
						}
					</script>
					<div id="print_contents" style="margin-top:30px;float:left">
						<p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
	<?php
						while( $row = mysqli_fetch_array( $result1)) {
	?>
							<table class="tablea" style="text-align:left;">
								<tr>
									<th >Project Name</th>
									<td><?php echo    ': <b>'.( htmlspecialchars( $row['Project_name'] ) ).'</b>'; ?></td>
								</tr>
								<tr>
									<th >Project Implementer</th>
									<td><?php echo ': '.( htmlspecialchars( $row['project_mentor'] ) ); ?></td>
								</tr>
								<tr>
									<th >Project Managers title</th>
									<td><?php echo ': '.( htmlspecialchars( $row['team_leader'] ) ); ?></td>
								</tr>
								<tr>
									<th >Project Particulars</th>
									<td> :  See Details below</td>
								</tr>
							</table>
							<table  border="1" class="tableb" cellpadding="0" cellspacing="0">
								<tr>
									<td>(a)  Purpose</td>
									<td><?php echo( htmlspecialchars( $row['Purpose'] ) ); ?></td>
								</tr>
								<tr>
									<td>(b)  Scope of Work</td>
									<td><?php echo( htmlspecialchars( $row['Scope'] ) ); ?></td>
								</tr>
								<tr>
									<td>(e) Project Scenario </td>
									<td><?php echo( htmlspecialchars( $row['Impl_status'] ) ); ?></td>
								</tr>
								<tr>
									<td>(f) GitHub URL</td>
									<td><?php echo( htmlspecialchars( $row['github_url'] ) ); ?></td>
								</tr>
								<tr>
									<td>(g)Remarks on Success/Failure/Delay</td>
									<td><?php echo( htmlspecialchars( $row['Remarks'] ) ); ?></td>
								</tr>
								<tr>
									<td>(h)  Action Required</td>
									<td><?php echo( htmlspecialchars( $row['Action_required'] ) ); ?></td>
								</tr>
							</table><br><hr>
	<?php
						}
					}
				}
	?>
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

  
