(function($) {
	var openedPopups = [];
	var popupLayerScreenLocker = false;
    var focusableElement = [];
	var setupJqueryMPopups = {
		screenLockerBackground: "#000",
		screenLockerOpacity: "0.5"
	};

	$.setupJMPopups = function(settings) {
		setupJqueryMPopups = jQuery.extend(setupJqueryMPopups, settings);
		return this;
	}

	$.openPopupLayer = function(settings) {
		if (typeof(settings.name) != "undefined" && !checkIfItExists(settings.name)) {
			settings = jQuery.extend({
				width: "auto",
				height: "auto",
				parameters: {},
				target: "",
				success: function() {},
				error: function() {},
				beforeClose: function() {},
				afterClose: function() {},
				reloadSuccess: null,
				cache: false
			}, settings);
			loadPopupLayerContent(settings, true);
			return this;
		}
	}

	$.closePopupLayer = function(name) {
		if (name) {
			for (var i = 0; i < openedPopups.length; i++) {
				if (openedPopups[i].name == name) {
					var thisPopup = openedPopups[i];

					openedPopups.splice(i,1)

					thisPopup.beforeClose();

					$("#popupLayer_" + name).fadeOut(function(){
						$("#popupLayer_" + name).remove();

						focusableElement.pop();

						if (focusableElement.length > 0) {
							$(focusableElement[focusableElement.length-1]).focus();
						}

						thisPopup.afterClose();
						hideScreenLocker(name);
					});
					break;
				}
			}
		} else {
			if (openedPopups.length > 0) {
				$.closePopupLayer(openedPopups[openedPopups.length-1].name);
			}
		}
		return this;
	}

	$.reloadPopupLayer = function(name, callback) {
		if (name) {
			for (var i = 0; i < openedPopups.length; i++) {
				if (openedPopups[i].name == name) {
					if (callback) {
						openedPopups[i].reloadSuccess = callback;
					}

					loadPopupLayerContent(openedPopups[i], false);
					break;
				}
			}
		} else {
			if (openedPopups.length > 0) {
				$.reloadPopupLayer(openedPopups[openedPopups.length-1].name);
			}
		}

		return this;
	}

	function setScreenLockerSize() {
		if (popupLayerScreenLocker) {
			$('#popupLayerScreenLocker').height($(document).height() + "px");
			$('#popupLayerScreenLocker').width($(document.body).outerWidth(true) + "px");
		}
	}

	function checkIfItExists(name) {
		if (name) {
			for (var i = 0; i < openedPopups.length; i++) {
				if (openedPopups[i].name == name) {
					return true;
				}
			}
		}
		return false;
	}

	function showScreenLocker() {
		if ($("#popupLayerScreenLocker").length) {
			if (openedPopups.length == 1) {
				popupLayerScreenLocker = true;
				setScreenLockerSize();
				$('#popupLayerScreenLocker').fadeIn();
			}

			if ($.browser.msie && $.browser.version < 7) {
				$("select:not(.hidden-by-jmp)").addClass("hidden-by-jmp hidden-by-" + openedPopups[openedPopups.length-1].name).css("visibility","hidden");
			}

			$('#popupLayerScreenLocker').css("z-index",parseInt(openedPopups.length == 1 ? 999 : $("#popupLayer_" + openedPopups[openedPopups.length - 2].name).css("z-index")) + 1);
		} else {
			$("body").append("<div id='popupLayerScreenLocker'><!-- --></div>");
			$("#popupLayerScreenLocker").css({
				position: "absolute",
				background: setupJqueryMPopups.screenLockerBackground,
				left: "0",
				top: "0",
				opacity: setupJqueryMPopups.screenLockerOpacity,
				display: "none"
			});
			showScreenLocker();

            $("#popupLayerScreenLocker").click(function() {
                $.closePopupLayer();
            });
		}
	}

	function hideScreenLocker(popupName) {
		if (openedPopups.length == 0) {
			screenlocker = false;
			$('#popupLayerScreenLocker').fadeOut();
		} else {
			$('#popupLayerScreenLocker').css("z-index",parseInt($("#popupLayer_" + openedPopups[openedPopups.length - 1].name).css("z-index")) - 1);
                }

		if ($.browser.msie && $.browser.version < 7) {
			$("select.hidden-by-" + popupName).removeClass("hidden-by-jmp hidden-by-" + popupName).css("visibility","visible");
            }

	}

	function setPopupLayersPosition(popupElement, animate) {
		if (popupElement) {
            if (popupElement.width() < $(window).width()) {
				var leftPosition = (document.documentElement.offsetWidth - popupElement.width()) / 2;
			} else {
				var leftPosition = document.documentElement.scrollLeft + 5;
			}

			if (popupElement.height() < $(window).height()) {
				var topPosition = document.documentElement.scrollTop + ($(window).height() - popupElement.height()) / 2;
			} else {
				var topPosition = document.documentElement.scrollTop + 5;
			}

			var positions = {
				left: leftPosition + "px",
				top: topPosition + "px"
			};

			if (!animate) {
				popupElement.css(positions);
			} else {
				popupElement.animate(positions, "slow");
			}

            setScreenLockerSize();
		} else {
			for (var i = 0; i < openedPopups.length; i++) {
				setPopupLayersPosition($("#popupLayer_" + openedPopups[i].name), true);
			}
		}
	}

    function showPopupLayerContent(popupObject, newElement, data) {
        var idElement = "popupLayer_" + popupObject.name;
		var zIndex;

        if (newElement) {
			showScreenLocker();
			$("body").append("<div id='" + idElement + "'><!-- --></div>");
			zIndex = parseInt(openedPopups.length == 1 ? 1000 : $("#popupLayer_" + openedPopups[openedPopups.length - 2].name).css("z-index")) + 2;
		} else {
			zIndex = $("#" + idElement).css("z-index");
		}

        var popupElement = $("#" + idElement);

		popupElement.css({
			visibility: "hidden",
			width: popupObject.width == "auto" ? "" : popupObject.width + "px",
			height: popupObject.height == "auto" ? "" : popupObject.height + "px",
			position: "absolute",
			"z-index": zIndex
		});

		var linkAtTop = "<a href='#' class='jmp-link-at-top' style='position:absolute; left:-9999px; top:-1px;'>&nbsp;</a><input class='jmp-link-at-top' style='position:absolute; left:-9999px; top:-1px;' />";
		var linkAtBottom = "<a href='#' class='jmp-link-at-bottom' style='position:absolute; left:-9999px; bottom:-1px;'>&nbsp;</a><input class='jmp-link-at-bottom' style='position:absolute; left:-9999px; top:-1px;' />";

		popupElement.html(linkAtTop + data + linkAtBottom);

		setPopupLayersPosition(popupElement);

        popupElement.css("display","none");
        popupElement.css("visibility","visible");

		if (newElement) {
        	popupElement.fadeIn();
		} else {
			popupElement.show();
		}

        $("#" + idElement + " .jmp-link-at-top, " +
		  "#" + idElement + " .jmp-link-at-bottom").focus(function(){
			$(focusableElement[focusableElement.length-1]).focus();
		});

		var jFocusableElements = $("#" + idElement + " a:visible:not(.jmp-link-at-top, .jmp-link-at-bottom), " +
								   "#" + idElement + " *:input:visible:not(.jmp-link-at-top, .jmp-link-at-bottom)");

		if (jFocusableElements.length == 0) {
			var linkInsidePopup = "<a href='#' class='jmp-link-inside-popup' style='position:absolute; left:-9999px;'>&nbsp;</a>";
			popupElement.find(".jmp-link-at-top").after(linkInsidePopup);
			focusableElement.push($(popupElement).find(".jmp-link-inside-popup")[0]);
		} else {
			jFocusableElements.each(function(){
				if (!$(this).hasClass("jmp-link-at-top") && !$(this).hasClass("jmp-link-at-bottom")) {
					focusableElement.push(this);
					return false;
				}
			});
		}

		$(focusableElement[focusableElement.length-1]).focus();

		popupObject.success();

		if (popupObject.reloadSuccess) {
			popupObject.reloadSuccess();
			popupObject.reloadSuccess = null;
		}
    }

	function loadPopupLayerContent(popupObject, newElement) {
		if (newElement) {
			openedPopups.push(popupObject);
		}

		if (popupObject.target != "") {
            showPopupLayerContent(popupObject, newElement, $("#" + popupObject.target).html());
        } else {
            $.ajax({
                url: popupObject.url,
                data: popupObject.parameters,
				cache: popupObject.cache,
                dataType: "html",
                method: "GET",
                success: function(data) {
                    showPopupLayerContent(popupObject, newElement, data);
                },
				error: popupObject.error
            });
		}
	}

	$(window).resize(function(){
		setScreenLockerSize();
		setPopupLayersPosition();
	});

	$(document).keydown(function(e){
		if (e.keyCode == 27) {
			$.closePopupLayer();
		}
	});

})(jQuery);

    function showLangFields(type1, type2, type3, num_language, languages) {

        for (i=1;i<=languages;i++) {
            jQuery('#'+type1+'_'+ARRAY_LANG[i-1]).addClass('isHidden').removeClass('isVisible');
                        jQuery('#tab_'+type1+'_'+ARRAY_LANG[i-1]).removeClass("tabActived");
            jQuery('#'+type2+'_'+ARRAY_LANG[i-1]).addClass('isHidden').removeClass('isVisible');
                        jQuery('#tab_'+type2+'_'+ARRAY_LANG[i-1]).removeClass("tabActived");
            jQuery('#'+type3+'_'+ARRAY_LANG[i-1]).addClass('isHidden').removeClass('isVisible');
						jQuery('#tab_'+type3+'_'+ARRAY_LANG[i-1]).removeClass("tabActived");
        }
        jQuery('#'+type1+'_'+num_language).removeClass('isHidden').addClass('isVisible');
                jQuery('#tab_'+type1+'_'+num_language).addClass("tabActived");
        jQuery('#'+type2+'_'+num_language).removeClass('isHidden').addClass('isVisible');
                jQuery('#tab_'+type2+'_'+num_language).addClass("tabActived");
        jQuery('#'+type3+'_'+num_language).removeClass('isHidden').addClass('isVisible');
				jQuery('#tab_'+type3+'_'+num_language).addClass("tabActived");

        // SET NAME FIELD VISIBLE
        if(num_language){
            $('.nameNlanguage').hide();
            $('#name_'+num_language).show().focus();
            // REPLACE ALL LABELS WITH CURRENT LANGUAGE
            $('#FM1 li, #FM2 li, #navbar li').each(function() {
				var currentLanguageLabel = $(this).attr('name_'+num_language);
				if (currentLanguageLabel){
					currentLanguageLabel = currentLanguageLabel.replace(/\[COMMA\]/g,",");
					currentLanguageLabel = currentLanguageLabel.replace(/\[PIPE\]/g,"|");
					currentLanguageLabel = currentLanguageLabel.replace(/\[AMP\]/g,"&");
					currentLanguageLabel = currentLanguageLabel.replace(/\&/g,"&amp;");
				} else {
					currentLanguageLabel = "&nbsp;";
				}

               $(this).find('a:first').html(currentLanguageLabel);
            });
        }
    }

