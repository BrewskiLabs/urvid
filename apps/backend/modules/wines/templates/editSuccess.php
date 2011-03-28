<?php use_helper('I18N', 'Date') ?>
<?php include_partial('wines/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Wines', array(), 'messages') ?></h1>

  <?php include_partial('wines/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('wines/form_header', array('wines' => $wines, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('wines/form', array('wines' => $wines, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('wines/form_footer', array('wines' => $wines, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>

<div>Values <a href="<?php echo url_for('@add_wines_property_name?wines_id='.$wines->getId());?>" id="addformProperty">+</a></div>
<?php include_partial('wines/wine_properties_form', array('wines' => $wines, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'wine_properties' => $wine_properties)) ?>
