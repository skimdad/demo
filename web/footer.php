<div data-theme="a" data-role="footer" data-position="fixed">
                <!--<span class="ui-title">-->
                <div style="width: 100%; height: 55px; position: relative; background-color: #fbfbfb; border: 1px solid #b8b8b8;">
            <img src="http://codiqa.com/static/images/v2/image.png" alt="image" style="position: absolute; top: 50%; left: 50%; margin-left: -16px; margin-top: -18px">
        </div>
                <!--</span>-->
            </div>
            
            <? if($page_to_load != 'splash') : ?>
            <div data-role="content" style="padding: 15px">
                <ul data-role="listview" data-divider-theme="c" data-inset="true">
				
                <?php foreach($enabled_mobile_pages as $p) :  if($p != 'splash' ): ?>
	<li data-theme="c">
                        <a <?if($p == 'map' ) echo 'data-ajax="false"' ?>href="<?= $mobile_base_url.'index.php/'.$listing->getNumber('id').'/'.$p ?>" data-transition="slide">
                            <?=  $mobileAppObj->{$p.'_title'} ?>
                        </a>
                    </li>
				<?php endif; endforeach; ?>
				
             
                </ul>
            </div>
            <? endif ;?>
        </div>
        
        
        
        <script>
            //App custom javascript
        </script>
    </body>
</html>