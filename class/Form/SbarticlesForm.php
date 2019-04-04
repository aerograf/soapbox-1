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
 * Class SbarticlesForm
 */
class SbarticlesForm extends \XoopsThemeForm
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

       $title = $this->targetObject->isNew() ? sprintf(AM_SOAPBOX_SBARTICLES_ADD) : sprintf(AM_SOAPBOX_SBARTICLES_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'),'post', true);
        $this->setExtra('enctype="multipart/form-data"');
        


        //include ID field, it's needed so the module knows if it is a new form or an edited form
        

        $hidden = new \XoopsFormHidden('articleID', $this->targetObject->getVar('articleID'));
        $this->addElement($hidden);
        unset($hidden);
        
// ArticleID
            $this->addElement(new \XoopsFormLabel(AM_SOAPBOX_SBARTICLES_ARTICLEID, $this->targetObject->getVar('articleID'), 'articleID' ));
            // ColumnID
        //$sbcolumnsHandler = $this->helper->getHandler('Sbcolumns');
         $db     = \XoopsDatabaseFactory::getDatabaseConnection();
         /** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
        $sbcolumnsHandler = $this->helper->getHandler('Sbcolumns');


        $sbcolumns_id_select = new \XoopsFormSelect(AM_SOAPBOX_SBARTICLES_COLUMNID, 'columnID', $this->targetObject->getVar('columnID'));
        $sbcolumns_id_select->addOptionArray($sbcolumnsHandler->getList());
        $this->addElement($sbcolumns_id_select, false);
        // Headline
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_HEADLINE, 'headline', 50, 255, $this->targetObject->getVar('headline')), false);
        // Lead
        if (class_exists('XoopsFormEditor')) {
        $editorOptions = [];
        $editorOptions['name'] = 'lead';
        $editorOptions['value'] = $this->targetObject->getVar('lead', 'e');
        $editorOptions['rows'] = 5;
        $editorOptions['cols'] = 40;
        $editorOptions['width'] = '100%';
        $editorOptions['height'] = '400px';
        //$editorOptions['editor'] = xoops_getModuleOption('soapbox_editor', 'soapbox');
        //$this->addElement( new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_LEAD, 'lead', $editorOptions), false  );
        if ($this->helper->isUserAdmin()) {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_LEAD, $this->helper->getConfig('soapboxEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    } else {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_LEAD, $this->helper->getConfig('soapboxEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    }
} else {
    $descEditor = new \XoopsFormDhtmlTextArea(AM_SOAPBOX_SBARTICLES_LEAD, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
}
$this->addElement($descEditor);
        // Bodytext
        if (class_exists('XoopsFormEditor')) {
        $editorOptions = [];
        $editorOptions['name'] = 'bodytext';
        $editorOptions['value'] = $this->targetObject->getVar('bodytext', 'e');
        $editorOptions['rows'] = 5;
        $editorOptions['cols'] = 40;
        $editorOptions['width'] = '100%';
        $editorOptions['height'] = '400px';
        //$editorOptions['editor'] = xoops_getModuleOption('soapbox_editor', 'soapbox');
        //$this->addElement( new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_BODYTEXT, 'bodytext', $editorOptions), false  );
        if ($this->helper->isUserAdmin()) {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_BODYTEXT, $this->helper->getConfig('soapboxEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    } else {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_BODYTEXT, $this->helper->getConfig('soapboxEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    }
} else {
    $descEditor = new \XoopsFormDhtmlTextArea(AM_SOAPBOX_SBARTICLES_BODYTEXT, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
}
$this->addElement($descEditor);
        // Teaser
        if (class_exists('XoopsFormEditor')) {
        $editorOptions = [];
        $editorOptions['name'] = 'teaser';
        $editorOptions['value'] = $this->targetObject->getVar('teaser', 'e');
        $editorOptions['rows'] = 5;
        $editorOptions['cols'] = 40;
        $editorOptions['width'] = '100%';
        $editorOptions['height'] = '400px';
        //$editorOptions['editor'] = xoops_getModuleOption('soapbox_editor', 'soapbox');
        //$this->addElement( new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_TEASER, 'teaser', $editorOptions), false  );
        if ($this->helper->isUserAdmin()) {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_TEASER, $this->helper->getConfig('soapboxEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    } else {
        $descEditor = new \XoopsFormEditor(AM_SOAPBOX_SBARTICLES_TEASER, $this->helper->getConfig('soapboxEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
    }
} else {
    $descEditor = new \XoopsFormDhtmlTextArea(AM_SOAPBOX_SBARTICLES_TEASER, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
}
$this->addElement($descEditor);
        // Uid
        $this->addElement(new \XoopsFormSelectUser(AM_SOAPBOX_SBARTICLES_UID, 'uid', false, $this->targetObject->getVar('uid'), 1, false), false);
        // Submit
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_SUBMIT, 'submit', 50, 255, $this->targetObject->getVar('submit')), false);
        // Datesub
        $this->addElement(new \XoopsFormDateTime(AM_SOAPBOX_SBARTICLES_DATESUB, 'datesub', '', strtotime($this->targetObject->getVar('datesub'))));
        // Counter
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_COUNTER, 'counter', 50, 255, $this->targetObject->getVar('counter')), false);
        // Weight
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Html
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_HTML, 'html', 50, 255, $this->targetObject->getVar('html')), false);
        // Smiley
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_SMILEY, 'smiley', 50, 255, $this->targetObject->getVar('smiley')), false);
        // Xcodes
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_XCODES, 'xcodes', 50, 255, $this->targetObject->getVar('xcodes')), false);
        // Breaks
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_BREAKS, 'breaks', 50, 255, $this->targetObject->getVar('breaks')), false);
        // Block
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_BLOCK, 'block', 50, 255, $this->targetObject->getVar('block')), false);
        // Artimage
        $artimage = $this->targetObject->getVar('artimage') ?: 'blank.png';

        $uploadDir = '/uploads/soapbox/images/';
        $imgtray = new \XoopsFormElementTray(AM_SOAPBOX_SBARTICLES_ARTIMAGE,'<br>');
        $imgpath = sprintf(AM_SOAPBOX_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'artimage', $artimage);
        $imageArray = \XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $uploadDir );
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra( "onchange='showImgSelected(\"image_artimage\", \"artimage\", \"".$uploadDir.'", "", "'.XOOPS_URL."\")'" );
        $imgtray->addElement($imageselect);
        $imgtray->addElement( new \XoopsFormLabel( '', "<br><img src='".XOOPS_URL.'/'.$uploadDir.'/'.$artimage."' name='image_artimage' id='image_artimage' alt='' />" ) );
        $fileseltray = new \XoopsFormElementTray('','<br>');
        $fileseltray->addElement(new \XoopsFormFile(AM_SOAPBOX_FORMUPLOAD , 'artimage', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Votes
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_VOTES, 'votes', 50, 255, $this->targetObject->getVar('votes')), false);
        // Rating
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_RATING, 'rating', 50, 255, $this->targetObject->getVar('rating')), false);
        // Commentable
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_COMMENTABLE, 'commentable', 50, 255, $this->targetObject->getVar('commentable')), false);
        // Offline
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_OFFLINE, 'offline', 50, 255, $this->targetObject->getVar('offline')), false);
        // Notifypub
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBARTICLES_NOTIFYPUB, 'notifypub', 50, 255, $this->targetObject->getVar('notifypub')), false);
                
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
