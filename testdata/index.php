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
use XoopsModules\Soapbox\Common;

    require_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';
    require dirname(__DIR__) . '/preloads/autoloader.php';

    $op = \Xmf\Request::getCmd('op', '');

    switch ($op) {
        case 'load':
            loadSampleData();
            break;
        case 'save':
        saveSampleData();
        break;
    }

    // XMF TableLoad for SAMPLE data

    function loadSampleData()
    {
        $moduleDirName = basename(dirname(__DIR__));
        $helper       = Soapbox\Helper::getInstance();
        $utility      = new Soapbox\Utility();
        $configurator = new Common\Configurator();

       // Load language files
        $helper->loadLanguage('admin');
        $helper->loadLanguage('modinfo');
        $helper->loadLanguage('common');

        $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');

        foreach ($tables as $table) {
        $tabledata = \Xmf\Yaml::readWrapped($table . '.yml');
        \Xmf\Database\TableLoad::truncateTable($table);
        \Xmf\Database\TableLoad::loadTableFromArray($table, $tabledata);
    }

          //  ---  COPY test folder files ---------------
    if (is_array($configurator->copyTestFolders) && count($configurator->copyTestFolders) > 0) {
        //        $file = __DIR__ . '/../testdata/images/';
        foreach (array_keys($configurator->copyTestFolders) as $i) {
            $src  = $configurator->copyTestFolders[$i][0];
            $dest = $configurator->copyTestFolders[$i][1];
            $utility::xcopy($src, $dest);
        }
    }
        redirect_header('../admin/index.php', 1, constant('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS'));
    }

    function saveSampleData()
{
    $moduleDirName = basename(dirname(__DIR__));
    $moduleDirNameUpper = strtoupper($moduleDirName);

        $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');

    $exportFolder = __DIR__ . '/Exports-' . date("Y-m-d-H-i-s") . '/';
    \XoopsModules\Soapbox\Utility::createFolder($exportFolder);

    foreach ($tables as $table) {
        \Xmf\Database\TableLoad::saveTableToYamlFile($table, $exportFolder . $table . '.yml');
    }

//        foreach ($tables as $table) {
//        \Xmf\Database\TableLoad::saveTableToYamlFile($moduleDirName . '_' . $table, $table . '.yml');
//        }

         redirect_header('../admin/index.php', 1, constant('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS'));
}

function exportSchema()
{
    $moduleDirName      = basename(dirname(__DIR__));
    $moduleDirNameUpper = mb_strtoupper($moduleDirName);

    try {
        // TODO set exportSchema
        //        $migrate = new Soapbox\Migrate($moduleDirName);
        //        $migrate->saveCurrentSchema();
        //
        //        redirect_header('../admin/index.php', 1, constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS'));
    }
    catch (\Exception $e) {
        exit(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR'));
    }

      }