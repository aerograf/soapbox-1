<?php
/**
 *
 * Module: Soapbox
 * Author: hsalazar
 * Licence: GNU
 */
// defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

require_once __DIR__ . '/preloads/autoloader.php';

$modversion['version']             = 1.70;
$modversion['module_status']       = 'Beta 1';
$modversion['release_date']        = '2017/05/23';
$modversion['description']         = _MI_SOAPBOX_DESC;
$modversion['name']                = _MI_SOAPBOX_NAME;
$modversion['author']              = 'hsalazar, domifara';
$modversion['credits']             = 'Catzwolf';
$modversion['license']             = 'GNU GPL 2.0';
$modversion['license_url']         = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['help']                = 'page=help';
$modversion['official']            = 0; //1 indicates supported by Xoops CORE Dev Team, 0 means 3rd party supported
$modversion['image']               = 'assets/images/logoModule.png';
$modversion['dirname']             = basename(__DIR__);
$modversion['author_realname']     = 'Horacio Salazar, domifara';
$modversion['author_website_url']  = 'http://www.anacronista.com, http://domifara.lolipop.jp/xo/';
$modversion['author_website_name'] = 'Anacronista, DomifaraOOP';
$modversion['author_email']        = 'hsalazar@xoops.org';
$modversion['warning']             = _MI_SOAPBOX_WARNING;
$modversion['author_word']         = _MI_SOAPBOX_AUTHORMSG;
//$modversion['dirmoduleadmin']      = 'Frameworks/moduleclasses/moduleadmin';
//$modversion['sysicons16']          = 'Frameworks/moduleclasses/icons/16';
//$modversion['sysicons32']          = 'Frameworks/moduleclasses/icons/32';
$modversion['modicons16']          = 'assets/images/icons/16';
$modversion['modicons32']          = 'assets/images/icons/32';
$modversion['release_file']        = XOOPS_URL . '/modules/' . $modversion['dirname'] . '/docs/changelog.txt';
$modversion['demo_site_url']       = '';
$modversion['demo_site_name']      = '';
$modversion['module_website_url']  = 'https://xoops.org';
$modversion['module_website_name'] = 'XOOPS';
$modversion['release']             = '0';
$modversion['min_php']             = '5.5';
$modversion['min_xoops']           = '2.5.9';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = ['mysql' => '5.5'];

// Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'sbcolumns';
$modversion['tables'][1] = 'sbarticles';
$modversion['tables'][2] = 'sbvotedata';

// Search
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'sb_search';

// Menu
$modversion['hasMain'] = 1;

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_SOAPBOX_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_SOAPBOX_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_SOAPBOX_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_SOAPBOX_SUPPORT, 'link' => 'page=support'],
];
//Install/Uninstall Functions
$modversion['onInstall']   = 'include/oninstall.php';
$modversion['onUpdate']    = 'include/onupdate.php';
$modversion['onUninstall'] = 'include/onuninstall.php';

global $xoopsDB, $xoopsUser;
$hModule = xoops_getHandler('module');
$i       = 0;
if ($soapModule = $hModule->getByDirname('soapbox')) {
    $gpermHandler = xoops_getHandler('groupperm');
    $hModConfig   = xoops_getHandler('config');

    $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;

    if (is_object($xoopsUser)) {
        $user  = $xoopsUser->getVar('uid');
        $query = $xoopsDB->query('SELECT author FROM ' . $xoopsDB->prefix('sbcolumns') . ' WHERE author = ' . $xoopsUser->getVar('uid'));
        if ($query) {
            $isauthor = $xoopsDB->getRowsNum($query);
            if ($isauthor >= 1 || $xoopsUser->isAdmin($soapModule->getVar('mid'))) {
                ++$i;
                $modversion['sub'][$i]['name'] = _MI_SOAPBOX_SUB_SMNAME1;
                $modversion['sub'][$i]['url']  = 'submit.php?op=add';
            }
        }
    }
    unset($isauthor);
    $module_id  = $soapModule->getVar('mid');
    $soapConfig = $hModConfig->getConfigsByCat(0, $soapModule->getVar('mid'));
    if (is_object($xoopsUser) && isset($soapConfig['colsinmenu']) && 1 === $soapConfig['colsinmenu']) {
        $sql = $xoopsDB->query('SELECT columnID, name FROM ' . $xoopsDB->prefix('sbcolumns') . '  ORDER BY weight');
        if ($sql) {
            while (list($columnID, $name) = $xoopsDB->fetchRow($sql)) {
                if ($gpermHandler->checkRight('Column Permissions', $columnID, $groups, $module_id)) {
                    ++$i;
                    $modversion['sub'][$i]['name'] = $name;
                    $modversion['sub'][$i]['url']  = 'column.php?columnID=' . $columnID . '';
                }
            }
        }
    }
}

