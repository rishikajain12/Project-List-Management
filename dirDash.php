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
        <title>Project List Management System | Dashboard</title>
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
                if (!/^[0-9]+$/.test(e.value)) {
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
            <h1 class="head2">PROJECTS LIST MONITORING SYSTEM</h1>
        </div>
        <div id="content">
            <div>
            <div id="columnA">
                <P style="font: 12px/17px arial, sans-serif; color: rgb(50, 50, 50); float:right; margin-top:-40px;">
    <?php
                    //mag show sang information sang user nga nag login
                    $user_id=$_SESSION['user_id'];
                    $result=mysqli_query($conn,"select * from user where username='$user_id'")or die(mysqli_error($conn));
                    $date=mysqli_query($conn,"SELECT curdate() as date");
                    $row=mysqli_fetch_array($result);
                    $d=mysqli_fetch_array($date);
                    $Name=$row['username'];
                    echo 'Currrent date:<a href="calender.php" title="Click to view calendar"><font color="blue" face=""> <a href="calender.php"> ' .$d['date'].'&nbsp;&nbsp;&nbsp;</font></a><img src="images/admin.png"> logged in as <<font color="red"> '.$Name.'</font>>';?>
                    <a href="logout.php" class="logout">Logout</a>
                </P>
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
										<th >Project Managers title</th>
										<td><?php echo ': '.( htmlspecialchars( $row['team_leader'] ) ); ?></td>
										
									  </tr>
									<tr>
										<th >Project Particulars</th>
										<td> :  See details below</td>
										
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
										<td>(f) Github URL</td>
										<td><?php echo( htmlspecialchars( $row['github_url'] ) ); ?></td>
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
                    }
                }
                if(isset($_POST['view'])) {
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
                        <div  id="print_contents" style="margin-top:30px;float:left">
                            <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
    <?php
                            while( $row = mysqli_fetch_array( $result1)) {
    ?>
                                <table class="tablea" style="text-align: left;" >
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
    <td> :  See details below</td>
    
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
    <td>(f) Github URL</td>
    <td><?php echo( htmlspecialchars( $row['github_url'] ) ); ?></td>
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


                                </table> <br><hr>
    <?php
                            }
  ?>
                        </div>
  <?php
                    }
                }

                $action=$_REQUEST['action'];

                if($action=='spr')
                {
    ?>
                <div id="content">
                    <div id="columnA">
                    <div style="float:left;">
                        <form  method="post">
                            <select  name="pcode" >
                                <option value="" required> ---Select Project--- </option>
    <?php
                                $result = mysqli_query($conn,"SELECT *FROM General_information WHERE 1 AND Proj_code IN (SELECT Proj_code FROM Implementation_Status)   ");
                                while($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row['Proj_code'].'">';
                                    echo $row['Project_name'];
                                    echo '</option>';
                                }
    ?>
                            </select><br><br>
                            <input type="submit" value="Submit" name="Go" />
                        </form>
                    </div>
    <?php
                }else if($action==pmr)
                {
                    header('location:projectInfo.php');

                }else if($action==sop)
                {
                    echo'<h1> Viewing Implementation Status </h1>';
                    include('connection.php');
                    $sel=mysqli_query($conn,"SELECT * FROM  General_information, Implementation_status where General_information.Proj_code=Implementation_status.Proj_code");
                    $rowscheck=mysqli_num_rows($sel);
                    if($rowscheck < 1){
                        echo 'There is no Project Under Implementation.';
                    }else{
    ?>
                       <script language="javascript">
                            function caaictpms(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_content").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3  PROJECTS LIST MANAGEMENT SYSTEM </title>');
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Completed Projects</P>');
                                docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
                                docprint.document.write(content_vlue);          
                                docprint.document.write('</body></html>'); 
                                docprint.document.close(); 
                                docprint.focus(); 
                            }
                        </script>
                        <div  id="print_content">
                            <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p>
    <?php
                            echo '<table style="" id="results" >';
                            echo '<tr style="background:#0066FF; color:white"><th>Project Name</th><th>Implementation Code</th><th align=left>Implementation Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </th><th>Project Status</th><th>Remarks</th><th>Action Required</th></tr>';
                            $flag=0;
                            while($fetch=mysqli_fetch_array($sel)){
                            if($flag%2==0)
                            echo '<tr bgcolor=#E5E5E5>';
                            else 
                            echo '<tr bgcolor=white>';
                            echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_status'].'</td><td>'.$fetch['Proj_status'].'</td><td>'.$fetch['Remarks'].'</td><td>'.$fetch['Action_required'].'</td></tr>';
                            $flag=$flag+1;
                            }
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }else if($action==comp){
                    echo '<h1>Completed Projects</h1>';
                    $selects=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='Completed'");
                    $rowscheck=mysqli_num_rows($selects);
                    if($rowscheck < 1){
                        echo 'No Completed Project(s)';
                    }else{
    ?>
                        <script language="javascript">
                            function caaictpms(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_content").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3  PROJECTS LIST MANAGEMENT SYSTEM </title>');
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Completed Projects</P>');
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
                            echo '<tr style="background:#0066FF; color:white"><th>Project Code</th><th>Project Name</th><th>Implementation Code</th><th> Start-Date</th><th>End-Date</th></tr>';
                            $flag=0;
                            while($fetch=mysqli_fetch_array($selects)){
                                if($flag%2==0)
                                    echo '<tr bgcolor=#E5E5E5>';
                                else 
                                   echo '<tr bgcolor=white>';
                                   echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
                                   $flag++;
                            }
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }else if($action==runp){
                    echo '<h1>running projects</h1>';
                    $selec=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='running'");
                    $rowscheck=mysqli_num_rows($selec);
                    if($rowscheck < 1){
                        echo 'No running project(s)';
                    }else{
    ?>
                        <script language="javascript">
                            function caaictp(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_conte").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>'); 
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Running Projects</P>');
                                docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
                                docprint.document.write(content_vlue);          
                                docprint.document.write('</body></html>'); 
                                docprint.document.close(); 
                                docprint.focus(); 
                            }
                        </script>
                        <div  id="print_conte">
                            <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
    <?php
                            echo '<table style="" id="results" >';
                            echo '<tr style="background:#0066FF; color:white"><th>Project Code</th><th>Project Name</th><th>Implementation Code</th><th>Start-Date</th><th>End-Date</th></tr>';
                            $flag=0;
                            while($fetch=mysqli_fetch_array($selec)){
                                if($flag%2==0)
                                    echo '<tr bgcolor=#E5E5E5>';
                                else 
                                    echo '<tr bgcolor=white>';
                                    echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
                                    $flag++;
                            }
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }else if($action==stp){
                    echo '<h1>stalled project</h1>';
                    $sel=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='stalled'");
                    $rowscheck=mysqli_num_rows($sel);
                    if($rowscheck < 1){
                        echo 'No stalled project(s)';
                    }else{
    ?>
                        <script language="javascript">
                            function caaictp(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_conte").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>');
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Stalled Projects</P>'); 
                                docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
                                docprint.document.write(content_vlue);          
                                docprint.document.write('</body></html>'); 
                                docprint.document.close(); 
                                docprint.focus(); 
                            }
                        </script>
                        <div  id="print_conte">
                            <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
    <?php
                            echo '<table style="" id="results" >';
                            echo '<tr style="background:#0066FF; color:white"><th>Project  Code</th><th>Project Name</th><th>Implementation Code</th><th>Start-Date</th><th>End-Date</th></tr>';
                            $flag=0;
                            while($fetch=mysqli_fetch_array($sel)){
                                if($flag%2==0)
                                    echo '<tr bgcolor=#E5E5E5>';
                                else 
                                    echo '<tr bgcolor=white>';
                                    echo '<td>'.$fetch['Proj_code'].'</td><td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_StartDate'].'</td><td>'.$fetch['Impl_EndDate'].'</td></tr>';
                                    $flag++;
                            }
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }else if($action==notes){
                    echo 'Other Notifications<br/>';
                    $compdate=mysqli_query($conn,"SELECT *FROM General_information, Implementation_status  WHERE General_information.Proj_code=Implementation_status.Proj_code AND Impl_EndDate < curdate() ");
                    $rowscheck=mysqli_num_rows($compdate);
                    if($rowscheck <1){
                        echo '<br/><font color=red>Not Available </font>';
                    }
                    while($fetch=mysqli_fetch_array($compdate)){
                        echo 'Project <font color=red>['.$fetch['Project_name']. ']</font> with Implementation Code <font color=red> ['.$fetch['Impl_code']. '] </font>has passed its Compeletion Time <br/>';
                    }
                    echo '</table>';
                }else if($action=='term'){
                    echo '<h1>Terminated Projects</h1>';
                    $sel=mysqli_query($conn,"SELECT * FROM Implementation_status, General_information WHERE General_information.Proj_code=Implementation_status.Proj_code AND Proj_status='terminated'");
                    $rowscheck=mysqli_num_rows($sel);
                    if($rowscheck < 1){
                        echo 'No Terminated Project(s)';
                    }else{
    ?>
                        <script language="javascript">
                            function caaictp(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_conte").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>'); 
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Terminated Projects</P>');
                                docprint.document.write('</head><body onLoad="self.print()" style="width:800px; font-size:10px; margin-left:40px; -cell-padding:none;font: 12px/17px arial, sans-serif;color: rgb(50, 50, 50);">');
                                docprint.document.write(content_vlue);          
                                docprint.document.write('</body></html>'); 
                                docprint.document.close(); 
                                docprint.focus(); 
                            }
                        </script>
                        <div  id="print_conte">
                            <p class="pprint"> <a href="javascript:caaictpms()" ><img src="images/Print.png" width="30" height="30" /></a></p><br/>
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
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }else if($action=='back'){
                    echo'<h1>Projects Status Backups</h1>';
                    include('connection.php');
                    $sel=mysqli_query($conn,"SELECT * FROM  backup");
                    $rowscheck=mysqli_num_rows($sel);
                    if($rowscheck < 1){
                        echo 'Back up not Nvailable. Click <a href="?action=spr">here</a> to view Projects Status';
                    }else{
    ?>
                        <script language="javascript">
                            function caaictpms(){
                                var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
                                disp_setting+="scrollbars=yes"; 
                                var content_vlue = document.getElementById("print_content").innerHTML; 
                                var docprint=window.open("","",disp_setting); 
                                docprint.document.open(); 
                                docprint.document.write('<html><head><title>i3 PROJECTS LIST MANAGEMENT SYSTEM </title>'); 
                                docprint.document.write('<p align="center"> <FONT size="+3"><img src="images/logo2.png" ></FONT></p><P  align="center"> PROJECTS LIST MANAGEMENT SYSTEM </P><BR><P  align="center"> Projects Status back up information</P>');
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
                            echo '<tr style="background:#0066FF; color:white"><th>Project Name</th><th>Implementation Code</th><th align=left>implementation Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            </th><th>Project Status</th><th>Remarks</th><th>Action Required</th><th>Date modified</th></tr>';
                            $flag=0;
                            while($fetch=mysqli_fetch_array($sel)){
                                if($flag%2==0)
                                    echo '<tr bgcolor=#E5E5E5>';
                                else
                                    echo '<tr bgcolor=white>';
                                    echo '<td>'.$fetch['Project_name'].'</td><td>'.$fetch['Impl_code'].'</td><td>'.$fetch['Impl_status'].'</td><td>'.$fetch['Proj_status'].'</td><td>'.$fetch['Remarks'].'</td><td>'.$fetch['Action_required'].'</td><td>'.$fetch['update_date'].'</td></tr>';

                                    $flag=$flag+1;
                            }
    ?>
                        </div>
    <?php
                        echo '</table>';
                    }
                }
                else if($action=='adduser')
                {
    ?>
                    <h1>Add User</h1>
                    <form method="post">
                        <table id="utable">
                            <tr><td>User_id </td><td><input type="text" name="uid"  required  /></td></tr>
                            <tr><td>Name </td><td><input type="text" name="name" required /></td></tr>
                            <tr><td>Department </td><td><input type="text" name="dep" /></td></tr>
                            <tr><td>Role </td><td><input type="text" name="role" required  /></td></tr>
                            <tr><td>Email Address </td><td><input type="email" name="email" required /></td></tr>
                            <tr><td>User Name </td><td><input type="text" name="uname"  required /></td></tr>
                            <tr><td>Password </td><td><input type="password" name="pwd" required /></td></tr>
                            <tr><td></td><td><input type="submit" name="Submit" value="Add User" /></td></tr>
                        </table>
                    </form>
    <?php
                    if(isset($_POST['Submit']))
                    {
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
                            echo 'Sorry! This username is in use by someone else. please choose another username';
                        }else if($username==""){
                            echo '<br/>You forgot to enter username.username and password can\'t be empty<br/>';
                        }else if($pwd==""){
                            echo 'You forgot to enter password.password can\'t be empty<br/>';
                        }else{
                            $adduser=mysqli_query($conn,"INSERT INTO user VALUES('$uid', '$name', '$dep', '$role', '$email', '$username','$pwds' )");
                            if(!$adduser){
                                echo mysqli_error($conn);
                            }else {
                                echo '<font color="green">User Added Successfully</font>';
                                echo '<meta content="2;dirDash.php?action=adduser" http-equiv="refresh" />';
                            }
                        }
                    }
                }else if($action=='uedit'){
    ?>
                    <h1>Select User to View Details</h1>
                    <form method="post" action="useredit.php">
                        <select name="userid">
    <?php
                            $sel=mysqli_query($conn,"SELECT *FROM user ");
                            while($fetch=mysqli_fetch_array($sel)){
                                echo '<option value="'.$fetch['user_id'].'">'.$fetch['username'].'</option>';
                            }
    ?>
                        </select>
                        <input type="submit" name="go" value="Click" />
                    </form>
    <?php
                }else if($action=='deleteuser'){
    ?>
                    <h1>Select User to Delete</h1>
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
                    if(isset($_POST['delete']))
                    {
                        $id=$_POST['userid'];
                        $query=mysqli_query($conn,"DELETE FROM user WHERE 1 AND user_id='$id'");
                        if($query){
                            echo '<font color="green">User Deleted Successfully</font>';
                            echo '<meta content="2;dirDash.php?action=deleteuser" http-equiv="refresh" />';
                        }else{
                            echo 'Please Click delete button again';
                        }
                    }
                }
    ?>
            </div>
        </div>
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
                                    <a href="?action=spr">Standard Project Report</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=sop">Status of Projects</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="projectInfo.php?action=detailed">Detailed Project Report</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=comp">Completed Projects</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=runp">Running Projects</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=stp">Stalled Projects</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=term">Terminated Projects</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=notes">Other Notifications</a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="?action=back"><i>BACK UP OF PROJECTS STATUS</i></a>
                                </h4>
                            </div>
                        </div>
                        <div class="panel panel-default"    >
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" > MANAGE USERS </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ol id="user">
                                        <li class="odd"><a href="?action=adduser" onclick="var admin=prompt('Enter Security Code');if(admin=='admin') return true; else  return false;">Add User</a></li>
                                        <li class="even"><a href="?action=uedit" onclick="var admins=prompt('Enter Security Code');if(admins=='admin') return true; else  return false;">Edit User information</a></li>
                                        <li class="even"><a href="?action=deleteuser" onclick="var admins=prompt('Enter Security Code');if(admins=='admin') return true; else  return false;">Delete User</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            <p >Copyright &copy; I3. Designed by <a href="mailto:rishikajainranu@gmail.com" style="color:white; font-size: 13px;"><strong>Rishika and Team</strong></a></p>
        </div>

        <!-- JavaScript -->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/modern-business.js"></script>
    </body>
</html>