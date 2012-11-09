<?php
include("../conf/loadconfig.inc.php");
$query= "INSERT INTO dealclou_main.Account(updated,entered,agree_tou,facebook_username,username,password,foreignaccount,foreignaccount_done) VALUES(now(),now(),0,'".$_REQUEST['username']."','".$_REQUEST['username']."','".md5("")."','y','y')";
$dbresult = mysql_query($query) or die(mysql_error());
echo mysql_insert_id();

?> 
