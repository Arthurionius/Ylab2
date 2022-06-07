<?
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
$APPLICATION->SetTitle("Lesson1");
?>

<?php
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"welcome", 
	array(
		"IBLOCK_TYPE" => "clients",
		"IBLOCK_ID" => "5",
		"PROPERTY_CODE" => array(
			0 => "NAME",
			1 => "FATHER_NAME",
			2 => "NUMBER",
			3 => "LASTNAME",
			4 => "ADDRESS",	
		),
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>