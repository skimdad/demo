<?php

    /*
    * To change this template, choose Tools | Templates
    * and open the template in the editor.
    */

    include("../conf/loadconfig.inc.php");
    
    $prepare_lang_constants = "off";
    $write_lang_constants = "off";
    $update_languages = "on";
    
    if($prepare_lang_constants =="on"){
    
        $constants_array = get_defined_constants();

        /*
        * Get the language 
        */
        $langObj = new Lang();
        $aux_lang_id = $langObj->returnLangId(EDIR_LANGUAGE);

        $db = db_getDBObject();


        function getLangLegend($key){

            $db = db_getDBObject();
            $sql = "select legend from Languages where `key` = '".$key."'";        
            $result = $db->query($sql);
            if(mysql_num_rows($result)){
                $lines = mysql_fetch_assoc($result);
                return $lines["legend"];
            }else{
                return false;
            }

        }


        
        $array_allow_constants[] = "DEAL_LINK2LISTING";
        $array_allow_constants[] = "DEAL_LIKEDTHIS";
        $array_allow_constants[] = "DEAL_REDEEM";
        $array_allow_constants[] = "DEAL_REDEEMTHIS";
        $array_allow_constants[] = "DEAL_REDEEMINFO1";
        $array_allow_constants[] = "DEAL_REDEEMINFO2";
        $array_allow_constants[] = "DEAL_CLICKHERETO";
        $array_allow_constants[] = "DEAL_PLEASEWAIT_POSTING";
        $array_allow_constants[] = "DEAL_YOUALREADY";
        $array_allow_constants[] = "DEAL_DEALDONE";
        $array_allow_constants[] = "DEAL_REDEEM_NONE_FB";
        $array_allow_constants[] = "DEAL_REDEEM_NONE_TW";
        $array_allow_constants[] = "DEAL_RECENTDEALS";
        $array_allow_constants[] = "DEAL_DIDNTNOTFINISHED";
        $array_allow_constants[] = "DEAL_NA";
        $array_allow_constants[] = "DEAL_REDEEMINFO_1";
        $array_allow_constants[] = "DEAL_REDEEM_DONEALREADY";
        $array_allow_constants[] = "DEAL_REDEEMINFO_2";
        $array_allow_constants[] = "DEAL_VALUE";
        $array_allow_constants[] = "DEAL_WITHTHISCOUPON";
        $array_allow_constants[] = "DEAL_THANKYOU";
        $array_allow_constants[] = "DEAL_ORIGINALVALUE";
        $array_allow_constants[] = "DEAL_AMOUNTPAID";
        $array_allow_constants[] = "DEAL_VALIDUNTIL";
        $array_allow_constants[] = "DEAL_INFODETAILS1";
        $array_allow_constants[] = "DEAL_INFODETAILS2";
        $array_allow_constants[] = "DEAL_INFODETAILS3";
        $array_allow_constants[] = "DEAL_INFODETAILS4";
        $array_allow_constants[] = "DEAL_PRINTDEAL";
        $array_allow_constants[] = "DEAL_DEALSDONE";
        $array_allow_constants[] = "DEAL_DEALSDONE_PLURAL";
        $array_allow_constants[] = "DEAL_LEFTAMOUNT";
        $array_allow_constants[] = "DEAL_SOLDOUT";
        $array_allow_constants[] = "DEAL_DOESNTEXIST";
        $array_allow_constants[] = "DEAL_AT";
        $array_allow_constants[] = "DEAL_FRIENDLYURL";
        $array_allow_constants[] = "DEAL_SELECTLISTING";
        $array_allow_constants[] = "DEAL_TAG";
        $array_allow_constants[] = "DEAL_LINK2LISTING_ACCTINFO";
        $array_allow_constants[] = "DEAL_VALUE";
        $array_allow_constants[] = "DEAL_WITHCOUPON";
        $array_allow_constants[] = "DEAL_REDEEMBYEMAIL";
        $array_allow_constants[] = "DEAL_CONNECT_REDEEM";
        
        $array_allow_constants[] = "CLOCK_TYPE";
        $array_allow_constants[] = "DEFAULT_DATE_FORMAT";
        $array_allow_constants[] = "ZIPCODE_UNIT"; 
        $array_allow_constants[] = "ZIPCODE_UNIT_LABEL";
        $array_allow_constants[] = "ZIPCODE_UNIT_LABEL_PLURAL";
        $array_allow_constants[] = "ZIPCODE_LABEL";
        
        $array_allow_constants[] = "DEAL_SITEMGR_REDEEMCODE";
        $array_allow_constants[] = "DEAL_SITEMGR_AVAILABLE";
        $array_allow_constants[] = "DEAL_SITEMGR_USED";
        $array_allow_constants[] = "DEAL_REDEEMINFO_3";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE1";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE2";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE3";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE4";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE5";
        $array_allow_constants[] = "NAVBAR_SAVED_MESSAGE6";
        $array_allow_constants[] = "DEAL_SITEMGR_USE";
        
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLPAGESBUTITEMPAGES";
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLPAGES";
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLSTATUS";
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLCATEGORIES";
        $array_allow_constants[] = "LANG_LABEL_YOUR_SITE";
        $array_allow_constants[] = "LANG_LABEL_YOUR_EMAIL";
        $array_allow_constants[] = "LANG_LABEL_SELECT_TYPE";
        $array_allow_constants[] = "LANG_LABEL_SELECT_CATEGORY";
        $array_allow_constants[] = "LANG_LABEL_SELECT_LOCATION";
        $array_allow_constants[] = "LANG_LABEL_SELECT_COUNTRY";
        $array_allow_constants[] = "LANG_LABEL_SELECT_REGION";
        $array_allow_constants[] = "LANG_LABEL_SELECT_STATE";
        $array_allow_constants[] = "LANG_LABEL_SELECT_CITY";
        $array_allow_constants[] = "LANG_LABEL_SELECT_NEIGHBORHOOD";
        $array_allow_constants[] = "LANG_LABEL_SELECT_SELECTASYSTEM";
        $array_allow_constants[] = "LANG_LABEL_MSG_PROFILE_STATUS";
        $array_allow_constants[] = "LANG_SITEMGR_CURRENCY_SYMBOL";
        $array_allow_constants[] = "LANG_MSG_CYCLE_IS_REQUIRED_ON_SIMPLEPAY_RECURRING";
        $array_allow_constants[] = "LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_CYCLE_IN_SIMPLEPAY_RECURRING";
        $array_allow_constants[] = "LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_CYCLE_IN_SIMPLEPAY_RECURRING";
        $array_allow_constants[] = "LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_TIMES_IN_SIMPLEPAY_RECURRING";
        $array_allow_constants[] = "LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_TIMES_IN_SIMPLEPAY_RECURRING";
        $array_allow_constants[] = "LANG_MSG_CYCLE_IS_REQUIRED_ON_PAYPAL_RECURRING";
        $array_allow_constants[] = "LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_CYCLE_IN_PAYPAL_RECURRING";
        $array_allow_constants[] = "LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_CYCLE_IN_PAYPAL_RECURRING";
        $array_allow_constants[] = "LANG_MSG_NEGATIVE_NUMBER_NOT_ALLOWED_FOR_TIMES_IN_PAYPAL_RECURRING";
        $array_allow_constants[] = "LANG_MSG_LETTERS_AND_SPECIAL_CHARS_ARE_NOT_ALLOWED_FOR_TIMES_IN_PAYPAL_RECURRING";
        $array_allow_constants[] = "LANG_MSG_PAYMENT_CURRENCY_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_PAYMENT_CURRENCY_MUST_CONTAIN_THREE_CHARS";
        $array_allow_constants[] = "LANG_MSG_PAYMENT_CURRENCY_MUST_BE_ONLY_LETTERS";
        $array_allow_constants[] = "LANG_MSG_CURRENCY_SYMBOL_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_LISTING_RENEWAL_PERIOD_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_EVENT_RENEWAL_PERIOD_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_BANNER_RENEWAL_PERIOD_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_CLASSIFIED_RENEWAL_PERIOD_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_ARTICLE_RENEWAL_PERIOD_IS_REQUIRED";
        $array_allow_constants[] = "LANG_MSG_CURRENCY_PAGSEGURO";
        $array_allow_constants[] = "LANG_MSG_LISTING_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_ERROR_NO_ITEM_SELECTED";
        $array_allow_constants[] = "LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_EVENT_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_BANNER_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE";
        $array_allow_constants[] = "LANG_MSG_LISTING_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_MSG_CLASSIFIED_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_MSG_EVENT_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_MSG_PROMOTION_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_MSG_ARTICLE_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_MSG_BANNER_SUCCESSFULLY_DELETE";
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLTYPES";
        $array_allow_constants[] = "LANG_LABEL_SELECT_ALLLEVELS";
        $array_allow_constants[] = "LANG_PACKAGE_ERROR_MSG_UPDATE_PACKAGE";
        $array_allow_constants[] = "LANG_FACEBOOK_APP_ID";
        $array_allow_constants[] = "LANG_FACEBOOK_USER_ID";
        $array_allow_constants[] = "LANG_SITEMGR_PLUGIN_INSTALL";
        
        $total_constants = 0;
        foreach($constants_array as $key => $value){

            //echo $key." = ".$value."<br>";

            if(in_array($key,$array_allow_constants) || ((strpos($key, "LANG_") !== false) && ($key != "NON_LANG_URL") && ($key !== "BLOG_LANG_DIR") && ($key !== "EDIR_LANG_URL"))) {

                /*
                * Search legend
                */
                $aux_legend = getLangLegend($key);
                if($aux_legend){
                    $legend = $aux_legend;
                }else{
                    $legend = $value;
                }

                /*
                * Saving languages on table
                */
                $sql = "insert into Languages (`lang_id`,`key`,`value`,`legend`) values (".$aux_lang_id.",'".$key."','".addslashes($value)."','".addslashes($legend)."')";  
                $db->query($sql);

                $total_constants++;

            }


        }
        echo $total_constants."<br>";
    }
    
    
    
    if($update_languages == "on"){
        
        $db = db_getDBObject();
        
        //$sql = "SELECT id, value FROM `Languages` WHERE `value` LIKE '%listing%'";
        $sql = "SELECT id, value FROM `Languages`";
        $result = $db->query($sql);
        
        if(mysql_num_rows($result)){
            
            while($row = mysql_fetch_assoc($result)){
                $lang = stripslashes($row["value"]);
                /*
                if(strpos($lang, "Listings") !== false){
                    
                    $lang = str_replace("Listings","Properties",$lang);
                    
                }elseif(strpos($lang,"Listing") !== false){
                    
                    $lang = str_replace("Listing","Property",$lang);
                    
                }elseif(strpos($lang,"listings") !== false){
                    
                    $lang = str_replace("listings","properties",$lang);
                    
                }elseif(strpos($lang,"listing") !== false){
                    
                    $lang = str_replace("listing","property",$lang);
                    
                }
                */
                
                
                
                $sql_replace = "update Languages set value = '".addslashes($lang)."' where id = ".$row["id"];
                $result_2 = $db->query($sql_replace);
                
            }
        }
        
    }
    
    
    
    if($write_lang_constants == "on"){
        
        unset($langObj,$lang_array);
        
        
        function WriteLanguageFiles($lang_id,$file_name,$buffer_header,$result,$type){
                
            $file_langPath = EDIRECTORY_ROOT."/custom/domain_1/lang/".$file_name;
            if ($file_lang = fopen($file_langPath, "w+")) {
                
                $buffer = "";
                if($type == "PHP"){
                    $buffer.= "<?".PHP_EOL;
                }
             
                $buffer .= $buffer_header;    
                $buffer .= "// ----------------------------------------------------------------------------------------------------".PHP_EOL;
                $buffer .= "// * FILE: /custom/domain_1/lang/".$file_name.PHP_EOL;
                $buffer .= "// ----------------------------------------------------------------------------------------------------".PHP_EOL;
                
                while($row = mysql_fetch_assoc($result)){
                    $buffer .= "//".$row["legend"].PHP_EOL;                                            
                    if($type == "PHP"){                        
                        $buffer .= "define(\"".$row["key"]."\", \"".addslashes($row["value"])."\");".PHP_EOL;
                    }else{                        
                        $buffer .= $row["key"]." = \"".addslashes($row["value"])."\"".PHP_EOL;
                    }
                    
                }                
                fwrite($file_lang, $buffer, strlen($buffer));
                fclose($file_lang);
                return true;
            }else{
                return false;
            }
            
        }
        
        
        
        $buffer_header .= "/*==================================================================*\\".PHP_EOL;
        $buffer_header .= "######################################################################".PHP_EOL;
        $buffer_header .= "#                                                                    #".PHP_EOL;
        $buffer_header .= "# Copyright ".date("Y")." Arca Solutions, Inc. All Rights Reserved.           #".PHP_EOL;
        $buffer_header .= "#                                                                    #".PHP_EOL;
        $buffer_header .= "# This file may not be redistributed in whole or part.               #".PHP_EOL;
        $buffer_header .= "# eDirectory is licensed on a per-domain basis.                      #".PHP_EOL;
        $buffer_header .= "#                                                                    #".PHP_EOL;
        $buffer_header .= "# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #".PHP_EOL;
        $buffer_header .= "#                                                                    #".PHP_EOL;
        $buffer_header .= "# http://www.edirectory.com | http://www.edirectory.com/license.html #".PHP_EOL;
        $buffer_header .= "######################################################################".PHP_EOL;
        $buffer_header .= "\*==================================================================*/".PHP_EOL;
        
        $langObj = new Lang();
        $lang_array = $langObj->getAll();
        
        $db = db_getDBObject();
        
        
        /*
         * Preparing to write files
         */
        for($i=0;$i<count($lang_array);$i++){
            
            unset($file_name_php, $file_name_js);
            $file_name_php  = $lang_array[$i]["id"].".php";
            $file_name_js   = $lang_array[$i]["id"].".js";
            
            
            /*
             * Writing PHP lang file
             */
            $sql = "SELECT * FROM `Languages` WHERE lang_id =".$lang_array[$i]["id_number"]." and type = 'PHP'";
            $result = $db->query($sql);
            if(mysql_num_rows($result)){
                $aux_return = WriteLanguageFiles($lang_id,$file_name_php,$buffer_header,$result,"PHP");
                if(!$aux_return){
                    die("Error generating file ".$file_name_php);
                }
            }
            
            /*
             * Writing JavaScript lang file
             */
            $sql = "SELECT * FROM `Languages` WHERE lang_id =".$lang_array[$i]["id_number"]." and type = 'JS'";
            $result = $db->query($sql);
            if(mysql_num_rows($result)){
                $aux_return = WriteLanguageFiles($lang_id,$file_name_js,$buffer_header,$result,"JS");
                if(!$aux_return){
                    die("Error generating file ".$file_name_js);
                }
            }
            
            
        }
        
    }
    
    

?>
