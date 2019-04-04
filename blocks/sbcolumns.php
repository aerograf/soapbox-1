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
use XoopsModules\Soapbox;

/**
 * @param $options
 *
 * @return array
 */
function showSoapboxSbcolumns($options)
{
    // require dirname(__DIR__) . '/class/sbcolumns.php';
  ///  $moduleDirName = basename(dirname(__DIR__));
    //$myts = \MyTextSanitizer::getInstance();

    $block = [];
    $blockType = $options[0];
    $sbcolumnsCount = $options[1];
    //$titleLenght = $options[2];

    /** @var \XoopsModules\Soapbox\Helper $helper */
    $helper = \XoopsModules\Soapbox\Helper::getInstance();

    /** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
    $sbcolumnsHandler = $helper->getHandler('Sbcolumns'); 
    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);    
    if ($blockType) {
        $criteria->add(new \Criteria('columnID', 0, '!='));
        $criteria->setSort('columnID');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($sbcolumnsCount);
    $sbcolumnsArray = $sbcolumnsHandler->getAll($criteria);
    foreach (array_keys($sbcolumnsArray) as $i) {    
    }

    return $block;
}
/**
 * @param $options
 *
 * @return string
 */
function editSoapboxSbcolumns($options)
{
   //require dirname(__DIR__) . '/class/sbcolumns.php';
    // $moduleDirName = basename(dirname(__DIR__));

    $form = MB_SOAPBOX_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='".$options[1]."' type='text' />&nbsp;<br>";
    $form .= MB_SOAPBOX_TITLELENGTH." : <input name='options[2]' size='5' maxlength='255' value='".$options[2]."' type='text' /><br><br>";


    /** @var \XoopsModules\Soapbox\Helper $helper */
    $helper = \XoopsModules\Soapbox\Helper::getInstance();

    /** @var \XoopsPersistableObjectHandler $sbcolumnsHandler */
    $sbcolumnsHandler = $helper->getHandler('Sbcolumns'); 

    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('columnID', 0, '!='));
    $criteria->setSort('columnID');
    $criteria->setOrder('ASC');
    $sbcolumnsArray = $sbcolumnsHandler->getAll($criteria);
    $form .= MB_SOAPBOX_CATTODISPLAY."<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (false === in_array(0, $options)  ? '' : "selected='selected'") . '>' .MB_SOAPBOX_ALLCAT . '</option>';
    foreach (array_keys($sbcolumnsArray) as $i) {
        $columnID = $sbcolumnsArray[$i]->getVar('columnID');
        $form .= "<option value='" . $columnID . "' " . (false === in_array($columnID, $options) ? '' : "selected='selected'") . '>'.$sbcolumnsArray[$i]->getVar('name').'</option>';
    }
    $form .= '</select>';

    return $form;
}
