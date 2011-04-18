<?php


/**
 * Skeleton subclass for performing query and update operations on the 'wine_property_value' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class WinePropertyValuePeer extends BaseWinePropertyValuePeer {
    public static function getChoices($property_id, $forAjax=false){
        $criteria = new Criteria();
        $criteria->add(self::PROPERTY_ID, $property_id);
        $objects = self::doSelect($criteria);
        if (!$forAjax) return $objects;
        $item = new WinePropertyValue();
        $result = array();
        foreach ($objects as $item) {
            $result[] = array('text'=>$item->getName(), 'value'=>$item->getId());
        }
        return $result;
    }

    public static function getWinesValueId($id) {
        $criteria = new Criteria();
        $criteria->add(self::PROPERTY_ID, $id);
        return self::doSelect($criteria);
    }
} // WinePropertyValuePeer