$i                                       = 0;
$modversion['blocks'][$i]['file']        = 'arts_rated.php';
$modversion['blocks'][$i]['name']        = _MI_SOAPBOX_ARTSRATED;
$modversion['blocks'][$i]['description'] = _MI_SOAPBOX_ARTSRATED_DSC;
$modversion['blocks'][$i]['show_func']   = 'b_arts_rated';
$modversion['blocks'][$i]['edit_func']   = 'b_arts_rated_edit';
$modversion['blocks'][$i]['options']     = 'rating|5|65';
$modversion['blocks'][$i]['template']    = 'arts_rated.tpl';
$modversion['blocks'][$i]['can_clone']   = true;
++$i;
$modversion['blocks'][$i]['file']        = 'arts_new.php';
$modversion['blocks'][$i]['name']        = _MI_SOAPBOX_ARTSNEW;
$modversion['blocks'][$i]['description'] = _MI_SOAPBOX_ARTSNEW_DSC;
$modversion['blocks'][$i]['show_func']   = 'b_arts_new_show';
$modversion['blocks'][$i]['edit_func']   = 'b_arts_new_edit';
$modversion['blocks'][$i]['options']     = 'datesub|5|65';
$modversion['blocks'][$i]['template']    = 'arts_new.tpl';
$modversion['blocks'][$i]['can_clone']   = true;
++$i;
$modversion['blocks'][$i]['file']        = 'arts_top.php';
$modversion['blocks'][$i]['name']        = _MI_SOAPBOX_ARTSTOP;
$modversion['blocks'][$i]['description'] = _MI_SOAPBOX_ARTSTOP_DSC;
$modversion['blocks'][$i]['show_func']   = 'b_arts_top_show';
$modversion['blocks'][$i]['edit_func']   = 'b_arts_top_edit';
$modversion['blocks'][$i]['options']     = 'counter|5|65';
$modversion['blocks'][$i]['template']    = 'arts_top.tpl';
$modversion['blocks'][$i]['can_clone']   = true;
++$i;
$modversion['blocks'][$i]['file']        = 'arts_spot.php';
$modversion['blocks'][$i]['name']        = _MI_SOAPBOX_ARTSPOTLIGHT;
$modversion['blocks'][$i]['description'] = _MI_SOAPBOX_ARTSPOTLIGHT_DSC;
$modversion['blocks'][$i]['show_func']   = 'b_arts_spot_show';
$modversion['blocks'][$i]['edit_func']   = 'b_arts_spot_edit';
$modversion['blocks'][$i]['options']     = '1|5|1|1|1|ver|1|datesub|65|0';
$modversion['blocks'][$i]['template']    = 'arts_spot.tpl';
$modversion['blocks'][$i]['can_clone']   = true;
++$i;
$modversion['blocks'][$i]['file']        = 'columns_spot.php';
$modversion['blocks'][$i]['name']        = _MI_SOAPBOX_ARTSPOTLIGHT2;
$modversion['blocks'][$i]['description'] = _MI_SOAPBOX_ARTSPOTLIGHT2_DSC;
$modversion['blocks'][$i]['show_func']   = 'b_columns_spot_show';
$modversion['blocks'][$i]['edit_func']   = 'b_columns_spot_edit';
$modversion['blocks'][$i]['options']     = '1|5|1|1|1|ver|1|datesub|65|0';
$modversion['blocks'][$i]['template']    = 'columns_spot.tpl';
$modversion['blocks'][$i]['can_clone']   = true;

// Templates
$modversion['templates'][1]['file']        = 'sb_column.tpl';
$modversion['templates'][1]['description'] = 'Display columns';
$modversion['templates'][2]['file']        = 'sb_index.tpl';
$modversion['templates'][2]['description'] = 'Display index';
$modversion['templates'][3]['file']        = 'sb_article.tpl';
$modversion['templates'][3]['description'] = 'Display article';

