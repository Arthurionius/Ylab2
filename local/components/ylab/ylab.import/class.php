<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Ylab\Import\Import;
use Bitrix\Main\Loader;


/**
 * Class YlabImport
 */
class YlabImportComponent extends CBitrixComponent
{
    /**
     * @return mixed|void
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function executeComponent()
    {
        Loader::includeModule('ylab.import');

        $profile = new Import();

        $this->arResult['LIMIT'] = $profile->getLimitImport();

        $this->includeComponentTemplate();
    }
}