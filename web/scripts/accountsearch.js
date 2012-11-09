/** Private Class *************************************/
function accountSearch(params) {

	var main_div_id = params[0];
	var loading_div_id = params[1];

	var grid_id = params[2];
	var grid_class_name = params[3];

	var thisObj = this;
	var mainDivObj = document.getElementById(main_div_id);
	var loadingDivObj = document.getElementById(loading_div_id);

	this.loadXMLDoc = function (url) {
         if (params[4]&&params[4]!='undefined')
                url=url+"&"+params[4]+"=1";

		if (window.XMLHttpRequest) {
			xmlHttpObj = new XMLHttpRequest();
			xmlHttpObj.onreadystatechange = thisObj.processReqChange;
			xmlHttpObj.open("GET", url, true);
			xmlHttpObj.send(null);
		} else if (window.ActiveXObject) {
			xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
			if (xmlHttpObj) {
				xmlHttpObj.onreadystatechange = thisObj.processReqChange;
				xmlHttpObj.open("GET", url, true);
				xmlHttpObj.send();
			}
		}
	}


	this.processReqChange = function() {
		if (xmlHttpObj.readyState == 4) {
			if (xmlHttpObj.status == 200) {
				var reply = unescape(xmlHttpObj.responseText.replace(/\+/g," "));
				if (reply.substring(reply.length-2) != "ok"){
					thisObj.loadResult('', showText(LANG_JS_ACCOUNTSEARCH_SERVERRESPONSEFAILURE));
				}else{
					thisObj.loadResult('',reply.substring(0,reply.length-2));
				}
			} else {
				alert(showText(LANG_JS_ACCOUNTSEARCH_PROBLEMRETRIEVING ) + "\n" + xmlHttpObj.statusText);
			}
		}
	}

	this.loadResult = function (url, reply){
		if (reply != ''){
			thisObj.openMainGrid(reply);
		} else if(url != '') {
			return (thisObj.loadXMLDoc(url));
		}
	}

	this.openLoadingGrid = function(){
		mainDivObj.style.display = 'none';
		loadingDivObj.style.display = 'block';
	}

	this.openMainGrid = function(reply){
		loadingDivObj.style.display = 'none';
		mainDivObj.style.display = 'block';
		if(!document.getElementById(grid_id)) {
			var grid = document.createElement("DIV");
			grid.id = grid_id;
			grid.className = grid_class_name;
			grid.innerHTML = reply
			mainDivObj.appendChild(grid);
		} else {
			var grid = document.getElementById(grid_id);
			grid.innerHTML = reply
		}
	}
}
/*******************************************************/



/** Public Functions ***********************************/
function resetSearchAccount(extraId) {
	if (extraId <= 0 || !extraId){
		extraId = "";
	}
	document.getElementById('acct_search_company'+extraId).value='';
	document.getElementById('acct_search_username'+extraId).value='';
	document.getElementById('accounts_search'+extraId).style.display='none';
	document.getElementById('accounts_search_loading'+extraId).style.display='none';
}



function cancelSearchAccount(extraId) {
	if (extraId <= 0 || !extraId){
		extraId = "";
	}
	document.getElementById('table_accounts_search'+extraId).style.display='none';
	document.getElementById('table_accounts'+extraId).style.display='block';
}



function changeAccount(extraId){
	resetSearchAccount(extraId);
	if (extraId <= 0 || !extraId){
		extraId = "";
	}
	document.getElementById('table_accounts_search'+extraId).style.display='block';
	document.getElementById('table_accounts'+extraId).style.display='none';
}



function emptySearchAccount(extraId){
	var auxExtraId = "";
	if (extraId <= 0 || !extraId){
		extraId = "";
		auxExtraId = 0;
	} else {
		auxExtraId = extraId;
	}
	document.getElementById('selected_account'+extraId).innerHTML = " <a id=\"change_account_search"+extraId+"\" style='vertical-align: middle' href='javascript:changeAccount("+auxExtraId+")'><b>"+showText(LANG_JS_ACCOUNTSEARCH_CLICKHERETOSELECT)+"</b></a>";
	document.getElementById('table_accounts_search'+extraId).style.display='none';
	document.getElementById('table_accounts'+extraId).style.display='block';

	if (document.getElementById("listingContent")){
		showListings(0);
	}
}



function selectAccount(selected_account, acct_search_field_name, auxExtraId){
	
	if (auxExtraId <= 0 || !auxExtraId){
		auxExtraId = "";
	}
	
	var acct_info = new Array();
	acct_info = selected_account.split("||");

	document.getElementById('selected_account'+auxExtraId).innerHTML = " <a id=\"change_account_search"+auxExtraId+"\" style='vertical-align: middle' href='javascript:changeAccount("+auxExtraId+")'>"+acct_info[1]+"</a>";
	document.getElementById('selected_account'+auxExtraId).innerHTML += "<input type='hidden' id='"+acct_search_field_name+"' name='"+acct_search_field_name+"' value='"+acct_info[0]+"'>";

	document.getElementById('table_accounts_search'+auxExtraId).style.display='none';
	document.getElementById('table_accounts'+auxExtraId).style.display='block';
}

function selectAccountCustom(selected_account, acct_search_field_name, auxExtraId){
    
	var acct_info = new Array();
	acct_info = selected_account.split("||");

	document.getElementById('selected_account').innerHTML = " <a id=\"change_account_search\" style='vertical-align: middle' href='javascript:changeAccount("+auxExtraId+")'>"+acct_info[1]+"</a>";
	document.getElementById('selected_account').innerHTML += "<input type='hidden' id='"+acct_search_field_name+"' name='"+acct_search_field_name+"' value='"+acct_info[0]+"'>";

	document.getElementById('table_accounts_search').style.display='none';
	document.getElementById('table_accounts').style.display='block';

	showListings(acct_info[0]);
}



function searchAccount(formObj, url, custom, extraId) {
	if (extraId <= 0 || !extraId){
		extraId = "";
	}
	if(document.getElementById('acct_search_company'+extraId)
	&& document.getElementById('acct_search_company'+extraId).value.length < 3
	&& document.getElementById('acct_search_username'+extraId)
	&& document.getElementById('acct_search_username'+extraId).value.length < 3) {
        fancy_alert(showText(LANG_JS_ACCOUNTSEARCH_PLEASEPROVIDEATLEAST), "informationMessage", false, 500, 100, false);
        return false;
	}

	url += '/sitemgr/accountsearch.php';
	url += '?company='+document.getElementById('acct_search_company'+extraId).value;
	url += '&username='+document.getElementById('acct_search_username'+extraId).value;
	url += '&acct_search_field_name='+document.getElementById('acct_search_field_name'+extraId).value;
	url += '&extraId='+extraId;

	var params = new Array();

	params[0] = 'accounts_search'+extraId; // main div id
	params[1] = 'accounts_search_loading'+extraId; // loading div id
	params[2] = 'accounts_grid'+extraId; // accounts grid id 
	params[3] = 'div-accounts_grid-form-listing'; // accounts grid class
    if (custom && custom!='undefined' && custom!='false' && custom!='0') {
        params[4] = 'selectAccountCustom'; // custom function
    }

	var acctSearchObj = new accountSearch(params);
	acctSearchObj.openLoadingGrid();
	acctSearchObj.loadResult(url,'');

	formObj.onsubmit = function () {
							if (document.getElementById('table_accounts'+extraId).style.display != 'block') {
								return false;
							} else {
								return true;
							}
						}
}
/*******************************************************/