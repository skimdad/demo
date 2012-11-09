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
	# * FILE: /lang/tr_tr.php
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
	define("LANG_DATE_MONTHS", "ocak,şubat,mart,nisan,mayıs,haziran,temmuz,ağustos,eylül,ekim,kasım,aralık");
	//sunday,monday,tuesday,wednesday,thursday,friday,saturday
	define("LANG_DATE_WEEKDAYS", "pazar,pazartesi,salı,çarşamba,perşembe,cuma,cumartesi");
	//year
	define("LANG_YEAR", "yıl");
	//years
	define("LANG_YEAR_PLURAL", "yıllar");
	//month
	define("LANG_MONTH", "ay");
	//months
	define("LANG_MONTH_PLURAL", "aylar");
	//day
	define("LANG_DAY", "gün");
	//days
	define("LANG_DAY_PLURAL", "günler");
	//#,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
	define("LANG_LETTERS", "#,a,b,c,ç,d,e,f,g,ğ,h,ı,i,j,k,l,m,n,o,ö,p,r,s,ş,t,u,ü,v,y,z");
	//y
	define("LANG_LETTER_YEAR", "y");
	//m
	define("LANG_LETTER_MONTH", "a");
	//d
	define("LANG_LETTER_DAY", "g");
	//Hour
	define("LANG_LABEL_HOUR", "Saat");
	//Minute
	define("LANG_LABEL_MINUTE", "Dakika");
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
	define("ZIPCODE_LABEL", "posta kodu");

	# ----------------------------------------------------------------------------------------------------
	# STRING EVENT DATE
	# ----------------------------------------------------------------------------------------------------
	//[MONTHNAME] [DAY][SUFFIX], [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTHANDDAY", "F dS, Y");
	//[MONTHNAME] [YEAR]
	define("LANG_STRINGDATE_YEARANDMONTH", "F Y");
	//Video Snippet Code TIP
	define("LANG_VIDEO_SNIPPETTIP", "Video Kodu hakkında bir sorunuz mu var?");

	# ----------------------------------------------------------------------------------------------------
	# INCLUDES
	# ----------------------------------------------------------------------------------------------------
	//You are using an older version of Internet Explorer that may affect the full functionality of some features. We recommend you upgrade to a newer version of Internet Explorer.
	define("LANG_IE6_WARNING", "Bazı özellikler tam işlevselliği etkileyebilir Internet Explorer'ın eski bir sürümünü kullanıyorsanız. Internet Explorer'ın yeni bir sürüme yükseltme önerilir.");
	//N/A
	define("LANG_NA", "N/A");
	//characters
	define("LANG_LABEL_CHARACTERES", "karakterler");
	//by
	define("LANG_BY", "-");
	//in
	define("LANG_IN", "içinde");
	//Read More
	define("LANG_READMORE", "Devamı");
	//More
	define("LANG_MORE", "diller");
	//Browse by Category
	define("LANG_BROWSEBYCATEGORY", "Kategoriye göre göster");
	//Browse by Location
	define("LANG_BROWSEBYLOCATION", "Yere göre göster");
	//Browse Listings
	define("LANG_BROWSELISTINGS", "Listeler göre göster");
	//Browse Events
	define("LANG_BROWSEEVENTS", "Aktiviteler göre göster");
	//Browse Classifieds
	define("LANG_BROWSECLASSIFIEDS", "İlanlar göre göster");
	//Browse Articles
	define("LANG_BROWSEARTICLES", "Makaleler göre göster");
	//Browse Deals
	define("LANG_BROWSEPROMOTIONS", "Teklifler göre göster");
	//Browse Posts
	define("LANG_BROWSEPOSTS", "İletiler göre göster");
	//show
	define("LANG_SHOW", "göster");
	//hide
	define("LANG_HIDE", "sakla");
	//Bill to
	define("LANG_BILLTO", "Fatura");
	//Payable to
	define("LANG_PAYABLETO", "Ödenebilir");
	//Issuing Date
	define("LANG_ISSUINGDATE", "Düzenleme Tarihi");
	//Expire Date
	define("LANG_EXPIREDATE", "Son Kullanma Tarihi");
	//Questions
	define("LANG_QUESTIONS", "Sorular");
	//Please call
	define("LANG_PLEASECALL", "Lütfen bu numarayı arayın");
	//Invoice Info
	define("LANG_INVOICEINFO", "Fatura Bilgisi");
	//Payment Date
	define("LANG_PAYMENTDATE", "Ödeme Tarihi");
	//None
	define("LANG_NONE", "Yok");
	//Custom Invoice
	define("LANG_CUSTOM_INVOICES", "Özel Fatura");
	//Locations
	define("LANG_LOCATIONS", "Yerler");
	//Close
	define("LANG_CLOSE", "Kapat");
	//Close this window
	define("LANG_CLOSEWINDOW", "Pencereyi kapat");
	//from
	define("LANG_FROM", "/");
	//Transaction Info
	define("LANG_TRANSACTION_INFO", "İşlem Bilgisi");
	//In manual transactions, subtotal and tax are not calculated.
	define("LANG_TRANSACTION_MANUAL", "Elle yapılan işlemlerde ara toplam ve vergi hesaplanmaz.");
	//creditcard
	define("LANG_CREDITCARD", "kredikartı");
	//Join Now!
	define("LANG_JOIN_NOW", "Bize Katılın!");
	//Create Your Profile
	define("LANG_JOIN_PROFILE", "Profilinizi Oluşturun");
	//More Information
	define("LANG_MOREINFO", "Daha Fazla Bilgi");
	//and
	define("LANG_AND", "ve");
	//Keyword sample 1: "Auto Parts"
	define("LANG_KEYWORD_SAMPLE_1", "Otomobil Parçaları");
	//Keyword sample 2: "Tires"
	define("LANG_KEYWORD_SAMPLE_2", "Lastikler");
	//Keyword sample 3: "Engine Repair"
	define("LANG_KEYWORD_SAMPLE_3", "Motor Tamiri");
	//Categories and sub-categories
	define("LANG_CATEGORIES_SUBCATEGS", "Kategoriler ve alt-kategoriler");
	//per
	define("LANG_PER", "her");
	//each
	define("LANG_EACH", "her");
	//impressions block
	define("LANG_IMPRESSIONSBLOCK", "izlenim bloğu");
	//Add
	define("LANG_ADD", "Ekle");
	//Manage
	define("LANG_MANAGE", "Yönet");
	//impressions to my paid credit of
	define("LANG_IMPRESSIONPAIDOF", "izlenimler benim ödenen kredime");
	//Section
	define("LANG_SECTION", "Bölüm");
	//General Pages
	define("LANG_GENERALPAGES", "Genel Sayfalar");
	//Open in a new window
	define("LANG_OPENNEWWINDOW", "Yeni bir pencerede aç");
	//No
	define("LANG_NO", "Hayır");
	//Yes
	define("LANG_YES", "Evet");
	//Dear
	define("LANG_DEAR", "Sayın");
	//Street Address, P.O. box
	define("LANG_ADDRESS_EXAMPLE", "Sokak Adresi, Posta Kodu");
	//Apartment, suite, unit, building, floor, etc.
	define("LANG_ADDRESS2_EXAMPLE", "Apartman, daire, birim, bina, kat, vs.");
	//or
	define("LANG_OR", "veya");
	//Hour of Work sample 1: "Sun 8:00 am - 6:00 pm"
	define("LANG_HOURWORK_SAMPLE_1", "Pazar 08:00 - 18:00 arası");
	//Hour of Work sample 2: "Mon 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_2", "Pazartesi 08:00 am - 21:00 arası");
	//Hour of Work sample 3: "Tue 8:00 am - 9:00 pm"
	define("LANG_HOURWORK_SAMPLE_3", "Salı 08:00 - 21:00 arası");
	//Extra fields
	define("LANG_EXTRA_FIELDS", "Ekstra alanlar");
	//Amenities
	define("LANG_TEMPLATE_AMENITIES", "Tesisler");
	//Sign me in automatically
	define("LANG_AUTOLOGIN", "Otomatik olarak oturum aç");
	//Check / Uncheck All
	define("LANG_CHECK_UNCHECK_ALL", "Tümünü Seç / Bırak");
	//Billing Information
	define("LANG_BIILING_INFORMATION", "Fatura Bilgisi");
	//Default
	define("LANG_BUSINESS", "Varsayılan");
	//on Listing
	define("LANG_ON_LISTING", "Listede");
	//on Event
	define("LANG_ON_EVENT", "Aktivitede");
	//on Banner
	define("LANG_ON_BANNER", "Afişte");
	//on Classified
	define("LANG_ON_CLASSIFIED", "İlanlarda");
	//on Article
	define("LANG_ON_ARTICLE", "Makalede");
	//Listing Name
	define("LANG_LISTING_NAME", "Liste Adı");
	//Event Name
	define("LANG_EVENT_NAME", "Aktivite Adı");
	//Banner Name
	define("LANG_BANNER_NAME", "Afiş Adı");
	//Classified Name
	define("LANG_CLASSIFIED_NAME", "İlan Adı");
	//Article Name
	define("LANG_ARTICLE_NAME", "Makale Adı");
	//Frequently Asked Questions
	define("LANG_FAQ_NAME", "Sık Sorulan Sorular");
	//click to crop image
	define("LANG_CROPIMAGE", "resmi kırpmak için tıklayın");
	//Did not find your answer? Contact us.
	define("LANG_FAQ_CONTACT", "Aradığınızı bulamadınız mı? Bize ulaşın.");
	//Active
	define("LANG_LABEL_ACTIVE", "Aktif");
	//Suspended
	define("LANG_LABEL_SUSPENDED", "Askıya Alınmış");
	//Expired
	define("LANG_LABEL_EXPIRED", "Süresi Dolmuş");
	//Pending
	define("LANG_LABEL_PENDING", "Beklemede");
	//Received
	define("LANG_LABEL_RECEIVED", "Alındı");
	//Promotional Code
	define("LANG_LABEL_DISCOUNTCODE", "Promosyon Kodu");
	//Account
	define("LANG_LABEL_ACCOUNT", "Hesap");
	//Change account
	define("LANG_LABEL_CHANGE_ACCOUNT", "Hesap değiştir");
	//Name or Title
	define("LANG_LABEL_NAME_OR_TITLE", "Ad veya Başlık");
	//Name
	define("LANG_LABEL_NAME", "Ad");
	//First, Last
	define("LANG_LABEL_FIRST_LAST", "İlk, Son");
	//Page Name
	define("LANG_LABEL_PAGE_NAME", "Sayfa Adı");
	//Summary Description
	define("LANG_LABEL_SUMMARY_DESCRIPTION", "Özet Tanım");
	//Category
	define("LANG_LABEL_CATEGORY", "Kategori");
	//Category
	define("LANG_CATEGORY", "Kategori");
	//Categories
	define("LANG_LABEL_CATEGORY_PLURAL", "Kategoriler");
	//Categories
	define("LANG_CATEGORY_PLURAL", "Kategoriler");
	//Country
	define("LANG_LABEL_COUNTRY", "Ülke");
	//Region
	define("LANG_LABEL_REGION", "Bölge");
	//State
	define("LANG_LABEL_STATE", "İl");
	//City
	define("LANG_LABEL_CITY", "İlçe");
	//Neighborhood
	define("LANG_LABEL_NEIGHBORHOOD", "Mahalle");	
	//Countries
	define("LANG_LABEL_COUNTRY_PL", "Ülkeler");
	//Regions
	define("LANG_LABEL_REGION_PL", "Bölgeler");
	//States
	define("LANG_LABEL_STATE_PL", "İller");
	//Cities
	define("LANG_LABEL_CITY_PL", "İlçeler");
	//Neighborhoods
	define("LANG_LABEL_NEIGHBORHOOD_PL", "Mahalleler");
	//Add a New Region
	define("LANG_LABEL_ADD_A_NEW_REGION", "Yeni bölge ekle");
	//Add a New State
	define("LANG_LABEL_ADD_A_NEW_STATE", "Yeni il ekle");
	//Add a New City
	define("LANG_LABEL_ADD_A_NEW_CITY", "Yeni ilçe ekle");
	//Add a New Neighborhood
	define("LANG_LABEL_ADD_A_NEW_NEIGHBORHOOD", "Yeni mahalle ekle");
	//Choose an Existing Region
	define("LANG_LABEL_CHOOSE_AN_EXISTING_REGION", "Mevcut olan bir bölge seç");
	//Choose an Existing State
	define("LANG_LABEL_CHOOSE_AN_EXISTING_STATE", "Mevcut olan bir il seç");
	//Choose an Existing City
	define("LANG_LABEL_CHOOSE_AN_EXISTING_CITY", "Mevcut olan bir ilçe seç");
	//Choose an Existing Neighborhood
	define("LANG_LABEL_CHOOSE_AN_EXISTING_NEIGHBORHOOD", "Mevcut olan bir mahalle seç");
	//No locations found.
	define("LANG_LABEL_NO_LOCATIONS_FOUND", "Yer bulunamadı");
	//Renewal
	define("LANG_LABEL_RENEWAL", "Yenileme");
	//Renewal Date
	define("LANG_LABEL_RENEWAL_DATE", "Yenileme Tarihi");
	//Street Address
	define("LANG_LABEL_STREET_ADDRESS", "Adres");
	//Web Address
	define("LANG_LABEL_WEB_ADDRESS", "Web Sayfası");
	//Phone
	define("LANG_LABEL_PHONE", "Telefon");
	//Fax
	define("LANG_LABEL_FAX", "Faks");
	//Long Description
	define("LANG_LABEL_LONG_DESCRIPTION", "Uzun Tanım");
	//Status
	define("LANG_LABEL_STATUS", "Statü");
	//Level
	define("LANG_LABEL_LEVEL", "Seviye");
	//Empty
	define("LANG_LABEL_EMPTY", "Boş");
	//Start Date
	define("LANG_LABEL_START_DATE", "Başlangıç Tarihi");
	//Start Date
	define("LANG_LABEL_STARTDATE", "Bitiş Tarihi");
	//End Date
	define("LANG_LABEL_END_DATE", "Bitiş Tarihi");
	//End Date
	define("LANG_LABEL_ENDDATE", "Bitiş Tarihi");
	//Invalid date
	define("LANG_LABEL_INVALID_DATE", "Geçersiz tarih");
	//Start Time
	define("LANG_LABEL_START_TIME", "Başlangıç Saati");
	//End Time
	define("LANG_LABEL_END_TIME", "Bitiş Saati");
	//Unlimited
	define("LANG_LABEL_UNLIMITED", "Sınırsız");
	//Select a Type
	define("LANG_LABEL_SELECT_TYPE", "Tür seç");
	//Select a Category
	define("LANG_LABEL_SELECT_CATEGORY", "Kategori seç");
	//Time Left
	define("LANG_LABEL_TIMELEFT", "Kalan Süre");
	//View Deal
	define("LANG_LABEl_VIEW_DEAL", "Teklif Görüntüle");
	//No Deal
	define("LANG_LABEL_NO_PROMOTION", "Teklif yok");
	//Select a Deal
	define("LANG_LABEL_SELECT_PROMOTION", "Teklif Seç");
	//Contact Name
	define("LANG_LABEL_CONTACTNAME", "Yetkili Adı");
	//Contact Name
	define("LANG_LABEL_CONTACT_NAME", "Yetkili Adı");
	//Contact Phone
	define("LANG_LABEL_CONTACT_PHONE", "Yetkilinin Telefonu");
	//Contact Fax
	define("LANG_LABEL_CONTACT_FAX", "Yetkilinin Faksı");
	//Contact E-mail
	define("LANG_LABEL_CONTACT_EMAIL", "Yetkilinin E-posta Adresi");
	//URL
	define("LANG_LABEL_URL", "URL");
	//Address
	define("LANG_LABEL_ADDRESS", "Adres");
	//E-mail
	define("LANG_LABEL_EMAIL", "E-posta");
	//Notify me about listing reviews and listing traffic
	define("LANG_LABEL_NOTIFY_TRAFFIC", "Liste yorum ve listeleme trafiği hakkında bildir.");
	//Invoice
	define("LANG_LABEL_INVOICE", "Fatura");
	//Invoice #
	define("LANG_LABEL_INVOICENUMBER", "Fatura No:");
	//Item
	define("LANG_LABEL_ITEM", "Kayıt");
	//Items
	define("LANG_LABEL_ITEMS", "Kayıtlar");
	//Extra Category
	define("LANG_LABEL_EXTRA_CATEGORY", "Ekstra Kategori");
	//Discount Code
	define("LANG_LABEL_DISCOUNT_CODE", "İndirim Kodu");
	//Item Price
	define("LANG_LABEL_ITEMPRICE", "Kayıt Fiyatı");
	//Amount
	define("LANG_LABEL_AMOUNT", "Tutar");
	//Tax
	define("LANG_LABEL_TAX", "Vergi");
	//Subtotal
	define("LANG_LABEL_SUBTOTAL", "Aratoplam");
	//Make checks payable to
	define("LANG_LABEL_MAKE_CHECKS_PAYABLE", "Çek ödemesi");
	//Total
	define("LANG_LABEL_TOTAL", "Toplam");
	//Id
	define("LANG_LABEL_ID", "Kimlik");
	//IP
	define("LANG_LABEL_IP", "IP");
	//Title
	define("LANG_LABEL_TITLE", "Başlık");
	//Caption
	define("LANG_LABEL_CAPTION", "Altyazı");
	//impressions
	define("LANG_IMPRESSIONS", "izlenimler");
	//Impressions
	define("LANG_LABEL_IMPRESSIONS", "İzlenimler");
	//By impressions
	define("LANG_LABEL_BY_IMPRESSIONS", "Gösterimlerine");
	//By time period
	define("LANG_LABEL_BY_PERIOD", "Zaman diliminde");
	//Date
	define("LANG_LABEL_DATE", "Tarih");
	//Your E-mail
	define("LANG_LABEL_YOUREMAIL", "E-Posta Adresiniz");
	//Subject
	define("LANG_LABEL_SUBJECT", "Konu");
	//Additional message
	define("LANG_LABEL_ADDITIONALMSG", "Mesaj");
	//Payment type
	define("LANG_LABEL_PAYMENT_TYPE", "Ödeme şekli");
	//Notes
	define("LANG_LABEL_NOTES", "Notlar");
	//It's easy and fast!
	define("LANG_LABEL_EASYFAST", "Kolay ve de hızlı!");
	//Write reviews, comment on blog
	define("LANG_LABEL_FOR_PROFILE", "Bloga yorum yazın");
	//Write reviews
	define("LANG_LABEL_FOR_PROFILE2", "Yorum yazın");
	//Already have access?
	define("LANG_LABEL_ALREADYMEMBER", "Zaten erişiminiz var mı?");
	//Enjoy our services!
	define("LANG_LABEL_ENJOYSERVICES", "Hizmetimizin tadını çıkarın!");
	//Test Password
	define("LANG_LABEL_TESTPASSWORD", "Test Şifresi");
	//Forgot your password?
	define("LANG_LABEL_FORGOTPASSWORD", "Şifrenizi unuttunuz mu?");
	//Summary
	define("LANG_LABEL_SUMMARY", "Özet");
	//Detail
	define("LANG_LABEL_DETAIL", "Detay");
	//(your friend's e-mail)
	define("LANG_LABEL_FRIEND_EMAIL", "(Arkadaşınızın e-posta)");
	//From
	define("LANG_LABEL_FROM", "Dan");
	//To
	define("LANG_LABEL_TO", "Gönderilen");
	//to
	define("LANG_LABEL_DATE_TO", "kadar");
	//Last
	define("LANG_LABEL_LAST", "Son");
	//Last
	define("LANG_LABEL_LAST_PLURAL", "Son");
	//day
	define("LANG_LABEL_DAY", "gün");
	//days
	define("LANG_LABEL_DAYS", "günler");
	//New
	define("LANG_LABEL_NEW", "Yeni");
	//New FAQ
	define("LANG_LABEL_NEW_FAQ", "Yeni FAQ");
	//Type
	define("LANG_LABEL_TYPE", "Tür");
	//ClickThru
	define("LANG_LABEL_CLICKTHRU", "Tıklama");
	//Added
	define("LANG_LABEL_ADDED", "Eklendi");
	//Add
	define("LANG_LABEL_ADD", "Ekle");
	//rating
	define("LANG_LABEL_RATING", "puanlama");
	//evaluator
	define("LANG_LABEL_EVALUATOR", "değerlendirici");
	//Reviewer
	define("LANG_LABEL_REVIEWER", "Yorumcu");
	//System
	define("LANG_LABEL_SYSTEM", "Sistem");
	//Subscribe to RSS
	define("LANG_LABEL_SUBSCRIBERSS", "RSS'ye üye olun");
	//Password strength
	define("LANG_LABEL_PASSWORDSTRENGTH", "Şifre gücü");
	//Article Title
	define("LANG_ARTICLE_TITLE", "Makale Başlığı");
	//SEO Description
	define("LANG_SEO_DESCRIPTION", "SEO Tanımı");
	//SEO Keywords
	define("LANG_SEO_KEYWORDS", "SEO Anahtar Kelimeleri");
	//No line breaks allowed
	define("LANG_SEO_LINEBREAK", "satır sonları kabul edilmiyor");
	//Separate elements with comma (,)
	define("LANG_SEO_COLON", "sözcükleri virgülle (,) ayırın");
	//Click here to edit the SEO information of this item
	define("LANG_MSG_CLICK_TO_EDIT_SEOCENTER", "Bu kaydın SEO bilgilerini değiştirmek için tıklayın");
	//SEO successfully updated!
	define("LANG_MSG_SEOCENTER_ITEMUPDATED", "SEO başarılı olarak güncellendi!");
	//Click here to view this article
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE", "Bu makaleyi görmek için tıklayın");
	//Click here to edit this article
	define("LANG_MSG_CLICK_TO_EDIT_THIS_ARTICLE", "Bu makaleyi düzenlemek için tıklayın");
	//Click here to add/edit photo gallery for this article
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_ARTICLE", "Bu makaleye foto galeri eklemek/düzenlemek için tıklayın");
	//Photo gallery not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Bu makale için foto galeri henüz mevcut değil");
	//Click here to view this article reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ARTICLE_REPORTS", "Bu makalenin raporlarını görmek için tıklayın");
	//History for this article
	define("LANG_HISTORY_FOR_THIS_ARTICLE", "Bu makalenin geçmişi");
	//History not available for this article
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_ARTICLE", "Bu makale için geçmiş henüz mevcut değil");
	//Click here to delete this article
	define("LANG_MSG_CLICK_TO_DELETE_THIS_ARTICLE", "Bu makaleyi silmek için tıklayın.");
	//Click here to view this banner
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER", "Bu afişi görmek için tıklayın");
	//Click here to edit this banner
	define("LANG_MSG_CLICK_TO_EDIT_THIS_BANNER", "Bu afişi düzenlemek için tıklayın.");
	//Click here to view this banner reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_BANNER_REPORTS", "Bu afişin raporlarını görmek için tıklayın.");
	//History for this banner
	define("LANG_HISTORY_FOR_THIS_BANNER", "Bu afişin geçmişi.");
	//History not available for this banner
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_BANNER", "Bu afiş için henüz geçmiş mevcut değil.");
	//Click here to delete this banner
	define("LANG_MSG_CLICK_TO_DELETE_THIS_BANNER", "Bu afişi silmek için tıklayın");
	//Classified Title
	define("LANG_CLASSIFIED_TITLE", "İlan Başlığı");
	//Click here to
	define("LANG_MSG_CLICKTO", "için tıklayın");
	//Click here to view this classified
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED", "Bu ilanı görmek için tıklayın");
	//Click here to edit this classified
	define("LANG_MSG_CLICK_TO_EDIT_THIS_CLASSIFIED", "Bu ilanı düzenlemek için tıklayın");
	//Click here to add/edit photo gallery for this classified
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_CLASSIFIED", "Bu İlana foto galeri eklemek/düzenlemek için tıklayın");
	//Photo gallery not available for this classified
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_CLASSIFIED", "Bu ilan için foto galerisi henüz mevcut değil");
	//Click here to view this classified reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_CLASSIFIED_REPORTS", "Bu ilan raporlarını görmek için tıklayın");
	//Click here to map tuning this classified location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_CLASSIFIED", "Bu ilanın harita ayarları için tıklayın");
	//Map tuning not available for this classified
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_CLASSIFIED", "Bu ilan için harita ayarları henüz mevcut değil");
	//History for this classified
	define("LANG_HISTORY_FOR_THIS_CLASSIFIED", "Bu ilanın geçmişi");
	//History not available for this classified
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_CLASSIFIED", "Bu ilan için geçmiş henüz mevcut değil");
	//Click here to delete this classified
	define("LANG_MSG_CLICK_TO_DELETE_THIS_CLASSIFIED", "Bu ilanı silmek için tıklayın");
	//Event Title
	define("LANG_EVENT_TITLE", "Aktivite Başlığı");
	//Click here to view this event
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT", "Bu aktiviteyi görmek için tıklayın");
	//Click here to edit this event
	define("LANG_MSG_CLICK_TO_EDIT_THIS_EVENT", "Bu aktiviteyi düzenlemek için tıklayın");
	//Click here to add/edit photo gallery for this event
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_EVENT", "Bu aktiviteye foto galeri eklemek/düzenlemek için tıklayın");
	//Photo gallery not available for this event
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_EVENT", "Bu aktivite için foto galerisi henüz mevcut değil");
	//Click here to view this event reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_EVENT_REPORTS", "Bu aktivitenin raporlarını görmek için tıklayın");
	//Click here to map tuning this event location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_EVENT", "Bu aktivitenin harita ayarları için tıklayın");
	//Map tuning not available for this event
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_EVENT", "Bu aktivite için harita ayarları henüz mevcut değil");
	//History for this event
	define("LANG_HISTORY_FOR_THIS_EVENT", "Bu aktivitenin geçmişi");
	//History not available for this event
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_EVENT", "Bu aktivite için geçmiş henüz mevcut değil");
	//Click here to delete this event
	define("LANG_MSG_CLICK_TO_DELETE_THIS_EVENT", "Bu aktiviteyi silmek için tıklayın");
	//Gallery Title
	define("LANG_GALLERY_TITLE", "Galeri Başlığı");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_THIS_GALLERY", "Bu galeriyi görmek için tıklayın");
	//Click here to edit this gallery
	define("LANG_MSG_CLICK_TO_EDIT_THIS_GALLERY", "Bu galeriyi düzenlemek için tıklayın");
	//Click here to delete this gallery
	define("LANG_MSG_CLICK_TO_DELETE_THIS_GALLERY", "Bu galeriyi silmek için tıklayın");
	//Listing Title
	define("LANG_LISTING_TITLE", "Liste Başlığı");
	//Click here to view this listing
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING", "Bu listeyi görmek için tıklayın");
	//Click here to edit this listing
	define("LANG_MSG_CLICK_TO_EDIT_THIS_LISTING", "Bu listeyi düzenlemek için tıklayın");
	//Click here to add/edit photo gallery for this listing
	define("LANG_MSG_CLICK_TO_ADD_EDIT_PHOTO_GALLERY_THIS_LISTING", "Bu listeye foto galeri eklemek/düzenlemek için tıklayın");
	//Photo gallery not available for this listing
	define("LANG_PHOTO_GALLERY_NOT_AVAILABLE_FOR_LISTING", "Bu liste için foto galeri henüz mevcut değil");
	//Click here to change deal for this listing
	define("LANG_MSG_CLICK_TO_CHANGE_PROMOTION", "Bu listenin bu teklif değiştirmek için tıklayın");
	//Deal not available for this listing
	define("LANG_MSG_PROMOTION_NOT_AVAILABLE", "Bu liste için teklif mevcut değil");
	//Click here to view this listing reports
	define("LANG_MSG_CLICK_TO_VIEW_THIS_LISTING_REPORTS", "Bu listenin raporlarını görmek için tıklayın");
	//Click here to map tuning this listing location
	define("LANG_MSG_CLICK_TO_MAP_TUNING_THIS_LISTING", "Bu listenin harita ayarları için tıklayın");
	//Map tuning not available for this listing
	define("LANG_LABEL_MAP_TUNING_NOT_AVAILABLE_FOR_LISTING", "Bu liste için harita ayarları mevcut değil");
	//Map tuning Address Not Found
	define("LANG_MAPTUNING_ADDRESSNOTFOUND", "Adres bulunmadı");
	//Map tuning Please Edit Your Item
	define("LANG_MAPTUNING_PLEASEEDITYOURITEM", "Lütfen kaydınızı düzenleyin");
	//Click here to view this item reviews
	define("LANG_MSG_CLICK_TO_VIEW_THIS_ITEM_REVIEWS", "Bu kaydın yorumlarını görmek için tıklayın");
	//Item reviews not available
	define("LANG_MSG_ITEM_REVIEWS_NOT_AVAILABLE", "Kayıt yorumları mevcut değil ");
	//History for this listing
	define("LANG_HISTORY_FOR_THIS_LISTING", "Bu listenin geçmişi");
	//History not available for this listing
	define("LANG_HISTORY_NOT_AVAILABLE_FOR_LISTING", "Bu liste için geçmiş henüz mevcut değil");
	//Click here to delete this listing
	define("LANG_MSG_CLICK_TO_DELETE_THIS_LISTING", "Bu listeyi silmek için tıklayın");
	//Save
	define("LANG_MSG_SAVE_CHANGES", "Kaydet");	
	//More Information
	define("LANG_MSG_MORE_INFO", "Daha fazla Bilgi");
	//(Try to use something descriptive, like "10% off of our product" or "3 for the price of two on our product")
	define("LANG_MSG_DEALTITLE_TIP", "(\"Ürün iki fiyatına 3\" veya \"Ürünümüzün 10% indirim\" gibi bir tanımlayıcı, kullanmaya çalışın.)");
	//Enter the value of the item / service you are offering. Choose a discount type (Fixed Value or Percentage), and enter the respective value. Check the calculation and then provide us with the number of offers you wish to make.
	define("LANG_MSG_ADD_DEAL_TIP", "Size sunuyoruz öğenin değerini girin. Bir indirim türü (Sabit Değer veya Yüzde) seçin ve ilgili değeri girin. hesaplama kontrol edin ve sonra yapmak istediğiniz tekliflerinin sayısını bize.");
	//Please be sure your image is the right size before you upload it, otherwise the image will likely be stretched to fit the site and image quality will be affected.
	define("LANG_MSG_ADD_DEAL_TIP2", "Aksi takdirde görüntü muhtemel site ve görüntü kalitesi etkilenecektir sığdırmak için gergin olacak yükleyin önce görüntü, uygun büyüklükte olduğundan emin olun.");
	//Every deal needs to be linked to a listing in order to be active on the site.
	define("LANG_MS_MANGE_DEAL_TIP", "Her anlaşma için sitede aktif olabilmek için bir liste ile bağlantılı olması gerekir.");
	//Associate with the listing
	define("LANG_DEAL_LISTING_SELECT", "Liste ile ilişkilendirmek");
	//Please type your item title and wait for suggestions of available associations.
	define("LANG_DEAL_LISTING_TIP", "Öğeniz başlığını yazın ve mevcut derneklerin önerileri için bekleyin.");
	//Empty
	define("LANG_EMPTY", "Boş");
	//Cancel
	define("LANG_CANCEL", "İptal");
	//Custom Time Period
	define("LANG_SITEMGR_CUSTOMPERIOD", "Özel Zaman Aralığı");
	//Fixed Value Discount
	define("LANG_LABEL_FIXEDVALUE_DISC", "Sabit değer İndirim");
	//Percentage Discount
	define("LANG_LABEL_PERCENTAGE_DISC", "Yüzde İndirim");
	//Value with Discount
	define("LANG_LABEL_DISC_AMOUNT", "Indirim ile Değer");
	//Discount (Calculated)
	define("LANG_LABEL_DISC_CALCULATED", "Indirim (Hesaplanan)");
	//How many deal would you like to offer
	define("LANG_LABEL_DEALS_OFFER", "Kaç anlaşma size sunmak istiyorum");
	//Linked to Listing
	define("LANG_LABEL_ATTACHED_LISTING", "Listeleme Bağlı");
	//Choose a Listing
	define("LANG_LABEL_CHOOSE_LISTING", "Bir Liste seçin");
	//You can not add different deals to the same listing
	define("LANG_MSG_REPEATED_LISTINGS", "Aynı liste için farklı fırsatlar ekleyemezsiniz.");
	//Deals successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATE", "Fırsatlar başarıyla güncellendi!");
	//Options
	define("LANG_LABEL_OPTIONS", "Seçenekleri");
	//Deal Title
	define("LANG_PROMOTION_TITLE", "Teklif Başlık");
	//Click here to view this deal
	define("LANG_MSG_CLICK_TO_VIEW_THIS_PROMOTION", "Bu teklif görmek için tıklayın");
	//Click here to edit this deal
	define("LANG_MSG_CLICK_TO_EDIT_THIS_PROMOTION", "Bu teklif düzenlemek için tıklayın");
	//Click here to delete this deal
	define("LANG_MSG_CLICK_TO_DELETE_THIS_PROMOTION", "Bu teklif silmek için tıklayın");
	//Go to "Listings" and click on the deal icon belonging to the listing where you want to add the deal. Select one deal to add to your listing to make it live.
	define("LANG_PROMOTION_EXTRAMESSAGE", "\"Listeler\" e gidin ve teklif eklemek istediğiniz listeye ait olan teklif sembolüne tıklayın. Listenize ekleyip yayınlamak için bir teklif seçin.");
	//The installments will be recurring until your credit card expiration
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATION", "Taksitler kredi kartınızın son kullanma tarihi dolana kadar tekrar edecektir");
	//The installments will be recurring until your credit card expiration ("maximum of 36 installments")
	define("LANG_MSG_RECURRINGUNTILCARDEXPIRATIONMAXOF", "en fazla 36 taksit");
	//SEO Center
	define("LANG_MSG_SEO_CENTER", "SEO Merkezi");
	//View
	define("LANG_LABEL_VIEW", "Görünüm");
	//Edit
	define("LANG_LABEL_EDIT", "Düzenleme");
	//Gallery
	define("LANG_LABEL_GALLERY", "Galeri");
	//Traffic Reports
	define("LANG_TRAFFIC_REPORTS", "Trafik Raporları");
	//Unpaid
	define("LANG_LABEL_UNPAID", "Ödenmemiş");
	//Paid
	define("LANG_LABEL_PAID", "Ödenmiş");
	//Waiting payment approval
	define("LANG_LABEL_WAITING", "Ödeme onayı bekliyorum");
	//Under review
	define("LANG_LABEL_ANALYSIS", "Inceleniyor");
	//Available
	define("LANG_LABEL_AVAILABLE", "Mevcut");
	//In dispute
	define("LANG_LABEL_DISPUTE", "Anlaşmazlık");
	//Refunded
	define("LANG_LABEL_REFUNDED", "Iade");
	//Cancelled
	define("LANG_LABEL_CANCELLED", "İptal Edildi");
	//Transaction
	define("LANG_LABEL_TRANSACTION", "İşlem");
	//Delete
	define("LANG_LABEL_DELETE", "Sil");
	//Map Tuning
	define("LANG_LABEL_MAP_TUNING", "Harita Ayarları");
	//Hide Map
	define("LANG_LABEL_HIDEMAP", "Haritayı Sakla");
	//Show Map
	define("LANG_LABEL_SHOWMAP", "Haritayı Göster");
	//SEO
	define("LANG_LABEL_SEO_TUNING", "SEO");
	//Print
	define("LANG_LABEL_PRINT", "Yazdır");
	//Pending Approval
	define("LANG_LABEL_PENDING_APPROVAL", "Onay Bekliyor");
	//Image
	define("LANG_LABEL_IMAGE", "Resim");
	//Images
	define("LANG_LABEL_IMAGE_PLURAL", "Resimler");
	//Required field
	define("LANG_LABEL_REQUIRED_FIELD", "Gerekli Alan");
	//Please type all the required fields.
	define("LANG_LABEL_TYPE_FIELDS", "Gerekli tüm alanları yazın.");
	//Account Information
	define("LANG_LABEL_ACCOUNT_INFORMATION", "Hesap Bilgileri");
	//Username
	define("LANG_LABEL_USERNAME", "E-posta");
	//Current Password
	define("LANG_LABEL_CURRENT_PASSWORD", "Şimdiki şifreniz");
	//Password
	define("LANG_LABEL_PASSWORD", "Şifre");
	//Create Password
	define("LANG_LABEL_CREATE_PASSWORD", "Ş​ifre Oluştur");
	//New Password
	define("LANG_LABEL_NEW_PASSWORD", "Yeni Şifre");
	//Retype Password
	define("LANG_LABEL_RETYPE_PASSWORD", "Şifrenizi Tekrar Girin");
	//Retype Password
	define("LANG_LABEL_RETYPEPASSWORD", "Şifrenizi Tekrar Girin");
	//Retype New Password
	define("LANG_LABEL_RETYPE_NEW_PASSWORD", "Yeni Şifrenizi Tekrar Girin");
	//OpenID URL
	define("LANG_LABEL_OPENIDURL", "OpenID URL");
	//Information
	define("LANG_LABEL_INFORMATION", "Bilgiler");
	//Publication Date
	define("LANG_LABEL_PUBLICATION_DATE", "Yayın Tarihi");
	//Calendar
	define("LANG_LABEL_CALENDAR", "Takvim");
	//Friendly Url
	define("LANG_LABEL_FRIENDLY_URL", "Friendly Url");
	//For example
	define("LANG_LABEL_FOR_EXAMPLE", "Örnek");
	//Image Source
	define("LANG_LABEL_IMAGE_SOURCE", "Resim Kaynağı");
	//Image Attribute
	define("LANG_LABEL_IMAGE_ATTRIBUTE", "Resim Niteliği");
	//Image Caption
	define("LANG_LABEL_IMAGE_CAPTION", "Resim Altyazısı");
	//Abstract
	define("LANG_LABEL_ABSTRACT", "Özet");
	//Keywords for the search
	define("LANG_LABEL_KEYWORDS_FOR_SEARCH", "Arama için anahtar kelimeler");
	//maximum
	define("LANG_LABEL_MAX", "en fazla");
	//keywords
	define("LANG_LABEL_KEYWORDS", "anahtar kelime");
	//Content
	define("LANG_LABEL_CONTENT", "İçerik");
	//Code
	define("LANG_LABEL_CODE", "Kod");
	//free
	define("LANG_FREE", "BEDAVA");
	//free
	define("LANG_LABEL_FREE", "bedava");
	//Destination Url
	define("LANG_LABEL_DESTINATION_URL", "Hedef Url");
	//Script
	define("LANG_LABEL_SCRIPT", "Kod");
	//File
	define("LANG_LABEL_FILE", "Dosya");
	//Warning
	define("LANG_LABEL_WARNING", "Uyarı");
	//Display URL (optional)
	define("LANG_LABEL_DISPLAY_URL", "Gösterilen URL (seçmeli)");
	//Description line 1
	define("LANG_LABEL_DESCRIPTION_LINE1", "Tanım satırı 1");
	//Description line 2
	define("LANG_LABEL_DESCRIPTION_LINE2", "Tanım satırı 2");
	//Locations
	define("LANG_LABEL_LOCATIONS", "Adres bilgileri");
	//Address (optional)
	define("LANG_LABEL_ADDRESS_OPTIONAL", "Adres (seçmeli)");
	//Address (Optional)
	define("LANG_LABEL_ADDRESSOPTIONAL", "Adres (seçmeli)");
	//Detail Description
	define("LANG_LABEL_DETAIL_DESCRIPTION", "Detaylı Tanım");
	//Price
	define("LANG_LABEL_PRICE", "Fiyat");
	//Prices
	define("LANG_LABEL_PRICE_PLURAL", "Fiyatlar");
	//Contact Information
	define("LANG_LABEL_CONTACT_INFORMATION", "İletişim Bilgileri");
	//Language
	define("LANG_LABEL_LANGUAGE", "Dil");
	//Select your main language to contact (when necessary).
	define("LANG_LABEL_LANGUAGETIP", "(İletişim için anadilinizi seçin (gerekliyse)."); 
	//First Name
	define("LANG_LABEL_FIRST_NAME", "Adı");
	//First Name
	define("LANG_LABEL_FIRSTNAME", "Adı");
	//Last Name
	define("LANG_LABEL_LAST_NAME", "Soyadı");
	//Last Name
	define("LANG_LABEL_LASTNAME", "Soyadı");
	//Company
	define("LANG_LABEL_COMPANY", "Şirket");
	//Address Line1
	define("LANG_LABEL_ADDRESS1", "Adres Satırı 1");
	//Address Line2
	define("LANG_LABEL_ADDRESS2", "Adres Satırı 2");
	//Latitude
	define("LANG_LABEL_LATITUDE", "Enlem");
	//Longitude
	define("LANG_LABEL_LONGITUDE", "Boylam");
	//Not found. Please, try to specify better your location.
	define("LANG_LABEL_MAP_NOTFOUND", "Bulamadık. Konumunuzu daha iyi belirlemek için deneyin.");
	//The following fields contain errors:
	define("LANG_LABEL_MAP_ERRORS", "Aşağıdaki alanlar hataları içerir:");
	//Latitude must be a number between -90 and 90.
	define("LANG_LABEL_MAP_INVALID_LAT", "Enlem -90 ile 90 arasında bir sayı olmalıdır.");
	//Longitude must be a number between -180 and 180.
	define("LANG_LABEL_MAP_INVALID_LON", "Boylam -180 ve 180 arasında bir sayı olmalıdır.");
	//Location Name
	define("LANG_LABEL_LOCATION_NAME", "Yer Adı");
	//Event Date
	define("LANG_LABEL_EVENT_DATE", "Aktivite Günü");
	//Description
	define("LANG_LABEL_DESCRIPTION", "Tanım");
	//Help Information
	define("LANG_LABEL_HELP_INFORMATION", "Yardım Bilgileri");
	//Text
	define("LANG_LABEL_TEXT", "Yazı");
	//Add Image
	define("LANG_LABEL_ADDIMAGE", "Resim Ekle");
	//Add Image
	define("LANG_LABEL_ADDIMAGES", "Resim Ekle");
	//Edit Image Captions
	define("LANG_LABEL_EDITIMAGECAPTIONS", "Resim Altyazılarını Düzenle");
	//Image File
	define("LANG_LABEL_IMAGEFILE", "Resim Dosyası");
	//Thumb Caption
	define("LANG_LABEL_THUMBCAPTION", "Küçük Resim Altyazısı");
	//Image Caption
	define("LANG_LABEL_IMAGECAPTION", "Resim Altyazısı");
	//Note, your upload may take several minutes depending on the file size and your internet connection speed. Hitting refresh or navigating away from this page will cancel your upload.
	define("LANG_LABEL_NOTEFORGALLERYIMAGE", "Not; dosya büyüklüğüne ve internet bağlantı hızına bağlı olarak yüklemeniz birkaç dakika sürebilir. Sayfayı yenile düğmesine basarsanız veya bu sayfadan başka bir sayfaya geçerseniz, yükleme iptal olacaktır.");
	//Video Snippet Code
	define("LANG_LABEL_VIDEO_SNIPPET_CODE", "Video Kodu");
	//Attach Additional File
	define("LANG_LABEL_ATTACH_ADDITIONAL_FILE", "Ek Dosya ekle");
	//Attention
	define("LANG_LABEL_ATTENTION", "Dikkat");
	//Source
	define("LANG_LABEL_SOURCE", "Kaynak");
	//Hours of work
	define("LANG_LABEL_HOURS_OF_WORK", "Çalışma Saatleri");
	//Default
	define("LANG_LABEL_DEFAULT", "Varsayılan");
	//Payment Method
	define("LANG_LABEL_PAYMENT_METHOD", "Ödeme Şekli");
	//By Credit Card
	define("LANG_LABEL_BY_CREDIT_CARD", "Kredi Kartı İle");
	//By PayPal
	define("LANG_LABEL_BY_PAYPAL", "PayPal İle");
	//By SimplePay
	define("LANG_LABEL_BY_SIMPLEPAY", "SimplePay İle");
	//By Pagseguro
	define("LANG_LABEL_BY_PAGSEGURO", "Pagseguro İle");
	//Print Invoice and Mail a Check
	define("LANG_LABEL_PRINT_INVOICE_AND_MAIL_CHECK", "Faturayı Yazdır ve Çek Gönder");
	//Headline
	define("LANG_LABEL_HEADLINE", "Başlık");
	//Offer
	define("LANG_LABEL_OFFER", "Teklif");
	//Conditions
	define("LANG_LABEL_CONDITIONS", "Şartlar");
	//Deal Dates
	define("LANG_LABEL_PROMOTION_DATE", "Teklif Tarihleri​​");
	//Deal Layout
	define("LANG_LABEL_PROMOTION_LAYOUT", "Teklif Düzeni");
	//Printable Deal
	define("LANG_LABEL_PRINTABLE_PROMOTION", "Yazdırılabilir Teklif");
	//Our HTML template based deal
	define("LANG_LABEL_OUR_HTML_TEMPLATE_BASED", "Bizim HTML şablonumuza dayanan teklif");
	//Fill in the fields above and insert a logo or other image (JPG or GIF)
	define("LANG_LABEL_FILL_FIELDS_ABOVE", "Yukarıdaki alanları doldurun ve bir logo ya da başka bir resim (JPG veya GIF) ekleyin)");
	//A deal provided by you instead
	define("LANG_LABEL_PROMOTION_PROVIDED_BY_YOU", "Onun yerine sizin tarafınızdan sağlanan bir teklif");
	//JPG or GIF image
	define("LANG_LABEL_JPG_GIF_IMAGE", "JPG veya GIF resmi");
	//Comment Title
	define("LANG_LABEL_COMMENTTITLE", "Yorum Başlığı");
	//Comment
	define("LANG_LABEL_COMMENT", "Yorum");
	//Accepted
	define("LANG_LABEL_ACCEPTED", "Kabul Edildi");
	//Approved
	define("LANG_LABEL_APPROVED", "Onaylandı");
	//Success
	define("LANG_LABEL_SUCCESS", "Başarılı");
	//Completed
	define("LANG_LABEL_COMPLETED", "Tamamlandı");
	//Y
	define("LANG_LABEL_Y", "E");
	//Failed
	define("LANG_LABEL_FAILED", "Başarısız");
	//Declined
	define("LANG_LABEL_DECLINED", "Reddedildi");
	//failure
	define("LANG_LABEL_FAILURE", "başarısızlık");
	//Canceled
	define("LANG_LABEL_CANCELED", "İptal Edildi");
	//Error
	define("LANG_LABEL_ERROR", "Hata");
	//Transaction Code
	define("LANG_LABEL_TRANSACTION_CODE", "İşlem Kodu");
	//Subscription ID
	define("LANG_LABEL_SUBSCRIPTION_ID", "Abone Numarası");
	//transaction history
	define("LANG_LABEL_TRANSACTION_HISTORY", "işlem geçmişi");
	//Authorization Code
	define("LANG_LABEL_AUTHORIZATION_CODE", "Onay Kodu");
	//Transaction Status
	define("LANG_LABEL_TRANSACTION_STATUS", "İşlem Durumu");
	//Transaction Error
	define("LANG_LABEL_TRANSACTION_ERROR", "İşlem Hatası");
	//Monthly Bill Amount
	define("LANG_LABEL_MONTHLY_BILL_AMOUNT", "Aylık Fatura Tutarı");
	//Transaction OID
	define("LANG_LABEL_TRANSACTION_OID", "İşlem Nesne Numarası");
	//Yearly Bill Amount
	define("LANG_LABEL_YEARLY_BILL_AMOUNT", "Yıllık Fatura Tutarı");
	//Bill Amount
	define("LANG_LABEL_BILL_AMOUNT", "Fatura Tutarı");
	//Transaction ID
	define("LANG_LABEL_TRANSACTION_ID", "İşlem Numarası");
	//Receipt ID
	define("LANG_LABEL_RECEIPT_ID", "Makbuz Numarası");
	//Subscribe ID
	define("LANG_LABEL_SUBSCRIBE_ID", "Abone Numarası");
	//Transaction Order ID
	define("LANG_LABEL_TRANSACTION_ORDERID", "İşlem Sıra Numarası");
	//your
	define("LANG_LABEL_YOUR", "sizin");
	//Make Your
	define("LANG_LABEL_MAKE_YOUR", "Yapınız");
	//Payment
	define("LANG_LABEL_PAYMENT", "Ödemenizi");
	//History
	define("LANG_LABEL_HISTORY", "Geçmiş");
	//Sign in
	define("LANG_LABEL_LOGIN", "Oturum aç");
	//Transaction canceled
	define("LANG_LABEL_TRANSACTION_CANCELED", "İşlem iptal edildi");
	//Transaction amount
	define("LANG_LABEL_TRANSACTION_AMOUNT", "İşlem tutarı");
	//Pay
	define("LANG_LABEL_PAY", "Öde");
	//Back
	define("LANG_LABEL_BACK", "Geri");
	//Total Price
	define("LANG_LABEL_TOTAL_PRICE", "Toplam Fiyat");
	//Pay By Invoice
	define("LANG_LABEL_PAY_BY_INVOICE", "Fatura İle Öde");
	//Administrator
	define("LANG_LABEL_ADMINISTRATOR", "Yönetici");
	//Billing Info
	define("LANG_LABEL_BILLING_INFO", "Fatura Bilgisi");
	//Card Number
	define("LANG_LABEL_CARD_NUMBER", "Kart Numarası");
	//Card Expire date
	define("LANG_LABEL_CARD_EXPIRE_DATE", "Kartın Son Kullanma Tarihi");
	//Card Code
	define("LANG_LABEL_CARD_CODE", "Kart Kodu");
	//Customer Info
	define("LANG_LABEL_CUSTOMER_INFO", "Müşteri Bilgileri");
	//zip
	define("LANG_LABEL_ZIP", "posta kodu");
	//Place Order and Continue
	define("LANG_LABEL_PLACE_ORDER_CONTINUE", "Sipariş Ver ve Devam Et");
	//General Information
	define("LANG_LABEL_GENERAL_INFORMATION", "Genel Bilgiler");
	//Phone Number
	define("LANG_LABEL_PHONE_NUMBER", "Telefon Numarası");
	//E-mail Address
	define("LANG_LABEL_EMAIL_ADDRESS", "E-posta Adresi");
	//Credit Card Information
	define("LANG_LABEL_CREDIT_CARD_INFORMATION", "Kredi Kartı Bilgileri");
	//Exp. Date
	define("LANG_LABEL_EXP_DATE", "Son Kullanma Tarihi");
	//Customer Information
	define("LANG_LABEL_CUSTOMER_INFORMATION", "Müşteri Bilgileri");
	//Card Expiration
	define("LANG_LABEL_CARD_EXPIRATION", "Kartın Son Kullanma Tarihi");
	//Name on Card
	define("LANG_LABEL_NAME_ON_CARD", "Kartın Üzerindeki İsim");
	//Card Type
	define("LANG_LABEL_CARD_TYPE", "Kart Türü");
	//Card Verification Number
	define("LANG_LABEL_CARD_VERIFICATION_NUMBER", "Kart Onay Numarası");
	//Province
	define("LANG_LABEL_PROVINCE", "İl");
	//Postal Code
	define("LANG_LABEL_POSTAL_CODE", "Posta Kodu");
	//Post Code
	define("LANG_LABEL_POST_CODE", "Posta Kodu");
	//Tel
	define("LANG_LABEL_TEL", "Tel");
	//Select Date
	define("LANG_LABEL_SELECTDATE", "Tarih Seç");
	//Found
	define("LANG_PAGING_FOUND", "Bulundu");
	//Found
	define("LANG_PAGING_FOUND_PLURAL", "Bulundu");
	//record
	define("LANG_PAGING_RECORD", "kayıt");
	//records
	define("LANG_PAGING_RECORD_PLURAL", "kayıt");
	//Showing page
	define("LANG_PAGING_SHOWINGPAGE", "Gösteriyor");
	//of
	define("LANG_PAGING_PAGEOF", ".sayfayı");
	//pages
	define("LANG_PAGING_PAGE_PLURAL", "sayfadan");
	//Go to page
	define("LANG_PAGING_GOTOPAGE", "Sayfaya git");
	//Select
	define("LANG_PAGING_ORDERBYPAGE_SELECT", "Seç");
	//Order by:
	define("LANG_PAGING_ORDERBYPAGE", "Sırala:");
	//Characters
	define("LANG_PAGING_ORDERBYPAGE_CHARACTERS", "Alfabetik");
	//Last update
	define("LANG_PAGING_ORDERBYPAGE_LASTUPDATE", "Son Güncellenme Tarihi");
	//Date created
	define("LANG_PAGING_ORDERBYPAGE_DATECREATED", "Eklenme Tarihi");
	//Popular
	define("LANG_PAGING_ORDERBYPAGE_POPULAR", "Popüler");
	//Rating
	define("LANG_PAGING_ORDERBYPAGE_RATING", "Puanlama");
	//Price
	define("LANG_PAGING_ORDERBYPAGE_PRICE", "Fiyat");
	//previous page
	define("LANG_PAGING_PREVIOUSPAGE", "önceki sayfa");
	//next page
	define("LANG_PAGING_NEXTPAGE", "sonraki sayfa");
	//"previous" page
	define("LANG_PAGING_PREVIOUSPAGEMOBILE", "önce");
	//"next" page
	define("LANG_PAGING_NEXTPAGEMOBILE", "sonra");
	//Article successfully added!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_ADDED", "Makale başarıyla eklendi!");
	//Banner successfully added!
	define("LANG_MSG_BANNER_SUCCESSFULLY_ADDED", "Afiş başarıyla eklendi!");
	//Classified successfully added!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_ADDED", "Ilan başarıyla eklendi!");
	//Event successfully added!
	define("LANG_MSG_EVENT_SUCCESSFULLY_ADDED", "Aktivite başarıyla eklendi!");
	//Gallery successfully added!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_ADDED", "Foto galeri başarıyla eklendi!");
	//Listing successfully added!
	define("LANG_MSG_LISTING_SUCCESSFULLY_ADDED", "Liste başarıyla eklendi!");
	//Deal successfully added!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_ADDED", "Teklif başarıyla eklendi!");
	//Article successfully updated!
	define("LANG_MSG_ARTICLE_SUCCESSFULLY_UPDATED", "Makale başarıyla güncellendi!");
	//Banner successfully updated!
	define("LANG_MSG_BANNER_SUCCESSFULLY_UPDATED", "Afiş başarıyla güncellendi!");
	//Classified successfully updated!
	define("LANG_MSG_CLASSIFIED_SUCCESSFULLY_UPDATED", "Ilan başarıyla güncellendi!");
	//Event successfully updated!
	define("LANG_MSG_EVENT_SUCCESSFULLY_UPDATED", "Aktivite başarıyla güncellendi!");
	//Gallery successfully updated!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_UPDATED", "Foto galeri başarıyla güncellendi!");
	//Listing successfully updated!
	define("LANG_MSG_LISTING_SUCCESSFULLY_UPDATED", "Liste başarıyla güncellendi!");
	//Deal successfully updated!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_UPDATED", "Teklif başarıyla güncellendi!");
	//Map Tuning successfully updated!
	define("LANG_MSG_MAPTUNING_SUCCESSFULLY_UPDATED", "Harita ayarları başarıyla güncellendi!");
	//Gallery successfully changed!
	define("LANG_MSG_GALLERY_SUCCESSFULLY_CHANGED", "Foto galeri başarıyla changed!");
	//Deal was successfully deleted!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_DELETED", "Teklif başarıyla silindi!");
	//Deal successfully changed!
	define("LANG_MSG_PROMOTION_SUCCESSFULLY_CHANGED", "Teklif başarıyla değiştirildi!");
	//Banner successfully deleted!
	define("LANG_MSG_BANNER_SUCCESSFULLY_DELETED", "Afiş başarıyla silindi!");
	//Invalid image type. Please insert one image JPG, GIF or PNG.
	define("LANG_MSG_INVALID_IMAGE_TYPE", "Geçersiz resim türü. Lütfen JPG, GIF veya PNG türünden resimler ekleyin.");
	//The image file is too large
	define("LANG_MSG_IMAGE_FILE_TOO_LARGE", "Resim dosyası çok büyük.");
	//Please try again with another image
	define("LANG_PLEASE_TRY_AGAIN_WITH_ANOTHER_IMAGE", "Lütfen başka bir resim seçip tekrar deneyiniz.");
	//Attached file was denied. Invalid file type.
	define("LANG_MSG_ATTACHED_FILE_DENIED", "Eklenen dosya kabul edilmedi. Geçersiz dosya türü.");
	//Click here to view this gallery
	define("LANG_MSG_CLICK_TO_VIEW_GALLERY", "Bu foto galeriyi görmek için tıklayın");
	//Click here to manage this gallery images
	define("LANG_MSG_CLICKTOMANAGEGALLERYIMAGES", "Foto galeri resimlerini yönetmek için tıklayın");
	//Please type your username.
	define("LANG_MSG_TYPE_USERNAME", "Lütfen e-posta adresinizi girin.");
	//Username was not found.
	define("LANG_MSG_USERNAME_WAS_NOT_FOUND", "E-posta adresi bulunamadı.");
	//Please try again or contact support at:
	define("LANG_MSG_TRY_AGAIN_OR_CONTACT_SUPPORT", "Lütfen tekrar deneyin ya da teknik destekle iletişime geçin:");
	//System Forgotten Password is disabled.
	define("LANG_MSG_FORGOTTEN_PASSWORD_DISABLED", "Unutulmuş Şifre Sistemi devre dışı bırakıldı.");
	//Please contact support at:
	define("LANG_MSG_CONTACT_SUPPORT", "Lütfen teknik destekle iletişime geçin:");
	//Thank you!
	define("LANG_MSG_THANK_YOU", "Teşekkürler!");
	//An e-mail was sent to the account holder with instructions to obtain a new password
	define("LANG_MSG_EMAIL_WAS_SENT_TO_ACCOUNT_HOLDER", "Yeni şifre almak için gereken talimatların bulunduğu bir e-posta hesap sahibine gönderildi.");
	//File not found!
	define("LANG_MSG_FILE_NOT_FOUND", "Dosya bulunamadı!");
	//Error! No Thumb Image!
	define("LANG_MSG_ERRORNOTHUMBIMAGE", "Hata! Küçük Resim Görüntüsü Yok!");
	//No Images have been uploaded into this gallery yet!
	define("LANG_MSG_NOIMAGESUPLOADEDYET", "Bu foto galeriye henüz hiçbir resim eklenmemiş!");
	//Click here to print the invoice
	define("LANG_MSG_CLICK_TO_PRINT_INVOICE", "Faturayı yazdırmak için tıklayın");
	//Click here to view the invoice detail
	define("LANG_MSG_CLICK_TO_VIEW_INVOICE_DETAIL", "Fatura detaylarını görmek için tıklayın");
	//(prices amount are per installments)
	define("LANG_MSG_PRICES_AMOUNT_PER_INSTALLMENTS", "(fiyatlar kurulum başınadır)");
	//Unpaid Item
	define("LANG_MSG_UNPAID_ITEM", "Ödenmemiş Kayıt");
	//No Check Out Needed
	define("LANG_MSG_NO_CHECKOUT_NEEDED", "Hesap Kapatımı Gerekli Değil");
	//(Move the mouse over the bars to see more details about the graphic)
	define("LANG_MSG_MOVE_MOUSEOVER_THE_BARS", "(Grafik hakkında daha fazla detay görmek için çubukların üzerinden mouse ile geçin)");
	//(Click the report type to display graph)
	define("LANG_MSG_CLICK_REPORT_TYPE", "(Grafiği görmek için rapor türünün üzerine tıklayın)");
	//Click here to view this review
	define("LANG_MSG_CLICK_TO_VIEW_THIS_REVIEW", "Bu yorumu görmek için tıklayın");
	//Click here to edit this review
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REVIEW", "Bu yorumu düzenlemek için tıklayın");
	//Click here to edit this reply
	define("LANG_MSG_CLICK_TO_EDIT_THIS_REPLY", "Bu cevabı düzenlemek için tıklayın");
	//Click here to delete this review
	define("LANG_MSG_CLICK_TO_DELETE_THIS_REVIEW", "Bu yorumu silmek için tıklayın");
	//Waiting Site Manager approve
	define("LANG_MSG_WAITINGSITEMGRAPPROVE", "Site Yöneticisinin Onayını Bekliyor");
	//Waiting Site Manager approve for Review
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW", "Yorum için Site Yöneticisinin Onayı Bekleniyor");
	//Waiting Site Manager approve for Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REPLY", "Cevap için Site Yöneticisinin Onayı Bekleniyor");
	//Waiting Site Manager approve for Review Reply
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_REVIEW_REPLY", "Yorum ve Cevap için Site Yöneticisinin Onayı Bekleniyor");
	//Review already approved
	define("LANG_MSG_REVIEW_ALREADY_APPROVED", "Bu Yorum Onaylandı Bile");
	//Review and Reply already approved
	define("LANG_MSG_REVIEWANDREPLY_ALREADY_APPROVED", "Bu Yorum ve de Cevap Onaylandı Bile");
	//Review pending approval
	define("LANG_REVIEW_PENDINGAPPROVAL", "Yorum Onay Bekliyor");
	//Reply pending approval
	define("LANG_REPLY_PENDINGAPPROVAL", "Cevap Onay Bekliyor");
	//Review active
	define("LANG_REVIEW_ACTIVE", "Yorum Aktif");
	//Reply active
	define("LANG_REPLY_ACTIVE", "Cevap Aktif");
	//Review and Reply pending approval
	define("LANG_REVIEWANDREPLY_PENDINGAPPROVAL", "Yorum ile Cevap Onay Bekliyor");
	//Review and Reply active
	define("LANG_REVIEWANDREPLY_ACTIVE", "Yorum ile Cevap Aktif");
	//Reply
	define("LANG_REPLY", "Cevap");
	//Reply (noun)
	define("LANG_REPLYNOUN", "Cevap");
	//Review and Reply
	define("LANG_REVIEWANDREPLY", "Yorum ile Cevap");
	//Edit Review
	define("LANG_LABEL_EDIT_REVIEW", "Yorumu Düzenle");
	//Edit Reply
	define("LANG_LABEL_EDIT_REPLY", "Cevabı Düzenle");
	//Approve Review
	define("LANG_SITEMGR_APPROVE_REVIEW", "Yorumu Onayla");
	//Approve Reply
	define("LANG_SITEMGR_APPROVE_REPLY", "Cevabı Onayla");
	//Reply already approved
	define("LANG_MSG_RESPONSE_ALREADY_APPROVED", "Cevap  Onaylandı Bile");
	//Review successfully sent!
	define("LANG_REVIEW_SUCCESSFULLY", "Yorum başarıyla gönderildi!");
	//Reply successfully sent!
	define("LANG_REPLY_SUCCESSFULLY", "Cevap başarıyla gönderildi!");
	//Please type a valid reply!
	define("LANG_REPLY_EMPTY", "Lütfen geçerli bir cevap yazın!");
	//Please type a valid name
	define("LANG_REVIEW_EMPTY_NAME", "Lütfen geçerli bir isim yazın!");
	//Please type a valid e-mail
	define("LANG_REVIEW_EMPTY_EMAIL", "Lütfen geçerli bir e-posta adresi yazın");
	//Please type a valid city, State
	define("LANG_REVIEW_EMPTY_LOCATION", "Lütfen geçerli bir il, ilçe yazın");
	//Please type a valid review title
	define("LANG_REVIEW_EMPTY_TITLE", "Lütfen geçerli bir başlık yazın");
	//Please type a valid review!
	define("LANG_REVIEW_EMPTY", "Lütfen geçerli bir yorum yazın!");
	//Please choose an option or click in cancel to exit.
	define("LANG_STATUS_EMPTY", "Lütfen bir seçeneği işaretleyin veya çıkmak için iptali tıklayın.");
	//Click here to reply this review
	define("LANG_MSG_REVIEW_REPLY", "Bu yoruma cevap yazmak için tıklayın");
	//Click here to view the transaction
	define("LANG_MSG_CLICK_TO_VIEW_TRANSACTION", "İşlemi görmek için tıklayın");
	//Username must be between
	define("LANG_MSG_USERNAME_MUST_BE_BETWEEN", "E-posta arasında olmalıdır");
	//characters with no spaces.
	define("LANG_MSG_CHARACTERS_WITH_NO_SPACES", "karakterlerin arasında boşluk olmamalıdır.");
	//Password must be between
	define("LANG_MSG_PASSWORD_MUST_BE_BETWEEN", "Şifre arasında olmalıdır");
	//Type you password here if you want to change it.
	define("LANG_MSG_TIPE_YOUR_PASSWORD_HERE_IF_YOU_WANT_TO_CHANGE_IT", "Değiştirmek isterseniz şifrenizi buraya girin.");
	//Password is going to be sent to Member E-mail Address.
	define("LANG_MSG_PASSWORD_SENT_TO_MEMBER_EMAIL", "Şifre Üyenin E-Posta Adresine gönderilecektir.");
	//Please write down your username and password for future reference.
	define("LANG_MSG_WRITE_DOWN_YOUR_USERNAME_PASSWORD", "Lütfen ileride referans olması için kullanıcı adı ve şifrenizi not alın.");
	//Please check the agreement terms.
	define("LANG_MSG_ALERT_AGREE_WITH_TERMS_OF_USE", "Lütfen anlaşma şartlarını işaretleyin.");
	//successfully added
	define("LANG_MSG_CATEGORY_SUCCESSFULLY_ADDED", "Başarıyla eklendi!");
	//This category was already inserted
	define("LANG_MSG_CATEGORY_ALREADY_INSERTED", "Daha önceden eklediniz bile");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_CATEGORY", "Lütfen geçerli bir kategori seçin");
	//Please, select a category first
	define("LANG_MSG_SELECT_CATEGORY_FIRST", "Lütfen önce bir kategori seçin");
	//You can choose a page name title to be accessed directly from the web browser as a static html page. The chosen page name title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_MSG_FRIENDLY_URL1", "Statik bir html sayfası olarak web tarayıcısından doğrudan erişilebilen bir sayfa adı başlığı seçebilirsiniz. Seçilen sayfa adı başlığı harfli veya rakamlı karakterlerden oluşmalıdır (\"a-z\" ve/veya \"0-9\" gibi) ve boşluk yerine \"-\" kullanılmalıdır.");
	//The page name title "John Auto Repair" will be available through the url:
	define("LANG_MSG_FRIENDLY_URL2", "Sayfa adı başlığı \"John Oto Tamir\" url üzerinden erişilebilecektir:");
	//"Additional images may be added to the" [GALLERYIMAGE] gallery (If it is enabled).
	define("LANG_MSG_ADDITIONAL_IMAGES_MAY_BE_ADDED", "Ek resimler galeriye");
	//Additional images may be added to the [GALLERYIMAGE] "gallery (If it is enabled)."
	define("LANG_MSG_ADDITIONAL_IMAGES_IF_ENABLED", "eklenebilir (Eğer etkinleştirildiyse).");
	//Maximum file size
	define("LANG_MSG_MAX_FILE_SIZE", "En fazla dosya büyüklüğü");
	//Transparent .gif or .png not supported
	define("LANG_MSG_TRANSPARENTGIF_NOT_SUPPORTED", "Saydam .gif veya .png desteklenmemektedir");
	//Animated .gif isn't supported.
	define("LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED", "Animasyonlu gif desteklenmemektedir.");
	//Please be sure that your image dimensions fit within the recommended pixel sizes, otherwise, image quality can be effected.
	define("LANG_MSG_IMAGE_DIMENSIONS_ALERT", "Lütfen resim boyutlarının önerilen pixel büyüklüklerine uyduğundan emin olun yoksa resim kalitesi bundan etkilenebilir.");
	//Check this box to remove your existing image
	define("LANG_MSG_CHECK_TO_REMOVE_IMAGE", "Var olan resminizi kaldırmak için bu kutuyu işaretleyin");
	//max 250 characters
	define("LANG_MSG_MAX_250_CHARS", "en fazla 250 karakter");
	//max 100 characters
	define("LANG_MSG_MAX_100_CHARS", "en fazla 100 karakter");
	//characters left
	define("LANG_MSG_CHARS_LEFT", "karakter kaldı");
	//(including spaces and line breaks)
	define("LANG_MSG_INCLUDING_SPACES_LINE_BREAKS", "(boşluklar ve satır başları dahil)");
	//Include up to
	define("LANG_MSG_INCLUDE_UP_TO_KEYWORDS", "e kadar dahil");
	//keywords with a maximum of 50 characters each.
	define("LANG_MSG_KEYWORDS_WITH_MAXIMUM_50", "her anahtar sözcük başına en fazla 50 karakter.");
	//Add one keyword or keyword phrase per line. For example:
	define("LANG_MSG_KEYWORD_PER_LINE", "satır başına bir anahtar sözcük veya anahtar cümle ekleyin. Örnek:");
	//Only select sub-categories that directly apply to your type.
	define("LANG_MSG_ONLY_SELECT_SUBCATEGS", "Sadece kendi türünüzle doğrudan alakalı alt-kategoriler seçin.");
	//Your article will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_ARTICLE_AUTOMATICALLY_APPEAR", "Makaleniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//maximum 25 characters
	define("LANG_MSG_MAX_25_CHARS", "en fazla 25 karakter");
	//maximum 500 characters
	define("LANG_MSG_MAX_500_CHARS", "en fazla 500 karakter");
	//Allowed file types
	define("LANG_MSG_ALLOWED_FILE_TYPES", "İzin verilen dosya türleri");
	//Click here to preview this listing
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_LISTING", "Bu listenin ön izlemesi için tıklayın");
	//Click here to preview this event
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_EVENT", "Bu makalenin ön izlemesi için tıklayın");
	//Click here to preview this classified
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_CLASSIFIED", "Bu ilanın ön izlemesi için tıklayın");
	//Click here to preview this article
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_ARTICLE", "Bu makalenin ön izlemesi için tıklayın");
	//Click here to preview this banner
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_BANNER", "Bu afişin ön izlemesi için tıklayın");
	//Click here to preview this deal
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_PROMOTION", "Bu teklif ön izlemesi için tıklayın");
	//Click here to preview this gallery
	define("LANG_MSG_CLICK_TO_PREVIEW_THIS_GALLERY", "Bu galerinin ön izlemesi için tıklayın");
	//maximum 30 characters
	define("LANG_MSG_MAX_30_CHARS", "en fazla 30 karakter");
	//Select a Country
	define("LANG_MSG_SELECT_A_COUNTRY", "Bir Ülke seçin");
	//Select a Region
	define("LANG_MSG_SELECT_A_REGION", "Bir Bölge seçin");
	//Select a State
	define("LANG_MSG_SELECT_A_STATE", "Bir İl seçin");
	//Select a City
	define("LANG_MSG_SELECT_A_CITY", "Bir İlçe seçin");	
	//Select a Neighborhood
	define("LANG_MSG_SELECT_A_NEIGHBORHOOD", "Bir Mahalle seçin");
	//(This information will not be displayed publicly)
	define("LANG_MSG_INFO_NOT_DISPLAYED", "(Bu bilgiler herkese açık olarak gösterilmeyecektir)");
	//Your event will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_EVENT_AUTOMATICALLY_APPEAR", "Aktiviteniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");	
	//If video snippet code was filled in", it will appear on the detail page
	define("LANG_MSG_VIDEO_SNIPPET_CODE", "Eğer video kodu doldurulmuşsa, video detay sayfasında gözükecektir");
	//Maximum video code size supported
	define("LANG_MSG_MAX_VIDEO_CODE_SIZE", "Desteklenen en fazla video büyüklüğü");
	//If the video code size is bigger than supported video size, it will be modified.
	define("LANG_MSG_VIDEO_MODIFIED", "Eğer video kodunun büyüklüğü desteklenen video büyüklüğünden daha fazlaysa video değişikliğe uğrayacaktir.");
	//Attachment has no caption
	define("LANG_MSG_ATTACHMENT_HAS_NO_CAPTION", "Eklentinin hiçbir altbaşlığı yok ");
	//Check this box to remove existing listing attachment
	define("LANG_MSG_CLICK_TO_REMOVE_ATTACHMENT", "Var olan liste eklentisini çıkarmak için bu kutuyu işaretleyin");
	//Add one phrase per line. For example
	define("LANG_MSG_PHRASE_PER_LINE", "Her satır başına bir cümle ekleyin. Örnek");
	//Extra categories/sub-categories cost an
	define("LANG_MSG_EXTRA_CATEGORIES_COST", "Ekstra kategoriler/alt-kategoriler her kategori başına");
	//additional
	define("LANG_MSG_ADDITIONAL", "fazladan");
	//each. Be seen!
	define("LANG_MSG_BE_SEEN", "mal olmaktadır. Kendinizi belli edin!");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_LISTING_AUTOMATICALLY_APPEAR", "Listeniz seçtiğiniz her alt-kategorinin ana kategorisinin altında gözükecektir.");
	//If you add new categories, your listing will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_LISTING_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, listeniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your article will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_ARTICLE_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, makaleniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your classified will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_CLASSIFIED_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, ilanınız site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//If you add new categories, your event will not appear in the main category of each sub-category you added until site manager approve them.
	define("LANG_MSG_EVENT_TEMPORARY_CATEGORY", "Eğer yeni kategori eklerseniz, makaleniz site yöneticisi onaylamadan eklediğiniz alt-kategorinin ana kategorisinin altında gözükmeyecektir.");
	//Request your listing to be considered for the following badges.
	define("LANG_MSG_REQUEST_YOUR_LISTING", "Listenizin aşağıdaki rozetler için değerlendirilmesi için istekte bulunun.");
	//Click here to select date
	define("LANG_MSG_CLICK_TO_SELECT_DATE", "Tarih seçmek için tıklayın");
	//"Click on the" gallery icon below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_CLICK_GALLERY_BELOW", "Foto galerinize resim eklemek isterseniz");
	//Click on the "gallery icon" below if you wish to add photos to your photo gallery.
	define("LANG_LISTING_GALLERY_ICON", "aşağıdaki galeri sembolüne");
	//Click on the gallery icon "below if you wish to add photos to your photo gallery."
	define("LANG_LISTING_IFYOUWISHADDPHOTOS", "tıklayın.");
	//"Click on the" deal icon below if you wish to add deal to your listing.
	define("LANG_LISTING_CLICK_PROMOTION_BELOW", "Tıklayın");
	//Click on the "deal icon" below if you wish to add deal to your listing.
	define("LANG_LISTING_PROMOTION_ICON", "aşağıdaki teklif sembolüne");
	//Click on the deal icon "below if you wish to add deal to your listing."
	define("LANG_LISTING_IFYOUWISHADDPROMOTION", "eğer şirketinize teklif eklemek isterseniz.");
	//You can add deal to your listing by clicking on the link
	define("LANG_LISTING_YOUCANADDPROMOTION", "Linke tıklayarak listeninize teklif ekleyebilirsiniz.");
	//add deal
	define("LANG_LISTING_ADDPROMOTION", "teklif ekle");
	//All pages but item pages
	define("LANG_ALLPAGESBUTITEMPAGES", "Kayıt sayfaları dışındaki bütün sayfalar");
	//All pages
	define("LANG_ALLPAGES", "Bütün sayfalar");
	//Non-category search
	define("LANG_NONCATEGORYSEARCH", "Kategori harici arama");
	//deal
	define("LANG_ICONPROMOTION", "teklif");
	//e-mail to friend
	define("LANG_ICONEMAILTOFRIEND", "arkadaşına gönder");
	//add to favorites
	define("LANG_ICONQUICKLIST_ADD", "favorilerime ekle");
	//remove from favorites
	define("LANG_ICONQUICKLIST_REMOVE", "favorilerimden kaldır");
	//print
	define("LANG_ICONPRINT", "yazdır");
	//map
	define("LANG_ICONMAP", "harita");
	//Add to
	define("LANG_ADDTO_SOCIALBOOKMARKING", "Ekle");
	//Google maps are not available. Please contact the administrator.
	define("LANG_GOOGLEMAPS_NOTAVAILABLE_CONTACTADM", "Google haritası mevcut değil. Lütfen yöneticiyle iletişime geçin.");
	//Remove
	define("LANG_QUICKLIST_REMOVE", "Kaldır");
	//Favorite Articles
	define("LANG_FAVORITE_ARTICLE", "Favori Makaleler");
	//Favorite Classifieds
	define("LANG_FAVORITE_CLASSIFIED", "Favori İlanlar");
	//Favorite Events
	define("LANG_FAVORITE_EVENT", "Favori Aktiviteler");
	//Favorite Listings
	define("LANG_FAVORITE_LISTING", "Favori Listeler");
	//Favorite Deals
	define("LANG_FAVORITE_PROMOTION", "Favori Teklifler");
	//Published
	define("LANG_ARTICLE_PUBLISHED", "Yayın Tarihi");
	//More Info
	define("LANG_CLASSIFIED_MOREINFO", "Daha Fazla Bilgi");
	//Date
	define("LANG_EVENT_DATE", "Tarih");
	//Time
	define("LANG_EVENT_TIME", "Saat");
	//Get driving directions
	define("LANG_EVENT_DRIVINGDIRECTIONS", "Yol tarifi alın");
	//Website
	define("LANG_EVENT_WEBSITE", "Websitesi");
	//phone
	define("LANG_EVENT_LETTERPHONE", "Telefon");
	//More
	define("LANG_EVENT_MORE", "Daha fazla");
	//More Info
	define("LANG_EVENT_MOREINFO", "Daha Fazla Bilgi");
	//See all categories
	define("LANG_SEEALLCATEGORIES", "Tüm kategoriler bak");
	//View all categories
	define("LANG_LISTING_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//More Info
	define("LANG_LISTING_MOREINFO", "Daha Fazla Bilgi");
	//view phone
	define("LANG_LISTING_VIEWPHONE", "telefonu gör");
	//view fax
	define("LANG_LISTING_VIEWFAX", "faksı gör");
	//send an e-mail
	define("LANG_SEND_AN_EMAIL", "e-posta gönder");
	//Click here to see more info!
	define("LANG_LISTING_ATTACHMENT", "Daha fazla bilgi için tıklayın!");
	//Complete the form below to contact us.
	define("LANG_LISTING_CONTACTTITLE", "Bizimle iletişime geçmek için aşağıdaki formu doldurun.");
	//Contact this Listing
	define("LANG_LISTING_CONTACT", "Listenın İletişim");
	//E-mail an inquiry
	define("LANG_LISTING_INQUIRY", "Soru Gönder");
	//phone
	define("LANG_LISTING_LETTERPHONE", "telefon");
	//fax
	define("LANG_LISTING_LETTERFAX", "faks");
	//website
	define("LANG_LISTING_LETTERWEBSITE", "websitesi");
	//e-mail
	define("LANG_LISTING_LETTEREMAIL", "e-posta");
	//offers the following products and/or services:
	define("LANG_LISTING_OFFERS", "aşağıdaki ürün ve/veya hizmetleri sunmaktadır:");
	//Hours of work
	define("LANG_LISTING_HOURS_OF_WORK", "Çalışma saatleri");
	//Check in
	define("LANG_CHECK_IN", "Giriş yapın");
	//No review comment found for this item!
	define("LANG_REVIEW_NORECORD", "Bu kayıt için hiçbir yorum bulunamadı!");
	//Reviews and comments from the last month
	define("LANG_REVIEWS_MONTH", "Yorum ve son bir ay yorumlarına");
	//Review
	define("LANG_REVIEW", "Yorum");
	//Reviews
	define("LANG_REVIEW_PLURAL", "Yorum");
	//Reviews
	define("LANG_REVIEWTITLE", "Yorum");
	//review
	define("LANG_REVIEWCOUNT", "yorum");
	//reviews
	define("LANG_REVIEWCOUNT_PLURAL", "yorum");
	//check in
	define("LANG_CHECKINCOUNT", "giriş yapın");
	//check ins
	define("LANG_CHECKINCOUNT_PLURAL", "girişler");
	//See check ins
	define("LANG_CHECKINSEECOMMENTS", "Girişleri gör");
	//Check ins of
	define("LANG_CHECKINSOF", "Girişleri");
	//No check in found for this item!
	define("LANG_CHECKIN_NORECORD", "Bu kayıt için hiçbir giriş bulunamadı!");
	//Related Categories
	define("LANG_RELATEDCATEGORIES", "İlgili Kategoriler");
	//Subcategories
	define("LANG_LISTING_SUBCATEGORIES", "Altkategoriler");
	//See comments
	define("LANG_REVIEWSEECOMMENTS", "Yorumları gör");
	//Rate it!
	define("LANG_REVIEWRATEIT", "Puanla!");
	//Be the first to review this item!
	define("LANG_REVIEWBETHEFIRST", "Bu kaydı yorumlayan ilk kişi sen ol!");
	//Offered by
	define("LANG_PROMOTION_OFFEREDBY", "Tarafından sunuldu");
	//More Info
	define("LANG_PROMOTION_MOREINFO", "Daha Fazla Bilgi");
	//Valid from
	define("LANG_PROMOTION_VALIDFROM", "Geçerli");
	//to
	define("LANG_PROMOTION_VALIDTO", "e kadar");
	//Print Deal
	define("LANG_PROMOTION_PRINT", "Teklif Yazdır");
	//Article
	define("LANG_ARTICLE_FEATURE_NAME", "Makale");
	//Articles
	define("LANG_ARTICLE_FEATURE_NAME_PLURAL", "Makaleler");
	//Banner
	define("LANG_BANNER_FEATURE_NAME", "Afiş");
	//Banners
	define("LANG_BANNER_FEATURE_NAME_PLURAL", "Afişler");
	//Classified
	define("LANG_CLASSIFIED_FEATURE_NAME", "İlan");
	//Classifieds
	define("LANG_CLASSIFIED_FEATURE_NAME_PLURAL", "İlanlar");
	//Event
	define("LANG_EVENT_FEATURE_NAME", "Aktivite");
	//Events
	define("LANG_EVENT_FEATURE_NAME_PLURAL", "Aktiviteler");
	//Listing
	define("LANG_LISTING_FEATURE_NAME", "Liste");
	//Listings
	define("LANG_LISTING_FEATURE_NAME_PLURAL", "Listeler");
	//Deal
	define("LANG_PROMOTION_FEATURE_NAME", "Teklif");
	//Deals
	define("LANG_PROMOTION_FEATURE_NAME_PLURAL", "Teklifler");
	//Send
	define("LANG_BUTTON_SEND", "Gönder");
	//Sign Up
	define("LANG_BUTTON_SIGNUP", "Kaydol");
	//View Category Path
	define("LANG_BUTTON_VIEWCATEGORYPATH", "Kategori Yolunu Gör");
	//More info
	define("LANG_VIEWCATEGORY", "Daha fazla bilgi");
	//No info found
	define("LANG_NOINFO", "Hiçbir bilgi bulunamadı");
	//Remove Selected Category
	define("LANG_BUTTON_REMOVESELECTEDCATEGORY", "Seçilen Kategoriyi Kaldır");
	//Continue
	define("LANG_BUTTON_CONTINUE", "Devam Et");
	//No, thank you
	define("LANG_BUTTON_NO_THANKS", "Hayır, teşekkürler.");
	//Yes, continue
	define("LANG_BUTTON_YES_CONTINUE", "Evet, teşekkürler.");
	//No, Order without the Package!
	define("LANG_BUTTON_NO_ORDER_WITHOUT", "Hayır, Paket olmadan sipariş et.");
	//Increase your Visibility!
	define("LANG_INCREASE_VISIBILITY", "Görünürlüğünüzü Arttırın!");
	//Gift
	define("LANG_GIFT", "Hediye");
	//Help to Increase your visibility, check our 
	define("LANG_HELP_INCREASE", "Görünürlüğünüzü arttırmak için yardımcı olun, kontrol edin ");
	//Site statistics
	define("LANG_DOMAIN_STATISTICS", "Site istatistikleri!");
	//Visitors per Month
	define("LANG_VISITOR_MONTH", "Ay başına ziyaretçi");
	//Custom option
	define("LANG_CUSTOM_OPTION", "Özel seçenekler");
	//Ok
	define("LANG_BUTTON_OK", "Tamam");
	//Cancel
	define("LANG_BUTTON_CANCEL", "İptal");
	//Sign In
	define("LANG_BUTTON_LOGIN", "Oturum aç");
	//Save Map Tuning
	define("LANG_BUTTON_SAVE_MAP_TUNING", "Harita Ayarlarını Kaydet");
	//Clear Map Tuning
	define("LANG_BUTTON_CLEAR_MAP_TUNING", "Harita Ayarlarını Temizle");
	//Next
	define("LANG_BUTTON_NEXT", "Sonraki");
	//Pay By CreditCard
	define("LANG_BUTTON_PAY_BY_CREDIT_CARD", "Kredi Kartı İle Öde");
	//Pay By PayPal
	define("LANG_BUTTON_PAY_BY_PAYPAL", "PayPal İle Öde");
	//Pay By SimplePay
	define("LANG_BUTTON_PAY_BY_SIMPLEPAY", "SimplePay İle Öde");
	//Search
	define("LANG_BUTTON_SEARCH", "Ara");
	//Advanced
	define("LANG_BUTTON_ADVANCEDSEARCH", "Detaylı");
	//Close
	define("LANG_BUTTON_ADVANCEDSEARCH_CLOSE", "Yakın");
	//Clear
	define("LANG_BUTTON_CLEAR", "Temizle");
	//Add your Article
	define("LANG_BUTTON_ADDARTICLE", "Makalenizi ekleyin");
	//Add your Classified
	define("LANG_BUTTON_ADDCLASSIFIED", "Ilanınızı ekleyin");
	//Add your Event
	define("LANG_BUTTON_ADDEVENT", "Aktivitenizi ekleyin");
	//Add your Listing
	define("LANG_BUTTON_ADDLISTING", "Listenizi ekleyin");
	//Add your Deal
	define("LANG_BUTTON_ADDPROMOTION", "Teklif ekleyin");
	//Home
	define("LANG_BUTTON_HOME", "Ana Sayfa");
	//Manage Account
	define("LANG_BUTTON_MANAGE_ACCOUNT", "Hesabınızı Yönetin");
	//Manage Content
	define("LANG_MANAGE_CONTENT", "İçerik Yönet");
	//Sponsor Area
	define("LANG_SPONSOR_AREA", "Sponsor Alanı");
	//Site Manager Area
	define("LANG_SITEMGR_AREA", "İdari alanı");
	//Site Manager Section
	define("LANG_LABEL_SITEMGR_SECTION", "İdari Bölüm");
	//Help
	define("LANG_BUTTON_HELP", "Yardım");
	//Sign out
	define("LANG_BUTTON_LOGOUT", "Oturumu kapat");
	//Submit
	define("LANG_BUTTON_SUBMIT", "Gönder");
	//Update
	define("LANG_BUTTON_UPDATE", "Güncelle");
	//Back
	define("LANG_BUTTON_BACK", "Geri");
	//Delete
	define("LANG_BUTTON_DELETE", "Sil");
	//Complete the Process
	define("LANG_BUTTON_COMPLETE_THE_PROCESS", "İşlemi Tamamla");
	//Please enter the text you see in the image at the left into the textbox. This is required to prevent automated submission of contact requests.
	define("LANG_CAPTCHA_HELP", "Lütfen resimde gördüğünüz yazıyı metin kutusuna girin. Bu otomatik iletişim taleplerinin gönderilmesini engellemek için gereklidir.");
	//Verification Code image cannot be displayed
	define("LANG_CAPTCHA_ALT", "Onay Kodu resmi gösterilemiyor");
	//Verification Code
	define("LANG_CAPTCHA_TITLE", "Onay Kodu");
	//Please select a rating for this item
	define("LANG_MSG_REVIEW_SELECTRATING", "Lütfen bu öğe için bir yıldız seçin");
	//Fraud detected! Please select a rating for this item!
	define("LANG_MSG_REVIEW_FRAUD_SELECTRATING", "Hile saptandı! Lütfen bu öğe için bir puan seçin!");
	//"Comment" and "Comment Title" are required to post a comment!
	define("LANG_MSG_REVIEW_COMMENTREQUIRED", "Yorum göndermek için \"Yorum\" ve \"Yorum Başlığı\" gerekli!");
	//"Name" and "E-mail" are required to post a comment!
	define("LANG_MSG_REVIEW_NAMEEMAILREQUIRED", "Yorum göndermek için \"İsim\" ve \"E-posta\" gerekli!");
	//"City, State" are required to post a comment!
	define("LANG_MSG_REVIEW_CITYSTATEREQUIRED", "Yorum göndermek için \"İl , İlçe\" gerekli!");
	//Please type a valid e-mail address!
	define("LANG_MSG_REVIEW_TYPEVALIDEMAIL", "Lütfen geçerli bir e-posta adresi girin!");
	//You have already given your opinion on this item. Thank you.
	define("LANG_MSG_REVIEW_YOUALREADYGIVENOPINION", "Bu konu hakkında daha önce yorum yapmıştınız. Teşekkürler.");
	//Thanks for the feedback!
	define("LANG_MSG_REVIEW_THANKSFEEDBACK", "Yorumunuz için teşekkürler!");
	//Your review has been submitted for approval.
	define("LANG_MSG_REVIEW_REVIEWSUBMITTEDAPPROVAL", "Yorumunuz onaylanmaya gönderildi.");
	//No payment method was selected!
	define("LANG_MSG_NO_PAYMENT_METHOD_SELECTED", "Ödeme yöntemi seçilmedi!");
	//Wrong credit card expiration date. Please, try again.
	define("LANG_MSG_WRONG_CARD_EXPIRATION_TRY_AGAIN", "Yanlış kredi kartı son kullanma tarihi girdiniz. Lütfen tekrar deneyin.");
	//Click here to try again
	define("LANG_MSG_CLICK_HERE_TO_TRY_AGAIN", "Tekrar denemek için tıklayın");
	//Payment transactions may not occur immediately.
	define("LANG_MSG_TRANSACTIONS_MAY_NOT_OCCUR_IMMEDIATELY", "Ödeme işlemleri anında gerçekleşmeyebilir.");
	//After your payment is processed, information about your transaction
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED_INFO_ABOUT", "Ödemeniz işleme koyulduktan sonra, işlem bilginiz");
	//may be found in your transaction history.
	define("LANG_MSG_MAY_BE_FOUND_IN_TRANSACTION_HISTORY", "işlem geçmişinde bulunabilir.");
	//"may be found in your" transaction history
	define("LANG_MSG_MAY_BE_FOUND_IN_YOUR", "bulunabilir");
	//The payment gateway is not available currently
	define("LANG_MSG_PAYMENT_GATEWAY_NOT_AVAILABLE", "Ödeme şu an için mümkün değil");
	//The payment parameters could not be validated
	define("LANG_MSG_PAYMENT_INVALID_PARAMS", "Ödeme parametreleri doğrulanamadı");
	//Internal gateway error was encountered
	define("LANG_MSG_INTERNAL_GATEWAY_ERROR", "Dahili ağ geçidi hatası bulundu");
	//Information about your transaction may be found
	define("LANG_MSG_INFO_ABOUT_TRANSACTION_MAY_BE_FOUND", "İşleminiz hakkında bilgiler");
	//in your transaction history.
	define("LANG_MSG_IN_YOUR_TRANSACTION_HISTORY", "işlem geçmişinde bulunabilir.");
	//in your
	define("LANG_MSG_IN_YOUR", "sizin");
	//No Transaction ID
	define("LANG_MSG_NO_TRANSACTION_ID", "İşlem Numarası Yok");
	//System failure, please try again.
	define("LANG_MSG_SYSTEM_FAILURE_TRY_AGAIN", "Sistem hatası, lütfen tekrar deneyin.");
	//Please, fill in all required fields.
	define("LANG_MSG_FILL_ALL_REQUIRED_FIELDS", "Lütfen tüm gerekli alanları doldurun.");
	//Could not connect.
	define("LANG_MSG_COULD_NOT_CONNECT", "Bağlantı kurulamadı.");
	//Thank you for setting up your items and for making the payment!
	define("LANG_MSG_THANKS_FOR_MAKING_THE_PAYMENT", "Kayıtlarınızı ayarladığınız ve ödemenizi yaptığınız için teşekkürler !");
	//Site manager will review your items and set it live within 2 working days.
	define("LANG_MSG_SITEMGR_WILL_REVIEW_YOUR_ITEMS", "Site yöneticisi kayıtlarınızı inceledikten sonra 2 iş günü içerisinde sitede yayınlayacaktır.");
	//The payment gateway could not respond
	define("LANG_MSG_PAYMENT_GATEWAY_COULD_NOT_RESPOND", "Ödeme ağı geçidi cevap vermiyor");
	//Pending payments may take 3 to 4 days to be approved.
	define("LANG_MSG_PENDING_PAYMENTS_TAKE_3_4_DAYS_TO_BE_APPROVED", "Beklemede olan ödemelerin onaylanması 3 - 4 gün sürebilir.");
	//Connection Failure
	define("LANG_MSG_CONNECTION_FAILURE", "Bağlantı Hatası");
	//Please, fill correctly zip.
	define("LANG_MSG_FILL_CORRECTLY_ZIP", "Lütfen posta kodunu doğru olarak doldurun.");
	//Please, fill correctly card verification number.
	define("LANG_MSG_FILL_CORRECTLY_CARD_VERIF_NUMBER", "Lütfen onay kodunu doğru olarak doldurun.");
	//Card Type and Card Verification Number do not match.
	define("LANG_MSG_CARD_TYPE_VERIF_NUMBER_DO_NOT_MATCH", "Kart Türü ve Kart Onay Numarası birbirini tutmuyor.");
	//Transaction Not Completed.
	define("LANG_MSG_TRANSACTION_NOT_COMPLETED", "İşlem Tamamlanmadı.");
	//Error Number:
	define("LANG_MSG_ERROR_NUMBER", "Hata Numarası:");
	//Short Message
	define("LANG_MSG_SHORT_MESSAGE", "Kısa Mesaj:");
	//Long Message
	define("LANG_MSG_LONG_MESSAGE", "Uzun Mesaj:");
	//Transaction Completed Successfully.
	define("LANG_MSG_TRANSACTION_COMPLETED_SUCCESSFULLY", "İşlem Başarıyla Tamamlandı.");
	//Card expire date must be in the future
	define("LANG_MSG_CARD_EXPIRE_DATE_IN_FUTURE", "Kartın son kullanma tarihi gelecekte olmalıdır");
	//If your transaction was confirmed, information about it may be found in
	define("LANG_MSG_IF_TRANSACTION_WAS_CONFIRMED", "İşleminiz onaylandıysa, işlem bilgileri");
	//your transaction history after your payment is processed.
	define("LANG_MSG_YOUR_TRANSACTION_AFTER_PAYMENT_PROCESSED", "ödemeniz işlem gördükten sonra işlem geçmişinde bulunabilir.");
	//after your payment is processed.
	define("LANG_MSG_AFTER_PAYMENT_IS_PROCESSED", "ödemeniz işlem gördükten sonra.");
	//No items requiring payment.
	define("LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT", "Ödeme gerektiren hiçbir kayıt yok.");
	//Pay for outstanding invoices
	define("LANG_MSG_PAY_OUTSTANDING_INVOICES", "Ödenmemiş faturaları ödeyin");
	//Banner by Impression and Custom Invoices can be paid once.
	define("LANG_MSG_BANNER_CUSTOM_INVOICE_PAID_ONCE", "İzlenim başına afişler ve Özel Faturalar bir kere ödenebilir.");
	//Banner by Impression can be paid once.
	define("LANG_MSG_BANNER_PAID_ONCE", "İzlenim başına afişler bir kere ödenebilir.");
	//Custom Invoices can be paid once.
	define("LANG_MSG_CUSTOM_INVOICE_PAID_ONCE", "Özel Faturalar bir kere ödenebilir.");
	//View Items
	define("LANG_VIEWITEMS", "Kayıtları Gör");
	//Please do not use recurring payment system.
	define("LANG_MSG_PLEASE_DO_NOT_USE_RECURRING_PAYMENT_SYSTEM", "Lütfen tekrar eden ödeme sistemini kullanmayın.");
	//Try again!
	define("LANG_MSG_TRY_AGAIN", "Tekrar deneyin!");
	//All fields are required.
	define("LANG_MSG_ALL_FIELDS_REQUIRED", "Bütün alanlar zorunlu.");
	//"You have more than" X items. Please contact the administrator to check out it.
	define("LANG_MSG_OVERITEM_MORETHAN", "Daha fazla var");
	//You have more than X items. "Please contact the administrator to check out it".
	define("LANG_MSG_OVERITEM_CONTACTADMIN", "Lütfen hesabı kapatmak için yöneticiyle iletişime geçin.");
	//Article Options
	define("LANG_ARTICLE_OPTIONS", "Makale Seçenekleri");
	//Article Author
	define("LANG_ARTICLE_AUTHOR", "Makale Yazarı");
	//Article Author URL
	define("LANG_ARTICLE_AUTHOR_URL", "Makale Yazarının URL adresi");
	//Article Categories
	define("LANG_ARTICLE_CATEGORIES", "Makale Kategorileri");
	//Banner Type
	define("LANG_BANNER_TYPE", "Afiş Türü");
	//Banner Options
	define("LANG_BANNER_OPTIONS", "Afiş Seçenekleri");
	//Order Banner
	define("LANG_ORDER_BANNER", "Afiş Sipariş Et ");
	//By time period
	define("LANG_BANNER_BY_TIME_PERIOD", "Süre başına");
	//Banner Details
	define("LANG_BANNER_DETAIL_PLURAL", "Afiş Detayları");
	//Script Banner
	define("LANG_SCRIPT_BANNER", "Afiş Kodu");
	//Show by Script Code
	define("LANG_SHOWSCRIPTCODE", "Kod başına göster");
	//Allow script to be entered instead of an image. This field allows you to paste in script that will be used to display the banner from an affiliate program or external banner system. If "Show by Script Code" is checked, just "Script" field will be required. The other fields below will not be necessary.
	define("LANG_SCRIPTCODEHELP", "Resim yerine kod girilmesine izin ver. Bu alan afişin görünümünde kullanılmak üzere bağlı bir programdan ya da dış afiş sistemlerinden gelen kodları yapıştırmanıza izin verir. Eğer \"Kod Başına Göster\" işaretliyse sadece \"Kod\" alanı gerekli olacaktır. Aşağıdaki diğer alanlar gerekli olmayacaktır.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload script banners.
	define("LANG_SCRIPTCODEHELP2", "Kod afişleri eklediğinizde ne \"Hedef Url\"sinin ne de \"Trafik Raporu Tıklaması\"nın hiçbir etkisi olmaz.");
	//Both "Destination Url" and "Traffic Report ClickThru" has no effect when you upload swf file
	define("LANG_BANNERFILEHELP", "swf dosyası eklediğinizde ne \"Hedef Url\"sinin ne de \"Trafik Raporu Tıklaması\"nın hiçbir etkisi olmaz.");
	//Classified Level
	define("LANG_CLASSIFIED_LEVEL", "İlan Seviyesi");
	//Classified Category
	define("LANG_CLASSIFIED_CATEGORY", "İlan Kategorisi");
	//Select classified level
	define("LANG_MENU_SELECT_CLASSIFIED_LEVEL", "İlan seviyesi seç");
	//Classified Options
	define("LANG_CLASSIFIED_OPTIONS", "İlan Seçenekleri");
	//Event Level
	define("LANG_EVENT_LEVEL", "Aktivite Seviyesi");
	//Event Categories
	define("LANG_EVENT_CATEGORY_PLURAL", "Aktivite Kategorileri");
	//Event Categories
	define("LANG_EVENT_CATEGORIES", "Aktivite Kategorileri");
	//Select event level
	define("LANG_MENU_SELECT_EVENT_LEVEL", "Aktivite seviyesi seç");
	//Event Options
	define("LANG_EVENT_OPTIONS", "Aktivite Seçenekleri");
	//Listing Level
	define("LANG_LISTING_LEVEL", "Liste Seviyesi");
	//Listing Type
	define("LANG_LISTING_TEMPLATE", "Liste Türü");
	//Listing Categories
	define("LANG_LISTING_CATEGORIES", "Liste Kategorileri");
	//Listing Badges
	define("LANG_LISTING_DESIGNATION_PLURAL", "Liste Rozetleri");
	//Subject to administrator approval.
	define("LANG_LISTING_SUBJECTTOAPPROVAL", "Yönetici onayına tabidir.");
	//Select this choice
	define("LANG_LISTING_SELECT_THIS_CHOICE", "Bu seçeneği işaretle");
	//Select listing level
	define("LANG_MENU_SELECTLISTINGLEVEL", "Liste seviyesi seç");
	//Listing Options
	define("LANG_LISTING_OPTIONS", "Liste Seçenekleri");
	//The Authorize Payment System is not available currently. Please contact the
	define("LANG_AUTHORIZE_NO_AVAILABLE", "Authorize Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The iTransact Payment System is not available currently. Please contact the
	define("LANG_ITRANSACT_NO_AVAILABLE", "iTransact Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The LinkPoint Payment System is not available currently. Please contact the
	define("LANG_LINKPOINT_NO_AVAILABLE", "LinkPoint Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The PayFlow Payment System is not available currently. Please contact the
	define("LANG_PAYFLOW_NO_AVAILABLE", "PayFlow Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The PayPal Payment System is not available currently. Please contact the
	define("LANG_PAYPAL_NO_AVAILABLE", "PayPal Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The PayPalAPI Payment System is not available currently. Please contact the
	define("LANG_PAYPALAPI_NO_AVAILABLE", "PayPalAPI Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The PSIGate Payment System is not available currently. Please contact the
	define("LANG_PSIGATE_NO_AVAILABLE", "PSIGate Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The 2CheckOut Payment System is not available currently. Please contact the
	define("LANG_TWOCHECKOUT_NO_AVAILABLE", "2CheckOut Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The WorldPay Payment System is not available currently. Please contact the
	define("LANG_WORLDPAY_NO_AVAILABLE", "WorldPay Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//The SimplePay Payment System is not available currently. Please contact the
	define("LANG_SIMPLEPAY_NO_AVAILABLE", "SimplePay Ödeme Sistemi şu anda mevcut değil. Lütfen iletişime geçiniz");
	//Upload Warning
	define("LANG_UPLOAD_WARNING", "Yükleme Uyarısı");
	//File successfully uploaded!
	define("LANG_UPLOAD_MSG_SUCCESSUPLOADED", "Dosya başarıyla yüklendi!");
	//Extension not allowed or wrong file type!
	define("LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE", "Uzantıya izin verilmedi ya da yanlış dosya türü!");
	//File exceeds size limit!
	define("LANG_UPLOAD_MSG_EXCEEDSLIMIT", "Dosya büyüklük sınırını aşıyor!");
	//Fail trying to create directory!
	define("LANG_UPLOAD_MSG_FAILCREATEDIRECTORY", "Rehberi kurarken hata!");
	//Wrong directory permission!
	define("LANG_UPLOAD_MSG_WRONGDIRECTORYPERMISSION", "Yanlış directory izni!");
	//Unexpected failure!
	define("LANG_UPLOAD_MSG_UNEXPECTEDFAILURE", "Beklenmedik hata!");
	//File not found or not entered!
	define("LANG_UPLOAD_MSG_NOTFOUND_NOTENTERED", "Dosya bulunmadı ya da girilmedi!");
	//File already exists in directory!
	define("LANG_UPLOAD_MSG_FILEALREADEXISTSINDIRECTORY", "Dosya zaten rehberde var!");
	//View all locations
	define("LANG_VIEWALLLOCATIONSCATEGORIES", "Tüm yerleri gör");
	//Featured Locations
	define("LANG_FEATUREDLOCATIONS", "Favori Mekanlar");
	//There aren't any featured location in the system.
	define("LANG_LABEL_NOFEATUREDLOCATIONS", "Sistemde hiçbir favori mekan yok.");
	//Overview
	define("LANG_LABEL_OVERVIEW", "Genel bakış");
	//Video
	define("LANG_LABEL_VIDEO", "Video");
	//Map Location
	define("LANG_LABEL_MAPLOCATION", "Harita Konumu");
	//More Listings
	define("LANG_LABEL_MORELISTINGS", "Daha Fazla Liste");
	//More Events
	define("LANG_LABEL_MOREEVENTS", "Daha Fazla Aktivite");
	//More Classifieds
	define("LANG_LABEL_MORECLASSIFIEDS", "Daha Fazla İlan");
	//More Articles
	define("LANG_LABEL_MOREARTICLES", "Daha Fazla Makale");
	//"Operation not allowed: The deal" (deal_name) is already associated with the listing
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED1", "İşleme izin verilmedi: Teklif");
	//Operation not allowed: The deal (deal_name) "is already associated with the listing"
	define("LANG_MSGERROR_PROMOTIONOPERATIONNOTALLOWED2", "zaten bir liste ile ilişkilendirilmiş");
	//Pending
	define("LANG_LABEL_SIMPLEPAYPENDING", "Beklemede");
	//Aborted
	define("LANG_LABEL_SIMPLEPAYABORTED", "İptal Edildi");
	//Failed
	define("LANG_LABEL_SIMPLEPAYFAILED", "Başarısız oldu");
	//Declined
	define("LANG_LABEL_SIMPLEPAYDECLINED", "Reddedildi");
	//Unknow
	define("LANG_LABEL_SIMPLEPAYUNKNOW", "Bilinmeyen");
	//Success
	define("LANG_LABEL_SIMPLEPAYSUCCESS", "Başarılı");
	//Click on Add to Select Categories.
	define("LANG_MSG_CLICKADDTOSELECTCATEGORIES", "Kategori seçmek için \"Ekle\"ye tıklayın");
	//Click on "Add main category" or "Add sub-category" to type your new categories
	define("LANG_MSG_CLICKADDTOADDCATEGORIES", "Yeni kategorileriniz eklemek için \"Ana kategori ekle\"ye ya  da \"Alt-kategori eklee\"ye tıklayın");
	//Add an
	define("LANG_ADD_AN", "Ekle");
	//Add a
	define("LANG_ADD_A", "Ekle");
	//on these sites
	define("LANG_ON_SITES", "bu sitelere:");
	//on this site
	define("LANG_ON_SITES_SINGULAR", "bu siteye:");

	# ----------------------------------------------------------------------------------------------------
	# FUNCTIONS
	# ----------------------------------------------------------------------------------------------------
	//slideshow
	define("LANG_SLIDESHOW", "slayt gösterisi");
	//on
	define("LANG_SLIDESHOW_ON", "açık");
	//off
	define("LANG_SLIDESHOW_OFF", "kapalı");
	//Photo Gallery
	define("LANG_GALLERYTITLE", "Foto Galeri");
	//"Click here" for Slideshow. You can also click on any of the photos to start slideshow.
	define("LANG_GALLERYCLICKHERE", "Burayı tıklayın");
	//Click here "for Slideshow. You can also click on any of the photos to start slideshow."
	define("LANG_GALLERYSLIDESHOWTEXT", "slayt gösterisi için. Ayrıca herhangi bir resmin üzerine tıklayarak da slayt gösterisini başlatabilirsiniz.");
	//more photos
	define("LANG_GALLERYMOREPHOTOS", "daha fazla resim");
	//Inexistent Discount Code
	define("LANG_MSG_INEXISTENT_DISCOUNT_CODE", "Var Olmayan Promosyon Kodu");
	//is not available.
	define("LANG_MSG_IS_NOT_AVAILABLE", "mevcut değil.");
	//is not available for this item type.
	define("LANG_MSG_IS_NOT_AVAILABLE_FOR", "bu kayıt türü için mevcut değil.");
	//cannot be used twice.
	define("LANG_MSG_CANNOT_BE_USED_TWICE", "iki kez kullanılamaz.");
	//"You can select up to" [ITEM_MAX_GALLERY] gallery(ies).
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY_UP", "Seçebilirsiniz");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERY", "e kadar galeri.");
	//You can select up to [ITEM_MAX_GALLERY] "gallery(ies)".
	define("LANG_MSG_YOU_CAN_SELECT_ITEM_GALLERIES", "galeriler.");
	//Title is required.
	define("LANG_MSG_TITLE_IS_REQUIRED", "Başlık gerekli.");
	//Language is required.
	define("LANG_MSG_LANGUAGE_IS_REQUIRED", "Dil gerekli.");
	//First Name is required.
	define("LANG_MSG_FIRST_NAME_IS_REQUIRED", "Ad gerekli.");
	//Last Name is required.
	define("LANG_MSG_LAST_NAME_IS_REQUIRED", "Soyad gerekli.");
	//Company is required.
	define("LANG_MSG_COMPANY_IS_REQUIRED", "Şirket gerekli.");
	//Phone is required.
	define("LANG_MSG_PHONE_IS_REQUIRED", "Telefon gerekli.");
	//E-mail is required.
	define("LANG_MSG_EMAIL_IS_REQUIRED", "E-posta gerekli.");
	//Account is required.
	define("LANG_MSG_ACCOUNT_IS_REQUIRED", "Hesap gerekli.");
	//Page Name is required.
	define("LANG_MSG_PAGE_NAME_IS_REQUIRED", "Sayfa Adı gerekli.");
	//Category is required.
	define("LANG_MSG_CATEGORY_IS_REQUIRED", "Kategori gerekli.");
	//Abstract is required.
	define("LANG_MSG_ABSTRACT_IS_REQUIRED", "Özet geçerli.");
	//Expiration type is required.
	define("LANG_MSG_EXPIRATION_TYPE_IS_REQUIRED", "Süre dolum türü gerekli.");
	//Renewal Date is required.
	define("LANG_MSG_RENEWAL_DATE_IS_REQUIRED", "Yenileme Tarihi gerekli.");
	//Impressions are required.
	define("LANG_MSG_IMPRESSIONS_ARE_REQUIRED", "İzlenimler gerekli.");
	//File is required.
	define("LANG_MSG_FILE_IS_REQUIRED", "Dosya gerekli.");
	//Type is required.
	define("LANG_MSG_TYPE_IS_REQUIRED", "Tür gerekli.");
	//Caption is required.
	define("LANG_MSG_CAPTION_IS_REQUIRED", "Altyazı gerekli.");
	//Script Code is required.
	define("LANG_MSG_SCRIPT_CODE_IS_REQUIRED", "Kod gerekli.");
	//Description 1 is required.
	define("LANG_MSG_DESCRIPTION1_IS_REQUIRED", "Tanım 1 gerekli.");
	//Description 2 is required.
	define("LANG_MSG_DESCRIPTION2_IS_REQUIRED", "Tanım 2 gerekli.");
	//Name is required.
	define("LANG_MSG_NAME_IS_REQUIRED", "Ad gerekli.");
	//Deal Title is required.
	define("LANG_MSG_HEADLINE_IS_REQUIRED", "Teklif Başlık gerekli.");
	//"Offer" is required.
	define("LANG_MSG_OFFER_IS_REQUIRED", "Teklif gerekli.");
	//"Start Date" is required.
	define("LANG_MSG_START_DATE_IS_REQUIRED", "Başlangıç Tarihi gerekli.");
	//"End Date" is required.
	define("LANG_MSG_END_DATE_IS_REQUIRED", "Bitiş Tarihi gerekli.");
	//Text is required.
	define("LANG_MSG_TEXT_IS_REQUIRED", "Metin gerekli.");
	//Username is required.
	define("LANG_MSG_USERNAME_IS_REQUIRED", "E-posta gerekli.");
	//"Current Password" is incorrect.
	define("LANG_MSG_CURRENT_PASSWORD_IS_INCORRECT", "\"Şimdiki Şifre\" yanlış.");
	//"Password" is required.
	define("LANG_MSG_PASSWORD_IS_REQUIRED", "\"Şifre\" gerekli.");
	//"Agree to terms of use" is required.
	define("LANG_MSG_IGREETERMS_IS_REQUIRED", "\"Şartları kabul etmek\" gerekli.");
	//The following fields were not filled or contain errors:
	define("LANG_MSG_FIELDS_CONTAIN_ERRORS", "Aşağıdaki alanlar doldurulmamış veya hata içeriyor:");
	//Title - Please fill out the field
	define("LANG_MSG_TITLE_PLEASE_FILL_OUT", "Başlık  - Lütfen alanı doldurun");
	//Page Name - Please fill out the field
	define("LANG_MSG_PAGE_NAME_PLEASE_FILL_OUT", "Sayfa adı - Lütfen alanı doldurun");
	//"Maximum of" [MAX_CATEGORY_ALLOWED] categories are allowed
	define("LANG_MSG_MAX_OF_CATEGORIES_1", "En fazla");
	//Maximum of [MAX_CATEGORY_ALLOWED] "categories are allowed"
	define("LANG_MSG_MAX_OF_CATEGORIES_2", "kategoriye izin verilir.");
	//Friendly URL Page Name already in use, please choose another Page Name.
	define("LANG_MSG_FRIENDLY_URL_IN_USE", "Friendly URL Sayfa Adı zaten kullanılıyor, lütfen başka bir Sayfa Adı seçin.");
	//Page Name contain invalid chars
	define("LANG_MSG_PAGE_NAME_INVALID_CHARS", "Sayfa Adı geçersiz karakter içeriyor");
	//"Maximum of" [MAX_KEYWORDS] keywords are allowed
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_1", "En fazla");
	//Maximum of [MAX_KEYWORDS] "keywords are allowed"
	define("LANG_MSG_MAX_OF_KEYWORDS_ALLOWED_2", "anahtar sözcüğe izin verilir");
	//Please include keywords with a maximum of 50 characters each
	define("LANG_MSG_PLEASE_INCLUDE_KEYWORDS", "Lütfen her biri en fazla 50 karakter olan anahtar sözcükler ekleyin");
	//Please enter a valid "Publication Date".
	define("LANG_MSG_ENTER_VALID_PUBLICATION_DATE", "Lütfen geçerli bir \"Yayın Tarihi\" ekleyin.");
	//Please enter a valid "Start Date".
	define("LANG_MSG_ENTER_VALID_START_DATE", "Lütfen geçerli bir \"Başlangıç Tarihi\" ekleyin.");
	//Please enter a valid "End Date".
	define("LANG_MSG_ENTER_VALID_END_DATE", "Lütfen geçerli bir \"Bitiş Tarihi\" ekleyin.");
	//The "End Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_END_DATE_GREATER_THAN_START_DATE", "\"Bitiş Tarihi\", \"Başlangıç Tarihi\"ne eşit veya ondan daha ileride olmalıdır.");
	//The "End Time" must be greater than the "Start Time".
	define("LANG_MSG_END_TIME_GREATER_THAN_START_TIME", "\"Bitiş Tarihi\", \"Başlangıç Tarihi\"nden daha ileride olmalıdır.");
	//The "End Date" cannot be in past.
	define("LANG_MSG_END_DATE_CANNOT_IN_PAST", "\"Bitiş Tarihi\" geçmişte olamaz.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_ENTER_VALID_EMAIL_ADDRESS", "Lütfen geçerli bir e-posta adresi girin.");
	//Please enter a valid "URL".
	define("LANG_MSG_ENTER_VALID_URL", "Lütfen geçerli bir \"URL\" girin.");
	//Please provide a description with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_DESCRIPTION_WITH_255_CHARS", "Lütfen en fazla 255 karakterlik bir tanım girin.");
	//Please provide a conditions with a maximum of 255 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_255_CHARS", "Lütfen en fazla 255 karakterlik bir şart metni girin.");
	//Please enter a valid renewal date.
	define("LANG_MSG_ENTER_VALID_RENEWAL_DATE", "Lütfen geçerli bir yenileme tarihi girin.");
	//Renewal date must be in the future.
	define("LANG_MSG_RENEWAL_DATE_IN_FUTURE", "Yenileme tarihi gelecekte olmalıdır.");
	//Please enter a valid expiration date.
	define("LANG_MSG_ENTER_VALID_EXPIRATION_DATE", "Lütfen geçerli bir son kullanma tarihi girin.");
	//Expiration date must be in the future.
	define("LANG_MSG_EXPIRATION_DATE_IN_FUTURE", "Son kullanma tarihi gelecekte olmalıdır.");
	//Blank space is not allowed for password.
	define("LANG_MSG_BLANK_SPACE_NOT_ALLOWED_FOR_PASSWORD", "Şifrede boşluğa izin verilmez.");
	//"Please enter a password with a maximum of" [PASSWORD_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MAX_CHARS", "Lütfen en fazla olan bir şifre girin");
	//"Please enter a password with a minimum of" [PASSWORD_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_ENTER_PASSWORD_WITH_MIN_CHARS", "Lütfen en az olan bir şifre girin");
	//Please enter a valid username.
	define("LANG_MSG_ENTER_VALID_USERNAME", "Lütfen geçerli bir kullanıcı adı girin.");
	//Sorry", you can´t change this account information
	define("LANG_MSG_YOUCANTCHANGEACCOUNTINFORMATION", "Maalesef bu hesabın bilgilerini değiştiremezsiniz");
	//Password "abc123" not allowed!
	define("LANG_MSG_ABC123_NOT_ALLOWED", "\"abc123\" şifresine izin verilmez!");
	//Passwords do not match. Please enter the same content for "password" and "retype password" fields.
	define("LANG_MSG_PASSWORDS_DO_NOT_MATCH", "şifreler birbirini tutmuyor. Lütfen \"şifre\" ile \"şifreyi tekrar girin\" alanları için aynı içeriği girin.");
	//Spaces are not allowed for username.
	define("LANG_MSG_SPACES_NOT_ALLOWED_FOR_USERNAME", "E-posta adresinde boşluğa izin verilmez.");
	//Special characters are not allowed for username.
	define("LANG_MSG_SPECIAL_CHARS_NOT_ALLOWED_FOR_USERNAME", "E-posta adresinde özel karakterlere izin verilmez.");
	//"Please type an username with a maximum of" [USERNAME_MAX_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MAX_CHARS", "Lütfen en fazla olan bir e-posta adresi girin");
	//"Please type an username with a minimum of" [USERNAME_MIN_LEN] [LANG_LABEL_CHARACTERES]
	define("LANG_MSG_CHOOSE_USERNAME_WITH_MIN_CHARS", "Lütfen en az olan e-posta adresi girin");
	//Please choose a different username.
	define("LANG_MSG_CHOOSE_DIFFERENT_USERNAME", "Lütfen farklı bir e-posta seçin.");
	//Click here if you do not see your category
	define("LANG_MSG_CLICK_TO_ADD_CATEGORY", "Kategorinizi göremiyorsanız buraya tıklayın");	
	//Add main category
	define("LANG_MSG_CLICK_TO_ADD_MAINCATEGORY", "Ana kategori ekle");
	//Add sub-category
	define("LANG_MSG_CLICK_TO_ADD_SUBCATEGORY", "Alt-kategori ekle");
	//Category title already registered!
	define("LANG_CATEGORY_ALREADY_REGISTERED", "Kategori başlığı kaydedildi bile!");
	//Category title available!
	define("LANG_CATEGORY_NOT_REGISTERED", "Kategiri başlığı mevcut!");

	# ----------------------------------------------------------------------------------------------------
	# MENU
	# ----------------------------------------------------------------------------------------------------
	//Home
	define("LANG_MENU_HOME", "Ana Sayfa");
	//Dashboard
	define("LANG_MEMBERS_DASHBOARD", "Kontrol Paneli");
	//Manage
	define("LANG_MENU_MANAGE", "Yönet");
	//Add
	define("LANG_MENU_ADD", "Ekle");
	//Sponsor Options
	define("LANG_MENU_MEMBEROPTIONS", "Sponsor Seçenekleri");
	//Listings
	define("LANG_MENU_LISTING", "Listeler");
	//Add Listing
	define("LANG_MENU_ADDLISTING", "Liste Ekle");
	//Manage Listings
	define("LANG_MENU_MANAGELISTING", "Listeleri Yönet");
	//Galleries
	define("LANG_MENU_GALLERY", "Galeriler");
	//Add Gallery
	define("LANG_MENU_ADDGALLERY", "Galeri Ekle");
	//Manage Gallery
	define("LANG_MENU_MANAGEGALLERY", "Galeriyi Yönet");
	//Events
	define("LANG_MENU_EVENT", "Aktiviteler");
	//Add Event
	define("LANG_MENU_ADDEVENT", "Aktivite Ekle");
	//Manage Events
	define("LANG_MENU_MANAGEEVENT", "Aktiviteleri Yönet");
	//Banners
	define("LANG_MENU_BANNER", "Afişler");
	//Add Banner
	define("LANG_MENU_ADDBANNER", "Afiş Ekle");
	//Manage Banners
	define("LANG_MENU_MANAGEBANNER", "Afişleri Yönet");
	//Classifieds
	define("LANG_MENU_CLASSIFIED", "İlanlar");
	//Add Classified
	define("LANG_MENU_ADDCLASSIFIED", "İlan Ekle");
	//Manage Classifieds
	define("LANG_MENU_MANAGECLASSIFIED", "İlanları Yönet");
	//Articles
	define("LANG_MENU_ARTICLE", "Makaleler");
	//Add Article
	define("LANG_MENU_ADDARTICLE", "Makale Ekle");
	//Manage Articles
	define("LANG_MENU_MANAGEARTICLE", "Makaleleri Yönet");
	//Deals
	define("LANG_MENU_PROMOTION", "Teklifler");
	//Add Deal
	define("LANG_MENU_ADDPROMOTION", "Teklif Ekle");
	//Manage Deals
	define("LANG_MENU_MANAGEPROMOTION", "Teklifler Yönet");
	//Advertise With Us
	define("LANG_MENU_ADVERTISE", "İlan Verin");
	//Page not found
	define("LANG_PAGE_NOT_FOUND", "Sayfa bulunamadı");
	//Maintenance Page
	define("LANG_MAINTENANCE_PAGE", "Bakım Sayfa");
	//FAQ
	define("LANG_MENU_FAQ", "SSS");
	//Sitemap
	define("LANG_MENU_SITEMAP", "Site haritası");
	//Contact Us
	define("LANG_MENU_CONTACT", "Bize Ulaşın");
	//Payment Options
	define("LANG_MENU_PAYMENTOPTIONS", "Ödeme Ayarları");
	//Check Out
	define("LANG_MENU_CHECKOUT", "Hesabı Kapat");
	//Make Your Payment
	define("LANG_MENU_MAKEPAYMENT", "Ödeme Yap");
	//History
	define("LANG_MENU_HISTORY", "Geçmiş");
	//Transaction History
	define("LANG_MENU_TRANSACTIONHISTORY", "İşlem Geçmişi");
	//Invoice History
	define("LANG_MENU_INVOICEHISTORY", "Fatura Geçmişi");
	//Choose a Theme
	define("LANG_MENU_CHOOSETHEME", "Tema Seç");
	//Choose a Color Scheme
	define("LANG_MENU_CHOOSESCHEME", "Renk Düzeni Seç");

	# ----------------------------------------------------------------------------------------------------
	# SEARCH
	# ----------------------------------------------------------------------------------------------------
	//Search Article
	define("LANG_LABEL_SEARCHARTICLE", "Makale Ara");
	//Search Classified
	define("LANG_LABEL_SEARCHCLASSIFIED", "İlan Ara");
	//Search Event
	define("LANG_LABEL_SEARCHEVENT", " Aktivite Ara");
	//Search Listing
	define("LANG_LABEL_SEARCHLISTING", "Liste Ara");
	//Search Deal
	define("LANG_LABEL_SEARCHPROMOTION", "Teklif Ara");
	//Advanced Search
	define("LANG_SEARCH_ADVANCEDSEARCH", "Detaylı Arama");
	//Search
	define("LANG_SEARCH_LABELKEYWORD", "Ara");
	//Location
	define("LANG_SEARCH_LABELLOCATION", "Yer");
	//Select a Country
	define("LANG_SEARCH_LABELCBCOUNTRY", "Ülke Seçin");
	//Select a Region
	define("LANG_SEARCH_LABELCBREGION", "Bölge Seçin");
	//Select a State
	define("LANG_SEARCH_LABELCBSTATE", "İl Seçin");	
	//Select a City
	define("LANG_SEARCH_LABELCBCITY", "İlçe Seçin");
	//Select a Neighborhood
	define("LANG_SEARCH_LABELCBNEIGHBORHOOD", "Mahalle Seçin");
	//Category
	define("LANG_SEARCH_LABELCATEGORY", "Kategori");
	//Select a Category
	define("LANG_SEARCH_LABELCBCATEGORY", "Kategori Seçin");
	//Match
	define("LANG_SEARCH_LABELMATCH", "Eşleşme");
	//Exact Match
	define("LANG_SEARCH_LABELMATCH_EXACTMATCH", "Tam Eşleşme");
	//Any Word
	define("LANG_SEARCH_LABELMATCH_ANYWORD", "Herhangi bir Kelime");
	//All Words
	define("LANG_SEARCH_LABELMATCH_ALLWORDS", "Bütün Kelimeler");
	//Listing Type
	define("LANG_SEARCH_LABELBROWSE", "Liste Türü");
	//from
	define("LANG_SEARCH_LABELFROM", "den");
	//to
	define("LANG_SEARCH_LABELTO", "e");
	//Miles "of"
	define("LANG_SEARCH_LABELZIPCODE_OF", "sinde");
	//Search by keyword
	define("LANG_LABEL_SEARCHFAQ", "Anahtar sözcüğe göre ara");
	//Search
	define("LANG_LABEL_SEARCHFAQ_BUTTON", "Ara");
	//Please provide only words with at least [FT_MIN_WORD_LEN] letters for search!
	define("LANG_MSG_SEARCH_MIN_WORD_LEN", "Arama için lütfen en az harf girin!");

	# ----------------------------------------------------------------------------------------------------
	# FRONTEND
	# ----------------------------------------------------------------------------------------------------
	//Featured
	define("LANG_ITEM_FEATURED", "Vitrindekiler");
	//Recent Articles
	define("LANG_RECENT_ARTICLE", "En Yeni Makaleler");
	//Upcoming Events
	define("LANG_UPCOMING_EVENT", "Yaklaşan Aktiviteler");
	//Featured Classifieds
	define("LANG_FEATURED_CLASSIFIED", "Vitrindeki İlanlar");
	//Featured Articles
	define("LANG_FEATURED_ARTICLE", "Vitrindeki Makaleler");
	//Featured Listings
	define("LANG_FEATURED_LISTING", "Vitrindeki Listeler");
	//Featured Deals
	define("LANG_FEATURED_PROMOTION", "Vitrindeki Teklifler");
	//View all articles
	define("LANG_LABEL_VIEW_ALL_ARTICLES", "Tüm makaleleri Görüntüle");
	//View all events
	define("LANG_LABEL_VIEW_ALL_EVENTS", "Tüm aktiviteler göster");
	//View all classifieds
	define("LANG_LABEL_VIEW_ALL_CLASSIFIEDS", "Tüm ilanlar görüntüle");
	//View all listings
	define("LANG_LABEL_VIEW_ALL_LISTINGS", "Tüm listeler görüntüle");
	//View all deals
	define("LANG_LABEL_VIEW_ALL_PROMOTIONS", "Tüm teklifleri görüntüle");
	//Last Tweets
	define("LANG_LAST_TWEETS", "En Son Tweetler");
	//Easy and Fast.
	define("LANG_EASYANDFAST", "Kolay ve de Hızlı.");
	//3 Steps
	define("LANG_THREESTEPS", "3 Adım");
	//4 Steps
	define("LANG_FOURSTEPS", "4 Adım");
	//Account Signup
	define("LANG_ACCOUNTSIGNUP", "Hesap Kaydı");
	//Listing Update
	define("LANG_LISTINGUPDATE", "Liste Güncellemesi");
	//Order
	define("LANG_ORDER", "Sipariş Edin");
	//Check Out
	define("LANG_CHECKOUT", "Ödeme Yapın");
	//Configuration
	define("LANG_CONFIGURATION", "Ayarlar");
	//Select a level
	define("LANG_SELECTPACKAGE", "Seviye seçin");
	//Profile Options
	define("LANG_PROFILE_OPTIONS", "Profil Seçenekleri");
	//Directory account
	define("LANG_PROFILE_OPTIONS1", "Directory hesabı");
	//My existing OpenID 2.0 Account
	define("LANG_PROFILE_OPTIONS2", "Benim mevcut OpenID 2.0 Hesap");
	//My existing Facebook Account
	define("LANG_PROFILE_OPTIONS3", "Benim mevcut Facebook Hesabı");
	//My existing Google Account
	define("LANG_PROFILE_OPTIONS4", "Benim mevcut Google Hesabı");
	//Do you already have an account?
	define("LANG_ALREADYHAVEACCOUNT", "Zaten bir hesabınız var mı?");
	//No, I'm a New User.
	define("LANG_ACCOUNTNEWUSER", "Hayır, Yeni Kullanıcıyım.");
	//Yes, I have an Existing Account.
	define("LANG_ACCOUNTEXISTSUSER", "Evet, Mevcut Hesabım var.");
	//Sign in with my existing Directory Account.
	define("LANG_ACCOUNTDIRECTORYUSER", "Mevcut Dizin	Hesabınızla oturum açın.");
	//Sign in with my existing OpenID 2.0 Account.
	define("LANG_ACCOUNTOPENIDUSER", "Mevcut OpenID 2.0 Hesabınızla oturum açın.");
	//Sign in with my existing Facebook Account.
	define("LANG_ACCOUNTFACEBOOKUSER", "Mevcut Facebook Hesabınızla oturum açın.");
	//Sign in with my existing Google Account.
	define("LANG_ACCOUNTGOOGLEUSER", "Mevcut Google Hesabınızla oturum açın.");
	//Account Information
	define("LANG_ACCOUNTINFO", "Hesap Bilgileri");
	//Additional Information
	define("LANG_LABEL_ADDITIONALINFORMATION", "Ek Bilgi ");
	//Please write down your e-mail and password for future reference.
	define("LANG_ACCOUNTINFOMSG", "İleride referans olması için e-postanızı ve şifrenizi not alın.");
	//"Username must be a valid e-mail between" [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG1", "E-posta arasında geçerli olmak zorunda");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] "and" [USERNAME_MAX_LEN] characters with no spaces.
	define("LANG_USERNAME_MSG2", "ve");
	//Username must be a valid e-mail between [USERNAME_MIN_LEN] and [USERNAME_MAX_LEN] "characters with no spaces."
	define("LANG_USERNAME_MSG3", "boşluksuz karakter.");
	//"Password must be between" [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG1", "Şifre arasında olmalı");
	//Password must be between [PASSWORD_MIN_LEN] "and" [PASSWORD_MAX_LEN] characters with no spaces.
	define("LANG_PASSWORD_MSG2", "ve");
	//Password must be between [PASSWORD_MIN_LEN] and [PASSWORD_MAX_LEN] "characters with no spaces."
	define("LANG_PASSWORD_MSG3", "boşluksuz karakter.");
	//I agree with the terms of use
	define("LANG_IGREETERMS", "Kullanma şartlarını kabul ediyorum");
	//Do you want to advertise with us?
	define("LANG_DOYOUWANT_ADVERTISEWITHUS", "Bize ilan vermek ister misiniz?");
	//Buy a link
	define("LANG_BUY_LINK", "Link satın alın");
	//Back to Top
	define("LANG_BACKTOTOP", "Yukarı Dön");
	//Back to
	define("LANG_BACKTO", "Için yedekleyin ");
	//Favorites
	define("LANG_QUICK_LIST", "Favorileri");
	//view summary
	define("LANG_VIEWSUMMARY", "özeti gör");
	//view detail
	define("LANG_VIEWDETAIL", "detayları gör");
	//Advertisers
	define("LANG_ADVERTISER", "İlan verenler");
	//Order Now!
	define("LANG_ORDERNOW", "Sipariş Et!");
	//Wait, Loading...
	define("LANG_WAITLOADING", "Bekleyin, Yükleniyor...");
	//Subtotal Amount
	define("LANG_SUBTOTALAMOUNT", "Aratoplam tutarı");
	//Subtotal
	define("LANG_SUBTOTAL", "Aratoplam");
	//Total Tax Amount
	define("LANG_TAXAMOUNT", "Vergi Tutarı");
	//Total Price Amount
	define("LANG_TOTALPRICEAMOUNT", "Toplam Fiyat Tutarı");
	//Favorites
	define("LANG_LABEL_QUICKLIST", "Favoriler");
	//No favorites found!
	define("LANG_LABEL_NOQUICKLIST", "Favori bulunmadı!");
	//Search results for
	define("LANG_LABEL_SEARCHRESULTSFOR", "için arama sonuçları");
	//Related Search
	define("LANG_LABEL_RELATEDSEARCH", "İlgili Aramalar");
	//Browse by Section
	define("LANG_LABEL_BROWSESECTION", "Bölüme göre Göster");
	//Keyword
	define("LANG_LABEL_SEARCHKEYWORD", "Anahtar sözcük");
	//Type a keyword
	define("LANG_LABEL_SEARCHKEYWORDTIP", "Anahtar sözcük girin");
	//Type a keyword or listing name
	define("LANG_LABEL_SEARCHKEYWORDTIP_LISTING", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or deal title
	define("LANG_LABEL_SEARCHKEYWORDTIP_PROMOTION", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or event title
	define("LANG_LABEL_SEARCHKEYWORDTIP_EVENT", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or classified title
	define("LANG_LABEL_SEARCHKEYWORDTIP_CLASSIFIED", "Anahtar sözcük veya kayıt başlığı girin");
	//Type a keyword or article title
	define("LANG_LABEL_SEARCHKEYWORDTIP_ARTICLE", "Anahtar sözcük veya kayıt başlığı girin");
	//Where
	define("LANG_LABEL_SEARCHWHERE", "Nerede");
	//(Address, City, State or Zip Code)
	define("LANG_LABEL_SEARCHWHERETIP", "(Adres, İlçe, İl veya Posta Kodu)");
	//Wait, searching for your location...
	define("LANG_LABEL_WAIT_LOCATION", "Bulunduğunuz yer için aranıyor...");
	//Complete the form below to contact us.
	define("LANG_LABEL_FORMCONTACTUS", "Bizimle iletişime geçmek için aşağıdaki formu doldurun.");
	//Message
	define("LANG_LABEL_MESSAGE", "Mesaj");
	//No disabled categories found in the system.
	define("LANG_DISABLED_CATEGORY_NOTFOUND", "Hiçbir engelli kategoriler sistemi bulundu.");
	//No categories found.
	define("LANG_CATEGORY_NOTFOUND", "Kategori bulunmadı.");
	//Please, select a valid category
	define("LANG_CATEGORY_INVALIDERROR", "Lütfen geçerli bir kategori girin");
	//Please select a category first!
	define("LANG_CATEGORY_SELECTFIRSTERROR", "Lütfen önce bir kategori seçin!");
	//View Category Path
	define("LANG_CATEGORY_VIEWPATH", "Kategori Yolunu Gör");
	//Remove Selected Category
	define("LANG_CATEGORY_REMOVESELECTED", "Seçili Karakteri Kaldır");
	//"Extra categories/sub-categories cost an" additional [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC1", "Ekstra kategori/alt kategori tutarı:");
	//Extra categories/sub-categories cost an "additional" [LEVEL_CATEGORY_PRICE] each. Be seen!
	define("LANG_CATEGORIES_PRICEDESC2", "ek");
	//Extra categories/sub-categories cost an additional [LEVEL_CATEGORY_PRICE] "each. Be seen!"
	define("LANG_CATEGORIES_PRICEDESC3", "her biri. Görünür olun!");
	//Maximum of
	define("LANG_CATEGORIES_CATEGORIESMAXTIP1", "En fazla");
	//allowed.
	define("LANG_CATEGORIES_CATEGORIESMAXTIP2", "kategoriye izin verilir.");
	//Categories and sub-categories
	define("LANG_CATEGORIES_TITLE", "Kategoriler ve alt-kategoriler");
	//Only select sub-categories that directly apply to your type.
	define("LANG_CATEGORIES_MSG1", "Lütfen sadece kendi türünüzle doğrudan ilgili olan alt-kategorileri seçin.");
	//Your listing will automatically appear in the main category of each sub-category you select.
	define("LANG_CATEGORIES_MSG2", "Listeniz otomatik olarak seçtiğiniz her alt-kategorinin ana kategorisinde gözükecektir.");
	//Account Information Error
	define("LANG_ACCOUNTINFO_ERROR", "Hesap Bilgisi Hatası");
	//Contact Information
	define("LANG_CONTACTINFO", "İletişim Bilgileri");
	//This information will not be displayed publicly.
	define("LANG_CONTACTINFO_MSG", "Bu bilgiler herkes tarafından görüntülenmeyecektir.");
	//Billing Information
	define("LANG_BILLINGINFO", "Fatura Bilgileri");
	//This information will not be displayed publicly.
	define("LANG_BILLINGINFO_MSG1", "Bu bilgiler herkes tarafından görüntülenmeyecektir.");
	//You will configure your article after placing the order.
	define("LANG_BILLINGINFO_MSG2_ARTICLE", "Makalenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your banner after placing the order.
	define("LANG_BILLINGINFO_MSG2_BANNER", "Afişinizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your classified after placing the order.
	define("LANG_BILLINGINFO_MSG2_CLASSIFIED", "Ilanınızı sipariş yaptıktan sonra ayarlayacaksınız .");
	//You will configure your event after placing the order.
	define("LANG_BILLINGINFO_MSG2_EVENT", "Aktivitenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//You will configure your listing after placing the order.
	define("LANG_BILLINGINFO_MSG2_LISTING", "Listenizi sipariş yaptıktan sonra ayarlayacaksınız.");
	//Billing Information Error
	define("LANG_BILLINGINFO_ERROR", "Fatura Bilgisi Hatası");
	//Article Information
	define("LANG_ARTICLEINFO", "Makale Bilgileri");
	//Article Information Error
	define("LANG_ARTICLEINFO_ERROR", "Makale Bilgisi Hatası");
	//Banner Information
	define("LANG_BANNERINFO", "Afiş Bilgileri");
	//Banner Information Error
	define("LANG_BANNERINFO_ERROR", "Afiş Bilgisi Hatası");
	//Classified Information
	define("LANG_CLASSIFIEDINFO", "İlan Bilgileri");
	//Classified Information Error
	define("LANG_CLASSIFIEDINFO_ERROR", "İlan Bilgisi Hatası");
	//Browse Events by Date
	define("LANG_BROWSEEVENTSBYDATE", "Aktiviteleri tarihe göre göster");
	//Event Information
	define("LANG_EVENTINFO", "Aktivite Bilgileri");
	//Event Information Error
	define("LANG_EVENTINFO_ERROR", "Aktivite Bilgisi Hatası");
	//Listing Information
	define("LANG_LISTINGINFO", "Liste Bilgileri");
	//Listing Information Error
	define("LANG_LISTINGINFO_ERROR", "Liste Bilgisi Hatası");
	//Claim this Listing
	define("LANG_LISTING_CLAIMTHIS", "Bu listeyi talep et");
	//Listing Type
	define("LANG_LISTING_LABELTEMPLATE", string_ucwords(LISTING_FEATURE_NAME)." Tür");
	//No results were found for the search criteria you requested.
	define("LANG_MSG_NORESULTS", "Aradığınız kriterlere uygun bir sonuç bulunamadı.");
	//Please try your search again or browse by section.
	define("LANG_MSG_TRYAGAIN_BROWSESECTION", "Lütfen aramanızı tekrar deneyin veya bölüme göre arayın.");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword and perform your search again.
	define("LANG_MSG_USE_SPECIFIC_KEYWORD", "Bazen kullandığınız anahtar sözcük çok kapsamlı olduğu için sonuç alamayabilirsiniz. Daha spesifik bir anahtar sözcük kullanıp aramanızı tekrar yapmayı deneyin.");
	//Please type at least one keyword on the search box.
	define("LANG_MSG_LEASTONEKEYWORD", "Lütfen arama kutusuna en az bir anahtar sözcük girin.");
	//"No results content"
	define("LANG_SEARCH_NORESULTS", "<h1>Üzgünüm!</h1><p>Aramanız sonuç döndürür. Bu sıradışı olsa kullandığınız arama terimi biz gerçekten eşleşen herhangi bir içerik yok biraz genel veya olduğunda, zaman zaman olur.</p><h2>Öneriler:</h2>Arama terimlerinizi daha spesifik olun.<br />Yazım kontrol edin.<br />Eğer arama yoluyla bulamazsanız bölüm browing deneyin.<br /><br /><p>Size yanlışlıkla buraya gelmiş inanıyoruz, burada bir sorun bildirmek için site yöneticisi ile irtibata <a href=\"[EDIR_LINK_SEARCH_ERROR]\">geçiniz</a>.</p>");
	//Image
	define("LANG_SLIDESHOW_IMAGE", "Resim");
	//of
	define("LANG_SLIDESHOW_IMAGEOF", "i");
	//Error loading image
	define("LANG_SLIDESHOW_IMAGELOADINGERROR", "Resim yükleme hatası");
	//Next
	define("LANG_SLIDESHOW_NEXT", "İleri");
	//Pause
	define("LANG_SLIDESHOW_PAUSE", "Durdur");
	//Play
	define("LANG_SLIDESHOW_PLAY", "Oynat");
	//Back
	define("LANG_SLIDESHOW_BACK", "Geri");
	//Your e-mail has been sent. Thank you.
	define("LANG_CONTACTMSGSUCCESS", "E-postanız gönderildi. Teşekkürler.");
	//There was a problem sending this e-mail. Please try again.
	define("LANG_CONTACTMSGFAILED", "Bu e-postayı gönderirken bir sorun çıktı. Lütfen tekrar deneyin.");
	//Please enter your name.
	define("LANG_MSG_CONTACT_ENTER_NAME", "Please enter your name.");
	//Please enter a valid e-mail address.
	define("LANG_MSG_CONTACT_ENTER_VALID_EMAIL", "Lütfen geçerli bir e-posta adresi girin.");
	//Please type the message.
	define("LANG_MSG_CONTACT_TYPE_MESSAGE", "Lütfen bir mesaj girin.");
	//Please type the code correctly.
	define("LANG_MSG_CONTACT_TYPE_CODE", "Lütfen kodu doğru girin.");
	//Please correct it and try again.
	define("LANG_MSG_CONTACT_CORRECTIT_TRYAGAIN", "Lütfen düzeltip tekrar deneyin.");
	//Please type a name!
	define("LANG_MSG_CONTACT_TYPE_NAME", "Lütfen bir ad girin!");
	//Please type a subject!
	define("LANG_MSG_CONTACT_TYPE_SUBJECT", "Lütfen bir konu girin!");
	//SOME DETAILS
	define("LANG_ARTICLE_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_CLASSIFIED_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_EVENT_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_LISTING_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//SOME DETAILS
	define("LANG_PROMOTION_TOFRIEND_MAIL", "BAZI DETAYLAR");
	//Please enter a valid e-mail address in the "To" field
	define("LANG_MSG_TOFRIEND1", "Lütfen \"Gönderen\" alanına geçerli bir e-posta adresi girin");
	//Please enter a valid e-mail address in the "From" field
	define("LANG_MSG_TOFRIEND2", "Lütfen \"Gönderilen\" alanına geçerli bir e-posta adresi girin");
	//"Item not found. Please return to" [YOURSITE] and try again.
	define("LANG_MSG_TOFRIEND3", "Kayıt bulunamadı. Lütfen e geri dönün");
	//We could not find the item you're trying to send to a friend. Please return to [YOURSITE] "and try again."
	define("LANG_MSG_TOFRIEND4", "ve tekrar deneyin.");
	//Please enter a valid e-mail address in the "Your E-mail" field
	define("LANG_MSG_TOFRIEND5", "Lütfen \"E-Posta Adresiniz\" alanına geçerli bir e-posta adresi girin");
	//"About" [ARTICLE_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [ARTICLE_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_ARTICLE_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [CLASSIFIED_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [CLASSIFIED_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_CLASSIFIED_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [EVENT_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [EVENT_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_EVENT_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [LISTING_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [LISTING_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_LISTING_CONTACTSUBJECT_ISNULL_2", "den");
	//"About" [PROMOTION_TITLE] from the [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_1", "Hakkında");
	//About [PROMOTION_TITLE] "from the" [EDIRECTORY_TITLE]
	define("LANG_PROMOTION_CONTACTSUBJECT_ISNULL_2", "den");
	//Send info about this article to a friend
	define("LANG_ARTICLE_TOFRIEND_SAUDATION", "Bu makale hakkında arkadaşına bilgi gönder");
	//Send info about this classified to a friend
	define("LANG_CLASSIFIED_TOFRIEND_SAUDATION", "Bu ilan hakkında arkadaşına bilgi gönder");
	//Send info about this event to a friend
	define("LANG_EVENT_TOFRIEND_SAUDATION", "Bu aktivite hakkında arkadaşına bilgi gönder");
	//Send info about this listing to a friend
	define("LANG_LISTING_TOFRIEND_SAUDATION", "Bu liste hakkında arkadaşına bilgi gönder");
	//Send info about this deal to a friend
	define("LANG_PROMOTION_TOFRIEND_SAUDATION", "Bu teklif hakkında arkadaşına bilgi gönder");
	//Message sent by
	define("LANG_MESSAGE_SENT_BY", "Mesaj tarafından gönderildi ");
	//This is a automatic message.
	define("LANG_THIS_IS_A_AUTOMATIC_MESSAGE", "Bu otomatik bir mesajdır.");
	//Contact
	define("LANG_CONTACT", "İletişim");
	//article
	define("LANG_ARTICLE", "makale");
	//classified
	define("LANG_CLASSIFIED", "ilan");
	//event
	define("LANG_EVENT", "aktivite");
	//listing
	define("LANG_LISTING", "liste");
	//deal
	define("LANG_PROMOTION", "teklif");
	//Please search at least one parameter on the search box!
	define("LANG_MSG_LEASTONEPARAMETER", "Lütfen arama kutusuna en az bir parametre girin!");
	//Please try your search again.
	define("LANG_MSG_TRYAGAIN", "Lütfen aramanızı tekrar deneeyin.");
	//No articles registered yet.
	define("LANG_MSG_NOARTICLES", "Henüz makale kaydedilmemiş.");
	//No classifieds registered yet.
	define("LANG_MSG_NOCLASSIFIEDS", "Henüz ilan kaydedilmemiş.");
	//No events registered yet.
	define("LANG_MSG_NOEVENTS", "Henüz aktivite kaydedilmemiş.");
	//No listings registered yet.
	define("LANG_MSG_NOLISTINGS", "Henüz liste kaydedilmemiş.");
	//No deals registered yet.
	define("LANG_MSG_NOPROMOTIONS", "Henüz teklifler kaydedilmemiş.");
	//Message sent through
	define("LANG_CONTACTPRESUBJECT", "Mesaj üzerinden gönderildi");
	//E-mail Form
	define("LANG_EMAILFORM", "E-posta Formu");
	//Click here to print
	define("LANG_PRINTCLICK", "Yazdırmak için tıklayın");
	//View all categories
	define("LANG_CLASSIFIED_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Location
	define("LANG_CLASSIFIED_LOCATIONS", "Yer");
	//More Classifieds
	define("LANG_CLASSIFIED_MORE", "Daha fazla ilan");
	//View all categories
	define("LANG_EVENT_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Location
	define("LANG_EVENT_LOCATIONS", "Yer");
	//Featured Events
	define("LANG_EVENT_FEATURED", "Vitrindeki Aktiviteler");
	//events
	define("LANG_EVENT_PLURAL", "Aktiviteler");
	//Search results
	define("LANG_SEARCHRESULTS", "Arama sonuçları");
	//Results
	define("LANG_RESULTS", "Sonuçlar");
	//Search results "for" keyword
	define("LANG_SEARCHRESULTS_KEYWORD", "için");
	//Search results "in" where
	define("LANG_SEARCHRESULTS_WHERE", "deki");
	//Search results "in" template
	define("LANG_SEARCHRESULTS_TEMPLATE", "daki");
	//Search results "in" category
	define("LANG_SEARCHRESULTS_CATEGORY", "deki");
	//Search results "in category"
	define("LANG_SEARCHRESULTS_INCATEGORY", "kategorisindeki");
	//Search results "in" location
	define("LANG_SEARCHRESULTS_LOCATION", "deki");
	//Search results "in" zip
	define("LANG_SEARCHRESULTS_ZIP", "daki");
	//Search results "for" date
	define("LANG_SEARCHRESULTS_DATE", "için");
	//Search results - "Page" X
	define("LANG_SEARCHRESULTS_PAGE", "Sayfa");
	//Recent Reviews
	define("LANG_RECENT_REVIEWS", "En Son Yorumlar");
	//Reviews of
	define("LANG_REVIEWSOF", "Yorumları");
	//Reviews are disabled
	define("LANG_REVIEWDISABLE", "Yorumlar etkisiz kılındı");
	//View all categories
	define("LANG_ARTICLE_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//View all categories
	define("LANG_PROMOTION_VIEWALLCATEGORIES", "Tüm kategorileri gör");
	//Offer
	define("LANG_PROMOTION_OFFER", "Teklif");
	//Description
	define("LANG_PROMOTION_DESCRIPTION", "Tanım");
	//Conditions
	define("LANG_PROMOTION_CONDITIONS", "Şartlar");
	//Location
	define("LANG_PROMOTION_LOCATIONS", "Yer");
	//Item not found!
	define("LANG_MSG_NOTFOUND", "Kayıt bulunamadı!");
	//Item not available!
	define("LANG_MSG_NOTAVAILABLE", "Kayıt mevcut değil!");
	//Listing Search Results
	define("LANG_MSG_LISTINGRESULTS", "Liste Arama Sonuçları");
	//Deal Search Results
	define("LANG_MSG_PROMOTIONRESULTS", "Teklif Arama Sonuçları");
	//Event Search Results
	define("LANG_MSG_EVENTRESULTS", "Aktivite Arama Sonuçları");
	//Classified Search Results
	define("LANG_MSG_CLASSIFIEDRESULTS", "İlan Arama Sonuçları");
	//Article Search Results
	define("LANG_MSG_ARTICLERESULTS", "Makale Arama Sonuçları");
	//Available Languages
	define("LANG_MSG_AVAILABLELANGUAGES", "Mevcut Diller");
	//You can choose up to [MAX_ENABLED_LANGUAGES] of the languages below for your directory.
	define("LANG_MSG_AVAILABLELANGUAGESMSG", "Rehberiniz için en fazla ".MAX_ENABLED_LANGUAGES." adet dil seçebilirsiniz.");

	# ----------------------------------------------------------------------------------------------------
	# MEMBERS
	# ----------------------------------------------------------------------------------------------------
	//Enjoy our Services!
	define("LANG_ENJOY_OUR_SERVICES", "Hizmetlerimizin tadını çıkarın!");
	//Remove association with
	define("LANG_REMOVE_ASSOCIATION_WITH", "Arasındaki ilişkiyi kaldır");
	//Welcome
	define("LANG_LABEL_WELCOME", "Hoşgeldiniz");
	//Sponsor Options
	define("LANG_LABEL_MEMBER_OPTIONS", "Sponsor Ayarları");
	//Back to Website
	define("LANG_LABEL_BACK_TO_SEARCH", "Website Dön");
	//Add New Account
	define("LANG_LABEL_ADD_NEW_ACCOUNT", "Yeni Hesap Ekle");
	//Forgotten password
	define("LANG_LABEL_FORGOTTEN_PASSWORD", "Unutulmuş şifre");
	//Click here
	define("LANG_LABEL_CLICK_HERE", "Tıklayın");
	//Help
	define("LANG_LABEL_HELP", "Yardım");
	//Reset Password
	define("LANG_LABEL_RESET_PASSWORD", "Şifreyi sıfırla");
	//Account and Contact Information
	define("LANG_LABEL_ACCOUNT_AND_CONTACT_INFO", "Hesap ve İletişim Bilgileri");
	//Signup Notification
	define("LANG_LABEL_SIGNUP_NOTIFICATION", "Kayıt Bildirisi");
	//Go to Sign in
	define("LANG_LABEL_GO_TO_LOGIN", "Kaydol'a git");
	//Order
	define("LANG_LABEL_ORDER", "Sipariş Et");
	//Check Out
	define("LANG_LABEL_CHECKOUT", "Ödeme Yap");
	//Configuration
	define("LANG_LABEL_CONFIGURATION", "Ayarlar");
	//Please, type your site URL first.
	define("LANG_LABEL_TYPE_URL", "Lütfen yazın ilk sitenizin URL\'sini.");
	//Validation failed! Please try again.
	define("LANG_LABEL_VALIDATION_FAIL", "Doğrulaması başarısız! Lütfen tekrar deneyin.");
	//Site successfully validated!
	define("LANG_LABEL_VALIDATION_OK", "Sitesi başarıyla valide!");
	//Build Traffic
	define("LANG_LABEL_TRAFFIC", "Inşa Trafik");
	//Please, notice that you can change this code as you want, since you keep the URL exactly like shown here, otherwise your backlink will not be validated.
	define("LANG_LABEL_BACKLINKCODE_TIP", "URL tam olarak istediğiniz aksi takdirde backlink geçerliliği olmayacak, burada gösterilen tutmak yana, istediğiniz kadar bu kodu değiştirebilir fark edin.");
	//Backlink not been validated. Please, try again.
	define("LANG_BACKLINK_NOT_VALIDATED", "Backlink valide edilmemiştir. Yeniden deneyin lütfen.");
	//Check this box to remove the backlink for this listing
	define("LANG_MSG_CLICK_TO_REMOVE_BACKLINK", "Bu liste için backlink kaldırmak için bu kutuyu işaretleyin");
	//Backlink URL
	define("LANG_LABEL_BACKLINK_URL", "Backlink URL");
	//URL where the backlink was installed.
	define("LANG_LABEL_BACKLINK_URL_TIP", "Backlink kuruldu URL.");
	//Please, type the Backlink URL.
	define("LANG_BACKLINK_TYPE_URL", "Backlink URL'sini yazın lütfen");
	//Backlink
	define("LANG_LABEL_BACKLINK", "Backlink");
	//Backlink not available for this listing
	define("LANG_MSG_BACKLINK_NOT_AVAILABLE", "Bu liste için geçerli değildir backlink");
	//Add a Backlink
	define("LANG_LABEL_ADDBACKLINK", "Bir Backlink ekle");
	//Put this on your Site (HTML Code):
	define("LANG_LABEL_PUTTHISCODE", "Site (HTML Kodu) koyarım:");
	//Enter the URL of your Site:
	define("LANG_LABEL_ENTERURL", "Site URL'sini girin:");
	//Ex: http://www.mywebsite.com
	define("LANG_LABEL_ENTERURL_TIP", "Ex: http://www.mywebsite.com");
	//Click the Button to verify your Backlink
	define("LANG_LABEL_VERIFYSITE", "Senin Backlink doğrulamak için Düğmesi'ni");
	//Verify
	define("LANG_LABEL_VERIFY", "Doğrulamak");
	//Why add a Backlink?
	define("LANG_LABEL_QUESTION1", "Neden bir Backlink eklemek?");
	//Adding a link to your website pointing to this one, increases the relevance of this site and in turn the relevance of your listing.
	define("LANG_LABEL_ANSWER1", "Bu bir işaret eden web sitenize link ekleme, bu sitenin ve kaleminin alaka sırayla alaka artar.");
	//What's in it for me?
	define("LANG_LABEL_QUESTION2", "Benim için neler var?");
	//By giving us a link on the homepage of your site, you help us with our ranking and hence your results. But as well as helping us, we willl go the extra mile and help you. If you add a link, once we have verified it exists, we will show your listing with a special style on the results page, so you really get some extra exposure in the directory - it's a win / win situation for us both.
	define("LANG_LABEL_ANSWER2", "Bize sitenizin ana sayfasında bir link vererek, bizim sıralama ve dolayısıyla sizin sonuç bize yardım eder. Ama aynı zamanda bize yardımcı olarak, ekstra mil gidecek ve size yardımcı olacaktır. Eğer bir bağlantı eklerseniz, bir zamanlar biz, biz site üzerinde önemli bir pozisyonda öğe gösterecektir var doğrulanmadı var, bu yüzden gerçekten dizinin bazı ekstra poz olsun - bir / ikimiz için kazan-kazan durumu's.");
	//How can I do this?
	define("LANG_LABEL_QUESTION3", "Bunu nasıl yapabilirim?");
	//Simple really, copy the code above into the code of your website, so that it shows up somewhere prominent on the home page, give us the URL of your website (where the link is) and we will verify it after you hit the "Verify" button - then just continue on.... super simple.
	define("LANG_LABEL_ANSWER4", "Basit, gerçekten bize web sitenizin URL'sini (bağlantı olduğu) vermek, onu bir yere giriş sayfasında belirgin gösterir, böylece web sitenizin koduna yukarıdaki kodu kopyalayın ve düğmesine \"Doğrulamak\" basın sonra bunu doğrular - o zaman sadece devam .... süper basit.");
	//No, Order without the Backlink.
	define("LANG_LABEL_WITHOUT", "Hayır, Backlink olmadan sipariş.");
	//Yes, add Backlink
	define("LANG_LABEL_CONFIRM_BACKLINK", "Evet, Backlink eklemek");
	//Backlink successfully added to your listing!
	define("LANG_MSG_LISTING_BACKLINKS_ADDED", "Geri başarıyla liste eklendi!");
	//You have no listing to add backlink yet.
	define("LANG_MSG_LISTING_BACKLINKS_ERROR", "Henüz backlink eklemek için herhangi bir liste yok.");
	//Backlink preview
	define("LANG_LABEL_BACKLINK_PREVIEW", "Backlink önizlemesi");
	//Category Detail
	define("LANG_LABEL_CATEGORY_DETAIL", "Kategori Detayı");
	//Site Manager
	define("LANG_LABEL_SITE_MANAGER", "Site Yöneticisi");
	//Summary page
	define("LANG_LABEL_SUMMARY_PAGE", "Özet Sayfası");
	//Detail page
	define("LANG_LABEL_DETAIL_PAGE", "Detay Sayfası");
	//Photo Gallery
	define("LANG_LABEL_PHOTO_GALLERY", "Foto Galeri");
	//Add Banner
	define("LANG_LABEL_ADDBANNER", "Afiş Ekle");
	//Gallery Image Information
	define("LANG_LABEL_GALLERYIMAGEINFORMATION", "Galeri Resmi Bilgileri");
	//Gallery Images
	define("LANG_LABEL_GALLERYIMAGES", "Galeri Resimleri");
	//Manage Gallery Images
	define("LANG_LABEL_MANAGEGALLERYIMAGES", "Galeri Resimlerini Yönet");
	//Manage Galleries
	define("LANG_LABEL_MANAGEGALLERY_PLURAL", "Galerileri Yönet");
	//Gallery does not exist!
	define("LANG_LABEL_GALLERYDOESNOTEXIST", "Galeri yok!");
	//Gallery not available!
	define("LANG_LABEL_GALLERYNOTAVAILABLE", "Galeri mevcut değil!");
	//Custom Invoice Title
	define("LANG_LABEL_CUSTOM_INVOICE_TITLE", "Özel Fatura Başlığı");
	//Custom Invoice Items
	define("LANG_LABEL_CUSTOM_INVOICE_ITEMS", "Özel Fatura Kayıtları");
	//Easy and Fast.
	define("LANG_LABEL_EASY_AND_FAST", "Kolay ve de Hızlı.");
	//Steps
	define("LANG_LABEL_STEPS", "Adımlar");
	//Account Signup
	define("LANG_LABEL_ACCOUNT_SIGNUP", "Hesap Kaydı");
	//Select a Level
	define("LANG_LABEL_SELECT_PACKAGE", "Bir Seviye Seçin");
	//Payment Status
	define("LANG_LABEL_PAYMENTSTATUS", "Ödeme Statüsü");
	//Expiration
	define("LANG_LABEL_EXPIRATION", "Son Kullanma Tarihi");
	//Add New Gallery
	define("LANG_LABEL_ADDNEWGALLERY", "Yeni Galeri Ekle");
	//Add a new gallery
	define("LANG_LABEL_ADDANEWGALLERY", "Yeni galeri ekle");
	//New Deal
	define("LANG_LABEL_ADDNEWPROMOTION", "Teklif Ekle.");
	//Add a new deal
	define("LANG_LABEL_ADDANEWPROMOTION", "Yeni teklif ekle.");
	//Manage Billing
	define("LANG_LABEL_MANAGEBILLING", "Faturaları Yönet");
	//Click here if you have your password already.
	define("LANG_MSG_CLICK_IF_YOU_HAVE_PASSWORD", "Şifrenizi zaten aldıysanız tıklayın.");
	//Not a sponsor?
	define("LANG_MSG_NOT_A_MEMBER", "Sponsor değil misiniz?");
	//for information on adding your item to
	define("LANG_MSG_FOR_INFORMATION_ON_ADDING_YOUR_ITEM", "kaydınızı eklemek hakkında bilgiler");
	//Welcome to the Sponsor Section
	define("LANG_MSG_WELCOME", "Sponsor Bölümüne Hoşgeldiniz");
	//Welcome to the Member Section
	define("LANG_MSG_WELCOME2", "Üye Bölümüne Hoşgeldiniz");
	//"Account locked. Wait" X minute(s) and try again.
	define("LANG_MSG_ACCOUNTLOCKED1", "Hesap kilitlendi.");
	//Account locked. Wait X "minute(s) and try again."
	define("LANG_MSG_ACCOUNTLOCKED2", "dakika bekleyin ve tekrar deneyin.");
	//One or more required fields were not filled in. Please confirm that all required information has been entered before continuing.
	define("LANG_MSG_FOREIGNACCOUNTWARNING", "Bir veya daha fazla gerekli alanların doldurulması değildi. Gerekli tüm bilgileri devam etmeden önce girmiş olduğunu onaylayın.");
	//You don't have access permission from this IP address!
	define("LANG_MSG_YOUDONTHAVEACCESSFROMTHISIPADDRESS", "Bu IP adresinden giriş yapma yetkiniz yok!");
	//Your account was deactivated!
	define("LANG_MSG_ACCOUNT_DEACTIVE", "Hesabınız etkisizleştirildi!");
	//Sorry, your username or password is incorrect.
	define("LANG_MSG_USERNAME_OR_PASSWORD_INCORRECT", "Maalesef kullanıcı adı veya şifreniz yanlış.");
	//Sorry, wrong account.
	define("LANG_MSG_WRONG_ACCOUNT", "Maalesef yanlış hesap.");
	//Sorry, for your protection the link sent to your e-mail has expired. If you forgot your password click on the link below.
	define("LANG_MSG_WRONG_KEY", "Maalesef güvenliğiniz için e-postanıza gönderilen linkin süresi doldu. Şifrenizi unuttuysanız aşağıdaki linke tıklayın.");
	//OpenID Server not available!
	define("LANG_MSG_OPENID_SERVER", "OpenID Sunucusu uygun değil!");
	//Error requesting OpenID Server!
	define("LANG_MSG_OPENID_ERROR", "OpenID Sunucusu isterken hata!");
	//OpenID request canceled!
	define("LANG_MSG_OPENID_CANCEL", "OpenID isteği iptal edildi!");
	//Google request canceled!
	define("LANG_MSG_GOOGLE_CANCEL", "Google isteği iptal edildi!");
	//Invalid OpenID Identity!
	define("LANG_MSG_OPENID_INVALID", "Geçersiz OpenID Kimliği!");
	//Forgot your password?
	define("LANG_MSG_FORGOT_YOUR_PASSWORD", "Şifrenizi mi unuttunuz?");
	//What is OpenID?
	define("LANG_MSG_WHATISOPENID", "OpenID nedir?");
	//What is Facebook?
	define("LANG_MSG_WHATISFACEBOOK", "Facebook nedir?");
	//What is Google?
	define("LANG_MSG_WHATISGOOGLE", "Google nedir?");
	//Account successfully updated!
	define("LANG_MSG_ACCOUNT_SUCCESSFULLY_UPDATED", "Hesap başarıyla güncellendi!");
	//Password successfully updated!
	define("LANG_MSG_PASSWORD_SUCCESSFULLY_UPDATED", "Şifre başarıyla güncellendi!");
	//"Thank you for signing up for an account in" [EDIRECTORY_TITLE]
	define("LANG_MSG_THANK_YOU_FOR_SIGNING_UP", "de bir hesap kaydettiğiniz için teşekkür ederiz");
	//Sign in to manage your account with the e-mail and password below.
	define("LANG_MSG_LOGIN_TO_MANAGE_YOUR_ACCOUNT", "Hesabınızı yönetmek için aşağıdaki e-posta ve şifreyi kullanarak oturum açın.");
	//You can see
	define("LANG_MSG_YOU_CAN_SEE", "Görebilirsiniz");
	//Your account in
	define("LANG_MSG_YOUR_ACCOUNT_IN", "daki hesabınız");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_ARTICLE_WILL_SHOW", "Bu makale resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_CLASSIFIED_WILL_SHOW", "Bu ilan resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_EVENT_WILL_SHOW", "Bu aktivite resim gösterecek");
	//"This [ITEM] will show" [UNLIMITED|the max of X] images per gallery.
	define("LANG_MSG_LISTING_WILL_SHOW", "Bu liste resim gösterecek");
	//This [ITEM] will show [UNLIMITED|"the max of" X] images per gallery.
	define("LANG_MSG_THE_MAX_OF", "en fazla");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTO", "resim");
	//This [ITEM] will show [UNLIMITED|the max of X] "images" per gallery.
	define("LANG_MSG_GALLERY_PHOTOS", "resimler");
	//This [ITEM] will show [UNLIMITED|the max of X] images "in the gallery"
	define("LANG_MSG_PER_GALLERY", "galeride");
	// plus one main image.
	define("LANG_MSG_PLUS_MAINIMAGE", " artı bir ana görüntü.");
	//or Associate an existing gallery with this article
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_ARTICLE", "veya mevcut bir galeriyi bu makale ile ilişkilendirin");
	//or Associate an existing gallery with this classified
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_CLASSIFIED", "veya mevcut bir galeriyi bu ilan ile ilişkilendirin");
	//or Associate an existing gallery with this event
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_EVENT", "veya mevcut bir galeriyi bu aktivite ile ilişkilendirin");
	//or Associate an existing gallery with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_GALLERY_WITH_LISTING", "veya mevcut bir galeriyi bu liste ile ilişkilendirin");
	//Continue to pay for your article
	define("LANG_MSG_CONTINUE_TO_PAY_ARTICLE", "Makalenizi ödemek için devam edin");
	//Continue to pay for your banner
	define("LANG_MSG_CONTINUE_TO_PAY_BANNER", "Afişinizi ödemek için devam edin");
	//Continue to pay for your classified
	define("LANG_MSG_CONTINUE_TO_PAY_CLASSIFIED", "Ilanızı ödemek için devam edin");
	//Continue to pay for your event
	define("LANG_MSG_CONTINUE_TO_PAY_EVENT", "Aktivitenizi ödemek için devam edin");
	//Continue to pay for your listing
	define("LANG_MSG_CONTINUE_TO_PAY_LISTING", "Listenizi ödemek için devam edin");
	//Articles are activated by
	define("LANG_MSG_ARTICLES_ARE_ACTIVATED_BY", "Makaleler tarafından etkinleştirilir");
	//Banners are activated by
	define("LANG_MSG_BANNERS_ARE_ACTIVATED_BY", "Afişler tarafından etkinleştirilir");
	//Classifieds are activated by
	define("LANG_MSG_CLASSIFIEDS_ARE_ACTIVATED_BY", "Ilanlar tarafından etkinleştirilir");
	//Events are activated by
	define("LANG_MSG_EVENTS_ARE_ACTIVATED_BY", "Aktiviteler tarafından etkinleştirilir");
	//Listings are activated by
	define("LANG_MSG_LISTINGS_ARE_ACTIVATED_BY", "Listeler tarafından etkinleştirilir");
	//only after the process is complete.
	define("LANG_MSG_ONLY_PROCCESS_COMPLETE", "sadece işlem tamalandıktan sonra.");
	//Tips for the Item Map Tuning
	define("LANG_MSG_TIPSFORMAPTUNING", "Kayıtların Harita Ayarları için ipuçları");
	//You can adjust the position in the map,
	define("LANG_MSG_YOUCANADJUSTPOSITION", "Haritadaki konumu ayarlayabilirsiniz,");
	//with more accuracy.
	define("LANG_MSG_WITH_MORE_ACCURACY", "daha fazla kesinlikle.");
	//Use the controls "+" and "-" to adjust the map zoom.
	define("LANG_MSG_USE_CONTROLS_TO_ADJUST", "Haritayı yaklaştırmak için \"+\" ve \"-\" kontrollerini kullanın.");
	//Use the arrows to navigate on map.
	define("LANG_MSG_USE_ARROWS_TO_NAVIGATE", "Haritada gezmek için okları kullanın.");
	//Drag-and-Drop the marker to adjust the location.
	define("LANG_MSG_DRAG_AND_DROP_MARKER", "Konumu ayarlamak için imleci Taşı-ve-Bırak.");
	//Your deal will appear here
	define("LANG_MSG_PROMOTION_WILL_APPEAR_HERE", "teklif burada gözükecek");
	//Associate an existing deal with this listing
	define("LANG_MSG_ASSOCIATE_EXISTING_PROMOTION", "Veya mevcut olan bir teklif bu liste ile ilişkilendirin");
	//No results found!
	define("LANG_MSG_NO_RESULTS_FOUND", "Sonuç bulunmadı!");
	//Access not allowed!
	define("LANG_MSG_ACCESS_NOT_ALLOWED", "Giriş izni verilmedi!");
	//The following problems were found
	define("LANG_MSG_PROBLEMS_WERE_FOUND", "Aşağıdaki problemler bulundu");
	//No items selected or requiring payment.
	define("LANG_MSG_NO_ITEMS_SELECTED_REQUIRING_PAYMENT", "Hiçbir kayıt seçilmedi veya ödeme gerekmiyor.");
	//No items found.
	define("LANG_MSG_NO_ITEMS_FOUND", "Hiçbir kayıt bulunmadı.");
	//No invoices in the system.
	define("LANG_MSG_NO_INVOICES_IN_THE_SYSTEM", "Sistemde hiçbir Fatura yok.");
	//No transactions in the system.
	define("LANG_MSG_NO_TRANSACTIONS_IN_THE_SYSTEM", "Sistemde hiçbir İşlem yok.");
	//Claim this Listing
	define("LANG_MSG_CLAIM_THIS_LISTING", "Bu listeyi talep et");
	//Go to sponsor check out area
	define("LANG_MSG_GO_TO_MEMBERS_CHECKOUT", "Sponsor ödeme bölgesine git");
	//You can see your invoice in
	define("LANG_MSG_YOU_CAN_SEE_INVOICE", "Faturanızı görebilirsiniz");
	//I agree to terms
	define("LANG_MSG_AGREE_TO_TERMS", "Şartları kabul ediyorum");
	//and I will send payment.
	define("LANG_MSG_I_WILL_SEND_PAYMENT", "ve ödeme yapacağım.");
	//This page will redirect you to your sponsor area in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU", "Bu sayfa birkaç saniye içinde sponsor bölgesine yönlendirilecektir.");
	//This page will redirect you to continue your signup process in few seconds.
	define("LANG_MSG_THIS_PAGE_WILL_REDIRECT_YOU_SIGNUP", "Bu sayfa birkaç saniye içinde kayıt işlemine devam sayfasına yönlendirilecektir.");
	//"If it doesn't work, please" click here
	define("LANG_MSG_IF_IT_DOES_NOT_WORK", "Çalışmıyorsa lütfen");
	//Manage Article
	define("LANG_MANAGE_ARTICLE", "Makaleleri Yönet");
	//Manage Banner
	define("LANG_MANAGE_BANNER", "Afişleri Yönet");
	//Manage Classified
	define("LANG_MANAGE_CLASSIFIED", "İlanları Yönet");
	//Manage Event
	define("LANG_MANAGE_EVENT", "Aktiviteleri Yönet");
	//Manage Listing
	define("LANG_MANAGE_LISTING", "Listeleri Yönet");
	//Manage Deal
	define("LANG_MANAGE_PROMOTION", "Teklif Yönet");
	//Manage Billing
	define("LANG_MANAGE_BILLING", "Faturalandırmayı Yönet");
	//Manage Invoices
	define("LANG_MANAGE_INVOICES", "Faturaları Yönet");
	//Manage Transactions
	define("LANG_MANAGE_TRANSACTIONS", "İşlemleri Yönet");
	//No articles in the system.
	define("LANG_NO_ARTICLES_IN_THE_SYSTEM", "Sistemde hiçbir makale yok.");
	//No banners in the system.
	define("LANG_NO_BANNERS_IN_THE_SYSTEM", "Sistemde hiçbir afiş yok.");
	//No classifieds in the system.
	define("LANG_NO_CLASSIFIEDS_IN_THE_SYSTEM", "Sistemde hiçbir ilan yok.");
	//No events in the system.
	define("LANG_NO_EVENTS_IN_THE_SYSTEM", "Sistemde hiçbir aktivite yok.");
	//No galleries in the system.
	define("LANG_NO_GALLERIES_IN_THE_SYSTEM", "Sistemde hiçbir galeri yok.");
	//No listings in the system.
	define("LANG_NO_LISTINGS_IN_THE_SYSTEM", "Sistemde hiçbir liste yok.");
	//No deals in the system.
	define("LANG_NO_PROMOTIONS_IN_THE_SYSTEM", "Sistemde hiçbir teklifler yok.");
	//No Reports Available.
	define("LANG_NO_REPORTS", "Hiçbir Rapor Mevcut Değil.");
	//No article found. It might be deleted.
	define("LANG_NO_ARTICLE_FOUND", "Hiçbir makale bulunmadı. Silinmiş olabilir.");
	//No classified found. It might be deleted.
	define("LANG_NO_CLASSIFIED_FOUND", "Hiçbir ilan bulunmadı. Silinmiş olabilir.");
	//No listing found. It might be deleted.
	define("LANG_NO_LISTING_FOUND", "Hiçbir liste bulunmadı. Silinmiş olabilir.");
	//Article Information
	define("LANG_ARTICLE_INFORMATION", "Makale Bilgileri");
	//Delete Article
	define("LANG_ARTICLE_DELETE", "Makaleyi sil.");
	//Delete Article Information
	define("LANG_ARTICLE_DELETE_INFORMATION", "Makale Bilgilerini Sil");
	//Are you sure you want to delete this article
	define("LANG_ARTICLE_DELETE_CONFIRM", "Bu makaleyi silmek istediğinizden emin misiniz?");
	//Article Gallery
	define("LANG_ARTICLE_GALLERY", "Makale Galerisi");
	//Article Preview
	define("LANG_ARTICLE_PREVIEW", "Makalenin Önizlemesi ");
	//Article Traffic Report
	define("LANG_ARTICLE_TRAFFIC_REPORT", "Makalenin Trafik Raporu");
	//Article Detail
	define("LANG_ARTICLE_DETAIL", "Makale Detayları");
	//Edit Article Information
	define("LANG_ARTICLE_EDIT_INFORMATION", "Makale Bilgilerini Düzenle");
	//Delete Banner
	define("LANG_BANNER_DELETE", "Afişi Sil");
	//Delete Banner Information
	define("LANG_BANNER_DELETE_INFORMATION", "Afiş Bilgilerini Sil");
	//Are you sure you want to delete this banner?
	define("LANG_BANNER_DELETE_CONFIRM", "Bu afişi silmek istediğinizden emin misiniz?");
	//Edit Banner
	define("LANG_BANNER_EDIT", "Afişi Düzenle");
	//Edit Banner Information
	define("LANG_BANNER_EDIT_INFORMATION", "Afiş Bilgilerini Düzenle ");
	//Banner Preview
	define("LANG_BANNER_PREVIEW", "Afişin Önizlemesi");
	//Banner Traffic Report
	define("LANG_BANNER_TRAFFIC_REPORT", "Afişin Trafik Raporu");
	//View Banner
	define("LANG_VIEW_BANNER", "Afişi Gör");
	//Disabled
	define("LANG_BANNER_DISABLED", "Kapatıldı");
	//Classified Information
	define("LANG_CLASSIFIED_INFORMATION", "İlan Bilgileri");
	//Delete Classified
	define("LANG_CLASSIFIED_DELETE", "İlanı Sil");
	//Your classified will automatically appear in the main category of each sub-category you select.
	define("LANG_MSG_CLASSIFIED_AUTOMATICALLY_APPEAR", "Ilanınız otomatik olarak seçtiğiniz alt-kategorinin ana kategorisinde gözükecektir.");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORY_PLURAL", "İlan Kategorileri");
	//Classified Categories
	define("LANG_CLASSIFIED_CATEGORIES", "İlan Kategorileri");
	//Delete Classified Information
	define("LANG_CLASSIFIED_DELETE_INFORMATION", "İlan Bilgilerini Sil");
	//Are you sure you want to delete this classified
	define("LANG_CLASSIFIED_DELETE_CONFIRM", "Bu İlanı silmek istediğinizden emin misiniz?");
	//Classified Gallery
	define("LANG_CLASSIFIED_GALLERY", "İlan Galerisi");
	//Classified Map Tuning
	define("LANG_CLASSIFIED_MAP_TUNING", "İlanın Harita Ayarları");
	//Classified Preview
	define("LANG_CLASSIFIED_PREVIEW", "İlanın Önizlemesi");
	//Classified Traffic Report
	define("LANG_CLASSIFIED_TRAFFIC_REPORT", "İlanın Trafik Raporları");
	//Classified Detail
	define("LANG_CLASSIFIED_DETAIL", "İlanın Detayları");
	//Edit Classified Information
	define("LANG_CLASSIFIED_EDIT_INFORMATION", "İlanın Bilgilerini Düzenle");
	//Edit Classified Level
	define("LANG_CLASSIFIED_EDIT_LEVEL", "İlanın Seviyelerini Düzenle");
	//Delete Event
	define("LANG_EVENT_DELETE", "Aktiviteyi Sil");
	//Delete Event Information
	define("LANG_EVENT_DELETE_INFORMATION", "Aktivite Bilgilerini Sil");
	//Are you sure you want to delete this event
	define("LANG_EVENT_DELETE_CONFIRM", "Bu aktiviteyi silmek istediğinizden emin misiniz? ");
	//Event Information
	define("LANG_EVENT_INFORMATION", "Aktivite Bilgileri");
	//Event Gallery
	define("LANG_EVENT_GALLERY", "Aktivite Galerisi");
	//Event Map Tuning
	define("LANG_EVENT_MAP_TUNING", "Aktivitenin Harita Ayarları");
	//Event Preview
	define("LANG_EVENT_PREVIEW", "Aktivitenin Önizlemesi");
	//Event Traffic Report
	define("LANG_EVENT_TRAFFIC_REPORT", "Aktivitenin Trafik Raporu");
	//Event Detail
	define("LANG_EVENT_DETAIL", "Aktivite Detayları");
	//Edit Event Information
	define("LANG_EVENT_EDIT_INFORMATION", "Aktivite Bilgilerini Düzenle");
	//Listing Gallery
	define("LANG_LISTING_GALLERY", "Liste Galerisi");
	//Listing Information
	define("LANG_LISTING_INFORMATION", "Liste Bilgileri");
	//Listing Map Tuning
	define("LANG_LISTING_MAP_TUNING", "Listenin Harita Ayarları");
	//Listing Preview
	define("LANG_LISTING_PREVIEW", "Listenin Önizlemesi");
	//Listing Deal
	define("LANG_LISTING_PROMOTION", "Liste Teklif");
	//The deal is linked from the listing.
	define("LANG_LISTING_PROMOTION_IS_LINKED", "Teklif listeden bağlanmıştır.");
	//To be active the deal
	define("LANG_LISTING_TO_BE_ACTIVE_PROMOTION", "Aktif olmak için teklif");
	//must have an end date in the future.
	define("LANG_LISTING_END_DATE_IN_FUTURE", "un bitiş tarihi gelecekte olmalıdır.");
	//must be associated with a listing.
	define("LANG_LISTING_ASSOCIATED_WITH_LISTING", "bir liste ile ilişkilendirilmesi gereklidir.");
	//Listing Traffic Report
	define("LANG_LISTING_TRAFFIC_REPORT", "Listenin Trafik Raporu");
	//Listing Detail
	define("LANG_LISTING_DETAIL", "Liste Detayları");
	//for listing
	define("LANG_LISTING_FOR_LISTING", "liste için");
	//Listing Update
	define("LANG_LISTING_UPDATE", "Liste Güncellemesi");
	//Delete Deal
	define("LANG_PROMOTION_DELETE", "Teklif Sil");
	//Delete Deal Information
	define("LANG_PROMOTION_DELETE_INFORMATION", "Teklif Bilgilerini Sil");
	//Are you sure you want to delete this deal?
	define("LANG_PROMOTION_DELETE_CONFIRM", "Bu teklif silmek istediğinizden emin misiniz ?");
	//Deal Preview
	define("LANG_PROMOTION_PREVIEW", "Teklif Önizlemesi");
	//Deal Information
	define("LANG_PROMOTION_INFORMATION", "Teklif Bilgileri");
	//Deal Detail
	define("LANG_PROMOTION_DETAIL", "Teklif Detayları");
	//Edit Deal Information
	define("LANG_PROMOTION_EDIT_INFORMATION", "Teklif Bilgilerini Düzenle");
	//Delete Gallery
	define("LANG_GALLERY_DELETE", "Galeriyi Sil");
	//Delete Gallery Information
	define("LANG_GALLERY_DELETE_INFORMATION", "Galeri Bilgilerini Sil");
	//Are you sure you want to delete this gallery? This will remove all gallery information, photos and relationships.
	define("LANG_GALLERY_DELETE_CONFIRM", "Bu galeriyi silmek istediğinizden emin misiniz ? Bu galerinin bütün bilgilerinin, resimlerinin ve ilişkilerinin de silinmesine yol açacaktır.");
	//Delete Gallery Image
	define("LANG_GALLERY_IMAGE_DELETE", "Galeri Resmini Sil");
	//Gallery Information
	define("LANG_GALLERY_INFORMATION", "Galeri Bilgileri");
	//Gallery Preview
	define("LANG_GALLERY_PREVIEW", "Galeri Önizlemesi");
	//Gallery Detail
	define("LANG_GALLERY_DETAIL", "Galeri Detayları");
	//Edit Gallery Information
	define("LANG_GALLERY_EDIT_INFORMATION", "Galeri Bilgilerini Düzenle");
	//Manage Images
	define("LANG_GALLERY_MANAGE_IMAGES", "Resimleri Yönet");
	//Delete Image
	define("LANG_IMAGE_DELETE", "Resmi Sil");
	//Image successfully deleted!
	define("LANG_IMAGE_SUCCESSFULLY_DELETED", "Resim başarıyla silindi!");
	//Review Detail
	define("LANG_REVIEW_DETAIL", "Yorum Detayları");
	//Review Preview
	define("LANG_REVIEW_PREVIEW", "Yorum Önizlemesi");
	//Invoice Detail
	define("LANG_INVOICE_DETAIL", "Fatura Detayları");
	//Invoice not found for this account.
	define("LANG_INVOICE_NOT_FOUND_FOR_ACCOUNT", "Bu hesapta fatura bulunmadı.");
	//Invoice Notification
	define("LANG_INVOICE_NOTIFICATION", "Fatura Bildirisi");
	//Transaction Detail
	define("LANG_TRANSACTION_DETAIL", "İşlem Detayları");
	//Transaction not found for this account.
	define("LANG_TRANSACTION_NOT_FOUND_FOR_ACCOUNT", "Bu hesapta işlem bulunmadı.");
	//Sign in with Directory Account
	define("LANG_LOGINDIRECTORYUSER", "Dizin Hesabıyla Oturum Aç");
	//Sign in with OpenID 2.0 Account
	define("LANG_LOGINOPENIDUSER", "OpenID 2.0 Hesabıyla Oturum Aç");
	//Sign in with Facebook Account
	define("LANG_LOGINFACEBOOKUSER", "Facebook Hesabıyla Oturum Aç");
	//Sign in with Google Account
	define("LANG_LOGINGOOGLEUSER", "Google Hesabıyla Oturum Aç");
	//Username already registered!
	define("LANG_USERNAME_ALREADY_REGISTERED", LANG_LABEL_USERNAME." zaten kayıtlı!");
	//This account is available.
	define("LANG_USERNAME_NOT_REGISTERED", "Bu hesap uygun.");
	//Error uploading image. Please try again.
	define("LANG_MSGERROR_ERRORUPLOADINGIMAGE", "Resim yükleme hatası. Lütfen tekrar deneyin.");
	//Image successfully uploaded
	define("LANG_IMAGE_SUCCESSFULLY_UPLOADED", "Resim başarıyla yüklendi!");
	//Image successfully updated
	define("LANG_IMAGE_SUCCESSFULLY_UPDATED", "Resim başarıyla güncellendi!");
	//Delete image
	define("LANG_DELETE_IMAGE", "Resmi Sil");
	//Are you sure you want to delete this image
	define("LANG_DELETE_IMAGE_CONFIRM", "Bu resmi silmek istediğinizden emin misiniz ?");
	//Edit Image
	define("LANG_LABEL_EDITIMAGE", "Resmi Düzenle");
	//Make main
	define("LANG_LABEL_MAKEMAIN", "Ana Resim Yap");
	//Main image
	define("LANG_LABEL_MAINIMAGE", "Ana Resim");
	//Click here to set as main image
	define("LANG_LABEL_CLICKTOSETMAINIMAGE", "Ana resim olarak ayarlamak için tıklayın");
	//Click here to set as gallery image
	define("LANG_LABEL_CLICKTOSETGALLERYIMAGE", "Galeri resmi olarak ayarlamak için tıklayın");
	//Packages
	define("LANG_PACKAGE_PLURAL", "Paketler");
	//Package
	define("LANG_PACKAGE_SING", "Paket");
	//Charging for package
	define("LANG_CHARGING_PACKAGE", "Paket ücretlendirmesi ");

	# ----------------------------------------------------------------------------------------------------
	# SOCIAL NETWORK
	# ----------------------------------------------------------------------------------------------------
	//Profile successfully updated!
	define("LANG_MSG_PROFILE_SUCCESSFULLY_UPDATED", "Profil başarıyla güncellendi!");
	//Sponsor Options
	define("LANG_MENU_MEMBER_OPTIONS", "Sponsor Ayarları");
	//My Friends
	define("LANG_LABEL_MY_FRIENDS", "Arkadaşlarım");
	//Friends to Approve
	define("LANG_LABEL_APPROVE_NEW_FRIENDS", "Onaylanacak Arkadaşlar");
	//Pending Acceptance
	define("LANG_LABEL_PENDING_ACCEPTANCE", "Onay Bekliyor");
	//Enable User Profile
	define("LANG_LABEL_ENABLE_PROFILE", "Kullanıcı Profilini Etkinleştir");
	//Meet people, make friends and customers for your business and much more!
	define("LANG_MSG_ENABLE_PROFILE", "İnsanlarla tanışın, işiniz için müşteriler bulun ve çok daha fazlası!");
	//Profile
	define("LANG_LABEL_PROFILE", "Profil");
	//Profile Options
	define("LANG_LABEL_PROFILE_OPTIONS", "Profil Ayarları");
	//Edit Profile
	define("LANG_LABEL_EDIT_PROFILE", "Profiliz Düzenle");
	//Friends
	define("LANG_LABEL_FRIENDS", "Arkadaşlar");
	//View Friends
	define("LANG_LABEL_VIEW_FRIENDS", "Arkadaşları Gör");
	//Manage Friends
	define("LANG_LABEL_MANAGE_FRIENDS", "Arkadaşları Yönet");
	//Load image from your Facebook.
	define("LANG_LABEL_IMAGE_FROM_FACEBOOK", "Facebook'tan resim yükle.");
	//Personal Infomation
	define("LANG_LABEL_PERSONAL_INFORMATION", "Kişisel Bilgiler");
	//Nickname
	define("LANG_LABEL_NICKNAME", "Rumuz");
	//Twitter Account
	define("LANG_LABEL_TWITTER_ACCOUNT", "Twitter hesabı");
	//About me
	define("LANG_LABEL_ABOUT_ME", "Hakkımda");
	//Birthdate
	define("LANG_LABEL_BIRTHDATE", "Doğum tarihi");
	//Hometown
	define("LANG_LABEL_HOMETOWN", "Memleketi");
	//Favorite Books
	define("LANG_LABEL_FAVORITEBOOKS", "Favori Kitapları");
	//Favorite Movies
	define("LANG_LABEL_FAVORITEMOVIES", "Favori Filmleri");
	//Favorite Sports
	define("LANG_LABEL_FAVORITESPORTS", "Favori Sporları");
	//Favorite Musics
	define("LANG_LABEL_FAVORITEMUSICS", "Favori Müzikleri");
	//Favorite Foods
	define("LANG_LABEL_FAVORITEFOODS", "Favori Yemekleri");
	//Settings
	define("LANG_LABEL_SETTINGS", "Ayarlar");
	//View all friends
	define("LANG_LABEL_VIEW_ALL_FRIENDS", "Tüm arkadaşları gör");
	//All Friends
	define("LANG_LABEL_ALL_FRIENDS", "Tüm Arkadaşlar");
	//Remove friend
	define("LANG_LABEL_REMOVE_FRIEND", "Arkadaşı sil");
	//Add as friend
	define("LANG_LABEL_ADD_FRIEND", "Arkadaş olarak ekle");
	//Accept
	define("LANG_LABEL_ACCEPT_FRIEND", "Kabul Et");
	//Deny
	define("LANG_LABEL_ACCEPT_DENY", "Reddet");
	//Become a Sponsor
	define("LANG_LABEL_BECOME_A_MEMBER", "Sponsor Ol");
	//Get listed and start promoting your business today, for free!
	define("LANG_MSG_BECOME_A_MEMBER", "Rehbere girip şirketinizin reklamını yapmaya başlayın!");
	//What can i do?
	define("LANG_LABEL_WHAT_CAN_I_DO", "Ne yapabilirim?");
	//Messages
	define("LANG_LABEL_MESSAGES", "Mesajlar");
	//Are you sure?
	define("LANG_MESSAGE_MSGAREYOUSURE", "Emin misiniz?");
	//The personal page with name "john-smith" will be available through the URL:
	define("LANG_MSG_FRIENDLY_URL_PROFILE_TIP", "\"john-smith\" ismiyle olan kişisel sayfa bu URL üzerinden mevcut olacaktır:");
	//Your URL:
	define("LANG_LABEL_YOUR_URL", "Sizin URL sayfanız:");
	//Your URL contains invalid chars.
	define("LANG_MSG_FRIENDLY_URL_INVALID_CHARS", "URL geçersiz karakterler içeriyor.");
	//URL already in use, please choose another URL.
	define("LANG_MSG_PAGE_URL_IN_USE", "URL zaten kullanılmakta, lütfen başka bir URL seçin.");
	//You have no friends.
	define("LANG_MSG_YOU_HAVE_NO_FRIENDS", "Hiç arkadaşınız yok.");
	//Friend successfully removed.
	define("LANG_MSG_FRIEND_SUCCESSREMOVED", "Arkadaş başarıyla silindi.");
	//Friend successfully approved.
	define("LANG_MSG_FRIEND_SUCCESSAPPROVED", "Arkadaş başarıyla onaylandı.");
	//Friend successfully rejected.
	define("LANG_MSG_FRIEND_SUCCESSREJECTED", "Arkadaş başarıyla reddedildi.");
	//Friend requirement successfully canceled.
	define("LANG_MSG_FRIEND_REQUIRE_SUCCESSCANCELED", "Arkadaş gereksinimi başarıyla iptal edildi.");
	//View all
	define("LANG_LABEL_VIEW_ALL", "Hepsini gör");
	//View all
	define("LANG_LABEL_VIEW_ALL2", "Hepsini gör");
	//No Friends
	define("LANG_MSG_NO_FRIENDS", "Hiç Arkadaşınız Yok");
	//No Items
	define("LANG_MSG_NO_ITEMS", "Hiç Kayıt Yok");
	//Share
	define("LANG_LABEL_SHARE", "Paylaş");
	//Share All
	define("LANG_LABEL_SHARE_ALL", "Hepsini Paylaş");
	//Comments
	define("LANG_LABEL_COMMENTS", "Yorumlar");
	//My Profile
	define("LANG_LABEL_MYPROFILE", "Profilim");
	//User profile successfully enabled!
	define("LANG_MSG_PROFILE_ENABLED", "Kullanıcı profili başarıyla etkinleştirildi!");
	//Display my contact information publicly
	define("LANG_LABEL_PUBLISH_MY_CONTACT", "İletişim bilgilerimi herkese görüntüle");
	//Create my Personal Page
	define("LANG_LABEL_CREATE_PERSONAL_PAGE", "Kişisel Sayfamı Yarat");
	//Public Profile
	define("LANG_LABEL_PERSONAL_PAGE", "Genel Profil");
	//Article Reviews
	define("LANG_LABEL_ARTICLE_REVIEW", "Makale Yorumları");
	//Listing Reviews
	define("LANG_LABEL_LISTING_REVIEW", "Liste Yorumları");
	//Reviews Successfully Deleted.
	define("LANG_MSG_REVIEW_SUCCESS_DELETED", "Yorumlar Başarıyla Silndi.");
	//No reviews found!
	define("LANG_LABEL_NOREVIEWS", "Yorum bulunmadı!");
	//Edit my Profile
	define("LANG_LABEL_EDITPROFILE", "Profilimi düzenle");
	//Back to my Profile
	define("LANG_LABEL_BACKTOPROFILE", "Profilime dön");
	//Member Since
	define("LANG_LABEL_MEMBER_SINCE", "den beri üye");
	//Account Settings
	define("LANG_LABEL_ACCOUNT_SETTINGS", "Hesap Ayarları");
    //Deals Redeemed
	define("LANG_LABEL_ACCOUNT_DEALS", "Alınan Teklifler");
	//Favorites
	define("LANG_LABEL_FAVORITES", "Favoriler");
	//You have no permission to access this area.
	define("LANG_MSG_NO_PERMISSION", "Bu alana giriş izniniz yok.");
	//Go to your Profile
	define("LANG_MSG_GO_PROFILE", "Profile git.");
	//My Personal Page
	define("LANG_MSG_MY_PERSONAL_PAGE", "Kişisel Sayfam");
	//Use this Account
	define("LANG_MSG_USE_LOGGED_ACCOUNT", "Bu Hesabı kullan");
	//Profile Page
	define("LANG_LABEL_PROFILE_PAGE", "Profil Sayfası");
	//Create your Profile
	define("LANG_CREATE_MEMBER_PROFILE", "Profilinizi oluşturun");
	//Nickname is required.
	define("LANG_MSG_NICKANAME_REQUIRED", "Rumuz gerekli.");
	//Be sure that the twitter account you are adding is not protected. If the twitter account is protected the latest tweets on this account will not be shown.
	define("LANG_PROFILE_TWITTER_TIP1", "Eklediginiz Twitter hesabının korunmalı olmadığından emin olun. Eğer Twitter hesabi korunmalıysa bu hesaptaki son tweetler gösterilmeyecektir.");
	//Your item has been paid, so you can add a maximum of 3 categories free.
	define("LANG_ITEM_ALREADY_HAS_PAID", "Kaydınızın ödemesi yapıldı, böylece en fazla [max] kategoriyi bedava ekleyebilirsiniz.");
	//Your item has been paid, so you can add a maximum of 1 category free.
	define("LANG_ITEM_ALREADY_HAS_PAID2", "Kaydınızın ödemesi yapıldı, böylece en fazla [max] kategoriyi bedava ekleyebilirsiniz.");

	# ----------------------------------------------------------------------------------------------------
	# GALLERY
	# ----------------------------------------------------------------------------------------------------
	//Only
	define("LANG_ONLY", "Sadece ");
	//images accepted for upload!
	define("LANG_IMAGES_ACCEPETED", "resimler yükleme için kabul edilir!");
	//Images must be under
	define("LANG_IMAGE_MUST_BE", "Resimler altında olmalıdır");
	//Select an image for upload!
	define("LANG_SELECT_IMAGE", "Yükleme için bir resim seçin!");
	//Original image
	define("LANG_ORIGINAL", "Orijinal resim");
	//Thumbnail preview
	define("LANG_THUMB_PREVIEW", "Küçük resim önizlemesi");
	//Edit captions
	define("LANG_LABEL_EDIT_CAPTIONS", "Altbaşlıklar");
	//You can add the maximum of
	define("LANG_YOU_CAN_ADD_MAXOF", "Galerinize en fazla");
	//photos to your gallery
	define("LANG_TO_YOUR_GALLERY", " resim ekleyebilirsiniz!");
	//Create Thumbnail
	define("LANG_CREATE_THUMB", "Küçük Resim Yarat");
	//Thumbnail Preview
	define("LANG_THUMB_PREVIEW", "Küçük Resim Önizlemesi");
	//Your item already has the maximum number of images in the gallery. Delete an existing image to save this one.
	define("LANG_ITEM_ALREADY_HAD_MAX_IMAGE", "Kaydınız en fazla resim sayısına ulaşmış. Bu resmi yüklemek için mevcut resimlerden birini silin.");
	
	# ----------------------------------------------------------------------------------------------------
	# RECURRING EVENTS
	# ----------------------------------------------------------------------------------------------------
	//Recurring Event
	define("LANG_EVENT_RECURRING", "Tekrarlayan Aktiviteler");
	//Repeat
	define("LANG_PERIOD", "Tekrar");
	//Choose an option
	define("LANG_CHOOSE_PERIOD", "Bir seçenek seçin");
	//Daily
	define("LANG_DAILY", "Günlük");
	//Weekly
	define("LANG_WEEKLY", "Haftalık");
	//Monthly
	define("LANG_MONTHLY", "Aylık");
	//Yearly
	define("LANG_YEARLY", "Yıllık");
	//Daily
	define("LANG_DAILY2", "Günlük");
	//Weekly
	define("LANG_WEEKLY2", "Haftalık");
	//Monthly
	define("LANG_MONTHLY2", "Aylık");
	//Yearly
	define("LANG_YEARLY2", "Yıllık");
	//every
	define("LANG_EVERY", "Her");
	//every
	define("LANG_EVERY2", "Her");
	//of
	define("LANG_OF", "ün");
	//of
	define("LANG_OF2", "nın");
	//of
	define("LANG_OF3", "ın");
	//of
	define("LANG_OF4", "ın");
	//Week
	define("LANG_WEEK", "Hafta");
	//Choose Month
	define("LANG_CHOOSE_MONTH", "Ay Seçin");
	//Choose Day
	define("LANG_CHOOSE_DAY", "Gün Seçin");
	//Choose Week
	define("LANG_CHOOSE_WEEK", "Hafta Seçin");
	//First
	define("LANG_FIRST", "İlk");
	//Second
	define("LANG_SECOND", "İkinci");
	//Third
	define("LANG_THIRD", "Üçüncü");
	//Fourth
	define("LANG_FOURTH", "Dördüncü");
	//Last
	define("LANG_LAST", "Son");
	//1st
	define("LANG_FIRST_2", "1.");
	//2nd
	define("LANG_SECOND_2", "2.");
	//3rd
	define("LANG_THIRD_2", "3.");
	//4th
	define("LANG_FOURTH_2", "4.");
	//Recurring
	define("LANG_RECURRING", "Tekrarlayan");
	//Please select a day of week
	define("LANG_EVENT_SELECT_DAYOFWEEK", "Lürfen haftanın bir gününü seçin.");
	//Please type a day
	define("LANG_EVENT_TYPE_DAY", "Lütfen bir gün seçin.");
	//Please select a month
	define("LANG_EVENT_SELECT_MONTH", "Lütfen bir ay seçin.");
	//Please select a week
	define("LANG_EVENT_SELECT_WEEK", "Lütfen bir gün seçin.");
	//Please select a Repeat option
	define("LANG_EVENT_SELECT_PERIOD", "Lütfen bir Tekrarlama seçeneği seçin.");
	//When
	define("LANG_EVENT_WHEN", "Ne zaman");
	//Day must be numeric
	define("LANG_EVENT_TYPE_DAY_NUMERIC", "Günler rakam olmaıdır.");
	//Day must be between 1 and 31
	define("LANG_EVENT_TYPE_DAY_BETWEEN", "Günler 1 ve 31 arasında olmalıdır.");
	//Day doesn't match with the choosen period
	define("LANG_EVENT_CHECK_DAY", "Gün seçilen zaman aralığıyla eşleşmiyor.");
	//Month doesn't match with the choosen period
	define("LANG_EVENT_CHECK_MONTH", "Ay seçilen zaman aralığıyla eşleşmiyor.");
	//Days don't match with the choosen period
	define("LANG_EVENT_CHECK_DAYOFWEEK", "Günler seçilen zaman aralığıyla eşleşmiyor.");
	//Week doesn't match with the choosen period
	define("LANG_EVENT_CHECK_WEEK", "Hafta seçilen zaman aralığıyla eşleşmiyor.");
	//No info
	define("LANG_EVENT_NO_INFO", "Bilgi yok");
	//Ends on
	define("LANG_ENDS_IN", "Bitiyor");
	//Never
	define("LANG_NEVER", "Asla");
	//Until
	define("LANG_UNTIL", "Kadar");
	//Until Date
	define("LANG_LABEL_UNTIL_DATE", "Tarihine Kadar");
	//The "Until Date" must be greater than or equal to the "Start Date".
	define("LANG_MSG_UNTIL_DATE_GREATER_THAN_START_DATE", "\"Tarihine Kadar\", \"Başlangıç Tarihi\"yle eşit ya da ondan daha büyük olmalı .");
	//The "Until Date" cannot be in past.
	define("LANG_MSG_UNTIL_DATE_CANNOT_IN_PAST", "\"Tarihine Kadar\" geçmişte olamaz.");
	//Starts on
	define("LANG_EVENT_STARTS_ON", "Tarihinde Başlıyor");
	//Repeats
	define("LANG_EVENT_REPEATS", "Tekrar Ediyor");
	//Ends on
	define("LANG_EVENT_ENDS", "Bitiyor");
	//weekend
	define("LANG_EVENT_WEEKEND", "haftasonu");
	//business day
	define("LANG_EVENT_BUSINESSDAY", "haftaiçi");
	//the month
	define("LANG_THE_MONTH", "ay");
	
	# ----------------------------------------------------------------------------------------------------
	# SITES
	# ----------------------------------------------------------------------------------------------------
    //Site
    define("LANG_DOMAIN", "Site");
	//Site name
	define("LANG_DOMAIN_NAME", "Site adı");
	//Click here to view this site
	define("LANG_MSG_CLICK_TO_VIEW_THIS_DOMAIN", "Bu siteyi görmek için tıklayın");
	//Click here to delete this site
	define("LANG_MSG_CLICK_TO_DELETE_THIS_DOMAIN", "Bu siteyi silmek için tıklayın");
	//Site successfully deleted!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_DELETE", "Site başarıyla silindi!");
	//Site successfully added!
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2", "Site başarıyla eklendi!");
	//An email notification will be sent to the eDirectory support team, please wait our contact.
	define("LANG_MSG_DOMAIN_SUCCESSFULLY_ADD", LANG_MSG_DOMAIN_SUCCESSFULLY_ADD2."<br />Bir e-posta bildirimi eDirectory destek ekibi gönderilecektir, lütfen iletişim bekleyin.");
    //Site name is required
	define("LANG_MSG_DOMAINNAME_IS_REQUIRED", "Site adı gerekli");
    //Site URL is required
	define("LANG_MSG_DOMAINURL_IS_REQUIRED", "Site URLsi gerekli");
	//Site name already exists
	define("LANG_MSG_DOMAINNAME_ALREADY_EXISTS", "Site adı zaten var");
	//Site URL already exists
	define("LANG_MSG_DOMAINURL_ALREADY_EXISTS", "Site URLsi zaten var");
	//Site URL not valid
	define("LANG_MSG_DOMAINURL_INVALID_CHARS", "Site URLsi geçersiz");
	//Site Items
	define("LANG_SITE_ITEMS", "Site Kayıtları");
	
	# ----------------------------------------------------------------------------------------------------
	# PROFILE
	# ----------------------------------------------------------------------------------------------------
	//Profile Information
	define("LANG_LABEL_PROFILE_INFORMATION", "Profil Bilgileri");
	//Social Networking
	define("LANG_LABEL_FOREIGN_ACCOUNTS", "Sosyal Ağ");
	//Link and import informations
	define("LANG_LABEL_CONNECT_WITH_FB_AND_IMPORT", "Link ve dosya alım bilgileri");
	//Just link
	define("LANG_LABEL_CONNECT_WITH_FB", "Sadece link");
	//Link my Facebook account
	define("LANG_LABEL_LINK_FACEBOOK", "Facebook hesabıma bağlantı ekle");
	//Unlink my Facebook account
	define("LANG_LABEL_UNLINK_FB", "Facebook hesabımdan bağlantıyı kaldır");
	//Your account was unlinked from Facebook
	define("LANG_LABEL_FB_ACT_DISC", "Hesabınızın Facebook bağlantısı kaldırıldı");
	//Your Facebook account is already linked with other account in the system.
	define("LANG_FB_ALREADY_LINKED", "Facebook hesabınız sistemdeki başka bir hesapla bağlantılı bile.");
	//Your Twitter account is already linked with other account in the system.
	define("LANG_TW_ALREADY_LINKED", "Twitter hesabınız sistemdeki başka bir hesapla bağlantılı bile.");
	//Linked to twitter as
	define("LANG_MSG_LINKED_TW_AS", "Twitter'a olarak bağlantılı");
	//Connected as
	define("LANG_LABEL_CONECTED_AS", "olarak bağlı");
	//Location options
	define("LANG_LABEL_LOCATIONPREF", "Yer Seçenekleri");
	//Choose you location preference
	define("LANG_LABEL_CHOOSELOCATIONPREF", "Yer seçeneğinizi seçin");
	//Use your current location
	define("LANG_LABEL_USECURRENTLOCATION", "Mevcut yer adınızı kullanın");
	//Use Facebook Location
	define("LANG_LABEL_USEFACEBOOKLOCATION", "Facebook Yer Adınızı kullanın");
	//Connect to Facebook
	define("LANG_LABEL_CONECTED_TO_FB", "Facebook'a bağlan");
	//Facebook account
	define("LANG_LABEL_FACEBOOK_ACCT", "Facebook hesabı");
	//Google account
	define("LANG_LABEL_GOOGLE_ACCT", "Google hesabı");
	//Change account
	define("LANG_LABEL_CHANGE_ACCT", "Hesap değiştir");
	//Twitter account
	define("LANG_LABEL_FB_ACCT", "Twitter hesabı");
	//Twitter connection
	define("LANG_LABEL_TW_CONN", "Twitter bağlantısı");
	//Link my Twitter account
	define("LANG_LABEL_TW_LINK", "Twitter hesabıma bağlantı ekle");
	//Unlink my twitter account
	define("LANG_LABEL_UNLINK_TW", "Twitter hesabımdan bağlantıyı kaldır");
	//Post redeems on my twitter account automatically
	define("LANG_LABEL_POSTRED", "Promosyon alımlarını otomatik olarak Twitter hesabıma gönder");
	//Your account was disconnected from twitter
	define("LANG_LABEL_TW_ACT_DISC", "Hesabınızın Twitter bağlantısı koptu");
	//You must sign in through twitter first
	define("LANG_LABEL_TW_SIGNTW", "Önce Twitter'dan oturum açmalısınız");
	//Your twitter account was successfully connected
	define("LANG_LABEL_TW_SIGNTW_CONN", "Twitter hesabınız başarıyla bağlandı");
	//Your Facebook account was successfully connected
	define("LANG_LABEL_FB_SIGNFB_CONN", "Facebook hesabınız başarıyla bağlandı");
	//Your are already logged Facebook account as
	define("LANG_LABEL_FB_ALREADYLOGGED", "Facebook'a zaten olarak bağlısınız");
	//This user is already attached to another directory account.
	define("LANG_LABEL_FB_ALREADYATTACHED", "Bu kullanıcı zaten başka bir dizine hesabına bağlı.");
	//Click here to switch to this account
	define("LANG_LABEL_FB_CLICKHERETOSWITCH", "Bu hesaba geçmek için tıklayın");
	//Connect to Facebook
	define("LANG_LABEL_CONN_FB", "Facebook'a bağlan");
	//Use this language upon each sign in to my account
	define("LANG_LABEL_USE_SELECTEDLANGUAGE", "Hesabıma her oturum halinde bu dil kullanın");

	# ----------------------------------------------------------------------------------------------------
	# DEALS
	# ----------------------------------------------------------------------------------------------------
	//Link to a listing
	define("DEAL_LINK2LISTING", "Bir listeye bağla");
	//I just got a great deal
	define("DEAL_LIKEDTHIS", "Harika bir teklif aldım");
	//Redeem
	define("DEAL_REDEEM", "Al");
	//Redeem this deal
	define("DEAL_REDEEMTHIS", "Bu teklif al");
	//To redeem you need to post this deal information on your Facebook or Twitter.
	define("DEAL_REDEEMINFO1", "Bu teklif almak için promosyonun bilgilerini Facebook veya Twitter'a göndermeniz lazım");
	//You can set this button to automatic post on your Profile.
	define("DEAL_REDEEMINFO2", "Bu düğmeyi Profilinize otomatik gönder olarak ayarlayabilirsiniz");
	//Click here to configure it
	define("DEAL_CLICKHERETO", "Ayarlamak için tıklayın");
	//Please wait, posting on Facebook and Twitter (if available)
	define("DEAL_PLEASEWAIT_POSTING", "Lütfen bekleyin, Facebook ve Twitter'a gönderiliyor (eğer mevcutsa)");
	//You already redeemed this deal! Your code is
	define("DEAL_YOUALREADY", "Bu teklif aldınız bile! Kodunuz");
	//Deal done! This is your redeem code
	define("DEAL_DEALDONE", "Teklif alındı! Kodunuz bu");
	//No one has redeemed this deal  on Facebook yet
	define("DEAL_REDEEM_NONE_FB", "Bu teklif henüz hiç kimse Facebook ile almadı");
	//No one has redeemed this deal  on Twitter yet
	define("DEAL_REDEEM_NONE_TW", "Bu teklif henüz hiç kimse Twitter ile almadı");
	//Recent done deals
	define("DEAL_RECENTDEALS", "En son alınmış Teklifler");
	//No deals found!
	define("DEAL_DIDNTNOTFINISHED", "Hayır fırsatlar bulunamadı!");
	//This deal is not available anymore
	define("DEAL_NA", "Bu teklif artık mevct değil");
	//To redeem this deal you need to post to your Facebook wall. First, sign using the Facebook login button and you will need to approve this Application to do it
	define("DEAL_REDEEMINFO_1", "Bu teklif almak için Facebook duvarınıza göndermeniz lazım. Önce Facebook oturumu aç düğmesiyle oturum açın. Bunun için Uygulamayı onaylamanız lazım");
	//You already did this deal!
	define("DEAL_REDEEM_DONEALREADY", "Bu teklif aldınız bile");
	//Sorry, there was an error trying to post on your Facebook wall. Please try again.
	define("DEAL_REDEEMINFO_2", "Maalesef Facebook hesabınıza gönderirken bir hata oluştu. Lütfen tekrar deneyin.");
	//Value
	define("DEAL_VALUE", "Değer");
	//With this coupon
	define("DEAL_WITHTHISCOUPON", "Bu kupon ile");
	//Thank you
	define("DEAL_THANKYOU", "Teşekkürler");
	//Original value
	define("DEAL_ORIGINALVALUE", "Orijinal değer");
	//Amount paid
	define("DEAL_AMOUNTPAID", "Bu promosyon değeri");
	//Valid until
	define("DEAL_VALIDUNTIL", "arasında geçerlidir");
	//Coupon must be presented to receive discount
	define("DEAL_INFODETAILS1", "İndirimi almak için kupon  gösterilmelidir");
	//Limit of 1 coupon per purchase
	define("DEAL_INFODETAILS2", "Satış başına 1 kuponla sınırlı");
	//Not valid with other coupons, offers or discounts of any kind
	define("DEAL_INFODETAILS3", "Diğer kuponlarla veya herhangi bir indirim teklifi türüyle birlikte geçerli değildir.");
	//Valid only for Listing Name - Address
	define("DEAL_INFODETAILS4", "Sadece Liste Adı ve Adresi için geçerlidir");
	//Print deal
	define("DEAL_PRINTDEAL", "Teklif Yazdır");
	//deal done
	define("DEAL_DEALSDONE", "Teklif Yapıldı");
	//deals done
	define("DEAL_DEALSDONE_PLURAL", "Teklifler Yapıldı");
	//Left
	define("DEAL_LEFTAMOUNT", "Kaldı");
	//SOLD OUT
	define("DEAL_SOLDOUT", "SATILDI");
	//Sorry, this deal doesn't exist or it was removed by owner
	define("DEAL_DOESNTEXIST", "Maalesef bu teklif artık mevcut değil veya sahibi tarafından kaldırılmış.");
	//at
	define("DEAL_AT", "/");
	//Friendly URL
	define("DEAL_FRIENDLYURL", "Friendly URL");
	//Select a listing
	define("DEAL_SELECTLISTING", "Bir liste seç");
	//Tagline for Deals
	define("DEAL_TAG", "Teklifler için Etiket");
	//Visibility
	define("LANG_SITEMGR_VISIBILITY", "Görünürlük");
	//This deal will show up on
	define("LANG_SITEMGR_DEALSHOWUP", "Bu teklif");
	//searches and nearby feature
	define("LANG_SITEMGR_DEALSEARCHES_NEARBY", "aramalarda ve yakın özelliklerde gözükecek");
	//24 hours / day
	define("LANG_SITEMGR_TWFOURHOURSDAY", "Günde 24 saat");
	//Custom range
	define("LANG_SITEMGR_CUSTOMRANGE", "Özel aralık");
	//Discount information
	define("LANG_SITEMGR_DISCINFO", "İndirim bilgileri");
	//Deal value
	define("LANG_SITEMGR_ITEMVALUE", "Teklif değeri");
	//Discount
	define("LANG_SITEMGR_DISCOUNT", "İndirim");
	//Value with discount
	define("LANG_DEAL_WITH_DISCOUNT", "İndirimden sonraki değer");
	//Amount of deals
	define("LANG_SITEMGR_AMOUNTOFDEALS", "Teklifler tutarları");
	//deals done until now
	define("LANG_SITEMGR_DONEUNTIL_SINGULAR", "bu zamana kadar yapılan teklifler");
    //deals done until now
	define("LANG_SITEMGR_DONEUNTIL_PLURAL", "bu zamana kadar yapılan teklifler");
	//left
	define("LANG_SITEMGR_LEFT", "kaldı");
    //OFF
    define("LANG_DEAL_OFF", "KAPALI");
    //Please wait, loading...
    define("LANG_DEAL_PLEASEWAITLOADING", "Lütfen bekleyin, yüklüyor...");
    //Please wait. We are redirecting your login to complete this step...
    define("LANG_DEAL_PLEASEWAITLOADING2", "Lütfen bekleyin. Bu adımı tamamlamak için oturumunuzu tekrar yönlendiriyoruz...");
    //Item Value is required.
    define("LANG_MSG_VALIDDEAL_REALVALUE", "Kayıt Değeri gerekli.");
    //Value with Discount is required.
    define("LANG_MSG_VALIDDEAL_DEALVALUE", LANG_LABEL_DISC_AMOUNT." gerekli.");
	//Value with Discount can not be higher than 99.
	define("LANG_MSG_VALIDDEAL_DEALVALUE2", LANG_LABEL_DISC_AMOUNT." 99'dan daha büyük olamaz.");
    //Deals to offer is required.
    define("LANG_MSG_VALIDDEAL_AMOUNT", "Sunmak için fırsatlar gereklidir.");
    //Please enter a minor value on Value with Discount field.
    define("LANG_MSG_VALID_MINOR", LANG_LABEL_DISC_AMOUNT." alanına daha küçük bir değer girin.");
    //Redemeed at
    define("LANG_DEAL_REMEEDED_AT", "Promosyon alındı");
    //You can only directly link this deal to a listing if you select one account first
    define("DEAL_LINK2LISTING_ACCTINFO", "Bu teklif doğrudan bağlanmak için önce bir hesap seçin");
    //Value
    define("DEAL_VALUE", "Değer");
    //With discount
    define("DEAL_WITHCOUPON", "İndirimli");
    //Redeem by e-mail
    define("DEAL_REDEEMBYEMAIL", "E-posta ile promosyon al");
    //Sign In and Redeem
    define("DEAL_CONNECT_REDEEM", "Oturum aç Promosyon Al");
	//Redeem and Print
	define("LANG_LABEL_REDEEM_PRINT", "Kurtarmak ve Yazdırın.");
    //Redeem and Share
    define("DEAL_REDEEMSHARE", "Promosyon Al ve Paylaş");
    //Featured Deals
    define("DEAL_FEATURED_DEALS", "Vitrindeki Teklifler");
    //Sign in using your Facebook session
    define("LOGIN_FB_CURRENT_SESSION", "Facebook kullanarak oturum açın");
    //To Redeem using Facebook you need to connect using your Facebook account
    define("LANG_DEAL_DISCONNECTED_NOFB", "Facebook kullanarak teklif almak için önce Facebook hesabınızı kullanarak baglanmanız lazım.");
	//Redeem Statistics
    define("LANG_LABEL_REDEEM_STATISTICS", "Promosyon Alım İstatistikleri");
    //Redeem code
    define("DEAL_SITEMGR_REDEEMCODE", "Promosyon alış kodu");
    //Available
    define("DEAL_SITEMGR_AVAILABLE", "Mevcut");
    //Used
    define("DEAL_SITEMGR_USED", "Kullanılmış ");
    //Redeem using your current Facebook session.
    define("DEAL_REDEEMINFO_3", "Mevcut Facebook oturumunuzu kullanarak alın");
    //Navbar configuration saved
    define("NAVBAR_SAVED_MESSAGE1", "Gezinti çubuğu ayarları kaydedildi");
    //There was a problem saving, try again please
    define("NAVBAR_SAVED_MESSAGE2", "Kaydederken bir sorun çıktı, lütfen tekrar deneyin");
    //At least one item is required
    define("NAVBAR_SAVED_MESSAGE3", "En azından bir kayıt gerekli");
	//You can not save repeated URLs
    define("NAVBAR_SAVED_MESSAGE4", "Tekrar eden URLleri kaydedemezsiniz");
	//You can not save empty items
    define("NAVBAR_SAVED_MESSAGE5", "Boş kayıtları kaydedemezsiniz.");
	//You can not save empty header or footer.
    define("NAVBAR_SAVED_MESSAGE6", "Boş üst bilgi veya alt bilgileri kaydedemezsiniz..");
    //Use
    define("DEAL_SITEMGR_USE", "Kullan");
	//Saving...
	define("LANG_DEAL_SAVING", "Kaydediyor...");
	//No redeem found
	define("LANG_DEAL_NO_RECORD", "Alış bulunamadı");
	//percentage
	define("LANG_LABEL_PERCENTAGE", "yüzde");
	//fixed value
	define("LANG_LABEL_FIXEDVALUE", "sabit değer");
	
	# ----------------------------------------------------------------------------------------------------
	# MENU CONFIGURATION
	# ----------------------------------------------------------------------------------------------------
	//Please enter a label
	define("LANG_SITEMGR_MENUCONFIG_ENTERLABEL", "Lütfen bir etiket girin.");
	//Please enter an URL
	define("LANG_SITEMGR_MENUCONFIG_ENTERURL", "Lütfen bir URL girin.");
	//Add item
	define("LANG_SITEMGR_MENUCONFIG_ADDNEW", "Kayıt ekle");
	//New Item
	define("LANG_SITEMGR_MENUCONFIG_NEWITEM", "Yeni Kayıt");
	//Module
	define("LANG_SITEMGR_MENUCONFIG_MC_MODULE", "Modül");
	//Site content
	define("LANG_SITEMGR_MENUCONFIG_MC_SITECONTENT", "Site içeriği");
	//Custom
	define("LANG_SITEMGR_MENUCONFIG_MC_CUSTOM", "Özel");
	//Save
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSE", "Kaydet");
	//Save Item
	define("LANG_SITEMGR_MENUCONFIG_MC_SAVECLOSEITEM", "Kaydı Gir");
	//Label
	define("LANG_SITEMGR_MENUCONFIG_MC_LABEL", "Etiket");
	//Use
	define("LANG_SITEMGR_MENUCONFIG_MC_USE", "Kullan");
	//Please select one module or hit close to cancel
	define("LANG_SITEMGR_MENUCONFIG_MC_SELECTORHIT", "Lütfen bir modül seçin ya da iptal etmek için kapata tıklayın");
	//Sorry, there is no custom site content created yet.
	define("LANG_SITEMGR_MENUCONFIG_MC_SORRYNOCUSTOM", "Maalesef henüz özel bir içerik yaratılmamış.");
	//Create a new custom content
	define("LANG_SITEMGR_MENUCONFIG_MC_CREATENEWCC", "Yeni bir özel içerik yarat");
	//Create custom pages in the site content section
	define("LANG_SITEMGR_MENUCONFIG_MC_CLICKINGH", "Site içerigi bölümünden özel sayfalar yaratın");
	//Use module URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USEMODULEURL", "Modül URLsi kullan");
	//Use custom page URL
	define("LANG_SITEMGR_MENUCONFIG_MC_USECUSTOMURL", "Özel sayfa URLsi kullan");
	//Edit, add, remove or change the order of items on the section below:
	define("LANG_SITEMGR_MENUCONFIG_MC_TIPS1", "Kayitların sırasını aşağıdaki bölümden düzenleyin, ekleyin, kaldırın veya değiştirin:");
	//Header Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_HEADERNAV", "Üstbilgi Gezinimi");
	//Footer Navigation
	define("LANG_SITEMGR_MENUCONFIG_MC_FOOTERNAV", "Altbilgi Gezinimi");
	//Cancel the inclusion of this item?
	define("LANG_SITEMGR_MENUCONFIG_DELETENEWITEM", "Bu kaydın eklenmesini iptal et");
	//Restore navbar
	define("LANG_SITEMGR_MENUCONFIG_RESTORENAVBAR", "Kayıtları yenile");
    //Redeem without Facebook
    define("LANG_DEAL_DONTUSEFACEBOOK", "Facebook olmadan al");
    //Don't have Facebook? Sign using your account
    define("LANG_DEAL_FACEEBOKSIGNWOUTACT", "Facebook hesabınız yok mu? Site hesabınızı kullanarak oturum açın.");
	//Select a Site
	define("LANG_SELECT_DOMAIN", "Siteyi Değiştirin");
    //Only
    define("LANG_ONLY2", "Sadece");
    //Deal
    define("LANG_PROMOTION_SINGULARWORD", "Teklif");
    //Deals
    define("LANG_PROMOTION_PLURALWORD", "Teklifler");
	//Deal Reviews
	define("LANG_LABEL_PROMOTION_REVIEW", "Teklif Yorumları");
	//posted on facebook and twitter
	define("LANG_DEAL_POSTFACEBOOK_TWITTER", "Facebook ve Twitter'a gönderildi");
	//posted on facebook
	define("LANG_DEAL_POSTFACEBOOK", "Facebook'a gönderildi");
	//posted on twitter
	define("LANG_DEAL_TWITTER", "Twitter'a gönderildi");
	//Posted on
	define("LANG_LABEL_POSTED_ON", "Gönderildi");
	//deal checked out
	define("LANG_DEAL_CHECKOUT", "teklif kapandı");
	//deal opened
	define("LANG_DEAL_OPENED", "teklif açıldı");
	//Terms and Conditions
	define("LANG_LABEL_DEAL_CONDITIONS", "Şartlar ve Koşullar");
	//maximum 1000 characters
	define("LANG_MSG_MAX_1000_CHARS", "en fazla 1000 karakter");
	//Please provide a conditions with a maximum of 1000 characters.
	define("LANG_MSG_PROVIDE_CONDITIONS_WITH_1000_CHARS", "Lütfen en fazla 1000 karakterlik bir şart metni girin");
	
	# ----------------------------------------------------------------------------------------------------
	# IMPORT
	# ----------------------------------------------------------------------------------------------------
	//line
	define("LANG_MSG_IMPORT_ERROR_LINE", "hat");
	//Error importing to temporary table.
	define("LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE", "Geçici tablo dosya alırken hata.");
	//Invalid renewal date - line
	define("LANG_MSG_IMPORT_INVALIDRENEWALDATE", "Geçersiz yenileme tarihi satırı - hat");
	//Invalid updated date - line
	define("LANG_MSG_IMPORT_INVALIDUPDATEDATE", "Geçersiz güncellenme tarihi satırı - hat");
	//CSV file imported to temporary table.
	define("LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE", "CSV dosyası geçici bir tabloya alındı.");
	//Invalid e-mail - line
	define("LANG_MSG_IMPORT_INVALIDUSERNAMELINE", "Geçersiz e-posta satırı - hat");
	//Invalid password - line
	define("LANG_MSG_IMPORT_INVALIDPASSWORDLINE", "Geçersiz şifre satırı - hat");
	//Invalid keyword (maximum 10 keywords) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS", "Geçersiz anahtar (azami ".MAX_KEYWORDS." anahtar) - hat");
	//Invalid keyword (keywords with a maximum of 50 characters each.) - line
	define("LANG_MSG_IMPORT_INVALIDKEYWORDS2", "Geçersiz anahtar (".LANG_MSG_KEYWORDS_WITH_MAXIMUM_50.") - hat");
	//Invalid title - line
	define("LANG_MSG_IMPORT_INVALIDTITLELINE", "Geçersiz başlık satırı - hat");
	//Invalid start date - line
	define("LANG_MSG_IMPORT_INVALIDSTARTDATE", "Geçersiz başlangıç tarihi - hat");
	//Invalid end date - line
	define("LANG_MSG_IMPORT_INVALIDENDDATE", "Geçersiz bitiş tarihi - hat");
	//Start date must be filled - line
	define("LANG_MSG_IMPORT_STARTDATEEMPTY", "Başlangıç tarihi dolu olmalıdır - hat");
	//End date must be filled - line
	define("LANG_MSG_IMPORT_ENDDATEEMPTY", "Bitiş tarihi dolu olmalıdır - hat");
	//The "End Date" must be greater than or equal to the "Start Date" - line
	define("LANG_MSG_IMPORT_END_DATE_GREATER_THAN_START_DATE", str_replace(".", "", LANG_MSG_END_DATE_GREATER_THAN_START_DATE)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//The "End Date" cannot be in past - line
	define("LANG_MSG_IMPORT_END_DATE_CANNOT_IN_PAST", str_replace(".", "", LANG_MSG_END_DATE_CANNOT_IN_PAST)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Invalid start time - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_NUMBER", "Geçersiz başlangıç saati - hat");
	//Invalid end time - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_NUMBER", "Geçersiz bitiş saati - hat");
	//Invalid start time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_FORMAT", "Geçersiz saat biçimi başlar. Olmalı \"xx:xx\" - hat");
	//Invalid end time format. Must be "xx:xx" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_FORMAT", "Geçersiz bitiş saati biçimi. Olmalı \"xx:xx\" - hat");
	//Invalid start time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE1", "Yanlış başlangıç zamanı modu. Olmalı \"AM\" veya \"PM\" - hat");
	//Invalid end time mode. Must be "AM" or "PM" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE1", "Geçersiz bitiş zamanı modu. Olmalı \"AM\" veya \"PM\" - hat");
	//Invalid start time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_START_TIME_MODE2", "Yanlış başlangıç​zamanı modu. Olmalı \"24\" - hat");
	//Invalid end time mode. Must be "24" - line
	define("LANG_MSG_IMPORT_WRONG_END_TIME_MODE2", "Yanlış bitiş zamanı modu. Olmalı \"24\" - hat");
	//The "End Time" must be greater than the "Start Time" - line
	define("LANG_MSG_IMPORT_END_TIME_GREATER_THAN_START_TIME", str_replace(".", "", LANG_MSG_END_TIME_GREATER_THAN_START_TIME)." - ".LANG_MSG_IMPORT_ERROR_LINE);
	//Location and system default location are differents - line
	define("LANG_MSG_IMPORT_INVALIDLOCATIONLINE", "Yer ile sistemin varsayılan yerleri arasında farklılıklar var satırı - hat");
	//Invalid latitude. Must be numeric between -90 and 90 - line
	define("LANG_MSG_IMPORT_INVALIDLATITUDELINE", "Geçersiz enlem. -90 Ile 90 arasında sayısal olmalı - hat");
	//Invalid longitude. Must be numeric between -180 and 180 - line
	define("LANG_MSG_IMPORT_INVALIDLONGITUDELINE", "Geçersiz boylam. -180 Ve 180 arasında sayısal olmalı - hat");
	//No CSV Files in Import Folder.
	define("LANG_MSG_IMPORT_NOFILES_INFTP", "Dosya Alım Klasöründe hiçbir CSV Dosyası yok.");
	//The number of columns in the following line(s) are wrong:
	define("LANG_MSG_IMPORT_NUMBEROFCOLUMNSAREWRONG", "Aşağıdaki satırlardaki sütün sayısı yanlış:");
	//Total lines read:
	define("LANG_MSG_IMPORT_TOTALLINESREADY", "Toplam satır sayısı:");
	//CSV header does not match - it has more fields that it is allowed
	define("LANG_MSG_IMPORT_WRONG_HEADER", "CSV başlık eşleşmiyor - buna izin verilirse daha fazla alan vardır");
	//CSV header does not match at field(s):
	define("LANG_MSG_IMPORT_WRONG_HEADER2", "CSV başlık alanı (ler) de uymuyor: ");
	//account rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK", "hesap geri alındı");
	//accounts rolled back
	define("LANG_MSG_IMPORT_ACCOUNT_ROLLEDBACK_PLURAL", "hesapları geri alındı");
	//item rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK", "Öğe geri alındı");
	//items rolled back
	define("LANG_MSG_IMPORT_ITEM_ROLLEDBACK_PLURAL", "Öğeleri geri alındı");	
	
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	//Find what you are Looking for...
	define("LANG_SEARCH_MESSAGE_TITLE", "Sen arıyorsun ne bul...");
	//Sometimes you may receive no results for your search because the keyword you have used is highly generic. Try to use a more specific keyword.
	define("LANG_SEARCH_MESSAGE_TEXT", "Eğer kullandığınız anahtar kelime çok genel olduğu Bazen bir arama için herhangi bir sonuç alabilirsiniz. Daha belirli bir anahtar kelime kullanmaya çalışın.");
	
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	//Find us on LinkedIn
	define("LANG_ALT_LINKEDIN", "LinkedIn'ta bizi bulun");
	//Find us on Facebook
	define("LANG_ALT_FACEBOOK", "Facebook'ta bizi bulun");
	//Links
	define("LANG_LINKS", "Linkler");
	//Contact
	define("LANG_FOOTER_CONTACT", "İletişim");
	//Twitter
	define("LANG_TWITTER", "Twitter");
	//Follow us on Twitter
	define("LANG_FOLLOW_US_TWITTER", "Twitter bizi izleyin");
	//Follow us
	define("LANG_FOLLOW_US", "Bizi izleyin");
	
	# ----------------------------------------------------------------------------------------------------
	# PAGING
	# ----------------------------------------------------------------------------------------------------
	//Results per page
	define("LANG_PAGING_RESULTS_PER_PAGE", "Sayfa başına Sonuçlar");
	//Showing results
	define("LANG_PAGING_SHOWING_RESULTS", "Sonuç gösteriliyor");
	//to
	define("LANG_PAGING_SHOWING_TO", "için");
	//of
	define("LANG_PAGING_SHOWING_OF", "ve");
	//Pages
	define("LANG_PAGING_SHOWING_PAGE", "Sayfaları");
	
	# ----------------------------------------------------------------------------------------------------
	# SUGARCRM
	# ----------------------------------------------------------------------------------------------------
	//Importing [SUGAR_ITEM_TITLE] from SugarCRM to [EDIRECTORY_TITLE]
	define("LANG_IMPORT_ITEM_FROM_SUGAR", "[SUGAR_ITEM_TITLE] SugarCRM gelen [EDIRECTORY_TITLE] İçe");
	//Use the form above to import from the SugarCRM record [SUGAR_ITEM_TITLE], after clicking import your data will be transferred to your directory installation with all relevant information passed across, just fill in the extra data, and payment data.
	define("LANG_MESSAGE_ON_FOOTER", "Şeker kayıttan almak için yukarıdaki formu kullanın [SUGAR_ITEM_TITLE], veri üzerinden iletilen tüm bilgileri ile dizini yükleme transfer edilecektir ithalat tıkladıktan sonra, sadece ek veri doldurun ve ödeme verileri.");
	//You're nearly done.
	define("LANG_YOU_NEARLY_DONE", "Neredeyse bitti.");
	//It was not possible to export. Please check your SugarCRM connection information on your directory.
	define("LANG_SUGAR_CHECKINFO", "Ihraç etmek de mümkün değildi. Dizin SugarCRM bağlantı bilgilerini kontrol edin.");
	//Wrong eDirectory Key.
	define("LANG_SUGAR_WRONG_KEY", "Yanlış eDirectory Anahtar.");
	
	# ----------------------------------------------------------------------------------------------------
	# ADVERTISE
	# ----------------------------------------------------------------------------------------------------
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_TITLE", LANG_LISTING_TITLE);	
	//Listing Title
	define("LANG_LABEL_ADVERTISE_LISTING_OWNER", "listele Sahibi");
	//10% Off - Deal Title
	define("LANG_LABEL_ADVERTISE_DEAL_TITLE", "10% Off - ".LANG_PROMOTION_TITLE);
	//Review Title
	define("LANG_LABEL_ADVERTISE_REVIEW_TITLE", "Yorum Başlığı");
	//Event Title
	define("LANG_LABEL_ADVERTISE_EVENT_TITLE", LANG_EVENT_TITLE);	
	//Event Owner
	define("LANG_LABEL_ADVERTISE_EVENT_OWNER", "Aktivitenin Sahibi");
	//Classified Title
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_TITLE", LANG_CLASSIFIED_TITLE);	
	//Classified Owner
	define("LANG_LABEL_ADVERTISE_CLASSIFIED_OWNER", "İlanın Sahibi");
	//Article Title
	define("LANG_LABEL_ADVERTISE_ARTICLE_TITLE", LANG_ARTICLE_TITLE);	
	//Article Author
	define("LANG_LABEL_ADVERTISE_ARTICLE_AUTHOR", "Makale Yazarının");
	//Contact Name
	define("LANG_LABEL_ADVERTISE_ITEM_CONTACT", LANG_LABEL_CONTACTNAME);
	//Zipcode
	define("LANG_LABEL_ADVERTISE_ITEM_ZIPCODE", ZIPCODE_LABEL);
	//www.yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_SITE", "www.sitenizin.com");
	//youremail@yoursite.com
	define("LANG_LABEL_ADVERTISE_ITEM_EMAIL", "adınızı@sitenizin.com");
	//Address
	define("LANG_LABEL_ADVERTISE_ITEM_ADDRESS", LANG_LABEL_ADDRESS);
	//Visitor
	define("LANG_LABEL_ADVERTISE_VISITOR", "Ziyaretçi");
	//Category
	define("LANG_LABEL_ADVERTISE_CATEGORY", "Kategori");
	//Category 1
	define("LANG_LABEL_ADVERTISE_CATEGORY1", "Kategori 1");
	//Category 1.1
	define("LANG_LABEL_ADVERTISE_CATEGORY1_2", "Kategori 1.1");
	//Category 2
	define("LANG_LABEL_ADVERTISE_CATEGORY2", "Kategori 2");
	//Category 2.2
	define("LANG_LABEL_ADVERTISE_CATEGORY2_2", "Kategori 2.2");
	//Summary View
	define("LANG_LABEL_ADVERTISE_SUMMARYVIEW", "Özet Görünümü");
	//Detail View
	define("LANG_LABEL_ADVERTISE_DETAILVIEW", "Detay Görünümü");
	//This content is illustrative
	define("LANG_LABEL_ADVERTISE_CONTENTILLUSTRATIVE", "Örnek içeri");
	
	# ----------------------------------------------------------------------------------------------------
	# TWILIO
	# ----------------------------------------------------------------------------------------------------
	//Send to Phone
	define("LANG_LABEL_SENDPHONE", "Telefona gönder");
	//Click to Call
	define("LANG_LABEL_CLICKTOCALL", "Aramak için tıklayın");
	//Message successfully sent!
	define("LANG_LABEL_SMS_SENT", "Mesaj başarıyla gönderildi!");
	//Send info about this listing to a phone.
	define("LANG_LISTING_TOPHONE_SAUDATION", "Bir telefon için bu liste hakkında bilgi gönder.");
	//Enter your phone to call the listing owner with no costs.
	define("LANG_LISTING_CLICKTOCALL_SAUDATION", "Hiçbir masraf listesi sahibini aramak için telefonunuzu girin.");
	//Phone is required.
	define("LANG_PHONE_REQUIRED", "Telefon gereklidir.");
	//Please, type a valid phone number.
	define("LANG_PHONE_INVALID", "Lütfen geçerli bir telefon numarasını yazın.");
	//Call
	define("LANG_TWILIO_CALL", "Aramak");
	//Calling
	define("LANG_TWILIO_CALLING", "Arayan");
	//Phone
	define("LANG_CLICKTOCALL_PHONE", "Telefon");
	//Extension
	define("LANG_CLICKTOCALL_EXTENSION", "Uzatma");
	//Activate
	define("LANG_CLICKTOCALL_ACTIVATE", "Kurmak");
	//Your validation code is:
	define("LANG_CLICKTOCALL_YOUR_VALIDATION_CODE", "Doğrulama kodu:");
	//Your phone number was activated!
	define("LANG_CLICKTOCALL_STATUS_ACTIVATED", "Telefon numaranız aktif oldu!");
	//Phone number successfully deleted!
	define("LANG_CLICKTOCALL_PHONE_DELETED", "Telefon numarası başarıyla silindi!");
	//Click to Call not available for this listing
	define("LANG_MSG_CLICKTOCALL_NOT_AVAILABLE", "Bu liste için kullanılabilir Aramak için Tıklayın");
	//Tips for the Item Click to Call
	define("LANG_CLICKTOCALL_TIPTITLE", "Öğe için ipuçları Aramak için Tıklayın");
	//You need to activate the phone number below in order to allow the users to contact you directly through the directory.
	define("LANG_CLICKTOCALL_TIP1", "Kullanıcılar dizine aracılığıyla doğrudan sizinle iletişim kurmak için izin vermek için aşağıdaki telefon numarasını aktive etmek gerekiyor.");
	//Enter your phone number and click in Activate.
	define("LANG_CLICKTOCALL_TIP2", "Telefon numaranızı girin ve Kurmak tıklatın.");
	//A message with your activation code will be shown. Take note of this code and wait for the activation phone call.
	define("LANG_CLICKTOCALL_TIP3", "Aktivasyon kodu içeren bir mesaj gösterilecektir. Bu kodu not alın ve aktivasyon telefon görüşmesi için bekleyin.");
	//You will be ask to enter the six digits activation code. Enter the code and wait for the confirmation message.
	define("LANG_CLICKTOCALL_TIP4", "Altı haneli aktivasyon kodunu girmeniz istenecektir.Kodunu girin ve onay mesajı için bekleyin.");
	//After activate your phone number, click in Save Number to finish the process.
	define("LANG_CLICKTOCALL_TIP5", "Telefon numaranızı etkinleştirdikten sonra, işlemi tamamlamak için Kaydet'i tıklatın.");
	//For numbers outside the USA, you need to put your country code first.
	define("LANG_CLICKTOCALL_TIP6", "ABD dışındaki numaraları için, ilk önce ülke kodunu koymak gerekir.");
	//Only numbers from USA are accepted.
	define("LANG_CLICKTOCALL_TIP7", "ABD yalnızca sayı kabul edilir.");
	//"Click to Call" report
	define("LANG_CLICKTOCALL_REPORT", "\"Aramak için tıklayın\" raporu");
	//Direction
	define("LANG_CLICKTOCALL_REPORT_DIRECTION", "Yön");
	//To
	define("LANG_CLICKTOCALL_REPORT_FROM", "Itibaren");
	//Start Time
	define("LANG_CLICKTOCALL_REPORT_START_TIME", "Başlangıç Saati");
	//End Time
	define("LANG_CLICKTOCALL_REPORT_END_TIME", "Bitiş Saati");
	//Duration (seconds)
	define("LANG_CLICKTOCALL_REPORT_DURATION", "Süre (saniye)");
	//No reports available.
	define("LANG_CLICKTOCALL_REPORT_NORECORD", "Yok bildirir.");
	//Activated by
	define("LANG_LABEL_ACTIVATED_BY", "Tarafından aktive");
	//Activation failed. Please, try again.
	define("LANG_TWILIO_ERROR_10000", "Etkinleştirme başarısız oldu. Lütfen yeniden deneyin.");
	//Account is not active.
	define("LANG_TWILIO_ERROR_10001", "Hesap aktif değildir.");
	//Trial account does not support this feature.
    define("LANG_TWILIO_ERROR_10002", "Deneme hesabı, bu özelliği desteklemiyor.");
	//Incoming call rejected due to inactive account.
    define("LANG_TWILIO_ERROR_10003", "Gelen çağrı, pasif hesap nedeniyle reddetti.");
	//Invalid URL format.
    define("LANG_TWILIO_ERROR_11100", "Geçersiz URL biçimi.");
	//HTTP retrieval failure.
    define("LANG_TWILIO_ERROR_11200", "HTTP alma başarısızlık.");
	//HTTP connection failure.
    define("LANG_TWILIO_ERROR_11205", "HTTP bağlantı hatası.");
	//HTTP protocol violation.
    define("LANG_TWILIO_ERROR_11206", "HTTP protokol ihlali.");
	//HTTP bad host name.
    define("LANG_TWILIO_ERROR_11210", "HTTP kötü bir konak adı.");
	//HTTP too many redirects.
    define("LANG_TWILIO_ERROR_11215", "HTTP çok yönlendirir.");
	//Document parse failure.
    define("LANG_TWILIO_ERROR_12100", "Belge ayrıştırma hatası.");
	//Invalid Twilio Markup XML version.
    define("LANG_TWILIO_ERROR_12101", "Geçersiz Twilio Biçimlendirme XML sürümü.");
	//The root element must be Response.
    define("LANG_TWILIO_ERROR_12102", "Tepki kök elemanı olmalıdır.");
	//Schema validation warning.
    define("LANG_TWILIO_ERROR_12200", "Şema doğrulama uyarısı.");
	//Invalid Content-Type.
    define("LANG_TWILIO_ERROR_12300", "Geçersiz Content-Type.");
	//Internal Failure.
    define("LANG_TWILIO_ERROR_12400", "İç Başarısızlık.");
	//Dial: Cannot Dial out from a Dial Call Segment.
    define("LANG_TWILIO_ERROR_13201", "Dial: Çevirmeli Çağrı Segment Dial değil.");
	//Dial: Invalid method value.
    define("LANG_TWILIO_ERROR_13210", "Dial: Geçersiz yöntem değeri.");
	//Dial: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13212", "Dial: Geçersiz zaman aşımı değeri.");
	//Dial: Invalid hangupOnStar value.
    define("LANG_TWILIO_ERROR_13213", "Dial: Geçersiz hangupOnStar değer.");
	//Dial: Invalid callerId value.
    define("LANG_TWILIO_ERROR_13214", "Dial: Geçersiz CallerID değer.");
	//Dial: Invalid nested element.
    define("LANG_TWILIO_ERROR_13215", "Dial: Geçersiz iç içe geçmiş öğesi.");
	//Dial: Invalid timeLimit value.
    define("LANG_TWILIO_ERROR_13216", "Dial: Geçersiz süre kısıtlaması değer.");
	//Dial->Number: Invalid method value.
    define("LANG_TWILIO_ERROR_13221", "Dial->Number: Geçersiz yöntem değeri.");
	//Dial->Number: Invalid sendDigits value.
    define("LANG_TWILIO_ERROR_13222", "Dial->Number: Geçersiz sendDigits değer.");
	//Dial: Invalid phone number format.
    define("LANG_TWILIO_ERROR_13223", "Dial: Geçersiz telefon numarası biçimi.");
	//Dial: Invalid phone number.
    define("LANG_TWILIO_ERROR_13224", "Dial: Geçersiz telefon numarası.");
	//Dial: Forbidden phone number.
    define("LANG_TWILIO_ERROR_13225", "Dial: Telefon numarası yasaktır.");
	//Dial->Conference: Invalid muted value.
    define("LANG_TWILIO_ERROR_13230", "Dial->Conference: Geçersiz sessiz değer.");
	//Dial->Conference: Invalid endConferenceOnExit value.
    define("LANG_TWILIO_ERROR_13231", "Dial->Conference: Geçersiz endConferenceOnExit değer.");
	//Dial->Conference: Invalid startConferenceOnEnter value.
    define("LANG_TWILIO_ERROR_13232", "Dial->Conference: Geçersiz startConferenceOnEnter değer.");
	//Dial->Conference: Invalid waitUrl.
    define("LANG_TWILIO_ERROR_13233", "Dial->Conference: Geçersiz waitUrl.");
	//Dial->Conference: Invalid waitMethod.
    define("LANG_TWILIO_ERROR_13234", "Dial->Conference: Geçersiz waitMethod.");
	//Dial->Conference: Invalid beep value.
    define("LANG_TWILIO_ERROR_13235", "Dial->Conference: Geçersiz bip değeri.");
	//Dial->Conference: Invalid Conference Sid.
    define("LANG_TWILIO_ERROR_13236", "Dial->Conference: Geçersiz Konferansı Sid.");
	//Dial->Conference: Invalid Conference Name.
    define("LANG_TWILIO_ERROR_13237", "Dial->Conference: Geçersiz Konferansı adı.");
	//Dial->Conference: Invalid Verb used in waitUrl TwiML.
    define("LANG_TWILIO_ERROR_13238", "Dial->Conference: Geçersiz Fiil waitUrl TwiML kullanılır.");
	//Gather: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13310", "Gather: Geçersiz finishOnKey değer.");
	//Gather: Invalid method value.
    define("LANG_TWILIO_ERROR_13312", "Gather: Geçersiz yöntem değeri.");
	//Gather: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13313", "Gather: Geçersiz zaman aşımı değeri.");
	//Gather: Invalid numDigits value.
    define("LANG_TWILIO_ERROR_13314", "Gather: Geçersiz numDigits değer.");
	//Gather: Invalid nested verb.
    define("LANG_TWILIO_ERROR_13320", "Gather: Geçersiz iç içe geçmiş fiil.");
	//Gather->Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13321", "Gather->Say: Geçersiz ses değeri.");
	//Gather->Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13322", "Gather->Say: Geçersiz döngü değeri.");
	//Gather->Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13325", "Gather->Play: Geçersiz Content-Type.");
	//Play: Invalid loop value.
    define("LANG_TWILIO_ERROR_13410", "Play: Geçersiz döngü değeri.");
	//Play: Invalid Content-Type.
    define("LANG_TWILIO_ERROR_13420", "Play: Geçersiz Content-Type.");
	//Say: Invalid loop value.
    define("LANG_TWILIO_ERROR_13510", "Say: Geçersiz döngü değeri.");
	//Say: Invalid voice value.
    define("LANG_TWILIO_ERROR_13511", "Say: Geçersiz ses değeri.");
	//Say: Invalid text.
    define("LANG_TWILIO_ERROR_13520", "Say: Metin Geçersiz.");
	//Record: Invalid method value.
    define("LANG_TWILIO_ERROR_13610", "Record: Geçersiz yöntem değeri.");
	//Record: Invalid timeout value.
    define("LANG_TWILIO_ERROR_13611", "Record: Geçersiz zaman aşımı değeri.");
	//Record: Invalid maxLength value.
    define("LANG_TWILIO_ERROR_13612", "Record: Geçersiz maxLength değer.");
	//Record: Invalid finishOnKey value.
    define("LANG_TWILIO_ERROR_13613", "Record: Geçersiz finishOnKey değeri.");
	//Redirect: Invalid method value.
    define("LANG_TWILIO_ERROR_13710", "Redirect: Geçersiz yöntem değeri.");
	//Pause: Invalid length value.
    define("LANG_TWILIO_ERROR_13910", "Pause: Geçersiz uzunluk değeri.");
	//Invalid "To" attribute.
    define("LANG_TWILIO_ERROR_14101", "Geçersiz öznitelik.");
	//Invalid "From" attribute.
    define("LANG_TWILIO_ERROR_14102", "Geçersiz özniteliği.");
	//Invalid Body.
    define("LANG_TWILIO_ERROR_14103", "Geçersiz Vücut.");
	//Invalid Method attribute.
    define("LANG_TWILIO_ERROR_14104", "Geçersiz Yöntemi özniteliği.");
	//Invalid statusCallback attribute.
    define("LANG_TWILIO_ERROR_14105", "Geçersiz statusCallback özniteliği.");
	//Document retrieval limit reached.
    define("LANG_TWILIO_ERROR_14106", "Belge alma sınırına ulaşıldığında.");
	//SMS send rate limit exceeded.
    define("LANG_TWILIO_ERROR_14107", "SMS hız limiti aşıldığında gönderebilirsiniz.");
	//From phone number not SMS capable.
    define("LANG_TWILIO_ERROR_14108", "Yeteneğine telefon numarası gelen SMS değil.");
	//SMS Reply message limit exceeded.
    define("LANG_TWILIO_ERROR_14109", "SMS Yanıtla mesaj sınırı aşıldı.");
	//Invalid Verb for SMS Reply.
    define("LANG_TWILIO_ERROR_14110", "SMS Yanıtla Geçersiz Fiil.");
	//Invalid To phone number for Trial mode.
    define("LANG_TWILIO_ERROR_14111", "Deneme modu için telefon numarası geçersiz.");
	//Unknown parameters.
    define("LANG_TWILIO_ERROR_20001", "Bilinmeyen parametreler.");
	//Invalid FriendlyName.
    define("LANG_TWILIO_ERROR_20002", "Geçersiz FriendlyName.");
	//Permission Denied.
    define("LANG_TWILIO_ERROR_20003", "İzin Verilmedi.");
	//Method not allowed.
    define("LANG_TWILIO_ERROR_20004", "Yönteme izin verilmiyor.");
	//Account not active.
    define("LANG_TWILIO_ERROR_20005", "Hesap aktif değil.");
	//No Called number specified.
    define("LANG_TWILIO_ERROR_21201", "Yok Aranan numara belirtildi.");
	//Called number is a premium number.
    define("LANG_TWILIO_ERROR_21202", "Aranan numarayı bir prim sayıdır.");
	//International calling not enabled.
    define("LANG_TWILIO_ERROR_21203", "Uluslararası arama etkin değil.");
	//Invalid URL.
    define("LANG_TWILIO_ERROR_21205", "Geçersiz URL.");
	//Invalid SendDigits.
    define("LANG_TWILIO_ERROR_21206", "Geçersiz SendDigits.");
	//Invalid IfMachine.
    define("LANG_TWILIO_ERROR_21207", "Geçersiz IfMachine.");
	//Invalid Timeout.
    define("LANG_TWILIO_ERROR_21208", "Geçersiz Timeout.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21209", "Geçersiz Method.");
	//Caller phone number not verified.
    define("LANG_TWILIO_ERROR_21210", "Arayan telefon numarası doğrulanmadı.");
	//Invalid Called Phone Number.
    define("LANG_TWILIO_ERROR_21211", "Geçersiz Telefon Numarası çağrılır.");
	//Invalid Caller Phone Number.
    define("LANG_TWILIO_ERROR_21212", "Geçersiz Arayan Telefon Numarası.");
	//Caller phone number is required.
    define("LANG_TWILIO_ERROR_21213", "Arayan telefon numarası gereklidir.");
	//Called Phone Number cannot be reached.
    define("LANG_TWILIO_ERROR_21214", "Adında Telefon Numarası ulaşmış olamaz.");
	//Account not authorized to call phone number.
    define("LANG_TWILIO_ERROR_21215", "Hesap telefon numarasını aramak için yetkili değildir.");
	//Account not allowed to call phone number.
    define("LANG_TWILIO_ERROR_21216", "Telefon numarasını aramak için izin verilmez Hesabı.");
	//Phone number does not appear to be valid.
    define("LANG_TWILIO_ERROR_21217", "Telefon numarası geçerli olabilmesi için görünmez.");
	//Invalid ApplicationSid.
    define("LANG_TWILIO_ERROR_21218", "Geçersiz ApplicationSid.");
	//Invalid call state.
    define("LANG_TWILIO_ERROR_21220", "Geçersiz arama durumunda.");
	//Invalid Phone Number.
    define("LANG_TWILIO_ERROR_21401", "Geçersiz Telefon Numarası.");
	//Invalid Url.
    define("LANG_TWILIO_ERROR_21402", "Geçersiz URL.");
	//Invalid Method.
    define("LANG_TWILIO_ERROR_21403", "Geçersiz Method");
	//Inbound Phone number not available to trial account.
    define("LANG_TWILIO_ERROR_21404", "Gelen Telefon numarası deneme hesabı mevcut değil.");
	//Cannot set VoiceFallbackUrl without setting Url.
    define("LANG_TWILIO_ERROR_21405", "URL ayarı VoiceFallbackUrl ayarlanamıyor.");
	//Cannot set SmsFallbackUrl without setting SmsUrl.
    define("LANG_TWILIO_ERROR_21406", "SmsUrl ayarı SmsFallbackUrl ayarlanamıyor.");
	//This Phone Number type does not support SMS.
    define("LANG_TWILIO_ERROR_21407", "Bu Telefon Numarası türü SMS desteklemiyor.");
	//Phone number already validated on your account.
    define("LANG_TWILIO_ERROR_21450", "Telefon numarası zaten hesabınızda valide.");
	//Invalid area code.
    define("LANG_TWILIO_ERROR_21451", "Geçersiz alan kodu.");
	//No phone numbers found in area code.
    define("LANG_TWILIO_ERROR_21452", "Hiçbir telefon numarası alan kodu bulundu.");
	//Phone number already validated on another account.
    define("LANG_TWILIO_ERROR_21453", "Telefon numarası Zaten başka bir hesabın da tasdik edilmiştir.");
	//Invalid CallDelay.
    define("LANG_TWILIO_ERROR_21454", "Geçersiz CallDelay.");
	//Resource not available.
    define("LANG_TWILIO_ERROR_21501", "Kaynak kullanılabilir değil.");
	//Invalid callback url.
    define("LANG_TWILIO_ERROR_21502", "Geçersiz geri arama url.");
	//Invalid transcription type.
    define("LANG_TWILIO_ERROR_21503", "Geçersiz transkripsiyon yazın.");
	//RecordingSid is required..
    define("LANG_TWILIO_ERROR_21504", "RecordingSid gereklidir.");
	//Phone number is not a valid SMS-capable inbound phone number.
    define("LANG_TWILIO_ERROR_21601", "Telefon numarası, geçerli bir SMS özellikli gelen telefon numarası değildir.");
	//Message body is required.
    define("LANG_TWILIO_ERROR_21602", "Mesaj gövdesi gereklidir.");
	//The source 'from' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21603", "Kaynağı telefon numarası bir SMS göndermek için gereklidir.");
	//The destination 'to' phone number is required to send an SMS.
    define("LANG_TWILIO_ERROR_21604", "Telefon numarası 'için' Hedef bir SMS göndermek için gereklidir.");
	//Maximum SMS body length is 160 characters.
    define("LANG_TWILIO_ERROR_21605", "Maksimum SMS vücut uzunluğu 160 karakter.");
	//The "From" phone number provided is not a valid, SMS-capable inbound phone number for your account.
    define("LANG_TWILIO_ERROR_21606", "Verilen telefon numarası hesabınız için geçerli, SMS özellikli gelen telefon numarası değildir.");
	//The Sandbox number can send messages only to verified numbers.
    define("LANG_TWILIO_ERROR_21608", "Sandbox sayısı sadece doğrulanmış numaralara mesaj gönderebilirsiniz.");
	
	# ----------------------------------------------------------------------------------------------------
	# FACEBOOK COMMENTS
	# ----------------------------------------------------------------------------------------------------
	//Facebook comments
	define("LANG_LABEL_FACEBOOK_COMMENTS", "Facebook yorum");
	//Facebook comments not available for this listing
	define("LANG_LABEL_FACEBOOK_COMMENTS_NOT_AVAILABLE", "Bu liste için geçerli değildir Facebook yorum");
	//Be sure you're logged into Facebook with the same account you set in your Commenting Options section, otherwise you can not moderate the comments for this item. 
	define("LANG_LABEL_FACEBOOK_TIP1", "Yorumlarında Seçenekleri bölümünde belirlenen aynı hesap ile Facebook oturum açmış olduğunuzdan emin olun, aksi takdirde orta Bu öğe için bir yorum olamaz.");
	//You can also moderate your comments by going to
	define("LANG_LABEL_FACEBOOK_TIP2", "Ayrıca, giderek orta ");
	
	# ----------------------------------------------------------------------------------------------------
	# EDIRECTORY API
	# ----------------------------------------------------------------------------------------------------
	//Invalid API key.
	define("LANG_API_INVALIDKEY", "Geçersiz API anahtarı.");
	//Missing parameter: module.
	define("LANG_API_EMPTYMODULE", "Parametre yok: module.");
	//Invalid module name.
	define("LANG_API_INVALIDMODULE", "Geçersiz modül adı.");
	//Module disabled.
	define("LANG_API_MODULEOFF", "Modül devre dışı.");
	//Missing parameter: keyword.
	define("LANG_API_EMPTYKEYWORD", "Parametre yok: keyword.");
	//API disabled.
	define("LANG_API_DISABLED", "API devre dışı.");
	
	# ----------------------------------------------------------------------------------------------------
	# THEME TEMPLATE
	# ----------------------------------------------------------------------------------------------------
	//Swimming Pool
	define("LANG_LABEL_TEMPLATE_POOL", "Yüzme Havuzu");
	//Bedrooms(s)
	define("LANG_LABEL_TEMPLATE_BEDROOM", "Yatak Odası");
	//Bathrooms(s)
	define("LANG_LABEL_TEMPLATE_BATHROOM", "Banyolar");
	//Level(s)
	define("LANG_LABEL_TEMPLATE_LEVEL", "Seviye(ler)");
	//Property Type
	define("LANG_LABEL_TEMPLATE_TYPE", "Emlak Tipi");
	//Purpose
	define("LANG_LABEL_TEMPLATE_PURPOSE", "Amaç");
	//Price
	define("LANG_LABEL_TEMPLATE_PRICE", "Fiyat");
	//Acres
	define("LANG_LABEL_TEMPLATE_ACRES", "Acres");
	//Built In
	define("LANG_LABEL_TEMPLATE_TYPEBUILTIN", "Dahili");
	//Square Feet
	define("LANG_LABEL_TEMPLATE_SQUARE", "Feet Kare");
	//Office
	define("LANG_LABEL_TEMPLATE_OFFICE", "Ofis");
	//Laundry Room
	define("LANG_LABEL_TEMPLATE_LAUNDRYROOM", "Çamaşır Odası");
	//Central Air Conditioning
	define("LANG_LABEL_TEMPLATE_AIRCOND", "Merkezi Klima");
	//Dining Room
	define("LANG_LABEL_TEMPLATE_DINING", "Yemek Odası");
	//Garage
	define("LANG_LABEL_TEMPLATE_GARAGE", "Garaj");
	//Garbage Disposal
	define("LANG_LABEL_TEMPLATE_GARBAGE", "Çöp Atma");