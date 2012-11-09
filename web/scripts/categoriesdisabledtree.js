function createXMLObject(){
	var xmlHTTP;
	try {
		xmlHTTP = new XMLHttpRequest();
    } catch (e) {
		try {
			xmlHTTP = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHTTP = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlHTTP = false;
			}
		}
    }
	return xmlHTTP;
}

function showDisabledCategories(prefix, category, path, domain_id) {
	$('#linkShowDisabledCategories').css('display','none');
	$('#linkHideDisabledCategories').css('display','');
	$('#' + prefix + 'disabledCategoryTree').css('display','');
	loadCategoryTree('all', prefix, category, 0, 0, path, domain_id);
}

function hideDisabledCategories(prefix){
	$('#linkShowDisabledCategories').css('display','');
	$('#linkHideDisabledCategories').css('display','none');
	$('#' + prefix + 'disabledCategoryTree').css('display','none');
}

function loadCategoryTree(action, prefix, category, category_id, template_id, path, domain_id) {
	var ajax_categories = 0;
	
	if(document.getElementById("feed")){
		
		var categories_aux = new Array();
		
		if(document.getElementById("feed").length > 0){
			for(i =0 ; i < document.getElementById("feed").length ; i++){
			  categories_aux[i] = document.getElementById("feed").options[i].value;
			}
			var categories = categories_aux.join(",");
			ajax_categories = categories;
		}
	}

	var xmlhttp = createXMLObject();
	
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "<li class=\"loading\">"+showText(LANG_JS_LOADCATEGORYTREE)+"</li>";
	if (xmlhttp) {
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if (xmlhttp.status == 200) {
					if (category_id > 0) {
						$('#'+prefix+"opencategorytree_id_"+category_id).css('display', 'none');
						$('#'+prefix+"opencategorytree_title_id_"+category_id).css('display', 'none');
						$('#'+prefix+"closecategorytree_id_"+category_id).css('display', '');
						$('#'+prefix+"closecategorytree_title_id_"+category_id).css('display', '');
					}
					document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = xmlhttp.responseText;
				}
			}
		}
	
		xmlhttp.open("GET", path + "/sitemgr/loaddisabledcategorytree.php?action=" + action + "&prefix=" + prefix + "&category=" + category + "&category_id=" + category_id + "&template_id=" + template_id + "&ajax_categories=" + ajax_categories + "&domain_id=" + domain_id, true);
		xmlhttp.send(null);
	}
}

function closeCategoryTree(prefix, category, category_id, path) {
	if (category_id > 0) {
		$('#'+prefix+"closecategorytree_id_"+category_id).css('display', 'none');
		$('#'+prefix+"closecategorytree_title_id_"+category_id).css('display', 'none');
		$('#'+prefix+"opencategorytree_id_"+category_id).css('display', '');
		$('#'+prefix+"opencategorytree_title_id_"+category_id).css('display', '');
	}
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "none";
}