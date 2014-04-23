<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$doc=JFactory::getDocument();
$doc->addStyleSheet(JURI::root().'/modules/mod_adv_slider/css/mod_adv_slider.css');
$doc->addScript(JURI::root().'/modules/mod_adv_slider/js/jquery-1.4.4.min.js');
$doc->addScript(JURI::root().'/modules/mod_adv_slider/js/jsCarousel-2.0.0.js');

require_once JPATH_ROOT . '/components/com_banners/helpers/banner.php';
$baseurl = JURI::base();







?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#carouselv').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: false, itemstodisplay: 3, orientation: 'v' });
        $('#carouselh').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: false, masked: false, itemstodisplay: 5, orientation: 'h' });
        $('#carouselhAuto').jsCarousel({ onthumbnailclick: function(src) { alert(src); }, autoscroll: true, masked: true, itemstodisplay: 5, orientation: 'h' });
    });
</script>



<div id="contents">

    <div id="v2">

        <div id="demo-wrapper">

            <div id="demo-left">

                <div id="vWrapper">

                    <div id="carouselv">

                        <?php foreach($imagelist as $item): ?>

                                <?php $imageurl = $item->params->get('imageurl');?>
                                <?php $width = $item->params->get('width');?>
                                <?php $height = $item->params->get('height');?>

                                <div>
                                    <img
                                    src="<?php echo $baseurl . $imageurl;?>"
                                    alt="<?php echo $alt;?>"
                                    <?php if (!empty($width)) echo 'width ="'. $width.'"';?>
                                    <?php if (!empty($height)) echo 'height ="'. $height.'"';?>
                                    /><br />

                                    <span class="thumbnail-text"><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8');?>  </span>
                                </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
