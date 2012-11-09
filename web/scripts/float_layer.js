document.onmousemove = captureMousePosition;
var xMousePos = 0; // Horizontal position of the mouse on the screen
var yMousePos = 0; // Vertical position of the mouse on the screen

function captureMousePosition(e) {
  e=e||window.event;
  if(e.pageX || e.pageY) { // Netscape Mozilla
	xMousePos = e.pageX;
	yMousePos = e.pageY;
  } else if(typeof(e.clientX)=='number') { // IE
	xMousePos = event.clientX;
	yMousePos = event.clientY;
//	var dE=document.documentElement;
//	xMousePos=e.clientX+document.body.scrollLeft+(dE?dE.scrollLeft:0);
//	yMousePos=e.clientY+document.body.scrollTop+(dE?dE.scrollTop:0);
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