<?php
include("../conf/loadconfig.inc.php");
$req = $_REQUEST['datatoget'];
$query="";
if($req=="Events")
{
$query= "SELECT a.id,CONCAT(a.thumb_id,'.',c.type) as image_id,a.account_id,a.title,CONCAT('in ',b.title1) as description1 from Event a LEFT JOIN EventCategory b ON (a.cat_1_id=b.id) LEFT JOIN Image c ON (a.thumb_id=c.id)";
}
else
{
if($req=="Classifieds")
{
$query= "SELECT a.id,CONCAT(a.thumb_id,'.',c.type) as image_id,a.account_id,a.title,CONCAT('in ',b.title1,' by ',a.contactname) as description1 from Classified a LEFT JOIN ClassifiedCategory b ON (a.cat_1_id=b.id) LEFT JOIN Image c ON (a.thumb_id=c.id)";
}
else
{
$query= "SELECT a.id,CONCAT(a.thumb_id,'.',c.type) as image_id,a.account_id,a.title,CONCAT('Published: ',a.publication_date,' by ',a.author,' in ',b.title1) as description1 from Article a LEFT JOIN ArticleCategory b ON (a.cat_1_id=b.id) LEFT JOIN Image c ON (a.thumb_id=c.id)";
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
