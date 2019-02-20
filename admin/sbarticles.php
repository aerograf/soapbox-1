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

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
$order   = Request::getString('order', 'desc');
$sort     = Request::getString('sort', '');


$adminObject->displayNavigation(basename(__FILE__));
/** @var \Xmf\Module\Helper\Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir = XOOPS_UPLOAD_PATH . '/soapbox/images/';
$uploadUrl = XOOPS_UPLOAD_URL . '/soapbox/images/';

switch ($op) {    case 'new':
        $adminObject->addItemButton(AM_SOAPBOX_SBARTICLES_LIST, 'sbarticles.php', 'list');
        $adminObject->displayButton('left');

        $sbarticlesObject = $sbarticlesHandler->create();
        $form = $sbarticlesObject->getForm();
        $form->display();
        break;

    case 'save':
        if ( !$GLOBALS['xoopsSecurity']->check() ) {
           redirect_header('sbarticles.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('articleID', 0)) {
           $sbarticlesObject = $sbarticlesHandler->get(Request::getInt('articleID', 0));
        } else {
           $sbarticlesObject = $sbarticlesHandler->create();
        }
// Form save fields
        $sbarticlesObject->setVar('columnID',  Request::getVar('columnID', ''));
        $sbarticlesObject->setVar('headline',  Request::getVar('headline', ''));
        $sbarticlesObject->setVar('lead',  Request::getText('lead', ''));
        $sbarticlesObject->setVar('bodytext',  Request::getText('bodytext', ''));
        $sbarticlesObject->setVar('teaser',  Request::getText('teaser', ''));
        $sbarticlesObject->setVar('uid',  Request::getVar('uid', ''));
        $sbarticlesObject->setVar('submit',  Request::getVar('submit', ''));
        $sbarticlesObject->setVar('datesub', date('Y-m-d H:i:s',strtotime($_REQUEST['datesub']['date']) + $_REQUEST['datesub']['time']));
        $sbarticlesObject->setVar('counter',  Request::getVar('counter', ''));
        $sbarticlesObject->setVar('weight',  Request::getVar('weight', ''));
        $sbarticlesObject->setVar('html',  Request::getVar('html', ''));
        $sbarticlesObject->setVar('smiley',  Request::getVar('smiley', ''));
        $sbarticlesObject->setVar('xcodes',  Request::getVar('xcodes', ''));
        $sbarticlesObject->setVar('breaks',  Request::getVar('breaks', ''));
        $sbarticlesObject->setVar('block',  Request::getVar('block', ''));

        require_once XOOPS_ROOT_PATH.'/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH.'/soapbox/images/';
        $uploader = new \XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'soapbox'),
                                                       xoops_getModuleOption('maxsize', 'soapbox'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['artimage']).'.'.$extension;

            $uploader->setPrefix('artimage_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $sbarticlesObject->setVar('artimage', $uploader->getSavedFileName());
            }
        } else {
            $sbarticlesObject->setVar('artimage',  Request::getVar('artimage', ''));
        }
        
        $sbarticlesObject->setVar('votes',  Request::getVar('votes', ''));
        $sbarticlesObject->setVar('rating',  Request::getVar('rating', ''));
        $sbarticlesObject->setVar('commentable',  Request::getVar('commentable', ''));
        $sbarticlesObject->setVar('offline',  Request::getVar('offline', ''));
        $sbarticlesObject->setVar('notifypub',  Request::getVar('notifypub', ''));
        if ($sbarticlesHandler->insert($sbarticlesObject)) {
           redirect_header('sbarticles.php?op=list', 2, AM_SOAPBOX_FORMOK);
        }

        echo $sbarticlesObject->getHtmlErrors();
        $form = $sbarticlesObject->getForm();
        $form->display();
    break;

    case 'edit':
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBARTICLES, 'sbarticles.php?op=new', 'add');
        $adminObject->addItemButton(AM_SOAPBOX_SBARTICLES_LIST, 'sbarticles.php', 'list');
        $adminObject->displayButton('left');
        $sbarticlesObject = $sbarticlesHandler->get(Request::getString('articleID', ''));
        $form = $sbarticlesObject->getForm();
        $form->display();
    break;

    case 'delete':
        $sbarticlesObject = $sbarticlesHandler->get(Request::getString('articleID', ''));
        if (1 == Request::getInt('ok', 0))  {
            if ( !$GLOBALS['xoopsSecurity']->check() ) {
                redirect_header('sbarticles.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbarticlesHandler->delete($sbarticlesObject)) {
                redirect_header('sbarticles.php', 3, AM_SOAPBOX_FORMDELOK);
            } else {
                echo $sbarticlesObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'articleID' => Request::getString('articleID', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI','', 'SERVER'), sprintf(AM_SOAPBOX_FORMSUREDEL, $sbarticlesObject->getVar('headline')));
        }
    break;

    case 'clone':

        $id_field = Request::getString('articleID', '');

        if ($utility::cloneRecord('soapbox_sbarticles', 'articleID', $id_field )) {
        redirect_header('sbarticles.php', 3, AM_SOAPBOX_CLONED_OK);
        } else {
            redirect_header('sbarticles.php', 3, AM_SOAPBOX_CLONED_FAILED);
        }

     break;    case 'list':
    default:
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBARTICLES, 'sbarticles.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start = Request::getInt('start', 0);
        $sbarticlesPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('articleID ASC, headline');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbarticlesPaginationLimit);
        $criteria->setStart($start);
        $sbarticlesTempRows = $sbarticlesHandler->getCount();
        $sbarticlesTempArray = $sbarticlesHandler->getAll($criteria);
/*
//
// 
                    <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbarticlesTempRows > $sbarticlesPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($sbarticlesTempRows, $sbarticlesPaginationLimit, $start, 'start',
            'op=list' . '&sort=' . $sort . '&order=' . $order
            . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbarticlesRows', $sbarticlesTempRows);
         $sbarticlesArray =[];

//    $fields = explode('|', articleID:int:8::NOT NULL::primary:articleID|columnID:tinyint:4::NOT NULL:0::ColumnID|headline:varchar:255::NOT NULL:0::Headline|lead:text:0::NOT NULL:::Lead|bodytext:text:0::NOT NULL:::Bodytext|teaser:text:0::NOT NULL:::Teaser|uid:int:6::NULL:1::Uid|submit:int:1::NOT NULL:0::Submit|datesub:datetime:::NOT NULL:::Datesub|counter:int:8:unsigned:NOT NULL:0::Counter|weight:int:11::NOT NULL:1::Weight|html:int:11::NOT NULL:0::Html|smiley:int:11::NOT NULL:0::Smiley|xcodes:int:11::NOT NULL:0::Xcodes|breaks:int:11::NOT NULL:1::Breaks|block:int:11::NOT NULL:0::Block|artimage:varchar:255::NOT NULL:::Artimage|votes:int:11::NOT NULL:0::Votes|rating:double:6,4::NOT NULL:0.0000::Rating|commentable:int:11::NOT NULL:0::Commentable|offline:int:11::NOT NULL:0::Offline|notifypub:int:11::NOT NULL:0::Notifypub);
//    $fieldsCount    = count($fields);

$criteria = new \CriteriaCompo();

//$criteria->setOrder('DESC');
$criteria->setSort($sort);
$criteria->setOrder($order);
$criteria->setLimit($sbarticlesPaginationLimit);
$criteria->setStart($start);


$sbarticlesCount = $sbarticlesHandler->getCount($criteria);
$sbarticlesTempArray = $sbarticlesHandler->getAll($criteria);

//    for ($i = 0; $i < $fieldsCount; ++$i) {
 if ($sbarticlesCount > 0) {
     foreach (array_keys($sbarticlesTempArray) as $i) {


//        $field = explode(':', $fields[$i]);

$GLOBALS['xoopsTpl']->assign('selectorarticleID', AM_SOAPBOX_SBARTICLES_ARTICLEID);
 $sbarticlesArray['articleID'] = $sbarticlesTempArray[$i]->getVar('articleID');

$GLOBALS['xoopsTpl']->assign('selectorcolumnID', AM_SOAPBOX_SBARTICLES_COLUMNID);
 $sbarticlesArray['columnID'] = $sbcolumnsHandler->get($sbarticlesTempArray[$i]->getVar('columnID'))->getVar('name');

$GLOBALS['xoopsTpl']->assign('selectorheadline', AM_SOAPBOX_SBARTICLES_HEADLINE);
 $sbarticlesArray['headline'] = $sbarticlesTempArray[$i]->getVar('headline');

$GLOBALS['xoopsTpl']->assign('selectorlead', AM_SOAPBOX_SBARTICLES_LEAD);
 $sbarticlesArray['lead'] = $sbarticlesTempArray[$i]->getVar('lead');

$GLOBALS['xoopsTpl']->assign('selectorbodytext', AM_SOAPBOX_SBARTICLES_BODYTEXT);
 $sbarticlesArray['bodytext'] = $sbarticlesTempArray[$i]->getVar('bodytext');

$GLOBALS['xoopsTpl']->assign('selectorteaser', AM_SOAPBOX_SBARTICLES_TEASER);
 $sbarticlesArray['teaser'] = $sbarticlesTempArray[$i]->getVar('teaser');

$GLOBALS['xoopsTpl']->assign('selectoruid', AM_SOAPBOX_SBARTICLES_UID);
 $sbarticlesArray['uid'] = $sbarticlesTempArray[$i]->getVar('uid');

$GLOBALS['xoopsTpl']->assign('selectorsubmit', AM_SOAPBOX_SBARTICLES_SUBMIT);
 $sbarticlesArray['submit'] = $sbarticlesTempArray[$i]->getVar('submit');

$GLOBALS['xoopsTpl']->assign('selectordatesub', AM_SOAPBOX_SBARTICLES_DATESUB);
 $sbarticlesArray['datesub'] = date(_DATESTRING, strtotime($sbarticlesTempArray[$i]->getVar('datesub')));

$GLOBALS['xoopsTpl']->assign('selectorcounter', AM_SOAPBOX_SBARTICLES_COUNTER);
 $sbarticlesArray['counter'] = $sbarticlesTempArray[$i]->getVar('counter');

$GLOBALS['xoopsTpl']->assign('selectorweight', AM_SOAPBOX_SBARTICLES_WEIGHT);
 $sbarticlesArray['weight'] = $sbarticlesTempArray[$i]->getVar('weight');

$GLOBALS['xoopsTpl']->assign('selectorhtml', AM_SOAPBOX_SBARTICLES_HTML);
 $sbarticlesArray['html'] = $sbarticlesTempArray[$i]->getVar('html');

$GLOBALS['xoopsTpl']->assign('selectorsmiley', AM_SOAPBOX_SBARTICLES_SMILEY);
 $sbarticlesArray['smiley'] = $sbarticlesTempArray[$i]->getVar('smiley');

$GLOBALS['xoopsTpl']->assign('selectorxcodes', AM_SOAPBOX_SBARTICLES_XCODES);
 $sbarticlesArray['xcodes'] = $sbarticlesTempArray[$i]->getVar('xcodes');

$GLOBALS['xoopsTpl']->assign('selectorbreaks', AM_SOAPBOX_SBARTICLES_BREAKS);
 $sbarticlesArray['breaks'] = $sbarticlesTempArray[$i]->getVar('breaks');

$GLOBALS['xoopsTpl']->assign('selectorblock', AM_SOAPBOX_SBARTICLES_BLOCK);
 $sbarticlesArray['block'] = $sbarticlesTempArray[$i]->getVar('block');

$GLOBALS['xoopsTpl']->assign('selectorartimage', AM_SOAPBOX_SBARTICLES_ARTIMAGE);
 $sbarticlesArray['artimage'] = "<img src='" .$uploadUrl .  $sbarticlesTempArray[$i]->getVar('artimage') . "' name='". 'name' ."' id=". 'id'." alt='' style='max-width:100px'>";

$GLOBALS['xoopsTpl']->assign('selectorvotes', AM_SOAPBOX_SBARTICLES_VOTES);
 $sbarticlesArray['votes'] = $sbarticlesTempArray[$i]->getVar('votes');

$GLOBALS['xoopsTpl']->assign('selectorrating', AM_SOAPBOX_SBARTICLES_RATING);
 $sbarticlesArray['rating'] = $sbarticlesTempArray[$i]->getVar('rating');

$GLOBALS['xoopsTpl']->assign('selectorcommentable', AM_SOAPBOX_SBARTICLES_COMMENTABLE);
 $sbarticlesArray['commentable'] = $sbarticlesTempArray[$i]->getVar('commentable');

$GLOBALS['xoopsTpl']->assign('selectoroffline', AM_SOAPBOX_SBARTICLES_OFFLINE);
 $sbarticlesArray['offline'] = $sbarticlesTempArray[$i]->getVar('offline');

$GLOBALS['xoopsTpl']->assign('selectornotifypub', AM_SOAPBOX_SBARTICLES_NOTIFYPUB);
 $sbarticlesArray['notifypub'] = $sbarticlesTempArray[$i]->getVar('notifypub');
            $sbarticlesArray['edit_delete'] =
              "<a href='sbarticles.php?op=edit&articleID=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbarticles.php?op=delete&articleID=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbarticles.php?op=clone&articleID=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='". _CLONE . "'></a>";


 $GLOBALS['xoopsTpl']->append_by_ref('sbarticlesArrays', $sbarticlesArray);
unset($sbarticlesArray);
    }
unset($sbarticlesTempArray);
    // Display Navigation
    if ($sbarticlesCount > $sbarticlesPaginationLimit) {
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbarticlesCount, $sbarticlesPaginationLimit, $start, 'start',
        'op=list' . '&sort=' . $sort . '&order=' . $order
        . '');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }


//                     echo "<td class='center width5'>

//                    <a href='sbarticles.php?op=edit&articleID=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
//                    <a href='sbarticles.php?op=delete&articleID=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
//                    </td>";

//                echo "</tr>";

//            }

//            echo "</table><br><br>";

//        } else {

//            echo "<table width='100%' cellspacing='1' class='outer'>

//                    <tr>

 //                     <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."XXX</th>
//                    </tr><tr><td class='errorMsg' colspan='23'>There are noXXX sbarticles</td></tr>";
//            echo "</table><br><br>";

//-------------------------------------------

        echo $GLOBALS['xoopsTpl']->fetch(
            XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox_admin_sbarticles.tpl'
        );
}

    
    break;
}
require __DIR__ . '/admin_footer.php';
