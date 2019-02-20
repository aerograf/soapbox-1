<?php namespace XoopsModules\Soapbox\Form;

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


require_once dirname(dirname(__DIR__)) . '/include/common.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
//$helper = Soapbox\Helper::getInstance();
$permHelper = new \Xmf\Module\Helper\Permission();

xoops_load('XoopsFormLoader');
/**
 * Class SbcolumnsForm
 */
class SbcolumnsForm extends \XoopsThemeForm
{
    public $targetObject;
    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
      //  global $helper;
      $this->helper = $target->helper;
      $this->targetObject = $target;

       $title = $this->targetObject->isNew() ? sprintf(AM_SOAPBOX_SBCOLUMNS_ADD) : sprintf(AM_SOAPBOX_SBCOLUMNS_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'),'post', true);
        $this->setExtra('enctype="multipart/form-data"');
        


        //include ID field, it's needed so the module knows if it is a new form or an edited form
        

        $hidden = new \XoopsFormHidden('columnID', $this->targetObject->getVar('columnID'));
        $this->addElement($hidden);
        unset($hidden);
        
// ColumnID
            $this->addElement(new \XoopsFormLabel(AM_SOAPBOX_SBCOLUMNS_COLUMNID, $this->targetObject->getVar('columnID'), 'columnID' ));
            // Author
        $this->addElement(new \XoopsFormSelectUser(AM_SOAPBOX_SBCOLUMNS_AUTHOR, 'author', false, $this->targetObject->getVar('author'), 1, false), false);
        // Name
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBCOLUMNS_NAME, 'name', 50, 255, $this->targetObject->getVar('name')), false);
        // Description
        if (class_exists('XoopsFormEditor')) {
        $editorOptions = [];
        $editorOptions['name'] = 'description';
        $editorOptions['value'] = $this->targetObject->getVar('description', 'e');
        $editorOptions['rows'] = 5;
        $editorOptions['cols'] = 40;
        $editorOptions['width'] = '100%';
        $editorOptions['height'] = '400px';
        //$editorOptions['editor'] = xoops_getModuleOption('soapbox_editor', 'soapbox');
        //$this->addElement( new \XoopsFormEditor(AM_SOAPBOX_SBCOLUMNS_DESCRIPTION, 'description', $editorOptions), false  );
        if ($this->helper->isUserAdmin()) {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBCOLUMNS_DESCRIPTION, $this->helper->getConfig('soapboxEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    } else {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBCOLUMNS_DESCRIPTION, $this->helper->getConfig('soapboxEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    }
} else {
    $descEditor = new \XoopsFormDhtmlTextArea(AM_SOAPBOX_SBCOLUMNS_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
}
$this->addElement($descEditor);
        // Total
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBCOLUMNS_TOTAL, 'total', 50, 255, $this->targetObject->getVar('total')), false);
        // Weight
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBCOLUMNS_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Colimage
        $colimage = $this->targetObject->getVar('colimage') ?: 'blank.png';

        $uploadDir = '/uploads/soapbox/images/';
        $imgtray = new \XoopsFormElementTray(AM_SOAPBOX_SBCOLUMNS_COLIMAGE,'<br>');
        $imgpath = sprintf(AM_SOAPBOX_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'colimage', $colimage);
        $imageArray = \XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $uploadDir );
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra( "onchange='showImgSelected(\"image_colimage\", \"colimage\", \"".$uploadDir.'", "", "'.XOOPS_URL."\")'" );
        $imgtray->addElement($imageselect);
        $imgtray->addElement( new \XoopsFormLabel( '', "<br><img src='".XOOPS_URL.'/'.$uploadDir.'/'.$colimage."' name='image_colimage' id='image_colimage' alt='' />" ) );
        $fileseltray = new \XoopsFormElementTray('','<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_SOAPBOX_FORMUPLOAD , 'colimage', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Created
        $this->addElement(new \XoopsFormDateTime(AM_SOAPBOX_SBCOLUMNS_CREATED, 'created', '', strtotime($this->targetObject->getVar('created'))));
                
        //permissions
        /** @var \XoopsMemberHandler $memberHandler */
        $memberHandler =  xoops_getHandler ('member');
        $groupList = $memberHandler->getGroupList();
        /** @var \XoopsGroupPermHandler $grouppermHandler */
        $grouppermHandler = xoops_getHandler ('groupperm');
        $fullList = array_keys ($groupList);

//========================================================================

      $mid           = $GLOBALS['xoopsModule']->mid();
        $groupIdAdmin   = 0;
        $groupNameAdmin = '';

        // create admin checkbox
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN == $groupId) {
                $groupIdAdmin   = $groupId;
                $groupNameAdmin = $groupName;
            }
        }

        $selectPermAdmin = new \XoopsFormCheckBox('', 'admin', XOOPS_GROUP_ADMIN);
        $selectPermAdmin->addOption($groupIdAdmin, $groupNameAdmin);
        $selectPermAdmin->setExtra("disabled='disabled'"); //comment it out, if you want to allow to remove permissions for the admin

        // ********************************************************
        // permission view items
        $cat_gperms_read     =  $grouppermHandler->getGroupIds('soapbox_view', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_read = $this->targetObject->isNew() ? '0' : $cat_gperms_read;

        $permsTray = new \XoopsFormElementTray(AM_SOAPBOX_PERMISSIONS_VIEW, '');

        $selectAllReadCheckbox = new \XoopsFormCheckBox('', 'adminbox1', 1);
        $selectAllReadCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllReadCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox1\" , \"groupsRead[]\");' ");
        $selectAllReadCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllReadCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_read', $arr_cat_gperms_read);
        //$selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $this->targetObject->getGroupsRead());
        $selectPerm = new \XoopsFormCheckBox('', 'groupsRead[]', $arr_cat_gperms_read);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission submit item
        $cat_gperms_create     = $grouppermHandler->getGroupIds('soapbox_submit', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_create = $this->targetObject->isNew() ? '0' : $cat_gperms_create;

        $permsTray = new \XoopsFormElementTray(AM_SOAPBOX_PERMISSIONS_SUBMIT, '');

        $selectAllSubmitCheckbox = new \XoopsFormCheckBox('', 'adminbox2', 1);
        $selectAllSubmitCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllSubmitCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox2\" , \"groupsSubmit[]\");' ");
        $selectAllSubmitCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllSubmitCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_create', $arr_cat_gperms_create);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsSubmit[]', $arr_cat_gperms_create);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission approve items
        $cat_gperms_admin     = $grouppermHandler->getGroupIds('soapbox_approve', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_admin = $this->targetObject->isNew() ? '0' : $cat_gperms_admin;

        $permsTray = new \XoopsFormElementTray(AM_SOAPBOX_PERMISSIONS_APPROVE, '');

        $selectAllModerateCheckbox = new \XoopsFormCheckBox('', 'adminbox3', 1);
        $selectAllModerateCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllModerateCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox3\" , \"groupsModeration[]\");' ");
        $selectAllModerateCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllModerateCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new \XoopsFormCheckBox('', 'cat_gperms_admin', $arr_cat_gperms_admin);
        $selectPerm = new \XoopsFormCheckBox('', 'groupsModeration[]', $arr_cat_gperms_admin);
        foreach ($groupList as $groupId => $groupName) {
            if (XOOPS_GROUP_ADMIN != $groupId && XOOPS_GROUP_ANONYMOUS  != $groupId) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

//=========================================================================        
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
