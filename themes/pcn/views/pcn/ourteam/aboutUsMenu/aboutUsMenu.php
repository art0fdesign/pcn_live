<?php
$overview = 'Overview';
$overSeo = Frontend::getPageData( intval(@$settings['overview-page-id']['value']) );
$givingBack = 'Giving Back';
$givingSeo = Frontend::getPageData( intval(@$settings['giving-back-page-id']['value']) );
$ourTeam = 'Our Team';
$ourSeo = Frontend::getPageData( intval(@$settings['our-team-page-id']['value']) );
$ourPartners = 'Our Partners';
$partnersSeo = Frontend::getPageData( intval(@$settings['our-partners-page-id']['value']) );
$ourClients = 'Our Clients';
$clientsSeo = Frontend::getPageData( intval(@$settings['our-clients-page-id']['value']) );
//MyFunctions::echoArray( $settings );
?>

<div class="narrow narrow1 floatL mb20">
    <h2 class="mt25 black">About Us</h2>
    <ul class="links">
        <li class="dotedB"><a href="<?php echo $linkBaseUrl.'/'.$overSeo ?>"
            <?php //if($this->pars[0] == $overSeo) echo 'class="active"' ?>>
            <?php echo $overview ?></a>
        </li>
        <li class="dotedB">
            <a href="#" class="accordionParent on<?php //if($this->pars[0] == $ourSeo) echo ' active' ?>">
                <?php echo $ourTeam ?>
            </a>
            <ul class="accordionMenu" style="display:none;">
<?php foreach (Yii::app()->params['pcnOurTeamLocations'] as $lkey=>$lvalue): ?>
                <li<?php //if($this->pars[1]==strtolower($lvalue)) echo 'class="active"' ?>>
                    <a href="<?php echo $linkBaseUrl . '/' . $ourSeo . '/' . strtolower($lvalue); ?>" 
                        class="accordionParentLevel2 on<?php if($this->pars[1] == strtolower($lvalue)) echo ' active' ?>">
                        <?php echo $lvalue; ?>
                    </a>
                    <?php if(isset($items[$lkey])):?>
                    <ul class="accordionMenuLevel2" style="display: none" >
                        <?php foreach($items[$lkey] as $item): ?>
                            <li>
                                <a href="<?php echo $linkBaseUrl . '/' . $ourSeo . '/' . strtolower($lvalue) . '#' . $item['seo'] ?>">
                                <?php echo $item['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;?>
                </li>
<?php endforeach; // locations ?>
            </ul>
        </li>
        <li class="dotedB"><a href="<?php echo $linkBaseUrl.'/'.$clientsSeo ?>"
            <?php if($this->pars[0] == $givingSeo) echo 'class="active"' ?>>
            <?php echo $ourClients ?></a>
        </li>
        <li class="dotedB"><a href="<?php echo $linkBaseUrl.'/'.$partnersSeo ?>"
            <?php if($this->pars[0] == $givingSeo) echo 'class="active"' ?>>
            <?php echo $ourPartners ?></a>
        </li>
        <li class="dotedB"><a href="<?php echo $linkBaseUrl.'/'.$givingSeo ?>"
            <?php if($this->pars[0] == $givingSeo) echo 'class="active"' ?>>
            <?php echo $givingBack ?></a>
        </li>
    </ul>
</div>
