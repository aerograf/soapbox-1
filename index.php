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

use XoopsModules\Soapbox;



$GLOBALS['xoopsOption']['template_main'] = 'soapbox_index.tpl';
require __DIR__ . '/header.php';
require XOOPS_ROOT_PATH.'/header.php';
//require __DIR__ . '/include/config.php';
// Define Stylesheet
$xoTheme->addStylesheet( $stylesheet );
// keywords
$utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName));
// description
$utility::metaDescription(MD_SOAPBOX_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL.'/index.php');
$GLOBALS['xoopsTpl']->assign('soapbox_url',  SOAPBOX_URL);
$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', $moduleDirName));
$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('admin', SOAPBOX_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
//
require XOOPS_ROOT_PATH.'/footer.php';
