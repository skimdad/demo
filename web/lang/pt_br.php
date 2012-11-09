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
	# * FILE: /lang/pt_br.php
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
	define("LANG_DATE_MONTHS", "janeiro,fevereiro,março,abril,maio,junho,julho,agosto,setembro,outubro,novembro,dezembro");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "domingo,segunda-feira,terça-feira,quarta-feira,quinta-feira,sexta-feira,sábado");
	//year
	define("LANG_YEAR", "ano");
	//years
	define("LANG_YEAR_PLURAL", "anos");
	//month
	define("LANG_MONTH", "mês");
	//months
	define("LANG_MONTH_PLURAL", "meses");
	//day
	define("LANG_DAY", "dia");
	//days
	define("LANG_DAY_PLURAL", "dias");
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
	define("ZIPCODE_LABEL", "CEP");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "d \d\e F \d\e Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F \d\e Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Tem alguma pergunta sobre o Código do Vídeo? Clique Aqui.");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Você está usando uma versão antiga do Internet Explorer que pode afetar a funcionalidade completa de alguns recursos. Nós recomendamos que você atualize para uma versão mais recente do Internet Explorer.");
	//N/A
	define("LANG_NA", "n.d.");
	//characters
	define("LANG_LABEL_CHARACTERES", "caracteres");
	//by
	define("LANG_BY", "por");
	//in
	define("LANG_IN", "em");
	//Read More
	define("LANG_READMORE", "Leia Mais");
	//More
	define("LANG_MORE", "mais");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Busca por Categoria");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Busca por Localidade");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Busca por Empresas");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Busca por Eventos");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "Busca por Classificados");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Busca por Artigos");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Busca por Ofertas");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "Busca por Postagens");
	//show
	define("LANG_SHOW", "exibir");
	//hide
	define("LANG_HIDE", "ocultar");
	//Bill to
	define("LANG_BILLTO", "Para faturamento");
	//Payable to
	define("LANG_PAYABLETO", "Pague a");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Data de Emissão");
	//Expire Date
	define("LANG_EXPIREDATE", "Data de Vencimento");
	//Questions
	define("LANG_QUESTIONS", "Dúvidas");
	//Please call
	define("LANG_PLEASECALL", "Por favor ligue para");
	//Invoice Info
	define("LANG_INVOICEINFO", "Informações da Fatura");
	//Payment Date
	define("LANG_PAYMENTDATE", "Data do Pagamento");
	//None
	define("LANG_NONE", "Nenhum");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Serviços Extras");
	//Locations
	define("LANG_LOCATIONS", "Localização");
	//Close
	define("LANG_CLOSE", "Fechar");
	//Close this window
	define("LANG_CLOSEWINDOW", "Fechar esta janela");
	//from
	define("LANG_FROM", "de");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "Informações da Transação");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Em transações manuais, subtotal e o imposto não são calculados.");
	//creditcard
	define("LANG_CREDITCARD", "cartão de crédito");
	//Join Now!
	define("LANG_JOIN_NOW", "Registre-se Agora!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Crie Seu Perfil");
	//More Information
	define("LANG_MOREINFO", "Mais Informações");
	//and
	define("LANG_AND", "e");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Auto Peças");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Pneus e Rodas");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Reparo de Motor");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Categorias e subcategorias");
	//per
	define("LANG_PER", "por");
	//each
	define("LANG_EACH", "cada");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "blocos de visualizações");
	//Add
	define("LANG_ADD", "Adicionar");
	//Manage
	define("LANG_MANAGE", "Gerenciar");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "visualizações ao meu crédito de");
	//Section
	define("LANG_SECTION", "Seção");
	//General Pages
	define("LANG_GENERALPAGES", "Páginas Gerais");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Abrir em uma nova janela");
	//No
	define("LANG_NO", "Não");
	//Yes
	define("LANG_YES", "Sim");
	//Dear
	define("LANG_DEAR", "Querido(a)");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Endereço, Caixa Postal");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartamento, suite, unidade, prédio, andar, etc.");
	//or
	define("LANG_OR", "ou");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Segunda à Sexta - 8:00 às 18:00");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Sábado - 8:00 às 14:00");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Domingo - 10:00 às 12:00");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Campos Adicionais");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Comodidades");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Entrar automaticamente");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Marcar / Desmarcar Todos");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Informações da Fatura");
	//Default
	define("LANG_BUSINESS", "Padrão");
	//on Listing
	define("LANG_ON_LISTING", "na Empresa");
	//on Event
	define("LANG_ON_EVENT", "no Evento");
	//on Banner
	define("LANG_ON_BANNER", "no Banner");
	//on Classified
	define("LANG_ON_CLASSIFIED", "no Classificado");
	//on Article
	define("LANG_ON_ARTICLE", "no Artigo");
	//Listing Name
	define("LANG_LISTING_NAME", "Nome da Empresa");
	//Event Name
	define("LANG_EVENT_NAME", "Nome do Evento");
	//Banner Name
	define("LANG_BANNER_NAME", "Nome do Banner");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "Nome do Classificado");
	//Article Name
	define("LANG_ARTICLE_NAME", "Nome do Artigo");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Dúvidas Frequentes");
	//click to crop image
	define("LANG_CROPIMAGE", "clique aqui para recortar a imagem");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Não encontrou sua resposta? Fale conosco.");
	//Active
	define("LANG_LABEL_ACTIVE", "Ativo");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Suspenso");
	//Expired
	define("LANG_LABEL_EXPIRED", "Expirado");
	//Pending
	define("LANG_LABEL_PENDING", "Pendente");
	//Received
	define("LANG_LABEL_RECEIVED", "Recebido");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Código Promocional");
	//Account
	define("LANG_LABEL_ACCOUNT", "Conta");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Mudar a conta");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Nome ou Título");
	//Name
	define("LANG_LABEL_NAME", "Nome");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "Primeiro, Último");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Nome da Página");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Resumo");
	//Category
	define("LANG_LABEL_CATEGORY", "Categoria");
	//Category
	define("LANG_CATEGORY", "Categoria");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Categorias");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Categorias");
	//Country
	define("LANG_LABEL_COUNTRY", "País");
	//Region
	define("LANG_LABEL_REGION", "Região");
	//State
	define("LANG_LABEL_STATE", "Estado");
	//City
	define("LANG_LABEL_CITY", "Cidade");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Bairro");
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Países");
	//Regions
	define("LANG_LABEL_REGION_PL", "Regiões");
	//States
	define("LANG_LABEL_STATE_PL", "Estados");
	//Cities
	define("LANG_LABEL_CITY_PL", "Cidades");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Bairros");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Adicione uma nova região");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Adicione um novo estado");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Adicione uma nova cidade");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Adicione um novo bairro");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Escolher uma região existente");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Escolher um estado existente");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Escolher uma cidade existente");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Escolher um bairro existente");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Nenhuma localidade encontrada");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Renovação");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Data de Renovação");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Endereço");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Website");
	//Phone
	define("LANG_LABEL_PHONE", "Fone");
	//Fax
	define("LANG_LABEL_FAX", "Fax");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Descrição");
	//Status
	define("LANG_LABEL_STATUS", "Status");
	//Level
	define("LANG_LABEL_LEVEL", "Nível");
	//Empty
	define("LANG_LABEL_EMPTY", "Vazio");
	//Start Date
	define("LANG_LABEL_START_DATE", "Data de Início");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Data de Início");
	//End Date
	define("LANG_LABEL_END_DATE", "Data de Término");
	//End Date
	define("LANG_LABEL_ENDDATE", "Data de Término");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Data inválida");
	//Start Time
	define("LANG_LABEL_START_TIME", "Hora de Início");
	//End Time
	define("LANG_LABEL_END_TIME", "Hora de Término");
	//unlimited
	define("LANG_LABEL_UNLIMITED", "ilimitado");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Selecione um Tipo");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Selecione uma Categoria");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Tempo Restante");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Ver Oferta");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Nenhuma Oferta");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Selecione uma Oferta");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Nome do Contato");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Nome do Contato");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Telefone");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Fax");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "E-mail");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Endereço");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-mail");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Notifique-me sobre avaliações e tráfego das empresas");
	//Invoice
	define("LANG_LABEL_INVOICE", "Fatura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Fatura Nº");
	//Item
	define("LANG_LABEL_ITEM", "Item");
	//Items
	define("LANG_LABEL_ITEMS", "Itens");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Categoria Extra");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "Código Promocional");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Preço do Item");
	//Amount
	define("LANG_LABEL_AMOUNT", "Valor");
	//Tax
	define("LANG_LABEL_TAX", "Imposto");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Subtotal");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Fazer os cheques nominais para");
	//Total
	define("LANG_LABEL_TOTAL", "Total");
	//Id
	define("LANG_LABEL_ID", "Id");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Título");
	//Caption
	define("LANG_LABEL_CAPTION", "Legenda");
	//impressions
	define("LANG_IMPRESSIONS", "visualizações");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "Visualizações");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Por visualizações");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Por período de tempo");
	//Date
	define("LANG_LABEL_DATE", "Data");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "Seu E-mail");
	//Subject
	define("LANG_LABEL_SUBJECT", "Assunto");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mensagem adicional");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Tipo de pagamento");
	//Notes
	define("LANG_LABEL_NOTES", "Notas");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "É fácil e rápido!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Escreva avaliações, comente no blog");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Escreva avaliações");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Já possui uma conta?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Aproveite nossos serviços!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Senha de Teste");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Esqueceu sua senha?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Resumo");
	//Detail
	define("LANG_LABEL_DETAIL", "Detalhes");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(e-mail do seu amigo)");
	//From
	define("LANG_LABEL_FROM", "De");
	//To
	define("LANG_LABEL_TO", "Para");
	//to
	define("LANG_LABEL_DATE_TO", "a");
	//Last
	define("LANG_LABEL_LAST", "Último");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Últimos");
	//day
	define("LANG_LABEL_DAY", "dia");
	//days
	define("LANG_LABEL_DAYS", "dias");
	//New
	define("LANG_LABEL_NEW", "Nova");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Novo FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Tipo");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Website");
	//Added
	define("LANG_LABEL_ADDED", "Adicionado");
	//Add
	define("LANG_LABEL_ADD", "Adicionar");
	//rating
	define("LANG_LABEL_RATING", "avaliação");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "avaliador");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Avaliador");
	//System
	define("LANG_LABEL_SYSTEM", "Sistema");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "Inscrição de RSS");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Força da senha");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Título do Artigo");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO - Descrição");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO - Palavras-chave");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "não são permitidas quebras de linha");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "separe os elementos com vírgula (,)");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Clique aqui para editar as informações de SEO deste item");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "Informações de SEO atualizadas!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Clique aqui para visualizar este artigo");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Clique aqui para editar este artigo");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Clique aqui para adicionar/editar a galeria de fotos deste artigo");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Galeria de fotos indisponível para este artigo");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Clique aqui para ver o relatório deste artigo");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Histórico deste artigo");
	//History not available for this article
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_ARTICLE", "Histórico indisponível para este artigo");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Clique aqui para remover este artigo");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Clique aqui para visualizar este banner");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Clique aqui para editar este banner");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Clique aqui para ver o relatório deste banner");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Histórico deste banner");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Histórico indisponível para este banner");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Clique aqui para remover este banner");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "Título do Classificado");
	//Click here to
	define("LANG_MSG_CLICKTO", "Clique aqui para");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Clique aqui para visualizar este classificado");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Clique aqui para editar este classificado");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Clique aqui para adicionar/editar a galeria de fotos deste classificado");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Galeria de fotos indisponível para este classificado");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Clique aqui para ver o relatório deste classificado");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Clique aqui para ajustar a localização deste classificado no mapa");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Ajuste de localização indisponível para este classificado");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Histórico deste classificado");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Histórico indisponível para este classificado");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Clique aqui para remover este classificado");
	//Event Title
	define("LANG_EVENT_TITLE", "Título do Evento");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Clique aqui para visualizar este evento");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Clique aqui para editar este evento");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Clique aqui para adicionar/editar a galeria de fotos deste evento");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Galeria de fotos indisponível para este evento");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Clique aqui para ver o relatório deste evento");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Clique aqui para ajustar a localização deste evento no mapa");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Ajuste de localização indisponível para este evento");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Histórico deste evento");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Histórico indisponível para este evento");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Clique aqui para remover este evento");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Título da Galeria");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Clique aqui para visualizar esta galeria");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Clique aqui para editar esta galeria");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Clique aqui para remover esta galeria");
	//Listing Title
	define("LANG_LISTING_TITLE", "Nome da Empresa");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Clique aqui para visualizar esta empresa");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Clique aqui para editar esta empresa");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Clique aqui para adicionar/editar a galeria de fotos desta empresa");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Galeria de fotos indisponível para esta empresa");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Clique aqui para alterar a oferta desta empresa");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Oferta indisponível para esta empresa");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Clique aqui para ver o relatório desta empresa");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Clique aqui para ajustar a localização desta empresa no mapa");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Ajuste de localização indisponível para esta empresa");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Endereço não encontrado.");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Por favor edite o seu item.");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Clique aqui para ver as avaliações deste item");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Avaliações indisponíveis para este item");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Histórico desta empresa");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Histórico indisponível para esta empresa");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Clique aqui para remover esta empresa");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Salvar");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Mais Informação");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(Tente usar algo descritivo, como \"10% de desconto no nosso produto\" ou \"3 pelo preço de dois em nosso produto\")");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Digite o valor do item / serviço que você está oferecendo. Escolha um tipo de desconto (valor fixo ou percentual) e digite o respectivo valor. Verifique o cálculo e, em seguida, forneça o número de ofertas que você deseja fazer.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Por favor, certifique-se que a imagem é do tamanho correto antes de carregá-la, caso contrário, a imagem provavelmente será esticada e a qualidade será afetada.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Toda oferta precisa ser ligada a uma empresa para ser ativa no site.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Associar com a empresa");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Por favor, digite o título do seu item e aguarde por sugestões de associações disponíveis.");
	//Empty
	define("LANG_EMPTY", "Vazio");
	//Cancel
	define("LANG_CANCEL", "Cancelar");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Período Personalizado");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Valor de Desconto Fixo");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Desconto Percentual");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Valor com Desconto");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Desconto (Calculado)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Quantas ofertas você gostaria de oferecer");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Ligada à Empresa");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Escolha uma Empresa");
	//You can not add different deals to the same listing.
	define("LANG_MSG_REPEATED_LISTINGS", "Você não pode adicionar ofertas diferentes para a mesma empresa.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Ofertas atualizadas com sucesso!");
	//Options
	define("LANG_LABEL_OPTIONS", "Opções");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Título da Oferta");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Clique aqui para visualizar esta Oferta");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Clique aqui editar esta Oferta");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Clique aqui para remover esta Oferta");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "Vá para \"Empresas\" e clique no ícone Oferta da empresa que terá uma Oferta. Escolha uma Oferta para a empresa. Somente após esse processo a Oferta será publicada.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "As parcelas serão debitadas até a expiração do cartão de crédito");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "máximo de 36 parcelas");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "Configurações de SEO");
	//View
	define("LANG_LABEL_VIEW", "Visualizar");
	//Edit
	define("LANG_LABEL_EDIT", "Editar");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galeria");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Relatório de Tráfego");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Pendente");
	//Paid
	define("LANG_LABEL_PAID", "Pago");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Aguardando pagamento/aprovação");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Em análise");
	//Available
	define("LANG_LABEL_AVAILABLE", "Disponível");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Em disputa");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Devolvido");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "Cancelado");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "Transação");
	//Delete
	define("LANG_LABEL_DELETE", "Remover");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Ajustar Localização");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Ocultar Mapa");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Exibir Mapa");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Imprimir");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Pendente");
	//Image
	define("LANG_LABEL_IMAGE", "Imagem");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Imagens");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Campo obrigatório");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Por favor, digite todos os campos requeridos.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Informações da Conta");
	//Usuário
	define("LANG_LABEL_USERNAME", "E-mail");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Senha Atual");
	//Password
	define("LANG_LABEL_PASSWORD", "Senha");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Criar Senha");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Nova Senha");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Confirme a Senha");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Confirme a Senha");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Confirme a Nova Senha");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Informações");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Data de Publicação");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Calendário");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Url Amigável");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Por exemplo");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Imagem");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Autor da imagem");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Legenda da imagem");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Resumo");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Palavras-chave para a busca");
	//maximum
	define("LANG_LABEL_MAX", "max");
	//keywords
	define("LANG_LABEL_KEYWORDS", "palavras-chave");
	//Content
	define("LANG_LABEL_CONTENT", "Conteúdo");
	//Code
	define("LANG_LABEL_CODE", "Código");
	//free
	define("LANG_FREE", "grátis");
	//free
	define("LANG_LABEL_FREE", "grátis");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Url de Destino");
	//Script
	define("LANG_LABEL_SCRIPT", "Script");
	//File
	define("LANG_LABEL_FILE", "Arquivo");
	//Warning
	define("LANG_LABEL_WARNING", "Aviso");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Exibir URL (opcional)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Descrição 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Descrição 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Localização");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Complemento");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Complemento");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Descrição");
	//Price
	define("LANG_LABEL_PRICE", "Preço");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Preços");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "Informações de Contato");
	//Language
	define("LANG_LABEL_LANGUAGE", "Idioma");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "Selecione seu idioma de origem para contato (quando necessário).");
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Nome");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Nome");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Sobrenome");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Sobrenome");
	//Company
	define("LANG_LABEL_COMPANY", "Empresa");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Endereço");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Complemento");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Latitude");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Longitude");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Não encontrado. Por favor, tente especificar melhor sua localização.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Os campos a seguir contêm erros:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Latitude deve ser um número entre -90 e 90.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Longitude deve ser um número entre -180 e 180.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Local");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Data do Evento");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Descrição");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Informações");
	//Text
	define("LANG_LABEL_TEXT", "Texto");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Adicionar Imagem");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Adicionar Imagem");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Editar Legendas da Imagem");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Arquivo");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Legenda da Miniatura");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Legenda da Imagem");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Atenção, seu upload pode demorar alguns minutos dependendo do tamanho de seu arquivo e da velocidade de sua conexão. Atualizar esta página ou navegar fora desta página cancelará seu upload.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Código do Vídeo");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Anexar um Arquivo");
	//Attention
	define("LANG_LABEL_ATTENTION", "Atenção");
	//Source
	define("LANG_LABEL_SOURCE", "Arquivo");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Horário de funcionamento");
	//Default
	define("LANG_LABEL_DEFAULT", "Padrão");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Método de Pagamento");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Por Cartão de Crédito");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "Por Paypal");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "Por SimplePay");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Por Pagseguro");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Imprimir Fatura");
	//Headline
	define("LANG_LABEL_HEADLINE", "Título");
	//Offer
	define("LANG_LABEL_OFFER", "Oferta");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Condições");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Datas da Oferta");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Imagem da Oferta");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Versão Impressa");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Nosso modelo padrão de Oferta");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Preencha os campos acima e insira uma logomarca ou outra imagem (JPG ou GIF)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Uma Oferta fornecida por você");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "imagem JPG ou GIF");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Título");
	//Comment
	define("LANG_LABEL_COMMENT", "Comentário");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Aceito");
	//Approved
	define("LANG_LABEL_APPROVED", "Aprovado");
	//Success
	define("LANG_LABEL_SUCCESS", "Sucesso");
	//Completed
	define("LANG_LABEL_COMPLETED", "Finalizado");
	//Y
	define("LANG_LABEL_Y", "S");
	//Failed
	define("LANG_LABEL_FAILED", "Falha");
	//Declined
	define("LANG_LABEL_DECLINED", "Recusado");
	//failure
	define("LANG_LABEL_FAILURE", "falha");
	//Canceled
	define("LANG_LABEL_CANCELED", "Cancelado");
	//Error
	define("LANG_LABEL_ERROR", "Erro");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "Código da Transação");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "ID da Subscrição");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "histórico de transações");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Código de Autorização");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "Status da Transação");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "Erro na Transação");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Valor Mensal da Conta");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "ID da Transação");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Valor Anual da Conta");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Valor da Conta");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "ID da Transação");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "ID do Recibo");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "ID da Subscrição");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "ID da Transação");
	//your
	define("LANG_LABEL_YOUR", "seu");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Faça Seu");
	//Payment
	define("LANG_LABEL_PAYMENT", "Pagamento");
	//History
	define("LANG_LABEL_HISTORY", "Histórico");
	//Sign in
	define("LANG_LABEL_LOGIN", "Entrar");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "Transação cancelada");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "Valor da transação");
	//Pay
	define("LANG_LABEL_PAY", "Pagar");
	//Back
	define("LANG_LABEL_BACK", "Voltar");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Preço Total");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Imprimir Fatura");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Administrador");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Informações do Pagamento");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Número do Cartão");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Data de Expiração do Cartão");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Código do Cartão");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Informações do Cliente");
	//zip
	define("LANG_LABEL_ZIP", "CEP");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Concluir e Continuar");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Informações Gerais");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Fone");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "Endereço de E-mail");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Informações do Cartão de Crédito");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Data de Exp.");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Informações do Cliente");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Expiração do Cartão");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Nome Impresso no Cartão");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Tipo de Cartão");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Número de Verificação do Cartão");
	//Province
	define("LANG_LABEL_PROVINCE", "Estado");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "CEP");
	//Post Code
	define("LANG_LABEL_POST_CODE", "CEP");
	//Tel
	define("LANG_LABEL_TEL", "Fone");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Selecione uma Data");
	//Found
	define("LANG_PAGING_FOUND", "Encontrado");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Encontrados");
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
	define("LANG_PAGING_GOTOPAGE", "Ir para página");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Selecione");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Ordenação por:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Caracteres");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Última Atualização");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Data de Criação");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popular");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Avaliação");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Preço");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "página anterior");
	//next page
	define("LANG_PAGING_NEXTPAGE", "próxima página");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "anterior");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "próxima");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Artigo adicionado com sucesso!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Banner adicionado com sucesso!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Classificado adicionado com sucesso!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Evento adicionado com sucesso!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Galeria adicionada com sucesso!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Empresa adicionada com sucesso!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Oferta adicionada com sucesso!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Artigo atualizado com sucesso!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Banner atualizado com sucesso!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Classificado atualizado com sucesso!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Evento atualizado com sucesso!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Galeria atualizada com sucesso!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Empresa atualizada com sucesso!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Oferta atualizada com sucesso!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Ajuste de Localização atualizado com sucesso!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Galeria alterada com sucesso!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Oferta removida com sucesso!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Oferta alterada com sucesso!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Banner removido com sucesso!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Tipo de imagem inválida. Por favor, insira uma imagem JPG, GIF ou PNG.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "O arquivo de imagem é muito grande.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Por favor tente novamente com uma outra imagem.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Arquivo anexado negado. Tipo de arquivo inválido.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "clique aqui para visualizar esta galeria");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Clique aqui para gerenciar as imagens desta galeria");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Por favor, digite seu e-mail.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-mail não encontrado.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Por favor, tente novamente ou entre em contato com o suporte:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Sistema de Recuperação de Senha está desabilitado.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Por favor, entre em contato com o suporte:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Obrigado!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Um e-mail foi enviado para o proprietário da conta com instruções para obter uma nova senha");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Arquivo não encontrado!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Erro! Sem Imagem!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "Nenhuma Imagem foi adicionada a esta galeria ainda!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Clique aqui para imprimir a fatura");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Clique aqui para ver os detalhes da fatura");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(o preço total é por prestações)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Item Pendente");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Nenhum pagamento necessário");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Coloque o mouse sobre as barras para ver mais detalhes sobre o gráfico)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Clique no tipo de relatório para exibir o gráfico)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Clique aqui para visualizar esta avaliação");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Clique aqui para editar esta avaliação");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Clique aqui para editar esta resposta");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Clique aqui para remover esta avaliação");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Avaliação esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Resposta esperando Aprovação do Administrador");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Avaliação e Resposta esperando Aprovação do Administrador");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Avaliação já Aprovada");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Avaliação e Resposta já Aprovadas");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Avaliação Pendente");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Resposta Pendente");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Avaliação Ativa");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Resposta Ativa");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Avaliação e Resposta Pendentes");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Avaliação e Resposta Ativas");
	//Reply
	define("LANG_REPLY", "Responder");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Resposta");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Avaliação e Resposta");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Editar Avaliação");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Editar Resposta");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Aprovar Avaliação");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Aprovar Resposta");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Resposta já Aprovada");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Avaliação atualizada com sucesso!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Resposta enviada com sucesso!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Por favor, escreva uma resposta válida!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Por favor, escreva um nome válido!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Por favor, escreva um e-mail válido!");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Por favor, escreva uma cidade, estado válido!");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Por favor, escreva um título válido!");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Por favor, escreva uma avaliação válida!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Por favor, escolha uma opção ou clique em cancelar para sair.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Clique aqui para responder esta avaliação");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "Clique aqui para ver a transação");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-mail deve ter entre");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "caracteres sem espaços.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "A senha deve ter entre");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Digite sua senha se você deseja alterá-la.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "A senha será enviada para o E-mail do Sócio.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Por favor, anote o seu e-mail e senha para futura referência.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Por favor, aceite os termos de uso.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Adicionada com sucesso!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Esta categoria já foi adicionada");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Por favor, selecione uma categoria válida");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Por favor, selecione uma categoria primeiro");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Você pode escolher um nome para a página ser acessada diretamente do navegador como uma página HTML estática. O nome escolhido para a página deve conter somente caracteres alfanuméricos (como \"a-z\" e/ou \"0-9\") e \"-\" ao invés de espaços.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "O nome \"John Auto Repair\" estará disponível através da url:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Imagens adicionais podem ser inseridas na");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "galeria de fotos (Se estiver habilitada).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "Tamanho máximo do arquivo");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Imagens .gif ou .png transparentes não são suportadas");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Gif animado não é suportado.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Por favor, certifique-se que as dimensões de sua imagem se adaptem com as dimensões dos pixels recomendadas, caso contrário a qualidade da imagem pode ser afetada.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Marque esta caixa para remover a imagem existente");
	//max 250 characters
	define("LANG_MSG_MAX_250_CHARS", "max 250 caracteres");
	//max 100 characters
	define("LANG_MSG_MAX_100_CHARS", "max 100 caracteres");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "caracteres restantes");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(incluindo espaços e quebras de linha)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "Adicione até");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "palavras-chave com no máximo 50 caracteres cada.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "Adicionar uma palavra-chave ou frase por linha. Por exemplo:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Selecione somente subcategorias que se enquadram diretamente em seu tipo.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Seu artigo aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "max 25 caracteres");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "max 500 caracteres");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "Tipos de arquivo permitidos");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Clique aqui para visualizar esta empresa");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Clique aqui para visualizar este evento");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Clique aqui para visualizar este classificado");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Clique aqui para visualizar este artigo");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Clique aqui para visualizar este banner");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Clique aqui para visualizar esta oferta");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Clique aqui para visualizar esta galeria");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "max 30 caracteres");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Selecione um País");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Selecione uma Região");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Selecione um Estado");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Selecione uma Cidade");
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Selecione um Bairro");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Estas informações não serão divulgadas)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Seu evento aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//If video snippet code was filled in, it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Se o código do vídeo for preenchido, ele aparecerá na página de detalhe");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Tamanho máximo suportado do código do vídeo");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Se o tamanho do código do vídeo for maior que o suportado, ele será modificado.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Anexo não tem legenda");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Marque esta caixa para remover o anexo existente");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Adicionar uma frase por linha. Por exemplo");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Categorias/subcategorias extras terão um custo");
	//additional
	define("LANG_MSG_ADDITIONAL", "adicional de");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "cada. Seja visto!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Sua empresa aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, sua empresa não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu artigo não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu classificado não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Se você adicionar novas categorias, seu evento não aparecerá na categoria principal das subcategorias adicionadas até que o administrador do site as aprove.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Solicite que sua empresa seja inserida nas classificações seguintes.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Clique aqui para selecionar uma data");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Clique no");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "ícone da galeria");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "abaixo se você deseja adicionar fotos à sua galeria.");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Clique no");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "ícone de Oferta");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "abaixo se você deseja adicionar Ofertas à sua empresa.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Você pode adicionar ofertas à sua empresa clicando no link");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "adicionar oferta");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Todas as páginas exceto as páginas dos items");
	//All pages
	define("LANG_ALLPAGES", "Todas as páginas");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Busca sem categoria");
	//deal
	define("LANG_ICONPROMOTION", "oferta");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "indique");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "+ favoritos");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "- favoritos");
	//print
	define("LANG_ICONPRINT", "imprimir");
	//map
	define("LANG_ICONMAP", "mapa");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Adicionar ao");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google maps não está disponível. Entre em contato com o administrador.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Remover");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Artigos Favoritos");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Classificados Favoritos");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Eventos Favoritos");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Empresas Favoritas");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Ofertas Favoritas");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Publicado em");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Mais Informações");
	//Date
	define("LANG_EVENT_DATE", "Data");
	//Time
	define("LANG_EVENT_TIME", "Hora");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Como chegar");
	//Website
	define("LANG_EVENT_WEBSITE", "Website");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Fone");
	//More
	define("LANG_EVENT_MORE", "Mais");
	//More Info
	define("LANG_EVENT_MOREINFO", "Mais Informações");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Veja todas as categorias");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Ver todas as categorias");
	//More Info
	define("LANG_LISTING_MOREINFO", "Mais Informações");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "ver fone");
	//view fax
	define("LANG_LISTING_VIEWFAX", "ver fax");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "envie um e-mail");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Clique aqui para ver mais informações!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Preencha o formulário abaixo para entrar em contato conosco.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Contactar esta Empresa");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Enviar pergunta");
	//phone
	define("LANG_LISTING_LETTERPHONE", "fone");
	//fax
	define("LANG_LISTING_LETTERFAX", "fax");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "website");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-mail");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "oferece os seguintes produtos e/ou serviços:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Horário de funcionamento");
	//Check in
	define("LANG_CHECK_IN", "Check in");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Nenhuma avaliação encontrada para este item!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Avaliações e comentários do último mês");
	//Review
	define("LANG_REVIEW", "Avaliação");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Avaliações");
	//Reviews
	define("LANG_REVIEWTITLE", "Avaliações");
	//review
	define("LANG_REVIEWCOUNT", "avaliação");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "avaliações");
	//check in
	define("LANG_CHECKINCOUNT", "check in");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "check ins");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Ver check ins");
	//Check ins of
	define("LANG_CHECKINSOF", "Check ins de");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Nenhum check in encontrado para este item!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "Categorias Relacionadas");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Subcategorias");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Ver avaliações");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Dê sua nota!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Seja o primeiro a avaliar!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "oferecida por");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Mais Informações");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Válido de");
	//to
	define("LANG_PROMOTION_VALIDTO", "até");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Imprimir");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Artigo");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Artigos");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Banner");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Banners");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "Classificado");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "Classificados");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Evento");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Eventos");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Empresa");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Empresas");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Oferta");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Ofertas");
	//Send
	define("LANG_BUTTON_SEND", "Enviar");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Cadastre-se");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Ver o Caminho da Categoria");
	//More info
	define("LANG_VIEWCATEGORY", "Mais informações");
	//No info found
	define("LANG_NOINFO", "Nenhuma informação encontrada");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Remover a Categoria");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Avançar");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Não, obrigado");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Sim, continue.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Não, Comprar sem o Pacote.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Aumente a sua visibilidade!");
	//Gift
	define("LANG_GIFT", "Brinde");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Ajude a Aumentar sua visibilidade, veja as ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "estatísticas do Site!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Visitantes por Mês");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Opção personalizada");
	//Ok
	define("LANG_BUTTON_OK", "Ok");
	//Cancel
	define("LANG_BUTTON_CANCEL", "Cancelar");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Entrar");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Salvar ajuste");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Limpar ajuste");
	//Next
	define("LANG_BUTTON_NEXT", "Próximo");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Pagar por Cartão de Crédito");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "Pagar por PayPal");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "Pagar por SimplePay");
	//Search
	define("LANG_BUTTON_SEARCH", "Buscar");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Avançada");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Fechar");
	//Clear
	define("LANG_BUTTON_CLEAR", "Limpar");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Adicione seu Artigo");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Adicione seu Classificado");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Adicione seu Evento");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Adicione sua Empresa");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Adicione sua Oferta");
	//Home
	define("LANG_BUTTON_HOME", "Home");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Gerenciar Conta");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "Gerenciar Conteúdo");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Área de Anunciante");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "Área Administrativa");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "Seção Administrativa");
	//Help
	define("LANG_BUTTON_HELP", "Ajuda");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Sair");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Enviar");
	//Update
	define("LANG_BUTTON_UPDATE", "Atualizar");
	//Back
	define("LANG_BUTTON_BACK", "Voltar");
	//Delete
	define("LANG_BUTTON_DELETE", "Remover");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "Completar o Processo");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Por favor, digite o código que está na imagem. Este campo é obrigatório para evitar o envio automático de e-mails.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Código de Verificação não pôde ser mostrado");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Código de Verificação");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Por favor, selecione uma nota para este item");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Fraude detectada! Por favor, selecione uma nota para este item!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "\"Comentário\" e \"Título\" são obrigatórios para enviar um comentário!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "\"Nome\" e \"E-mail\" são obrigatórios para enviar um comentário!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "\"Cidade, Estado\" são obrigatórios para enviar um comentário!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Por favor, digite um e-mail válido!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Você já deu sua opnião para este item. Obrigado.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Obrigado!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Sua avaliação foi enviada para aprovação.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Nenhum método de pagamento foi selecionado!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Data de expiração do cartão errada. Por favor, tente novamente.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Clique aqui para tentar novamente");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "As transações podem não ocorrer imediatamente.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Depois que seu pagamento for processado, informações sobre sua transação");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "podem ser encontradas em seu histórico de transações.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "podem ser encontradas em");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "O sistema de pagamento não está disponível no momento");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Os parâmetros de pagamento não puderam ser validados");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Foi encontrado um erro interno no pagamento");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "Informações sobre sua transação podem ser encontradas");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "em seu histórico de transação.");
	//in your
	define("LANG_MSG_IN_YOUR", "em seu");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "não há ID da Transação");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Falha no sistema, por favor, tente novamente.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Por favor, preencha todos os campos obrigatórios.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "não foi possível conectar.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Obrigado por adicionar seus itens e fazer o pagamento!");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "O administrador revisará seus itens e os colocará no ar dentro 2 dias úteis.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "O sistema de pagamento não pôde responder");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Pagamentos pendentes podem levar de 3 a 4 dias para serem aprovados.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Falha na Conexão");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Por favor, preencha corretamente o CEP.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Por favor, preencha corretamente o número de verificação do cartão.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Tipo de Cartão e Número de Verificação não coincidem.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "A Transação não foi completada.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Número do Erro:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Mensagem:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Mensagem:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "Transação Completada com Sucesso.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Data de expiração do cartão deve estar no futuro");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "Se a sua transação for confirmada, informações sobre ela poderão ser encontradas em");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "seu histórico de transação depois que seu pagamento for processado.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "depois que seu pagamento for processado.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Nenhum item requerendo pagamento.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Pagar por serviços extras");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "Banners por visualização e Serviços Extras podem ser pagos somente uma vez.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "Banners por visualização podem ser pagos somente uma vez.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Serviços Extras podem ser pagos somente uma vez.");
	//View Items
	define("LANG_VIEWITEMS", "Ver Itens");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Por favor não utilize sistema de pagamento recorrente.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Tente novamente!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Todos os campos são obrigatórios.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Você tem mais do que");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Por favor, entre em contato com o administrador para realizar o pagamento.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Opção de Artigo");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Autor");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "Website do autor");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Categorias do Artigo");
	//Banner Type
	define("LANG_BANNER_TYPE", "Tipo de Banner");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Opções de Banner");
	//Order Banner
	define("LANG_ORDER_BANNER", "Expiração do Banner");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Por período de tempo");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Detalhes do Banner");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Banner por Script");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Mostrar por Código");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Permite que um código seja inserido ao invés de uma imagem. Este campo permite que você cole um script que será utilizado para exibir o banner de um programa afiliado ou sistema externo de banner. Se \"Mostrar por Código\" estiver marcado, somente o campo \"Script\" será obrigatório. Os outros campos abaixo não serão necessários.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Ambos \"Url de Destino\" e \"Relatório de Tráfego - Website\" não terão efeito ao adicionar um banner por script.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "Ambos \"Url de Destino\" e \"Relatório de Tráfego - Website\" não terão efeito se você fizer upload de um arquivo swf");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "Nível do Classificado");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "Categoria do Classificado");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "Selecionar nível do classificado");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "Opções de Classificado");
	//Event Level
	define("LANG_EVENT_LEVEL", "Nível do Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Categorias do Evento");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Categorias do Evento");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Selecionar nível do evento");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Opções de Evento");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Nível da Empresa");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Tipo da Empresa");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Categorias da Empresa");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Classificações da Empresa");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Sujeito à aprovação do administrador.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Selecione esta opção");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Selecione o nível da empresa");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Opções de Empresa");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "O Sistema de Pagamento Authorize não está disponível no momento. Por favor, entre em contato com o");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "O Sistema de Pagamento iTransact não está disponível no momento. Por favor, entre em contato com o");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "O Sistema de Pagamento LinkPoint não está disponível no momento. Por favor, entre em contato com o");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "O Sistema de Pagamento PayFlow não está disponível no momento. Por favor, entre em contato com o");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "O Sistema de Pagamento PayPal não está disponível no momento. Por favor, entre em contato com o");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "O Sistema de Pagamento PayPalAPI não está disponível no momento. Por favor, entre em contato com o");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "O Sistema de Pagamento PSIGate não está disponível no momento. Por favor, entre em contato com o");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "O Sistema de Pagamento 2CheckOut não está disponível no momento. Por favor, entre em contato com o");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "O Sistema de Pagamento WorldPay não está disponível no momento. Por favor, entre em contato com o");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "O Sistema de Pagamento SimplePay não está disponível no momento. Por favor, entre em contato com o");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Aviso sobre o Upload");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Arquivo enviado com sucesso!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Extensão não permitida ou tipo errado de arquivo!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "O arquivo excedeu o tamanho permitido!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Falha ao tentar criar diretório!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Permissão errada!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Falha inesperada!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Arquivo não encontrado ou não informado!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Arquivo já existente!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Ver todas as localidades");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Localidades em Destaque");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "não existe nenhuma localicade em destaque no sistema.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Resumo");
	//Video
	define("LANG_LABEL_VIDEO", "Vídeo");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Localização no Mapa");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Mais Empresas");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Mais Eventos");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Mais Classificados");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Mais Artigos");
	//"Operation not allowed: The deal" (promotion_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "Operação não permitida: a oferta");
	//Operation not allowed: The deal (promotion_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "ja está associada a uma empresa");
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
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Clique em \"Adicionar\" para selecionar categorias");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Clique em \"Adicionar categoria principal\" ou \"Adicionar subcategorias\" para digitar suas novas categorias");
	//Add an
	define("LANG_ADD_AN", "Adicionar um(a)");
	//Add a
	define("LANG_ADD_A", "Adicionar um(a)");
	//on these sites
	define("LANG_ON_SITES", "nesses sites:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "neste site:");

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
	define("LANG_GALLERYTITLE", "Galeria de Fotos");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Clique aqui");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "ou nas fotos para iniciar o slideshow.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "mais fotos");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Código Promocional Inexistente");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "não está disponível.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "não está disponível para este tipo de item.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "não pode ser utilizado duas vezes.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "Você pode selecionar até");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "galeria.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galerias.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Título é obrigatório.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Idioma é obrigatório.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Nome é obrigatório.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Sobrenome é obrigatório.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Empresa é obrigatória.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Fone é obrigatório.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-mail é obrigatório.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Conta é obrigatória.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Nome da Página é obrigatório.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Categoria é obrigatória.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Resumo é obrigatório.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Tipo de expiração é obrigatório.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Data de Renovação é obrigatória.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "Visualizações é obrigatório.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Arquivo é obrigatório.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Tipo é obrigatório.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Legenda é obrigatória.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Código é obrigatório.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Descrição 1 é obrigatório.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Descrição 2 é obrigatório.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Nome é obrigatório.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Título da Oferta é requerido.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Oferta é obrigatória.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Data de Início é obrigatória.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Data de Término é obrigatória.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Texto é obrigatório.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-mail é obrigatório.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Senha Atual\" está incorreta.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "\"Senha\" é obrigatória.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Eu concordo com os termos de uso\" é obrigatório.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Os campos a seguir não foram preenchidos ou contêm erros:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Título - Por favor, preencha o campo");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Nome da Página - Por favor, preencha o campo");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "No máximo");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "categorias são permitidas.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "A URL Amigável já está em uso, por favor, escolha outra.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "O Nome da Página contém caracteres inválidos");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "No máximo");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "palavras-chave são permitidas");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Por favor, coloque palavras-chave com no máximo 50 caracteres cada");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Por favor, digite uma \"Data de Publicação\" válida.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Por favor, digite uma \"Data de Início\" válida.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Por favor, digite uma \"Data de Término\" válida.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "A \"Data de Término\" deve ser maior ou igual à \"Data de Início\".");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "A \"Hora de Término\" deve ser maior que a \"Hora de Início\".");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "A \"Data de Término\" não pode estar no passado.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Por favor, digite um e-mail válido.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Por favor, digite uma \"URL\" válida.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Por favor, forneça uma descrição com no máximo 255 caracteres.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Por favor, forneça uma condição com no máximo 255 caracteres.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Por favor, digite uma data de renovação válida.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "A data de renovação deve estar no futuro.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Por favor, digite uma data de expiração.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "A data de expiração deve estar no futuro.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "A senha não pode ter espaços.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Por favor, digite uma senha com no máximo");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Por favor, digite uma senha com no mínimo");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Por favor, digite um e-mail válido.");
	//Sorry, you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Desculpe, você não pode alterar as informações desta conta");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "A senha \"abc123\" não é permitida!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "As senhas não coincidem. Por favor, digite a mesma senha nos campos \"Senha\" e \"Confirme a Senha\".");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "O e-mail não pode ter espaços.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "O e-mail não pode ter caracteres especiais.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Por favor, digite um e-mail com no máximo");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Por favor, digite um e-mail com no mínimo");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Por favor, escolha um e-mail diferente.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Clique aqui se você não ver a sua categoria");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Adicionar categoria principal");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Adicionar subcategoria");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Categoria já registrada!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Categoria disponível!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Home");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Painel");
	//Manage
	define("LANG_MENU_MANAGE", "Gerenciar");
	//Add
	define("LANG_MENU_ADD", "Adicionar");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Anunciante - Opções");
	//Listings
	define("LANG_MENU_LISTING", "Empresas");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Adicionar Empresa");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Gerenciar Empresas");
	//Galleries
	define("LANG_MENU_GALLERY", "Galerias");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Adicionar Galeria");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Gerenciar Galeria");
	//Events
	define("LANG_MENU_EVENT", "Eventos");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Adicionar Evento");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Gerenciar Evento");
	//Banners
	define("LANG_MENU_BANNER", "Banners");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Adicionar Banner");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Gerenciar Banners");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "Classificados");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "Adicionar Classificados");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "Gerenciar Classificados");
	//Articles
	define("LANG_MENU_ARTICLE", "Artigos");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Adicionar Artigo");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Gerenciar Artigos");
	//Deals
	define("LANG_MENU_PROMOTION", "Ofertas");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Adicionar Oferta");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Gerenciar Ofertas");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "Anuncie Aqui");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Página não encontrada");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Página em manutenção");
	//FAQ
	define("LANG_MENU_FAQ", "FAQ");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Mapa do Site");
	//Contact Us
	define("LANG_MENU_CONTACT", "Contato");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Pagamento - Opções");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Pagar");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Faça seu Pagamento");
	//History
	define("LANG_MENU_HISTORY", "Histórico");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "Histórico de Transações");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Histórico de Faturas");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Escolha um Tema");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Escolha um Esquema de Cor");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Busca de Artigos");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "Busca de Classificados");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", "Busca de Eventos");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Busca de Empresas");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Busca de Ofertas");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Busca Avançada");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Procurar por");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Localidade");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Selecione um País");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Selecione uma Região");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "Selecione um Estado");	
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "Selecione uma Cidade");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Selecione um Bairro");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Categoria");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Selecione uma Categoria");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Filtro");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Sentença Exata");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Qualquer Palavra");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Todas as Palavras");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Tipo de Empresa");
	//from
	define("LANG_SEARCH_LABELFROM", "de");
	//to
	define("LANG_SEARCH_LABELTO", "até");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "do");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Busca por Palavra-Chave ");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Procurar");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Por favor, forneça apenas palavras com pelo menos [FT_MIN_WORD_LEN] letras para a busca!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Destaque");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "Novos Artigos");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Próximos Eventos");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Destaque: Classificados");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Destaque: Artigos");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Destaque: Empresas");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Destaque: Ofertas");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Ver todos os artigos");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Ver todos os eventos");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Ver todos os classificados");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Ver todas as empresas");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Ver todas as ofertas");
	//Last Tweets
	define("LANG_LAST_TWEETS", "Últimos Tweets");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Fácil e Rápido.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Passos");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Passos");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Cadastro");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Editar Empresa");
	//Order
	define("LANG_ORDER", "Cadastro");
	//Check Out
	define("LANG_CHECKOUT", "Pagamento");
	//Configuration
	define("LANG_CONFIGURATION", "Configuração");
	//Select a level
	define("LANG_SELECTPACKAGE", "Selecione um nível");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Opções de Perfil");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Conta do Diretório");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Minha conta do OpenID 2.0");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Minha conta do Facebook");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Minha conta do Google");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Você já tem uma conta?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Não, sou um Novo Usuário.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Sim, já tenho uma Conta.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Entrar com minha conta existente do Diretório.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Entrar com minha conta do OpenID 2.0.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Entrar com minha conta do Facebook.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Entrar com minha conta do Google.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Informações da Conta");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Informações Adicionais");
	//Please write down your username and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "Por favor, anote o seu e-mail e senha para futura referência.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "O e-mail deve ser um e-mail válido entre ");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "e");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "caracteres sem espaços.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "A senha deve ter entre");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "e");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "caracteres sem espaços.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Eu concordo com os termos de uso");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Gostaria de anunciar conosco?");
	//Buy a link
	define("LANG_BUY_LINK", "Anuncie também");
	//Back to Top
	define("LANG_BACKTOTOP", "Voltar para o topo");
	//Back to
	define("LANG_BACKTO", "Voltar para ");
	//Favorites
	define("LANG_QUICK_LIST", "Favoritos");
	//view summary
	define("LANG_VIEWSUMMARY", "ver resumo");
	//view detail
	define("LANG_VIEWDETAIL", "ver detalhes");
	//Advertisers
	define("LANG_ADVERTISER", "Publicidade");
	//Order Now!
	define("LANG_ORDERNOW", "Cadastre-se!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Aguarde, Carregando...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Subtotal");
	//Subtotal
	define("LANG_SUBTOTAL", "Subtotal");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Total de Impostos");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Preço Total");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoritos");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Nenhum item favorito encontrado!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "Resultados da busca por");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "Busca Relacionada");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Procure por Seção");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Palavra-Chave");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Digite uma palavra-chave");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Palavra-chave ou nome da empresa");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Palavra-chave ou título da oferta");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Palavra-chave ou título do evento");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Palavra-chave ou título do classificado");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Palavra-chave ou título do artigo");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Onde");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Endereço, Cidade, Estado ou CEP)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Procurando sua localização...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Preencha o formulário abaixo para entrar em contato conosco.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mensagem");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Nenhuma categoria desabilitada encontrada no sistema.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Nenhuma categoria encontrada.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Por favor, selecione uma categoria válida");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Por favor, selecione uma categoria primeiro!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Ver o Caminho da Categoria");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Remover a Categoria");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Categorias/subcategorias extras terão um custo");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "adicional de");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "cada. Seja visto!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "Máximo de");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "categorias permitidas.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Categorias e Subcategorias");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Selecione somente subcategorias que se enquadram diretamente em sua empresa.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Sua empresa aparecerá automaticamente na categoria principal de cada subcategoria que você selecionar.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Informações da Conta Possuem Erros");
	//Contact Information
	define("LANG_CONTACTINFO", "Informações de Contato");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Estas informações não serão divulgadas.");
	//Billing Information
	define("LANG_BILLINGINFO", "Informações da Fatura");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Estas informações não serão divulgadas.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Você irá configurar seu artigo após fazer o cadastro.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Você irá configurar seu banner após fazer o cadastro.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Você irá configurar seu classificado após fazer o cadastro.");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Você irá configurar seu evento após fazer o cadastro.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Você irá configurar sua empresa após fazer o cadastro.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Informações da Fatura Possuem Erros");
	//Article Information
	define("LANG_ARTICLEINFO", "Informações do Artigo");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Informações do Artigo Possuem Erros");
	//Banner Information
	define("LANG_BANNERINFO", "Informações do Banner");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Informações do Banner Possuem Erros");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "Informações do Classificado");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "Informações do Classificado Possuem Erros");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Procure Eventos por Data");
	//Event Information
	define("LANG_EVENTINFO", "Informações do Evento");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Informações do Evento Possuem Erros");
	//Listing Information
	define("LANG_LISTINGINFO", "Informações da Empresa");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Informações da Empresa Possuem Erros");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Solicite esta Empresa");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", "Tipo da Empresa");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Nenhum resultado foi encontrado com o seu critério de busca.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Por favor, tente novamente ou procure por seção.");
	//Sometimes you may receive no results for your search because the keyword you used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Algumas vezes sua busca pode não retornar resultados porque a palavra-chave utilizada foi muito genérica. Tente fazer uma nova busca usando uma palavra-chave mais específica.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Por favor, digite pelo menos uma palavra-chave no formulário de busca.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Desculpe!</h1><p>Sua pesquisa não trouxe resultados. Embora não seja comum, isso pode acontecer se o termo de pesquisa que você usou é muito genérico ou quando nós realmente não temos conteúdo correspondente.</p><h2>Sugestões:</h2>Seja mais específico nos termos da sua pesquisa.<br />Verifique a ortografia.<br />Se você não conseguir encontrar através da busca, tente navegar por seção.<br /><br /><p>Se você acredita que chegou aqui por engano, por favor contacte o administrador do site para relatar um problema <a href=\"[EDIR_LINK_SEARCH_ERROR]\">aqui</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Imagem");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "de");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Erro ao carregar imagem");
	//Next
	define("LANG_SLIDESHOW_NEXT", "Próxima");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Pausar");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Play");
	//Back
	define("LANG_SLIDESHOW_BACK", "Anterior");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "Sua mensagem foi enviada. Obrigado.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Ocorreu um problema ao tentar enviar seu e-mail. Por favor, tente novamente.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Por favor, digite seu nome.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Por favor, digite um e-mail válido.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Por favor, digite a mensagem.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Por favor, digite o código de verificação corretamente.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Por favor, corrija os itens e tente novamente.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "Por favor, digite um nome!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Por favor, digite um assunto!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "ALGUNS DETALHES");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Por favor, digite um e-mail válido no campo \"Para\"");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND2", "Por favor, digite um e-mail válido no campo \"De\"");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Item não encontrado. Por favor, retorne para");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "e tente novamente.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Por favor, digite um e-mail válido no campo \"Seu E-mail\"");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "do");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Sobre");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "do");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Enviar informações sobre este artigo para um amigo");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Enviar informações sobre este classificado para um amigo");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Enviar informações sobre este evento para um amigo");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Enviar informações sobre esta empresa para um amigo");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Enviar informações sobre esta oferta para um amigo");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mensagem enviada por ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Esta é uma mensagem automática.");
	//Contact
	define("LANG_CONTACT", "Entrar em contato com");
	//article
	define("LANG_ARTICLE", "artigo");
	//classified
	define("LANG_CLASSIFIED", "classificado");
	//event
	define("LANG_EVENT", "evento");
	//listing
	define("LANG_LISTING", "empresa");
	//deal
	define("LANG_PROMOTION", "oferta");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Por favor, busque por pelo menos um parâmetro no formulário de busca!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Por favor, tente sua busca novamente.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Nenhum artigo registrado ainda.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Nenhum classificado registrado ainda.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Nenhum evento registrado ainda.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Nenhuma empresa registrada ainda.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Nenhuma oferta registrada ainda.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mensagem enviada através do");
	//E-mail Form
	define("LANG_EMAILFORM", "Formulário de E-mail");
	//Click here to print
	define("LANG_PRINTCLICK", "Clique aqui para imprimir");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Localização");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Mais Classificados");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Location
	define("LANG_EVENT_LOCATIONS", "Localização");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Destaque: Eventos");
	//events
	define("LANG_EVENT_PLURAL", "eventos");
	//Search results
	define("LANG_SEARCHRESULTS", "Resultados da busca");
	//Results
	define("LANG_RESULTS", "Resultados");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "por");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "em");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "em");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "em");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "na categoria");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "em");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "no");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "para");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Página");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "Avaliações Recentes");
	//Reviews of
	define("LANG_REVIEWSOF", "Comentários de");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Avaliações estão desabilitadas");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Ver todas as categorias");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Ver todas as categorias");
	//Offer
	define("LANG_PROMOTION_OFFER", "Oferta");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Descrição");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Condições");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Localização");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Item não encontrado!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Item não disponível!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Resultados da Busca por Empresas");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Resultados da Busca por Ofertas");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Resultados da Busca por Eventos");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "Resultados da Busca por Classificados");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Resultados da Busca por Artigos");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Idiomas Disponíveis");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Você pode escolher até ".MAX_ENABLED_LANGUAGES." dos idiomas abaixo para o seu diretório.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Aproveite nossos serviços!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Remover relação com");
	//Welcome
	define("LANG_LABEL_WELCOME", "Bem-vindo(a)");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Anunciante - Opções");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Voltar ao Website");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Adicionar Nova Conta");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Recuperação de senha");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Clique aqui");
	//Help
	define("LANG_LABEL_HELP", "Ajuda");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Redefinir Senha");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Informações de Conta e Contato");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Notificação de Cadastro");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Ir para a página de acesso");
	//Order
	define("LANG_LABEL_ORDER", "Cadastro");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Pagamento");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Configuração");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Por favor, digite a URL do site antes.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "Validação falhou! Por favor, tente novamente.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Site validado com sucesso!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Gere Tráfego");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "Por favor, observe que você pode alterar esse código como quiser, desde que você mantenha a URL exatamente como mostrado aqui, caso contrário o seu backlink não será validado.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink não foi validado. Por favor, tente novamente.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Selecione esta caixa para remover o backlink desta empresa.");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "URL do Backlink");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "URL onde o backlink foi instalado.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Por favor, informe a URL do Backlink.");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Backlink indisponível para esta empresa");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Adicionar um Backlink");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Coloque isto no seu site (código HTML):");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Digite a URL do seu site:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Ex: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Clique no botão para confirmar o seu Backlink");
	//Verify
	define("LANG_LABEL_VERIFY", "Verificar");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Por que acrescentar um Backlink?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Adicionando um link no seu site apontando para este, a relevância deste site aumentará e por sua vez, a relevância da sua empresa.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "Qual minha vantagem?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "Ao dar-nos um link na página inicial do seu site, você nos ajuda com a nossa classificação e, portanto, seus resultados. Assim como você nos ajuda, nós iremos ajudá-lo. Se você adicionar um link, uma vez que verificarmos que ele existe, vamos mostrar sua empresa com um estilo especial na página de resultados, assim você realmente terá exposição extra no diretório - os dois lados ganham.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "Como posso fazer isso?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Muito simples, copie o código acima no código do seu site em algum lugar de destaque na página inicial, informe a URL do seu site (onde está o link) e vamos verificá-lo depois que você clicar em \"Verificar\" - depois é só continuar .... super simples.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "Não, continuar sem Backlink.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Sim, adicionar Backlink");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Backlink adicionado à sua empresa com sucesso!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Você não tem nenhuma empresa para adicionar backlink ainda.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Visualizar Backlink");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Detalhes da Categoria");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Administrador");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Página de Resumo");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Página de Detalhe");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Galeria de Fotos");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Adicionar Banner");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Informações da Imagem da Galeria");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Imagens da Galeria");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Gerenciar Imagens da Galeria");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Gerenciar Galerias");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "Galeria não existe!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "Galeria indisponível!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Título do Serviço Adicional");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Itens do Serviço Adicional");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Fácil e Rápido.");
	//Steps
	define("LANG_LABEL_STEPS", "Passos");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Cadastro");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Selecione um Nível");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Status do Pagamento");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Expiração");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Adicionar Nova Galeria");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Adicionar uma nova galeria");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Nova Oferta");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Adicionar uma nova oferta");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Gerenciar Faturas");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Clique aqui se você já tem sua senha.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Não é anunciante?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "para informação sobre o cadastro de seu item no");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Bem-vindo(a) à Seção de Anunciante");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Bem-vindo(a) à Seção de Sócios");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Conta bloqueada. Aguarde");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "minuto(s) e tente novamente.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Um ou mais campos obrigatórios não foram preenchidos. Por favor, confirme se todas as informações requeridas foram inseridas antes de continuar");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Você não tem permissão de acesso neste endereço IP!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Sua conta foi desativada!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Desculpe, seu e-mail ou senha está incorreto.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Desculpe, conta errada.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Desculpe, para sua proteção o link enviado para seu e-mail expirou. Se você esqueceu sua senha, clique no link abaixo.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "O servidor do OpenID não está disponível!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "Erro ao requisitar o servidor do OpenID!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "Requisição do OpenID cancelada!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Requisição do Google cancelada!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Identificação do OpenID inválida!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Esqueceu sua senha?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "O que é OpenID?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "O que é Facebook?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "O que é Google?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Conta atualizada com sucesso!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Senha atualizada com sucesso!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "Obrigado por criar uma conta no");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Utilize o usuário e senha abaixo para gerenciar sua conta.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Você pode ver");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "Sua conta em");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Este artigo mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Este classificado mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Este evento mostrará");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Esta empresa mostrará");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "no máximo");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "imagem");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "imagens");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "na galeria");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " mais uma imagem principal.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "ou Relacionar uma galeria existente com este artigo");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "ou Relacionar uma galeria existente com este classificado");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "ou Relacionar uma galeria existente com este evento");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "ou Relacionar uma galeria existente com esta empresa");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Clique aqui para pagar por seu artigo");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Clique aqui para pagar por seu banner");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Clique aqui para pagar por seu classificado");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Clique aqui para pagar por seu evento");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Clique aqui para pagar por sua empresa");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Artigos são ativados pelo");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Banners são ativados pelo");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Classificados são ativados pelo");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Eventos são ativados pelo");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Empresas são ativadas pelo");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "somente depois que o processo estiver completo.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Dicas para o Ajuste de Localização");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Você pode ajustar a posição no mapa,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "com mais exatidão.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Use os controles \"+\" e \"-\" para ajustar o zoom do mapa.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Use as flechas para navegar no mapa.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Arraste e solte o marcador para ajustar a localização.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "Sua oferta aparecerá aqui");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Relacionar uma oferta existente com esta empresa");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Nenhum resultado encontrado!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Acesso não permitido!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Os seguintes problemas foram encontrados");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Nenhum item selecionado ou requerendo pagamento.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Nenhum item encontrado.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Não há faturas no sistema.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Não há transações no sistema.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Solicite esta Empresa");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Ir à área de pagamento da seção de anunciante");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Você pode ver sua fatura em");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Eu concordo com os termos de uso");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "e vou enviar o pagamento.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Esta página redirecionará você à seção de anunciante em alguns segundos.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Esta página redirecionará você para continuar o processo de cadastro em alguns segundos.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Se não funcionar, por favor,");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Gerenciar Artigo");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Gerenciar Banner");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "Gerenciar Classificados");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Gerenciar Evento");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Gerenciar Empresa");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Gerenciar Oferta");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Gerenciar Fatura");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Gerenciar Faturas");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "Gerenciar Transações");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Não há artigos no sistema.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Não há banners no sistema");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Não há classificados no sistema.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Não há eventos no sistema");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "Não há galerias no sistema.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Não há empresas no sistema.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Não há ofertas no sistema.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Nenhum Relatório Disponível.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Nenhum artigo encontrado. Ele pode ter sido removido.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Nenhum classificado encontrado. Ele pode ter sido removido.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Nenhuma empresa encontrada. Ela pode ter sido removida.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Informação do Artigo");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Remover Artigo");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Remover Informações do Artigo");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Você tem certeza que deseja remover este artigo?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Galeria do Artigo");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Visualizar Artigo");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Relatório de Tráfego do Artigo");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Detalhes do Artigo");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Editar Informações do Artigo");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Remover Banner");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Remover Informações do Banner");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Você tem certeza que deseja remover este banner?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Editar Banner");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Editar Informação do Banner");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Visualizar Banner");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Relatório de Tráfego do Banner");
	//View Banner
	define("LANG_VIEW_BANNER", "Visualizar Banner");
	//Disabled
	define("LANG_BANNER_DISABLED", "Desabilitado");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "Informação do Classificado");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "Remover Classificado");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Seu classificado irá aparecer na categoria principal de cada subcategoria que você selecionar.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "Categorias do Classificado");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "Categorias do Classificado");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "Remover Informações do Classificado");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Você tem certeza que deseja remover este classificado?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "Galeria do Classificado");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "Ajustar Localização do Classificado");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "Visualizar Classificado");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "Relatório de Tráfego do Classificado");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "Detalhes do Classificado");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "Editar Informações do Classificado");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "Editar Nível do Classificado");
	//Delete Event
	define("LANG_EVENT_DELETE", "Remover Evento");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Remover Informações do Evento");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Você tem certeza que deseja remover este evento?");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Informações do Evento");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Galeria do Evento");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Ajustar Localização do Evento");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Visualizar Evento");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Relatório de Tráfego do Evento");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Detalhes do Evento");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Editar Informações do Evento");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Galeria da Empresa");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Informações da Empresa");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Ajustar Localização da Empresa");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Visualizar Empresa");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Oferta da Empresa");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "A oferta é acessada a partir da empresa");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Para estar ativa, a oferta");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "deve ter uma data de término no futuro.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "deve estar relacionada com uma empresa.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Relatório de Tráfego da Empresa");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Detalhes da Empresa");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "para a empresa");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Editar Empresa");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Remover Oferta");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Remover Informações da Oferta");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Você tem certeza que deseja remover esta Oferta?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Visualizar Oferta");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Informações da Oferta");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Detalhes da Oferta");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Editar Informações da Oferta");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Remover Galeria");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Remover Informação da Galeria");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Você tem certeza que deseja remover esta galeria? Todas as informações da galeria, fotos e relacionamentos serão removidos.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Remover Imagem da Galeria");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Informações da Galeria");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Visualizar Galeria");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Detalhes da Galeria");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Editar informações da Galeria");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Gerenciar Imagens");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Remover Imagem");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Imagem removida com sucesso!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Detalhes da Avaliação");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Visualizar Avaliação");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Detalhes da Fatura");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Fatura não encontrada para esta conta.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Notificação de Fatura");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "Detalhes da Transação");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Transação não encontrada para esta conta.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Entrar com minha conta do Diretório");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "Entrar com minha conta do OpenID 2.0");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Entrar com minha conta do Facebook");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Entrar com minha conta do Google");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." já registrado!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Esta conta está disponível.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Erro no envio da imagem. Por favor, tente de novo.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Imagem enviada com sucesso!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Imagem alterada com sucesso!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Apagar Imagem");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Tem certeza que deseja apagar esta imagem?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Editar Imagem");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Tornar principal");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Principal");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Clique aqui para salvar como imagem principal");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Clique aqui para salvar como imagem da galeria");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Pacotes");
	//Package
	define("LANG_PACKAGE_SING", "Pacote");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Cobrança do pacote ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Perfil atualizado com sucesso!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Opções de Anunciante");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "Meus Amigos");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Amigos para Aprovar");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "Aceitação em Pendência");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Habilitar Perfil do Usuário");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "Conheça pessoas, encontre clientes para suas ofertas e muito mais!");
	//Profile
	define("LANG_LABEL_PROFILE", "Perfil");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Opções do Perfil");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Editar Perfil");
	//Friends
	define("LANG_LABEL_FRIENDS", "Amigos");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Ver Amigos");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Gerenciar Amigos");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Carregar imagem do seu Facebook.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Informações Pessoais");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Apelido");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Conta do Twitter");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Sobre Mim");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Data de Aniversário");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Cidade Natal");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Livros Favoritos");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Filmes Favoritos");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Esportes Favoritos");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Músicas Favoritas");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Comidas Favoritas");
	//Settings
	define("LANG_LABEL_SETTINGS", "Configurações");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Ver todos os amigos");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Todos os Amigos");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Remover amigo");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Adicionar amigo");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Aceitar");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Negar");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Tornar-se um Anunciante");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Registre-se e comece a promover sua empresa hoje , de graça!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "O que posso fazer?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Mensagens");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Você tem certeza?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "A página pessoal com o nome \"john-smith\" estará disponível através da URL:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Sua URL:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "Sua URL contém caracteres inválidos.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL já em uso, escolha outra URL.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Você não tem amigos.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Amigo removido com sucesso.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Amigo aprovado com sucesso.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Amigo negado com sucesso.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Requisição de amigo cancelada com sucesso.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Ver todos");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Ver todas");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "Nenhum Amigo");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Nenhum Item");
	//Share
	define("LANG_LABEL_SHARE", "Compartilhar");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Compartilhar Todos");
	//Comments
	define("LANG_LABEL_COMMENTS", "Comentários");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Meu Perfil");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Perfil do Usuário habilitado com sucesso!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "Publicar minhas informações de contato");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Criar minha página pessoal");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Página Pessoal");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Avaliações de Artigos");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Avaliações de Empresas");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Avaliações Apagadas com Sucesso.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Nenhuma avaliação encontrada!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Editar meu Perfil");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Voltar ao meu Perfil");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "Membro Desde");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Configurações da Conta");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Ofertas Validadas");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoritos");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Você não tem permissão para acessar esta área.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Ir para o seu Profile.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Minha Página Pessoal");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Usar esta Conta");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Página Pessoal");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Crie o seu Perfil");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Apelido é obrigatório.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Tenha certeza de que a conta do twitter que você está adicionando não esteja protegida. Se a conta do twitter estiver protegida os últimos tweets desta conta não serão mostrados.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Seu item já foi pago, portanto você pode adicionar no máximo [max] categorias grátis.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Seu item já foi pago, portanto você pode adicionar no máximo [max] categoria grátis.");
	
	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Apenas imagens ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "são aceitas para envio!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Imagens devem ter menos que ");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Selecione uma imagem para enviar!");
	//Original image
	define("LANG_ORIGINAL", "Imagem original");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Miniatura");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Legendas");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Você pode adicionar no máximo ");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " fotos na sua galeria!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Criar miniatura");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Visualizar miniatura");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Seu item já possui o número máximo de imagens na galeria. Para salvar a nova imagem, exclua uma das já existentes.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Evento Recorrente");
	//Repeat
	define("LANG_PERIOD", "Repetição");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Escolha uma opção");
	//Daily
	define("LANG_DAILY", "Diário");
	//Weekly
	define("LANG_WEEKLY", "Semanal");
	//Monthly
	define("LANG_MONTHLY", "Mensal");
	//Yearly
	define("LANG_YEARLY", "Anual");
	//Daily
	define("LANG_DAILY2", "Diariamente");
	//Weekly
	define("LANG_WEEKLY2", "Semanalmente");
	//Monthly
	define("LANG_MONTHLY2", "Mensalmente");
	//Yearly
	define("LANG_YEARLY2", "Anualmente");
	//every
	define("LANG_EVERY", "Todo(a)");
	//every
	define("LANG_EVERY2", "Todo");
	//of
	define("LANG_OF", "do(a)");
	//of
	define("LANG_OF2", "de");
	//of
	define("LANG_OF3", "da");
	//of
	define("LANG_OF4", "do");
	//Week
	define("LANG_WEEK", "Semana");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Escolha o Mês");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Escolha o Dia");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Escolha a Semana");
	//First
	define("LANG_FIRST", "Primeiro(a)");
	//Second
	define("LANG_SECOND", "Segundo(a)");
	//Third
	define("LANG_THIRD", "Terceiro(a)");
	//Fourth
	define("LANG_FOURTH", "Quarto(a)");
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
	define("LANG_RECURRING", "Recorrente");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Por favor, selecione um dia da semana.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Por favor, informe o dia.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Por favor, selecione o mês.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Por favor, selecione a semana.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Por favor, selecione uma opção de Repetição.");
	//When
	define("LANG_EVENT_WHEN", "Quando");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Dia deve ser um número.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Dia deve estar entre 1 e 31.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Dia não coincide com o período selecionado.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Mês não coincide com o período selecionado.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Dias não coincidem com o período selecionado.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Semana não coincide com o período selecionado.");
	//No info
	define("LANG_EVENT_NO_INFO", "Sem informação");
	//Ends on
	define("LANG_ENDS_IN", "Termina em");
	//Never
	define("LANG_NEVER", "Nunca");
	//Until
	define("LANG_UNTIL", "Até");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Até");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Até\" deve ser maior ou igual à \"Data de Início\".");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Até\" não pode estar no passado.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Começa em");
	//Repeats
	define("LANG_EVENT_REPEATS", "Repete");
	//Ends on
	define("LANG_EVENT_ENDS", "Termina em");
	//weekend
	define("LANG_EVENT_WEEKEND", "final de semana");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "dia útil");
	//the month
	define("LANG_THE_MONTH", "mês");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
	//Site
	define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Nome do site");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Clique aqui para visualizar este site");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Clique aqui para remover este site");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site excluído com sucesso!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site adicionado com sucesso!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Uma notificação de email foi enviada para o time de suporte do eDirectory, por favor aguarde nosso contato.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Nome do site é requerido");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "URL do site é requerida");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Nome do site já existe");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "URL do site já existe");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "URL do site não é válida");
	//Site Items
	define("LANG_SITE_ITEMS", "Itens do Site");

	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Informações do Perfil");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Rede(s) Social(is)");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Associar e importar informações");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Apenas associar");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Associar à minha conta do Facebook");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Desassociar minha conta do Facebook");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Sua conta foi desassociada do Facebook");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Sua conta do Facebook já está associada a outra conta no sistema.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Sua conta do Twitter já está associada a outra conta no sistema.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Conectado ao Twitter como");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "Conectado como");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Opções de localidade");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Escolha sua localidade de preferência");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Usar sua localidade atual");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Usar localidade do Facebook");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Conectar ao Facebook");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Conta do Facebook");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Conta do Google");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Mudar a conta");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Conta do Twitter");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Conexão com Twitter");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Associar à minha conta do Twitter");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Desassociar minha conta do Twitter");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Publicar validações diretamente na minha conta do Twitter");
	//Your account was unlinked from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Sua conta foi desassociada do Twitter");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Você precisa conectar no Twitter primeiro");
	//Your Twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Sua conta do Twitter foi conectada com sucesso");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Sua conta do Facebook foi conectada com sucesso");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Você já está conectado no Facebook como");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Esse usuário já esta conectado com outra conta.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Clique aqui para trocar essa conta");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Conectar ao Facebook");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Use este idioma a cada vez que entrar na minha conta");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_TAG_POSTING", "Relacione com uma empresa");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Gostei disso");
	//Redeem
	define("DEAL_REDEEM", "Validar");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Validar esta oferta");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Para validar, você precisa publicar essa informação no seu Facebook ou Twitter.");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Você pode configurar este botão para fazer automaticamente a publicação no seu perfil.");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Clique aqui para configurá-lo");
	//Please wait, posting on Facebook and Twitter (if available).
	define("DEAL_PLEASEWAIT_POSTING", "Por favor aguarde, publicando no Facebook e/ou Twitter (se disponível).");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Você já validou esta oferta! Seu código é");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Oferta concluída! Este é seu código:");
	//No one has redeemed this deal  on Facebook yet.
	define("DEAL_REDEEM_NONE_FB", "Ninguém validou esta oferta no Facebook ainda.");
	//No one has redeemed this deal  on Twitter yet.
	define("DEAL_REDEEM_NONE_TW", "Ninguém validou esta oferta no Twitter ainda.");
	//Recent done deals
	define("DEAL_RECENTDEALS", "Ofertas validadas recentemente");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Nenhuma oferta encontrada!");
	//This deal is not available anymore.
	define("DEAL_NA", "Esta oferta não está mais disponível.");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it.
	define("DEAL_REDEEMINFO_1", "Para validar esta oferta você precisa publicar no seu mural do Facebook. Primeiro entre utilizando sua conta do Facebook e aprove nossa aplicação para funcionar no seu perfil.");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Você já validou esta oferta!");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Desculpe, houve um erro na tentativa de publicar no seu mural do Facebook. Por favor, tente novamente.");
	//Value
	define("DEAL_VALUE", "Valor");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Com esta oferta");
	//Thank you
	define("DEAL_THANKYOU", "Obrigado");
	//Original value
	define("DEAL_ORIGINALVALUE", "Valor original");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Valor pago");
	//Valid until
	define("DEAL_VALIDUNTIL", "Valido até");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "O código deve ser mostrado para validar o desconto");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Limite de uma oferta por compra");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Não válido para outras ofertas ou outros descontos");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Válido apenas para itens relacionados à ofertas");
	//Print deal
	define("DEAL_PRINTDEAL", "Imprimir Oferta");
	//deal done
	define("DEAL_DEALSDONE", "Oferta Concluída");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Ofertas Concluídas");
	//Left
	define("DEAL_LEFTAMOUNT", "Restantes");
	//SOLD OUT
	define("DEAL_SOLDOUT", "Vendido");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Desculpe, esta oferta não existe ou foi removida pelo proprietário");
	//at
	define("DEAL_AT", "em");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Endereço amigável");
	//Select a listing
	define("DEAL_SELECTLISTING", "Selecione uma empresa");
	//Tagline for Deals
	define("DEAL_TAG", "Mensagem no mural do Facebook");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Visibilidade");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Esta oferta vai aparecer em");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "buscas gerais e aproximadas");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "24 horas / dia");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Período específico");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "Informação de desconto");
	//Deal value
	define("LANG_SITEMGR_ITEMVALUE", "Valor do Item");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "Desconto");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "Valor com desconto");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Quantidade de ofertas");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "oferta finalizada até agora");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "ofertas finalizadas até agora");
	//left
	define("LANG_SITEMGR_LEFT", "restantes");
    //OFF
    define("LANG_DEAL_OFF", "OFF");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Por favor aguarde, carregando...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Por favor aguarde. Estamos redirecionando sua conta para finalizar esse passo...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Valor do Item é requerido.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." é requerido.");
	//Value with Discount can not be higher than 99.
    define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." não pode ser superior a 99.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Ofertas a oferecer é requerida.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", "Por favor insira um número menor no campo ".LANG_LABEL_DISC_AMOUNT);
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Validado em");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Você só poderá relacionar a oferta com uma empresa se escolher uma conta primeiro");
    //Value
    define("DEAL_VALUE", "Valor");
    //With discount
    define("DEAL_WITHCOUPON", "Com desconto");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "Validar por e-mail");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Entrar e Validar");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Validar e Imprimir");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Validar e Compartilhar");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Ofertas em Destaque");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Entrar usando sua conta atual do Facebook");
	//To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Para validar pelo Facebook você precisa logar usando sua conta do Facebook.");
    //Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Estatísticas de Validações");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Código de validação");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Disponível");
    //Used
    define("DEAL_SITEMGR_USED", "Usado");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Validar usando a conta do seu Facebook");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Configuração salva.");
    //There was a problem saving, try again please.
    define("NAVBAR_SAVED_MESSAGE2", "Ocorreu um problema. Por favor tente novamente.");
	//At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "Pelo menos um item é requerido.");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Você não pode salvar URLs repetidas.");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Você não pode salvar itens vazios.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "Você não pode salvar o cabeçalho ou o rodapé vazios.");
    //Use
    define("DEAL_SITEMGR_USE", "Usar");
	//Saving...
	define("LANG_DEAL_SAVING", "Salvando...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Nenhuma validação encontrada.");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "porcentagem");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "valor fixo");

	# ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label.
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Favor digitar um nome.");
	//Please enter an URL.
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Favor digitar uma URL.");
	//Add new item to menu
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Adicionar item");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Novo item");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Módulo");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Conteúdo do Site");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Novo");
	//Save & Close
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Salvar");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Salvar Item");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Nome");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Usar");
	//Please select one module or hit close to cancel.
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Selecione o módulo ou clique em fechar para cancelar.");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Desculpe, não há páginas personalizadas para escolher.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Criar um novo conteúdo personalizado");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Crie páginas personalizadas na área de conteúdo de páginas");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Usar URL de módulo");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Usar URL personalizada");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Edite, adicione, remova ou altere a ordem dos itens na seção abaixo:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Navegação");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Navegação do Rodapé");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Cancelar a inclusão deste item?");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Restaurar itens");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Validar sem Facebook");
    //Don't have Facebook? Sign using your account.
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Você não tem Facebook? Entre usando sua conta.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Mudar Site");
    //Apenas
    define("LANG_ONLY2", "Apenas");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Oferta");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Ofertas");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Avaliações de Ofertas");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "postada no Facebook e Twitter");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "postada no Facebook");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "postada no Twitter");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Postada no");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "oferta finalizada");
	//deal opened
	define("LANG_DEAL_OPENED", "oferta em aberto");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Termos e Condições");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "max 1000 caracteres");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Por favor, forneça as condições com no máximo 1000 caracteres.");

	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "linha");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Erro ao importar para a tabela temporária.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Data de renovação inválida - linha");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Data de atualização inválida - linha");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "Arquivo CSV importado para a tabela temporária.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "E-mail inválido - linha");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Senha inválida - linha");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Palavra-chave inválida (máximo ".MAX_KEYWORDS." palavras-chave) - linha");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Palavra-chave inválida (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - linha");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Título inválido - linha");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Data de início inválida - linha");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Data de término inválida - linha");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Data de início deve ser preenchida - linha");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Data de término deve ser preenchida - linha");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Hora de início inválida - linha");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Hora de término inválida - linha");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Formato da hora de início inválido. Deve ser \"xx:xx\" - linha");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Formato da hora de término inválido. Deve ser \"xx:xx\" - linha");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Modo da hora de início inválido. Deve ser \"AM\" ou \"PM\" - linha");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Modo da hora de término inválido. Deve ser \"AM\" ou \"PM\" - linha");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Modo da hora de início inválido. Deve ser \"24\" - linha");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Modo da hora de término inválido. Deve ser \"24\" - linha");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Localidade e localidade padrão do sistema são diferentes - linha");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Latitude inválida. Deve ser numérica entre -90 e 90 - linha");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Longitude inválida. Deve ser numérica entre -180 e 180 - linha");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Não existem arquivos CSV na pasta de importação.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "O número de colunas na(s) seguinte(s) linha(s) está errado:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Total de linhas lidas:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "Cabeçalho do CSV incorreto - possui mais campos que o permitido");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "Cabeçalho do CSV incorreto nos campos: ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "conta revertida");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "contas revertidas");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "item revertido");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "itens revertidos");
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Encontre o que você está procurando...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Às vezes você pode não encontrar resultados da busca pois a palavra-chave que você utilizou é muito genérica. Tente usar uma palavra mais específica.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "Siga-nos no LinkedIn");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Siga-nos no Facebook");
	//Links
	define("LANG_LINKS", "Links");
	//Contact
	define("LANG_FOOTER_CONTACT", "Contato");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Siga-nos no Twitter");
	//Follow us
	define("LANG_FOLLOW_US", "Siga-nos");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Resultados por página");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Mostrando resultados");
	//to
	define("LANG_PAGING_SHOWING_TO", "para");
	//of
	define("LANG_PAGING_SHOWING_OF", "de");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Páginas");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "Importação de [SUGAR_ITEM_TITLE] do SugarCRM para o [EDIRECTORY_TITLE]");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Utilize o formulário acima para realizar a importação a partir do registro [SUGAR_ITEM_TITLE] do SugarCRM. Depois de clicar em importar, seus dados serão transferidos para o seu diretório, você precisará preencher somente os dados extras e os dados de pagamento.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Está quase pronto.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Não foi possível realizar a exportação. Por favor, verifique as informações de conexão do SugarCRM em seu diretório.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Chave do eDirectory inválida.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "Dono da Empresa");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Título da Avaliação");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Dono do Evento");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "Dono do Classificado");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Autor do Artigo");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.seusite.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "seunome@seusite.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Visitante");
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
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Visão Resumida");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Visão Detalhada");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Conteúdo ilustrativo");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Enviar para Celular");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Clique para Ligar");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Mensagem enviada com sucesso!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Enviar informações sobre esta empresa a um telefone.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Digite o seu telefone para ligar para o proprietário da empresa sem custos.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefone é requerido.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Por favor, digite um número de telefone válido.");
	//Call
	define("LANG_TWILIO_CALL", "Ligar");
	//Calling
	define("LANG_TWILIO_CALLING", "Ligando...");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefone");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Extensão");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Ativar");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Seu código de validação é:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Seu número de telefone foi ativado!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Número de telefone apagado com sucesso!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Clique para Ligar indisponível para esta empresa");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Dicas para o item Clique para Ligar");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Você precisa ativar o número de telefone abaixo a fim de permitir que os usuários o contacte diretamente através do diretório.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Digite seu número de telefone e clique em Ativar.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Uma mensagem com o código de ativação será mostrada. Anote o código e aguarde o telefonema de ativação.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Você será solicitado a digitar o código de ativação de seis dígitos. Digite o código e espere a mensagem de confirmação.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Depois de ativar o seu número de telefone, clique em Salvar para concluir o processo.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "Para números de fora dos EUA, você precisa colocar o código do país primeiro.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "São aceitos apenas números dos EUA.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "Relatórios do \"Clique para Ligar\"");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Direção");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "De");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Hora de Início");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Hora de Término");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Duração (segundos)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Nenhum relatório disponível.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Ativado por");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Ativação falhou. Por favor, tente novamente.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Conta não está ativa.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Conta de teste não suporta esse recurso.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Chamada rejeitada devido a conta inativa.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Formato de URL inválido.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP falha de recuperação.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP falha na conexão.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP violação do protocolo.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP nome do host ruim.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP muitos redirecionamentos.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Falha de interpretação do documento.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Versão do Twilio Markup XML inválida.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "O elemento raiz deve ser Response.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Aviso de validação do esquema.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Inválido Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "Falha interna.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Não é possível discar a partir de um segmento das chamadas Dial.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Valor do método inválido.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Valor de tempo limite inválido.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Valor inválido hangupOnStar.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Valor inválido callerId.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Inválido elemento aninhado.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Valor inválido timelimit.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Valor do método inválido.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Valor inválido sendDigits.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Inválido formato de número de telefone.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Número de telefone inválido.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Número de telefone proibido.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Valor inválido silenciado.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Valor inválido endConferenceOnExit.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Valor inválido endConferenceOnExit.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Inválido waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Inválido waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Valor inválido beep.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Inválido Sid Conferência.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Inválido Nome Conferência.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Inválido verbo usado em waitUrl TwiML.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Valor inválido finishOnKey.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Valor inválido método.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Valor de tempo limite inválido.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Valor inválido numDigits.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Inválido verbo aninhadas.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Valor inválido voz.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Valor inválido laço.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Inválido Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Valor inválido laço.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Inválido Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Valor inválido loop.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Valor inválido voz.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Inválido texto.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Valor inválido método.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Valor de tempo limite inválido.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Valor inválido maxLength.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Valor inválido finishOnKey");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Valor inválido método.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Inválido valor de comprimento.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Atributo \"Para\" inválido.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Atributo \"De\" inválido.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Corpo inválido.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Método inválido atributo.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Atributo inválido statusCallback.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Limite de recuperação de documentos alcançados.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS enviar limite da taxa de ultrapassado.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "De número de telefone não SMS capaz.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS limite mensagem de resposta excedido.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "Inválido verbo para Responder SMS.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Para inválidos número de telefone para o modo de teste.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Parâmetros desconhecidos.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "FriendlyName inválido.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "Permissão negada.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Método não permitido.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Conta não ativa.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Chamado nenhum número especificado.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Número chamado é um número premium.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Internacional de chamada não habilitado.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Inválido URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "SendDigits inválido.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "IfMachine inválido.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Inválido Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Método inválido.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Número de telefone chamador não verificado.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Chamado inválido número de telefone.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Número de telefone inválido Caller.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Número de telefone chamador é necessária.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Número de telefone chamado não pode ser alcançado.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Conta não autorizado a chamada número de telefone.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Conta não tem permissão para chamar o número de telefone.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Número de telefone não parece ser válido.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "ApplicationSid inválido.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Estado inválido chamada.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Número de telefone inválido.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Url inválida.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Método inválido");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Telefone de entrada não estão disponíveis a conta de teste.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "Não é possível definir VoiceFallbackUrl sem definir Url.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "Não é possível definir SmsFallbackUrl sem definir SmsUrl.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Este tipo de número de telefone não suporta SMS.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Número de telefone já validado em sua conta.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Inválido o código de área.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Nenhum número de telefone encontrado no código de área.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Número de telefone já validado em outra conta.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "CallDelay inválido.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Recurso não disponível.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Inválido url callback.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Inválido tipo de transcrição.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid é necessária.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Número de telefone não é um válido SMS com capacidade de número de telefone de entrada.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Corpo da mensagem é necessário.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "O número de telefone \"de\" é necessário para enviar um SMS.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "O número de telefone \"para\" é necessário para enviar um SMS.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Máximo comprimento do corpo SMS é de 160 caracteres");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "O \"De\" número de telefone fornecido não é um válido, o SMS-capaz número de telefone de entrada para sua conta.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "O número Sandbox pode enviar mensagens apenas para números verificados.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Comentários do Facebook");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Comentários do Facebook indisponíveis para esta empresa.");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Tenha certeza que você está logado no Facebook com a mesma conta que você configurou na seção Opções de Comentários, caso contrário, você não poderá moderar os comentários deste item.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Você também pode moderar seus comentários indo até ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Chave da API inválida.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Parâmetro ausente: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Nome do módulo inválido.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Módulo desabilitado.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Parâmetro ausente: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API desabilitada.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Piscina");
	//Bedroom(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Quarto(s)");
	//Bathroom(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Banheiro(s)");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Andar(es)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Tipo de Imóvel");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Finalidade");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Preço");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Hectares");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Construído Em");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Metros Quadrados");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Escritório");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Lavanderia");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Ar Condicionado");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Sala de Jantar");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garagem");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Remoção de Lixo");