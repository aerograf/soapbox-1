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
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbarticles.tpl';
} else {
   $GLOBALS['xoopsOption']['template_main'] = 'soapbox_sbarticles_list0.tpl';
}

require_once XOOPS_ROOT_PATH . '/header.php';

$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet( $stylesheet );

$db      = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
$sbarticlesHandler  = $helper->getHandler('Sbarticles');

$sbarticlesPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbarticlesPaginationLimit);
$criteria->setStart($start);


$sbarticlesCount = $sbarticlesHandler->getCount($criteria);
$sbarticlesArray = $sbarticlesHandler->getAll($criteria);

$articleID = Request::getInt('articleID', 0, 'GET');

switch ($op) {
    case 'view':
//        viewItem();
        $sbarticlesPaginationLimit                  = 1;
        $myid                 = $articleID ;
        //articleID
        $sbarticlesObject = $sbarticlesHandler->get($myid);

 $criteria               = new \CriteriaCompo();
$criteria->setSort('articleID');
$criteria->setOrder('DESC');
$criteria->setLimit($sbarticlesPaginationLimit);
$criteria->setStart($start);
        $sbarticles['articleID'] = $sbarticlesObject->getVar('articleID');
/** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler  = $helper->getHandler('Sbcolumns');
        
 $sbarticles['columnID'] = $sbcolumnsHandler->get($sbarticlesObject->getVar('columnID'))->getVar('name');
        $sbarticles['headline'] = $sbarticlesObject->getVar('headline');
        $sbarticles['lead'] = $sbarticlesObject->getVar('lead');
        $sbarticles['bodytext'] = $sbarticlesObject->getVar('bodytext');
        $sbarticles['teaser'] = $sbarticlesObject->getVar('teaser');
        $sbarticles['uid'] = $sbarticlesObject->getVar('uid');
        $sbarticles['submit'] = $sbarticlesObject->getVar('submit');        
 $sbarticles['datesub'] = date(_SHORTDATESTRING, strtotime($sbarticlesObject->getVar('datesub')));
        $sbarticles['counter'] = $sbarticlesObject->getVar('counter');
        $sbarticles['weight'] = $sbarticlesObject->getVar('weight');
        $sbarticles['html'] = $sbarticlesObject->getVar('html');
        $sbarticles['smiley'] = $sbarticlesObject->getVar('smiley');
        $sbarticles['xcodes'] = $sbarticlesObject->getVar('xcodes');
        $sbarticles['breaks'] = $sbarticlesObject->getVar('breaks');
        $sbarticles['block'] = $sbarticlesObject->getVar('block');
        $sbarticles['artimage'] = $sbarticlesObject->getVar('artimage');
        $sbarticles['votes'] = $sbarticlesObject->getVar('votes');
        $sbarticles['rating'] = $sbarticlesObject->getVar('rating');
        $sbarticles['commentable'] = $sbarticlesObject->getVar('commentable');
        $sbarticles['offline'] = $sbarticlesObject->getVar('offline');
        $sbarticles['notifypub'] = $sbarticlesObject->getVar('notifypub');

 //       $GLOBALS['xoopsTpl']->append('sbarticles', $sbarticles);
        $keywords[] = $sbarticlesObject->getVar('headline');

        $GLOBALS['xoopsTpl']->assign('sbarticles', $sbarticles);
        $start = $articleID;

        // Display Navigation
        if ($sbarticlesCount >  $sbarticlesPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbarticles.php');
            xoops_load('XoopsPageNav');
            $pagenav = new \XoopsPageNav($sbarticlesCount, $sbarticlesPaginationLimit, $start, 'op=view&articleID');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();


if ($sbarticlesCount > 0) {
    foreach (array_keys($sbarticlesArray) as $i) {
        $sbarticles['articleID'] = $sbarticlesArray[$i]->getVar('articleID');
/** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler  = $helper->getHandler('Sbcolumns');
        
 $sbarticles['columnID'] = $sbcolumnsHandler->get($sbarticlesArray[$i]->getVar('columnID'))->getVar('name');
        $sbarticles['headline'] = $sbarticlesArray[$i]->getVar('headline');
        $sbarticles['lead'] = $sbarticlesArray[$i]->getVar('lead');
        $sbarticles['bodytext'] = $sbarticlesArray[$i]->getVar('bodytext');
        $sbarticles['teaser'] = $sbarticlesArray[$i]->getVar('teaser');
        $sbarticles['uid'] = $sbarticlesArray[$i]->getVar('uid');
        $sbarticles['submit'] = $sbarticlesArray[$i]->getVar('submit');        
 $sbarticles['datesub'] = date(_SHORTDATESTRING, strtotime($sbarticlesArray[$i]->getVar('datesub')));
        $sbarticles['counter'] = $sbarticlesArray[$i]->getVar('counter');
        $sbarticles['weight'] = $sbarticlesArray[$i]->getVar('weight');
        $sbarticles['html'] = $sbarticlesArray[$i]->getVar('html');
        $sbarticles['smiley'] = $sbarticlesArray[$i]->getVar('smiley');
        $sbarticles['xcodes'] = $sbarticlesArray[$i]->getVar('xcodes');
        $sbarticles['breaks'] = $sbarticlesArray[$i]->getVar('breaks');
        $sbarticles['block'] = $sbarticlesArray[$i]->getVar('block');
        $sbarticles['artimage'] = $sbarticlesArray[$i]->getVar('artimage');
        $sbarticles['votes'] = $sbarticlesArray[$i]->getVar('votes');
        $sbarticles['rating'] = $sbarticlesArray[$i]->getVar('rating');
        $sbarticles['commentable'] = $sbarticlesArray[$i]->getVar('commentable');
        $sbarticles['offline'] = $sbarticlesArray[$i]->getVar('offline');
        $sbarticles['notifypub'] = $sbarticlesArray[$i]->getVar('notifypub');
        $GLOBALS['xoopsTpl']->append('sbarticles', $sbarticles);
        $keywords[] = $sbarticlesArray[$i]->getVar('headline');
        unset($sbarticles);
    }
    // Display Navigation
    if ($sbarticlesCount > $sbarticlesPaginationLimit) {
        $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', SOAPBOX_URL . '/sbarticles.php');
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbarticlesCount, $sbarticlesPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
  }
}

//keywords
if (isset($keywords)) {
$utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) .', '. implode(', ', $keywords));
}
//description
$utility::metaDescription(MD_SOAPBOX_SBARTICLES_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl',  SOAPBOX_URL . '/sbarticles.php');
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
