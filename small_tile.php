<?php

# 1. $directory comes from handler.php
global $directory;
# 2. Config file stored in the resource directory. The 'installed' value is taken out. 
$configfile = parse_ini_file($directory.'resource/infusion.conf');
$enabled = $configfile['installed'];

# 3. mcalls.js allows this php file to hotlink to the js file without opening a new webpage.
?>
<script type='text/javascript' src='/components/infusions/unofficialhop/js/mcalls.js'></script>
<?php

# 4. Checks to see if the rest of the code is enabled or disabled from the conf file.
#    When the script runs successfully once the rest of the code should be disabled.
if (strpos($enabled, '1') !== false)
{
 # 5. The script can be manually enabled by the user clicking here.
 echo "Click <a href=\"javascript:isInstalled('0')\">here</a> if you need to reinstall.";
}
else
{
 # 6. The user can disable the rest of the script by clicking here.
 echo "Click <a href=\"javascript:isInstalled('1')\">here</a> to not reinstall again.";

 # 7. Checks to see if hop.php is in www. I do not want to overwrite the file if it is there.
 if ( !file_exists('/www/hop.php'))
 {
  # 8. Check to see if we have hop.php and download it if we don't.
  if ( !file_exists($directory.'resource/hop.php'));                                          
  {                                                                                                 
   exec("curl --insecure -o ".$directory."resource/hop.php https://raw.githubusercontent.com/rapid7/metasploit-framework/master/data/php/hop.php");
  } 
  # 9. This performs a md5 on the hop.php file as a verification check.
  $theMD5 = shell_exec('md5sum '.$directory.'resource/hop.php');
  if (strpos ($theMD5,'6e1667949ffec3187f1de421def8ed45') !== false)
  {
   # 10. The hop.php file is copied into www. In addition the following happens:
   #  i. isInstalled from our javascript runs the function in functions which sets
   #     our conf file to yes or one.
   #  ii. The screen is refreshed to re-run this php file and to re-read the conf file.
   exec('cp '.$directory.'resource/hop.php /www/hop.php');
   ?>
   <script type='text/javascript'>
   isInstalled('1');
   refreshScreen();
   </script>
   <?php
  }
 }
 else
 {
  # 11. In the case that hop.php is in www, we check to see if that is our hop.php file. If yes,
  # the following happens:
  # i. Set isInstalled to yes, 1 because we have already installed it.
  $theMD5 = shell_exec('md5sum /www/hop.php');
  if (strpos ($theMD5, '6e1667949ffec3187f1de421def8ed45') !== false)
  {
   ?>
   <script type='text/javascript'>
   isInstalled('1');
   </script>
   <?php
  }
  # 12. We dont do anything if that is not our hop.php file.
 }
}
?>
