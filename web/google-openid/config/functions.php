<?php

mysql_connect("localhost", "root", "Arch$2724") or die(mysql_error());
mysql_select_db("dealclou_domain1") or die(mysql_error());

class User {

    function checkUserGoogle($uid, $oauth_provider, $username, $email)
	{
        $userstable = USERS_TABLE_NAME;
        $query = mysql_query("SELECT * FROM `$userstable` WHERE email = '$email' and oauth_provider = '$oauth_provider'") or die(mysql_error());
        $result = mysql_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
            echo "INSERT INTO `$userstable` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', '$uid', '$username', '$email')";
            echo "<br/>INSERT INTO `$userstable` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', $uid, '$username', '$email')";
            $query = mysql_query("INSERT INTO `$userstable` (oauth_provider, oauth_uid, username, email) VALUES ('$oauth_provider', '$uid', '$username', '$email')") or die(mysql_error());
            $query = mysql_query("SELECT * FROM `$userstable` WHERE email = '$email' and oauth_provider = '$oauth_provider'");
            $result = mysql_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}

?>
