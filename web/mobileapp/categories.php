<?php
include("../conf/loadconfig.inc.php");

$query= "SELECT id,title1 from ListingCategory ";
if(isset($_REQUEST['id']))
{
$pieces= explode(",",$_REQUEST['id']);
$i=0;
for($i=0;$i<count($pieces);$i++)
{
if($i==0)
$query= $query." where category_id=".$pieces[$i];
else
$query= $query." OR category_id=".$pieces[$i];
}
}
else
{
$query= $query." where featured='y'";
}
$query = $query." order by title1";

$dbresult = mysql_query($query) or die(mysql_error());
$doc = new DomDocument('1.0');

// create root node
$root = $doc->createElement('root');
$root = $doc->appendChild($root);

// process one row at a time
while($row = mysql_fetch_assoc($dbresult)) 
{
	// add node for each row
  	$occ = $doc->createElement('user_details');
  	$occ = $root->appendChild($occ);

	// add a child node for each field
  	foreach ($row as $fieldname => $fieldvalue) 
    {
	
		$child = $doc->createElement($fieldname);
    		$child = $occ->appendChild($child);
		
			$value = $doc->createTextNode($fieldvalue);
    			$value = $child->appendChild($value);
		
  	} // foreach
	
} // while



// get completed xml document
$xml_string = $doc->saveXML();
header("Content-type: text/xml");
echo $xml_string;


mysql_close($dbconnect);



?> 
