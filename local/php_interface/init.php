<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/log/log.txt");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementAddHandler");

// создаем обработчик события "OnAfterIBlockElementAdd"
function OnAfterIBlockElementAddHandler(&$arFields)
{
    if($arFields["ID"] > 0)
    {
        AddMessage2Log("Запись с кодом ".$arFields["ID"]." добавлена." . " Имя элемента: " . $arFields["NAME"]);
    }
    else
    {
        AddMessage2Log("Ошибка добавления записи (".$arFields["RESULT_MESSAGE"].").");
    }
}
