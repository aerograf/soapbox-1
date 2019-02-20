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
function showSoapboxSbarticles($options)
{
    // require dirname(__DIR__) . '/class/sbarticles.php';
  ///  $moduleDirName = basename(dirname(__DIR__));
    //$myts = \MyTextSanitizer::getInstance();

    $block = [];
    $blockType = $options[0];
    $sbarticlesCount = $options[1];
    //$titleLenght = $options[2];

    /** @var \XoopsModules\Soapbox\Helper $helper */
    $helper = \XoopsModules\Soapbox\Helper::getInstance();

    /** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
    $sbarticlesHandler = $helper->getHandler('Sbarticles'); 
    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);    
    if ($blockType) {
        $criteria->add(new \Criteria('articleID', 0, '!='));
        $criteria->setSort('articleID');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($sbarticlesCount);
    $sbarticlesArray = $sbarticlesHandler->getAll($criteria);
    foreach (array_keys($sbarticlesArray) as $i) {    
    }

    return $block;
}
/**
 * @param $options
 *
 * @return string
 */
function editSoapboxSbarticles($options)
{
   //require dirname(__DIR__) . '/class/sbarticles.php';
    // $moduleDirName = basename(dirname(__DIR__));

    $form = MB_SOAPBOX_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='".$options[1]."' type='text' />&nbsp;<br>";
    $form .= MB_SOAPBOX_TITLELENGTH." : <input name='options[2]' size='5' maxlength='255' value='".$options[2]."' type='text' /><br><br>";


    /** @var \XoopsModules\Soapbox\Helper $helper */
    $helper = \XoopsModules\Soapbox\Helper::getInstance();

    /** @var \XoopsPersistableObjectHandler $sbarticlesHandler */
    $sbarticlesHandler = $helper->getHandler('Sbarticles'); 

    $criteria = new \CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('articleID', 0, '!='));
    $criteria->setSort('articleID');
    $criteria->setOrder('ASC');
    $sbarticlesArray = $sbarticlesHandler->getAll($criteria);
    $form .= MB_SOAPBOX_CATTODISPLAY."<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (false === in_array(0, $options)  ? '' : "selected='selected'") . '>' .MB_SOAPBOX_ALLCAT . '</option>';
    foreach (array_keys($sbarticlesArray) as $i) {
        $articleID = $sbarticlesArray[$i]->getVar('articleID');
        $form .= "<option value='" . $articleID . "' " . (false === in_array($articleID, $options) ? '' : "selected='selected'") . '>'.$sbarticlesArray[$i]->getVar('headline').'</option>';
    }
    $form .= '</select>';

    return $form;
}