$(document).ready(function() {

	function setAutoChange(){

		$('.nameNlanguage').keyup(function(){
			// find current editing language
			var currentEditingLanguage=$('.tabActived').attr('lang_id');
			//find item on navbar
			var itemID=$('#li_id').val();
			//replace on keyup
			$('#'+itemID).find('a:first').html($(this).val().replace(/\&/g,"&amp;"));
			$('#'+itemID).attr('name_'+currentEditingLanguage,$(this).val());
			warnAboutBrokenLayout();

			var num_languages=$('#num_languages').val();
			var prevID = $('#navBarItemForm').find('#li_id').attr('value');
			var currID = itemID;
			var prevItemName = "";
			var RgExItem = new RegExp("^(((\\s)*(&nbsp;)*)|((&nbsp;)*(\\s))|(\\s)*|(&nbsp;)*)*$");

			$('#' + currID).removeClass('activeBlank');
			if (prevID) {
				for (c=1;c<=num_languages;c++){
					prevItemName = $('#name_' + ARRAY_LANG[c-1]).val();
					if (prevItemName == '' || prevItemName.match(RgExItem)) {
						$('#' + prevID).addClass('activeBlank');
						$('#' + prevID + ' a').html('&nbsp;');
						break;
					}
				}
			}

		});

		$('#link').keyup(function(){
			var item=$('#li_id').val();
			$('#'+item).attr('link',$(this).val());
			warnAboutBrokenLayout();
		});
		
		$('#target_self').click(function(){
			var item=$('#li_id').val();
			$('#'+item).attr('link_target', "self");
		});
		
		$('#target_blank').click(function(){
			var item=$('#li_id').val();
			$('#'+item).attr('link_target', "blank");
		});
	}

    function restoreNavBarAction(){
         $('#restoreNavbar').click(function(){

			 if($('#DEMO_LIVE_MODE').val() == 1){
				 msgConfirmbox = $('#LANG_SITEMGR_DEMO_LIVE_MODE').val();
			 } else {
				  msgConfirmbox = $('#LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR').val()+"?";
			 }

            if (confirm(msgConfirmbox)){
                var thisButton=$(this);
                $.ajax({
                   type: "POST",
                   url: DEFAULT_URL+"/includes/code/navbar_ajax.php",
                   cache: false,
                   data: {action:"restoreNavbar",navbarType:$('#navbarType').val(),selected_domain_id:$('#selected_domain_id').val()},
                   beforeSend:function(){
                          thisButton.unbind('click');
                        },
                   success: function(msg){
                        if (msg=='OK')
                            parent.window.location = $('#default_url').val()+"/sitemgr/content/navigation.php";
                        },
                   complete: function (){
                        restoreNavBarAction();
                    }

                 });
             }
        });
    }
    restoreNavBarAction();

	$('#module').click(function(){
        $.openPopupLayer({
            name: "moduleForm",
            width:800,
            url: "navigation_options.php?navbarType="+$('#navbarType').val()+"&option=module",
            afterClose: function() {
                setAutoChange();
            }
        });
	});

	$('#sitecontent').click(function(){
        $.openPopupLayer({
            name: "moduleForm",
            width:800,
            url: "navigation_options.php?navbarType="+$('#navbarType').val()+"&option=sitecontent",
            afterClose: function() {
                setAutoChange();
            }
        });
	});

   function hideAddShowSave(){
       $('#addButton').unbind('click');
       $('#cancelarea').css('display','inline-block');
   }

	function bindbuttons(){
		$('#addButton').unbind('click').click(function(){
			$(this).addClass('saveareaOff');
			$('#updateItemDetail').html($('#LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM').val());
			var language_id=$('#language_id').val();
			var newItemLabel=$('#newitem_'+language_id).val();
			$('#navBarItemForm input').attr('value','');
			$('#tools').show();
			var newItemHTML='<li hovereffect="true"  id="no_id" item="new" li_id="" link="" link_target="self" ';
			var num_languages=$('#num_languages').val();
			for (i=1; i<=num_languages; i++){
				var nameid = ('name_'+ARRAY_LANG[i-1]);
				newItemHTML += " "+nameid+"='"+$('#newitem_'+ARRAY_LANG[i-1]).val()+"' ";
				$('#name_'+ARRAY_LANG[i-1]).attr('value',$('#newitem_'+ARRAY_LANG[i-1]).val());
			}
			newItemHTML+=' ><a href="javascript:void(0)">'+newItemLabel+'</a></li>';

			if ($('#navbarType').val()=='header')
				$('#navbar').prepend(newItemHTML);
			else $('#FM1').prepend(newItemHTML);

			$('#no_id').addClass('activeEdit');
			$('#link').attr('value',$('#default_url_domain').val());
			$('#target_self').attr('checked', true);
			$('#li_id').attr('value','no_id');

			var aditionalEditCode=$('#adicionalEditCode').val().replace('||REMOVE_ID||','no_id');
			$('#no_id').append($('#adicionalEditCode').val()).find('.editItem').remove();
			$('#no_id').find('.delItem').unbind('click').bind('click',function(){
				$('#cancelButton').trigger('click');
			});
			$('#no_id').mouseover(function(){
				$('.aditionalItemOptions').hide();
				$(this).find('.aditionalItemOptions').show();
			}).mouseout(function(){
				$('.aditionalItemOptions').hide();
			});
			hideAddShowSave();
			showLangFields('summary', 'detail', 'keywords', $('#language_id').val(), NUMBER_LANGUAGES);
			warnAboutBrokenLayout();
		});

		$('#saveButton').unbind('click').click(function(){
			var thisButton=$(this);
			var order='order=';
			var names='names=';
			var links='links=';
			var targets='targets=';
			var items='items=';
			var areas='areas=';
			var checkStatus = 'ok';
			var auxName = '';

			if ($('#navbarType').val()=='footer'){

				$('#FM1 li').each(function(k,v){
					if (v.id!=''){
						order+=v.id+'|';
						var num_languages=$('#num_languages').val();
						for (i=1;i<=num_languages;i++){
							auxName = ($(this).attr('name_'+ARRAY_LANG[i-1])).replace(/\,/g,"[COMMA]");
							auxName = auxName.replace(/\|/g,"[PIPE]");
							auxName = auxName.replace(/\&/g,"[AMP]");
							auxName = auxName.replace(/\&amp;/g,"[AMP]");
							names += auxName+",";
							}
						names+="|";
						links+=$(this).attr('link')+"|";
						targets+=$(this).attr('link_target')+"|";
						items+=$(this).attr('item')+"|";
						areas+="1|";
					}
				});

				$('#FM2 li').each(function(k,v){
					if (v.id!=''){
						order+=v.id+'|';
						var num_languages=$('#num_languages').val();
						for (i=1;i<=num_languages;i++){
							auxName = ($(this).attr('name_'+ARRAY_LANG[i-1])).replace(/\,/g,"[COMMA]");
							auxName = auxName.replace(/\|/g,"[PIPE]");
							auxName = auxName.replace(/\&/g,"[AMP]");
							auxName = auxName.replace(/\&amp;/g,"[AMP]");
							names += auxName+",";
						}
						names+="|";
						links+=$(this).attr('link')+"|";
						targets+=$(this).attr('link_target')+"|";
						items+=$(this).attr('item')+"|";
						areas+="2|";
					}
				});

			}else{

				$('#navbar li').each(function(k,v){
					if (v.id!=''){
						order+=v.id+'|';
						var num_languages=$('#num_languages').val();
						for (i=1;i<=num_languages;i++){
							auxName = ($(this).attr('name_'+ARRAY_LANG[i-1])).replace(/\,/g,"[COMMA]");
							auxName = auxName.replace(/\|/g,"[PIPE]");
							auxName = auxName.replace(/\&/g,"[AMP]");
							auxName = auxName.replace(/\&amp;/g,"[AMP]");
							names += auxName+",";
						}
						names+="|";
						links+=$(this).attr('link')+"|";
						targets+=$(this).attr('link_target')+"|";
						items+=$(this).attr('item')+"|";
						areas+=$(this).attr('area')+"|";
					}
				});
			}

		var action=order+"&action=saveOrder&navbarType="+$('#navbarType').val()+"&"+names+"&"+links+"&"+targets+"&"+items+"&"+areas+"&selected_domain_id="+$('#selected_domain_id').val();

		 if($('#DEMO_LIVE_MODE').val() == 1){
			 alert($('#LANG_SITEMGR_DEMO_LIVE_MODE').val());
		 }else{

		$.ajax({
		   type: "POST",
		   url: DEFAULT_URL+"/includes/code/navbar_ajax.php",
		   cache: false,
		   data: action,
		   beforeSend:function(){
				  thisButton.unbind('click');
				},
		   success: function(msg){
					if (msg!='OK'){
						popupMessage(2);
						$('.itemForm').removeAttr('disabled');
						if (msg == 'ERROR: empty'){
							checkStatus = 'error empty';
						} else if (msg == 'ERROR: repeated') {
							checkStatus = 'error repeated';
						}else if (msg == 'ERROR: empty navbar') {
							checkStatus = 'error empty navbar';
						}

					}
				},
		   complete: function (){
				bindbuttons();
				$('#addButton').removeClass('saveareaOff');
				$('#updateItemDetail').html($('#LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE').val());
				$('#cancelarea').hide();
				setEditAndDelOptions();
				if (checkStatus == 'error repeated'){
					popupMessage(4);
				} else if (checkStatus == 'error empty'){
					popupMessage(5);
				} else if (checkStatus == 'error empty navbar'){
					popupMessage(6);
				} else {
					popupMessage(1);
				}


			}

		 });
		}

		});
	}

	bindbuttons();

	$('#cancelButton').click(function(){

		var currentEditingLanguage=$('.tabActived').attr('lang_id');
		//find item on navbar
		var itemID=$('#li_id').val();

		var nameCancel = "";

		nameCancel = ARRAY_CANCEL[currentEditingLanguage];
		if (nameCancel){
			nameCancel = nameCancel.replace(/\&/g,"&amp;");
		}

		$('#navBarItemForm').find('#name_'+ARRAY_LANG[currentEditingLanguage]).attr('value',ARRAY_CANCEL[currentEditingLanguage]);
		$('#navBarItemForm').find('#link').attr('value',ARRAY_CANCEL[0]);
		$('#navBarItemForm').find('#link_target').attr('value',ARRAY_CANCEL[8]);
		$('#'+itemID).find('a:first').html(nameCancel);
		$('#'+itemID).attr('name_'+currentEditingLanguage,ARRAY_CANCEL[currentEditingLanguage]);
		
		if (ARRAY_CANCEL[8] == "self"){
			$('#navBarItemForm').find('#target_self').attr('checked', true);
		} else {
			$('#navBarItemForm').find('#target_blank').attr('checked', true);
		}
		
		warnAboutBrokenLayout();

		$("#no_id").remove();
		$('#navBarItemForm input').attr('value','');
		$('#navBarItemForm').find('#link').attr('value',ARRAY_CANCEL[0]);
        $('#'+itemID).attr('link',ARRAY_CANCEL[0]);
        $('#'+itemID).attr('link_target',ARRAY_CANCEL[8]);
		$('#tools').hide();
		$('#addButton').removeClass('saveareaOff');
		$('#updateItemDetail').html($('#LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE').val());
		$('#cancelarea').hide();
		bindbuttons();
        warnAboutBrokenLayout();
	});

	$('#updateItemDetail').click(function(){
		var postdata=$('#navBarItemForm').serialize();

		if ($('#li_id').val()=='no_id'){
			var isnewid=true;
		}
		if ($('#li_id').val()==''){
			// JUST SAVING
			$('#saveButton').trigger('click');
		} else {
			postdata=postdata+"&action=checkItem&li_id="+$('#li_id').val()+"&navbarType="+$('#navbarType').val()+'&lang_id='+$('.tabActived').attr('lang_id')+"&selected_domain_id="+$('#selected_domain_id').val();

			if($('#DEMO_LIVE_MODE').val() == 1){
				 alert($('#LANG_SITEMGR_DEMO_LIVE_MODE').val());
			 }else{
				$.ajax({
				   type: "POST",
				   url: DEFAULT_URL+"/includes/code/navbar_ajax.php",
				   cache: false,
				   data: postdata,
				   beforeSend:function(){
								$('.itemForm').attr('disabled','disabled');
								$('#warningMsg').hide();
						},
				   success: function(msg){
						   if (msg.substr(0,3)=="OK:"){
								var checked_id=msg.substr(3,msg.length);
								var num_languages=$('#num_languages').val();
								var nameid = "";
								var nameToWrite = "";
								if (isnewid){

									$('#no_id').attr('link',$('#link').val());
									$('#no_id').attr('li_id',checked_id);
									$('#no_id').attr('item',$('#item').val());
									// LANGUAGES
									for (i=1;i<=num_languages;i++){
										nameid=('name_'+ARRAY_LANG[i-1]);
										nameToWrite=$('#'+nameid).val();
										$('#no_id').attr(nameid,nameToWrite);
									}
									$('#no_id a:first').html($('#name_'+$('.tabActived').attr('lang_id')).val().replace(/\&/g,"&amp;"));
									// INJECT OPTIONS
									// remove temporary first
									$('#no_id').find('.aditionalItemOptions:first').remove();
									newcode=$('#adicionalEditCode').val().replace('||REMOVE_ID||',checked_id);

									$('#no_id').append(newcode);
									$('#no_id').removeClass('activeEdit');
									$('#no_id').addClass(checked_id);
									$('#no_id').attr('id',checked_id);

									setHoverEffect();
									setEditAndDelOptions();
								} else {
									// LANGUAGES
									for (i=1;i<=num_languages;i++){
										nameid=('name_'+ARRAY_LANG[i-1]);
										nameToWrite=$('#'+nameid).val();
										$('#'+checked_id).attr(nameid,nameToWrite);
									}

									$('#'+checked_id).attr('link',$('#link').val());
									$('#'+checked_id+' a:first').html($('#name_'+$('.tabActived').attr('lang_id')).val().replace(/\&/g,"&amp;"));
								}

								$('.itemForm').removeAttr('disabled');
								$('#tools').hide();
								$('li[hovereffect=true]').removeClass('activeEdit');
								$('#saveButton').trigger('click');

						   } else {
								   // PROBLEMS SAVING
								   var errorMsg=msg.substr(6,msg.length);
								   $('.itemForm').removeAttr('disabled');
								   $('#warningMsg').show().find('td:first').find('p').html(errorMsg);
								   window.setTimeout("$('#warningMsg').hide('fast');", 5000);
						   }
						}
				 });
			}
		}// just saving
	});

	function setEditAndDelOptions(){
		$('.delItem').click(function(){
			var removeId=$(this).find('a').attr('removeid');

			$("."+removeId).remove();
			$('#tools').hide();
			$('#addarea').show();
			$('#cancelarea').hide();
			warnAboutBrokenLayout();
		});

		$('.editItem').click(function(){
			// KILL ANY INCOMPLETE ITEM
			var createnew = true;
			var auxvarName = '';
			$('#updateItemDetail').html($('#LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM').val());
			if ( $('#no_id').length>0 ){
				if (confirm($('#deleteNewItemQuestion').val())){
					createnew = true;
				} else createnew = false;
			}
			if(createnew){
				$('#no_id').remove();
				bindbuttons();

				$('#cancelarea').css('display','inline-block');
				$('html, body').animate({
					scrollTop: $('#cancelarea').offset().top
				}, 500);

				// RESET LANGUAGE FROM FORM
				showLangFields('summary', 'detail', 'keywords', $('#language_id').val(), NUMBER_LANGUAGES);

				var num_languages=$('#num_languages').val();
				var prevID = $('#navBarItemForm').find('#li_id').attr('value');
				var currID = $(this).parent().parent().attr('li_id');
				var prevItemName = "";
				var RgExItem = new RegExp("^(((\\s)*(&nbsp;)*)|((&nbsp;)*(\\s))|(\\s)*|(&nbsp;)*)*$");

				$('#' + currID).removeClass('activeBlank');
				if (prevID) {
					for (c=1;c<=num_languages;c++){
						prevItemName = $('#name_' + ARRAY_LANG[c-1]).val();
						if (prevItemName == '' || prevItemName.match(RgExItem)) {
							$('#' + prevID).addClass('activeBlank');
							$('#' + prevID + ' a').html('&nbsp;');
							break;
						}
					}
				}

				for (i=1;i<=num_languages;i++){
					auxvarName = $(this).parent().parent().attr('name_'+ARRAY_LANG[i-1]);
					
					auxvarName = auxvarName.replace(/\[COMMA\]/g,",");
					auxvarName = auxvarName.replace(/\[PIPE\]/g,"|");
					auxvarName = auxvarName.replace(/\[AMP\]/g,"&");

					$('#navBarItemForm').find('#name_'+ARRAY_LANG[i-1]).attr('value',auxvarName);
					ARRAY_CANCEL[ARRAY_LANG[i-1]] = $('#name_'+ARRAY_LANG[i-1]).attr('value');
					
				}
				if ($(this).parent().parent().attr('link_target') == "self" || !$(this).parent().parent().attr('link_target')){
					$('#navBarItemForm').find('#target_self').attr('checked', true);
					ARRAY_CANCEL[8] = "self";
				} else {
					$('#navBarItemForm').find('#target_blank').attr('checked', true);
					ARRAY_CANCEL[8] = "blank";
				}

				$('#navBarItemForm').find('#link').attr('value',$(this).parent().parent().attr('link'));
				$('#navBarItemForm').find('#li_id').attr('value',$(this).parent().parent().attr('li_id'));
				$('#navBarItemForm').find('#item').attr('value',$(this).parent().parent().attr('item'));
				ARRAY_CANCEL[0] =  $('#link').attr('value');
				$('#tools').show();
				$('#addButton').removeClass('saveareaOff');
				warnAboutBrokenLayout();
			}
		});
	}

	// HEADER OR FOOTER?
	if ($('#navbarType').val()=='footer'){
		$('#FM1').sortable({
	        opacity: 0.6,
	        cursor: 'move',
	        connectWith:'#FM2',

	        start:function(event,ui){
        		var oldColor=$(ui.item).css('background-color');
                            $(ui.item).attr('oldColor',oldColor);
                            $(ui.item).addClass('activeMove');


  			},
  			stop:function (event,ui){
			$(ui.item).removeClass('activeMove');
			$('.aditionalItemOptions').hide();
			ui.item.css({'top':'0','left':'0'});
  			},
  			receive: function(event, ui) {
  				ui.item.attr('area',1);
				$(ui.item).removeClass('activeEdit');
				warnAboutBrokenLayout();
  			}

	    });
	    $('#FM2').sortable({
	        opacity: 0.6,
	        cursor: 'move',
	        connectWith:'#FM1',
	        start:function(event,ui){
        		var oldColor=$(ui.item).css('background-color');
        		$(ui.item).attr('oldColor',oldColor);
        		$(ui.item).addClass('activeMove');
  			},
  			stop:function (event,ui){
  				$(ui.item).removeClass('activeMove');
  				$('.aditionalItemOptions').hide();
				ui.item.css({'top':'0','left':'0'});
  			},
  			receive: function(event, ui) {
				ui.item.attr('area',2);
				$(ui.item).removeClass('activeEdit');
				warnAboutBrokenLayout();
  			}
	    });
	}

	if ($('#navbarType').val()=='header') {
		$('#navbar').sortable({
	        opacity: 0.6,
	        cursor: 'move',
	        start:function(event,ui){
        		var oldColor=$(ui.item).css('background-color');
        		$(ui.item).attr('oldColor',oldColor);
        		$(ui.item).addClass('activeMove');

  			},
			stop:function (event,ui){
				$(ui.item).removeClass('activeMove');
				$('.aditionalItemOptions').hide();
				ui.item.css({'top':'0','left':'0'});
			}
	    });

	}

	function setHoverEffect(){
		$('li[hovereffect=true]').mouseover(function(){
			$('.aditionalItemOptions').hide();
			$(this).addClass('activeEdit');
			$(this).find('.aditionalItemOptions').show();
		}).mouseout(function(){
			$(this).removeClass('activeEdit');
			$('.aditionalItemOptions').hide();
		});
	}

	setHoverEffect();
	setEditAndDelOptions();
	setAutoChange();

	var ULMaxSize = new Array();

	function warnAboutBrokenLayout(){
		/*
		 * Just for debug
		 */
		var ip = $('#ip').val();
		/*
		 * Used only for validation and calc
		 */
		var navbarType = $('#navbarType').val();
		var elementBaseID = new Array();
		var auxStyle = '';
		var withoutBroken = false;
		// Used to calculate the element size
		var extraSize1 = '';
		var extraSize2 = '';
		var extraSizeUL1 = '';
		var extraSizeUL2 = '';
		var baseSize = '';
		// Sum of element size
		var totalsizeOfLis = 0;
		// Max element size
		var sizeOfBk = 0;
		// Used only in "for" command
		var i = 0;

		if (navbarType == 'header') {
			elementBaseID[0] = '#navbar';
		} else {
			elementBaseID[0] = '#FM1';
			elementBaseID[1] = '#FM2';
			/*
			 * The Default theme do not need to be validated because the Footer never
			 * broken in fron of this theme
			 */
			withoutBroken = true;
		}

		if (withoutBroken == false) {

			extraSize1 = 'right';
			extraSize2 = 'left';
			extraSizeUL1 = 'right';
			extraSizeUL2 = 'left';
			baseSize = 'width';

			for (i = 0; i < elementBaseID.length; i++) {
				totalsizeOfLis = 0;
				sizeOfBk = (parseInt($(elementBaseID[i]).css(baseSize)).toString()	== 'NaN'?	0:	parseInt($(elementBaseID[i]).css(baseSize)));

				if (ULMaxSize[i] == 0) ULMaxSize[i] = sizeOfBk;
				if (ULMaxSize[i] > sizeOfBk) {
					sizeOfBk += (parseInt($(elementBaseID[i]).css('border-' + extraSizeUL1 + '-width')).toString()	== 'NaN'?	0:	parseInt($(elementBaseID[i]).css('border-' + extraSizeUL1 + '-width')));
					sizeOfBk += (parseInt($(elementBaseID[i]).css('border-' + extraSizeUL2 + '-width')).toString()	== 'NaN'?	0:	parseInt($(elementBaseID[i]).css('border-' + extraSizeUL2 + '-width')));
				} else {
					ULMaxSize[i] = sizeOfBk;
				}

				$(elementBaseID[i] + ' li').each(function() {
					if(!$(this).hasClass('editItem') && !$(this).hasClass('delItem')) {
						if ($.browser.msie && $.browser.version < 9) {
							$(this).css('white-space', 'nowrap');
						}

						auxStyle = $(this).find('ul').css('display');
						$(this).find('ul').hide();
						totalsizeOfLis += (parseInt($(this).css(baseSize)).toString()					== 'NaN'?	0:	parseInt($(this).css(baseSize)));
						totalsizeOfLis += (parseInt($(this).css('margin-' + extraSize1)).toString()		== 'NaN'?	0:	parseInt($(this).css('margin-' + extraSize1)));
						totalsizeOfLis += (parseInt($(this).css('margin-' + extraSize2)).toString()		== 'NaN'?	0:	parseInt($(this).css('margin-' + extraSize2)));
						totalsizeOfLis += (parseInt($(this).css('padding-' + extraSize1)).toString()	== 'NaN'?	0:	parseInt($(this).css('padding-' + extraSize1)));
						totalsizeOfLis += (parseInt($(this).css('padding-' + extraSize2)).toString()	== 'NaN'?	0:	parseInt($(this).css('padding-' + extraSize2)));
						if (auxStyle != 'none') $(this).find('ul').show();
					}
				});

				if (totalsizeOfLis > sizeOfBk) {
					$(elementBaseID[i]).addClass('broken');
				} else {
					$(elementBaseID[i]).removeClass('broken');
				}
			}
		}
	}

	function popupMessage(number){
		if (number==1)
			classe = "successMessage";
		if (number==2 || number==4 || number==5 || number==6)
			classe = "errorMessage";
		$('#messageAfterAction').removeClass("successMessage");
		$('#messageAfterAction').html( $('#NAVBAR_SAVED_MESSAGE'+number).val() ).addClass(classe).show('fast');
		window.setTimeout("$('#messageAfterAction').hide('fast');", 5000);
	}

	warnAboutBrokenLayout();
});