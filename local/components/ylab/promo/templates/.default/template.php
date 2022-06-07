<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
?>

<div>
    <b><?= Loc::getMessage('YLAB.PROMO.IF_YES') ?></b>
    <?php if ($arResult['IF_PROMO']) { ?>
        <?= Loc::getMessage('YLAB.PROMO.YES') ?>
    <?php } else { ?>
        <?= Loc::getMessage('YLAB.PROMO.NO') ?>
    <?php } ?>
</div>

<div class="list">
    <b><?= Loc::getMessage('YLAB.PROMO.ITEMS') ?></b>
    <?php foreach ($arResult['BASKET_ITEMS'] as $basketItem) { ?>
        <div>
            <p><?= $basketItem->getField('NAME') . ' - ' . $basketItem->getQuantity() . '<br />' ?></p>
        </div>
        <hr>
    <?php } ?>
</div>