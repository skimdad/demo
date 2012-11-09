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
	# * FILE: /lang/ge_ge.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# CLOCK TYPE
	# options: 24 or 12
	# ----------------------------------------------------------------------------------------------------
	define("CLOCK_TYPE", 24);

	# ----------------------------------------------------------------------------------------------------
	# DATE/TIME
	# ----------------------------------------------------------------------------------------------------
	//january,february,march,april,may,june,july,august,september,october,november,december
	define("LANG_DATE_MONTHS", "Januar,Februar,März,April,Mai,Juni,Juli,August,September,Oktober,November,Dezember");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "Sonntag,Montag,Dienstag,Mittwoch,Donnerstag,Freitag,Samstag");
	//year
	define("LANG_YEAR", "jahr");
	//years
	define("LANG_YEAR_PLURAL", "jahre");
	//month
	define("LANG_MONTH", "monat");
	//months
	define("LANG_MONTH_PLURAL", "monate");
	//day
	define("LANG_DAY", "tag");
	//days
	define("LANG_DAY_PLURAL", "tage");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "j");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "t");
	//Hour
	define("LANG_LABEL_HOUR", "Stunde");
	//Minute
	define("LANG_LABEL_MINUTE", "Minute");
	// DATE FORMAT - SET JUST ONE FORMAT
	// Y - numeric representation of a year with 4 digits (xxxx)
	// m - numeric representation of a month with 2 digits (01 - 12)
	// d - numeric representation of a day of the month with 2 digits (01 - 31)
	define("DEFAULT_DATE_FORMAT", "d/m/Y");

	# ----------------------------------------------------------------------------------------------------
	# ZIPCODE
	# ----------------------------------------------------------------------------------------------------
	//ZIPCODE_UNIT - Available just for: mile or km
	define("ZIPCODE_UNIT", "km");
	//mile
	define("ZIPCODE_UNIT_LABEL", "km");
	//miles
	define("ZIPCODE_UNIT_LABEL_PLURAL", "km");
	//zipcode
	define("ZIPCODE_LABEL", "postleitzahl");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "F dS, Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Haben Sie eine Frage zu Video-Snippet-Code? Klicken Sie hier.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Sie verwenden eine ältere Version des Internet Explorer, dass die volle Funktionalität einiger Funktionen beeinflussen können. Wir empfehlen Ihnen, eine neuere Version von Internet Explorer zu aktualisieren.");
	//N/A
	define("LANG_NA", "k.A.");
	//characters
	define("LANG_LABEL_CHARACTERES", "zeichen");
	//by
	define("LANG_BY", "von");
	//in
	define("LANG_IN", "in");
	//Read More
	define("LANG_READMORE", "Weiter lesen");
	//More
	define("LANG_MORE", "mehr");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Nach Kategorie suchen");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Nach Standort suchen");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Nach Einträge suchen");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Nach Ereignisse suchen");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Nach Anzeigen suchen");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Nach Angebote suchen");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Nach Einträge suchen");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Nach Beiträge suchen");
	//show
	define("LANG_SHOW", "anzeigen");
	//hide
	define("LANG_HIDE", "verbergen");
	//Bill to
	define("LANG_BILLTO", "Rechnung an");
	//Payable to
	define("LANG_PAYABLETO", "Zahlbar im");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Erstellungsdatum");
	//Expire Date
	define("LANG_EXPIREDATE", "Ablaufdatum");
	//Questions
	define("LANG_QUESTIONS", "Fragen");
	//Please call
	define("LANG_PLEASECALL", "Bitte wenden Sie sich telefonisch an");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informationen zur Rechnung");
	//Payment Date
	define("LANG_PAYMENTDATE", "Zahlungstermin");
	//None
	define("LANG_NONE", "Kein");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Angepasste Rechnung");
	//Locations
	define("LANG_LOCATIONS", "Standorte");
	//Close
	define("LANG_CLOSE", "Schließen");
	//Close this window
	define("LANG_CLOSEWINDOW", "Fenster schließen");
	//from
	define("LANG_FROM", "von");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Informationen zur Transaktion");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Im manuellen Vorgänge sind Teilsumme und Steuern nicht berechnet.");
	//creditcard
	define("LANG_CREDITCARD", "Kreditkarte");
	//Join Now!
	define("LANG_JOIN_NOW", "Jetzt anmelden!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Erstellen Sie Ihr Profil");
	//More Information
	define("LANG_MOREINFO", "Weitere Informationen");
	//and
	define("LANG_AND", "und");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Autoteile");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Reifen");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Motorreparatur");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Kategorien und Unterkategorien");
	//per
	define("LANG_PER", "pro");
	//each
	define("LANG_EACH", "jede");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "Impressionen");
	//Add
	define("LANG_ADD", "Hinzufügen");
	//Manage
	define("LANG_MANAGE", "Verwalten");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "Impressionen zu meinem bezahlten Guthaben von");
	//Section
	define("LANG_SECTION", "Abschnitt");
	//General Pages
	define("LANG_GENERALPAGES", "Allgemeine Seiten");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "In neuem Fenster öffnen");
	//No
	define("LANG_NO", "Nein");
	//Yes
	define("LANG_YES", "Ja");
	//Dear
	define("LANG_DEAR", "Sehr geehrte(r) Herr/Frau");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Straße, Postfach");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Hausnummer, Wohneinheit, Etage etc.");
	//or
	define("LANG_OR", "oder");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "So 8:00 - 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Mo 8:00 - 21:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Di 8:00 - 21.00");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Zusatzfelder");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Anlagen");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Automatische anmelden");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Alle auswählen/abwählen");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Rechnungsinformationen");
	//Default
	define("LANG_BUSINESS", "Standardmäßig");
	//on Listing
	define("LANG_ON_LISTING", "bei Eintrag");
	//on Event
	define("LANG_ON_EVENT", "bei Ereignis");
	//on Banner
	define("LANG_ON_BANNER", "bei Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "bei Anzeige");
	//on Article
	define("LANG_ON_ARTICLE", "bei Artikel");
	//Listing Name
	define("LANG_LISTING_NAME", "Name des Eintrags");
	//Event Name
	define("LANG_EVENT_NAME", "Name der Ereignis");
	//Banner Name
	define("LANG_BANNER_NAME", "Name des Banners");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Name der Anzeige");
	//Article Name
	define("LANG_ARTICLE_NAME", "Name des Artikels");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Häufig gestellte Fragen");
	//click to crop image
	define("LANG_CROPIMAGE", "click here to crop the image");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Haben Sie nicht gefunden Ihre Antwort? Kontaktieren Sie uns.");
	//Active
	define("LANG_LABEL_ACTIVE", "Aktiv");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Ausgesetzt");
	//Expired
	define("LANG_LABEL_EXPIRED", "Abgelaufen");
	//Pending
	define("LANG_LABEL_PENDING", "Ausstehend");
	//Received
	define("LANG_LABEL_RECEIVED", "Erhalten");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Promotionscode");
	//Account
	define("LANG_LABEL_ACCOUNT", "Konto");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Konto ändern");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Name oder Titel");
	//Name
	define("LANG_LABEL_NAME", "Name");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Erste, Letzter");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Seitenname");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Zusammenfassende Beschreibung");
	//Category
	define("LANG_LABEL_CATEGORY", "Kategorie");
	//Category
	define("LANG_CATEGORY", "Kategorie");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Kategorien");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Kategorien");
	//Country
	define("LANG_LABEL_COUNTRY", "Land");
	//Region
	define("LANG_LABEL_REGION", "Region");
	//State
	define("LANG_LABEL_STATE", "Staat");
	//City
	define("LANG_LABEL_CITY", "Stadt");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Nachbarschaft");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Länder");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regionen");
	//States
	define("LANG_LABEL_STATE_PL", "Staaten");
	//Cities
	define("LANG_LABEL_CITY_PL", "Städte");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Nachbarschaften");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Hinzufügen einer neuen Region");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Hinzufügen einer neuen Staat");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Hinzufügen einer neuen Stadt");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Hinzufügen einer neuen Nachbarschaft");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Wählen Sie einen vorhandene Region");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Wählen Sie einen bestehenden Staat");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Wählen Sie einen vorhandenen Stadt");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Wählen Sie einen vorhandenen Nachbarschaft");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Keine Standort gefunden");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Erneuerung");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Datum der Erneuerung");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Straße");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Internetadresse");
	//Phone
	define("LANG_LABEL_PHONE", "Telefon");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Langbeschreibung");
	//Status
	define("LANG_LABEL_STATUS", "Status");
	//Level
	define("LANG_LABEL_LEVEL", "Stufe");
	//Empty
	define("LANG_LABEL_EMPTY", "Leer");
	//Start Date
	define("LANG_LABEL_START_DATE", "Startdatum");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Startdatum");
	//End Date
	define("LANG_LABEL_END_DATE", "Enddatum");
	//End Date
	define("LANG_LABEL_ENDDATE", "Enddatum");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Ungültiges Datum");
	//Start Time
	define("LANG_LABEL_START_TIME", "Startzeit");
	//End Time
	define("LANG_LABEL_END_TIME", "Endzeit");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Unbegrenzt");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Typ wählen");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Kategorie wählen");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Verbleibende Zeit");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Zum Angebot");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Kein Anzubieten");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Anzubieten wählen");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Name des Ansprechpartners");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Name des Ansprechpartners");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Telefonnummer des Ansprechpartners");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Faxnummer des Ansprechpartners");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-Mail-Adresse des Ansprechpartners");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Adresse");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Benachrichtigen Sie mich über Einschätzungen von Unternehmen und Verkehr.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Rechnung");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Rechnung #");
	//Item
	define("LANG_LABEL_ITEM", "Eintrag");
	//Items
	define("LANG_LABEL_ITEMS", "Einträge");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Zusatzkategorie");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Rabattschlüssel");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Eintrag-Preis");
	//Amount
	define("LANG_LABEL_AMOUNT", "Betrag");
	//Tax
	define("LANG_LABEL_TAX", "Steuer");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Zwischensumme");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Schecks ausstellen für");
	//Total
	define("LANG_LABEL_TOTAL", "Gesamt");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Titel");
	//Caption
	define("LANG_LABEL_CAPTION", "Überschrift");
	//impressions
	define("LANG_IMPRESSIONS", "Impressionen");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Impressionen");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Durch Impressionen");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Durch Zeitraum");
	//Date
	define("LANG_LABEL_DATE", "Datum");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Ihre E-Mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Betreff");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Zusätzliche Nachricht");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Zahlungsart");
	//Notes
	define("LANG_LABEL_NOTES", "Notizen");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "So schnell und einfach!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Schreiben Überprüfunge, Kommentare im Blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Schreiben Überprüfunge");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Schon dabei?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Profitieren Sie von unseren Diensten!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Testpasswort");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Passwort vergessen?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Zusammenfassung");
	//Detail
	define("LANG_LABEL_DETAIL", "Einzelansicht");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(E-Mail Ihres Freundes)");
	//From
	define("LANG_LABEL_FROM", "Von");
	//To
	define("LANG_LABEL_TO", "An");
	//to
	define("LANG_LABEL_DATE_TO", "an");
	//Last
	define("LANG_LABEL_LAST", "Letzter");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Letzter");
	//day
	define("LANG_LABEL_DAY", "tag");
	//days
	define("LANG_LABEL_DAYS", "tage");
	//New
	define("LANG_LABEL_NEW", "Neuer");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Neuer FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Typ");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Durchklicken");
	//Added
	define("LANG_LABEL_ADDED", "Hinzugefügt");
	//Add
	define("LANG_LABEL_ADD", "Hinzufügen");
	//rating
	define("LANG_LABEL_RATING", "bewertung");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "bewertung");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Prüfer");
	//System
	define("LANG_LABEL_SYSTEM", "System");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Anmelden für RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Passwortstärke");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Bezeichnung des Artikels");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO-Beschreibung");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO Keywords");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "keine Zeilenumbrüche erlaubt");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separate elemente mit komma (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Hier klicken, um die SEO-Informationen für den Eintrag zu bearbeiten");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO erfolgreich aktualisiert!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Zur Ansicht des Artikels hier klicken");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Zur Bearbeitung des Artikels hier klicken");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Zur Hinzufügung/Bearbeitung der Fotogalerie für den Artikel hier klicken");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Keine Fotogalerie für den Artikel verfügbar");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Zur Ansicht der Berichte zum Artikel hier klicken");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Historie zum Artikel");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Keine Historie zum Artikel verfügbar");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Zum Löschen des Artikels hier klicken");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Zur Ansicht des Banners hier klicken");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Zur Bearbeitung des Banners hier klicken");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Zur Ansicht der Berichte zum Banner hier klicken");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Historie zum Banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Keine Historie zum Banner verfügbar");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Zum Löschen des Banners hier klicken");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Titel der Anzeige");
	//Click here to
	define("LANG_MSG_CLICKTO", "Hier klicken für");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Zur Ansicht der Anzeige hier klicken");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Zur Bearbeitung der Anzeige hier klicken");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Zur Hinzufügung/Bearbeitung der Fotogalerie für die Anzeige hier klicken");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Keine Fotogalerie für die Anzeige verfügbar");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Zur Ansicht der Berichte zur Anzeige hier klicken");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Zur Feineinstellung der Karte für den Standort der Anzeige hier klicken");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Feineinstellung der Karte für die Anzeige nicht verfügbar");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Historie zur Anzeige");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Keine Historie zur Anzeige verfügbar");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Zum Löschen der Anzeige hier klicken");
	//Event Title
	define("LANG_EVENT_TITLE", "Titel der Ereignis");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Zur Ansicht der Ereignis hier klicken");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Zur Bearbeitung der Ereignis hier klicken");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Zur Hinzufügung/Bearbeitung der Fotogalerie für diese Ereignis hier klicken");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Keine Fotogalerie für die Ereignis verfügbar");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Zur Ansicht der Berichte zur Ereignis hier klicken");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Zur Feineinstellung der Karte für den Standort der Ereignis hier klicken");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Feineinstellung der Karte für die Ereignis nicht verfügbar");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Historie zur Ereignis");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Keine Historie zur Ereignis verfügbar");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Zum Löschen der Ereignis hier klicken");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Titel der Galerie");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Zur Ansicht der Galerie hier klicken");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Zur Bearbeitung der Galerie hier klicken");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Zum Löschen der Gallerie hier klicken");
	//Listing Title
	define("LANG_LISTING_TITLE", "Titel des Eintrags");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Zur Ansicht des Eintrags hier klicken");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Zur Bearbeitung des Eintrags hier klicken");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Zur Hinzufügung/Bearbeitung der Fotogalerie für diesen Einträg hier klicken");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Keine Fotogalerie für den Einträg verfügbar");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Zur Änderung der Anzubieten für den Einträg hier klicken");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Kein Anzubieten für den Eintrag verfügbar");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Zur Ansicht der Berichte zum Eintrag hier klicken");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Zur Feineinstellung der Karte für den Standort des Eintrags hier klicken");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Feineinstellung der Karte für den Eintrag nicht verfügbar");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Adresse nicht gefunden.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Bitte bearbeiten Sie Ihren Eintrag.");	
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Zur Ansicht der Überprüfunge zum Eintrag hier klicken");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Keine Überprüfunge für den Eintrag verfügbar");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Historie zum Eintrag");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Keine Historie zum Artikel verfügbar");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Zum Löschen des Eintrags hier klicken");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Speichern");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Weitere Informationen");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Versuchen Sie, etwas beschreibend, wie \"10% off Verwendung unseres Produkts\" oder \"3 für den Preis von zwei auf unser Produkt\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Geben Sie den Wert der Sache / Dienstleistung Sie anbieten. Wählen Sie einen Rabatt geben (Festwert oder Prozentsatz), und geben Sie den jeweiligen Wert. Überprüfen Sie die Berechnung und dann geben Sie uns die Anzahl der Angebote die Sie machen möchten.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Bitte seien Sie sicher Bild die richtige Größe ist, bevor Sie es hochladen, sonst wird das Bild wahrscheinlich gestreckt, um die Seite passen und die Bildqualität beeinträchtigt werden wird.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Jedes Anzubieten muss, um eine Eintrag verknüpft werden, damit sie auf dem Gelände aktiv.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Mitarbeiter mit der eintrag");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Bitte geben Sie Ihre Titel und warte auf Vorschläge der Verbände zur Verfügung.");
	//Empty
	define("LANG_EMPTY", "Leere");
	//Cancel
	define("LANG_CANCEL", "Abbrechen");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Brauch Zeitraum");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Fester Wert Rabatt");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Prozentualen Rabatt");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Wert mit Rabatt");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Rabatt (Berechnet)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Wie viele Angebote möchten Sie bieten");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "An Eintrag");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Wählen Sie ein Eintrag");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Sie können nicht anders Angebote das gleiche Eintrag.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Angebote erfolgreich aktualisiert!");
	//Options
	define("LANG_LABEL_OPTIONS", "Optionen");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Titel der Anzubieten");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Zur Ansicht der Anzubieten hier klicken");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Zur Bearbeitung der Anzubieten hier klicken");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Zum Löschen der Anzubieten hier klicken");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Gehen Sie zu \"Einträge\" und klicken Sie auf das Angebotessymbol zum Eintrag, bei dem Sie die Anzubieten hinzufügen wollen. Wählen Sie eine Anzubieten zur Hinzufügung zu Ihrem Eintrag und Schaltung dieser.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Die Teilbeträge werden bis zum Ablauf Ihrer Kreditkarte abgebucht");
	//The installments will be recurring until your credit card expiration (maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "höchstens 36 Teilbeträge");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "SEO-Zentrale");
	//View
	define("LANG_LABEL_VIEW", "Ansicht");
	//Edit
	define("LANG_LABEL_EDIT", "Bearbeiten");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galerie");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Traffic-Berichte");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Offen");
	//Paid
	define("LANG_LABEL_PAID", "Bezahlt");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Warten auf Zahlung Genehmigung");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Unter Kritik");
	//Available
	define("LANG_LABEL_AVAILABLE", "Verfügbar");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Im Streitfall");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Zurückgezahlt");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Abgebrochen");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transaktion");
	//Delete
	define("LANG_LABEL_DELETE", "Löschen");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Feineinstellung der Karte");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Karte verbergen");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Karte anzeigen");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Drucken");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Ausstehende Genehmigung");
	//Image
	define("LANG_LABEL_IMAGE", "Bild");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Bilder");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Erforderliches Feld");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Bitte geben Sie alle erforderlichen Felder aus.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Konteninformationen");
	//Username
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Aktuelles Passwort");
	//Password
	define("LANG_LABEL_PASSWORD", "Passwort");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Generate Password");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Neues Passwort");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Passwort erneut eingeben");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Passwort erneut eingeben");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Neues Passwort erneut eingeben");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Informationen");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Datum der Veröffentlichung");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Kalender");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Freundliche URL");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Zum Beispiel");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Bildquelle");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Bildattribut");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Bildüberschrift");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Kurzbeschreibung");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Keywords für die Suche");
	//maximum
	define("LANG_LABEL_MAX", "max");
	//keywords
	define("LANG_LABEL_KEYWORDS", "keywords");
	//Content
	define("LANG_LABEL_CONTENT", "Inhalt");
	//Code
	define("LANG_LABEL_CODE", "Code");
	//free
	define("LANG_FREE", "GRATIS");
	//free
	define("LANG_LABEL_FREE", "gratis");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Ziel-URL");
	//Script
	define("LANG_LABEL_SCRIPT", "Skript");
	//File
	define("LANG_LABEL_FILE", "Datei");
	//Warning
	define("LANG_LABEL_WARNING", "Warnung");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Anzeige URL (optional)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Beschreibung Zeile 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Beschreibung Zeile 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Standort");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Adresse (optional)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Adresse (Optional)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Detaillierte Beschreibung");
	//Price
	define("LANG_LABEL_PRICE", "Preis");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Preise");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Kontaktdaten");
	//Language
	define("LANG_LABEL_LANGUAGE", "Sprache");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Wählen Sie die gewünschte Sprache, in der Sie kontaktiert werden wollen (sofern notwendig).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Vorname");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Vorname");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Nachname");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Nachname");
	//Company
	define("LANG_LABEL_COMPANY", "Unternehmen");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Adresszeile 1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Adresszeile 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Breitengrad");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Länge");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Nicht gefunden. Bitte, versuchen Sie besser Ihren Standort angeben.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Die folgenden Felder enthalten Fehler:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Breitengrad muss eine Zahl zwischen -90 und 90 sein.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Länge muss eine Zahl zwischen -180 und 180 liegen.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Name des Standortes");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Datum der Ereignis");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Beschreibung");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Hilfeinformationen");
	//Text
	define("LANG_LABEL_TEXT", "Text");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Bild hinzufügen");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Bild hinzufügen");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Bildüberschriften bearbeiten");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Bilddatei");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Miniaturüberschrift");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Bildüberschrift");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Bitte beachten Sie, dass der Upload je nach Größe der Datei und Geschwindigkeit Ihrer Internetverbindung einige Minuten dauert. Wird in dieser Zeit die Schaltfläche Aktualisieren gedrückt oder diese Seite verlassen, wird der Upload abgebrochen.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Video Snippet Code");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Weitere Datei hinzufügen");
	//Attention
	define("LANG_LABEL_ATTENTION", "Achtung");
	//Source
	define("LANG_LABEL_SOURCE", "Quelle");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Geschäftszeiten");
	//Default
	define("LANG_LABEL_DEFAULT", "Standard");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Zahlungsmethode");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Per Kreditkarte");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Über PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Über SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Über Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Rechnung drucken und Scheck per Post zusenden");
	//Headline
	define("LANG_LABEL_HEADLINE", "Überschrift");
	//Offer
	define("LANG_LABEL_OFFER", "Angebot");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Bedingungen");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Anzubieten datum");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Bild");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Druckbare anzubieten");
	//Our HTML template based Deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Unsere HTML-Vorlage für anzubieten");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Vervollständigen Sie die obigen Felder und fügen Sie ein Bild oder Logo ein (JPG oder GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Ein anzubieten, die von Ihnen statt");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Bild als JPG oder GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Bezeichnung des Kommentars");
	//Comment
	define("LANG_LABEL_COMMENT", "Kommentar");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Angenommen");
	//Approved
	define("LANG_LABEL_APPROVED", "Genehmigt");
	//Success
	define("LANG_LABEL_SUCCESS", "Erfolgreich");
	//Completed
	define("LANG_LABEL_COMPLETED", "Abgeschlossen");
	//Y
	define("LANG_LABEL_Y", "J");
	//Failed
	define("LANG_LABEL_FAILED", "Fehlgeschlagen");
	//Declined
	define("LANG_LABEL_DECLINED", "Abgelehnt");
	//failure
	define("LANG_LABEL_FAILURE", "Erfolglos");
	//Canceled
	define("LANG_LABEL_CANCELED", "Abgebrochen");
	//Error
	define("LANG_LABEL_ERROR", "Fehler");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Transaktionscode");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Registrierungs-ID");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "Transaktionshistorie");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Authorisationscode");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Transaktionsstatus");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Transaktionsfehler");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Monatlicher Rechnungsbetrag");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transaktions-OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Jährlicher Rechnungsbetrag");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Rechnungsbetrag");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "Transaktions-ID");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Empfangs-ID");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Registrierungs-ID");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "Transaktionsauftrags-ID");
	//your
	define("LANG_LABEL_YOUR", "ihr(e)");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Tätigen Sie Ihre");
	//Payment
	define("LANG_LABEL_PAYMENT", "Zahlung");
	//History
	define("LANG_LABEL_HISTORY", "Historie");
	//Sign in
	define("LANG_LABEL_LOGIN", "Anmeldung");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transaktion abgebrochen");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Transaktionsbetrag");
	//Pay
	define("LANG_LABEL_PAY", "Zahlung");
	//Back
	define("LANG_LABEL_BACK", "Rückerstatten");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Gesamtpreis");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Per Rechnung zahlen");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrator");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informationen zur Rechnung");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Kartennummer");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Ablaufdatum der Karte");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Kartencode");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Kundeninformation");
	//zip
	define("LANG_LABEL_ZIP", "PLZ");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Bestellung vornehmen und fortfahren");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Allgemeine Informationen");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Telefonnummer");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "E-Mail-Adresse");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informationen zur Kreditkarte");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Ablaufdatum");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Kundeninformationen");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Ablauf der Gültigkeit");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Karteninhaber");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Kartentyp");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Kartenprüfnummer");
	//Province
	define("LANG_LABEL_PROVINCE", "Bundesland");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Postleitzahl");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Postleitzahl");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Datum wählen");
	//Found
	define("LANG_PAGING_FOUND", "Gefunden");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Gefunden");
	//record
	define("LANG_PAGING_RECORD", "eintrag");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "einträge");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Anzeige der Seite");
	//of
	define("LANG_PAGING_PAGEOF", "von");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "seiten");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Gehe zu Seite");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Wählen");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Ordnen nach:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Buchstaben");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Letzte Aktualisierung");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Erstellungsdatum");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Beliebte");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Bewertung");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Preis");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "vorherige Seite");
	//next page
	define("LANG_PAGING_NEXTPAGE", "nächste Seite");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "zurück");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "weiter");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Artikel erfolgreich hinzugefügt!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Banner erfolgreich hinzugefügt!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Anzeige erfolgreich hinzugefügt!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Ereignis erfolgreich hinzugefügt!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Galerie erfolgreich hinzugefügt!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Eintrag erfolgreich hinzugefügt!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Anzubieten erfolgreich hinzugefügt!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Artikel erfolgreich aktualisiert!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Banner erfolgreich aktualisiert!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Anzeige erfolgreich aktualisiert!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Ereignis erfolgreich aktualisiert!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Galerie erfolgreich aktualisiert!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Eintrag erfolgreich aktualisiert!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Anzubieten erfolgreich aktualisiert!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Feineinstellung der Karte erfolgreich aktualisiert!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Gallerie erfolgreich geändert!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Anzubieten wurde erfolgreich gelöscht!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Anzubieten erfolgreich geändert!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Banner erfolgreich gelöscht!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Ungültiges Bildformat. Bild bitte als JPG, GIF oder PNG einfügen.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Die Image-Datei ist zu groß.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Bitte versuchen Sie es mit einem anderen Bild versuchen.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Beigefügte Datei wurde abgelehnt. Ungültiges Dateiformat.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Zur Ansicht der Galerie hier klicken");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Zur Verwaltung der Bilder der Galerie hier klicken");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Bitte geben Sie Ihre E-Mail.");
	//username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-Mail wurde nicht gefunden.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Bitte versuchen Sie es erneut oder wenden Sie sich an den Kundendienst unter:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "System für vergessene Passwörter ist inaktiv.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Bitte wenden Sie sich an den Kundendienst unter:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Vielen Dank!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "An den Inhaber der Kontos wurde eine E-Mail mit Anweisungen zur Erstellung eines neuen Passwortes versendet");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Datei nicht gefunden!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Fehler! Kein Miniaturbild!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "In die Galerie wurden bislang keine Bilder heraufgeladen!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Zum Ausdrucken der Rechnung hier klicken");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Zur Detailansicht der Rechnung hier klicken");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(Betrag der Teilzahlung)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Unbezahlter Eintrag");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Kein Zahlvorgang erforderlich");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Zur Anzeige weiterer Einzelheiten zur Darstellung mit dem Mauszeiger über die Balken fahren)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Zur Anzeige der Darstellung auf den Berichtstyp klicken)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Zur Ansicht des Überprüfung hier klicken");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Zur Bearbeitung des Überprüfung hier klicken");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Zur Bearbeitung der Antwort hier klicken");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Zum Löschen des Überprüfung hier klicken");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Genehmigung des Seitenmanagers ausstehend");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Genehmigung des Seitenmanagers für den Überprüfung ausstehend");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Genehmigung des Seitenmanagers für die Antwort ausstehend");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Genehmigung des Seitenmanagers für den Überprüfung und die Antwort ausstehend");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Überprüfung bereits genehmigt");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Überprüfung und Antwort bereits genehmigt");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Ausstehende Genehmigung für Überprüfung");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Ausstehende Genehmigung für Antwort");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Überprüfung aktivieren");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Antwort aktivieren");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Ausstehende Genehmigung für Überprüfung und Antwort");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Überprüfung und Antwort aktivieren");
	//Reply
	define("LANG_REPLY", "Antworten");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Antwort");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Überprüfung und Antwort");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Überprüfung bearbeiten");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Antwort bearbeiten");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Überprüfung genehmigen");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Antwort genehmigen");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Antwort bereits genehmigt");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Überprüfung erfolgreich versendet!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Antwort erfolgreich versendet!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Bitte geben Sie eine gültige Antwort ein!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Bitte geben Sie einen gültigen Namen ein!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Bitte geben Sie eine gültige E-Mail-Adresse ein!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Bitte geben Sie eine gültige Stadt und ein gültiges Bundesland ein!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Bitte geben Sie einen gültigen Überprüfung Titel!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Bitte geben Sie einen gültigen Überprüfung ein!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Bitte wählen Sie eine Option oder klicken Sie Abbrechen.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Zur Beantwortung des Überprüfung hier klicken");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Zur Ansicht der Transaktion hier klicken");	
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-Mail muss zwischen");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "Zeichen bestehen und darf keine Leerzeichen enthalten.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Das Passwort muss aus");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Geben Sie Ihr Passwort hier ein, um dies zu ändern.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Das Passwort wird an die E-Mail-Adresse des Mitglieds versendet.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Bitte schreiben Sie Ihre E-Mail und Passwort für spätere Verwendung auf.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Bitte überprüfen Sie die Vertragsbedingungen.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Erfolgreich hinzugefügt!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Die Kategorie wurde bereits hinzugefügt");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Bitte wählen Sie eine gültige Kategorie");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Bitte wählen Sie zunächst ein Kategorie");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Sie können den Titel der Seite wählen, auf den direkt über den Webbrowser als statische HMTL-Seite zugegriffen wird. Der gewählte Titel der Seite darf nur aus alphanumerischen Zeichen (wie \"a-z\" und/oder \"0-9\") und dem Zeichen \"-\" anstelle von Leerzeichen bestehen.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Der Titel der Seite \"Autoreparatur John\" wird verfügbar über die URL:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Weitere Bilder können hinzugefügt werden");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "zur Galerie (sofern diese aktiv ist).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Max. Dateigröße");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .gif oder .png wird nicht unterstützt");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animiertes .gif wird nicht unterstützt.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Bitte stellen Sie sicher, dass Ihr Bild Dimensionen innerhalb der empfohlenen Pixelgrößen passen, sonst kann die Bildqualität erfolgen.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Zum Entfernen des vorhandenen Bildes Kästchen auswählen");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "max. 250 Zeichen");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "al massimo 100 caratteri");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "Zeichen verbleibend");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(einschließlich Leerzeichen und Zeilenumbrüche)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Fügen Sie bis zu");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "Keywords mit jeweils maximal 50 Zeichen ein.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Fügen Sie ein Keyword oder einen Keyword-Ausdruck je Zeile ein. Zum Beispiel:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Wählen Sie nur Unterkategorien, die direkt auf Ihre Art anwendbar.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Ihr Artikel erscheint automatisch auch in der Hauptkategorie für jede gewählte Unterkategorie.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "max. 25 Zeichen");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "max. 500 Zeichen");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Zulässige Dateiformate");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Zur Voransicht des Eintrags hier klicken");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Zur Voransicht der Ereignis hier klicken");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Zur Voransicht der Anzeige hier klicken");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Zur Voransicht des Artikels hier klicken");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Zur Voransicht des Banners hier klicken");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Zur Voransicht der Anzubieten hier klicken");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Zur Voransicht der Galerie hier klicken");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "max. 30 Zeichen");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Wählen Sie ein Land");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Wählen Sie eine Region");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Wählen Sie ein Staat");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Wählen Sie eine Stadt");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Wählen Sie ein Nachbarschaft");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Diese Informationen werden nicht öffentlich angezeigt)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Ihre Ereignis erscheint automatisch auch in der Hauptkategorie für jede gewählte Unterkategorie.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Wurde ein Video-Snippet-Code eingegeben, dann erscheint er in der Detailansicht");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Max unterstützte Videocodegröße");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Ist die Größe des Videocodes größer als die unterstützte Größe, wird diese angepasst.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Keine Überschrift für Anhang");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Zum Entfernen des vorhandenen Anhangs zum Eintrag Kästchen wählen");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Fügen Sie einen Ausdruck je Zeile ein. Zum Beispiel");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Zusatzkategorien/Unterkategorien kosten");
	//additional
	define("LANG_MSG_ADDITIONAL", "zusätzlich");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "jede. Treten Sie in Erscheinung!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Ihr Eintrag erscheint automatisch auch in der Hauptkategorie für jede gewählte Unterkategorie.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Wenn Sie neue Kategorien hinzufügen, wird Ihr einträge nicht in der Hauptkategorie der einzelnen Sub-Kategorie erscheinen Sie hat bis zum Bauleiter zustimmen.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Wenn Sie neue Kategorien hinzufügen, wird Ihr artikel nicht in der Hauptkategorie der einzelnen Sub-Kategorie erscheinen Sie hat bis zum Bauleiter zustimmen.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Wenn Sie neue Kategorien hinzufügen, wird Ihr anzeige nicht in der Hauptkategorie der einzelnen Sub-Kategorie erscheinen Sie hat bis zum Bauleiter zustimmen.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Wenn Sie neue Kategorien hinzufügen, wird Ihr ereignis nicht in der Hauptkategorie der einzelnen Sub-Kategorie erscheinen Sie hat bis zum Bauleiter zustimmen.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Fordern Sie die Berücksichtigung Ihres Eintrages für die folgenden Badges an.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Zur Auswahl des Datums hier klicken");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Klicken Sie auf");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "das Galeriesymbol");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "weiter unten, wenn Sie Fotos zu Ihrer Fotogalerie hinzufügen wollen.");
	//"Click on the" Angebote icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Klicken Sie auf");
	//Click on the "Angebote icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "das Anzubietensymbol");
	//Click on the Angebote icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "Sie können ein Anzubieten zu Ihrem Eintrag hinzufügen.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Sie können ein Anzubieten zu Ihrem Eintrag hinzufügen, indem Sie auf die Verknüpfung klicken");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "Anzubieten hinzufügen");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Alle Seiten ohne Artikelseiten");
	//All pages
	define("LANG_ALLPAGES", "Alle Seiten");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Kategorielose Suche");
	//Deal
	define("LANG_ICONPROMOTION", "anzubieten");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "An Freund senden");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "Zu den Favoriten hinzufügen");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "Entfernen von Favoriten");
	//print
	define("LANG_ICONPRINT", "drucken");
	//map
	define("LANG_ICONMAP", "karte");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Hinzufügen zu");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google Maps ist nicht verfügbar. Bitte wenden Sie sich an den Administrator.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Entfernen");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Bevorzugte Artikel");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Bevorzugte Anzeigen");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Bevorzugte Ereignisse");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Bevorzugte Einträge");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Bevorzugte Angebote");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Veröffentlicht");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Weitere Informationen");
	//Date
	define("LANG_EVENT_DATE", "Datum");
	//Time
	define("LANG_EVENT_TIME", "Zeit");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Anfahrtsinformationen erhalten");
	//Website
	define("LANG_EVENT_WEBSITE", "Website");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Telefonnummer");
	//More
	define("LANG_EVENT_MORE", "Mehr");
	//More Info
	define("LANG_EVENT_MOREINFO", "Weitere Informationen");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Alle Kategorien");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Alle Kategorien anzeigen");
	//More Info
	define("LANG_LISTING_MOREINFO", "Weitere Informationen");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "Telefonnummer anzeigen");
	//view fax
	define("LANG_LISTING_VIEWFAX", "Faxnummer anzeigen");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "Senden Sie eine E-Mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Für weitere Informationen hier klicken!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Vervollständigen Sie das Formular weiter unten, um mit uns in Kontakt zu treten.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Diese Eintrag kontaktieren");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Frage einreichen");
	//phone
	define("LANG_LISTING_LETTERPHONE", "telefonnummer");
	//fax
	define("LANG_LISTING_LETTERFAX", "faxnummer");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "website");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "bietet die folgenden Produkte und/oder Dienstleistungen:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Geschäftszeiten");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Kein Überprüfung für diesen Artikel gefunden!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Überprüfunge und Kommentare aus dem letzten Monat");
	//Review
	define("LANG_REVIEW", "Überprüfung");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Überprüfunge");
	//Reviews
	define("LANG_REVIEWTITLE", "Überprüfunge");
	//review
	define("LANG_REVIEWCOUNT", "Überprüfung");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "Überprüfunge");
	//check in
	define("LANG_CHECKINCOUNT", "Check-In");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "Check-Ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Siehe Check-Ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check-Ins von");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Kein check in für diesen Artikel gefunden!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Zugehörige Kategorien");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Unterkategorien");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Kommentare anzeigen");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Bewerten");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Besprechen Sie diesen Überprüfung als Erster!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Angeboten von");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Weitere Informationen");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Gültig von");
	//to
	define("LANG_PROMOTION_VALIDTO", "bis");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Anzubieten drucken");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Artikel");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Artikel");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banner");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Anzeige");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Anzeigen");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Ereignis");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Ereignisse");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Eintrag");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Einträge");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Anzubieten");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Angebote");
	//Send
	define("LANG_BUTTON_SEND", "Senden");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Registrieren");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Kategoriepfad anzeigen");
	//More info
	define("LANG_VIEWCATEGORY", "Mehr Infos");
	//No info found
	define("LANG_NOINFO", "Keine Information gefunden");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Gewählte Kategorie entfernen");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Fortfahren");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Nein, danke");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Ja, auch weiterhin.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Nein, Auftrag, ohne die Verpackung.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Erhöhen Sie Ihre Sichtbarkeit!");
	//Gift
	define("LANG_GIFT", "Geschenk");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Helfen Sie mit Ihrer Sichtbarkeit zu erhöhen, überprüfen unsere ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Website Statistiken!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Besucher pro Monat");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Option Benutzerdefiniert");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Abbrechen");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Anmelden");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Feineinstellung der Karte speichern");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Feineinstellung der Karte aufheben");
	//Next
	define("LANG_BUTTON_NEXT", "Weiter");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Per Kreditkarte zahlen");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Über PayPal bezahlen");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Über SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Suche");
	//Advanced Search
	define("LANG_BUTTON_ADVANCEDSEARCH", "Erweitert");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Ende");
	//Clear
	define("LANG_BUTTON_CLEAR", "Aufheben");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Ihren Artikel hinzufügen");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Ihre Anzeige hinzufügen");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Ihre Ereignis hinzufügen");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Ihren Eintrag hinzufügen");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Ihr Anzubieten hinzufügen");
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Konto Verwalten");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Inhalte Verwalten");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Sponsor Bereich");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Administrativen Bereich");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Verwaltungsabteilung");
	//Help
	define("LANG_BUTTON_HELP", "Hilfe");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Abmelden");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Absenden");
	//Update
	define("LANG_BUTTON_UPDATE", "Aktualisieren");
	//Back
	define("LANG_BUTTON_BACK", "Zurück");
	//Delete
	define("LANG_BUTTON_DELETE", "Löschen");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Vorgang abschließen");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Bitte geben Sie den Text, den Sie links im Bild sehen, in das Textfeld ein. Hierdurch werden automatische Kontaktanfragen verhindert.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Bild mit dem Bestätigungscode kann nicht angezeigt werden");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Bestätigungscode");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Bitte wählen Sie eine Bewertung für den Eintrag");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Betrugsversuch entdeckt! Bitte wählen Sie eine Bewertung für den Eintrag!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "Zur Einstellung eines Kommentars müssen \"Kommentar\" und \"Titel des Kommentars\" vervollständigt werden!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "Zur Einstellung eines Kommentars müssen \"Name\" und \"E-Mail\" vervollständigt werden!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Stadt, Staat\" erforderlich sind, um einen Kommentar zu hinterlassen!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Bitte geben Sie eine gültige E-Mail-Adresse ein!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Sie haben Ihre Meinung zu diesem Eintrag bereits mitgeteilt. Vielen Dank.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Vielen Dank für Ihre Rückmeldung!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Ihr Überprüfung wurde zur Genehmigung eingereicht.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Keine Zahlungsmethode gewählt!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Falsches Ablaufdatum für Kreditkarte. Bitte erneut versuchen.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Für erneuten Versuch hier klicken");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Zahlungstransaktionen werden möglicherweise nicht sofort angezeigt.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Nach Bearbeitung Ihrer Zahlungen erscheinen die Informationen zu Ihrer Transaktion");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "in Ihrer Transaktionshistorie.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "erscheint in");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "Das Zahlungs-Gateway ist gegenwärtig nicht verfügbar");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Die Zahlungdaten konnten nicht bestätigt werden");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Ein interner Gateway-Fehler trat auf");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Die Informationen zu Ihrer Transaktion werden angezeigt");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "in Ihrer Transaktionshistorie.");
	//in your
	define("LANG_MSG_IN_YOUR", "in Ihrer");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "Keine Transaktions-ID");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Systemfehler, bitte erneut versuchen.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Bitte alle erforderlichen Felder vervollständigen.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Es konnte keine Verbindung hergestellt werden.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Vielen Dank für die Einstellung Ihrer Einträge und Ihre Zahlung!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Der Seitenmanager wird Ihre Einträge prüfen und diese innerhalb von 2 Werktagen freischalten");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "Keine Antwort vom Zahlungs-Gateway");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Bei ausstehenden Zahlungen nimmt die Genehmigung 3 bis 4 Tage in Anspruch.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Verbindungsfehler");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Bitte korrekte PLZ eintragen");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Bitte korrekte Kartenprüfnummer eintragen");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Kartentyp und Kartenprüfnummer stimmen nicht überein.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "Transaktion nicht abgeschlossen.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Fehlernummer:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Kurzmeldung:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Detaillierte Meldung:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transaktion erfolgreich abgeschlossen");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Das Ablaufdatum der Karte muss in der Zukunft liegen");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Nach Bestätigung Ihrer Transaktion erscheinen die Informationen zu dieser bei");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "Ihrer Zahlungshistorie, nachdem Ihre Zahlung bearbeitet wurde.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "nachdem Ihre Zahlung bearbeitet wurde.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Keine Zahlung für Einträge erforderlich.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Zahlung für offene Rechnung");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Banner nach Impressionen und angepasste Rechnungen können einmalig bezahlt werden.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Banner nach Impressionen können einmalig bezahlt werden");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Anpasste Rechnungen können einmalig bezahlt werden.");
	//View Items
	define("LANG_VIEWITEMS", "Einträge anzeigen");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Bitte nicht das System für wiederkehrende Zahlungen verwenden.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Erneut versuchen!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Sämtliche Felder müssen vervollständigt werden.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Sie haben mehr als");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Bitte wenden Sie sich zur Prüfung an den Administrator.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Artikeloptionen");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Artikelverfasser");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL Artikelverfasser");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Artikelkategorien");
	//Banner Type
	define("LANG_BANNER_TYPE", "Bannertyp");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Banneroptionen");
	//Order Banner
	define("LANG_ORDER_BANNER", "Banner bestellen");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Nach Zeitraum");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Bannerdaten");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Skript Banner");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mit Script-Code anzeigen");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Skript anstelle des Bildes eingeben. Hier können Sie das Skript einfügen, mit dem das Banner über ein Affiliate-Programm oder ein externes Bannersystem angezeigt wird. Wenn das Feld \"Mit Skript-Code anzeigen\" gewählt wurde, muss nur das Feld \"Skript\" vervollständigt werden. Es müssen keine weiteren Felder vervollständigt werden.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Beim Upload von Skript-Bannern sind \"Ziel-URL\" und \"Traffic-Bericht Klickrate\" nicht aktiv.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Beim Upload von Dateien im Format SWF sind \"Ziel-URL\" und \"Traffic-Bericht Klickrate\" nicht aktiv");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Stufe der Anzeige");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Kategorie der Anzeige");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Stufe der Anzeige wählen");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Anzeigenoptionen");
	//Event Level
	define("LANG_EVENT_LEVEL", "Stufe der Ereignis");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Kategorien der Ereignis");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Kategorien der Ereignis");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Stufe der Ereignis wählen");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Ereignissoptionen");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Stufe des Eintrags");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Listing Typ");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Kategorien des Eintrags");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Bedges des Eintrags");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Vorbehaltlich der Genehmigung des Administrators.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Auswahl übernehmen");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Stufe des Eintrags wählen");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Eintragsoptionen");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "Das System zur Zahlungsfreigabe ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "Das Zahlungssystem iTransact Payment System ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "Das Zahlungssystem LinkPoint ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "Das Zahlungssystem PayFlow ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "Das Zahlungssystem PayPal ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "Das Zahlungssystem PayPalAPI ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "Das Zahlungssystem PSIGate ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "Das Zahlungssystem 2CheckOut Payment System ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "Das Zahlungssystem WorldPay ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "Das Zahlungssystem SimplePay ist gegenwärtig nicht verfügbar. Bitte wenden Sie sich an");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Upload-Warnung");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Datei erfolgreich hochgeladen!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Unzulässige Erweiterung oder falscher Dateityp!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Datei überschreitet zulässige Größe!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Verzeichniserstellung nicht erfolgreich!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Falsche Verzeichnisgenehmigung!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Unerwarteter Fehler!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Datei nicht gefunden oder hinzugefügt!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Datei bereits im Verzeichnis vorhanden!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Alle Standorte anzeigen");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Ausgewählte Standorte");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Im System sind keine Ausgewählte Standorte vorhanden.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Übersicht");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Standort auf der Karte");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Weitere Einträge");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Weitere Ereignisse");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Weitere Anzeigen");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Weitere Artikel");
	//"Operation not allowed: The deal" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Unzulässiger Vorgang: Die Anzubieten");
	//Operation not allowed: The deal (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "ist bereits mit dem Eintrag verknüpft");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Anhängig");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "Abgebrochen");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Failed");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Abgelehnt");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Unbekannt");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Success");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Klicken Sie auf \"Hinzufügen\", um Kategorien auswählen");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Klicken Sie auf \"Add Hauptkategorie\" oder \"Add Unterkategorie\" die Eingabe Ihres neuen Kategorien");
	//Add an
	define("LANG_ADD_AN", "Hinzufügen eines");
	//Add a
	define("LANG_ADD_A", "Hinzufügen eines");
	//on these sites
	define("LANG_ON_SITES", "auf diesen Websites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "auf dieser Site:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slideshow");
	//on
	define("LANG_SLIDESHOW_ON", "auf");
	//off
	define("LANG_SLIDESHOW_OFF", "aus");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Fotogalerie");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Hier klicken");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "für Slideshow. Zum Start der Slideshow können Sie auch auf ein beliebiges Foto klicken.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "weitere Fotos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Rabattschlüssel nicht vorhanden");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "ist nicht verfügbar.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "ist nicht verfügbar für diesen Eintragstyp.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "kann nicht zweifach verwendet werden.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "Wählen Sie bis zu");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "galerie.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galerien.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Titel ist ein erforderliches Feld.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Sprache ist ein erforderliches Feld.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Vorname ist ein erforderliches Feld.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Nachname ist ein erforderliches Feld.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Unternehmen ist ein erforderliches Feld.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Telefonnummer ist ein erforderliches Feld.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-Mail-Adresse ist ein erforderliches Feld.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Konto ist ein erforderliches Feld.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Seitenname ist ein erforderliches Feld.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Kategorie ist ein erforderliches Feld.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Kurzbeschreibung ist ein erforderliches Feld.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Ablauftyp ist ein erforderliches Feld.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Erneuerungsdatum ist ein erforderliches Feld.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Impressionen ist ein erforderliches Feld.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Datei ist ein erforderliches Feld.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Typ ist ein erforderliches Feld.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Überschrift ist ein erforderliches Feld.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Skript-Code eist ein erforderliches Feld.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Beschreibung 1 ist ein erforderliches Feld.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Beschreibung 2 ist ein erforderliches Feld.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Name ist ein erforderliches Feld.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Titel der Anzubieten ist erforderlich.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Angebot ist ein erforderliches Feld.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Startdatum ist ein erforderliches Feld.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Enddatum ist ein erforderliches Feld.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Text ist ein erforderliches Feld.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-Mail ist erforderlich.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Aktuelles Passwort\" nicht korrekt.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "\"Passwort\" ist ein erforderliches Feld.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Einwilligung zu Nutzungsbedingungen\" erforderlich.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Die folgenden Felder wurden nicht vervollständigt oder enthalten Fehler:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Titel - Bitte vervollständigen Sie das Feld");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Seitenname - Bitte vervollständigen Sie das Feld");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "von maximal");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "Kategorien zulässig.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Freundlicher Name der URL-Seite bereits in Gebrauch. Bitte anderen Seitennamen verwenden.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Seitenname enthält ungültige Zeichen");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "von maximal");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "Keywords zulässig");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Bitte fügen Sie Keywords mit jeweils maximal 50 Zeichen ein");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Bitte geben Sie ein gültiges \"Datum der Veröffentlichung\" ein.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Bitte geben Sie ein gültiges \"Startdatum\" ein");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Bitte geben Sie ein gültiges \"Enddatum\" ein.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "Da \"Enddatum\" musst größer als das \"Startdatum\" oder identisch mit diesem sein.");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "Da \"als zeit\" musst größer als das \"Start Zeit\" oder identisch mit diesem sein.");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "Das \"Enddatum\" kann nicht in der Vergangenheit liegen.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Bitte geben Sie eine gültige E-Mail-Adresse ein!");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Bitte geben Sie eine gültige \"URL\" ein.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Bitte geben Sie eine Beschreibung mit einer Länge von maximal 255 Zeichen ein.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Bitte geben Sie die Bedingungen mit einer Länge von maximal 255 Zeichen ein");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Bitte geben Sie ein gültiges Erneuerungsdatum ein.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Das Erneuerungsdatum muss in der Zukunft liegen.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Bitte geben Sie ein gültiges Ablaufdatum ein.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Das Ablaufdatum muss in der Zukunft liegen.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Beim Passwort sind keine Leerzeichen zulässig.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Bitte geben Sie ein Passwort ein mit einer Länge von maximal");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Bitte geben Sie ein Passwort ein mit einer Länge von mindestens");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Bitte geben Sie eine gültige E-Mail.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Leider können Sie nicht ändern diese Konten Informationen");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Das Passwort \"abc123\" ist nicht zulässig!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Die eingegebenen Passworte stimmen nicht überein. Bitte nehmen Sie die gleichen Eingaben in den Feldern \"Passwort\" and \"Passwort erneut eingeben\" vor.");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Leerzeichen sind nicht für E-Mail gestattet.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "Sonderzeichen sind nicht für E-Mail gestattet.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Bitte geben Sie eine E-Mail mit einem Maximum von");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Bitte geben Sie eine E-Mail mit einem Minimum an");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Bitte wählen Sie eine andere E-Mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Klicken Sie hier, wenn Sie nicht sehen Sie Ihre Kategorie");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Add Hauptkategorie");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Add Unterkategorie");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Kategorie Titel bereits reserviert!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Titel der Kategorie vorhanden!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Home");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Verwalten");
	//Add
	define("LANG_MENU_ADD", "Hinzufügen");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Sponsor Optionen");
	//Listings
	define("LANG_MENU_LISTING", "Einträge");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Eintrag hinzufügen");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Einträge verwalten");
	//Galleries
	define("LANG_MENU_GALLERY", "Galerien");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Galerie hinzufügen");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Galerien verwalten");
	//Events
	define("LANG_MENU_EVENT", "Ereignisse");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Ereignis hinzufügen");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Ereignisse verwalten");
	//Banners
	define("LANG_MENU_BANNER", "Banner");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Banner hinzufügen");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Banner verwalten");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Anzeigen");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Anzeige hinzufügen");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Anzeigen verwalten");
	//Articles
	define("LANG_MENU_ARTICLE", "Artikel");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Artikel hinzufügen");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Artikel verwalten");
	//Deals
	define("LANG_MENU_PROMOTION", "Angebote");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Anzubieten hinzufügen");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Angebote verwalten");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Werbung");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Seite nicht gefunden");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Wartung Page");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Sitemap");
	//Contact Us
	define("LANG_MENU_CONTACT", "Kontakt");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Zahlungsoptionen");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Zur Zahlung");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Zahlung vornehmen");
	//History
	define("LANG_MENU_HISTORY", "Historie");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Transaktionshistorie");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Rechnungshistorie");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Wählen Sie ein Thema");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Wählen Sie ein Farbschema");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Artikel suchen");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Anzeige suchen");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Ereignis suchen");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Eintrag suchen");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Anzubieten suchen");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Erweiterte Suche");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Suche");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Standort");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Wählen Sie ein Land");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Wählen Sie eine Region");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Wählen Sie ein Staat");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Wählen Sie eine Stadt");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Wählen Sie ein Nachbarschaft");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Kategorie");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Kategorie wählen");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Übereinstimmung");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Exakte Übereinstimmung");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Beliebiges Wort");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Alle Worte");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Eintragstyp");
	//from
	define("LANG_SEARCH_LABELFROM", "von");
	//to
	define("LANG_SEARCH_LABELTO", "bis");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "von");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Nach Keyword suchen");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Suche");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Bitte geben Sie nur Wörter mit mindestens [FT_MIN_WORD_LEN] Buchstaben für die Suche!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Vorgestellte");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Aktuelle Artikel");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Bevorstehende Ereignisse");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Vorgestellte Anzeigen");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Vorgestellte Artikel");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Vorgestellte Einträge");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Vorgestellte Angebote");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Alle Artikel anzeigen");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Alle Ereignisse anzeigen");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Alle Anzeigen anzeigen");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Alle Einträge anzeigen");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Alle Angebote anzeigen");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Dauern Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "So schnell und einfach!");
	//3 Steps
	define("LANG_THREESTEPS", "Nur 3 Schritt");
	//4 Steps
	define("LANG_FOURSTEPS", "Nur 4 Schritt");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Registrierung des Kontos");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Eintragsaktualisierung");
	//Order
	define("LANG_ORDER", "Bestellung");
	//Check Out
	define("LANG_CHECKOUT", "Zahlung");
	//Configuration
	define("LANG_CONFIGURATION", "Konfiguration");
	//Select a level
	define("LANG_SELECTPACKAGE", "Wählen Sie eine Ebene");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Profil-Optionen");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Verzeichniskonto");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Meine vorhandenen OpenID 2.0-Konto");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Meine vorhandenen Facebook-Konto");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Meine vorhandenen Google-Konto");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Haben Sie bereits ein Konto?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Nein, ich bin ein neuer Nutzer.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Ja, ich habe bereits ein Konto.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Anmeldung mit meinem vorhandenen Verzeichniskonto");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Anmeldung mit meinem vorhandenen OpenID 2.0-Konto");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Anmeldung mit meinem vorhandenen Facebook-Konto");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Anmeldung mit meinem vorhandenen Google-Konto");
	//Account Information
	define("LANG_ACCOUNTINFO", "Konteninformationen");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Weitere Informationen");
	//Please write down your username and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Bitte schreiben Sie Ihre E-Mail und Passwort für spätere Verwendung auf.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-Mail muss eine gültige E-Mail zwischen sein");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "bis");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "Zeichen ohne Leerzeichen bestehen.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Das Passwort muss aus");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "bis");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "Zeichen ohne Leerzeichen bestehen.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Ich stimme den Nutzungsbedingungen zu");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Wollen Sie Werbung bei uns?");
	//Buy a link
	define("LANG_BUY_LINK", "Link kaufen");
	//Back to Top
	define("LANG_BACKTOTOP", "Zurück nach oben");
	//Back to
	define("LANG_BACKTO", "Zurück nach ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoriten");
	//view summary
	define("LANG_VIEWSUMMARY", "zusammenfassung anzeigen");
	//view detail
	define("LANG_VIEWDETAIL", "Detailansicht anzeigen");
	//Advertisers
	define("LANG_ADVERTISER", "Werbepartner");
	//Order Now!
	define("LANG_ORDERNOW", "Jetzt bestellen!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Bitte warten, lädt noch...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Teilsumme Betrag");
	//Subtotal
	define("LANG_SUBTOTAL", "Zwischensumme");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Gesamt Steuer");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Gesamtpreis");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoriten");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Keine Favoriten gefunden!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Suchergebnisse für");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Zugehörige Suche");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Durchsuchen nach Abschnitt");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Keyword");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Keyword eingeben");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Keyword oder Name des Eintrags eingeben");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Keyword oder Titel der Anzubieten eingeben");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Keyword oder Titel der Ereignis eingeben");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Keyword oder Titel der Anzeige eingeben");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Keyword oder Titel des Artikels eingeben");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Wo");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Adresse, Stadt, Bundesland oder Postleitzahl)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Auf der Suche nach einen Standort...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Vervollständigen Sie das folgende Formular, um mit uns in Kontakt zu treten.");
	//Message
	define("LANG_LABEL_MESSAGE", "Nachricht");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Keine Behinderungen Kategorien gefunden im System.");
	//No categories found
	define("LANG_CATEGORY_NOTFOUND", "Keine Kategorien gefunden");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Bitte wählen Sie eine gültige Kategorie");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Bitte wählen Sie zunächst ein Kategorie!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Kategoriepfad anzeigen");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Gewählte Kategorie entfernen");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Zusatzkategorien/Unterkategorien kosten");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "zusätzlich");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "für jede. Treten Sie in Erscheinung!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "von maximal");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "Kategorien zulässig.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Kategorien und Unterkategorien");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Wählen Sie nur Unterkategorien, die direkt zu Ihrem Eintrag passen.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Ihr Eintrag erscheint automatisch auch in der Hauptkategorie für jede gewählte Unterkategorie");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Fehler bei den Konteninformationen");
	//Contact Information
	define("LANG_CONTACTINFO", "Kontaktdaten");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Diese Informationen werden nicht öffentlich angezeigt.");
	//Billing Information
	define("LANG_BILLINGINFO", "Rechnungsinformationen");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Diese Informationen werden nicht öffentlich angezeigt.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Nach Aufgabe der Bestellung können Sie Ihren Artikel konfiguieren.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Nach Aufgabe der Bestellung können Sie Ihr Banner konfiguieren.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Nach Aufgabe der Bestellung können Sie Ihre Anzeige konfiguieren.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Nach Aufgabe der Bestellung können Sie Ihre Ereignis konfiguieren.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Nach Aufgabe der Bestellung können Sie Ihren Eintrag konfiguieren.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Fehler bei den Rechnungsinformationen");
	//Article Information
	define("LANG_ARTICLEINFO", "Artikelinformationen");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Fehler bei den Artikelinformationen");
	//Banner Information
	define("LANG_BANNERINFO", "Bannerinformationen");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Fehler bei den Bannerinformationen");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Anzeigeninformationen");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Fehler bei den Anzeigeninformationen");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Ereignisse nach Datum durchsuchen");
	//Event Information
	define("LANG_EVENTINFO", "Ereignissinformationen");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Fehler bei den Ereignissinformationen");
	//Listing Information
	define("LANG_LISTINGINFO", "Eintragsinformationen");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Fehler bei den Eintragsinformationen");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Diesen Eintrag anfordern");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Listing Typ");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Mit den von Ihnen gewünschten Suchkriterien wurden keine Ergebnisse gefunden.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Bitte führen Sie Ihre Suche erneut aus oder suchen Sie nach Abschnitt.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "In einigen Fällen liefert die Suche keine Ergebnisse, weil ein zu allgemeines Keyword gewählt wurde. Bitte versuchen Sie es mit einem spezifischeren Keyword und führen Sie Ihre Suche erneut aus.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Geben Sie mindestens ein Keyword im Suchfeld ein.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Entschuldigung!</h1><p>Ihre Suche keine Ergebnisse. Dies ist zwar ungewöhnlich, es passiert von Zeit zu Zeit, wenn der Suchbegriff, den Sie verwendet haben, ist ein wenig generische oder wenn wir wirklich über keine abgestimmte Inhalte.</p><h2>Vorschläge:</h2>Genauer zu sein mit Ihren Suchbegriffen.<br />Prüfen Sie die Rechtschreibung.<br />Wenn Sie nicht über die Suche finden können versuchen durchsucht werden durch Abschnitt.<br /><br /><p>Wenn Sie glauben, Sie haben hier im Irrtum kommen, kontaktieren Sie bitte den Bauleiter, ein Problem <a href=\"[EDIR_LINK_SEARCH_ERROR]\">zu melden</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Bild");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "von");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Fehler beim Laden des Bildes");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Weiter");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pause");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Abspielen");
	//Back
	define("LANG_SLIDESHOW_BACK", "Zurück");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Ihre E-Mail wurde versendet. Vielen Dank.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Störung beim Versenden der E-Mail. Bitte erneut versuchen.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Bitte geben Sie Ihren Namen.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Bitte geben Sie eine gültige E-Mail-Adresse ein.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Bitte geben Sie eine Nachricht ein.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Bitte geben Sie den korrekten Code ein.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Bitte nehmen Sie eine Korrektur vor und versuchen Sie es erneut.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "Bitte geben Sie einen Name ein!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Bitte geben Sie einen Betreff ein!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "EINIGE INFORMATIONEN");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "EINIGE INFORMATIONEN");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "EINIGE INFORMATIONEN");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "EINIGE INFORMATIONEN");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "EINIGE INFORMATIONEN");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Bitte tragen Sie ein gültige E-Mail-Adresse im Feld \"An\" ein");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Bitte tragen Sie ein gültige E-Mail-Adresse im Feld \"Von\" ein");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Artikel nicht gefunden. Bitte kehren Sie");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "und versuche es erneut.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Bitte tragen Sie ein gültige E-Mail-Adresse im Feld \"Ihre E-Mail\" ein");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Über");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "von");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Über");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "von");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Über");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "von");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Über");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "von");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Über");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "von");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Informationen zu diesem Artikel an einen Freund senden");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Informationen zu dieser Anzeige an einen Freund senden");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Informationen zu dieser Ereignis an einen Freund senden");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Informationen zu diesem Eintrag an einen Freund senden");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Informationen zu dieser Anzubieten an einen Freund senden");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Nachricht, die von ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Dies ist eine automatische Nachricht.");
	//Contact
	define("LANG_CONTACT", "Kontakt");
	//article
	define("LANG_ARTICLE", "artikel");
	//classified
	define("LANG_CLASSIFIED", "anzeige");
	//event
	define("LANG_EVENT", "ereignis");
	//listing
	define("LANG_LISTING", "eintrag");
	//deal
	define("LANG_PROMOTION", "anzubieten");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Bitte führen Sie die Suche mit mindestens einem Parameter im Suchfeld aus!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Bitte führen Sie Ihre Suche erneut aus.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Noch keine Artikel eingetragen.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Noch keine Anzeigen eingetragen.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Noch keine Ereignisse eingetragen.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Noch keine Einträge eingetragen.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Noch kein Angebote eingetragen.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Nachricht versendet über");
	//E-mail Form
	define("LANG_EMAILFORM", "E-Mail-Formular");
	//Click here to print
	define("LANG_PRINTCLICK", "Zum Ausdrucken hier klicken");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Alle Kategorien anzeigen");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Standort");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Weitere Anzeigen");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Alle Kategorien anzeigen");
	//Location
	define("LANG_EVENT_LOCATIONS", "Standort");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Vorgestellte Ereignisse");
	//events
	define("LANG_EVENT_PLURAL", "Ereignisse");
	//Search results
	define("LANG_SEARCHRESULTS", "Suchergebnisse");
	//Results
	define("LANG_RESULTS", "Ergebnisse");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "für");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "in");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "in");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "in");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "in Kategorie");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "in");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "in");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "für");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Seite");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Aktuelle Überprüfunge");
	//Reviews of
	define("LANG_REVIEWSOF", "Überprüfunge von");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Überprüfunge inaktiv");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Alle Kategorien anzeigen");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Alle Kategorien anzeigen");
	//Offer
	define("LANG_PROMOTION_OFFER", "Angebot");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Beschreibung");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Bedingungen");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Standort");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Eintrag nicht gefunden!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Kein Eintrag verfügbar!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Ergebnisse der Eintragssuche");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Ergebnisse der Anzubietensuche");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Ergebnisse der Ereignisssuche");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Ergebnisse der Anzeigensuche");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Ergebnisse der Artikelsuche");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Verfügbare Sprachen");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Sie können bis zu ".MAX_ENABLED_LANGUAGES." der folgenden Sprachen für Ihr Verzeichnis.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Profitieren Sie von unseren Diensten!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Verbindung entfernen mit");
	//Welcome
	define("LANG_LABEL_WELCOME", "Willkommen");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Sponsor Optionen");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Zurück zur Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Neues Konto hinzufügen");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Passwort vergessen");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Hier klicken");
	//Help
	define("LANG_LABEL_HELP", "Hilfe");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Passwort zurücksetzen");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Konten- und Kontaktinformationen");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Registierungsbestätigung");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Zur Anmeldung gehen");
	//Order
	define("LANG_LABEL_ORDER", "Bestellen");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Zur Kasse gehen");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Konfiguration");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Bitte geben Sie Ihre Website-URL zuerst.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "Validierung fehlgeschlagen! Bitte versuchen Sie es erneut.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Website erfolgreich validiert!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Generieren Traffic");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "Bitte beachten Sie, dass Sie diesen Code zu ändern, wie Sie wollen, da halten Sie die URL genau wie hier dargestellt, da sonst Ihr Backlink wird nicht validiert werden.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink nicht validiert worden. Bitte, versuchen Sie es erneut.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Markieren Sie dieses Kästchen, um den Backlink dieser Liste entfernen");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "Backlink-URL");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL wo der Backlink installiert wurde.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Bitte geben Sie den Backlink-URL.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink nicht verfügbar für diesen Eintrag");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Fügen Sie einen Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Setzen Sie diese auf Ihrer Website (HTML-Code):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Geben Sie die URL Ihrer Site:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Ex: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Klicken Sie auf die Schaltfläche, um Ihre Backlink überprüfen");
	//Verify
	define("LANG_LABEL_VERIFY", "Sicher");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Warum fügen Sie einen Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Einen Link zu Ihrer Webseite zeigt auf dieser, erhöht sich die Relevanz dieser Website und im Gegenzug die Relevanz Ihrer Artikel.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "Was bringt es für mich?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "Indem Sie uns einen Link auf der Startseite Ihrer Website, helfen Sie uns mit unserem Ranking und damit Ihre Ergebnisse. Aber wie hilft uns, wir gehen die extra Meile und helfen Ihnen. Wenn Sie einen Link hinzufügen, sobald wir überprüft haben, es existiert, werden wir Ihren Artikel an prominenter Stelle auf der Seite zeigen, so bekommt man wirklich etwas mehr Engagement in dem Verzeichnis - es ist eine Win / Win-Situation für uns beide.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "How can I do this?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Ganz einfach, kopieren Sie den obigen Code in den Code Ihrer Website, so dass es zeigt, irgendwo prominent auf der Startseite, geben Sie die URL Ihrer Website (wo der Link ist) und wir werden es überprüfen, nachdem Sie die \"Verify Hit\" -Taste - dann einfach auf weiter .... super einfach.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "Nein, Auftrag ohne Backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Ja, fügen Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink erfolgreich hinzugefügt, um Ihre Einträge!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Sie haben noch keine Einträge zu Backlink noch hinzuzufügen.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Backlink-Vorschau");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Detailansicht Kategorie");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Seitenmanager");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Zusammenfassung");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Detailansicht");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Fotogalerie");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Banner hinzufügen");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Informationen zu Bildern in der Galerie");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Bilder in der Galerie");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Bilder in der Galerie verwalten");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Galerien verwalten");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "Galerie nicht vorhanden!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "Galerie nicht verfügbar!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Titel der angepassten Rechnung");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Einträge der angepassten Rechnung");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "So schnell und einfach!");
	//Steps
	define("LANG_LABEL_STEPS", "Schritte");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Registrierung des Kontos");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Wählen Sie eine Ebene");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Zahlungsstatus");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Ablauf");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Neue Galerie hinzufügen");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Neue Galerie hinzufügen");
	//New deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Anzubieten hinzufügen");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Neue Anzubieten hinzufügen");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Abrechnung verwalten");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Hier klicken, wenn Sie bereits über ein Passwort verfügen.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Noch kein Sponsor?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "für Informationen zum Hinzufügen Ihres Eintrags zu");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Willkommen in der Sektion Sponsor");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Willkommen im Mitgliederbereich");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Konto gesperrt. Bitte warten für");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minute(n) und dann erneut versuchen.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Ein oder mehrere Pflichtfelder wurden nicht ausgefüllt. Bitte bestätigen Sie, dass alle erforderlichen Informationen, bevor Sie fortfahren eingegeben wurde.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Von dieser IP-Adresse sind Sie nicht zum Zugriff berechtigt!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Ihr Konto wurde deaktivierten!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Leider ist Ihre E-Mail oder Passwort falsch.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Falsches Konto.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Sorry, für den Schutz der Link in Ihrem E-Mail abgelaufen ist. Wenn Sie Ihr Passwort vergessen haben klicken Sie auf den untenstehenden Link.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID-Server nicht verfügbar!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Fehler bei Anfrage beim OpenID-Server!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Anfrage bei OpenID abgebrochen!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Anfrage bei Google abgebrochen!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Ungültige OpenID-Identität!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Passwort vergessen?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "Was ist OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Was ist Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Was ist Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Konto erfolgreich aktualisiert!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Passwort erfolgreich aktualisiert!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Vielen Dank für Ihre Registrierung des Kontos bei");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Melden Sie sich an, um Ihr Konto mit dem folgenden e-mail und Passwort zu verwalten.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Sie sehen");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Ihr Konto bei");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Der Artikel enthält");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Die Anzeige enthält");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Die Ereignis enthält");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Der Eintrag enthält");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "von max.");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "bild");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "bilder");
	//This [ITEM] will show [UNLIMITED|the max of X] images "per gallery"
	define("LANG_MSG_PER_GALLERY", "in der Galerie");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " plus eine Haupt-Bild.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "oder Eine vorhandene Galerie mit diesem Artikel verknüpfen");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "oder Eine vorhandene Galerie mit dieser Anzeige verknüpfen");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "oder Eine vorhandene Galerie mit dieser Ereignis verknüpfen");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "oder Eine vorhandene Galerie mit diesem Eintrag verknüpfen");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Fortfahren zur Zahlung für Ihren Artikel.");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Fortfahren zur Zahlung für Ihr Banner.");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Fortfahren zur Zahlung für Ihre Anzeige.");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Fortfahren zur Zahlung für Ihre Ereignis.");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Fortfahren zur Zahlung für Ihren Eintrag.");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Artikel werden aktiviert von");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Banner werden aktiviert von");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Anzeigen werden aktiviert von");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Ereignisse werden aktiviert von");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Einträge werden aktiviert von");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "nachdem der Vorgang abgeschlossen ist.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Tipps zur Feineinstellung der Karte");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Sie können für die Position auf der Karte,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "eine größere Genauigkeit einstellen.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Verwenden Sie die Steuerflächen \"+\" und \"-\" zur Anpassung des Zooms auf der Karte.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Verwenden Sie die Pfeile zur Navigation auf der Karte");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Ziehen Sie die Markierung an den Standort und legen Sie diese dort ab.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Ihre Anzubieten wird hier angezeigt");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Oder eine vorhandene Anzubieten mit dem Eintrag verknüpfen");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Keine Ergebnisse gefunden!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Zugriff nicht zugelassen!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Die folgenden Probleme traten auf");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Keine Einträge gewählt oder keine Zahlung für Einträge erforderlich.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Keine Einträge gefunden.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Keine Rechnungen im System.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Keine Transaktionen im System.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Diesen Eintrag anfordern");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Gehen Sie auf Zur Kasse gehen im Sponsor Bereich");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Ihre Rechnung wird angezeigt bei");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Ich stimme den Bedingungen zu");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "und werde die Zahlung vornehmen.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Über diese Seite werden Sie in wenigen Augenblicken zum Sponsor Bereich weitergeleitet.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Über diese Seite werden Sie in wenigen Augenblicken zur Fortsetzung der Registrierung weitergeleitet.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Sollte dies nicht erfolgen, bitte");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Artikel verwalten");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Banner verwalten");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Anzeige verwalten");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Ereignis verwalten");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Eintrag verwalten");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Anzubieten verwalten");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Abrechnung verwalten");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Rechnungen verwalten");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Transaktionen verwalten");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Keine Artikel im System.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Keine Banner im System.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Keine Anzeigen im System.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Keine Ereignisse im System ");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "Keine Galerien im System.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Keine Einträge im System.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Kein Angebote im System.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Keine Berichte verfügbar.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Kein Artikel gefunden. Möglicherweise wurde dieser gelöscht.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Keine Anzeige gefunden. Möglicherweise wurde diese gelöscht.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Kein Eintrag gefunden. Möglicherweise wurde dieser gelöscht.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Artikelinformationen");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Artikel löschen");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Artikelinformationen löschen");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Wollen Sie diesen Artikel wirklich löschen?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Artikel Galerie");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Voransicht Artikel");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Traffic-Bericht Artikel");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Detailansicht Artikel");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Artikelinformationen bearbeiten");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Banner löschen");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Bannerinformationen löschen");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Wollen Sie dieses Banner wirklich löschen?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Banner bearbeiten");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Bannerinformationen bearbeiten");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Voransicht Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Traffic-Bericht Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Banner anzeigen");
	//Disabled
	define("LANG_BANNER_DISABLED", "Inaktiv");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Anzeigeninformationen");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Anzeige löschen");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Ihre Kleinanzeige wird automatisch in der Hauptkategorie der einzelnen Teilsysteme erscheinen Kategorie Sie wählen.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Anzeigen Kategorien");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Anzeigen Kategorien");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Anzeigeninformationen löschen");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Wollen Sie diese Anzeige wirklich löschen?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "Galerie Anzeigen");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Feinabstimmung der Karte Anzeige");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Voransicht Anzeige");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Traffic-Bericht Anzeige");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Detailansicht Anzeige");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Anzeigeninformationen bearbeiten");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Stufe der Anzeige bearbeiten");
	//Delete Event
	define("LANG_EVENT_DELETE", "Ereignis löschen");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Ereignissinformationen löschen");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Wollen Sie diese Ereignis wirklich löschen?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Ereignissinformationen");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Galerie Ereignisse");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Feineinstellung der Karte Ereignis");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Voransicht Ereignis");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Traffic-Bericht Ereignis");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Detailansicht Ereignis");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Ereignissinformationen bearbeiten");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Galerie Einträge");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Eintragsinformationen");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Feineinstellung der Karte Eintrag");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Voransicht Eintrag");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Anzubieten Eintrag");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Die Anzubieten ist verknüpft aus dem Eintrag.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Um aktiviert zu werden, muss die Anzubieten");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "ein Enddatum haben, das in der Zukunft liegt.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "mit einem Eintrag verknüpft werden.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Traffic-Bericht Eintrag");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Detailansicht Eintrag");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "für Eintrag");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Aktualisierung Eintrag");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Anzubieten löschen");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Anzubieteninformationen löschen");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Wollen Sie dies Anzubieten wirklich löschen?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Voransicht Anzubieten");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Anzubieteninformationen");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Detailansicht Anzubieten");
	//Edit deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Anzubieteninformationen bearbeiten");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Galerie löschen");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Galerieinformationen löschen");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Wollen Sie diese Galerie wirklich löschen? Hierdurch werden sämtliche Galerieinformationen, Fotos und Verknüpfungen entfernt.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Galeriebild löschen");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Galerieinformationen");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Voransicht Galerie");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Detailansicht Galerie");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Galerieinformationen bearbeiten");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Bilder verwalten");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Bild löschen");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Bild erfolgreich gelöscht!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Detailansicht Überprüfung");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Voransicht Überprüfung");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Detailansicht Rechnung");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Rechnung für dieses Konto nicht gefunden.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Rechnungsmitteilung");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Informationen zur Transaktion");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transaktion für dieses Konto nicht gefunden.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Mit Verzeichniskonto anmelden");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Mit-OpenID 2.0 anmelden");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Mit Facebook-Konto anmelden");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Mit Google-Konto anmelden");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." bereits registriert!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Dieses Konto ist verfügbar.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Fehler beim Upload der Bilder. Bitte versuchen Sie es erneut.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Image erfolgreich hochgeladen!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Image erfolgreich aktualisiert!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Bild löschen");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Sind Sie sicher, dass Sie dieses Bild wirklich löschen?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Bild bearbeiten");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Titelbild");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Titelbild");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Klicken Sie hier, um als Haupt-Bild gesetzt");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Klicken Sie hier, um als Galerie Bild gesetzt");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Pakete");
	//Package
	define("LANG_PACKAGE_SING", "Paket");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Die Gebühren für paket ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profil erfolgreich aktualisiert!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Sponsor Optionen");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "Meine Freunde");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Friends zu genehmigen");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "Bis Acceptance");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Enable Benutzerprofil");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "Leute treffen, Kunden finden für Ihr Unternehmen und vieles mehr!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profil");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Profil-Optionen");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Profil bearbeiten");
	//Friends
	define("LANG_LABEL_FRIENDS", "Freunde");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Freunde anzeigen");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Freunde verwalten");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Load Bild von Ihrem Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Persönliche Informationen");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Spitzname");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Twitter-Konto");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Über Mich");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Geburtsdatum");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Heimat");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Lieblings-Bücher");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Lieblingsfilme");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favorite Sport");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Lieblings-Musics");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Lieblingsessen");
	//Settings
	define("LANG_LABEL_SETTINGS", "Einstellungen");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Sehen Sie alle Freunde");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Alle Freunde");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Freund entfernen");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Freunde hinzufügen");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Akzeptieren");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Leugnen");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Werden Sie ein Advertiser");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Registrieren Sie sich und Ihr Unternehmen zu fördern beginnen heute, kostenlos!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "Was kann ich tun?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Nachrichten");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Sind Sie sicher?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "Die persönliche Seite mit Namen \"john-smith\" wird durch die URL zur Verfügung:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Ihre URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Ihre URL enthält ungültige Zeichen.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL bereits im Einsatz, bitte wählen Sie eine andere URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Du hast keine Freunde.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Friend erfolgreich entfernt.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Friend erfolgreich genehmigt.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Friend erfolgreich abgelehnt.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Friend Anforderung erfolgreich abgebrochen.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Alle");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Alle");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "Keine Freunde");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Keine Produkte");
	//Share
	define("LANG_LABEL_SHARE", "Anteil");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Teilen alle");
	//Comments
	define("LANG_LABEL_COMMENTS", "Kommentare");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Mein Profil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Benutzerprofil erfolgreich aktiviert!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Veröffentlichen Sie meine Kontaktdaten");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Erstellen Sie meine persönliche Seite");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Persönliche Seite");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Artikel Überprüfunge");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Listing Überprüfunge");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Überprüfunge erfolgreich gelöscht.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Keine Überprüfunge gefunden!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Mein Profil bearbeiten");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Zurück zu meinem Profil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Mitglied seit");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Kontoeinstellungen");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Angebote Eingelöst");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoriten");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Sie haben keine Berechtigung, diesen Bereich zu betreten.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Gehen Sie zu Ihrem Profil.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Meine persönliche Seite");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Verwenden Sie dieses Konto");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Profil-Seite");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Erstellen Sie Ihr Profil");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Spitzname ist erforderlich.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Seien Sie sicher, dass die Twitter-Konto Sie hinzufügen ist nicht geschützt. Wenn der Twitter-Konto ist das jüngste tweets Weise geschützt werden nicht angezeigt.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Ihr Artikel wurde bezahlt, so können Sie maximal [max] Kategorien kostenlos hinzufügen.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Ihr Artikel wurde bezahlt, so können Sie maximal [max] Kategorie kostenlos hinzufügen.");
	
	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Nur ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "Bilder für den Upload akzeptiert!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Bilder müssen im Rahmen ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Wählen Sie ein Bild für den Upload!");
	//Original image
	define("LANG_ORIGINAL", "Originalbild");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Thumb-Vorschau");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Benennen");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Hier können Sie die max von ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " Fotos zu Ihrer Galerie hinzufügen!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Thumbnail erstellen");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Thumbnail-Vorschau");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Ihr Artikel hat schon die maximale Anzahl der Bilder in der Galerie. Löschen Sie ein vorhandenes Bild zu speichern diese.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Wiederkehrend");
	//Repeat
	define("LANG_PERIOD", "Wiederholen");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Wählen Sie eine Option");
	//Daily
	define("LANG_DAILY", "Täglich");
	//Weekly
	define("LANG_WEEKLY", "Wöchentlich");
	//Monthly
	define("LANG_MONTHLY", "Monatlich");
	//Yearly
	define("LANG_YEARLY", "Jährlich");
	//Daily
	define("LANG_DAILY2", "Täglich");
	//Weekly
	define("LANG_WEEKLY2", "Wöchentlich");
	//Monthly
	define("LANG_MONTHLY2", "Monatlich");
	//Yearly
	define("LANG_YEARLY2", "Jährlich");
	//every
	define("LANG_EVERY", "Jeder");
	//every
	define("LANG_EVERY2", "Jeder");
	//of
	define("LANG_OF", "von");
	//of
	define("LANG_OF2", "von");
	//of
	define("LANG_OF3", "von");
	//of
	define("LANG_OF4", "des");
	//Week
	define("LANG_WEEK", "Woche");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Monat wählen");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Tag auswählen");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Wählen Sie Woche");
	//First
	define("LANG_FIRST", "Erste");
	//Second
	define("LANG_SECOND", "Zweite");
	//Third
	define("LANG_THIRD", "Drittel");
	//Fourth
	define("LANG_FOURTH", "Vierte");
	//Last
	define("LANG_LAST", "Zuletzt");
	//1st
	define("LANG_FIRST_2", "1ª");
	//2nd
	define("LANG_SECOND_2", "2ª");
	//3rd
	define("LANG_THIRD_2", "3ª");
	//4th
	define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Wiederkehrend");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Bitte wählen Sie einen Tag der Woche.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Bitte geben Sie einen Tag.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Bitte wählen Sie einen Monat.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Bitte wählen Sie eine Woche.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Bitte wählen Sie eine Option Wiederholen.");
	//When
	define("LANG_EVENT_WHEN", "Wenn");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Tag müssen numerisch sein.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Tag muss zwischen 1 und 31 sein.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Tag nicht mit den gewählten Zeitraum passen.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Monat nicht mit den gewählten Zeitraum passen.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Tage nicht mit dem gewählten Zeitraum passen.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Woche nicht mit den gewählten Zeitraum passen.");
	//No info
	define("LANG_EVENT_NO_INFO", "Keine Information");
	//Ends on
	define("LANG_ENDS_IN", "Endet am");
	//Never
	define("LANG_NEVER", "Nie");
	//Until
	define("LANG_UNTIL", "Bis");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Bis Datum");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Bis\" muss größer als oder gleich dem \"Startdatum\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Bis\" kann nicht in der Vergangenheit sein.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Startet am");
	//Repeats
	define("LANG_EVENT_REPEATS", "Wiederholt");
	//Ends on
	define("LANG_EVENT_ENDS", "Endet am");
	//weekend
	define("LANG_EVENT_WEEKEND", "wochenende");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "werktag");
	//the month
	define("LANG_THE_MONTH", "monat");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Website");
	//Site name
	define("LANG_DOMAIN_NAME", "Website-Namen");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Klicken Sie hier tun view this Website");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Klicken Sie hier, löschen Sie diese Website");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Website erfolgreich gelöscht!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Website erfolgreich hinzugefügt!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Eine E-Mail Benachrichtigung an den eDirectory-Support-Team gesendet werden, warten Sie bitte unser Kontaktformular.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Website-Namen ist erforderlich");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Website-URL ist erforderlich");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Website-Namen ist bereits vorhanden");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "Website-URL ist bereits vorhanden");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "Website-URL nicht gültig");
	//Site Items
	define("LANG_SITE_ITEMS", "Site Elemente");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Profil-Information");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Soziale Netzwerke");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link-und Einfuhr Informationen");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Just Link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Link meine Facebook-Konto");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Die Verknüpfung zwischen meinem Facebook-Konto");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Ihr Konto wurde auf Facebook getrennt");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Ihre Facebook-Konto ist bereits mit anderen Konto im System verknüpft.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Ihre Twitter-Konto ist bereits mit anderen Konto im System verknüpft.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Verbunden mit Twitter als");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Verbunden als");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Lage Preferences");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Wählen Sie Ihren Standort bevorzugt");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Verwenden Sie Ihren aktuellen Standort");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Verwenden Facebook Lage");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Verbinden mit Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Facebook-Konto");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Google-Konto");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Konto ändern");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Twitter-Account");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter-Verbindung");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Link meine Twitter-Account");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Unlink meinen Twitter-Account");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Post erlöst auf meinem Twitter-Account automatisch");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Ihr Konto wurde auf Twitter getrennt");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Sie müssen sich über Twitter unterzeichnet erste");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Ihren Twitter-Account wurde erfolgreich verbunden");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Ihren Facebook-Account wurde erfolgreich verbunden");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Du bist bereits angemeldet Facebook-Account als");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Dieser Benutzer ist bereits mit einem anderen Konto verbunden.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Klicken Sie hier, um auf dieses Konto wechseln");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Verbinden mit Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Verwenden Sie diese Sprache bei jedem Anmelden auf mein Konto");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_LINK2LISTING", "Link zu einer Einträge");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Ich mochte dieses");
	//Redeem
	define("DEAL_REDEEM", "Einlösen");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Einlösen dieser angebote");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Zum Einlösen benötigen Sie, um dieses Geschäft Informationen über Ihre Facebook oder Twitter Post.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Sie können diese Schaltfläche, um automatisch per Post auf Ihrem Profil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Klicken Sie hier, um ihn zu konfigurieren");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Bitte warten, die Entsendung auf Facebook und Twitter (falls vorhanden).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Sie haben bereits das Angebot erlöst! Ihr Code ist");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Deal gemacht! Dies ist Ihr Code einlösen");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Niemand hat das Angebot auf Facebook eingelöst noch.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Niemand hat das Angebot auf Twitter eingelöst noch.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Aktuelle Angebote gemacht");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Keine Angebote gefunden!");
	//This deal is not available anymore.
	define("DEAL_NA", "Dieser Deal ist nicht mehr erhältlich.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Zum Einlösen dieses Geschäft müssen Sie zu Ihrem Facebook-Pinnwand schreiben. Zunächst melden Sie sich mit der Facebook-Login-Button, und Sie müssen diesen Antrag zu genehmigen, dies zu tun.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Sie konnte das schon viel!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Sorry, es war ein Fehler versucht, auf Ihre Facebook-Pinnwand schreiben. Bitte versuchen Sie es erneut.");
	//Value
	define("DEAL_VALUE", "Preis");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Mit diesem Gutschein");
	//Thank you
	define("DEAL_THANKYOU", "Vielen Dank");
	//Original value
	define("DEAL_ORIGINALVALUE", "Original-Wert");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Mit diesem Deal");
	//Valid until
	define("DEAL_VALIDUNTIL", "Gültig bis");
	//Angebote must be presented to receive discount
	define("DEAL_INFODETAILS1", "Angebote muss vorgelegt Nachlass erhalten");
	//Limit of 1 Angebote per purchase
	define("DEAL_INFODETAILS2", "Limit von 1 Gutschein pro Einkauf");
	//Not valid with other Angebotes, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Nicht gültig mit anderen Gutscheinen, Angeboten oder Rabatten jeglicher Art");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Gültig nur für Listing Name - Adresse");
	//Print deal
	define("DEAL_PRINTDEAL", "Drucken");
	//deal done
	define("DEAL_DEALSDONE", "Anzubieten Getan");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Angebote Gemacht");
	//Left
	define("DEAL_LEFTAMOUNT", "Verbleibenden");
	//SOLD OUT
	define("DEAL_SOLDOUT", "Verkauft");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Sorry, dieses Geschäft nicht vorhanden, oder es wurde vom Eigentümer entfernt");
	//at
	define("DEAL_AT", "bei");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Freundliche URL");
	//Select a listing
	define("DEAL_SELECTLISTING", "Wählen Sie ein Inserat aufgeben");
	//Tagline for Deals
	define("DEAL_TAG", "Tagline for Deals");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Sichtweite");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Dieser Angebote wird nun an");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "sucht und in der Nähe Feature");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 stunden / tag");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Individuelle Auswahl");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Discount Informationen");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Artikel-Wert");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Diskont");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Wert mit Rabatt");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Anzahl der Angebote");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "bis jetzt getan");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "bis jetzt getan");
	//left
	define("LANG_SITEMGR_LEFT", "rest");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Bitte warten, lade...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Bitte warten Sie. Wir lenken Ihre Login um diesen Schritt abzuschließen...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Artikel-Wert ist erforderlich.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." ist erforderlich.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." darf nicht höher als 99 ist.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Angebote zu bieten ist nicht erforderlich.");
	//Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Bitte geben Sie einen geringeren Wert auf viel ".LANG_LABEL_DISC_AMOUNT);
	//Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed auf");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Sie können nur direkt Verlinken dieser Deal, um eine Liste, wenn Sie ein Konto wählen Sie zuerst");
    //Value
    define("DEAL_VALUE", "Wert");
    //With discount
    define("DEAL_WITHCOUPON", "Mit Rabatt");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Bestätigen per E-Mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Anmeldung und Lösen");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Einlösen und Drucken");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Einlösen setzen");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Ausgewählte Angebote");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Melden Sie sich mit Ihrem Facebook-Sitzung");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Um Einlösen der Nutzung von Facebook, müssen Sie eine Verbindung mit Ihrem Facebook-Konto.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Einlösen Statistik");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Redeem code");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Verfügbar");
    //Used
    define("DEAL_SITEMGR_USED", "Gebraucht");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Einlösen mit Ihrer aktuellen Sitzung Facebook");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Navbar Konfiguration gespeichert.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "Es gab ein Problem beim Speichern, bitte versuchen Sie es erneut.");
	//At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "Mindestens ein Element benötigt wird.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Sie können nicht wiederholt sparen URLs.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Sie können keine leeren Begriffe.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "Sie können keine leeren Kopf-oder Fußzeile.");
    //Use
    define("DEAL_SITEMGR_USE", "Verwenden");
	//Saving...
	define("LANG_DEAL_SAVING", "Speichern...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Keine einlösen gefunden.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "Prozentsatz");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "Festbetrag");

    # ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Tragen Sie bitte einen Kennsatz ein.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Tragen Sie bitte ein URL ein.");
	//Add new item to menu
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Fügen Sie Feld hinzu");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Neues Feld");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Module");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Site-Inhalt");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Neu");
	//Save & Close
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Gespeichert");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Gespeichert Feld");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Name");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Gebrauch");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Wählen Sie bitte ein Modul oder Hit nah an Löschen aus.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Traurig, gibt es keinen kundenspezifischen Site-Inhalt, der schon erstellt wird.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Erstellen Sie eine neue benutzerdefinierte Inhalte");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Erstellen Sie einen neuen kundenspezifischen Inhalt");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Benutzen Sie Modul URL");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Benutzen Sie kundenspezifisches seite URL");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Klicken Sie ein Einzelteil auf dem navbar untengenannten an, um den Aufkleber zu redigieren oder die Verbindungsposition zu ändern:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Überschrift-Navigations");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Seitenende-Navigation");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Abbrechen der Aufnahme dieses Artikels?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Wiederherstellen von Elementen");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Einlösen ohne Facebook");
    //Don't have Facebook? Sign using your account.
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Sie haben noch keine Facebook? Registriere über Ihr Konto.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Unter Website");
    //Only
    define("LANG_ONLY2", "Nur");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Anzubieten");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Angebote");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Angebote Überprüfunge");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "Gesendet Facebook und Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "Gesendet Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "Gesendet Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Geschrieben am");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "Angebot endet");
	//deal opened
	define("LANG_DEAL_OPENED", "offenes Angebot");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Allgemeine Geschäftsbedingungen");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "max. 1000 Zeichen");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Bitte geben Sie eine Bedingungen mit einem Maximum von 1000 Zeichen.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "Zeile");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Fehler beim Importieren auf temporäre Tabelle.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Ungültige Datum der Erneuerung - Zeile");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Ungültige aktualisiert Datum - Zeile");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "CSV-Datei in temporäre Tabelle importiert.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Ungültiger E-mail - Zeile");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Ungültiges Passwort - Zeile");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Ungültiges Keyword (maximal ".MAX_KEYWORDS." keyword) - Zeile");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Ungültiges Keyword (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - Zeile");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Ungültiger Titel - Zeile");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Ungültige Startdatum - Zeile");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Ungültige Enddatum - Zeile");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Startdatum muss ausgefüllt werden - Zeile");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Enddatum muss ausgefüllt werden - Zeile");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Ungültige Startzeit - Zeile");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Ungültige Endzeit - Zeile");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Ungültige Startzeit Format. Muss\"xx:xx\" - Zeile");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Ungültige Endzeit Format. Muss \"xx:xx\" - Zeile");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Falsche Startzeit-Modus. Muss \"AM\" oder \"PM\" - Zeile");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Falsche Endzeit-Modus. Muss \"AM\" oder \"PM\" - Zeile");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Falsche Startzeit-Modus. Muss \"24\" - Zeile");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Falsche Endzeit-Modus. Muss \"24\" - Zeile");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Standort-und System-Standard-Speicherort befinden differents - Zeile");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Ungültige Breitengrad. Muss zwischen -90 und 90 numerische - Zeile");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Ungültige Länge. Muss zwischen -180 und 180 numerische - Zeile");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Kein Import von CSV-Dateien in Ordner.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Falsche Spaltenanzahl in der/den folgende(n) Zeile(n):");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Eingelesene Zeilenzahl:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV Header stimmt nicht - es hat mehr Felder, die es erlaubt ist");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV Header nicht auf Feld (n) entsprechen: ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "konto zurückgesetzt");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "konten zurückgesetzt");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "Artikel zurückgesetzt");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "Artikel zurückgesetzt");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Finden Sie, was Sie suchen...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Manchmal erhalten Sie möglicherweise keine Ergebnisse für Ihre Suche, weil die Schlüsselwort, das Sie ist stark Generika. Versuchen Sie, einen genaueren Schlüsselwort verwenden.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Finden Sie uns auf LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Finden Sie uns auf Facebook");
	//Links
	define("LANG_LINKS", "Platz");
	//Contact
	define("LANG_FOOTER_CONTACT", "Kontakt");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Folgen Sie uns auf Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Folgen Sie uns");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Ergebnisse pro Seite");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Zeige Ergebnis");
	//to
	define("LANG_PAGING_SHOWING_TO", "auf");
	//of
	define("LANG_PAGING_SHOWING_OF", "von");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Seiten");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importieren [SUGAR_ITEM_TITLE] von SugarCRM auf [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Verwenden Sie das obige Formular, um aus der SugarCRM Rekord import [SUGAR_ITEM_TITLE], nach einem Klick importieren Sie Ihre Daten auf Ihren Direktorium-Installation mit allen relevanten Informationen weitergegeben ganz übertragen werden, nur in den zusätzlichen Daten zu füllen, und Zahlungsdaten.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Sie sind fast fertig.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Es war nicht möglich, zu exportieren. Bitte überprüfen Sie Ihre SugarCRM-Verbindung über Ihr Verzeichnis.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Falsche eDirectory Key.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Eintrags Besitzer");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Rishikimi Titulli");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Eintrags Ereignis");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Eintrags Anzeige");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Artikelverfasser");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.ihrewebsite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "ihrname@ihrewebsite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Besucher");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Kategorien");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Kategorien 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Kategorien 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Kategorien 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Kategorien 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Zusammenfassung");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Detailansicht");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Illustrative Inhalt");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Senden zu Telefon");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Klicken Sie auf Anruf");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Nachricht erfolgreich!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Senden Sie Informationen zu dieser Eintrag, um eine Telefonnummer.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Geben Sie Ihre Telefonnummer an die Auflistung Besitzer kostenfrei anrufen können.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefon erforderlich ist.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Bitte, geben Sie eine gültige Telefonnummer.");
	//Call
	define("LANG_TWILIO_CALL", "Nennen");
	//Calling
	define("LANG_TWILIO_CALLING", "Berufung");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefon");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Erweiterung");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Aktivieren");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Ihr Bestätigungscode ist:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Ihre Telefonnummer wurde aktiviert!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Telefon erfolgreich gelöscht!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Klicken Sie auf Anruf nicht verfügbar für diesen Eintrag");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Tipps für die Artikel Klicken Sie auf Anruf");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Sie müssen die Telefonnummer unten aktivieren, damit die Benutzer direkt mit Ihnen Kontakt durch die Verzeichnisstruktur.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Geben Sie Ihre Telefonnummer ein und klicken Sie in Aktivieren.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Eine Nachricht mit Ihren Aktivierungscode angezeigt. Beachten Sie diesen Code und warten auf die Aktivierung Anruf.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Sie werden fragen, um die sechs Ziffern Aktivierungscode eingeben. Geben Sie den Code und warten auf die Bestätigung.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Nach Ihrer Telefonnummer aktivieren, in Speichern, um den Vorgang abzuschließen klicken.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Für Zahlen außerhalb der USA, müssen Sie Ihre Landesvorwahl an erster Stelle.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "Nur Zahlen aus den USA akzeptiert.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Klicken Sie auf Anruf\" Bericht");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Richtung");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "Aus");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Startzeit");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Endzeit");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Dauer (Sekunden)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Keine Berichte verfügbar.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Aktiviert durch");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Aktivierung fehlgeschlagen. Bitte versuchen Sie es erneut.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Konto ist nicht aktiv.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Test-Account bietet keine Unterstützung für dieses Feature.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Ankommende Anrufe abgelehnt aufgrund inaktiver Account.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Ungültige URL-Format.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP Abruf Misserfolg.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP Verbindungsfehler.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP Protokollverletzung.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP bad Host-Namen.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP Zu viele Umleitungen.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Document parse Misserfolg.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Ungültige Twilio Markup XML-Version.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "Das Root-Element muss Reaktionszeit werden");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Schema-Validierung Warnung.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Ungültige Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Interner Fehler.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Lässt sich nicht wählen aus einem Dial Rufen Segment.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Invalid method Wert.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Ungültige Timeout-Wert.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Ungültige hangupOnStar Wert.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Ungültige callerid Wert.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Ungültige verschachtelten Element.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Ungültige Zeitlimit-Wert.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Invalid method Wert.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Ungültige sendDigits Wert.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Ungültige Telefonnummer Format.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Ungültige Telefonnummer.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Forbidden Telefonnummer.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Ungültige gedämpften Wert.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Ungültige endConferenceOnExit Wert.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Ungültige startConferenceOnEnter Wert.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: ungültige waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: ungültige waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Ungültige Signalton Wert.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Ungültige Konferenz Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Ungültige Conference Name.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Invalid Verb in waitUrl TwiML verwendet.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Ungültige finishOnKey Wert.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Invalid method Wert.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Ungültige Timeout-Wert.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Ungültige numDigits Wert.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Ungültige verschachtelte Verb.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Ungültige Stimme Wert.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Ungültige Schleife Wert.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Ungültige Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Ungültige Schleife Wert.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Ungültige Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Ungültige Schleife Wert.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Ungültige Stimme Wert.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: ungültige Text.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Invalid method Wert.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Ungültige Timeout-Wert.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Ungültige maxLength Wert.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Ungültige finishOnKey Wert.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Invalid method Wert.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Ungültige Länge Wert.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Ungültige \"Auf\"-Attribut.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Ungültige \"Von\"-Attribut.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Ungültige Body.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Invalid method-Attribut.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Ungültige statusCallback Attribut.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Document Retrieval erreicht.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS senden Rate überschritten.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "Vom Telefon-Nummer nicht SMS-fähig.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS-Reply-Grenze überschritten.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Invalid Verb für SMS antworten.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Ungültige Um Telefonnummer für Trial-Modus.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Unbekannte Parameter.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Ungültige FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Zugriff verweigert.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Methode nicht erlaubt.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Konto nicht aktiv ist.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Keine Called Zahl angegeben.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Die gewählte Rufnummer ist eine Premium-Nummer.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Internationale Anrufe sind nicht aktiviert.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Ungültige URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Ungültige SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Ungültige IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Ungültige Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Ungültige Methode.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Caller Telefonnummer nicht überprüft.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Ungültige Called Telefonnummer.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Ungültige Caller Telefonnummer.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Caller Telefonnummer ist nicht erforderlich.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Called Telefonnummer nicht erreicht werden kann.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Konto nicht berechtigt, Telefonnummer anzurufen.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Konto nicht erlaubt, Telefonnummer anzurufen.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Telefonnummer nicht gültig zu sein scheint.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Ungültige ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Invalid call Zustand.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Ungültige Telefonnummer.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Ungültige URL.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Ungültige Methode");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Inbound Telefonnummer nicht zur Verfügung Testzugang.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Kann nicht gesetzt VoiceFallbackUrl ohne Einstellung URL.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Kann nicht festgelegt werden, ohne Einstellung SmsUrl SmsFallbackUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Diese Telefonnummer unterstützt keine SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Telefon bereits auf Ihrem Konto validiert.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Ungültige Vorwahl.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Keine Telefonnummern im Postleitzahlengebiet gefunden.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Telefonnummer bereits auf ein anderes Konto validiert.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Ungültige CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Ressource nicht verfügbar.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Ungültige Callback-URL.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Ungültige Transkription Typ.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid erforderlich ist.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Telefonnummer ist keine gültige SMS-fähige eingehende Telefonnummer.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Nachrichtentext ist erforderlich.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "Die Quelle \"Von\" Telefonnummer ist erforderlich, um eine SMS zu senden.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "Das Ziel \"Auf\" Telefonnummer ist erforderlich, um eine SMS zu senden.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Maximale SMS Körperlänge beträgt 160 Zeichen.");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Die \"Von\"-Telefonnummer gegeben ist keine gültige, SMS-fähige eingehende Telefonnummer für Ihr Konto.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Die Sandbox-Nummer können Nachrichten nur an verifiziert Zahlen zu senden.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Facebook kommentare");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Facebook kommentare nicht verfügbar für diesen Eintrag");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Seien Sie sicher, dass Sie in Facebook sind mit dem gleichen Konto, das Sie in Ihrem Kommentar Optionen gesetzt angemeldet haben, sonst kann man nicht moderieren die Kommentare zu diesem Artikel.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Sie können auch moderate Ihre Kommentare zu ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Ungültiger API-Schlüssel.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Fehlender Parameter: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Ungültige Modulnamen.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Modul deaktiviert.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Fehlender Parameter: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API deaktiviert.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Schwimmbad");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Schlafzimmer");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Badezimmer");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Stufe(n)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Art der Unterkunft");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Zweck");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Preis");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Erbaut Im");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Square Feet");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Büro");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Waschküche");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Zentrale Klimaanlage");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Esszimmer");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Parkhaus");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Müllhexler");