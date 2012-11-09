var advancedSearchShow = false;
function showAdvancedSearch(item_type, action, action_adv, template_id, load_cat) {
	document.getElementById("buttonSearch").removeAttribute("onclick");
	var aux_data = "fnct=categories&type="+item_type;
	
	if (load_cat){
		/*
		 * Load dropdown using ajax
		 */
		if(template_id > 0){
			aux_data += "&template_id="+template_id;
		}

		$.ajax({
		  url: DEFAULT_URL+"/advancedsearch_categories.php",
		  context: document.body,
		  data: aux_data,
		  success: function(html){
			$("#advanced_search_category_dropdown").html(html)
		  }
		});	
	}

	$('#keyword').attr('onkeyup', '');
	$('#keyword').attr('onkeypress', '');
	if (document.getElementById("where")){
		$('#where').attr('onkeyup', '');
		$('#where').attr('onkeypress', '');
	}
	if (document.getElementById("locations_default_where")){
		if (document.getElementById("locations_default_where").value){
			if (document.getElementById("locations_default_where_replace").value == "yes"){
			document.getElementById("where").value = document.getElementById("locations_default_where").value;
		}
	}
	}
	document.getElementById("buttonSearch").setAttribute("type", "submit");
	var form = document.getElementById("search_form");
	form.action = action_adv;
	form.method = 'get';
	document.getElementById("advanced-search-button").onclick = function() {
		closeAdvancedSearch(item_type, action, action_adv, template_id);
	}
	$('#advanced-search').slideDown('slow');
	$('#advanced-search-label').hide();
	$('#advanced-search-label-close').show();
}

function closeAdvancedSearch(item_type, action, action_adv, template_id) {
	var form = document.getElementById("search_form");
	form.action = action;
	form.method = 'post';
	document.getElementById("buttonSearch").setAttribute("onclick", "submitformSearch('"+action+"')");
	$('#keyword').attr('onkeyup', "changeFormAction('"+action+"',this.value, '')");
	$('#keyword').attr('onkeypress', "submitenter(this,event)");
	if (document.getElementById("where")){
		$('#where').attr('onkeyup', "changeFormAction('"+action+"','',this.value)");
		$('#where').attr('onkeypress', "submitenter(this,event)");
	}
	document.getElementById("buttonSearch").setAttribute("type", "button");
	document.getElementById("advanced-search-button").onclick = function() {
		showAdvancedSearch(item_type, action, action_adv, template_id, true);
	}
	$('#advanced-search').slideUp('slow');
	$('#advanced-search-label').show();
	$('#advanced-search-label-close').hide();
}

function showAdvancedTemplateSearch(template_id, path) {
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
	for (i=0; i<document.getElementById("templateSearchTabs").childNodes.length; i++) {
		if (document.getElementById("templateSearchTabs").childNodes[i].id.indexOf("templateActiveID") >= 0) {
			document.getElementById(document.getElementById("templateSearchTabs").childNodes[i].id).className = "templateSearchTab";
		}
	}
	document.getElementById("advancedTemplateSearchID").className = "templateTabContent isVisible";
	document.getElementById("advancedTemplateSearchID").innerHTML = "<p class=\"loading\">Loading...</p>";
	if (xmlhttp) {
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4) {
				if (xmlhttp.status == 200) {
					document.getElementById("templateIDID").value = template_id;
					document.getElementById("templateActiveID"+template_id).className = "templateActive";
					document.getElementById("advancedTemplateSearchID").className = "templateTabContent isHidden";
					document.getElementById("advancedTemplateSearchID").innerHTML = xmlhttp.responseText;
					document.getElementById("advancedTemplateSearchID").className = "templateTabContent isVisible";
				}
			}
		}
		xmlhttp.open("GET", path + "/search_template.php?template_id=" + template_id, true);
		xmlhttp.send(null);
	}
}