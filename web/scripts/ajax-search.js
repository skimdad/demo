var position ;
var id_element;

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest(); //Outros browsers sem ser o IE
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP"); //IE
	} else {
		//Exibe a mensagem de erro
		alert("Your browser does not accept the XmlHttpRequest object.Please update it");

	}
}

function updateSelect(selectObj,texto){
	var tempDiv = document.createElement("div");
	var attString = "";
	var att = selectObj.attributes;
	var oldOnChange = selectObj.onchange;
	for(var i = 0 ; i < att.length ; i++)
		if(att[ i ].nodeValue != "" && att[ i ].nodeValue != null )//o IE diz que nó tem todos os atributos possíveis com valor null ou "" então temos que filtrar esses valores
			tempDiv.innerHTML = "<select "+attString+">"+texto+"</select>";
	var newSelect = tempDiv.firstChild;
	newSelect.onchange = oldOnChange
	selectObj.parentNode.replaceChild(newSelect,selectObj);
	selectObj = null;tempDiv = null;
	return newSelect;
}

function loadOnSelect(URL,divResponseID) {
	/** create new xmlhttprequest **/
	var ajax = getXmlHttpRequestObject();
	if(ajax) {
		ajax.open("GET", URL, true);
		headerResponse='application/x-www-form-urlencoded';
		ajax.setRequestHeader("Content-Type", headerResponse);
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4 ) {
				if (ajax.responseText == false) {
					//alert("empty response from "+param);					
				}
				else {
					if (document.getElementById(divResponseID)){
						updateSelect(document.getElementById(divResponseID),ajax.responseText) ;
					}
				}

			}
		}
		ajax.send(null);
	}
}


function loadOnDIV(URL,divResponseID) {
	/** create new xmlhttprequest **/
	var ajax = getXmlHttpRequestObject();
	if(ajax) {
		ajax.open("GET", URL, true);
		headerResponse='application/x-www-form-urlencoded';
		ajax.setRequestHeader("Content-Type", headerResponse);
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4 ) {
				if (ajax.responseText == false) {
					//alert("empty response from "+param);					
				}
				else {
					if (document.getElementById(divResponseID)){
						document.getElementById(divResponseID).innerHTML = ajax.responseText;
					}
				}

			}
		}
		ajax.send(null);
	}
}


function loadOnDIVField(URL,divResponseID) {
	/** create new xmlhttprequest **/
	var ajax = getXmlHttpRequestObject();
	if(ajax) {
		ajax.open("GET", URL, true);
		headerResponse='application/x-www-form-urlencoded';
		ajax.setRequestHeader("Content-Type", headerResponse);
		ajax.onreadystatechange = function() {
			if(ajax.readyState == 4 ) {
				if (ajax.responseText == false) {
					//alert("empty response from "+param);
					
				}
				else {
					if (document.getElementById(divResponseID))
					document.getElementById(divResponseID).value = ajax.responseText;
				}

			}
		}
		ajax.send(null);
	}
}

function loadXMLDoc_Ajax(url) {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange_Ajax;
		req.open("GET", url, true);
		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange_Ajax;
			req.open("GET", url, true);
			req.send();
		}
	}
}

