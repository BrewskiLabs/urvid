<?php

/**
 * Wines filter form base class.
 *
 * @package    wines
 * @subpackage filter
 * @author     alex
 */
abstract class BaseWinesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'lable'       => new sfWidgetFormFilterInput(),
      'picture'     => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'lable'       => new sfValidatorPass(array('required' => false)),
      'picture'     => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wines_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wines';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'lable'       => 'Text',
      'picture'     => 'Text',
      'description' => 'Text',
    );
  }
}
