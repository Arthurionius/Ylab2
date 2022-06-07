<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'; ?>

<?php
$APPLICATION->IncludeComponent(
    'ylab:gift',
    '',
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>