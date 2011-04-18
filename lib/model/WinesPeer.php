<?php


/**
 * Skeleton subclass for performing query and update operations on the 'wines' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class WinesPeer extends BaseWinesPeer {

    public static function SearchWines($year=null, $winery=null, $wine_type=null)
    {
        $criteria = new Criteria();
        if(!is_null($winery) && !is_null($wine_type)) {
            $criteria->addJoin(self::ID, WinePropertiesPeer::WINE_ID, Criteria::LEFT_JOIN);
        }
        if(!is_null($year)) {
            $criteria->add(self::YEAR, $year);
        }
        if(!is_null($winery)) {
            $criteria->add(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, $winery);
        }
        if(!is_null($wine_type)) {
            $criteria->add(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, $wine_type);
        }
        return $criteria;
    }

    public static function SearchWinesCountAll($year=null, $winery=null, $wine_type=null)
    {
        $criteria = new Criteria();
        $criteria->addJoin(self::ID, WinePropertiesPeer::WINE_ID, Criteria::LEFT_JOIN);
        if(!is_null($year)) {
            $criteria->add(self::YEAR, $year);
        }
        if(!is_null($winery)) {
            $criteria->add(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, $winery);
        }
        if(!is_null($wine_type)) {
            $criteria->add(WinePropertiesPeer::WINE_PROPERTY_VALUE_ID, $wine_type);
        }
        return self::doCount($criteria);
    }

} // WinesPeer
