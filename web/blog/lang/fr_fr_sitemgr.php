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
	# * FILE: blog/lang/fr_fr_sitemgr.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# BLOG
	# ----------------------------------------------------------------------------------------------------
	//blog
	define("LANG_SITEMGR_BLOG", BLOG_FEATURE_NAME);
	//Blog
	define("LANG_SITEMGR_BLOG_SING", string_ucwords(BLOG_FEATURE_NAME));
	//Post
	define("LANG_SITEMGR_POST_BLOG_SING", "Poste");
    //Posts
	define("LANG_SITEMGR_POST_BLOG_PLURAL", "Posts");
	//Post Title
	define("LANG_SITEMGR_BLOG_POST_TITLE", "Titre du poste");
	//Click here to view this post
	define("LANG_MSG_CLICK_TO_VIEW_THIS_POST", "Cliquez ici pour consulter ce post");
	//Click here to edit this post
	define("LANG_MSG_CLICK_TO_EDIT_THIS_POST", "Cliquez ici pour éditer ce post");
	//Click here to delete this post
	define("LANG_MSG_CLICK_TO_DELETE_THIS_POST", "Cliquez ici pour supprimer ce message");
	//Categories
	define("LANG_SITEMGR_TAGS", "Catégories");
	//Category
	define("LANG_SITEMGR_TAG", "Catégorie");
	//Manage Categories
	define("LANG_SITEMGR_MENU_MANAGETAGS", "Gérer les Catégories");
	//No post found. It might be deleted.
	define("LANG_SITEMGR_POST_MIGHTBEDELETED", "Aucun poste trouvé. Il pourrait être supprimé.");
	//Post Detail
	define("LANG_SITEMGR_POST_DETAIL", "Post Détails");
	//Are you sure you want to delete this post?
	define("LANG_SITEMGR_POST_DELETEQUESTION", "Etes-vous sûr de vouloir supprimer ce message?");
	//No posts in the system.
	define("LANG_SITEMGR_BLOG_NORECORD", "Aucune posts dans le système.");
	//Click here to view this category
	define("LANG_SITEMGR_CLICK_TOVIEWTAG", "Cliquez ici pour voir cette catégorie");
	//Click here to edit this category
	define("LANG_SITEMGR_CLICK_TOEDITTAG", "Cliquez ici pour modifier cette catégorie");
	//Click here to delete this category
	define("LANG_SITEMGR_CLICK_TODELETETAG", "Cliquez ici pour supprimer ce catégorie");
	//View Category
	define("LANG_SITEMGR_VIEWTAG", "Voir le Catégorie");
	//Edit Category
	define("LANG_SITEMGR_EDITTAG", "Modifier la catégorie");
	//Delete Category
	define("LANG_SITEMGR_DELETETAG", "Supprimer Catégorie");
	//No categories.
	define("LANG_SITEMGR_TAGS_NORECORD", "Pas de catégories.");
	//The category was successfully updated.
	define("LANG_SITEMGR_TAG_SUCCESSUPDATED", "La catégorie a été mis à jour.");
	//Are you sure you want to delete this category?
	define("LANG_SITEMGR_TAG_DELETEQUESTION", "Etes-vous sûr de vouloir supprimer ce catégorie?");
	//Post was successfully updated!
	define("LANG_MSG_POST_SUCCESSFULLY_UPDATED", "Post a été mis à jour!");
	//Post successfully added!
	define("LANG_MSG_POST_SUCCESSFULLY_ADDED", "Poste d'ajouter!");
	//Post successfully deleted!
	define("LANG_SITEMGR_POST_WASSUCCESSDELETED", "Post supprimé avec succès!");
	//Category Information
	define("LANG_SITEMGR_TAG_INFORMATION", "Catégorie Informations");
	//If you disable a category...
	define("LANG_LABEL_IFDISABLETAG", "Si vous désactivez une catégorie, Meta Description et Meta Keywords sera perdu.");
	//We recommend categories have less than 22 characters to preserve formatting on the front of the site, but this may depend on your layout.
	define("LANG_SITEMGR_TAG_INFOTEXT1", "Nous vous recommandons de catégories ont moins de 22 caractères pour préserver le format sur le front du site, mais cela peut dépendre de votre mise en page.");
	//You can choose a category title to be accessed directly from the web browser as a static html page. The chosen category title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_SITEMGR_TAG_FRIENDLYURL1", "Vous pouvez choisir un titre catégorie pour être accessible directement depuis le navigateur Web comme une page HTML statique. Le titre choisi catégorie doit contenir que des caractères alphanumériques (comme \"a-z\" et/ou \"0-9\") et \"-\" au lieu d'espaces.");
	//The category title "Computer" will be available through the url:
	define("LANG_SITEMGR_TAG_FRIENDLYURL2", "Le titre catégorie \"Computer\" sera disponible via l'URL:");
	//Select the available languages for this category
	define("LANG_SITEMGR_LANGUAGE_SELECTAVAIBLETAG", "Sélectionnez les langues disponibles pour ce catégorie");
	//Disable Category
	define("LANG_SITEMGR_DISABLE_TAG", "Désactiver Catégorie");
	//All Categories
	define("LANG_LABEL_SELECT_ALLTAGS", "Tous les Catégories");
	//The category was successfully added.
	define("LANG_SITEMGR_TAG_SUCCESSADDED", "La catégorie a été ajouté.");
	//No categories found.
	define("LANG_TAG_NOTFOUND", "Pas de catégories trouvés.");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_TAG", "S'il vous plaît, sélectionnez une catégorie valide");
	//Please, select a category first
	define("LANG_MSG_SELECT_TAG_FIRST", "S'il vous plaît, choisir un premier catégorie");
	//The category was saved as disabled category.
	define("LANG_SITEMGR_TAG_WITHOUT_LANGUAGE", "La catégorie a été enregistré en tant que catégorie handicapés.");
	//Category Detail
	define("LANG_SITEMGR_TAGDETAIL", "Catégorie Détails");
	//Statistic Report
	define("LANG_SITEMGR_BLOG_STATISTICREPORT", "Rapport statistique");
	//Comment not found
	define("LANG_SITEMGR_COMMENT_NOTFOUND", "Commentaire introuvable");
	//Comment successfully deleted!
	define("LANG_SITEMGR_COMMENT_SUCCESSDELETED", "Commentaire supprimé avec succès!");
	//Reply not found
	define("LANG_SITEMGR_REPLY_NOTFOUND", "Répondre introuvable");
	//Reply successfully deleted!
	define("LANG_SITEMGR_REPLY_SUCCESSDELETED", "Répondre supprimé avec succès!");
	//Manage comments
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENTS", "Gérer les commentaires");
	//No comments in the system.
	define("LANG_SITEMGR_COMMENT_NORECORD", "Pas de commentaires dans le système.");
	//No comments in the system.
	define("LANG_SITEMGR_REPLY_NORECORD", "Aucune réponse dans le système.");
	//Comment
	define("LANG_SITEMGR_COMMENT", "Commentaire");
	//Comments
	define("LANG_SITEMGR_COMMENT_PLURAL", "Commentaires");
	//Manage comment
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENT", "Commentaire Gérer");
	//Delete comment
	define("LANG_SITEMGR_COMMENT_DELETECOMMENT", "Supprimer le commentaire");
	//Are you sure you want to delete this comment?
	define("LANG_SITEMGR_COMMENT_DELETEQUESTION", "Etes-vous sûr de vouloir supprimer ce commentaire?");
	//Replys
	define("LANG_SITEMGR_REPLYS", "Réponses");
	//Comment Preview
	define("LANG_SITEMGR_COMMENT_REVIEWPREVIEW", "Un commentaire Preview");
	//Comments
	define("LANG_SITEMGR_SETTINGS_EMAIL_BLOG", "Commentaires");
	//Category successfully deleted!
	define("LANG_SITEMGR_TAG_DELETED", "Catégorie supprimée avec succès!");
	//The category have no selected language, please select a language to continue.
	define("LANG_SITEMGR_ERROR_TAG_HAVE_NO_LANGUAGE", "La catégorie n'ont pas de langue choisi, s'il vous plaît choisir une langue pour continuer.");
	//Content is required
	define("LANG_SITEMGR_CONTENT_IS_REQUIRED", "Le contenu est nécessaire.");
	//Manage Replies
	define("LANG_SITEMGR_COMMENT_MANAGEREPLIES", "Gérer les réponses");
	//Reply
	define("LANG_SITEMGR_REPLY", "Réponse");
	//Manage reply
	define("LANG_SITEMGR_COMMENT_MANAGEREPLY", "Gérer réponse");
	//Delete reply
	define("LANG_SITEMGR_COMMENT_DELETEREPLY", "Réponse Supprimer");
	//Reply Preview
	define("LANG_SITEMGR_REPLY_REVIEWPREVIEW", "Répondre Aperçu");
	//Are you sure you want to delete this reply?
	define("LANG_SITEMGR_REPLY_DELETEQUESTION", "Etes-vous sûr de vouloir supprimer cette réponse?");
	//Before a comment appears:
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_BEFOREACOMMENTAPPEARS", "Avant un commentaire s'affiche:");
	//Site manager must approve the comment and the reply
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_SITEMGRMUSTAPPROVE", "Gestionnaire du site doit approuver le commentaire et la réponse");
	//Your comments configuration was successfully changed!
	define("LANG_SITEMGR_SETTINGS_BLOG_CONFIGURATIONWASCHANGED", "La configuration de votre commentaires a été modifié avec succès!");
	//Comment Pending Approval
	define("LANG_COMMENT_PENDINGAPPROVAL", "Commentaire en attente d'approbation");
	//Comment Active
	define("LANG_COMMENT_ACTIVE", "Commentaire Activer");
	//Waiting Site Manager Approval for Comment
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT", "En attendant l'approbation du gestionnaire du site pour un commentaire");
	//Comment Already Approved
	define("LANG_MSG_COMMENT_ALREADY_APPROVED", "Commentaire Déjà Approuvé");
	//Reply Already Approved
	define("LANG_MSG_REPLY_ALREADY_APPROVED", "Répondre Déjà Approuvé");
	//Comment successfully approved!
	define("LANG_SITEMGR_COMMENT_SUCCESSAPPROVED", "Commentaire succès approuvé!");
	//Reply successfully approved!
	define("LANG_SITEMGR_REPLY_SUCCESSAPPROVED", "Répondre avec succès approuvé!");
	//Approve Comment
	define("LANG_SITEMGR_APPROVE_COMMENT", "Approuver Commentaire");