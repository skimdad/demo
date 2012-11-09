<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /lang/en_us.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CLOCK TYPE
	# options: 24 or 12
	# ----------------------------------------------------------------------------------------------------
	define("CLOCK_TYPE", 12);

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "january,february,march,april,may,june,july,august,september,october,november,december");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "sunday,monday,tuesday,wednesday,thursday,friday,saturday");
	//year
	define("LANG_YEAR", "year");
	//years
	define("LANG_YEAR_PLURAL", "years");
	//month
	define("LANG_MONTH", "month");
	//months
	define("LANG_MONTH_PLURAL", "months");
	//day
	define("LANG_DAY", "day");
	//days
	define("LANG_DAY_PLURAL", "days");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "y");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "d");
	//Hour
	define("LANG_LABEL_HOUR", "Hour");
	//Minute
	define("LANG_LABEL_MINUTE", "Minute");
	// DATE FORMAT - SET JUST ONE FORMAT
	// Y - numeric representation of a year with 4 digits (xxxx)
	// m - numeric representation of a month with 2 digits (01 - 12)
	// d - numeric representation of a day of the month with 2 digits (01 - 31)
	define("DEFAULT_DATE_FORMAT", "m/d/Y");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "mile");
	//mile
	define("ZIPCODE_UNIT_LABEL", "mile");
	//miles
	define("ZIPCODE_UNIT_LABEL_PLURAL", "miles");
	//zipcode
	define("ZIPCODE_LABEL", "zipcode");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "F dS, Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Do you have a question about Video Snippet Code? Click here.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "characters");
	//by
	define("LANG_BY", "by");
	//in
	define("LANG_IN", "in");
	//Read More
	define("LANG_READMORE", "Read More");
	//More
	define("LANG_MORE", "more");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Browse by Category");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Browse by Location");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Browse ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Browse Events
	define("LANG_BROWSEEVENTS", "Browse ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Browse ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Browse ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Browse ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Browse Posts");
	//show
	define("LANG_SHOW", "show");
	//hide
	define("LANG_HIDE", "hide");
	//Bill to
	define("LANG_BILLTO", "Bill to");
	//Payable to
	define("LANG_PAYABLETO", "Payable to");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Issuing Date");
	//Expire Date
	define("LANG_EXPIREDATE", "Expire Date");
	//Questions
	define("LANG_QUESTIONS", "Questions");
	//Please call
	define("LANG_PLEASECALL", "Please call");
	//Invoice Info
	define("LANG_INVOICEINFO", "Invoice Info");
	//Payment Date
	define("LANG_PAYMENTDATE", "Payment Date");
	//None
	define("LANG_NONE", "None");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Custom Invoice");
	//Locations
	define("LANG_LOCATIONS", "Locations");
	//Close
	define("LANG_CLOSE", "Close");
	//Close this window
	define("LANG_CLOSEWINDOW", "Close this window");
	//from
	define("LANG_FROM", "from");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Transaction Info");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "In manual transactions, subtotal and tax are not calculated.");
	//creditcard
	define("LANG_CREDITCARD", "creditcard");
	//Join Now!
	define("LANG_JOIN_NOW", "Join Now!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Create Your Profile");
	//More Information
	define("LANG_MOREINFO", "More Information");
	//and
	define("LANG_AND", "and");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Auto Parts");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Tires");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Engine Repair");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categories and sub-categories");
	//per
	define("LANG_PER", "per");
	//each
	define("LANG_EACH", "each");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "impressions block");
	//Add
	define("LANG_ADD", "Add");
	//Manage
	define("LANG_MANAGE", "Manage");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "impressions to my paid credit of");
	//Section
	define("LANG_SECTION", "Section");
	//General Pages
	define("LANG_GENERALPAGES", "General Pages");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Open in a new window");
	//No
	define("LANG_NO", "No");
	//Yes
	define("LANG_YES", "Yes");
	//Dear
	define("LANG_DEAR", "Dear");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Street Address, P.O. box");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartment, suite, unit, building, floor, etc.");
	//or
	define("LANG_OR", "or");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Sun 8:00 am - 6:00 pm");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Mon 8:00 am - 9:00 pm");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Tue 8:00 am - 9:00 pm");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Extra fields");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Amenities");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Sign me in automatically");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Check / Uncheck All");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Billing Information");
	//Default
	define("LANG_BUSINESS", "Default");
	//on Listing
	define("LANG_ON_LISTING", "on ".string_ucwords(LISTING_FEATURE_NAME));
	//on Event
	define("LANG_ON_EVENT", "on ".string_ucwords(EVENT_FEATURE_NAME));
	//on Banner
	define("LANG_ON_BANNER", "on ".string_ucwords(BANNER_FEATURE_NAME));
	//on Classified
	define("LANG_ON_CLASSIFIED", "on ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//on Article
	define("LANG_ON_ARTICLE", "on ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Listing Name
	define("LANG_LISTING_NAME", string_ucwords(LISTING_FEATURE_NAME)." Name");
	//Event Name
	define("LANG_EVENT_NAME", string_ucwords(EVENT_FEATURE_NAME)." Name");
	//Banner Name
	define("LANG_BANNER_NAME", string_ucwords(BANNER_FEATURE_NAME)." Name");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", string_ucwords(CLASSIFIED_FEATURE_NAME)." Name");
	//Article Name
	define("LANG_ARTICLE_NAME", string_ucwords(ARTICLE_FEATURE_NAME)." Name");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Frequently Asked Questions");
	//click to crop image
	define("LANG_CROPIMAGE", "click here to crop the image");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Did not find your answer? Contact us.");
	//Active
	define("LANG_LABEL_ACTIVE", "Active");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspended");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expired");
	//Pending
	define("LANG_LABEL_PENDING", "Pending");
	//Received
	define("LANG_LABEL_RECEIVED", "Received");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", string_ucwords(DISCOUNTCODE_LABEL));
	//Account
	define("LANG_LABEL_ACCOUNT", "Account");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Change account");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Name or Title");
	//Name
	define("LANG_LABEL_NAME", "Name");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "First, Last");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Page Name");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Summary Description");
	//Category
	define("LANG_LABEL_CATEGORY", "Category");
	//Category
	define("LANG_CATEGORY", "Category");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categories");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categories");
	//Country
	define("LANG_LABEL_COUNTRY", "Country");
	//Region
	define("LANG_LABEL_REGION", "Region");
	//State
	define("LANG_LABEL_STATE", "State");
	//City
	define("LANG_LABEL_CITY", "City");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Neighborhood");	
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Countries");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regions");
	//States
	define("LANG_LABEL_STATE_PL", "States");
	//Cities
	define("LANG_LABEL_CITY_PL", "Cities");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Neighborhoods");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Add a new region");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Add a new state");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Add a new city");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Add a new neighborhood");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Choose an existing region");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Choose an existing state");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Choose an existing city");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Choose an existing neighborhood");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "No locations found");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renewal");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Renewal Date");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Street Address");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Web Address");
	//Phone
	define("LANG_LABEL_PHONE", "Phone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Long Description");
	//Status
	define("LANG_LABEL_STATUS", "Status");
	//Level
	define("LANG_LABEL_LEVEL", "Level");
	//Empty
	define("LANG_LABEL_EMPTY", "Empty");
	//Start Date
	define("LANG_LABEL_START_DATE", "Start Date");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Start Date");
	//End Date
	define("LANG_LABEL_END_DATE", "End Date");
	//End Date
	define("LANG_LABEL_ENDDATE", "End Date");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Invalid date");
	//Start Time
	define("LANG_LABEL_START_TIME", "Start Time");
	//End Time
	define("LANG_LABEL_END_TIME", "End Time");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Unlimited");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Select a Type");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Select a Category");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Time Left");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "View ".string_ucwords(PROMOTION_FEATURE_NAME));
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "No ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Select a ". string_ucwords(PROMOTION_FEATURE_NAME));
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Contact Name");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Contact Name");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Contact Phone");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Contact Fax");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Contact E-mail");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Address");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Notify me about listing reviews and listing traffic");
	//Invoice
	define("LANG_LABEL_INVOICE", "Invoice");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Invoice #");
	//Item
	define("LANG_LABEL_ITEM", "Item");
	//Items
	define("LANG_LABEL_ITEMS", "Items");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Extra Category");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", string_ucwords(DISCOUNTCODE_LABEL));
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Item Price");
	//Amount
	define("LANG_LABEL_AMOUNT", "Amount");
	//Tax
	define("LANG_LABEL_TAX", "Tax");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Subtotal");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Make checks payable to");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Title");
	//Caption
	define("LANG_LABEL_CAPTION", "Caption");
	//impressions
	define("LANG_IMPRESSIONS", "impressions");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Impressions");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "By impressions");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "By time period");
	//Date
	define("LANG_LABEL_DATE", "Date");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Your E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Subject");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Additional message");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Payment type");
	//Notes
	define("LANG_LABEL_NOTES", "Notes");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "It's easy and fast!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Write reviews, comment on blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Write reviews");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Already have access?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Enjoy our services!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test Password");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Forgot your password?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Summary");
	//Detail
	define("LANG_LABEL_DETAIL", "Detail");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(your friend's e-mail)");
	//From
	define("LANG_LABEL_FROM", "From");
	//To
	define("LANG_LABEL_TO", "To");
	//to
	define("LANG_LABEL_DATE_TO", "to");
	//Last
	define("LANG_LABEL_LAST", "Last");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Last");
	//day
	define("LANG_LABEL_DAY", "day");
	//days
	define("LANG_LABEL_DAYS", "days");
	//New
	define("LANG_LABEL_NEW", "New");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "New FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Type");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "ClickThru");
	//Added
	define("LANG_LABEL_ADDED", "Added");
	//Add
	define("LANG_LABEL_ADD", "Add");
	//rating
	define("LANG_LABEL_RATING", "rating");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "evaluator");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Reviewer");
	//System
	define("LANG_LABEL_SYSTEM", "System");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Subscribe to RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Password strength");
	//Article Title
	define("LANG_ARTICLE_TITLE", string_ucwords(ARTICLE_FEATURE_NAME)." Title");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Description");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO Keywords");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "line breaks are not allowed");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separate elements using comma (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Click here to edit the SEO information of this item");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO successfully updated!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Click here to view this ".ARTICLE_FEATURE_NAME);
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Click here to edit this ".ARTICLE_FEATURE_NAME);
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Click here to add/edit photo gallery for this ".ARTICLE_FEATURE_NAME);
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Photo gallery not available for this ".ARTICLE_FEATURE_NAME);
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Click here to view this ".ARTICLE_FEATURE_NAME." reports");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "History for this ".ARTICLE_FEATURE_NAME);
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "History not available for this ".ARTICLE_FEATURE_NAME);
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Click here to delete this ".ARTICLE_FEATURE_NAME);
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Click here to view this ".BANNER_FEATURE_NAME);
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Click here to edit this ".BANNER_FEATURE_NAME);
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Click here to view this ".BANNER_FEATURE_NAME." reports");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "History for this ".BANNER_FEATURE_NAME);
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "History not available for this ".BANNER_FEATURE_NAME);
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Click here to delete this ".BANNER_FEATURE_NAME);
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", string_ucwords(CLASSIFIED_FEATURE_NAME)." Title");
	//Click here to
	define("LANG_MSG_CLICKTO", "Click here to");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Click here to view this ".CLASSIFIED_FEATURE_NAME);
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Click here to edit this ".CLASSIFIED_FEATURE_NAME);
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Click here to add/edit photo gallery for this ".CLASSIFIED_FEATURE_NAME);
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Photo gallery not available for this ".CLASSIFIED_FEATURE_NAME);
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Click here to view this ".CLASSIFIED_FEATURE_NAME." reports");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Click here to map tuning this ".CLASSIFIED_FEATURE_NAME." location");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Map tuning not available for this ".CLASSIFIED_FEATURE_NAME);
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "History for this ".CLASSIFIED_FEATURE_NAME);
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "History not available for this ".CLASSIFIED_FEATURE_NAME);
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Click here to delete this ".CLASSIFIED_FEATURE_NAME);
	//Event Title
	define("LANG_EVENT_TITLE", string_ucwords(EVENT_FEATURE_NAME)." Title");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Click here to view this ".EVENT_FEATURE_NAME);
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Click here to edit this ". EVENT_FEATURE_NAME);
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Click here to add/edit photo gallery for this ".EVENT_FEATURE_NAME);
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Photo gallery not available for this ".EVENT_FEATURE_NAME);
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Click here to view this ".EVENT_FEATURE_NAME." reports");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Click here to map tuning this ".EVENT_FEATURE_NAME." location");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Map tuning not available for this ".EVENT_FEATURE_NAME);
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "History for this ".EVENT_FEATURE_NAME);
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "History not available for this ".EVENT_FEATURE_NAME);
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Click here to delete this ".EVENT_FEATURE_NAME);
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Gallery Title");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Click here to view this gallery");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Click here to edit this gallery");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Click here to delete this gallery");
	//Listing Title
	define("LANG_LISTING_TITLE", string_ucwords(LISTING_FEATURE_NAME)." Title");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Click here to view this ".LISTING_FEATURE_NAME);
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Click here to edit this ".LISTING_FEATURE_NAME);
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Click here to add/edit photo gallery for this ".LISTING_FEATURE_NAME);
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Photo gallery not available for this ".LISTING_FEATURE_NAME);
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Click here to change ".PROMOTION_FEATURE_NAME." for this ".LISTING_FEATURE_NAME);
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", string_ucwords(PROMOTION_FEATURE_NAME)." not available for this ".LISTING_FEATURE_NAME);
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Click here to view this ".LISTING_FEATURE_NAME." reports");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Click here to map tuning this ".LISTING_FEATURE_NAME." location");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Map tuning not available for this ".LISTING_FEATURE_NAME);
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Address not found.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Please edit your item.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Click here to view this item reviews");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Item reviews not available");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "History for this ".LISTING_FEATURE_NAME);
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "History not available for this ".LISTING_FEATURE_NAME);
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Click here to delete this ".LISTING_FEATURE_NAME);
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Save");	
	//More Information
	define("LANG_MSG_MORE_INFO", "More Information");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Try to use something descriptive, like \"10% off of our product\" or \"3 for the price of two on our product\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Every ".PROMOTION_FEATURE_NAME." needs to be linked to a ".LISTING_FEATURE_NAME." in order to be active on the site.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associate with the ".LISTING_FEATURE_NAME);
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Please type your item title and wait for suggestions of available associations.");
	//Empty
	define("LANG_EMPTY", "Empty");
	//Cancel
	define("LANG_CANCEL", "Cancel");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Custom Time Period");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Fixed Value Discount");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Percentage Discount");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Value with Discount");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Discount (Calculated)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "How many deal would you like to offer");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Linked to ".string_ucwords(LISTING_FEATURE_NAME));
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Choose a ".string_ucwords(LISTING_FEATURE_NAME));
	//You can not add different deals to the same listing.
	//define("LANG_MSG_REPEATED_LISTINGS", "You can not add different ".PROMOTION_FEATURE_NAME_PLURAL." to the same ".LISTING_FEATURE_NAME.".");
	define("LANG_MSG_REPEATED_LISTINGS", "You can not add more ".PROMOTION_FEATURE_NAME_PLURAL." to the ".LISTING_FEATURE_NAME." than the number of purchased ".PROMOTION_FEATURE_NAME_PLURAL.".");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL)." successfully updated!");
	//Options
	define("LANG_LABEL_OPTIONS", "Options");
	//Deal Title
	define("LANG_PROMOTION_TITLE", string_ucwords(PROMOTION_FEATURE_NAME)." Title");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Click here to view this ".PROMOTION_FEATURE_NAME);
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Click here to edit this ".PROMOTION_FEATURE_NAME);
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Click here to delete this ".PROMOTION_FEATURE_NAME);
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Go to \"".string_ucwords(LISTING_FEATURE_NAME_PLURAL)."\" and click on the ".PROMOTION_FEATURE_NAME." icon belonging to the ".LISTING_FEATURE_NAME." where you want to add the ".PROMOTION_FEATURE_NAME.". Select one ".PROMOTION_FEATURE_NAME." to add to your ".LISTING_FEATURE_NAME." to make it live.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "The installments will be recurring until your credit card expiration");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "maximum of 36 installments");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "SEO Center");
	//View
	define("LANG_LABEL_VIEW", "View");
	//Edit
	define("LANG_LABEL_EDIT", "Edit");
	//Gallery
	define("LANG_LABEL_GALLERY", "Gallery");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Traffic Reports");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Unpaid");
	//Paid
	define("LANG_LABEL_PAID", "Paid");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Waiting payment approval");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Under review");
	//Available
	define("LANG_LABEL_AVAILABLE", "Available");
	//In dispute
	define("LANG_LABEL_DISPUTE", "In dispute");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Refunded");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelled");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transaction");
	//Delete
	define("LANG_LABEL_DELETE", "Delete");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Map Tuning");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Hide Map");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Show Map");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Print");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Pending Approval");
	//Image
	define("LANG_LABEL_IMAGE", "Image");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Images");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Required field");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Please type all the required fields.");
	//Accoun