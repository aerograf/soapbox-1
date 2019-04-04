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
 * Class SbvotedataForm
 */
class SbvotedataForm extends \XoopsThemeForm
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

       $title = $this->targetObject->isNew() ? sprintf(AM_SOAPBOX_SBVOTEDATA_ADD) : sprintf(AM_SOAPBOX_SBVOTEDATA_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'),'post', true);
        $this->setExtra('enctype="multipart/form-data"');
        


        //include ID field, it's needed so the module knows if it is a new form or an edited form
        

        $hidden = new \XoopsFormHidden('ratingid', $this->targetObject->getVar('ratingid'));
        $this->addElement($hidden);
        unset($hidden);
        
// Ratingid
            $this->addElement(new \XoopsFormLabel(AM_SOAPBOX_SBVOTEDATA_RATINGID, $this->targetObject->getVar('ratingid'), 'ratingid' ));
            // Lid
        //$sbarticlesHandler = $this->helper->getHandler('Sbarticles');
         $db     = \XoopsDatabaseFactory::getDatabaseConnection();
         /** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
        $sbarticlesHandler = $this->helper->getHandler('Sbarticles');


        $sbarticles_id_select = new \XoopsFormSelect(AM_SOAPBOX_SBVOTEDATA_LID, 'lid', $this->targetObject->getVar('lid'));
        $sbarticles_id_select->addOptionArray($sbarticlesHandler->getList());
        $this->addElement($sbarticles_id_select, false);
        // Ratinguser
        $this->addElement(new \XoopsFormSelectUser(AM_SOAPBOX_SBVOTEDATA_RATINGUSER, 'ratinguser', false, $this->targetObject->getVar('ratinguser'), 1, false), false);
        // Rating
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBVOTEDATA_RATING, 'rating', 50, 255, $this->targetObject->getVar('rating')), false);
        // Ratinghostname
        $this->addElement(new \XoopsFormText(AM_SOAPBOX_SBVOTEDATA_RATINGHOSTNAME, 'ratinghostname', 50, 255, $this->targetObject->getVar('ratinghostname')), false);
        // Ratingtimestamp
        $this->addElement(new \XoopsFormDateTime(AM_SOAPBOX_SBVOTEDATA_RATINGTIMESTAMP, 'ratingtimestamp', '', strtotime($this->targetObject->getVar('ratingtimestamp'))));
                
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
