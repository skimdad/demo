
	var Topen=0;
	var Tchange=0;
	
	function showBulkUpdate(num, type, msg_close, msg_open){
		
		item_number = num;
		
		if (Topen==0){
			$('#table_bulk').slideDown('slow');
			$('#change_account').css('display', '');
			$('#bulk_check').css('display', '');
			$('#open_bulk').html(msg_close);
			Tchange=1;
		} else {
			$('#table_bulk').slideUp('slow');
			$('#bulk_check').css('display', 'none');
			$('#open_bulk').html(msg_open);
			Tchange=0;
		}

		if (Topen==0){
			for (i=1;i<=item_number;i++)
				$('#'+type+'_id'+i).css('display', '');
			Tchange=1;
		}else{
			for (i=1;i<=item_number;i++)
				$('#'+type+'_id'+i).css('display', 'none');
			Tchange=0;
		}

		if (Tchange==1){
			Topen=1;
		} else {
			Topen=0;
		}
	}

	function checkAll(type, obj, link, num) {

		var value = obj.checked;
		var val = 0;
		var input = "";

		if(link == true){
			if(value == true){
				obj.checked = false;
				value = false;
				for (i=1;i<=num;i++) {
					document.getElementById(type+'_id'+i).checked = false;
					val = document.getElementById(type+'_id'+i).value;
					$('#' + type + '_' + val).remove();
				}
			} else {
				obj.checked = true;
				value = true;
				
				for (i=1;i<=num;i++) {
					val = document.getElementById(type+'_id'+i).value;
					document.getElementById(type+'_id'+i).checked = true;

					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', type + '_' + val);
					input.setAttribute('name', type + '_id[]');
					input.setAttribute('value', val);
					$('#idlist').append(input);
				}
			}
		} else {
			if(value == true){
				obj.checked = true;
				value = true;
				
				for (i=1;i<=num;i++) {
					if (document.getElementById(type+'_id'+i)) {
						val = document.getElementById(type+'_id'+i).value;
						document.getElementById(type+'_id'+i).checked = true;

						input = document.createElement('input');
						input.setAttribute('type', 'hidden');
						input.setAttribute('id', type + '_' + val);
						input.setAttribute('name', type + '_id[]');
						input.setAttribute('value', val);
						$('#idlist').append(input);
					}
				}
			} else {
				obj.checked = false;
				value = false;
				for (i=1;i<=num;i++) {
					val = document.getElementById(type+'_id'+i).value;
					document.getElementById(type+'_id'+i).checked = false;
					$('#' + type + '_' + val).remove();
				}
			}
		}
	}

	function setLocationSelect () {
		var arrayIds = new Array();
		var n_checked = 0;

		var val = 0;
		var input = "";

		for (i=0; i < document.item_table.elements.length ; i++) {
			if (document.item_table.elements[i].name == "item_check[]") {
				if (document.item_table.elements[i].checked) {
					arrayIds[n_checked] = document.item_table.elements[i].value;

					val = document.item_table.elements[i].value;
					$('#location_' + val).remove();
					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', 'location_' + val);
					input.setAttribute('name', 'location_id[]');
					input.setAttribute('value', val);
					$('#idlist').append(input);

					n_checked++;
				} else {
					val = document.item_table.elements[i].value;
					$('#location_' + val).remove();
				}
			}
		}
	}

	function removeCategoryDropDown(type, url) {

		var arrayIds = new Array();
		var n_checked = 0;

		var val = 0;
		var input = "";



		for (i=0; i < document.item_table.elements.length ; i++) {
			if (document.item_table.elements[i].name == "item_check[]") {
				if (document.item_table.elements[i].checked) {
					arrayIds[n_checked] = document.item_table.elements[i].value;

					val = document.item_table.elements[i].value;
					$('#' + type + '_' + val).remove();
					input = document.createElement('input');
					input.setAttribute('type', 'hidden');
					input.setAttribute('id', type + '_' + val);
					input.setAttribute('name', type + '_id[]');
					input.setAttribute('value', val);
					$('#idlist').append(input);

					n_checked++;
				} else {
					val = document.item_table.elements[i].value;
					$('#' + type + '_' + val).remove();
				}
			}
		}

		if (type != 'banner' && type != 'promotion') {
			try {
				xmlhttp = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp = false;
					}
				}
			}
			if (xmlhttp) {
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							if (document.getElementById('delete_all').checked != "true" && document.getElementById('tr_category').style.display != "none") {
								$('#tr_category').css('display', '');

								if (!xmlhttp.responseText) {
									$('#tr_category').css('display', 'none');
								}
								document.getElementById("remove_category").innerHTML = xmlhttp.responseText;
							} else if (arrayIds.length > 0) {
								$('#tr_category').css('display', '');
								if (!xmlhttp.responseText) {
									$('#tr_category').css('display', 'none');
								}
								document.getElementById("remove_category").innerHTML = xmlhttp.responseText;
							}
						}
					}
				}
				xmlhttp.open('GET', url+'/sitemgr/bulkupdate.php?ids=' + arrayIds + '&type=' + type + '&delete=' + document.getElementById('delete_all').checked, true);
				xmlhttp.send(null);
			}
		}
		
	}

	function disableBulkOptions(obj) {

		var value = obj.checked;
		
		if (value == true) {
			document.getElementById('change_no_owner').disabled = true;
			if (document.getElementById('level')) {
				document.getElementById('level').disabled = true;
			}
			if (document.getElementById('status')) {
				document.getElementById('status').disabled = true;
			}
			if (document.getElementById('change_renewaldate')) {
				document.getElementById('change_renewaldate').disabled = true;
			}
			if (document.getElementById('add_category_id')) {
				document.getElementById('add_category_id').disabled = true;
			}			
			if (document.getElementById('tr_category')) {
				if (document.getElementById('tr_category').style.display == "") {
					if (document.getElementById('removecategory')) {
						document.getElementById('removecategory').disabled = true;
					}
				}
			}
			document.getElementById('change_account_search').href = "javascript:void(0);";
			if (document.getElementById('section_general')) {
				document.getElementById('section_general').disabled = true;
			}
			if (document.getElementById('section_listing')) {
				document.getElementById('section_listing').disabled = true;
			}
			if (document.getElementById('section_event')) {
				document.getElementById('section_event').disabled = true;
			}
			if (document.getElementById('section_classified')) {
				document.getElementById('section_classified').disabled = true;
			}
			if (document.getElementById('section_article')) {
				document.getElementById('section_article').disabled = true;
			}
			if (document.getElementById('section_global')) {
				document.getElementById('section_global').disabled = true;
			}
			
		} else {
			document.getElementById('change_no_owner').disabled = false;
			if (document.getElementById('level')) {
				document.getElementById('level').disabled = false;
			}
			if (document.getElementById('status')) {
				document.getElementById('status').disabled = false;
			}
			if (document.getElementById('change_renewaldate')) {
				document.getElementById('change_renewaldate').disabled = false;
			}
			if (document.getElementById('add_category_id')) {
				document.getElementById('add_category_id').disabled = false;
			}		
			if (document.getElementById('tr_category')) {
				if (document.getElementById('tr_category').style.display == "none") {
					if (document.getElementById('removecategory')) {
						document.getElementById('removecategory').disabled = false;
					}
				}else{
					document.getElementById('removecategory').disabled = false;
				}
			}
			document.getElementById('change_account_search').href = "javascript:changeAccount()";
			if (document.getElementById('section_general')) {
				document.getElementById('section_general').disabled = false;
			}
			if (document.getElementById('section_listing')) {
				document.getElementById('section_listing').disabled = false;
			}
			if (document.getElementById('section_event')) {
				document.getElementById('section_event').disabled = false;
			}
			if (document.getElementById('section_classified')) {
				document.getElementById('section_classified').disabled = false;
			}
			if (document.getElementById('section_article')) {
				document.getElementById('section_article').disabled = false;
			}
			if (document.getElementById('section_global')) {
				document.getElementById('section_global').disabled = false;
			}
		}
		
	}
	