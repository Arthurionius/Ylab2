<?php

namespace YLab\Components;

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use CBitrixComponent;
use Bitrix\Sale\Basket;

/**
 * Class PromoComponent
 * @package YLab\Components
 * Компонент отображения списка элемента нашего ИБ
 */
class PromoComponent extends CBitrixComponent {
    /** @var int $totalCost Минимальная сумма заказа в корзине */
    private $totalCost = 2000;

    /**
     * Метод executeComponent
     * 
     * @return mixed|void
     * @throws Exception
     */

     public function executeComponent()
     {
         Loader::includeModule("catalog"); //чтобы использовать Basket, надо подключить модуль каталог

         $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite()); //получает корзину для текущего пользователя

         $this->arResult['BASKET_ITEMS'] = $basket->getBasketItems();

         $this->arResult['IF_PROMO'] = $this->checkIfGivePromo($basket->getPrice());

         $this->includeComponentTemplate(); //чтобы подключился наш шаблон
     }

     /**
      * Определим может ли пользователь участвовать в промо акции
      * @param float $total
      * @return bool
      */
      public function checkIfGivePromo(float $total): bool
      {
          return $total >= $this->totalCost;
      }
}