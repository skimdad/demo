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
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Account Information");
	//Username
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Current Password");
	//Password
	define("LANG_LABEL_PASSWORD", "Password");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Create Password");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "New Password");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Retype Password");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Retype Password");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Retype New Password");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Information");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Publication Date");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendar");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Friendly Url");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "For example");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Image Source");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Image Attribute");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Image Caption");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Abstract");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Keywords for the search");
	//maximum
	define("LANG_LABEL_MAX", "maximum");
	//keywords
	define("LANG_LABEL_KEYWORDS", "keywords");
	//Content
	define("LANG_LABEL_CONTENT", "Content");
	//Code
	define("LANG_LABEL_CODE", "Code");
	//free
	define("LANG_FREE", "FREE");
	//free
	define("LANG_LABEL_FREE", "free");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Destination Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "File");
	//Warning
	define("LANG_LABEL_WARNING", "Warning");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Display URL (optional)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Description line 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Description line 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Location");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Address (optional)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Address (Optional)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Detail Description");
	//Price
	define("LANG_LABEL_PRICE", "Price");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Prices");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Contact Information");
	//Language
	define("LANG_LABEL_LANGUAGE", "Language");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Select your main language to contact (when necessary)."); 
	//First Name
	define("LANG_LABEL_FIRST_NAME", "First Name");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "First Name");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Last Name");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Last Name");
	//Company
	define("LANG_LABEL_COMPANY", "Company");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Address Line1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Address Line2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Not found. Please, try to specify better your location.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "The following fields contain errors:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude must be a number between -90 and 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude must be a number between -180 and 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Location Name");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", string_ucwords(EVENT_FEATURE_NAME)." Date");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Description");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Help Information");
	//Text
	define("LANG_LABEL_TEXT", "Text");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Add Image");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Add Image");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Edit Image Captions");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Image File");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Thumb Caption");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Image Caption");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Video Snippet Code");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Attach Additional File");
	//Attention
	define("LANG_LABEL_ATTENTION", "Attention");
	//Source
	define("LANG_LABEL_SOURCE", "Source");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Hours of work");
	//Default
	define("LANG_LABEL_DEFAULT", "Default");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Payment Method");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "By Credit Card");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "By PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "By SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "By Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Print Invoice and Mail a Check");
	//Headline
	define("LANG_LABEL_HEADLINE", "Headline");
	//Offer
	define("LANG_LABEL_OFFER", "Offer");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Conditions");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Deal Dates");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Deal Image");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Printable ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Our HTML template based ".PROMOTION_FEATURE_NAME);
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Fill in the fields above and insert a logo or other image (JPG or GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "A ".(PROMOTION_FEATURE_NAME)." provided by you instead");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "JPG or GIF image");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Comment Title");
	//Comment
	define("LANG_LABEL_COMMENT", "Comment");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Accepted");
	//Approved
	define("LANG_LABEL_APPROVED", "Approved");
	//Success
	define("LANG_LABEL_SUCCESS", "Success");
	//Completed
	define("LANG_LABEL_COMPLETED", "Completed");
	//Y
	define("LANG_LABEL_Y", "Y");
	//Failed
	define("LANG_LABEL_FAILED", "Failed");
	//Declined
	define("LANG_LABEL_DECLINED", "Declined");
	//failure
	define("LANG_LABEL_FAILURE", "failure");
	//Canceled
	define("LANG_LABEL_CANCELED", "Canceled");
	//Error
	define("LANG_LABEL_ERROR", "Error");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Transaction Code");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Subscription ID");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "transaction history");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Authorization Code");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Transaction Status");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Transaction Error");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Monthly Bill Amount");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transaction OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Yearly Bill Amount");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Bill Amount");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "Transaction ID");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Receipt ID");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Subscribe ID");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "Transaction Order ID");
	//your
	define("LANG_LABEL_YOUR", "your");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Make Your");
	//Payment
	define("LANG_LABEL_PAYMENT", "Payment");
	//History
	define("LANG_LABEL_HISTORY", "History");
	//Sign in
	define("LANG_LABEL_LOGIN", "Sign in");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transaction canceled");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Transaction amount");
	//Pay
	define("LANG_LABEL_PAY", "Pay");
	//Back
	define("LANG_LABEL_BACK", "Back");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Total Price");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Pay By Invoice");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrator");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Billing Info");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Card Number");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Card Expire date");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Card Code");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Customer Info");
	//zip
	define("LANG_LABEL_ZIP", "zip");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Place Order and Continue");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "General Information");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Phone Number");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "E-mail Address");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Credit Card Information");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Exp. Date");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Customer Information");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Card Expiration");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Name on Card");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Card Type");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Card Verification Number");
	//Province
	define("LANG_LABEL_PROVINCE", "Province");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Postal Code");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Post Code");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Select Date");
	//Found
	define("LANG_PAGING_FOUND", "Found");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Found");
	//record
	define("LANG_PAGING_RECORD", "record");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "records");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Showing page");
	//of
	define("LANG_PAGING_PAGEOF", "of");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "pages");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Go to page");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Select");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Sort by:");
	//A-Z:
	define("LANG_PAGING_ORDERBYPAGE_AZ", "A-Z");
	//Distance:
	define("LANG_PAGING_ORDERBYPAGE_DISTANCE", "Distance");	
	//Reviews:
	define("LANG_PAGING_ORDERBYPAGE_REVIEWS", "Reviews");	
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Characters");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Last Updated");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Date Created");
	//Event Date
	define("LANG_PAGING_ORDERBYPAGE_EVENTDATE", "Event Date");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Rating");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Price");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "previous page");
	//next page
	define("LANG_PAGING_NEXTPAGE", "next page");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "previous");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "next");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", string_ucwords(ARTICLE_FEATURE_NAME)." successfully added!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", string_ucwords(BANNER_FEATURE_NAME)." successfully added!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", string_ucwords(CLASSIFIED_FEATURE_NAME)." successfully added!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", string_ucwords(EVENT_FEATURE_NAME)." successfully added!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Gallery successfully added!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", string_ucwords(LISTING_FEATURE_NAME)." successfully added!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully added!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", string_ucwords(ARTICLE_FEATURE_NAME)." successfully updated!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", string_ucwords(BANNER_FEATURE_NAME)." successfully updated!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", string_ucwords(CLASSIFIED_FEATURE_NAME)." successfully updated!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", string_ucwords(EVENT_FEATURE_NAME)." successfully updated!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Gallery successfully updated!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", string_ucwords(LISTING_FEATURE_NAME)." successfully updated!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully updated!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Map Tuning successfully updated!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Gallery successfully changed!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Deal was successfully deleted!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", string_ucwords(PROMOTION_FEATURE_NAME)." successfully changed!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", string_ucwords(BANNER_FEATURE_NAME)." successfully deleted!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Invalid image type. Please insert one image JPG, GIF or PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "The image file is too large.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Please try again with another image.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Attached file was denied. Invalid file type.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Click here to view this gallery");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Click here to manage gallery images");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Please type your e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail was not found.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Please try again or contact support at:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "System Forgotten Password is disabled.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Please contact support at:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Thank you!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "An e-mail was sent to the account holder with instructions to obtain a new password");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "File not found!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Error! No Thumb Image!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "No Images have been uploaded into this gallery yet!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Click here to print the invoice");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Click here to view the invoice detail");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(prices amount are per installments)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Unpaid Item");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "No Check Out Needed");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Move the mouse over the bars to see more details about the graphic)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Click the report type to display graph)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Click here to view this review");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Click here to edit this review");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Click here to edit this reply");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Click here to delete this review");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Waiting Site Manager Approval");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Waiting Site Manager Approval for Review");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Waiting Site Manager Approval for Reply");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Waiting Site Manager Approval for Review and Reply");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Review Already Approved");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Review and Reply Already Approved");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Review Pending Approval");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Reply Pending Approval");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Review Active");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Reply Active");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Review and Reply Pending Approval");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Review and Reply Active");
	//Reply
	define("LANG_REPLY", "Reply");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Reply");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Review and Reply");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Edit Review");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Edit Reply");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Approve Review");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Approve Reply");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Reply Already Approved");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Review successfully sent!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Reply successfully sent!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Please type a valid reply!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Please type a valid name!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Please type a valid e-mail!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Please type a valid city, state!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Please type a valid title!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Please type a valid review!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Please choose an option or click in cancel to exit.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Click here to reply this review");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Click here to view the transaction");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail must be between");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "characters with no spaces.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Password must be between");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Type your password here if you want to change it.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Password is going to be sent to Member E-mail Address.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Please write down your e-mail and password for future reference.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Please check the agreement terms.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Successfully added!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Already added");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Please, select a valid category");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Please, select a category first");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like \"a-z\" and/or \"0-9\") and \"-\" instead of spaces.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "The page name title \"John Auto Repair\" will be available through the url:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Additional images may be added to the");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "gallery (If it is enabled).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Maximum file size");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .gif or .png not supported");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animated .gif isn't supported.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Check this box to remove your existing image");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "maximum 250 characters");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "maximum 100 characters");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "characters left");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(including spaces and line breaks)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Include up to");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "keywords with a maximum of 50 characters each.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Add one keyword or keyword phrase per line. For example:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Only select sub-categories that directly apply to your type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Your ".ARTICLE_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "maximum 25 characters");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "maximum 500 characters");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Allowed file types");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Click here to preview this ".LISTING_FEATURE_NAME);
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Click here to preview this ".EVENT_FEATURE_NAME);
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Click here to preview this ".CLASSIFIED_FEATURE_NAME);
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Click here to preview this ".ARTICLE_FEATURE_NAME);
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Click here to preview this ".BANNER_FEATURE_NAME);
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Click here to preview this ".PROMOTION_FEATURE_NAME);
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Click here to preview this gallery");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "maximum 30 characters");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Select a Country");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Select a Region");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Select a State");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Select a City");	
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Select a Neighborhood");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(This information will not be displayed publicly)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Your ".EVENT_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");	
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "If video snippet code was filled in, it will appear on the detail page");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Maximum video code size supported");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "If the video code size is bigger than supported video size, it will be modified.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Attachment has no caption");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Check this box to remove existing ".LISTING_FEATURE_NAME." attachment");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Add one phrase per line. For example");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Extra categories/sub-categories cost an");
	//additional
	define("LANG_MSG_ADDITIONAL", "additional");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "each. Be seen!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "If you add new categories, your ".LISTING_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "If you add new categories, your ".ARTICLE_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "If you add new categories, your ".CLASSIFIED_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "If you add new categories, your ".EVENT_FEATURE_NAME." will not appear in the main category of each sub-category you added until site manager approve them.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Request your ".LISTING_FEATURE_NAME." to be considered for the following badges.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Click here to select date");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Click on the");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "gallery icon");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "below if you wish to add photos to your photo gallery.");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Click on the");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "Deal icon");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "below if you wish to add deal to your listing.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "You can add ".PROMOTION_FEATURE_NAME." to your ".LISTING_FEATURE_NAME." by clicking on the link");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "add ".PROMOTION_FEATURE_NAME);
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "All pages but item pages");
	//All pages
	define("LANG_ALLPAGES", "All pages");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Non-category search");
	//deal
	define("LANG_ICONPROMOTION", PROMOTION_FEATURE_NAME);
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "e-mail to friend");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "add to favorites");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "remove from favorites");
	//print
	define("LANG_ICONPRINT", "print");
	//map
	define("LANG_ICONMAP", "map");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Add to");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google maps are not available. Please contact the administrator.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Remove");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Favorite ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Favorite ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Favorite ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Favorite ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Favorite ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Published");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "More Info");
	//Date
	define("LANG_EVENT_DATE", "Date");
	//Time
	define("LANG_EVENT_TIME", "Time");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Get driving directions");
	//Website
	define("LANG_EVENT_WEBSITE", "Website");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Phone");
	//More
	define("LANG_EVENT_MORE", "More");
	//More Info
	define("LANG_EVENT_MOREINFO", "More Info");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "See all categories");
	//View all listing categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "View all ".LISTING_FEATURE_NAME." categories");
	//More Info
	define("LANG_LISTING_MOREINFO", "More Info");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "view phone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "view fax");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "send an e-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Click here to see more info!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Complete the form below to contact us.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contact this ".ucfirst(LISTING_FEATURE_NAME));
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "E-mail an inquiry");
	//phone
	define("LANG_LISTING_LETTERPHONE", "phone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "website");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "offers the following products and/or services:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Hours of work");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "No review comment found for this item!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Reviews and comments from the last month");
	//Review
	define("LANG_REVIEW", "Review");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Reviews");
	//Reviews
	define("LANG_REVIEWTITLE", "Reviews");
	//review
	define("LANG_REVIEWCOUNT", "review");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "reviews");
	//check in
	define("LANG_CHECKINCOUNT", "Check in");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Check ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "See check ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check ins of");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "No check in found for this item!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Related Categories");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategories");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "See comments");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Rate it");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Be the first to review this item!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Offered by");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "More Info");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Valid from");
	//to
	define("LANG_PROMOTION_VALIDTO", "to");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Print ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", string_ucwords(ARTICLE_FEATURE_NAME));
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Banner
	define("LANG_BANNER_FEATURE_NAME", string_ucwords(BANNER_FEATURE_NAME));
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Event
	define("LANG_EVENT_FEATURE_NAME", string_ucwords(EVENT_FEATURE_NAME));
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Listing
	define("LANG_LISTING_FEATURE_NAME", string_ucwords(LISTING_FEATURE_NAME));
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", string_ucwords(PROMOTION_FEATURE_NAME));
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Send
	define("LANG_BUTTON_SEND", "Send");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Sign Up");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "View Category Path");
	//More info
	define("LANG_VIEWCATEGORY", "More info");
	//No info found
	define("LANG_NOINFO", "No info found");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Remove Selected Category");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continue");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "No, thank you");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Yes, continue.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "No, Order without the Package.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Increase your Visibility!");
	//Gift
	define("LANG_GIFT", "Gift");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Help to Increase your visibility, check our ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Site statistics!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitors per Month");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Custom option");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancel");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Sign In");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Save Map Tuning");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Clear Map Tuning");
	//Next
	define("LANG_BUTTON_NEXT", "Next");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pay By CreditCard");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pay By PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pay By SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Search");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Advanced");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Close");
	//Clear
	define("LANG_BUTTON_CLEAR", "Clear");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Add your ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Add your ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Add your ".string_ucwords(EVENT_FEATURE_NAME));
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Add your ".string_ucwords(LISTING_FEATURE_NAME));
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Add your ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Manage Account");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Manage Content");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Sponsor Area");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Site Manager Area");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Site Manager Section");
	//Help
	define("LANG_BUTTON_HELP", "Help");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Sign out");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Submit");
	//Update
	define("LANG_BUTTON_UPDATE", "Update");
	//Back
	define("LANG_BUTTON_BACK", "Back");
	//Delete
	define("LANG_BUTTON_DELETE", "Delete");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Complete the Process");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Verification Code image cannot be displayed");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Verification Code");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Please select a rating for this item");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraud detected! Please select a rating for this item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Comment\" and \"Comment Title\" are required to post a comment!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Name\" and \"E-mail\" are required to post a comment!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"City, State\" are required to post a comment!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Please type a valid e-mail address!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "You have already given your opinion on this item. Thank you.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Thanks for the feedback!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Your review has been submitted for approval.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "No payment method was selected!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Wrong credit card expiration date. Please, try again.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Click here to try again");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Payment transactions may not occur immediately.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "After your payment is processed, information about your transaction");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "may be found in your transaction history.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "may be found in your");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "The payment gateway is not available currently");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "The payment parameters could not be validated");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Internal gateway error was encountered");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Information about your transaction may be found");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "in your transaction history.");
	//in your
	define("LANG_MSG_IN_YOUR", "in your");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "No Transaction ID");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "System failure, please try again.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Please, fill in all required fields.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Could not connect.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Thank you for setting up your items and for making the payment!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Site manager will review your items and set it live within 2 working days.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "The payment gateway could not respond");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Pending payments may take 3 to 4 days to be approved.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Connection Failure");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Please, fill correctly zip.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Please, fill correctly card verification number.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Card Type and Card Verification Number do not match.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "Transaction Not Completed.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Error Number:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Short Message:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Long Message:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transaction Completed Successfully.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Card expire date must be in the future");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "If your transaction was confirmed, information about it may be found in");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "your transaction history after your payment is processed.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "after your payment is processed.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "No items requiring payment.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pay for outstanding invoices");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." by Impression and Custom Invoices can be paid once.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." by Impression can be paid once.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Custom Invoices can be paid once.");
	//View Items
	define("LANG_VIEWITEMS", "View Items");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Please do not use recurring payment system.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Try again!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "All fields are required.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "You have more than");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Please contact the administrator to check out it");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", string_ucwords(ARTICLE_FEATURE_NAME)." Options");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", string_ucwords(ARTICLE_FEATURE_NAME)." Author");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", string_ucwords(ARTICLE_FEATURE_NAME)." Author URL");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", string_ucwords(ARTICLE_FEATURE_NAME)." Categories");
	//Banner Type
	define("LANG_BANNER_TYPE", string_ucwords(BANNER_FEATURE_NAME)." Type");
	//Banner Options
	define("LANG_BANNER_OPTIONS", string_ucwords(BANNER_FEATURE_NAME)." Options");
	//Order Banner
	define("LANG_ORDER_BANNER", "Order ".string_ucwords(BANNER_FEATURE_NAME));
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "By time period");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", string_ucwords(BANNER_FEATURE_NAME)." Details");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Script ".string_ucwords(BANNER_FEATURE_NAME));
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Show by Script Code");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the ".BANNER_FEATURE_NAME." from an affiliate program or external ".BANNER_FEATURE_NAME." system. If \"Show by Script Code\" is checked, just \"Script\" field will be required. The other fields below will not be necessary.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Both \"Destination Url\" and \"Traffic Report ClickThru\" has no effect when you upload script banners.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Both \"Destination Url\" and \"Traffic Report ClickThru\" has no effect when you upload swf file");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", string_ucwords(CLASSIFIED_FEATURE_NAME)." Category");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Select ".CLASSIFIED_FEATURE_NAME." level");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", string_ucwords(CLASSIFIED_FEATURE_NAME)." Options");
	//Event Level
	define("LANG_EVENT_LEVEL", string_ucwords(EVENT_FEATURE_NAME)." Level");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", string_ucwords(EVENT_FEATURE_NAME)." Categories");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", string_ucwords(EVENT_FEATURE_NAME)." Categories");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Select ".EVENT_FEATURE_NAME." level");
	//Event Options
	define("LANG_EVENT_OPTIONS", string_ucwords(EVENT_FEATURE_NAME)." Options");
	//Listing Level
	define("LANG_LISTING_LEVEL", string_ucwords(LISTING_FEATURE_NAME)." Level");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", string_ucwords(LISTING_FEATURE_NAME)." Categories");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", string_ucwords(LISTING_FEATURE_NAME)." Badges");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Subject to administrator approval.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Select this choice");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Select ".LISTING_FEATURE_NAME." level");
	//Listing Options
	define("LANG_LISTING_OPTIONS", string_ucwords(LISTING_FEATURE_NAME)." Options");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "The Authorize Payment System is not available currently. Please contact the");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "The iTransact Payment System is not available currently. Please contact the");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "The LinkPoint Payment System is not available currently. Please contact the");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "The PayFlow Payment System is not available currently. Please contact the");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "The PayPal Payment System is not available currently. Please contact the");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "The PayPalAPI Payment System is not available currently. Please contact the");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "The PSIGate Payment System is not available currently. Please contact the");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "The 2CheckOut Payment System is not available currently. Please contact the");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "The WorldPay Payment System is not available currently. Please contact the");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "The SimplePay Payment System is not available currently. Please contact the");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Upload Warning");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "File successfully uploaded!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Extension not allowed or wrong file type!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "File exceeds size limit!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Fail trying to create directory!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Wrong directory permission!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Unexpected failure!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "File not found or not entered!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "File already exists in directory!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "View all locations");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Featured Locations");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "There aren't any featured location in the system.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Overview");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Map Location");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "More ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//More Events
	define("LANG_LABEL_MOREEVENTS", "More ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "More ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "More ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Operation not allowed: The ".PROMOTION_FEATURE_NAME."");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "is already associated with the ".LISTING_FEATURE_NAME."");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Pending");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "Aborted");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Failed");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Declined");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Unknow");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Success");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Click on \"Add\" to select categories");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Click at \"Add main category\" or \"Add sub-category\" to type your new categories");
	//Add an
	define("LANG_ADD_AN", "Add an");
	//Add a
	define("LANG_ADD_A", "Add a");
	//on these sites
	define("LANG_ON_SITES", "on these sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "on this site:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slideshow");
	//on
	define("LANG_SLIDESHOW_ON", "on");
	//off
	define("LANG_SLIDESHOW_OFF", "off");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Photos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Click here");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "for Slideshow. You can also click on any of the photos to start slideshow.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "View more photos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Inexistent ".string_ucwords(DISCOUNTCODE_LABEL));
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "is not available.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "is not available for this item type.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "cannot be used twice.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "You can select up to");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "gallery.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galleries.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Title is required.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Language is required.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "First Name is required.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Last Name is required.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Company is required.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Phone is required.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-mail is required.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Account is required.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Page Name is required.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Category is required.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Abstract is required.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Expiration type is required.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Renewal Date is required.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Impressions are required.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "File is required.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Type is required.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Caption is required.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Script Code is required.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Description 1 is required.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Description 2 is required.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Name is required.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Deal Title is required.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Offer is required.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Start Date is required.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "End Date is required.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Text is required.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail is required.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Current Password\" is incorrect.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "\"Password\" is required.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Agree to terms of use\" is required.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "The following fields were not filled or contain errors:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Title - Please fill out the field");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Page Name - Please fill out the field");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Maximum of");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categories are allowed.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Friendly URL Page Name already in use, please choose another Page Name.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Page Name contain invalid chars");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Maximum of");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "keywords are allowed");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Please include keywords with a maximum of 50 characters each");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Please enter a valid \"Publication Date\".");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Please enter a valid \"Start Date\".");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Please enter a valid \"End Date\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "The \"End Date\" must be greater than or equal to the \"Start Date\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "The \"End Time\" must be greater than the \"Start Time\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "The \"End Date\" cannot be in past.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Please enter a valid e-mail address.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Please enter a valid \"URL\".");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Please provide a description with a maximum of 255 characters.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Please provide a conditions with a maximum of 255 characters.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Please enter a valid renewal date.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Renewal date must be in the future.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Please enter a valid expiration date.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Expiration date must be in the future.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Blank space is not allowed for password.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Please enter a password with a maximum of");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Please enter a password with a minimum of");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Please enter a valid e-mail.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Sorry, you can´t change these account´s informations");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Password \"abc123\" not allowed!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Passwords do not match. Please enter the same content for \"password\" and \"retype password\" fields.");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Spaces are not allowed for e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "Special characters are not allowed for e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Please type an e-mail with a maximum of");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Please type an e-mail with a minimum of");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Please choose a different e-mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Click here if you do not see your category");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Add main category");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Add sub-category");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", LANG_LABEL_CATEGORY." title already registered!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", LANG_LABEL_CATEGORY." title available!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Home");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Manage");
	//Add
	define("LANG_MENU_ADD", "Add");
	//Create
	define("LANG_MENU_CREATE", "Create");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Sponsor Options");
	//Listings
	define("LANG_MENU_LISTING", string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Add ".string_ucwords(LISTING_FEATURE_NAME));
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Manage ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Galleries
	define("LANG_MENU_GALLERY", "Galleries");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Add Gallery");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Manage Gallery");
	//Events
	define("LANG_MENU_EVENT", string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Add Event
	define("LANG_MENU_ADDEVENT", "Add ".string_ucwords(EVENT_FEATURE_NAME));
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Manage ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Banners
	define("LANG_MENU_BANNER", string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Add ".string_ucwords(BANNER_FEATURE_NAME));
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Manage ".string_ucwords(BANNER_FEATURE_NAME_PLURAL));
	//Classifieds
	define("LANG_MENU_CLASSIFIED", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Add ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Manage ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Articles
	define("LANG_MENU_ARTICLE", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Add ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Manage ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Deals
	define("LANG_MENU_PROMOTION", string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Add ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Manage ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Advertise With Us");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Page not found");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Maintenance Page");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Sitemap");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contact Us");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Payment Options");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Check Out");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Make Your Payment");
	//History
	define("LANG_MENU_HISTORY", "History");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Transaction History");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Invoice History");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Choose a Theme");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Choose a Color Scheme");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Search ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Search ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Search ".string_ucwords(EVENT_FEATURE_NAME));
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Search ".string_ucwords(LISTING_FEATURE_NAME));
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Search ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Advanced Search");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Search");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Location");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Select a Country");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Select a Region");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Select a State");	
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Select a City");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Select a Neighborhood");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Category");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Select a Category");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Match");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Exact Match");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Any Word");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "All Words");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//from
	define("LANG_SEARCH_LABELFROM", "from");
	//to
	define("LANG_SEARCH_LABELTO", "to");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "of");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Search by keyword");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Search");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Featured");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Recent ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Upcoming ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Featured ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Featured ".string_ucwords(ARTICLE_FEATURE_NAME_PLURAL));
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Featured Business ".string_ucwords(LISTING_FEATURE_NAME_PLURAL));
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Featured ".string_ucwords(PROMOTION_FEATURE_NAME_PLURAL));
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "MORE FEATURED ARTICLES. . . "); //"View all ".ARTICLE_FEATURE_NAME_PLURAL);
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "MORE FEATURED EVENTS. . . "); //"View all ".EVENT_FEATURE_NAME_PLURAL);
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "MORE FEATURED CLASSIFIEDS. . . "); //"View all ".CLASSIFIED_FEATURE_NAME_PLURAL);
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "MORE FEATURED BUSINESSES. . . "); //"View all ".LISTING_FEATURE_NAME_PLURAL);
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "MORE FEATURED DEALS. . . "); //"View all ".PROMOTION_FEATURE_NAME_PLURAL);
	//Last Tweets
	define("LANG_LAST_TWEETS", "Last Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Easy and Fast.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Steps");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Steps");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Account Signup");
	//Listing Update
	define("LANG_LISTINGUPDATE", string_ucwords(LISTING_FEATURE_NAME)." Update");
	//Order
	define("LANG_ORDER", "Order");
	//Check Out
	define("LANG_CHECKOUT", "Check Out");
	//Configuration
	define("LANG_CONFIGURATION", "Configuration");
	//Select a level
	define("LANG_SELECTPACKAGE", "Select a level");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Profile Options");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Directory account");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "My existing OpenID 2.0 Account");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "My existing Facebook Account");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "My existing Google Account");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Do you already have an account?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "No, I'm a New User.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Yes, I have an Existing Account.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Sign in with my existing Directory Account.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Sign in with my existing OpenID 2.0 Account.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Sign in with my existing Facebook Account.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Sign in with my existing Google Account.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Account Information");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Additional Information");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Please write down your e-mail and password for future reference.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail must be a valid e-mail between");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "and");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "characters with no spaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Password must be between");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "and");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "characters with no spaces.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "I agree with the terms of use");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Do you want to advertise with us?");
	//Buy a link
	define("LANG_BUY_LINK", "Buy a link");
	//Back to Top
	define("LANG_BACKTOTOP", "Back to Top");
	//Back to
	define("LANG_BACKTO", "Back to ");
	//Favorites
	define("LANG_QUICK_LIST", "Favorites");
	//view summary
	define("LANG_VIEWSUMMARY", "view summary");
	//view detail
	define("LANG_VIEWDETAIL", "view detail");
	//Advertisers
	define("LANG_ADVERTISER", "Advertisers");
	//Order Now!
	define("LANG_ORDERNOW", "Order Now!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Wait, Loading...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Subtotal Amount");
	//Subtotal
	define("LANG_SUBTOTAL", "Subtotal");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Tax Amount");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Total Price Amount");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favorites");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "No favorites found!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Search results for");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Related Search");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Browse by Section");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Keyword");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Type a keyword");
	//Type  a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Type  a keyword or ".LISTING_FEATURE_NAME." name");
	//Type  a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Type  a keyword or ".PROMOTION_FEATURE_NAME." title");
	//Type  a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Type  a keyword or ".EVENT_FEATURE_NAME." title");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Type  a keyword or ".CLASSIFIED_FEATURE_NAME." title");
	//Type  a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Type  a keyword or ".ARTICLE_FEATURE_NAME." title");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Where");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Address, City, State or Zip Code)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Wait, searching for your location...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Complete the form below to contact us.");
	//Message
	define("LANG_LABEL_MESSAGE", "Message");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "No disabled categories found in the system.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "No categories found.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Please, select a valid category");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Please select a category first!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "View Category Path");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Remove Selected Category");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Extra categories/sub-categories cost an");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "additional");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "each. Be seen!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Maximum of");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categories allowed.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categories and sub-categories");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Only select sub-categories that directly apply to your type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Your ".LISTING_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Account Information Error");
	//Contact Information
	define("LANG_CONTACTINFO", "Contact Information");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "This information will not be displayed publicly.");
	//Billing Information
	define("LANG_BILLINGINFO", "Billing Information");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "This information will not be displayed publicly.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "You will configure your ".ARTICLE_FEATURE_NAME." after placing the order.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "You will configure your ".BANNER_FEATURE_NAME." after placing the order.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "You will configure your ".CLASSIFIED_FEATURE_NAME." after placing the order.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "You will configure your ".EVENT_FEATURE_NAME." after placing the order.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "You will configure your ".LISTING_FEATURE_NAME." after placing the order.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Billing Information Error");
	//Article Information
	define("LANG_ARTICLEINFO", string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", string_ucwords(ARTICLE_FEATURE_NAME)." Information Error");
	//Banner Information
	define("LANG_BANNERINFO", string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", string_ucwords(BANNER_FEATURE_NAME)." Information Error");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information Error");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Browse ".string_ucwords(EVENT_FEATURE_NAME_PLURAL)." by Date");
	//Event Information
	define("LANG_EVENTINFO", string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", string_ucwords(EVENT_FEATURE_NAME)." Information Error");
	//Listing Information
	define("LANG_LISTINGINFO", string_ucwords(LISTING_FEATURE_NAME)." Information");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", string_ucwords(LISTING_FEATURE_NAME)." Information Error");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Claim this ".string_ucwords(LISTING_FEATURE_NAME));
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", string_ucwords(LISTING_FEATURE_NAME)." Type");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "No results were found for the search criteria you requested.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Please try your search again or browse by section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Please type at least one keyword on the search box.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h3>No items found in this area!</h3><p>Trying widening search or new keywords</p>");
	//"No results content org"
	define("LANG_SEARCH_NORESULTS_ORG", "<h1>Sorry!</h1><p>Your search return no results. Although this is unusual, it happens from time to time when the search term you have used is a little generic or when we really do not have any matched content.</p><h2>Suggestions:</h2>Be more specific with your search terms.<br />Check your spelling.<br />If you can’t find via the search try browing by section.<br /><br /><p>If you belive you have come here in error, please contact the site manager to report a problem <a href=\"[EDIR_LINK_SEARCH_ERROR]\">here</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Image");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "of");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Error loading image");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Next");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pause");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Play");
	//Back
	define("LANG_SLIDESHOW_BACK", "Back");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Your e-mail has been sent. Thank you.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "There was a problem sending this e-mail. Please try again.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Please enter your name.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Please enter a valid e-mail address.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Please type the message.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Please type the code correctly.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Please correct it and try again.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "Please type a name!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Please type a subject!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "SOME DETAILS");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "SOME DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Please enter a valid e-mail address in the \"To\" field");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Please enter a valid e-mail address in the \"From\" field");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Item not found. Please return to");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "and try again.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Please enter a valid e-mail address in the \"Your E-mail\" field");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "About");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "About");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "About");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "About");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "from the");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "About");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "from the");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Send info about this ".ARTICLE_FEATURE_NAME." to a friend");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Send info about this ".CLASSIFIED_FEATURE_NAME." to a friend");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Send info about this ".EVENT_FEATURE_NAME." to a friend");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Send info about this ".LISTING_FEATURE_NAME." to a friend");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Send info about this ".PROMOTION_FEATURE_NAME." to a friend");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Message sent by ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "This is a automatic message.");
	//Contact
	define("LANG_CONTACT", "Contact");
	//article
	define("LANG_ARTICLE", ARTICLE_FEATURE_NAME);
	//classified
	define("LANG_CLASSIFIED", CLASSIFIED_FEATURE_NAME);
	//event
	define("LANG_EVENT", EVENT_FEATURE_NAME);
	//listing
	define("LANG_LISTING", LISTING_FEATURE_NAME);
	//deal
	define("LANG_PROMOTION", PROMOTION_FEATURE_NAME);
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Please search at least one parameter on the search box!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Please try your search again.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "No ".ARTICLE_FEATURE_NAME_PLURAL." registered yet.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "No ".CLASSIFIED_FEATURE_NAME_PLURAL." registered yet.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "No ".EVENT_FEATURE_NAME_PLURAL." registered yet.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "No ".LISTING_FEATURE_NAME_PLURAL." registered yet.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "No ".PROMOTION_FEATURE_NAME_PLURAL." registered yet.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Message sent through");
	//E-mail Form
	define("LANG_EMAILFORM", "E-mail Form");
	//Click here to print
	define("LANG_PRINTCLICK", "Click here to print");
	//View all classified categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "View all ".CLASSIFIED_FEATURE_NAME." categories");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Location");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "More ".string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL));
	//View all event categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "View all ".EVENT_FEATURE_NAME." categories");
	//Location
	define("LANG_EVENT_LOCATIONS", "Location");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Featured ".string_ucwords(EVENT_FEATURE_NAME_PLURAL));
	//events
	define("LANG_EVENT_PLURAL", EVENT_FEATURE_NAME_PLURAL);
	//Search results
	define("LANG_SEARCHRESULTS", "Search results");
	//Results
	define("LANG_RESULTS", "Results");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "for");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "in");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "in");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "in");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "in category");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "in");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "in");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "for");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Page");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Recent Reviews");
	//Reviews of
	define("LANG_REVIEWSOF", "Reviews of");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Reviews are disabled");
	//View all article categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "View all ".ARTICLE_FEATURE_NAME." categories");
	//View all deal categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "View all ".PROMOTION_FEATURE_NAME." categories");
	//Offer
	define("LANG_PROMOTION_OFFER", "Offer");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Description");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Conditions");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Location");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Item not found!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Item not available!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", string_ucwords(LISTING_FEATURE_NAME)." Search Results");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", string_ucwords(PROMOTION_FEATURE_NAME)." Search Results");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", string_ucwords(EVENT_FEATURE_NAME)." Search Results");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", string_ucwords(CLASSIFIED_FEATURE_NAME)." Search Results");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", string_ucwords(ARTICLE_FEATURE_NAME)." Search Results");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Available Languages");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "You can choose up to ".MAX_ENABLED_LANGUAGES." of the languages below for your directory.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Enjoy our Services!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Remove association with");
	//Welcome
	define("LANG_LABEL_WELCOME", "Welcome");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Sponsor Options");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Back to Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Add New Account");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Forgotten password");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Click here");
	//Help
	define("LANG_LABEL_HELP", "Help");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Reset Password");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Account and Contact Information");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Signup Notification");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Go to Sign in");
	//Order
	define("LANG_LABEL_ORDER", "Order");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Check Out");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuration");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Please, type your site URL first.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "Validation failed! Please try again.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Site successfully validated!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Build Traffic");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink not been validated. Please, try again.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Check this box to remove the backlink for this ".LISTING_FEATURE_NAME);
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "Backlink URL");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL where the backlink was installed.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Please, type the Backlink URL.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink not available for this ".LISTING_FEATURE_NAME);
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Add a Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Put this on your Site (HTML Code):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Enter the URL of your Site:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Ex: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Click the Button to verify your Backlink");
	//Verify
	define("LANG_LABEL_VERIFY", "Verify");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Why add a Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your ".LISTING_FEATURE_NAME.".");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "What's in it for me?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we will go the extra mile and help you. If you add a link, once we have verified it exists, we will show your ".LISTING_FEATURE_NAME." with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "How can I do this?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the \"Verify\" button - then just continue on.... super simple.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "No, Order without the Backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Yes, add Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink successfully added to your ".LISTING_FEATURE_NAME."!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "You have no ".LISTING_FEATURE_NAME." to add backlink yet.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Backlink preview");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Category Detail");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Site Manager");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Summary Page");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Detail Page");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Photo Gallery");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Add ".string_ucwords(BANNER_FEATURE_NAME));
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Gallery Image Information");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Gallery Images");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Manage Gallery Images");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Manage Galleries");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "Gallery does not exist!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "Gallery not available!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Custom Invoice Title");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Custom Invoice Items");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Easy and Fast.");
	//Steps
	define("LANG_LABEL_STEPS", "Steps");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Account Signup");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Select a Level");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Payment Status");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiration");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Add New Gallery");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Add a new gallery");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "New ". string_ucwords(PROMOTION_FEATURE_NAME));
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Add a new ".PROMOTION_FEATURE_NAME);
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Manage Billing");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Click here if you have your password already.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Not a sponsor?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "for information on adding your item to");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Welcome to the Sponsor Section");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Welcome to the Member Section");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Account locked. Wait");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minute(s) and try again.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "You don't have access permission from this IP address!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Your account was deactivated!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Sorry, your e-mail or password is incorrect.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Sorry, wrong account.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Server not available!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Error requesting OpenID Server!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "OpenID request canceled!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Google request canceled!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Invalid OpenID Identity!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Forgot your password?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "What is OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "What is Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "What is Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Account successfully updated!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Password successfully updated!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Thank you for signing up for an account in");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Sign in to manage your account with the e-mail and password below.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "You can see");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Your account in");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "This ".ARTICLE_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "This ".CLASSIFIED_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "This ".EVENT_FEATURE_NAME." will show");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "This ".LISTING_FEATURE_NAME." will show");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "the maximum of");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "image");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "images");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "in the gallery");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " plus one main image.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "or Associate an existing gallery with this ".ARTICLE_FEATURE_NAME);
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "or Associate an existing gallery with this ".CLASSIFIED_FEATURE_NAME);
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "or Associate an existing gallery with this ".EVENT_FEATURE_NAME);
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "or Associate an existing gallery with this ".LISTING_FEATURE_NAME);
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Continue to pay for your ".ARTICLE_FEATURE_NAME);
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Continue to pay for your ".BANNER_FEATURE_NAME);
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Continue to pay for your ".CLASSIFIED_FEATURE_NAME);
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Continue to pay for your ".EVENT_FEATURE_NAME);
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Continue to pay for your ".LISTING_FEATURE_NAME);
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", string_ucwords(ARTICLE_FEATURE_NAME_PLURAL)." are activated by");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", string_ucwords(BANNER_FEATURE_NAME_PLURAL)." are activated by");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", string_ucwords(CLASSIFIED_FEATURE_NAME_PLURAL)." are activated by");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", string_ucwords(EVENT_FEATURE_NAME_PLURAL)." are activated by");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", string_ucwords(LISTING_FEATURE_NAME_PLURAL)." are activated by");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "only after the process is complete.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Tips for the Item Map Tuning");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "You can adjust the position in the map,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "with more accuracy.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Use the controls \"+\" and \"-\" to adjust the map zoom.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Use the arrows to navigate on map.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Drag-and-Drop the marker to adjust the location.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Your ".PROMOTION_FEATURE_NAME." will appear here");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Associate an existing ".PROMOTION_FEATURE_NAME." with this ".LISTING_FEATURE_NAME);
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "No results found!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Access not allowed!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "The following problems were found");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "No items selected or requiring payment.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "No items found.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "No Invoices in the system.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "No Transactions in the system.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Claim this ".string_ucwords(LISTING_FEATURE_NAME));
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Go to sponsor check out area");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "You can see your invoice in");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "I agree to terms");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "and I will send payment.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "This page will redirect you to your sponsor area in few seconds.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "This page will redirect you to continue your signup process in few seconds.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "If it doesn't work, please");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Manage ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Manage ".string_ucwords(BANNER_FEATURE_NAME));
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Manage ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Manage Event
	define("LANG_MANAGE_EVENT", "Manage ".string_ucwords(EVENT_FEATURE_NAME));
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Manage ".string_ucwords(LISTING_FEATURE_NAME));
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Manage ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Manage Billing");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Manage Invoices");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Manage Transactions");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "No ".ARTICLE_FEATURE_NAME_PLURAL." in the system.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "No ".BANNER_FEATURE_NAME_PLURAL." in the system.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "No ".CLASSIFIED_FEATURE_NAME_PLURAL." in the system.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "No ".EVENT_FEATURE_NAME_PLURAL." in the system.");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "No galleries in the system.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "No ".LISTING_FEATURE_NAME_PLURAL." in the system.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "No ".PROMOTION_FEATURE_NAME_PLURAL." in the system.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "No Reports Available.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "No ".ARTICLE_FEATURE_NAME." found. It might be deleted.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "No ".CLASSIFIED_FEATURE_NAME." found. It might be deleted.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "No ".LISTING_FEATURE_NAME." found. It might be deleted.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Delete ".string_ucwords(ARTICLE_FEATURE_NAME));
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Delete ".string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Are you sure you want to delete this ".ARTICLE_FEATURE_NAME."?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", string_ucwords(ARTICLE_FEATURE_NAME)." Gallery");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", string_ucwords(ARTICLE_FEATURE_NAME)." Preview");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", string_ucwords(ARTICLE_FEATURE_NAME)." Traffic Report");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", string_ucwords(ARTICLE_FEATURE_NAME)." Detail");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Edit ".string_ucwords(ARTICLE_FEATURE_NAME)." Information");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Delete ".string_ucwords(BANNER_FEATURE_NAME));
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Delete ".string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Are you sure you want to delete this ".BANNER_FEATURE_NAME."?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Edit ".string_ucwords(BANNER_FEATURE_NAME));
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Edit ".string_ucwords(BANNER_FEATURE_NAME)." Information");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", string_ucwords(BANNER_FEATURE_NAME)." Preview");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", string_ucwords(BANNER_FEATURE_NAME)." Traffic Report");
	//View Banner
	define("LANG_VIEW_BANNER", "View ".string_ucwords(BANNER_FEATURE_NAME));
	//Disabled
	define("LANG_BANNER_DISABLED", "Disabled");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Delete ".string_ucwords(CLASSIFIED_FEATURE_NAME));
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Your ".CLASSIFIED_FEATURE_NAME." will automatically appear in the main category of each sub-category you select.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Categories");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", string_ucwords(CLASSIFIED_FEATURE_NAME)." Categories");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Delete ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Are you sure you want to delete this ".CLASSIFIED_FEATURE_NAME."?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", string_ucwords(CLASSIFIED_FEATURE_NAME)." Gallery");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", string_ucwords(CLASSIFIED_FEATURE_NAME)." Map Tuning");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", string_ucwords(CLASSIFIED_FEATURE_NAME)." Preview");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", string_ucwords(CLASSIFIED_FEATURE_NAME)." Traffic Report");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", string_ucwords(CLASSIFIED_FEATURE_NAME)." Detail");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Edit ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Information");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Edit ".string_ucwords(CLASSIFIED_FEATURE_NAME)." Level");
	//Delete Event
	define("LANG_EVENT_DELETE", "Delete ".string_ucwords(EVENT_FEATURE_NAME));
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Delete ".string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Are you sure you want to delete this ".EVENT_FEATURE_NAME."?");
	//Event Information
	define("LANG_EVENT_INFORMATION", string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Event Gallery
	define("LANG_EVENT_GALLERY", string_ucwords(EVENT_FEATURE_NAME)." Gallery");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", string_ucwords(EVENT_FEATURE_NAME)." Map Tuning");
	//Event Preview
	define("LANG_EVENT_PREVIEW", string_ucwords(EVENT_FEATURE_NAME)." Preview");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", string_ucwords(EVENT_FEATURE_NAME)." Traffic Report");
	//Event Detail
	define("LANG_EVENT_DETAIL", string_ucwords(EVENT_FEATURE_NAME)." Detail");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Edit ".string_ucwords(EVENT_FEATURE_NAME)." Information");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", string_ucwords(LISTING_FEATURE_NAME)." Gallery");
	//Listing Information
	define("LANG_LISTING_INFORMATION", string_ucwords(LISTING_FEATURE_NAME)." Information");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", string_ucwords(LISTING_FEATURE_NAME)." Map Tuning");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", string_ucwords(LISTING_FEATURE_NAME)." Preview");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", string_ucwords(LISTING_FEATURE_NAME)." ".string_ucwords(PROMOTION_FEATURE_NAME));
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "The ".PROMOTION_FEATURE_NAME." is linked from the ".LISTING_FEATURE_NAME.".");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "To be active the ".PROMOTION_FEATURE_NAME);
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "must have an end date in the future.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "must be associated with a ".LISTING_FEATURE_NAME.".");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", string_ucwords(LISTING_FEATURE_NAME)." Traffic Report");
	//Listing Detail
	define("LANG_LISTING_DETAIL", string_ucwords(LISTING_FEATURE_NAME)." Detail");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "for ".LISTING_FEATURE_NAME);
	//Listing Update
	define("LANG_LISTING_UPDATE", string_ucwords(LISTING_FEATURE_NAME)." Update");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Delete ".string_ucwords(PROMOTION_FEATURE_NAME));
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Delete ".string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Are you sure you want to delete this ".PROMOTION_FEATURE_NAME."?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", string_ucwords(PROMOTION_FEATURE_NAME)." Preview");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", string_ucwords(PROMOTION_FEATURE_NAME)." Detail");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Edit ".string_ucwords(PROMOTION_FEATURE_NAME)." Information");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Delete Gallery");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Delete Gallery Information");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Delete Gallery Image");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Gallery Information");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Gallery Preview");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Gallery Detail");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Edit Gallery Information");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Manage Images");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Delete Image");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Image successfully deleted!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Review Detail");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Review Preview");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Invoice Detail");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Invoice not found for this account.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Invoice Notification");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Transaction Detail");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transaction not found for this account.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Sign in with Directory Account");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Sign in with OpenID 2.0 Account");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Sign in with Facebook Account");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Sign in with Google Account");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." already registered!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "This account is available.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Error uploading image. Please try again.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Image successfully uploaded!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Image successfully updated!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Delete Image");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Are you sure you want to delete this image?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Edit Image");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Make main");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Main");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Click here to set as main image");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Click here to set as gallery image");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Packages");
	//Package
	define("LANG_PACKAGE_SING", "Package");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Charging for package ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profile successfully updated!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Sponsor Options");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "My Friends");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Friends to Approve");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "Pending Acceptance");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Enable User Profile");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "Meet people, find customers for your business and much more!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profile");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Profile Options");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Edit Profile");
	//Friends
	define("LANG_LABEL_FRIENDS", "Friends");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "View Friends");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Manage Friends");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Load image from your Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Personal Information");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Nickname");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Twitter account");
	//About me
	define("LANG_LABEL_ABOUT_ME", "About Me");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Birthdate");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Hometown");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Favorite Books");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Favorite Movies");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favorite Sports");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favorite Music");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favorite Food");
	//Settings
	define("LANG_LABEL_SETTINGS", "Settings");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "View all friends");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "All Friends");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Remove friend");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Add as friend");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Accept");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Deny");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Become a Sponsor");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Get listed and start promoting your business today, for free!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "What can i do?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Messages");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Are you sure?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "The personal page with name \"john-smith\" will be available through the URL:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Your URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Your URL contains invalid chars.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL already in use, please choose another URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "You have no friends.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Friend successfully removed.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Friend successfully approved.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Friend successfully rejected.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Friend requirement successfully canceled.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "View all");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "View all");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "No Friends");
	//No Items
	define("LANG_MSG_NO_ITEMS", "No Items");
	//Share
	define("LANG_LABEL_SHARE", "Share");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Share All");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comments");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "My Profile");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "User profile successfully enabled!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publish my contact information");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Create my Personal Page");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Public Profile");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Article Reviews");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Listing Reviews");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Reviews Successfully Deleted.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "No reviews found!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Edit my Profile");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Back to my Profile");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Member Since");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Account Settings");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Deals Redeemed");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favorites");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "You have no permission to access this area.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Go to your Profile.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "My Personal Page");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Use this Account");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Profile Page");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Create your Profile");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Nickname is required.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Your item has been paid, so you can add a maximum of [max] categories free.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Your item has been paid, so you can add a maximum of [max] category free.");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Only ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "images accepted for upload!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Images must be under ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Select an image for upload!");
	//Original image
	define("LANG_ORIGINAL", "Original image");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Thumb preview");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Captions");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "You can add the maximum of ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " photos to your gallery!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Create Thumbnail");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Thumbnail Preview");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Recurring Event");
	//Repeat
	define("LANG_PERIOD", "Repeat");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Choose an option");
	//Daily
	define("LANG_DAILY", "Daily");
	//Weekly
	define("LANG_WEEKLY", "Weekly");
	//Monthly
	define("LANG_MONTHLY", "Monthly");
	//Yearly
	define("LANG_YEARLY", "Yearly");
	//Daily
	define("LANG_DAILY2", "Daily");
	//Weekly
	define("LANG_WEEKLY2", "Weekly");
	//Monthly
	define("LANG_MONTHLY2", "Monthly");
	//Yearly
	define("LANG_YEARLY2", "Yearly");
	//every
	define("LANG_EVERY", "Every");
	//every
	define("LANG_EVERY2", "Every");
	//of
	define("LANG_OF", "of");
	//of
	define("LANG_OF2", "of");
	//of
	define("LANG_OF3", "of");
	//of
	define("LANG_OF4", "of");
	//Week
	define("LANG_WEEK", "Week");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Choose Month");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Choose Day");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Choose Week");
	//First
	define("LANG_FIRST", "First");
	//Second
	define("LANG_SECOND", "Second");
	//Third
	define("LANG_THIRD", "Third");
	//Fourth
	define("LANG_FOURTH", "Fourth");
	//Last
	define("LANG_LAST", "Last");
	//1st
	define("LANG_FIRST_2", "1st");
	//2nd
	define("LANG_SECOND_2", "2nd");
	//3rd
	define("LANG_THIRD_2", "3rd");
	//4th
	define("LANG_FOURTH_2", "4th");
	//Recurring
	define("LANG_RECURRING", "Recurring");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Please select a day of week.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Please type a day.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Please select a month.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Please select a week.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Please select a Repeat option.");
	//When
	define("LANG_EVENT_WHEN", "From");
	//To
	define("LANG_EVENT_TO", "To");	
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Day must be numeric.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Day must be between 1 and 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Day doesn't match with the choosen period.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Month doesn't match with the choosen period.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Days don't match with the choosen period.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Week doesn't match with the choosen period.");
	//No info
	define("LANG_EVENT_NO_INFO", "No info");
	//Ends on
	define("LANG_ENDS_IN", "Ends on");
	//Never
	define("LANG_NEVER", "Never");
	//Until
	define("LANG_UNTIL", "Until");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Until Date");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "The \"Until Date\" must be greater than or equal to the \"Start Date\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "The \"Until Date\" cannot be in past.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Starts on");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repeats");
	//Ends on
	define("LANG_EVENT_ENDS", "Ends on");
	//weekend
	define("LANG_EVENT_WEEKEND", "weekend");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "business day");
	//the month
	define("LANG_THE_MONTH", "the month");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Site name");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Click here to view this site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Click here to delete this site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site successfully deleted!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site successfully added!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />An email notification will be sent to the eDirectory support team, please wait our contact.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Site name is required");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Site URL is required");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Site name already exists");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "Site URL already exists");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "Site URL not valid");
	//Site Items
	define("LANG_SITE_ITEMS", "Site Items");
	
	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Profile Information");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Social Networking");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link and import informations");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Just link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Link my Facebook account");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Unlink my Facebook account");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Your account was unlinked from Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Your Facebook account is already linked with other account in the system.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Your Twitter account is already linked with other account in the system.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Linked to Twitter as");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Connected as");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Location Preferences");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Choose your location preference");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Use your current location");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Use Facebook Location");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Connect to Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Facebook account");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Google account");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Change account");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Twitter account");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter connection");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Link my Twitter account");
	//Unlink my Twitter account
	define("LANG_LABEL_UNLINK_TW", "Unlink my Twitter account");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Post redeems on my Twitter account automatically");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Your account was unlinked from Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "You must sign in through Twitter first");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Your Twitter account was successfully connected");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Your Facebook account was successfully connected");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Your are already logged Facebook account as");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "This user is already attached to another directory account.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Click here to switch to this account");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Connect to Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Use this language upon each sign in to my account");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_LINK2LISTING", "Link to a listing");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "I just got a great deal");
	//Redeem
	define("DEAL_REDEEM", "Redeem");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Redeem this deal");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "To redeem you need to post this deal information on your Facebook or Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "You can set this button to automatic post on your Profile.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Click here to configure it.");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Please wait, posting to Facebook and Twitter (if available).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "You already redeemed this deal! Your code is");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Deal done! This is your code");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "No one has redeemed this deal on Facebook yet.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "No one has redeemed this deal on Twitter yet.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Recent done deals");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "No deals found!");
	//This deal is not available anymore.
	define("DEAL_NA", "This deal is not available anymore.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "You already did this deal!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Sorry, there was an error trying to post on your Facebook wall. Please try again.");
	//Value
	define("DEAL_VALUE", "Value");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "With this coupon");
	//Thank you
	define("DEAL_THANKYOU", "Thank you");
	//Original value
	define("DEAL_ORIGINALVALUE", "Original value");
	//Amount paid
	define("DEAL_AMOUNTPAID", "This Deal value");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valid until");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "Coupon must be presented to receive discount");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limit of 1 coupon per purchase");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Not valid with other coupons, offers or discounts of any kind");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Valid only for Listing Name - Address");
	//Print deal
	define("DEAL_PRINTDEAL", "Print Deal");
	//deal done
	define("DEAL_DEALSDONE", "Deal Done");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Deals Done");
	//Left
	define("DEAL_LEFTAMOUNT", "Left");
	//SOLD OUT
	define("DEAL_SOLDOUT", "SOLD OUT");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Sorry, this deal doesn't exist or it was removed by owner");
	//at
	define("DEAL_AT", "at");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Friendly URL");
	//Select a listing
	define("DEAL_SELECTLISTING", "Select a listing");
	//Tagline for Deals
	define("DEAL_TAG", "Tagline for Deals");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibility");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "This deal will show up on");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "searches and nearby feature");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 hours / day");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Custom range");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Discount information");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Item Value");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Discount");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Value with discount");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Amount of deals");
	//deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "deal done until now");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "deals done until now");
	//left
	define("LANG_SITEMGR_LEFT", "left");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Please wait, loading...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Please wait. We are redirecting your login to complete this step...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Item Value is required.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." is required.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." can not be higher than 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Deals to offer is required.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Please enter a minor value on ".LANG_LABEL_DISC_AMOUNT." field.");
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed at");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "You can only directly link this deal to a listing if you select an account first");
    //Value
    define("DEAL_VALUE", "Value");
    //With discount
    define("DEAL_WITHCOUPON", "With discount");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Redeem by e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Sign In and Redeem");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Redeem and Print");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Redeem and Share");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Featured Deals");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Sign in using your Facebook");
    //To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "To Redeem using Facebook you need to connect using your Facebook account.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Redeem Statistics");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Redeem code");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Available");
    //Used
    define("DEAL_SITEMGR_USED", "Used");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Redeem using your current Facebook session");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Navbar configuration saved.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "There was a problem saving, try again please.");
    //At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "At least one item is required.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "You can not save repeated URLs.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "You can not save empty items.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "You can not save empty header or footer.");
    //Use
    define("DEAL_SITEMGR_USE", "Use");
	//Saving...
	define("LANG_DEAL_SAVING", "Saving...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "No redeem found.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "percentage");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "fixed value");
	
	# ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Please enter a label.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Please enter an URL.");
	//Add item
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Add item");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "New Item");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Module");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Site content");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Custom");
	//Save
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Save");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Save Item");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Label");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Use");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Please select one module or hit close to cancel.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Sorry, there is no custom site content created yet.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Create a new custom content");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Create custom pages in the site content section");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Use module URL");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Use custom page URL");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Edit, add, remove or change the order of items on the section below:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Header Navigation");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Footer Navigation");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Cancel the inclusion of this item?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Restore items");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Redeem without Facebook");
    //Don't have Facebook? Sign using your account.
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Don't have Facebook? Sign using your account.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Change Site");
    //Only
    define("LANG_ONLY2", "Only");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Deal");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Deals");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Deal Reviews");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "posted on Facebook and Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "posted on Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "posted on Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Posted on");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "deal checked out");
	//deal opened
	define("LANG_DEAL_OPENED", "deal opened");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Terms and Conditions");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "maximum 1000 characters");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Please provide a conditions with a maximum of 1000 characters.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "line");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Error importing to temporary table.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Invalid renewal date - line");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Invalid updated date - line");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "CSV file imported to temporary table.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Invalid e-mail - line");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Invalid password - line");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Invalid keyword (maximum ".MAX_KEYWORDS." keywords) - line");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Invalid keyword (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - line");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Invalid title - line");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Invalid start date - line");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Invalid end date - line");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Start date must be filled - line");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "End date must be filled - line");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Invalid start time - line");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Invalid end time - line");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Invalid start time format. Must be \"xx:xx\" - line");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Invalid end time format. Must be \"xx:xx\" - line");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Invalid start time mode. Must be \"AM\" or \"PM\" - line");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Invalid end time mode. Must be \"AM\" or \"PM\" - line");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Invalid start time mode. Must be \"24\" - line");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Invalid end time mode. Must be \"24\" - line");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Location and system default location are differents - line");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Invalid latitude. Must be numeric between -90 and 90 - line");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Invalid longitude. Must be numeric between -180 and 180 - line");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "No CSV Files in Import Folder.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "The number of columns in the following line(s) are wrong:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total lines read:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV header does not match - it has more fields that it is allowed");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV header does not match at field(s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "account rolled back");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "accounts rolled back");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "item rolled back");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "items rolled back");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Find what you are Looking for...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Find us on LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Find us on Facebook");
	//Links
	define("LANG_LINKS", "Links");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contact");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Follow us on Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Follow us");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Results per page");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Showing results");
	//to
	define("LANG_PAGING_SHOWING_TO", "to");
	//of
	define("LANG_PAGING_SHOWING_OF", "of");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Pages");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "You're nearly done.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "It was not possible to export. Please check your SugarCRM connection information on your directory.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Wrong eDirectory Key.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Listing Owner");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Review Title");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Event Owner");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Classified Owner");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Article Author");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.yoursite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "youremail@yoursite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitor");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Category");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Category 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Category 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Category 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Category 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Summary View");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Detail View");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "This content is illustrative");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Send to Phone");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Click to Call");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Message successfully sent!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Send info about this ".LISTING_FEATURE_NAME." to a phone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Enter your phone to call the ".LISTING_FEATURE_NAME." owner with no costs.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Phone is required.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Please, type a valid phone number.");
	//Call
	define("LANG_TWILIO_CALL", "Call");
	//Calling
	define("LANG_TWILIO_CALLING", "Calling");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Phone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extension");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activate");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Your validation code is:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Your phone number was activated!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Phone number successfully deleted!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Click to Call not available for this ".LISTING_FEATURE_NAME);
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Tips for the Item Click to Call");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "You need to activate the phone number below in order to allow the users to contact you directly through the directory.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Enter your phone number and click in Activate.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "A message with your activation code will be shown. Take note of this code and wait for the activation phone call.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "After activate your phone number, click in Save to finish the process.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "For numbers outside the USA, you need to put your country code first.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "Only numbers from USA are accepted.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Click to Call\" report");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direction");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "From");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Start Time");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "End Time");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Duration (seconds)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "No reports available.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activated by");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Activation failed. Please, try again.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Account is not active.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Trial account does not support this feature.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Incoming call rejected due to inactive account.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Invalid URL format.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP retrieval failure.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP connection failure.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protocol violation.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP bad host name.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP too many redirects.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Document parse failure.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Invalid Twilio Markup XML version.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "The root element must be Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Schema validation warning.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Invalid Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Internal Failure.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Cannot Dial out from a Dial Call Segment.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Invalid method value.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Invalid timeout value.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Invalid hangupOnStar value.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Invalid callerId value.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Invalid nested element.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Invalid timeLimit value.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Invalid method value.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Invalid sendDigits value.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Invalid phone number format.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Invalid phone number.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Forbidden phone number.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Invalid muted value.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Invalid endConferenceOnExit value.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Invalid startConferenceOnEnter value.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Invalid waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Invalid waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Invalid beep value.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Invalid Conference Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Invalid Conference Name.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Invalid Verb used in waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Invalid finishOnKey value.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Invalid method value.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Invalid timeout value.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Invalid numDigits value.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Invalid nested verb.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Invalid voice value.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Invalid loop value.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Invalid Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Invalid loop value.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Invalid Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Invalid loop value.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Invalid voice value.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Invalid text.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Invalid method value.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Invalid timeout value.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Invalid maxLength value.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Invalid finishOnKey value");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Invalid method value.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Invalid length value.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalid \"To\" attribute.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalid \"From\" attribute.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Invalid Body.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Invalid Method attribute.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Invalid statusCallback attribute.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Document retrieval limit reached.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS send rate limit exceeded.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "From phone number not SMS capable.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS Reply message limit exceeded.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Invalid Verb for SMS Reply.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Invalid To phone number for Trial mode.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Unknown parameters.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Invalid FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permission Denied.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Method not allowed.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Account not active.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "No Called number specified.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Called number is a premium number.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "International calling not enabled.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Invalid URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Invalid SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Invalid IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Invalid Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Invalid Method.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Caller phone number not verified.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Invalid Called Phone Number.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Invalid Caller Phone Number.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Caller phone number is required.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Called Phone Number cannot be reached.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Account not authorized to call phone number.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Account not allowed to call phone number.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Phone number does not appear to be valid.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Invalid ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Invalid call state.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Invalid Phone Number.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Invalid Url.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Invalid Method");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Inbound Phone number not available to trial account.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Cannot set VoiceFallbackUrl without setting Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Cannot set SmsFallbackUrl without setting SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "This Phone Number type does not support SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Phone number already validated on your account.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Invalid area code.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "No phone numbers found in area code.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Phone number already validated on another account.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Invalid CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Resource not available.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Invalid callback url.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Invalid transcription type.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid is required.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Phone number is not a valid SMS-capable inbound phone number.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Message body is required.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "The source 'from' phone number is required to send an SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "The destination 'to' phone number is required to send an SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Maximum SMS body length is 160 characters");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "The \"From\" phone number provided is not a valid, SMS-capable inbound phone number for your account.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "The Sandbox number can send messages only to verified numbers.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Facebook comments");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Facebook comments not available for this ".LISTING_FEATURE_NAME);
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "You can also moderate your comments by going to ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Invalid API key.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Missing parameter: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Invalid module name.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Module disabled.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Missing parameter: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API disabled.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Swimming Pool");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Bedroom(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Bathroom(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Level(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Property Type");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Purpose");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Price");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Built In");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Square Feet");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Office");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Laundry Room");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Central Air Conditioning");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Dining Room");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garage");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Garbage Disposal");