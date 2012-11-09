function checkUsername(username, path, option) {

	expression = /(&\B)|(^&)|(#\B)|(^#)/;
	if (expression.exec(username)) {
		username = 'erro';
	}

	$.get(DEFAULT_URL + "/search_username.php", {
		option: option,
		username: username,
		path: path
	}, function (response) {
		$('#checkUsername').html(response);
	});

}