<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$test_submit = "off";
if($test_submit == "on"){

    ?>
    <form method="post" name="test" action="http://geoip.edirectory.com/getInformation.php">

        <input type="hidden" name="o" value="c938617c17644f02827c8f2c4eae62fa" />
        <input type="hidden" name="info" value="201.42.135.179" />
        <input type="hidden" name="v" value="v.9.4.00b" />
        <input type="hidden" name="debug" value="true" />

        <input type="submit" />
    </form>
    <?
}else{
    

    $clientURL = "http://geoip.edirectory.com";    
    $updateAPI = '/getInformation.php';    
    $agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)";
    $ref = DEFAULT_URL.$_SERVER["PHP_SELF"];


//    if(strpos($_SERVER["REMOTE_ADDR"],"192.168.1") === false){
  //          $parameters = "o=".md5("getGEOIP")."&info=".$_SERVER["REMOTE_ADDR"]."&v=v.9.4.00b";
  //  }else{
            $parameters = "?info=201.42.135.179"."&v=v.9.4.00b&o=".md5("getGEOIP");
  //  }

    /*
        * To debug add debug=true on parameters
        */
    //if($debug){
            $req = $parameters."&debug=true";
    //}else{
    //        $req  = $parameters;
    //}
            
    echo $req."<Br>";        

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $clientURL . $updateAPI);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_NOPROGRESS, true);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_REFERER, $ref);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    //curl_setopt($ch, CURLOPT_HTTPGET,true);
    
    //$response = curl_exec($ch);
    //$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //curl_close ($ch);
    
    echo "<pre>";
    //print_r($response);
    print_r(curl_exec($ch));
    
    echo "<br>".curl_error($ch)."<br>";
    print_r(curl_getinfo($ch));

    echo "</pre>";
    
}
?>