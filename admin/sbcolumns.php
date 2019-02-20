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
        $adminObject->addItemButton(AM_SOAPBOX_SBCOLUMNS_LIST, 'sbcolumns.php', 'list');
        $adminObject->displayButton('left');

        $sbcolumnsObject = $sbcolumnsHandler->create();
        $form = $sbcolumnsObject->getForm();
        $form->display();
        break;

    case 'save':
        if ( !$GLOBALS['xoopsSecurity']->check() ) {
           redirect_header('sbcolumns.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('columnID', 0)) {
           $sbcolumnsObject = $sbcolumnsHandler->get(Request::getInt('columnID', 0));
        } else {
           $sbcolumnsObject = $sbcolumnsHandler->create();
        }
// Form save fields
        $sbcolumnsObject->setVar('author',  Request::getVar('author', ''));
        $sbcolumnsObject->setVar('name',  Request::getVar('name', ''));
        $sbcolumnsObject->setVar('description',  Request::getText('description', ''));
        $sbcolumnsObject->setVar('total',  Request::getVar('total', ''));
        $sbcolumnsObject->setVar('weight',  Request::getVar('weight', ''));

        require_once XOOPS_ROOT_PATH.'/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH.'/soapbox/images/';
        $uploader = new \XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'soapbox'),
                                                       xoops_getModuleOption('maxsize', 'soapbox'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['colimage']).'.'.$extension;

            $uploader->setPrefix('colimage_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $sbcolumnsObject->setVar('colimage', $uploader->getSavedFileName());
            }
        } else {
            $sbcolumnsObject->setVar('colimage',  Request::getVar('colimage', ''));
        }
        
        $sbcolumnsObject->setVar('created', date('Y-m-d H:i:s',strtotime($_REQUEST['created']['date']) + $_REQUEST['created']['time']));        
 //Permissions
//===============================================================

            $mid           = $GLOBALS['xoopsModule']->mid();
            /** @var \XoopsGroupPermHandler $grouppermHandler */
            $grouppermHandler =  xoops_getHandler('groupperm');
            $columnID   = Request::getInt('columnID', 0);

        /**
         * @param $myArray
         * @param $permissionGroup
         * @param $columnID
         * @param $grouppermHandler
         * @param $permissionName
         * @param $mid
         */
            function setPermissions($myArray, $permissionGroup, $columnID, $grouppermHandler, $permissionName, $mid)
            {
                $permissionArray = $myArray;
                if ($columnID > 0) {
                    $sql = 'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name` = '" . $permissionName
                        . "' AND `gperm_itemid`= $columnID;";
                    $GLOBALS['xoopsDB']->query($sql);
                }
                //admin
                $gperm = $grouppermHandler->create();
                $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
                $gperm->setVar('gperm_name', $permissionName);
                $gperm->setVar('gperm_modid', $mid);
                $gperm->setVar('gperm_itemid', $columnID);
                $grouppermHandler->insert($gperm);
                unset($gperm);
                //non-Admin groups
                if (is_array($permissionArray)) {
                    foreach ($permissionArray as $key => $cat_groupperm) {
                        if ($cat_groupperm > 0) {
                            $gperm = $grouppermHandler->create();
                            $gperm->setVar('gperm_groupid', $cat_groupperm);
                            $gperm->setVar('gperm_name', $permissionName);
                            $gperm->setVar('gperm_modid', $mid);
                            $gperm->setVar('gperm_itemid', $columnID);
                            $grouppermHandler->insert($gperm);
                            unset($gperm);
                        }
                    }
                } elseif ($permissionArray > 0) {
                    $gperm = $grouppermHandler->create();
                    $gperm->setVar('gperm_groupid', $permissionArray);
                    $gperm->setVar('gperm_name', $permissionName);
                    $gperm->setVar('gperm_modid', $mid);
                    $gperm->setVar('gperm_itemid', $columnID);
                    $grouppermHandler->insert($gperm);
                    unset($gperm);
                }
            }

            //setPermissions for View items
            $permissionGroup = 'groupsRead';
            $permissionName  = 'soapbox_view';
            $permissionArray = Request::getArray($permissionGroup, '');
            $permissionArray[] = XOOPS_GROUP_ADMIN;
            //setPermissions($permissionArray, $permissionGroup, $columnID, $grouppermHandler, $permissionName, $mid);
            $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);


            //setPermissions for Submit items
            $permissionGroup = 'groupsSubmit';
            $permissionName  = 'soapbox_submit';
            $permissionArray = Request::getArray($permissionGroup, '');
            $permissionArray[] = XOOPS_GROUP_ADMIN;
            //setPermissions($permissionArray, $permissionGroup, $columnID, $grouppermHandler, $permissionName, $mid);
            $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);

            //setPermissions for Approve items
            $permissionGroup = 'groupsModeration';
            $permissionName  = 'soapbox_approve';
            $permissionArray = Request::getArray($permissionGroup, '');
            $permissionArray[] = XOOPS_GROUP_ADMIN;
            //setPermissions($permissionArray, $permissionGroup, $columnID, $grouppermHandler, $permissionName, $mid);
            $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);

