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
					<script language="javascript">
function caaictpms()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
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
				
				
	
	<P style="font: 12px/17px arial, sans-serif;
color: rgb(50, 50, 50); float:right; margin-top:-40px;">
<?php
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
	$id=$_POST['id'];

mysqli_select_db($conn,"ictpms");
$sql= "SELECT * FROM General_information,Implementation_status WHERE 1 AND General_information.Proj_code=Implementation_status.Proj_code AND Implementation_status.Proj_code ='$id'";

$result1 = mysqli_query($conn,$sql);



while( $row = mysqli_fetch_array( $result1))
 {
 ?>
<div  id="print_content">
 <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
<br/><br/>
 <table class="tablea">

  <tr>
    <th>Project Name</th>
    <td><?php echo    ': <b>'.( htmlspecialchars( $row['Project_name'] ) ).'</b>'; ?></td>
    
  </tr>
  <tr>
    <th >Project Implementer</th>
    <td><?php echo ': '.( htmlspecialchars( $row['Proj_implementer'] ) ); ?></td>
    
  </tr>
  <tr>
    <th >Procurement code</th>
    <td><?php echo ': '.( htmlspecialchars( $row['Procurement_code'] ) ); ?></td>
    
  </tr><tr>
    <th >Project Managers title</th>
    <td><?php echo ': '.( htmlspecialchars( $row['Proj_manager'] ) ); ?></td>
    
  </tr>
<tr>
    <th >Project Particulars</th>
    <td> :  See details below</td>
    
  </tr>

</table>

<table  class="tableb" border="1" >
  <tr>
    <td>(a)  Purpose</td>
    <td><?php echo( htmlspecialchars( $row['Purpose'] ) ); ?></td>
  </tr>
  <tr>
    <td>(b)  Scope of Work</td>
    <td><?php echo( htmlspecialchars( $row['Scope'] ) ); ?></td>
  </tr>
  <tr>
    <td>(c) Contract signing</td>
    <td><?php echo( htmlspecialchars( $row['DateOf_Contract'] ) ); ?></td>
  </tr>
  <tr>
    <td>(d)  Planned Contract Sum</td>
    <td><?php echo( htmlspecialchars( $row['Planned_costing'] ) ); ?></td>
  </tr>
  <tr>
    <td>(e) Status of Implementation </td>
    <td><?php echo( htmlspecialchars( $row['Impl_status'] ) ); ?></td>
  </tr>
  <tr>
    <td>(f) Current Costing</td>
    <td><?php echo( htmlspecialchars( $row['Current_Costing'] ) ); ?></td>
  </tr>
  <tr>
    <td>(g)Remarks on Success/Failure/Delay
</td>
    <td><?php echo( htmlspecialchars( $row['Remarks'] ) ); ?></td>
  </tr>
  <tr>
    <td>(h)  Action Required</td>
    <td><?php echo( htmlspecialchars( $row['Action_required'] ) ); ?></td>
  </tr>
</table>

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
                                <a  href="home.php?action=pdetails">
                        PROJECT DETAILS
                  </a>
                            </h4>
                        </div>
                        
                    </div>
					
                    <div class="panel panel-default" >
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
							    <li class="even"><a href="home.php?action=oneproj">Standard project report</a></li>
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
							<a  href="logout.php" onClick="alert('You are about to log out. Refresh the page  to cancel or click OK button to continue')">
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

  
