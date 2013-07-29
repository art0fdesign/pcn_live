
<div class="homeBlock homeBlock1">
    <h1 class="title">PCN News</h1>
    <ul>
<?php foreach( $models as $item ): ?>
<?php
$href = $linkBaseUrl . '/' . $item->item_seo; 
?>
        <li>                
            <?php                
                $t = Frontend::replaceAllTagsInContent( $item->html_widget );                 
                echo str_replace( '{href}', $href, $t);
            ?>
        </li>
<?php endforeach; ?>
    </ul>
    <a class="btn_blue" href="<?php echo $linkBaseUrl?>">view all</a>
</div>
