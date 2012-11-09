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
	# * FILE: blog/lang/it_it_sitemgr.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//blog
	define("LANG_SITEMGR_BLOG", BLOG_FEATURE_NAME);
	//Blog
	define("LANG_SITEMGR_BLOG_SING", string_ucwords(BLOG_FEATURE_NAME));
	//Post
	define("LANG_SITEMGR_POST_BLOG_SING", "Post");
    //Posts
	define("LANG_SITEMGR_POST_BLOG_PLURAL", "Posts");
	//Post Title
	define("LANG_SITEMGR_BLOG_POST_TITLE", "Titolo del Post");
	//Click here to view this post
	define("LANG_MSG_CLICK_TO_VIEW_THIS_POST", "Clicca qui per visualizzare questo post");
	//Click here to edit this post
	define("LANG_MSG_CLICK_TO_EDIT_THIS_POST", "Clicca qui per pubblicare questo");
	//Click here to delete this post
	define("LANG_MSG_CLICK_TO_DELETE_THIS_POST", "Clicca qui per cancellare questo post");
	//Categories
	define("LANG_SITEMGR_TAGS", "Categorie");
	//Category
	define("LANG_SITEMGR_TAG", "Categoria");
	//Manage Categories
	define("LANG_SITEMGR_MENU_MANAGETAGS", "Gestione dei Categorie");
	//No post found. It might be deleted.
	define("LANG_SITEMGR_POST_MIGHTBEDELETED", "Nessun Post trovato. Potrebbe essere eliminato.");
	//Post Detail
	define("LANG_SITEMGR_POST_DETAIL", "Post Dettaglio");
	//Are you sure you want to delete this post?
	define("LANG_SITEMGR_POST_DELETEQUESTION", "Sei sicuro di volere cancellare questo post?");
	//No posts in the system.
	define("LANG_SITEMGR_BLOG_NORECORD", "Nessun post nel sistema.");
	//Click here to view this category
	define("LANG_SITEMGR_CLICK_TOVIEWTAG", "Clicca qui per visualizzare questa categoria");
	//Click here to edit this category
	define("LANG_SITEMGR_CLICK_TOEDITTAG", "Clicca qui per modificare questa categoria");
	//Click here to delete this category
	define("LANG_SITEMGR_CLICK_TODELETETAG", "Clicca qui per cancellare questa categoria");
	//View Category
	define("LANG_SITEMGR_VIEWTAG", "Vedi Categoria");
	//Edit Category
	define("LANG_SITEMGR_EDITTAG", "Modifica Categoria");
	//Delete Category
	define("LANG_SITEMGR_DELETETAG", "Cancellare Categoria");
	//No categories.
	define("LANG_SITEMGR_TAGS_NORECORD", "Nessun categories.");
	//The category was successfully updated.
	define("LANG_SITEMGR_TAG_SUCCESSUPDATED", "Il categoria è stato aggiornato con successo.");
	//Are you sure you want to delete this category?
	define("LANG_SITEMGR_TAG_DELETEQUESTION", "Sei sicuro di voler cancellare questa categoria?");
	//Post was successfully updated!
	define("LANG_MSG_POST_SUCCESSFULLY_UPDATED", "Post stato aggiornato con successo!");
	//Post successfully added!
	define("LANG_MSG_POST_SUCCESSFULLY_ADDED", "Post aggiunto con successo!");
	//Post successfully deleted!
	define("LANG_SITEMGR_POST_WASSUCCESSDELETED", "Post eliminato con successo!");
	//Category Information
	define("LANG_SITEMGR_TAG_INFORMATION", "Categoria Informazioni");
	//If you disable a category...
	define("LANG_LABEL_IFDISABLETAG", "Se si disattiva un categoria, le parole chiave, descrizione e parole chiave andranno perse.");
	//We recommend categories have less than 22 characters to preserve formatting on the front of the site, but this may depend on your layout.
	define("LANG_SITEMGR_TAG_INFOTEXT1", "Si consiglia di categoria hanno meno di 22 caratteri per mantenere la formattazione sul fronte del sito, ma questo può dipendere dal vostro layout.");
	//You can choose a category title to be accessed directly from the web browser as a static html page. The chosen category title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_SITEMGR_TAG_FRIENDLYURL1", "È possibile scegliere un titolo del categoria a cui accedere direttamente dal browser web come una pagina in html statico. Il titolo categoria scelto deve contenere solo caratteri alfanumerici (come \"a-z\" e/o \"0-9\") e \"-\" al posto degli spazi.");
	//The category title "Computer" will be available through the url:
	define("LANG_SITEMGR_TAG_FRIENDLYURL2", "Il titolo categoria \"Computer\" sarà disponibile attraverso l'url:");
	//Select the available languages for this category
	define("LANG_SITEMGR_LANGUAGE_SELECTAVAIBLETAG", "Selezionare le lingue disponibili per questo categoria");
	//Disable Category
	define("LANG_SITEMGR_DISABLE_TAG", "Disabilita Categoria");
	//All Categories
	define("LANG_LABEL_SELECT_ALLTAGS", "Tutte le Categorie");
	//The category was successfully added.
	define("LANG_SITEMGR_TAG_SUCCESSADDED", "Il categoria è stato aggiunto.");
	//No categories found.
	define("LANG_TAG_NOTFOUND", "Nessun categoria trovato.");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_TAG", "Per favore, selezionare un categoria valido");
	//Please", select a category first
	define("LANG_MSG_SELECT_TAG_FIRST", "Per favore, selezionare un categoria");
	//The category was saved as disabled category.
	define("LANG_SITEMGR_TAG_WITHOUT_LANGUAGE", "Il categoria è stato salvato come categoria disabili.");
	//Category Detail
	define("LANG_SITEMGR_TAGDETAIL", "Categoria Dettaglio");
	//Statistic Report
	define("LANG_SITEMGR_BLOG_STATISTICREPORT", "Statistic Report");
	//Comment not found
	define("LANG_SITEMGR_COMMENT_NOTFOUND", "Commento non trovato");
	//Comment successfully deleted!
	define("LANG_SITEMGR_COMMENT_SUCCESSDELETED", "Commento cancellato con successo!");
	//Reply not found
	define("LANG_SITEMGR_REPLY_NOTFOUND", "Risposta non trovato");
	//Reply successfully deleted!
	define("LANG_SITEMGR_REPLY_SUCCESSDELETED", "Risposta correttamente cancellato!");
	//Manage comments
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENTS", "Gestione dei commenti");
	//No comments in the system.
	define("LANG_SITEMGR_COMMENT_NORECORD", "Nessun commento nel sistema.");
	//No comments in the system.
	define("LANG_SITEMGR_REPLY_NORECORD", "Nessun risposte nel sistema.");
	//Comment
	define("LANG_SITEMGR_COMMENT", "Commento");
	//Comments
	define("LANG_SITEMGR_COMMENT_PLURAL", "Commenti");
	//Manage comment
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENT", "Gestire commento");
	//Delete comment
	define("LANG_SITEMGR_COMMENT_DELETECOMMENT", "Elimina commento");
	//Are you sure you want to delete this comment?
	define("LANG_SITEMGR_COMMENT_DELETEQUESTION", "Sei sicuro di voler cancellare questo commento?");
	//Replys
	define("LANG_SITEMGR_REPLYS", "Risposte");
	//Comment Preview
	define("LANG_SITEMGR_COMMENT_REVIEWPREVIEW", "Anteprima del commento");
	//Comments
	define("LANG_SITEMGR_SETTINGS_EMAIL_BLOG", "Commenti");
	//Category successfully deleted!
	define("LANG_SITEMGR_TAG_DELETED", "Categoria correttamente cancellata!");
	//The category have no selected language, please select a language to continue.
	define("LANG_SITEMGR_ERROR_TAG_HAVE_NO_LANGUAGE", "La categoria non hanno una lingua selezionata, per favore selezionare una lingua per continuare.");
	//Content is required
	define("LANG_SITEMGR_CONTENT_IS_REQUIRED", "Il contenuto è necessario.");
	//Manage Replies
	define("LANG_SITEMGR_COMMENT_MANAGEREPLIES", "Gestire Risposte");
	//Reply
	define("LANG_SITEMGR_REPLY", "Risposta");
	//Manage reply
	define("LANG_SITEMGR_COMMENT_MANAGEREPLY", "Gestire risposta");
	//Delete reply
	define("LANG_SITEMGR_COMMENT_DELETEREPLY", "Elimina risposta");
	//Reply Preview
	define("LANG_SITEMGR_REPLY_REVIEWPREVIEW", "Rispondi Anteprima");
	//Are you sure you want to delete this reply?
	define("LANG_SITEMGR_REPLY_DELETEQUESTION", "Sei sicuro di voler cancellare questa risposta?");
	//Before a comment appears:
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_BEFOREACOMMENTAPPEARS", "Prima che appaia un commento:");
	//Site manager must approve the comment and the reply
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_SITEMGRMUSTAPPROVE", "Amministratore del sito deve approvare il commento e la risposta");
	//Your comments configuration was successfully changed!
	define("LANG_SITEMGR_SETTINGS_BLOG_CONFIGURATIONWASCHANGED", "La configurazione di commenti è stato cambiato con successo!");
	//Comment Pending Approval
	define("LANG_COMMENT_PENDINGAPPROVAL", "Commento in Attesa di Approvazione");
	//Comment Active
	define("LANG_COMMENT_ACTIVE", "Commento Attivo");
	//Waiting Site Manager Approval for Comment
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT", "In Attesa del'approvazione dell'amministratore del sitio per lo Commento");
	//Comment Already Approved
	define("LANG_MSG_COMMENT_ALREADY_APPROVED", "Commento Già Approvato");
	//Reply Already Approved
	define("LANG_MSG_REPLY_ALREADY_APPROVED", "Rispondi Già Approvato");
	//Comment successfully approved!
	define("LANG_SITEMGR_COMMENT_SUCCESSAPPROVED", "Commento approvato con successo!");
	//Reply successfully approved!
	define("LANG_SITEMGR_REPLY_SUCCESSAPPROVED", "Rispondi approvato con successo!");
	//Approve Comment
	define("LANG_SITEMGR_APPROVE_COMMENT", "Approva Commento.");