// Config Settings (only for modules that need config settings generated automatically)
$i                                       = 0;
$modversion['config'][$i]['name']        = 'allowsubmit';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_ALLOWSUBMIT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_ALLOWSUBMITDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'autoapprove';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_AUTOAPPROVE';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_AUTOAPPROVEDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
++$i;
$modversion['config'][$i]['name']        = 'adminhits';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_ALLOWADMINHITS';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_ALLOWADMINHITSDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
++$i;
$modversion['config'][$i]['name']        = 'perpage';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_PERPAGE';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_PERPAGEDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 5;
$modversion['config'][$i]['options']     = [
    '5'  => 5,
    '10' => 10,
    '15' => 15,
    '20' => 20,
    '25' => 25,
    '30' => 30,
    '50' => 50
];
++$i;
$modversion['config'][$i]['name']        = 'indexperpage';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_PERPAGEINDEX';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_PERPAGEINDEXDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 5;
$modversion['config'][$i]['options']     = [
    '5'  => 5,
    '10' => 10,
    '15' => 15,
    '20' => 20,
    '25' => 25,
    '30' => 30,
    '50' => 50
];
++$i;
$modversion['config'][$i]['name']        = 'sbimgdir';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_IMGDIR';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_IMGDIRDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'modules/soapbox/assets/images';
++$i;
$modversion['config'][$i]['name']        = 'sbuploaddir';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_UPLOADDIR';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_UPLOADDIRDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'modules/soapbox/assets/images/uploads';
++$i;
$modversion['config'][$i]['name']        = 'maximgwidth';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_IMGWIDTH';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_IMGWIDTHDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 800;
++$i;
$modversion['config'][$i]['name']        = 'maximgheight';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_IMGHEIGHT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_IMGHEIGHTDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 800;
++$i;
$modversion['config'][$i]['name']        = 'maxfilesize';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_MAXFILESIZE';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_MAXFILESIZEDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 250000;
++$i;
$modversion['config'][$i]['name']        = 'dateformat';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_DATEFORMAT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_DATEFORMATDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = _SHORTDATESTRING; //'d M Y';
++$i;
$modversion['config'][$i]['name']        = 'globaldisplaycomments';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_ALLOWCOMMENTS';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_ALLOWCOMMENTSDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'morearts';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_MOREARTS';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_MOREARTSDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 3;
$modversion['config'][$i]['options']     = ['3' => 3, '5' => 5, '10' => 10, '15' => 15, '20' => 20];
++$i;
$modversion['config'][$i]['name']        = 'colsinmenu';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_COLSINMENU';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_COLSINMENUDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;
++$i;
$modversion['config'][$i]['name']        = 'colsperindex';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_COLSPERINDEX';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_COLSPERINDEXDSC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 3;
$modversion['config'][$i]['options']     = [
    '3'  => 3,
    '5'  => 5,
    '10' => 10,
    '15' => 15,
    '20' => 20,
    '25' => 25,
    '30' => 30,
    '50' => 50
];
++$i;
$modversion['config'][$i]['name']        = 'includerating';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_ALLOWRATING';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_ALLOWRATINGDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 1;
++$i;
$modversion['config'][$i]['name']        = 'introtitle';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_INTROTIT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_INTROTITDSC';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = _MI_SOAPBOX_INTROTITDFLT;
++$i;
$modversion['config'][$i]['name']        = 'introtext';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_INTROTEXT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_INTROTEXTDSC';
$modversion['config'][$i]['formtype']    = 'textarea';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = _MI_SOAPBOX_INTROTEXTDFLT;
++$i;
$modversion['config'][$i]['name']        = 'buttonsadmin';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_BUTTSTXT';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_BUTTSTXTDSC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 0;

//$modversion['config'][] = array(
//    'name' => 'form_options',
//    'title' => '_MI_SOAPBOX_FORM_OPTIONS',
//    'description' => '_MI_SOAPBOX_FORM_OPTIONS_DESC',
//    'formtype' => 'select',
//    'valuetype' => 'text',
//    'options' => array(
//                    _MI_SOAPBOX_FORM_DHTML=>'dhtml',
//                    _MI_SOAPBOX_FORM_COMPACT=>'textarea',
//                    _MI_SOAPBOX_FORM_SPAW=>'spaw',
//                    _MI_SOAPBOX_FORM_HTMLAREA=>'htmlarea',
//                    _MI_SOAPBOX_FORM_KOIVI=>'koivi',
//                    _MI_SOAPBOX_FORM_TINYMCE=>'tinymce',
//                    _MI_SOAPBOX_FORM_FCK=>'fck'),
//    'default' =>'dhtml');

++$i;
$modversion['config'][$i]['name']        = 'form_options';
$modversion['config'][$i]['title']       = '_MI_SOAPBOX_FORM_OPTIONS';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_FORM_OPTIONS_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'dhtml';
xoops_load('xoopseditorhandler');
$editorHandler                       = XoopsEditorHandler::getInstance();
$modversion['config'][$i]['options'] = array_flip($editorHandler->getList());

// Теги
++$i;
$modversion['config'][$i]['name'] = 'usetag';
$modversion['config'][$i]['title'] = '_MI_SOAPBOX_USETAG';
$modversion['config'][$i]['description'] = '_MI_SOAPBOX_USETAGDSC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;

// Comments
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'articleID';
$modversion['comments']['pageName'] = 'article.php';

// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'sb_com_approve';
$modversion['comments']['callback']['update']  = 'sb_com_update';

