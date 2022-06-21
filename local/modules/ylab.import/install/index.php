<?php

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\ModuleManager;

/**
 * Class ylab_import
 * Модуль импорта товаров
 */
class ylab_import extends CModule
{
    /**
     * ID модуля
     * @var string
     */
    public $MODULE_ID = 'ylab.import';

    /**
     * constructor
     */
    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('YLAB_IMPORT_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('YLAB_IMPORT_MODULE_DESCRIPTION');
    }

    /**
     * @return bool|void
     */
    public function DoInstall()
    {
        global $APPLICATION;
        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();

		if ($request["step"] < 2)
		{
			$APPLICATION->IncludeAdminFile(Loc::getMessage("YLAB_IMPORT_MODULE_INSTALL_STEP1"), $_SERVER["DOCUMENT_ROOT"]."/local/modules/ylab.import/install/step1.php");
		}
		elseif ($request["step"] == 2)
		{
            COption::SetOptionString($this->MODULE_ID, "limit_to_import", $request['limit_to_import']);
            COption::SetOptionString($this->MODULE_ID, "textarea", $request['textarea']);
            COption::SetOptionString($this->MODULE_ID, "allow_import", $request['allow_import']);

			$APPLICATION->IncludeAdminFile(Loc::getMessage("YLAB_IMPORT_MODULE_INSTALL_STEP2"), $_SERVER["DOCUMENT_ROOT"]."/local/modules/ylab.import/install/step2.php");
		}		
        elseif ($request["step"] == 3)
		{
            COption::SetOptionString($this->MODULE_ID, "selectbox", $request['selectbox']);

			$APPLICATION->IncludeAdminFile(Loc::getMessage("YLAB_IMPORT_MODULE_INSTALL_STEP3"), $_SERVER["DOCUMENT_ROOT"]."/local/modules/ylab.import/install/step3.php");
		}
        elseif ($request["step"] == 4)
        {
            $this->InstallFiles();
			$this->InstallDB();
			$GLOBALS["errors"] = $this->errors;

            COption::SetOptionString($this->MODULE_ID, "multiselectbox", $request['multiselectbox']);
            COption::SetOptionString($this->MODULE_ID, "statictext", $request['statictext']);
            COption::SetOptionString($this->MODULE_ID, "statichtml", $request['statichtml']);

            $APPLICATION->IncludeAdminFile(GetMessage("BCL_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/local/modules/ylab.import/install/step4.php");
        }

        return true;
    }

    /**
     * @return bool|void
     */
    public function DoUninstall()
    {
        $this->uninstallDB();
        $this->uninstallFiles();

        ModuleManager::unregisterModule($this->MODULE_ID);

        return true;
    }

    /**
     * @param array $arParams
     * @return bool|void
     */
    public function installFiles($arParams = array())
    {
        $root = Application::getDocumentRoot();

        CopyDirFiles(__DIR__ . '/components/', $root . '/local/components', true, true);

        if (is_dir($sPachDir = $_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/admin')) {
            if ($sDir = opendir($sPachDir)) {
                while (false !== $sItem = readdir($sDir)) {
                    if ($sItem == '..' || $sItem == '.' || $sItem == 'menu.php') {
                        continue;
                    }

                    file_put_contents($file = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $sItem,
                        '<' . '? require($_SERVER["DOCUMENT_ROOT"] . "/local/modules/' . $this->MODULE_ID . '/admin/' . $sItem . '");?' . '>');
                }

                closedir($sDir);
            }
        }


        return true;
    }

    /**
     * @return bool|void
     */
    public function uninstallFiles()
    {
        if (Directory::isDirectoryExists($path = $this->GetPath() . '/admin')) {
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . $this->GetPath() . '/admin/',
                $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');

            if ($dir = opendir($path)) {
                while (false !== $item = readdir($dir)) {
                    File::deleteFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
                }

                closedir($dir);
            }
        }

        DeleteDirFiles(__DIR__ . "/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components");

        return true;
    }

    /**
     * @return bool
     */
    public function installDB()
    {
        $sPath = $this->getPath() . '/install/db/mysql/up/';
        $oConn = Application::getConnection();
        $arFiles = scandir($sPath, SCANDIR_SORT_NONE);

        foreach ($arFiles as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $sQuery = file_get_contents($sPath . $file);
            $oConn->executeSqlBatch($sQuery);
        }

        RegisterModule($this->MODULE_ID);

        // COption::SetOptionString($this->MODULE_ID, "limit_to_import", '200');

        return true;
    }

    /**
     * @return bool|void
     */
    public function uninstallDB()
    {
        $sPath = $this->getPath() . '/install/db/mysql/down/';
        $oConn = Application::getConnection();
        $arFiles = scandir($sPath, SCANDIR_SORT_NONE);

        foreach ($arFiles as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $sQuery = file_get_contents($sPath . $file);
            $oConn->executeSqlBatch($sQuery);
        }

        return true;
    }

    /**
     * @param bool $bNotDocumentRoot
     * @return mixed|string
     */
    public function GetPath($bNotDocumentRoot = false)
    {
        if ($bNotDocumentRoot) {
            return str_ireplace(Application::getDocumentRoot(), '', str_replace('\\', '/', dirname(__DIR__)));
        }

        return dirname(__DIR__);
    }
}