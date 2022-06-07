<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'; ?>

<?php
$APPLICATION->IncludeComponent(
    'ylab:promo', //namespace ylab, promo - название компонента
    '',
    []
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>