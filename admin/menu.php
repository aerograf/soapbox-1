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

require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var \XoopsModules\Tdmdownloads\Helper $helper */
$helper = Soapbox\Helper::getInstance();
$helper->loadLanguage('common');

// get path to icons
$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
}

$adminObject = \Xmf\Module\Admin::getInstance();

$adminmenu[] = ['title' => MI_SOAPBOX_ADMENU1,
                          'link' => 'admin/index.php',
                          'icon' => "{$pathIcon32}/home.png"];

$adminmenu[] =  ['title' => MI_SOAPBOX_ADMENU2,
                          'link' => 'admin/sbcolumns.php',
                          'icon' => "{$pathIcon32}/category.png"];

$adminmenu[] =  ['title' => MI_SOAPBOX_ADMENU3,
                          'link' => 'admin/sbarticles.php',
                          'icon' => "{$pathIcon32}/folder_txt.png"];

$adminmenu[] =  ['title' => MI_SOAPBOX_ADMENU4,
                          'link' => 'admin/sbvotedata.php',
                          'icon' => "{$pathIcon32}/button_ok.png"];

$adminmenu[] = ['title' => MI_SOAPBOX_ADMENU5,
                          'link' => 'admin/feedback.php',
                          'icon' => "{$pathIcon32}/mail_foward.png"];


$adminmenu[] = ['title' => MI_SOAPBOX_ADMENU6,
                          'link' => 'admin/migrate.php',
                          'icon' => "{$pathIcon32}/database_go.png"];


$adminmenu[] = ['title' => MI_SOAPBOX_ADMENU7,
                          'link' => 'admin/about.php',
                          'icon' => "{$pathIcon32}/about.png"];
