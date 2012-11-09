<?php
 //used to load plain template: with out footer menu nor header logo
function loadPlain() {
    return string_strpos($_SERVER["PHP_SELF"], "/login.php");
}
?>