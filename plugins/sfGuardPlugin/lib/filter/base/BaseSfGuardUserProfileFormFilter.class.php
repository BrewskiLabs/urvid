<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'first_name'   => new sfWidgetFormFilterInput(),
      'last_name'    => new sfWidgetFormFilterInput(),
      'facebook_uid' => new sfWidgetFormFilterInput(),
      'email'        => new sfWidgetFormFilterInput(),
      'email_hash'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'first_name'   => new sfValidatorPass(array('required' => false)),
      'last_name'    => new sfValidatorPass(array('required' => false)),
      'facebook_uid' => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'email_hash'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_id'      => 'ForeignKey',
      'first_name'   => 'Text',
      'last_name'    => 'Text',
      'facebook_uid' => 'Text',
      'email'        => 'Text',
      'email_hash'   => 'Text',
    );
  }
}
