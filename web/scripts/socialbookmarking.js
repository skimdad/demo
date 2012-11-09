function getAbsoluteTop( oElement ) {
	var iReturnValue = 0;
	while( oElement != null ) {
		iReturnValue += oElement.offsetTop;
		oElement = oElement.offsetParent;
	}

	return iReturnValue;
}

function getAbsoluteLeft( oElement ) {
	var iReturnValue = 0;
	while( oElement != null ) {
		iReturnValue += oElement.offsetLeft;
		oElement = oElement.offsetParent;
	}

	return iReturnValue;
}

function enableSocialBookMarking(id, module, url, comments) {

	if (comments === undefined) {
		comments = 0;
	}

	var left = 0 + getAbsoluteLeft(document.getElementById('link_social_'+id+module));
	var top = 18 + getAbsoluteTop(document.getElementById('link_social_'+id+module));

	$.ajax({
		type: "POST",
		url: url+"/includes/code/socialbookmarking_ajax.php",
		data: "id="+id+"&module="+module+"&comments="+comments,
		success: function(msg){
			$('#div_to_share').html(msg);
		}
	});

	$('#div_to_share').css('top', top+'px').css('left',left+"px").css('z-index','1000').show('fast');

}

function disableSocialBookMarking() {

	//$('#allSocial_'+id).hide('fast');

	$('#div_to_share').hide('fast');

}