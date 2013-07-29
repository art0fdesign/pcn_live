    <div class="rightWidget widget">
        <div class="title"><h6>Tags List</h6></div>

        <div class="formRow mt30">
            <b>Tag</b><span>Attribute</span>
        </div>
<?php foreach( $tags as $key=>$value ){ ?>

        <div class="formRow">
            <b><?=$value?></b>
            <span><?=$key?></span>
        </div>
<?php } ?>
    </div>
