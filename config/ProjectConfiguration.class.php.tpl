<?php
ini_set('memory_limit', '256M');
ini_set('post_max_size', '128M');
ini_set('upload_max_filesize', '128M');


require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
  }
}
