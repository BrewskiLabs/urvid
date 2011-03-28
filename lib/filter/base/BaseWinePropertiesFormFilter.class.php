<?php

/**
 * WineProperties filter form base class.
 *
 * @package    wines
 * @subpackage filter
 * @author     alex
 */
abstract class BaseWinePropertiesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'wine_id'                => new sfWidgetFormPropelChoice(array('model' => 'Wines', 'add_empty' => true)),
      'wine_property_value_id' => new sfWidgetFormPropelChoice(array('model' => 'WinePropertyValue', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'wine_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Wines', 'column' => 'id')),
      'wine_property_value_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WinePropertyValue', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('wine_properties_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WineProperties';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'wine_id'                => 'ForeignKey',
      'wine_property_value_id' => 'ForeignKey',
    );
  }
}