/*
            //Form soapbox_view
            $arr_soapbox_view = Request::getArray('cat_gperms_read');
            if ($columnID > 0) {
                $sql
                    =
                    'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name`='soapbox_view' AND `gperm_itemid`=$columnID;";
                $GLOBALS['xoopsDB']->query($sql);
            }
            //admin
            $gperm = $grouppermHandler->create();
            $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
            $gperm->setVar('gperm_name', 'soapbox_view');
            $gperm->setVar('gperm_modid', $mid);
            $gperm->setVar('gperm_itemid', $columnID);
            $grouppermHandler->insert($gperm);
            unset($gperm);
            if (is_array($arr_soapbox_view)) {
                foreach ($arr_soapbox_view as $key => $cat_groupperm) {
                    $gperm = $grouppermHandler->create();
                    $gperm->setVar('gperm_groupid', $cat_groupperm);
                    $gperm->setVar('gperm_name', 'soapbox_view');
                    $gperm->setVar('gperm_modid', $mid);
                    $gperm->setVar('gperm_itemid', $columnID);
                    $grouppermHandler->insert($gperm);
                    unset($gperm);
                }
            } else {
                $gperm = $grouppermHandler->create();
                $gperm->setVar('gperm_groupid', $arr_soapbox_view);
                $gperm->setVar('gperm_name', 'soapbox_view');
                $gperm->setVar('gperm_modid', $mid);
                $gperm->setVar('gperm_itemid', $columnID);
                $grouppermHandler->insert($gperm);
                unset($gperm);
            }
*/

