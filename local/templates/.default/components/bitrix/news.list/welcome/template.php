<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<div class="news-list">
    <?php
        $IBLOCK_ID = 5;   // id инфоблока
        $ELEMENT_ID = 317;   // id элемента
        
        if (CModule::IncludeModule("iblock")) {
            $db_props = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, "sort", "asc", array());
        }
        
        while ($ar_props = $db_props->Fetch()) {
            // Сохраняем параметры свойства
            $db_propsn[] = $ar_props;
        }

        // Добавление свойств связанного элемента с помощью значения свойства "адрес" тем же способом
        foreach ($db_propsn as $item) {
            if ($item['CODE'] == "ADDRESS") {

                $res = CIBlockElement::GetByID($item['VALUE']);
                if ($ar_res = $res->GetNext()) {
                    $db_props = CIBlockElement::GetProperty($ar_res['IBLOCK_ID'], $ar_res['ID'], "sort", "asc", array());
                }

                while ($ar_props = $db_props->Fetch()) {
                    $db_propsn[] = $ar_props;
                }
                //Вывод данных клиента
                foreach ($db_propsn as $item) {
                    if ($item['NAME'] == "Адрес") {
                        echo "<br>Адрес клиента <br>";
                        continue;
                    }
                    echo $item['NAME'] . ": " . $item['VALUE'] . "<br>";
                }
            }
        }        
    ?>

    <br><br>

    <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
        <p class="news-item">
            Фамилия: <?= $arItem['PROPERTIES']['NAME']['VALUE'] ?>
            <br>
            Имя: <?= $arItem['PROPERTIES']['LASTNAME']['VALUE'] ?>
            <br>
            Отчество: <?= $arItem['PROPERTIES']['FATHER_NAME']['VALUE'] ?>
            <br>
            (тел. <?= $arItem['PROPERTIES']['NUMBER']['VALUE'] ?>)
            <br>
        </p>
        <p class="news-item">
            Адрес клиента: 
        </p>
    <?php } ?>
</div>