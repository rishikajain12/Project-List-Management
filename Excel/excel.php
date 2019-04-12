<?php
  require_once('OLEwriter.php');
  require_once('BIFFwriter.php');
  require_once('Worksheet.php');
  require_once('Workbook.php');
  require_once('dbcon.php');
  


    function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }
	  
	  // HTTP headers
HeaderingExcel('Member.xls');// Creating a workbook
$workbook = new excel("-");
// Creating the first worksheet
$worksheet1 =& $workbook->add_worksheet('candidate result');
$worksheet1->freeze_panes(1, 0);
  $worksheet1->set_column(0, 0, 25);
  $worksheet1->set_column(1, 1, 20);
  $worksheet1->set_column(1, 2, 20);
  $worksheet1->set_column(1, 3, 20);
  $worksheet1->set_column(1, 4, 20);










   $worksheet1->write_string(0,0,"FirstName");
   $worksheet1->write_string(0,1,"LastName");
   $worksheet1->write_string(0,2,"MiddleName");
   $worksheet1->write_string(0,3,"Address");
   $worksheet1->write_string(0,4,"Email");

 






/////////////////
	

	$qryreport = mysql_query("SELECT * FROM member") or die(mysql_error());
	
	$sqlrows=mysql_num_rows($qryreport);
	$j=0;
	
	WHILE ($reportdisp=mysql_fetch_array($qryreport)) { $id=$reportdisp['member_id'];
	$j=$j+1;
                    
                        $firstname=$reportdisp['firstname'];
                        $lastname=$reportdisp['lastname'];
                        $middlename=$reportdisp['middlename'];
                        $address=$reportdisp['address'];
                        $email=$reportdisp['email'];

			
			
			
				
			
			
			 $worksheet1->write_string($j,0,"$firstname");
			 $worksheet1->write_string($j,1,"$lastname");
			 $worksheet1->write_string($j,2,"$middlename");
			 $worksheet1->write_string($j,3,"$address");
			 $worksheet1->write_string($j,4,"$email");
	
			
		
			
			 
	}
	
	
	
/////////////////
  
  

  
$workbook->close();
?>