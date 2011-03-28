<?php

require_once dirname(__FILE__).'/../lib/winepropertiesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/winepropertiesGeneratorHelper.class.php';

/**
 * wineproperties actions.
 *
 * @package    wines
 * @subpackage wineproperties
 * @author     alex
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class winepropertiesActions extends autoWinepropertiesActions
{
    public function executeEdit(sfWebRequest $request)
    {
        $this->WinePropertyName = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm($this->WinePropertyName);

        $this->forms = array();
        foreach ($this->WinePropertyName->getWinePropertyValues() as $item) {
            $this->forms[] = new WinePropertyValueForm($item);
        }
    }

    public function executeAddWinePropertyValue(sfWebRequest $request)
    {
        $WinePropertyValue = new WinePropertyValue();
        $WinePropertyValue->setPropertyId($request->getParameter('property_name_id'));
        $form2 = new WinePropertyValueForm($WinePropertyValue);

        //$this->processFormValue($request, $this->form2);
        return $this->renderPartial('wineproperties/formValue', array('form2' => $form2));
    }

    public function executeSaveWinePropertyValue(sfWebRequest $request)
    {       
        $form2 = new WinePropertyValueForm();
        $object = $this->ProcessFormValue($request, $form2);
        if($object->isDeleted()) return sfView::NONE;
        return $this->renderPartial('wineproperties/formValue', array('form2' => new WinePropertyValueForm($object)));
    }

    public function ProcessFormValue(sfWebRequest $request, BaseFormPropel $form)
    {
        $params = $request->getParameter($form->getName());
        if (!empty($params['id']))  {
            $obj = WinePropertyValuePeer::retrieveByPk($params['id']);
            $form = new WinePropertyValueForm($obj);
        }
        $form->bind($params);
        $object = null;
        if($form->isValid()) {
            if($request->getParameter('actions') == 'Save') {
                $object = $form->save();
            }
        }
        if (!($object instanceof WinePropertyValue)) {
            $object = new WinePropertyValue();
            $object->setId($params['id']);
            $object->setPropertyId($params['property_id']);
            $object->setName($params['name']);
            if($request->getParameter('actions') == 'Delete') {
                $object->delete();
            }
        }
        return $object;
    }
  
}
