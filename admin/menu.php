<?php
/**
 *
 * Module: Soapbox
 * Version: v 1.5
 * Release Date: 23 August 2004
 * Author: hsalazar
 * Licence: GNU
 */

if (!isset($moduleDirName)) {
    $moduleDirName = basename(dirname(__DIR__));
}

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
//$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

$moduleHelper->loadLanguage('modinfo');

$adminmenu = array();

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_HOME,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png'
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX_ADMENU1,
    'link'  => 'admin/main.php',
    'icon'  => $pathIcon32 . '/manage.png'
);

//++$i;
//$adminmenu[$i]['title'] =  _MI_SOAPBOX_ADMENU2;
//$adminmenu[$i]['link']  = 'admin/column.php';
//$adminmenu[$i]['icon']  = $pathIcon32 . '/categoryadd.png';

//++$i;
//$adminmenu[$i]['title'] = _MI_SOAPBOX_ADMENU3;
//$adminmenu[$i]['link']  = 'admin/article.php';
//$adminmenu[$i]['icon']  = $pathIcon32 . '/add.png';

$adminmenu[] = array(
    'title' => _MI_SOAPBOX_SUBMITS,
    'link'  => 'admin/submissions.php',
    'icon'  => $pathIcon32 . '/button_ok.png'
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX_ADMENU4,
    'link'  => 'admin/permissions.php',
    'icon'  => $pathIcon32 . '/permissions.png'
);

$adminmenu[] = array(
    'title' => _AM_MODULEADMIN_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png'
);
