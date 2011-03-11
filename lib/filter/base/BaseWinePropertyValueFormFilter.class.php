<?php

/**
 * WinePropertyValue filter form base class.
 *
 * @package    wines
 * @subpackage filter
 * @author     alex
 */
abstract class BaseWinePropertyValueFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'property_id' => new sfWidgetFormPropelChoice(array('model' => 'WinePropertyName', 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'property_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WinePropertyName', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wine_property_value_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WinePropertyValue';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'property_id' => 'ForeignKey',
      'name'        => 'Text',
    );
  }
}
