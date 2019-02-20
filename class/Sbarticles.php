<?php namespace XoopsModules\Soapbox;

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
use XoopsModules\Soapbox;
use XoopsModules\Soapbox\Form;

//$permHelper = new \Xmf\Module\Helper\Permission();


/**
 * Class Sbarticles
 */
class Sbarticles extends \XoopsObject
{
    public $helper, $permHelper;
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
//        /** @var  Soapbox\Helper $helper */
//        $this->helper = Soapbox\Helper::getInstance();
         $this->permHelper = new \Xmf\Module\Helper\Permission();

        $this->initVar('articleID', XOBJ_DTYPE_INT);
        $this->initVar('columnID', XOBJ_DTYPE_INT);
        $this->initVar('headline', XOBJ_DTYPE_TXTBOX);
        $this->initVar('lead', XOBJ_DTYPE_OTHER);
        $this->initVar('bodytext', XOBJ_DTYPE_OTHER);
        $this->initVar('teaser', XOBJ_DTYPE_OTHER);
        $this->initVar('uid', XOBJ_DTYPE_INT);
        $this->initVar('submit', XOBJ_DTYPE_INT);
                    $this->initVar('datesub', XOBJ_DTYPE_TIMESTAMP);
        $this->initVar('counter', XOBJ_DTYPE_INT);
        $this->initVar('weight', XOBJ_DTYPE_INT);
        $this->initVar('html', XOBJ_DTYPE_INT);
        $this->initVar('smiley', XOBJ_DTYPE_INT);
        $this->initVar('xcodes', XOBJ_DTYPE_INT);
        $this->initVar('breaks', XOBJ_DTYPE_INT);
        $this->initVar('block', XOBJ_DTYPE_INT);
        $this->initVar('artimage', XOBJ_DTYPE_TXTBOX);
        $this->initVar('votes', XOBJ_DTYPE_INT);
        $this->initVar('rating', XOBJ_DTYPE_DECIMAL);
        $this->initVar('commentable', XOBJ_DTYPE_INT);
        $this->initVar('offline', XOBJ_DTYPE_INT);
        $this->initVar('notifypub', XOBJ_DTYPE_INT);
     }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox\Form\SbarticlesForm
     */
    public function getForm()
    {
        $form = new Form\SbarticlesForm($this);
        return $form;
    }

        /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('articleID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
          //$permHelper = new \Xmf\Module\Helper\Permission();
          return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('articleID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('articleID'));
    }
}

