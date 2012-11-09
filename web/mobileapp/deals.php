<?php
include("../conf/loadconfig.inc.php");
$req = $_REQUEST['datatoget'];


$query= "SELECT a.id,a.thumb_id as image_id,a.account_id,a.name,CONCAT('by ',b.title) as description1,dealvalue,realvalue from Promotion a LEFT JOIN Listing b ON (a.listing_id=b.id)";

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
