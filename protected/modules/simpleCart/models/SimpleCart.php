<?php
class SimpleCart
{
    protected static $_sessionKey = 'AtKz2FZ7jHnqrQ16RvC85EIDMdU0XB4s_aod.simplecart';

    protected static $_eventRegistrationID = null;

    public static function cartID()
    {
        if (empty(Yii::app()->session[static::$_sessionKey])) {
            self::resetCart();
        }
        return Yii::app()->session[static::$_sessionKey];
    }

    public static function itemsCount()
    {
        $itemsCount = 0;
        $items = self::fullCartItemsList();
        foreach ($items as $cartItem) {
            $itemsCount += $cartItem->quantity;
        }
        return $itemsCount;
    }

    public static function total($vatMultiplicator = 1.00)
    {
        $total = 0.00;
        $items = self::fullCartItemsList();
        foreach ($items as $cartItem) {
            $total += $cartItem->total($vatMultiplicator);
        }
        return $total;
    }

    // Retrieve full items list
    public static function fullCartItemsList()
    {
        return SimpleCartItem::model()->findAllByAttributes(array(
            'cart_id'=> self::cartID()
        ));
    }

    public static function addCartItem($simpleCartItem=null)
    {
        if (is_null($simpleCartItem) || !is_a($simpleCartItem, 'SimpleCartItem')) {
            return null;
        }
        $simpleCartItem->cart_id = self::cartID();
        $simpleCartItem->save();
        return $simpleCartItem;
    }

    public static function deleteCartItem($itemID=null)
    {
        if (is_null($itemID)) {
            return false;
        }

        $model = SimpleCartItem::model()->findByPk($itemID);
        if (!$model) {
            return false;
        }

        return $model->delete();
    }

    public static function updateCart($itemID=null, $quantity=null)
    {
        if (is_null($itemID) || is_null($quantity)) {
            return false;
        }

        $model = SimpleCartItem::model()->findByPk($itemID);
        if (!$model) {
            return false;
        }

        $model->quantity = $quantity;

        return $model->save();
    }

    public static function resetCart()
    {
        return Yii::app()->session[static::$_sessionKey] = MyFunctions::generatePassword(32, 2);
    }

    /* EVENT REGISTRATION FLAGS */
    public static function setEventRegistrationID($ident)
    {
        if (empty(Yii::app()->session[static::$_sessionKey . '.event_registration_id'])) {
            Yii::app()->session[static::$_sessionKey . '.event_registration_id'] = $ident;
        }
        return Yii::app()->session[static::$_sessionKey . '.event_registration_id'];
    }

    public static function getEventRegistrationID()
    {
        if (empty(Yii::app()->session[static::$_sessionKey . '.event_registration_id'])) {
            return null;
        }
        return Yii::app()->session[static::$_sessionKey . '.event_registration_id'];
    }

    public static function getEventRegistrationAttributes()
    {
        if (is_null(self::getEventRegistrationID())) {
            return array();
        }

        $modelFromSession = EventsRegistration::model()->findByPk((int)SimpleCart::getEventRegistrationID());
        if (!$modelFromSession) {
            return array();
        }

        $returnArray = $modelFromSession->attributes;
        unset($returnArray['id']);
        return $returnArray;
    }
}