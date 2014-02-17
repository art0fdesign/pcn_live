<?php
/**
 * Created by Lemmy.
 * Date: 3/25/13
 * Time: 7:56 PM
 */?>
<div class="socialShare">
    <?php if ($this->controller->isLive()): ?>
    <ul class="soc" id="socialShareLinks">
        <li><script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
            <!--<script type="IN/FollowCompany" data-id="2884818" data-counter="none"></script>-->
            <script type="IN/Share" data-id="2884818" data-counter="right"></script>
        </li>
        <li><div class="fb-like" data-href="http://www.facebook.com/pages/Payments-Consulting-Network/267363763392274" data-send="false" data-layout="button_count" data-width="75" data-show-faces="false" data-font="arial" style="z-index:10;"></div>
        </li>
        <li><a href="https://twitter.com/PaymentsConsNet" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @PaymentsConsNet</a>
        </li>
        <li>
            <div class="g-plus" data-action="share" data-annotation="none" data-href="https://plus.google.com/100412375096944407149" data-rel="publisher"></div>
            <script type="text/javascript">
              (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
              })();
            </script>
        </li>
    </ul>
    <?php endif; ?>
</div>
