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
use XoopsModules\Soapbox\Common;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
//count "total Sbcolumns"
/** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
$totalSbcolumns = $sbcolumnsHandler->getCount();
//count "total Sbarticles"
/** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
$totalSbarticles = $sbarticlesHandler->getCount();
//count "total Sbvotedata"
/** @var \XoopsPersistableObjectHandler $sbvotedataHandler */
$totalSbvotedata = $sbvotedataHandler->getCount();
// InfoBox Statistics
$adminObject->addInfoBox(AM_SOAPBOX_STATISTICS);

// InfoBox sbcolumns
$adminObject->addInfoBoxLine(sprintf(AM_SOAPBOX_THEREARE_COLUMN, $totalSbcolumns));

// InfoBox sbarticles
$adminObject->addInfoBoxLine(sprintf(AM_SOAPBOX_THEREARE_ARTICLE, $totalSbarticles));

// InfoBox sbvotedata
$adminObject->addInfoBoxLine(sprintf(AM_SOAPBOX_THEREARE_VOTES, $totalSbvotedata));
// Render Index
$adminObject->displayNavigation(basename(__FILE__));


 //------------- Test Data ----------------------------

if ($helper->getConfig('displaySampleButton')) {
    xoops_loadLanguage('admin/modulesadmin', 'system');
    require __DIR__ . '/../testdata/index.php';

    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');

    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');

//    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');

    $adminObject->displayButton('left', '');
}

//------------- End Test Data ----------------------------

$adminObject->displayIndex();

echo $utility::getServerStats();

//codeDump(__FILE__);
require __DIR__ . '/admin_footer.php';
