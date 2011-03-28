<?php


/**
 * Skeleton subclass for performing query and update operations on the 'wine_property_name' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class WinePropertyNamePeer extends BaseWinePropertyNamePeer {

    static function getWinesPropertyNames($array_id = false)
    {
        $criteria = new Criteria();
        $criteria->add(WinePropertyNamePeer::ID, $array_id, Criteria::NOT_IN);
        return WinePropertyNamePeer::doSelect($criteria);
    }

    static function getWinesPropertyValues($wines_id)
    {
        $criteria = new Criteria();
        $criteria->addJoin(WinePropertyValuePeer::ID, WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, Criteria::LEFT_JOIN);
        $criteria->add(WinePropertiesPeer::WINE_ID, $wines_id);
        return WinePropertyValuePeer::doSelect($criteria);
    }

    static function getWinePropertys($wines_id)
    {
        $criteria = new Criteria();
        $criteria->add(WinePropertiesPeer::WINE_ID, $wines_id);
        return WinePropertiesPeer::doSelect($criteria);
    }

    static function getNamePropertyValue($id, $one=false)
    {
        $criteria = new Criteria();
        $criteria->addJoin(WinePropertyNamePeer::ID, WinePropertyValuePeer::PROPERTY_ID, Criteria::LEFT_JOIN);
        $criteria->add(WinePropertyValuePeer::ID, $id);
        if($one) {
            return WinePropertyNamePeer::doSelectOne($criteria);
        } else {
            return WinePropertyNamePeer::doSelect($criteria);
        }
    }

} // WinePropertyNamePeer
