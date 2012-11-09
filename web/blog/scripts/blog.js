
function showhideFormReply(id, remove, msg){
	
	$('#reply_cancel').css('display', '');
	$('#liRId_'+id).css('display', 'none');
	var reply_id = $('#reply_id').val();
	if (reply_id != 0) {
		$('#liRId_'+reply_id).css('display', '');
	}

	$('#reply_id').val(id);

	if (remove) {
		$("#error").remove();
	}

	$('#reply_'+id).html($('#reply_'+reply_id).html());
	$('#reply_'+reply_id).html('');
	$('#infoComment').html(msg);
	$('html, body').animate({
		scrollTop: $('#cmm_'+id).offset().top
	}, 500);

	$('#messageSucess').remove();
}

function cancelReply(url) {
	window.location = url;
}
