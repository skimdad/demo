
var obj;

/* Ajax Impressions DropDown ********************************************/

function bannerFillSelect(host, obj, value, domain_id){
	this.obj = obj;
	bannerResetSelect(obj);
	// check if object exisits.
	if(typeof obj != 'object') return false;
	url  = host+'/includes/code/banner_xml_info.php?level=' + value + '&domain_id=' + domain_id;
	if(value > 0) bannerLoadResult(url,'');
}

function bannerResetSelect(obj){
	while (obj.options.length >= 1) {
		deleteIndex=obj.options.length-1;
		obj.options[deleteIndex]=null;
	}
}

function bannerLoadXMLDoc(url) {  
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = bannerProcessReqChange;
		req.open("GET", url, true);
		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = bannerProcessReqChange;
			req.open("GET", url, true);
			req.send();
		}
	}
}

function bannerProcessReqChange() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {
			// ...processing statements go here
			response  = req.responseXML.documentElement;
			if(response) {
				var result = new Array();
				for(i=0; i < 50; i++){
					result[i] = response.getElementsByTagName('block')[0].firstChild.data*i
				}
				bannerLoadResult('',result);
			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function bannerLoadResult(url, result){
	if (result != ''){
		// Response mode
		for(i=0; i < result.length; i++){
			this.obj.options[this.obj.options.length]  = new Option(result[i],result[i]);
		}
	} else if(url != '') {
		// Input mode
		return (bannerLoadXMLDoc(url));
	}
}

/************************************************************************/


/* Text Ad Banner *******************************************************/

function bannerDisableRenewalDate(){
	if(document.getElementById('unpaid_impressions')) document.getElementById('unpaid_impressions').disabled = false;
	if(document.getElementById('impressions')) document.getElementById('impressions').disabled = false;
	if(document.getElementById('renewal_date')) document.getElementById('renewal_date').disabled = true;
    if (document.getElementById('labelRenewal')){
        $("#labelRenewal").text("");
    }
    if (document.getElementById('labelImpressions')){
        $("#labelImpressions").text("* ");
    }
}

function bannerDisableImpressions(){
	if(document.getElementById('unpaid_impressions')) document.getElementById('unpaid_impressions').disabled = true;
	if(document.getElementById('impressions')) document.getElementById('impressions').disabled = true;
	if(document.getElementById('renewal_date')) document.getElementById('renewal_date').disabled = false;
    if (document.getElementById('labelImpressions')){
        $("#labelImpressions").text("");
    }
    if (document.getElementById('labelRenewal')){
        $("#labelRenewal").text("* ");
    }
}

function bannerCheckType(type, url, languages, EDIR_LANGUAGENUMBERS, EDIR_DEFAULT_LANGUAGENUMBER){

	var arrLangNumbers = EDIR_LANGUAGENUMBERS.split(',');

	if (type < 50) {
		bannerDisableTextForm();
       
        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
            $('#tab_caption_'+i).removeClass("tabActived");
            $('#caption_'+i).css('display', 'none');
            $('#file_'+i).css('display', 'none');
        }

		//reset language fields for image banners
        $('#tab_caption_' + EDIR_DEFAULT_LANGUAGENUMBER).addClass("tabActived");
        $('#caption_' + EDIR_DEFAULT_LANGUAGENUMBER).css('display', '');
        $('#file_' + EDIR_DEFAULT_LANGUAGENUMBER).css('display', '');
	} else if (type >= 50) {
		bannerDisableImagesForm();
        
        for (j=0;j<languages;j++) {
			i = arrLangNumbers[j];
            $('#tab_caption_'+i).removeClass("tabActived");
            $('#caption_'+i).css('display', 'none');
            $('#description1_'+i).css('display', 'none');
            $('#description2_'+i).css('display', 'none');
        }

		//reset language fields for image banners
        $('#tab_caption_' + EDIR_DEFAULT_LANGUAGENUMBER).addClass("tabActived");
        $('#caption_' + EDIR_DEFAULT_LANGUAGENUMBER).css('display', '');
        $('#description1_' + EDIR_DEFAULT_LANGUAGENUMBER).css('display', '');
        $('#description2_' + EDIR_DEFAULT_LANGUAGENUMBER).css('display', '');
	}

}

function bannerDisableImagesForm(){
	tmpBanner_with_images_content=document.getElementById("banner_with_images").innerHTML;
	document.getElementById("banner_with_images").innerHTML="";
	document.getElementById("banner_with_text").innerHTML=banner_tmp_form_text_content;
}

function bannerDisableTextForm(){
	tmpBanner_banner_with_text=document.getElementById("banner_with_text").innerHTML;
	document.getElementById("banner_with_text").innerHTML="";
	document.getElementById("banner_with_images").innerHTML=banner_tmp_form_images_content;
}

/************************************************************************/
/************************************************************************/
/************************************************************************/

function fillBannerCategorySelect(host, obj, value, form, domain_id, from) {
	this.obj = obj;
	while (obj.options.length >= 1) {
		deleteIndex = obj.options.length-1;
		obj.options[deleteIndex] = null;
	}
	url = host + '/includes/code/fill_banner_category.php?section=' + value + '&domain_id=' + domain_id + '&from=' + from;
	if (value.length) {
		loadBannerResult(url, '');
		if (value == "general" || value == "global") {
			obj.disabled=true;
		} else {
			obj.disabled=false;
		}
	}
}

function loadBannerXMLDoc(url) {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processBannerReqChange;
		req.open("GET", url, true);
		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processBannerReqChange;
			req.open("GET", url, true);
			req.send();
		}
	}
}

function processBannerReqChange() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {
			// ...processing statements go here
			response  = req.responseXML.documentElement;
			if(response) {
				var result = new Array();
				for(i=0; i < response.getElementsByTagName('id').length; i++){
					result[i] = {'id': response.getElementsByTagName('id')[i].firstChild.data, 'name': response.getElementsByTagName('name')[i].firstChild.data};
				}
				loadBannerResult('', result);
			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function loadBannerResult(url, result) {
	if (result != '') {
		// Response mode
		for (i=0; i < result.length; i++) {
			this.obj.options[this.obj.options.length] = new Option(result[i].name,result[i].id);
		}
	} else if(url != '') { 
		// Input mode
		return (loadBannerXMLDoc(url));
	}
}

/************************************************************************/
/************************************************************************/
/************************************************************************/
