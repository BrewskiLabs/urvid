<?php

/**
 * Wines form.
 *
 * @package    wines
 * @subpackage form
 * @author     alex
 */
class WinesForm extends BaseWinesForm
{
  public function configure()
  {
    $this->widgetSchema['picture'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Company logo',
      'file_src'  => '/uploads/jobs/'.$this->getObject()->getPicture(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
    ));
    $this->validatorSchema['picture'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/jobs',
      'mime_types' => 'web_images',
    ));
  }
}
