<div>
    <form action="<?php echo url_for('@save_wines_property_value');?>" method="post">
        <?php echo $form->renderGlobalErrors() ?>
        <?php echo $form->renderHiddenFields() ?>
        <?php echo $form['name_id']->renderLabel() ?>: <?php //echo $form['name']->render(array('id' => 'myid'.$form->getObject()->getId())); ?>
        <?php echo $form['name_id']?>
        <?php echo $form['value_id']->renderLabel() ?>: <?php //echo $form['name']->render(array('id' => 'myid'.$form->getObject()->getId())); ?>
        <?php echo $form['value_id']?>
        <input type="submit"name="actions" value="Save" />
        <input type="submit" name="actions" value="Delete" />
    </form>
</div>