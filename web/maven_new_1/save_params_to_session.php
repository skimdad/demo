<?php
     //$_SESSION['where'] = $_GET['where'];
     foreach ($_GET as $key => $value) {
         if($key != 'type')
         {
            
             $_SESSION[$_GET['type'].'_'.$key] = $value;
         }
    
}

//exit();
?>