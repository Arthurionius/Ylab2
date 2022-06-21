<?
/** @global CMain $APPLICATION */
IncludeModuleLangFile(__FILE__);
?>

<form action="<? echo $APPLICATION->GetCurPage(); ?>" name="form1">
    <? echo bitrix_sessid_post(); ?>
    <input type="hidden" name="lang" value="<? echo LANG ?>">
    <input type="hidden" name="id" value="ylab.import">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="2"> <!-- Задаем step значение 2, таким образом перейдем к 2 шагу установки -->
    Лимит импорта: <input type="text" name="limit_to_import" value=""><br>
    Комментарий: <input type="text" name="textarea" value=""><br>
    Разрешение на импорт: <input type="checkbox" name="allow_import" value="Y"><br>
    <input type="submit" name="inst" value="Далее">
</form>