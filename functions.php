<?php
require('/pineapple/components/infusions/unofficialhop/handler.php');
global $directory,$enabled;                                          
                           
if (strpos($_GET['jscript'],'yes') !== false)
{                                            
 $theFile = fopen($directory.'resource/infusion.conf','w');
 fwrite($theFile, "installed=".$_GET['get']."\n");        
 fclose($theFile);                                
}                  
?>
                              
