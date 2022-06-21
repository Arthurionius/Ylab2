<?
/** @global CMain $APPLICATION */
IncludeModuleLangFile(__FILE__);
?>

<form action="<? echo $APPLICATION->GetCurPage(); ?>" name="form3">
    <? echo bitrix_sessid_post(); ?>
    <input type="hidden" name="lang" value="<? echo LANG ?>">
    <input type="hidden" name="id" value="ylab.import">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="4">
    <select name="multiselectbox[]" size="3" multiple="multiple">
        <option value="val1">Значение 1</option>
        <option value="val2">Значение 2</option>
        <option value="val3">Значение 3</option>
    </select><br>
    Статический текст:<input type="text" name="statictext"><br>
    HTML-модифицированный текст: <input type="text" name="statichtml"><br>
    <input type="submit" name="inst" value="Далее">
</form>