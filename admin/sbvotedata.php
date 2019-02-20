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
        $adminObject->addItemButton(AM_SOAPBOX_SBVOTEDATA_LIST, 'sbvotedata.php', 'list');
        $adminObject->displayButton('left');

        $sbvotedataObject = $sbvotedataHandler->create();
        $form = $sbvotedataObject->getForm();
        $form->display();
        break;

    case 'save':
        if ( !$GLOBALS['xoopsSecurity']->check() ) {
           redirect_header('sbvotedata.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('ratingid', 0)) {
           $sbvotedataObject = $sbvotedataHandler->get(Request::getInt('ratingid', 0));
        } else {
           $sbvotedataObject = $sbvotedataHandler->create();
        }
// Form save fields
        $sbvotedataObject->setVar('lid',  Request::getVar('lid', ''));
        $sbvotedataObject->setVar('ratinguser',  Request::getVar('ratinguser', ''));
        $sbvotedataObject->setVar('rating',  Request::getVar('rating', ''));
        $sbvotedataObject->setVar('ratinghostname',  Request::getVar('ratinghostname', ''));
        $sbvotedataObject->setVar('ratingtimestamp', date('Y-m-d H:i:s',strtotime($_REQUEST['ratingtimestamp']['date']) + $_REQUEST['ratingtimestamp']['time']));
        if ($sbvotedataHandler->insert($sbvotedataObject)) {
           redirect_header('sbvotedata.php?op=list', 2, AM_SOAPBOX_FORMOK);
        }

        echo $sbvotedataObject->getHtmlErrors();
        $form = $sbvotedataObject->getForm();
        $form->display();
    break;

    case 'edit':
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBVOTEDATA, 'sbvotedata.php?op=new', 'add');
        $adminObject->addItemButton(AM_SOAPBOX_SBVOTEDATA_LIST, 'sbvotedata.php', 'list');
        $adminObject->displayButton('left');
        $sbvotedataObject = $sbvotedataHandler->get(Request::getString('ratingid', ''));
        $form = $sbvotedataObject->getForm();
        $form->display();
    break;

    case 'delete':
        $sbvotedataObject = $sbvotedataHandler->get(Request::getString('ratingid', ''));
        if (1 == Request::getInt('ok', 0))  {
            if ( !$GLOBALS['xoopsSecurity']->check() ) {
                redirect_header('sbvotedata.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbvotedataHandler->delete($sbvotedataObject)) {
                redirect_header('sbvotedata.php', 3, AM_SOAPBOX_FORMDELOK);
            } else {
                echo $sbvotedataObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'ratingid' => Request::getString('ratingid', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI','', 'SERVER'), sprintf(AM_SOAPBOX_FORMSUREDEL, $sbvotedataObject->getVar('ratingid')));
        }
    break;

    case 'clone':

        $id_field = Request::getString('ratingid', '');

        if ($utility::cloneRecord('soapbox_sbvotedata', 'ratingid', $id_field )) {
        redirect_header('sbvotedata.php', 3, AM_SOAPBOX_CLONED_OK);
        } else {
            redirect_header('sbvotedata.php', 3, AM_SOAPBOX_CLONED_FAILED);
        }

     break;    case 'list':
    default:
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBVOTEDATA, 'sbvotedata.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start = Request::getInt('start', 0);
        $sbvotedataPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('ratingid ASC, ratingid');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbvotedataPaginationLimit);
        $criteria->setStart($start);
        $sbvotedataTempRows = $sbvotedataHandler->getCount();
        $sbvotedataTempArray = $sbvotedataHandler->getAll($criteria);
/*
//
// 
                    <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbvotedataTempRows > $sbvotedataPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($sbvotedataTempRows, $sbvotedataPaginationLimit, $start, 'start',
            'op=list' . '&sort=' . $sort . '&order=' . $order
            . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbvotedataRows', $sbvotedataTempRows);
         $sbvotedataArray =[];

//    $fields = explode('|', ratingid:int:11:unsigned:NOT NULL::primary:ratingid|lid:int:11:unsigned:NOT NULL:0::Lid|ratinguser:int:11::NOT NULL:0::Ratinguser|rating:tinyint:3:unsigned:NOT NULL:0::Rating|ratinghostname:varchar:60::NOT NULL:::Ratinghostname|ratingtimestamp:timestamp:::NOT NULL:0::Ratingtimestamp);
//    $fieldsCount    = count($fields);

$criteria = new \CriteriaCompo();

//$criteria->setOrder('DESC');
$criteria->setSort($sort);
$criteria->setOrder($order);
$criteria->setLimit($sbvotedataPaginationLimit);
$criteria->setStart($start);


$sbvotedataCount = $sbvotedataHandler->getCount($criteria);
$sbvotedataTempArray = $sbvotedataHandler->getAll($criteria);

//    for ($i = 0; $i < $fieldsCount; ++$i) {
 if ($sbvotedataCount > 0) {
     foreach (array_keys($sbvotedataTempArray) as $i) {


//        $field = explode(':', $fields[$i]);

$GLOBALS['xoopsTpl']->assign('selectorratingid', AM_SOAPBOX_SBVOTEDATA_RATINGID);
 $sbvotedataArray['ratingid'] = $sbvotedataTempArray[$i]->getVar('ratingid');

$GLOBALS['xoopsTpl']->assign('selectorlid', AM_SOAPBOX_SBVOTEDATA_LID);
 $sbvotedataArray['lid'] = $sbarticlesHandler->get($sbvotedataTempArray[$i]->getVar('lid'))->getVar('headline');

$GLOBALS['xoopsTpl']->assign('selectorratinguser', AM_SOAPBOX_SBVOTEDATA_RATINGUSER);
 $sbvotedataArray['ratinguser'] = $sbvotedataTempArray[$i]->getVar('ratinguser');

$GLOBALS['xoopsTpl']->assign('selectorrating', AM_SOAPBOX_SBVOTEDATA_RATING);
 $sbvotedataArray['rating'] = $sbvotedataTempArray[$i]->getVar('rating');

$GLOBALS['xoopsTpl']->assign('selectorratinghostname', AM_SOAPBOX_SBVOTEDATA_RATINGHOSTNAME);
 $sbvotedataArray['ratinghostname'] = $sbvotedataTempArray[$i]->getVar('ratinghostname');

$GLOBALS['xoopsTpl']->assign('selectorratingtimestamp', AM_SOAPBOX_SBVOTEDATA_RATINGTIMESTAMP);
 $sbvotedataArray['ratingtimestamp'] = date(_DATESTRING, strtotime($sbvotedataTempArray[$i]->getVar('ratingtimestamp')));
            $sbvotedataArray['edit_delete'] =
              "<a href='sbvotedata.php?op=edit&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbvotedata.php?op=delete&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbvotedata.php?op=clone&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='". _CLONE . "'></a>";


 $GLOBALS['xoopsTpl']->append_by_ref('sbvotedataArrays', $sbvotedataArray);
unset($sbvotedataArray);
    }
unset($sbvotedataTempArray);
    // Display Navigation
    if ($sbvotedataCount > $sbvotedataPaginationLimit) {
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbvotedataCount, $sbvotedataPaginationLimit, $start, 'start',
        'op=list' . '&sort=' . $sort . '&order=' . $order
        . '');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }


//                     echo "<td class='center width5'>

//                    <a href='sbvotedata.php?op=edit&ratingid=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
//                    <a href='sbvotedata.php?op=delete&ratingid=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
//                    </td>";

//                echo "</tr>";

//            }

//            echo "</table><br><br>";

//        } else {

//            echo "<table width='100%' cellspacing='1' class='outer'>

//                    <tr>

 //                     <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."XXX</th>
//                    </tr><tr><td class='errorMsg' colspan='7'>There are noXXX sbvotedata</td></tr>";
//            echo "</table><br><br>";

//-------------------------------------------

        echo $GLOBALS['xoopsTpl']->fetch(
            XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox_admin_sbvotedata.tpl'
        );
}

    
    break;
}
require __DIR__ . '/admin_footer.php';