// Notification
$modversion['hasNotification']                                = 1;
$modversion['notification']['lookup_file']                    = 'include/notification.inc.php';
$modversion['notification']['lookup_func']                    = 'sb_notify_iteminfo';
$i                                                            = 0;
$modversion['notification']['category'][$i]['name']           = 'global';
$modversion['notification']['category'][$i]['title']          = _MI_SOAPBOX_GLOBAL_NOTIFY;
$modversion['notification']['category'][$i]['description']    = _MI_SOAPBOX_GLOBAL_NOTIFYDSC;
$modversion['notification']['category'][$i]['subscribe_from'] = ['index.php', 'column.php', 'article.php'];
++$i;
$modversion['notification']['category'][$i]['name']           = 'column';
$modversion['notification']['category'][$i]['title']          = _MI_SOAPBOX_COLUMN_NOTIFY;
$modversion['notification']['category'][$i]['description']    = _MI_SOAPBOX_COLUMN_NOTIFYDSC;
$modversion['notification']['category'][$i]['subscribe_from'] = ['index.php'];
$modversion['notification']['category'][$i]['item_name']      = 'columnID';
$modversion['notification']['category'][$i]['allow_bookmark'] = 1;
++$i;
$modversion['notification']['category'][$i]['name']           = 'article';
$modversion['notification']['category'][$i]['title']          = _MI_SOAPBOX_ARTICLE_NOTIFY;
$modversion['notification']['category'][$i]['description']    = _MI_SOAPBOX_ARTICLE_NOTIFYDSC;
$modversion['notification']['category'][$i]['subscribe_from'] = 'article.php';
$modversion['notification']['category'][$i]['item_name']      = 'articleID';
$modversion['notification']['category'][$i]['allow_bookmark'] = 1;

$i                                                        = 0;
$modversion['notification']['event'][$i]['name']          = 'new_column';
$modversion['notification']['event'][$i]['category']      = 'global';
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_GLOBAL_NEWCOLUMN_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_GLOBAL_NEWCOLUMN_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_GLOBAL_NEWCOLUMN_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'global_newcolumn_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_GLOBAL_NEWCOLUMN_NOTIFYSBJ;
++$i;
$modversion['notification']['event'][$i]['name']          = 'article_submit';
$modversion['notification']['event'][$i]['category']      = 'global';
$modversion['notification']['event'][$i]['admin_only']    = 1;
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_GLOBAL_ARTICLESUBMIT_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_GLOBAL_ARTICLESUBMIT_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_GLOBAL_ARTICLESUBMIT_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'global_articlesubmit_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_GLOBAL_ARTICLESUBMIT_NOTIFYSBJ;
++$i;
$modversion['notification']['event'][$i]['name']          = 'new_article';
$modversion['notification']['event'][$i]['category']      = 'global';
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_GLOBAL_NEWARTICLE_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_GLOBAL_NEWARTICLE_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_GLOBAL_NEWARTICLE_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'global_newarticle_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_GLOBAL_NEWARTICLE_NOTIFYSBJ;
++$i;
$modversion['notification']['event'][$i]['name']          = 'article_submit';
$modversion['notification']['event'][$i]['category']      = 'column';
$modversion['notification']['event'][$i]['admin_only']    = 1;
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_COLUMN_ARTICLESUBMIT_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_COLUMN_ARTICLESUBMIT_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_COLUMN_ARTICLESUBMIT_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'column_articlesubmit_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_COLUMN_ARTICLESUBMIT_NOTIFYSBJ;
++$i;
$modversion['notification']['event'][$i]['name']          = 'new_article';
$modversion['notification']['event'][$i]['category']      = 'column';
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_COLUMN_NEWARTICLE_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_COLUMN_NEWARTICLE_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_COLUMN_NEWARTICLE_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'column_newarticle_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_COLUMN_NEWARTICLE_NOTIFYSBJ;
++$i;
$modversion['notification']['event'][$i]['name']          = 'approve';
$modversion['notification']['event'][$i]['category']      = 'article';
$modversion['notification']['event'][$i]['invisible']     = 1;
$modversion['notification']['event'][$i]['title']         = _MI_SOAPBOX_ARTICLE_APPROVE_NOTIFY;
$modversion['notification']['event'][$i]['caption']       = _MI_SOAPBOX_ARTICLE_APPROVE_NOTIFYCAP;
$modversion['notification']['event'][$i]['description']   = _MI_SOAPBOX_ARTICLE_APPROVE_NOTIFYDSC;
$modversion['notification']['event'][$i]['mail_template'] = 'article_approve_notify';
$modversion['notification']['event'][$i]['mail_subject']  = _MI_SOAPBOX_ARTICLE_APPROVE_NOTIFYSBJ;

// On Update
if (!empty($_POST['fct']) && !empty($_POST['op']) && !empty($_POST['diranme']) && 'modulesadmin' === $_POST['fct']
    && 'update_ok' === $_POST['op']
    && $_POST['dirname'] === $modversion['dirname']) {
    include __DIR__ . '/include/onupdate.inc.php';
}
