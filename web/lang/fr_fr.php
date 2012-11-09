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
	# * FILE: /lang/fr_fr.php
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
	define("LANG_DATE_MONTHS", "janvier,février,mars,avril,mai,juin,juillet,août,septembre,octobre,novembre,décembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "dimanche,lundi,mardi,mercredi,jeudi,vendredi,samedi");
	//year
	define("LANG_YEAR", "l'année");
	//years
	define("LANG_YEAR_PLURAL", "les année");
	//month
	define("LANG_MONTH", "le mois");
	//months
	define("LANG_MONTH_PLURAL", "les mois");
	//day
	define("LANG_DAY", "jour");
	//days
	define("LANG_DAY_PLURAL", "jours");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "a");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "j");
	//Hour
	define("LANG_LABEL_HOUR", "Heure");
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
	define("ZIPCODE_LABEL", "code postal");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "d \d\e F \d\e Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F \d\e Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Avez-vous une question à propos de la vidéo extrait de code? Cliquez ici.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Vous utilisez une ancienne version d'Internet Explorer qui peut affecter la fonctionnalité complète de certaines fonctions. Nous vous recommandons de mettre à niveau vers une version plus récente d'Internet Explorer.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "caractères");
	//by
	define("LANG_BY", "par");
	//in
	define("LANG_IN", "dans");
	//Read More
	define("LANG_READMORE", "Lire la suite");
	//More
	define("LANG_MORE", "plus");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Recherche par Catégorie");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Recherche par Région");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Recherche par Liste");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Recherche par Événements");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Recherche par Annonces");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Recherche par Articles");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Recherche par Offres");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Recherche par Posts");
	//show
	define("LANG_SHOW", "afficher");
	//hide
	define("LANG_HIDE", "cacher");
	//Bill to
	define("LANG_BILLTO", "Facturer à");
	//Payable to
	define("LANG_PAYABLETO", "À payer à");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Date d'émission");
	//Expire Date
	define("LANG_EXPIREDATE", "Date d'expiration");
	//Questions
	define("LANG_QUESTIONS", "Questions");
	//Please call
	define("LANG_PLEASECALL", "S'il vous plaît appelez");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informations sur la facture");
	//Payment Date
	define("LANG_PAYMENTDATE", "Date de paiement");
	//None
	define("LANG_NONE", "Aucun");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Facture Personnalisée");
	//Locations
	define("LANG_LOCATIONS", "Emplacement");
	//Close
	define("LANG_CLOSE", "Fermer");
	//Close this window
	define("LANG_CLOSEWINDOW", "Fermer la fenêtre");
	//from
	define("LANG_FROM", "à partir de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Information sur la transaction");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Dans les transactions manuelles, total et impôt ne sont pas calculés.");
	//creditcard
	define("LANG_CREDITCARD", "carte de crédit");
	//Join Now!
	define("LANG_JOIN_NOW", "Inscrivez-vous maintenant!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Créez Votre Profil");
	//More Information
	define("LANG_MOREINFO", "Plus d'info");
	//and
	define("LANG_AND", "et");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Pièces pour véhicule");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Pneus");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Réparation du moteur");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Catégories et sous-catégories");
	//per
	define("LANG_PER", "pour");
	//each
	define("LANG_EACH", "chaque");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "bloc d'affichage");
	//Add
	define("LANG_ADD", "Ajouter");
	//Manage
	define("LANG_MANAGE", "Gérer");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "affichages à mon crédit payé de");
	//Section
	define("LANG_SECTION", "Section");
	//General Pages
	define("LANG_GENERALPAGES", "Pages Générales");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Ouvrir dans une nouvelle fenêtre");
	//No
	define("LANG_NO", "Non");
	//Yes
	define("LANG_YES", "Oui");
	//Dear
	define("LANG_DEAR", "Cher");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Adresse, Code Postal");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Appartement, bureau, unité, bâtiment, étage, etc.");
	//or
	define("LANG_OR", "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Dimanche 8:00 - 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Lundi 8:00 - 21:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Mardi 8:00 - 21:00");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Champs extras");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Aménagements");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Se connecter automatiquement");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Cocher / Décocher tous");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Informations sur la facturation");
	//Default
	define("LANG_BUSINESS", "Standard");
	//on Listing
	define("LANG_ON_LISTING", "sur la Liste");
	//on Event
	define("LANG_ON_EVENT", "sur l'Événement");
	//on Banner
	define("LANG_ON_BANNER", "sur la Bannière");
	//on Classified
	define("LANG_ON_CLASSIFIED", "sur l'Annonce");
	//on Article
	define("LANG_ON_ARTICLE", "sur l'Article");
	//Listing Name
	define("LANG_LISTING_NAME", "Nom de la Liste");
	//Event Name
	define("LANG_EVENT_NAME", "Nom de l'Événement");
	//Banner Name
	define("LANG_BANNER_NAME", "Nom de la Bannière");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nom de l'Annonce");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nom de l'Article");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Foire Aux Questions");
	//click to crop image
	define("LANG_CROPIMAGE", "cliquez ici pour recadrer l'image");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Vous ne trouvez pas votre réponse? Contactez-nous.");
	//Active
	define("LANG_LABEL_ACTIVE", "Active");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspendu");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expiré");
	//Pending
	define("LANG_LABEL_PENDING", "En attente");
	//Received
	define("LANG_LABEL_RECEIVED", "Reçu");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Code promotionnel");
	//Account
	define("LANG_LABEL_ACCOUNT", "Compte");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Changer de compte");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nom ou titre");
	//Name
	define("LANG_LABEL_NAME", "Nom");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Première, Dernière");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nom de la page");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Description du sommaire");
	//Category
	define("LANG_LABEL_CATEGORY", "Catégorie");
	//Category
	define("LANG_CATEGORY", "Catégorie");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Catégories");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Catégories");
	//Country
	define("LANG_LABEL_COUNTRY", "Pays");
	//Region
	define("LANG_LABEL_REGION", "Région");
	//State
	define("LANG_LABEL_STATE", "État");
	//City
	define("LANG_LABEL_CITY", "Ville");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Quartier");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Pays");
	//Regions
	define("LANG_LABEL_REGION_PL", "Régions");
	//States
	define("LANG_LABEL_STATE_PL", "États");
	//Cities
	define("LANG_LABEL_CITY_PL", "Villes");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Quartiers");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Ajouter une région nouvelle");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Ajouter un état nouveau");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Ajouter une ville nouvelle ");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Ajouter un quartier noveau");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Choisir une région existante");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Choisir un état existante");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Choisir une ville existante");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Choisir un quartier existante");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Aucune adresse trouvée");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renouvellement");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Date de Renouvellement");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Adresse");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Adresse Web");
	//Phone
	define("LANG_LABEL_PHONE", "Téléphone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Description longue");
	//Status
	define("LANG_LABEL_STATUS", "État");
	//Level
	define("LANG_LABEL_LEVEL", "Niveau");
	//Empty
	define("LANG_LABEL_EMPTY", "Vide");
	//Start Date
	define("LANG_LABEL_START_DATE", "Date de Début");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Date de Début");
	//End Date
	define("LANG_LABEL_END_DATE", "Date de Fin");
	//End Date
	define("LANG_LABEL_ENDDATE", "Date de Fin");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Date Incorrecte");
	//Start Time
	define("LANG_LABEL_START_TIME", "Heure de Début");
	//End Time
	define("LANG_LABEL_END_TIME", "Heure de Fin");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Illimité");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Choisissez un Type");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Choisissez une Catégorie");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Temps Restant");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Voir Offre");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Pas de Offrir");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Choisissez un Offrir");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nom du Contact");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nom du Contact");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Téléphone du Contact");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax du Contact");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-mail du Contact");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Adresse");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Me prévenir des évaluations et de la circulation d'entreprises.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Facture");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Facture #");
	//Item
	define("LANG_LABEL_ITEM", "Article");
	//Items
	define("LANG_LABEL_ITEMS", "Articles");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Catégorie Extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Code promotionnel");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Prix de l'article");
	//Amount
	define("LANG_LABEL_AMOUNT", "Montant");
	//Tax
	define("LANG_LABEL_TAX", "Impôt");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Total");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Faire les chèques à l'ordre de");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Identité");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Titre");
	//Caption
	define("LANG_LABEL_CAPTION", "Légende");
	//impressions
	define("LANG_IMPRESSIONS", "affichages");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Affichages");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Par affichages");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "En période de temps");
	//Date
	define("LANG_LABEL_DATE", "Date");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Votre E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Sujet");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Message");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Mode de paiement");
	//Notes
	define("LANG_LABEL_NOTES", "Notes");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "C'est facile et rapide!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Fais des évaluations, laisse des commentaires sur le blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Fais des évaluations");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Avez-vous déjà un accès?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Profitez de nos services!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test de mot de passe");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Avez-vous oublié votre mot de passe?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Sommaire");
	//Detail
	define("LANG_LABEL_DETAIL", "Détail");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail de votre ami)");
	//From
	define("LANG_LABEL_FROM", "À partir de");
	//To
	define("LANG_LABEL_TO", "À");
	//to
	define("LANG_LABEL_DATE_TO", "à");
	//Last
	define("LANG_LABEL_LAST", "Dernier");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Dernier");
	//day
	define("LANG_LABEL_DAY", "jour");
	//days
	define("LANG_LABEL_DAYS", "jours");
	//New
	define("LANG_LABEL_NEW", "Nouveau");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Nouveau FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Type");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Cliquez Grâce");
	//Added
	define("LANG_LABEL_ADDED", "Ajouté");
	//Add
	define("LANG_LABEL_ADD", "Ajouter");
	//rating
	define("LANG_LABEL_RATING", "Évaluation");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "Évaluateur");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Commentateur");
	//System
	define("LANG_LABEL_SYSTEM", "Système");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "S'abonner au RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Niveau de sécurité du mot de passe");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Titre de l'Article");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Description");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO mots-clés");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "les sauts de ligne ne sont pas autorisés");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "séparer les éléments en utilisant une virgule (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Cliquez ici pour modifier le référencement des informations de cette rubrique.");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "Article mis à jour!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Cliquez ici pour voir cet article");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Cliquez ici pour modifier cet article");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Cliquez ici pour ajouter/modifier la galerie de photos pour cet article");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Galerie de photos non disponible pour cet article");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Cliquez sur ici pour consulter les rapports de cet article");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Historique pour cet article");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Historique non disponible pour cet article");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Cliquez ici pour supprimer cet article");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Cliquez ici pour voir cette bannière");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Cliquez ici pour modifier cette bannière");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Cliquez ici pour voir les rapports de cette bannière");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Historique de cette bannière");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Historique non disponible pour cette bannière");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Cliquez ici pour supprimer cette bannière");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Titre de l'Annonce");
	//Click here to
	define("LANG_MSG_CLICKTO", "Cliquez ici pour");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Cliquez ici pour voir cette annonce");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Cliquez ici pour modifier cette annonce");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Cliquez ici pour ajouter/modifier la galerie de photos pour cette annonce");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Galerie de photos non disponible pour cette annonce");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Cliquez ici pour voir les rapports pour cette annonce");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Cliquez ici pour régler l'emplacement de cette annonce");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Carte de réglage non disponible pour cette annonce");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Historique de cette annonce");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Historique non disponible pour cette annonce");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Cliquez ici pour supprimer cette annonce");
	//Event Title
	define("LANG_EVENT_TITLE", "Titre de l'Evénement");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Cliquez ici pour voir cet événement");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Cliquez ici pour modifier cet événement");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Cliquez ici pour ajouter/modifier la galerie de photos pour cet événement");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Galerie de photos non disponible pour cet événement");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Cliquez ici pour voir les rapports de cet événement");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Cliquez ici pour régler l'emplacement de cet événement");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Carte de réglage non disponible pour cet événement");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Historique de cet événement");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Historique non disponible pour cet événement");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Cliquez ici pour supprimer cet événement");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Titre de la galerie");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Cliquez ici pour voir cette galerie");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Cliquez ici pour éditer cette galerie");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Cliquez ici pour supprimer cette galerie");
	//Listing Title
	define("LANG_LISTING_TITLE", "Titre de la Liste");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Cliquez ici pour voir cette liste");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Cliquez ici pour modifier cette liste");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Cliquez ici pour ajouter/modifier la galerie de photos pour cette liste");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Galerie de photos non disponible pour cette liste");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Cliquez ici pour changer le offrir de cette liste");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Offrir pas disponible pour cette liste");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Cliquez ici pour voir les rapports de cette liste");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Cliquez ici pour régler l'emplacement de cette liste");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Carte de réglage non disponible pour cette liste");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Adresse introuvable.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Veuillez éditer votre article.");	
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Cliquez ici pour voir cet article commentaires");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Point commentaires non disponible");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Historique de cette liste");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Historique non disponible pour cette liste");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Cliquez ici pour supprimer cette liste");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Enregistrer");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Plus d'Informations");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Essayez d'utiliser quelque chose descriptive, comme \"10% de réduction de notre produit \" ou \"3 pour le prix de deux sur notre produit\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Entrez la valeur de l'article ou le service que vous offrez. Choisir un type de rabais (valeur fixe ou en pourcentage), et entrez la valeur respective. Vérifier le calcul, puis nous fournir le nombre d'offres que vous voudrez faire.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "S'il vous plaît assurez-vous de l'image est la bonne taille avant de la télécharger, sinon l'image sera probablement étendu pour s'adapter à la qualité du site et l'image sera affectée.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Tout affaire doit être liée à une liste pour être active sur le site..");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associé à la entreprise");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "S'il vous plaît entrez le titre de votre article et d'attendre pour obtenir des suggestions d'associations disponibles.");
	//Empty
	define("LANG_EMPTY", "Vide");
	//Cancel
	define("LANG_CANCEL", "Annulé");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Période Personnalisée");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Remise Valeur Fixe");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Pourcentage de Réduction");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valeur avec Escompte");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Remise (Calculé)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Combien souhaitez-vous faire face à offrir");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Lié à la Liste");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Choisissez un Liste");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Vous ne pouvez pas ajouter offres différentes pour une même liste.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Offres correctement mis à jour!");
	//Options
	define("LANG_LABEL_OPTIONS", "Options");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Titre du Offrir");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Cliquez ici pour voir cet ffrir");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Cliquez ici pour modifier cet offrir");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Cliquez ici pour supprimer cet offrir");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Aller aux \"Listes\" et cliquez sur l'icône de la liste où vous souhaitez ajouter le offrir. Choisissez un offrir à ajouter à votre pour le faire en direct.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Les versements seront récurrents jusqu'à l'expiration de votre carte de crédit");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "maximum de 36 versements");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Centre SEO");
	//View
	define("LANG_LABEL_VIEW", "Afficher");
	//Edit
	define("LANG_LABEL_EDIT", "Modifier");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galerie");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Rapport du Trafic");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Pas Payé");
	//Paid
	define("LANG_LABEL_PAID", "Payés");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "En attendant l'approbation");
	//Under review
	define("LANG_LABEL_ANALYSIS", "En cours de révision");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponible");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Dans le différend");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Remboursé");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Annulé");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transaction");
	//Delete
	define("LANG_LABEL_DELETE", "Supprimer");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Carte de Réglage");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Cacher la Carte");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Afficher la Carte");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimer");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "En attente d'approbation");
	//Image
	define("LANG_LABEL_IMAGE", "Image");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Images");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Champ Obligatoire");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "S\'il vous plaît entrez tous les champs requis.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informations sur Le Compte");
	//Username
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Mot de passe actuel");
	//Password
	define("LANG_LABEL_PASSWORD", "Mot de Passe");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Créer mot de passe");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nouveau mot de Passe");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Confirmer le mot de passe");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Confirmer le mot de passe");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Confirmer le nouveau mot de passe");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Information");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Date de Publication");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendrier");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Url Facile");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Par exemple");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Source de l'image");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Attributs de l'image");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Légende de l'image");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Résumé");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Mots-clés pour la recherche");
	//maximum
	define("LANG_LABEL_MAX", "max");
	//keywords
	define("LANG_LABEL_KEYWORDS", "Mots-clés");
	//Content
	define("LANG_LABEL_CONTENT", "Contenu");
	//Code
	define("LANG_LABEL_CODE", "Code");
	//free
	define("LANG_FREE", "gratuites");
	//free
	define("LANG_LABEL_FREE", "gratuites");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Destination Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "Fichier");
	//Warning
	define("LANG_LABEL_WARNING", "Attention");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Afficher URL (facultatif)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Description de la ligne 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Description de la ligne 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Emplacement");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Adresse (facultatif)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Adresse (facultatif)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Description en détail");
	//Price
	define("LANG_LABEL_PRICE", "Prix");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Prix");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Contact Info");
	//Language
	define("LANG_LABEL_LANGUAGE", "Langue");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Choisissez votre langue principale (si nécessaire).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Prénom");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Prénom");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Nom de Famille");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Nom de Famille");
	//Company
	define("LANG_LABEL_COMPANY", "Entreprise");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Adresse Ligne 1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Adresse Ligne 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Pas trouvé. S'il vous plaît, essayez de mieux spécifier votre emplacement.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Les champs suivants contiennent des erreurs:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude doit être un nombre compris entre -90 et 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude doit être un nombre entre -180 et 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Emplacement");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Date de l'Evénement");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Description");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Aide");
	//Text
	define("LANG_LABEL_TEXT", "Texte");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Ajouter une Image");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Ajouter une Image");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Modifier la légende de l'Image");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Fichier de l'Image");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Légende de la Vignette");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Légende de l'Image");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Remarque, votre téléchargement peut prendre plusieurs minutes selon la taille du fichier et de votre connexion Internet. Si vous cliquez sur rafraîchir ou naviguez en dehor de cette page votre transfert sera annulé.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Code Extrait Vidéo");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Joindre des fichiers additionnels");
	//Attention
	define("LANG_LABEL_ATTENTION", "Attention");
	//Source
	define("LANG_LABEL_SOURCE", "Source");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Heures de travail");
	//Default
	define("LANG_LABEL_DEFAULT", "Défaut");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Mode de Paiement");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Par Carte de Crédit");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Par PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Par SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Par Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimer la Facture et Envoyer un Chèque");
	//Headline
	define("LANG_LABEL_HEADLINE", "Headline");
	//Offer
	define("LANG_LABEL_OFFER", "Offre");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Conditions");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Dates du Offrir");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Image du Offrir");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Imprimable");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Notre modèle basé HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Remplissez les champs ci-dessus et d'insérez un logo ou une image (JPG ou GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Un offrir que vous avez fournis au lieu");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Image JPG ou GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Titre");
	//Comment
	define("LANG_LABEL_COMMENT", "Commentaire");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Accepté");
	//Approved
	define("LANG_LABEL_APPROVED", "Approuvé");
	//Success
	define("LANG_LABEL_SUCCESS", "Succès");
	//Completed
	define("LANG_LABEL_COMPLETED", "Terminé");
	//Y
	define("LANG_LABEL_Y", "O");
	//Failed
	define("LANG_LABEL_FAILED", "Échec");
	//Declined
	define("LANG_LABEL_DECLINED", "Refusée");
	//failure
	define("LANG_LABEL_FAILURE", "échec");
	//Canceled
	define("LANG_LABEL_CANCELED", "Annule");
	//Error
	define("LANG_LABEL_ERROR", "Erreur");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Code de Transaction");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Abonnement ID");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "Historique des transactions");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Code d'Autorisation");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "État de la Transaction");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Erreur de Transaction");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Montant de la Facture Mensuelle");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "Transaction OID");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Montant de la Facture Annuelle");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Montant de la Facture");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "ID de la Transaction");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "ID de la Réception");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "ID de l'Abonnement");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "ID de la Commande");
	//your
	define("LANG_LABEL_YOUR", "votre");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Faites Votre");
	//Payment
	define("LANG_LABEL_PAYMENT", "Paiement");
	//History
	define("LANG_LABEL_HISTORY", "Historique");
	//Sign in
	define("LANG_LABEL_LOGIN", "Connexion");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transaction annulée");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Le montant de la transaction");
	//Pay
	define("LANG_LABEL_PAY", "Payer");
	//Back
	define("LANG_LABEL_BACK", "Retour");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Prix Total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Payer par Facturation");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrateur");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informations sur la Facturation");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Numéro de la Carte");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Date d'Expiration de la Carte");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Code de la Carte");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Infos client");
	//zip
	define("LANG_LABEL_ZIP", "code postal");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Commander et Continuer");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Information générale");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Numéro de Téléphone");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Adresse E-mail ");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informations sur la Carte de Crédit");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Date d'Expiration");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Informations sur le client");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Expiration de la Carte");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nom sur la Carte");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Type de Carte");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Numéro de Vérification de la Carte");
	//Province
	define("LANG_LABEL_PROVINCE", "Région");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Code Postal");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Code Postal");
	//Tel
	define("LANG_LABEL_TEL", "Téléphone");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Choisissez une Date");
	//Found
	define("LANG_PAGING_FOUND", "Trouvé");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Trouvé");
	//record
	define("LANG_PAGING_RECORD", "record");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "records");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Affichage de la page");
	//of
	define("LANG_PAGING_PAGEOF", "de");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "pages");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Aller à la page");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Choisissez");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Classement par:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caractères");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Dernière mise à jour");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Date de création");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Populaires");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Évaluation");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "​​Prix");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "retour page");
	//next page
	define("LANG_PAGING_NEXTPAGE", "page suivante");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "retour");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "suivante");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Article ajouté avec succès!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Bannière ajouté avec succès!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Annonce ajouté avec succès!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Événement ajouté avec succès!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Galerie ajouté avec succès!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Liste ajouté avec succès!");
	//Offres successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Offres ajouté avec succès!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Article mis à jour ajouté avec succès!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Bannière mise à jour ajouté avec succès!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Annonce mise à jour ajouté avec succès!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Événement mis à jour ajouté avec succès!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Galerie mise à jour ajouté avec succès!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Liste mise à jour ajouté avec succès!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Offrir mise à jour ajouté avec succès!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Carte des Réglages mis à jour ajouté avec succès!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Galerie changé avec succès!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Offrir a été supprimé avec succès!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Offrir changé avec succès!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Bannière supprimé avec succès!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Type d'image non valide. S'il vous plaît d'insérer une image JPG, GIF ou PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Le fichier image est trop grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "S'il vous plaît essayez de nouveau avec une autre image.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Le fichier joint a été refusée. Type de fichier incorrect.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Cliquez ici pour voir la galerie");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Cliquez ici pour gérer les images de la galerie");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "S'il vous plaît entrez votre e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail n'a pas été trouvé.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "S'il vous plaît essayez à nouveau ou contactez le support à l'adresse suivante:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Le système 'mot de passe oublié' est désactivé.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "S'il vous plaît contacter le support à l'adresse suivante:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Merci!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Un e-mail a été envoyé au titulaire du compte avec les instructions pour obtenir un nouveau mot de passe");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Fichier non trouvé!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Erreur! Pas d'image vignette!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "Pour le moment, aucune image a été téléchargée dans cette galerie!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Cliquez ici pour imprimer la facture");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Cliquez ici pour consulter la facture détaillée");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(les prix sont par acomptes)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Objets non payés");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Pas de Check Out obligatoire");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Déplacez la souris sur les barres pour voir plus de détails sur le graphique)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Cliquez sur le type de rapport pour afficher le graphique)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Cliquez ici pour voir cette évaluations");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Cliquez ici pour éditer cette évaluations");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Cliquez ici pour éditer cette réponse");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Cliquez ici pour supprimer cette évaluations");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "En Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Évaluations en Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Réponse en Attente d'Approbation du Gestionnaire de Site");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Évaluations et Réponse en Attente d'Approbation du Gestionnaire de Site");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Evaluation déjà Approuvé");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Evaluation et Réponse déjà Approuvé");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Evaluation en Attente d'Approbation");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Réponse en Attente d'Approbation");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Evaluation Activer");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Réponse Activer");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Evaluation et Réponse en Attente d'Approbation");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Evaluation et Réponse Activer");
	//Reply
	define("LANG_REPLY", "Répondre");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Réponse");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Evaluation et Réponse");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Modifier Evaluation");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Modifier Réponse");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Approuver Evaluation");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Approuver Réponse");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Réponse déjà Approuvé");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Evaluation envoyé avec succès!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Réponse envoyée avec succès!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "S'il vous plaît taper une réponse valide!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "S'il vous plaît taper un nom valide!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "S'il vous plaît taper un e-mail valide!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "S'il vous plaît taper una ville, région valide!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "S'il vous plaît taper un titre valide!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "S'il vous plaît taper una evaluation valide!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "S'il vous plaît choisir une option ou cliquez sur annuler pour quitter.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Cliquez ici pour répondre de cet evaluation");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Cliquez ici pour visualiser la transaction");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail doit être comprise entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caractères sans espaces.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Mot de passe doit être compris entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Tapez votre mot de passe ici si vous voulez le changer.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Mot de passe va être envoyé à l'adresse e-mail du membre.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "S'il vous plaît écrivez votre e-mail et mot de passe pour référence future.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "S\'il vous plaît vérifiez les termes du contrat.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Ajouté avec succès!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Cette catégorie a déjà été insérée");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "S'il vous plaît, choisissez une catégorie valide");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "S\'il vous plaît, choisissez une catégorie d\'abord");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Vous pouvez choisir que le titre du nom de la page soit directement accessibles à partir du navigateur Web comme une page html statique. Le choix du titre du nom de la page doit contenir uniquement des caractères alphanumériques (comme \"a-z\" et/ou \"0-9\") et \"-\" en lieu d'espaces");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Titre du nom de la page");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Images supplémentaires peuvent être ajouté à la");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "galerie (si elle est activée).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Taille maximale du fichier");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Transparent .Gif ou .Png n'est pas pris en charge");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animé n'est pas supporté.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "S'il vous plaît assurez-vous que les dimensions de votre image en forme avec les dimensions recommandées des pixels, sinon la qualité d'image peut être affectée.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Cochez cette case pour supprimer votre image");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "250 caractères max");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "al massimo 100 caratteri");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caractères restants");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(y compris les espaces et les sauts de ligne)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Inclure jusqu'à");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "mots-clés avec un maximum de 50 caractères chacun.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Ajouter un mot-clé ou une expression par ligne. Par exemple:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "25 caractères maximum");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "500 caractères maximum");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Types de fichiers acceptés");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Cliquez ici pour avoir un aperçu de cette liste");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Cliquez ici pour avoir un aperçu de cet événement");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Cliquez ici pour avoir un aperçu de cette annonce");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Cliquez ici pour avoir un aperçu de cet article");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Cliquez ici pour avoir un aperçu de cette bannière");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Cliquez ici pour avoir un aperçu de cet offrir");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Cliquez ici pour avoir un aperçu de cette galerie");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "30 caractères maximum");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Choisissez un Pays");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Choisissez une Région");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Choisissez un État");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Choisissez une Ville");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Choisissez un Quartier");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Ces informations ne seront pas affichées publiquement)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Votre article apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Si le code extrait vidéo a été rempli, il apparaîtra sur la page de détail");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Taille maximale du code vidéo supporté");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Si la taille de la vidéo est plus grande que la taille vidéo supportée, elle sera modifiée.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "La pièce jointe n'a pas de légende");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Cochez cette case pour supprimer les pièces jointes de la Liste");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Ajoutez une phrase par ligne. Par exemple");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Catégories extras/sous-catégories coûtent un");
	//additional
	define("LANG_MSG_ADDITIONAL", "supplément de");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "chaque. Démarquez-vous!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre enterprise n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre article n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre annonce n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Si vous ajouter de nouvelles catégories, votre événement n'apparaîtra pas dans la catégorie principale de chaque sous-catégorie que vous avez ajouté que gestionnaire du site de les approuver.");
	//Request your listing to be considered for the following bedges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Demandez que votre liste soit prise en considération pour les badges suivantes.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Cliquez ici pour sélectionner une date");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Cliquez sur");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "l'icônes de la galerie");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "ci-dessous si vous voulez ajouter des photos à votre galerie photo");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Cliquez sur");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "l'icônes de le offrir");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "ci-dessous si vous voulez ajouter un Offres à votre liste");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Vous pouvez ajouter un offrir à votre liste en cliquant sur le lien");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "ajouter un offrir");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Toutes les pages sauf les pages d'objets");
	//All pages
	define("LANG_ALLPAGES", "Toutes les pages");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Recherche sans catégorie");
	//deal
	define("LANG_ICONPROMOTION", "offrir");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "e-mail un ami");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "ajouter aux favoris");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "supprimer des favoris");
	//print
	define("LANG_ICONPRINT", "imprimer");
	//map
	define("LANG_ICONMAP", "carte");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Ajouter à");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google Maps n'est pas disponible. S'il vous plaît contacter l'administrateur.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Supprimer");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Articles Favoris");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Annonces Favoris");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Evénements Favoris");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Listes Favories");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Offres Favories");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publié");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Plus d'Info");
	//Date
	define("LANG_EVENT_DATE", "Date");
	//Time
	define("LANG_EVENT_TIME", "Heure");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Obtenir l'itinéraire");
	//Website
	define("LANG_EVENT_WEBSITE", "Web site");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Téléphone");
	//More
	define("LANG_EVENT_MORE", "Plus");
	//More Info
	define("LANG_EVENT_MOREINFO", "Plus d'Info");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Voir toutes les catégories");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//More Info
	define("LANG_LISTING_MOREINFO", "Plus d'Info");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "afficher le téléphone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "afficher le fax");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "envoyer un e-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Cliquez ici pour avoir plus d'infos!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Pour nous contacter, merci de remplir le formulaire ci-dessous ");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Communiquez cette Liste");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Soumettre question");
	//phone
	define("LANG_LISTING_LETTERPHONE", "téléphone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "web site");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "offre les produits et/ou services suivants:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Heures de travail");
	//Check in
	define("LANG_CHECK_IN", "Vérifier dans");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Pas de commentaire trouvé pour l'examen de ce point!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Revisiones et commentaires du dernier mois");
	//Review
	define("LANG_REVIEW", "Revisione");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Revisiones");
	//Reviews
	define("LANG_REVIEWTITLE", "Revisiones");
	//review
	define("LANG_REVIEWCOUNT", "revisione");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "revisiones");
	//check in
	define("LANG_CHECKINCOUNT", "vérifier dans");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "vérifier dans");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Voir vérifier ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Vérifier ins");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Pas de vérifier trouvé pour l'examen de ce point!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Catégories Associés");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Sous-catégories");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Regarder les commentaires");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Donnez votre avis!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Soyez le premier à donner votre avis!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Offert par");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Plus d'Info");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Valable à partir du");
	//to
	define("LANG_PROMOTION_VALIDTO", "à");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimer");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Article");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Articles");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Bannière");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Bannières");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Annonce");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Annonces");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Événement");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Événements");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Entreprise");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Entreprises");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Offrir");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Offres");
	//Send
	define("LANG_BUTTON_SEND", "Envoyer");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "S'inscrire");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Voir le plan de Catégorie");
	//More info
	define("LANG_VIEWCATEGORY", "Plus d'info");
	//No info found
	define("LANG_NOINFO", "Pas d'infos trouvées");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Supprimer la Catégorie Choisie");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continuer");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Non, merci");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Oui, continuer.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Non, sans ordonnance le Paquet.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Augmentez votre Visibilité!");
	//Gift
	define("LANG_GIFT", "Présent");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Aider à augmenter votre visibilité, consultez notre ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Statistiques du site!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visiteurs par Mois");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Option personnalisée");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Annuler");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Connexion");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Enregistrez la Carte des Réglages");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Effacer Carte Des Réglages");
	//Next
	define("LANG_BUTTON_NEXT", "Suivant");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Payer par Carte de Crédit");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Payer par PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Payer par SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Rechercher");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avancée");
	//Advanced Search Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Fini");
	//Clear
	define("LANG_BUTTON_CLEAR", "Effacer");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Ajouter votre Article");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Ajouter votre Annonce");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Ajouter votre Événement");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Ajouter votre Liste");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Ajouter votre Offrir");
	//Home
	define("LANG_BUTTON_HOME", "Accueil");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Gérer Compte");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gérez le Contenu");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Zone Sponsor");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Zone Administrative");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Section Administrative");
	//Help
	define("LANG_BUTTON_HELP", "Aide");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Déconnexion");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Envoyer");
	//Update
	define("LANG_BUTTON_UPDATE", "Envoyer");
	//Back
	define("LANG_BUTTON_BACK", "Retour");
	//Delete
	define("LANG_BUTTON_DELETE", "Supprimer");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Compléter le Processus");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Entrez le texte que vous voyez dans l'image à gauche dans la zone de texte. Cela est nécessaire pour éviter la soumission automatique de demandes de contact.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Le Code de Vérification ne peut pas s'afficher");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Code de Vérification");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "S'il vous plaît choisir un avis pour cet article");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraude détectée! S'il vous plaît choisir un avis pour cet article!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Titre du Commentaire\" et \"Commentaire\" sont nécessaires pour poster un commentaire!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Nom\" et \"E-mail\" sont nécessaires pour poster un commentaire!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Ville, Région\" sont nécessaires pour poster un commentaire!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Entrez un e-mail valide s'il vous plait!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Vous avez déjà donné votre avis sur ce point. Merci.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Merci pour les commentaires!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Votre évaluation a été soumise pour approbation.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Le mode de paiement n'a pas été sélectionné!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "La date d'expiration de la carte de crédit est incorrecte. Essayez de nouveau s'il vous plaît.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Cliquez ici pour essayer de nouveau");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Les opérations de paiement ne sont pas immédiates.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Après traitement de votre paiement, les informations sur votre transaction");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "se trouveront dans l'historique de vos transactions.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "se trouveront dans");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "La passerelle de paiement n'est pas disponible actuellement");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Les paramètres du paiement n'ont pas pu être validés");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Une erreur interne s'est produite sur la passerelle");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Des informations sur votre transaction peuvent être retrouvées");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "dans l'historique de vos transactions.");
	//in your
	define("LANG_MSG_IN_YOUR", "dans votre");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "Pas d'ID de Transaction");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Défaillance du système, essayez de nouveau s'il vous plaît.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "S'il vous plaît remplir tous les champs obligatoires.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Connexion impossible.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Merci d'avoir mis en place vos objets et d'avoir fait le paiement!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Le gestionnaire de site passera en revue vos objets et ils seront disponibles dans les 2 jours ouvrables.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "La passerelle de paiement ne peut pas répondre");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Paiements en attente peuvent prendre 3 à 4 jours avant d'être approuvé.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Problème avec la Connexion");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "S'il vous plaît remplir correctement le code postal.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "S'il vous plaît remplir correctement le code de sécurité.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Le Type de Carte et le Code de Sécurité ne correspondent pas.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "La Transaction n'est pas Terminée.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Numéro d'erreur:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Message court");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Message long");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transaction Effectuée avec Succès.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "La date d'expiration de la Carte doit être une date future");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Si votre transaction a été confirmée, vous pouvez trouver des informations dans");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "l'historique de vos transactions, après traitement de votre paiement.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "après traitement de votre paiement.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Aucun élément exigeant paiement.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Payer les factures impayées");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Bannière par affichage et factures personnalisées peuvent être payé une fois.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Bannière par affichage peut être payé une fois.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Facture Personnalisé peut être payé une fois.");
	//View Items
	define("LANG_VIEWITEMS", "Voir les Articles");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "S'il vous plaît ne pas utiliser le système de paiement récurrent.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Essayez de nouveau!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Tous les champs sont obligatoires.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Vous avez plus de");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "S'il vous plaît contactez l'administrateur pour effectuer votre paiement.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Options de l'Article");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Auteur de l'Article");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL de l'Auteur");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Catégorie de l'Article");
	//Banner Type
	define("LANG_BANNER_TYPE", "Type de Bannière ");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Options de la Bannière");
	//Order Banner
	define("LANG_ORDER_BANNER", "Commander Bannière");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Par période de temps");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Détails de Bannière ");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Script Bannière");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Afficher par Code Script");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permettre de rentrer un script au lieu d'une image. Ce champ vous permet de coller le script qui sera utilisé pour afficher la bannière d'un programme affilié ou d'un système de bannière externe. Si \"Afficher par Script Code\" est cochée, seulement le champ \"Script\" sera nécessaire. Les autres champs ci-dessous ne seront pas obligatoires.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Les deux \"Destination Url\" et \"Trafic Cliquez Grâce\" n'a aucun effet lorsque vous téléchargez le script de bannières.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Les deux \"Url Destination\" et \"Trafic Cliquez Grâce\" n'ont aucun effet lorsque vous téléchargez des fichiers swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Niveau de l'Annonce");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Catégorie de l'Annonce");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Choisissez le niveau de l'Annonce");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Options de l'Annonce");
	//Event Level
	define("LANG_EVENT_LEVEL", "Niveau de l'Événement");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Catégories de l'Événement");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Catégories de l'Événement");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Choisissez le niveau de l'événement");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Options de l'Événement");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Niveau de la Liste");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Type d'annonce");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Catégories de la Liste");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Badges de la Liste ");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sous réserve de l'approbation de l'administrateur.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Sélectionnez ce choix");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Sélectionnez le niveau de la liste");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Options de la Liste ");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "Le Système de Paiement Authorize n'est pas disponible actuellement. S'il vous plaît contacter");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "Le Système de Paiement iTransact n'est pas disponible actuellement. S'il vous plaît contacter");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "Le Système de Paiement LinkPoint n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "Le Système de Paiement Payflow n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "Le Système de Paiement PayPal n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "Le Système de Paiement PayPalAPI n'est pas disponible actuellement. S'il vous plaît contacter");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "Le Système de Paiement PSIGate n'est pas disponible actuellement. S'il vous plaît contacter");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "Le Système de Paiement 2CheckOut n'est pas disponible actuellement. S'il vous plaît contacter");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "Le Système de Paiement WorldPay n'est pas disponible actuellement. S'il vous plaît contacter");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "Le Système de Paiement SimplePay n'est pas disponible actuellement. S'il vous plaît contacter");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Télécharger une Alerte");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Fichier téléchargé avec succès!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "L'extension du fichier n'est pas autorisée ou le type de fichier est incorrect!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Le fichier dépasse la taille maximale autorisée!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Impossible de créer le répertoire!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Permissions du répertoire incorrect!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Échec inattendu!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Fichier non trouvé ou le nom du fichier n'a pas été rentré!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Le fichier existe déjà dans le répertoire!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Voir tous les Emplacement");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Sites en Vedette");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Il n'y a pas un endroit aussi dans le système.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Présentation");
	//Video
	define("LANG_LABEL_VIDEO", "Vidéo");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Emplacement sur la Carte");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Plus Listes");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Plus Événements");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Plus Annonces");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Plus Articles");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Opération non permise: le offrir");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "est déjà associé avec l'entreprise");
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
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Cliquez sur \"Ajouter\" pour sélectionner des catégories");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Cliquez sur \"Ajouter une catégorie principale\" ou \"Ajouter sous-catégorie\" à taper votre nouvelles catégories");
	//Add an
	define("LANG_ADD_AN", "Ajouter un");
	//Add a
	define("LANG_ADD_A", "Ajouter un");
	//on these sites
	define("LANG_ON_SITES", "sur ces sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "sur ce site:");

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
	define("LANG_GALLERYTITLE", "Galerie de photos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Cliquez ici");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "pour le diaporama. Vous pouvez également cliquer sur une photo pour démarrer le diaporama.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "plus de photos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Code de Rabais Inexistant");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "Non disponible.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "Non disponible pour ce type d'objet.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "ne peut pas être utilisé deux fois.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "Vous pouvez sélectionner jusqu'à");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "galerie.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galeries.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Le Titre est obligatoire.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "La Langue est obligatoire.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Le Prénom est obligatoire.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Le Nom de Famille est obligatoire.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "L'Entreprise est obligatoire.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Le Numéro de Téléphone est obligatoire.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "L'Adresse E-mail est obligatoire.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Le Compte est obligatoire.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Le Nom de la Page est obligatoire.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "La Catégorie est obligatoire.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Le Résumé est obligatoire.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Le type d'Expiration est obligatoire.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "La Date de Renouvellement est obligatoire.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Les affichages sont obligatoires.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Le Fichier est obligatoire.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Le Type est obligatoire.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "La Légende est obligatoire.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Le Code Script est obligatoire.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "La Description 1 est obligatoire.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "La Description 2 est obligatoire.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Le Nom est obligatoire.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Titre du Offrir est obligatoire.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Offre est obligatoire.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Date de début est obligatoire.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Date de Fin est obligatoire.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Le Texte est obligatoire.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail est nécessaire.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Mot de passe actuel\" est incorrecte.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "\"Mot de passe\" est obligatoire.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Accepter les termes d'utilisation\" est obligatoire.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Les champs suivants ne sont pas remplis ou ils contiennent des erreurs:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Titre - S'il vous plaît remplir le champ");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nom de la page - S'il vous plaît remplir le champ");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Maximum de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "catégories sont autorisées.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "URL Facile est en cours d'utilisation, s'il vous plaît choisir un autre URL Facile.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Le Nom de la page contient des caractères non valides");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Maximum de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "mots-clés sont autorisés");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "S'il vous plaît inclure des mots-clés avec un maximum de 50 caractères chacun");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "S'il vous plaît entrez une \"Date de publication\".");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "S'il vous plaît entrez une \"Date de Début\".");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "S'il vous plaît entrez une \"Date de Fin\".");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "La \"Date de Fin\" doit être supérieure ou égale à la \"Date de Début\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "La \"Date de Fin\" doit être supérieure à la \"Date de Début\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "La \"Date de Fin\" ne peut pas être dans le passé.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "S'il vous plaît entrer une adresse e-mail valide.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "S'il vous plaît entrer un \"URL valide\".");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "S'il vous plaît fournir une description avec un maximum de 255 caractères.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "S'il vous plaît fournir les conditions avec un maximum de 255 caractères.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "S'il vous plaît entrer une date de renouvellement valide.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Date de renouvellement doit être une date future. ");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "S'il vous plaît entrer une date d'expiration valide.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Date d'expiration doit être une date future.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Les espaces ne sont pas autorisés dans le mot de passe.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "S'il vous plaît entrer un mot de passe avec un maximum de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "S'il vous plaît entrer un mot de passe avec un minimum de");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "S'il vous plaît entrer un e-mail valide.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Désolé, vous ne pouvez pas modifier ces informations du compte");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "Mot de Passe \"abc123\" non autorisé!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Les mots de passe ne correspondent pas. S'il vous plaît entrer le même contenu pour les");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "Les espaces ne sont pas autorisés pour l'e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "Les caractères spéciaux ne sont pas autorisés pour l'e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "S'il vous plaît taper un e-mail avec un maximum de");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "S'il vous plaît taper un e-mail avec un minimum de");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "S'il vous plaît choisir une autre adresse e-mail.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Cliquez ici si vous ne voyez pas votre catégorie");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Ajouter la catégorie principale");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Ajouter la sous-catégorie");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Titre de la catégorie déjà inscrit!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Titre de la catégorie disponible!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Accueil");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Dashboard");
	//Manage
	define("LANG_MENU_MANAGE", "Gérer");
	//Add
	define("LANG_MENU_ADD", "Ajouter");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Options des Sponsors");
	//Listings
	define("LANG_MENU_LISTING", "Listes");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Ajouter une Liste");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Gérer les Listes");
	//Galleries
	define("LANG_MENU_GALLERY", "Galeries");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Ajouter une Galerie");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Gérer les Galeries");
	//Events
	define("LANG_MENU_EVENT", "Événements");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Ajouter un Événements");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Gérer les Événements");
	//Banners
	define("LANG_MENU_BANNER", "Bannières");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Ajouter une Bannière");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Gérer les Bannières");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Annonces");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Ajouter une Annonce");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Gérer les Annonces");
	//Articles
	define("LANG_MENU_ARTICLE", "Articles");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Ajouter un Article");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Gérer les Articles");
	//Deals
	define("LANG_MENU_PROMOTION", "Offres");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Ajouter un Offrir");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Gérer les Offres");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Publicité");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Page Introuvable");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Page de Maintenance");
	//FAQ
	define("LANG_MENU_FAQ", "Questions");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Plan du site");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contacter");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Options de Paiement");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Passer la Commande");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Faites Votre Paiement");
	//History
	define("LANG_MENU_HISTORY", "Historique");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Historique des Transactions");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Historique des Factures");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Choisissez un Thème");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Choisissez un Color Scheme");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Recherche un Article");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Rechercher un Annonce");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Rechercher un Evénement");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Rechercher une Liste");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Rechercher un Offrir");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Recherche Avancée");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Recherche");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Emplacement");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Choisissez un Pays");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Choisissez a Région");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Choisissez une État");
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Choisissez une Ville");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Choisissez a Quartier");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Catégorie");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Choisissez une Catégorie");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtre");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Phrase Exacte");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "N'importe quel Mot");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Tous les Mots");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Type de Liste");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "à");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "de");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Recherche par mots clés");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Recherche");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "S'il vous plaît fournir que des mots avec au moins [FT_MIN_WORD_LEN] lettres pour la recherche!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Vedette");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Articles Récents");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Prochains Evénements");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Annonces Vedettes");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Articles Vedettes");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Listes Vedettes");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Offres Vedettes");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Voir tous les articles");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Voir tous les evénements");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Voir tous les annonces");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Voir tous les listes");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Voir tous les offres");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Dernier Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Facile et Rapide.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Étapes");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Étapes");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "S'inscrire au Compte");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Mise à jour de la Liste");
	//Order
	define("LANG_ORDER", "Commander");
	//Check Out
	define("LANG_CHECKOUT", "Payer");
	//Configuration
	define("LANG_CONFIGURATION", "Configuration");
	//Select a level
	define("LANG_SELECTPACKAGE", "Choisissez un niveau");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Options du Profil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Répertoire Compte");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Mon compte OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Mon compte Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Mon compte Google");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Avez-vous déjà un compte?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Non, je suis un Nouvel Utilisateur.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Oui, j'ai déjà un Compte.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Connectez-vous avec mon Répertoire compte.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Connectez-vous avec mon compte OpenID 2.0.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Connectez-vous avec mon compte Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Connectez-vous avec mon compte Google.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informations sur le compte");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Information Additionnelle");
	//Please write down your username and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "S'il vous plaît écrivez votre e-mail et mot de passe pour référence future.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail doit être un e-mail valide entre");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "et");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caractères sans espaces.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Mot de Passe doit être compris entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "et");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caractères sans espaces.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Je suis d'accord avec les conditions d'utilisation");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Publicité avec nous?");
	//Buy a link
	define("LANG_BUY_LINK", "Acheter un lien");
	//Back to Top
	define("LANG_BACKTOTOP", "Haut de page");
	//Back to
	define("LANG_BACKTO", "Retour aux ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoris");
	//view summary
	define("LANG_VIEWSUMMARY", "afficher le résumé");
	//view detail
	define("LANG_VIEWDETAIL", "afficher le détail");
	//Advertisers
	define("LANG_ADVERTISER", "Les Annonceurs");
	//Order Now!
	define("LANG_ORDERNOW", "Commander!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Patientez, Chargement ...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Total partiel");
	//Subtotal
	define("LANG_SUBTOTAL", "Total partiel");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total des taxes");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Montant Total");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoris");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Aucun favori trouvé!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Résultats de recherche pour");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Relatif Recherche");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Rechercher par Section");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Mots-clés");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "(tapez un mot-clé)");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Mot-clé ou nom de l'entreprise");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Mot-clé ou titre de le offrir");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Mot-clé ou titre de l'evénement");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Mot-clé ou titre de l'annonce");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Mot-clé ou titre de l'article");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Où");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Adresse, Ville, Région ou Code Postal)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Recherche de votre emplacement...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Pour nous contacter, merci de remplir le formulaire ci-dessous.");
	//Message
	define("LANG_LABEL_MESSAGE", "Message");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Aucune catégorie handicapés dans le système.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Aucune catégorie trouvée.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "S'il vous plaît choisir une catégorie valide");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "S'il vous plaît sélectionner une catégorie d'abord!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Afficher le Plan de Catégories");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Supprimer la Catégorie Choisie");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Catégories extras/sous-catégories coûtent un");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "supplément de");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "chaque. Démarquez-vous!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Maximum de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "catégories de permis.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Catégories et sous-catégories");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Sélectionnez seulement les sous-catégories qui s'appliquent directement à votre type.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Votre liste apparaîtra automatiquement dans la catégorie principale de chaque sous-catégorie que vous sélectionnez");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Erreur sur les Informations du Compte");
	//Contact Information
	define("LANG_CONTACTINFO", "Contact Information");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Cette information ne sera pas montrée publiquement.");
	//Billing Information
	define("LANG_BILLINGINFO", "Informations de Facturation");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Cette information ne sera pas montrée publiquement.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Vous allez configurer votre article, après avoir passé commande.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Vous allez configurer votre bannière, après avoir passé commande.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Vous allez configurer votre annonce, après avoir passé commande.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Vous allez configurer votre événement, après avoir passé commande.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Vous allez configurer votre liste, après avoir passé commande.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Erreur sur les Informations de Facturation ");
	//Article Information
	define("LANG_ARTICLEINFO", "Information sur l'Article");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Erreur sur les informations d'Article");
	//Banner Information
	define("LANG_BANNERINFO", "Information sur la Bannière");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Erreur sur les informations de Bannière");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Information sur les Annonces");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Erreur sur les Informations de l'Annonce");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Rechercher un événement par date");
	//Event Information
	define("LANG_EVENTINFO", "Information sur l'Événement");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Erreur sur les Informations de l'Événement");
	//Listing Information
	define("LANG_LISTINGINFO", "Informations sur la liste ");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Erreur sur les Informations de la Liste");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Réclamez cette Liste");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Type d'annonce");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Aucun résultat trouvé pour les critères de recherche que vous avez demandé.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "S'il vous plaît essayer votre recherche de nouveau ou naviguez par section.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Parfois, vous n'allez pas reçevoir de résultats pour votre recherche, car le mot-clé que vous avez utilisé est très générique. Essayez d'utiliser un mot-clé plus specifique et de réeffectuer votre recherche.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "S'il vous plaît renter au moins un mot-clé sur le champ de recherche.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Désolé!</h1><p>Votre recherche ne renvoie aucun résultat. Bien que ce qui est inhabituel, il arrive de temps en temps, quand le terme de recherche que vous avez utilisé est un générique peu ou quand nous n'avons pas vraiment de tout contenu adapté.</p><h2>Suggestions:</h2>Soyez plus précis avec vos termes de recherche.<br />Vérifiez l'orthographe.<br />Si vous ne pouvez pas trouver via la recherche essayez Browing par l'article.<br /><br /><p>Si tu crois que vous êtes venus ici dans l'erreur, s'il vous plaît contacter le gestionnaire du site pour signaler un problème <a href=\"[EDIR_LINK_SEARCH_ERROR]\">ici</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Image");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Erreur lors du chargement de l'image");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Suivant");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pause");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Lire");
	//Back
	define("LANG_SLIDESHOW_BACK", "Retour");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Votre adresse e-mail a été envoyée. Merci.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Un problème est survenu lors de l'envoi de cet e-mail. S'il vous plaît essayer de nouveau.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "S'il vous plaît entrer votre nom.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "S'il vous plaît entrer une adresse e-mail valide.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "S'il vous plaît saisir le message.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "S'il vous plaît rentrer le code correctement.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "S'il vous plaît corriger et essayer de nouveau.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "S'il vous plaît entrer un nom!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "S'il vous plaît entrer un sujet!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "QUELQUES DETAILS");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"À\"");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Point Not Found. S'il vous plaît revenir à");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "et essayez à nouveau.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "S'il vous plaît entrer une adresse e-mail valide dans le champ \"Votre E-mail\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "À propos de ");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "À propos de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "de la ");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "À propos de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "de la ");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Envoyer des informations sur cet article à un ami");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Envoyer des informations sur cette annonce à un ami");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Envoyer des informations sur cet événement à un ami");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Envoyer des informations sur cette liste à un ami");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Envoyer des informations sur cet offrir à un ami");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Message envoyé par ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Ceci est un message automatique.");
	//Contact
	define("LANG_CONTACT", "Contacter");
	//article
	define("LANG_ARTICLE", "article");
	//classified
	define("LANG_CLASSIFIED", "annonces");
	//event
	define("LANG_EVENT", "événement");
	//listing
	define("LANG_LISTING", "liste");
	//deal
	define("LANG_PROMOTION", "offrir");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "S'il vous plaît de recherche au moins un paramètre dans le champ de recherche!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "S'il vous plaît essayer de nouveau votre recherche.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Aucun article enregistré pour le moment.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Aucune annonce enregistré pour le moment.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Aucun événement enregistré pour le moment.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Aucune liste enregistré pour le moment.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Aucun offrir enregistré pour le moment.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Message envoyé par");
	//E-mail Form
	define("LANG_EMAILFORM", "Formaulaire E-mail");
	//Click here to print
	define("LANG_PRINTCLICK", "Cliquez ici pour imprimer");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Emplacement");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Plus d'Annonces");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Location
	define("LANG_EVENT_LOCATIONS", "Emplacement");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Événements Vedettes");
	//events
	define("LANG_EVENT_PLURAL", "Événements");
	//Search results
	define("LANG_SEARCHRESULTS", "Résultats de la recherche");
	//Results
	define("LANG_RESULTS", "Résultats");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "pour");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "dans");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "dans");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "dans");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "dans la catégorie");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "dans");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "dans");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "à");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Page");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Les Commentaires Récents");
	//Reviews of
	define("LANG_REVIEWSOF", "Les revisiones de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Revisiones non disponibles");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Afficher toutes les catégories");
	//Offer
	define("LANG_PROMOTION_OFFER", "Offre");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Description");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Conditions");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Emplacement");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Objet non trouvé!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Objet non disponible!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Résultats de Recherche pour Listes");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Résultats de Recherche pour Offres");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Résultats de Recherche pour Événements");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Résultats de Recherche pour Annonces");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Résultats de Recherche pour Articles");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Langues Disponibles");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Vous pouvez choisir jusqu'à ".MAX_ENABLED_LANGUAGES." au large des langues ci-dessous pour votre répertoire.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Profitez de nos services!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Supprimer l'association avec");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bienvenue");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Options des sponsors");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Retour au Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Ajouter un Nouveau Compte");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Mot de passe oublié");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Cliquez ici");
	//Help
	define("LANG_LABEL_HELP", "Aide");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Réinitialiser le mot de passe");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Information sur le Compte et le Contact");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notification d'Inscription");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Aller à la Page de Connexion");
	//Order
	define("LANG_LABEL_ORDER", "Commander");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Payer");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuration");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "S\'il vous plaît, tapez l\'URL de votre site en premier.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "La validation a échoué! S\'il vous plaît essayez de nouveau.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Site validé avec succès!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Créer du Trafic");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "S'il vous plaît, remarquez que vous pouvez changer ce code que vous le souhaitez, puisque vous gardez l'URL exactement comme montré ici, sinon votre backlink ne sera pas validé.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink pas été validé. S'il vous plaît, essayez à nouveau.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Cochez cette case pour supprimer le backlink pour cette entreprise");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "URL Backlink");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL où le backlink a été installé.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "S'il vous plaît, tapez l'URL Backlink.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink pas disponible pour cette liste");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Ajouter un Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Mettez-le sur votre site (code HTML):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Entrez l'URL de votre site:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Ex: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Cliquez sur le bouton pour vérifier votre Backlink");
	//Verify
	define("LANG_LABEL_VERIFY", "Vérifier");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Pourquoi ajouter un Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Ajout d'un lien vers votre site pointant vers celui-ci, augmente la pertinence de ce site et à son tour la pertinence de votre entreprise.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "Quels sont les avantages pour moi?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "En nous donnant un lien sur la page d'accueil de votre site, vous nous aider avec notre classement et donc vos résultats. Mais ainsi que nous aider, nous allons aller le mile supplémentaire et vous aider. Si vous ajoutez un lien, une fois que nous avons vérifié qu'il existe, nous allons montrer votre entreprise avec un style particulier sur la page de résultats, si vous avez vraiment une exposition supplémentaire dans le répertoire - c'est une situation gagnant / gagnant pour nous deux.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "Comment puis-je faire cela?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "C'est simple, copiez le code ci-dessus dans le code de votre site web, de sorte qu'il apparaît quelque part visible sur la page d'accueil, nous donner l'URL de votre site web (le lien est) et nous allons le vérifier une fois que vous appuyez sur \"Vérifier\" bouton - puis continuer tout sur.... super simple.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "Non, sans ordre du Backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Oui, ajouter Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink d'ajouter à vos entreprise!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Vous n'avez pas d'entreprise pour l'ajouter backlink pour le moment.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Perçu de Backlink");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Détail de la Catégorie");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Website Manager");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Sommaire");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Page de Détails");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galerie de Photos");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Ajouter une Bannière");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Information sur l'Image de la Galerie");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Images de la Galerie");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Gérer les Images de la Galerie");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Gérer les Galeries");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "La Galerie n'existe pas!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "Galerie non disponible!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Titre de la Facturation Personnalisée");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Objets de la Facturation Personnalisée");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Facile et Rapide.");
	//Steps
	define("LANG_LABEL_STEPS", "Étapes");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "S'inscrire au Compte");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Choisissez un Niveau");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Etat du Paiement");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiration");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Ajouter une Nouvelle Galerie");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Ajouter une Nouvelle Galerie");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nouveau Offrir");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Ajouter un nouveau offrir");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Gérer la Facturation");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Cliquez ici si vous avez déjà votre mot de passe.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Vous n'etez pas Sponsors?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "pour plus d'informations sur l'ajout de votre objet à");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bienvenue à la Section des Sponsors");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bienvenue à la Section des Membres");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Compte bloqué. Attendre");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minute(s) et essayez de nouveau.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Un ou plusieurs champs obligatoires n'ont pas été pourvus. S'il vous plaît confirmer que toutes les informations nécessaires a été conclu avant de continuer.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Vous n'avez pas l'autorisation d'accès de cette adresse IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Votre compte a été desactivé!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Désolé, votre e-mail ou mot de passe est incorrect.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Désolé, mauvais compte.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Désolé, pour votre protection leur lien envoyé à votre adresse e-mail a expiré. Si vous avez oublié votre mot de passe, cliquez sur le lien ci-dessous.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Le serveur n'est pas disponible!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Erreur lors de l'appel du serveur OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Demande d'annulation OpenID!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Demande d'annulation Google!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Identification des invalides OpenID!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Avez-vous oublié votre mot de passe?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "Qu'est-ce que OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Qu'est-ce que Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Qu'est-ce que Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Le compte a été mis à jour!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Mot de passe a été mis à jour!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Merci de votre inscription à un compte en");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Connectez-vous ci-dessous pour gérer votre compte avec le e-mail et le mot de passe.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Vous pouvez voir");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Votre compte en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Affiche");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Affiche ");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Affiche");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "le maximum de");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "image");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "images");
	//This [ITEM] will show [UNLIMITED|the max of X] images "per gallery"
	define("LANG_MSG_PER_GALLERY", "dans la galerie");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " ainsi une image principale.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "ou Associez une galerie existante avec cet article");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "ou Associez une galerie existante avec cette annonce");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "ou Associez une galerie existante avec cet événement");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "ou Associez une galerie existante avec cette liste");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Cliquez ici pour payer votre article");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Cliquez ici pour payer votre bannière");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Cliquez ici pour payer votre annonce");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Cliquez ici pour payer votre événement");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Cliquez ici pour payer votre liste");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Articles sont activés par");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Bannières sont activés par");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Annonces sont activés par");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Événements sont activés par");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Listes sont activés par");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "seulement après que le processus soit terminé.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Conseils pour la Carte des Réglages des Objets");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Vous pouvez ajuster la position sur la carte,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "avec plus de précision.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Utilisez les commandes \"+\" et \"-\" pour ajuster le zoom de la carte");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Utilisez les flèches pour naviguer sur la carte.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Glisser/déplacer le marqueur pour modifier l'emplacement.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Votre offrir apparaîtra ici");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Associez un Offres a cette liste");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Aucun résultat trouvé!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Accès non autorisé!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Les problèmes suivants ont été trouvés");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Aucun produit sélectionné ou exigeant le paiement.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Aucun objet trouvé.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Aucune facture dans le système.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Aucune transaction dans le système.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Réclamez cette Liste");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Passer la commande dans la zone des sponsors");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Vous pouvez voir votre facture dans");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Je suis d'accord avec les conditions");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "et je vais envoyer le paiement.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Cette page va vous rediriger vers votre espace sponsors en quelques secondes.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Cette page va vous rediriger en quelques secondes pour poursuivre votre processus d'inscription.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Si cela ne fonctionne pas, s'il vous plaît de");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Gérer l'article");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Gérer la Bannière");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Gérer l'Annonce");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Gérer l'Evénement");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Gérer la Liste");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Gérer le Offrir");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Gérer la Facturation");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Gérer les Factures");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Gérer les Transactions");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Aucun article dans le système.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Aucune bannières dans le système.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Aucune annonce dans le système.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Aucun événement dans le système.");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "Aucune galerie dans le système.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Aucune liste dans le système.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Aucun offres dans le système.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Rapports non Disponibles.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Aucun article trouvé. Peut-être il a été supprimé.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Aucune annonce trouvé. Peut-être elle a été supprimé.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Aucune liste trouvé. Peut-être elle a été supprimé.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Information sur l'Article");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Supprimer l'Article");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Supprimer l'information sur l'Article");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet article?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Galerie de l'Article");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Aperçu de l'Article");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Rapport du Trafic de l'Article");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Détail de l'Article");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Modifier l'Information sur l'Article ");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Supprimer Bannière");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Supprimer l'information sur la Bannière");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Etes-vous sûr de vouloir supprimer cette bannière?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Modifier la Bannière");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Modifier l'information sur la Bannière");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Aperçu de la Bannière");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Rapport du Trafic de la Bannière");
	//View Banner
	define("LANG_VIEW_BANNER", "Affichage de la Bannière");
	//Disabled
	define("LANG_BANNER_DISABLED", "Désactivé");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Information sur l'Annonce");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Supprimer l'Annonce");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Votre annonce apparaît automatiquement dans la catégorie de chaque sous-catégorie que vous choisissez.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Annonce Catégories");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Annonce Catégories");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Supprimer l'Information sur l'Annonce");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cette annonce?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "Galerie des Annonces");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Carte des Réglages de l'Annonce");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Aperçu de l'Annonce");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Rapport du Trafic de l'Annonce");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Détail de l'Annonce");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Modifier les Informations de l'Annonce");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Modifier le Niveau de l'Annonce");
	//Delete Event
	define("LANG_EVENT_DELETE", "Supprimer l'Événement");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Supprimer l'Information sur l'Événement");
	//Are you sure you want to delete this event?
	define("LANG_EVENT_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet événement?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Information sur l'Événement");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Galerie de l'Événement");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Carte Des Réglages d'Événement");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Aperçu de l'Événement");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Rapports de Trafic de l'Événement");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Détail de l'Événement");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Modifier l'Événement");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Liste des Galeries");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Information sur la liste");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Carte Des Réglages de la Liste");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Aperçu de la Liste");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Offrir sur la Liste");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Le offrir est liée à la liste.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Pour être actif, le offrir");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "doit avoir une date de fin dans le futur.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "doit être associé à un liste.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Rarpport du Trafic de la Liste");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Détail de la Liste");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "pour liste");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Mettre à jour la Liste");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Supprimer le Offrir");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Supprimer l'information sur le Offrir");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cet offrir?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Aperçu du Offrir");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Information sur le Offrir");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Détail de lo Offrir");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Modifier l'Information sur le Offrir");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Supprimer la Galerie");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Supprimer l'information sur la galerie");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Êtes-vous sûr de vouloir supprimer cette galerie? Cela permettra d'éliminer toutes les informations, photos et liens de la galerie.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Supprimer l'Image de la Galerie");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Information sur la Galerie");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Aperçu de la Galerie");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Détails de la Galerie");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Modifier l'Information sur la Galerie");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Gérer les Images");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Supprimer l'Image");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Image supprimée avec succès!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Détail de l'évaluation");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Aperçu de l'évaluation");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Facture Détaillée");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Facture non trouvé pour ce compte.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notification de Facture");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Détails de la Transaction");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "La transaction n'a pas été trouvée pour ce compte.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Connexion avec Répertoire compte");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Connexion avec OpenID 2.0 compte");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Connexion avec Facebook compte");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Connexion avec Google compte");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." déjà enregistré!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Ce compte est disponible.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Erreur de chargement de l'image. S'il vous plaît essayer de nouveau");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Image transféré avec succès!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Image correctement mis à jour!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Supprimer l'image");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Etes-vous sûr de vouloir supprimer cette image?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Modifier l'image");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Faire principales");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principale");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Cliquez ici pour définir comme image principale");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Cliquez ici pour définir comme la galerie d'images");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paquets");
	//Package
	define("LANG_PACKAGE_SING", "Paquet");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Charge pour le paquet ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profil mis à jour!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Options des sponsors");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "Mes Amis");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Amis d'approuver");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "Dans l'attente de l'acceptation");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Profil Activer");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "Rencontrer des gens, trouver des clients pour votre entreprise et bien plus encore!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profil");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Options Profil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Modifier le Profil");
	//Friends
	define("LANG_LABEL_FRIENDS", "Amis");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Voir ses amis");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Gérer les amis");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Charger l'image de votre Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Des renseignements personnels");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Surnom");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Compte Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "À propos de Moi");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Date de naissance");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Ville Natale");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Livres Préférés");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Films Préférés");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Sports Favoris");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favoris Musiques");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Aliments Préférés");
	//Settings
	define("LANG_LABEL_SETTINGS", "Paramètres");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Voir tous ses amis");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Tous les Amis");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Retirer un ami");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Ajouter un ami");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Accepter");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Nier");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Devenir annonceur");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Inscrivez-vous et commencer à promouvoir votre entreprise dès aujourd'hui, gratuitement!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "Que puis-je faire?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Messages");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Etes-vous sûr?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "La page personnelle avec le nom 'john-smith' sera disponible via l'URL:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Votre URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Votre URL contient les caractères invalides.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL déjà en cours d'utilisation, s'il vous plaît choisir une autre URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Vous n'avez pas d'amis.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Ami supprimé avec succès.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Ami avec succès approuvé.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Ami avec succès rejeté.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Exigence ami succès annulée.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Voir tous");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Voir tous");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "Aucun Amis");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Aucun Article");
	//Share
	define("LANG_LABEL_SHARE", "Part");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Partagez Tous");
	//Comments
	define("LANG_LABEL_COMMENTS", "Commentaires");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Mon Profil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Profil d'utilisateur activé avec succès!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publier mes coordonnées");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Créer ma page personnelle");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Page Personnelle");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Article passe en revue");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Liste des commentaires");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Avis supprimé avec succès.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Aucun commentaire trouvé!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Modifier mon profil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Retour à mon profil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Membre depuis");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Paramètres du Compte");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Offres Rachetées");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoris");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Vous n'avez pas la permission d'accéder à cette section.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Accédez à votre profil.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Ma page personnelle");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Utilisez ce compte");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Page Profil");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Créez votre Profil");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Surnom est nécessaire.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Assurez-vous que le compte twitter que vous ajoutez ne sont pas protégées. Si le compte twitter est protégé le dernier tweets sur ce compte ne sera pas montré.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Votre article a été payée, de sorte que vous pouvez ajouter un maximum de [max] catégories gratuitement.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Votre article a été payée, de sorte que vous pouvez ajouter un maximum de [max] catégorie gratuitement.");
	
	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Sont acceptés  ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "pour le téléchargement!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Les images doivent être sous ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Sélectionnez une image pour télécharger!");
	//Original image
	define("LANG_ORIGINAL", "Image d'origine");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Aperçu de Pouce");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Légendes");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Vous pouvez ajouter le maximum de ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " photos à votre galerie!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Créer Miniature");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Avant-première Miniature");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Votre article a déjà le nombre maximum d\'images dans la galerie. Supprimer une image existante pour sauver celui-ci.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Événement Périodique");
	//Repeat
	define("LANG_PERIOD", "Répétition");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Choisissez une option");
	//Daily
	define("LANG_DAILY", "Quotidien");
	//Weekly
	define("LANG_WEEKLY", "Hebdomadaire");
	//Monthly
	define("LANG_MONTHLY", "Mensuel");
	//Yearly
	define("LANG_YEARLY", "Annuel");
	//Daily
	define("LANG_DAILY2", "Quotidien");
	//Weekly
	define("LANG_WEEKLY2", "Hebdomadaire");
	//Monthly
	define("LANG_MONTHLY2", "Mensuel");
	//Yearly
	define("LANG_YEARLY2", "Annuel");
	//every
	define("LANG_EVERY", "Tous");
	//every
	define("LANG_EVERY2", "Tous");
	//of
	define("LANG_OF", "de");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "de");
	//of
	define("LANG_OF4", "du");
	//Week
	define("LANG_WEEK", "Semaine");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Choisissez mois");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Choisir la date");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Choisissez la Semaine");
	//First
	define("LANG_FIRST", "Première");
	//Second
	define("LANG_SECOND", "Deuxième");
	//Third
	define("LANG_THIRD", "Troisième");
	//Fourth
	define("LANG_FOURTH", "Quatrième");
	//Last
	define("LANG_LAST", "Dernier");
	//1st
    define("LANG_FIRST_2", "1ª");
    //2nd
    define("LANG_SECOND_2", "2ª");
    //3rd
    define("LANG_THIRD_2", "3ª");
    //4th
    define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Récurrent");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "S'il vous plaît sélectionner un jour de la semaine.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "S'il vous plaît une journée type.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "S'il vous plaît sélectionner un mois.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "S'il vous plaît sélectionnez une semaine.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "S'il vous plaît sélectionnez une option de Répétition.");
	//When
	define("LANG_EVENT_WHEN", "Quand");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Journée doit être numérique.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Journée doit être comprise entre 1 et 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Jour ne correspond pas à la période choisie.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mois ne correspond pas à la période choisie.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Jours ne correspondent pas à la période choisie.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semaine ne correspond pas à la période choisie.");
	//No info
	define("LANG_EVENT_NO_INFO", "Pas d'info");
	//Ends on
	define("LANG_ENDS_IN", "Se termine le");
	//Never
	define("LANG_NEVER", "Jamais");
	//Until
	define("LANG_UNTIL", "Jusqu'à ce que");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Jusqu'à ce que");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Jusqu'à ce que\" doit être supérieure ou égale à la \"Date de Début\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Jusqu'à ce que\" ne peut pas être dans le passé.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Début le");
	//Repeats
	define("LANG_EVENT_REPEATS", "Répète");
	//Ends on
	define("LANG_EVENT_ENDS", "Se termine le");
	//weekend
	define("LANG_EVENT_WEEKEND", "fin de la semaine");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "jour ouvrable");
	//the month
	define("LANG_THE_MONTH", "mois");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Nom de site");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Cliquez ici ne visualiser ce site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Cliquez ici pour supprimer ce site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site supprimé avec succès!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site d'ajouter!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Un courriel sera envoyé à l'équipe de soutien eDirectory, s'il vous plaît attendre notre contact.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Nom de site est nécessaire");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL de site est nécessaire");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Nom de site existe déjà");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL de site existe déjà");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL de site n'est pas valide");
	//Site Items
	define("LANG_SITE_ITEMS", "Articles du Site");
	
	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Renseignements sur le Profil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Réseautage Social");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Lien information et à l'importation");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Tout lien");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Lien mon compte Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Dissocier mon compte Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Votre compte a été supprimé le lien entre Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Votre compte Facebook est déjà lié avec le compte d'autres dans le système.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Votre compte Twitter est déjà lié avec le compte d'autres dans le système.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Lié à Twitter comme");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Connecté en tant que");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Préférences de emplacement");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Choisissez l'emplacement de votre choix");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Utilisez votre position actuelle");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Utilisez Facebook emplacement");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Connectez-vous à Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Compte Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Compte Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Changer de compte");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Compte Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Connexion Twitter");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Lien mon compte Twitter");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Dissocier mon compte Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Poste rachète sur mon Twitter compte automatiquement");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Votre compte a été supprimé le lien entre Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Vous devez vous connecter via Twitter première");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Votre compte Twitter a été connecté avec succès");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Votre compte Facebook a été connecté avec succès");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Votre compte est déjà connecté en tant Facebook");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Cet utilisateur est déjà connecté à un autre compte.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Cliquez ici pour passer à ce compte");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Connectez-vous à Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Utilisez cette langue à chaque connecter à mon compte");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
    //Link to a listing   
	define("DEAL_LINK2LISTING", "Liées à une enterprise");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "J'ai aimé ce");
	//Redeem
	define("DEAL_REDEEM", "Échangez");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Échangez cet Offrir");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Pour échanger vous avez besoin d'afficher cette information sur votre affaire Facebook ou Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Vous pouvez configurer ce bouton afin d'envoyer automatiquement le sur votre profil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Cliquez ici pour le configurer");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "S'il vous plaît attendre, annonce sur Facebook et Twitter (si disponible).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Vous avez déjà racheté cette offrir! Votre code est");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Chose faite! Ceci est votre code d'activation");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Personne n'a racheté cet accord sur Facebook encore.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Personne n'a racheté cet accord sur Twitter encore.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Dernières offres fait");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Aucun offres trouvées!");
	//This deal is not available anymore.
	define("DEAL_NA", "Cet accord n'est plus disponible.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Pour profiter de cette affaire dont vous avez besoin pour écrire sur votre mur Facebook. Primeiro entre utilizando sua conta do Facebook e aprove nossa aplicação para funcionar no seu perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Vous avez déjà fait cette entente!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Désolé, il ya eu une erreur en essayant d'afficher sur votre mur Facebook. S'il vous plaît essayez de nouveau.");
	//Value
	define("DEAL_VALUE", "Courage");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Avec ce numéro");
	//Thank you
	define("DEAL_THANKYOU", "Je vous remercie");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valeur originale");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Avec cet accord");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valable jusqu'au");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "Le Offres doit être présenté pour obtenir le rabais");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limite de 1 coupon par achat");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Non cumulable avec d'autres coupons, des offres ou des remises de toute nature");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Valable uniquement pour l'inscription Nom - Adresse");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimer Offrir");
	//deal done
	define("DEAL_DEALSDONE", "Offre Effectué");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Offres Effectuées");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//SOLD OUT
	define("DEAL_SOLDOUT", "Épuisé");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Désolé, cet accord n'existe pas ou il a été enlevé par le propriétaire");
	//at
	define("DEAL_AT", "à");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "URL conviviale");
	//Select a listing
	define("DEAL_SELECTLISTING", "Sélectionnez une liste");
	//Tagline for Deals
	define("DEAL_TAG", "Slogan pour les Offres");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilité");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Cette offrir sera affiché sur");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "recherches et disposent à proximité");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 heures / jour");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Gamme sur mesure");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Remise des informations");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valeur de l'Élément");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Remise");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valeur avec remise");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Montant des offres");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "fait jusqu'à présent");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "fait jusqu'à présent");
	//left
	define("LANG_SITEMGR_LEFT", "autres");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "S'il vous plaît patienter, chargement...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "S'il vous plaît attendre. Nous sommes rediriger vos informations de connexion pour effectuer cette étape...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Point Valeur est requise.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." est requise.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." ne peut pas être supérieur à 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Offres offrir est nécessaire.");
    //Please enter a minor value on Value with Discountfield.
    define("LANG_MSG_VALID_MINOR", "S'il vous plaît entrer une valeur mineure sur le champ delo ".LANG_LABEL_DISC_AMOUNT);
	//Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed à");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Vous ne pouvez relier directement cet accord pour une annonce si vous sélectionnez un premier compte");
    //Value
    define("DEAL_VALUE", "Valeur");
    //With discount
    define("DEAL_WITHCOUPON", "With discount");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Validez par e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Connectez-vous et échangez");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Échangez et d'impression");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Échangez et partagez");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Offres en vedette");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Inscrivez-vous en utilisant votre session Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Pour Échangez utilisant Facebook, vous devez vous connecter en utilisant votre compte Facebook.");
    //Redemm Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Statistiques d'utilisation");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Code d'utilisation");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponible");
    //Used
    define("DEAL_SITEMGR_USED", "Employée");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Échangez avec votre session Facebook");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Navbar configuration sauvegardée.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "Il y avait un problème de sauvegarde, s'il vous plaît essayer de nouveau.");
	//At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "Au moins un élément est requis.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Vous ne pouvez pas enregistrer répétées URLs.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Vous ne pouvez pas enregistrer des éléments vides.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "Vous ne pouvez pas enregistrer en-tête ou pied de page vide.");
    //Use
    define("DEAL_SITEMGR_USE", "Utilisez");
	//Saving...
	define("LANG_DEAL_SAVING", "Enregistrement...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Aucun rachat trouvé.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "pourcentage");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valeur fixe");

    # ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Veuillez écrire une étiquette.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Veuillez écrire un URL.");
	//Add new item to menu
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Ajoutez l'élément");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Nouvel élément");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Module");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Contenu de Site");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Nouveau");
	//Save & Close
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Sauvegardez");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Sauvegardez élément");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Nom");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Utilisation");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Veuillez choisir un module ou coup près d'annulation.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Désolé, il n'y a aucun contenu fait sur commande de site créé encore.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Créer un nouveau contenu personnalisé");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Créez un nouveau contenu fait sur commande");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Utilisez l'URL de module");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Utilisez I'URL fait sur commande de page");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Cliquez sur un article sur le ci-dessous navbar pour éditer l'étiquette ou pour changer l'endroit de lien:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Navigation en-tête");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Navigation Pied de page");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Annuler l'inscription de cette élément?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Restaurer des éléments");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Échangez sans Facebook");
    //Don't have Facebook? Sign using your account.
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Vous n'avez pas de Facebook? Inscrivez-vous en utilisant votre compte.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Changez de Site");
    //Only
    define("LANG_ONLY2", "Seuls les");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Offrir");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Offres");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Offres passe en revue");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "publiée sur Facebook et Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "publiée sur Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "publiée sur Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Publiée sur");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "offre se termine");
	//deal opened
	define("LANG_DEAL_OPENED", "offre ouverte");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Termes et Conditions");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "1000 caractères max");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "S'il vous plaît fournir conditions avec un maximum de 1000 caractères.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "ligne");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Erreur lors du importés de table temporaire.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Date de renouvellement non valide - ligne");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Date de mis à jour non valide - ligne");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Fichier CSV importés de table temporaire.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail incorrect - ligne");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Mot de passe non valide - ligne");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Mots-clé non valide(max ".MAX_KEYWORDS." mots-clés) - ligne");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Mots-clé non valide(".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - ligne");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Non valide titre - ligne");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Date de début non valide - ligne");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Date de fin non valide - ligne");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Date de début doit être rempli - ligne");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Date de fin doivent être remplis - ligne");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Heure de début non valide - ligne");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Invalide heure de fin - ligne");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Mauvaise format de l'heure de début. Doit être \"xx:xx\" - ligne");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Mauvaise format de l'heure de fin. Doit être \"xx:xx\" - ligne");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Mauvaise mode de l'heure de début. Doit être \"AM\" ou \"PM\" - ligne");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Mauvaise mode de l'heure de fin. Doit être \"AM\" ou \"PM\" - ligne");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Mauvaise mode de l'heure de début. Doit être \"24\" - ligne");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Mauvaise mode de l'heure de fin. Doit être \"24\" - ligne");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Adresse et de l'adresse par défaut du système sont différents - ligne");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitude non valide. Doit être numérique entre -90 et 90 - ligne");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitude non valide. Doit être numérique entre -180 et 180 - ligne");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Pas de fichiers CSV dans le dossier d'importation.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Le nombre de colonnes dans la ligne suivante est fausse:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total des lignes suit:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV-tête ne correspond pas - il a plus de champs qu'il est permis");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV-tête ne correspond pas au champ (s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "compte annulée");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "comptes annulée");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "article annulée");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "articles annulée");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Trouvez ce que vous cherchez...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Parfois, vous pouvez recevoir aucun résultat pour votre recherche car le mot clé que vous avez utilisé est très générique. Essayez d'utiliser un mot clé précis.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Retrouvez-nous sur LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Retrouvez-nous sur Facebook");
	//Links
	define("LANG_LINKS", "Liens");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contact");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Suivez-nous sur Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Suivez-nous");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Résultats par page");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Affichage des résultats");
	//to
	define("LANG_PAGING_SHOWING_TO", "à");
	//of
	define("LANG_PAGING_SHOWING_OF", "des");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páges");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "La importación de [SUGAR_ITEM_TITLE] de SugarCRM en [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilisez le formulaire ci-dessus pour l'importation du dossier SugarCRM [SUGAR_ITEM_TITLE], après avoir cliqué sur l'importation de vos données seront transférées vers votre installation de répertoire avec toutes les informations pertinentes passé à travers, il suffit de remplir les données supplémentaires, et des données de paiement.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Vous êtes presque fait.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Il n'était pas possible d'exporter. S'il vous plaît vérifier vos informations de connexion SugarCRM sur votre répertoire.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Mauvaise clé eDirectory.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Propriétaire de Liste");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Titre de Evaluation");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Propriétaire de Événement");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Propriétaire de Annonce");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Article Auteur");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.votresite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "otrenom@votresite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visiteur");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Catégorie");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Catégorie 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Catégorie 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Catégorie 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Catégorie 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Vue Résumée");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Vue Détaillée");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Contenu exemplative");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Envoyer à Téléphone");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Cliquez pour Appeler");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Message envoyé avec succès!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Envoyer des informations sur cette liste à un téléphone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Entrez votre téléphone pour appeler le propriétaire cotation sans frais.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Le téléphone est nécessaire.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "S'il vous plaît, entrez un numéro de téléphone valide.");
	//Call
	define("LANG_TWILIO_CALL", "Appelez");
	//Calling
	define("LANG_TWILIO_CALLING", "Appel");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Téléphone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extension");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activer");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Votre code de validation est la suivante:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Votre numéro de téléphone a été activé!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Numéro de téléphone supprimé avec succès!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Cliquez pour Appeler pas disponible pour cette liste");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Conseils pour l'article Cliquez pour Appeler");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Vous avez besoin d'activer le numéro de téléphone ci-dessous afin de permettre aux utilisateurs à vous contacter directement via le répertoire.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Entrez votre numéro de téléphone et cliquez sur Activer.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Un message avec votre code d'activation sera affiché. Prenez note de ce code et d'attendre l'appel téléphonique d'activation.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Vous serez demander d'entrer le code à six chiffres d'activation. Entrez le code et attendre le message de confirmation.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Après activation de votre numéro de téléphone, cliquez sur Enregistrer pour terminer dans le processus.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Pour les numéros hors des Etats-Unis, vous devez mettre votre code de pays d'abord.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "Seuls les numéros de Etats-Unis sont acceptés.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Cliquez pour Appeler\" le rapport");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direction");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Heure de Début");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Heure de Fin");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Durée (en secondes)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Pas de rapports disponibles.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activé par");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "D'activation a échoué. S'il vous plaît, essayez de nouveau.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Compte n'est pas actif.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Compte d'essai ne prend pas en charge cette fonctionnalité.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Appel entrant rejeté en raison de compte inactif.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Invalid URL format.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP l'échec de récupération.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP échec de connexion.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protocole de violation.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP nom d'hôte mauvaisee.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP trop de redirections.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "L'échec d'analyser le document.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Invalide Twilio balisage XML version.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "L'élément racine doit être la réponse.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Avertissement de validation de schéma.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Invalid Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Défaillance interne.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Ne peut pas composer à partir d'un segment des appels Dial.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Valeur non valide la méthode.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Invalide valeur de temporisation.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Valeur invalide hangupOnStar.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Valeur invalide callerID.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Invalide élément imbriqué.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Valeur invalide délai.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valeur non valide la méthode.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Valeur invalide sendDigits.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Invalid format de numéro de téléphone.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Le numéro de téléphone valide.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Forbidden numéro de téléphone.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valeur non valide en sourdine.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Valeur invalide endConferenceOnExit.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Valeur invalide startConferenceOnEnter.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Invalide waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Invalide waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Valeur invalide bip.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Invalide Sid Conférence.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Nom incorrect de la Conférence.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Invalide verbe employé dans waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Valeur invalide finishOnKey.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valeur non valide la méthode.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Invalide valeur de temporisation.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Valeur invalide numDigits.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Invalide verbe imbriquées.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Valeur invalide voix.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Valeur non valide boucle.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Invalid Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valeur non valide boucle.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Invalid Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Valeur non valide boucle.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Valeur invalide voix.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Invalide texte.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Valeur non valide la méthode.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Invalide valeur de temporisation.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Valeur invalide maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Valeur invalide finishOnKey.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Valeur non valide la méthode.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Valeur non valide la longueur.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalide \"À\" attribut.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalide \"De\" attribut.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Invalide corps.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Invalide attribut de méthode.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Attribut non valide statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limite de la récupération de documents atteint.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS envoyez limite de taux de dépassement.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De ne pas le numéro de téléphone SMS capable.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "Limite de SMS Répondre dépassé.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Invalid Verb pour les SMS Répondre.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Pour le numéro de téléphone valide pour le mode d'essai.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Paramètres inconnus.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Invalide FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Autorisation refusée.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Méthode non autorisée.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Compte non actif.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Aucun numéro appelé spécifié.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Numéro appelé est un numéro surtaxé.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Les appels internationaux pas activé.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "URL invalide.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits invalide.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Invalide IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "TimeOut non valide.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Méthode non valide.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Appelant le numéro de téléphone n'est pas vérifiée.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Appelé numéro de téléphone valide.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Numéro de téléphone valide Caller.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Appelant le numéro de téléphone est nécessaire.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Numéro de téléphone appelé ne peut pas être atteint.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Compte pas autorisé à appeler le numéro de téléphone.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Compte pas autorisé à appeler le numéro de téléphone.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Numéro de téléphone ne semble pas être valide.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Invalide ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Etat non valide appel.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Numéro de téléphone valide.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "URL invalide.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Méthode non valide");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Numéro de téléphone entrants ne sont pas disponibles au compte d'essai.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Impossible de définir VoiceFallbackUrl sans paramètre URL.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Impossible de définir SmsFallbackUrl sans réglage SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Ce type numéro de téléphone ne supporte pas les SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Numéro de téléphone déjà validé sur votre compte.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Indicatif régional invalide.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Pas de numéros de téléphone dans l'indicatif régional.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Numéro de téléphone déjà validés sur un autre compte.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Invalide CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Ressources ne sont pas disponibles.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "URL invalide rappel.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Invalid type de transcription.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid est nécessaire.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Numéro de téléphone n'est pas valide SMS capables numéro de téléphone entrant.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Corps du message est nécessaire.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "La source 'de' numéro de téléphone est nécessaire pour envoyer un SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "La destination \"à\" numéro de téléphone est nécessaire pour envoyer un SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Longueur maximale du corps de SMS est de 160 caractères");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Le \"De\" le numéro de téléphone fourni n'est pas valide, le SMS-capable le numéro de téléphone entrant pour votre compte.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Le nombre Sandbox peuvent envoyer des messages à des numéros vérifiés.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Commentaires Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Facebook commentaires ne sont pas disponibles pour cette liste");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Soyez sûr que vous êtes connecté à Facebook avec le même compte vous définissez dans votre section Options Commentaire, sinon vous ne pouvez pas modérer les commentaires pour cet article.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Vous pouvez aussi modérer vos commentaires en allant à ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Blancs clé API.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Paramètre manquant: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nom du module non valide.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Module désactivé.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Paramètre manquant: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API désactivé.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscine");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Chambre(s) à Coucher");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Salle(s) de Bains");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Niveau(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Type de Propriété");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Utilité");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "​​Prix");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built En
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construit En");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Pieds Carrés");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Bureau");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Salle de Lavage");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Climatisation Centrale");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Salle à Manger");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garage");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "L'élimination des Déchets");