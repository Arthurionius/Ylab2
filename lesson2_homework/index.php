<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php'; ?>

<?php
$APPLICATION->IncludeComponent(
    'ylab:gift',
    '',
    []
    // Array(
    //     "CACHE_TYPE" => "A", 
    //     "CACHE_TIME" => "3600",
    //     "CACHE_GROUPS" => "Y", 
    //     "AJAX_MODE" => "Y", 
    //     "SECTION" => "-", 
    //     "EXPAND_LIST" => "Y", 
    //     "SECTION_URL" => "faq_detail.php?SECTION_ID=#SECTION_ID#", 
    //     "AJAX_OPTION_JUMP" => "N", 
    //     "AJAX_OPTION_STYLE" => "Y", 
    //     "AJAX_OPTION_HISTORY" => "N" 
    // ),
);
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>