<?php

namespace Ylab\Import;

use Bitrix\Main\Localization\Loc;

/**
 * Class Import
 * @package Ylab\Import
 */
class Import
{
    private $moduleId = 'ylab.import';

    /**
     * @return string
     */
    public function getLimitImport(): string
    {
        return Loc::getMessage('YLAB_IMPORT_LIMIT_TEXT') . \COption::GetOptionString($this->moduleId, "limit_to_import", '0');
    }
}