
function loadCategoryTree(action, prefix, category, category_id, template_id, path, domain_id) {

	if (document.getElementById('newcategory')){
		document.getElementById('newcategory').style.display='none';
		}
	if (document.getElementById("back")){
		document.getElementById("back").style.display='none';
		document.getElementById("msgback").style.display='none';
		document.getElementById("msgback2").style.display='';
		document.getElementById('addnewcateg').style.display='';
		document.getElementById("newcategory").style.display='none';
	}
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

	var xmlhttp;
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
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "<li class=\"loading\">"+showText(LANG_JS_LOADCATEGORYTREE)+"</li>";
	if (xmlhttp) {
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if (xmlhttp.status == 200) {
					if (category_id > 0) document.getElementById(prefix+"opencategorytree_id_"+category_id).style.display = "none";
					if (category_id > 0) document.getElementById(prefix+"opencategorytree_title_id_"+category_id).style.display = "none";
					if (category_id > 0) document.getElementById(prefix+"closecategorytree_id_"+category_id).style.display = "";
					if (category_id > 0) document.getElementById(prefix+"closecategorytree_title_id_"+category_id).style.display = "";
					document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = xmlhttp.responseText;
				}
			}
		}
		
		xmlhttp.open("GET", path + "/loadcategorytree.php?action=" + action + "&prefix=" + prefix + "&category=" + category + "&category_id=" + category_id + "&template_id=" + template_id + "&ajax_categories=" + ajax_categories + "&domain_id=" + domain_id, true);
		xmlhttp.send(null);
	}
}

function closeCategoryTree(prefix, category, category_id, path) {
	if (category_id > 0) document.getElementById(prefix+"closecategorytree_id_"+category_id).style.display = "none";
	if (category_id > 0) document.getElementById(prefix+"closecategorytree_title_id_"+category_id).style.display = "none";
	if (category_id > 0) document.getElementById(prefix+"opencategorytree_id_"+category_id).style.display = "";
	if (category_id > 0) document.getElementById(prefix+"opencategorytree_title_id_"+category_id).style.display = "";
	//document.getElementById('newcategory').style.display='none';
	document.getElementById(prefix+"categorytree_id_"+category_id).innerHTML = "";
	document.getElementById(prefix+"categorytree_id_"+category_id).style.display = "none";
}