<div>
    <form action="<?php echo url_for('@save_wine_property_value');?>" method="post">
        <?php echo $form2->renderGlobalErrors() ?>
        <?php echo $form2->renderHiddenFields() ?>
        <?php echo $form2['name']->renderLabel() ?>: <?php echo $form2['name']->render(array('id' => 'myid'.$form2->getObject()->getId())); ?>
        <input type="submit"name="actions" value="Save" />
        <input type="submit" name="actions" value="Delete" />
    </form>
</div>
