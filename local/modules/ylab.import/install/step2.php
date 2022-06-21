<?
/** @global CMain $APPLICATION */
IncludeModuleLangFile(__FILE__);
?>

<form action="<? echo $APPLICATION->GetCurPage(); ?>" name="form2">
    <? echo bitrix_sessid_post(); ?>
    <input type="hidden" name="lang" value="<? echo LANG ?>">
    <input type="hidden" name="id" value="ylab.import">
    <input type="hidden" name="install" value="Y">
    <input type="hidden" name="step" value="3">
    <select name="selectbox" size="1">
        <option value="Y">Yes</option>
        <option value="N">No</option>
        <option value="M">Maybe</option>
    </select><br>
    <input type="submit" name="inst" value="Далее">
</form>