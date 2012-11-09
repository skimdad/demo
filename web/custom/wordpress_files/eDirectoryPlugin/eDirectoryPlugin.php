<?php
	/*
	 * Plugin Name: eDirectory Plugin
	 * Plugin URI: http://www.arcasolutions.com/
	 * Description: With this plugin, you can import all your posts, categories and comments directly to your eDirectory blog and centralize your administration in one place. To get started: 1) Click the "Activate" link to the left of this description, 2) Take note of the WordPress plugin key shown in your eDirectory site manager area, and 3) Go to your <a href="options-general.php?page=eDirectoryPlugin/eDirectoryPlugin.php">eDirectory Plugin configuration</a> page, and save your plugin key.
	 * Author: Arca Solutions
	 * Version: 0.1
	 * Author URI: http://www.arcasolutions.com/
	 */

	/**
	 * eDirectory Plugin
	 * 
	 * @author Arca Solutions
	 * @package DMS
	 *
	 */
	include_once("plugin_settings.php");

	class eDirectoryPlugin {

		private static $wpdb;
		private static $info;
		private static $edirUrl = EDIRECTORY_URL;
		private static $projectName = PROJECT_NAME;

		/**
		 * Initialization function, centralizes the definition of filters/areas.
		 */
		public static function initialize() {
			global $wpdb;

			//Posts
			add_filter("save_post", array("eDirectoryPlugin", "SendPost")); //new post
			add_action("deleted_post", array("eDirectoryPlugin", "EdirDeletePost")); //delete post
			add_action('trashed_post', array('eDirectoryPlugin', 'EdirTrashPost')); //trash post
			add_action('untrashed_post', array('eDirectoryPlugin', 'EdirUnTrashPost')); //untrash post
			
			//Categories
			add_action("create_term", array("eDirectoryPlugin", "SendCategory")); //new category
			add_action("edit_category", array("eDirectoryPlugin", "SendCategory")); //new category
			add_action("delete_term", array("eDirectoryPlugin", "EdirDeleteCategory")); //delete category
			
			//Comments
			add_action("comment_post", array("eDirectoryPlugin", "SendComments")); //new comment
			add_action("edit_comment", array("eDirectoryPlugin", "SendComments")); //edit comment
			add_action("comment_closed", array("eDirectoryPlugin", "SendComments")); //mark comment as not spam
			add_action("wp_set_comment_status", array("eDirectoryPlugin", "SendComments")); //change comment status
			add_action("deleted_comment", array("eDirectoryPlugin", "EdirDeleteComment")); //delete comment
			add_action('trashed_comment', array('eDirectoryPlugin', 'EdirTrashComment')); //trash comment
			add_action('untrashed_comment', array('eDirectoryPlugin', 'EdirUnTrashComment')); //untrash comment
			
			add_action('admin_menu', array('eDirectoryPlugin', 'addMenu'));
			
			// Export Categories
			add_action('wp_ajax_ProcessExportCategory', array('eDirectoryPlugin', 'ProcessExportCategory')); // Ajax function to export Categories
			add_action('wp_ajax_nopriv_ProcessExportCategory', array('eDirectoryPlugin', 'ProcessExportCategory')); // Ajax function to export Categories
			
			// Export Posts
			add_action('wp_ajax_ProcessExportPosts', array('eDirectoryPlugin', 'ProcessExportPosts')); // Ajax function to export Posts
			add_action('wp_ajax_nopriv_ProcessExportPosts', array('eDirectoryPlugin', 'ProcessExportPosts')); // Ajax function to export Posts
			
			// Export Comments
			add_action('wp_ajax_ProcessExportComments', array('eDirectoryPlugin', 'ProcessExportComments')); // Ajax function to export Comments
			add_action('wp_ajax_nopriv_ProcessExportComments', array('eDirectoryPlugin', 'ProcessExportComments')); // Ajax function to export Comments
			
			
			//Map WP objects
			eDirectoryPlugin::$wpdb = $wpdb;

			//Others mappings
			eDirectoryPlugin::$info['plugin_fpath'] = dirname(__FILE__);
		}

		/**
		 * Install function called when the plugin is activated.
		 */
		public static function install() {

			if (is_null(eDirectoryPlugin::$wpdb))
				eDirectoryPlugin::initialize();

			 //Create new tables
			$sqlEdirSetting = "CREATE TABLE IF NOT EXISTS `" . eDirectoryPlugin::$wpdb->prefix . "edirectory_settings` (
									`name` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
									`value` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
									PRIMARY KEY ( `name` )
									) ENGINE = MYISAM ";
			
			eDirectoryPlugin::$wpdb->query($sqlEdirSetting);

		}

		/**
		 * This function removes traits of this plugin instalation. It removes all database tables.
		 */
		public static function uninstall() {

			if (is_null(eDirectoryPlugin::$wpdb))
				eDirectoryPlugin::initialize();

			//Drop tables
			$sqlEdirSetting = "DROP TABLE `" . eDirectoryPlugin::$wpdb->prefix . "edirectory_settings`";
			eDirectoryPlugin::$wpdb->query($sqlEdirSetting);

		}

		/**
		 * Add a new tab at wordPress menu where this plugin can be configured
		 */
		public static function addMenu() {
			add_options_page(eDirectoryPlugin::$projectName.' - Management', eDirectoryPlugin::$projectName.' Plugin', 10, __FILE__, array("eDirectoryPlugin", "tabOptions"));
		}
		
		
		
		/**
		 * Save and get the number of total categories
		 * @param integer $total
		 * @return integer $total 
		 */
		public static function SaveTotalCategories($total = false){
			
			if(!$total){
				$sql_export_categories = "SELECT count(".eDirectoryPlugin::$wpdb->prefix."terms.term_id) as total 
											FROM ".eDirectoryPlugin::$wpdb->prefix."terms 
									  INNER JOIN ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy ON ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy.term_id = ".eDirectoryPlugin::$wpdb->prefix."terms.term_id
										   WHERE ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy.taxonomy = 'category'";
				$results_total = eDirectoryPlugin::$wpdb->get_results($sql_export_categories);
				$array_total = get_object_vars($results_total[0]);
				$total = $array_total["total"];
			}
			
			$sql_get_total_categories = "SELECT name, value FROM ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings WHERE name = 'total_categories'";
			$results = eDirectoryPlugin::$wpdb->get_results($sql_get_total_categories);
			
			if(count($results) > 0){
				$sql_setting = "update ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings set value = ".$total." where name = 'total_categories'";
			}else{
				$sql_setting = "insert into ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings (name,value) values ('total_categories',".$total.")";
			}
			eDirectoryPlugin::$wpdb->query($sql_setting);
			
			return $total;
		}
		
		
		public static function GetStatusToExport($success = true){
			
			if($success){
				return "<img src='".eDirectoryPlugin::$edirUrl."/images/icon-message-success.gif' />";
			}else{
				return "<img src='".eDirectoryPlugin::$edirUrl."/images/icon-message-error.gif' />";
			}
			
		}
		
		
		/**
		 * Get all comments and save on eDirectory
		 * @return string HTML code with image of success or error 
		 */
		public static function ProcessExportComments(){
			
			$sql = "SELECT ".eDirectoryPlugin::$wpdb->prefix."comments.comment_ID
					  FROM ".eDirectoryPlugin::$wpdb->prefix."comments";
			
			$results = eDirectoryPlugin::$wpdb->get_results($sql);
			if($results){
				
				$aux_count = 0;
				foreach ($results as $ids) {
					
					unset($aux_ids);
					$aux_ids = get_object_vars($ids);
					$aux_return = eDirectoryPlugin::SendComments($aux_ids["comment_ID"]);
					
				}
			
				echo eDirectoryPlugin::GetStatusToExport();
				
			}else{
				echo eDirectoryPlugin::GetStatusToExport(false);
			}
			die(); // Need this to stop ajax proccess
			
		}
		
		
		/**
		 * Get all posts and save on eDirectory
		 * @return string HTML code with image of success or error 
		 */		
		public static function ProcessExportPosts(){
			
			$sql = "SELECT ".eDirectoryPlugin::$wpdb->prefix."posts.ID 
					  FROM ".eDirectoryPlugin::$wpdb->prefix."posts
					 WHERE ".eDirectoryPlugin::$wpdb->prefix."posts.post_status = 'publish' and ".eDirectoryPlugin::$wpdb->prefix."posts.post_type = 'post'";
			
			$results = eDirectoryPlugin::$wpdb->get_results($sql);
			if($results){
				
				$aux_count = 0;
				foreach ($results as $ids) {
					
					unset($aux_ids);
					$aux_ids = get_object_vars($ids);
					$aux_return = eDirectoryPlugin::SendPost(false,$aux_ids["ID"]);
					
				}
			
				echo eDirectoryPlugin::GetStatusToExport();
			}else{
				echo eDirectoryPlugin::GetStatusToExport(false);
			}
			die(); // Need this to stop ajax proccess
			
		}
		
		
		/**
		 * Get all Categories and save on eDirectory
		 * @return string HTML code with image of success or error 
		 */
		public static function ProcessExportCategory(){
			
			$sql_export_categories = "SELECT ".eDirectoryPlugin::$wpdb->prefix."terms.term_id 
										FROM ".eDirectoryPlugin::$wpdb->prefix."terms 
								  INNER JOIN ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy ON ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy.term_id = ".eDirectoryPlugin::$wpdb->prefix."terms.term_id
									   WHERE ".eDirectoryPlugin::$wpdb->prefix."term_taxonomy.taxonomy = 'category'";
			$results = eDirectoryPlugin::$wpdb->get_results($sql_export_categories);
			if($results){
				
				$aux_count = 0;
				foreach ($results as $ids) {
					
					unset($aux_ids);
					$aux_ids = get_object_vars($ids);
					$aux_return = eDirectoryPlugin::SendCategory($aux_ids["term_id"]);
					
				}
			
				echo eDirectoryPlugin::GetStatusToExport();
			}else{
				echo eDirectoryPlugin::GetStatusToExport(false);
			}
			die(); // Need this to stop ajax proccess
			
		}
		
		
		/**
		 * Get eDirectory plugin key
		 */
		private function _GetEdirKey() {
			$sql_get_key = "SELECT name, value FROM ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings WHERE name = 'edir_key'";
			$results = eDirectoryPlugin::$wpdb->get_results($sql_get_key);
			
			if($results){
				$wp_edir_info = array();
				$wp_edir_info = get_object_vars($results[0]);	
				return $wp_edir_info["value"];
			}else{
				return false;
			}
			
		}

		/**
		 * Shows the settings tab for this plugin and save all settings.
		 */
		public static function tabOptions() {

			//Default
			$templateVars['{UPDATED}'] = "";
			$templateVars['{ERROS}'] = "";

			//Perform defined operations.
			if (count($_POST) > 0) {
				
				/**
				 * Check if key exists
				 */
				$eDirectoryKey = eDirectoryPlugin::_GetEdirKey();
				if($eDirectoryKey){
					$sql_key = "UPDATE ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings SET value = '".$_POST["edir_key"]."' WHERE name = 'edir_key'";
				}else{
					$sql_key = "INSERT INTO ".eDirectoryPlugin::$wpdb->prefix."edirectory_settings (name, value) VALUES ('edir_key','".$_POST["edir_key"]."')";
				}
				$ins = eDirectoryPlugin::$wpdb->query($sql_key);
				
				$templateVars['{UPDATED}'] = '<div id="message" class="updated fade"><p><strong>';
				if ($ins) {
					if($eDirectoryKey){
						$templateVars['{UPDATED}'] .= "eDirectory Key updated!";
					}else{
						$templateVars['{UPDATED}'] .= "eDirectory Key Added!";
					}
				} else {
					$templateVars['{UPDATED}'] .= "Error adding eDirectory Key!";
				}
				$templateVars['{UPDATED}'] .= "</strong></p></div>";
			}

			//Read the template file using WP functions
			$admTplObj = new POMO_FileReader(eDirectoryPlugin::$info['plugin_fpath'] . "/admin_tpl.htm");
			$admTpl = $admTplObj->read_all();
			
			//Get eDirectory Key
			$eDirectoryKey = eDirectoryPlugin::_GetEdirKey();
			if($eDirectoryKey){
				$templateVars['{EDIRECTORY_KEY}'] = $eDirectoryKey;
			}else{
				$templateVars['{EDIRECTORY_KEY}'] = "";
			}
			
			$templateVars["EDIRECTORY_TITLE_PAGE"] = eDirectoryPlugin::$projectName." Settings";
			$templateVars["EDIRECTORY_URL"] = eDirectoryPlugin::$edirUrl;
			
			
			//Replace variables in template	
			$admTpl = strtr($admTpl, $templateVars);

			echo $admTpl;
		}

		
		/**
		 * Send post to eDirectory
		 * @global type $post
		 * @param type $post_texto
		 * @return type 
		 */
		public static function SendPost($post_texto,$aux_id = false) {
			global $post;
			
			if(($post->ID > 0) || ($aux_id)){
				unset($array_post_fields);
				$wp_fields = array();

				
				/*
				 * ID to save
				 */
				if($aux_id){
					$aux_id_sql = $aux_id;
				}else{
					$aux_id_sql = $post->ID;
				}
				
				
				
				/*
				 * Prepare POST fields to send to eDirectory
				 */
				$sql = "SELECT ".eDirectoryPlugin::$wpdb->prefix ."users.ID, 
							   ".eDirectoryPlugin::$wpdb->prefix ."users.user_nicename,
							   ".eDirectoryPlugin::$wpdb->prefix ."posts.ID,
							   date_format(".eDirectoryPlugin::$wpdb->prefix ."posts.post_date,'%Y-%m-%d') as post_date,
							   ".eDirectoryPlugin::$wpdb->prefix ."posts.post_content,
							   ".eDirectoryPlugin::$wpdb->prefix ."posts.post_title,
							   ".eDirectoryPlugin::$wpdb->prefix ."posts.post_status,
							   ".eDirectoryPlugin::$wpdb->prefix ."posts.post_name
						FROM ".eDirectoryPlugin::$wpdb->prefix ."posts wp_posts 
							INNER JOIN ".eDirectoryPlugin::$wpdb->prefix ."users ".eDirectoryPlugin::$wpdb->prefix ."users ON ".eDirectoryPlugin::$wpdb->prefix ."users.ID = ".eDirectoryPlugin::$wpdb->prefix ."posts.post_author
						WHERE ".eDirectoryPlugin::$wpdb->prefix ."posts.ID = ".$aux_id_sql;

				$results = eDirectoryPlugin::$wpdb->get_results($sql);


				if($results){
					$wp_fields["type"] = "posts";
					foreach ($results as $res) {
						$wp_fields["fields"] = get_object_vars($res);
					}
					
					/*
					 * Get Categories to post
					 */ 
					$categories = $_POST["post_category"];
					for($i=0;$i<count($categories);$i++){
						if($categories[$i]> 0){
							$wp_fields["fields"]["categories"][] = $categories[$i];
						}
					}
					
					eDirectoryPlugin::_EdirCurlRequest($wp_fields);
					
				}
			}
			
			return $post_texto;
		}
		

		/**
		 * Send category to eDirectory
		 * @param type $id
		 * @return type 
		 */
		public static function SendCategory($id) {
			
			if($id > 0){
				
				unset($array_post_fields);
				$wp_fields = array();

				/*
				 * Prepare Category fields to send to eDirectory
				 */
				$sql = "SELECT  ".eDirectoryPlugin::$wpdb->prefix ."terms.term_id, 
								".eDirectoryPlugin::$wpdb->prefix ."terms.name, 
								".eDirectoryPlugin::$wpdb->prefix ."terms.slug, 
								".eDirectoryPlugin::$wpdb->prefix ."term_taxonomy.taxonomy, 
								".eDirectoryPlugin::$wpdb->prefix ."term_taxonomy.parent 
						   FROM ".eDirectoryPlugin::$wpdb->prefix ."terms 
					 INNER JOIN ".eDirectoryPlugin::$wpdb->prefix ."term_taxonomy ON ".eDirectoryPlugin::$wpdb->prefix ."term_taxonomy.term_id = ".eDirectoryPlugin::$wpdb->prefix ."terms.term_id 
						  WHERE ".eDirectoryPlugin::$wpdb->prefix ."term_taxonomy.taxonomy = 'category' AND ".eDirectoryPlugin::$wpdb->prefix."terms.term_id = ".$id;

				$results = eDirectoryPlugin::$wpdb->get_results($sql);

				if($results){
					foreach ($results as $res) {
						$wp_fields["fields"] = get_object_vars($res);
					}
					$wp_fields["type"] = "category";

					eDirectoryPlugin::_EdirCurlRequest($wp_fields);

				}
			}

			return $id;
		}
		
		
		/**
		 * Delete post
		 * @param type $id
		 * @return type 
		 */
		public static function EdirDeletePost($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "delete_post";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Change post status to pending
		 * @param type $id
		 * @return type 
		 */
		public static function EdirTrashPost($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "trash_post";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Change post status to active
		 * @param type $id
		 * @return type 
		 */
		public static function EdirUnTrashPost($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "untrash_post";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Delete category
		 * @param type $id
		 * @return type 
		 */
		public static function EdirDeleteCategory($id) {

			$wp_fields = array();
			$wp_fields["type"] = "delete_category";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Send comments to eDirectory
		 * @global type $comment
		 * @param type $id
		 * @return type 
		 */
		public static function SendComments($id){
			global $comment;
			
			if ($id > 0){
				
				$wp_fields = array();

				/*
				 * Prepare Comments fields to send to eDirectory
				 */
				$sql = "SELECT  ".eDirectoryPlugin::$wpdb->prefix ."comments.comment_post_ID, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_ID, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_author, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_parent, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_date, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_content, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_author_url, 
								".eDirectoryPlugin::$wpdb->prefix ."comments.comment_approved 
						   FROM ".eDirectoryPlugin::$wpdb->prefix ."comments
						  WHERE ".eDirectoryPlugin::$wpdb->prefix ."comments.comment_ID = ".$id;
				
				$results = eDirectoryPlugin::$wpdb->get_results($sql);

				if($results){
					foreach ($results as $res) {
						$wp_fields["fields"] = get_object_vars($res);
					}
					$wp_fields["type"] = "comments";

					eDirectoryPlugin::_EdirCurlRequest($wp_fields);

				}
				
			}
			
			return $id;
			
		}
		
		
		/**
		 * Delete comment
		 * @param type $id
		 * @return type 
		 */
		public static function EdirDeleteComment($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "delete_comment";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Change comment status to not approved
		 * @param type $id
		 * @return type 
		 */
		public static function EdirTrashComment($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "trash_comment";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Change comment status to approved
		 * @param type $id
		 * @return type 
		 */
		public static function EdirUnTrashComment($id) {
			
			$wp_fields = array();
			$wp_fields["type"] = "untrash_comment";
			$wp_fields["fields"] = array("id"=>$id);
			
			eDirectoryPlugin::_EdirCurlRequest($wp_fields);
			
			return $id;
		}
		
		
		/**
		 * Curl request to eDirectory
		 * @param array $wp_fields 
		 */
		private function _EdirCurlRequest($wp_fields) {
			
			$wp_fields["key"] = eDirectoryPlugin::_GetEdirKey();
			
			unset($array_curl_properties);
			$array_curl_properties["method"] = "POST";

			$array_curl_properties["body"]["fields"] = serialize($wp_fields);
			$eDirUrl = eDirectoryPlugin::$edirUrl."blog/wordpress.php";
			
			$curlObj = new WP_Http_Curl();
			$response = $curlObj->request($eDirUrl, $array_curl_properties);

		}
		
		
	}

	/**
	 *  Add WordPress HOOKs
	 */
	$mppPluginFile = substr(strrchr(dirname(__FILE__), DIRECTORY_SEPARATOR), 1) . DIRECTORY_SEPARATOR . basename(__FILE__);
	/** Install function */
	register_activation_hook($mppPluginFile, array('eDirectoryPlugin', 'install'));
	/** Uninstall function */
	register_uninstall_hook($mppPluginFile, array('eDirectoryPlugin', 'uninstall'));
	/** Initialization function */
	add_filter('init', array('eDirectoryPlugin', 'initialize'));
?>