<?php
include("../conf/loadconfig.inc.php");
$query= "SELECT * from  dealclou_main.Account where username='".$_REQUEST['uname']."' AND password='".md5($_REQUEST['pass'])."'";
$dbresult = mysql_query($query) or die(mysql_error());
if(mysql_num_rows($dbresult)==0)
{
echo "Unsuccessful";
}
else
{
$a=mysql_fetch_array($dbresult);
echo $a['id'];
}
// create root node
echo $xml_string;
?> 
