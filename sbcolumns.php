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

require __DIR__ . '/header.php';

$op = Request::getCmd('op', 'list');

if ('view' === $op) {
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbcolumns.tpl';
} else {
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbcolumns_list0.tpl';
}

require_once XOOPS_ROOT_PATH . '/header.php';

$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet( $stylesheet );

$db      = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler  = $helper->getHandler('Sbcolumns');

$sbcolumnsPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbcolumnsPaginationLimit);
$criteria->setStart($start);


$sbcolumnsCount = $sbcolumnsHandler->getCount($criteria);
$sbcolumnsArray = $sbcolumnsHandler->getAll($criteria);

$columnID = Request::getInt('columnID', 0, 'GET');

switch ($op) {
    case 'view':
//        viewItem();
        $sbcolumnsPaginationLimit                  = 1;
        $myid                 = $columnID ;
        //columnID
        $sbcolumnsObject = $sbcolumnsHandler->get($myid);

 $criteria               = new \CriteriaCompo();
$criteria->setSort('columnID');
$criteria->setOrder('DESC');
$criteria->setLimit($sbcolumnsPaginationLimit);
$criteria->setStart($start);
        $sbcolumns['columnID'] = $sbcolumnsObject->getVar('columnID');
        $sbcolumns['author'] = $sbcolumnsObject->getVar('author');
        $sbcolumns['name'] = $sbcolumnsObject->getVar('name');
        $sbcolumns['description'] = $sbcolumnsObject->getVar('description');
        $sbcolumns['total'] = $sbcolumnsObject->getVar('total');
        $sbcolumns['weight'] = $sbcolumnsObject->getVar('weight');
        $sbcolumns['colimage'] = $sbcolumnsObject->getVar('colimage');        
 $sbcolumns['created'] = date(_SHORTDATESTRING, strtotime($sbcolumnsObject->getVar('created')));

 //       $GLOBALS['xoopsTpl']->append('sbcolumns', $sbcolumns);
        $keywords[] = $sbcolumnsObject->getVar('name');

        $GLOBALS['xoopsTpl']->assign('sbcolumns', $sbcolumns);
        $start = $columnID;

        // Display Navigation
        if ($sbcolumnsCount >  $sbcolumnsPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbcolumns.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($sbcolumnsCount, $sbcolumnsPaginationLimit, $start, 'op=view&columnID');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();


if ($sbcolumnsCount > 0) {
    foreach (array_keys($sbcolumnsArray) as $i) {
        $sbcolumns['columnID'] = $sbcolumnsArray[$i]->getVar('columnID');
        $sbcolumns['author'] = $sbcolumnsArray[$i]->getVar('author');
        $sbcolumns['name'] = $sbcolumnsArray[$i]->getVar('name');
        $sbcolumns['description'] = $sbcolumnsArray[$i]->getVar('description');
        $sbcolumns['total'] = $sbcolumnsArray[$i]->getVar('total');
        $sbcolumns['weight'] = $sbcolumnsArray[$i]->getVar('weight');
        $sbcolumns['colimage'] = $sbcolumnsArray[$i]->getVar('colimage');        
 $sbcolumns['created'] = date(_SHORTDATESTRING, strtotime($sbcolumnsArray[$i]->getVar('created')));
        $GLOBALS['xoopsTpl']->append('sbcolumns', $sbcolumns);
        $keywords[] = $sbcolumnsArray[$i]->getVar('name');
        unset($sbcolumns);
    }
    // Display Navigation
    if ($sbcolumnsCount > $sbcolumnsPaginationLimit) {
        $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', SOAPBOX_URL . '/sbcolumns.php');
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbcolumnsCount, $sbcolumnsPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
  }
}

//keywords
if (isset($keywords)) {
$utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) .', '. implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_SOAPBOX_SBCOLUMNS_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbcolumns.php');
$GLOBALS['xoopsTpl']->assign('soapbox_url', SOAPBOX_URL);
$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', $moduleDirName));
$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('admin', SOAPBOX_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
//
require XOOPS_ROOT_PATH . '/footer.php';
