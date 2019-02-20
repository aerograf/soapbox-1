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
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbvotedata.tpl';
} else {
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbvotedata_list0.tpl';
}

require_once XOOPS_ROOT_PATH . '/header.php';

$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet( $stylesheet );

$db      = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $sbvotedataHandler */
$sbvotedataHandler  = $helper->getHandler('Sbvotedata');

$sbvotedataPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbvotedataPaginationLimit);
$criteria->setStart($start);


$sbvotedataCount = $sbvotedataHandler->getCount($criteria);
$sbvotedataArray = $sbvotedataHandler->getAll($criteria);

$ratingid = Request::getInt('ratingid', 0, 'GET');

switch ($op) {
    case 'view':
//        viewItem();
        $sbvotedataPaginationLimit                  = 1;
        $myid                 = $ratingid ;
        //ratingid
        $sbvotedataObject = $sbvotedataHandler->get($myid);

 $criteria               = new \CriteriaCompo();
$criteria->setSort('ratingid');
$criteria->setOrder('DESC');
$criteria->setLimit($sbvotedataPaginationLimit);
$criteria->setStart($start);
        $sbvotedata['ratingid'] = $sbvotedataObject->getVar('ratingid');
/** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
$sbarticlesHandler  = $helper->getHandler('Sbarticles');
        
 $sbvotedata['lid'] = $sbarticlesHandler->get($sbvotedataObject->getVar('lid'))->getVar('headline');
        $sbvotedata['ratinguser'] = $sbvotedataObject->getVar('ratinguser');
        $sbvotedata['rating'] = $sbvotedataObject->getVar('rating');
        $sbvotedata['ratinghostname'] = $sbvotedataObject->getVar('ratinghostname');        
 $sbvotedata['ratingtimestamp'] = date(_SHORTDATESTRING, strtotime($sbvotedataObject->getVar('ratingtimestamp')));

 //       $GLOBALS['xoopsTpl']->append('sbvotedata', $sbvotedata);
        $keywords[] = $sbvotedataObject->getVar('ratingid');

        $GLOBALS['xoopsTpl']->assign('sbvotedata', $sbvotedata);
        $start = $ratingid;

        // Display Navigation
        if ($sbvotedataCount >  $sbvotedataPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbvotedata.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($sbvotedataCount, $sbvotedataPaginationLimit, $start, 'op=view&ratingid');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();


if ($sbvotedataCount > 0) {
    foreach (array_keys($sbvotedataArray) as $i) {
        $sbvotedata['ratingid'] = $sbvotedataArray[$i]->getVar('ratingid');
/** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
$sbarticlesHandler  = $helper->getHandler('Sbarticles');
        
 $sbvotedata['lid'] = $sbarticlesHandler->get($sbvotedataArray[$i]->getVar('lid'))->getVar('headline');
        $sbvotedata['ratinguser'] = $sbvotedataArray[$i]->getVar('ratinguser');
        $sbvotedata['rating'] = $sbvotedataArray[$i]->getVar('rating');
        $sbvotedata['ratinghostname'] = $sbvotedataArray[$i]->getVar('ratinghostname');        
 $sbvotedata['ratingtimestamp'] = date(_SHORTDATESTRING, strtotime($sbvotedataArray[$i]->getVar('ratingtimestamp')));
        $GLOBALS['xoopsTpl']->append('sbvotedata', $sbvotedata);
        $keywords[] = $sbvotedataArray[$i]->getVar('ratingid');
        unset($sbvotedata);
    }
    // Display Navigation
    if ($sbvotedataCount > $sbvotedataPaginationLimit) {
        $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', SOAPBOX_URL . '/sbvotedata.php');
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbvotedataCount, $sbvotedataPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
  }
}

//keywords
if (isset($keywords)) {
$utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) .', '. implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_SOAPBOX_SBVOTEDATA_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbvotedata.php');
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