//===============================================================

        if ($sbcolumnsHandler->insert($sbcolumnsObject)) {
           redirect_header('sbcolumns.php?op=list', 2, AM_SOAPBOX_FORMOK);
        }

        echo $sbcolumnsObject->getHtmlErrors();
        $form = $sbcolumnsObject->getForm();
        $form->display();
    break;

    case 'edit':
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBCOLUMNS, 'sbcolumns.php?op=new', 'add');
        $adminObject->addItemButton(AM_SOAPBOX_SBCOLUMNS_LIST, 'sbcolumns.php', 'list');
        $adminObject->displayButton('left');
        $sbcolumnsObject = $sbcolumnsHandler->get(Request::getString('columnID', ''));
        $form = $sbcolumnsObject->getForm();
        $form->display();
    break;

    case 'delete':
        $sbcolumnsObject = $sbcolumnsHandler->get(Request::getString('columnID', ''));
        if (1 == Request::getInt('ok', 0))  {
            if ( !$GLOBALS['xoopsSecurity']->check() ) {
                redirect_header('sbcolumns.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbcolumnsHandler->delete($sbcolumnsObject)) {
                redirect_header('sbcolumns.php', 3, AM_SOAPBOX_FORMDELOK);
            } else {
                echo $sbcolumnsObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'columnID' => Request::getString('columnID', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI','', 'SERVER'), sprintf(AM_SOAPBOX_FORMSUREDEL, $sbcolumnsObject->getVar('name')));
        }
    break;

    case 'clone':

        $id_field = Request::getString('columnID', '');

        if ($utility::cloneRecord('soapbox_sbcolumns', 'columnID', $id_field )) {
        redirect_header('sbcolumns.php', 3, AM_SOAPBOX_CLONED_OK);
        } else {
            redirect_header('sbcolumns.php', 3, AM_SOAPBOX_CLONED_FAILED);
        }

     break;    case 'list':
    default:
        $adminObject->addItemButton(AM_SOAPBOX_ADD_SBCOLUMNS, 'sbcolumns.php?op=new', 'add');
        $adminObject->displayButton('left');
        $start = Request::getInt('start', 0);
        $sbcolumnsPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('columnID ASC, name');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbcolumnsPaginationLimit);
        $criteria->setStart($start);
        $sbcolumnsTempRows = $sbcolumnsHandler->getCount();
        $sbcolumnsTempArray = $sbcolumnsHandler->getAll($criteria);
/*
//
// 
                    <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbcolumnsTempRows > $sbcolumnsPaginationLimit) {
            xoops_load('XoopsPageNav');

            $pagenav = new \XoopsPageNav($sbcolumnsTempRows, $sbcolumnsPaginationLimit, $start, 'start',
            'op=list' . '&sort=' . $sort . '&order=' . $order
            . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbcolumnsRows', $sbcolumnsTempRows);
         $sbcolumnsArray =[];

//    $fields = explode('|', columnID:tinyint:4::NOT NULL::primary:columnID|author:int:8::NOT NULL:::Author|name:varchar:255::NOT NULL:::Name|description:text:0::NOT NULL:::Description|total:int:11::NOT NULL:0::Total|weight:int:11::NOT NULL:1::Weight|colimage:varchar:255::NOT NULL:blank.png::Colimage|created:datetime:::NOT NULL:::Created);
//    $fieldsCount    = count($fields);

$criteria = new \CriteriaCompo();

//$criteria->setOrder('DESC');
$criteria->setSort($sort);
$criteria->setOrder($order);
$criteria->setLimit($sbcolumnsPaginationLimit);
$criteria->setStart($start);


$sbcolumnsCount = $sbcolumnsHandler->getCount($criteria);
$sbcolumnsTempArray = $sbcolumnsHandler->getAll($criteria);

//    for ($i = 0; $i < $fieldsCount; ++$i) {
 if ($sbcolumnsCount > 0) {
     foreach (array_keys($sbcolumnsTempArray) as $i) {


//        $field = explode(':', $fields[$i]);

$GLOBALS['xoopsTpl']->assign('selectorcolumnID', AM_SOAPBOX_SBCOLUMNS_COLUMNID);
 $sbcolumnsArray['columnID'] = $sbcolumnsTempArray[$i]->getVar('columnID');

$GLOBALS['xoopsTpl']->assign('selectorauthor', AM_SOAPBOX_SBCOLUMNS_AUTHOR);
 $sbcolumnsArray['author'] = $sbcolumnsTempArray[$i]->getVar('author');

$GLOBALS['xoopsTpl']->assign('selectorname', AM_SOAPBOX_SBCOLUMNS_NAME);
 $sbcolumnsArray['name'] = $sbcolumnsTempArray[$i]->getVar('name');

$GLOBALS['xoopsTpl']->assign('selectordescription', AM_SOAPBOX_SBCOLUMNS_DESCRIPTION);
 $sbcolumnsArray['description'] = $sbcolumnsTempArray[$i]->getVar('description');

$GLOBALS['xoopsTpl']->assign('selectortotal', AM_SOAPBOX_SBCOLUMNS_TOTAL);
 $sbcolumnsArray['total'] = $sbcolumnsTempArray[$i]->getVar('total');

$GLOBALS['xoopsTpl']->assign('selectorweight', AM_SOAPBOX_SBCOLUMNS_WEIGHT);
 $sbcolumnsArray['weight'] = $sbcolumnsTempArray[$i]->getVar('weight');

$GLOBALS['xoopsTpl']->assign('selectorcolimage', AM_SOAPBOX_SBCOLUMNS_COLIMAGE);
 $sbcolumnsArray['colimage'] = "<img src='" .$uploadUrl .  $sbcolumnsTempArray[$i]->getVar('colimage') . "' name='". 'name' ."' id=". 'id'." alt='' style='max-width:100px'>";

$GLOBALS['xoopsTpl']->assign('selectorcreated', AM_SOAPBOX_SBCOLUMNS_CREATED);
 $sbcolumnsArray['created'] = date(_DATESTRING, strtotime($sbcolumnsTempArray[$i]->getVar('created')));
            $sbcolumnsArray['edit_delete'] =
              "<a href='sbcolumns.php?op=edit&columnID=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbcolumns.php?op=delete&columnID=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbcolumns.php?op=clone&columnID=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='". _CLONE . "'></a>";


 $GLOBALS['xoopsTpl']->append_by_ref('sbcolumnsArrays', $sbcolumnsArray);
unset($sbcolumnsArray);
    }
unset($sbcolumnsTempArray);
    // Display Navigation
    if ($sbcolumnsCount > $sbcolumnsPaginationLimit) {
        xoops_load('XoopsPageNav');
        $pagenav = new \XoopsPageNav($sbcolumnsCount, $sbcolumnsPaginationLimit, $start, 'start',
        'op=list' . '&sort=' . $sort . '&order=' . $order
        . '');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }


//                     echo "<td class='center width5'>

//                    <a href='sbcolumns.php?op=edit&columnID=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
//                    <a href='sbcolumns.php?op=delete&columnID=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
//                    </td>";

//                echo "</tr>";

//            }

//            echo "</table><br><br>";

//        } else {

//            echo "<table width='100%' cellspacing='1' class='outer'>

//                    <tr>

 //                     <th class='center width5'>".AM_SOAPBOX_FORM_ACTION."XXX</th>
//                    </tr><tr><td class='errorMsg' colspan='9'>There are noXXX sbcolumns</td></tr>";
//            echo "</table><br><br>";

//-------------------------------------------

        echo $GLOBALS['xoopsTpl']->fetch(
            XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox_admin_sbcolumns.tpl'
        );
}

    
    break;
}
require __DIR__ . '/admin_footer.php';
