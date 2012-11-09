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
	# * FILE: blog/lang/en_us_sitemgr.php
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
	define("LANG_SITEMGR_BLOG_POST_TITLE", "Post Title");
	//Click here to view this post
	define("LANG_MSG_CLICK_TO_VIEW_THIS_POST", "Click here to view this post");
	//Click here to edit this post
	define("LANG_MSG_CLICK_TO_EDIT_THIS_POST", "Click here to edit this post");
	//Click here to delete this post
	define("LANG_MSG_CLICK_TO_DELETE_THIS_POST", "Click here to delete this post");
	//Categories
	define("LANG_SITEMGR_TAGS", "Categories");
	//Category
	define("LANG_SITEMGR_TAG", "Category");
	//Manage Categories
	define("LANG_SITEMGR_MENU_MANAGETAGS", "Manage Categories");
	//No post found. It might be deleted.
	define("LANG_SITEMGR_POST_MIGHTBEDELETED", "No Post found. It might be deleted.");
	//Post Detail
	define("LANG_SITEMGR_POST_DETAIL", "Post Detail");
	//Are you sure you want to delete this post?
	define("LANG_SITEMGR_POST_DELETEQUESTION", "Are you sure you want to delete this post?");
	//No posts in the system.
	define("LANG_SITEMGR_BLOG_NORECORD", "No posts in the system.");
	//Click here to view this category
	define("LANG_SITEMGR_CLICK_TOVIEWTAG", "Click here to view this category");
	//Click here to edit this category
	define("LANG_SITEMGR_CLICK_TOEDITTAG", "Click here to edit this category");
	//Click here to delete this category
	define("LANG_SITEMGR_CLICK_TODELETETAG", "Click here to delete this category");
	//View Category
	define("LANG_SITEMGR_VIEWTAG", "View Category");
	//Edit Category
	define("LANG_SITEMGR_EDITTAG", "Edit Category");
	//Delete Category
	define("LANG_SITEMGR_DELETETAG", "Delete Category");
	//No categories.
	define("LANG_SITEMGR_TAGS_NORECORD", "No categories.");
	//The category was successfully updated.
	define("LANG_SITEMGR_TAG_SUCCESSUPDATED", "The category was successfully updated.");
	//Are you sure you want to delete this category?
	define("LANG_SITEMGR_TAG_DELETEQUESTION", "Are you sure you want to delete this category?");
	//Post was successfully updated!
	define("LANG_MSG_POST_SUCCESSFULLY_UPDATED", "Post was successfully updated!");
	//Post successfully added!
	define("LANG_MSG_POST_SUCCESSFULLY_ADDED", "Post successfully added!");
	//Post successfully deleted!
	define("LANG_SITEMGR_POST_WASSUCCESSDELETED", "Post successfully deleted!");
	//Category Information
	define("LANG_SITEMGR_TAG_INFORMATION", "Category Information");
	//If you disable a category...
	define("LANG_LABEL_IFDISABLETAG", "If you disable a category, the Keywords, Meta Description and Meta Keywords will be lost.");
	//We recommend categories have less than 22 characters to preserve formatting on the front of the site, but this may depend on your layout.
	define("LANG_SITEMGR_TAG_INFOTEXT1", "We recommend categories have less than 22 characters to preserve formatting on the front of the site, but this may depend on your layout.");
	//You can choose a category title to be accessed directly from the web browser as a static html page. The chosen category title must contain only alphanumeric chars (like "a-z" and/or "0-9") and "-" instead of spaces.
	define("LANG_SITEMGR_TAG_FRIENDLYURL1", "You can choose a category title to be accessed directly from the web browser as a static html page. The chosen category title must contain only alphanumeric chars (like \"a-z\" and/or \"0-9\") and \"-\" instead of spaces.");
	//The category title "Computer" will be available through the url:
	define("LANG_SITEMGR_TAG_FRIENDLYURL2", "The category title \"Computer\" will be available through the url:");
	//Select the available languages for this category
	define("LANG_SITEMGR_LANGUAGE_SELECTAVAIBLETAG", "Select the available languages for this category");
	//Disable Category
	define("LANG_SITEMGR_DISABLE_TAG", "Disable Category");
	//All Categories
	define("LANG_LABEL_SELECT_ALLTAGS", "All Categories");
	//The category was successfully added.
	define("LANG_SITEMGR_TAG_SUCCESSADDED", "The category was successfully added.");
	//No categories found.
	define("LANG_TAG_NOTFOUND", "No categories found.");
	//Please, select a valid category
	define("LANG_MSG_SELECT_VALID_TAG", "Please, select a valid category");
	//Please, select a category first
	define("LANG_MSG_SELECT_TAG_FIRST", "Please, select a category first");
	//The category was saved as disabled category.
	define("LANG_SITEMGR_TAG_WITHOUT_LANGUAGE", "The category was saved as disabled category.");
	//Category Detail
	define("LANG_SITEMGR_TAGDETAIL", "Category Detail");
	//Statistic Report
	define("LANG_SITEMGR_BLOG_STATISTICREPORT", "Statistic Report");
	//Comment not found
	define("LANG_SITEMGR_COMMENT_NOTFOUND", "Comment not found");
	//Comment successfully deleted!
	define("LANG_SITEMGR_COMMENT_SUCCESSDELETED", "Comment successfully deleted!");
	//Reply not found
	define("LANG_SITEMGR_REPLY_NOTFOUND", "Reply not found");
	//Reply successfully deleted!
	define("LANG_SITEMGR_REPLY_SUCCESSDELETED", "Reply successfully deleted!");
	//Manage comments
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENTS", "Manage Comments");
	//No comments in the system.
	define("LANG_SITEMGR_COMMENT_NORECORD", "No comments in the system.");
	//No comments in the system.
	define("LANG_SITEMGR_REPLY_NORECORD", "No replies in the system.");
	//Comment
	define("LANG_SITEMGR_COMMENT", "Comment");
	//Comments
	define("LANG_SITEMGR_COMMENT_PLURAL", "Comments");
	//Manage comment
	define("LANG_SITEMGR_COMMENT_MANAGECOMMENT", "Manage Comment");
	//Delete comment
	define("LANG_SITEMGR_COMMENT_DELETECOMMENT", "Delete comment");
	//Are you sure you want to delete this comment?
	define("LANG_SITEMGR_COMMENT_DELETEQUESTION", "Are you sure you want to delete this comment?");
	//Replies
	define("LANG_SITEMGR_REPLYS", "Replies");
	//Comment Preview
	define("LANG_SITEMGR_COMMENT_REVIEWPREVIEW", "Comment Preview");
	//Comments
	define("LANG_SITEMGR_SETTINGS_EMAIL_BLOG", "Comments");
	//Category successfully deleted!
	define("LANG_SITEMGR_TAG_DELETED", "Category successfully deleted!");
	//The category have no selected language, please select a language to continue.
	define("LANG_SITEMGR_ERROR_TAG_HAVE_NO_LANGUAGE", "The category have no selected language, please select a language to continue.");
	//Content is required
	define("LANG_SITEMGR_CONTENT_IS_REQUIRED", "Content is required.");
	//Manage Replies
	define("LANG_SITEMGR_COMMENT_MANAGEREPLIES", "Manage Replies");
	//Reply
	define("LANG_SITEMGR_REPLY", "Reply");
	//Manage reply
	define("LANG_SITEMGR_COMMENT_MANAGEREPLY", "Manage reply");
	//Delete reply
	define("LANG_SITEMGR_COMMENT_DELETEREPLY", "Delete reply");
	//Reply Preview
	define("LANG_SITEMGR_REPLY_REVIEWPREVIEW", "Reply Preview");
	//Are you sure you want to delete this reply?
	define("LANG_SITEMGR_REPLY_DELETEQUESTION", "Are you sure you want to delete this reply?");
	//Before a comment appears:
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_BEFOREACOMMENTAPPEARS", "Before a comment appears:");
	//Site manager must approve the comment and the reply
	define("LANG_SITEMGR_SETTINGS_POSTCOMMENT_SITEMGRMUSTAPPROVE", "Site manager must approve the comment and the reply");
	//Your comments configuration was successfully changed!
	define("LANG_SITEMGR_SETTINGS_BLOG_CONFIGURATIONWASCHANGED", "Your comments configuration was successfully changed!");
	//Comment Pending Approval
	define("LANG_COMMENT_PENDINGAPPROVAL", "Comment Pending Approval");
	//Comment Active
	define("LANG_COMMENT_ACTIVE", "Comment Active");
	//Waiting Site Manager Approval for Comment
	define("LANG_MSG_WAITINGSITEMGRAPPROVE_COMMENT", "Waiting Site Manager Approval for Comment");
	//Comment Already Approved
	define("LANG_MSG_COMMENT_ALREADY_APPROVED", "Comment Already Approved");
	//Reply Already Approved
	define("LANG_MSG_REPLY_ALREADY_APPROVED", "Reply Already Approved");
	//Comment successfully approved!
	define("LANG_SITEMGR_COMMENT_SUCCESSAPPROVED", "Comment successfully approved!");
	//Reply successfully approved!
	define("LANG_SITEMGR_REPLY_SUCCESSAPPROVED", "Reply successfully approved!");
	//Approve Comment
	define("LANG_SITEMGR_APPROVE_COMMENT", "Approve Comment");