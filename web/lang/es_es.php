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
	# * FILE: /lang/es_es.php
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
	define("LANG_DATE_MONTHS", "enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "domingo,lunes,martes,miércoles,jueves,viernes,sábado");
	//year
	define("LANG_YEAR", "año");
	//years
	define("LANG_YEAR_PLURAL", "años");
	//month
	define("LANG_MONTH", "mes");
	//months
	define("LANG_MONTH_PLURAL", "meses");
	//day
	define("LANG_DAY", "día");
	//days
	define("LANG_DAY_PLURAL", "días");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z");
	//y
	define("LANG_LETTER_YEAR", "a");
	//m
	define("LANG_LETTER_MONTH", "m");
	//d
	define("LANG_LETTER_DAY", "d");
	//Hour
	define("LANG_LABEL_HOUR", "Hora");
	//Minute
	define("LANG_LABEL_MINUTE", "Minuto");
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
	define("ZIPCODE_LABEL", "código postal");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "d \d\e F \d\e Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F \d\e Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "¿Tiene una pregunta sobre Video de fragmento de código? Haga clic aquí.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Usted está utilizando una versión anterior de Internet Explorer que puede afectar a la funcionalidad completa de algunas funciones. Le recomendamos que actualice a una versión más reciente de Internet Explorer.");
	//N/A
	define("LANG_NA", "N/D");
	//characters
	define("LANG_LABEL_CHARACTERES", "caracteres");
	//by
	define("LANG_BY", "por");
	//in
	define("LANG_IN", "en");
	//Read More
	define("LANG_READMORE", "Leer más");
	//More
	define("LANG_MORE", "más");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Búsqueda por Categoría");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Búsqueda por Ubicación");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Búsqueda por Listados");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Búsqueda por Eventos");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Búsqueda por Clasificados");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Búsqueda por Artículos");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Búsqueda por Ofertas");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Búsqueda por Entradas");
	//show
	define("LANG_SHOW", "ver");
	//hide
	define("LANG_HIDE", "ocultar");
	//Bill to
	define("LANG_BILLTO", "Facturar a");
	//Payable to
	define("LANG_PAYABLETO", "A favor de");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Fecha de emisión");
	//Expire Date
	define("LANG_EXPIREDATE", "Fecha de vencimiento");
	//Questions
	define("LANG_QUESTIONS", "Preguntas");
	//Please call
	define("LANG_PLEASECALL", "Llame");
	//Invoice Info
	define("LANG_INVOICEINFO", "Información de la factura");
	//Payment Date
	define("LANG_PAYMENTDATE", "Fecha del pago");
	//None
	define("LANG_NONE", "Ninguna");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Factura personalizada");
	//Locations
	define("LANG_LOCATIONS", "Ubicaciones");
	//Close
	define("LANG_CLOSE", "Cerrar");
	//Close this window
	define("LANG_CLOSEWINDOW", "Cerrar esta ventana");
	//from
	define("LANG_FROM", "de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Información de la transacción");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "En las transacciones manuales, total parcial y el impuesto no se calculan.");
	//creditcard
	define("LANG_CREDITCARD", "Tarjeta de Crédito");
	//Join Now!
	define("LANG_JOIN_NOW", "¡Únase ahora!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Crea Tu Perfil");
	//More Information
	define("LANG_MOREINFO", "Más información");
	//and
	define("LANG_AND", "y");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Autopartes");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Neumáticos");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Reparación de motor");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categorías y subcategorías");
	//per
	define("LANG_PER", "por");
	//each
	define("LANG_EACH", "cada");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "bloque de impresiones");
	//Add
	define("LANG_ADD", "Agregar");
	//Manage
	define("LANG_MANAGE", "Administrar");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "impresiones a mi crédito pago de");
	//Section
	define("LANG_SECTION", "Sección");
	//General Pages
	define("LANG_GENERALPAGES", "Páginas generales");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Abrir en una nueva ventana");
	//No
	define("LANG_NO", "No");
	//Yes
	define("LANG_YES", "Sí");
	//Dear
	define("LANG_DEAR", "Estimado");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Domicilio, casilla de correo");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Departamento, habitación, unidad, edificio, piso, etc.");
	//or
	define("LANG_OR", "o");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Dom. de 08:00 a.m. a 06:00 p.m.");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Lun. de 08:00 a.m. a 09:00 p.m.");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Mar. de 08:00 a.m. a 09:00 p.m.");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Campos extra");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Comodidades");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Iniciar automáticamente");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Seleccionar/deseleccionar todo");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Información de Cuentas");
	//Default
	define("LANG_BUSINESS", "Estándar");
	//on Listing
	define("LANG_ON_LISTING", "en Listado");
	//on Event
	define("LANG_ON_EVENT", "en Evento");
	//on Banner
	define("LANG_ON_BANNER", "en Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "en Clasificado");
	//on Article
	define("LANG_ON_ARTICLE", "en Artículo");
	//Listing Name
	define("LANG_LISTING_NAME", "Nombre del Listado");
	//Event Name
	define("LANG_EVENT_NAME", "Nombre del Evento");
	//Banner Name
	define("LANG_BANNER_NAME", "Nombre del Banner");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nombre del Clasificado");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nombre del Artículo");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Preguntas Frecuentes");
	//click to crop image
	define("LANG_CROPIMAGE", "haga clic para recortar la imagen");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "¿No encuentras la respuesta a su pregunta? Contáctenos.");
	//Active
	define("LANG_LABEL_ACTIVE", "Activo");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspendido");
	//Expired
	define("LANG_LABEL_EXPIRED", "Vencido");
	//Pending
	define("LANG_LABEL_PENDING", "Pendiente");
	//Received
	define("LANG_LABEL_RECEIVED", "Recibido");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Código de Promoción");
	//Account
	define("LANG_LABEL_ACCOUNT", "Cuenta");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Cambiar cuenta");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nombre o título");
	//Name
	define("LANG_LABEL_NAME", "Nombre");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Primero, Último");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nombre de la página");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Descripción breve");
	//Category
	define("LANG_LABEL_CATEGORY", "Categoría");
	//Category
	define("LANG_CATEGORY", "Categoría");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categorías");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categorías");
	//Country
	define("LANG_LABEL_COUNTRY", "País");
	//Region
	define("LANG_LABEL_REGION", "Región");
	//State
	define("LANG_LABEL_STATE", "Estado");
	//City
	define("LANG_LABEL_CITY", "Ciudad");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Barrio");	
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Países");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regiones");
	//States
	define("LANG_LABEL_STATE_PL", "Estados");
	//Cities
	define("LANG_LABEL_CITY_PL", "Ciudades");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Barrios");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Añadir una nueva región");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Añadir un nuevo estado");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Añadir una nueva ciudad");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Añadir un nuevo barrio");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Elige una región ya existente");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Elige un estado ya existente");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Elige una ciudad ya existente");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Elige un barrio ya existente");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Ninguna ubicación encontrada");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renovación");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Fecha de renovación");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Domicilio");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Dirección web");
	//Phone
	define("LANG_LABEL_PHONE", "Teléfono");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Descripción extensa");
	//Status
	define("LANG_LABEL_STATUS", "Estado");
	//Level
	define("LANG_LABEL_LEVEL", "Nivel");
	//Empty
	define("LANG_LABEL_EMPTY", "Vacío");
	//Start Date
	define("LANG_LABEL_START_DATE", "Fecha de inicio");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Fecha de inicio");
	//End Date
	define("LANG_LABEL_END_DATE", "Fecha de finalización");
	//End Date
	define("LANG_LABEL_ENDDATE", "Fecha de finalización");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Fecha no válida");
	//Start Time
	define("LANG_LABEL_START_TIME", "Hora de inicio");
	//End Time
	define("LANG_LABEL_END_TIME", "Hora de finalización");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Sin límite");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Seleccione un tipo");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Seleccione una categoría");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Tiempo Restante");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Ver Oferta");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "No hay Oferta");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Seleccione un Oferta");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nombre de Contacto");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nombre de Contacto");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Teléfono de Contacto");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax de Contacto");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Correo electrónico");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Dirección");
	//E-mail
	define("LANG_LABEL_EMAIL", "Correo electrónico");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Avisame de las evaluaciones y el tráfico de las empresas.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Factura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "N. º de Factura");
	//Item
	define("LANG_LABEL_ITEM", "Elemento");
	//Items
	define("LANG_LABEL_ITEMS", "Elementos");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Categoría extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Código de lo Oferta");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Precio del Elemento");
	//Amount
	define("LANG_LABEL_AMOUNT", "Valor");
	//Tax
	define("LANG_LABEL_TAX", "Impuesto");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Total parcial");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Emitir cheques a nombre de");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id.");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Nombre");
	//Caption
	define("LANG_LABEL_CAPTION", "Epígrafe");
	//impressions
	define("LANG_IMPRESSIONS", "impresiones");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Impresiones");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Por impresiones");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Por período de tiempo");
	//Date
	define("LANG_LABEL_DATE", "Fecha");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Su correo electrónico");
	//Subject
	define("LANG_LABEL_SUBJECT", "Asunto");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mensaje adicional");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Tipo de pago");
	//Notes
	define("LANG_LABEL_NOTES", "Notas");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "¡Es fácil y rápido!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Escribe calificaciones, comente en el blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Escribe calificaciones");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "¿Ya tiene acceso?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "¡Disfrute los servicios!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Contraseña de Prueba");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "¿Olvidó su contraseña?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Resumen");
	//Detail
	define("LANG_LABEL_DETAIL", "Detalle");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail de tu amigo)");
	//From
	define("LANG_LABEL_FROM", "De");
	//To
	define("LANG_LABEL_TO", "A");
	//to
	define("LANG_LABEL_DATE_TO", "a");
	//Last
	define("LANG_LABEL_LAST", "último");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "último");
	//day
	define("LANG_LABEL_DAY", "día");
	//days
	define("LANG_LABEL_DAYS", "días");
	//New
	define("LANG_LABEL_NEW", "Nuevo");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Nuevo FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Tipo");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Clic directo");
	//Added
	define("LANG_LABEL_ADDED", "Agregado");
	//Add
	define("LANG_LABEL_ADD", "Agregar");
	//rating
	define("LANG_LABEL_RATING", "clasificación");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "avaliador");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Revisor");
	//System
	define("LANG_LABEL_SYSTEM", "Sistema");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Suscripción a RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Fortaleza de la contraseña");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Nombre del Artículo");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Descripción");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO palabras clave");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "no se permite saltos de línea");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "usar elementos separados por comas (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Haga clic aquí para editar la información SEO de este elemento.");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "¡Se actualizó las informaciones de SEO!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Haga clic aquí para ver este artículo");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Haga clic aquí para modificar este artículo");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Haga clic aquí para agregar o modificar la galería de fotos de este artículo");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "No hay galería de fotos para este artículo");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Haga clic aquí para ver los informes de este artículo");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Historial de este artículo");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "No hay historial para este artículo");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Haga clic aquí para eliminar este artículo");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Haga clic aquí para ver este banner");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Haga clic aquí para modificar este banner");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Haga clic aquí para ver los informes de este banner");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Historial de este banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "No hay historial para este banner");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Haga clic aquí para eliminar este banner");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Nombre del Clasificado");
	//Click here to
	define("LANG_MSG_CLICKTO", "Haga clic aquí para");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Haga clic aquí para ver este clasificado");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Haga clic aquí para modificar este clasificado");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Haga clic aquí para agregar o modificar la galería de fotos de este clasificado");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "No hay galería de fotos para este clasificado");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Haga clic aquí para ver los informes de este clasificado");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Haga clic aquí para ajustar el mapa de ubicación de este clasificado");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "No hay ajuste de mapa para este clasificado");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Historial de este clasificado");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "No hay historial para este clasificado");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Haga clic aquí para eliminar este clasificado");
	//Event Title
	define("LANG_EVENT_TITLE", "Nombre del Evento");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Haga clic aquí para ver este evento");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Haga clic aquí para modificar este evento");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Haga clic aquí para agregar o modificar la galería de fotos de este evento");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "No hay galería de fotos para este evento");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Haga clic aquí para ver los informes de este evento");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Haga clic aquí para ajustar el mapa de ubicación de este evento");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "No hay ajuste de mapa para este evento");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Historial de este evento");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "No hay historial para este evento");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Haga clic aquí para eliminar este evento");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Nombre de la galería");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Haga clic aquí para ver esta galería");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Haga clic aquí para modificar esta galería");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Haga clic aquí para eliminar esta galería");
	//Listing Title
	define("LANG_LISTING_TITLE", "Nombre del Listado");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Haga clic aquí para ver este listado");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Haga clic aquí para modificar este listado");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Haga clic aquí para agregar o modificar la galería de fotos de este listado");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "No hay galería de fotos para este listado");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Haga clic aquí para cambiar la Oferta de este listado");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "La Oferta no está disponible para el listado");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Haga clic aquí para ver los informes del listado");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Haga clic aquí para ajustar el mapa de ubicación del listado");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "No hay ajuste de mapa para el listado");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "No se encontró la dirección.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Modifique el elemento.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Haga clic aquí para ver las calificaciones del elemento");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "No hay calificaciones para este Elemento");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Historial del listado");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "No hay historial para el listado");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Haga clic aquí para eliminar el listado");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Guardar");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Más Información");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Intenta usar algo descriptivo, como \"10% de descuento en nuestro producto\" o \"3 por el precio de dos en nuestro producto\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Introduzca el valor del artículo o servicio que usted ofrece. Elija un tipo de descuento (valor fijo o porcentaje), y entrar en el valor respectivo. Verifica en el cálculo y, a continuación nos proporcione el número de ofertas que desea hacer.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Por favor, asegúrese de que la imagen sea del tamaño adecuado antes de subirlo, de lo contrario la imagen es probable que se estira para ajustarse a la calidad del sitio y la imagen se verá afectada.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Cada oferta debe estar vinculada a un listado para ser activa en el sitio.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Asocia con el listado");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Por favor escriba su título del artículo y espere que las sugerencias de las asociaciones disponibles.");
	//Empty
	define("LANG_EMPTY", "Vaciar");
	//Cancel
	define("LANG_CANCEL", "Cancelar");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Período de Tiempo Personalizado");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Valor Fijo de Descuento");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Porcentaje de Descuento");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valor com Descuento");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Descuento (Calculado)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "¿Cuántas ofertas le gustaría ofrecer?");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Vinculado al Listado");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Elija un Listado");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "No se puede agregar ofertas diferentes para el mismo listado.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "¡Ofertas actualizadas correctamente!");
	//Options
	define("LANG_LABEL_OPTIONS", "Opciones");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Nombre de la Oferta");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Haga clic aquí para ver este Oferta");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Haga clic aquí para modificar este Oferta");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Haga clic aquí para eliminar este Oferta");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Vaya a \"Listados\" y haga clic en el icono de Oferta que pertenece a el listado donde desea agregar la Oferta. Seleccione una Oferta para agregar a su listado y activarla.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Las instalaciones se reiterarán hasta el vencimiento de su Tarjeta de Crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "máximo de 36 instalaciones");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Centro de SEO");
	//View
	define("LANG_LABEL_VIEW", "Ver");
	//Edit
	define("LANG_LABEL_EDIT", "Modificar");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galería");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Informes de tráfico");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Sin pagar");
	//Paid
	define("LANG_LABEL_PAID", "Pagado");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Esperando la aprobación del pago");
	//Under review
	define("LANG_LABEL_ANALYSIS", "En proceso de revisión");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponible");
	//In dispute
	define("LANG_LABEL_DISPUTE", "En disputa");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Reintegrado");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelado");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transacción");
	//Delete
	define("LANG_LABEL_DELETE", "Eliminar");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Ajuste de mapa");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Ver Mapa");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimir");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Aprobación pendiente");
	//Image
	define("LANG_LABEL_IMAGE", "Imagen");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Imágenes");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Campo requerido");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Por favor escriba todos los campos obligatorios.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informaciones de la Cuenta");
	//Username
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Contraseña actual");
	//Password
	define("LANG_LABEL_PASSWORD", "Contraseña");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Crear contraseña");
    //New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nueva contraseña");
    //Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Vuelva a escribir la contraseña");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Vuelva a escribir la contraseña");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Vuelva a escribir nueva contraseña");
    //OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Información");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Fecha de publicación");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendario");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "URL semántica");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Por ejemplo");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Origen de la imagen");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Atributo de la imagen");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Epígrafe de la imagen");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Resumen");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Palabras clave para la búsqueda");
	//maximum
	define("LANG_LABEL_MAX", "máx.");
	//keywords
	define("LANG_LABEL_KEYWORDS", "palabras clave");
	//Content
	define("LANG_LABEL_CONTENT", "Contenido");
	//Code
	define("LANG_LABEL_CODE", "Código");
	//free
	define("LANG_FREE", "GRATIS");
	//free
	define("LANG_LABEL_FREE", "gratis");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "URL de destino");
	//Script
	define("LANG_LABEL_SCRIPT", "Secuencia de comandos");
	//File
	define("LANG_LABEL_FILE", "Archivo");
	//Warning
	define("LANG_LABEL_WARNING", "Advertencia");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Mostrar URL (opcional)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Línea de descripción 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Línea de descripción 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Ubicación");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Dirección (opcional)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Dirección (opcional)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Descripción detallada");
	//Price
	define("LANG_LABEL_PRICE", "Precio");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Precios");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Información de contacto");
	//Language
	define("LANG_LABEL_LANGUAGE", "Idioma");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Seleccione su idioma principal de contacto (si fuera necesario).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Nombre");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Nombre");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Apellido");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Apellido");
	//Company
	define("LANG_LABEL_COMPANY", "Empresa");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Línea de Dirección 1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Línea de Dirección 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitud");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitud");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "No se ha encontrado. Por favor, intente especificar mejor su ubicación.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Los siguientes campos contienen errores:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "La latitud debe ser un número entre -90 y 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitud debe ser un número entre -180 y 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Nombre de la Ubicación");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Fecha del Evento");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Descripción");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Información de ayuda");
	//Text
	define("LANG_LABEL_TEXT", "Texto");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Agregar imagen");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Agregar imagen");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Modificar epígrafes de la imagen");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Archivo de imagen");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Epígrafe de la miniatura");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Epígrafe de la imagen");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Es posible que la carga demore varios minutos, en función del tamaño del archivo y de la velocidad de su conexión de Internet. Si cambia de página o si la actualiza, se cancelará la carga.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Fragmento de código de video");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Adjuntar archivo adicional");
	//Attention
	define("LANG_LABEL_ATTENTION", "Atención");
	//Source
	define("LANG_LABEL_SOURCE", "Origen");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Horas de trabajo");
	//Default
	define("LANG_LABEL_DEFAULT", "Valor predeterminado");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Forma de pago");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Con Tarjeta de Crédito");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Con PayPal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Con SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Con Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimir Factura y enviar un Cheque por Correo");
	//Headline
	define("LANG_LABEL_HEADLINE", "Título");
	//Offer
	define("LANG_LABEL_OFFER", "Oferta");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Condiciones");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Fechas de la oferta");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Imagen de la oferta");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Oferta imprimible");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Nuestro Oferta basada en una plantilla HTML");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Complete los campos anteriores e inserte un logo u otra imagen (JPG o GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Uno Oferta provisto por usted, en su lugar");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "Imagen JPG o GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Título");
	//Comment
	define("LANG_LABEL_COMMENT", "Comentario");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Aceptado");
	//Approved
	define("LANG_LABEL_APPROVED", "Aprobado");
	//Success
	define("LANG_LABEL_SUCCESS", "Éxito");
	//Completed
	define("LANG_LABEL_COMPLETED", "Completo");
	//Y
	define("LANG_LABEL_Y", "S");
	//Failed
	define("LANG_LABEL_FAILED", "Con errores");
	//Declined
	define("LANG_LABEL_DECLINED", "Rechazado");
	//failure
	define("LANG_LABEL_FAILURE", "error");
	//Canceled
	define("LANG_LABEL_CANCELED", "Cancelado");
	//Error
	define("LANG_LABEL_ERROR", "Error");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Código de la transacción");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Id. de la suscripción");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "historial de transacciones");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Código de autorización");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Estado de la transacción");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Error en la transacción");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Valor de las cuentas mensuales");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "OID de la transacción");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Valor de las cuentas anuales");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Valor de las cuentas");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "Id. de la transacción");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Id. de la recepción");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Id. de la suscripción");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "Id. de pedido de la transacción");
	//your
	define("LANG_LABEL_YOUR", "su");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Haga su");
	//Payment
	define("LANG_LABEL_PAYMENT", "Pago");
	//History
	define("LANG_LABEL_HISTORY", "Historial");
	//Sign in
	define("LANG_LABEL_LOGIN", "Inicio de sesión");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Se canceló la transacción");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Valor de la transacción");
	//Pay
	define("LANG_LABEL_PAY", "Pagar");
	//Back
	define("LANG_LABEL_BACK", "Volver");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Precio total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Pagar con Factura");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrador");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Información de Cuentas");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Número de Tarjeta");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Fecha de vencimiento de la Tarjeta");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Código de la Tarjeta");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Información del Cliente");
	//zip
	define("LANG_LABEL_ZIP", "código postal");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Pedir y continuar");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Información General");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Número de Teléfono");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Dirección de Correo Electrónico");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Información de la Tarjeta de Crédito");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Fecha de Vencimiento");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Información del Cliente");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Vencimiento de la Tarjeta");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nombre que figura en la Tarjeta");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Tipo de Tarjeta");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Número de Verificación de la Tarjeta");
	//Province
	define("LANG_LABEL_PROVINCE", "Provincia");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Código Postal");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Código Postal");
	//Tel
	define("LANG_LABEL_TEL", "Tel.");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Seleccionar fecha");
	//Found
	define("LANG_PAGING_FOUND", "Se encontró");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Se encontraron");
	//record
	define("LANG_PAGING_RECORD", "registro");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "registros");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Mostrando página");
	//of
	define("LANG_PAGING_PAGEOF", "de");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "páginas");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Ir a la página");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Seleccione");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Ordenar por:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caracteres");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Última actualización");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Fecha de creación");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Calificación");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Precio");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "página anterior");
	//next page
	define("LANG_PAGING_NEXTPAGE", "página siguiente");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "anterior");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "siguiente");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "¡Se agregó correctamente el Artículo!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "¡Se agregó correctamente el Banner!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "¡Se agregó correctamente el Clasificado!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "¡Se agregó correctamente el Evento!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "¡Se agregó correctamente la galería!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "¡Se agregó correctamente el Listado");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "¡Se agregó correctamente lo Oferta!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Artículo!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Banner!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Clasificado!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Evento!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente la galería!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Listado!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente lo Oferta!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente el Ajuste de mapa!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "¡Se modificó correctamente la galería!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "¡Oferta se ha eliminado con éxito!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "¡Se modificó correctamente lo Oferta!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "¡Se eliminó correctamente el Banner!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Tipo de imagen no válido. Por favor inserte una imagen JPG, GIF o PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "El archivo de imagen es demasiado grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Por favor, inténtelo de nuevo con otra imagen.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Se rechazó el archivo adjunto. Tipo de archivo no válido.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Haga clic aquí para ver esta galería");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Haga clic aquí para administrar las imágenes de esta galería");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Escriba su nombre de e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "No se encontró el nombre de e-mail.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Intente nuevamente o póngase en contacto con el soporte en:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "El sistema de contraseña olvidada está desactivado.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Póngase en contacto con el soporte en:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "¡Gracias!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Se envió un mensaje de correo electrónico al titular de la cuenta con instrucciones para obtener una nueva contraseña");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "¡No se encontró el archivo!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "¡Error! No hay imagen en miniatura!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "¡Aún no se cargaron imágenes en esta galería!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Haga clic aquí para imprimir la factura");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Haga clic aquí para ver el detalle de la factura");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(los precios son por instalación)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Elemento sin pagar");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "No se necesita pagar");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Pase el mouse sobre las barras para ver más detalles sobre el gráfico)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Haga clic en el tipo de informe para mostrar el gráfico)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Haga clic aquí para ver esta calificación");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Haga clic aquí para modificar esta calificación");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Haga clic aquí para modificar esta respuesta");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Haga clic aquí para eliminar esta calificación");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Esperando la Aprobación del Administrador Del Sitio");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Esperando la Aprobación del Administrador Del Sitio para la Calificación");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Esperando la Aprobación del Administrador Del Sitio para la Respuesta");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Esperando la Aprobación del Administrador Del Sitio para la Calificación y Respuesta");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "La Calificación ya está Aprobada");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Calificación y Respuesta ya Aprobadas");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Calificación en Espera de Aprobación");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Respuesta en Espera de Aprobación");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Calificación Activa");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Respuesta Activa");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Calificación y Respuesta en Espera de Aprobación");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Calificación y Respuesta Activos");
	//Reply
	define("LANG_REPLY", "Responder");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Respuesta");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Calificación y Respuesta");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Editar Calificación");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Editar Respuesta");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Aprobar Calificación");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Aprobar Respuesta");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Respuesta ya Aprobada");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "¡La calificación se ha enviada con éxito!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "¡La respuesta se ha enviado con éxito!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "¡Por favor, escriba una respuesta válida!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "¡Por favor, escriba un nombre válido!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "¡Por favor, escriba un correo electrónico!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "¡Por favor, escriba una ciudad, estado válido!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "¡Por favor, escriba un nombre válido!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "¡Por favor, escriba una calificación válida!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Por favor, elige una opción o haga clic en Cancelar para salir.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Haga clic aquí para responder esta calificación");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Haga clic aquí para ver la transacción");	
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "El e-mail debe tener entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caracteres, sin espacios.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "La contraseña debe tener entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Escriba aquí su contraseña si desea modificarla.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Se enviará la contraseña a la dirección de correo electrónico del miembro.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Por favor escriba su e-mail y contraseña para referencias futuras.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Por favor revise los términos del acuerdo.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Se agregó correctamente");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Esta categoría ya se insertó");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Seleccione una categoría válida");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Seleccione una categoría en primer lugar");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Puede elegir un nombre para la página de modo que se acceda a ella directamente desde el navegador web, como una página html estática. El nombre elegido debe contener únicamente caracteres alfanuméricos (como \"a-z\" o \"0-9\") y \"-\" en lugar de espacios.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "El nombre de la página \"Taller de reparaciones Juan\" estará disponible mediante la dirección URL:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Se puede agregar imágenes adicionales a la");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "galería (si está activada).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Tamaño máximo de archivo");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "No se admiten archivos .gif o .png con transparencias");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animado no es compatible.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Por favor, asegúrese de que las dimensiones de la imagen se adapten a las dimensiones de pixel recomendadas, de lo contrario la calidad de la imagen puede verse afectada.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Marque esta casilla para quitar su imagen actual");
	//maximum 250 characters
	define("LANG_MSG_MAX_250_CHARS", "máximo 250 caracteres");
	//maximum 100 characters
	define("LANG_MSG_MAX_100_CHARS", "máximo 100 caracteres");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caracteres restantes");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(incluidos espacios y saltos de línea)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Incluir hasta");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "palabras clave, de no más de 50 caracteres cada una.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Agregue una palabra o frase clave por línea. Por ejemplo:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Su articulo aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "máximo 25 caracteres");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "máximo 500 caracteres");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Tipos de archivo permitidos");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Haga clic aquí para tener una vista previa de el listado");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Haga clic aquí para tener una vista previa de este evento");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Haga clic aquí para tener una vista previa de este clasificado");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Haga clic aquí para tener una vista previa de este artículo");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Haga clic aquí para tener una vista previa de este banner");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Haga clic aquí para tener una vista previa de esta oferta");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Haga clic aquí para tener una vista previa de esta galería");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "máximo 30 caracteres");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Seleccione un País");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Seleccione una Región");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Seleccione un Estado");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Seleccione una Ciudad");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Seleccione un Barrio");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Esta información no se mostrará al público)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Su evento aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Si el fragmento de código de video se completó, aparecerá en la página de detalles");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Tamaño máximo de código de video admitido");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Si el tamaño de código de video es mayor que el tamaño de video admitido, será modificado.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "El adjunto no tiene epígrafe");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Marque esta casilla para quitar el adjunto del listado existente");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Agregue una frase por línea. Por ejemplo");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Las categorías o subcategorías extra cuestan un");
	//additional
	define("LANG_MSG_ADDITIONAL", "adicional");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "cada una. ¡Es visto!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Su listado aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el listado no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el artículo no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el clasificado no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Si agrega nuevas categorías, el evento no aparecerá en la categoría principal de cada sub-categoría que agrega hasta que las apruebe administrador del sitio.");
	//Request your listing to be considered for the following bedges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Solicite que su listado sea tenida en cuenta para las siguientes clasificaciones.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Haga clic aquí para seleccionar la fecha");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Haga clic en el");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "icono de la galería");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "situado más abajo, si desea agregar fotos a su galería de fotos.");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Haga clic en el");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "icono de lo Oferta");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "situado más abajo, si desea agregar lo Oferta a su listado.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Puede agregar la oferta a su listado haciendo clic en el vínculo");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "agregar oferta");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Todas las páginas menos las páginas de elementos");
	//All pages
	define("LANG_ALLPAGES", "Todas las páginas");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Búsqueda sin categorías");
	//deal
	define("LANG_ICONPROMOTION", "oferta");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "enviar a un amigo");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "agregar a los favoritos");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "eliminar de favoritos");
	//print
	define("LANG_ICONPRINT", "imprimir");
	//map
	define("LANG_ICONMAP", "mapa");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Añadir a");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "No hay mapas de Google. Póngase en contacto con el administrador.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Quitar");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Artículos Favoritos");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Clasificados Favoritos");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Eventos Favoritos");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Listados Favoritos");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Ofertas Favoritas");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publicado");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Más información");
	//Date
	define("LANG_EVENT_DATE", "Fecha");
	//Time
	define("LANG_EVENT_TIME", "Hora");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Obtener indicaciones para llegar");
	//Website
	define("LANG_EVENT_WEBSITE", "Sitio web");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Teléfono");
	//More
	define("LANG_EVENT_MORE", "Más");
	//More Info
	define("LANG_EVENT_MOREINFO", "Más información");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Ver todas las categorías");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Ver todas las categorías");
	//More Info
	define("LANG_LISTING_MOREINFO", "Más información");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "ver teléfono");
	//view fax
	define("LANG_LISTING_VIEWFAX", "ver fax");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "enviar un mensaje");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "¡Haga clic aquí para obtener más información!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contacte este Listado");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Enviar pregunta");
	//phone
	define("LANG_LISTING_LETTERPHONE", "teléfono");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "sitio web");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "correo electrónico");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "ofrece los siguientes productos y servicios:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Horas de trabajo");
	//Check in
	define("LANG_CHECK_IN", "Entrada");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "¡No se encontraron calificaciones para este elemento!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Calificaciones y comentarios del último mes");
	//Review
	define("LANG_REVIEW", "Calificación");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Calificaciones");
	//Reviews
	define("LANG_REVIEWTITLE", "Calificaciones");
	//review
	define("LANG_REVIEWCOUNT", "calificación");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "calificaciones");
	//check in
	define("LANG_CHECKINCOUNT", "entrada");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "entradas");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Ver entradas");
	//Check ins of
	define("LANG_CHECKINSOF", "Entradas de");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "¡No se encontraron entradas para este elemento!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Categorías relacionadas");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategorías");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Ver calificaciones");
	//Rate it!
	define("LANG_REVIEWRATEIT", "¡Calificar!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "¡Sea el primero en calificar este ítem!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Ofrecido por");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Más información");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Válido de");
	//to
	define("LANG_PROMOTION_VALIDTO", "a");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimir");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Artículo");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Artículos");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banners");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Clasificado");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Clasificados");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Evento");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Eventos");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Listado");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listados");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Oferta");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Ofertas");
	//Send
	define("LANG_BUTTON_SEND", "Enviar");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Registrarse");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Ver ruta de la Categoría");
	//More info
	define("LANG_VIEWCATEGORY", "Más información");
	//No info found
	define("LANG_NOINFO", "No información encuentrada");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Quitar categoría");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Continuar");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "No, gracias");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Sí, continúe.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "¡No, Orden sin el paquete.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Aumente su Visibilidad!");
	//Gift
	define("LANG_GIFT", "Regalo");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "¡Ayuda para aumentar su visibilidad, visita nuestra ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Estadísticas del Sitio!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitantes por Mes");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Opción personalizada");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancelar");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Iniciar");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Guardar ajuste de mapa");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Borrar ajuste de mapa");
	//Next
	define("LANG_BUTTON_NEXT", "Siguiente");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pagar con Tarjeta de Crédito");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pagar con PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pagar con SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Buscar");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avanzada");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Cerrar");
	//Clear
	define("LANG_BUTTON_CLEAR", "Borrar");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Agregue su Artículo");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Agregue su Clasificado");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Agregue su Evento");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Agregue su Listado");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Agregue su Oferta");
	//Home
	define("LANG_BUTTON_HOME", "Inicio");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Administrar Cuenta");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gestionar Contenido");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Área del Anunciante");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Área Administrativa");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Sección Administrativa");
	//Help
	define("LANG_BUTTON_HELP", "Ayuda");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Salir");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Enviar");
	//Update
	define("LANG_BUTTON_UPDATE", "Actualizar");
	//Back
	define("LANG_BUTTON_BACK", "Volver");
	//Delete
	define("LANG_BUTTON_DELETE", "Eliminar");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Completar el proceso");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Escriba el texto de la imagen situada a la izquierda en el cuadro de texto. Esto es necesario para evitar el envío automatizado de solicitudes de contacto.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "No se puede mostrar la imagen del código de verificación");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Código de verificación");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Seleccione una calificación para este elemento");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "¡Se detectó un fraude! ¡Seleccione una calificación para este elemento!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "¡Se requiere el \"Comentario\" y el \"Nombre del comentario\" para enviar un comentario!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "¡Se requiere el \"Nombre\" y el \"Correo Electrónico\" para enviar un comentario!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "¡Se requiere la \"Ciudad, Estado\" para enviar un comentario!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "¡Escriba una dirección de correo electrónico válida!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Ya calificó el Elemento. Gracias.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "¡Gracias por sus comentarios!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Se envió su revisión y se evaluará su aprobación.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "¡No se seleccionó una forma de pago!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "La fecha de vencimiento de la Tarjeta de Crédito es errónea. Intente nuevamente.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Haga clic aquí para intentar nuevamente");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Es posible que las transacciones de pago no tengan lugar inmediatamente.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Después de que se haya procesado el pago, la información acerca de su transacción");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "se podrá encontrar en el historial de transacciones.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "se podrá encontrar en el");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "La puerta de enlace del pago no está actualmente disponible");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "No se pudieron validar los parámetros del pago");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Error en la puerta de enlace interna");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "La información acerca de su transacción se podrá encontrar");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "en el historial de transacciones.");
	//in your
	define("LANG_MSG_IN_YOUR", "en el");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "No hay Id. de la transacción");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Error del sistema, intente nuevamente.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Complete todos los campos requeridos.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "No se pudo conectar.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "¡Gracias por configurar sus elementos y realizar el pago!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "El administrador del sitio revisará sus elementos y los activará dentro de los siguientes dos días laborables.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "La puerta de enlace de pago no respondió");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Es posible que los pagos pendientes demoren entre 3 y 4 días en ser aprobados.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Error de conexión");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Complete correctamente el código postal.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Complete correctamente el número de verificación de la tarjeta.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "El tipo de la tarjeta y el número de identificación de la tarjeta no coinciden.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "No se completó la transacción.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Número de error:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Mensaje corto:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Mensaje largo:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Se completó correctamente la transacción.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "La fecha de vencimiento de la tarjeta debe estar en el futuro");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Si se confirmó la transacción, podrá encontrar información acerca de ella en");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "el historial de transacciones, después de que se haya procesado el pago.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "después de que se haya procesado el pago.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "No hay elementos que requieran pagarse.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pagar facturas pendientes");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." por impresión y facturas personalizadas se puede pagar una vez.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", string_ucwords(BANNER_FEATURE_NAME)." por impresión se puede pagar una vez.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Las facturas personalizadas se pueden pagar una vez.");
	//View Items
	define("LANG_VIEWITEMS", "Ver Artículos");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "No use un sistema de pago reiterativo.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "¡Intente nuevamente!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Se requieren todos los campos.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Usted tiene más de ");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Por favor, póngase en contacto con el administrador para pagar.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Opciones del Artículo");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Autor del Artículo");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "URL del autor");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Categorías del Artículo");
	//Banner Type
	define("LANG_BANNER_TYPE", "Tipo de Banner");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Opciones de Banners");
	//Order Banner
	define("LANG_ORDER_BANNER", "Solicitar Banner");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Por período");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Detalles del Banner");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Hacer secuencia de comandos del Banner");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mostrar por código de secuencia de comandos");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permitir especificar una secuencia de comandos en lugar de una imagen. Este campo permite pegar una secuencia de comandos que se usará para mostrar el banner de un programa asociado o un sistema de banner externo. Si \"Mostrar por código de secuencia de comandos\" está activado, solo se requerirá el campo \"Secuencia de comandos\". No se necesitarán los demás campos situados a continuación.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "\"URL de Destino\" y \"Informe de Tráfico Clic Directo\" no tendrán efecto cuando se haya cargado banners por secuencia de comandos.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "\"URL de destino\" y \"Informe de Tráfico Clic Directo\" no tendrán efecto al cargar el archivo swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Nivel del Clasificado");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Categoría del Clasificado");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Seleccionar el nivel del clasificado");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Opciones de Clasificados");
	//Event Level
	define("LANG_EVENT_LEVEL", "Nivel del Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Categorías del Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Categorías del Evento");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Seleccionar nivel de evento");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Opciones de Eventos");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Nivel del Listado");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Tipo del Listado");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Categorías del Listado");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Clasificaciones del Listado");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sujeto a la aprobación del administrador.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Seleccionar esta opción");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Seleccionar el nivel del listado");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Opciones de Listados");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "El sistema de pago Authorize no está actualmente disponible. Póngase en contacto con el");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "El sistema de pago iTransact no está actualmente disponible. Póngase en contacto con el");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "El sistema de pago LinkPoint no está actualmente disponible. Póngase en contacto con el");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "El sistema de pago PayFlow no está actualmente disponible. Póngase en contacto con el");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "El sistema de pago PayPal no está actualmente disponible. Póngase en contacto con el");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "El sistema de pago PayPalAPI no está actualmente disponible. Póngase en contacto con el");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "El sistema de pago PSIGate no está actualmente disponible. Póngase en contacto con el");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "El sistema de pago 2CheckOut no está actualmente disponible. Póngase en contacto con el");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "El sistema de pago WorldPay no está actualmente disponible. Póngase en contacto con el");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "El sistema de pago SimplePay no está actualmente disponible. Póngase en contacto con el");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Advertencia de carga");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "¡Se cargó correctamente el archivo!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "¡La extensión no está permitida, o el tipo de archivo es erróneo!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "¡El archivo excede el límite de tamaño!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "¡Error al intentar crear el directorio!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "¡Permiso de directorio erróneo!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "¡Error inesperado!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "¡No se encontró o no se especificó el archivo!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "¡El archivo ya existe en el directorio!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Ver todas las Ubicaciónes");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Lugares Destacados");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "No hay lugar destacado en el sistema.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Resumen");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Ubicación en el Mapa");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Más Listados");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Más Eventos");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Más Clasificados");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Más Artículos");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "No se permite la operación: la oferta");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "ya está asociada con el listado");
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
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Haga clic en \"Agregar\" para seleccionar las categorías");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Haga clic en \"Agregar categoría principal\" o \"Agregar sub-categoría\" para escribir sus nuevas categorías");
	//Add an
	define("LANG_ADD_AN", "Añadir un(a)");
	//Add a
	define("LANG_ADD_A", "Añadir un(a)");
	//on these sites
	define("LANG_ON_SITES", "en estos sitios:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "en este sitio:");

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
	define("LANG_GALLERYTITLE", "Galería de fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Haga clic aquí");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "para ver la presentación de diapositivas. También puede hacer clic en cualquier foto para iniciar la presentación.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "más fotos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Código de lo Oferta inexistente");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "no está disponible.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "no está disponible para este tipo de elemento.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "no se puede usar dos veces.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "Puede seleccionar hasta");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "galería.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galerías.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Se requiere el nombre.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Se requiere el idioma.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Se requiere el nombre.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Se requiere el apellido.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Se requiere la empresa.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Se requiere el teléfono.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "Se requiere el correo electrónico.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Se requiere la cuenta.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Se requiere el nombre de la página.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Se requiere la categoría.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Se requiere el resumen.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Se requiere el tipo de vencimiento.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Se requiere la fecha de renovación.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Se requieren las impresiones.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Se requiere el archivo.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Se requiere el tipo.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Se requiere el epígrafe.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Se requiere el código de secuencia de comandos.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Se requiere la descripción 1.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Se requiere la descripción 2.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Se requiere el nombre.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Se requiere el Nombre de la Oferta.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Se requiere la Oferta.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Se requiere la Fecha de inicio.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Se requiere la Fecha de finalización.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Se requiere el texto.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail es obligatorio.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "La \"Contraseña actual\" no es correcta.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "Se requiere la \"Contraseña\".");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "Se requiere la \"Aceptación de los términos de uso\".");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "No se completaron los siguientes campos, o contienen errores:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Nombre: complete el campo");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nombre de la página: complete el campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "Máximo de");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categorías permitidas.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "El nombre de la página de URL semántica ya está en uso, seleccione otro nombre para la página.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "El nombre de la página contiene caracteres no válidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "Máximo de");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "palabras clave permitidas");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Incluya palabras clave, de no más de 50 caracteres cada una.");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Especifique una \"Fecha de publicación\" válida.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Especifique una \"Fecha de inicio\" válida.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Especifique una \"Fecha de finalización\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "La \"Fecha de finalización\" debe ser posterior o igual a la \"Fecha de inicio\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "La \"Hora de finalización\" debe ser posterior a la \"Hora de inicio\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "La \"Fecha de finalización\" no puede estar en el pasado.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Especifique una dirección del correo electrónico válido.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Especifique una \"URL\" válida.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Escriba una descripción de no más de 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Escriba una condición de no más de 255 caracteres.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Especifique una fecha de renovación válida.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "La fecha de renovación debe estar en el futuro");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Especifique una fecha de vencimiento válida.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "La fecha de vencimiento debe estar en el futuro");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "No se permite dejar en blanco la contraseña.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Escriba una contraseña de no más de");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Escriba una contraseña de no menos de");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Especifique un e-mail válido.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Lo sentimos, no puedes cambiar estas informaciones de la cuenta");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "¡No se permite contraseña \"abc123\"!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "Las contraseñas no coinciden. Escriba el mismo texto en los campos \"Contraseña\" y \"Vuelva a escribir la contraseña\".");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "No se permiten espacios para el e-mail.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "No se permiten caracteres especiales para el e-mail.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Por favor, escriba un e-mail de no más de");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Por favor, escriba un e-mail de no menos de");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Seleccione un e-mail diferente.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Haga clic aquí si no aparece su categoría");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Añadir categoría principal");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Añadir subcategoría");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "¡Nombre de la categoría ya está registrado!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "¡Nombre de la categoría disponible!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Inicio");
	//Panel
	define("LANG_MEMBERS_DASHBOARD", "Panel");
	//Manage
	define("LANG_MENU_MANAGE", "Administrar");
	//Add
	define("LANG_MENU_ADD", "Agregar");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Opciones del Anunciante");
	//Listings
	define("LANG_MENU_LISTING", "Listados");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Agregar Listado");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Administrar Listados");
	//Galleries
	define("LANG_MENU_GALLERY", "Galerías");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Agregar galería");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Administrar galería");
	//Events
	define("LANG_MENU_EVENT", "Eventos");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Agregar Evento");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Administrar Eventos");
	//Banners
	define("LANG_MENU_BANNER", "Banners");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Agregar Banner");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Administrar Banners");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Clasificados");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Agregar Clasificado");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Administrar Clasificados");
	//Articles
	define("LANG_MENU_ARTICLE", "Artículos");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Agregar Artículo");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Administrar Artículos");
	//Deals
	define("LANG_MENU_PROMOTION", "Ofertas");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Agregar Oferta");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Administrar Ofertas");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Anunciate");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Página no encontrada");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Página de Mantenimiento");
	//FAQ
	define("LANG_MENU_FAQ", "Preguntas");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Mapa del sitio");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contáctenos");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Opciones de pago");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Pagar");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Realice su pago");
	//History
	define("LANG_MENU_HISTORY", "Historial");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Historial de transacciones");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Historial de facturas");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Elija un Tema");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Elija un Esquema de Color");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Buscar Artículo");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Buscar Clasificado");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Buscar Evento");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Buscar Listado");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Buscar Oferta");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Búsqueda avanzada");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Buscar");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Ubicación");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Seleccione un País");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Select una Región");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Seleccione un Estado");	
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Seleccione una Ciudad");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Seleccione un Barrio");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Categoría");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Seleccione una categoría");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtro");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Frase Exacta");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Cualquier Palabra");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Todas las Palabras");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Tipo del Listado");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "a");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "de");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Buscar por palabra clave");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Buscar");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "¡Sírvanse proporcionar únicas palabras con al menos [FT_MIN_WORD_LEN] letras para la búsqueda!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Presentado");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Artículos Recientes");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Eventos Próximos");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Clasificados Presentados");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Artículos Presentados");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Listados Presentados");
	//Featured deals
	define("LANG_FEATURED_PROMOTION", "Ofertas Presentadas");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Ver todos los artículos");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Ver todos los eventos");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Ver todos los clasificados");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Ver todos los listados");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Ver todas las ofertas");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Último Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Fácil y Rápido.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Pasos");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Pasos");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Registrar cuenta");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Actualización");
	//Order
	define("LANG_ORDER", "Solicitar");
	//Check Out
	define("LANG_CHECKOUT", "Pagar");
	//Configuration
	define("LANG_CONFIGURATION", "Configuración");
	//Select a level
	define("LANG_SELECTPACKAGE", "Seleccionar un nivel");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Opciones de Perfil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Cuenta de Directorio");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Mi cuenta de OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Mi cuenta de Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Mi cuenta de Google");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "¿Ya tiene una cuenta?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "No, soy un Usuario Nuevo.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Sí, tengo una Cuenta.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Iniciar sesión con mi cuenta de Directorio.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Iniciar sesión con mi cuenta de OpenID 2.0.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Iniciar sesión con mi cuenta de Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Iniciar sesión con mi cuenta de Google.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informaciones de la cuenta");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Información Extra");
	//Please write down your username and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Tome nota de su nombre de usuario y contraseña para referencia.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-mail debe ser un correo electrónico válido entre ");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "y");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caracteres, sin espacios.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "La contraseña debe tener entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "y");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caracteres, sin espacios.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Acepto los términos de uso");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "¿Quieres anunciarte con nosotros?");
	//Buy a link
	define("LANG_BUY_LINK", "Comprar un vínculo");
	//Back to Top
	define("LANG_BACKTOTOP", "Volver Arriba");
	//Back to
	define("LANG_BACKTO", "Volver a ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoritos");
	//view summary
	define("LANG_VIEWSUMMARY", "ver resumen");
	//view detail
	define("LANG_VIEWDETAIL", "ver detalles");
	//Advertisers
	define("LANG_ADVERTISER", "Auspiciantes");
	//Order Now!
	define("LANG_ORDERNOW", "¡Pida Ahora!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Espere, cargando...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Total parcial");
	//Subtotal
	define("LANG_SUBTOTAL", "Total parcial");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total de impuestos");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Valor total del precio");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoritos");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "¡No hay favoritos encontrados!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Buscar resultados por");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Búsqueda Relacionada");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Búsqueda por sección");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Palabra Clave");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "(escriba una palabra clave");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Palabra clave o nombre del listado");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Palabra clave o nombre de la oferta");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Palabra clave o nombre del evento");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Palabra clave o nombre del clasificado");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Palabra clave o nombre del artículo");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Dónde");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Dirección, Ciudad, Estado o Código Postal)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "En busca de su ubicación...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Complete el siguiente formulario para ponerse en contacto con nosotros.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mensaje");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "No hay encontrado categorías con discapacidad en el sistema.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "No se encontraron categorías.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Seleccione una categoría válida");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "¡Seleccione una categoría en primer lugar!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Ver ruta de las categorías");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Quitar categoría");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Las categorías o subcategorías extra cuestan un");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "adicional");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "cada una. ¡Es visto!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Máximo de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categorías permitidas.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categorías y subcategorías");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Seleccione únicamente subcategorías que se apliquen directamente a su tipo.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Su listado aparecerá automáticamente en la categoría principal de cada subcategoría que seleccione.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Error de información de la cuenta");
	//Contact Information
	define("LANG_CONTACTINFO", "Información de Contacto");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Esta información no se mostrará al público.");
	//Billing Information
	define("LANG_BILLINGINFO", "Información de cuentas");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Esta información no se mostrará al público.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Deberá configurar su artículo después de realizar el pedido.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Deberá configurar su banner después de realizar el pedido.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Deberá configurar su clasificado después de realizar el pedido.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Deberá configurar su evento después de realizar el pedido.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Deberá configurar su listado después de realizar el pedido.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Error de información de cuentas");
	//Article Information
	define("LANG_ARTICLEINFO", "Información del Artículo");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Error de información del Artículo");
	//Banner Information
	define("LANG_BANNERINFO", "Información del Banner");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Error de información del Banner");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Información del Clasificado");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Error de información del Clasificado");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Buscar Eventos por Fecha");
	//Event Information
	define("LANG_EVENTINFO", "Información del Evento");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Error de información del Evento");
	//Listing Information
	define("LANG_LISTINGINFO", "Información del Listado");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Error de información del Listado");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Reclame este Listado");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Tipo del listado");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "No se encontraron resultados para los criterios de búsqueda requeridos.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Intente la búsqueda nuevamente o busque por sección.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Es posible que, a veces, la búsqueda no arroje resultados, ya que la palabra clave usada es demasiado genérica. Realice una nueva búsqueda con una palabra clave más específica.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Escriba al menos una palabra clave en el cuadro de búsqueda.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>¡Lo siento!</h1><p>Su búsqueda me devuelve ningún resultado. Aunque esto es poco frecuente, que ocurre de vez en cuando, cuando el término de búsqueda que ha utilizado es un genérico poco o cuando en realidad no tienen ningún contenido coincidente.</p><h2>Sugerencias:</h2>Sea más específico con los términos de búsqueda.<br />Revisa tu ortografía.<br />Si usted no puede encontrar a través de la búsqueda de tratar browing por sección.<br /><br /><p>Si creemos que usted ha venido aquí por error, por favor póngase en contacto con el administrador del sitio para reportar un problema <a href=\"[EDIR_LINK_SEARCH_ERROR]\">aquí</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Imagen");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Error al cargar imagen");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Siguiente");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pausa");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Reproducir");
	//Back
	define("LANG_SLIDESHOW_BACK", "Volver");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Se envió su mensaje de correo electrónico. Gracias.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Hubo un problema al enviar este mensaje de correo electrónico. Intente nuevamente.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Por favor ingrese su nombre.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "¡Escriba una dirección de correo electrónico válida.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "¡Escriba un mensaje.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "¡Escriba correctamente el código.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Corríjalo e intente nuevamente.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "¡Escriba un nombre!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "¡Escriba un asunto!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "ALGUNOS DETALLES");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Escriba una dirección de correo electrónico válida en el campo \"Para\"");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Escriba una dirección de correo electrónico válida en el campo \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Artículo no encontrado. Por favor, regrese a");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "y vuelve a intentarlo.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Escriba una dirección de correo electrónico válida en el campo \"Su correo electrónico\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "del");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Acerca de");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "del");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Enviar información acerca de este artículo a un amigo");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Enviar información acerca de este clasificado a un amigo");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Enviar información acerca de este evento a un amigo");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Enviar información acerca del listado a un amigo");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Enviar información acerca de este Oferta a un amigo");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mensaje enviado por ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Este es un mensaje automático.");
	//Contact
	define("LANG_CONTACT", "Contacto");
	//article
	define("LANG_ARTICLE", "artículo");
	//classified
	define("LANG_CLASSIFIED", "clasificado");
	//event
	define("LANG_EVENT", "evento");
	//listing
	define("LANG_LISTING", "listado");
	//deal
	define("LANG_PROMOTION", "oferta");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "¡Busque al menos un parámetro en el cuadro de búsqueda!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Intente nuevamente su búsqueda.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Aún no hay artículos registrados.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Aún no hay clasificados registrados.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Aún no hay eventos registrados.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Aún no hay listados registrados.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Aún no hay ofertas registradas.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mensaje enviado por medio de");
	//E-mail Form
	define("LANG_EMAILFORM", "Formulario de correo electrónico");
	//Click here to print
	define("LANG_PRINTCLICK", "Haga clic aquí para imprimir");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Ubicación");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Más Clasificados");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Location
	define("LANG_EVENT_LOCATIONS", "Ubicación");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Eventos Presentados");
	//events
	define("LANG_EVENT_PLURAL", "Eventos");
	//Search results
	define("LANG_SEARCHRESULTS", "Resultados de la búsqueda");
	//Results
	define("LANG_RESULTS", "Resultados");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "para");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "en");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "en");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "en");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "en la categoría");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "en");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "en");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "para");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Página");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Calificaciones Recientes");
	//Reviews of
	define("LANG_REVIEWSOF", "Revisiones de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Las calificaciones están desactivadas");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Ver todas las categorías");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Ver todas las categorías");
	//Offer
	define("LANG_PROMOTION_OFFER", "Oferta");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Descripción");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Condiciones");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Ubicación");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "¡No se encontró el elemento!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "¡El elemento no está disponible!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Resultados de la Búsqueda de Listados");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Resultados de la Búsqueda de Ofertas");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Resultados de la Búsqueda de Eventos");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Resultados de la Búsqueda de Clasificados");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Resultados de la Búsqueda de Artículos");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Idiomas Disponibles");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Usted puede elegir un máximo de ".MAX_ENABLED_LANGUAGES." de los idiomas siguientes para su directorio.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "¡Disfrute los servicios!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Quitar asociación con");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bienvenido");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Opciones del Anunciante");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Volver a Sitio Web");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Agregar nueva cuenta");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Contraseña olvidada");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Haga clic aquí");
	//Help
	define("LANG_LABEL_HELP", "Ayuda");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Restablecer Contraseña");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Información del contacto y de la cuenta");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notificación de registro");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Ir a Inicio de sesión");
	//Order
	define("LANG_LABEL_ORDER", "Solicitar");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Pagar");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuración");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Por favor, escriba la URL del sitio en primer lugar.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "¡Error de validación! Por favor, inténtelo de nuevo.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "¡Sitio validado con éxito!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Generar Tráfico");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "Por favor, observe que puede cambiar el código que desee, ya que mantener el link exactamente como se muestra aquí, de lo contrario su backlink no será validado.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink no han sido validado. Por favor, inténtelo de nuevo.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Marque esta casilla para eliminar el backlink de este listado");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "URL del Backlink");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL donde se instaló el backlink.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Por favor, escriba la URL del Backlink.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink nno disponibles para este listado");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Agregar un Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Ponga esto en su sitio web (código HTML):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Introduzca la URL de tu sitio:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Por ejemplo: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Haga clic en el botón para verificar su Backlink");
	//Verify
	define("LANG_LABEL_VERIFY", "Verificar");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "¿Por qué añadir un Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Agregar un enlace a su sitio web que apunte a este, aumenta la pertinencia de este sitio y, a su vez la relevancia de su listado.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "¿Qué hay para mí?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "Al darnos un enlace en la página principal de su sitio web, usted nos ayuda con su clasificación y por lo tanto nuestros resultados. Pero así como nos ayuda, vamos a hacer un esfuerzo adicional y ayudarle. Si se agrega un enlace, una vez que haya verificado que existe, nos mostrará su listado con un estilo especial en la página de resultados, por lo que realmente consigue una cierta exposición adicional en el directorio - es una situación de beneficio mutuo para los dos.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "¿Cómo puedo hacer esto?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Simple en realidad, copie el código arriba en el código de su sitio web, de modo que aparece en algún lugar destacado en la página de inicio, nos dan la dirección URL de su sitio web (donde la relación es) y lo vamos a comprobar después de golpear el botón \"Verificar\" - a continuación, sólo continuar .... super simple.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "No, Orden sin el Backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Sí, añadir Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink agregado correctamente a tu listado!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Usted no tiene listado para añadir backlink aún.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Backlink previa");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Detalle de la categoría");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Administrador del sitio");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Página de Resumen");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Página de Detalles");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galería de fotos");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Agregar Banner");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Información de imágenes de la galería");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Imágenes de la galería");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Administrar imágenes de la galería");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Administrar Galerías");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "¡La galería no existe!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "¡La galería no está disponible!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Nombre de la factura personalizada");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Elementos de la factura personalizada");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Fácil y rápido.");
	//Steps
	define("LANG_LABEL_STEPS", "Pasos");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Registrar cuenta");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Seleccionar un Nivel");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Estado del pago");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Vencimiento");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Agregar nueva galería");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Agregar una nueva Galería");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nueva Oferta");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Agregar una nueva oferta");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Administrar Cuentas");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Haga clic aquí si ya tiene una contraseña.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "¿No es un anunciante?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "para obtener información acerca de cómo agregar su elemento a");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bienvenido a la Sección de Anunciante");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bienvenido a la Sección de Miembros");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Cuenta bloqueada. Espere");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minuto(s) e intente nuevamente.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Uno o más campos obligatorios no se llenaron. Por favor, confirmar que toda la información requerida fue introducido antes de continuar.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "¡Usted no tiene permiso de acceso de esta dirección IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "¡Tu cuenta ha sido desactivado!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "El e-mail o la contraseña son incorrectos.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Cuenta errónea.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Lo sentimos, para su protección en el vínculo enviado a su correo electrónico ha vencido. Si has olvidado tu contraseña, haz clic en el enlace de abajo.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "¡El OpenID servidor no está disponible!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "¡Error al llamar al servidor de OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "¡OpenID solicitud cancelada!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "¡Google solicitud cancelada!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "¡No válido de identidad OpenID!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "¿Olvidó su contraseña?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "¿Qué es OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "¿Qué es Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "¿Qué es Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "¡Se actualizó correctamente la cuenta!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "¡Contraseña correctamente actualizada!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Gracias por registrar su cuenta en");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Inicie sesión para administrar su cuenta con el correo electrónico y la contraseña que figuran a continuación.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Podrá ver");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Su cuenta en");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Este artículo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Este clasificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Este listado mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "la cantidad máxima de");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "imagen");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "imágenes");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "en la galería");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " además de una imagen principal.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "o Asociar una galería existente con este artículo");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "o Asociar una galería existente con este clasificado");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "o Asociar una galería existente con este evento");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "o Asociar una galería existente con este listado");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Continúe para pagar su artículo");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Continúe para pagar su banner");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Continúe para pagar su clasificado");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Continúe para pagar su evento");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Continúe para pagar su listado");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Los artículos están activados por");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Los banners están activados por");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Los clasificados están activados por");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Los eventos están activados por");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Los listados están activadas por");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "solo después de que se haya completado el proceso.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Sugerencias para el ajuste de mapa de los elementos");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Puede ajustar la posición en el mapa,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "con más precisión.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Acerque o aleje el mapa con los controles \"+\" y \"-\".");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Desplácese por el mapa con las flechas.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Arrastre y suelte el marcador para ajustar la ubicación.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Su Oferta aparecerá aquí");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Asociar un Oferta existente con este listado");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "¡No se encontraron resultados!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "¡No se permite el acceso!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Se encontraron los siguientes problemas");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "No hay elementos seleccionados que requieran pagarse.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "No se encontraron elementos.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "No hay facturas en el sistema.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "No hay transacciones en el sistema.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Reclame este Listado");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Vaya al área de pago de lo anunciante");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Puede ver su factura en");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Acepto los términos");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "y enviaré el pago.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Esta página lo dirigirá, en algunos segundos, al área de anunciante.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Esta página lo dirigirá, en algunos segundos, para que pueda continuar el proceso de registro.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Si no funciona,");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Administrar Artículo");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Administrar Banner");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Administrar Clasificado");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Administrar Evento");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Administrar Listado");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Administrar Oferta");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Administrar cuentas");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Administrar facturas");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Administrar Transacciones");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "No hay artículos en el sistema.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "No hay banners en el sistema.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "No hay clasificados en el sistema.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "No hay eventos en el sistema.");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "No hay galerías en el sistema.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "No hay listados en el sistema.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "No hay ofertas en el sistema.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "No hay informes disponibles.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "No se encontró el artículo. Es posible que se haya eliminado.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "No se encontró el clasificado. Es posible que se haya eliminado.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "No se encontró el listado. Es posible que se haya eliminado.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Información del Artículo");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Eliminar Artículo");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Eliminar información del Artículo");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "¿Confirma que desea eliminar este artículo?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Galería de Artículo");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Vista previa de Artículo");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Informe de tráfico del Artículo");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Detalle del Artículo");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Modificar información del Artículo");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Eliminar Banner");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Eliminar información del Banner");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "¿Confirma que desea eliminar este banner?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Modificar Banner");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Modificar información del Banner");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Vista previa del Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Informe de tráfico del Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Ver Banner");
	//Disabled
	define("LANG_BANNER_DISABLED", "Desactivado");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Información del Clasificado");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Eliminar Clasificado");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Su clasificado aparecerá automáticamente en la categoría principal de cada sub-categoría que usted seleccione.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Categorías del Clasificado");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Categorías del Clasificado");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Eliminar información del Clasificado");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "¿Confirma que desea eliminar este clasificado?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "Galería de Clasificado");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Ajuste de mapa del Clasificado");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Vista previa del Clasificado");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Informe de tráfico del Clasificado");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Detalle del Clasificado");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Modificar información del Clasificado");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Modificar nivel del Clasificado");
	//Delete Event
	define("LANG_EVENT_DELETE", "Eliminar Evento");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Eliminar información del Evento");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "¿Confirma que desea eliminar este evento?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Información del Evento");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Galería del Evento");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Ajuste de mapa del Evento");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Vista previa del Evento");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Informe de tráfico del Evento");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Detalle del Evento");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Modificar información del Evento");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Galería del Listado");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Información del Listado");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Ajuste de mapa del Listado");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Vista previa del Listado");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Oferta del Listado");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Lo Oferta está vinculada desde el listado.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Para estar activa, la oferta");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "debe tener una fecha de finalización en el futuro.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "debe estar asociada con un listado.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Informe de tráfico del Listado");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Detalle del Listado");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "para listado");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Actualización");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Eliminar Oferta");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Eliminar información de lo Oferta");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "¿Confirma que desea eliminar este Oferta?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Vista previa de lo Oferta");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Información de lo Oferta");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Detalle de lo Oferta");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Modificar información de lo Oferta");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Eliminar galería");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Eliminar información de la galería");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "¿Confirma que desea eliminar esta galería? Esto quitará la totalidad de la información, las fotos y las relaciones de la galería.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Eliminar imagen de la galería");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Información de la galería");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Vista previa de la galería");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Detalle de la galería");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Modificar información de la galería");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Administrar imágenes");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Eliminar imagen");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "¡Se eliminó correctamente la imagen!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Detalle de la calificación");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Vista previa de la calificación");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Detalle de la factura");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "No se encontró la factura de esta cuenta.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notificación de la factura");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Detalle de la transacción");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "No se encontró la transacción de esta cuenta.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Iniciar sesión con cuenta de Directorio");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Iniciar sesión con cuenta de OpenID 2.0");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Iniciar sesión con cuenta de Facebook");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Iniciar sesión con cuenta de Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", "¡".LANG_LABEL_USERNAME." ya está registrado!");
	//This account is avaliable.
	define("LANG_USERNAME_NOT_REGISTERED", "¡Esta cuenta está disponible!");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Error al subir la imagen. Por favor, inténtelo de nuevo.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "¡Imagen cargada con éxito!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "¡Imagen actualizada correctamente!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Eliminar imagen");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "¿Está seguro que quiere borrar esta imagen?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Editar imagen");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Hace principal");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principal");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Haga clic aquí para establecer como imagen principal");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Haga clic aquí para establecer como galería de imágenes");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paquetes");
	//Package
	define("LANG_PACKAGE_SING", "Paquete");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "El cobro por paquete ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "¡Perfil actualizado correctamente!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Opciones del Anunciante");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "Mis Amigos");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Amigos para Aprobar");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "En Espera de la Aceptación");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Habilitar Perfil de Usuario");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "¡Conoce gente, encontre clientes para su negocio y mucho más!");
	//Profile
	define("LANG_LABEL_PROFILE", "Perfil");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Opciones de Perfil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Editar Perfil");
	//Friends
	define("LANG_LABEL_FRIENDS", "Amigos");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Ver los Amigos");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Administrar Amigos");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Cargar la imagen de su Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Información Personal");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Apodo");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Cuenta de Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Acerca de Mí");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Fecha de Nacimiento");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Ciudad Natal");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Libros Favoritos");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Películas Favoritas");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favoritos de Deportes");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favoritos de Músicas");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favoritos de los Alimentos");
	//Settings
	define("LANG_LABEL_SETTINGS", "Configuración");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Ver a todos sus amigos");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Todos los Amigos");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Retire amigo");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Añadir amigo");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Aceptar");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Negar");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Seja un Anunciante");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Regístrate y comienza a promocionar su negocio hoy, ¡gratis!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "¿Qué puedo hacer?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Mensajes");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "¿Estás seguro?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "La página personal con el nombre \"john-smith\" estará disponible a través de la URL:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Su URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Su URL contiene caracteres no válidos.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL ya está en uso, por favor, elija otra URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Usted no tiene amigos.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Amigo retirado con éxito.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Amigo aprobado con éxito.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Amigo lograron rechazar.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Requisito amigo cancelado correctamente.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Ver todos");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Ver todas");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "No hay amigos");
	//No Items
	define("LANG_MSG_NO_ITEMS", "No hay elementos");
	//Share
	define("LANG_LABEL_SHARE", "Compartir");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Compartir Todos");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comentarios");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Mi Perfil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "¡Perfil de usuario habilitado correctamente!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publicar mi información de contacto");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Crear mi página personal");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Página Personal");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Calificaciones de Artículos");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Calificaciones de Listados");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Las calificaciones han eliminado correctamente.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "¡No se encontraron calificaciones!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Modificar mi perfil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Volver a mi perfil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Miembro desde");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Configuraciones de la Cuenta");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Ofertas Validadas");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoritos");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Usted no tiene permiso para acceder a esta zona.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Ve a tu perfil.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Mi Página Personal");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Utilice esta cuenta");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Página de Perfil");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Crea tu Perfil");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Apodo es necesario.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Asegúrese de que la cuenta de twitter que estás agregando no está protegida. Si la cuenta de twitter es protegida, los últimos tweets en esta cuenta no se muestran.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Su artículo ha sido pagada, lo que puede añadir un máximo de [max] categorías libre.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Su artículo ha sido pagada, lo que puede añadir un máximo de [max] categoría libre.");
	
	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "¡Sólo imágenes");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "se aceptan para cargar!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Las imágenes deben estar bajo ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "¡Seleccione una imagen para subir!");
	//Original image
	define("LANG_ORIGINAL", "Imagen original");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Pulgar vista previa");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Leyendas");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "¡Puede agregar el máximo de ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " fotos a su galería!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Crear Miniatura");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Vista previa en miniatura");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Su elemento ya tiene el número máximo de imágenes en la galería. Elimine una imagen existente para salvar esta.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Evento Recurrente");
	//Repeat
	define("LANG_PERIOD", "Repetición");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Elija una opción");
	//Daily
	define("LANG_DAILY", "Diario");
	//Weekly
	define("LANG_WEEKLY", "Semanal");
	//Monthly
	define("LANG_MONTHLY", "Mensual");
	//Yearly
	define("LANG_YEARLY", "Anual");
	//Daily
	define("LANG_DAILY2", "Diario");
	//Weekly
	define("LANG_WEEKLY2", "Semanal");
	//Monthly
	define("LANG_MONTHLY2", "Mensual");
	//Yearly
	define("LANG_YEARLY2", "Anual");
	//every
	define("LANG_EVERY", "Cada");
	//every
	define("LANG_EVERY2", "Cada");
	//of
	define("LANG_OF", "do(a)");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "da");
	//of
	define("LANG_OF4", "del");
	//Week
	define("LANG_WEEK", "Semana");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Elige Mes");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Elige Día");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Elige Semana");
	//First
	define("LANG_FIRST", "Primero(a)");
	//Second
	define("LANG_SECOND", "Segundo(a)");
	//Third
	define("LANG_THIRD", "Tercero(a)");
	//Fourth
	define("LANG_FOURTH", "Cuarto(a)");
	//Last
	define("LANG_LAST", "Último(a)");
	//1st
    define("LANG_FIRST_2", "1ª");
    //2nd
    define("LANG_SECOND_2", "2ª");
    //3rd
    define("LANG_THIRD_2", "3ª");
    //4th
    define("LANG_FOURTH_2", "4ª");
	//Recurring
	define("LANG_RECURRING", "Recurrente");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Por favor, seleccione un día de la semana.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Por favor, escriba un día.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Seleccione un mes.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Por favor, seleccione una semana.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Por favor, seleccione una opción de Repetición.");
	//When
	define("LANG_EVENT_WHEN", "Cuando");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Día debe ser numérico.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Día debe ser entre 1 y 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Día no coincide con el período elegido.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mes no coincide con el período elegido.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Días no coinciden con el período elegido.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semana no coincide con el período elegido.");
	//No info
	define("LANG_EVENT_NO_INFO", "No hay información");
	//Ends on
	define("LANG_ENDS_IN", "Finaliza el");
	//Never
	define("LANG_NEVER", "Nunca");
	//Until
	define("LANG_UNTIL", "Hasta");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Hasta");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Hasta\" debe ser mayor o igual a la \"Fecha de inicio\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Hasta\" no puede ser en el pasado.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Comienza el");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repite");
	//Ends on
	define("LANG_EVENT_ENDS", "Finaliza el");
	//weekend
	define("LANG_EVENT_WEEKEND", "fin de semana");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "día laborable");
	//the month
	define("LANG_THE_MONTH", "mes");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
	//Sitio
	define("LANG_DOMAIN", "Sitio");
	//Site name
	define("LANG_DOMAIN_NAME", "Nombre del Sitio");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Haga clic aquí hacer ver este sitio");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Haga clic aquí para borrar este sitio");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "¡Sitio eliminado correctamente!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "¡Sitio agregado correctamente!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Una notificación por correo electrónico será enviado al equipo de soporte de eDirectory, por favor espere nuestro contacto.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "El nombre del sitio se requiere");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL del sitio se requiere");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "El nombre del sitio ya existe");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL del sitio ya existe");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL del sitio no válida");
	//Site Items
	define("LANG_SITE_ITEMS", "Elementos del Sitio");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Informaciones del Perfil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Rede(s) Social(es)");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Conectar y importar las informaciones");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Sólo Conectar");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Conectar a mi cuenta de Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Desconectar mi cuenta de Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Su cuenta ha sido desconectada de facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Su cuenta de Facebook ya está conectada a otra cuenta en el sistema.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Su cuenta de Twitter ya está conectada a otra cuenta en el sistema.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Vinculado a Twitter como");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Conectado como");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Preferencias de ubicación");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Elija su preferencia de ubicación");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Utilice su ubicación actual");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Utilice su ubicación del Facebook");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Conectar con Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Cuenta de Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Cuenta de Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Cambiar cuenta");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Cuenta Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter con");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Conectar a mi cuenta de Twitter");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Desconectar mi cuenta de Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Publicar redime en mi cuenta de Twitter de forma automática");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Su cuenta ha sido desconectada de Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Usted debe registrarse primero a través de Twitter");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Su cuenta de Twitter fue conectada con éxito");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Su cuenta de Facebook fue conectada con éxito");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Usted ya ha iniciado sesión como cuenta de Facebook");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Este usuario está ya conectada a otra cuenta.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Haga clic aquí para ver a esta cuenta");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Conectar con Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Utilizar el lenguaje en cada sesión en mi cuenta");
	
	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_LINK2LISTING", "Enlace a un listado");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Me gustó este");
	//Redeem
	define("DEAL_REDEEM", "Validar");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Validar esta oferta");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Para validar usted necesita enviar esta información mucho en tu Facebook o Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Puede configurar este botón para enviar automáticamente en tu perfil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Haga clic aquí para configurar");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Por favor, espere, publicar en Facebook y Twitter (si está disponible).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Ya redimido este acuerdo! Su código es");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Oferta hecho! Este es su código de canjear");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Nadie ha redimido a este acuerdo en Facebook sin embargo.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Nadie ha redimido a este acuerdo sin embargo en Twitter.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Recientes ofertas validadas");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "¡No hay ofertas encontradas!");
	//This deal is not available anymore.
	define("DEAL_NA", "Este acuerdo ya no está disponible.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Para validar esta oferta es necesario publicar en su muro de Facebook. En primer lugar usted debe ingresar a su cuenta de Facebook y aprobar nuestra aplicación para trabajar en su perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "¡Ya has hecho esta oferta!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Lo sentimos, no fue un error intentando escribir un mensaje en su muro de Facebook. Por favor, inténtelo de nuevo.");
	//Value
	define("DEAL_VALUE", "Valor");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Con esta oferta");
	//Thank you
	define("DEAL_THANKYOU", "Gracias");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valor original");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Con este acuerdo");
	//Valid until
	define("DEAL_VALIDUNTIL", "Válido hasta el");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "El Oferta debe ser presentado para recibir el descuento");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Límite de un Oferta por compra");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "No es válido con otros cupones, oferta o descuentos de ningún tipo");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Sólo es válido para la lista de Nombre - Dirección");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimir artículo");
	//deal done
	define("DEAL_DEALSDONE", "Oferta Completada");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Ofertas Completadas");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//SOLD OUT
	define("DEAL_SOLDOUT", "VENDIDO");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Lo sentimos, este acuerdo no existe o fue eliminado por el propietario");
	//at
	define("DEAL_AT", "en");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "URL amigables");
	//Select a listing
	define("DEAL_SELECTLISTING", "Seleccione una lista");
	//Tagline for Deals
	define("DEAL_TAG", "Tagline for Deals");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilidad");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Esta oferta se mostrará en");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "búsquedas generales y a cerca de");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 horas / día");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Período específico");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Información de descuento");
	//Item Value
	define("LANG_SITEMGR_ITEMVALUE", "Valor del Ítem");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Descuento");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valor con descuento");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Cantidad de ofertas");
     //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "oferta concluida hasta ahora");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "ofertas concluidas hasta ahora");
	//left
	define("LANG_SITEMGR_LEFT", "restantes");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Por favor, espere...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Por favor, espere. Estamos reorientando su nombre de usuario para completar este paso...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Se requiere el Valor del Ítem.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", "Se requiere el ".LANG_LABEL_DISC_AMOUNT);
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." no puede ser superior a 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Se requiere las Ofertas para ofrecer.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Por favor, entre un valor menor en el campo ".LANG_LABEL_DISC_AMOUNT);
	//Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Redemeed de");
	//You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Sólo se puede vincular directamente este acuerdo a un listado si selecciona una cuenta de primera");
    //Value
    define("DEAL_VALUE", "Valor");
    //With discount
    define("DEAL_WITHCOUPON", "Con descuento");
	//Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Validar por correo electrónico");
	//Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Iniciar sessión y canjear");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Conecte y de impresión");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Redimir y Compartir");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Ofertas Destacadas");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Accede a través de su sesión de Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Para canjear el uso de Facebook que necesita para conectarse a través de tu cuenta de Facebook.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Canjear Estadísticas");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Canjear código");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponible");
    //Used
    define("DEAL_SITEMGR_USED", "Usado");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Redimir con su actual período de sesiones Facebook");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Configuración de Navegación guardada.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "Hubo un problema de ahorro, por favor, inténtelo de nuevo.");
	//At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "Por lo menos un punto es necesario.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Usted no puede guardar URLs repetidas.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Usted no puede guardar elementos vacíos.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "No se puede guardar el encabezado o pie de página vacío.");
    //Use
    define("DEAL_SITEMGR_USE", "Utilice");
	//Saving...
	define("LANG_DEAL_SAVING", "Guardando...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "No se encontraron canjear.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "porcentaje");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valor fijo");

    # ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Especifique un nombre.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Especifique una URL.");
	//Add new item to menu
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Añadir Ítem");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Nuevo Item");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Módulo");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Contenido del Sitio");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Nuevo");
	//Save
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Salve");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Salve Item");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Nombre");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Uso");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Seleccione por favor un módulo o golpe cerca de la cancelación.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Lo sentimos, no hay páginas personalizadas para elegir.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Crear un nuevo contenido personalizado");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Cree páginas personalizadas en el área de contenido de páginas");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Utilice el URL del módulo");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Utilice el URL personalizada");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Editar, añadir, quitar o cambiar el orden de los elementos en la siguiente sección:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Navegación de cabecera");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Navegación de pie de página");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "¿Cancelar la inclusión de este ítem?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Restaurar los ítems");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Canjear sin Facebook");
    //Don't have Facebook? Sign using your account
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "¿No tienes Facebook? Entra con tu cuenta");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Cambiar Sitio");
    //Only
    define("LANG_ONLY2", "Sólo");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Oferta");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Ofertas");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Calificaciones de Ofertas");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "publicada en Facebook y Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "publicada en Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "publicada en Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Publicada en");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "oferta terminada");
	//deal opened
	define("LANG_DEAL_OPENED", "oferta abierta");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Términos y Condiciones");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "máximo 1000 caracteres");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Escriba condiciones de no más de 1000 caracteres.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "línea");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Error al importar para tabla temporal.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Fecha de renovación no válida  - línea");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Fecha de actualización no válida  - línea");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Archivo CSV importado para tabla temporal.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail no válido - línea");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Contraseña no válida - línea");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Palabra clave no válida (máximo ".MAX_KEYWORDS." palabras clave) - línea");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Palabra clave no válida(".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - línea");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Nombre no válido - línea");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Fecha de inicio no válida - línea");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Fecha de finalización no válida - línea");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Fecha de inicio debe ser llenado - línea");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Fecha de finalización debe ser llenado - línea");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Inválida la hora de inicio. - línea");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Inválida la hora de finalización - línea");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Inválido formato de la hora de inicio. Debe ser \"xx:xx\" - línea");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Inválido formato de la hora de finalización. Debe ser \"xx:xx\" - línea");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Modo no válido de la hora de inicio. Debe ser \"AM\" o \"PM\" - línea");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Modo no válido de la hora de finalización. Debe ser \"AM\" o \"PM\" - línea");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Modo no válido de la hora de inicio. Debe ser \"24\" - línea");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Modo no válido de la hora de finalización. Debe ser \"24\" - línea");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Ubicación y ubicación estándar del sistema son diferentes - línea");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Inválida latitud. Debe ser numérico entre -90 y 90 - línea");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Inválida longitud. Debe ser numérico entre -180 y 180 - línea");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "No hay archivos CSV en el directorio de importación.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "El número de columnas en la(s) línea(s) siguiente(s) están equivocados:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total de líneas que se lee:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV header does not match - it has more fields that it is allowed");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV header does not match at field(s): ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "cuenta revertida");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "cuentas revertidas");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "artículo revertido");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "artículos revertidos");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Encuentre lo que está buscando...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "A veces puede recibir ningún resultado para su búsqueda por la palabra clave que han utilizado es muy genérico. Asegurese de usar una palabra clave más específica.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Encuéntranos en LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Encuéntranos en Facebook");
	//Links
	define("LANG_LINKS", "Enlaces");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contacto");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Síguenos en Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Síguenos");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Resultados por página");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Mostrando resultados");
	//to
	define("LANG_PAGING_SHOWING_TO", "a");
	//of
	define("LANG_PAGING_SHOWING_OF", "de");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páginas");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "La importación de [SUGAR_ITEM_TITLE] de SugarCRM en [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilice el formulario de arriba para importar desde el registro del SugarCRM [SUGAR_ITEM_TITLE], después de hacer clic importar sus datos serán transferidos a su directorio con toda la información relevante pasa a través, por favor llene los datos adicionales, y los datos de pago.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Estás a punto de terminar.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "No fue posible para la exportación. Por favor, consulte la información de conexión de SugarCRM en su directorio.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Clave del eDirectory incorrecta.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Proprietario del Listado");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Título de la Calificacione");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Proprietario del Evento");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Proprietario del Classificado");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Nombre del Autor");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.susitio.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "tunombre@susitio.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitante");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Categoría");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Categoría 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Categoría 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Categoría 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Categoría 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Descripcion Resumida");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Descripcion Completa");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Contenido ilustrativo");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Enviar a Teléfono");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Haga clic para Llamar");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "¡Mensaje enviado con éxito!");
	//Send info about this listing to a phone;
	define("LANG_LISTING_TOPHONE_SAUDATION", "Enviar información sobre este listado a un teléfono.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Escriba su teléfono para llamar al dueño del listado, sin costes.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "El teléfono es requerido.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Por favor, escriba un número de teléfono válido.");
	//Call
	define("LANG_TWILIO_CALL", "llamar");
	//Calling
	define("LANG_TWILIO_CALLING", "Llamando");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Teléfono");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extensión");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Activar");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "El código de validación es el siguiente:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "¡Su número de teléfono se activa!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "¡Número de teléfono se han eliminado correctamente!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Haga clic para Llamar no disponibles para este listado");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Consejos para el elemento de Haga clic para Llamar");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Debes activar el número de teléfono abajo con el fin de permitir a los usuarios en contacto con usted directamente a través de lo directorio.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Introduce tu número de teléfono y haga clic en Activar.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Un mensaje con el código de activación será mostrado. Tome nota de este código y esperar a que la llamada de activación.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Se le pedirá que introduzca el código de seis dígitos de activación. Introduzca el código y esperar a que el mensaje de confirmación.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Después de activar su número de teléfono, haga clic en Salvar para finalizar el proceso.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Para los números fuera de los EE.UU., es necesario poner el código de país primero.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "Sólo los números de EE.UU. son aceptados.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Haga clic para Llamar\" informe");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Dirección");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Hora de Inicio");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Hora de Finalización");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Tiempo (en segundos)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "No hay informes disponibles.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Activado por");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "La activación ha fallado. Por favor, inténtelo de nuevo.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Cuenta no está activa.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Cuenta de prueba no es compatible con esta función.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Llamada entrante rechazada debido a que cuenta inactiva.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Formato de la URL no válido.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP recuperación ha fallado.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP conexión ha fallado.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP violación del protocolo.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP mla nombre de host.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP demasiados redireccionamientos.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Documento falta analizar.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Inválida Twilio Markup XML versión.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "El elemento raíz debe ser la Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Advertencia de validación del esquema.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "No válido Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Falla interna.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: No se puede marcar desde un segmento de llamadas de marcación.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: método de valor no válido.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: tiempo de espera no válido.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: valor de hangupOnStar no válido.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: valor de callerId no válido.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Inválida elemento anidado.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: valor de timeLimit no válido.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valor del método no válido.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Valor de sendDigits no válido.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Formato de número de teléfono no válido.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Número de teléfono no válido.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Número de teléfono prohibido.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valor no válido silenciado.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Valor no válido endConferenceOnExit.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Valor no válido startConferenceOnEnter.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Inválida waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Inválida waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Inválido beep value.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Inválido Conference Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Inválido Conference Name.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Inválido Verb usado no waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Valor finishOnKey no válido.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valor del método no válido.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Valor del tiempo de espera no válido.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Valor del numDigits no válido.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Inválida verbo anidadas.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Valor no válido de voz.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Valor no válido bucle.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: No válido Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valor no válido bucle.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: No válido Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Valor no válido bucle.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Valor no válido de voz.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Texto no válido.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Valor no válido el método.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Valor no válido de tiempo de espera.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Valor no válido maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Valor no válido finishOnKey");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Valor no válido el método.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Valor no válido longitud.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Invalid \"Para\" atributo.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Invalid \"De\" atributo.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Cuerpo no válido.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Atributo no válido el método.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Atributo no válido statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limitar la recuperación de documentos alcanzado.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS enviar superado el límite de velocidad.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De número de teléfono SMS no pueden.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "Responder mensaje SMS límite excedido.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "No válido para el verbo Responder SMS.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Para el número de teléfono no válido para el modo de prueba.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Parámetros desconocidos.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Inválida FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permiso denegado.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Método no permitido.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Cuenta no está activa.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "No se especifica número llamado.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Número de llamada es un número especial.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Llamadas internacionales no están habilitadas.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "URL no válida.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits no válido.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Inválida IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Inválido tiempo de espera.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Método no válido.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Número de teléfono de llamada no verificado.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Llamado número de teléfono no válido.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "No válido número de teléfono del llamante.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Número de teléfono de llamada es necesaria.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Número de llamadas de teléfono no se puede llegar.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Cuenta no autorizada para llamar al número de teléfono.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Cuenta no se les permite llamar al número de teléfono.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Número de teléfono no parece ser válida.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Inválida ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Estado no válido de llamada.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Número de teléfono no válido.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "URL no válida.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Método no válido");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Número de teléfono entrante no está disponible en la cuenta de prueba.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "No se puede establecer sin establecer VoiceFallbackUrl Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "No se puede establecer sin establecer SmsFallbackUrl SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Este tipo de número de teléfono no es compatible con SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Número de teléfono ya validados en su cuenta.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Código de área no válida.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "No hay números de teléfono se encuentran en el código de área.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Número de teléfono ya validados en otra cuenta.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Inválida CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Recurso no disponible.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "URL no válida de devolución de llamada.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Inválida tipo de transcripción.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid es necesario.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Número de teléfono no es válido SMS con capacidad de número de teléfono entrante.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "El cuerpo del mensaje se requiere.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "La fuente \"de\" número de teléfono es necesario enviar un SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "El destino \"a\" número de teléfono es necesario enviar un SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Longitud máxima del cuerpo de SMS es de 160 caracteres");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "El \"De\" número de teléfono proporcionado no es válido, con capacidad de SMS el número de teléfono entrante para su cuenta.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "El número de Sandbox puede enviar mensajes a números verificados.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Comentarios del Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Comentarios del Facebook no estan disponible para este listado");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Asegúrese de estar conectado a Facebook con la misma cuenta se establece en la sección Opciones de Comentarios, de lo contrario no se puede moderar los comentarios para este artículo.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "También puede moderar los comentarios a través de ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "No válido clave de la API.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Falta un parámetro: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nombre del módulo no válido.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Módulo desactivado.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Falta un parámetro: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API deshabilitada.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscina");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Habitacione(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Baño(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Piso(s)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Tipo de Inmueble");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Uso");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Precio");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construido En");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Pies Cuadrados");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Oficina");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Lavandería");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Aire Acondicionado Central");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Comedor");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garaje");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Basura y Residuos");