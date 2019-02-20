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
 * Class Sbvotedata
 */
class Sbvotedata extends \XoopsObject
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

        $this->initVar('ratingid', XOBJ_DTYPE_INT);
        $this->initVar('lid', XOBJ_DTYPE_INT);
        $this->initVar('ratinguser', XOBJ_DTYPE_INT);
        $this->initVar('rating', XOBJ_DTYPE_INT);
        $this->initVar('ratinghostname', XOBJ_DTYPE_TXTBOX);
                    $this->initVar('ratingtimestamp', XOBJ_DTYPE_TIMESTAMP);
     }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox\Form\SbvotedataForm
     */
    public function getForm()
    {
        $form = new Form\SbvotedataForm($this);
        return $form;
    }

        /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
          //$permHelper = new \Xmf\Module\Helper\Permission();
          return $this->permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        //$permHelper = new \Xmf\Module\Helper\Permission();
        return $this->permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('ratingid'));
    }
}

