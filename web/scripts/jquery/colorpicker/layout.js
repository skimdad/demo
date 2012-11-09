(function($){
	var initLayout = function() {
		var hash = window.location.hash.replace('#', '');
		var currentTab = $('ul.navigationTabs a')
							.bind('click', showTab)
							.filter('a[rel=' + hash + ']');
		if (currentTab.size() == 0) {
			currentTab = $('ul.navigationTabs a:first');
		}
		showTab.apply(currentTab.get(0));

		$('#colorSelectorBackground').ColorPicker({
			color: '#'+$('#colorBackground').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorBackground div').css('backgroundColor', '#' + hex);
				$('#colorBackground').attr('value', hex);
			}
		});
		
		$('#colorSelectorContentBackground').ColorPicker({
			color: '#'+$('#colorContentBackground').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorContentBackground div').css('backgroundColor', '#' + hex);
				$('#colorContentBackground').attr('value', hex);
			}
		});
		
		$('#colorSelectorMainContent').ColorPicker({
			color: '#'+$('#colorMainContent').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorMainContent div').css('backgroundColor', '#' + hex);
				$('#colorMainContent').attr('value', hex);
			}
		});
		
		$('#colorSelectorSlider').ColorPicker({
			color: '#'+$('#colorSlider').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorSlider div').css('backgroundColor', '#' + hex);
				$('#colorSlider').attr('value', hex);
			}
		});
		
		$('#colorSelectorTitle').ColorPicker({
			color: '#'+$('#colorTitle').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorTitle div').css('backgroundColor', '#' + hex);
				$('#colorTitle').attr('value', hex);
			}
		});
		
		$('#colorSelectorTitleBorder').ColorPicker({
			color: '#'+$('#colorTitleBorder').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorTitleBorder div').css('backgroundColor', '#' + hex);
				$('#colorTitleBorder').attr('value', hex);
			}
		});
		
		$('#colorSelectorText').ColorPicker({
			color: '#'+$('#colorText').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorText div').css('backgroundColor', '#' + hex);
				$('#colorText').attr('value', hex);
			}
		});
		
		$('#colorSelectorLink').ColorPicker({
			color: '#'+$('#colorLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorLink div').css('backgroundColor', '#' + hex);
				$('#colorLink').attr('value', hex);
			}
		});
		
		$('#colorSelectorUserNavbar').ColorPicker({
			color: '#'+$('#colorUserNavbar').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorUserNavbar div').css('backgroundColor', '#' + hex);
				$('#colorUserNavbar').attr('value', hex);
			}
		});
		
		$('#colorSelectorUserNavbarText').ColorPicker({
			color: '#'+$('#colorUserNavbarText').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorUserNavbarText div').css('backgroundColor', '#' + hex);
				$('#colorUserNavbarText').attr('value', hex);
			}
		});
		
		$('#colorSelectorUserNavbarLink').ColorPicker({
			color: '#'+$('#colorUserNavbarLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorUserNavbarLink div').css('backgroundColor', '#' + hex);
				$('#colorUserNavbarLink').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbar').ColorPicker({
			color: '#'+$('#colorNavbar').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbar div').css('backgroundColor', '#' + hex);
				$('#colorNavbar').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbarLink').ColorPicker({
			color: '#'+$('#colorNavbarLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbarLink div').css('backgroundColor', '#' + hex);
				$('#colorNavbarLink').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbarLinkActive').ColorPicker({
			color: '#'+$('#colorNavbarLinkActive').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbarLinkActive div').css('backgroundColor', '#' + hex);
				$('#colorNavbarLinkActive').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooter').ColorPicker({
			color: '#'+$('#colorFooter').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooter div').css('backgroundColor', '#' + hex);
				$('#colorFooter').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooterText').ColorPicker({
			color: '#'+$('#colorFooterText').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooterText div').css('backgroundColor', '#' + hex);
				$('#colorFooterText').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooterLink').ColorPicker({
			color: '#'+$('#colorFooterLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooterLink div').css('backgroundColor', '#' + hex);
				$('#colorFooterLink').attr('value', hex);
			}
		});

	};
	
	var showTab = function(e) {
		var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
		$(this)
			.addClass('active')
			.blur();
		$('div.tab')
			.hide()
				.eq(tabIndex)
				.show();
	};
	
	EYE.register(initLayout, 'init');
})(jQuery)