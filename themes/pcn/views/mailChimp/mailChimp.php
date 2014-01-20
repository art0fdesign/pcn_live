<?php
$imgUrl = Yii::app()->theme->getBaseUrl() . '/img/';
?>
    <div id="popUpDiv" class="popUpDiv newsletter" style="display:none;">

       <a id="mc_back" class="back b-close"></a>

       <div class="top">
       <h1 class="black"><?php echo $settings['popup-title']['value']?></h1>
       </div>

       <div class="ajaxLoading">
            <img src="<?php echo $imgUrl?>ajax-loader.gif" />
       </div>
       <div class="newsletterInfo blue chimpInfo"></div>

        <form id="mc_form">
        <fieldset>
          <dl>
            <dt style="width:100px;" class="floatL mr10"><label>First Name*:</label></dt>
            <dd style="width:270px;" class="floatL">
                <img alt="ico" src="<?php echo $imgUrl?>ico_transparent.png" class="icosmall sprite1" />
                <input type="text" tabindex="10" class="textbox" style="width:270px;" name="Newsletter[first_name]" placeholder="Enter Your First Name" required="required" />
            </dd><br class="clear" />

            <dt style="width:100px;margin-top:14px;" class="floatL mr10"><label>Last Name*:</label></dt>
            <dd style="width:270px;" class="floatL mt5">
                <img alt="ico" src="<?php echo $imgUrl?>ico_transparent.png" class="icosmall sprite2" />
                <input type="text" tabindex="20" class="textbox" style="width:270px;" name="Newsletter[last_name]" placeholder="Enter Your Last Name" required="required" />
            </dd><br class="clear" />

            <dt style="width:100px;margin-top:14px;" class="floatL mr10"><label>Job Title:</label></dt>
            <dd style="width:270px;" class="floatL mt5">
                <img alt="ico" src="<?php echo $imgUrl?>ico_transparent.png" class="icosmall sprite3" />
                <input type="text" tabindex="30" class="textbox" style="width:270px;" name="Newsletter[job_title]" placeholder="Enter Your Job Title" />
            </dd><br class="clear" />

            <dt style="width:100px;margin-top:14px;" class="floatL mr10"><label>Company:</label></dt>
            <dd style="width:270px;" class="floatL mt5">
                <img alt="ico" src="<?php echo $imgUrl?>ico_transparent.png" class="icosmall sprite4" />
                <input type="text" tabindex="40" class="textbox" style="width:270px;" name="Newsletter[company]" placeholder="Enter Company Name" />
            </dd><br class="clear" />

            <dt style="width:100px;margin-top:14px;" class="floatL mr10"><label>E-mail*:</label></dt>
            <dd style="width:270px;" class="floatL mt5">
                <img alt="ico" src="<?php echo $imgUrl?>ico_transparent.png" class="icosmall sprite5" />
                <input type="email" tabindex="50" class="textbox" style="width:270px;" name="Newsletter[email]" placeholder="Enter Your e-mail Address" />
            </dd><br class="clear" /><br />

            <dd class="floatL mr10 mt10"><input type="checkbox" checked="checked" id="ch1" class="styled" name="Newsletter[group1]" /></dd>
            <dt class="floatL"><label for="ch1"><?php echo $settings['group1-title']['value']?></label></dt><br class="clear" />
            <dd class="pl30"><?php echo $settings['group1-description']['value']?></dd><br class="clear" />

            <dd class="floatL mr10 mt10"><input type="checkbox" checked="checked" id="ch2" class="styled" name="Newsletter[group2]" /></dd>
            <dt class="floatL"><label for="ch2"><?php echo $settings['group2-title']['value']?></label></dt><br class="clear" />
            <dd class="pl30"><?php echo $settings['group2-description']['value']?></dd><br class="clear" />

            <dd class="floatL mr10 mt10"><input type="checkbox" checked="checked" id="ch4" class="styled" name="Newsletter[group4]" /></dd>
            <dt class="floatL"><label for="ch4"><?php echo $settings['group4-title']['value']?></label></dt><br class="clear" />
            <dd class="pl30"><?php echo $settings['group4-description']['value']?></dd><br class="clear" />

            <dd class="floatL mr10 mt10"><input type="checkbox" checked="checked" id="ch3" class="styled" name="Newsletter[group3]" /></dd>
            <dt class="floatL"><label for="ch3"><?php echo $settings['group3-title']['value']?></label></dt><br class="clear" />
            <dd class="pl30"><?php echo $settings['group3-description']['value']?></dd><br class="clear" />

        </dl>
       </fieldset>
       </form>

       <a id="mc_submit" href="#" class="btn_blue floatL">Subscribe</a>
       <div class="floatL newsletterInfo chimpError"></div>
    </div>

