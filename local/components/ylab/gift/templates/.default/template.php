<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
?>

<div>
    <b><?= Loc::getMessage('YLAB.GIFT.IF_YES') ?></b>

    <?php if ($arResult['IF_GIFT'] && !$arResult['IF_ALREADY']) { ?>
        <?= Loc::getMessage('YLAB.GIFT.YES') ?>
    <?php } else { ?>
        <?= Loc::getMessage('YLAB.GIFT.NO') ?>
    <?php } ?>
    <br>
    <?php if ($arResult['IF_ALREADY']) { ?>
        <?= Loc::getMessage('YLAB.GIFT.GIFT_ALREADY') ?>
    <?php } ?>
</div>
<br>
<div class="list">
    <b><?= Loc::getMessage('YLAB.GIFT.ITEMS') ?></b>
    <?php foreach ($arResult['BASKET_ITEMS'] as $basketItem) { ?>
        <div>
            <p><?= $basketItem->getField('NAME') . ' - ID' . $basketItem->getField('ID') . ' - ' . $basketItem->getQuantity() . 'шт.<br />' ?></p>
        </div>
        <hr>
    <?php } ?>
</div>

<!-- 
    Обработка формы 
-->
<form action="" method="post">
    Количество подарков <input type="text" name="quantityGifts"> <br>
    <button type="submit">Хочу столько</button>
</form>

<?php
$quantityGifts = 0;
if(isset($_POST["quantityGifts"])){
    $quantityGifts = $_POST["quantityGifts"];
}

if ($quantityGifts != 0) {
    $result = \Bitrix\Catalog\Product\Basket::addProduct(['PRODUCT_ID' => 320, 'QUANTITY' => $quantityGifts]);
    if(!$result->isSuccess()) {
        echo implode('<br>', $result->getErrorMessages());
    }
}

echo "<br>Количество подарков, которое вы получите дополнительно: " . $quantityGifts;
?>