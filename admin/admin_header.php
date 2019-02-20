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
use XoopsModules\Soapbox;



require  dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require  dirname(dirname(dirname(__DIR__))) . '/class/xoopsformloader.php';

require  dirname(__DIR__) . '/include/common.php';


require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var \XoopsModules\Soapbox\Helper $helper */
$helper = \XoopsModules\Soapbox\Helper::getInstance();
/** @var Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();


$db      = \XoopsDatabaseFactory::getDatabaseConnection();

$pathIcon16      = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32      = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

/** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler  = $helper->getHandler('Sbcolumns'); 
/** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
$sbarticlesHandler  = $helper->getHandler('Sbarticles'); 
/** @var \XoopsPersistableObjectHandler $sbvotedataHandler */
$sbvotedataHandler  = $helper->getHandler('Sbvotedata'); 


$myts = \MyTextSanitizer::getInstance();
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');

//xoops_cp_header();
