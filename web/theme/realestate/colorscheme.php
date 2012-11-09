<!--Marker--><?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2011 Arca Solutions, Inc. All Rights Reserved.           #
	#                                                                    #
	# This file may not be redistributed in whole or part.               #
	# eDirectory is licensed on a per-domain basis.                      #
	#                                                                    #
	# ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
	#                                                                    #
	# http://www.edirectory.com | http://www.edirectory.com/license.html #
	######################################################################
	\*==================================================================*/

	# ----------------------------------------------------------------------------------------------------
	# * FILE: /theme/realestate/colorscheme.php
	# ----------------------------------------------------------------------------------------------------

	header("Content-type: text/css");
	
?><!--Marker-->
/**
* eDirectory - Color Scheme
*
* @package			design
* @filesource		colorscheme.php
* @author			Arca Solutions
* @copyright		Copyright (c) 2011, Arca Solutions Inc.
* @version			eDirectory 9.1
* @since			October, 1, 2011
*			
*/

/* STRUCTURE

/**
* Global Classes
*/
	
/** Global classes > No Link */
.no-link
{ border-color:#<?=SCHEME_COLORTITLEBORDER?> !important; }

/**
* Global Definitions
*/
a:link,
a:visited,
a:active
{ color:#<?=SCHEME_COLORLINK?>; }

.list li a:link, .list li a:visited, .list li a:active { color:#<?=SCHEME_COLORLINK?>; font-size:11px; }
	
a img, .no-image
{ border-color:#<?=SCHEME_COLORTITLEBORDER?>; }

	a:hover img, .no-image:hover
	{ border-color:#<?=SCHEME_COLORLINK?> !important; }
    
/**
* Typography
*/
*
{ font-family:<?=SCHEME_FONTOPTION?>; }

h1, h2, h3, h4, h5
{ color:#<?=SCHEME_COLORTITLE?> !important; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

.detail h2, .level-detail .sidebar h2
{ color:#<?=SCHEME_COLORTITLE?> !important; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/*Marker Spa Exception3*/

.sidebar h2 
{ color:#<?=SCHEME_COLORTEXT?> !important;}

/*Marker Spa Exception3*/

/** Typography > Paragraph */
p, 
.label-field-account, 
.browse-category li span,
.standardForm td.TimageFile,
.standardForm td.TaddImagetxt,
.standardForm th.wrapcaption
{ color:#<?=SCHEME_COLORTEXT?>; }

/*Marker Spa Exception*/

/** Typography > H2 */
h2 .view-more:link,
h2 .view-more:visited,
h2 .view-more:active
{ color:#<?=SCHEME_COLORLINK?>; }

/*Marker Spa Exception*/

/*Marker Spa Exception4*/

#slider h2,
#slider h2 a:link,
#slider h2 a:visited,
#slider h2 a:active
{ color:#<?=SCHEME_COLORTITLE?>; }

/*Marker Spa Exception4*/
	
/**************************************************************************************************\
* Forms > Contact form
* 
* Form style for contact informations
*/

.contact-form
{ background:#<?=SCHEME_COLORSLIDER?>; border-top-color:#<?=SCHEME_COLORTITLEBORDER?>; }

	.contact-form h2
	{ border-bottom:none; }

/** Contact form > form > form tags */
.contact-form .form div label
{ color:#<?=SCHEME_COLORTEXT?>; }

/**
* Body
*/
/*Marker Background*/

body { background-color:#<?=SCHEME_COLORBACKGROUND?>; }

/*Marker Background*/

body { background-image: url(<?=SCHEME_BACKGROUNDIMAGE?>); }

body { background-repeat: <?=SCHEME_REPEATOPTION?>; }

body { background-position: <?=SCHEME_ALIGNOPTION?> top; }

/**************************************************************************************************\
* User Navbar
* 
* User navbar located at the top, fixed.
*/

/*Marker UserNavbar*/

#user-navbar { background:#<?=SCHEME_COLORUSERNAVBAR?>; box-shadow:-1px 0 1px #000; border-bottom:none; border-top:none; }

/*Marker UserNavbar*/

/*Marker UserNavbarBackground*/

.user-options li
{ background:none; }

/*Marker UserNavbarBackground*/

.user-options li
{ color:#<?=SCHEME_COLORUSERNAVBARTEXT?>; }

	#user-navbar a:link,
	#user-navbar a:visited,
	#user-navbar a:active
	{ color:#<?=SCHEME_COLORUSERNAVBARLINK?>; }
	
/*Marker UserNavbarBackground*/

.language
{ background-image:none; }

/*Marker UserNavbarBackground*/

/**************************************************************************************************\
* Header
* 
* Header contents, search, advanced search, banner and other elements.
*/
/*Marker Navbar*/

#header-wrapper, #header { background:none; border-bottom:none;}

/*Marker Navbar*/

/*Marker Navbar2*/
	
/** Header > Navbar */
#navbar-wrapper, #navbar { background:#<?=SCHEME_COLORNAVBAR?>; }

/*Marker Navbar2*/

	#navbar li a:link,
	#navbar li a:visited,
	#navbar li a:active
	{ color:#<?=SCHEME_COLORNAVBARLINK?>; }
			
		#navbar li a:hover,
		#navbar .menuActived a:link,
		#navbar .menuActived a:visited,
		#navbar .menuActived a:active
		{ color:#<?=SCHEME_COLORNAVBARLINKACTIVE?>; }

/**************************************************************************************************\
* Button
* 
* Button properties
*/

#search input
{ border-color:#<?=SCHEME_COLORSLIDER?>; color:#888; }

#search input:focus
{ border-color:#<?=SCHEME_COLORLINK?>; }

/*Marker HappyTimes Exception*/

.standardButton button, .content-faq .search button, .treeView .tableCategoriesBUTTONS button,
button.input-button-form, .input-button-form button, .modal-content button
{ background: #<?=SCHEME_COLORTITLE?> !important; }

/*Marker HappyTimes Exception*/

#search button:focus, #search button:hover, p.standardButton button:focus, 
p.standardButton button:hover, .input-button-form button:focus, .input-button-form button:hover,
input.input-button-form:hover, button.input-button-form:hover, .addImageForm:hover,
.content-faq .search button:focus, .content-faq .search button:hover,
table.standard-table td.treeView table.tableCategoriesADDED button:hover, .modal-content button:hover,
.treeView .tableCategoriesBUTTONS button:hover
{ color:#<?=SCHEME_COLORLINK?>; }

/**************************************************************************************************\
* Advanced Search
* 
* Advanced Search properties
*/
#advanced-search
{ background:url(images/structure/bg-black-opacity-70.png) repeat; }

	#advanced-search,
	#advanced-search h4,
	#advanced-search p,
	#advanced-search label,
	#advanced-search div
	{ color:#<?=SCHEME_COLORMAINCONTENT?> !important; }
	

/**************************************************************************************************\
* Content Structure
* 
* Content structure elements
*/
/*Marker ContentBackground*/

.content-wrapper { background:#<?=SCHEME_COLORCONTENTBACKGROUND?>; }

/*Marker ContentBackground*/

.content-main
{ background:#<?=SCHEME_COLORMAINCONTENT?>; }

.content-main
{ border-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/**************************************************************************************************\
* Featured Items
* 
* Featured items style, structure and differences
*/

.featured-event .featured-item .date
{ background:#<?=SCHEME_COLORSLIDER?>; }

	.featured-event .featured-item .date .calendar
	{ background:#<?=SCHEME_COLORTITLEBORDER?>; }
	
	.featured-event .featured-item .date .calendar .month
	{ background:#<?=SCHEME_COLORLINK?>; }
	
	.featured-event .featured-item .date .calendar .day
	{ color:#<?=SCHEME_COLORTEXT?>; }

.featured-item
{ border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?> !important;}
		
/**************************************************************************************************\
* Content Miscelaneous
* 
* Misc items with special style on the content
*/		

/* Content misc > share box */

.share-box
{ background:#<?=SCHEME_COLORSLIDER?>; }

.share-box ul li.close a:link,
.share-box ul li.close a:visited,
.share-box ul li.close a:active
{ color:#<?=SCHEME_COLORLINK?>; }

/* Content misc > Buttons */

.button
{ background:#<?=SCHEME_COLORSLIDER?>; }

/*Marker Buttons*/

/* Content misc > Buttons > Button profile */
.button-profile h2
{ border-color:#000; }

	.button-profile h2 a:link,
	.button-profile h2 a:visited,
	.button-profile h2 a:active
	{ background-color:#<?=SCHEME_COLORLINK?>; background-image:none; border-color:#<?=SCHEME_COLORMAINCONTENT?>; }
	
		.button-profile h2 a:hover
		{ background:#<?=SCHEME_COLORTITLE?>; }
		
/* Content misc > Buttons > Button contact */
.button-contact h2
{ border-color:#000; }

	.button-contact h2 a:link,
	.button-contact h2 a:visited,
	.button-contact h2 a:active
	{ background-color:#<?=SCHEME_COLORTITLE?>; background-image:none; border-color:#<?=SCHEME_COLORMAINCONTENT?>; }
	
		.button-contact h2 a:hover
		{ background:#<?=SCHEME_COLORLINK?>; }
		
/*Marker Buttons*/

/** Content Misc > Default List */		
.list li span
{ color:inherit; }
		
/* Content misc > Browse by category */
.browse-category li span,
.browse-category li ul li span
{ color:#<?=SCHEME_COLORTEXT?>; }

.browse-category li ul li a:link,
.browse-category li ul li a:visited,
.browse-category li ul li a:active
{ color:#<?=SCHEME_COLORLINK?>; }

/* Content misc > Category List */
.list-category li a:link,
.list-category li a:visited,
.list-category li a:active
{ color:#<?=SCHEME_COLORLINK?>; }

/* Content misc > Pagination */

.pagination
{ background:#<?=SCHEME_COLORSLIDER?>; border-top-color:#<?=SCHEME_COLORTITLEBORDER?>; }

	.pagination li
	{ color:inherit; }

/* Content misc > Filter */
.filter
{ color:inherit; }

/**************************************************************************************************\
* Footer
* 
* Footer content, classes, styles.
*/

/*Marker Footer*/

#footer-wrapper { background:#<?=SCHEME_COLORFOOTER?>; }

/*Marker Footer*/

	#footer-wrapper p, #footer-wrapper li, #footer-wrapper h3, #footer-wrapper h5 { color:#<?=SCHEME_COLORFOOTERTEXT?> !important; }

/*Marker FooterImage*/	
	
	#footer-wrapper h3 { background:none; border-bottom:1px solid #<?=SCHEME_COLORFOOTERTEXT?>; }
	
/*Marker FooterImage*/
	
	#footer-wrapper a:link,	#footer-wrapper a:visited, #footer-wrapper a:active	{ color:#<?=SCHEME_COLORFOOTERLINK?> !important; }
	
/**************************************************************************************************\
* Advertisement
* 
* Advertisement classes for banners on Header, Content and Sidebar.
*/
	
/** Advertisement > Header */
#header .advertisement .info
{ background:url(images/structure/bg-black-opacity-70.png) repeat; }

	#header .advertisement .info *
	{ color:#<?=SCHEME_COLORMAINCONTENT?> !important; }
	
/** Advertisement > Sponsored */
.sponsored:hover
{ border-color:#<?=SCHEME_COLORLINK?>; }

	.sponsored .url
	{ color:#000; }
		
/**************************************************************************************************\
* Slider
* 
* Slider style ( check the structure on the .css file in the scripts folder )
*/

#slider .right
{ background:#<?=SCHEME_COLORSLIDER?>; }

	#slider .right h2
	{ border:none; }
	

/**************************************************************************************************\
* Sidebar Differences
* 
* Differences for the items with special style on the sidebar
*/
.sidebar h2
{ border-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/**************************************************************************************************\
* Accordion
* 
* Accordion style for the Triggers, links and Titles
*/

#accordion li h3,
#accordion li.active h3
{ background-color:#<?=SCHEME_COLORSLIDER?>; border-top-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/*Marker Spa Exception2*/

	#accordion li h3 a:link,
	#accordion li h3 a:visited,
	#accordion li h3 a:active
	{ color:#<?=SCHEME_COLORTITLE?>; }
	
/*Marker Spa Exception2*/
	
/**************************************************************************************************\
* Calendar
* 
* Calendar style
*/
.table-calendar
{ background:#<?=SCHEME_COLORSLIDER?>; }

	.table-calendar .calendar-header 
	{ background:#<?=SCHEME_COLORSLIDER?> url(images/structure/bg-black-opacity-15.png) repeat; border-bottom:none; }
	
/** FRONT **/
	
/**************************************************************************************************\
* Special Deal
* 
* Special Deal items style and structure
*/

.special-deal .right
{ background:#<?=SCHEME_COLORSLIDER?>; }

.special-deal h2
{ border-bottom:none; }

.special-deal .info
{ background:none; display:block; float:none; padding:0 0 5px 0; }

/** RESULTS **/

/**************************************************************************************************\
* Summary
* 
* Summary items style, structure and differences
*/	

/*Marker ContentBackground2*/

.summary { background-color:#<?=SCHEME_COLORCONTENTBACKGROUND?>; }

/*Marker ContentBackground2*/

.summary { border-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/** Summary > share */

.summary .share
{ background:#<?=SCHEME_COLORSLIDER?>; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/** Summary > items > title */		
.summary .title h3 a.map-link:link,
.summary .title h3 a.map-link:visited,
.summary .title h3 a.map-link:active
{ color:#<?=SCHEME_COLORLINK?>; }

/** Summary > items > info */	
.summary .info address
{ color:#<?=SCHEME_COLORTEXT?>; }

/** Summary > items > deal */		

.summary .deal h4
{ background:#<?=SCHEME_COLORSLIDER?>; }

	.summary .deal h4 a:link,
	.summary .deal h4 a:visited,
	.summary .deal h4 a:active
	{ color:#<?=SCHEME_COLORLINK?>; }

/**************************************************************************************************\
* Summary Backlink
* 
* Summary item special style for Backlink
*/

.summary-backlink
{ border-color:#<?=SCHEME_COLORTITLE?>; }

	.summary-backlink .share
	{ background:#<?=SCHEME_COLORTITLE?>; border-bottom-color:#<?=SCHEME_COLORTITLE?>; border-top-color:#<?=SCHEME_COLORLINK?>; }

/** DETAIL **/

/** Detail > Share Bar */

.share
{ background:#<?=SCHEME_COLORSLIDER?>; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; border-top-color:#<?=SCHEME_COLORTITLEBORDER?>;  }

/** Detail > Items > Info */
.detail address
{ color:#<?=SCHEME_COLORTEXT?>; }

/** Detail > Info **/

.detail .deal .info
{ background:#<?=SCHEME_COLORSLIDER?>; }

/** Detail > Info > Counter **/

.detail .deal .counter
{ background:#<?=SCHEME_COLORSLIDER?> url(images/structure/bg-black-opacity-15.png) repeat; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }
		
	.detail .deal .counter .countdown_section span
	{ color:#<?=SCHEME_COLORTEXT?>; }
	
	.detail .deal .counter .countdown_section strong
	{ color:#<?=SCHEME_COLORTEXT?>; }

/** DETAIL > DETAIL DEAL DIFFERENCES > IMAGE **/

.detail .deal .image .no-link
{ border-color:#<?=SCHEME_COLORSLIDER?> !important; }

/**************************************************************************************************\
* Sidebar
* 
* Sidebar structure and elements
*/

/** Featured Listing **/

.sidebar .featured-listing .featured-item address
{ clear:both; color:#<?=SCHEME_COLORTEXT?>; }
	
/** BLOG **/	

.summary { color:#<?=SCHEME_COLORTEXT?>; }

.summary .actions
{ background:#<?=SCHEME_COLORSLIDER?>; border-bottom-color:#<?=SCHEME_COLORLINK?>; color:#<?=SCHEME_COLORTEXT?>; }

/** ADVERTISE **/

/*Marker Tabs Advertise*/

/* Tab navigation */

.tabs li
{ background:#<?=SCHEME_COLORTITLEBORDER?>; border-top-color:#<?=SCHEME_COLORSLIDER?>; }

	.tabs li a:link, .tabs li a:visited, .tabs li a:active
	{ color:#<?=SCHEME_COLORLINK?>; }

.tabs li.active
{ background:#<?=SCHEME_COLORTITLE?>; border-top-color:#<?=SCHEME_COLORLINK?>; }

	.tabs li.active a:link, .tabs li.active a:visited, .tabs li.active a:active
	{ color:#<?=SCHEME_COLORMAINCONTENT?>; }
	
/*Marker Tabs Advertise*/

/** Level > misc */
.level .price
{ color:#<?=SCHEME_COLORTITLE?>; }

/** Members **/

.standard-tabletitle
{ color:#<?=SCHEME_COLORTITLE?> !important; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

.memberMenu ul li a, .memberMenu ul li a:visited
{ color:#<?=SCHEME_COLORTITLE?> !important; }

div.formFieldsLogin
{ background:#<?=SCHEME_COLORSLIDER?> !important; }

.content-faq .search input
{ border-color:#<?=SCHEME_COLORSLIDER?> !important; }

.content-faq .search input:focus
{ border-color:#<?=SCHEME_COLORLINK?> !important;}

.general-item a.sublink-front-navbar, 
.general-item a.sublink-front-navbar:visited,
.general-item a.sublink-front-navbar:active
{ color:#<?=SCHEME_COLORLINK?> !important; }

.tabs li.tabActived a, .tabs li.tabActived a:visited
{ color:#<?=SCHEME_COLORTITLE?> !important; }

table.levelTable th.levelTitle, table.levelTable td.levelTopdetail
{ border-color:#000; }

table.levelTable th.levelTitle, table.standard-tableTOPBLUE th
{ background:#000; }

table.levelTable td.levelTopdetail, table.levelTopdetail th
{ background:#<?=SCHEME_COLORTITLEBORDER?> url(images/structure/bg-black-opacity-70.png) repeat 0 0;}

/** Profile **/

/*Marker Tabs Profile*/

.profile-tabs li
{ background:#<?=SCHEME_COLORTITLEBORDER?>; border-top-color:#<?=SCHEME_COLORSLIDER?>; }

	.profile-tabs li a:link, .profile-tabs li a:visited, .profile-tabs li a:active
	{ color:#<?=SCHEME_COLORLINK?>; }

.profile-tabs li.active
{ background:#<?=SCHEME_COLORTITLE?>; border-top-color:#<?=SCHEME_COLORLINK?>; }

	.profile-tabs li.active a:link, .profile-tabs li.active a:visited, .profile-tabs li.active a:active
	{ color:#<?=SCHEME_COLORMAINCONTENT?>; }
	
/*Marker Tabs Profile*/

.standardSubTitle
{ color:#<?=SCHEME_COLORTITLE?> !important; border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/** Members Sitemap **/
.sitemapList li.standardSubTitle 
{ border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?>; }

.sitemapList li.standardSubTitle a, .sitemapList li.standardSubTitle a:visited, .sitemapList li.standardSubTitle a:active
{ color:#<?=SCHEME_COLORLINK?>; }

/** Member Menu **/
.memberMenu h2
{ border-color:#<?=SCHEME_COLORTITLEBORDER?>; }

/*Marker Deal Tags*/
.deal-tag
{ background-image:url(<?=SCHEME_DEAL-TAG?>) !important; }

.featured-deal .featured-item-special .deal-tag
{ background-image:url(<?=SCHEME_DEAL-TAG?>) !important; }

.special-deal .left .deal-tag
{ background-image:url(<?=SCHEME_DEAL-TAG-SPECIAL?>) !important; }

.detail .deal .deal-tag
{ background-image:url(<?=SCHEME_DEAL-TAG-DETAIL?>) !important; }

.deal-discount
{ background:url(<?=SCHEME_DEAL-TAG-SUB?>) !important; }

/*Marker Deal Tags*/

/*Marker ImageActive*/

#navbar .menuActived
{ background-image:url(<?=SCHEME_ACTIVE_IMAGE?>) !important; }

/*Marker ImageActive*/

/*Marker Exception eDirectoryClassic and Compact*/
			
    #navbar li a:hover
    { color:#<?=SCHEME_COLORNAVBARLINK?>; text-decoration:underline; }
	
/*Marker Exception eDirectoryClassic and Compact*/

.featured-event .featured-item .date, .loginOptions, table.standard-table th, table.standard-table td,
	div.formFieldsLogin label, div.formFieldsLogin span.automaticLogin, .summary
	{ color:#<?=SCHEME_COLORTEXT?>; }
	
/*Marker TB Exception*/	
	
#TB_window, .modal-content
	{ color:#<?=SCHEME_COLORBACKGROUND?>; } 
	
/*Marker TB Exception*/

/*Marker BuyersGuideException*/

.content-top h2, .contact-form h2, .standard-tabletitle, .content-custom h1, 
	.content-custom h2, .content-custom h3, .content-custom h4, .content-custom h5, 
	.content-custom h6, .package h2, .popupWrapper h2
	{ color:#<?=SCHEME_COLORTITLEBORDER?> !important; }
	
	.pagination
	{ border-top-color:#<?=SCHEME_COLORTITLEBORDER?> !important; }

	.pagination-bottom
	{ border-bottom-color:#<?=SCHEME_COLORTITLEBORDER?> !important; }
		
	.pagination li, .table-calendar .calendar-weekday, .table-calendar .today, .table-calendar .selected, 
	.detail strong, .content-custom, .filter label, .memberMenu ul li a, .memberMenu ul li a:visited,
	.list li span 
	{ color:#<?=SCHEME_COLORTEXT?>; }

	ul.basePrintNavbar li a, ul.basePrintNavbar li a:visited
	{ color:#<?=SCHEME_COLORLINK?>; }

	.level-detail .sidebar h2
	{ color:#<?=SCHEME_COLORTITLE?>; }

/*Marker BuyersGuideException*/

/*Marker EnvironmentException*/

.list li span, .filter label, .pagination li, .content-custom
	{ color:#<?=SCHEME_COLORTEXT?> !important; }
	
	.slideshow .control
	{ background:#<?=SCHEME_COLORTITLEBORDER?> !important; }

	#checkUsername .UsernameNotRegistered, ul.basePrintNavbar li a, ul.basePrintNavbar li a:visited
	{ color:#<?=SCHEME_COLORLINK?>; }

	.faqAnswers .standardSubTitle
	{ color:#<?=SCHEME_COLORTITLE?>; }

/*Marker EnvironmentException*/

.button-call a, .button-call a:visited, .button-send a, .button-send a:visited
	{ background-color:transparent; }
    
.categoryTreeview .categorySuccessMessage, .categoryTreeview .categoryErrorMessage,
.treeView .categoryAdd, .treeView .categoryAdd:visited
{ background:#<?=SCHEME_COLORCONTENTBACKGROUND?> !important; }