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

use Xmf\Request;

//Index
define('AM_SOAPBOX_STATISTICS', 'Soapbox statistics');
define('AM_SOAPBOX_THEREARE_COLUMN', "There are <span class='bold'>%s</span> Column in the database");
define('AM_SOAPBOX_THEREARE_ARTICLE', "There are <span class='bold'>%s</span> Article in the database");
define('AM_SOAPBOX_THEREARE_VOTES', "There are <span class='bold'>%s</span> Votes in the database");
//Buttons
define('AM_SOAPBOX_ADD_SBCOLUMNS', 'Add new Column');
define('AM_SOAPBOX_SBCOLUMNS_LIST', 'List of Column');
define('AM_SOAPBOX_ADD_SBARTICLES', 'Add new Article');
define('AM_SOAPBOX_SBARTICLES_LIST', 'List of Article');
define('AM_SOAPBOX_ADD_SBVOTEDATA', 'Add new Votes');
define('AM_SOAPBOX_SBVOTEDATA_LIST', 'List of Votes');
//General
define('AM_SOAPBOX_FORMOK', 'Registered successfull');
define('AM_SOAPBOX_FORMDELOK', 'Deleted successfull');
define('AM_SOAPBOX_FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('AM_SOAPBOX_FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('AM_SOAPBOX_FORMUPLOAD', 'Upload');
define('AM_SOAPBOX_FORMIMAGE_PATH', 'File presents in %s');
define('AM_SOAPBOX_FORM_ACTION', 'Action');
define('AM_SOAPBOX_SELECT', 'Select action for selected item(s)');
define('AM_SOAPBOX_SELECTED_DELETE', 'Delete selected item(s)');
define('AM_SOAPBOX_SELECTED_ACTIVATE', 'Activate selected item(s)');
define('AM_SOAPBOX_SELECTED_DEACTIVATE', 'De-activate selected item(s)');
define('AM_SOAPBOX_SELECTED_ERROR', 'You selected nothing to delete');
define('AM_SOAPBOX_CLONED_OK', 'Record cloned successfully');
define('AM_SOAPBOX_CLONED_FAILED', 'Cloning of the record has failed');

// Sbcolumns
define('AM_SOAPBOX_SBCOLUMNS_ADD', 'Add a sbcolumns');
define('AM_SOAPBOX_SBCOLUMNS_EDIT', 'Edit sbcolumns');
define('AM_SOAPBOX_SBCOLUMNS_DELETE', 'Delete sbcolumns');
define('AM_SOAPBOX_SBCOLUMNS_COLUMNID', 'columnID');
define('AM_SOAPBOX_SBCOLUMNS_AUTHOR', 'Author');
define('AM_SOAPBOX_SBCOLUMNS_NAME', 'Name');
define('AM_SOAPBOX_SBCOLUMNS_DESCRIPTION', 'Description');
define('AM_SOAPBOX_SBCOLUMNS_TOTAL', 'Total');
define('AM_SOAPBOX_SBCOLUMNS_WEIGHT', 'Weight');
define('AM_SOAPBOX_SBCOLUMNS_COLIMAGE', 'Colimage');
define('AM_SOAPBOX_SBCOLUMNS_CREATED', 'Created');
// Sbarticles
define('AM_SOAPBOX_SBARTICLES_ADD', 'Add a sbarticles');
define('AM_SOAPBOX_SBARTICLES_EDIT', 'Edit sbarticles');
define('AM_SOAPBOX_SBARTICLES_DELETE', 'Delete sbarticles');
define('AM_SOAPBOX_SBARTICLES_ARTICLEID', 'articleID');
define('AM_SOAPBOX_SBARTICLES_COLUMNID', 'ColumnID');
define('AM_SOAPBOX_SBARTICLES_HEADLINE', 'Headline');
define('AM_SOAPBOX_SBARTICLES_LEAD', 'Lead');
define('AM_SOAPBOX_SBARTICLES_BODYTEXT', 'Bodytext');
define('AM_SOAPBOX_SBARTICLES_TEASER', 'Teaser');
define('AM_SOAPBOX_SBARTICLES_UID', 'Uid');
define('AM_SOAPBOX_SBARTICLES_SUBMIT', 'Submit');
define('AM_SOAPBOX_SBARTICLES_DATESUB', 'Datesub');
define('AM_SOAPBOX_SBARTICLES_COUNTER', 'Counter');
define('AM_SOAPBOX_SBARTICLES_WEIGHT', 'Weight');
define('AM_SOAPBOX_SBARTICLES_HTML', 'Html');
define('AM_SOAPBOX_SBARTICLES_SMILEY', 'Smiley');
define('AM_SOAPBOX_SBARTICLES_XCODES', 'Xcodes');
define('AM_SOAPBOX_SBARTICLES_BREAKS', 'Breaks');
define('AM_SOAPBOX_SBARTICLES_BLOCK', 'Block');
define('AM_SOAPBOX_SBARTICLES_ARTIMAGE', 'Artimage');
define('AM_SOAPBOX_SBARTICLES_VOTES', 'Votes');
define('AM_SOAPBOX_SBARTICLES_RATING', 'Rating');
define('AM_SOAPBOX_SBARTICLES_COMMENTABLE', 'Commentable');
define('AM_SOAPBOX_SBARTICLES_OFFLINE', 'Offline');
define('AM_SOAPBOX_SBARTICLES_NOTIFYPUB', 'Notifypub');
// Sbvotedata
define('AM_SOAPBOX_SBVOTEDATA_ADD', 'Add a sbvotedata');
define('AM_SOAPBOX_SBVOTEDATA_EDIT', 'Edit sbvotedata');
define('AM_SOAPBOX_SBVOTEDATA_DELETE', 'Delete sbvotedata');
define('AM_SOAPBOX_SBVOTEDATA_RATINGID', 'ratingid');
define('AM_SOAPBOX_SBVOTEDATA_LID', 'Lid');
define('AM_SOAPBOX_SBVOTEDATA_RATINGUSER', 'Ratinguser');
define('AM_SOAPBOX_SBVOTEDATA_RATING', 'Rating');
define('AM_SOAPBOX_SBVOTEDATA_RATINGHOSTNAME', 'Ratinghostname');
define('AM_SOAPBOX_SBVOTEDATA_RATINGTIMESTAMP', 'Ratingtimestamp');
//Blocks.php
//Permissions
define('AM_SOAPBOX_PERMISSIONS_GLOBAL', 'Global permissions');
define('AM_SOAPBOX_PERMISSIONS_GLOBAL_DESC', 'Only users in the group that you select may global this');
define('AM_SOAPBOX_PERMISSIONS_GLOBAL_4', 'Rate from user');
define('AM_SOAPBOX_PERMISSIONS_GLOBAL_8', 'Submit from user side');
define('AM_SOAPBOX_PERMISSIONS_GLOBAL_16', 'Auto approve');
define('AM_SOAPBOX_PERMISSIONS_APPROVE', 'Permissions to approve');
define('AM_SOAPBOX_PERMISSIONS_APPROVE_DESC', 'Only users in the group that you select may approve this');
define('AM_SOAPBOX_PERMISSIONS_VIEW', 'Permissions to view');
define('AM_SOAPBOX_PERMISSIONS_VIEW_DESC', 'Only users in the group that you select may view this');
define('AM_SOAPBOX_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('AM_SOAPBOX_PERMISSIONS_SUBMIT_DESC', 'Only users in the group that you select may submit this');
define('AM_SOAPBOX_PERMISSIONS_GPERMUPDATED', 'Permissions have been changed successfully');
define('AM_SOAPBOX_PERMISSIONS_NOPERMSSET', 'Permission cannot be set: No sbvotedata created yet! Please create a sbvotedata first.');

//Errors
define('AM_SOAPBOX_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('AM_SOAPBOX_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('AM_SOAPBOX_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('AM_SOAPBOX_ERROR_COLUMN', 'Could not create column in database : %s');
define('AM_SOAPBOX_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('AM_SOAPBOX_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('AM_SOAPBOX_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
//directories
define('AM_SOAPBOX_AVAILABLE', "<span style='color : #008000;'>Available. </span>");
define('AM_SOAPBOX_NOTAVAILABLE', "<span style='color : #ff0000;'>is not available. </span>");
define('AM_SOAPBOX_NOTWRITABLE', "<span style='color : #ff0000;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>');
define('AM_SOAPBOX_CREATETHEDIR', 'Create it');
define('AM_SOAPBOX_SETMPERM', 'Set the permission');
define('AM_SOAPBOX_DIRCREATED', 'The directory has been created');
define('AM_SOAPBOX_DIRNOTCREATED', 'The directory can not be created');
define('AM_SOAPBOX_PERMSET', 'The permission has been set');
define('AM_SOAPBOX_PERMNOTSET', 'The permission can not be set');
define('AM_SOAPBOX_VIDEO_EXPIREWARNING', 'The publishing date is after expiration date!!!');
//Sample Data
define('AM_SOAPBOX_ADD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
define('AM_SOAPBOX_SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');

//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', 'Error: You don&#39;t use the Frameworks \'admin module\'. Please install this Frameworks');
define('AM_SOAPBOX_MAINTAINEDBY', 'is maintained by the');