function processReqChange_Ajax() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {
			// ...processing statements go here
			response  = req.responseXML.documentElement;
			if(response) {
				var result = new Array();
				
				for(i=0; i < response.getElementsByTagName('id').length; i++){
					result[i] = {'id': response.getElementsByTagName('id')[i].firstChild.data, 'title': response.getElementsByTagName('title')[i].firstChild.data, 'content': response.getElementsByTagName('content')[i].firstChild.data, 'image': response.getElementsByTagName('image')[i].firstChild.data, 'image_id': response.getElementsByTagName('image_id')[i].firstChild.data, 'friendly_url': response.getElementsByTagName('friendly_url')[i].firstChild.data};
					
				}
				//alert(response.getElementsByTagName('id').value);
				loadResult_Ajax('',result,id_element);
			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function loadResult_Ajax(url, result, id_element_form){
	id_element = id_element_form;
		
	var field_1 = 'top_article_title_'+id_element;
	var field_2 = 'top_article_link_'+id_element;
	var field_3 = 'top_article_content_'+id_element;
	var field_4 = 'image_uploaded_'+id_element;
	var field_5 = 'article_id_'+id_element;
	var field_6 = 'article_image_id_'+id_element;
	
	
	if (result != ''){
		// Response mode
		for(i=0; i < result.length; i++){
			document.getElementById(field_1).value = result[i].title;
			document.getElementById(field_2).value = result[i].friendly_url;
			document.getElementById(field_3).value = result[i].content;
			document.getElementById(field_4).innerHTML = result[i].image;	
			document.getElementById(field_5).value = result[i].id;		
			document.getElementById(field_6).value = result[i].image_id;		
		}
	} else if(url != '') {
		// Input mode
		return (loadXMLDoc_Ajax(url));
	}
}



function SaveAjax(url,divResponseID,form,type_return){
	/** create new xmlhttprequest **/
	var ajax = getXmlHttpRequestObject();
	var response_div= document.getElementById(divResponseID);
	if(ajax) {
		
        this.form= form;
        var counter;
        var params = "";
        if (this.form.elements.length==0){
            alert('No elements in this form');
            return false;
        }
        for (counter = 0; counter <= this.form.elements.length; counter++)
        {
            if (this.form.elements[counter])
            {
                if (this.form.elements[counter].type != "button" && this.form.elements[counter].type != "submit")
                {
                    // RADIO EXCEPTION ( WHEN SELECTED )
                    if (this.form.elements[counter].type == "radio"){
                        if (this.form.elements[counter].checked==true)
                        params += this.form.elements[counter].name+"="+this.form.elements[counter].value+"&";
                        // CHECKBOX EXCEPTION ( WHEN SELECTED )
                    } else if (this.form.elements[counter].type == "checkbox"){
                        if (this.form.elements[counter].checked==true)
                        params += this.form.elements[counter].name+"="+this.form.elements[counter].value+"&";
                    } else params += this.form.elements[counter].name+"="+this.form.elements[counter].value+"&";
                }
            }
        }

		ajax.open("POST", url, true);		
		//var params="responseType="+outputType+"&"+params;
        //toPostURL=host+'/ajax/'+posturl;        
        headerResponse='application/x-www-form-urlencoded';
        ajax.setRequestHeader("Content-Type", headerResponse);
        ajax.onreadystatechange = function() {					            
            if(ajax.readyState == 4 ) {             
            	// HTML ---------------------------------
                if (ajax.responseText == false) {
                    alert("HTML Request Error");
                }else{
                	if(type_return == 'innerHtml'){                		
                		response_div.innerHTML = ajax.responseText;
                	}else if(type_return == 'value'){
                		response_div.value = ajax.responseText;
                	}else if(type_return == 'alert'){
                		alert(ajax.responseText);
                	}
                    
                }
                //  -------------------------------------
                
            }
        }        
        ajax.send(params);        
	}
}


/*
=============== functions to contract tenders ==================================*/

function loadXMLDoc_Contract(url) {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange_Contract;
		req.open("GET", url, true);
		req.send(null);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
		if (req) {
			req.onreadystatechange = processReqChange_Contract;
			req.open("GET", url, true);
			req.send();
		}
	}
}

function processReqChange_Contract() {
	// only if req shows "complete"
	if (req.readyState == 4) {
		// only if "OK"
		if (req.status == 200) {
			// ...processing statements go here
			response  = req.responseXML.documentElement;
			if(response) {
				var result = new Array();
				for(i=0; i < response.getElementsByTagName('id').length; i++){
					result[i] = {'id': response.getElementsByTagName('id')[i].firstChild.data, 'title': response.getElementsByTagName('title')[i].firstChild.data};
					
				}
				//alert(response.getElementsByTagName('id').value);			
				loadResult_Contract('',result);
			}
		} else {
			alert("There was a problem retrieving the XML data:\n" + req.statusText);
		}
	}
}

function loadResult_Contract(url, result){
		
	var field_1 = 'organization_id';
	var field_2 = 'table_organization_name';
	
	
	if (result != ''){
		// Response mode
		for(i=0; i < result.length; i++){
			document.getElementById(field_1).value = result[i].id;			
			document.getElementById(field_2).innerHTML = result[i].title;				
		}
	} else if(url != '') {
		// Input mode
		return (loadXMLDoc_Contract(url));
	}
}

/////////LOCATION
function edirajax_getXMLHTTP() {
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
			return xmlhttp;
		}
	
	function LoadScript(URL) {

		var xmlhttp;
		xmlhttp = edirajax_getXMLHTTP();
		if (xmlhttp) {
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4) {
					if (xmlhttp.status == 200) {
						eval(xmlhttp.responseText);
					} else {
					}
				}
			}
		} else {
		}
		xmlhttp.open("GET", URL, true);
		xmlhttp.send(null);
		

	}