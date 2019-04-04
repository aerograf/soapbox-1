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
use Xmf\Module\Helper;
use XoopsModules\Soapbox;
use XoopsModules\Soapbox\Common;

require dirname(dirname(__DIR__)) . '/mainfile.php';

//require XOOPS_ROOT_PATH . '/header.php';

require __DIR__ . '/preloads/autoloader.php';
require __DIR__ . '/include/common.php';
$moduleDirName = basename(__DIR__);

$helper = Soapbox\Helper::getInstance();
$utility = new Soapbox\Utility();
$configurator = new Common\Configurator();
$copyright = $configurator->modCopyright;

$modulePath = XOOPS_ROOT_PATH. '/modules/'.$moduleDirName;
$db = \XoopsDatabaseFactory::getDatabaseConnection();


$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new \xos_opal_Theme();
}

$stylesheet = "modules/{$moduleDirName}/assets/css/style.css";
if (file_exists($GLOBALS['xoops']->path($stylesheet))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$stylesheet}"));
}
  /** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
  $sbcolumnsHandler = $helper->getHandler('Sbcolumns'); 
  /** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
  $sbarticlesHandler = $helper->getHandler('Sbarticles'); 
  /** @var \XoopsPersistableObjectHandler $sbvotedataHandler */
  $sbvotedataHandler = $helper->getHandler('Sbvotedata'); 

// Load language files
$helper->loadLanguage('blocks');
$helper->loadLanguage('common');
$helper->loadLanguage('main');
$helper->loadLanguage('modinfo');
