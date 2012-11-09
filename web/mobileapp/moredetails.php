<?php
include("../conf/loadconfig.inc.php");
$req = $_REQUEST['datatoget'];
$query="";
if($req=="Events")
{
$query= "SELECT a.account_id,CONCAT(a.image_id,'.',c.type) as image_id,a.title as name,a.long_description1,CONCAT('WHEN: ',a.start_date,'@#$','TIME: ',a.start_time,'@#$ LOCATION: ',a.location) as end_date from Event a LEFT JOIN Image c ON (a.image_id=c.id) where a.id=".$_REQUEST['dealid'];
}
else
{
if($req=="Classifieds")
{
$query= "SELECT a.account_id,CONCAT(a.image_id,'.',c.type) as image_id,a.title as name,a.detaildesc1 as long_description1,CONCAT('PRICE: $',a.classified_price,'@#$ ','ContactName: ',a.contactname,'@#$ PHONE: ',a.phone,'@#$ EMAIL: ',a.email,'@#$ URL: ',a.url) as end_date from Classified a LEFT JOIN Image c ON (a.image_id=c.id) where a.id=".$_REQUEST['dealid'];
}
else
{
$query= "SELECT a.account_id,CONCAT(a.image_id,'.',c.type) as image_id,a.title as name,a.content1 as long_description1,CONCAT('by: ',a.author) as end_date from Article a LEFT JOIN Image c ON (a.image_id=c.id) where a.id=".$_REQUEST['dealid'];
}
}

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
