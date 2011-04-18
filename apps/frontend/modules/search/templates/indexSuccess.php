<form action="<?php echo url_for("@search_result") ?>" method="post">
    <input type="text" name="year"/>
    <select name="winery">
        <option value=""></option>
        <?php foreach ($winery as $value) {?>
        <option value="<?php echo $value->getId()?>"><?php echo $value->getName()?></option>
        <?php } ?>
    </select>
    <select name="winery_type">
        <option value=""></option>
        <?php foreach ($winere_type as $value) {?>
        <option value="<?php echo $value->getId()?>"><?php echo $value->getName()?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Search"/>
</form>

<?php 
    if(isset($pager)) {
        foreach ($pager->getResults() as $wine) {
?>
            <?php echo $wine->getLable()?>
            <?php echo $wine->getDescription()?>
            <?php echo $wine->getYear()?>
<?php
        }
?>
        <?php $count_pager = count($pager->getLinks());
           foreach ($pager->getLinks() as $page): ?>
        <?php  if ( $count_pager<=5 )  { ?>
            <?php  if ( $page == $pager->getPage() )  { ?>
                <?php  echo $page ?>
            <?php } else { ?>
                <a href="<?php echo url_for('@search_page?page='.$page) ?>"><?php echo $page ?></a>
            <?php } ?>
        <?php } ?>
        <?php endforeach; ?>
<?php
    }
?>