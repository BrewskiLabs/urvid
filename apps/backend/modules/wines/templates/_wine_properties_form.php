<div id="ValuesForms">
<?php
foreach ($wine_properties as $form) {
    include_partial('wines/formValue', array('form' => $form));
}
?>
</div>