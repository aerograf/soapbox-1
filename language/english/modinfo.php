<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * Module: Soapbox
 *
 * @category        Module
 * @package         soapbox
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            https://xoops.org/
 * @since           1.0.0
 */
// Admin
define('MI_SOAPBOX_NAME', 'Soapbox');
define('MI_SOAPBOX_DESC', 'This module is for doing following...');
//Menu
define('MI_SOAPBOX_ADMENU1', 'Home');
define('MI_SOAPBOX_ADMENU2', 'Column');
define('MI_SOAPBOX_ADMENU3', 'Article');
define('MI_SOAPBOX_ADMENU4', 'Votes');
define('MI_SOAPBOX_ADMENU5', 'Feedback');
define('MI_SOAPBOX_ADMENU6', 'Migrate');
define('MI_SOAPBOX_ADMENU7', 'About');
//Blocks
define('MI_SOAPBOX_SBCOLUMNS_BLOCK', 'Sbcolumns block');
define('MI_SOAPBOX_SBARTICLES_BLOCK', 'Sbarticles block');
//Config
define('MI_SOAPBOX_EDITOR_ADMIN', 'Editor: Admin');
define('MI_SOAPBOX_EDITOR_ADMIN_DESC', 'Select the Editor to use by the Admin');
define('MI_SOAPBOX_EDITOR_USER', 'Editor: User');
define('MI_SOAPBOX_EDITOR_USER_DESC', 'Select the Editor to use by the User');
define('MI_SOAPBOX_KEYWORDS', 'Keywords');
define('MI_SOAPBOX_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('MI_SOAPBOX_ADMINPAGER', 'Admin: records / page');
define('MI_SOAPBOX_ADMINPAGER_DESC', 'Admin: # of records shown per page');
define('MI_SOAPBOX_USERPAGER', 'User: records / page');
define('MI_SOAPBOX_USERPAGER_DESC', 'User: # of records shown per page');
define('MI_SOAPBOX_MAXSIZE', 'Max size');
define('MI_SOAPBOX_MAXSIZE_DESC', 'Set a number of max size uploads file in byte');
define('MI_SOAPBOX_MIMETYPES', 'Mime Types');
define('MI_SOAPBOX_MIMETYPES_DESC', 'Set the mime types selected');
define('MI_SOAPBOX_IDPAYPAL', 'Paypal ID');
define('MI_SOAPBOX_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('MI_SOAPBOX_ADVERTISE', 'Advertisement Code');
define('MI_SOAPBOX_ADVERTISE_DESC', 'Insert here the advertisement code');
define('MI_SOAPBOX_BOOKMARKS', 'Social Bookmarks');
define('MI_SOAPBOX_BOOKMARKS_DESC', 'Show Social Bookmarks in the form');
define('MI_SOAPBOX_FBCOMMENTS', 'Facebook comments');
define('MI_SOAPBOX_FBCOMMENTS_DESC', 'Allow Facebook comments in the form');
// Notifications
define('MI_SOAPBOX_GLOBAL_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWCATEGORY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWCATEGORY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEMODIFY_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEMODIFY_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEMODIFY_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEBROKEN_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEBROKEN_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEBROKEN_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_GLOBAL_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_FILESUBMIT_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_FILESUBMIT_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_FILESUBMIT_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NEWFILE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NEWFILE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NEWFILE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_CATEGORY_NEWFILE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_APPROVE_NOTIFY', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_APPROVE_NOTIFY_CAPTION', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_APPROVE_NOTIFY_DESC', 'Allow Facebook comments in the form');
define('MI_SOAPBOX_FILE_APPROVE_NOTIFY_SUBJECT', 'Allow Facebook comments in the form');

// Help
define('MI_SOAPBOX_DIRNAME', basename(dirname(dirname(__DIR__))));
define('MI_SOAPBOX_HELP_HEADER', __DIR__.'/help/helpheader.tpl');
define('MI_SOAPBOX_BACK_2_ADMIN', 'Back to Administration of ');
define('MI_SOAPBOX_OVERVIEW', 'Overview');
// The name of this module
//define('MI_SOAPBOX_NAME', 'YYYYY Module Name');


//define('MI_SOAPBOX_HELP_DIR', __DIR__);


//help multi-page
define('MI_SOAPBOX_DISCLAIMER', 'Disclaimer');
define('MI_SOAPBOX_LICENSE', 'License');
define('MI_SOAPBOX_SUPPORT', 'Support');
//define('MI_SOAPBOX_REQUIREMENTS', 'Requirements');
//define('MI_SOAPBOX_CREDITS', 'Credits');
//define('MI_SOAPBOX_HOWTO', 'How To');
//define('MI_SOAPBOX_UPDATE', 'Update');
//define('MI_SOAPBOX_INSTALL', 'Install');
//define('MI_SOAPBOX_HISTORY', 'History');
//define('MI_SOAPBOX_HELP1', 'YYYYY');
//define('MI_SOAPBOX_HELP2', 'YYYYY');
//define('MI_SOAPBOX_HELP3', 'YYYYY');
//define('MI_SOAPBOX_HELP4', 'YYYYY');
//define('MI_SOAPBOX_HELP5', 'YYYYY');
//define('MI_SOAPBOX_HELP6', 'YYYYY');

// Permissions Groups
define('MI_SOAPBOX_GROUPS', 'Groups access');
define('MI_SOAPBOX_GROUPS_DESC', 'Select general access permission for groups.');
define('MI_SOAPBOX_ADMINGROUPS', 'Admin Group Permissions');
define('MI_SOAPBOX_ADMINGROUPS_DESC', 'Which groups have access to tools and permissions page');

define('MI_SOAPBOX_SHOW_SAMPLE_BUTTON', 'Import Sample Button?');
define('MI_SOAPBOX_SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');

