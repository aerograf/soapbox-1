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


require __DIR__ . '/../../mainfile.php';
//require XOOPS_ROOT_PATH.'/modules/soapbox/class/sbvotedata.php';
$com_itemid = Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {

    /** @var \XoopsPersistableObjectHandler $sbvotedataHandler */
    $sbvotedataHandler  = $helper->getHandler('Sbvotedata'); 

    $sbvotedata = $sbvotedataHandler->get($com_itemid);
    $com_replytitle = $sbvotedata->getVar('ratingid');
    require XOOPS_ROOT_PATH.'/include/comment_new.php';
}