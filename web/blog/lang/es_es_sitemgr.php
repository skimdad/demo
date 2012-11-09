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
	# * FILE: blog/lang/es_es_sitemgr.php
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
	define("LANG_SITEMGR_POST_BLOG_PLURAL", "Entradas");
	//Post Title
	define("LANG_SITEMGR_BLOG_POST_TITLE", "Post Título");
	//Click here to view this post
	define("LANG_MSG_CLICK_TO_VIEW_THIS_POST", "Haga clic aquí para ver este post");
	//Click here to edit this post
	define("LANG_MSG_CLICK_TO_EDIT_THIS_POST", "Haga clic aquí para editar este post");
	//Click here to delete this post
	define("LANG_MSG_CLICK_TO_DELETE_THIS_POST", "Haga clic aquí para borrar este post");
	//Categories
	define("LANG_SITEMGR_TAGS", "Categorías");
	//Category
	define("LANG_SITEMGR_TAG", "Categoría");
	//Manage Categories
	define("LANG_SITEMGR_MENU_MANAGETAGS", "Administrar Categorías");
	//No post found. It might be deleted.
	define("LANG_SITEMGR_POST_MIGHTBEDELETED", "No encontró Post. Puede ser que sea eliminado.");
	//Post Detail
	define("LANG_SITEMGR_POST_DETAIL", "Post Detalle");
	//Are you sure you want to delete this post?
	define("LANG_SITEMGR_POST_DELETEQUESTION", "¿Estás seguro que quieres eliminar este mensaje?");
	//No posts in the system.
	define("LANG_SITEMGR_BLOG_NORECORD", "No hay posts en el sistema.");
	//Click here to view this category
	define("LANG_SITEMGR_CLICK_TOVIEWTAG", "Haga clic aquí para ver esta categoría");
	//Click here to edit this category
	define("LANG_SITEMGR_CLICK_TOEDITTAG", "Haga clic aquí para editar esta categoría");
	//Click here to delete this category
	define("LANG_SITEMGR_CLICK_TODELETETAG", "Haga clic aquí para borrar esta categoría");
	//View Category
	define("LANG_SITEMGR_VIEWTAG", "Ver Categoría");
	//Edit Category
	define("LANG_SITEMGR_EDITTAG", "Editar Categoría");
	//Delete Category
	define("LANG_SITEMGR_DELETETAG", "Eliminar Categoría");
	//No categories.
	define("LANG_SITEMGR_TAGS_NORECORD", "Sin categorías.");
	//The category was successfully updated.
	define("LANG_SITEMGR_TAG_SUCCESSUPDATED", "La categoría se ha actualizado correctamente.");
	//Are you sure you want to delete this category?
	define("LANG_SITEMGR_TAG_DELETEQUESTION", "¿Está seguro que desea eliminar esta categoría?");
	//Post was successfully updated!
	define("LANG_MSG_POST_SUCCESSFULLY_UPDATED", "¡Post se ha actualizado con éxito!");
	//Post successfully added!
	define("LANG_MSG_POST_SUCCESSFULLY_ADDED", "¡Ha agregado Post!");
	//Post successfully deleted!
	define("LANG_SITEMGR_POST_WASSUCCESSDELETED", "¡Post eliminado correctamente!");
	//Category Information
	define("LANG_SITEMGR_TAG_INFORMATION", "Información de Categoría");
	//If you disable a category...
	define("LANG_LABEL_IFDISABLETAG", "Si deshabilita una categoría, palabras clave, descripción y palabras clave se perderán.");
	//We recommend categories have less than 22 characters to preserve formatting on the front of the site", but this may depend on your layout.
	define("LANG_SITEMGR_TAG_INFOTEXT1", "Recomendamos categorías tienen menos de 22 caracteres para conservar el formato en el frente del sitio, pero esto puede depender de su diseño.");
	//You can choose a category title to be accessed directly from the web browser as a static html page. The chosen category title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_SITEMGR_TAG_FRIENDLYURL1", "Usted puede escoger un título de categorías para acceder directamente desde el navegador web como una página html estática. La título de la categoría elegido sólo debe contener caracteres alfanuméricos (como \"a-z\" o \"0-9\") y \"-\" en lugar de espacios.");
	//The category title "Computer" will be available through the url:
	define("LANG_SITEMGR_TAG_FRIENDLYURL2", "El categoría \"Computer\" estará disponible a través de la url:");
	//Select the available languages for this category
	define("LANG_SITEMGR_LANGUAGE_SELECTAVAIBLETAG", "eleccione los idiomas disponibles para esta categoría");
	//Disable Category
	define("LANG_SITEMGR_DISABLE_TAG", "Deshabilitar Categoría");
	//All Categories
	define("LANG_LABEL_SELECT_ALLTAGS", "Todas las Categorías");
	//The category was successfully added.
	define("LANG_SITEMGR_TAG_SUCCESSADDED", "La categoría se ha añadido correctamente.");
	//No categories found.
	define("LANG_TAG_NOTFOUND", "No se han encontrado.");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_TAG", "Por favor, seleccione una categoría válida");
	//Please", select a category first
	define("LANG_MSG_SELECT_TAG_FIRST", "Por favor, seleccione una categoría de primera");
	//The category was saved as disabled category.
	define("LANG_SITEMGR_TAG_WITHOUT_LANGUAGE", "La categoría se guardó como una etiqueta con discapacidad.");
	//Category Detail
	define("LANG_SITEMGR_TAGDETAIL", "Categoría Detalle");
	//Statistic Report
	define("LANG_SITEMGR_BLOG_STATISTICREPORT", "Informe Estadístico");
	//Comment not found
	define("LANG_SITEMGR_COMMENT_NOTFOUND", "El comentario no encontrado");
	//Comment successfully deleted!
	define("LANG_SITEMGR_COMMENT_SUCCESSDELETED", "¡Comentario eliminado correctamente!");
	//Reply not found
	define("LANG_SITEMGR_REPLY_NOTFOUND", "Respuesta no se encuentra");
	//Reply successfully deleted!
	define("LANG_SITEMGR_REPLY_SUCCESSDELETED", "¡Respuesta eliminada correctamente!");
	//Manage comments
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENTS", "Administrar Comentarios");
	//No comments in the system.
	define("LANG_SITEMGR_COMMENT_NORECORD", "No hay comentarios en el sistema.");
	//No comments in the system.
	define("LANG_SITEMGR_REPLY_NORECORD", "No hay respuestas en el sistema.");
	//Comment
	define("LANG_SITEMGR_COMMENT", "Comentario");
	//Comments
	define("LANG_SITEMGR_COMMENT_PLURAL", "Comentarios");
	//Manage comment
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENT", "Administrar Comentario");
	//Delete comment
	define("LANG_SITEMGR_COMMENT_DELETECOMMENT", "Eliminar comentario");
	//Are you sure you want to delete this comment?
	define("LANG_SITEMGR_COMMENT_DELETEQUESTION", "¿Está seguro que desea eliminar este comentario?");
	//Replys
	define("LANG_SITEMGR_REPLYS", "Respuestas");
	//Comment Preview
	define("LANG_SITEMGR_COMMENT_REVIEWPREVIEW", "Comentario Prevista");
	//Comments
	define("LANG_SITEMGR_SETTINGS_EMAIL_BLOG", "Comentarios");
	//Category successfully deleted!
	define("LANG_SITEMGR_TAG_DELETED", "¡Se eliminó la categoría correctamente!");
	//The category have no selected language, please select a language to continue.
	define("LANG_SITEMGR_ERROR_TAG_HAVE_NO_LANGUAGE", "La categoría no tiene un idioma seleccionado, por favor seleccione un idioma para continuar.");
	//Content is required
	define("LANG_SITEMGR_CONTENT_IS_REQUIRED", "El contenido es necesario.");
	//Manage Replies
	define("LANG_SITEMGR_COMMENT_MANAGEREPLIES", "Administrar respuestas");
	//Reply
	define("LANG_SITEMGR_REPLY", "Respuesta");
	//Manage reply
	define("LANG_SITEMGR_COMMENT_MANAGEREPLY", "Administrar respuesta");
	//Delete reply
	define("LANG_SITEMGR_COMMENT_DELETEREPLY", "Borrar respuesta");
	//Reply Preview
	define("LANG_SITEMGR_REPLY_REVIEWPREVIEW", "Responder Prevista");
	//Are you sure you want to delete this reply?
	define("LANG_SITEMGR_REPLY_DELETEQUESTION", "¿Está seguro que quiere borrar esta respuesta?");
	//Before a comment appears:
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_BEFOREACOMMENTAPPEARS", "Antes de que un comentario aparece:");
	//Site manager must approve the comment and the reply
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_SITEMGRMUSTAPPROVE", "Administrador del Sitio debe aprobar el comentario y la respuesta");
	//Your comments configuration was successfully changed!
	define("LANG_SITEMGR_SETTINGS_BLOG_CONFIGURATIONWASCHANGED", "¡La configuración de su comentarios fue cambiado con éxito!");
	//Comment Pending Approval
	define("LANG_COMMENT_PENDINGAPPROVAL", "Comentario en Espera de Aprobación");
	//Comment Active
	define("LANG_COMMENT_ACTIVE", "Comentario Activo");
	//Waiting Site Manager Approval for Comment
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT", "Esperando la Aprobación del Administrador del Sitio para el comentario");
	//Comment Already Approved
	define("LANG_MSG_COMMENT_ALREADY_APPROVED", "El Comentário ya está Aprobado");
	//Reply Already Approved
	define("LANG_MSG_REPLY_ALREADY_APPROVED", "El Respuesta ya está Aprobada");
	//Comment successfully approved!
	define("LANG_SITEMGR_COMMENT_SUCCESSAPPROVED", "¡Comentario aprobado con éxito!");
	//Reply successfully approved!
	define("LANG_SITEMGR_REPLY_SUCCESSAPPROVED", "¡Respuesta aprobada con éxito!");
	//Approve Comment
	define("LANG_SITEMGR_APPROVE_COMMENT", "Aprobar Comentario");