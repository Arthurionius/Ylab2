<?php

namespace YLab\Components;

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use CBitrixComponent;
use Bitrix\Sale\Basket;

/**
 * Class GiftComponent
 * @package YLab\Components
 * Компонент отображения списка элемента нашего ИБ
 */
class GiftComponent extends CBitrixComponent {
    /** @var int $minItemCost Минимальная сумма каждого из 3-ех товаров */
    private $minItemCost = 500;

    /**
     * Метод executeComponent
     * 
     * @return mixed|void
     * @throws Exception
     */

     public function executeComponent()
     {
         Loader::includeModule("catalog"); // чтобы использовать Basket, надо подключить модуль каталог

         $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite()); // корзина текущего пользователя

         $this->arResult['BASKET_ITEMS'] = $basket->getBasketItems();

         $this->arResult['IF_GIFT'] = $this->checkIfGiveGift($basket->getBasketItems());

         $this->arResult['IF_ALREADY'] = $this->checkIfUserHaveGift($basket->getBasketItems());
        
         $this->addGiftToBasket();

         $this->includeComponentTemplate(); // подключение шаблона
     }

     /**
      * Определим получит ли пользователь подарок
      * @param array $total
      * @return bool
      */
      public function checkIfGiveGift(array $basketItems): bool
      {
        $counter = 0;
        foreach ($basketItems as $basketItem) {
            if ($basketItem->getField('PRICE') > $this->minItemCost) {
                $counter++;
            }

            if ($basketItem->getField('NAME') == 'Подарок') {
                $counter = 0;
                return false;
            }
        }

        return $counter > 2 ? true : false; // 3 и более товаров стоимостью более 500 руб
      }

     /**
      * Определим есть ли подарок у пользователя
      * @param array $total
      * @return bool
      */

      public function checkIfUserHaveGift(array $basketItems): bool
      {
        foreach ($basketItems as $basketItem) {
            if ($basketItem->getField('NAME') == 'Подарок') {
                return true;
            }
        }

        return false;
      }

     /**
      * Добавим подарок в корзину
      * @param void $total
      * @return void
      */
      public function addGiftToBasket(): void
      {
        if ($this->arResult['IF_GIFT'] && !$this->arResult['IF_ALREADY']) {
            $result = \Bitrix\Catalog\Product\Basket::addProduct(['PRODUCT_ID' => 320, 'QUANTITY' => 1]);
            if(!$result->isSuccess()) {
               echo implode('<br>', $result->getErrorMessages());
           }
         }
      }
}