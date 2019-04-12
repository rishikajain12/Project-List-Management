<?php   
session_start();  
              
                    $_SESSION['user_id'] = "";   
                    $_SESSION['password'] = "";   
                      
session_destroy();
$url = "index.php";  
header ('Location: ' . $url);  
?>  