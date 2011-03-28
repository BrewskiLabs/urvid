<?php use_helper('I18N', 'Date') ?>
<?php include_partial('wineproperties/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Wineproperties', array(), 'messages') ?></h1>

  <?php include_partial('wineproperties/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('wineproperties/form_header', array('WinePropertyName' => $WinePropertyName, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('wineproperties/form', array('WinePropertyName' => $WinePropertyName, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('wineproperties/form_footer', array('WinePropertyName' => $WinePropertyName, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<div>Values <a href="<?php echo url_for('@add_wine_property_value?property_name_id='.$WinePropertyName->getId());?>" id="addform2">+</a></div>
<?php include_partial('wineproperties/form2', array('WinePropertyName' => $WinePropertyName, 'forms' => $forms, 'configuration' => $configuration, 'helper' => $helper)) ?>