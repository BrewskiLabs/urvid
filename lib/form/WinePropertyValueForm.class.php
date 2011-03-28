<?php

/**
 * WinePropertyValue form.
 *
 * @package    wines
 * @subpackage form
 * @author     alex
 */
class WinePropertyValueForm extends BaseWinePropertyValueForm
{
  public function configure()
  {
      $this->widgetSchema['property_id'] = new sfWidgetFormInputHidden();
  }
}
