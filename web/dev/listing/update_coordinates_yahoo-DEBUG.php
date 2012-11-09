<?php
//	ini_set("max_execution_time", "3000000000");
	//set_time_limit(0);


////////////////////////////////////////////////////////////////////////////////////////////////////
$path = "";
$full_name = "";
$file_name = "";
$full_name = $_SERVER["SCRIPT_FILENAME"];
if (strlen($full_name) > 0) {
	$osslash = ((strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') ? '\\' : '/');
	$file_pos = strpos($full_name, $osslash."cron".$osslash);
	if ($file_pos !== false) {
		$file_name = substr($full_name, $file_pos);
	}
	$path = substr($full_name, 0, (strlen($file_name)*(-1)));
}
if (strlen($path) == 0) $path = "..";
define(EDIRECTORY_ROOT, $path);
define(BIN_PATH, EDIRECTORY_ROOT."/bin");
////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
$_inCron = true;
include_once(EDIRECTORY_ROOT."/conf/config.inc.php");
////////////////////////////////////////////////////////////////////////////////////////////////////

	$appid="zTXLw15e";
////////////////////////////////////////////////////////////////////////////////////////////////////
	$dbhost=_DIRECTORYDB_HOST;
	$dbname=_DIRECTORYDB_NAME;
	$dbuser=_DIRECTORYDB_USER;
	$dbpass=_DIRECTORYDB_PASS;
////////////////////////////////////////////////////////////////////////////////////////////////////

	//Faz conexão com Banco de Dados
	$con = mysql_connect($dbhost,$dbuser,$dbpass) or exit('Erro na conexao com o servidor');
	//mysql_set_charset('utf8',$con);
	mysql_select_db($dbname);
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	// retrieve domains list
	$sqlDomain = "	SELECT
					D.`id`, D.`database_host`, D.`database_port`, D.`database_username`, D.`database_password`, D.`database_name`, D.`url`
				FROM `Domain` AS D
				WHERE D.`status` = 'A'
				AND
					D.`id` = 1
				";
			
	$resDomain = mysql_query($sqlDomain, $con);
	
	
if (mysql_num_rows($resDomain) > 0) {

while ($rowDomain = mysql_fetch_assoc($resDomain)) {

	define(SELECTED_DOMAIN_ID, $rowDomain["id"]);
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	$domainHost = $rowDomain["database_host"].($rowDomain["database_port"]? ":".$rowDomain["database_port"]: "");
	$domainUser = $rowDomain["database_username"];
	$domainPass = $rowDomain["database_password"];
	$domainDBName = $rowDomain["database_name"];
	$domainURL = $rowDomain["url"];
	
	$linkDomain = mysql_connect($domainHost, $domainUser, $domainPass, true);
	mysql_select_db($domainDBName);
	////////////////////////////////////////////////////////////////////////////////////////////////////

	$sql =  "SELECT id, Address, Address2, Zip_code, Location_1_title, Location_2_title, Location_3_title, Location_4_title, Location_5_title 
            FROM Listing_Summary
            WHERE maptuning = ''
            AND (Address != '' AND Address != '0')
            AND (Location_1 !=0 OR Location_2 !=0 OR Location_3 !=0 OR Location_4 !=0 OR Location_5 !=0) 
            ORDER BY RAND() LIMIT 35000 ";

	$result = mysql_query($sql, $linkDomain);

	if ($result) {
		$item_amount = mysql_num_rows($result);
		$aux = 0;

		if ($item_amount > 0) {

			mysql_query("ALTER TABLE $dbname.Listing DISABLE KEYS; ALTER TABLE $dbname.Listing_Summary DISABLE KEYS;", $con);
			while ($item = mysql_fetch_assoc($result)) {
				sleep(0.1);
				$aux++;
				$location = "";

				if(!empty($item['Address'])) {
					$location .= trim($item['Address']);
				}
				
				if(!empty($item['Address2'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Address2']);
				}
				
				if (empty($item['Address']) && empty($item['Address2']) && !empty($item['Zip_code'])) {
                    if(!empty($location)) $location .= ', ';
                    $location .= trim($item['Zip_code']);
                }

				if(!empty($item['Location_5_title'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Location_5_title']);
				}
				
				if(!empty($item['Location_4_title'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Location_4_title']);
				}

				if(!empty($item['Location_3_title'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Location_3_title']);
				}

				if(!empty($item['Location_2_title'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Location_2_title']);
				}

				if(!empty($item['Location_1_title'])) {
					if(!empty($location)) $location .= ', ';
					$location .= trim($item['Location_1_title']);
				}
				
				$location = str_replace(' ', '+', $location);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://where.yahooapis.com/geocode?location=".$location."&appid=".$appid);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				$curl = trim(curl_exec($ch));
				curl_close($ch);
				
				if(strpos($curl, 'xml')) {
					$row = simplexml_load_string($curl);

					if(isset($row->Result->latitude) && isset($row->Result->longitude)) {
						    mysql_query('UPDATE '.$domainDBName.'.Listing SET maptuning = "'.$row->Result->latitude.','.$row->Result->longitude.'" WHERE id = '.$item['id'], $linkDomain);
						    mysql_query('UPDATE '.$domainDbName.'.Listing_Summary SET maptuning = "'.$row->Result->latitude.','.$row->Result->longitude.'" WHERE id = '.$item['id'], $linkDomain);
					       	    $numberoftunings++;
					       	    echo($numberoftunings."\n");
					       	//echo $aux.' => Latitude: '.$row->Result->latitude.' => Longitude: '.$row->Result->longitude.' => ID : '.$item['id'].'<br />';
	       				} elseif(isset($row->Result[0]->latitude) && isset($row->Result[0]->longitude)) {
						    mysql_query('UPDATE '.$domainDBName.'.Listing SET maptuning = "'.$row->Result[0]->latitude.','.$row->Result[0]->longitude.'" WHERE id = '.$item['id'], $linkDomain);
						    mysql_query('UPDATE '.$domainDBName.'.Listing_Summary SET maptuning = "'.$row->Result[0]->latitude.','.$row->Result[0]->longitude.'" WHERE id = '.$item['id'], $linkDomain);
						    $numberoftunings++;
						    
						    echo($numberoftunings."\n");
						    //echo $aux.' => Latitude: '.$row->Result[0]->latitude.' => Longitude: '.$row->Result[0]->longitude.' => ID : '.$item['id'].' - MANY RESULTS<br />';
					} else {
						var_dump($row);
						$numberoftunings++;
						$numberoffails++;
						echo($numberoftunings." CANNOT FIND! \n");
						//exit;
					}
				} else {
					echo $curl;
					//exit;
				}
			}
			mysql_query("ALTER TABLE $dbname.Listing ENABLE KEYS; ALTER TABLE $dbname.Listing_Summary ENABLE KEYS;", $con);
		}else{
			echo "No listings to do maptuning";
		}
	} else {
		echo 'Não foi possivel selecionar';
	}	
}
echo($numberoffails." FAILS! \n");

mysql_close();


} else {
	mysql_close();
	exit('Zero domains found');
}
?>

