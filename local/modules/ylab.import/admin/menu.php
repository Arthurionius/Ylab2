<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

AddEventHandler('main', 'OnBuildGlobalMenu', 'YlabImportModuleMenu');

if (!function_exists('YlabImportModuleMenu')) {
    /**
     * Отображение меню
     * @param $adminMenu
     * @param $moduleMenu
     */
    function YlabImportModuleMenu(&$adminMenu, &$moduleMenu)
    {
        $adminMenu['global_menu_services']['items'][] = [
            'section' => 'ylab-import-pages',
            'sort' => 110,
            'text' => Loc::getMessage('YLAB_IMPORT_TITLE_PAGE'),
            'items_id' => 'nlmk-hidden-pages',
            'items' => [
                [
                    'parent_menu' => 'ylab-import-pages',
                    'section' => 'ylab-import-pages-list',
                    'sort' => 500,
                    'url' => 'ylab.import_list.php?lang=' . LANG,
                    'text' => Loc::getMessage('YLAB_IMPORT_LIST_PAGE'),
                    'title' => Loc::getMessage('YLAB_IMPORT_LIST_PAGE'),
                    'icon' => 'form_menu_icon',
                    'page_icon' => 'form_page_icon',
                    'items_id' => 'ylab-import-pages-list'
                ],
                [
                    'parent_menu' => 'ylab-import-pages',
                    'section' => 'ylab-import-pages-start',
                    'sort' => 500,
                    'url' => 'ylab.import_start.php?lang=' . LANG,
                    'text' => Loc::getMessage('YLAB_IMPORT_START_PAGE'),
                    'title' => Loc::getMessage('YLAB_IMPORT_START_PAGE'),
                    'icon' => 'form_menu_icon',
                    'page_icon' => 'form_page_icon',
                    'items_id' => 'ylab-import-pages-start'
                ]
            ]
        ];
    }

}