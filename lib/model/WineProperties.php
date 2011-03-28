<?php


/**
 * Skeleton subclass for representing a row from the 'wine_properties' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class WineProperties extends BaseWineProperties {

    static function getWinePropertiesForm($winesId)
    {
        $wine_properties = WinePropertyNamePeer::getWinePropertys($winesId);
        $property_array_all = self::getProperty($wine_properties);

        foreach ($wine_properties as $item)
        {
            $propertyName = WinePropertyNamePeer::getNamePropertyValue($item->getWinePropertyValueId(), true);
            $form = new WineAddPropertyNameValueForm();
            $form->getWidget('wines_id')->setOption('default', $winesId);

            $form->getWidget('id')->setOption('default', $item->getId());

            $property_array = $property_array_all;
            $property_array[$propertyName->getId()] = $propertyName->getName();

            $form->getWidget('name_id')->setOption('default', $propertyName->getId());
            $form->getWidget('name_id')->setOption('choices', $property_array);

            $array = array();
            foreach (WinePropertyValuePeer::getChoices($propertyName->getId(),false) as $value)
            {
                $array[$value->getId()] = $value->getName();
            }
            $form->getWidget('value_id')->setOption('default', $item->getWinePropertyValueId());
            $form->getWidget('value_id')->setOption('choices', $array);
            $result[] = $form;
        }
        return $result;
    }

    static function getProperty($wine_properties, $empty_array=false)
    {
        foreach ($wine_properties as $item)
        {
            $propertyName = WinePropertyNamePeer::getNamePropertyValue($item->getWinePropertyValueId(), true);
            $property_array_wine_id[] = $propertyName->getId();
        }
        $array = array();
        if($empty_array) {
            $array = array('' => '');
        }
        $property = WinePropertyNamePeer::getWinesPropertyNames($property_array_wine_id);
        if(empty ($property)) return;
        foreach ($property as $item) {
            $array[$item->getId()] = $item->getName();
        }
        return $array;
    }

} // WineProperties
