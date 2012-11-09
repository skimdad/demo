<!DOCTYPE html> 
<html> 
    <head> 
        <title>Page Title</title> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=false&language=el"> </script>
    </head> 

    <body>
        <!-- /page -->
        <div data-role="page" class="page-map" style="width:100%; height:100%;">
            <!-- /header -->
            <div data-role="header" data-theme="b">
                <h1>Map</h1>
                <a href="test3.php" id="home" rel="external" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-left jqm-home">Home</a>
            </div>
            <!-- /content -->
            <div data-role="content" class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
                <div id="map_canvas" style="height:350px;"></div>
            </div>
        </div>
    </body>
</html>
