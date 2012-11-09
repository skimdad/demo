<?

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
	# * FILE: /includes/views/view_float_layer.php
	# ----------------------------------------------------------------------------------------------------
?>
<script type="text/javascript">
	//<![CDATA[
	document.onmousemove = captureMousePosition;
	var xMousePos = 0; // Horizontal position of the mouse on the screen
	var yMousePos = 0; // Vertical position of the mouse on the screen

	function captureMousePosition(e) {
      e=e||window.event;
      if(e.pageX || e.pageY) { // Netscape Mozilla
        xMousePos=e.pageX;
        yMousePos=e.pageY;
      } else if(typeof(e.clientX)=='number') { // IE
        var dE=document.documentElement;
        xMousePos=e.clientX+document.body.scrollLeft+(dE?dE.scrollLeft:0);
        yMousePos=e.clientY+document.body.scrollTop+(dE?dE.scrollTop:0);
      }
    }

	function enablePopupLayer(type, comment, listing_title, reply) {
		var float_layer = document.getElementById("float_layer");
        var layer_reply = '';
		float_layer.style.visibility = 'visible';
		//float_layer.style.left = 0;
		//float_layer.style.top = 0;
        
        if ( type == 'review' ) {
        	float_layer.style.left = (xMousePos + 20)+"px";
			float_layer.style.top = (yMousePos + 10)+"px";
	        if (reply) {
	            layer_reply =   '<br />'
	                            +'<p><strong><?=system_showText(LANG_REPLYNOUN);?>: </strong></p>'
	                            +'<p>'+reply+'</p>'
	                            +'';
	        }
			float_layer.innerHTML = ''
									+'<h3>'+listing_title+'</h3>'
									+'<p><strong><?=system_showText(LANG_REVIEW);?>: </strong></p>'
									+'<p>'+comment+'</p>'
	                                +layer_reply;
		} 
		else if ( type == 'langnav' ) {
			float_layer.style.left = (xMousePos - 220)+"px";
			float_layer.style.top = (yMousePos + 10)+"px";
			float_layer.innerHTML = $('#allLang').html();
		}
		
	}

	function disablePopupLayer(keep) {
		var float_layer = document.getElementById("float_layer");
		float_layer.style.visibility = 'hidden';
		if ( !keep ) {
			float_layer.innerHTML = '';
		}
	}
	//]]>
</script>

<? if ($sitemgr) {?>

<style type="text/css">

div.floatLayer {width: 200px; position: absolute; /*top: 0; left: 0;*/ visibility: hidden; background-color: #FCFCFC; border: 2px solid #EEE; height:auto; padding: 5px; z-index: 999;}

	div.floatLayer * {margin: 0; padding: 0;}

		div.floatLayer h3 {font: bold 12px Verdana, Arial, Helvetica, sans-serif; color: #003F7E; text-align: left; padding:3px 0 3px 0;}

		div.floatLayer p {font: normal 10px Verdana, Arial, Helvetica, sans-serif; color: #000; text-align: left; margin: 0; padding: 3px 0 3px 0;}

</style>

<? } ?>

<div id="float_layer" class="floatLayer"></div>