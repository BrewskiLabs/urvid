<?php

require_once dirname(__FILE__).'/../lib/winesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/winesGeneratorHelper.class.php';

/**
 * wines actions.
 *
 * @package    wines
 * @subpackage wines
 * @author     alex
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class winesActions extends autoWinesActions
{

  public function executeEdit(sfWebRequest $request)
  {
    $this->wines = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->wines);
    
    $this->wine_properties = WineProperties::getWinePropertiesForm($this->wines->getId());
  }

  public function executeAddWinePropertyName(sfWebRequest $request)
  {
    $form = new WineAddPropertyNameValueForm();
    $form->getWidget('wines_id')->setOption('default', $request->getParameter('wines_id'));

    $wine_properties = WinePropertyNamePeer::getWinePropertys($request->getParameter('wines_id'));
    $property_array_all = WineProperties::getProperty($wine_properties, true);
    if(empty($property_array_all)) return sfView::NONE;
    $form->getWidget('name_id')->setOption('choices', $property_array_all);
    return $this->renderPartial('wines/formValue', array('form' => $form));
  }

  public function executeGetWinePropertyValue(sfWebRequest $request)
  {
    return $this->renderText(json_encode(WinePropertyValuePeer::getChoices($request->getParameter('property_name_id'),true)));
  }

  public function executeSaveWinesPropertyValue(sfWebRequest $request)
  {
    $object = $this->ProcessFormNameValue($request);
    $this->wine_properties = WineProperties::getWinePropertiesForm($object->getWineId());
    $wines = WinesPeer::retrieveByPK($object->getWineId());
    return $this->renderPartial('wines/wine_properties_form', array('wine_properties' => $this->wine_properties, 'wines' => $wines));
  }

  public function ProcessFormNameValue(sfWebRequest $request)
  {
    $wineproperty = $request->getParameter('wine_properties');

    if(!empty ($wineproperty['wines_id']) && !empty ($wineproperty['value_id'])) {
        
        if (!empty($wineproperty['id']))  {
            $winepropertyobj = WinePropertiesPeer::retrieveByPK($wineproperty['id']);
        } else {
            $winepropertyobj = new WineProperties();
        }
        $winepropertyobj->setWineId($wineproperty['wines_id']);
        $winepropertyobj->setWinePropertyValueId($wineproperty['value_id']);
        if($request->getParameter('actions') == 'Save') {
            $winepropertyobj->save();
        } else {
            $winepropertyobj->delete();
        }
        return $winepropertyobj;
    }
  }
  
}

