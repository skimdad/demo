<?php

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /functions/populate_funct.php
	# ----------------------------------------------------------------------------------------------------
	
	/**
	 * Function to populate empty db of domain
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name populate_fullDB()
	 * @param integer $domain_id
	 * @param string $table
	 */
	function populate_fullDB($domain_id, $table){
	
		/*
		 * Get field of table
		 */
		
		
		$link_main = @mysql_connect("192.168.1.253","root","arca7");
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		if(!mysql_select_db("new_demodirectory-domain_1",$link_main)){
			echo "constructor: select_db";
		}
		
		$sql = "desc ".$table;
		$result = mysql_query($sql, $link_main);
		if(mysql_num_rows($result)){
			unset($array_fields);
			while($row = mysql_fetch_assoc($result)){
				if($row["Field"] != "domain_id"){
					$array_fields[] = $row["Field"]; 
				}
			}
			
		}
		
		
		/*
		 * Get info second DB
		 */
		$sql_connection = "SELECT database_host, database_port, database_username, database_password, database_name FROM Domain WHERE id = ".$domain_id;
		$result_connection = mysql_query($sql_connection,$link_main);
		if(mysql_num_rows($result_connection)){
			$info_db = mysql_fetch_assoc($result_connection);
			
			/*
			 * Connect with second DB
			 */
			$link1 = @mysql_connect("192.168.1.253","root","arca7");
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET character_set_connection=utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_results=utf8');
			
			$link_id = @mysql_connect($info_db["database_host"],$info_db["database_username"],$info_db["database_password"]);
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET character_set_connection=utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_results=utf8');

			if ($link_id) {
				if(!mysql_select_db($info_db["database_name"],$link_id)){
					echo "constructor: select_db";
				}else{
					
					/*
					 * Get information of table in main DB
					 */
					if(!mysql_select_db("yellowplaza",$link1)){
						echo "constructor: select_db";
					}
					
					
					
					$sql_main = "select ".implode(",",$array_fields)." from ".$table;
					$result_main = mysql_query($sql_main,$link1);
					if(mysql_num_rows($result_main)){
						$link_id = @mysql_connect("192.168.1.253","root","arca7");
						mysql_query("SET NAMES 'utf8'");
						mysql_query('SET character_set_connection=utf8');
						mysql_query('SET character_set_client=utf8');
						mysql_query('SET character_set_results=utf8');
						if(!mysql_select_db("new_demodirectory-domain_2",$link_id)){
							echo "constructor: select_db";
						}
						
						while($row_main_table = mysql_fetch_array($result_main)){
							unset($array_main_table);
							for($i=0;$i<count($array_fields);$i++){
								$array_main_table[] = db_formatString($row_main_table[$i]);
							}
							/*
							 * Insert into second db table
							 */
							unset($sql_insert);
							$sql_insert = "insert into ".$table." (".implode(",",$array_fields).") values (".implode(",",$array_main_table).")";
							$result_insert = mysql_query($sql_insert,$link_id);
							if(!$result_insert){
								echo "erro ".mysql_error($link_id)."<br />";
							}
							
						}
					}else{
						echo "erro ".mysql_error($link_id)."<br />";
						echo "erro no select";
					}
					
				}
			} else {
				echo "constructor: mysql_connect";
			}
			
		}else{
			echo "nao pegou o segundo banco";
		}
		
		
	}
	
	/**
	 * Function to populate accounts on second DB
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name populate_accounts()
	 * @param integer $domain_id
	 */
	function populate_accounts($domain_id,$account_id=false){
		/*
		 * Prepare SQL with all information of account for domain
		 */
		$db = db_getDBObject(DEFAULT_DB,true);
		$sql = "select  Account.id as account_id,
						Contact.first_name, 
					    Contact.last_name,
					    Profile.nickname,
					    Profile.friendly_url,
					    Profile.image_id,
					    Profile.facebook_image,
					    Account.has_profile
					   from Account Account
					   left outer join Contact Contact on Contact.account_id = Account.id
					   left outer join Profile Profile on Profile.account_id = Account.id";
		if($account_id){
			$sql .= "   where Account.id = ".$account_id; 
		}
		$result_account = $db->query($sql);
		if(mysql_num_rows($result_account)){
			/*
			 * Get info second DB
			 */
			$sql_connection = "SELECT database_host, database_port, database_username, database_password, database_name FROM Domain WHERE id = ".$domain_id;
			$result_connection = $db->query($sql_connection);
			if(mysql_num_rows($result_connection)){
				$info_db = mysql_fetch_assoc($result_connection);
				
				/*
				 * Connect with second DB
				 */
				$link_id = @mysql_connect($info_db["database_host"],$info_db["database_username"],$info_db["database_password"]);
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');
	
				if ($link_id) {
					if(!mysql_select_db($info_db["database_name"],$link_id)){
						echo "constructor: select_db";
					}else{
						
						/*
						 * Populate second DB with account information
						 */
						while($row_account = mysql_fetch_assoc($result_account)){
							
							/*
							 * Check if account already exist on second DB
							 */
							unset($sql_check);
							unset($sql_account_second);
							$sql_check = "select account_id from AccountProfileContact where account_id = ".$row_account["account_id"];
							$result_check = mysql_query($sql_check, $link_id);
							if(mysql_num_rows($result_check) > 0){

								/*
								 * Update account on second DB
								 */
								$sql_account_second = "update AccountProfileContact set 
																first_name = ".db_formatString($row_account["first_name"]).",
																last_name = ".db_formatString($row_account["last_name"]).",
																nickname = ".db_formatString($row_account["nickname"]).",
																friendly_url = ".db_formatString($row_account["friendly_url"]).",
																image_id = ".db_formatString($row_account["image_id"]).",
																facebook_image = ".db_formatString($row_account["facebook_image"]).",
																has_profile = ".db_formatString($row_account["has_profile"])."
															where account_id = ".$row_account["account_id"];
																
							}else{
							
								/*
								 * Insert account on second DB
								 */
								$sql_account_second = "insert into AccountProfileContact (account_id,
																			     first_name,
																			     last_name,
																			     nickname,
																			     friendly_url,
																			     image_id,
																			     facebook_image,
																			     has_profile)
																			     values
																			     (".$row_account["account_id"].",
																			     ".db_formatString($row_account["first_name"]).",
																			     ".db_formatString($row_account["last_name"]).",
																			     ".db_formatString($row_account["nickname"]).",
																			     ".db_formatString($row_account["friendly_url"]).",
																			     ".db_formatString($row_account["image_id"]).",
																			     ".db_formatString($row_account["facebook_image"]).",
																			     ".db_formatString($row_account["has_profile"]).")";
			
							}
												
							$result_insert = mysql_query($sql_account_second,$link_id);
							if(!$result_insert){
								echo "erro ".mysql_error($link_id)."<br />";
							}
						}
					}
				}
			}
		}	
	}

    /**
	 * Function to populate categories on second DB
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name populate_categoriess()
	 * @param integer $domain_id
     * @param string $table
     * @param string $relationshipTable
     * @param string $objectName
	 */
	function populate_categories($domain_id, $table, $relationshipTable, $objectName){
		/*
		 * Prepare SQL with all information of category for domain
		 */
		$db = db_getDBObject(DEFAULT_DB,true);
		$sql = "desc ".$table;
		$result = $db->query($sql);
		if(mysql_num_rows($result)){
			unset($array_fields);
			while($row = mysql_fetch_assoc($result)){
				if($row["Field"] != "domain_id"){
					$array_fields[] = "`".$row["Field"]."`"; 
				}
			}			
		}

        /*
		 * Get categories to domain
		 */
		$sql_categories = "select ".implode(",",$array_fields)." from ".$table." where id in (select category_id from ".$relationshipTable." where domain_id = ".$domain_id.")";

        $result_categories = $db->query($sql_categories);
		if(mysql_num_rows($result_categories) > 0){
			
		
			/*
			 * Save category on second DB
			 */
			while($row_category = mysql_fetch_assoc($result_categories)){
				unset($objectCategories);
				$objectCategories = new $objectName($row_category);
               	$objectCategories->Save();
			}
		}		
	}
	
?>