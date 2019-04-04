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
/**
 * CommentsUpdate
 *
 * @param mixed $itemId
 * @param mixed $commentCount
 * @return bool
 */
function soapboxCommentsUpdate($itemId, $commentCount) {
        /** @var \XoopsModules\Soapbox\Helper $helper */
    $helper = \XoopsModules\Soapbox\Helper::getInstance();
    if (!$helper->getHandler('Sbvotedata')->updateAll('comments', (int)$commentCount, new \Criteria('lid', (int)$itemId))){
        return false;
    }
    return true;
}

/**
 * CommentsApprove
 *
 * @param string  $comment
 * @return void
 */
function soapboxCommentsApprove(&$comment){
    // notification mail here
}