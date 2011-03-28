<?php

/**
 * WinePropertyName form.
 *
 * @package    wines
 * @subpackage form
 * @author     alex
 */
class WineAddPropertyNameValueForm extends sfForm
{
  public function configure()
  {
      $this->widgetSchema['name_id'] = new sfWidgetFormChoice(array('choices' => array('' => '')));
      $this->widgetSchema['value_id'] = new sfWidgetFormChoice(array('choices' => array('' => '')));
      $this->widgetSchema['wines_id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema->setLabel(array(
          'name_id' => 'Property',
          'value_id' => 'Value',
      ));
      $this->widgetSchema->setNameFormat('wine_properties[%s]');
  }
}
