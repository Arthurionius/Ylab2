<?php

namespace Ylab;

class Helpers {
    /*
    * Метод возвращает ID инфоблока по символьному коду 
    *
    * @param $code
    *
    * @throws \Bitrix\Main\ArgumentException
    * @throws \Bitrix\Main\LoaderException
    * @throws \Bitrix\Main\ObjectPropertyException
    * @throws \Bitrix\Main\SystemException
    *
    * @return int|void
    */

    public static function getIBlockIdByCode($code) {
        if (!\Bitrix\MainLoader::includeModule('iblock')) {
            return;
        }

        $IB = \Bitrix\Iblock\Iblocktable::getList([
           'select' => ['ID'],
           'filter' => ['CODE' => $code],
           'limit' => '1',
           'cache' => ['ttl' => 3600], 
        ]);

        $return = $IB->fetch();
        if (!$return) {
            throw new \Exception('IBlock with code "' . $code . '"not found');
        }

        return $return['ID'];
    }
}