<?php

/**
 * WinePropertyValue form base class.
 *
 * @method WinePropertyValue getObject() Returns the current form's model object
 *
 * @package    wines
 * @subpackage form
 * @author     alex
 */
abstract class BaseWinePropertyValueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'property_id' => new sfWidgetFormPropelChoice(array('model' => 'WinePropertyName', 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'property_id' => new sfValidatorPropelChoice(array('model' => 'WinePropertyName', 'column' => 'id')),
      'name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wine_property_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WinePropertyValue';
  }


}
