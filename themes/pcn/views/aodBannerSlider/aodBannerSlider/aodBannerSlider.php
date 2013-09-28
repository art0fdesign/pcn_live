<?php
/**
 * Created by Lemmy.
 * Date: 3/21/13
 * Time: 11:22 PM
 */
?>
<div id="<?php echo $divID ?>">
    <?php foreach($slides as $slide): ?>
        <div class="slide1">
            <img class="bannerPic" src="<?php echo $slide['url'] ?>" alt="<?php echo $slide['alt'] ?>">
            <div class="text"><?php echo Frontend::replaceAllTagsInContent( $slide['text'] )?></div>
        </div>
    <?php endforeach; ?>
</div>
