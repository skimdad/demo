<?

	/*==================================================================*
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
	# * FILE: /lang/it_it.php
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
	define("LANG_DATE_MONTHS", "gennaio,febbraio,marzo,aprile,maggio,giugno,luglio,agosto,settembre,ottobbre,novembre,dicembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "domenica,lunedì,martedì,mercoledì,giovedì,venerdì,sabato");
	//year
	define("LANG_YEAR", "anno");
	//years
	define("LANG_YEAR_PLURAL", "anno");
	//month
	define("LANG_MONTH", "mese");
	//months
	define("LANG_MONTH_PLURAL", "mese");
	//day
	define("LANG_DAY", "giorno");
	//days
	define("LANG_DAY_PLURAL", "giorno");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "a");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "g");
	//Hour
	define("LANG_LABEL_HOUR", "Ora");
	//Minute
	define("LANG_LABEL_MINUTE", "Minuti");
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
	define("ZIPCODE_LABEL", "codice postale");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "F dS, Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F de Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Avete una domanda su Video snippet di codice? Clicca qui.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Si utilizza una versione precedente di Internet Explorer che possono influire sulla funzionalità di alcune funzioni. Si consiglia l'aggiornamento a una versione più recente di Internet Explorer.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "caratteri");
	//by
	define("LANG_BY", "da");
	//in
	define("LANG_IN", "in");
	//Read More
	define("LANG_READMORE", "Leggi di più");
	//More
	define("LANG_MORE", "più");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Sfoglia per Categoria");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Sfoglia per Località");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Sfoglia per Listings");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Sfoglia per Eventi");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Sfoglia per Annunci");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Sfoglia per Articoli");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Sfoglia per Offerte");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Sfoglia per Posts");
	//show
	define("LANG_SHOW", "Visualizzare");
	//hide
	define("LANG_HIDE", "Chiudi");
	//Bill to
	define("LANG_BILLTO", "Addebitare a");
	//Payable to
	define("LANG_PAYABLETO", "Intestato a");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Data di emissione");
	//Expire Date
	define("LANG_EXPIREDATE", "Scadenza");
	//Questions
	define("LANG_QUESTIONS", "Domande");
	//Please call
	define("LANG_PLEASECALL", "Si prega di telefonare");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informazioni fattura");
	//Payment Date
	define("LANG_PAYMENTDATE", "Data di pagamento");
	//None
	define("LANG_NONE", "Nessuna");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Fatture Cliente");
	//Locations
	define("LANG_LOCATIONS", "Località");
	//Close
	define("LANG_CLOSE", "Chiudi");
	//Close this window
	define("LANG_CLOSEWINDOW", "Chiudi questa finestra");
	//from
	define("LANG_FROM", "da");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Informazioni sulla Transazione");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Le transazioni manuali, totale parziale e imposta non sono calcolati.");
	//creditcard
	define("LANG_CREDITCARD", "carta di credito");
	//Join Now!
	define("LANG_JOIN_NOW", "Unisciti a noi!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Crea il tuo profilo");
	//More Information
	define("LANG_MOREINFO", "Ulteriori Informazioni ");
	//and
	define("LANG_AND", "e");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Pezzi Auto");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Pneumatici");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Riparazione motori");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categorie e sottocategorie");
	//per
	define("LANG_PER", "per");
	//each
	define("LANG_EACH", "ogni");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "blocco stampe");
	//Add
	define("LANG_ADD", "Aggiungere");
	//Manage
	define("LANG_MANAGE", "Gestisci");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "stampe sul mio credito pagato di");
	//Section
	define("LANG_SECTION", "Sezione");
	//General Pages
	define("LANG_GENERALPAGES", "Pagine Generali");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Apri in una nuova finestra");
	//No
	define("LANG_NO", "No");
	//Yes
	define("LANG_YES", "Si");
	//Dear
	define("LANG_DEAR", "Caro");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Indirizzo, Casella Postale");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Appartamento, suite, unità, edificio, piano, etc.");
	//or
	define("LANG_OR", "o");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Lunedi a Venerdì - 8:00 à s 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Sabato - 8:00 às 14:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Domenica - 10:00 às 12:00");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Campi Extra");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Servizi");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Accedi automaticamente");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Seleziona / Deseleziona tutto");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Informazioni sulla fatturazione");
	//Default
	define("LANG_BUSINESS", "Di default");
	//on Listing
	define("LANG_ON_LISTING", "su Elenco");
	//on Event
	define("LANG_ON_EVENT", "su Evento");
	//on Banner
	define("LANG_ON_BANNER", "su Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "su Annunci");
	//on Article
	define("LANG_ON_ARTICLE", "su Articolo");
	//Listing Name
	define("LANG_LISTING_NAME", "Nome Listing");
	//Event Name
	define("LANG_EVENT_NAME", "Nome Evento");
	//Banner Name
	define("LANG_BANNER_NAME", "Nome Banner");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nome Annuncio");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nome Articolo");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Domande Frequenti");
	//click to crop image
	define("LANG_CROPIMAGE", "Clicca qui per ritagliare l'immagine");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Non trovi la risposta? Contattaci.");
	//Active
	define("LANG_LABEL_ACTIVE", "Attivo");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Sospeso");
	//Expired
	define("LANG_LABEL_EXPIRED", "Scaduto");
	//Pending
	define("LANG_LABEL_PENDING", "In Sospeso");
	//Received
	define("LANG_LABEL_RECEIVED", "Ricevuto");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Codice promozionale");
	//Account
	define("LANG_LABEL_ACCOUNT", "Account");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Cambia account");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nome o Titolo");
	//Name
	define("LANG_LABEL_NAME", "Nome");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Primo, Ultimo");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nome della Pagina");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Descrizione Sommario");
	//Category
	define("LANG_LABEL_CATEGORY", "Categoria");
	//Category
	define("LANG_CATEGORY", "Categoria");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categorie");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categorie");
	//Country
	define("LANG_LABEL_COUNTRY", "Paese");
	//Region
	define("LANG_LABEL_REGION", "Regione");
	//State
	define("LANG_LABEL_STATE", "Stato");
	//City
	define("LANG_LABEL_CITY", "Città");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Quartiere");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Paesi");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regioni");
	//States
	define("LANG_LABEL_STATE_PL", "Stati");
	//Cities
	define("LANG_LABEL_CITY_PL", "Città");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Quartieri");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Aggiungere una nuova regione");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Aggiungere una nuovo stato");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Aggiungere una nuova città");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Aggiungere una nuovo quartiere");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Scegli una regione esistente");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Scegli un stato esistente");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Scegli una città esistente");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Scegli un quartiere esistente");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Nessuna località trovato");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Rinnovo");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Data del Rinnovo");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Indirizzo");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Indirizzo Web");
	//Phone
	define("LANG_LABEL_PHONE", "Telefono");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Descrizione per esteso");
	//Status
	define("LANG_LABEL_STATUS", "Stato");
	//Level
	define("LANG_LABEL_LEVEL", "Livello");
	//Empty
	define("LANG_LABEL_EMPTY", "Vuoto");
	//Start Date
	define("LANG_LABEL_START_DATE", "Data di inizio");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Data di inizio");
	//End Date
	define("LANG_LABEL_END_DATE", "Data Fine");
	//End Date
	define("LANG_LABEL_ENDDATE", "Data Fine");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Data non valida");
	//Start Time
	define("LANG_LABEL_START_TIME", "Orario Inizio");
	//End Time
	define("LANG_LABEL_END_TIME", "Orario Fine");
	//unlimited
	define("LANG_LABEL_UNLIMITED", "Illimitato");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Scegliere un tipo");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Scegliere una Categoria");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Tempo Rimasto");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Vedi l'Offerta");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Nessuno Offerta");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Scegliere uno Offerta");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nome");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nome");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Recapito telefonico");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-mail");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Indirizzo");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Inviate le recensioni e traffico delle listings");
	//Invoice
	define("LANG_LABEL_INVOICE", "Fattura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Fattura #");
	//Item
	define("LANG_LABEL_ITEM", "Articolo");
	//Items
	define("LANG_LABEL_ITEMS", "Articoli");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Categoria Extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Codice Sconto");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Prezzo dell'articolo");
	//Amount
	define("LANG_LABEL_AMOUNT", "Importo");
	//Tax
	define("LANG_LABEL_TAX", "Imposta");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Totale parziale");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Intestare assegni a");
	//Total
	define("LANG_LABEL_TOTAL", "Totale");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Titolo");
	//Caption
	define("LANG_LABEL_CAPTION", "Intestazione");
	//impressions
	define("LANG_IMPRESSIONS", "stampe");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Stampe");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Per stampe");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Per periodo di tempo");
	//Date
	define("LANG_LABEL_DATE", "Data");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "La tua E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Soggetto");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Messaggio aggiuntivo");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Forma di pagamento");
	//Notes
	define("LANG_LABEL_NOTES", "Note");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "È facile e veloce!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Fai gli recensioni, lascia commenti sul blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Fai gli recensioni");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Hai già l");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Goditi i nostri servizi!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Prova la Password");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Hai dimenticato la tua password?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Sommario");
	//Detail
	define("LANG_LABEL_DETAIL", "Dettaglio");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail del tuo amico)");
	//From
	define("LANG_LABEL_FROM", "Da");
	//To
	define("LANG_LABEL_TO", "A");
	//to
	define("LANG_LABEL_DATE_TO", "a");
	//Last
	define("LANG_LABEL_LAST", "Último");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Ultimi");
	//day
	define("LANG_LABEL_DAY", "giorno");
	//days
	define("LANG_LABEL_DAYS", "giorni");
	//New
	define("LANG_LABEL_NEW", "Nuovo");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Nuovo FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Carattere");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Accesso tramite banner");
	//Added
	define("LANG_LABEL_ADDED", "Aggiunto");
	//Add
	define("LANG_LABEL_ADD", "Aggiungi");
	//rating
	define("LANG_LABEL_RATING", "valutazione");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "stimatore");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Recensore");
	//System
	define("LANG_LABEL_SYSTEM", "Sistema");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Iscriviti a RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Resistenza Password");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Titolo dell'Articolo");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "Descrizione SEO");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "Parole chiavi SEO");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "Non sono ammessi a interruzioni di linea");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separare gli elementi con una virgola (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Clicca qui per compilare le informazioni SEO su questo articolo");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO aggiornate con successo!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Clicca qui per vedere questo articolo");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Clicca qui per modificare questo articolo");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Clicca qui per aggiungere/modificare una galleria di foto per questo articolo");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Galleria di foto non disponibile per questo articolo");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Clicca qui per vedere i commenti su questo articolo");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Cronologia di questo articolo");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Cronologia non disponibile per questo articolo");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Clicca qui per cancellare questo articolo");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Clicca qui per vedere questo banner");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Clicca qui per modificare questo banner");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Clicca qui per vedere i commenti su questo banner");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Cronologia di questo banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Cronologia non disponibile per questo banner");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Clicca qui per cancellare questo banner");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Titolo Annuncio");
	//Click here to
	define("LANG_MSG_CLICKTO", "Clicca anche qui");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Clicca qui per vedere questo annuncio");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Clicca qui per modificare questo annuncio");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Clicca qui per aggiungere/modificare una galleria fotografica per questo annuncio");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Galleria fotografica non disponibile per questo annuncio");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Clicca qui per vedere i commenti a questo annuncio");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Clicca qui per sincronizzare la mappa sulla la località di questo annuncio");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Sincronizzazione mappa non disponibile per questo annuncio");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Cronologia di questo annuncio");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Cronologia non disponibile per questo annuncio");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Clicca qui per cancellare questo annuncio");
	//Event Title
	define("LANG_EVENT_TITLE", "Titolo Evento");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Clicca qui per vedere questo evento");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Clicca qui per modificare questo evento");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Clicca qui per aggiungere/modificare la galleria di foto per questo evento");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Galleria di foto non disponibile per questo evento");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Clicca qui per vedere i commenti a questo evento");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Clicca qui per sincronizzare la mappa sulla località di questo evento");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Sincronizzazione mappa non disponibile per questo evento");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Cronologia di questo evento");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Cronologia non disponibile per questo evento");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Clicca qui per cancellare questo evento");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Titolo della Galleria");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Clicca qui per vedere questa galleria");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Clicca qui per modificare questa galleria");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Clicca qui per cancellare questa galleria");
	//Listing Title
	define("LANG_LISTING_TITLE", "Titolo Listing");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Clicca qui per vedere questo listing");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Clicca qui per modificare questo listing");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Clicca qui per aggiungere/modificare la galleria di foto per questo listing");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Galleria di foto non disponibile per questo listing");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Clicca qui per cambiare lo offerta di questo listing");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Offerta non disponibile per questo listing");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Clicca qui per vedere i commenti a questo listing");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Clicca qui per sincronizzare la mappa sulla località di questo listing");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Sincronizzazione mappa non disponibile per questo listing");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Indirizzo non trovato.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Modifica il tuo articolo.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Clicca qui per per leggere i recensioni su questo articolo");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "I recensioni sull'articolo non sono disponibili");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Cronologia di questo listing");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Cronologia non disponibile per questo listing");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Clicca qui per cancellare questo listing");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Salva");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Ulteriori Informazioni");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Prova ad usare qualcosa di descrittivo, come il \"10% fuori del nostro prodotto\" o \"3 al prezzo di due sul nostro prodotto\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Inserire il valore del prodotto / servizio che state offrendo. Scegli un tipo di sconto (valore fisso o percentuale), e inserire il valore corrispondente. Verificare il calcolo e quindi di fornirci il numero di offerte che si desidera fare.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Si prega di essere sicuri che l'immagine è la dimensione giusta prima di caricarlo, altrimenti l'immagine sarà probabilmente allungato per adattarsi al sito e la qualità dell'immagine sarà modificata.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Ogni offerta deve essere collegata ad una listing per essere attivo sul sito.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associare alla listing");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Inserisci il tuo titolo voce e attendere i suggerimenti delle associazioni disponibili.");
	//Empty
	define("LANG_EMPTY", "Vuoto");
	//Cancel
	define("LANG_CANCEL", "Cancella");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Periodo di Tempo Personalizzati");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Corretto Valore di Sconto");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Percentuale di Sconto");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valore con sconto");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Sconto (Calcolato)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Quanti affare volete offrire");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Collegato alla Listing");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Scegliere una Listing");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Non è possibile aggiungere le offerte diverse per la stessa listing.");
	//Deals successfully updated1
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Offerte aggiornato con successo!");
	//Options
	define("LANG_LABEL_OPTIONS", "Opzioni");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Titolo dela Offerta");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Clicca qui per vedere questo offerta");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Clicca qui per modificare questo offerta");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Clicca qui per cancellare questo offerta");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Vai su \"Listings\" e clicca sull'icona dello offerta appartenente all'elenco in cui vuoi aggiungere la offerta. Scegli una offerta da aggiungere al tuo listing per renderla attiva.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Le rate si ripeteranno fino alla scadenza della carta");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "Il numero massimo di rate è 36");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Centro SEO");
	//View
	define("LANG_LABEL_VIEW", "Vedi");
	//Edit
	define("LANG_LABEL_EDIT", "Editar");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galeria");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Rapporti sul Traffico");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Non pagato");
	//Paid
	define("LANG_LABEL_PAID", "Pagati");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "In attesa dell'approvazione");
	//Under review
	define("LANG_LABEL_ANALYSIS", "In corso di revisione");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponibile");
	//In dispute
	define("LANG_LABEL_DISPUTE", "In controversia");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Rimborsati");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Annullato");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transazione");
	//Delete
	define("LANG_LABEL_DELETE", "Cancella");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Sincronizzazione della mappa");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Nascondi Mappa");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Mostra Mappa");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Stampa");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "In attesa di approvazione");
	//Image
	define("LANG_LABEL_IMAGE", "Immagine");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Immagini");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Campo obbligatorio");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Si prega di digitare tutti i campi obbligatori.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informazioni sull'Account");
	//Username
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Password Attuale");
	//Password
	define("LANG_LABEL_PASSWORD", "Password");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Crea password");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nuova Password");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Ridigita la Password");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Ridigita la Password");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Ridigita la nuova Password");
    //OpenID URL
	define("LANG_LABEL_OPENIDURL", "URL ID aperto");
	//Information
	define("LANG_LABEL_INFORMATION", "Informazione");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Data di Publicazione");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendario");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Url Amichevole");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Ad esempio");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Fonte Immagine");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Attributo Immaggine");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Legenda Immagine");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Sommario");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Parole chiavi per la ricerca");
	//maximum
	define("LANG_LABEL_MAX", "massimo");
	//keywords
	define("LANG_LABEL_KEYWORDS", "parole chiavi");
	//Content
	define("LANG_LABEL_CONTENT", "Contenuto");
	//Code
	define("LANG_LABEL_CODE", "Codice");
	//free
	define("LANG_FREE", "GRATIS");
	//free
	define("LANG_LABEL_FREE", "gratis");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Url di destinazione");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "File");
	//Warning
	define("LANG_LABEL_WARNING", "Avvertenza");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Mostra URL (facoltativo)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Descrizione linea 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Descrizione linea 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Località");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Indirizzo (facoltativo)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Indirizzo (Facoltativo)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Descrizione Dettaglio");
	//Price
	define("LANG_LABEL_PRICE", "Prezzo");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Prezzi");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Recapito");
	//Language
	define("LANG_LABEL_LANGUAGE", "Lingua");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Scegli la lingua principale per comunicare(quando necessario).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Nome");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Nome");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Cognome");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Cognome");
	//Company
	define("LANG_LABEL_COMPANY", "Società");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Indirizzo Riga1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Indirizzo Riga2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitudine");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitudine");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Non trovato. Per favore, cerca di specificare meglio la posizione.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "I campi seguenti contengono errori:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitudine deve essere un numero compreso tra -90 e 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitudine deve essere un numero compreso tra -180 e 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Nome Località");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Data Evento");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Descrizione");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Informazioni utili");
	//Text
	define("LANG_LABEL_TEXT", "Testo");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Aggiungi Immagine");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Aggiungi Immagine");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Modifica Leggende Immagine");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "File d'immagine");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Mini Leggenda");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Leggenda Immagine");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Nota, il caricamento potrebbe richiedere diversi a seconda della grandezza del file e dalla velocità di connessione. Premere ricerca o navigare su altre pagine annullerà il trasferimento.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Codice Frammento Video");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Allega file aggiuntivo");
	//Attention
	define("LANG_LABEL_ATTENTION", "Attenzione");
	//Source
	define("LANG_LABEL_SOURCE", "Fonte");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Ore di lavoro");
	//Default
	define("LANG_LABEL_DEFAULT", "Predefinito");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Metodo di pagamento");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Con Carta di Credito");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Via PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Via SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Via Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Stampa la Fattura e Spedisci un Assegno");
	//Headline
	define("LANG_LABEL_HEADLINE", "Intestazione");
	//Offer
	define("LANG_LABEL_OFFER", "Offerta");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Condizioni");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Date dello Offerta");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Foto dello Offerta");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Offerta stampabile");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Lo nostro offerta basata su un modello HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Compila i campi in alto ed inserisci un logo o un");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Uno Offerte fornita invece da te");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Immagine JPG o GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Titolo");
	//Comment
	define("LANG_LABEL_COMMENT", "Recensione");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Accettato");
	//Approved
	define("LANG_LABEL_APPROVED", "Approvato");
	//Success
	define("LANG_LABEL_SUCCESS", "Successo");
	//Completed
	define("LANG_LABEL_COMPLETED", "Completato");
	//Y
	define("LANG_LABEL_Y", "S");
	//Failed
	define("LANG_LABEL_FAILED", "Fallito");
	//Declined
	define("LANG_LABEL_DECLINED", "Rifiutato");
	//failure
	define("LANG_LABEL_FAILURE", "insuccesso");
	//Canceled
	define("LANG_LABEL_CANCELED", "Annullato");
	//Error
	define("LANG_LABEL_ERROR", "Errore");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Codice della Transazione");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "ID Sottoscrizione");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "cronologia transazione");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Codice di Autorizzazione");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Stato della Transazione");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Errore di Transazione");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Importo Accredito Mensile");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transazione OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Importo Accredito Annuale");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Importo Accredito");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "ID della Transazione");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "ID della Ricevuta");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "ID Sotoscrizione");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "ID Ordine di Transazione");
	//your
	define("LANG_LABEL_YOUR", "seu");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Fai tuo");
	//Payment
	define("LANG_LABEL_PAYMENT", "Pagamento");
	//History
	define("LANG_LABEL_HISTORY", "Cronologia");
	//Sign in
	define("LANG_LABEL_LOGIN", "Accedi");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transazione annullata");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Importo della transazione");
	//Pay
	define("LANG_LABEL_PAY", "Paga");
	//Back
	define("LANG_LABEL_BACK", "Indietro");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Prezzo totale");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Paga tramite Fattura");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Amministratore");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informazioni sulla fatturazione");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Numero della Carta");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Scadenza della Carta");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Codice della Carta");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Informazioni sul Cliente");
	//zip
	define("LANG_LABEL_ZIP", "zip");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Fai un Ordine e Continua");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Informazione Generale");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Numero di telefono");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Indirizzo E-mail");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informazioni sulla Carta di Credito");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Data di scadenza");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Informazioni Cliente");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Scadenza Carta");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nome sulla Carta");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Tipo di Carta");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Numero di Verificazione della Carta");
	//Province
	define("LANG_LABEL_PROVINCE", "Provincia");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Codice Postale");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Codice Postale");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Scegli la Data");
	//Found
	define("LANG_PAGING_FOUND", "Encontrado");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Trovate");
	//record
	define("LANG_PAGING_RECORD", "registro");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "registrazioni");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "mostrando la pagina");
	//of
	define("LANG_PAGING_PAGEOF", "di");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "pagine");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Vai a pagina");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Scegli");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Ordina per:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caratteri");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Último Aggiornamento");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Data di Creazione");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popolari");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Valutazione");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Prezzo");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "pagina precedente");
	//next page
	define("LANG_PAGING_NEXTPAGE", "pagina successiva");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "precedente");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "successiva");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Articolo aggiunto con successo!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Banner aggiunto con successo!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Annuncio aggiunto con successo!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Evento aggiunto con successo!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Galleria aggiunta con successo!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Listing aggiunto con successo!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Offerte aggiunta con successo!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Articolo aggiornato con successo!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Banner aggiornato con successo!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Annuncio aggiornato con successo!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Evento aggiornato con successo!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Galleria aggiornata con successo!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Listing aggiornato con successo!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Offerte aggiornata con successo!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Sincronizzazione mappa aggiornata con successo!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Galleria cambiata con successo!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Offerte è stato eliminato con successo!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Offerte cambiata con successo!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Banner cancellato con successo!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Formato immagine non valido. Inserire una immagine JPG, GIF o PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Il file di immagine è troppo grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Si prega di riprovare con un'altra immagine.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Il file allegato è stato rifiutato. Formato file non valido.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Clicca qui per vedere questa galleria");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Clicca qui per gestire le immagini di questa galleria");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Inserisci la tua e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail non è stato trovato.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Prova di nuovo o contatta il supporto tecnico al:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Il Sistema Password Dimenticata è disabilitato.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Si prega di contattare il supporto tecnico al:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Grazie!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "È stata inviata una e-mail al titolare dell'account con le istruzioni per ottenere una nuova password");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "File non trovato!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Errore! Nessuna Minifoto!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "Non è ancora stata caricata alcuna immagine in questa galleria!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Clicca qui per stampare la fattura");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Clicca qui per vedere i dettagli della fattura");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(Gli importi dei prezzi sono per rata)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Articolo non pagato");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Non è richiesto il saldo del conto");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Muovi il mouse sulle barre per vedere più informazioni sul grafico)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Clicca il tipo di rapporto per visualizzare il grafico)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Clicca qui per vedere questa recensione");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Clicca qui per modificare questa recensione");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Clicca qui per modificare questa risposta");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Clicca qui per cancellare questa recensione");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "In attesa dell'approvazione dell'Amministratore del Sito");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "In Attesa del'approvazione dell'amministratore del sito per la recensione");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "In Attesa del");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "In Attesa del");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Recensione già Approvata");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Recensione e Risposta già Approvate");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Recensione in attesa di approvazione");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Risposta in attesa di approvazione");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Recensione Attiva");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Risposta Attiva");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Recensione e Risposta in attesa di approvazione");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Recensione e Risposta Attive");
	//Reply
	define("LANG_REPLY", "Rispondi");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Risposta");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Recensione e Risposta");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Modifica Recensione");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Modifica Risposta");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Approva Recensione");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Approva Risposta");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Risposta già approvata");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Recensione inviata con successo!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Risposta inviata con successo!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Immetti una risposta valida!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Immetti un nome valido");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Imnetti un indirizzo e-mail valido!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Immetti una città, uno stato valido!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Immetti un titolo valido!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Immetti una recensione valida!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Scegli un");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Clicca qui per rispondere a questa recensione");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Clicca qui per vedere questa transazione");	
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail deve essere compreso tra");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caratteri senza spazi.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "La password deve essere tra");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Immetti qui la tua password se vuoi cambiarla.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "La Password sarà inviata all");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Si prega di scrivere il vostro e-mail e password per riferimento futuro.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Si prega di verificare l\'accordo di termini.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Aggiunto con successo!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Questa categoria è gia stata inserita");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Scegli una categoria valida");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Prima scegli una categoria");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Puoi scegliere il titolo del nome di una pagina per essere accessibile direttamente dal browser web come pagina html statica. Il titolo del nome della pagina scelto deve contenere solo caratteri alfanumeri (come 'a-z' e/o '0-9') e '-' invece di spazi.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Il titolo nome della pagina \"John Auto Repair\" saranno disponibili attraverso la url:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "È possibile aggiungere altre immaggini alla");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "galleria (Se è abilitata).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Dimensione massima del file");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .gif o .png non supportato");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animated .gif non è supportato.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Assicurarsi che le dimensioni della vostra immagine in forma con le dimensioni consigliate del pixel, altrimenti la qualità dell'immagine può essere influenzata.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Segna questa casella per rimuovere la tua immagine già esistente");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "al massimo 250 caratteri");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "al massimo 100 caratteri");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caratteri rimanenti");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(inclusi gli spazi e le interruzioni di riga)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Includi fino a");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "parole chiavi con un massimo di 50 caratteri per ognuna.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Aggiungi una parola chiave o frase chiave per rigo. Ad esempio:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Selezionare solo quelle sottocategorie applicabili al tuo genere.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Il tuo articolo apparirà automaticamente nella categoria principale di ogni sottocategoria scelta.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "al massimo 25 caratteri");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "al massimo 500 caratteri");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Tipi di archivi consentiti");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Clicca qui per vedere questo listing in anteprima");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Clicca qui per vedere questo evento in anteprima");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Clicca qui per vedere questo annuncio in anteprima");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Clicca qui per vedere questo articolo in anteprima");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Clicca qui per vedere questo banner in antepima");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Clicca qui per vedere questo offerte in anteprima");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Clicca qui per vedere questa galleria in anteprima");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "30 caratteri al massimo");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Scegli un Paese");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Scegli una Regione");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Scegli un Stato");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Scegli una Città");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Scegli un Quartiere");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Questa infrmazione non sarà visualizzata pubblicamente)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Il tuo evento apparirà automaticamente nella categoria principale di ogni sottocategoria che hai selezionato.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Se il codice del video ridotto è stato compilato, apparirà sulla pagina delle informazioni");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Dimensione massima del codice video supportata");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Se la dimensione del codice video è maggiore della dimensione video supportata, sarà modificata.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "L");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Seleziona questa casella per rimuovere l");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Aggiungi una frase per rigo. Ad esempio");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Categorie extra/Sottocategorie costano un");
	//additional
	define("LANG_MSG_ADDITIONAL", "aggiuntivo");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "ognuna. Fatti vedere!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Il tuo listing apparirà automaticamente nella categoria principale di ogni sottocategoria che scegli.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Se si aggiungono le nuove categorie, il vostro listing non verrà visualizzato nella categoria principale di ogni sottocategoria è stato aggiunto al gestore del sito li approva.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Se si aggiungono le nuove categorie, il vostro articolo non verrà visualizzato nella categoria principale di ogni sottocategoria è stato aggiunto al gestore del sito li approva.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Se si aggiungono le nuove categorie, il vostro annuncio non verrà visualizzato nella categoria principale di ogni sottocategoria è stato aggiunto al gestore del sito li approva.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Se si aggiungono le nuove categorie, il vostro evento non verrà visualizzato nella categoria principale di ogni sottocategoria è stato aggiunto al gestore del sito li approva.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Chiedi che il tuo listing sia considerato per le seguenti distintivi.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Clicca qui per selezionare la data");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Clicca sulla");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "icona della galleria");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "in basso se vuoi aggiungere delle foto alla tua galleria di foto.");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Clicca sulla");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "icona dello Offerte");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "in basso se vuoi aggiungere delle Offerte al tuo elenco.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Puoi aggiungere uno offerte al tuo elenco cliccando sul collegamento");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "aggiungi offerte");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Tutte le pagine eccetto quelle dell'articolo");
	//All pages
	define("LANG_ALLPAGES", "Tutte le pagine");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Ricerca Non-categoria");
	//deal
	define("LANG_ICONPROMOTION", "offerta");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "e-mail ad un amico");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "aggiungi ai preferiti");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "rimuovi da preferiti");
	//print
	define("LANG_ICONPRINT", "stampa");
	//map
	define("LANG_ICONMAP", "mappa");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Aggiungi a");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google maps non è disponibile. Contattare l");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Rimuovi");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Articoli Preferite");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Annunci Preferite");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Eventi Preferite");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Listings Preferite");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Offerte Preferite");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Pubblicato");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Ulteriori informazioni");
	//Date
	define("LANG_EVENT_DATE", "Data");
	//Time
	define("LANG_EVENT_TIME", "Ora");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Ottieni indicazioni stradali");
	//Website
	define("LANG_EVENT_WEBSITE", "Sito web");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Telefono");
	//More
	define("LANG_EVENT_MORE", "Altro");
	//More Info
	define("LANG_EVENT_MOREINFO", "Ulteriori informazioni");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Tutte le categorie");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Vedi tutte le categorie");
	//More Info
	define("LANG_LISTING_MOREINFO", "Ulteriori informazioni");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "vedi telefono");
	//view fax
	define("LANG_LISTING_VIEWFAX", "vedi fax");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "invia una e-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Clicca qui per vedere ulteriori informazioni!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Compila il modulo sottostante per contattarci.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contatta questa Listing");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Invia domanda");
	//phone
	define("LANG_LISTING_LETTERPHONE", "telefono");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "sito web");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "offre i seguenti prodotti e/o servizi:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "ore di lavoro");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review found for this item!
	define("LANG_REVIEW_NORECORD", "Nessuna recensione trovata per questo articolo!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Recensioni e commenti a partire dal mese scorso");
	//Review
	define("LANG_REVIEW", "Recensione");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Recensioni");
	//Reviews
	define("LANG_REVIEWTITLE", "Recensioni");
	//review
	define("LANG_REVIEWCOUNT", "recensione");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "recensioni");
	//check in
	define("LANG_CHECKINCOUNT", "check in");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "check ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "See check ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check ins di");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Nessun check in trovato per questo articolo!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Categorie correlate");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Sottocategorie");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Vedi recensioni");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Fai una stima!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Commenta per primo questo articolo!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Offerto da");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Ulteriori informazioni");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Valido da");
	//to
	define("LANG_PROMOTION_VALIDTO", "a");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Stampa Offerte");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Articolo");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Articoli");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banners");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Annuncio");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Annunci");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Evento");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Eventi");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Listing");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listings");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Offerta");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Offerte");
	//Send
	define("LANG_BUTTON_SEND", "Invia");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Sottoscrivi");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Vedi il percorso della Categoria");
	//More info
	define("LANG_VIEWCATEGORY", "Maggiori informazioni");
	//No info found
	define("LANG_NOINFO", "Senza info trovato");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Rimuovi la categoria selezionata");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continua");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "No, grazie");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Sì, continuare.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "No, Ordine senza il Pacchetto.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Aumentare la vostra Visibilità!");
	//Gift
	define("LANG_GIFT", "Regalo");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Contribuire ad aumentare la vostra visibilità, controllare il nostro ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Statistiche del sito!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitatori al Mese");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Custom opzione");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancella");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Accedi");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Salva Sincronizzazione Mappa");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Azzera Sincronizzazione Mappa");
	//Next
	define("LANG_BUTTON_NEXT", "Succesivo");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Paga tramite Carta di Credito");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Paga via PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Paga via SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Cerca");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avanzata");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Chiudi");
	//Clear
	define("LANG_BUTTON_CLEAR", "Limpar");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Aggiungi il tuo articolo");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Aggiungi il tuo annuncio");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Aggiungi il tuo evento");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Aggiungi il tuo listing");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Aggiungi la tuo Offerte");
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Gestisci Account");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gestione dei Contenuti");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Sponsor Area");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Area Amministrativa");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Sezione Amministrativa");
	//Help
	define("LANG_BUTTON_HELP", "Guida");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Esci");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Invia");
	//Update
	define("LANG_BUTTON_UPDATE", "Aggiorna");
	//Back
	define("LANG_BUTTON_BACK", "Indietro");
	//Delete
	define("LANG_BUTTON_DELETE", "Cancella");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Completa il procedimento");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Si prega di inserire il testo che vedi nell'immagine a sinistra nella casella di testo. Ciò è necessario per impedire la presentazione automatica delle richieste di contatto.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "L'immagine del codice di verifica non può essere visualizzata");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Codice di verifica");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Scegli una valutazione per questo articolo");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Frode rilevata! Scegli una valutazione per questo articolo!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Recensione\" e \"Titolo\" sono richiesti per inviare una recensione!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Nome\" e \"E-mail\" sono richiesti per inviare una recensione!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Città, Stato\" sono richiesti per inviare una recensione!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Immettere un indirizzo e-mail valido!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Hai già dato la tua opinione su questo articolo. Grazie.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Grazie per la tua opinione!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Il tua recensione è stato inviato ad approvazione.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Non è stato scelto un metodo di pagamento!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "La scadenza della carta di credito è errata. Si prega di riprovare.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Clicca qui per riprovare");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "La transazione del pagamento potrebbe non essere immediata.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Dopo che il pagamento è stato espletato, le informazioni sulla tua transazione");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "saranno disponibili nella tua cronologia delle transazioni.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "saranno disponibili nella tua");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "Il gateway di pagamento al momento non è disponibile");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Non è stato possibile convalidare i parametri del pagamento");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Incontrato errore interno del gateway");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "È possibile trovare informazioni sulla tua transazione");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "nella tua cronologia delle transazioni.");
	//in your
	define("LANG_MSG_IN_YOUR", "nella tua");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "Nesun ID della transazione");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Errore di sistema, riprovare.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Compila tutti i campi richiesti.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Impossibile connettersi.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Grazie per aver sistemato i tuoi articoli ed eseguito il pagamento!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "L");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "Il gateway di pagamento non poteva rispondere");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Il tempo richiesto per l");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Mancata connessione");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Compila correttamente il cap.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Compila correttamente il numero di verifica della carta.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Il tipo di carta e il codice di verifica della carta non coincidono.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "Transazione non completata.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Numero d'errore:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Messaggio breve:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Messaggio lungo:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transazione completata con successo.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "La data di scadenza della carta deve essere futura");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Se la tua transazione è stata confermata, puoi trovare le relative informazioni nella");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "tua cronologia delle transazioni dopo che il pagamento è stato espletato.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "dopo l'espletazione del tuo pagamento.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Non ci sono articoli che richiedono un pagamento.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Paga le fatture in sospeso");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "I banner da stampa e le fatture personalizzate possono essere pagati una volta.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "I banner da stampa possono essere pagati una volta.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Le fatture personalizzate possono essere pagate una volta.");
	//View Items
	define("LANG_VIEWITEMS", "Vedi articoli");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Si prega di non usare il sistema di pagamento periodico.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Riprova!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Tutti i campi sono obbligatori.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Tu hai più di");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Si prega di contattare l'amministratore per effettuare il pagamento.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Opzioni sull'Articolo");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Autore dell'articolo");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL dell'autore dell'articolo");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Categorie dell'articolo");
	//Banner Type
	define("LANG_BANNER_TYPE", "Tipo di banner");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Opzioni sul Banner");
	//Order Banner
	define("LANG_ORDER_BANNER", "Ordina banner");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Dal periodo di tempo");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Dettagli del banner");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Banner script");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mostra da codice script");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Consenti l'immissine di uno script al posto di un'immagine. Questo campo ti permette di copiare uno script che sarà usato per visualizzare il banner da un programma affiliato o da un sistema di banner esterno. Se l'opzione \"Show by Script Code\" è selezionata, sarà rihiesto solo il campo \"Script\". Gli altri campi in basso non saranno necessari.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Entrambi \"Url di destinazione\" e \"CliccaAttraverso Rapporto sul Traffico\" non hanno effetto quando carichi banner di script.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Entrambi \"Url di destinazione\" e \"CiccaAttraverso Rapporto sul Traffico\" non hanno effeto quando carichi un file swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Livello dell'annuncio");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Categoria dell'annuncio");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Scegli il livello dell'annuncio");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Opzioni Annuncio");
	//Event Level
	define("LANG_EVENT_LEVEL", "Livello dell'evento");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Categorie dell'evento");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Categorie dell'evento");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Scegli il livello dell'evento");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Opzioni Evento");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Livello del listing");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Tipo di annuncio");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Categorie del listing");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Distintivi del listing");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Soggetto ad approvazione dell'amministratore.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Seleziona questa scelta");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Seleziona il livello del listing");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Opzioni Listing");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "Il Sistema di Autorizzazione Pagamento non è al momento disponibile. Si prega di contattare ");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "Il sistema di pagamento iTransact non è al momento disponibile. Si prega di contattare");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "Il sistema di pagamento LinkPoint non è al momento disponibile. Si prega di contattare");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "Il sistema di pagamento PayFlow non è al momento disponibile . Si prega di contattare");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "Il sistema di pagamento PayPal non è al momento disponibile. Si prega di contattare");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "Il sistema di pagamento PayPalAPI non è al momento disponibile. Si prega di contattare");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "Il sistema di pagamento PSIGate non è al momento disponibile. Si prega di contattare");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "Il sistema di pagamento 2CheckOut non è al momento disponibile. Si prega di contattare");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "Il sistema di pagamento WorldPay non è al momento disponibile. Si prega di contattare");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "Il pagamento SimplePay sistema non è disponibile al momento. Si prega di contattare il");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Avviso caricamento");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Il file è stato trasferito con successo!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Estensione non consentita o formato file errato!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Il file supera il limite di grandezza!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Tentativo creazione directory fallito!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Permesso directory errato!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Errore inaspettato!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "File non trovato o non è entrato!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "File già eistente nella directory!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Vedi tutte le località");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Località in Evidenza");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Non ci sono località in evidenza nel sistema.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Panoramica");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Località mappa");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Altri listings");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Altri eventi");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Altri annunci");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Altri articoli");
	//"Operation not allowed: The deal" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Operazione non consentita: lo offerte");
	//Operation not allowed: The deal (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "è già associata ad elenco");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "In sospeso");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "Aborted");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Fallito");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Diminuita");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Unknow");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Successo");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Fare clic su \"Aggiungere\" per selezionare le categorie");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Fare clic su \"Aggiungi categoria principale\" o \"Aggiungi sotto-categoria\" di digitare il vostro nuove categorie");
	//Add an
	define("LANG_ADD_AN", "Aggiungi un");
	//Add a
	define("LANG_ADD_A", "Aggiungi un");
	//on these sites
	define("LANG_ON_SITES", "su questi siti:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "su questo sito:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slideshow");
	//on
	define("LANG_SLIDESHOW_ON", "su");
	//off
	define("LANG_SLIDESHOW_OFF", "chiuso");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Galleria di foto");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Clicca qui");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "per la proiezione diapositive. Puoi anche cliccare su qualsiasi foto per iniziare la proiezione diapositive.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "altre foto");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Codice sconto inesistente");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "non è disponibile.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "non è disponibile per questo tipo di articolo.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "non può essere usato due volte.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "puoi scegliere fino a");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "galeria.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "gallerie.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "È richiesto il titolo.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "È richiesta la lingua.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "È richiesto il nome.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "È richiesto il cognome.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "È richiesto il nome della società.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "È richiesto il telefono.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "È richiesto il e-mail.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "È richiesto il account.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "È richiesto il nome della pagina.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "È richiesto la categoria.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "È richiesto il sommario.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "È richiesto il tipo di scadenza.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "È richiesto la data di rinnovo.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Sono richieste le stampe.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "È richiesto il file.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "È richiesto il tipo.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "È richiesta il Intestazione.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "È richiesto il codice script.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "È richiesta la descrizione 1.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "È richiesta la descrizione 2.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "È richiesto il nome.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Titolo dela Offerta è richiesto.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "È richiesta L'offerta.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "È richiesta La data d'inizio.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "È richiesta La data fine.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "È richiesto il testo.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail è obbligatorio.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"La Password corrente\" non è corretta.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "È richiesta \"La password\".");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "È richiesto\"Acetto le condizioni per l'uso\".");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "I seguenti campi non sono stati compilati o contengono errori:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Titolo - Si prega di compilare il campo");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nome della pagina - Compila i campi");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Un massimo di");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categorie sono consentite.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Nome della pagina della URL amichevole già in uso, scegli un altro Nome della Pagina.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Il Nome della Pagina contiene caratteri non validi");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Un massimo di");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "parole chiavi è consentito");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Includi parole chiavi con un massimo di 50 caratteri ciascuna");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Immetti una valida \"Data di Pubblicazione\".");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Immetti una valida \"Data d'inizio\".");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Immetti una valida \"Data conclusiva\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "La \"Data conclusiva\" deve essere maggiore o uguale alla \"Data d'inizio\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "Il \"Orario Fine\" deve essere maggiore di \"Orario Inizio\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "La \"Data conclusiva\" non può essere passata.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Immetti un valido indirizzo e-mail.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Immetti una valida \"URL\".");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Fornisci una descrizione usando al massimo di 255 caratteri.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Fornisci le condizioni usando al massimo 255 caratteri.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Immetti una data di rinnovo valida.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "La data di rinnovo deve essere futura.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Immetti una data di scadenza valida.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "La data di scadenza deve essere futura.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Per la password non sono consentiti spazi vuoti.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Immetti una password con un massimo di");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Immetti una password con un minimo di");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Si prega di inserire un e-mail valido.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Siamo spiacenti, non è possibile modificare queste informazioni dell'account");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Password \"abc123\" non consentita!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Le passwords non coincidono. Immetti lo stesso contenuto per i campi \"password\" e \"ridigita la password\".");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Non sono consentiti spazi per i messaggi e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "I caratteri speciali non sono ammessi per e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Si prega di digitare una e-mail con un massimo di");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Si prega di digitare una e-mail con un minimo di");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Si prega di scegliere una diversa e-mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Clicca qui se non vedete la vostra categoria");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Aggiungi categoria principale");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Aggiungi sottocategoria");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Il titolo della categoria già registrato!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Il titolo della categoria disponibili!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Home");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Gestisci");
	//Add
	define("LANG_MENU_ADD", "Aggiungi");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Opzioni per gli sponsor");
	//Listings
	define("LANG_MENU_LISTING", "Listings");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Aggiungi Listing");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Gestisci Listings");
	//Galleries
	define("LANG_MENU_GALLERY", "Gallerie");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Aggiungi Galleria");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Gestisci Galleria");
	//Events
	define("LANG_MENU_EVENT", "Eventi");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Aggiungi Evento");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Gestisci Eventi");
	//Banners
	define("LANG_MENU_BANNER", "Banners");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Aggiungi Banner");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Gestisci Banners");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Annunci");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Aggiungi Annuncio");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Gestisci Annunci");
	//Articles
	define("LANG_MENU_ARTICLE", "Articoli");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Aggiungi Articolo");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Gestisci Articoli");
	//Deals
	define("LANG_MENU_PROMOTION", "Offerte");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Aggiungi Offerta");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Gestisci Offerte");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Fai pubblicità con noi");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Pagina non Trovata");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Pagina di Manutenzione");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Mappa del sito");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contattaci");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Opzioni di Pagamento");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Verifica");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Esegui il tuo pagamento");
	//History
	define("LANG_MENU_HISTORY", "Cronologia");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Cronologia Transazioni");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Cronologia Fattura");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Scegli un Tema");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Scegliere uno Schema di Colori");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Cerca Articolo");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Cerca Annuncio");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Cerca Evento");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Cerca Listing");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Cerca Offerta");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Ricerca avanzata");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Cerca");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Località");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Scegli un Paese");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Scegli una Regione");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Scegli uno Stato");	
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Scegli una Città");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Scegli un Quartiere");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Categoria");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Scegli una Categoria");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtro");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Abbinamento Esatto");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Qualsiasi Parola");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Tutte le Parole");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Tipo di Listing");
	//from
	define("LANG_SEARCH_LABELFROM", "da");
	//to
	define("LANG_SEARCH_LABELTO", "a");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "di");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Cerca per parola chiave ");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Cerca");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Si prega di fornire solo le parole con almeno [FT_MIN_WORD_LEN] lettere per la ricerca!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "In Evidenza");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Articoli Recenti");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Eventi Imminenti");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Annunci in Evidenza");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Articoli in Evidenza");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Listings in Evidenza");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Offerte in Evidenza");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Visualizza tutti gli articoli");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Visualizza tutti gli eventi");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Visualizza tutti gli annunci");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Visualizza tutti gli listings");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Visualizza tutti gli offerte");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Recenti Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Facile e Veloce.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Passi");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Passi");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Crea un Account");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Aggiornamento Listing");
	//Order
	define("LANG_ORDER", "Ordine");
	//Check Out
	define("LANG_CHECKOUT", "Verifica");
	//Configuration
	define("LANG_CONFIGURATION", "Configurazione");
	//Select a level
	define("LANG_SELECTPACKAGE", "Selezionare un livello");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Opzioni Profilo");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Account di Directory ");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Il mio account di OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Il mio account di Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Il mio account di Google");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Hai già un account?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "No, sono un nuovo utente.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Si, ho un Account attivo.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Accedo con il mio account di Direttorio.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Accedo con il mio account di OpenID 2.0.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Accedo con il mio account di Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Accedo con il mio account di Google.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informazioni sull'Account");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Informazioni aggiuntive");
	//Please write down your username and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Si prega di scrivere il vostro e-mail e password per riferimento futuro.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail deve essere un valido e-mail tra");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "e");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caratteri senza spazi.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "La password deve essere tra");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "e");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caratteri senza spazi.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Sono d'accordo con i termini di utilizzo");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Vuoi fare pubblicità con noi?");
	//Buy a link
	define("LANG_BUY_LINK", "Compra un collegamento");
	//Back to Top
	define("LANG_BACKTOTOP", "Inizio pagina");
	//Back to
	define("LANG_BACKTO", "Torna ai ");
	//Favorites
	define("LANG_QUICK_LIST", "Preferiti");
	//view summary
	define("LANG_VIEWSUMMARY", "vedi il sommario");
	//view detail
	define("LANG_VIEWDETAIL", "vedi le informazioni");
	//Advertisers
	define("LANG_ADVERTISER", "Inserzionisti");
	//Order Now!
	define("LANG_ORDERNOW", "Ordina adesso!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Attendere, Caricando...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Totale Parziale");
	//Subtotal
	define("LANG_SUBTOTAL", "Totale Parziale");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Tasse Totale");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Importo Prezzo Totale");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Preferiti");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Nessun preferito trovato!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Cerca risultati per");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Ricerca Correlata");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Sfoglia per Sezione");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Parola chiave");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Digita una parola chiave");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Digitare una parola chiave o annuncio");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Digita una parola chiave o uno Offerte");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Digita una parola chiave o un evento");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Digita una parola chiave o un annuncio");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Digita una parola chiave o un articolo");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Dove");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Indirizzo, Città, stato o Codice Postale)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Ricerca per la vostra posizione ...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Completa il modulo sottostante per contattarci.");
	//Message
	define("LANG_LABEL_MESSAGE", "Messaggio");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Nessuna categoria disabili trovano nel sistema.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Non è stata trovata alcuna categoria.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Scegli una categoria valida");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Scegli prima una categoria!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Vedi il percorso della Categoria");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Rimuovi la categoria Selezionata");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Le categorie extra/sottocategorie costano un");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "aggiuntivo");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "ognuna. Fatti notare!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Massimo di");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categorie consentite.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categorie e sottocategorie");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Scegli solo sottocategorie che si riferiscono al tuo tipo.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Il tuo elenco apparirà automaticamente nella categoria principale di ogni sottocategoria selezionata.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Errore di Informazione sull'Account");
	//Contact Information
	define("LANG_CONTACTINFO", "Informazioni per il contatto");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "queste informazioni non saranno mostrate pubblicamente.");
	//Billing Information
	define("LANG_BILLINGINFO", "Informazioni sulla fatturazione");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Queste informazioni non saranno mostrate pubblicamente.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Potrai configurare il tuo articolo dopo aver fatto una ordinazione.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Potrai configurare il tuo banner dopo aver fatto una ordinazione.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Potrai configurare il tuo annuncio dopo aver fatto una ordinazione.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Potrai configurare il tuo evento dopo aver fatto una ordinazione.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Potrai configurare il tuo listing dopo aver fatto una ordinazione.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Errore nelle Informazioni per la fatturazione");
	//Article Information
	define("LANG_ARTICLEINFO", "Informazioni sull'Articolo");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Errore di Informazione sull'Account");
	//Banner Information
	define("LANG_BANNERINFO", "Informazioni sul Banner");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Errore nelle Informazioni sul Banner");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Informazioni sull'Annuncio");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Errore nelle Informazioni sull'Annuncio");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Sfoglia gli Eventi per Data");
	//Event Information
	define("LANG_EVENTINFO", "Informazioni sull'Evento");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Errore nelle Informazioni sull'Evento");
	//Listing Information
	define("LANG_LISTINGINFO", "Informazioni sul Listing");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Errore nelle Informazioni sul Listing");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Richiedi questo Listing");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Tipo di annuncio");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Nessun risultato trovato per i criteri di ricerca richiesti.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Prova a cercare di nuovo o sfoglia per sezione.");
	//Sometimes you may receive no results for your search because the keyword you used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "A volte la ricerca non da risultati perchè la parola chiave usata è molto generica. Prova ad usare una parola chiave più specifica ed esegui di nuovo la ricerca.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Digita almeno una parola chiave nella casella di ricerca.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Scusi!</h1><p>La tua ricerca non dà risultati. Anche se questo è inusuale, succede di tanto in tanto, quando il termine di ricerca che hai usato è un po 'generico o quando in realtà non hanno alcun contenuto corrispondente.</p><h2>Suggerimenti:</h2>Siate più specifico con i termini di ricerca.<br />Controlla l'ortografia.<br />Se non riesci a trovare tramite la ricerca tenta doratura per sezione.<br /><br /><p>Se credi siete venuti qui per errore, si prega di contattare il gestore del sito per segnalare un problema <a href=\"[EDIR_LINK_SEARCH_ERROR]\">qui</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Imagem");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "di");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Errore nel caricamento dell'immagine");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Successivo");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pausa");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Esegui");
	//Back
	define("LANG_SLIDESHOW_BACK", "Indietro");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "La tua e-mail è stata inviata. Grazie.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Si è verificato un problema nell");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Inserisci il tuo nome.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Immetti un indirizzo e-mail valido.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Digita il messaggio.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Digita il codice correttamente.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Correggi e riprova.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "Digita un nome!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Digita un soggetto!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "ALCUNE INFORMAZIONI");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "ALCUNE INFORMAZIONI");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "ALCUNE INFORMAZIONI");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "ALCUNE INFORMAZIONI");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "ALCUNE INFORMAZIONI");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Immetti un indirizzo e-mail valido nel campo \"a\"");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Immetti un indirizzo e-mail valido nel campo \"Da\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Articolo non trovato. Please return to");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "e riprovare.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Immetti un indirizzo e-mail valido nel campo \"La tua E-mail\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Circa");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "dal");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Circa");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "dal");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Circa");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "dal");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Circa");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "dal");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Circa");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "dal");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Invia informazioni su questo articolo ad un amico");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Invia informazioni su questo annuncio ad un amico");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Invia informazioni su questo evento ad un amico");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Invia informazioni su questo listing ad un amico");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Invia informazioni su questo Offerte ad un amico");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Messaggio inviato dal ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Questo è un messaggio automatico.");
	//Contact
	define("LANG_CONTACT", "Contatto");
	//article
	define("LANG_ARTICLE", "articolo");
	//classified
	define("LANG_CLASSIFIED", "annuncio");
	//event
	define("LANG_EVENT", "evento");
	//listing
	define("LANG_LISTING", "empresa");
	//deal
	define("LANG_PROMOTION", "offerte");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Cerca almeno un parametro nella casalla di ricerca!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Prova a cercare di nuovo.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Al momento non ci sono articoli registrati.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Al momento non ci sono annunci registrati.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Al momento non ci sono eventi registrati.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Al momento non ci sono listings registrati.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Al momento non ci sono Offerte registrate.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Il messaggio è stato inviato");
	//E-mail Form
	define("LANG_EMAILFORM", "E-mail Da");
	//Click here to print
	define("LANG_PRINTCLICK", "Clicca qui per stampare");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Vedi tutte le categorie");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Località");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Altri Annunci");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Vedi tutte le categorie");
	//Location
	define("LANG_EVENT_LOCATIONS", "Località");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Eventi in Evidenza");
	//events
	define("LANG_EVENT_PLURAL", "eventi");
	//Search results
	define("LANG_SEARCHRESULTS", "Risultati della ricerca");
	//Results
	define("LANG_RESULTS", "Risultati");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "per");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "in");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "in");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "in");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "nella categoria");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "in");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "in");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "per");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Pagina");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Recensioni Recenti");
	//Reviews of
	define("LANG_REVIEWSOF", "Recensioni di");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Le recensioni sono disabilitate");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Vedi tutte le categorie");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Vedi tutte le categorie");
	//Offer
	define("LANG_PROMOTION_OFFER", "Offerta");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Descrizione");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Condizioni");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Località");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Articolo non trovato!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Articolo non disponibile!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Risultati della Ricerca per Listing");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Risultati della Ricerca per Offerta");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Risultati della Ricerca per Evento");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Risultati della Ricerca per Annuncio");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Risultati della Ricerca per Articolo");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Lingue Disponibili");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "È possibile scegliere fino a ".MAX_ENABLED_LANGUAGES." delle lingue al di sotto della directory.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Goditi i nostri servizi!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Rimuovi associazione con");
	//Welcome
	define("LANG_LABEL_WELCOME", "Benvenuto");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Opzioni per gli sponsor");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Ritorna alla Sito Web");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Aggiungi Nuovo Account");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Password dimenticata");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Clicca qui");
	//Help
	define("LANG_LABEL_HELP", "Aiuto");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Ripristina la Password");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Informazioni sull'Account e sul Contatto");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notifica Registrazione");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Vai a Accedi");
	//Order
	define("LANG_LABEL_ORDER", "Ordine");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Verifica");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configurazione");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Si prega di digitare l\'URL del sito per primo.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "Convalida non riuscita! Prova di nuovo.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Sito validato con successo!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Costruire il Traffico");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "Per favore, notare che è possibile modificare questo codice come volete, dato che si mantiene l'URL esattamente come mostrato qui, altrimenti il ​​backlink non verrà convalidato.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink non è stato convalidato. Si prega di riprovare.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Seleziona questa casella per rimuovere il backlink per questa listing");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "Backlink URL");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL dove è stato installato il backlink.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Si prega di digitare l'URL Backlink.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink non disponibili per questa listing");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Aggiungi un Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Metti questo sul vostro sito (codice HTML):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Inserisci l'URL del tuo sito:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Es: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Fare clic sul pulsante per verificare il tuo Backlink");
	//Verify
	define("LANG_LABEL_VERIFY", "Verifica");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Perché aggiungere un Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "L'aggiunta di un link al tuo sito web che punta a questo, aumenta la rilevanza di questo sito e, a sua volta l'importanza del vostra listing.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "Cosa c'è in esso per me?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "Dandoci un link sulla homepage del suo sito, ci aiutano con la nostra classifica e, di conseguenza i risultati. Ma, come pure per aiutare noi, andare il miglio supplementare e ti aiuterà. Se si aggiunge un link, una volta che abbiamo verificato che esiste, mostreremo il tua listing con uno stile particolare nella pagina dei risultati, in modo da realmente ottenere alcuni extra esposizione nella directory - è una situazione vantaggiosa per entrambi.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "How can I do this?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Semplice, in realtà, copiare il codice qui sopra nel codice del vostro sito web, in modo che si presenta da qualche parte di primo piano nella home page, ci danno l'URL del tuo sito web (dove il collegamento è) e noi la verifica dopo aver battuto il \"Verifica\" tasto - poi continuare il .... super semplice.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "No, l'Ordine senza backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Sì, aggiungi Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink aggiunto al tuo listing!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Non hai listing ad aggiungere ancora backlink.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Backlink Anteprima");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Informazioni sulla Categoria");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Manager del Sito");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Pagina Sommario");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Pagina Informazioni");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galleria di foto");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Aggiungi Banner");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Informazioni sulle Immagini nella Galleria");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Immagini della Galleria");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Gestisci immagini della Galleria");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Gestisci Gallerie");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "La galleria non esiste!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "La galleria non è disponibile!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Titolo Fattura Personalizzata");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Articoli Fattura Personalizzata");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Facile e Veloce.");
	//Steps
	define("LANG_LABEL_STEPS", "Passi");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Registrazione Account");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Selezionare un Livello");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Stato del Pagamento");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Scadenza");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Aggiungi Nuova Galleria");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Aggiungi una nuova galleria");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nuovo Offerte");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Aggiungi una nuovo offerte");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Gestisci fatturazione");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Clicca qui se hai già una password.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Non sei sponsor?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "per informazioni sull'aggiunta di un articolo a");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Benvenuto nella Sezione Sponsor");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Benvenuto nella Sezione Membri");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Account bloccato. Attendi");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minuto(i) e prova di nuovo.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Uno o più campi obbligatori non sono stati riempiti. Si prega di confermare che tutte le informazioni necessarie è stato immesso prima di continuare.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Non hai il permesso di accesso da questo indirizzo IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Il tuo account è stato deactived!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Spiacenti, la tua e-mail o password è errata.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Account inesatto.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Chiave inesatta.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "Server OpenID Server non disponibile!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Errore nella richiesta del Server OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Richiesta OpenID cancellata!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Richiesta Google cancellata!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Identità OpenID non valida!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Hai dimenticato la tua password?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "Cos'è OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Cosa è Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Cosa è Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Account aggiornato con successo!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Password aggiornata con successo!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Grazie per aver creato un account in");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Accedi per gestire il tuo account usando il e-mail e la password sottoindicati.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Puoi vedere");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Il tuo account in");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Questo articolo mostrerà");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Questo annuncio mostrerà");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Questo evento mostrerà");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Questo listing mostrerà");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "il massimo di");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "immagine");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "immagini");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "nella galleria");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " più una immagine principale.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "oppure Associa una galleria esistente con questo articolo");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "oppure Associa una galleria esistente con questo annuncio");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "oppure Associa una galleria esistente con questo evento");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "oppure Associa una galleria esistente con questo listing");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Continua a pagare per il tuo articolo.");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Continua a pagare per il tuo banner.");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Continua a pagare per il tuo annuncio.");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Continua a pagare per il tuo evento.");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Continua a pagare per il tuo listing.");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Gli articoli sono attivati da");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "I banners sono attivati da");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Gli annunci sono attivati da");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Gli eventi sono attivati da");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Gli listings sono attivati da");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "solo quando il procedimento è stato completato.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Suggerimenti per la Sincronizzazione della Mappa");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Puoi regolare la posizione sulla mappa,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "con più precisione.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Usa i tasti \"+\" e \"-\" per regolare lo zoom sulla mappa.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Usa le freccette per navigare sulla mappa.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Trascina-e-Rilascia il puntatore per mettere a punto la località.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "La tuo Offerte apparirà qui");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Oppure associa uno Offerte esistente con questo listing");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Non è stato trovato alcun risultato!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Accesso non consentito!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Sono stati trovati i seguenti problemi");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Nessun articolo selezionato o che richieda il pagamento.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Nessun articolo trovato.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Non ci sono fatture nel sistema.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Non ci sono transazioni nel sistema.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Richiedi questo Listing");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Vai alla sezione verifica sponsor");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Puoi vedere la tua fattura in");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Accetto le condizioni");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "e invierò il pagamento.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Esta página redirecionará você à seção de sponsor em alguns segundos.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Questa pagina ti indirizzerà di nuovo a continuare il tuo processo di registrazione in pochi secondi.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Se non funziona, si prega di");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Gestisci Articolo");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Gestisci Banner");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Gestisci annuncio");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Gestisci Evento");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Gestisci Listing");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Gestisci Offerte");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Gestisci Fatturazione");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Gestisci Fatture");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Gestisci Transazioni");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Non ci sono articoli nel sistema.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Non ci sono banner nel sistema.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Non ci sono annunci annunci nel sistema.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Non ci sono eventi nel sistema. ");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "Non ci sono gallerie nel sistema.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Non ci sono listings nel sistema.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Non ci sono offerte nel sistema.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Nessuna Recensione Disponibile.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Nessun articolo trovato. Potrebbe essere stato cancellato.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Nessun annuncio trovato. Potrebbe essere stato cancellato.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Nessun elenco trovato. Potrebbe essere stato cancellato.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Informazioni sull'Articolo");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Cancella Articolo");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Cancella le informazioni sul");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Sei sicuro di voler cancellare questo articolo?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Galleria Articoli");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Anteprima Articolo");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Rapporto sul Traffico dell'Articolo");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Dettagli Articolo");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Modifica le Informazioni sull'Articolo");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Cancella Banner");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Cancella le Informazioni sul Banner");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Sei sicuro di voler cancellare banner?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Modifica Banner");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Modifica Informazioni sul Banner");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "anteprima Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Rapporto sul traffico del Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Vedi Banner");
	//Disabled
	define("LANG_BANNER_DISABLED", "Disabilitato");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Informazioni sull'Annuncio");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Cancella Annuncio");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Il vostro annuncio apparirà automaticamente nella categoria principale di ogni sub-categoria selezionata.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Classificati Categorie");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Classificati Categorie");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Cancella le Informazioni sull'Annuncio");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Sei sicuro di voler cancellare questo annuncio?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "Galleria Annunci");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Sincronizzazione Mappa Annunci");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Anteprima Annuncio");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Rapporto sul Traffico dell'Annuncio");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Dettagli Annuncio");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Modifica le Informazioni sull'Annuncio");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Modifica il Livello dell'Annuncio");
	//Delete Event
	define("LANG_EVENT_DELETE", "Cancella Evento");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Cancella le Informazioni sull'Evento");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Sei sicuro di voler cancellare questo evento?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Informazioni sull'Evento");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Galleria Evento");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Sincronizzazione Mappa Evento");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Anteprima Evento");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Rapporto sul Traffico dell'Evento");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Dettagli Evento");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Modifica le Informazioni sull'Evento");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Galleria Elenco");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Informazioni sul Listing");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Sincronizzazione Mappa Listing");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Anteprima Listing");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Offerte Listing");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Lo Offerte è collegata dal Listing.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Per essere attiva lo offerte");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "deve avere una data di conclusione futura.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "deve essere associata ad un listing.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Rapporto sul Traffico del Listing");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Dettaglio Listing");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "per il listing");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Aggiornamento Listing");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Cancella Offerte");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Cancella le Informazioni sullo Offerte");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Sei sicuro di voler cancellare questo Offerte?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Anteprima Offerte");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Informazioni sullo Offerte");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Dettaglio Offerte");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Modifica le Informazioni sullo Offerte");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Cancella Galleria");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Cancella le Informazioni sulla Galleria");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Sei sicuro di voler cancellare questa galleria? Questa operazione rimuoverà tutte le informazioni sulla galleria, le foto e le relazioni.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Cancella Immagine Galleria");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Informazioni sulla Galleria");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Anteprima Galleria");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Dettaglio Galleria");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Modifica le Informazioni sulla Galleria");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Gestisci Immagini");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Cancela Immagine");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "immagine cancellata con successo!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Dettaglio Recensione");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Anteprima Recensione");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Dettaglio Fattura");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Fattura per questo account non trovata.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notifica Fattura");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Dettaglio Transazione");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transazione per questo account non trovata.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Accedi con il Account di Direttorio");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Accedi con il Account di OpenID 2.0");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Accedi con il Account di Facebook");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Accedi con il Account di Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." già registrato!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Questo account è disponibile");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Errore durante il caricamento delle immagini. Si prega di riprovare.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Immagine caricata!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Immagine aggiornato con successo!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Elimina Image");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Sei sicuro di voler cancellare questa immagine?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Modifica immagine");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Rendere principale");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principale");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Clicca qui per impostare come immagine principale");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Clicca qui per impostare come galleria immagini");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Pacchetti");
	//Package
	define("LANG_PACKAGE_SING", "Pacchetto");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Di ricarica per il pacchetto ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profilo aggiornato con successo!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Sponsor Opzioni");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "I miei Amici");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Amici di approvare");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "In attesa di accettazione");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Profilo utente Abilita");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "Incontrare persone, trovare clienti per la tua azienda e molto altro!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profilo");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Opzioni Profilo");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Modifica Profilo");
	//Friends
	define("LANG_LABEL_FRIENDS", "Amici");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Mostra gli amici");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Gestire Amici");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Carica immagine dal vostro Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Dati Personali");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Soprannome");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Account di Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Su di Me");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Data di Nascita");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Città Natale");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Libri Preferiti");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Favorite Movies");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Lo Sport Preferito");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Musica preferita");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favorite Foods");
	//Settings
	define("LANG_LABEL_SETTINGS", "Impostazioni");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Vedi tutti gli amici");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Tutti gli amici");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Rimuovere amico");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Aggiungi amico");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Accettare");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Negare");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Diventa un Inserzionista");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Registrati e iniziare a promuovere il vostro business di oggi, è gratis!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "Cosa posso fare?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Messaggi");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Sei sicuro?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "La pagina personale con nome \"john-smith\" sarà disponibile attraverso l'URL:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Il tuo URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Il tuo URL contiene caratteri non validi.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL già in uso, si prega di scegliere un altro URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Tu non hai amici.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Amico rimosse con successo.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Amico con successo approvato.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Amico con successo respinta.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Requisito amico correttamente annullato.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Vedi tutti");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Vedi tutti");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "Nessun amico");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Nessun elemento");
	//Share
	define("LANG_LABEL_SHARE", "Quota");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Condividi Tutti");
	//Comments
	define("LANG_LABEL_COMMENTS", "Commenti");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Il mio profilo");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Del profilo utente riuscito abilitato!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Pubblicare le informazioni di contatto");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Crea la mia pagina personale");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Pagina Personale");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Articolo Recensioni");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Elenco Recensioni");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Recensioni cancellato con successo.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Nessuna recensioni trovata!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Modificare il mio profilo");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Torna il mio profilo");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Iscritto da");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Impostazioni Account");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Offerte Redento");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Preferiti");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Non hai i permessi per accedere a questa area.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Vai al tuo profilo.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "La mia pagina personale");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Utilizzare questo account");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Pagina Profilo");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Creare il tuo Profilo");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Soprannome è obbligatorio.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Assicurarsi che l'account di Twitter si sta aggiungendo non è protetto. Se l'account di twitter è protetto l'ultimo tweet su questo account non verrà mostrato.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Il tuo articolo è stato pagato, quindi è possibile aggiungere un massimo di [max] categorie libero.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Il tuo articolo è stato pagato, quindi è possibile aggiungere un massimo di [max] categoria libero.");
	
	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Sono le immagini ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "accettati per l'upload!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Le immagini devono essere a norma ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Selezionare una immagine per l'upload!");
	//Original image
	define("LANG_ORIGINAL", "Immagine originale");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Mini anteprima");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Leggenda");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "È possibile aggiungere il numero massimo di ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " foto alla tua galleria!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Creare Thumbnail");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Thumbnail di anteprima");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Il tuo articolo ha già il numero massimo di immagini nella galleria. Eliminare un\'immagine esistente per salvare questo.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Evento Ricorrente");
	//Repeat
	define("LANG_PERIOD", "Ripetizione");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Scegli una opzione");
	//Daily
	define("LANG_DAILY", "Giornaliero");
	//Weekly
	define("LANG_WEEKLY", "Settimanale");
	//Monthly
	define("LANG_MONTHLY", "Mensile");
	//Yearly
	define("LANG_YEARLY", "Annuale");
	//Daily
	define("LANG_DAILY2", "Giornaliero");
	//Weekly
	define("LANG_WEEKLY2", "Settimanale");
	//Monthly
	define("LANG_MONTHLY2", "Mensile");
	//Yearly
	define("LANG_YEARLY2", "Annuale");
	//every
	define("LANG_EVERY", "Ogni");
	//every
	define("LANG_EVERY2", "Ogni");
	//of
	define("LANG_OF", "di");
	//of
	define("LANG_OF2", "di");
	//of
	define("LANG_OF3", "di");
	//of
	define("LANG_OF4", "del");
	//Week
	define("LANG_WEEK", "Settimana");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Scegli Mese");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Scegli Giorno");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Scegli Settimana");
	//First
	define("LANG_FIRST", "Prima");
	//Second
	define("LANG_SECOND", "Secondo");
	//Third
	define("LANG_THIRD", "Terzo");
	//Fourth
	define("LANG_FOURTH", "Quarto");
	//Last
	define("LANG_LAST", "Ultima");
	//1st
	define("LANG_FIRST_2", "1ª");
	//2nd
	define("LANG_SECOND_2", "2ª");
	//3rd
	define("LANG_THIRD_2", "3ª");
	//4th
	define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Ricorrenti");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Si prega di selezionare un giorno della settimana.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Inserisci un giorno.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Seleziona un mese.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Si prega di selezionare una settimana.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Si prega di selezionare un'opzione di Ripetizione.");
	//When
	define("LANG_EVENT_WHEN", "Quando");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Giorno deve essere numerico.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Giorno deve essere compreso tra 1 e 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Giornata non corrisponde con il periodo scelto.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mese non corrisponde con il periodo scelto.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Giorni non corrispondono con il periodo scelto.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Settimana non corrisponde con il periodo scelto.");
	//No info
	define("LANG_EVENT_NO_INFO", "Senza info");
	//Ends on
	define("LANG_ENDS_IN", "Si conclude il");
	//Never
	define("LANG_NEVER", "Mai");
	//Until
	define("LANG_UNTIL", "Fino quando");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Fino quando");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Fino quando\" deve essere maggiore o uguale alla \"Data di inizio\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Fino quando\" non può essere in passato.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Inizia il");
	//Repeats
	define("LANG_EVENT_REPEATS", "Ripete");
	//Ends on
	define("LANG_EVENT_ENDS", "Si conclude il");
	//weekend
	define("LANG_EVENT_WEEKEND", "fine settimana");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "giorno lavorativo");
	//the month
	define("LANG_THE_MONTH", "mese");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Sito");
	//Site name
	define("LANG_DOMAIN_NAME", "Nome di sito");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Clicca qui fare vedere questo sito");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Clicca qui per cancellare questo sito");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Sito eliminato con successo!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Sito aggiunto con successo!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2. "<br />Una email di notifica verrà inviata al team di supporto di eDirectory, attendere il nostro contatto.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Nome del sito è necessario");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL del sito è necessario");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Nome del sito già esistente");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL del sito esiste già");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL del sito non valido");
	//Site Items
	define("LANG_SITE_ITEMS", "Sito Elementi");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Informazioni sul Profilo");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Rete Sociali");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link e importare le informazioni");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Solo link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Collegare il mio account di Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Scollegare il mio account di Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Il tuo account è stato eliminato il collegamento da Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Il tuo account di Facebook è già collegato con altro account del sistema.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Il tuo account di Twitter è già collegato con altro account del sistema.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Collegato a Twitter");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Collegato come");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Posizione Preferenze");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Scegli la tua preferenza di posizione");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Usa la tua posizione corrente");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Usare Facebook Posizione");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Connettersi a Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Account di Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Account di Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Cambia account");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Account di Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter connessione");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Collegare il mio account di Twitter");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Scollegare il mio account di Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Post riscatta sul mio account di twitter automaticamente");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Il tuo account è stato eliminato il collegamento da Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "È necessario accedere attraverso Twitter prima");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Il tuo account di Twitter è stato collegato con successo");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Il tuo account di Facebook è stato collegato con successo");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Il tuo account è già loggato come Facebook");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Questo utente è già collegato a un altro account.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Fare clic qui per passare a questo account");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Connettersi a Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Utilizzare questo linguaggio su ogni segno al mio account");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_LINK2LISTING", "Collegamento a una listing");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Mi è piaciuto questo");
	//Redeem
	define("DEAL_REDEEM", "Redimere");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Riscattare questa offerta");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Per riscattare avete bisogno di questo post informazioni offerta sul vostro Facebook o Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "È possibile impostare questo pulsante per inviare automaticamente sul tuo profilo.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Clicca qui per configurarlo");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Attendere prego, l'inserimento su Facebook e Twitter (se disponibile).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Hai già redento questo offerta! Il codice è");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Offerta fatto! Questa è la tua riscattare codice");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Nessuno ha riscattato questa offerta su Facebook ancora.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Nessuno ha redento questo accordo ancora su Twitter.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "I recenti offerta conclusi");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Nessuna offerta trovata!");
	//This deal is not available anymore.
	define("DEAL_NA", "Questa offerta non è più disponibile.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Per riscattare questa offerta è necessario inviare al vostro muro di Facebook. In primo luogo, eseguire il login usando il pulsante di login di Facebook e sarà necessario approvare questa applicazione per farlo.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Hai già fatto questa offerta!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Spiacenti, si è verificato un errore cercando di post sul tuo muro Facebook. Prova di nuovo.");
	//Value
	define("DEAL_VALUE", "Valore");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Con questo coupon");
	//Thank you
	define("DEAL_THANKYOU", "Grazie");
	//Original value
	define("DEAL_ORIGINALVALUE", "Originale valore");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Con questo accordo");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valido fino al");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "Coupon deve essere presentato per ricevere sconti");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limite di 1 coupon per l'acquisto");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Non cumulabile con altri tagliandi, offerte o sconti di alcun tipo");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Valido solo per il Listato Nome - Indirizzo");
	//Print deal
	define("DEAL_PRINTDEAL", "Stampa");
	//deal done
	define("DEAL_DEALSDONE", "Offerta Conclusi");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Offerte Conclusi");
	//Left
	define("DEAL_LEFTAMOUNT", "Rimanente");
	//SOLD OUT
	define("DEAL_SOLDOUT", "VENDUTI");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Siamo spiacenti, questa offerta non esiste o è stato rimosso dal proprietario");
	//at
	define("DEAL_AT", "a");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "URL amichevole");
	//Select a listing
	define("DEAL_SELECTLISTING", "Selezionare una lista");
	//Tagline for Deals
	define("DEAL_TAG", "Tagline per le offerte");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilità");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Questa offerta verrà visualizzato sul");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "ricerche e caratteristica nelle vicinanze");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 ore / giorno");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Intervallo personalizzato");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Sconto informazioni");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valore della Voce.");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Sconto");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valore con sconto");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Quantità di offerte");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "offerta fino ad ora");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "offerta fino ad ora");
	//left
	define("LANG_SITEMGR_LEFT", "rimanente");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Attendere prego, caricamento...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Si prega di attendere. Vengono utilizzati i dati di accesso per completare questo passaggio...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Valore della Voce è obbligatorio.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." è obbligatorio.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." non può essere superiore a 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Offerte offrire è obbligatorio.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Si prega di inserire un valore minore sul campo ".LANG_LABEL_DISC_AMOUNT);
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Convalidata il");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "È possibile collegare direttamente solo questa offerta ad un annuncio se si seleziona un primo account");
    //Value
    define("DEAL_VALUE", "Valore");
    //With discount
    define("DEAL_WITHCOUPON", "Con lo sconto");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Convalida via e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Accedi e riscattare");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Riscattare e Stampa");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Riscattare e condividere");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Offerte in vetrina");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Accedi utilizzando la tua sessione di Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Per Riscattare utilizzando Facebook è necessario collegare utilizzando il tuo account di Facebook.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Riscattare Statistiche");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Riscatta codice");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponibile");
    //Used
    define("DEAL_SITEMGR_USED", "Usato");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Riscattare la sessione corrente utilizzando Facebook");
	//Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Navbar configurazione salvata.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "C'è stato un problema di risparmio, si prega di riprovare.");
	//At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "Almeno un elemento è necessario.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Non è possibile salvare ripetuti URL.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Non è possibile salvare gli elementi vuoti.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "Non è possibile salvare intestazione o piè di pagina vuota.");
    //Use
    define("DEAL_SITEMGR_USE", "Usa");
	//Saving...
	define("LANG_DEAL_SAVING", "Salvataggio...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Nessun riscattare trovato.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "percentuale");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valore fisso");
	
	# ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Entri prego in un Nome.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Entri prego in un URL.");
	//Add new item to menu
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Aggiunga l'elemento");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Nuovo elemento");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Modulo");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Contenuto del Sito");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Nuovo");
	//Save & Close
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Risparmi");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Risparmi elemento");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Nome");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Uso");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Selezioni prego un modulo o colpo vicino all'annullamento.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Spiacente, non c'è contenuto su ordinazione del sito creato ancora.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Creare un nuovo contenuto personalizzato");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Crei un nuovo contenuto di abitudine");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Usi il URL del modulo");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Usi il URL su ordinazione della pagina");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Scatti un articolo sul sotto navbar per pubblicare l'etichetta o per cambiare la posizione di collegamento:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Navigazione dell'intestazione");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Navigazione della persona alta un dato numero di piedi");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Annulla l'inserimento di questo elemento?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Ripristinare gli elementi");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Riscattare senza Facebook");
    //Don't have Facebook? Sign using your account.
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Non hai Facebook? Registrati utilizzando il tuo account.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Cambiamento Sito");
    //Only
    define("LANG_ONLY2", "Solo");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Offerta");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Offerte");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Offerte Recensioni");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "postata su Facebook e Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "postata su Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "postata su Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Postata su");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "L'offerta scade");
	//deal opened
	define("LANG_DEAL_OPENED", "offerta aperta");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Termini e Condizioni");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "al massimo 1000 caratteri");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Fornisci condizioni usando al massimo di 1000 caratteri.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "rigo");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Errore durante l'importazione di tabella temporanea.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Data di rinnovo non valido - rigo");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Data aggiornato non valida - rigo");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "File CSV importato nella tabella temporanea.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail non valido - rigo");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Password non valida - rigo");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Parole chiavi non valida (massimo ".MAX_KEYWORDS." parole chiavi) - rigo'");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Parole chiavi non valida (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - rigo");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Titolo non valido - rigo");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Data di inizio non valida - rigo");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Data di fine non valida - rigo");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Data di inizio deve essere riempito - rigo");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Data di fine deve essere riempito - rigo");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Ora di inizio non valida - rigo");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Ora di termine non valida - rigo");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Formato dell'ora di inizio non valido. Deve essere \"xx:xx\" - rigo");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Formato dell'ora di termine non valido. Deve essere \"xx:xx\" - rigo");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Modalità dell'ora di inizio non valido. Deve essere \"AM\" o \"PM\" - rigo");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Modalità dell'ora di termine non valido. Deve essere \"AM\" o \"PM\" - rigo");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Modalità dell'ora di inizio non valido. Deve essere \"24\" - rigo");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Modalità dell'ora di termine non valido. Deve essere \"24\" - rigo");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Località e la località predefinita di sistema sono differenti - rigo");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitudine non valido. Deve essere numerico tra -90 e 90 - rigo");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitudine non valido. Deve essere numerico tra -180 e 180 - rigo");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Nessun file CSV nella cartella di importazione.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Il numero delle colonne nei seguenti righi è sbagliato:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Righi letti in totale:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "Header CSV non corrisponde - ha più campi che è consentito");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "Header CSV non corrisponde al campo (s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "account revertida");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "accounts revertidas");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "articolo revertido");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "articoli revertidos");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Trovare quello che stai cercando...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "A volte si può ricevere nessun risultato per la tua ricerca, perché la parola chiave che avete usato è molto generica. Provare a usare una parola chiave più specifica.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Trovaci su LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Trovaci su Facebook");
	//Links
	define("LANG_LINKS", "Links");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contattaci");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Seguiteci su Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Seguiteci su");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Risultati per pagina");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Visualizzazione dei risultati");
	//to
	define("LANG_PAGING_SHOWING_TO", "a");
	//of
	define("LANG_PAGING_SHOWING_OF", "di");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Pagine");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importazione [SUGAR_ITEM_TITLE] da SugarCRM a [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Usa il modulo qui sopra per importare dal record SugarCRM [SUGAR_ITEM_TITLE], dopo aver fatto clic importare i dati saranno trasferiti per l'installazione di direttorio tutte le informazioni utili passato attraverso, è sufficiente compilare i dati in più, ei dati di pagamento.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Lei è quasi fatto.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Non è stato possibile esportare. Verifica le informazioni di connessione di SugarCRM sul vostro directory.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Sbagliato eDirectory chiave.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Owner
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Proprietario di Listing");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Titolo di Recensione");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Proprietario di Evento");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Proprietario di Annuncio");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Autore dell'Articolo");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.iltuosito.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "iltuonome@iltuosito.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitatore");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Categoria");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Categoria 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Categoria 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Categoria 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Categoria 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Vista di Sintesi");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Vista Dettagliata");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Contenuto illustrativo");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Invia a Cellulare");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Clicca per Chiamata");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Messaggio inviato con successo!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Invia informazioni su questa listing a un telefono.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Inserisci il tuo telefono per chiamare il proprietario lista senza costi.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefono è necessario.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Si prega di digitare un numero di telefono valido.");
	//Call
	define("LANG_TWILIO_CALL", "Chiamare");
	//Calling
	define("LANG_TWILIO_CALLING", "Chiamata");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefono");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Estensione");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Attivare");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Il codice di convalida è:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Il tuo numero di telefono è stato attivato!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Numero di telefono cancellato con successo!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Clicca per Chiamata non disponibili per questa lista");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Suggerimenti per la voce di Clicca per Chiamata");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "È necessario attivare il numero di telefono sottostante per consentire agli utenti di contattarti direttamente attraverso la directory.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Inserisci il tuo numero di telefono e fare clic nella Attivare.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Un messaggio con il codice di attivazione sarà mostrata. Prendete nota di questo codice e attendere la telefonata di attivazione.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Vi verrà chiesto di inserire il codice di sei cifre di attivazione. Inserisci il codice e attendere il messaggio di conferma.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Dopo attivare il vostro numero di telefono, fare clic su Salva per terminare il processo.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Per i numeri di fuori degli Stati Uniti, è necessario inserire il nazione codice prima.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "Solo numeri da Stati Uniti d'America sono accettati.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Clicca per Chiamata\" rapporto");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direzione");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "Da");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Ora Inizio");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Ora di Fine");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Durata (secondi)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Nessun report disponibili.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Attivato da");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Mancata attivazione. Per favore, riprova.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Account non è attivo.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Account di prova non supporta questa funzione.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Chiamata in entrata rifiutata a causa di account inattivo.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "URL non valido formato.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP recupero fallimento.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP Errore di connessione.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP violazione del protocollo.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP nome host male.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP Anche molti redirect.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Documento analizza il fallimento.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Valido Twilio Markup XML versione.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "L'elemento principale deve essere di risposta.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Convalida dello schema di avviso.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Valido Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Errore interno.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Non può chiamata fuori da un segmento delle chiamate Dial.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Valido metodo del valore.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Valore di timeout non valido.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: HangupOnStar valore non valido.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Valore non valido callerID.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Valido elemento nidificato.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Valore limite di tempo non valido.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valido metodo del valore.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: SendDigits valore non valido.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Formato del numero di telefono non valido.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Numero di telefono non valido.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Numero di telefono Proibita.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valore non valido disattivato.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: EndConferenceOnExit valore non valido.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: StartConferenceOnEnter valore non valido.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: WaitUrl valido.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: WaitMethod valido.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Valido segnale acustico valore.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Valido Conferenza Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Nome non valido Conferenza.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Valido verbo usato in waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: FinishOnKey valore non valido.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valido metodo del valore.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Non valido valore di timeout.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: NumDigits valore non valido.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Non valido verbo nidificati.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Non valido voce di valore.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Non valido anello di valore.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Non valido Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Non valido anello di valore.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Non valido Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Non valido anello di valore.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Non valido voce di valore.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Non valido il testo.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Non valido metodo del valore.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Non valido valore di timeout.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Non valido valore maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Non valido valore finishOnKey.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Non valido metodo del valore.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Non valido valore length.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Non valido \"A\" attributo.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Non valido \"Da\" attributo.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Corpo non valido.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Metodo di attributo non valido.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "StatusCallback attributo non valido.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Recupero limite documento è pervenuto.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS inviare limite di velocità superato.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "Dal numero di telefono non in grado di SMS.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "Limite Rispondi SMS superato.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Non valido Verbo per Reply SMS.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Per numero di telefono nonvalido per la modalità di prova.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Parametri sconosciuti.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "FriendlyName valido.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Autorizzazione negata.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Metodo non consentito.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Account non attivo.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Nessun numero chiamato specificato.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Numero chiamato è un numero premium.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Chiamate internazionali non abilitato.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "URL non valido.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Non valido SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Non valido IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Non valido Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Non valido Method.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Numero di telefono del chiamante non verificato.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Chiamato il numero di telefono non valido.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Numero di telefono del chiamante non valido.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Numero di telefono del chiamante è necessario.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Numero di telefono chiamato non è raggiungibile.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Account non autorizzato a chiamare il numero telefonico.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Conto non è consentito chiamare il numero telefonico.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Numero di telefono non sembra essere valido.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "ApplicationSid non valido.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Non valido call state.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Numero di telefono non valido.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "URL non valido.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Metodo non valido");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Numero di telefono in entrata non sono disponibili per account di prova.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Non è possibile impostare VoiceFallbackUrl senza impostare URL.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Non è possibile impostare SmsFallbackUrl senza impostare SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Questo tipo di numero di telefono non supporta gli SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Numero di telefono già validati sul tuo conto.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Area codice non valido.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Nessun numero di telefono trovato nel codice area.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Numero di telefono già convalidato su un altro account.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "CallDelay non valido.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Risorsa non disponibile.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Callback url non valido.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Valido trascrizione tipo.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid è richiesto.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Numero di telefono non è un valido SMS capace numero di telefono in entrata.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Corpo del messaggio è necessario.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "La fonte 'da' numero di telefono è necessario inviare un SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "La destinazione 'a' numero di telefono è necessario inviare un SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Massima lunghezza del corpo SMS è di 160 caratteri.");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Il \"Da\" numero di telefono fornito non è un valido, SMS-capable numero di telefono in entrata per il tuo account.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Il numero Sandbox possono inviare messaggi solo ai numeri verificata.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Commenti di Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Commenti di Facebook non sono disponibili per questa listing");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Assicurarsi di essere connesso in Facebook con lo stesso account che hai impostato nella sezione Opzioni Commenti, altrimenti non si riesce a moderare i commenti per questo articolo.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "È possibile anche moderare i tuoi commenti andando a ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Invalida chiave API.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Parametro deserto: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Il nome del modulo non valido.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Modulo disabilitato.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Parametro deserto: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API disabilitato.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscina");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Camere da Letto");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Bagni");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Livello(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Tipo di Proprietà");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Proposito");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Prezzo");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Costruito Nel");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Piedi Quadrati");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Ufficio");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Lavanderia");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Aria Condizionata Centrale");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Sala da Pranzo");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garage");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Tritarifiuti");