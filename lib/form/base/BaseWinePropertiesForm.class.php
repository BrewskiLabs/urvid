<?php

/**
 * WineProperties form base class.
 *
 * @method WineProperties getObject() Returns the current form's model object
 *
 * @package    wines
 * @subpackage form
 * @author     alex
 */
abstract class BaseWinePropertiesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'wine_id'                => new sfWidgetFormPropelChoice(array('model' => 'Wines', 'add_empty' => false)),
      'wine_property_value_id' => new sfWidgetFormPropelChoice(array('model' => 'WinePropertyValue', 'add_empty' => false)),
      'id'                     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'wine_id'                => new sfValidatorPropelChoice(array('model' => 'Wines', 'column' => 'id')),
      'wine_property_value_id' => new sfValidatorPropelChoice(array('model' => 'WinePropertyValue', 'column' => 'id')),
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wine_properties[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WineProperties';
  }


}
